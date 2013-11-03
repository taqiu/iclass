# Installing instructions

## Prerequisites
* Apache
* MySQL
* PHP 5.1.0 or above

## 1. Check Environment
After the environment deployment, you can open this link in your brower to check. The warning items can be ignored if you don't use those tool in yii. But there might still exist environment problems even everything is passed in the checking list.
	http://localhost/requirements/ 

## 2. Configure Database
Configure db the './protected/config/main.php' and './protected/config/console.php'
	'db'=>array(
		//	'connectionString' => 'mysql:host=silo.cs.indiana.edu;dbname=b561f13_taqiu',
			'connectionString' => 'mysql:host=localhost:3306;dbname=b561f13_taqiu',
			'emulatePrepare' => true,
			'username' => 'b561f13_taqiu',
			'password' => 'fountainpark',
			'charset' => 'utf8',
			'tablePrefix' => 'dev_',
		),
* Make sure database host, username and password are correct
* Table prefix is used to avoid conflic when mutiple applications share the same database
	
## 3. Migrate Database 
The step requires you create tables in the database. You can use the yiic migrate command to initialize the datebase.
The database schema is in the './protected/migrations' directory.
	./protected/yiic migrate

## 4. Initialize RBAC and Add admin user
* Build RBAC hierarachy
	./protected/yiic rbac 
* Register New user on the home page
* Set admin user
	./protected/yiic rbac admin --username='admin_username'

## References
* [Window](http://www.wampserver.com/en/)
* [Mac OS X](http://jason.pureconcepts.net/2012/10/install-apache-php-mysql-mac-os-x/) 
* [Linux (Centos)](http://www.howtoforge.com/quick-n-easy-lamp-server-centos-rhel)