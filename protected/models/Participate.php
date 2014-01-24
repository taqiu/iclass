<?php

/**
 * This is the model class for table "{{participate}}".
 *
 * The followings are the available columns in table '{{participate}}':
 * @property integer $user_id
 * @property integer $task_id
 * @property integer $last_image_labeled
 * @property integer $is_done
 * @property integer $count_labeled
 */
class Participate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{participate}}';
	}

	public function primaryKey()
	{
		return array('user_id', 'task_id');
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, task_id, last_image_labeled', 'required'),
			array('user_id, task_id, last_image_labeled, is_done, count_labeled', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, task_id, last_image_labeled, is_done', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'task_id' => 'Task',
			'last_image_labeled' => 'Last Image Labeled',
			'is_done' => 'Is Done',
			'count_labeled' => 'Images Labelled'
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('last_image_labeled',$this->last_image_labeled);
		$criteria->compare('is_done',$this->is_done);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Participate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
