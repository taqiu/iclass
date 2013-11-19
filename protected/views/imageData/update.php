<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
	
	$this->menu=array(
	array('label'=>'Image Data Home', 'url'=>array('index')),
	array('label'=>'Upload Image Data','url'=>array('upload')),
	array('label'=>'Manage Image Data','url'=>array('admin')),
	array('label'=>'View ImageData','url'=>array('view','id'=>$model->id)),
	);
	?>

	<h1>Update ImageData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>