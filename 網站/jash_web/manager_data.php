<?php
	require 'config.php';
	
	$page = $_POST['page'];
	$pageSize = $_POST['rows'];
	$first = $pageSize * ($page - 1);
	
	$order = $_POST['order'];
	$sort = $_POST['sort'];
	
	$query = mysql_query("SELECT id,manager,auth,date FROM easyui_admin ORDER BY $sort $order LIMIT $first,$pageSize") or die('SQL 錯誤！');
	$total = mysql_num_rows(mysql_query("SELECT id,manager,auth,date FROM easyui_admin"));
	
	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}

	$json = substr($json, 0, -1);
	echo '{"total" : '.$total.', "rows" : ['.$json.']}';
	mysql_close();
?>