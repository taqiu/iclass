<?php
$this->breadcrumbs=array(
	'Image Datas'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ImageData','url'=>array('index')),
	array('label'=>'Create ImageData','url'=>array('create')),
	array('label'=>'View ImageData','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ImageData','url'=>array('admin')),
	);
	?>

	<h1>Update ImageData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>