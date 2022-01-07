<?php
	require 'config.php';
	
	$id = isset($_POST['id']) ? $_POST['id'] : 0;
	
	$query = mysql_query("SELECT id,text,state,iconCls,url FROM easyui_nav WHERE nid='$id'") or die('SQL 錯誤！');

	
	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}

	$json = substr($json, 0, -1);
	echo '['.$json.']';
	mysql_close();
?>