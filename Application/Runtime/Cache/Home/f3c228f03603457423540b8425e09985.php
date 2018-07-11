<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script src="/Public/Home/index/js/jquery-1.11.3.min.js"></script>
<script src="/third-party/thirdPay/thirdPay.js"></script>
</head>
<body>
<script>
var app = ThirdApp;
console.log(app);

$(function(){
	app.getUserInfo("aa","xx");
});
</script>
</body>
</html>