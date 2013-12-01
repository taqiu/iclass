<div class="view">

	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,//array('model'=>$model,'answers'=>$answers),
	'type'=>'striped bordered condensed',
	'attributes'=>array(
			'id',
			'owner',
			'name',
			'description',
			'create_time',
			'last_search_time',
	),
	)); ?>
	<?php $gridDataProvider = new CArrayDataProvider($answers); ?>
	<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'type'=>'striped bordered condensed',
	'dataProvider'=>$gridDataProvider,
	'template'=>"{items}",
	'columns'=>array(
		array('name'=>'id', 'header'=>'#'),
		array('name'=>'answer','header'=>'Possible Answer'))
	)); ?>
</div>