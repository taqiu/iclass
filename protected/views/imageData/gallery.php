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
//$this->renderPartial('bootstrap.views.gallery.preview');
?>
<style>
.items {
 	text-align: center;
}
.item {
	height:120px;
/* 	width: 130px;
   	min-height: 130px; 
    max-height: 130px;
    float: left;*/
    margin: 1px;
    padding: 1px;
    display:inline-block;
}
.item:hover {
}
.item img {
    width: auto;
    height: 120px;;
} 
.list-view {
    padding-top: 0px;
}
.clearboth { clear: both; }

.item a {
  position: relative;
}
.item a:hover:after {
  content: attr(help);
  color: #000;
  padding-left: 5px;
  position: absolute;
  display: block;
  width: 100%;
  height: auto;
  opacity:0.5;
  min-height: 30px;
  background: #FFF;
  bottom: 0px;
  left: 0px;
}
</style>	
<h5>Scroll down to view more images</h5>
<hr/>
<?php // id="links" $photo_url = implode(array('http://farm',$model->farm,'.staticflickr.com/',$model->server,'/',$model->flickr_photo_id,'_',$model->secret,'.jpg')) ?>
<?php 
$this->widget('zii.widgets.CListView', array(
       'id' => 'VideoList',
       'dataProvider' => $dataProvider,
       'itemView' => '_view',
	   //'htmlOptions' => array('class'=>''),
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
