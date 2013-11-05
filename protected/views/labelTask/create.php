<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List LabelTask','url'=>array('index')),
array('label'=>'Manage LabelTask','url'=>array('admin')),
);
?>

<h1>Create LabelTask</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>