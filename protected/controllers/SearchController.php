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
		$data_model->unsetAttributes();  // clear any default values
		$show_result = false;
		
		// Get all label names for search form
		$labels = Label::model()->findAll();
		$labelNames = array();
		foreach($labels as $label)
		{
			$labelNames[] = $label->name;
		}
		
		// Ajax update
		if(isset($_GET['ImageData'])) {
			$data_model->attributes=$_GET['ImageData'];
		}
		
		// Ajax select all button
		if (isset($_GET['all'])) {
			$model->imageList = $data_model->search($pagination=false)->getKeys();
			#if (sizeof($model->imageList) > 1000)
			#	throw new CHttpException('500', 'Too many image selected');
			echo json_encode($model->imageList);
			Yii::app()->end();
		}
		
		if(isset($_POST['all'])){
			$model->imageList = $data_model->search($pagination=false)->getKeys();
		}
		
		// Download button
		if(isset($_POST['down'])){
			$show_result = true;
			$model->attributes=$_POST['ImageSet'];
			$model->imageList=explode(',',$model->imageList);
			$temp = "Internal ID, Flickr Photo ID, URL\n";
			foreach($model->imageList as $i)
				$m = $data_model->findByPK($i);
				if($m)
					$temp = $temp.$m->asCSVString();
			
			Yii::app()->getRequest()->sendFile('records.txt',$temp);
		}
		
		if(isset($_POST['set']) || isset($_POST['sub'])){
			$model->attributes=$_POST['ImageSet'];
			$this->forward('imageSet/create');
		}
		
		$this->render('index',array(
			'model'=>$model,'data_model'=>$data_model, 'labelNames'=>$labelNames, 'show_result'=>$show_result,
		));	
	}
	
	public function actionLoadAns()
	{	
		if (!YII_DEBUG && !Yii::app()->request->isAjaxRequest) {
			throw new CHttpException('403', 'Forbidden access.');
		}
		
		if (empty($_GET['label_name'])) {
			throw new CHttpException('404', 'Missing "labelName" GET parameter.');
		}
		
		$label = Label::model()->find('name=:label_name',
				array(':label_name'=>$_GET['label_name']));
		if ($label !== null) {
			$answers = PossibleAnswer::model()->findAll('label_id=:labelId',
				array(':labelId'=>$label->id));
			//print_r($answers);	
			$data = CHtml::listData($answers,'id','answer');
			echo "<option value=''>Select Answer</option>";
			foreach($data as $value=>$answer)
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($answer),true);
			Yii::app()->end();
		} else {
			throw new CHttpException('404', 'Cannot find Label');
		}
	}
	
}