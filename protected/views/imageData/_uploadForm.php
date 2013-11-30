<div id="document">	
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
<input type="file" name="FileUploadForm[imageData]" style="visibility:hidden;" id="pdffile" /><br/>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo Yii::app()->user->getFlash('success');?>
	</div>
<?php endif; ?>
<?php echo $form->errorSummary($model,
		$header='<button type="button" class="close" data-dismiss="alert">&times;</button><p>Please fix the following input errors:</p>',
			'', array('class'=>'alert alert-error',)); ?>
		

<?php //echo $form->fileField($model, 'imageData');?>
<div class="input-append">
<input type="text" name="FileUploadForm[imageData]" id="subfile" class="input-xlarge">
<a class="btn" onclick="$('#pdffile').click();">Browse</a>
</div>
<hr/>

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

$('#pdffile').change(function(){
	$('#subfile').val($(this).val());
	}); 
</script>