<?php
class RbacCommand extends CConsoleCommand
{
	 
	private $_authManager;


	public function getHelp()
	{

		$description = "DESCRIPTION\n";
		$description .= '    '."This command generates an initial RBAC authorization hierarchy.\n";
		return parent::getHelp() . $description;
	}


	/**
	 * The default action - create the RBAC structure.
	 */
	public function actionIndex()
	{
			
		$this->ensureAuthManagerDefined();

		// provide the oportunity for the use to abort the request
		$message = "This command will create four roles: Guest, Labeler, Lab Member and Admin\n";
		$message .= " and the following permissions:\n";
		$message .= "Would you like to continue?";
	  
		// check the input from the user and continue if
		// they indicated yes to the above question
		if($this->confirm($message))
		{
			// first we need to remove all operations,
			// roles, child relationship and assignments
			$this->_authManager->clearAll();

			// create the lowest level operations for [users]
			$this->_authManager->createOperation(
					"manageUser",
					"mansge users in-formation");

			// view self profile
			$bizRule='return Yii::app()->user->id===$params["user"]->uid;';
			$task=$this->_authManager->createTask('viewSelfProfile','view the profile of user self',$bizRule);
			
			// update self profile
			$bizRule='return Yii::app()->user->id===$params["user"]->uid;';
			$task=$this->_authManager->createTask('updateSelfProfile','update the profile of user self',$bizRule);
			
			
			// create the lowest level operations for [image data]
			$this->_authManager->createOperation(
					"deleteImageData",
					"delete image matedata");
			$bizRule='return Yii::app()->user->id===$params["image"]->uploader;';
			$task=$this->_authManager->createTask('delOwnImageData','delete own image data',$bizRule);
			$task->addChild('deleteImageData');
			
			
			// create the lowest level operations for [label]
			$this->_authManager->createOperation(
					"deleteLabel",
					"delete label information");
			$this->_authManager->createOperation(
					"updateLabel",
					"update label information");
			$bizRule='return Yii::app()->user->id===$params["label"]->owner;';
			$task=$this->_authManager->createTask('updateOwnLabel','update own label',$bizRule);
			$task->addChild('updateLabel');
			$bizRule='return Yii::app()->user->id===$params["label"]->owner;';
			$task=$this->_authManager->createTask('deleteOwnLabel','delete own label',$bizRule);
			$task->addChild('deleteLabel');
			
			
			// create the lowest level operations for [image set]
			$this->_authManager->createOperation(
					"updateImageSet",
					"update a new issue");
			$this->_authManager->createOperation(
					"deleteImageSet",
					"delete image set");
			$bizRule='return Yii::app()->user->id===$params["set"]->owner;';
			$task=$this->_authManager->createTask('updateOwnImageSet','update own image set',$bizRule);
			$task->addChild('updateImageSet');
			$bizRule='return Yii::app()->user->id===$params["set"]->owner;';
			$task=$this->_authManager->createTask('deleteOwnImageSet','update own image set',$bizRule);
			$task->addChild('deleteImageSet');
			

			//create the lowest level operations for [label task]
			$this->_authManager->createOperation(
					"updateTask",
					"update label task");
			$this->_authManager->createOperation(
					"deleteTask",
					"delete label task");
			$bizRule='return Yii::app()->user->id===$params["task"]->owner;';
			$task=$this->_authManager->createTask('updateOwnTask','update own task',$bizRule);
			$task->addChild('updateTask');
			$bizRule='return Yii::app()->user->id===$params["task"]->owner;';
			$task=$this->_authManager->createTask('deleteOwnTask','update own task',$bizRule);
			$task->addChild('deleteTask');
			

			//create the guest role and add the appropriate
			//permissions as children to this role
			$bizRule='return !Yii::app()->user->isGuest;';
			$role=$this->_authManager->createRole("guest", "authenticated guest user", $bizRule);
			$role->addChild("viewSelfProfile");
			$role->addChild("updateSelfProfile");
			

			
			//create the labeler, and add the appropriate
			//permissions, as well as the guest role itself, as children
			$bizRule="return Yii::app()->user->getRole() === 'labeler'
						|| Yii::app()->user->getRole() === 'labMember'
						|| Yii::app()->user->getRole() === 'admin';";
			$role=$this->_authManager->createRole("labeler", "labeler user", $bizRule);
			$role->addChild("guest");
				

			
			//create the lab member role, and add the appropriate
			//permissions, as well as the labeler role itself, as children
			$bizRule="return Yii::app()->user->getRole() === 'labMember'
						|| Yii::app()->user->getRole() === 'admin';";
			$role=$this->_authManager->createRole("labMember", "lab member user", $bizRule);
			$role->addChild("labeler");
			$role->addChild("updateOwnTask");
			$role->addChild("deleteOwnTask");
			$role->addChild("updateOwnLabel");
			$role->addChild("deleteOwnLabel");
			$role->addChild("delOwnImageData");
			$role->addChild("updateOwnImageSet");
			$role->addChild("deleteOwnImageSet");
			
			
			//create the admin role, and add the appropriate
			//permissions, as well as the lab member role, as children
			$bizRule="return Yii::app()->user->getRole() === 'admin';";
			$role=$this->_authManager->createRole("admin", "admin user", $bizRule);
			$role->addChild("labMember");
			$role->addChild("manageUser");
			$role->addChild("updateTask");
			$role->addChild("deleteTask");
			$role->addChild("updateLabel");
			$role->addChild("deleteLabel");
			$role->addChild("deleteImageData");
			$role->addChild("updateImageSet");
			$role->addChild("deleteImageSet");
			
			//provide a message indicating success
			echo "Authorization hierarchy successfully generated.\n";
		}
		else
			echo "Operation cancelled.\n";
	}

	
	public function actionAdmin($username)
	{
		// provide the oportunity for the use to abort the request
		$message = "This command will assgin the admin permission to < $username >\n";
		$message .= "Would you like to continue?";
		
		if($this->confirm($message))
		{
			$user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
			if ($user === null) {
				echo "No such user < $username >\n";
			} 
			else 
			{
				$user->role = 'admin';
				$user->save();
				echo "Operation succeed\n";
			}
		} else
			echo "Operation cancelled.\n";
	}
	
	
	public function actionDelete()
	{
		$this->ensureAuthManagerDefined();
		$message = "This command will clear all RBAC definitions.\n";
		$message .= "Would you like to continue?";
		//check the input from the user and continue if they indicated
		//yes to the above question
		if($this->confirm($message))
		{
			$this->_authManager->clearAll();
			echo "Authorization hierarchy removed.\n";
		}
		else
			echo "Delete operation cancelled.\n";
			
	}

	protected function ensureAuthManagerDefined()
	{
		//ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
		if(($this->_authManager=Yii::app()->authManager)===null)
		{
			$message = "Error: an authorization manager, named 'authManager' must be con-figured to use this command.";
			$this->usageError($message);
		}
	}
}