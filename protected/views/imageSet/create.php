<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ImageSet','url'=>array('index')),
array('label'=>'Manage ImageSet','url'=>array('admin')),
);
?>

<h1>Create ImageSet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>