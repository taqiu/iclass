<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index')),
array('label'=>'Create Label Task','url'=>array('create')),
array('label'=>'Manage Label Task','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
);
?>

<h3>Update Label Task #<?php echo $model->id; ?></h3>
<hr/>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'label-task-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
	<?php echo $form->labelEx($model,'Name'); ?>
	<?php echo $form->textField($model, 'name', array('class'=>'span4','maxlength'=>64)); ?>

	<?php echo $form->labelEx($model,'status'); ?>
	<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Save',
			)); ?>
		<input style='margin:5px 15px 0px 0px' Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('labelTask/admin');?>'"/>
	</div>
<?php $this->endWidget(); ?>