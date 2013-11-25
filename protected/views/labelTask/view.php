<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index')),
array('label'=>'Create Label Task','url'=>array('create')),
array('label'=>'Manage Label Task','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
//array('label'=>'Delete This Label Task','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3>Label Task #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => 'striped bordered',
	'attributes'=>array(
		'id',
		'name',
		'owner_name',
		'image_set_name',
		'label_name',
		'create_time',
		'status',
),
)); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'label-task-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo Yii::app()->user->getFlash('success');?>
	</div>
<?php endif; ?>
<?php echo $form->errorSummary($model); ?>
	<?php echo $form->labelEx($model,'Name'); ?>
	<?php echo $form->textField($model, 'name', array('class'=>'span4','maxlength'=>64)); ?>

	<?php echo $form->labelEx($model,'status'); ?>
	<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

	<hr/>
	<div class="control-group">
		  	<div class="controls">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>'Save',
				)); ?>
			<input style='margin:0px 15px 0px 15px' Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('labelTask/admin');?>'"/>
			<?php echo CHtml::button('Delete', array('style'=>'margin:5px 0px 0px 0px', 'class'=>"btn btn-danger pull-right", 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>
