<?php
$this->breadcrumbs=array(
	'Unfinished Label Tasks',
);

$this->menu=array(
array('label'=>'Unfinished Tasks','url'=>array('index'), 'itemOptions'=>array('class'=>'active')),
array('label'=>'All Tasks','url'=>array('allTasks'), ),
);
?>
<style>
.progress {
margin-bottom: 0px;
background-image: linear-gradient(to bottom, rgb(200, 200, 200), rgb(210, 210, 210));
}
.table td {
vertical-align:middle;
}
</style>
<h3> Unfinished Tasks </h3>
<hr/>
<p> <span class="label label-info">Hint</span>  Click the buttom to start or continue a task. Only unfinished and active label tasks are listed.</p>
<?php 
function showProgress($progress, $size) {
	if ($progress===-1) {
		return '';
	} 
	$percent = 100*$progress/$size;
	if ($percent >= 100) {
		$percent = 90;
	}
	return '<div class="progress progress-striped">
				<div class="bar" style="width:'.$percent.'%"></div>
			</div>';
}
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'label-tasks',
	'summaryText' => '',
	'dataProvider'=>$model->getUnfinishTasks(Yii::app()->user->id),
	'type'=>'striped bordered condensed',
	'columns'=>array(
			array(
					'name'=>'ID',
					'value'=>'$data[\'id\']',
					'htmlOptions'=>array('width'=>'20px'),
			),
			array(
					'name'=>'Name',
					'value'=>'$data[\'name\']',
					'htmlOptions'=>array('width'=>'170px'),
			),
			array(
					'name'=>'Progress',
					'type' => 'raw',
					'value'=>'showProgress($data[\'progress\'], $data[\'size\'])',
					'htmlOptions'=>array('width'=>'230px'),
			),
			array(
					'name'=>'Create Time',
					'value'=>'$data[\'create_time\']',
					'htmlOptions'=>array('width'=>'90px'),
			),
			array(
					'name'=>'Size',
					'value'=>'$data[\'size\']',
			),
			array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=>'{start}{continue}',
					'buttons'=>array(
							'start' => array(
									'label'=>'Start',
									'options'=>array('class'=>'btn btn-primary'),
									'url'=>'Yii::app()->createUrl("participate/start", array("task_id"=>$data[\'id\']))',
									'visible'=>'$data[\'progress\']===-1'
							),
							'continue' => array(
									'label'=>'Continue',
									'options'=>array('class'=>'btn btn-success'),
									'url'=>'Yii::app()->createUrl("participate/start", array("task_id"=>$data[\'id\']))',
									'visible'=>'$data[\'progress\']!==-1'
							),
					),
					
			),
	),
)); ?>		
