<?php
	session_start();
	if (!isset($_SESSION['admin'])) {
		header('location:index.php');
	}
?>

<table id="manager"></table>

<div id="manager_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add-new" plain="true" onclick="manager_tool.add();">添加</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="manager_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="manager_tool.remove();">刪除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="manager_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="manager_tool.redo();">取消選擇</a>		
	</div>
	<!--
	<div style="padding:0 0 0 7px;color:#333;">
		查詢帳號：<input type="text" class="textbox" name="user" style="width:110px">
		創建時間從：<input type="text" name="date_from" class="easyui-datebox" editable="false" style="width:110px">
		到：<input type="text" name="date_to" class="easyui-datebox" editable="false" style="width:110px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="obj.search();">查詢</a>
	</div>
	-->
</div>


<form id="manager_add" style="margin:0;padding:5px 0 0 25px;color:#333;">
	<p>管理帳號：<input type="text" name="manager" class="textbox" style="width:200px;"></p>
	<p>管理密碼：<input type="password" name="password" class="textbox" style="width:200px;"></p>
	<p>分配許可權：<input id="auth" class="textbox" name="auth" style="width:205px;"></p>
</form>


<form id="manager_edit" style="margin:0;padding:5px 0 0 25px;color:#333;">
	<input type="hidden" name="id" class="textbox" style="width:200px;">
	<p>管理帳號：<input type="text" name="manager_edit" disabled="true" class="textbox" style="width:200px;"></p>
	<p>管理密碼：<input type="password" name="password_edit" class="textbox" style="width:200px;"></p>
	<p>分配許可權：<input id="auth_edit" class="textbox" name="auth_edit" style="width:205px;"></p>
</form>



<script type="text/javascript" src="js/manager.js"></script>
