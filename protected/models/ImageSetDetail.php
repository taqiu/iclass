<?php

/**
 * This is the model class for table "{{image_set_detail}}".
 *
 * The followings are the available columns in table '{{image_set_detail}}':
 * @property integer $set_id
 * @property integer $image_id
 * @property integer $index_in_set
 */
class ImageSetDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{image_set_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('set_id, image_id, index_in_set', 'required'),
			array('set_id, image_id, index_in_set', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('set_id, image_id, index_in_set', 'safe', 'on'=>'search'),
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
			'set_id' => 'Set',
			'image_id' => 'Image',
			'index_in_set' => 'Index In Set',
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

		$criteria->compare('set_id',$this->set_id);
		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('index_in_set',$this->index_in_set);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function loadModel(array $id)
	{
			$model=ImageSetDetail::model()->findByPk($id);
			if($model===null)
					throw new CHttpException(404,implode(',',$id));#'The requested page does not exist. Cant Open Model');
			return $model;
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImageSetDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
