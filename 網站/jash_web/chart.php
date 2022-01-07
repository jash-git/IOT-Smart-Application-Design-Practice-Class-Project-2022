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
		
		var SwitchData = [];
		//alert(SwitchData);
		//var data01 = [5, 20, 36, 10, 10, 20];
		//var data02 = [20, 10, 10, 36, 20, 5];
		if((value%2)==1)
		{
			//*
			$.ajax(
			{
					 url: 'getChart.php?v=1',
					 cache: false,
					 type:'Get',
					 async:false, //設定為同步(=必須等待執行結果)
					 error:function(){
						 //alert('Ajax request 發生錯誤');
						 },
					 success: function(res){
							//alert(res);
							SwitchData.length = 0;
							SwitchData=$.parseJSON(res);
						 }
			});
			//*/
		}
		else
		{
			//*
			$.ajax(
			{
					 url: 'getChart.php?v=0',
					 cache: false,
					 type:'Get',
					 async:false, //設定為同步(=必須等待執行結果)
					 error:function(){
						 //alert('Ajax request 發生錯誤');
						 },
					 success: function(res){
						    //alert(res);
							SwitchData.length = 0;
							SwitchData=$.parseJSON(res);
						}
			});	
			//*/
		}
		
		// 指定图表的配置项和数据
		option = {
			title: {
				text: 'ECharts 入门示例'
			},
			tooltip: {},
			legend: {
				data:['销量']
			},
			xAxis: {
				data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
			},
			yAxis: {},
			series: [{
				name: '销量',
				type: 'bar',
				data: SwitchData
			}]
		};		
		// 使用刚指定的配置项和数据显示图表。
		myChart.setOption(option);		
	}


	
	function showAuto()
	{
		if((gCount%10)==0)
		{
		　　showtime();
			showecharts(gCount/10);			
		}
		if(gCount<600)
		{
			gCount++;
		}
		else
		{
			gCount=0;
		}

		
	}
	
	function StopFunction()
	{
		clearTimeout(t);
		history.go(0);
	}
	
	$(function(){
	　　t = setInterval("showAuto()", 100); 
	})
	


</script>