<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>试卷列表</title>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>
<body>
<table>
	<tr>
		<th>排名</th>
		<th>用户名</th>
		<th>头像</th>
		<th>正确数</th>
		<th>正确率</th>
	</tr>
	<?php foreach($list as $k => $v){ ?>
		<tr>
			<td style="text-align:center"><?php echo $k+1;?></td>
			<td style="text-align:center"><?php echo $v['username'];?></td></t>
			<td style="text-align:center"><img src="<?php echo $v['u_img'];?>" style="width:50px;height:50px;"/></td></t>
			<td style="text-align:center"><?php echo $v['rightnum'];?></td></t>
			<td style="text-align:center"><?php echo $v['accuracy'];?></td></t>
		</tr>
	<?php } ?>
</table>
</body>
</html>