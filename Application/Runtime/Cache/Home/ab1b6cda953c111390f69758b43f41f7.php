<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>致我们终将逝去的青春</title>
    
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="HandheldFriendly" content="true">
	
	<!--
	页面自适应 
	<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">

	<meta name="apple-mobile-web-app-capable" content="yes">
	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<meta name="format-detection" content="telephone=no">
	
	 -->

    <!-- load stylesheets -->
    <link rel="stylesheet" href="">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="/Public/Home/index/css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="/Public/Home/index/css/templatemo-style.css">
    
    <!-- 音乐插件  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/third-party/music/dist/APlayer.min.css">
	<style>
	body{font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;}.container{max-width:32rem;margin-left:auto;margin-right:auto;}h1{font-size:54px;color:#333;margin:30px 0 10px;}h2{font-size:22px;color:#555;}h3{font-size:24px;color:#555;}hr{display:block;width:7rem;height:1px;margin:2.5rem 0;background-color:#eee;border:0;}a{color:#08c;text-decoration:none;}p{font-size:18px;}
	</style>
	<script src="/third-party/music/dist/APlayer.min.js"></script> 

    <!-- load JS files -->
    <script src="/Public/Home/index/js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="/Public/Home/index/js/tether.min.js"></script> <!-- Tether for Bootstrap, http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h --> 
    <script src="/Public/Home/index/js/bootstrap.min.js"></script>                 <!-- Bootstrap (http://v4-alpha.getbootstrap.com/) -->

	<!-- 图片上传插件 -->
    <script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
    
    <!-- 时间日期插件 -->
	<link rel="stylesheet" type="text/css" href="/third-party/date/css/lq.datetimepick.css"/>
	<script src="/Public/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src='/third-party/date/js/selectUi.js' type='text/javascript'></script>
	<script src='/third-party/date/js/lq.datetimepick.js' type='text/javascript'></script>
	
	<!-- 微博登录   -->
	<html xmlns:wb="http://open.weibo.com/wb">
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=2710219093" type="text/javascript" charset="utf-8"></script>

<style>
.am-comment-avatar {
  float: left;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid transparent;
}	
</style>
</head>

    <body>
       
        <div class="tm-header">
            <div class="container-fluid">
                <div class="tm-header-inner">
                    <!-- <a href="#" class="navbar-brand tm-site-name"> -->
						<?php if(empty($_SESSION["id"])) { ?>
							<!-- <span>您还没登录哟😒</span> -->
							<span>
								<a href = "<?php echo U('Home/Login/ajaxLogin');?>" style="color:orange;text-decoration:none;">账号登录</a> | 
								<a href = "<?php echo U('Home/Login/ajaxRegist');?>" style="color:orange;text-decoration:none;">账号注册</a>
								<a href = "<?php echo $qqurl;?>"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/Public/qq_logo_2.png"/></a> 
							</span>

							<!-- <span>
                            	<a href="<?php echo $qqurl;?>"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/Public/qq_logo_2.png"/></a>
							</span> -->
							 
							 <!-- 
							<span>
								<a href="<?=$code_url?>"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/third-party/weibo/loginbtn_03.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a>
							</span>
							 -->
							
						<?php } else { ?>
						
							<span><span style="color:pink;font-weight:bold;">
								<?php if($_SESSION['qq_nickname'] != ''){ ?>
									<img src="<?php echo $_SESSION['qq_img'];?>" class="am-comment-avatar" style="width:30px;height:30px;margin-right:2px;"> 
									<?php echo $_SESSION['qq_nickname'];?>&nbsp;
								<?php }else{ ?>
									<img src="<?php echo $_SESSION['u_img'];?>" class="am-comment-avatar" style="width:30px;height:30px;margin-right:2px;"> 
									<?php echo $_SESSION['username'];?>&nbsp;
								<?php } ?>
							</span>您好</span>
							<span>
								<a href = "<?php echo U('User/userInfo');?>" style="color:orange;text-decoration:none;">会员中心</a> | 
								<a href = "javascript:void(0);" id="loginOut" style="color:orange;text-decoration:none;">安全退出</a>
							</span>
						<?php } ?>                    	
                    <!-- </a> -->
                    
<script>

$('#loginOut').click(function(){
	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Login/ajaxOut");?>',
		success:function(){
			location.replace(location.href);
			//window.location.href="<?php echo U('Home/Index/index')?>";
		}
	});
});
</script>


