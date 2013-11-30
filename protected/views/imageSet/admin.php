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
<p><span class="label label-warning">Warning:</span> The set size might not be synchronized after deleting image data
<?php echo CHtml::link('Refresh image set size', array('refreshSize'),array('class'=>'btn btn-success pull-right')); ?>
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
		'description',
		'size',
		'create_time',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
