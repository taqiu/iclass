<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'image-set-form',
	'enableAjaxValidation'=>false,
)); ?>

<style>
tr.filters {
	display:none;
}
</style>

<?php $form->widget('ext.selgridview.BootSelGridView',array(
'id'=>'image-data-grid',
'dataProvider'=>$data_model->search(),
'selectableRows'=>2,
'filter'=>$data_model,
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

<hr/>
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
		
	<?php echo CHtml::link('Preview','#',array('class'=>'preview-button btn btn-success pull-right')); ?>
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