<?php $this->pageTitle=Yii::app()->name; ?>

<div id='logo'>
       <a href="http://vision.soic.indiana.edu/"><img src="http://vision.soic.indiana.edu/wp/wp-content/themes/responsive/core/images/default-logo.png" width="960" height="129" /></a>
</div><!-- end of #logo -->

<div class="row">
	<div class="span8">
		<h2>Getting started - <?php echo CHtml::encode(Yii::app()->name); ?></h2>
		
		<?php Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You have successfully created your Yii application.');?>
		<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
		
		<p>You may change the content of this page by modifying the following two files:</p>
		<ul>
			<li>View file: <tt><?php echo __FILE__; ?></tt></li>
			<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
		</ul>
		
		<p>For more details on how to further develop this application, please read
		the <a href="http://www.yiiframework.com/doc/">documentation</a>.
		Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
		should you have any questions.</p>
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
			<input class="btn" id="yw1" type="reset" value="Rest" />
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php
/*
$gridDataProvider = new CArrayDataProvider(array(
	array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS'),
	array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript'),
	array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML'),
));

?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'dataProvider'=>$gridDataProvider,
	'template'=>"{items}",
	'columns'=>array(
		array('name'=>'id', 'header'=>'#'),
		array('name'=>'firstName', 'header'=>'First name'),
		array('name'=>'lastName', 'header'=>'Last name'),
		array('name'=>'language', 'header'=>'Language'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",array("id"=>$data["id"]))',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data["id"]))',
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data["id"]))',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); */?>