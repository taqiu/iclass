<?php

class SearchController extends Controller
{
	

	public $layout='//layouts/column1';

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
						'actions'=>array('index', 'loadAns'),
						'roles'=>array('labMember'),
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
		
		// Get all label names
		$labels = Label::model()->findAll();
		$labelNames = array();
		foreach($labels as $label)
		{
			$labelNames[] = $label->name;
		}
		
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
			$model->attributes=$_POST['ImageSet'];
			$this->redirect(array('imageSet/create', 'imageList'=>$model->imageList));
		}
		
		$this->render('index',array(
			'model'=>$model,'data_model'=>$data_model, 'labelNames'=>$labelNames
		));
		
	}
	
	public function actionLoadAns()
	{	
		if (!YII_DEBUG && !Yii::app()->request->isAjaxRequest) {
			throw new CHttpException('403', 'Forbidden access.');
		}
		
		if (empty($_GET['label_name'])) {
			throw new CHttpException('404', 'Missing "label_name" GET parameter.');
		}
		
		$label = Label::model()->find('name=:label_name',
				array(':label_name'=>(int) $_GET['label_name']));
		if (isset($label)) {
			$answers = PossibleAnswer::model()->find('lable_id=:lable_id',
				array('label_id'=>$lable->id));
			$data = CHtml::listData($answer,'id','answer');
			echo "<option value=''>Select Answer</option>";
			foreach($data as $value=>$answer)
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($answer),true);
		} else {
			
		}
		
		Yii::app()->end();
	}
	
}