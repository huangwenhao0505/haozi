<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script src="/Public/Home/index/js/jquery-1.11.3.min.js"></script>
</head>
<body>

<script>
$(function(){
	$.post('<?php echo U("Home/A/index");?>',function(result){
		var d = eval("("+result+")");
		var day = d.result.day.footDay;
		console.log(d);
		console.log(day);
	});
});
</script>
</body>
</html>