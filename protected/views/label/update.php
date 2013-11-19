<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Label Home','url'=>array('index')),
	array('label'=>'Create Labels','url'=>array('create')),
	array('label'=>'Manage Labels','url'=>array('admin')),
	);
	?>

	<h1>Update Label <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
                          'member'=>$member,'validatedMembers'=>$validatedMembers)); ?>