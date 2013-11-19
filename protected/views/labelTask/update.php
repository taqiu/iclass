<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Label Task Home','url'=>array('index')),
	array('label'=>'Create Label Task','url'=>array('create')),
	array('label'=>'Manage Label Task','url'=>array('admin')),
	array('label'=>'View This Label Task','url'=>array('view','id'=>$model->id)),
	);
	?>

	<h1>Update LabelTask <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'ImgSet'=>$ImgSet,'Label1'=>$Label1)); ?>