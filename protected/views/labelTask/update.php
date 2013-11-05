<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List LabelTask','url'=>array('index')),
	array('label'=>'Create LabelTask','url'=>array('create')),
	array('label'=>'View LabelTask','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage LabelTask','url'=>array('admin')),
	);
	?>

	<h1>Update LabelTask <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>