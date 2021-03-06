<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>登录</title>  
    <link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
    <link rel="stylesheet" href="/Public/Admin/css/admin.css">
    <script src="/Public/Admin/js/jquery.js"></script>
</head>
<body>
<div class="bg"></div>
<div class="container">
    <div class="line bouncein">
        <div class="xs6 xm4 xs3-move xm4-move">
            <div style="height:150px;"></div>
            <div class="media media-y margin-big-bottom">           
            </div>         
            <form action="index.html" method="post">
            <div class="panel loginbox">
                <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input input-big" name="name" id="name" placeholder="登录账号" data-validate="required:请填写账号" />
                            <span class="icon icon-user margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input input-big" name="password" id="password" placeholder="登录密码" data-validate="required:请填写密码" />
                            <span class="icon icon-key margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input input-big" name="code" id="code" placeholder="填写右侧的验证码" />
                           <img src="/index.php/Admin/Login/verify" alt="" width="100" height="32" class="passcode" style="height:43px;cursor:pointer;" onclick="this.src=this.src+'?'">                        
                        </div>
                    </div>
                </div>
                <div class="error"><span style="color:red;font-size:18px;margin-left:15px;padding-left:25px;"></span></div>
                <div style="padding:30px;"><input type="button" id="but" class="button button-block bg-main text-big input-big" value="登录"></div>
            </div>
            </form>          
        </div>
    </div>
</div>

<script>
$('#but').bind().click(function(){
	var username = $('#name').val();
	var password = $('#password').val();
	var code = $('#code').val();
	
	$.ajax({
		type:'post',
		url:'<?php echo U("Admin/Login/ajaxLogin");?>',
		data:{'username':username,'password':password,'code':code},
		success:function(respon){
			if(respon.errno == 10001){
				$('div .error span').html(respon.errmsg);
			}else if(respon.errno == 20000){
				window.location.href="<?php echo U('Admin/Index/index')?>";
			}
		},dataType:'json'
	});
});
</script>

</body>
</html>