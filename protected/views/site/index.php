<?php $this->pageTitle=Yii::app()->name; ?>

<div id='logo'>
       <a href="http://vision.soic.indiana.edu/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/default-logo.png" width="960" height="129" /></a>
</div><!-- end of #logo -->

<div class="row">
	<div class="span8">
		<center><h3><font color=red>I</font>mage 
			<font color=red>C</font>ollaborative 
			<font color=red>L</font>abelling 
			<font color=red>A</font>nd <br/>
			<font color=red>S</font>emantic 
			<font color=red>S</font>earch System</h3></center>
		<hr/>
		<h4>I. About <font color=red>ICLASS</font></h4>
		<p> <b><font color=red>ICLASS</font></b> is a collaborative labelling system designed by the Computer Vision Lab at Indiana University. It provides the capability to
		manage a large-scale image collection and coordinate collaborative human-labelling tasks based on image content. The responses to these
		labels can then be searched to produce semantically meaningful image sets for vision experiments.
		</p>
		<h4>II. Getting started</h4>
		<p>As some of the image data stored may be sensitive, each user must be cleared by the administrator. This is to ensure only users
		who are actively participating in experiments can utilize the system. To gain access to the <b><font color=red>ICLASS</font></b> system:
		</p><div style="text-align:center; margin:30px">
			<img alt="workflow" src="<?php echo Yii::app()->request->baseUrl; ?>/img/workflow.png" width="420"  />
	</div>
	
		
	</div>
	<div class="span4 pull-right" id="register-div">
		<h4>Create a Guest Account</h4>	
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'register-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
				'class'=>'well form-vertical',
			),
		)); ?>
			<?php echo $form->errorSummary($model, 
					$header='<button type="button" class="close" data-dismiss="alert">&times;</button><p>Please fix the following input errors:</p>', 
					'', array('class'=>'alert alert-error',)); ?>
			<fieldset>
				<legend><span class="label label-important">Required</span></legend>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64, 'placeholder'=>'Username', 'required'=>'required')); ?>
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64, 'placeholder'=>'Password', 'required'=>'required')); ?>
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>64, 'placeholder'=>'Cofirm Password', 'required'=>'required')); ?>
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-envelope"></i></span>
					<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'placeholder'=>'Email', 'required'=>'required')); ?>
				</div>
			</fieldset>
			<fieldset>
				<legend><span class="label label-info">Optional</span></legend>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-th-list"></i></span>
					<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128, 'placeholder'=>'Name')); ?>
				</div>
			</fieldset>
			<input class="btn btn-primary" type="submit" value="Create" />
			<input class="btn" id="yw1" type="reset" value="Reset" />
		<?php $this->endWidget(); ?>
	</div>
</div>


