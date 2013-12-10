<?php
$this->breadcrumbs=array(
	'Label Tasks',
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'Create Label Task','url'=>array('create')),
array('label'=>'Manage Label Task','url'=>array('admin')),
);
?>

<h3>Label Tasks</h3>
<hr/>
<p>Label tasks are the collaborative jobs that users participate in to respond to a label for an image set. Label tasks can be defined, managed, and updated in this module.
They are defined by specifying an image set and a label to set what question you would like answered by the community for some collection of images.</p>

<div style="margin-top:60px; text-align:center;">
<img alt="" style="width:350px" src="<?php echo Yii::app()->request->baseUrl;?>/img/task-example.png"/>
</div>
