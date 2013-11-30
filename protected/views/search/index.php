<?php
$this->breadcrumbs=array(
	'Search','By Image Data'
);

$this->menu=array(
array('label'=>'Search by Image Data','url'=>array('index')),
array('label'=>'Search by Label','url'=>array('label')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model, 'data_model'=>$data_model), true, false); ?>