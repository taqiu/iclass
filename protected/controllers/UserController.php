<?php

class UserController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('view', 'profile', 'password'),
				'roles'=>array('guest'),
			),
			array('allow', 
				'actions'=>array('admin','delete', 'update'),
				'roles'=>array('manageUser'),
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
		$params=array('user' => $model);
		if (Yii::app()->user->checkAccess('viewSelfProfile', $params))
		{
			$this->render('view',array(
				'model'=>$model,
			));
		} 
		else 
		{
			throw new CHttpException(403,'You are not authorized to see this user profile.');
		}
	}
	
	/**
	 * Change Profile
	 * @param unknown $id
	 */
	public function actionProfile($id)
	{
		$model=$this->loadModel($id);
		$model->scenario = 'changeProfile';
		
		$params=array('user' => $model);
		if (Yii::app()->user->checkAccess('updateSelfProfile', $params))
		{
			if(isset($_POST['User']))
			{
				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);
				
				$model->attributes=$_POST['User'];
				// only update username, email and name
				if($model->save(true, array('username', 'email', 'name')))
					Yii::app()->user->setFlash('success', "Profile saved!");
					$this->refresh();
			}
			
			$this->render('profile',array(
					'model'=>$model,
			));
		}
		else
		{
			throw new CHttpException(403,'You are not authorized to update this user profile.');
		}
	}
	
	/**
	 * Change Password
	 * @param unknown $id
	 */
	public function actionPassword($id)
	{
		$model=$this->loadModel($id);
		$model->scenario = 'changePassword';
		
		$params=array('user' => $model);
		if (Yii::app()->user->checkAccess('updateSelfProfile', $params))
		{

			if(isset($_POST['User']))
			{
				$model->attributes=$_POST['User'];
				if($model->save()) {
					Yii::app()->user->setFlash('success', "Password changed!");
					$this->refresh();
				}
			}
	
			$this->render('password',array(
				'model'=>$model,
			));
		}
		else
		{
			throw new CHttpException(403,'You are not authorized to update this profile.');
		}		
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
		
		// set layout
		$this->layout = '//layouts/column1';
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				Yii::app()->user->setFlash('success', "Role changed!");
				$this->refresh();
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->layout = '//layouts/column1';
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->layout = '//layouts/column1';
		$this->render('admin',array(
			'model'=>$model, 
		));
		//$this->layout = '//layouts/column2';
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
