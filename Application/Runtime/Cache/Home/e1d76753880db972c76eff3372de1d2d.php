<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title>新用户注册</title>
<meta charset="UTF-8">
<meta name="keywords" content="新用户注册">
<meta name="description" content="新用户注册">
<link type="text/css" href="/Public/Home/regist/css/reset.css" rel="stylesheet">
<link type="text/css" href="/Public/Home/regist/css/public.css" rel="stylesheet">
<link type="text/css" href="/Public/Home/regist/css/register.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" />
<script src="/Public/Home/regist/js/jquery.min.js" type="text/javascript"></script>
<script src="/Public/Home/regist/js/jquery.form.js" type="text/javascript"></script>
<script src="/Public/Home/regist/js/json.parse.js" type="text/javascript"></script>

<style>
.input_div span{ background:#FFF;}
</style>
<!--[if IE 6]>
<script src="/Public/Home/regist/js/DD_belatedPNG.js"  type="text/javascript"></script>
<script>DD_belatedPNG.fix('.png_bg');</script>
<![endif]-->
</head>
<body>
	<div id="header">
		<div class="header">
			<h1 class="png_bg"></h1>
		
			<a class="png_bg" style="color:red;font-size:16px;" href="<?php echo U('Home/Index/index');?>">返回网站首页</a>
		</div>
	</div>
	
	<div class="register_content">
	
		<ul class="step_ul step1 clear">
			<li class="li1">01、填写资料</li>
			<li class="li2">02、完成注册</li>
		</ul>
		
		 <form name="registerForm" id='registerForm' action="" method="post" style="padding:60px 40px 88px 40px;font-family:Microsoft Yahei">
			<div class="div_form clear ">
				<label>账户名：</label>
				<div class="input_div input_div1">
					<input id="username" name="username" type="text" placeholder="可为中文，英文，数字（1个中文算3个字符）" maxlength="24" onblur="isName()">
					<span></span>
				</div>
			</div>
			<div class="div_form clear ">
				<label>常用的邮箱帐号：</label>
				<div class="input_div input_div2" >
					<input id="mail" name="useremail"  type="text" placeholder="请填写正确的邮箱，以便接收账号激活邮件" maxlength="64" onblur="isEmail()">
					<span></span>
				</div>
			</div>
			<div class="div_form clear ">
				<label>请创建一个密码：</label>
				<div class="input_div input_div3">
					<input id="password1" name="userpass" type="password" placeholder="6-16个字符之间，区分大小写" maxlength="16" onblur="isPass()">
					<span></span>
				</div>
			</div>
			<div class="div_form clear ">
				<label>重新输入密码：</label>
				<div class="input_div input_div4">
					<input id="password2" name="userpass2" type="password" placeholder="再次输入密码" maxlength="16" onblur="isPass2()">
					<span></span>
				</div>
			</div>
			<div class="div_form clear ">
				<label>请输入验证码：</label>
				<div class="input_div input_div5">
					<input id="varcode" name="varcode" style="width:30%" type="text" maxlength="4" placeholder="请输入右侧验证码" onblur="isCode()">
                    <img src="/index.php/Home/Login/verify" alt="刷新重试" class="passcode" style="width:20%;height:50px;cursor:pointer;" onclick="this.src=this.src+'?'">
					<span></span>
				</div>
			</div>
			<div class="div_form clear ">
				<label></label>
				<div class="input_div check2 input_div6" data="0" id="agreement">
                    <span></span>
				</div>
			</div>
            
			<div class="div_form clear ">
				<label></label>
				<div class="input_div">
					<input id="btn" class="btn" type="button" value="注册" />
				</div>
			</div>
			
		</form>

		<div class="reg_login">
			<p>已有帐号？</p>
			<a class="btn2" href="<?php echo U('Home/Login/ajaxLogin');?>">登录</a>
		</div>
		<div class="bg"><div class="copyright" style="text-align:center;">Copyright © 2017 黄文豪  版权所有.</div></div>
		
	</div>
	
<script type="text/javascript">

function isName(){
	var userName= $("#username").val();
	//var reg = /^[\u4e00-\u9fa5_a-zA-Z0-9]{6,16}$/;
	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Login/ajaxUser")?>',
		data:{'username':userName},
		success:function(respon){
			if(respon.errno == 10001){
				$(".input_div1 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
				$(".input_div6 span").empty();
				return false;
			}else{
				$(".input_div1 span").empty();
				$(".input_div6 span").empty();
				return true;
			}
		}
	});
	/*if(reg.test(userName) == false){
		$(".input_div1 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>账户名格式不正确!</font>');
		$("#username").focus();
		$(".btn").val('注册').removeAttr('disabled');
		return false;
	}else{
		$(".input_div1 span").empty();
		$(".input_div6 span").empty();
		return true;
	}*/
}

