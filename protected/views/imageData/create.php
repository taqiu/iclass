<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Upload Image Data','url'=>array('upload')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);
?>

<h1>Create ImageData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>