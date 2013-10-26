<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
		
		
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
		//	'connectionString' => 'mysql:silo.cs.indiana.edu;dbname=b561f13_taqiu',
			'connectionString' => 'mysql:host=localhost;dbname=b561f13_taqiu',
			'emulatePrepare' => true,
			'username' => 'b561f13_taqiu',
			'password' => 'fountainpark',
			'charset' => 'utf8',
			'tablePrefix' => 'dev_',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
			'itemTable' =>'{{auth_item}}',
			'itemChildTable' =>'{{auth_item_child}}',
			'assignmentTable' =>'{{auth_assignment}}',
			'defaultRoles'=>array('guest', 'labeler', 'labMember', 'admin'),
		),	
	),
	// Command Map
	'commandMap'=>array(
		'migrate'=>array(
			'class'=>'system.cli.commands.MigrateCommand',
			'migrationPath'=>'application.migrations',
			'migrationTable'=>'{{migration_history}}',
			'connectionID'=>'db',
			//'templateFile'=>'application.migrations.template',
		),
	),
);