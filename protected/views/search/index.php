<?php
$this->breadcrumbs=array(
	'Search'
);
Yii::app()->clientScript->registerScript('search', "
$('.preview-button').click(function(){
	$('.preview-list').toggle();
	return false;
});		
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('image-data-grid', {
	data: $(this).serialize()
	});
	$.fn.yiiListView.update('preview-image-list', {
	data: $(this).serialize()
	});
	return false;
});
");
?>

<div  class="search-form" style="">
  <?php $this->renderPartial('_search',array(
  'data_model'=>$data_model, 'labelNames'=>$labelNames
)); ?> 
</div>
 
<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model), true, false); ?>

<div class='preview-list' style='display:none'>
<hr/>
<p>Result Preview </p>
<?php 
$this->widget('zii.widgets.CListView', array(
       'id' => 'preview-image-list',
       'htmlOptions' => array('class'=>'image-list'),
       'dataProvider' => $data_model->search(),
       'itemView' => '_view',
	   'itemsCssClass'=>'items',
       'template' => '{items} {pager}',
       'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.item', 
                    'listViewId' => 'VideoList', 
                    'header' => '',
                    'loaderText'=>'Loading...',
                    'options' => array('history' => false, 'triggerPageTreshold' => 100, 'trigger'=>'Load more'),
                  )
            )
       );
?>
</div>