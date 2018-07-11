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
div.box{width:300px;padding:20px;margin:20px;border:4px dashed #ccc;}
div.box>span{color:#999;font-style:italic;}
div.content{width:250px;margin:10px 0;padding:20px;border:2px solid #ff6666;}
input[type='text']{width:45px;height:35px;padding:5px 10px;margin:5px 0;border:1px solid #ff9966;}
</style> 

<style>
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
                                <li class="nav-item active">
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
        
        <!-- <div class="tm-home-img-container">
            <img src="/Public/Home/index/img/tm-home-img.jpg" alt="Image" class="hidden-lg-up img-fluid">
        </div> -->
        
        <div class="tm-blog-img-container">
            
        </div>

        <section class="tm-section">
            <div class="container-fluid">
              <!-- 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-center">
                        <h2 class="tm-gold-text tm-title">Introduction</h2>
                        <p class="tm-subtitle"></p> -->
                        	<!-- 音乐播放器 
                        	<div class="container">
	  							<h3>Music</h3>
	  							<div id="player1" class="aplayer"></div>
							</div>
							
                    </div>
                </div><br/>
                -->
                
                <div class="row">
                
                	<!-- 文章列表 -->
                	<?php foreach($articleList as $k => $v){ ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">

                        <div class="tm-content-box">
                            <img src="<?php echo $v['img_url']?>" style="width:310px;height:180px;" alt="Image" class="tm-margin-b-20 img-fluid">
                            <h4 class="tm-margin-b-20 tm-gold-text" style="margin-bottom:2px;margin-top:-10px;"><span style="font-size:14px;">标题：</span>
	                            <?php if( mb_strlen($v['title']) <= 30 ){ ?>
	                            	<?php echo $v['title'];?>
	                            <?php }else{ ?>
	                            	<?php echo mb_substr($v['title'],0,6,'UTF-8');?>...
	                            <?php } ?>
                            </h4>
                            <p class="tm-margin-b-20" style="margin-top:0;margin-bottom:0;font-size:14px;"><span style="color:red;">简介：</span><?php echo mb_substr($v['jianjie'],0,9,'UTF-8');?>...</p>
                            <!-- <a href="/Home/Article/detailArti?id=<?php echo $v['id'];?>" class="tm-btn text-uppercase" style="margin-bottom:10px;">点我查看详细内容</a> -->
                            <a href="<?php echo U('Home/Article/detailArti',array('id'=>$v['id']));?>" class="tm-btn text-uppercase" style="margin-bottom:10px;">点我查看详细内容</a>
                            <div style="width:99%;height:1px;margin-left:0.5%;margin-bottom:20px;padding:0px;background-color:#D5D5D5;overflow:hidden;"></div>    
                        </div>  

                    </div>
                    <?php } ?>

                </div> <!-- row -->
                
                <!-- 城市：<input type="text" name="city" id="city"/>
         <input type="button" id="cityButton" value="button"/>
         
         <input type="button" id="btnss" value="免费获取验证码" /> -->

                <div class="row tm-margin-t-big">
                
                	<!-- 首页推荐文章内容展示  只有一篇 -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="tm-2-col-left">
                            
                            
                            <h3 class="tm-gold-text tm-title" style="color:#242424;">经典文章推荐：</h3>
                            <h3 class="tm-gold-text tm-title">
                            	<?php echo $artiRecommend['title'];?>
                            	<span style="font-size:14px;">----<?php echo $artiRecommend['jianjie'];?></span>
                            </h3>
                            <!-- <p class="tm-margin-b-30"></p> -->
                            <!-- <img src="<?php echo $artiRecommend['img_url'];?>" alt="Image" class="tm-margin-b-40 img-fluid"> -->
                            
                            <?php echo $artiRecommend['content'];?>
                            
                            <a href="<?php echo U('Home/Article/listArti')?>" class="tm-btn text-uppercase">Read More</a>

                        </div>
                    </div>
                    <!-- row -->

					
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">

                        <div class="tm-2-col-right">

                            <div class="tm-2-rows-md-swap">
                                <div class="tm-overflow-auto row tm-2-rows-md-down-2">
                                    
                                        <h3 class="tm-gold-text tm-title" style="color:#242424;">
                                            	标准体重计算器:
                                        </h3>                                      
                                        
										<table width="100%" border=1>
										  <tbody>
										    <tr><td style="height:30px" align='middle' bgColor='#66CDAA'><span style="color:#303030;">身高大于100cm的体重自测</span></td></tr>      
											<tr>
												<form>
										  		<td style="padding-right: 0px; padding-left: 30px; padding-bottom: 8px; padding-top: 8px" width="100%" bgColor=#FFFFFF>
										  			 <div style="margin-bottom:10px;color:#55556D;">
											  			 您的身高 <input size='5' name='height' id="height"><span style="color:#242424;">（单位：cm）</span>　　
										  			 </div>
										  			 <div style="margin-bottom:10px;color:#55556D;">
										  			 	您的体重 <input size='5' name='weight' id="weight"><span style="color:#242424;">（单位：kg）</span>
										  			 </div>
										  			 <div style="margin-bottom:10px;color:#55556D;">
										  			 	您的性别 <select style="width:80px;" name='sex' id="sex"> 
										  						<option value='1' selected>男</option> 
										    					<option value='2'>女</option>
										    		  		  </select> 
										  			 </div>
										  			 <div>
										  			 	<span style="margin-left:15%;margin-right:5%;">
										  			 	<input type='button' value='点击重置' name='reset' id="health_reset" style="height:32px;background:#DAA520;">
										    		    </span>
										    		    <input type='button' value='点击测试' name='health_but' id="health_but" style="height:32px;background:#20b2aa;">
										  			 </div>
										  		
										  			<div class="youHealth" style="display:none;padding-top:30px;width:100%">
										  				<div style="width:100%;height:1px;margin-top:-20px;margin-bottom:20px;background-color:#D5D5D5;overflow:hidden;"></div>
											  			<div class="youGoodHealth" style="margin-bottom:10px;color:#55556D;">
												  			 您的理想体重: <input onfocus=blur() size=4 name="loveHeight" id="loveHeight" value=""><span style="color:#242424;">公斤</span>　
											  			</div>
											  			<div class="youGoodHealth" style="margin-bottom:10px;color:#55556D;">
											  				您的BMI指数: <input onfocus=blur() size=4 name="loves" id="loves" value=""><span style="color:#242424;">(20-21为最佳)</span>
											  			</div>
												         
												        <div style="margin-bottom:10px;color:#55556D;">
												       		 您现在的状况: <textarea onfocus=blur() name="nowLovePoint" id="nowLovePoint" cols=30></textarea> 
												        </div>
											        </div>
											          
											   </td>
											   </form>
											</tr>
										  </tbody>
										</table> 
        
                                    
                                </div>
                                                         
                                <!-- 
                                <div class="row tm-2-rows-md-down-1 tm-margin-t-mid">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h3 class="tm-gold-text tm-title tm-margin-b-30">Related User</h3>
                                        <?php foreach($userList as $k => $v){ ?>
                                        <div class="media tm-related-post">
                                          <div class="media-left media-middle">
                                            <a href="/Home/Photo/userPhoto?id=<?php echo $v['id'];?>">
                                              <img class="media-object" style="width:240px;height:120px;" src="<?php echo $v['u_img'];?>" alt="image">
                                            </a>
                                          </div>
                                          <div class="media-body">
                                          <div>
                                           	<h4 class="media-heading tm-gold-text tm-margin-b-15">
                                            	<a href="/Home/Photo/userPhoto?id=<?php echo $v['id'];?>"><?php echo $v['nickname'];?></a>
                                            	<input type="button" onclick="add_message(<?php echo $v['id']?>)" value="给他留言"/>
                                           	</h4>
                                            <p class="tm-small-font tm-media-description"><?php echo $v['u_sign'];?></p>
                                          </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>  
                                 -->
                                 
                                <div class="row tm-2-rows-md-down-1 tm-margin-t-mid">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h3 class="tm-gold-text tm-title tm-margin-b-30">你可能感兴趣的：</h3>
                                        <?php foreach($jokeList as $k => $v){ ?>
                                        <div class="media tm-related-post">
                                          <?php echo $k+1;?>：<?php echo $v['content'];?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>  
                                
                                   
                            </div>

                        </div>
                        
                    </div>
                </div> <!-- row -->
            </div>
        </section>
        
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

<script type="text/javascript">
var wait=60;
function time(o) {
  if (wait == 0) {
   o.removeAttribute("disabled");   
   o.value="免费获取验证码";
   wait = 60;
  } else { 
 
   o.setAttribute("disabled", true);
   o.value="重新发送(" + wait + ")";
   wait--;
   setTimeout(function() {
    time(o)
   },
   1000)
  }
 }
document.getElementById("btnss").onclick=function(){time(this);}
</script>

<!-- 音乐播放插件 -->
<script>
    var ap1 = new APlayer({
        element: document.getElementById('player1'),
        narrow: false,
        autoplay: false,
        showlrc: false,
        music: {
            title: 'Sugar',
            author: 'Maroon 5',
            url: '/third-party/music/music/Sugar.mp3',
            pic: '/third-party/music/music/pf.jpg'
        }
    });
    ap1.init();
	
</script>

<script type="text/javascript">
	
//点击测试按钮
$('#health_but').click(function(){
	var height = $('#height').val();
	var weight = $('#weight').val();
	var sex = $('#sex').val();
	
	//判断输入的正确性
	if(isNaN(height) || isNaN(weight)){	//判断是否是数字   
		$('#nowLovePoint').val('搞个撒子哟,请正确输入你的身高和体重!!!');
		$("#nowLovePoint").css("color","#CD2626");
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','none');
		return false;
	}
	
	if(height == '' || height == null || weight == '' || weight == null){	//身高体重是否为空
		$('#nowLovePoint').val('你以为我真的是神仙吗?你什么都不告诉我,我怎么给你测啊!!!');
		$("#nowLovePoint").css("color","#CD2626");
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','none');
		return false;
	}
	
	if(height >= 300){
		$('#nowLovePoint').val('喔!你好伟大啊!!替我向上帝问好!!!');
		$("#nowLovePoint").css("color","#CD2626");
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','none');
		return false;
	}
	
	if(height < 100){
		$('#nowLovePoint').val('sorry,目前只能测100cm以上的!');
		$("#nowLovePoint").css("color","#CD2626");
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','none');
		return false;
	}
	
	if(weight >= 300){
		$('#nowLovePoint').val('你不用测了,你的体重已经把我的秤压坏了!!');
		$("#nowLovePoint").css("color","#CD2626");
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','none');
		return false;
	}
	
	if(weight <= 0){
		$('#nowLovePoint').val('哇喔,不得鸟了,你轻的连地心引力对你都不起作用了!!');
		$("#nowLovePoint").css("color","#CD2626");
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','none');
		return false;
	}

	if(sex == 1){	//男
		var gb = (height-100)*0.9;	//标准体重
		var lv = (weight-gb)/gb;	//实际体重与标准体重的百分比之差
		if(lv > 0.20){
			$('#nowLovePoint').val('哇!你好胖啊!必须开始减肥了,听我的没错!');
		}else if(lv > 0.10 && lv <= 0.20){
			$('#nowLovePoint').val('哎呀!你可是比较胖啊,赶快开始减肥计划吧!');
		}else if(lv > (-0.10) && lv <= 0.10){
			$('#nowLovePoint').val('男神!你这可是魔鬼身材啊!!!');
		}else if(lv > (-0.20) && lv <= (-0.10)){
			$('#nowLovePoint').val('有点瘦!你应该多吃点东西啊!');
		}else if(lv <= (-0.20)){
			$('#nowLovePoint').val('你实在是太瘦太瘦了!快点大量吃东西吧!');
		}
		$("#nowLovePoint").css("color","#CD5C5C");
		
		$('#loveHeight').val(gb);
		$("#loveHeight").css("color","#CD5C5C");
		
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','block');
	}else{	//女
		var gb = (height-105)*0.92;	//标准体重
		var lv = (weight-gb)/gb;	//实际体重与标准体重的百分比之差
		if(lv > 0.20){
			$('#nowLovePoint').val('哇!你好胖啊!必须开始减肥了,听我的没错!');
		}else if(lv > 0.10 && lv <= 0.20){
			$('#nowLovePoint').val('哎呀!你可是比较胖啊,赶快开始减肥计划吧!');
		}else if(lv > (-0.10) && lv <= 0.10){
			$('#nowLovePoint').val('女神!你这可是魔鬼身材啊!!!');
		}else if(lv > (-0.20) && lv <= (-0.10)){
			$('#nowLovePoint').val('有点瘦!你应该多吃点东西啊!');
		}else if(lv <= (-0.20)){
			$('#nowLovePoint').val('你实在是太瘦太瘦了!快点大量吃东西吧!');
		}
		$("#nowLovePoint").css("color","#CD5C5C");
		
		$('#loveHeight').val(gb);
		$("#loveHeight").css("color","#CD5C5C");
		
		$('.youHealth').css('display','block');
		$('.youGoodHealth').css('display','block');
	}

	//BMI
	var bmi = weight/height/height*100*100;
	bmi = Math.round(bmi*100)/100;
	$('#loves').val(bmi);
	$("#loves").css("color","#CD5C5C");
});


//点击重置
$('#health_reset').click(function(){
	$('#height').val('');
	$('#weight').val('');
	$('.youHealth').css('display','none');
	$('.youGoodHealth').css('display','none');
});
</script>