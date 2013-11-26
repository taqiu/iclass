<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Label Home', 'url'=>array('index')),
array('label'=>'Create Labels','url'=>array('create'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'Manage Labels','url'=>array('admin')),
);
?>

<h3>Create New Label</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,
                          'member'=>$member,'validatedMembers'=>$validatedMembers)); ?>
