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
                <li><a href="javascript:void(0);" id="logout">退出</a></li>
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
                        <li><a href="<?php echo U('Admin/Article/listArticle');?>"><i class="icon-font">&#xe005;</i>文章管理</a></li>
                        <li><a href="<?php echo U('Admin/Article/articleCommentList')?>"><i class="icon-font">&#xe012;</i>文章评论管理</a></li>
                        <li><a href="<?php echo U('Admin/Joke/listJoke');?>"><i class="icon-font">&#xe006;</i>幽默笑话管理</a></li>
                        <li><a href="<?php echo U('Admin/User/userList');?>"><i class="icon-font">&#xe052;</i>人员管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="<?php echo U('Admin/Category/listCategory');?>"><i class="icon-font">&#xe033;</i>类别管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe006;</i>考试系统</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Exam/createExam');?>"><i class="icon-font">&#xe008;</i>创建试卷</a></li>
                    	<li><a href="<?php echo U('Admin/Exam/examList');?>"><i class="icon-font">&#xe052;</i>试卷列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>文件管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Uploade/index');?>"><i class="icon-font">&#xe017;</i>上传文件</a></li>
                        <li><a href="<?php echo U('Admin/Uploade/fileList');?>"><i class="icon-font">&#xe017;</i>文件列表</a></li>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?php echo U('Admin/Exam/createExam');?>">答题系统</a><span class="crumb-step">&gt;</span><span>创建试卷</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th>试卷名称：</th>
                                <td><input type="text" id="title"/></td>
                            </tr>
                            <tr>
                                <th>答题时长（分）：</th>
                                <td><input type="text" id="time"/></td>
                            </tr>
                            <tr>
                                <th>开放答题时间：</th>
                                <td><input type="text" id="startDate"/></td>
                            </tr>
                            <tr>
                                <th>截止答题时间：</th>
                                <td><input type="text" id="endDate"/></td>
                            </tr>
                            <tr>
                                <th>备注：</th>
                                <td><input type="text" id="remake"/></td>
                            </tr>
                            <tr><td colspan="2" class="error" style="font-size:20px;color:red;text-align:center;"><span></span></td></tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" id="but" value="提交" type="button">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>

<script>
$('#but').unbind('click').click(function(){
	var name = $('#title').val();
	var time = $('#time').val();
	var startDate = $('#startDate').val();
	var endDate = $('#endDate').val();
	var remake = $('#remake').val();
	
	$.ajax({
		type:'post',
		url:'<?php echo U("Admin/Exam/createExam");?>',
		data:{'name':name,'time':time,'startDate':startDate,'endDate':endDate,'remake':remake},
		dataType: 'json',
		success:function(respon)
		{
			if(respon.errno == 10001)
			{
				$('.error').html(respon.errmsg);
			}
			else
			{
				window.location.href="<?php echo U('Admin/Exam/examList')?>";
			}
		}
	});
});
</script>