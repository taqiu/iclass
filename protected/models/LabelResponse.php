<?php

/**
 * This is the model class for table "{{label_response}}".
 *
 * The followings are the available columns in table '{{label_response}}':
 * @property integer $image_id
 * @property integer $label_id
 * @property integer $user_id
 * @property integer $answer_id
 *
 * The followings are the available model relations:
 * @property PossibleAnswer $answer
 * @property ImageData $image
 * @property Label $label
 * @property User $user
 */
class LabelResponse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{label_response}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_id, label_id, user_id, answer_id', 'required'),
			array('image_id, label_id, user_id, answer_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image_id, label_id, user_id, answer_id', 'safe', 'on'=>'search'),
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
			'answer' => array(self::BELONGS_TO, 'PossibleAnswer', 'answer_id'),
			'image' => array(self::BELONGS_TO, 'ImageData', 'image_id'),
			'label' => array(self::BELONGS_TO, 'Label', 'label_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'image_id' => 'Image',
			'label_id' => 'Label',
			'user_id' => 'User',
			'answer_id' => 'Answer',
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

		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('label_id',$this->label_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('answer_id',$this->answer_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabelResponse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
