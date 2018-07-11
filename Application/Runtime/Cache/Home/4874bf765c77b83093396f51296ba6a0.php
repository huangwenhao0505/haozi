<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>文件下载</title>

<script src="/Public/Home/index/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<form action="<?php echo U('Uploade/downloadMethod')?>">
<input type="text" name="filename" id="filename" placeholder="请输入要下载的文件名称，包括后缀"/>
<span id="error" style="color:red;"></span>
<input type="submit" id="sub" value="点击下载"/>
</form>

</body>
</html>