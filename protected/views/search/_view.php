<div class="item">
	<a help="Click to view detail" href="<?php echo Yii::app()->createURL('imageData/view', array('id'=>$data->id))?>"><img src="
    <?php echo 'http://farm'.$data->farm.'.staticflickr.com/'.$data->server.'/'.$data->flickr_photo_id.'_'.$data->secret,'.jpg';
    ?>" alt=""/></a>
</div>