<?php

class ImageDataController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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

	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
					'actions'=>array('index', 'view', 'admin', 'delete', 'upload', 'gallery'),
					'roles'=>array('labMember'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ImageData;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImageData']))
		{
			$model->attributes=$_POST['ImageData'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImageData']))
		{
			$model->attributes=$_POST['ImageData'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		
		$model = $this->loadModel($id);
		$params=array('label' => $model);
		if (Yii::app()->user->checkAccess('deleteImageData', $params))
		{
		
		
		
			foreach($model->devImageSets as $set){
				$set->size = $set->size - 1;
				$set->save();
			}
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
			throw new CHttpException(403,'You are not authorized to delete this Image.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ImageData('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ImageData']))
			$model->attributes=$_GET['ImageData'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	public function actionUpload()
    {
	
		if(isset($_POST['ajax']) && $_POST['ajax']==='uploadform')
		{
				echo CActiveForm::validate($model);
				Yii::app()->end();
		}
	
        $model=new FileUploadForm;
        if(isset($_POST['FileUploadForm']))
        {
            $model->attributes=$_POST['FileUploadForm'];
            $model->imageData=CUploadedFile::getInstance($model,'imageData');
            if($model->validate())
            {
				set_time_limit(86400);
				$handle = fopen($model->imageData->tempname,"r");
				if($handle){
					$model->tot_records = 0;
					$model->added_records = 0;
					$model->added_tags = 0;
					while(($line = fgets($handle)) != false){
										
						$line = preg_replace("/\p{Han}+/u", '', $line);

										
						$record = new ImageData;
						$row_data = explode(' ', $line);
						$temp = explode('@N',$row_data[0]);
						
						$record->flickr_user = implode(array($temp[0],$temp[1]));
						$record->flickr_photo_id = $row_data[1];
						$record->date_uploaded_flickr = $row_data[7];
						$record->latitude = float($row_data[9]);
						$record->longitude = float($row_data[10]);
						$record->precision = float($row_data[11]);
						
						$record->secret = $row_data[12];
						$record->server = $row_data[13];
						$record->farm = $row_data[14];
						
						$temp = explode('=',$row_data[17]);
						if(count($temp) > 1)
							$record->title = $temp[1];
						
						$temp = explode('=',$row_data[18]);
						if(count($temp) > 1)
							$record->license = $temp[1];
						
						$model->tot_records++;
						if($record->validate()){
							$record->save();
							$model->added_records++;
							$temp = explode(',',$row_data[20]);
							foreach ($temp as $tag){
								if($tag != ''){
									$t = new Tag;
									$t->image_id = $record->id;
									$t->tag_text = preg_replace('/[^A-Za-z0-9\-]/', '',$tag);
									$t->save();
									$model->added_tags++;
								}
							}
						}
					}
				}
				Yii::app()->user->setFlash('success', "<p>Record Upload Summary</p>
						<ul><li><b>$model->added_records</b> of <b>$model->tot_records</b> records added.</li>
						 <li><b>$model->added_tags</b> tags added.</li></ul>");
				$this->refresh();
            }
			else{
				$model->error="Invalid file type. Requires .dump files.";
			}
        }
        $this->render('upload', array('model'=>$model));
    }
	
    public function actionGallery() 
    {
    	$dataProvider=new CActiveDataProvider('ImageData');
		$this->layout = '//layouts/column1';
		$this->render('gallery',array(
			'dataProvider'=>$dataProvider,
		));
    }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ImageData the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ImageData::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
		

	/**
	 * Performs the AJAX validation.
	 * @param ImageData $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
