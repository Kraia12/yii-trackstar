<?php


class ProjectUserForm extends CFormModel
{
	/**
	* @var string username of the user being added to the project
	*/
	public $username;

	/**
	* @var string the role to which the user will be associated within the project
	*/
	public $role;

	/**
	* @var object an instance of the Project AR model class
	*/
	public $project;

	/**
	 * Declares the validation rules.
	 */

	public function rules()
	{
		return array(
			// username and password are required
			array('username, role', 'required'),
			// password needs to be authenticated
			//array('username', 'verify'),
			array('username', 'exist', 'className'=>'User'),
			array('username', 'verify'),
		);
	}

	public function verify($attribute,$params)
	{
		if(!$this->hasErrors()) // we only want to authenticate when no other input errors are present
		{
			$user = User::model()->findByAttributes(array('username'=>$this->username));

				if($this->project->isUserInProject($user))
				{
					$this->addError('username','This user has already been added to the project.');
				}
				else
				{
					try{
						$this->project->associateUserToProject($user);
						$this->project->associateUserToRole($this->role,$user->id);
						$auth = Yii::app()->authManager;
						$bizRule='return isset($params["project"]) && $params["project"]->isUserInRole("'.$this->role.'");';
						$auth->assign($this->role,$user->id, $bizRule);
						}
						catch(Exception $e) {

						}
				}
		}
	}

}
