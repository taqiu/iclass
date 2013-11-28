<?php

/**
 * This is the model class for table "{{image_data}}".
 *
 * The followings are the available columns in table '{{image_data}}':
 * @property integer $id
 * @property integer $uploader
 * @property string $flickr_user
 * @property string $date_uploaded_flickr
 * @property double $latitude
 * @property double $longitude
 * @property double $precision
 * @property string $title
 * @property integer $license
 * @property string $flickr_photo_id
 * @property string $date_uploaded
 * @property integer $farm
 * @property integer $server
 * @property string $secret
 *
 * The followings are the available model relations:
 * @property User $uploader0
 * @property ImageSet[] $devImageSets
 * @property LabelResponse[] $labelResponses
 * @property Tag[] $tags
 */
 

 
class ImageData extends CActiveRecord
{
	public $tagSearch;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{image_data}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flickr_user', 'ext.UniqueAttributesValidator', 'with'=>'flickr_photo_id'),
			array('uploader, farm, server, secret', 'required'),
			array('uploader, license, farm, server', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude, precision', 'numerical'),
			array('flickr_user', 'length', 'max'=>128),
			array('flickr_photo_id', 'length', 'max'=>64),
			array('secret', 'length', 'max'=>10),
			array('date_uploaded_flickr, title, date_uploaded', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uploader, flickr_user, date_uploaded_flickr, latitude, longitude, precision, title, license, flickr_photo_id, date_uploaded, farm, server, secret, tagSearch', 'safe', 'on'=>'search'),
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
			'uploader0' => array(self::BELONGS_TO, 'User', 'uploader'),
			'devImageSets' => array(self::MANY_MANY, 'ImageSet', '{{image_set_detail}}(image_id, set_id)'),
			'labelResponses' => array(self::HAS_MANY, 'LabelResponse', 'image_id'),
			'tags' => array(self::HAS_MANY, 'Tag', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uploader' => 'Uploader',
			'flickr_user' => 'Flickr User',
			'date_uploaded_flickr' => 'Date Uploaded Flickr',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'precision' => 'Precision',
			'title' => 'Title',
			'license' => 'License',
			'flickr_photo_id' => 'Flickr Photo',
			'date_uploaded' => 'Date Uploaded',
			'farm' => 'Farm',
			'server' => 'Server',
			'secret' => 'Secret',
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

		//$criteria->compare('id',$this->id);
		$criteria->compare('t.id',$this->id);
		$criteria->compare('uploader',$this->uploader);
		$criteria->compare('flickr_user',$this->flickr_user,true);
		$criteria->compare('date_uploaded_flickr',$this->date_uploaded_flickr,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('precision',$this->precision);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('license',$this->license);
		$criteria->compare('flickr_photo_id',$this->flickr_photo_id,true);
		$criteria->compare('date_uploaded',$this->date_uploaded,true);
		$criteria->compare('farm',$this->farm);
		$criteria->compare('server',$this->server);
		$criteria->compare('secret',$this->secret,true);
		
		// Add criteria only when tagSearch is set,
		// so that empty tag image can be displayed
		if (isset($this->tagSearch) && $this->tagSearch !== '') {
			$criteria->with = array('tags');
			#$criteria->together = true;
			#$criteria->compare('tag_text',$this->tagSearch,true);
			$criteria->addCondition('t.id IN (SELECT image_id FROM dev_tag WHERE tag_text LIKE :tagSearch)');
			$criteria->params[':tagSearch']='%' . $this->tagSearch . '%';
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			// commet out the sort, because it might cause error
			/*'sort'=>array(
					'attributes'=>array('tagSearch'=>array('asc'=>'tags.tag_text', 'desc'=>'tags.tag_test DESC',
					),
					'*',))*/
		));
	}

	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImageData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
