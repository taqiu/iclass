<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$model->username,
);

$this->menu=array(
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->uid), 'itemOptions'=>array('class'=>'active')),
	array('label'=>'Update Profile', 'url'=>array('profile', 'id'=>$model->uid)),
	array('label'=>'Change Passwrod', 'url'=>array('password', 'id'=>$model->uid)),
);
?>

<h3>Profile</h3>

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