function isPass(){
	var userPass= $("#password1").val();
	if(userPass.length < 6 || userPass.length > 16){
		$(".input_div3 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>密码格式不正确!</font>');
		$(".input_div6 span").empty();
		return false;
	}else{
		$(".input_div3 span").empty();
		$(".input_div6 span").empty();
		return true;
	}
	
}

function isPass2(){
	var userPass = $("#password1").val();
	var userPass2=$("#password2").val();
	userPass=$.trim(userPass);
	userPass2=$.trim(userPass2);
	if(userPass2 == ''){
		$(".input_div4 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>请确认你的密码!</font>');
		$(".input_div6 span").empty();
		return false;
	}else if(userPass != userPass2){
		$(".input_div4 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>两次输入的密码不一致!</font>');
		$(".input_div6 span").empty();
		return false;
	}else{
		$(".input_div4 span").empty();
		$(".input_div6 span").empty();
		return true;
	}
}

function isEmail(){
   var email = $("#mail").val();
   //alert(email);
   var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
   $.ajax({
		type:'post',
		url:'<?php echo U("Home/Login/ajaxEmail")?>',
		data:{'email':email},
		success:function(respon){
			if(respon.errno == 10001){
				$(".input_div2 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
				$(".input_div6 span").empty();
				return false;
			}else{
				$(".input_div2 span").empty();
				$(".input_div6 span").empty();
				return true;
			}
		}
	});
   if(!myreg.test(email)){
		$(".input_div2 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>请输入正确的邮箱格式!</font>');
		$(".input_div6 span").empty();
		return false;
   }else{
	    $(".input_div2 span").empty();
		$(".input_div6 span").empty();
		return true;	   
   } 
		 
}

function isCode(){
	var code = $('#varcode').val();
	if(code == ''){
		$(".input_div5 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>验证码不能为空!</font>');
		$(".input_div6 span").empty();
		return false;
	}else{
		$(".input_div5 span").empty();
		$(".input_div6 span").empty();
		return true;
	}
}

$(function(){
	$(document).keydown(function(event){
		if(event.keyCode == 13){
			$(".btn").click();
		}
	});
	$(".btn").bind().click(function(){
				
		var username= $("#username").val();
		var userpass= $("#password1").val();
		var userpass2=$("#password2").val();
		var useremail=$("#mail").val();
		var code =$("#varcode").val();

		$.ajax({
			type:'post',
			url:'<?php echo U("Home/Login/ajaxRegist");?>',
			data:{'username':username,'userpass':userpass,'userpass2':userpass2,'email':useremail,'code':code},
			dataType: "json",
			success:function(respon){
				if(respon.errno == 10001){
					$(".input_div1 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$(".input_div6 span").html('<img src="/Public/Home/regist/images/text_error.png"><font color=red>注册失败,请按上面的要求填写！</font>');
				}else if(respon.errno == 10002){
					$(".input_div3 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$(".input_div6 span").html('<img src="/Public/Home/regist/images/text_error.png"><font color=red>注册失败,请按上面的要求填写！</font>');
				}else if(respon.errno == 10003){
					$(".input_div4 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$(".input_div6 span").html('<img src="/Public/Home/regist/images/text_error.png"><font color=red>注册失败,请按上面的要求填写！</font>');
				}else if(respon.errno == 10004){
					$(".input_div5 span").html('<img src="/Public/Home/regist/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$(".input_div6 span").html('<img src="/Public/Home/regist/images/text_error.png"><font color=red>注册失败,请按上面的要求填写！</font>');
				}else if(respon.errno == 20001){
					$(".input_div6 span").html('<img src="/Public/Home/regist/images/text_error.png"><font color=red>注册失败,请按上面的要求填写！</font>');
				}else if(respon.errno == 20000){
					$(".input_div6 span").html('<img src="/Public/Home/regist/images/tip-right.png"><font color=red>'+respon.errmsg+'</font>');
					setTimeout( "close()",15000);	//停留15秒，执行close()函数
					
				}
			}
		});			
	})
	
});


function close(){
	window.location.href = "<?php echo U('Home/Login/ajaxLogin');?>";
}

</script>
	
</body>
</html>