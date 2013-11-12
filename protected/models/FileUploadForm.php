<?php

class FileUploadForm extends CFormModel
{
    public $imageData;
	public $error;
	public $tot_records;
	public $added_records;
	public $added_tags;
	
    public function rules()
    {
        return array(
            array('imageData', 'file', 'types'=>'dump'),
        );
    }
}