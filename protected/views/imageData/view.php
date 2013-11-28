<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Image Data Home', 'url'=>array('index')),
	array('label'=>'Upload Image Data','url'=>array('upload')),
	array('label'=>'Manage Image Data','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
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

<h3>View Image #<?php echo $model->id; ?></h3>
<hr/>
<div class="left">
<?php $photo_url = implode(array('http://farm',$model->farm,'.staticflickr.com/',$model->server,'/',$model->flickr_photo_id,'_',$model->secret,'.jpg')) ?>
<a href= <?php echo $photo_url ?>> <img width="280" src=<?php echo $photo_url ?>></a>
</div>
<div class="right">
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered',
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
		array('label'=>'Tags','name'=>'tagSearch','value'=>function($data){
													$temp = array();
													foreach($data->tags as $t)
														$temp[] = $t->tag_text;
													$string = implode(", ", $temp);
													return $string;
													}),
),
)); ?>
</div>
<hr/>
<div>
<input Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('imageData/admin');?>'"/>
<?php echo CHtml::button('Delete', array('class'=>"btn btn-danger pull-right", 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
</div>