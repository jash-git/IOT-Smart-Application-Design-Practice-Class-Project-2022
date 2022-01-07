$(function () {
	
	$('#manager').datagrid({
		url : 'manager_data.php',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [10, 20, 30, 40, 50],
		pageNumber : 1,
		sortName : 'date',
		sortOrder : 'desc',
		toolbar : '#manager_tool',
		columns : [[
			{
				field : 'id',
				title : '自動編號',
				width : 100,
				checkbox : true,
			},
			{
				field : 'manager',
				title : '管理員帳號',
				width : 100,
			},
			{
				field : 'auth',
				title : '擁有許可權',
				width : 100,
			},
			{
				field : 'date',
				title : '創建日期',
				width : 100,
			},
		]],
	});
	
	$('#manager_add').dialog({
		width : 350,
		title : '新增管理',
		modal : true,
		closed : true,
		iconCls : 'icon-user-add',
		buttons : [{
			text : '提交',
			iconCls : 'icon-add-new',
			handler : function () {
				if ($('#manager_add').form('validate')) {
					$.ajax({
						url : 'addManager.php',
						type : 'post',
						data : {
							manager : $('input[name="manager"]').val(),
							password : $('input[name="password"]').val(),
							auth : $('#auth').combotree('getText'),
						},
						beforeSend : function () {
							$.messager.progress({
								text : '正在新增中...',
							});
						},
						success : function (data, response, status) {
							$.messager.progress('close');
							
							if (data > 0) {
								$.messager.show({
									title : '提示',
									msg : '新增管理成功',
								});
								$('#manager_add').dialog('close').form('reset');
								$('#manager').datagrid('reload');
							} else {
								$.messager.alert('新增失敗！', '未知錯誤導致失敗，請重試！', 'warning');
							}
						}
					});
				}
			},
		},{
			text : '取消',
			iconCls : 'icon-redo',
			handler : function () {
				$('#manager_add').dialog('close').form('reset');
			},
		}],
	});
	
	$('#manager_edit').dialog({
		width : 350,
		title : '修改管理',
		modal : true,
		closed : true,
		iconCls : 'icon-user-add',
		buttons : [{
			text : '提交',
			iconCls : 'icon-edit-new',
			handler : function () {
				if ($('#manager_edit').form('validate')) {
					$.ajax({
						url : 'updateManager.php',
						type : 'post',
						data : {
							id : $('input[name="id"]').val(),
							password : $('input[name="password_edit"]').val(),
							auth : $('#auth_edit').combotree('getText'),
						},
						beforeSend : function () {
							$.messager.progress({
								text : '正在修改中...',
							});
						},
						success : function (data, response, status) {
							$.messager.progress('close');
							
							if (data > 0) {
								$.messager.show({
									title : '提示',
									msg : '修改管理成功',
								});
								$('#manager_edit').dialog('close').form('reset');
								$('#manager').datagrid('reload');
							} else {
								$.messager.alert('修改失敗！', '未知錯誤或沒有任何修改，請重試！', 'warning');
							}
						}
					});
				}
			},
		},{
			text : '取消',
			iconCls : 'icon-redo',
			handler : function () {
				$('#manager_edit').dialog('close').form('reset');
			},
		}],
	});
	
	//管理帳號
	$('input[name="manager"]').validatebox({
		required : true,
		validType : 'length[2,20]',
		missingMessage : '請輸入管理名稱',
		invalidMessage : '管理名稱在 2-20 位',
	});
	
	//管理密碼
	$('input[name="password"]').validatebox({
		required : true,
		validType : 'length[6,30]',
		missingMessage : '請輸入管理密碼',
		invalidMessage : '管理密碼在 6-30 位',
	});
	
	//修改管理密碼
	$('input[name="password_edit"]').validatebox({
		//required : true,
		validType : 'length[6,30]',
		missingMessage : '請輸入管理密碼',
		invalidMessage : '管理密碼在 6-30 位',
	});
	
	//分配許可權
	$('#auth').combotree({
		url : 'nav.php',
		required : true,
		lines : true,
		multiple : true,
		checkbox : true,
		onlyLeafCheck : true,
		onLoadSuccess : function (node, data) {
			var _this = this;
			if (data) {
				$(data).each(function (index, value) {
					if (this.state == 'closed') {
						$(_this).tree('expandAll');
					}
				});
			}
		},
	});
	
	
	manager_tool = {
		reload : function () {
			$('#manager').datagrid('reload');
		},
		redo : function () {
			$('#manager').datagrid('unselectAll');
		},
		add : function () {
			$('#manager_add').dialog('open');
			$('input[name="manager"]').focus();
		},
		remove : function () {
			var rows = $('#manager').datagrid('getSelections');
			if (rows.length > 0) {
				$.messager.confirm('確定操作', '您正在要刪除所選的記錄嗎？', function (flag) {
					if (flag) {
						var ids = [];
						for (var i = 0; i < rows.length; i ++) {
							ids.push(rows[i].id);
						}
						//console.log(ids.join(','));
						$.ajax({
							type : 'POST',
							url : 'deleteManager.php',
							data : {
								ids : ids.join(','),
							},
							beforeSend : function () {
								$('#manager').datagrid('loading');
							},
							success : function (data) {
								if (data) {
									$('#manager').datagrid('loaded');
									$('#manager').datagrid('load');
									$('#manager').datagrid('unselectAll');
									$.messager.show({
										title : '提示',
										msg : data + '個管理被刪除成功！',
									});
								}
							},
						});
					}
				});
			} else {
				$.messager.alert('提示', '請選擇要刪除的記錄！', 'info');
			}
		},
		edit : function () {
			var rows = $('#manager').datagrid('getSelections');
			if (rows.length > 1) {
				$.messager.alert('警告操作！', '編輯記錄只能選定一條資料！', 'warning');
			} else if (rows.length == 1) {
				$.ajax({
					url : 'getManager.php',
					type : 'post',
					data : {
						id : rows[0].id,
					},
					beforeSend : function () {
						$.messager.progress({
							text : '正在獲取中...',
						});
					},
					success : function (data, response, status) {
						$.messager.progress('close');
						
						if (data) {
							
							var obj = $.parseJSON(data);
							var auth = obj[0].auth.split(',');
							
							$('#manager_edit').form('load', {
								id : obj[0].id,
								manager_edit : obj[0].manager,
								//auth_edit : obj[0].auth,
							}).dialog('open');
							
							//分配許可權
							$('#auth_edit').combotree({
								url : 'nav.php',
								required : true,
								lines : true,
								multiple : true,
								checkbox : true,
								onlyLeafCheck : true,
								onLoadSuccess : function (node, data) {
									var _this = this;
									if (data) {
										$(data).each(function (index, value) {
											if ($.inArray(value.text, auth) != -1) {
												$(_this).tree('check', value.target);
											}
											if (this.state == 'closed') {
												$(_this).tree('expandAll');
											}
										});
									}
								},
							});
							
						} else {
							$.messager.alert('獲取失敗！', '未知錯誤導致失敗，請重試！', 'warning');
						}
					}
				});
			} else if (rows.length == 0) {
				$.messager.alert('警告操作！', '編輯記錄至少選定一條資料！', 'warning');
			}
		},
	};
	
	
	
});
