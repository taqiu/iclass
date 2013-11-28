<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Image Set Home','url'=>array('index')),
	array('label'=>'Create Image Set','url'=>array('create')),
	array('label'=>'Manage Image Sets','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
	);
	?>

	<h3>Update Image Set #<?php echo $model->id; ?></h3>
<hr/>
<?php echo $this->renderPartial('_form',array('model'=>$model, 'data_model'=>$data_model)); ?>