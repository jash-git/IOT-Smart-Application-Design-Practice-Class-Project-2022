<?php
	session_start();
	require 'config.php';
	
	$manager = $_POST['manager'];
	$password = sha1($_POST['password']);
	
	$query = mysql_query("SELECT id FROM easyui_admin WHERE manager='$manager' AND password='$password' LIMIT 1") or die('SQL 錯誤！');
	
	if (!!mysql_fetch_array($query, MYSQL_ASSOC)) {
		$_SESSION['admin'] = $manager;
		echo 1;
	} else {
		echo 0;
	}
	
	
?>