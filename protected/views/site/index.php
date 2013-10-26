<?php $this->pageTitle=Yii::app()->name; ?>

<div id='logo'>
       <a href="http://vision.soic.indiana.edu/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/default-logo.png" width="960" height="129" /></a>
</div><!-- end of #logo -->

<div class="row">
	<div class="span8">
		<h2>Getting started</h2>
		<hr/>
		<h4>I. About ICLASS</h4>
		<p>Nam vitae luctus ante. Pellentesque nec urna in urna elementum gravida. Donec tempus erat a ultricies placerat. Cras malesuada ac nunc vitae rutrum. Quisque metus nunc, vulputate vitae enim quis, tincidunt sollicitudin turpis. Donec feugiat diam nec orci varius sagittis. Praesent ac dignissim turpis, id luctus turpis. Integer ultrices quam in urna tempus consectetur. Aenean fermentum dui sed sem lacinia, in facilisis mi commodo. Donec facilisis neque sit amet erat ultricies interdum. Ut placerat sagittis erat. Vestibulum vitae est suscipit, fermentum nisi et, facilisis libero. Mauris non urna et augue ultrices scelerisque sit amet nec nulla. Fusce eget mauris sem. Donec quis tellus erat. Pellentesque quis sapien blandit, pulvinar felis eget, viverra turpis.</p>
		<h4>II. How to use</h4>
		<div style="text-align:center; margin:30px">
			<img alt="workflow" src="<?php echo Yii::app()->request->baseUrl; ?>/img/workflow.png" width="420"  />
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec augue accumsan, accumsan metus id, viverra urna. Vivamus imperdiet lobortis erat. Nulla eget velit ac erat pretium sagittis in eu nibh. Sed ipsum est, molestie vel justo et, porta tempus tortor. Aenean nec fringilla neque. Nulla venenatis, velit non sagittis venenatis, turpis neque placerat ligula, a rhoncus ligula elit sit amet sem.</p>
		<p>Cras vestibulum ac mi ut pharetra. Integer magna dolor, rhoncus a euismod varius, faucibus vel metus. Phasellus purus mi, pharetra ut cursus auctor, blandit suscipit mi. Sed vitae placerat libero. Duis ac lacinia dolor, vel facilisis augue. Curabitur in sollicitudin metus. Vivamus non elit varius, semper urna molestie, euismod ligula.</p>
<?php /*		
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
*/ ?>
		
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

<?php /*

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