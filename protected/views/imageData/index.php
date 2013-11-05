<?php
$this->breadcrumbs=array(
	'Image Datas',
);

$this->menu=array(
array('label'=>'Create ImageData','url'=>array('create')),
array('label'=>'Manage ImageData','url'=>array('admin')),
);
?>

<h1>Image Datas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
