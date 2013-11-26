<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index')),
array('label'=>'Create Label Task','url'=>array('create'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'Manage Label Task','url'=>array('admin')),
);
?>

<h3>Create New Label Task</h3>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'label-task-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required. <br/> 'Image Set Name' and 
'Label Name' can autocomplete.</p>
<hr/>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'name'); ?>
	<?php echo $form->textField($model, 'name', array('class'=>'span4','maxlength'=>64)); ?>
	
	<?php echo $form->labelEx($model,'image_set_name'); ?>
	<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'image_set_name',
			'data'=>$imageSetNames,
			'multiple'=>false,
			'htmlOptions'=>array('class'=>'span4'),
	)); ?>
	
    <?php echo $form->labelEx($model,'label_name'); ?>
	<?php $this->widget('CAutoComplete', array(
    		'model'=>$model,
			'attribute'=>'label_name',
			'data'=>$labelNames,
			'multiple'=>false,
			'htmlOptions'=>array('class'=>'span4'),
	)); ?>
	
	<?php echo $form->labelEx($model,'status'); ?>
	<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Create',
			)); ?>
	</div>

<?php $this->endWidget(); ?>
