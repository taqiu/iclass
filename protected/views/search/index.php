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

<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model,'labelNames'=>$labelNames), true, false); ?>