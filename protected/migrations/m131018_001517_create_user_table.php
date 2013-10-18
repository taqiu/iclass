<?php

class m131018_001517_create_user_table extends CDbMigration
{
	public function up()
	{
		// talbe name 'user', and yii will add prefix for {{user}}
		$this->createTable('{{user}}', array(
			'uid' => 'pk',          // primary key
			'username' => 'varchar(64) NOT NULL',
			'password' => 'varchar(64) NOT NULL',
			'email' => 'varchar(128) NOT NULL',
			'name' => 'varchar(128)',
			'role' => 'varchar(16)',
			'create_time' => 'datetime DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',
			'last_login_time' => 'datetime DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		$this->createIndex('username', '{{user}}', 'username', true);
		$this->createIndex('email', '{{user}}', 'email', true);
	}

	public function down()
	{
		$this->dropTable('{{user}}');
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