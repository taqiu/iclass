<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	'Manage'=>Yii::app()->createUrl('label/admin'),
	$model->name,
);

$this->menu=array(
array('label'=>'Label Home','url'=>array('index')),
array('label'=>'Create Labels','url'=>array('create')),
array('label'=>'Manage Labels','url'=>array('admin')),
array('label'=>'Update This Label','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete This Label','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Label: <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_view',array('model'=>$model, 'answers'=>$answers)); ?>



