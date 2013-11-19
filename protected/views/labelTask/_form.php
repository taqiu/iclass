<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'label-task-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>64)); ?>

	<?php 
	       $ImgSetvals = array();
          foreach($ImgSet as $i){
//           array_push($ImgSetvals, implode(array($i->id," ", $i->name)));
		 // array_push($ImgSetvals, $i->id =>implode($i->id," ", $i->name));
		 $ImgSetvals[$i->id] = implode(array($i->id," ", $i->name));
		  }
  	
	         echo $form->dropDownListRow($model,'set_id',$ImgSetvals); 
			 
			 $Labelvals = array();
          foreach($Label1 as $i){
//           array_push($Labelvals, implode(array($i->id," ", $i->name)));
	//array_push($ImgSetvals, $i->id =>implode($i->id," ", $i->name));
	$Labelvals[$i->id] = implode(array($i->id," ", $i->name));
	}

	      echo $form->dropDownListRow($model,'label_id',$Labelvals); ?>

	
	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>16)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
<?php echo $ImgSet[0]->name; ?>