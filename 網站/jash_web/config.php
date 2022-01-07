<?php
	header('Content-Type:text/html; charset=utf-8');
	
	define('DB_HOST', 'localhost:3307');
	define('DB_USER', 'root');
	define('DB_PWD', 'usbw');
	define('DB_NAME', 'easyui');
	
	$conn = @mysql_connect(DB_HOST, DB_USER, DB_PWD) or die('資料庫連結失敗：'.mysql_error());
	
	@mysql_select_db(DB_NAME) or die('資料庫錯誤：'.mysql_error());
	
	@mysql_query('SET NAMES UTF8') or die('字元集錯誤：'.mysql_error());
?>
