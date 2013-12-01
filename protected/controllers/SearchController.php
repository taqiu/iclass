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
		$model = new ImageSet;
		$data_model=new ImageData('search');
		
		if(isset($_GET['ImageData']))
			$data_model->attributes=$_GET['ImageData'];
		
		if(isset($_POST['all'])){
			$data_model->attributes=$_POST['ImageData'];
			$model->imageList = $data_model->searchNoPage()->getKeys();
		}
		
		if(isset($_POST['down'])){
			$model->attributes=$_POST['ImageSet'];
			$model->imageList=explode(',',$model->imageList);
			$temp = "Internal ID, Flickr Photo ID, URL\n";
			foreach($model->imageList as $i)
				$temp = $temp.$data_model->findByPK($i)->asCSVString();
			
			Yii::app()->getRequest()->sendFile('records.txt',$temp);
		}
		
		if(isset($_POST['set'])){
			#$model->attributes=$_POST['ImageSet'];
			#$model->imageList=explode(',',$model->imageList);
			$this->forward('imageSet/transfer');
		}
		
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