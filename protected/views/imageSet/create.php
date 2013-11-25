<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Image Set Home','url'=>array('index')),
array('label'=>'Create Image Set','url'=>array('create')),
array('label'=>'Manage Image Sets','url'=>array('admin')),
);
?>

<h1>Create ImageSet</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model), true, false); ?>
