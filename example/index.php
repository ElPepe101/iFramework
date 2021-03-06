<?php
// A little anti-fallback
if (! defined('__DIR__')) define('__DIR__', dirname(__FILE__));

if( ! class_exists('Locale', false)) {
	die('You must install the <a href="http://php.net/manual/en/book.intl.php">PHP INTL</a> extension.');
}

setlocale(LC_ALL, 'es_ES.UTF-8');

require 'vendor/autoload.php';
require 'vendor/elpepe/iframework/src/lib/Micro/common.php';

// Settings
\iframework\Router::$SRVRROOT = __DIR__;
\iframework\Router::$SITEROOT = array('localhost/ICO/portal', '189.137.75.112/example.com', 'icosc.com.mx/portal', 'www.icosc.com.mx/portal');
\iframework\Router::$SAFEAREA = 'portal';
\iframework\Router::$DEBUG = TRUE;
//\iframework\Router::$TEMPLATE = 'example'; 

/**
 * Database
 *
 * This system uses PDO to connect to MySQL, SQLite, or PostgreSQL.
 * Visit http://us3.php.net/manual/en/pdo.drivers.php for more info.
 */
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	\iframework\Router::$config['database'] = array(
		'dns' => "mysql:host=127.0.0.1;port=3306;dbname=",
		'username' => '',
		'password' => ''
	);
}
else
{
	\iframework\Router::$config['database'] = array(
		'dns' => "mysql:host=127.0.0.1;port=3306;dbname=",
		'username' => '',
		'password' => ''
	);
}

/**
 * Cookie Handling
 * To insure your cookies are secure, please choose a long, random key!
 * @link http://php.net/setcookie
 */
\iframework\lib\Micro\Cookie::$settings = array(
	'key' => '',
	'timeout' => time() + (60 * 60 * 4), // Ignore submitted cookies older than 4 hours
	'expires' => 0, // Expire on browser close
	'path' => '/',
	'domain' => '',
	'secure' => '',
	'httponly' => ''
);

\iframework\Router::construct();

// This will create/reset the DB
//$model = new Role();
//\RedBeanPHP\Facade::nuke();
//$model->reset();

// Check login access to module
$_sess = new \iframework\lib\Session(new User());
$_sess->verify();

// Set Nav
\iframework\Router::$navigation = $_sess->navigation();

// Start
\iframework\Router::start();