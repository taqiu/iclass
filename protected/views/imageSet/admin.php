<?php
$this->breadcrumbs=array(
	'Image Sets'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Image Set Home','url'=>array('index')),
array('label'=>'Create Image Set','url'=>array('create')),
array('label'=>'Manage Image Sets','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
);
?>

<h3>Manage Image Sets</h3>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
 
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'image-set-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'type'=>'striped bordered condensed',
'columns'=>array(
		'id',
		'owner',
		'name',
		array('header'=>'Description','name'=>'description','value'=>function($data){
													return (strlen($data->description) > 50) ? substr($data->description, 0, 50).'...' : $data->description;
													}),
		'size',
		'create_time',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
