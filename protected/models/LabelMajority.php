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
	
	
	public static function updateByImage($label_id, $image_id) {
		// Get ans_count for each image
		$sql = "SELECT answer_id, COUNT(*) AS ans_count
				FROM {{label_response}}
				WHERE label_id=:labelId AND image_id=:imageId
				GROUP BY answer_id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":labelId", $label_id, PDO::PARAM_INT);
		$command->bindValue(":imageId", $image_id, PDO::PARAM_INT);
		$rows = $command->queryAll();
		
		// Update majority tabel
		$max = 0;
		$answer = 0;
		foreach ($rows as $row) {	
			if ($row['ans_count'] > $max) {
				$max = $row['ans_count'];
				$answer = $row['answer_id'];
			}
		}
		
		if ($max !== 0) {
			$label_maj = LabelMajority::model()->findByPk(array('label_id'=>$label_id, 'image_id'=>$image_id));
			if ($label_maj === null) {
				$label_maj = new LabelMajority();
				$label_maj->label_id = $label_id;
				$label_maj->image_id = $image_id;
			}
			$label_maj->answer_id = $answer;
			if($label_maj->save());
			else die(print_r($label_maj->errors));
		}		
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
