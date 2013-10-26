<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $uid
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $name
 * @property string $role
 * @property string $create_time
 * @property string $update_time
 * @property string $last_login_time
 */
class User extends CActiveRecord
{
	const ROLE_GUEST ='guest';
	const ROLE_LABELER ='labeler';
	const ROLE_LAB_MEMBER = 'labMember';
	const ROLE_ADMIN = 'admin';
	
	public $password_repeat;
	public $old_password;
	public $new_password;
	public $new_password_repeat;
	
	/**
	 * Retrieves a list of roles
	 * @return array an array of available role types.
	 */
	public function getRoleOptions()
	{
		return array(
			self::ROLE_GUEST => 'Guest',
			self::ROLE_LABELER => 'Labeler',
			self::ROLE_LAB_MEMBER => 'Lab member',
			self::ROLE_ADMIN => 'admin'
		);
	}
	
	public static function getAllowedRoleRange()
	{
		return array(
				self::ROLE_GUEST,
				self::ROLE_LABELER,
				self::ROLE_LAB_MEMBER,
				self::ROLE_ADMIN,
		);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		// Scenarios: register, change_profile, change_password
		return array(
			array('role','in','range'=>$this->getAllowedRoleRange(),'allowEmpty'=>false),
			array('username, email', 'required', 'on'=>'changeProfile, register'),
			array('password, password_repeat', 'required', 'on'=>'register'),
			array('password', 'compare', 'on'=>'register'),
			array('old_password, new_password, new_password_repeat', 'required', 'on'=>'changePassword'),
			array('new_password', 'compare', 'on'=>'changePassword'),
			array('password_repeat, old_password, new_password_repeat', 'safe'),	
			array('username, email', 'unique'),
			array('email', 'email'),
			array('username, password, new_password', 'length', 'min'=>3, 'max'=>64),
			array('email, name', 'length', 'max'=>128),
			array('role', 'length', 'max'=>16),
			// array('create_time, update_time, last_login_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, username, password, email, name, role, create_time, update_time, last_login_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'name' => 'Name',
			'role' => 'Role',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'last_login_time' => 'Last Login Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	/**
	 * Define the behaviors
	 * so the user can automatically  save the create time and update time
	 * @see CModel::behaviors()
	 */
	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'create_time',
				'updateAttribute' => 'update_time',
				'setUpdateOnCreate' => true,
			),
		);
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password) === $this->password;
	}
	
	/**
	 * Check the olde password if 'change_password'
	 * @see CModel::beforeValidate()
	 */
	public function beforeValidate()
	{
		if ($this->scenario === 'changePassword')
			if ($this->password !== $this->hashPassword($this->old_password)) 
				$this->addError(null, 'Old password is not correct');
		
		return parent::beforeValidate();
	}
	
	/**
	 * apply a hash on the password before we store it in the database
	 */
	protected function afterValidate()
	{
		parent::afterValidate();	
		if(!$this->hasErrors()) {		
			if ($this->scenario === 'register') {
				$this->password = $this->hashPassword($this->password);
			}
			else if ($this->scenario === 'changePassword') {
				$this->password = $this->hashPassword($this->new_password);
			}
		}
	}
	
	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5($password);
	}
}