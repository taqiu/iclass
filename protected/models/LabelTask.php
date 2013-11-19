<?php

/**
 * This is the model class for table "{{label_task}}".
 *
 * The followings are the available columns in table '{{label_task}}':
 * @property integer $id
 * @property integer $owner
 * @property string $name
 * @property integer $set_id
 * @property integer $label_id
 * @property string $create_time
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Label $label
 * @property User $owner0
 * @property ImageSet $set
 * @property User[] $devUsers
 */
class LabelTask extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{label_task}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner, set_id, label_id', 'required'),
			array('owner, set_id, label_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('status', 'length', 'max'=>16),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner, name, set_id, label_id, create_time, status', 'safe', 'on'=>'search'),
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
			'label' => array(self::BELONGS_TO, 'Label', 'label_id'),
			'owner0' => array(self::BELONGS_TO, 'User', 'owner'),
			'set' => array(self::BELONGS_TO, 'ImageSet', 'set_id'),
			'devUsers' => array(self::MANY_MANY, 'User', '{{participate}}(task_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner' => 'Owner',
			'name' => 'Name',
			'set_id' => 'Set',
			'label_id' => 'Label',
			'create_time' => 'Create Time',
			'status' => 'Status',
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
		$criteria->compare('set_id',$this->set_id);
		$criteria->compare('label_id',$this->label_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabelTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}