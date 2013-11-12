<?php
$this->breadcrumbs=array(
	'Image Datas'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'Upload Image Data','url'=>array('upload')),
array('label'=>'Manually Enter Image Data','url'=>array('create')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);
?>
<style>
.left {
    float: left;
    width: 50%;
	margin-left:auto;
	margin-right:auto;
}

.right {
    margin-left: 50%;
}
</style>

<h1>View ImageData #<?php echo $model->id; ?></h1>
<div class=left>
<?php $photo_url = implode(array('http://farm',$model->farm,'.staticflickr.com/',$model->server,'/',$model->flickr_photo_id,'_',$model->secret,'.jpg')) ?>
<a href= <?php echo $photo_url ?>> <img width="240" src=<?php echo $photo_url ?>></a>
</div>
<div class=right>
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
</div>
