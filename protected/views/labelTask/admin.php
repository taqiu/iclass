<?php
$this->breadcrumbs=array(
	'Label Tasks'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Label Task Home','url'=>array('index')),
array('label'=>'Create Label Task','url'=>array('create')),
array('label'=>'Manage Label Task','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
);

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('label-task-grid', {
data: $(this).serialize()
});
return false;
});
");
*/
?>

<h3>Manage Label Tasks</h3>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /* 
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
*/?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'label-task-grid',
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
		array(
			'name'=>'status',
			'filter'=> LabelTask::model()->getStatusOptions(),
		),
		array(
			'header'=>'Edit',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{delete}',
		),
),
)); ?>
