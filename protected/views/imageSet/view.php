<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List ImageSet','url'=>array('index')),
array('label'=>'Create ImageSet','url'=>array('create')),
array('label'=>'Update ImageSet','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ImageSet','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ImageSet','url'=>array('admin')),
);
?>

<h1>View ImageSet #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'owner',
		'name',
		'description',
		'size',
		'create_time',
),
)); ?>
