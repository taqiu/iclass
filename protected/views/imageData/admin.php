<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Image Data Home', 'url'=>array('index')),
array('label'=>'Upload Image Data','url'=>array('upload')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('image-data-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Image Data</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'image-data-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
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
array(
'class'=>'bootstrap.widgets.TbButtonColumn', 'template'=>'{view}{delete}',
),
),
)); ?>
