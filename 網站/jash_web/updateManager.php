<?php
	require 'config.php';
	
	$id = $_POST['id'];
	$auth = $_POST['auth'];
	
	if (!empty($_POST['password'])) {
		$password = sha1($_POST['password']);
		mysql_query("UPDATE easyui_admin SET password='$password',auth='$auth' WHERE id='$id'") or die('SQL 錯誤！');
	} else {
		mysql_query("UPDATE easyui_admin SET auth='$auth' WHERE id='$id'") or die('SQL 錯誤！');
	}

	echo mysql_affected_rows();
	
	mysql_close();
?>