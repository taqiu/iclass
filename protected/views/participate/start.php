<?php
$this->breadcrumbs=array(
		'Unfinished Label Tasks'=>array('index'),
		$task->name,
);

$this->menu=array(
		array('label'=>'Unfinished Tasks','url'=>array('index'), 'itemOptions'=>array('class'=>'active')),
		array('label'=>'All Tasks','url'=>array('allTasks'), ),
);
?>

<style>
.left {
    float: left;
    width: 50%;
	margin-left:5px;
	margin-right:auto;
}

.right {
    margin-left: 55%;
}

.ans-div {
	/*display:block;*/
	margin-top:10px;
	font-style:italic
}

.ans-div label {
	padding: 10px;
}

.ans-div label:hover {
	background-color: #f7f7f7;
}

.ans-div label span{
    padding-left:20px;
}

</style>

<script type='text/javascript'>

 $(document).ready(function() { 
   $('input[name=answer]').change(function(){
        $('form').submit();
   });
  });

</script>

<span class="pull-right"> Set ID: <?php echo $task->set_id; ?> | Index of Set: <?php echo  $index_in_set; ?></span>
<h4>Current Task: <?php echo $task->name;?></h4>
<hr/>
<div class="left">
<form action=<?php echo $this->createUrl('participate/start', array('task_id'=>$task->id));?> method="post">
	<input type="hidden" name="imageId" value="<?php echo $image->id;?>">
	<input type="hidden" name="indexInSet" value="<?php echo $index_in_set;?>">
	<p><?php echo $label->description;?> </p>
	<?php 
		foreach ($answers as $answer) {
			echo '<div class="ans-div">';
			echo '<label><input type="radio" name="answer" value="'.$answer->id.'"><span>'.$answer->answer.'</span></label>';
			echo '</div>';
		}
	?>
</form>
</div>
<div class="right">
<?php $photo_url = implode(array('http://farm',$image->farm,'.staticflickr.com/',$image->server,'/',$image->flickr_photo_id,'_',$image->secret,'.jpg')) ?>
<a href= <?php echo $photo_url ?>> <img width="300" src=<?php echo $photo_url ?>></a>
</div>