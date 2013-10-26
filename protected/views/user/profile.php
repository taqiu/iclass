<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$model->username=>array('view','id'=>$model->uid),
	'Profile',
);

$this->menu=array(
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->uid)),
	array('label'=>'Update Profile', 'url'=>array('profile', 'id'=>$model->uid), 'itemOptions'=>array('class'=>'active')),
	array('label'=>'Change Passwrod', 'url'=>array('password', 'id'=>$model->uid)),
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'profile-form',
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
	<legend>Update Profile</legend>
	<?php if(Yii::app()->user->hasFlash('success')):?>
    	<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo Yii::app()->user->getFlash('success');?>
		</div>
	<?php endif; ?>
	<?php echo $form->errorSummary($model, 
			$header='<button type="button" class="close" data-dismiss="alert">&times;</button><p>Please fix the following input errors:</p>', 
			'', array('class'=>'alert alert-error',)); ?>
	<div class="control-group">
	  <label class="control-label">Username</label>
	  <div class="controls">
	    <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64, 'class'=>'input-xlarge', 'placeholder'=>'Username', 'required'=>'required')); ?>
	    <p class="help-block">Username you can sign in with</p>
	  </div>
	</div>

	<div class="control-group">
	  <label class="control-label" for="textinput">E-mail</label>
	  <div class="controls">
	    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'class'=>'input-xlarge', 'placeholder'=>'you@example.com', 'required'=>'required')); ?>
	    <p class="help-block">Email address we can contact you</p>
	  </div>
	</div>

	<div class="control-group">
	  <label class="control-label" for="textinput">Name (optional)</label>
	  <div class="controls">
	    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128, 'placeholder'=>'FirstName  LastName', 'class'=>'input-xlarge')); ?>
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
<?php $this->endWidget(); ?>

