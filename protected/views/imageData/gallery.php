<?php
$this->breadcrumbs=array(
		'Image Data'=>array('index'),
		'Gallery',
);

$this->menu=array(
		array('label'=>'Image Data Home', 'url'=>array('index')),
		array('label'=>'Upload Image Data','url'=>array('upload')),
		array('label'=>'Manage Image Data','url'=>array('admin'), 'itemOptions'=>array('class'=>'active'))
);
//$this->renderPartial('bootstrap.views.gallery.preview');
?>
<style>
ol.thumb-grid li {
	float: left;
	width: 15%;
	margin: 0 5% 5% 0;
	}
ol.thumb-grid li:nth-child(5n) {
	margin-right: 0;
	}
ol.thumb-grid li a img {
	width: 100%;
	}				
</style>

<h3>Gallery</h3>
<hr/>

<?php //  id="links" $photo_url = implode(array('http://farm',$model->farm,'.staticflickr.com/',$model->server,'/',$model->flickr_photo_id,'_',$model->secret,'.jpg')) ?>
<ol class="thumb-grid group">
	<li><a href="#"><img src="http://farm1.staticflickr.com/5/10000000_106b46b078.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm2.staticflickr.com/1036/1000000134_85ca7edfc6.jpg" /></a></li>
	<li><a href="#"><img src="http://farm2.staticflickr.com/1237/1000001320_71442845e7.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm1.staticflickr.com/33/100000172_0461732dc7.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm1.staticflickr.com/31/100000174_bdc79086d6.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm1.staticflickr.com/36/100000176_5ff6324dda.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm2.staticflickr.com/1069/1000002218_3ab21cd245.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm1.staticflickr.com/39/100000048_59ca4b28ed.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm1.staticflickr.com/39/100000048_59ca4b28ed.jpg" alt="thumbnail" /></a></li>
	<li><a href="#"><img src="http://farm1.staticflickr.com/39/100000048_59ca4b28ed.jpg" alt="thumbnail" /></a></li>
</ol>


