<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>文件上传</title>
</head>
<body>
<form action="<?php echo U('Uploade/uploade');?>" enctype="multipart/form-data" method="post" name="uploadfile">
上传文件：<input type="file" name="zip"/>

<input type="submit" value="上传"/>
</form>

</body>
</html>