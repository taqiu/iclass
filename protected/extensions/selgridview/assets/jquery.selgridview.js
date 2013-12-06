(function ($) {
    var methods,
	selected,
    selGridSettings = [];
    
    methods = {
        init: function (options) {
            var selSettings = $.extend({
                selVar: 'sel'
            }, options || {});

            return this.each(function () {
                var $grid = $(this),
                id = $grid.attr('id'),
                beforeAjaxUpdateOrig,
				afterAjaxUpdateOrig;

                selGridSettings[id] = selSettings;

                //overloading beforeAjaxUpdate 
                var settings = $.fn.yiiGridView.settings[id];
                if(settings.beforeAjaxUpdate !== undefined) {
                    beforeAjaxUpdateOrig = settings.beforeAjaxUpdate;
                } else {
                    beforeAjaxUpdateOrig = function(id, options) {}; 
                }

                delete settings.beforeAjaxUpdate;
                settings.beforeAjaxUpdate = function(id, options) {
                    var selection = $('#' + id).selGridView('getAllSelection');
                    
					$("#ImageSet_imageList").val(selection);
					
                    //call user's handler
                    beforeAjaxUpdateOrig(id, options);
                }
				
				
				if(settings.beforeAjaxUpdate !== undefined) {
                    afterAjaxUpdateOrig = settings.afterAjaxUpdate;
                } else {
                    afterAjaxUpdateOrig = function(id, options) {}; 
                }

                delete settings.afterAjaxUpdate;
                settings.afterAjaxUpdate = function(id, options) {
                                   
					var keys = JSON.parse("[" + $("#ImageSet_imageList").val()+ "]"),
					pageKeys = $('#' + id).find(".keys span"),
                	rows = $('#' + id).find("tbody tr"),
					checkedInPage = $('#' + id).yiiGridView('getSelection');
					//uncheck things !!! TODO
					if(!$.isArray(keys)) keys = [keys];
					$('#' + id).find('tr.selected').click();
					
					$.each(keys, function(index, value) {
							pageKeys.each(function (i) {
								if($(this).text() == value) {
									rows.eq(i).click();
								}
							});
						 });
					
					
					
					
					
                    //call user's handler
                    afterAjaxUpdateOrig(id, options);
                }
				

            });
        },        
          
        getAllSelection: function () {
            var settings = $.fn.yiiGridView.settings[this.attr('id')],
            
			
            //rows selected by GET
            checkedInQuery = JSON.parse("[" + $("#ImageSet_imageList").val()+ "]");
			
			if(!$.isArray(checkedInQuery)) checkedInQuery = [checkedInQuery];

            //rows selected on current page
            var checkedInPage = this.yiiGridView('getSelection');
			
			//alert(checkedInQuery);
			//alert(checkedInPage);
            /*
              if only one row can be selected:
                1. if selected on current page - return it
                2. if nothing selected on current page - return previous selection
            */
            if(settings.selectableRows == 1) {
                if(checkedInPage.length) {
                    return checkedInPage;
                } else {
                    return checkedInQuery;
                }
            }

            /*
            if selectableRows > 1 - merge selected on current page with selected on other pages
            We need go though all keys on current page because user could deselect some of previously selected - we should delete it
            */

            //iterating all keys of this page
            this.find(".keys span").each(function (i) {
                var key = $(this).text();
				
                //row found in GET params: means row was selected on page load
                var indexInQuery = $.inArray(parseInt(key), checkedInQuery);
				
                //row is checked on current page
                var indexInChecked = $.inArray(key, checkedInPage);

                //row is selected and not in GET params --> adding to GET params
                if(indexInChecked >= 0 && indexInQuery == -1) {
                    checkedInQuery.push(key); 
                }

                //row not selected, but in GET params due to selected on page load --> deleting from GET params
                if(indexInChecked == -1 && indexInQuery >= 0) {
                    checkedInQuery.splice(indexInQuery, 1); 
                }
            });     

            return checkedInQuery;                  
        },
        
        clearAllSelection: function() {
             //clear on current page
             this.find('tr.selected').click();
			 $("#ImageSet_imageList").val(" ");      
		},
        
        addSelection: function(keys) {
            if(!keys || keys.length == 0) return;
			if(!$.isArray(keys)) keys = [keys];
			
			if(keys.length == 1)
				keys = JSON.parse("[" + keys[0].split(",") + "]")[0];
			
            var parsed = this.yiiGridView('getSelection'),
				pageKeys = this.find(".keys span"),
                rows = this.find("tbody tr");
               
		     //add to url params
             $.each(keys, function(index, value) {
                 if($.inArray(value, parsed) === -1) {
                    parsed.push(value); 
                    //select row on grid
                    pageKeys.each(function (i) {
                        if($(this).text() == value) {
                            rows.eq(i).click();
                        }
                    });
                 }
             });
  
			 $("#ImageSet_imageList").val(parsed);
        }
	}
        
       
    $.fn.selGridView = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        }else {
            $.error('Method ' + method + ' does not exist on jQuery.selGridView');
            return false;
        }
    };        

})(jQuery);