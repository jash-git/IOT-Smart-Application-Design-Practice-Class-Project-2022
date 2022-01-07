<?php
	require 'config.php';
	
	$manager = $_POST['manager'];
	$password = sha1($_POST['password']);
	$auth = $_POST['auth'];
	$date = time();

	mysql_query("INSERT INTO easyui_admin (manager,password,auth,date) VALUES ('$manager','$password','$auth','$date')") or die('SQL 錯誤！');

	echo mysql_affected_rows();
	
	mysql_close();
?>