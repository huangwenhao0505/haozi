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


<!-- 相册列表显示样式   -->
<link rel="stylesheet" type="text/css" href="/third-party/photo2/css/style.css">

<!-- 多图上传插件 -->
<link href="/third-party/diyupload/css/webuploader.css" rel="stylesheet"><!-- 多图上传必须样式 -->
<link href="/third-party/diyupload/css/diyUpload.css" rel="stylesheet"><!-- 多图上传必须样式 -->

<script src="/third-party/diyupload/js/jquery-2.1.4.min.js"></script><!-- 必须jq -->
<script src="/third-party/diyupload/js/webuploader.html5only.min.js"></script><!-- 多图上传必须的js -->
<script src="/third-party/diyupload/js/diyUpload.js"></script><!-- 多图上传必须的js -->
            
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
                                    <a href="<?php echo U('Home/Joke/listJoke');?>" class="nav-link">幽默笑话</a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Article/listArti');?>" class="nav-link">优美文章</a>
                                </li>
                                <li class="nav-item  active">
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
        
        <div class="tm-about-img-container"></div>
	
		<ul>
			<li><input type="button" class="btn btn-info" id="user_comment" style="margin-left:70%;margin-right:6px;margin-top:20px;" onclick="add_comment()" value="点我上传你的个性照片"/></li>
		</ul>
		<p>
			测试浏览器兼容：ie9+,chrome,FF,safari;
		</p>
		<ul class="polaroids" style="margin:auto;">
			<?php if($photoList == array()){?>
				<input type="button" class="btn btn-info" onclick="add_comment()" value="暂无数据，亲来上传靓照呗..."/>
			<?php }else{ ?>
				<?php foreach($photoList as $k => $v){ ?>
					<li><a href="/index.php/Home/Photo/userPhoto?id=<?php echo $v['uid'];?>" title="<?php echo $v['nickname'];?>"><img src="<?php echo $v['img'];?>" alt="Roeland!"></a></li>
				<?php } ?>	
			<?php } ?>
			
		</ul>
		<ul class="polaroids" style="width:280px;">
			<li><a href="javascript:void(0);" title="Hello"><img src="/third-party/photo2/images/image-04.jpg" alt="Roeland!"></a></li>
			<li><a href="javascript:void(0);" title="My"><img src="/third-party/photo2/images/image-05.jpg" alt="Discussion"></a></li>
			<li class="messy"><a href="javascript:void(0);" title="Friend"><img src="/third-party/photo2/images/image-06.jpg" alt="A Hearty Laugh"></a></li>
		</ul>
		
	</body>
</html>

<script type="text/javascript">
function add_comment(){
	window.location.href="<?php echo U('Home/Photo/addUserPhoto');?>";
}
</script>