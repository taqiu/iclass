<?php

class LabelController extends Controller
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
				'actions'=>array('index', 'view', 'update', 'create', 'admin', 'delete'),
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
	
		$criteria = new CDbCriteria();
		$criteria->compare('label_id', $id, true);
		$answers = PossibleAnswer::model()->findAll($criteria);
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),'answers'=>$answers,
		));
	}

	
	
	public function actionCreate()
	{
		Yii::import('ext.multimodelform.MultiModelForm');
	 
		$model = new Label;
	 
		$member = new PossibleAnswer;
		$validatedMembers = array();  //ensure an empty array
	 
		if(isset($_POST['Label']))
		{
			$model->attributes=$_POST['Label'];
			
			if( //validate detail before saving the master
				MultiModelForm::validate($member,$validatedMembers,$deleteItems) &&
				$model->save()
			   )
			   {
				 //the value for the foreign key 'groupid'
				 $masterValues = array ('label_id'=>$model->id);
				 if (MultiModelForm::save($member,$validatedMembers,$deleteMembers,$masterValues))
					$this->redirect(array('view','id'=>$model->id));
				}
		}
	 
		$this->render('create',array(
			'model'=>$model,
			//submit the member and validatedItems to the widget in the edit form
			'member'=>$member,
			'validatedMembers' => $validatedMembers,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		Yii::import('ext.multimodelform.MultiModelForm');
	 
		$model=$this->loadModel($id); //the Group model
	 
		$member = new PossibleAnswer;
		$validatedMembers = array(); //ensure an empty array
	 
		if(isset($_POST['Label']))
		{
			$params=array('label' => $model);
			if (Yii::app()->user->checkAccess('updateLabel', $params))
			{
				$model->attributes=$_POST['Label'];
				//the value for the foreign key 'groupid'
				$masterValues = array ('label_id'=>$model->id);
		 
				if( //Save the master model after saving valid members
					MultiModelForm::save($member,$validatedMembers,$deleteMembers,$masterValues) &&
					$model->save()
				   )
						$this->redirect(array('view','id'=>$model->id));
			}
			else
			{
				throw new CHttpException(403,'You are not authorized to update this label.');
			}
			
		}
	 
		$this->render('update',array(
			'model'=>$model,
			//submit the member and validatedItems to the widget in the edit form
			'member'=>$member,
			'validatedMembers' => $validatedMembers,
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
		$params=array('image' => $model);
		if (Yii::app()->user->checkAccess('deleteLabel', $params))
		{
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
			throw new CHttpException(403,'You are not authorized to delete this label.');
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
		$model=new Label('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Label']))
			$model->attributes=$_GET['Label'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Label the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Label::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Label $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='label-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
