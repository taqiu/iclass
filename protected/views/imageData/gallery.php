<?php
$this->breadcrumbs=array(
		'Image Data'=>array('index'),
		'Gallery',
);

$this->menu=array(
		//array('label'=>'Image Data Home', 'url'=>array('index')),
		//array('label'=>'Upload Image Data','url'=>array('upload')),
		//array('label'=>'Manage Image Data','url'=>array('admin'), 'itemOptions'=>array('class'=>'active'))
);
?>
<h5>Scroll down to view more images</h5>
<hr/>
<?php // id="links" $photo_url = implode(array('http://farm',$model->farm,'.staticflickr.com/',$model->server,'/',$model->flickr_photo_id,'_',$model->secret,'.jpg')) ?>
<?php 
$this->widget('zii.widgets.CListView', array(
       'id' => 'VideoList',
       'htmlOptions' => array('class'=>'image-list'),
       'dataProvider' => $dataProvider,
       'itemView' => '_view',
	   'itemsCssClass'=>'items',
       'template' => '{items} {pager}',
       'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.item', 
                    'listViewId' => 'VideoList', 
                    'header' => '',
                    'loaderText'=>'<img style="width:40px" src="img/loading.gif"/>',
                    'options' => array('history' => false, 'triggerPageTreshold' => 100, 'trigger'=>'Load more'),
                  )
            )
       );
?>
