<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index')),
array('label'=>'Create Label Task','url'=>array('create')),
array('label'=>'Manage Label Task','url'=>array('admin')),
);
?>

<h1>Create LabelTask</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'ImgSet'=>$ImgSet,'Label1'=>$Label1)); ?>