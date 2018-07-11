<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>试卷列表</title>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>
<body>
<table>
	<?php foreach($list as $k => $v){ ?>
		<lable>试卷名称：<?php echo $v['papername'];?></lable><br/>
		<lable>答题时长：<?php echo $v['exercisetime'];?></lable></br>
		<lable><input type="button" value="开始答题" onclick="onExam(<?php echo $v['id'];?>)"/></lable>
	<?php } ?>
</table>
</body>
</html>

<script>
function onExam(id){
	//获取当前点击开始答题的时间戳
	var timestamp = Date.parse(new Date());
	//为防止随意在url链接改时间戳，把时间戳加密处理
	var time = timestamp/24/60/60/1000 + 'H';
	window.location.href = "/index.php/Exam/User/onExam?id="+id+"&timestamp="+time;
}
</script>