<?php
	require 'config.php';
	
	$id = $_POST['id'];
	
	$query = mysql_query("SELECT id,manager,auth FROM easyui_admin WHERE id='$id'") or die('SQL 錯誤！');

	
	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}

	$json = substr($json, 0, -1);
	echo '['.$json.']';
	mysql_close();
?>