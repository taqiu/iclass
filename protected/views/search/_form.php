<?php 
$url = Yii::app()->createUrl('search/loadAns');
Yii::app()->clientScript->registerScript('load_ans', "
$('input[id=ImageData_label_name]').change(function() {
	$('#ImageData_possible_ans option').remove();
	var label_name = $(this).val();
	var sent_data = 'label_name='+label_name;
	$.ajax({
		url:\"".$url."\",
		type: 'GET',
		data: sent_data,
		cache:false,
		success: function(data) {
        	$('#ImageData_possible_ans').append(data);
		},
		error:function(jxhr){
        	//alert(jxhr.responseText);
    	}
	});
});"
);
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<legend>Semantic Search</legend>
	<div class="control-group controls-row">
		<div class="controls span1">
			<label>Image ID</label>
			<?php echo $form->textField($data_model,'id',array('class'=>'span1')); ?>
		</div>
		<div class="controls span2">
			<label>Uploader UID </label>
			<?php echo $form->textField($data_model,'uploader',array('class'=>'span2')); ?>
		</div>
		<div class="controls span2">
			<label>Upload Time </label>
			<?php echo $form->textField($data_model,'date_uploaded',array('class'=>'span2')); ?>
		</div>
		<div class="controls span3">
			<label>Flickr User </label>
			<?php echo $form->textField($data_model,'flickr_user',array('class'=>'span3','maxlength'=>128)); ?>
		</div>
		<div class="controls span2">
			<label> Flickr Upload Time</label>
			<?php echo $form->textField($data_model,'date_uploaded_flickr',array('class'=>'span2', 'placeholder'=>'e.g. 2007-08-03')); ?>
		</div>
		<div class="controls span1">
			<label>License </label>
			<?php echo $form->textField($data_model,'license',array('class'=>'span1')); ?>
		</div>
	</div>
	<div class="control-group controls-row">
		<div class="controls span2">
			<label>Latitude</label>
			<?php echo $form->textField($data_model,'latitude',array('class'=>'span2', 'placeholder' => 'e.g. < 39.162')); ?>
		</div>
		<div class="controls span2">
			<label>Longitude</label>
			<?php echo $form->textField($data_model,'longitude',array('class'=>'span2', 'placeholder' => 'e.g. > 86.52')); ?>
		</div>
		<div class="controls span1">
			<label>Precision </label>
			<?php echo $form->textField($data_model,'precision',array('class'=>'span1')); ?>
		</div>
		<div class="controls span2">
			<label>Flickr Photo ID </label>
			<?php echo $form->textField($data_model,'flickr_photo_id',array('class'=>'span2')); ?>
		</div>
		<div class="controls span2">
			<label>Title </label>
			<?php echo $form->textField($data_model,'title',array('class'=>'span2','maxlength'=>64)); ?>
		</div>
		<div class="controls span2">
			<label>Tags </label>
			<?php echo $form->textField($data_model,'tagSearch',array('class'=>'span2','maxlength'=>64, 'placeholder' => 'tag keyword')); ?>
		</div>
	</div>
	<div class="control-group controls-row">
		<div class="controls span3">
			<label>Label Name</label>
			<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
					'name'=>'ImageData[label_name]',
					'options'=>array(
						'source'=>$labelNames,
						'items'=>5,
						'matcher'=>"js:function(item) {
		            		return ~item.toLowerCase().indexOf(this.query.toLowerCase());
		        		}",
					),
					'htmlOptions'=>array('class'=>'span3', 'placeholder' => 'auto-complete', 'name'=>'ImageData[label_name]'),
			)); ?>
		</div>
		<div class="controls span6">
			<label>Possible Answer </label>
			<select id="ImageData_possible_ans" name="ImageData[possible_ans]" class="span6">
			</select>
		</div>
		<div class="controls span2 pull-right">
			<label>&nbsp;</label>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'id'=>'search',
				'buttonType' => 'submit',
				'type'=>'default',
				'label'=>'Search',
				'htmlOptions'=>array('class'=>'pull-right', 'id'=>'search','name'=>'search'),
			)); ?>
		</div>
	</div>


<?php $form->widget('ext.selgridview.BootSelGridView',array(
'id'=>'image-data-grid',
'dataProvider'=>$data_model->search(),
'selectableRows'=>2,
'columns'=>array(
		array(
          'id' => 'checkedImages',
		  'class' => 'CCheckBoxColumn',
        ),
		'id',
		'uploader',
		'flickr_user',
		'date_uploaded_flickr',
		'latitude',
		'longitude',
		array('header'=>'Tags','name'=>'tagSearch','value'=>function($data){
													$temp = array();
													foreach($data->tags as $t)
														$temp[] = $t->tag_text;
													$string = implode(',', $temp);
													return (strlen($string) > 20) ? substr($string, 0, 20).'...' : $string;
													}),
),
)); ?>


<?php echo $form->hiddenField($model,'imageList',array('value'=>''));?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'all',
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Select All',
			'htmlOptions'=>array('id'=>'all', 'name'=>'all'),
		)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'clear',
			'buttonType'=>'reset',
			'type'=>'primary',
			'label'=>'Clear All',
		)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'down',
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Download URLs',
			'htmlOptions'=>array('id'=>'down', 'name'=>'down'),
		)); ?>
		
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'set',
			'buttonType'=>'submit',
			'type'=>'primary',
			'url'=>Yii::app()->createUrl('imageSet/create'),
			'label'=>'Save as Image Set',
			'htmlOptions'=>array('id'=>'set', 'name'=>'set'),
		)); ?>
			
</div>



<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScript('fill','$("#image-data-grid").selGridView("addSelection", '.json_encode($model->imageList).');');?>
<?php Yii::app()->clientScript->registerScript('postChecked', 'function postChecked(){
		var arraySel = $("#image-data-grid").selGridView("getAllSelection");
        var stringSel=arraySel.join(",");                                                                          
        $("#ImageSet_imageList").val(stringSel);}');?>
<?php Yii::app()->clientScript->registerScript('clearall', 'function clearall(){
		$("#image-data-grid").selGridView("clearAllSelection");}');?>
<?php Yii::app()->clientScript->registerScript('init','$(document).ready(function(){ $("#down").on("click", postChecked);});'); ?>
<?php Yii::app()->clientScript->registerScript('init2','$(document).ready(function(){ $("#set").on("click", postChecked);});'); ?>
<?php Yii::app()->clientScript->registerScript('init3','$(document).ready(function(){ $("#search").on("click", postChecked);});'); ?>
<?php Yii::app()->clientScript->registerScript('sel', '$(document).ready(function(){ $("#clear").on("click", clearall);});');?>