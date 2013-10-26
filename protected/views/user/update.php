<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Manage Users'=>array('admin'),
	$model->username,
);

?>



<div class="row">
	<div class="span6">
		<h3>User #<?php echo $model->uid; ?></h3>
		<?php $this->widget('bootstrap.widgets.TbDetailView', array(
			'data'=>$model,
			'type' => 'striped bordered',
			'attributes'=>array(
				'uid',
				'username',
				'email',
				'name',
				'role',
				'create_time',
				'update_time',
				'last_login_time',
			),
		)); ?>
	</div>
	<div class="span6">
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
	<legend>Change role</legend>
		<?php if (isset($showSucceed)):?>
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Operation succeed!
		</div>
		<?php endif?>
		<?php echo $form->errorSummary($model, 
			$header='<button type="button" class="close" data-dismiss="alert">&times;</button><p>Please fix the following input errors:</p>', 
			'', array('class'=>'alert alert-error',)); ?>
		<div class="control-group">
		 	<label class="control-label">Choose the Role</label>
		 	<div class="controls">
		 		<?php echo $form->dropDownList($model,'role', $model->getRoleOptions()); ?>
		    </div>
		</div>	
		<!-- Button (Double) -->
		<div class="control-group">
		  	<div class="controls">
		    	<button type="submit" class="btn btn-primary">Save</button>
		    	<input Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('user/admin');?>'"/>
		  	</div>
		</div>
	</fieldset>
	
	<?php $this->endWidget(); ?>
	</div>
</div>
