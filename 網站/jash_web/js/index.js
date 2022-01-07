$(function () {
	
	//登錄介面
	$('#login').dialog({
		title : '登錄後臺',
		width : 300,
		height : 180,
		modal : true,
		iconCls : 'icon-login',
		buttons : '#btn',
	});
	
	//管理員帳號驗證
	$('#manager').validatebox({
		required : true,
		missingMessage : '請輸入管理員帳號',
		invalidMessage : '管理員帳號不得為空',
	});
	
	//管理員密碼驗證
	$('#password').validatebox({
		required : true,
		validType : 'length[6,30]',
		missingMessage : '請輸入管理員密碼',
		invalidMessage : '管理員密碼不得為空',
	});
	
	//載入時判斷驗證
	if (!$('#manager').validatebox('isValid')) {
		$('#manager').focus();
	} else if (!$('#password').validatebox('isValid')) {
		$('#password').focus();
	}
	
	
	//按一下登錄
	$('#btn a').click(function () {
		if (!$('#manager').validatebox('isValid')) {
			$('#manager').focus();
		} else if (!$('#password').validatebox('isValid')) {
			$('#password').focus();
		} else {
			$.ajax({
				url : 'checklogin.php',
				type : 'post',
				data : {
					manager : $('#manager').val(),
					password : $('#password').val(),
				},
				beforeSend : function () {
					$.messager.progress({
						text : '正在登錄中...',
					});
				},
				success : function (data, response, status) {
					$.messager.progress('close');
					
					if (data > 0) {
						location.href = 'admin.php';
					} else {
						$.messager.alert('登錄失敗！', '用戶名或密碼錯誤！', 'warning', function () {
							$('#password').select();
						});
					}
				}
			});
		}
	});
	
});
