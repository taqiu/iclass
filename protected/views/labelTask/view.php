<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index')),
array('label'=>'Create Label Task','url'=>array('create')),
array('label'=>'Manage Label Task','url'=>array('admin')),
array('label'=>'Update This Label Task','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete This Label Task','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
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
