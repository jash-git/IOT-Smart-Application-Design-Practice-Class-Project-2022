﻿<?php
	require 'config.php';//連接DB
	require 'ws.php';//PHP WebSocket Client，因為JS 不能被Arduino 執行 所以只能找PHP
	//error_reporting(0);//停止報錯	
	date_default_timezone_set("Asia/Taipei");
	$time = date("Y-m-d H:i:s");
	//echo $time.'<br/>';
	
	//---
	//接收Arduino資料	
	$val = $_GET['string'];
	/*
	$bf = fopen("test.txt","a+");
	fwrite ($bf,$val."\r\n");
	fclose($bf);
	*/
	//---接收Arduino資料	

	//---
	//將資料寫入DB
	//echo "INSERT INTO val2db (date, value) VALUES ('$time','$val')";
	mysql_query("INSERT INTO val2db (date, value) VALUES ('$time','$val')") or die('SQL 錯誤！');
	mysql_close();
	//---將資料寫入DB

	//---
	//觸發WebSocket Server 後推資料動力
	$ws_client = new ws(array
	(
		'host' => '127.0.0.1',
		'port' => 8081,
		'path' => ''
	));
	$result = $ws_client->send('message');
	$ws_client->close();
	//---觸發WebSocket Server 後推資料動力
	
	//---
	//回傳Arduino資料
	echo "get data=";
	if(($val%2)==0)
	{
		echo 0;
	}
	else
	{
		echo 1;
	}
	//---回傳Arduino資料
	
?>
		