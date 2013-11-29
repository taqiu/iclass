<div class="item">
 
	<a help="Click to view detail" href="<?php echo Yii::app()->createURL('imageData/view', array('id'=>$data->id))?>"><img src="
    <?php echo 'http://farm'.$data->farm.'.staticflickr.com/'.$data->server.'/'.$data->flickr_photo_id.'_'.$data->secret,'.jpg';
    ?>" alt=""/></a>
    
<?php /*
		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uploader')); ?>:</b>
	<?php echo CHtml::encode($data->uploader); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flickr_user')); ?>:</b>
	<?php echo CHtml::encode($data->flickr_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_uploaded_flickr')); ?>:</b>
	<?php echo CHtml::encode($data->date_uploaded_flickr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
	<?php echo CHtml::encode($data->latitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
	<?php echo CHtml::encode($data->longitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precision')); ?>:</b>
	<?php echo CHtml::encode($data->precision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license')); ?>:</b>
	<?php echo CHtml::encode($data->license); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flickr_photo_id')); ?>:</b>
	<?php echo CHtml::encode($data->flickr_photo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_uploaded')); ?>:</b>
	<?php echo CHtml::encode($data->date_uploaded); ?>
	<br />
*/?>
</div>