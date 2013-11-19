<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'image-data-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'uploader',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'flickr_user',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'date_uploaded_flickr',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'latitude',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'longitude',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'precision',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'title',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'license',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'flickr_photo_id',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'date_uploaded',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'farm',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'server',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'secret',array('class'=>'span5')); ?>

	
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
