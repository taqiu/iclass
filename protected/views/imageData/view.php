<?php
$this->breadcrumbs=array(
	'Image Datas'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List ImageData','url'=>array('index')),
array('label'=>'Create ImageData','url'=>array('create')),
array('label'=>'Update ImageData','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ImageData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ImageData','url'=>array('admin')),
);
?>

<h1>View ImageData #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'uploader',
		'flickr_user',
		'date_uploaded_flickr',
		'latitude',
		'longitude',
		'precision',
		'title',
		'license',
		'flickr_photo_id',
		'date_uploaded',
),
)); ?>
