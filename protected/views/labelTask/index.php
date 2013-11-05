<?php
$this->breadcrumbs=array(
	'Label Tasks',
);

$this->menu=array(
array('label'=>'Create LabelTask','url'=>array('create')),
array('label'=>'Manage LabelTask','url'=>array('admin')),
);
?>

<h1>Label Tasks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
