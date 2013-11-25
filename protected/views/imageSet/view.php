<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Image Set Home','url'=>array('index')),
array('label'=>'Create Image Set','url'=>array('create')),
array('label'=>'Manage Image Sets','url'=>array('admin')),
array('label'=>'Update This Image Set','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete This Image Set','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View ImageSet #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'owner',
		'name',
		'description',
		'size',
		'create_time',
),
)); ?>




<?php 

$this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'image-data-grid',
'dataProvider'=>new CActiveDataProvider('ImageData', array('data'=>$model->devImageDatas)),
'columns'=>array(
		'id',
		'uploader',
		'flickr_user',
		'date_uploaded_flickr',
		'latitude',
		'longitude',
		array('header'=>'Tags','name'=>'tagSearch','value'=>function($data){
													$temp = array();
													foreach($data->tags as $t)
														$temp[] = $t->tag_text;
													$string = implode(',', $temp);
													return (strlen($string) > 20) ? substr($string, 0, 20).'...' : $string;
													}),
),
)); ?>


