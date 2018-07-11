<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html class="login-alone">
    <head>
        <title>用户登录界面</title>
		<meta name="keywords" content="用户登录界面" />
		<meta name="description" content="用户登录界面" />
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
                                <th>密码</th>
                                <td width="245">
                                    <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off">
                                </td>
                                <td class="NipPass"></td>
                            </tr>
                            <tr id="tr-vcode">
                                <th>验证码</th>
                                <td width="245">
                                    <div>
                            			<input type="text" class="input input-big" style="width:50%;" name="code" id="code" placeholder="填写右侧验证码" />
                           				<img src="/index.php/Home/Login/verify" alt="刷新重试" class="passcode" style="width:45%;height:35px;cursor:pointer;" onclick="this.src=this.src+'?'">                        
                        			</div>
                                </td>
                                <td class="NipCode"></td>
                            </tr>
                            <tr class="find">
                                <th></th>
                                <td>
                                    <div> 
                                        <label class="checkbox" for="chk11"><input style="height: auto;" id="remember_me" type="checkbox" name="remember_me" value="0" onclick="this.value=(this.value==0)?1:0")>记住我</label>
                                        <a href="<?php echo U('Home/Login/wjPassword');?>">忘记密码？</a>
                                    </div>
                                </td>
                                <td><span></span></td>                               
                            </tr>
                            <tr>
                                <th></th>
                                <td width="245"><input class="confirm" id="but" type="button" value="登  录"></td>
                                <td></td>
                            </tr>
                            
                            <tr>
                            	
                            	<th colspan="3" style="padding-left:-10%;">
                            	其他登录方式：
                            	<!-- <a href="<?php echo $qqurl;?>"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/Public/qq_logo_1.png"/></a> -->
                            	<a href = "<?php echo $qqurl;?>"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/Public/qq_logo_2.png"/></a>
                            	</th>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="refer" value="site/">
                </form>
            </div>
            <div class="reg">
            	<p><a href="<?php echo U('Home/Index/index');?>" style="color:red;">返回网站首页</a></p>
                <p>还没有账号？<br>赶快免费注册一个吧！</p>
                <a class="reg-btn" href="<?php echo U('Home/Login/ajaxRegist');?>">立即免费注册</a>
            </div>
        </div>
        <div id="footer">
            <div class="copyright">Copyright © 2017 黄文豪  版权所有.</div>
        </div>

<script>
$(function(){
	$(document).keydown(function(event){
		if(event.keyCode == 13){
			$("#but").click();
		}
	});
	$('#but').bind().click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		var remember_me = $('#remember_me').val();
		var code = $('#code').val();

		$.ajax({
			type:'post',
			url:'<?php echo U("Home/Login/ajaxLogin")?>',
			data:{'username':username,'password':password,'remember_me':remember_me,'code':code},
			success:function(respon){
				if(respon.errno == 0){
					$("td.NipCode").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$("td.NipName").empty();
					$("td.NipPass").empty();
					$("tr.find td span").empty();
					//$(".passcode").attr('src',"/index.php/Home/User/verify?r=+Math.random()+"); //刷新验证码
				}else if(respon.errno == -1){
					$("td.NipName").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$("td.NipPass").empty();
					$("td.NipCode").empty();
					$("tr.find td span").empty();
					//$(".passcode").attr('src',"/index.php/Home/User/verify?r=+Math.random()+"); 
				}else if(respon.errno == -2){
					$("td.NipPass").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$("td.NipName").empty();
					$("td.NipCode").empty();
					$("tr.find td span").empty();
					//$(".passcode").attr('src',"/index.php/Home/User/verify?r=+Math.random()+"); 
				}else if(respon.errno == 20001){
					$("tr.find td span").html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
					$("td.NipName").empty();
					$("td.NipPass").empty();
					$("td.NipCode").empty();
					//$(".passcode").attr('src',"/index.php/Home/User/verify?r=+Math.random()+"); 
				}else if(respon.errno == 20000){
					window.location.href="<?php echo U('Home/User/userInfo')?>";
				}
			},dataType:'json'
		});
	});
});
</script> 
      
    </body>
</html>