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
		$user_id = Yii::app()->user->id;
		$partipate = Participate::model()->findByPk(array('user_id' => $user_id, 'task_id' => $task_id));
		if ($partipate === null) {
			$partipate = new Participate();
			$partipate->user_id = $user_id;
			$partipate->task_id = $task_id;
			$partipate->last_image_labeled = -1;
			$partipate->is_done = 0;
			$partipate->save();
		}
		
		// read task
		$task = LabelTask::model()->findByPk($task_id);
		
		// process user selection
		if (isset($_POST['answer'])) {
			$image_id = $_POST['imageId'];
			$index_in_set = $_POST['indexInSet'];
			$answer = $_POST['answer'];
			// die($answer.'|'.$image_id.'|'.$index_in_set);
			// check Duplicate entry in databse
			$labelResponse = LabelResponse::model()->findByPk(array('image_id'=>$image_id, 'label_id'=>$task->label_id, 'user_id'=>$user_id));
			if ($labelResponse == null) {
				$labelResponse = new LabelResponse();
				$labelResponse->image_id = $image_id;
				$labelResponse->label_id = $task->label_id;
				$labelResponse->user_id = $user_id;
				$labelResponse->answer_id = $answer;
				if ($labelResponse->save()) {
					$partipate->last_image_labeled = $index_in_set;
					$partipate->save();
				} else {
					die(print_r($labelResponse->errors));
				}
			} else {
				$partipate->last_image_labeled = $index_in_set;
				$partipate->save();
			}
		}
		
		// Get all images in set and get next image
		$imageSetDtails = ImageSetDetail::model()->findAllByAttributes(array('set_id'=>$task->set_id), array('order'=>'index_in_set'));
		// die(print_r($imageSetDtails));
		$image_id = -1;
		foreach ($imageSetDtails as $imageSetDetail ) {
			$cursor = $imageSetDetail->index_in_set;
			if ($cursor > $partipate->last_image_labeled) {
				$image_id = $imageSetDetail->image_id;
				break;
			} 
		}
		
		if ($image_id < 0) {
			$partipate->is_done = 1;
			if(!$partipate->save()) { die(print_r($partipate->errors));}
			$this->render('done');
		} else {
			$image = ImageData::model()->findByPk($image_id);
			$label = Label::model()->findByPk($task->label_id);
			$answers = PossibleAnswer::model()->findAllByAttributes(array('label_id' => $task->label_id));
			
			$this->render('start', array(
				'task' => $task,
				'image' => $image,
				'label' => $label,
				'index_in_set' => $cursor,
				'answers' => $answers,
			));
		}
	}
}