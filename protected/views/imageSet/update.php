<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Image Set Home','url'=>array('index')),
	array('label'=>'Create Image Set','url'=>array('create')),
	array('label'=>'Manage Image Sets','url'=>array('admin')),
	array('label'=>'View This Image Set','url'=>array('view','id'=>$model->id)),
	);
	?>

	<h1>Update ImageSet <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'data_model'=>$data_model)); ?>