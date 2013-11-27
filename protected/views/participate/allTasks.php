<?php
$this->breadcrumbs=array(
	'All Tasks',
);

$this->menu=array(
array('label'=>'Unfinished Tasks','url'=>array('index')),
array('label'=>'All Tasks','url'=>array('allTasks'), 'itemOptions'=>array('class'=>'active') ),
);
?>
<h3> All Tasks </h3>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'label-tasks',
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
			'create_time',
			'status',
			//array(
					//'class'=>'bootstrap.widgets.TbButtonColumn',
					//'template'=>'{view}{delete}',
					//'class'=>'CButtonColumn',
					//'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data["uid"]))',
					//'updateButtonOptions'=>array('class'=>'btn', 'title'=>'edit'),
			//),
	),
)); ?>		