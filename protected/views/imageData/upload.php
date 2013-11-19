<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	'Upload',
);

$this->menu=array(
array('label'=>'Image Data Home', 'url'=>array('index')),
array('label'=>'Upload Image Data','url'=>array('upload')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);
?>
<?php $this->widget('ext.widgets.loading.LoadingWidget');?>
<h1>Upload Crawler Dump File</h1>
Uploading and parsing the file may take a long period of time. Please be patient.
<?php
if(get_class($model) == "FileUploadForm")
	echo $this->renderPartial('_uploadForm', array('model'=>$model),false,true); 
else
	echo $this->renderPartial('_uploadForm', array('model'=>new FileUploadForm),false,true); 
?>