<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ImageSet','url'=>array('index')),
	array('label'=>'Create ImageSet','url'=>array('create')),
	array('label'=>'View ImageSet','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ImageSet','url'=>array('admin')),
	);
	?>

	<h1>Update ImageSet <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>