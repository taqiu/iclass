<?php

class m131104_043747_create_label_and_task_tables extends CDbMigration
{
	public function up()
	{
		// create label table
/*		CREATE TABLE Label(
		LabelID   	INT  AUTO_INCREMENT,
		Owner   	INT,
		LabelName   	VARCHAR(50),
		Description   	TEXT,
		Date   	DATETIME(),
		PRIMARY KEY (LabelID),
		FOREIGN KEY (Owner)  REFERENCES  User(UserID)); */
		$this->createTable('{{label}}', array(
			'id' => 'pk',
			'owner' => 'integer NOT NULL',
			'name' => 'varchar(64)',
			'description' => 'text',
			'create_time' => 'datetime DEFAULT NULL',
			'last_search_time' => 'datetime DEFAULT NULL',
		), 'ENGINE=InnoDB');
		$this->createIndex('label_name', '{{label}}', 'name', true);
		$this->addForeignKey(
				'fk_label_owner',
				'{{label}}',
				'owner',
				'{{user}}',
				'uid',
				'CASCADE',
				'RESTRICT'
		);
		
		// create poossible answer table
/* 	    CREATE TABLE PossibleAnswer(
		AID   		INT AUTO_INCREMENT,
		Answer   	TEXT,
		LabelID     	INT,
		PRIMARY KEY (AID),
		FOREIGN KEY (LabelID)  REFERENCES Label(LabelID)); */
		$this->createTable('{{possible_answer}}', array(
			'id' => 'pk',
			'label_id' => 'integer NOT NULL',
			'answer' => 'text',
		), 'ENGINE=InnoDB');
		$this->addForeignKey(
				'fk_possible_answer_label_id',
				'{{possible_answer}}',
				'label_id',
				'{{label}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		
		
		// create label task table
/*      CREATE TABLE LabelTask(
		TaskID     	INT  AUTO_INCREMENT,
		Owner    	INT,                
		ImageSetID    	INT, 
		LabelID          INT,
		DateCreated   	DATETIME(),
		status           VARCHAR(10),
		PRIMARY KEY (TaskID),
		FOREIGN KEY (Owner)      REFERENCES  User(UserID),
		FOREIGN KEY (LabelID)    REFERENCES  Label(LabelID),
		FOREIGN KEY (ImageSetID) REFERENCES  ImageSet(SetID)); */
		$this->createTable('{{label_task}}', array(
			'id' => 'pk',
			'owner' => 'integer NOT NULL',
			'name' => 'varchar(64)',
			'set_id' => 'integer NOT NULL',
			'label_id' => 'integer NOT NULL',
			'create_time' => 'datetime',
			'status' => 'varchar(16)',
		), 'ENGINE=InnoDB');
		$this->createIndex('label_task_name', '{{label_task}}', 'name', true);
		$this->addForeignKey(
				'fk_label_task_owner',
				'{{label_task}}',
				'owner',
				'{{user}}',
				'uid',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_task_set_id',
				'{{label_task}}',
				'set_id',
				'{{image_set}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_task_label_id',
				'{{label_task}}',
				'label_id',
				'{{label}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);

		// create participate table
/* 		CREATE TABLE Participates(
		UserID    		INT,
		TaskID    		INT,
		LastImageLabeled  	INT,
		PRIMARY KEY (UserID,TaskID),	
		FOREIGN KEY (UserID)  REFERENCES  User(UserID),                   
		    	FOREIGN KEY (TaskID)  REFERENCES  LabelTask(TaskID); */
		$this->createTable('{{participate}}', array(
			'user_id' => 'integer NOT NULL',
			'task_id' => 'integer NOT NULL',
			'last_image_labeled' => 'integer NOT NULL',
			'is_done' => 'boolean',
			'PRIMARY KEY (`user_id`,`task_id`)',
		), 'ENGINE=InnoDB');
		$this->addForeignKey(
				'fk_participate_user_id',
				'{{participate}}',
				'user_id',
				'{{user}}',
				'uid',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_participate_task_id',
				'{{participate}}',
				'task_id',
				'{{label_task}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		
		// create label response table
/* 		CREATE TABLE LabelResponse(
		ImageID   	INT,
		LabelID 	INT,
		UserID  	INT,
		AID  		INT,
		PRIMARY KEY (LabelID, UserID, ImageID),
		FOREIGN KEY (LabelID)  REFERENCES Label(LabelID),
		FOREIGN KEY (UserID)   REFERENCES User(UserID),
		FOREIGN KEY (AID)      REFERENCES PossibleAnswers(AID),
		FOREIGN KEY (ImageID)  REFERENCES ImageData(ImageID)); */
		$this->createTable('{{label_response}}', array(
			'image_id' => 'integer NOT NULL',
			'label_id' => 'integer NOT NULL',
			'user_id' => 'integer NOT NULL',
			'answer_id' => 'integer NOT NULL',
			'PRIMARY KEY (`image_id`,`label_id`, `user_id`)',
		), 'ENGINE=InnoDB');
		$this->addForeignKey(
				'fk_label_response_image_id',
				'{{label_response}}',
				'image_id',
				'{{image_data}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_response_label_id',
				'{{label_response}}',
				'label_id',
				'{{label}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_response_user_id',
				'{{label_response}}',
				'user_id',
				'{{user}}',
				'uid',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_response_answer_id',
				'{{label_response}}',
				'answer_id',
				'{{possible_answer}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		
	}

	public function down()
	{
		$this->dropTable('{{label_response}}');
		$this->dropTable('{{participate}}');
		$this->dropTable('{{label_task}}');
		$this->dropTable('{{possible_answer}}');
		$this->dropTable('{{label}}');
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