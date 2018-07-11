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
                        <li><a href="<?php echo U('Admin/Uploade/addVideo');?>"><i class="icon-font">&#xe017;</i>上传视频</a></li>
                        <li><a href="<?php echo U('Admin/Uploade/fileList');?>"><i class="icon-font">&#xe017;</i>视频列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>爬虫管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/News/index');?>"><i class="icon-font">&#xe017;</i>爬虫列表</a></li>
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
            <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>个人资料信息</span></div>
        </div>
        <div class="result-wrap">

        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1>修改个人信息</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">用户名</label><span class="res-info"><input type="text" name="username" id="username" disabled="true" value="<?php echo $info['username'];?>"/></span>
                    </li>
                    <li>
                        <label class="res-lab">昵称</label><span class="res-info"><input type="text" name="nickname" id="nickname" value="<?php echo $info['nickname'];?>"/></span>
                        <span id="error_nickname" style="color:red;"></span>
                    </li>
                    <li>
                        <label class="res-lab">头像</label><span class="res-info"><input type="file" name="img" id="file_img" onchange="imgUpload('user_img','file_img')" alt="请选择上传图片"/></span>
                        <img src="<?php echo $info['img'];?>" width="100px" height="100px" id="user_img"/>
                        <span id="error_img" style="color:red;"></span>
                    </li>
                    <li>
                    	<input type="button" id="but_sub" style="margin-left:10%;width:200px;background:#0E90D2;" value="修改"/>
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
//上传按钮改变时触发  增加用户体验度  实现实时显示选择的图片
function imgUpload(imgid,fileid) {
 //imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
    $("#"+imgid).attr("src","");//加载loading图片
    $.ajaxFileUpload({            
     	url: '<?php echo U("Admin/Login/uploadImg");?>',
        secureuri: false,
        fileElementId: fileid,  
        dataType: 'json',              
        success: function (data, status){   //data的内容都是在后台php代码中自定义的,json格式返回后在这里以对象的方式的访问
            if(typeof (data.error) != 'undefined'){
            	var error_msg = "";
            	switch(data.error){
	            	case "101": error_msg="文件类型错误";
	            		$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+error_msg);
	                	break;
	            	case "102": error_msg="文件过大";
	            		$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+error_msg);
	                	break;
	            	case "400": error_msg="非法上传";
	            		$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+error_msg);
	                	break;
	            	case "404": error_msg="文件为空";
	            		$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+error_msg);
	                	break;
	            	default :error_msg="服务器不稳定";
	            	$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+error_msg);
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

//点击提交按钮时触发
$('#but_sub').bind().click(function(){
	var nickname = $('#nickname').val();
	
	$.ajaxFileUpload({
		type:'post',
		url:'<?php echo U("Admin/Login/uploadImg");?>',
	    secureuri: false,
        fileElementId: 'file_img',  //file标签的id
        dataType: 'json',  
		success:function(data){
			var img = data.path;	//获取上传的图片路径
			$.ajax({
				type:'post',
				url:'<?php echo U("Admin/Login/changeAdmin");?>',
				data:{'nickname':nickname,'img':img}, 
		        dataType: 'json',
		        success:function(respon){
		        	if(respon.errno == 10001){
						$('#error_sub').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
					}else if(respon.errno == 10002){
						$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
					}else if(respon.errno == 10000){
						$('#error_nickname').empty();
						$('#error_img').empty();
						$('#error_sub').empty();
						setTimeout( "close()",500);	//停留0.5秒，执行close()函数
					}
		        }
			});	
		}
	}); 
})

$(function(){
	close();
});

function close(){
	$.post('<?php echo U("Admin/Login/adminInfoSon")?>',
		function(list){
			var html = "";
			var d = eval("("+list+")");
			if(d != false && d!= null){
				html += '<div class="result-title"><h1>个人基本信息显示</h1></div>';
            	html += '<div class="result-content">';
            	html += '<ul class="sys-info-list">';
            	html += '<li><label class="res-lab">用户名：</label><span class="res-info">'+d.username+'</span></li>';
            	html += '<li><label class="res-lab">昵称：</label><span class="res-info">'+d.nickname+'</span></li>';
            	html += '<li><label class="res-lab">头像：</label><span class="res-info"><img src="'+d.img+'"/></span></li>';
            	html += '</ul>';
            	html += '</div>';
			}else{
				html += '<div class="result-title"><h1>个人基本信息显示</h1></div>';
				html += '<div class="result-content">';
            	html += '<ul class="sys-info-list">';
            	html += '<li><label class="res-lab">哎哟我去~</label><span class="res-info">没有该管理员信息!</span></li>';
            	html += '</ul>';
            	html += '</div>';
			}
			
			$('#adminInfo').html(html);
		}	
	);
}
</script>