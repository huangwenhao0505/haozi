<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="/Public/jquery-1.8.3.min.js" type="text/javascript"></script>
<title>Insert title here</title>

<style>
.box{
	width:60%;
	height:60%;
	text-align:center;
	margin: auto 0;
}
</style>
</head>
<body>
	<div>
		<table id="box" class="box">
			<thead>
			<tr>
				<th>任务来源</th>
				<th>种子链接</th>
				<th>种子名称</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
</body>
</html>

<script>
$(function(){
	do_sub();
	init();
});

function do_sub(){
	$.post('<?php echo U("Home/News/getRuleList");?>',function(data){
		var html = '';
		var d = eval("("+data+")");
		if(d.result != null && d.result != false)
		{
			for(var i in d.result)
			{
				html += '<tr>';
				html += '<td>'+d.result[i].name+'</td>';
				html += '<td>'+d.result[i].url+'</td>';
				html += '<td>'+d.result[i].cateName+'</td>';
				html += '<td><a href="">抓取</a></td>';
				html += '</tr>';
			}
		}
		else
		{
			html += '<tr><td colspan="4" text-align="center">暂无数据</td></tr>';
		}
		
		$("#box>tbody").html(html);
	});
}
</script>