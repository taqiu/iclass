<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$model->name,
);

$this->menu=array(
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->uid)),
	array('label'=>'Update Profile', 'url'=>array('profile', 'id'=>$model->uid)),
	array('label'=>'Change Passwrod', 'url'=>array('password', 'id'=>$model->uid)),
);
?>

<h2>Profile</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'username',
		'password',
		'email',
		'name',
		'role',
		'create_time',
		'update_time',
		'last_login_time',
	),
)); ?>
