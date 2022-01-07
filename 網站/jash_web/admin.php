<?php
	session_start();
	if (!isset($_SESSION['admin'])) {
		header('location:index.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>jash_web</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css" />
		<link rel="stylesheet" type="text/css" href="easyui/themes/icon.css" />
		<link rel="stylesheet" type="text/css" href="css/admin.css" />
	</head>
	<body class="easyui-layout">

		<div data-options="region:'north',title:'header',split:true,noheader:true" style="height:60px;background:#666;">
			<div class="logo">後臺管理</div>
			<div class="logout">您好，<?php echo $_SESSION['admin']?> | <a href="logout.php">退出</a></div>
		</div>
		
		<div data-options="region:'south',title:'footer',split:true,noheader:true" style="height:35px;line-height:30px;text-align:center;">
			&copy;2009-2025 jashliao. Powered by PHP and EasyUI.
		</div>
		
		<div data-options="region:'west',title:'導航',split:true,iconCls:'icon-world'" style="width:180px;padding:10px;">
			<ul id="nav"></ul>
		</div>
		
		<div data-options="region:'center'" style="overflow:hidden;">
			<div id="tabs">
				<div title="起始頁" iconCls="icon-house" style="padding:0 10px;display:block;">
					歡迎來到後臺管理系統！
				</div>
			</div>
		</div> 


		<script type="text/javascript" src="easyui/jquery.min.js"></script>
		<script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="easyui/locale/easyui-lang-zh_TW.js" ></script>
		<script type="text/javascript" src="js/admin.js"></script>
	</body>
</html>