<style>
<!-- 新增文章样式 -->
.smart-green {
margin-left:auto;
margin-right:auto;

max-width: 500px;
background: #F8F8F8;
padding: 30px 30px 20px 30px;
font: 12px Arial, Helvetica, sans-serif;
color: #666;
border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
}
.smart-green h1 {
font: 24px "Trebuchet MS", Arial, Helvetica, sans-serif;
padding: 20px 0px 20px 40px;
display: block;
margin: -10px -30px 10px -30px;
color: #FFF;
background: #9DC45F;
text-shadow: 1px 1px 1px #949494;
border-radius: 5px 5px 0px 0px;
-webkit-border-radius: 5px 5px 0px 0px;
-moz-border-radius: 5px 5px 0px 0px;
border-bottom:1px solid #89AF4C;

}
.smart-green h1>span {
display: block;
font-size: 11px;
color: #FFF;
}

.smart-green label {
display: block;
margin: 0px 0px 5px;
}
.smart-green label>span {
float: left;
margin-top: 10px;
color: #5E5E5E;
}
.smart-green input[type="text"], .smart-green input[type="email"], .smart-green textarea, .smart-green select {
color: #555;
height: 30px;
line-height:15px;
width: 100%;
padding: 0px 0px 0px 10px;
margin-top: 2px;
border: 1px solid #E5E5E5;
background: #FBFBFB;
outline: 0;
-webkit-box-shadow: inset 1px 1px 2px rgba(238, 238, 238, 0.2);
box-shadow: inset 1px 1px 2px rgba(238, 238, 238, 0.2);
font: normal 14px/14px Arial, Helvetica, sans-serif;
}
.smart-green textarea{
height:100px;
padding-top: 10px;
}
.smart-green select {
background: url('down-arrow.png') no-repeat right, -moz-linear-gradient(top, #FBFBFB 0%, #E9E9E9 100%);
background: url('down-arrow.png') no-repeat right, -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FBFBFB), color-stop(100%,#E9E9E9));
appearance:none;
-webkit-appearance:none;
-moz-appearance: none;
text-indent: 0.01px;
text-overflow: '';
width:100%;
height:30px;
}
.smart-green .button {
background-color: #9DC45F;
border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-border-radius: 5px;
border: none;
padding: 10px 25px 10px 25px;
color: #FFF;
text-shadow: 1px 1px 1px #949494;
}
.smart-green .button:hover {
background-color:#80A24A;
}
</style>

                    <!-- navbar -->
                    <nav class="navbar tm-main-nav">

                        <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                            &#9776;
                        </button>
                        
                        <div class="collapse navbar-toggleable-sm" id="tmNavbar">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Index/index');?>" class="nav-link">首页</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Yulu/yuluList');?>" class="nav-link">精典语录</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?php echo U('Home/joke/listJoke');?>" class="nav-link">幽默笑话</a>
                                </li> -->
                                <li class="nav-item active">
                                    <a href="<?php echo U('Home/Article/listArti');?>" class="nav-link">优美文章</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Photo/index');?>" class="nav-link">相册列表</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Fun/index');?>" class="nav-link">文件列表</a>
                                </li>
                            </ul>                        
                        </div>
                        
                    </nav>  

                </div>                                  
            </div>            
        </div>

        <div class="tm-about-img-container">
            
        </div>

        <section class="tm-section">
            <div class="container-fluid">
            
		<!-- 新增文章的表单   样式就在本页  新增的 -->	
		<form action="" method="post" class="smart-green">
			<h1>新增视频[Add Video]
				<span>请填写所有的内容 [ Please fill in all the content ]</span>
			</h1>
			<label>
				<span>标题 [Title] ：</span> <span id="error_title" style="color:red;padding-left:10px;"></span>
				<input id="title" type="text" name="title" placeholder="标题请在15字以内 [ The title is within 15 words ]" />
			</label>
			
			<label>
				<span>简介 [ The Brief Introduction ] ：</span> <span id="error_jianjie" style="color:red;padding-left:10px;"></span>
				<input id="jianjie" type="text" name="jianjie" placeholder="简介请在50字以内 [ Please in 50 words ]" />
			</label>
			
			<label>
				<span style="margin-right:20px;">封面图 [ Cover Image ] ：</span>
				<img class="load0" name="img1" id="img1" src=""/> 
				<input style="padding-top:10px;" id="image" type="file" name="image" onchange="uploadimg('img1','image')" placeholder="请上传封面图,用于在列表展示" />
	            <span id="error_img" style="font-size:20px;color:red;"></span>
			</label>
			
			<label style="padding-top:10px;">
				<span>选择视频 ：</span>
				<input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
			</label>

			<label>
				<input type="button" id="but" class="button" value="Send" />
				<span id="error" style="color:red;"></span>
			</label>
		</form>

            </div>
        </section>


        
