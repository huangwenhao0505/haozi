<?php if (!defined('THINK_PATH')) exit();?><!-- 引用公共头文件 -->
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <script type="text/javascript" src="/Public/Admin/js/modernizr.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    
    <!-- 图片上传插件 -->
    <script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="<?php echo U('Admin/Index/index')?>" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="<?php echo U('Admin/Index/index');?>">首页</a></li>
                <li><a href="<?php echo U('Home/Index/index');?>" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="<?php echo U('Admin/Login/changeAdmin');?>">管理员</a></li>
                <li><a href="<?php echo U('Admin/Login/changePass');?>">修改密码</a></li>
                <li><a href="javascript:void(0)" id="logout">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Yulu/yuluList');?>"><i class="icon-font">&#xe008;</i>语录管理</a></li>
                        <li><a href="<?php echo U('Admin/Article/listArticle');?>"><i class="icon-font">&#xe005;</i>博文管理</a></li>
                        <li><a href="<?php echo U('Admin/Article/articleCommentList')?>"><i class="icon-font">&#xe012;</i>博文评论管理</a></li>
                        <li><a href="<?php echo U('Admin/Joke/listJoke');?>"><i class="icon-font">&#xe006;</i>幽默笑话管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
<script>
$('#logout').bind().click(function(){
	$.ajax({
		type:'post',
		url:'<?php echo U("Admin/Login/logout");?>',
		success:function(){
			window.location.href="<?php echo U('Admin/Login/ajaxlogin')?>";
		}
	});
});
</script>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>登录密码</span></div>
        </div>
        <div class="result-wrap">

        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1>修改登录密码</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">原密码</label><span class="res-info"><input type="password" name="old_password" id="old_password"/></span>
                        <span id="error_old_password" style="color:red;"></span>
                    </li>
                    <li>
                        <label class="res-lab">新密码</label><span class="res-info"><input type="password" name="new_password" id="new_password"/></span>
                        <span id="error_new_password" style="color:red;"></span>
                    </li>
                    <li>
                        <label class="res-lab">确认密码</label><span class="res-info"><input type="password" name="new_password2" id="new_password2"/></span>
                        <span id="error_new_password2" style="color:red;"></span>
                    </li>
                    <li>
                    	<input type="button" id="but_sub" style="margin-left:9.5%;width:200px;background:#0E90D2;" value="修改"/>
                    	<span id="error_sub" style="color:red;"></span>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="result-wrap" id="adminInfo">
            <div class="result-title">
                <h1>个人基本信息</h1>
            </div>
            
            <!-- ajax动态获取该处内容 -->
            
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>

<script>
$('#but_sub').click(function(){
	var password = $('#old_password').val();
	var newpwd = $('#new_password').val();
	var newpwd2 = $('#new_password2').val();
	$.ajax({
		type:'post',
		url:'<?php echo U("Admin/Login/changePass");?>',
		data:{'password':password,'newpwd':newpwd,'newpwd2':newpwd2},
		success:function(respon){
			if(respon.errno == 10001){
				$('#error_old_password').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
				$('#error_new_password').empty();
				$('#error_new_password2').empty();
			}else if(respon.errno == 10002){
				$('#error_new_password').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
				$('#error_old_password').empty();
				$('#error_new_password2').empty();
			}else if(respon.errno == 10003){
				$('#error_new_password2').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
				$('#error_old_password').empty();
				$('#error_new_password').empty();
			}else if(respon.errno == 10004){
				$('#error_old_password').empty();
				$('#error_new_password').empty();
				$('#error_new_password2').empty();
				$('#error_sub').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
			}else if(respon.errno == 10000){
				$('#error_old_password').empty();
				$('#error_new_password').empty();
				$('#error_new_password2').empty();
				$('#error_sub').html('<img src="/Public/Home/regist/images/success.png"><font color=red>修改成功[1秒后请重新登录]</font>');
				close();
			}
		}
	});
});

function close(){
	window.location.href="<?php echo U('Admin/Login/logOutPass');?>";
}
</script>