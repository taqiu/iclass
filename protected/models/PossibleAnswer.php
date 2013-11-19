<?php

/**
 * This is the model class for table "{{possible_answer}}".
 *
 * The followings are the available columns in table '{{possible_answer}}':
 * @property integer $id
 * @property integer $label_id
 * @property string $answer
 *
 * The followings are the available model relations:
 * @property LabelResponse[] $labelResponses
 * @property Label $label
 */
class PossibleAnswer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{possible_answer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('label_id', 'required'),
			array('label_id', 'numerical', 'integerOnly'=>true),
			array('answer', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, label_id, answer', 'safe', 'on'=>'search'),
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
			'labelResponses' => array(self::HAS_MANY, 'LabelResponse', 'answer_id'),
			'label' => array(self::BELONGS_TO, 'Label', 'label_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label_id' => 'Label',
			'answer' => 'Answer',
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
		$criteria->compare('label_id',$this->label_id);
		$criteria->compare('answer',$this->answer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PossibleAnswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
