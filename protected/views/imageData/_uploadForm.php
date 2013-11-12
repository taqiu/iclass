<div id="document" class="form-actions">
<?php
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'uploadform',
		'action' => array('upload'),
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
echo $form->fileField($model, 'imageData');?> 
<?php 
echo CHtml::ajaxSubmitButton (
   'Upload and Processes', 
	'',
    array('data'=>'js:function(){$(#uploadform).serialize()}',
		  'context'=>'this',
	      'type' => 'post',),
	array('id'=>'sub', 'name'=>'t')
 );?>
<p><font color=red><?php echo $model->error;?> </font></p>
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
$(document).ready(function() {
    $('#sub').on('click', function() {  Loading.show()});
});
</script>