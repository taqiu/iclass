<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Label Home', 'url'=>array('index')),
array('label'=>'Create Labels','url'=>array('create')),
array('label'=>'Manage Labels','url'=>array('admin')),
);
?>

<h1>Create Label</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
                          'member'=>$member,'validatedMembers'=>$validatedMembers)); ?>
