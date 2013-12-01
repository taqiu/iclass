<?php

class ImageSetController extends Controller
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
				'actions'=>array('index','transfer', 'view', 'update', 'create', 'admin', 'delete', 'refreshSize'),
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

	public function actionTransfer(){
	
		$model = new ImageSet;
		$data_model = new ImageData('search');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImageSet']))
		{
			$model->attributes=$_POST['ImageSet'];
			$model->imageList=explode(',',$model->imageList);
		}
		
		$this->render('create',array(
			'model'=>$model, 'data_model'=>$data_model
		));
	
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ImageSet;
		$data_model = new ImageData('search');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
	
		
		if(isset($_GET['ImageData']))
			$data_model->attributes=$_GET['ImageData'];
			
		if(isset($_POST['ImageSet']))
		{
			$model->attributes=$_POST['ImageSet'];
			$model->imageList=explode(',',$model->imageList);
			$model->size = count($model->imageList);
			$model->owner = Yii::app()->user->getId();
			$model->create_time = date("Y-m-d");
			if($model->save()){
				$i = 0;
				foreach($model->imageList as $img_id){
					$temp = new ImageSetDetail;
					$temp->set_id = $model->id;
					$temp->image_id = $img_id;
					$temp->index_in_set = $i;
					
					if($temp->save())
						$i++;
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model, 'data_model'=>$data_model
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
		$data_model = new ImageData('search');
		
		foreach($model->devImageDatas as $t)
			$model->imageList[] = $t->id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['ImageData']))
			$data_model->attributes=$_GET['ImageData'];
			
		if(isset($_POST['ImageSet']))
		{
			$oldList = $model->imageList;
			$model->attributes=$_POST['ImageSet'];
			$model->imageList=explode(',',$model->imageList);
			
			$model->size = count($model->imageList);
			
			if($model->save()){
				$i = 0;
				
				
				$delList = array_diff($oldList, $model->imageList);
				$newList = array_diff($model->imageList, $oldList);
				
				$criteria = new CDbCriteria;
				$criteria->select = 'max(index_in_set)';
				$criteria->addColumnCondition(array('set_id' => $model->id));
				$temp = ImageSetDetail::model();
				$i = $temp->commandBuilder->createFindCommand($temp->tableName(), $criteria)->queryScalar();
				$i++;
				
				foreach($delList as $d){
					$temp = ImageSetDetail::model()->loadModel(array('set_id'=>$model->id,'image_id'=>$d));
					$temp->delete();
				}
				
				
				foreach($newList as $r){
					$temp = new ImageSetDetail;
					$temp->set_id = $model->id;
					$temp->image_id = $r;
					$temp->index_in_set = $i;
					$i++;
					
					$temp->save();
				}
				
				
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model, 'data_model'=>$data_model
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
		$params=array('set' => $model);
		if (Yii::app()->user->checkAccess('deleteImageSet', $params))
		{
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
			throw new CHttpException(403,'You are not authorized to delete this Image Set. (Only owner and admin can do this)');
		}
	}

	
	public function actionRefreshSize()
	{
		$model = New ImageSet();
		$model->refreshAllSize();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ImageSet');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ImageSet('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ImageSet']))
			$model->attributes=$_GET['ImageSet'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ImageSet the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ImageSet::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ImageSet $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-set-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
