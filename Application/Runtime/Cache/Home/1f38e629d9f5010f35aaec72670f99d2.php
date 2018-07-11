<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html class="login-alone">
    <head>
        <title>找回密码</title>
		<meta name="keywords" content="找回密码" />
		<meta name="description" content="找回密码" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" type="image/x-icon" href="" />
        <link href="/Public/Home/login/css/screen.css?v=3.9" media="screen, projection" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" type="text/css" href="/Public/Home/login/css/base.css?v=3.9">
        <link rel="stylesheet" type="text/css" href="/Public/Home/login/css/login.css?v=3.9">
        <script src="/Public/jquery-1.8.3.min.js"></script>
        <!--[if lt IE 9]>
        <script>
        window.location="homepage/support";
        </script>
        <![endif]-->
    </head>
    <body>
        <div class="logina-logo" style="height: 55px">
            <a href="">
                <!-- <img src="/Public/Home/login/images/toplogo.png?v=3.9" height="60" alt=""> -->
            </a>
        </div>
        <div class="logina-main main clearfix">
            <div class="tab-con">
                <form id="form-login" method="post" action="passport/ajax-login">
                    <div id='login-error' class="error-tip"></div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        	<tr>
                                <th colspan=2; style="font-size:20px;color:000;padding-right:30%;">密码找回</th>
                                
                            </tr>
                            <tr>
                                <th>账户</th>
                                <!-- <td width="245">
                                    <input id="email" type="text" name="email" placeholder="电子邮箱/手机号" autocomplete="off" value=""></td>
                                <td> -->
                                <td width="245">
                                    <input id="username" type="text" name="username" placeholder="请输入用户名" autocomplete="off" value="">
                                </td>
                                <td class="NipName"></td>
                            </tr>
                            <tr>
                                <th>邮箱</th>
                                <td width="245">
                                    <input id="email" type="email" name="email" placeholder="请输入您注册时的邮箱" autocomplete="off">
                                </td>
                                <td class="NipEmail"></td>
                            </tr>
                            
                            <tr class="abcd" hidden>
                                <td class="errors" colspan="3" style="padding-left:18%;"></td>
                            </tr>
                            
                            <tr class="abcderrors" hidden>
                                <td class="abcderrors" colspan="3" style="padding-left:18%;"></td>
                            </tr>
                            
                            <tr>
                                <th></th>
                                <td width="245"><input class="confirm" id="but" type="button" value="提    交"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="refer" value="site/">
                </form>
            </div>
            <div class="reg">
            	<p><a href="<?php echo U('Home/Index/index');?>" style="color:red;">返回网站首页</a></p>
                <p>还没有账号？<br>赶快免费注册一个吧！</p>
                <a class="reg-btn" href="<?php echo U('Home/Login/regist');?>">立即免费注册</a>
            </div>
        </div>
        <div id="footer">
            <div class="copyright">Copyright © 2017 黄文豪  版权所有.</div>
        </div>

<script>
$('#but').bind().click(function(){

	var username = $('#username').val();
	var email = $('#email').val();

	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Login/wjPassword")?>',
		data:{'email':email,'username':username},
		success:function(respon){
			if(respon.errno == 10001){
				//$(".abcd").show();
				$("td.NipName").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
				$("td.NipEmail").empty();
				$("td.errors").empty();
			}else if(respon.errno == 10002){
				$("td.NipEmail").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
				$("td.NipName").empty();
				$("td.errors").empty();
			}else if(respon.errno == 10003){
				$(".abcderrors").show();
				$("td.abcderrors").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
				$("td.NipName").empty();
				$("td.NipEmail").empty();
				$(".abcd").hide();
			}else if(respon.errno == 10000){
				$(".abcd").show();
				$("td.errors").html('<img src="/Public/Home/login/images/tip-right.png"><font color=red>'+respon.errmsg+'</font>');
				$("td.NipName").empty();
				$("td.NipEmail").empty();
				$(".abcderrors").hide();
				setTimeout( "close()",15000);	//停留15秒，执行close()函数
			}
		},dataType:'json'
	});
});

function close(){
	window.location.href = "<?php echo U('Home/Login/resetPassView');?>";
}
</script>       
    </body>
</html>