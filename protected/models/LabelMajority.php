<?php

/**
 * This is the model class for table "{{label_majority}}".
 *
 * The followings are the available columns in table '{{label_majority}}':
 * @property integer $image_id
 * @property integer $label_id
 * @property integer $answer_id
 */
class LabelMajority extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{label_majority}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_id, label_id', 'required'),
			array('image_id, label_id, answer_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image_id, label_id, answer_id', 'safe', 'on'=>'search'),
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
			'image_id' => 'Image',
			'label_id' => 'Label',
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
		$criteria->compare('answer_id',$this->answer_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public function updateAll() {
		
	}
	
	public function partialUpdate($label_id) {
		$update_period = 60*60*24; // one day
		
		$label = Label::model()->findByPk((int) $label_id);
		if ($label === null) 
			throw new CHttpException(404,'No such Label!');
		
		// return and do nothing if last search time is less than update period
		$now = time();
		if (isset($label->last_search_time)) {
			$last_search_timestamp = strtotime($label->last_search_time);
			if ($now-$last_search_timestamp < $update_period) {	
				return $now-$last_search_timestamp;
			}
		}
		
		$sql = "SELECT T1.id, 
				FROM {{image_data}} AS T1
				WHERE 
					(SELECT label_id, image_id, answer_id, COUNT(*) as c
					FROM {{label_response}}
					WHERE label_id=:labelId AND image_id = T1.id
					GROUP BY label_id, image_id, answer_id
					ORDER BY c DESC) AS count_table

				";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":labelId", $label_id, PDO::PARAM_INT);
		
		$label->last_search_time = new CDbExpression('NOW()');
		$label->save();
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabelMajority the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
