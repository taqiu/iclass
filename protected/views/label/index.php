<?php
$this->breadcrumbs=array(
	'Labels',
);

$this->menu=array(
array('label'=>'Label Home', 'url'=>array('index')),
array('label'=>'Create Labels','url'=>array('create')),
array('label'=>'Manage Labels','url'=>array('admin')),
);
?>

<h1>Labels</h1>
Labels define some semantic concept for which we want some human input. They are defined by a description and set of possible answers for the user to choose from.
One example might be the presence or absence of children in a photograph. In this module labels can be defined, modified, and viewed. These labels are used when
defining a label task for other users to participate in.
