<?php
require 'config.php';//連接DB
$data_array01 = array();
$data_array02 = array();
$k=0;
/*
//模擬用資料
if($_GET["v"]==0)
{
	$data_array= [20, 10, 10, 36, 20, 5];	
}
else
{
	$data_array= [5, 20, 36, 10, 10, 20];	
}
//*/

//*
	$query = mysql_query("SELECT id,value FROM val2db ORDER BY id DESC LIMIT 0,6") or die('SQL 錯誤！');
	while (!!$row = mysql_fetch_array($query)) {
		$data_array01[$k] = $row[1];
		$k++;
	}
//*/
//print_r ($data_array01);
$data_array02 = array_reverse($data_array01);
//print_r ($data_array02);

$data_json = json_encode($data_array02);
echo $data_json;
?>