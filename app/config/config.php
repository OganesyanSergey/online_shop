<?php
	
	session_start();

	// Database connection data
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'online_shop');

	define('URL_ROOT', 'http://online.shop.com');
	define('APP_ROOT', dirname(dirname(__FILE__)));
	define('UPLOAD_ROOT', dirname(dirname(dirname(__FILE__))).'\public\uploads');

?>