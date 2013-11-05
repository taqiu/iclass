<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List LabelTask','url'=>array('index')),
array('label'=>'Create LabelTask','url'=>array('create')),
array('label'=>'Update LabelTask','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete LabelTask','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage LabelTask','url'=>array('admin')),
);
?>

<h1>View LabelTask #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'owner',
		'name',
		'set_id',
		'label_id',
		'create_time',
		'status',
),
)); ?>
