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
 * @property integer $label_set_size
 *
 * The followings are the available model relations:
 * @property Label $label
 * @property User $owner0
 * @property ImageSet $set
 * @property User[] $devUsers
 */
class LabelTask extends CActiveRecord
{
	const STATUS_ACTIVE = 'active';
	const STATUS_INACTIVE = 'inactive';
	
	public $image_set_name;
	public $label_name;
	public $owner_name;
	
	public function getStatusOptions()
	{
		return array(
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_INACTIVE => 'Inactive',
		);
	}
	
	public static function getAllowedStatusRange()
	{
		return array(
				self::STATUS_ACTIVE,
				self::STATUS_INACTIVE,
		);
	}
	
	
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
			array('status','in','range'=>$this->getAllowedStatusRange(),'allowEmpty'=>false),
			array('name, image_set_name, label_name, status, label_set_size', 'required'),
			array('name', 'unique'),
			array('owner, set_id, label_id', 'numerical', 'integerOnly'=>true),
			array('label_set_size', 'numerical', 'integerOnly'=>true, 'min'=>0),
			array('name', 'length', 'max'=>64),
			array('status', 'length', 'max'=>16),
			array('image_set_name', 'exist', 'className'=>'ImageSet', 'attributeName'=>'name'),
			array('label_name', 'exist', 'className'=>'Label', 'attributeName'=>'name'),
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
			'owner' => 'Owner UID',
			'owner_name' => 'Owner',
			'name' => 'Task Name',
			'image_set_name' => 'Image Set Name',
			'label_name' => 'Label Name',
			'set_id' => 'Image Set',
			'label_id' => 'Label',
			'create_time' => 'Create Time',
			'status' => 'Status',
			'label_set_size'=>'Label Set Size',
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
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getUnfinishTasks($uid)
	{
		$sql="SELECT t.id as id, t.create_time as create_time, t.name as name, s.size as size
			FROM {{label_task}} t, {{image_set}} s
			WHERE  t.status='active' AND t.set_id = s.id 
				AND t.id NOT IN
				(SELECT task_id FROM {{participate}} 
				 WHERE user_id=:uid AND is_done=1)
			ORDER BY t.id ASC";
		$command=Yii::app()->db->createCommand($sql);
		$command->bindParam(":uid", $uid, PDO::PARAM_INT);
		$rows = $command->queryAll();
		foreach ($rows as &$row) {
			//die(print_r($row));
			$task_id = $row['id'];
			$participate = Participate::model()->findByPk(array('user_id' => $uid, 'task_id' => $task_id));
			if ($participate == null) {
				$row['progress'] = -1;
				$task = LabelTask::model()->findByPk($row['id']);
				if($task->label_set_size > 0)
					$row['size'] = $task->label_set_size;	
			} else {
				$task = LabelTask::model()->findByPk($participate->task_id);
				if($task->label_set_size == 0)				
					$progross = ImageSetDetail::model()->count("set_id=$task->set_id AND index_in_set<=$participate->last_image_labeled");
				else{
					$progross = $participate->count_labeled;
					$row['size'] = $task->label_set_size;				
				}
				$row['progress'] = $progross;
			}
		}
		$dataProvider = new CArrayDataProvider($rows, array(
			'pagination'=>array(
						'pageSize'=>10,
				),
		));
		return $dataProvider;
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

	protected function afterValidate()
	{
		parent::afterValidate();
		if(!$this->hasErrors()) {
			$label = Label::model()->findByAttributes(array('name'=>$this->label_name));
			$imageSet = ImageSet::model()->findByAttributes(array('name'=>$this->image_set_name));
			$this->label_id = $label->id;
			$this->set_id = $imageSet->id;
		}
	}
}
