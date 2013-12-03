<?php

class m131201_002149_create_label_majority_table extends CDbMigration
{
	public function up()
	{
		
		$this->createTable('{{label_majority}}', array(
				'image_id' => 'integer NOT NULL',
				'label_id' => 'integer NOT NULL',
				'answer_id' => 'integer DEFAULT NULL',              // Default  NULL
				'PRIMARY KEY (`image_id`,`label_id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		$this->addForeignKey(
				'fk_label_majority_image_id',
				'{{label_majority}}',
				'image_id',
				'{{image_data}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_majority_label_id',
				'{{label_majority}}',
				'label_id',
				'{{label}}',
				'id',
				'CASCADE',
				'RESTRICT'
		);
		$this->addForeignKey(
				'fk_label_majority_answer_id',
				'{{label_majority}}',
				'answer_id',
				'{{possible_answer}}',
				'id',
				'SET NULL',     // Delete action should be SET NUL
				'RESTRICT'
		);
	}

	public function down()
	{
		$this->dropTable('{{label_majority}}');
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