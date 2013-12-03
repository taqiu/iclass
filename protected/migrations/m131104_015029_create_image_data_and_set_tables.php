<?php

class m131104_015029_create_image_data_and_set_tables extends CDbMigration
{
	public function up()
	{
		// create ImageData table
		$this->createTable('{{image_data}}', array(
			'id' => 'pk',
			'uploader' => 'integer NOT NULL',
			'flickr_user' => 'varchar(128)',	
			'date_uploaded_flickr' => 'datetime',
			'latitude' => 'float',
			'longitude' => 'float',
			'precision' => 'float',
			'title' => 'text',
			'license' => 'integer',
			'flickr_photo_id' => 'varchar(64)',
			'date_uploaded'	=> 'datetime',
			'farm'	=>	'integer NOT NULL',
			'server' => 'integer NOT NULL',
			'secret' => 'char(10) NOT NULL',
			'UNIQUE KEY `k` (`flickr_user`,`flickr_photo_id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		// the image_data.uploader is a reference to user.uid
		$this->addForeignKey(
				'fk_image_date_uploader',
				'{{image_data}}',
				'uploader',
				'{{user}}',
				'uid',
				'CASCADE',
				'RESTRICT'
		);
		
		// create Tag table
		$this->createTable('{{tag}}', array(
			'id' => 'pk',
			'image_id' => 'integer NOT NULL',
			'tag_text' => 'text',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		// the tag.image_id is a reference to image_data.id
		$this->addForeignKey(
				'fk_tag_image_id', 
				'{{tag}}', 
				'image_id', 
				'{{image_data}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		
		
		// create ImageSet table
		$this->createTable('{{image_set}}', array(
			'id' => 'pk',
			'owner' => 'integer NOT NULL',
			'name' => 'varchar(64)',
			'description' => 'text',
			'size' => 'integer',
			'create_time' => 'datetime DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		$this->createIndex('image_set_name', '{{image_set}}', 'name', true);
		// the image_set.owner is a reference to user.uid
		$this->addForeignKey(
				'fk_image_set_owner',
				'{{image_set}}',
				'owner',
				'{{user}}',
				'uid',
				'CASCADE',
				'RESTRICT'
		);
		
		
		// create ImageSetDetails table
		$this->createTable('{{image_set_detail}}', array(
			'set_id' => 'integer NOT NULL',	
			'image_id' => 'integer NOT NULL',
			'index_in_set' => 'integer NOT NULL',
			'PRIMARY KEY (`set_id`,`image_id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		$this->addForeignKey(
				'fk_image_set_detail_set_id',
				'{{image_set_detail}}',
				'set_id',
				'{{image_set}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_image_set_detail_image_id',
				'{{image_set_detail}}',
				'image_id',
				'{{image_data}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		
	}

	public function down()
	{
		$this->dropTable('{{image_set_detail}}');
		$this->dropTable('{{image_set}}');
		$this->dropTable('{{tag}}');
		$this->dropTable('{{image_data}}');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}