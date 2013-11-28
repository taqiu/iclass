<?php

/**
 * This is the model class for table "{{label}}".
 *
 * The followings are the available columns in table '{{label}}':
 * @property integer $id
 * @property integer $owner
 * @property string $name
 * @property string $description
 * @property string $create_time
 *
 * The followings are the available model relations:
 * @property User $owner0
 * @property LabelResponse[] $labelResponses
 * @property LabelTask[] $labelTasks
 * @property PossibleAnswer[] $possibleAnswers
 */
class Label extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{label}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner', 'required'),
			array('name', 'required'),
			array('description', 'required'),
			array('name', 'unique'),
			array('owner', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('description, create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner, name, description, create_time', 'safe', 'on'=>'search'),
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
			'owner0' => array(self::BELONGS_TO, 'User', 'owner'),
			'labelResponses' => array(self::HAS_MANY, 'LabelResponse', 'label_id'),
			'labelTasks' => array(self::HAS_MANY, 'LabelTask', 'label_id'),
			'possibleAnswers' => array(self::HAS_MANY, 'PossibleAnswer', 'label_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner' => 'Owner UID',
			'name' => 'Name',
			'description' => 'Description',
			'create_time' => 'Create Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('owner',$this->owner);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Label the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	/**
	 * Prepares create_time, owner, update_time and update_user_id attributes before performing validation.
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			// set the create date and the user doing the creating
			$this->create_time = new CDbExpression('NOW()');
			$this->owner = Yii::app()->user->id;
		}
		return parent::beforeValidate();
	}
}
