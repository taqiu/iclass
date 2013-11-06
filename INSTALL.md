# Installing instructions

This repository has already integrated the yii framework, 
so you don't need to install yii additionally. 
See the [reference](#references) for more information about enviroment. 

## Prerequisites
* Apache
* MySQL
* PHP 5.1.0 or above

## 1. Check Environment
After the environment deployment, you can open this link in your brower to check. 
The warning items can be ignored if you don't use those tool in this project. 
But there might still exist environment problems even everything is passed in the checking list.

	http://localhost/requirements/ (change 'localhost' to your hostname if necessary)

## 2. Create and Configure Database
* [Create database and set privileges to a user](http://www.debuntu.org/how-to-create-a-mysql-database-and-set-privileges-to-a-user/)

```shell
	$ mysql -u root -p
	mysql> create database b561f13_taqiu;
	mysql> grant usage on *.* to b561f13_taqiu@localhost identified by 'your_password';
	mysql> grant all privileges on b561f13_taqiu.* to b561f13_taqiu@localhost ;
```

* Configure db in the ```./protected/config/main.php``` and ```./protected/config/console.php```

```php
	'db'=>array(
		//	'connectionString' => 'mysql:host=silo.cs.indiana.edu;dbname=b561f13_taqiu',
			'connectionString' => 'mysql:host=localhost:3306;dbname=b561f13_taqiu',
			'emulatePrepare' => true,
			'username' => 'b561f13_taqiu',
			'password' => 'your_password',
			'charset' => 'utf8',
			'tablePrefix' => 'dev_',
		),
```
	
* Make sure database host, username and password are correct
* Table prefix is used to avoid conflict when mutiple applications share the same database
	
## 3. Migrate Database 
The step requires you to create tables in the database. You can use the [yiic migrate command](http://www.yiiframework.com/doc/guide/1.1/en/database.migration) to initialize the datebase.
The database schema is in the ```./protected/migrations``` directory. 

```shell
	./protected/yiic migrate [up|down]
```

* 'up' is the default argument for this command. 'down' is used to drop all tables in the database.

## 4. Initialize RBAC and Add admin user
* Build RBAC hierarachy 

```shell
	./protected/yiic rbac
```

* Register new user on the home page
* Set admin user 

```shell
	./protected/yiic rbac admin --username='admin_username'
```

## References
Deploy Apache, MySQL and PHP in different platforms
* [Window](http://www.wampserver.com/en/)
* [Mac OS X](http://jason.pureconcepts.net/2012/10/install-apache-php-mysql-mac-os-x/) 
* [Linux (Cent OS 6.4)](http://www.howtoforge.com/quick-n-easy-lamp-server-centos-rhel)