<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Image Set Home','url'=>array('index')),
array('label'=>'Create Image Set','url'=>array('create'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'Manage Image Sets','url'=>array('admin')),
);
?>

<h3>Create New Image Set</h3>
<hr/>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model), true, false); ?>
