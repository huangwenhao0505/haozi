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
	/* 命名盒子“id=divcss5”盒子居中，同时上下外间距为10px;，然后设置对象盒子里img图片圆角50% */
	#divcss5{ margin:10px auto}
	#divcss5 img{ border-radius:50%;height:35px;width:35px;}

	.popUp{position:fixed;width:500px;height:300px;left:40%;top:50%;margin:-80px 0 0 -175px;border:1px solid #000;background:#fff;display:none;z-index: 1000;}
	.popUp_a{background: #61BD1A;color: #fff;padding: 0 10px;line-height: 50px;}
	.popUp_a_l{font-size: 20px;}
	.popUp_a_r{font-size: 20px;}
	.popUp_a_r:hover{cursor: pointer;}
	.popUp_b{padding:20px;margin-left:2%;margin-right:11%;}
	.popUp_c{text-align:center;}
	.popUp_c input{
		width:80px;
		line-height:30px;
		padding-bottom:3px;
		margin-right:20px;
		border:none;
		text-align:center;
		text-decoration: none;
		font-size: 12px;
		font-weight: bold;
		border-radius: 2px;
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
                                    <a href="<?php echo U('Home/Joke/listJoke');?>" class="nav-link">幽默笑话</a>
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

        <div class="tm-blog-img-container">
            
        </div>

        <section class="tm-section">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
                        
                        <!-- start文章内容 -->
                        <div class="tm-blog-post">
                            <h2 class="tm-gold-text" style="padding-left:10%;">
	                            <?php echo $artiList['title'];?>
	                            <span style="font-size:12px;"><?php echo $artiList['jianjie'];?></span>
                            </h2>
                            <p style="margin-left:10%;">
	                            <span style="font-size:12px;color:#A1A1A1;padding-right:2%;">作者：<?php echo $artiList['author'];?></span>
								<span style="font-size:12px;color:#A1A1A1;padding-right:2%;">发布时间：<?php echo $artiList['maketime'];?></span>
								<span style="font-size:12px;color:#A1A1A1;padding-right:2%;">浏览量：<?php echo $artiList['view_count'];?></span>
								<span style="font-size:12px;color:#A1A1A1;padding-right:2%;" id="like_counts">点赞量：<?php echo $artiList['like_count'];?></span>
								<span style="font-size:12px;color:#A1A1A1;padding-right:2%;" id="comment_count">评论量：<?php echo $artiList['comment_count'];?></span>
                            </p>
                            <!-- <img src="<?php echo $artiList['img_url'];?>" alt="Image" class="img-fluid tm-img-post"> -->
                            
                            <?php echo $artiList['content'];?>
                            <span style="margin-left:30%;margin-right:6px;"></span>
                            <!-- <input type="button" class="btn btn-info active" id="user_message" onclick="add_message(<?php echo $artiList['uid'];?>)" value="留言"/> -->
                            <input type="button" class="btn btn-info active" id="user_like" onclick="add_likes(<?php echo $artiList['id'];?>,<?php echo $artiList['like_count']?>)" value="点赞"/>
                            <input type="button" class="btn btn-info active" id="user_comment" style="margin-left:6px;" onclick="add_comment()" value="评论"/>
							<p class="likes_msg_id" style="color:red; font-size:15px; margin-left:45%;"></p>

                        </div>
                        
                        <div style="width:99%;height:1px;margin-left:0.5%;margin-top:20px;margin-bottom:20px;padding:0px;background-color:#D5D5D5;overflow:hidden;"></div>
                        <span style="color:#442D37;">评论列表：</span>
                        <!-- end文章内容 -->
                        
                        <!-- 评论列表 -->
                        <div class="tm-blog-post" id="pingluns"></div>
						<div class="pages"></div>
		
						<input type="hidden" id="curr_page" value="1"/>
						<input type="hidden" id="total_page" value="1"/>
						<input type="hidden" id="artiId" value="<?php echo $artiList['id']?>"/>
                        
                        <!-- end评论列表 -->
                        
                        <div class="row tm-margin-t-big">
                        
                        	<!-- 上一篇下一篇 -->
                            
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                <div class="tm-content-box" style="padding-right:5%;">
                                    	上一篇：
                                    	<?php if($prev != null || $prev != ''){ ?>
                                     		<a href="/index.php/Home/Article/detailArti?id=<?php echo $prev['id'];?>" class=""><?php echo $prev['title'];?></a>    
                                		<?php }else{ ?>
                                			已经是第一篇文章了!
                                		<?php } ?>    
                                </div>  

                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                <div class="tm-content-box" style="float:left;padding-left:5%;">
                                     	下一篇：
                                     	<?php if($next != null || $next != ''){ ?>
                                     		<a href="/index.php/Home/Article/detailArti?id=<?php echo $next['id'];?>" class=""><?php echo $next['title'];?></a>    
                                		<?php }else{ ?>
                                			已经是最后一篇文章了!
                                		<?php } ?>
                                </div>   

                            </div>
                            
                            <!-- end上一篇下一篇 -->

                            <!-- 
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                <div class="tm-content-box">
                                    <img src="/Public/Home/index/img/tm-img-310x180-2.jpg" alt="Image" class="tm-margin-b-30 img-fluid">
                                    <h4 class="tm-margin-b-20 tm-gold-text">Lorem ipsum dolor #2</h4>
                                    <p class="tm-margin-b-20">Aenean cursus tellus mauris, quis
                                    consequat mauris dapibus id. Donec
                                    scelerisque porttitor pharetra</p>
                                    <a href="#" class="tm-btn text-uppercase">Read More</a>    
                                </div>  

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                <div class="tm-content-box">
                                    <img src="/Public/Home/index/img/tm-img-310x180-3.jpg" alt="Image" class="tm-margin-b-30 img-fluid">
                                    <h4 class="tm-margin-b-20 tm-gold-text">Lorem ipsum dolor #3</h4>
                                    <p class="tm-margin-b-20">Aenean cursus tellus mauris, quis
                                    consequat mauris dapibus id. Donec
                                    scelerisque porttitor pharetra</p>
                                    <a href="#" class="tm-btn text-uppercase">Detail</a>    
                                </div>  

                            </div> 
                             -->
                                
                        </div>
                        
                    </div>

					<!-- 右侧部分开始  -->
                    <!-- 
                    <aside class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 tm-aside-r">

                        <div class="tm-aside-container">
                            <h3 class="tm-gold-text tm-title">
                                Categories
                            </h3>
                            <nav>
                                <ul class="nav">
                                    <li><a href="#" class="tm-text-link">Lorem ipsum dolor sit</a></li>
                                    <li><a href="#" class="tm-text-link">Tincidunt non faucibus placerat</a></li>
                                    <li><a href="#" class="tm-text-link">Vestibulum tempor ac lectus</a></li>
                                    <li><a href="#" class="tm-text-link">Elementum egestas dui</a></li>
                                    <li><a href="#" class="tm-text-link">Nam in augue consectetur</a></li>
                                    <li><a href="#" class="tm-text-link">Fusce non turpis euismod</a></li>
                                    <li><a href="#" class="tm-text-link">Text Link Color #006699</a></li>
                                </ul>
                            </nav>
                            <hr class="tm-margin-t-small">   
                            <h3 class="tm-gold-text tm-title tm-margin-t-small">
                                Useful Links
                            </h3>
                            <nav>   
                                <ul class="nav">
                                    <li><a href="#" class="tm-text-link">Suspendisse sed dui nulla</a></li>
                                    <li><a href="#" class="tm-text-link">Lorem ipsum dolor sit</a></li>
                                    <li><a href="#" class="tm-text-link">Duiss nec purus et eros</a></li>
                                    <li><a href="#" class="tm-text-link">Etiam pulvinar et ligula sed</a></li>
                                    <li><a href="#" class="tm-text-link">Proin egestas eu felis et iaculis</a></li>
                                </ul>
                            </nav>   
                            <hr class="tm-margin-t-small"> 

                            <div class="tm-content-box tm-margin-t-small">
                                <a href="#" class="tm-text-link"><h4 class="tm-margin-b-20 tm-thin-font">Duis sit amet tristique #1</h4></a>
                                <p class="tm-margin-b-30">Vestibulum arcu erat, lobortis sit amet tellus ut, semper tristique nibh. Nunc in molestie elit.</p>
                            </div>
                            <hr class="tm-margin-t-small">
                            <div class="tm-content-box tm-margin-t-small">
                                <a href="#" class="tm-text-link"><h4 class="tm-margin-b-20 tm-thin-font">Duis sit amet tristique #2</h4></a>
                                <p>Vestibulum arcu erat, lobortis sit amet tellus ut, semper tristique nibh. Nunc in molestie elit.</p>
                            </div>  
                            <hr class="tm-margin-t-small">
                            <div class="tm-content-box tm-margin-t-small">
                                <a href="#" class="tm-text-link"><h4 class="tm-margin-b-20 tm-thin-font">Duis sit amet tristique #3</h4></a>
                                <p>Vestibulum arcu erat, lobortis sit amet tellus ut, semper tristique nibh. Nunc in molestie elit.</p>
                            </div>      
                        </div>
                        
                        
                    </aside>
                     -->

                </div>
                
            </div>
        </section>      

<!-- 发表评论弹窗   -->
 <div class = 'popUp' id = 'mima'>
	<div class = 'popUp_a clear'>
		<p class = 'popUp_a_l f_l'>请输入您想说的话：</p>
	</div>
	<div class = 'popUp_b'>
		<textarea name="content" id="add_content" cols="15" style="width: 95%;" rows="5"></textarea>
		<span id="error" style="float:right;padding-right:50px;"></span>
	</div>
	<div class= 'popUp_c'>
		<input type="hidden" id="user_article_comment" value=""/>
		<input type="button" class="btn btn-primary" id="quxiao" value="取消"/>
		<input type="button" class="btn btn-success" id="queding" onclick="queding(<?php echo $artiList['comment_count'];?>)" value="确定"/>
	</div>
</div>

<!-- 发表留言start -->
<!-- 发表留言弹窗   -->
<div id="liuyan" style="position:fixed;width:50%;height:50%;left:40%;top:30%;margin:-80px 0 0 -175px;border:1px solid #000;background:#fff;display:none;z-index: 1000;">
	<script type="text/plain" id="message_content" style="width:100%;height:300px;"></script>
	<span id="message_error" style="text-align:center;"></span>
	<div class= 'popUp_c'>
		<input type="hidden" id="uid_message" value=""/>
		<input type="button" class="btn btn-primary" id="quxiao_message" onclick="message_quxiao()" value="取消"/>
		<input type="button" class="btn btn-success" id="queding_message" onclick="message_queding()" value="确定"/>
	</div>
</div>

<script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
<!-- 加载编辑器的容器 -->
 <!-- 配置文件 -->
 <script type="text/javascript" src="/third-party/ueditor/ueditor.config.js"></script>
 <!-- 编辑器源码文件 -->
 <script type="text/javascript" src="/third-party/ueditor/ueditor.all.js"></script>
 <!-- 实例化编辑器 -->
 <script type="text/javascript">
     var ue = UE.getEditor('message_content');
 </script>
<script>
function add_message(uid){
	$('#uid_message').val(uid);	//把被留言人的ID赋值给uid_message
	$("#liuyan").show();
}

function message_queding(){
	var uid = $('#uid_message').val();
	var ue = UE.getEditor('message_content');
	var content = ue.getContent();
	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Message/message");?>',
		data:{'user_id':uid,'content':content},
		dataType:'json',
		success:function(respon){
			if(respon.errno == 10001){
				$('#message_error').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
			}else{
				$('#message_error').html('<img src="/Public/Home/login/images/tip-right.png">'+respon.errmsg);
				$('#quxiao').hide();
				$('#queding').hide();
				setTimeout( "message_quxiao()",1500);	//停留一秒，执行message_quxiao()函数
			}
		}
	});
}

function message_quxiao(){
	$('#liuyan').hide();
}
</script>
<!-- 发表留言end -->      

<script>
/**
 * 无刷新显示评论列表*/
$(function(){
	init();
	do_sub();
});

function init(){
	//点击上一页
	$('#pre_page').unbind('click').click(function(){
		var cur = $('#curr_page').val();
		if( Number(cur) > 1 ){
			$('#curr_page').val( Number(cur)-1 );
			do_sub();
		}
	});
	//点击下一页
	$('#nex_page').unbind('click').click(function(){
		var cur = $('#curr_page').val();
		var tol = $('#total_page').val();
		if( Number(cur) < Number(tol) ){
			$('#curr_page').val( Number(cur)+1 );
			do_sub();
		}
	});
}

function do_sub(){
	var id = $('#artiId').val();
	var currPage = $('#curr_page').val();
	var tiaoPage = $('#tiao_page').val();
	$.post('<?php echo U("Home/Article/ajaxCommentArti");?>',{'id':id,'currPage':currPage,'tiaoPage':tiaoPage},
		function(data){
			var html = '';
			var d = eval("("+data+")");	//解析json数据
			if(d.list != false && d.list != null){	//数据不为空
				for(var o in d.list){	//遍历
                
                	html += '<p style="margin-left:5%;">';
                	html += '<span id="divcss5"><img src="'+d.list[o].u_img+'" alt="头像 "/></span>';
                	html += '<span style="font-size:12px;margin-left:25px;color:#A1A1A1;">'+d.list[o].nickname+'</span>';
                	html += '<span style="font-size:12px;margin-left:25px;color:#A1A1A1;">'+d.list[o].maketime+'</span><br/>';
                	html += '<span style="font-size:12px;margin-left:50px;color:#272226;">'+d.list[o].content+'</span>';
                	/*html += '<input type="button" class="btn btn-info active" style="margin-left:80%;margin-right:6px;" onclick="add_comment('+d.list[o].id+')" value="发表评论"/>';*/
					html += '<span style="margin-left:20%;margin-right:6px;"><a href="javascript:void(0);" onclick="add_comment('+d.list[o].id+')">------评论</a></span>';
                	
					/** 二级评论start **/
					if(d.list[o].twoList != false && d.list[o].twoList != null){
						for(var i in d.list[o].twoList){
							html += '<p style="margin-left:10%">';
							html += '<span id="divcss5"><img src="'+d.list[o].twoList[i].u_img+'" alt="头像 "/></span>';
		                	html += '<span style="font-size:12px;margin-left:25px;color:#A1A1A1;">'+d.list[o].twoList[i].nickname+'</span>';
		                	html += '<span style="font-size:12px;margin-left:25px;color:#A1A1A1;">'+d.list[o].twoList[i].create_date+'</span><br/>';
		                	html += '<span style="font-size:12px;margin-left:50px;color:#272226;">'+d.list[o].twoList[i].content+'</span>';
							html += '</p>';
						}
					}else{
						html += '';
					}
					/** 二级评论end  **/
					
                	html += '</p>';
                	html += '<div style="width:20%;height:1px;margin-left:5%;margin-right:65.5%;margin-top:20px;margin-bottom:20px;padding:0px;background-color:#D5D5D5;overflow:hidden;"></div>';
                	
				}
			
				if(d.total_page == 1){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><li>跳转到<input type="text" id="tiao_page" value=""/>页<input type="button" value="跳转" onclick="do_sub()"/></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==1){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><li>跳转到<input type="text" id="tiao_page" value=""/>页<input type="button" value="跳转" onclick="do_sub()"/></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==d.total_page){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><li>跳转到<input type="text" id="tiao_page" value=""/>页<input type="button" value="跳转" onclick="do_sub()"/></li></ul></nav></td></tr>');
				}else if(d.total_page>=3 && d.currPage>1 && d.currPage<d.total_page){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><li>跳转到<input type="text" id="tiao_page" value=""/>页<input type="button" value="跳转" onclick="do_sub()"/></li></ul></nav></td></tr>');
				}
				
				$("#total_page").val(d.total_page);	//获取总页数（把总页数赋值给total_page）
				
			}else{
				html += '<p style="margin-left:5%;color:#DB7093;">暂无，亲来评论一发呗！</p>';
			}
			
			$('#pingluns').html(html);
			init();
		}		
	);
}

/**
 * 无刷新发表评论*/
function add_comment(id){
	$('#user_article_comment').val(id);	//把评论的ID赋值给user_article_comment
	$('#mima').show();
	//显示确定按钮和取消按钮
	$('#quxiao').show();
	$('#queding').show();
	$('#error').show();
}

$('#quxiao').click(function(){
	$('#mima').hide();
});

function queding(comment_count){
	var counts = parseInt(comment_count) + 1;
	var article_id = $('#artiId').val();
	var content = $('#add_content').val();
	var commentId = $('#user_article_comment').val();
	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Article/addComment");?>',
		data:{'article_id':article_id,'content':content,'commentId':commentId},
		success:function(respon){
			if(respon.errno == 10001){
				$('#error').html('<img src="/Public/Home/login/images/tip-error.png"><font color=red>'+respon.errmsg+'</font>');
			}else if(respon.errno == 10000){
				$('#comment_count').html("评论量："+counts);
				$('#error').show();
				$('#error').html('<img src="/Public/Home/login/images/tip-right.png"><font color=red>'+respon.errmsg+'</font>');
				$('#quxiao').hide();
				$('#queding').hide();
				setTimeout( "close()",1500);	//停留一秒，执行close()函数
			}
		}
	});
}

function close(){
	$('#mima').hide();
	do_sub();
}

/**
 * 点赞*/
function add_likes(id,like_count){
	var count = like_count + 1;
	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Article/addLikes");?>',
		data:{'article_id':id},
		success:function(respon){
			if(respon.errno == 10001){
				$('p.likes_msg_id').html(respon.errmsg);
			}else if(respon.errno == 10000){
				$('p.likes_msg_id').html(respon.errmsg);
				$('#like_counts').html("点赞量："+count);
			}
		},dataType:'json'
	});
}

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