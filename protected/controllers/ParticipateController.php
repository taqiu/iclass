<?php

class ParticipateController extends Controller
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
						'actions'=>array('index', 'allTasks', 'start'),
						'roles'=>array('labeler'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$model=new LabelTask('search');
		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	public function actionAllTasks()
	{
		$model=new LabelTask('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LabelTask']))
			$model->attributes=$_GET['LabelTask'];

		$this->render('allTasks',array(
			'model'=>$model,
		));
	}
	
	public function actionStart($task_id)
	{
		// find task first
		$task = LabelTask::model()->findByPk((int) $task_id);
		if ($task === null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		
		// check partipate record
		$user_id = Yii::app()->user->id;
		$partipate = Participate::model()->findByPk(array('user_id' => $user_id, 'task_id' => $task_id));
		if ($partipate === null) {
			$partipate = new Participate();
			$partipate->user_id = $user_id;
			$partipate->task_id = $task_id;
			$partipate->is_done = 0;
			$partipate->count_labeled = 0;
			$partipate->save();
		}	
		

		


		// process user selection
		if (isset($_POST['answer'])) {
			$image_id = (int) $_POST['imageId'];
			$index_in_set =  (int)$_POST['indexInSet'];
			$answer =  (int) $_POST['answer'];
			
			// check Duplicate entry in databse
			$labelResponse = LabelResponse::model()->findByPk(array('image_id'=>$image_id, 'label_id'=>$task->label_id, 'user_id'=>$user_id));
			if ($labelResponse == null)
				$labelResponse = new LabelResponse();
			
			// new response will overide old response
			$labelResponse->image_id = $image_id;
			$labelResponse->label_id = $task->label_id;
			$labelResponse->user_id = $user_id;
			$labelResponse->answer_id = $answer;
			if ($labelResponse->save()) {
				// update partipate record if label response is saved
				$partipate->count_labeled = $partipate->count_labeled + 1;
				$partipate->save();
				
				// Upate Majority table
				LabelMajority::updateByImage($task->label_id, $image_id);
			} 
		}
		
		// Get all images in set and get next image
		$criteria = new CDbCriteria;
		$criteria->condition = 'set_id=:setID AND image_id NOT IN (SELECT image_id FROM dev_label_response WHERE user_id=:userID AND label_id=:labID)';
		$criteria->order = 'rand()';
		$criteria->params = array(':setID'=>$task->set_id, ':userID'=>$user_id, ':labID'=>$task->label_id);
		$criteria->limit = 1;

		$imageSetDetail = ImageSetDetail::model()->find($criteria);
		
		if ($imageSetDetail === null or ($task->label_set_size > 0 && $partipate->count_labeled > $task->label_set_size)) {
			$partipate->is_done = 1;
			if(!$partipate->save()) {die(print_r($partipate->errors));}
			$this->render('done');
		} else {
			$image_id = $imageSetDetail->image_id;
			$image = ImageData::model()->findByPk($image_id);
			$label = Label::model()->findByPk($task->label_id);
			$answers = PossibleAnswer::model()->findAllByAttributes(array('label_id' => $task->label_id));
			
			$this->render('start', array(
				'task' => $task,
				'image' => $image,
				'label' => $label,
				'index_in_set' => $partipate->count_labeled,
				'answers' => $answers,
			));
		}
	}
}
