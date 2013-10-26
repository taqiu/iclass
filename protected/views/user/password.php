<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$model->name=>array('view','id'=>$model->uid),
	'Password',
);

$this->menu=array(
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->uid)),
	array('label'=>'Update Profile', 'url'=>array('profile', 'id'=>$model->uid)),
	array('label'=>'Change Passwrod', 'url'=>array('password', 'id'=>$model->uid), 'itemOptions'=>array('class'=>'active')),
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'password-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
			),
		)); ?>
	<fieldset>
	<!-- Form Name -->
	<legend>Change password</legend>
	<?php if (isset($showSucceed)):?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Operation succeed!
		</div>
	<?php endif?>
	<?php echo $form->errorSummary($model, 
			$header='<button type="button" class="close" data-dismiss="alert">&times;</button><p>Please fix the following input errors:</p>', 
			'', array('class'=>'alert alert-error',)); ?>
	<div class="control-group">
	  <label class="control-label">Old password</label>
	  <div class="controls">
	    <?php echo $form->passwordField($model,'old_password',array('size'=>60,'maxlength'=>64, 'class'=>'input-xlarge', 'required'=>'required')); ?>
	  </div>
	</div>

	<div class="control-group">
	  <label class="control-label" for="textinput">New password</label>
	  <div class="controls">
	    <?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>64, 'class'=>'input-xlarge', 'required'=>'required')); ?>
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="textinput">New password repeat</label>
	  <div class="controls">
	    <?php echo $form->passwordField($model,'new_password_repeat',array('size'=>60,'maxlength'=>64, 'class'=>'input-xlarge', 'required'=>'required')); ?>
	  </div>
	</div>
	<!-- Button (Double) -->
	<div class="control-group">
	  <label class="control-label" for=""></label>
	  <div class="controls">
	    <button type="submit" class="btn btn-primary">Save</button>
	  </div>
</div>
</fieldset>
<?php $this->endWidget(); ?><!-- form -->