<script src="/Public/jquery-1.8.3.min.js"></script>
<!-- 上传图片插件 -->
<script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
<!-- 加载编辑器的容器 -->
 <!-- 配置文件 -->
 <script type="text/javascript" src="/third-party/ueditor/ueditor.config.js"></script>
 <!-- 编辑器源码文件 -->
 <script type="text/javascript" src="/third-party/ueditor/ueditor.all.js"></script>
 <!-- 实例化编辑器 -->
 <script type="text/javascript">
     var ue = UE.getEditor('content');
 </script>

<script>
//上传按钮改变时触发  增加用户体验度  实现实时显示选择的图片
function uploadimg(imgid,fileid) {
 //imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
    $("#"+imgid).attr("src","");//加载loading图片
    $.ajaxFileUpload({            
     	url: '<?php echo U("Home/Article/artiPosterImg");?>',
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
	            		$('#error_img').html(error_msg);
	                	break;
	            	case "400": error_msg="非法上传";
	            		$('#error_img').html(error_msg);
	                	break;
	            	case "404": error_msg="文件为空";
	            		$('#error_img').html(error_msg);
	                	break;
	            	default :error_msg="服务器不稳定";
	            	$('#error_img').html(error_msg);
            	}
            	//alert(error_msg);
            }else{
            	$('#error_img').empty();
            	$("#"+imgid).attr("src",data.path);//加载返回的图片路径并附加上样式
            	$("#"+imgid).css({"width":"150px","height":"150px"});
                //$("#"+hiddenid).val(data.path);//给对应的隐藏域赋值，以便提交时给后台
            }              
        },
    });
}

//点击提交按钮时触发
$('#but').bind().click(function(){
	
	$.ajaxFileUpload({
		type:'post',
		url:'<?php echo U("Home/Article/artiPosterImg");?>',
	    secureuri: false,
        fileElementId: 'image',  //file标签的id
        dataType: 'json',  
		success:function(data){
			var img_url = data.path;	//获取上传的图片路径
			var title = $('#title').val();
			var jianjie = $('#jianjie').val();
			//var content = $('#content').val();
			var ue = UE.getEditor('content');
			var content = ue.getContent();
			$.ajax({
				type:'post',
				url:'<?php echo U("Home/Article/addArticle");?>',
				data:{'title':title,'jianjie':jianjie,'editorValue':content,'img_url':img_url},
				dataType: 'json',
				success:function(respon){
					if(respon.errno == 10001){
						$('label #error_title').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('label #error').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_jianjie').empty();
						$('#error_content').empty();
						$('#error_img').empty();
					}else if(respon.errno == 10002){
						$('#error_jianjie').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('label #error').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_title').empty();
						$('#error_content').empty();
						$('#error_img').empty();
					}else if(respon.errno == 10003){
						$('#error_content').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('label #error').empty();
						$('#error_title').empty();
						$('#error_jianjie').empty();
						$('#error_img').empty();
					}else if(respon.errno == 10005){
						$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('label #error').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_content').empty();
						$('#error_title').empty();
						$('#error_jianjie').empty();
					}else if(respon.errno == 10004 || respon.errno == 10008 || respon.errno == 20001){
						$('label #error').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
					}else if(respon.errno == 10000){
						window.location.href="<?php echo U('Home/Article/listArti')?>";
					}
				}
			});	
		}
	}); 
})	
</script>
        
        <footer class="tm-footer">
            <div class="container-fluid">
                <div class="row">
                    
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="tm-footer-content-box">
                            <h3 class="tm-gold-text tm-title tm-footer-content-box-title"></h3>
                            <div class="tm-gray-bg">
                                <p>Address:湖北省仙桃市陈场镇幼松村八组</p>
                                <p>E-mail:haozi_0505@sina.com / 1165092460@qq.com</p>
                                <p><strong>Danny Egg (Executive)</strong></p>    
                            </div>    
                        </div>
                                                
                    </div>
                     -->

                </div>

                <div class="row">
                    <div class="col-xs-12 tm-copyright-col">
                        <p class="tm-copyright-text" style="font-size:15px;">Address：湖北省仙桃市陈场镇幼松村八组.  <!-- <span style="padding-left:10px;">E-mail：haozi_0505@sina.com / 1165092460@qq.com</span> -->  <span>Copyright © 2017-2018 黄文豪  版权所有.</span></p>
                    </div>
                </div>
            </div>
        </footer>

</body>
</html>