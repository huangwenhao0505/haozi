<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<style>
.pager li{
	float:left;
	list-style:none;
}
</style>
</head>
<body>
<tr>
	<td colspan="9" style="padding-left:30%;align:center;">
		<ul class="pager">
			<li class="previous disabled">
				<a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a>
			</li>
			<li class="disabled"  style="padding-left:20px;padding-right:20px;">
				<a>共2页 当前页1/2</a>
			</li>
			<li class="next disabled">
			<a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a>
			</li>
		</ul>
	</td>
</tr>
</body>
</html>