<?php
$this->breadcrumbs=array(
	'Image Sets',
);

$this->menu=array(
array('label'=>'Image Set Home','url'=>array('index'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'Create Image Set','url'=>array('create')),
array('label'=>'Manage Image Sets','url'=>array('admin')),
);
?>

<h3>Image Sets</h3>
<hr/>
<p>Image sets define collections of images that have been defined by the user. These sets are useful as they may be used to run labelling tasks
or to define subsets of the image database that are relevant to an experiment. They can be created, managed, and downloaded in this module.</p>
<div style="margin-top:60px; text-align:center;">
<img alt="" style="width:400px" src="<?php echo Yii::app()->request->baseUrl;?>/img/image-set.png"/>
</div>
