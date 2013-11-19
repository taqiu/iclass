<div class="form-actions">
 
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'group-form',
        'enableAjaxValidation'=>false,
)); ?>
 
 
<?php
    //show errorsummary at the top for all models
    //build an array of all models to check
    echo $form->errorSummary(array_merge(array($model),$validatedMembers));
?>
 
<div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name'); ?>
    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
</div>
 
<?php
 
// see http://www.yiiframework.com/doc/guide/1.1/en/form.table
// Note: Can be a route to a config file too,
//       or create a method 'getMultiModelForm()' in the member model
 
$memberFormConfig = array(
      'elements'=>array(
        'answer'=>array(
			'label'=>'Possible Answers',
            'type'=>'textarea',
            'rows'=>2,
			'cols'=>50,
			'class'=>'span6'
        ),
    ));
 
$this->widget('ext.multimodelform.MultiModelForm',array(
        'id' => 'id_member', //the unique widget id
        'formConfig' => $memberFormConfig, //the form configuration array
        'model' => $member, //instance of the form model
 
        //if submitted not empty from the controller,
        //the form will be rendered with validation errors
        'validatedItems' => $validatedMembers,
 
        //array of member instances loaded from db
        'data' => $member->findAll('label_id=:groupId', array(':groupId'=>$model->id)),
    ));
?>
 
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->