<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Manage Users',
);

$this->menu=array();
?>

<h3>Manage Users</h3>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.<br/>
<span class="label label-info">Hint:</span>  click the right side button to edit user information
</p>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'uid',
			'htmlOptions'=>array('width'=>'50px'),
		),
		'username',
		'email',
		'name',
		array(
			'name'=>'role',
			'filter'=>User::model()->getRoleOptions(),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header'=>'Edit',
			'template'=>'{update}',
			//'class'=>'CButtonColumn',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data["uid"]))',
			'updateButtonOptions'=>array('class'=>'btn', 'title'=>'edit'),
		),
	),
)); ?>
