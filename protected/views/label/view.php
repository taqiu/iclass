<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Label','url'=>array('index')),
array('label'=>'Create Label','url'=>array('create')),
array('label'=>'Update Label','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Label','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Label','url'=>array('admin')),
);
?>

<h1>View Label #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'owner',
		'name',
		'description',
		'create_time',
),
)); ?>
