<?php

class LabelTaskController extends Controller
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
				'actions'=>array('index','view', 'create', 'admin', 'delete','update'),
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
		$model = $this->loadModel($id);
		$owner = User::model()->findByPk($model->owner);
		$label = Label::model()->findByPk($model->label_id);
		$imageSet = ImageSet::model()->findByPk($model->set_id);
		$model->owner_name = $owner->name;
		$model->image_set_name = $imageSet->name;
		$model->label_name = $label->name;
		
		if(isset($_POST['LabelTask']))
		{
			$params=array('task' => $model);
			if (Yii::app()->user->checkAccess('updateTask', $params))
			{
				$model->attributes=$_POST['LabelTask'];
				if($model->save())
					Yii::app()->user->setFlash('success', "Label Task updated!");
			}
			else
			{
				throw new CHttpException(403,'You are not authorized to update this label task. (Only owner and admin can do this)');
			}
		}
		
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new LabelTask();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LabelTask']))
		{
			$model->attributes=$_POST['LabelTask'];
			if($model->save()) {
				Yii::app()->user->setFlash('success-create', "Label Task created!");
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		// Get all imagee set names
		$imageSets = ImageSet::model()->findAll();
		$imageSetNames = array();
		foreach($imageSets as $imageSet)
		{
			$imageSetNames[] = $imageSet->name;
		}
		
		// Get all label names
		$labels = Label::model()->findAll();
		$labelNames = array();
		foreach($labels as $label)
		{
			$labelNames[] = $label->name;
		}
		
		$this->render('create',array(
			'model'=>$model,'imageSetNames'=>$imageSetNames,'labelNames'=>$labelNames
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
		$params=array('task' => $model);
		if (Yii::app()->user->checkAccess('updateTask', $params))
		{
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
			throw new CHttpException(403,'You are not authorized to delete this label task.');
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
		$model=new LabelTask('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LabelTask']))
			$model->attributes=$_GET['LabelTask'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LabelTask the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LabelTask::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LabelTask $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='label-task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
