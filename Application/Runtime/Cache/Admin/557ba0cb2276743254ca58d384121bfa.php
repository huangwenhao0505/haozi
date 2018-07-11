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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?php echo U('Admin/Yulu/yuluList');?>">语录管理</a><span class="crumb-step">&gt;</span><span>新增语录</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>缩略图：</th>
                                <td>
                                	<input type="file" name="img" id="img" onchange="fileImg('images','img')">
                                	<img src="" id="images"/>
                                	<span id="error_img" style="color:red;">没上传图片默认显示的是你的个人头像哟!</span>
                                </td>  
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea></td>
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
<script>
//上传按钮改变时触发  增加用户体验度  实现实时显示选择的图片
function fileImg(imgid,fileid) {
 //imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
    $("#"+imgid).attr("src","");//加载loading图片
    $.ajaxFileUpload({            
     	url: '<?php echo U("Admin/Yulu/uploadImg");?>',
        secureuri: false,
        fileElementId: fileid,  
        dataType: 'json',              
        success: function (data, status){   //data的内容都是在后台php代码中自定义的,json格式返回后在这里以对象的方式的访问
            if(typeof (data.error) != 'undefined'){
            	var error_msg = "";
            	switch(data.error){
	            	case "101": error_msg="文件类型错误";
	            		$('#error_img').html(error_msg);
	                	break;
	            	case "102": error_msg="文件过大";
	            		$('#error_img').html(err_msg);
	                	break;
	            	case "400": error_msg="非法上传";
	            		$('#error_img').html(err_msg);
	                	break;
	            	case "404": error_msg="文件为空";
	            		$('#error_img').html(err_msg);
	                	break;
	            	default :error_msg="服务器不稳定";
	            	$('#error_img').html(err_msg);
            	}
            	//alert(error_msg);
            }else{
            	$('#error_img').empty();
            	$("#"+imgid).attr("src",data.path);//加载返回的图片路径并附加上样式
                //$("#"+hiddenid).val(data.path);//给对应的隐藏域赋值，以便提交时给后台
            }              
        },
    });
}

$('#but').bind().click(function(){
	var content = $('#content').val();
	
	$.ajaxFileUpload({
		type:'post',
		url:'<?php echo U("Admin/Yulu/uploadImg");?>',
	    secureuri: false,
        fileElementId: 'img',  //file标签的id
        dataType: 'json', 
        success:function(data){
        	var img = data.path;
        	$.ajax({
        		type:'post',
        		url:'<?php echo U("Admin/yulu/yuluAdd");?>',
        		data:{'img':img,'content':content},
        		success:function(respon){
        			if(respon.errno == 10001){
        				$('tr td.error span').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
        			}else{
        				window.location.href="<?php echo U('Admin/yulu/yuluList')?>";
        			}
        		},dataType:'json'
        	});
        }
	});
	
});

</script>
</div>
</body>
</html>