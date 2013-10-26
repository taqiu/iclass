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
		$message .= "(.........)\n";
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
			$this->_authManager->createOperation(
					"changeRole",
					"change the role of a user");

			// view self profile
			$bizRule='return Yii::app()->user->id===$params["user"]->uid;';
			$task=$this->_authManager->createTask('viewSelfProfile','view the profile of user self',$bizRule);
			
			// update self profile
			$bizRule='return Yii::app()->user->id===$params["user"]->uid;';
			$task=$this->_authManager->createTask('updateSelfProfile','update the profile of user self',$bizRule);
			
			
			// create the lowest level operations for [image data]
			$this->_authManager->createOperation(
					"uploadImageData",
					"upload image image matedata");

			
			// create the lowest level operations for [label]
			$this->_authManager->createOperation(
					"createLabel",
					"create a new label");
			$this->_authManager->createOperation(
					"readLabel",
					"read label information");
			$this->_authManager->createOperation(
					"updateLabel",
					"update label information");
			
			
			// create the lowest level operations for [image set]
			$this->_authManager->createOperation(
					"createImageSet",
					"create a new issue");
			$this->_authManager->createOperation(
					"viewImageSet",
					"view image set list");
			

			//create the lowest level operations for [label task]
			$this->_authManager->createOperation(
					"createTask",
					"create a new task");
			$this->_authManager->createOperation(
					"viewTask",
					"view label task list");
			

			//create the guest role and add the appropriate
			//permissions as children to this role
			$bizRule='return !Yii::app()->user->isGuest;';
			$role=$this->_authManager->createRole("guest", "authenticated guest user", $bizRule);
			$role->addChild("viewSelfProfile");
			$role->addChild("updateSelfProfile");
			

			
			//create the labeler, and add the appropriate
			//permissions, as well as the guest role itself, as children
			$bizRule="return Yii::app()->user->getRole() === 'labeler';";
			$role=$this->_authManager->createRole("labeler", "labeler user", $bizRule);
			$role->addChild("guest");
				

			
			//create the lab member role, and add the appropriate
			//permissions, as well as the labeler role itself, as children
			$bizRule="return Yii::app()->user->getRole() === 'labMember';";
			$role=$this->_authManager->createRole("labMember", "lab member user", $bizRule);
			$role->addChild("labeler");

			
			
			//create the admin role, and add the appropriate
			//permissions, as well as the lab member role, as children
			$bizRule="return Yii::app()->user->getRole() === 'admin';";
			$role=$this->_authManager->createRole("admin", "admin user", $bizRule);
			$role->addChild("labMember");
			$role->addChild("manageUser");
			$role->addChild("changeRole");
			
			
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