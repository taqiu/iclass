<?php
$this->breadcrumbs=array(
	'Image Datas',
);

$this->menu=array(
array('label'=>'Upload Image Data','url'=>array('upload')),
array('label'=>'Manually Enter Image Data','url'=>array('create')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);
?>

<h1>Image Data</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
