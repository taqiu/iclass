<?php
$this->breadcrumbs=array(
	'Image Data'=>array('index'),
	'Upload'=>Yii::app()->createUrl('imageData/upload'),
	'Summary',
);

$this->menu=array(
array('label'=>'Image Data Home', 'url'=>array('index')),
array('label'=>'Upload Image Data','url'=>array('upload'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'Manage Image Data','url'=>array('admin'))
);
?>


<h3>Record Upload Summary</h3>
<hr/>
<font size=3>
<p style="text-indent: 5em"> <b><?php echo $model->added_records ?></b> of <b><?php echo $model->tot_records ?></b> records added.</p>
<p style="text-indent: 5em"><b><?php echo $model->added_tags ?></b> tags added. </p>
</font>
<hr/>
<input style='margin:0px 0px 0px 15px' Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('imageData/upload');?>'"/>