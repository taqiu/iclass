<?php

class SearchController extends Controller
{
	

	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',
						'actions'=>array('index', 'label', ),
						'roles'=>array('labeler'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$model = new ImageSet('search');
		$data_model=new ImageData('search');
		
		if(isset($_GET['ImageData']))
			$data_model->attributes=$_GET['ImageData'];
		
		$this->render('index',array(
			'model'=>$model,'data_model'=>$data_model
		));
	}
	
	public function actionLabel()
	{
		$model=new ImageData('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LabelTask']))
			$model->attributes=$_GET['LabelTask'];

		$this->render('label',array(
			'model'=>$model,
		));
	}
	
	
}