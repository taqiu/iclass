<?php
$this->breadcrumbs=array(
	'Search'
);
Yii::app()->clientScript->registerScript('search', "
$('.preview-button').click(function(){
	$('.preview-list').toggle();
	return false;
});
$('.hide-button').click(function(){
	$('#image-data-grid').toggle();
	return false;
});	
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('image-data-grid', {
	data: $(this).serialize()
	});
	$('#image-set-form').show();
	$.fn.yiiListView.update('VideoList', {
	data: $(this).serialize()
	});
	return false;
});
");
?>

<div  class="search-form" style="">
  <?php $this->renderPartial('_search',array(
  'data_model'=>$data_model, 'labelNames'=>$labelNames
)); ?> 
</div>
 
<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model, 'show_result'=>$show_result), true, false); ?>

<div class='preview-list' style='display:none'>
<hr/>
<p>Result Preview </p>
<?php 
$this->widget('zii.widgets.CListView', array(
       'id' => 'VideoList',
       'htmlOptions' => array('class'=>'image-list'),
       'dataProvider' => $data_model->search(),
       'itemView' => '_view',
	   'itemsCssClass'=>'items',
       'template' => '{items} {pager}',
       'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.item', 
                    'listViewId' => 'VideoList', 
                    'header' => '',
                    'loaderText'=>'Loading...',
                    'options' => array('history' => false, 'triggerPageTreshold' => 12, 'trigger'=>'Load more'),
                    ),
	   'afterAjaxUpdate' => "function(id, data) {
			// unbind to solvoe duplicate problem
			$(window).unbind('scroll');
			$('#VideoList .items').unbind('scroll');
	        $.ias({
	            'history': false,
	            'triggerPageTreshold': 12,
	            'trigger': 'Load more',
	            'container': '#VideoList > .items',
	            'item': '.item',
	            'pagination': '#VideoList .pager',
	            'next': '#VideoList .next:not(.disabled):not(.hidden) a',
	            'loader': 'Loading...'
	        });
       }",
));?>
</div>