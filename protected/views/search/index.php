<?php
$this->breadcrumbs=array(
	'Search'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('image-data-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="search-form" style="">
	<?php  $this->renderPartial('_search',array(
	'data_model'=>$data_model, 'labelNames'=>$labelNames
)); ?>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model), true, false); ?>