
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
);?>
<?php echo $form->errorSummary($model,
		$header='<button type="button" class="close" data-dismiss="alert">&times;</button><p>Please fix the following input errors:</p>',
			'', array('class'=>'alert alert-error',)); ?>
		
<?php echo $form->fileField($model, 'imageData');?> 
<?php 
echo CHtml::ajaxSubmitButton (
   'Upload and Process', 
	'',
    array('data'=>'js:function(){$(#uploadform).serialize()}',
		  'context'=>'this',
	      'type' => 'post',),
	array('class'=>'btn btn-primary',
			'id'=>'sub', 'name'=>'t')
 );?>

<?php $this->endWidget(); ?>
</div> 

<script type="text/javascript">
$(document).ready(function() {
    $('#sub').on('click', function() {  Loading.show()});
});
</script>