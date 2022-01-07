<?php
	require 'config.php';
	
	$ids = $_POST['ids'];
	
	mysql_query("DELETE FROM easyui_admin WHERE id IN ($ids)") or die('SQL 錯誤！');

	echo mysql_affected_rows();
	
	mysql_close();
?>