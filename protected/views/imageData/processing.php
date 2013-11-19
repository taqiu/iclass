<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	'Upload'=>Yii::app()->createUrl('imageData/upload'),
	'Summary',
);

$this->menu=array(
array('label'=>'Upload Image Data','url'=>array('upload')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);
?>


<h1>Record Upload Summary</h1>
<font size=3>
<p style="text-indent: 5em"><?php echo $model->added_records ?> of <?php echo $model->tot_records ?> records added.</p>
<p style="text-indent: 5em"><?php echo $model->added_tags ?> tags added. </p>
</font>