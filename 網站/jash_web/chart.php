<?php
/*
//user.php作為來源
	error_reporting(0);//停止報錯
	
	date_default_timezone_set("Asia/Taipei");
	echo date("Y-m-d H:i:s")."<br/>";　// 常用的完整表示法，分別為年、月、日、時、分、秒，輸出結果類似 2013-06-05 05:12:50
*/
?>
<script src="echarts/echarts.min.js"></script>
<script type="text/javascript" src="easyui/jquery.min.js"></script>

<!-- JS 顯示時間區域 -->
<div align="center">
	<font size="6">
		<span id='clock'>
		
		</span>
	</font>
</div>

<!-- <button onclick="StopFunction()">Stop it</button> -->
<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" style="width:80px" onclick="StopFunction()">Stop it</a>

<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 960px;height:720px;"></div>

<script type="text/javascript">	
	// 基于准备好的dom，初始化echarts实例
	var myChart = echarts.init(document.getElementById('main'));
	var gCount=0;
	var t;
	var ws = new WebSocket("ws://localhost:8081");
    ws.onmessage = function (e) {
		/*
        var msg = JSON.parse(e.data);
        var sender, user_name, name_list, change_type;

        switch (msg.type) {
            case 'system':
                sender = '系统消息: ';
                break;
            case 'user':
                sender = msg.from + ': ';
                break;
            case 'handshake':
                var user_info = {'type': 'login', 'content': uname};
                sendMsg(user_info);
                return;
            case 'login':
            case 'logout':
                user_name = msg.content;
                name_list = msg.user_list;
                change_type = msg.type;
                dealUser(user_name, change_type, name_list);
                return;
        }

        var data = sender + msg.content;
		listMsg(data);
		*/
		if (e.data.indexOf('d_array') !== -1)
		{		
			var msg = JSON.parse(e.data);
			showtime();
			showecharts(msg.d_array);
			console.log(msg.d_array);
		}

    };
	
	function showtime()
	{
		var now,hours,minutes,seconds,timeValue; 
		now = new Date(); 
		hours = now.getHours(); 
		minutes = now.getMinutes(); 
		seconds = now.getSeconds();
		timeValue = now.getFullYear()+"年";
		timeValue += (((now.getMonth()+1) < 10) ? " 0" : " ")+(now.getMonth()+1)+"月";
		timeValue += ((now.getDate()< 10) ? " 0" : " ")+now.getDate()+"日&emsp;";
		timeValue += (hours >= 12) ? "下午 " : "上午 "; 
		timeValue += ((hours > 12) ? hours - 12 : hours) + " 點"; 
		timeValue += ((minutes < 10) ? " 0" : " ") + minutes + " 分"; 
		timeValue += ((seconds < 10) ? " 0" : " ") + seconds + " 秒"; 
		clock.innerHTML = timeValue; 
	}
		
	function showecharts(value)
	{
		var option;
		
		var SwitchData = value;
		var X_Data = ["V1","V2","V3","V4","V5","V6"];

		
		// 指定图表的配置项和数据
		option = {
			title: {
				text: 'Arduino Value'
			},
			tooltip: {},
			legend: {
				data:['Value']
			},
			xAxis: {
				data: ["V1","V2","V3","V4","V5","V6"]
			},
			yAxis: {},
			series: [{
				name: 'Value',
				type: 'bar',
				data: SwitchData
			}]
		};		
		// 使用刚指定的配置项和数据显示图表。
		myChart.setOption(option);		
	}


	
	function showAuto()
	{
		showtime();
		showecharts([]);	
	}
	
	function StopFunction()
	{
		clearTimeout(t);
		history.go(0);
	}
	
	$(function(){
		showAuto();
	})
	


</script>