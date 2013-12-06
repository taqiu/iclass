<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Label Home', 'url'=>array('index')),
array('label'=>'Create Labels','url'=>array('create')),
array('label'=>'Manage Labels','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
);
?>

<h3>Manage Labels</h3>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'label-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'type'=>'striped bordered condensed',
'columns'=>array(
		array(
			'name'=>'id',
			'htmlOptions'=>array('width'=>'50px'),
		),
		array(
			'name'=>'owner',
			'htmlOptions'=>array('width'=>'80px'),
		),
		'name',
		array('name'=>'description',
			  'value'=>function($data){return (strlen($data->description) > 80) ? substr($data->description, 0, 80).'...' : $data->description;}),
		'create_time',
		array(
			'header'=>'Edit',
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
),
)); ?>
