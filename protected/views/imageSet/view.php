<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Image Set Home','url'=>array('index')),
array('label'=>'Create Image Set','url'=>array('create')),
array('label'=>'Manage Image Sets','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
);
?>

<h3>View Image Set #<?php echo $model->id; ?></h3>
<div>
<input style='margin:0px 0px 0px 0px' Type="button" VALUE="Update" class="btn btn-primary" onClick="location.href='<?php echo Yii::app()->createURL('imageSet/update', array('id'=>$model->id));?>'"/>
<input style='margin:0px 15px 0px 15px' Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('imageSet/admin');?>'"/>
<?php echo CHtml::button('Delete', array('style'=>'margin:0px 0px 0px 0px', 'class'=>"btn btn-danger pull-right", 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
</div><br/>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'type'=>'striped bordered condensed',
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


