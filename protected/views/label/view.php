<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	'Manage'=>Yii::app()->createUrl('label/admin'),
	$model->name,
);

$this->menu=array(
array('label'=>'Label Home','url'=>array('index')),
array('label'=>'Create Labels','url'=>array('create')),
array('label'=>'Manage Labels','url'=>array('admin'), 'itemOptions'=>array('class'=>'active')),
);
?>

<h3>View Label - <?php echo $model->name; ?></h3>

<?php echo $this->renderPartial('_view',array('model'=>$model, 'answers'=>$answers)); ?>

<hr/>
<input style='margin:0px 0px 0px 0px' Type="button" VALUE="Update" class="btn btn-primary" onClick="location.href='<?php echo Yii::app()->createURL('label/update', array('id'=>$model->id));?>'"/>
<input style='margin:0px 15px 0px 15px' Type="button" VALUE="Back" class="btn btn-success" onClick="location.href='<?php echo Yii::app()->createURL('label/admin');?>'"/>
<?php echo CHtml::button('Delete', array('style'=>'margin:0px 0px 0px 0px', 'class'=>"btn btn-danger pull-right", 'submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
		



