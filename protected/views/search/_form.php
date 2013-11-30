



<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'image-set-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php $form->widget('ext.selgridview.BootSelGridView',array(
'id'=>'image-data-grid',
'dataProvider'=>$data_model->search(),
'selectableRows'=>2,
#'selectionChanged'=>'js:postChecked',
'filter'=>$data_model,
'columns'=>array(
		array(
          'id' => 'checkedImages',
		  'class' => 'CCheckBoxColumn',
        ),
		'id',
		'uploader',
		'flickr_user',
		'date_uploaded_flickr',
		'latitude',
		'longitude',
		array('header'=>'Tags','name'=>'tagSearch','value'=>function($data){
													$temp = array();
													foreach($data->tags as $t)
														$temp[] = $t->tag_text;
													$string = implode(',', $temp);
													return (strlen($string) > 20) ? substr($string, 0, 20).'...' : $string;
													}),
),
)); ?>


<?php echo $form->hiddenField($model,'imageList',array('value'=>''));?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'sub',
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScript('fill','$("#image-data-grid").selGridView("addSelection", '.json_encode($model->imageList).');');?>
<?php Yii::app()->clientScript->registerScript('postChecked', 'function postChecked(){
		var arraySel = $("#image-data-grid").selGridView("getAllSelection");
 
        var stringSel=arraySel.join(",");                                                                          
        $("#ImageSet_imageList").val(stringSel);}');?>
<?php Yii::app()->clientScript->registerScript('init','$(document).ready(function(){ $("#sub").on("click", postChecked);});'); ?>
