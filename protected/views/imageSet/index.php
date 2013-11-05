<?php
$this->breadcrumbs=array(
	'Image Sets',
);

$this->menu=array(
array('label'=>'Create ImageSet','url'=>array('create')),
array('label'=>'Manage ImageSet','url'=>array('admin')),
);
?>

<h1>Image Sets</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
