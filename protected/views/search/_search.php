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
					'htmlOptions'=>array('class'=>'span3', 'placeholder' => 'auto-complete'),
					'value'=>$data_model->label_name,
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
				'buttonType' => 'submit',
				'type'=>'default',
				'label'=>'Search',
				'htmlOptions'=>array('class'=>'pull-right'),
			)); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>
<hr/> 