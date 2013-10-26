<?php
// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {
	
	public function getRole() 
	{
		if(($role=$this->getState('__role'))!==null)
			return $role;
		else
			return null;
	}
	
	public function setRole($value)
	{
		$this->setState('__role',$value);
	}

	protected function afterLogin($fromCookie)
	{
		$model = User::model()->findByPk($this->getId());
		$this->setRole($model->role);
	}

}
?>