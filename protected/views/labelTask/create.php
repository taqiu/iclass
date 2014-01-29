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

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<hr/>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'name'); ?>
	<?php echo $form->textField($model, 'name', array('class'=>'span4','maxlength'=>64)); ?>
	
	<?php echo $form->labelEx($model,'image_set_name'); ?>

	<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
			'name'=>'LabelTask[image_set_name]',
			'options'=>array(
				'source'=>$imageSetNames,
				'items'=>5,
				'matcher'=>"js:function(item) {
            		return ~item.toLowerCase().indexOf(this.query.toLowerCase());
        		}",
			),
			'htmlOptions'=>array('class'=>'span4', 'placeholder' => 'auto-complete'),
	)); ?>
	
    <?php echo $form->labelEx($model,'label_name'); ?>
	<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
			'name'=>'LabelTask[label_name]',
			'options'=>array(
				'source'=>$labelNames,
				'items'=>5,
				'matcher'=>"js:function(item) {
            		return ~item.toLowerCase().indexOf(this.query.toLowerCase());
        		}",
			),
			'htmlOptions'=>array('class'=>'span4', 'placeholder' => 'auto-complete'),
	)); ?>
	
	<?php echo $form->labelEx($model,'status'); ?>
	<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

	<?php echo $form->labelEx($model,'label_set_size'); ?>
	<?php echo $form->textField($model, 'label_set_size', array('class'=>'span4','maxlength'=>1000, 'value'=>0)); ?>
<p> <span class="label label-info">Hint</span>  If 0, the whole set is given to each labeller.

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Create',
			)); ?>
	</div>

<?php $this->endWidget(); ?>
