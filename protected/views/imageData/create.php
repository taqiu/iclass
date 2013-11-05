<?php
$this->breadcrumbs=array(
	'Image Datas'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ImageData','url'=>array('index')),
array('label'=>'Manage ImageData','url'=>array('admin')),
);
?>

<h1>Create ImageData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>