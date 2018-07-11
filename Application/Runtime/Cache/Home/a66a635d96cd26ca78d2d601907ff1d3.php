<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<style>
    #th th{
        background-color: #50a9fa;
        color: aliceblue;
        font-size: large;
    }
</style>

<!-- vue不支持请求   所以要用到axios来执行请求地址  -->
<script type="text/javascript" src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>

 <div class = 'popUp' id = 'mima'>
	<div class = 'popUp_a clear'>
		<p class = 'popUp_a_l f_l'>请输入您想说的话：</p>
	</div>
	<div class = 'popUp_b'>
		<textarea name="content" id="add_content" cols="15" style="width: 95%;" rows="5"></textarea>
		<span id="error" style="float:right;padding-right:50px;"></span>
	</div>
	<div class= 'popUp_c'>
		<input type="hidden" id="user_article_comment" value=""/>
		<input type="button" class="btn btn-primary" id="quxiao" value="取消"/>
		<input type="button" class="btn btn-success" id="queding" onclick="queding(<?php echo $artiList['comment_count'];?>)" value="确定"/>
	</div>
</div>

</body>
</html>