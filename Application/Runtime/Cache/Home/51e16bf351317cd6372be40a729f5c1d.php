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
    *, *:before, *:after {
        box-sizing: border-box;
    }
    #chat,#weather {
        margin: 20px auto;
        width: 90%;
    	height: 400px;
    	background: #f5f5f5 url('/Public/bg.jpg') no-repeat center;
    }
    
div.boxxx{width:90%;padding:20px;margin:20px;border:4px dashed #ccc;}
div.boxxx>span{color:#999;font-style:italic;}
/*div.content{width:340px;margin:10px 10px;padding:20px;border:2px solid #ff6666;}*/
.boxxtext{width:61px;height:35px;padding:5px 10px;margin:5px 0;border:1px solid #ff9966;}
.boxsstext{width:61px;height:35px;padding:5px 10px;margin:5px 0;border:1px solid #ff9966;}

/* 点击样式 */
.alist a{color:#333;text-decoration:none;}
.alist a:hover{color:#CC3300;text-decoration:underline;}
.alist a:visited {color:red;font-weight:bold;text-decoration:underline;}

/* 按钮样式 */
.boxbutton{border:1px solid #48DGCG ; background-color:#48D1CC; width:80%; text-align:center;margin-left:10%}

.tm-text-link a:visited{color:red;font-weight:bold;text-decoration:underline;}
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
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Article/listArti');?>" class="nav-link">优美文章</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Photo/index');?>" class="nav-link">相册列表</a>
                                </li>
                                <li class="nav-item active">
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
                        <div class="tm-blog-post">
                        
                        	<!-- 微信公众号 -->
                        	<div class="weixin">
                        		<div>
		                            <h3 class="tm-gold-text">亲，扫一扫下面的二维码，关注微信公众号:</h3>
	                     		</div>
	                     		
	                     		<img src="/Public/code/wxcode.jpg"/>
                        	</div>
                        	<!-- end微信公众号 -->
                        	
                        	<!-- 文件 -->
                        	<div class="uploadFile">
                        		<!-- 搜索 -->
					            <div class="fileSuffixList"></div>
						        
						        <!-- 文件列表 -->
						        <div class="fileList"></div>
						        
						        <!-- 分页 -->
						        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pages"></div>
						        <input type="hidden" id="curr_page" value="1"/>
				   				<input type="hidden" id="total_page" value="1"/>
                        	</div>
                        	<!-- end文件 -->
                            
                            <input type="hidden" id="userimgs" value="<?php echo $userInfo['u_img'];?>"/>
                            <!-- 图灵机器人 -->
                            <div class="tuling" style="display:none;">
                            	
                            	<div>
		                            <h3 class="tm-gold-text">智能聊天机器人:</h3>
		                            <p style="font-size:14px;">聊天  笑话  图片  天气  问答  百科  故事  新闻  菜谱  星座  凶吉  计算  快递  飞机  列车  成语接龙...</p>
	                     		</div>
	                     		
	                            <div id="chat" style="overflow-y:auto;">
									<div id="chatContent"><!-- ajax动态添加聊天内容 --></div>
								</div>
								<form>
								<!-- <input type="button" onclick="clears()" value="清空聊天记录"/> -->   
								<span style="margin-left:55%">Say:<input type="text" id="info" /> <input type="button" id="jqrBut" value="发送"/></span>  
								</form>
							</div> 
                            <!-- END图灵机器人 -->
                            
                            <!-- 标准体重计算器 -->
                            <div class="health" style="display:none;">
                            	<h3 class="tm-gold-text tm-title" style="color:#242424;">标准体重计算器:</h3>                                         
								<table width="100%" border=1>
								  <tbody>
								    <tr><td style="height:30px" align='middle' bgColor='#66CDAA'><span style="color:#303030;">身高大于100cm的体重自测</span></td></tr>      
									<tr>
										<form>
								  		<td style="padding-right: 0px; padding-left: 30px; padding-bottom: 8px; padding-top: 8px" width="100%" bgColor=#FFFFFF>
								  			 <div style="margin-bottom:10px;color:#55556D;">
									  			 您的身高 <input size='4' name='height' id="height"><span style="color:#242424;"> (单位：cm)</span>　　
								  			 </div>
								  			 <div style="margin-bottom:10px;color:#55556D;">
								  			 	您的体重 <input size='4' name='weight' id="weight"><span style="color:#242424;"> (单位：kg)</span>
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
                            <!-- END标准体重计算器 -->
                            
                            <!-- 音乐 -->
                            <div class="music" style="display:none">
	                            <!-- 音乐播放器 -->
	                        	<div class="container">
		  							<h3>Music</h3>
		  							<div id="player1" class="aplayer"></div>
								</div>
								
								<!-- 音乐播放器 -->
	                        	<!-- <div class="container">
		  							<h3>Music</h3>
		  							<div id="player2" class="aplayer"></div>
								</div> -->
								
								<!-- 音乐播放器 -->
	                        	<!-- <div class="container">
		  							<h3>Music</h3>
		  							<div id="player3" class="aplayer"></div>
								</div> -->
							
                            </div>
                            <!-- END音乐 -->
                            
                            <!-- 天气查询 -->
                            <div class="weather" style="display:none;">
                            	<h3 class="tm-gold-text" style="color:#242424;padding-left:5%;">城市天气查询（输入城市名：仙桃）</h3>
	                            <div id="weather" style="overflow-y:auto;">
									<div id="weatherContent"><!-- ajax动态添加内容 --></div>
								</div>
								<form>   
								<span style="margin-left:55%">Say:<input type="text" size="30" id="city" /> <input type="button" id="cityButton" value="查询"/></span>  
								</form>
                            </div>
                            <!-- END天气查询 -->
                            
                            <!-- 节日倒计时查询 -->
                            <div class="holiday" style="display:none;">
                            	<div class="boxxx">
									<span style="padding-left:10px;">距离2018年春节还剩：</span>
									<div class="content">
										<input type="text" class="boxxtext" id="time_d">天
										<input type="text" class="boxxtext" id="time_h">时
										<input type="text" class="boxxtext" id="time_m">分
										<input type="text" class="boxxtext" id="time_s">秒
									</div>
								</div>
								
								<div class="boxxx">
									<span style="padding-left:10px;">请输入您要查询的日期：</span><br/>
									<span style="padding-left:10px;">
										<input type="text" id="yearss" class="boxsstext"/>年
										<input type="text" id="monthss" class="boxsstext"/>月
										<input type="text" id="dayss" class="boxsstext"/>日
										
									</span>
									<span>
										<input type="button" class="boxbutton" onclick="timess_but()" value="查询"/>
									</span>
									<div class="content" id="contentss" style="display:none;">
										<input type="text" class="boxxtext" id="timess_d">天
										<input type="text" class="boxxtext" id="timess_h">时
										<input type="text" class="boxxtext" id="timess_m">分
										<input type="text" class="boxxtext" id="timess_s">秒
									</div>
									<div class="content" id="contentsserror" style="display:none;">
										<span></span>
									</div>
								</div>
                            </div>
                            <!-- END节日倒计时查询 -->
                            
                        </div>
                        
                        <!-- 
                        <div class="row tm-margin-t-big">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                <div class="tm-content-box">
                                    <img src="img/tm-img-310x180-1.jpg" alt="Image" class="tm-margin-b-30 img-fluid">
                                    <h4 class="tm-margin-b-20 tm-gold-text">Lorem ipsum dolor #1</h4>
                                    <p class="tm-margin-b-20">Aenean cursus tellus mauris, quis
                                    consequat mauris dapibus id. Donec
                                    scelerisque porttitor pharetra</p>
                                    <a href="#" class="tm-btn text-uppercase">Detail</a>    
                                </div>  

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                <div class="tm-content-box">
                                    <img src="img/tm-img-310x180-2.jpg" alt="Image" class="tm-margin-b-30 img-fluid">
                                    <h4 class="tm-margin-b-20 tm-gold-text">Lorem ipsum dolor #2</h4>
                                    <p class="tm-margin-b-20">Aenean cursus tellus mauris, quis
                                    consequat mauris dapibus id. Donec
                                    scelerisque porttitor pharetra</p>
                                    <a href="#" class="tm-btn text-uppercase">Read More</a>    
                                </div>  

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                <div class="tm-content-box">
                                    <img src="img/tm-img-310x180-3.jpg" alt="Image" class="tm-margin-b-30 img-fluid">
                                    <h4 class="tm-margin-b-20 tm-gold-text">Lorem ipsum dolor #3</h4>
                                    <p class="tm-margin-b-20">Aenean cursus tellus mauris, quis
                                    consequat mauris dapibus id. Donec
                                    scelerisque porttitor pharetra</p>
                                    <a href="#" class="tm-btn text-uppercase">Detail</a>    
                                </div>  

                            </div>    
                        </div>
                         -->
                        
                    </div>

                    <aside class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 tm-aside-r">

                        <div class="tm-aside-container">
                            <h3 class="tm-gold-text tm-title">
                                Categories
                            </h3>
                            <nav>
                                <ul class="nav alist">
                                	<li><a href="javascript:void(0);" class="tm-text-link" onclick="do_sub()">文件列表</a></li>
                                	<li><a href="javascript:void(0);" class="tm-text-link" onclick="weixin()">微信公众号</a></li>
                                    <!-- <li><a href="javascript:void(0);" class="tm-text-link" onclick="tuling()">聊天解闷</a></li> -->
                                    <!-- <li><a href="javascript:void(0);" class="tm-text-link" onclick="health()">标准体重计算器</a></li> -->
                                    <!-- <li><a href="javascript:void(0);" class="tm-text-link" onclick="music()">音乐欣赏</a></li> -->
                                    <li><a href="javascript:void(0);" class="tm-text-link" onclick="weather()">城市天气查询</a></li>
                                    <!-- <li><a href="javascript:void(0);" class="tm-text-link" onclick="holiday()">节日倒记时查询</a></li> -->
                                </ul>
                            </nav>    
                        </div>
                    </aside>
                </div>
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

<script>
$(function(){
	do_sub();
});

function weixin(){
	$('.weixin').css('display','block');
	$('.uploadFile').css('display','none');
	$('.tuling').css('display','none');
	$('.health').css('display','none');
	$('.music').css('display','none');
	$('.weather').css('display','none');
	$('.holiday').css('display','none');
}

function init(){
	//点击搜索
	$('#fileSub').unbind('click').click(function(){
		do_sub();
	});
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
	//搜索条件发生改变
	$('#fileSuffixId').unbind('change').change(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
}

function do_sub(){
	$('.weixin').css('display','none');
	$('.tuling').css('display','none');
	$('.health').css('display','none');
	$('.music').css('display','none');
	$('.weather').css('display','none');
	$('.holiday').css('display','none');
	
	var fileCate = $('#fileSuffixId').val();
	var currPage = $('#curr_page').val();
	var tiaoPage = $('#tiao_page').val();
	$.post('<?php echo U("Home/Fun/fileList");?>',{'fileCate':fileCate,'currPage':currPage,'tiaoPage':tiaoPage},function(data){
		var d = eval("("+data+")");
		
		/** 文件类型分类 **/
		var hh = '';
		if(d.list.filecategorylist != false && d.list.filecategorylist != null)
		{
			hh += '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">'
			hh += '<th width="70">文件类型：</th>';
			hh += '<select id="fileSuffixId" style="marign-right:10px;">';
			hh += '<option value="">请选择类型</option>';
			for(var i in d.list.filecategorylist)
			{
				hh += '<option value="'+d.list.filecategorylist[i].filesuffix+'">'+d.list.filecategorylist[i].filesuffix+'</option>';
			}
			hh += '</select>'; 
			hh += '<button class="btn btn-small btn-primary" id="fileSub" style="margin-left:2%;">点击查询</button>';
        	hh += '<div style="width:99%;height:1px;margin-left:0.5%;margin-bottom:20px;margin-top:2px;padding:0px;background-color:#D5D5D5;overflow:hidden;"></div>';
			hh += '</div>';
        	
        	$('.fileSuffixList').html(hh);
		}
		
		/** 文件列表 **/
		var html = '';
		if(d.list.filelist != false && d.list.filelist != null)
		{
			for(var o in d.list.filelist)
			{
				html += '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">';
				html += '<div class="tm-content-box">';
				html += '<span style="font-size:12px;">'+d.list.filelist[o].nickname+'  '+d.list.filelist[o].createdate+'上传</span>';
				html += '<p class="tm-margin-b-20 tm-gold-text"><a href="/index.php/Home/Fun/document?id='+d.list.filelist[o].id+'">'+d.list.filelist[o].filename+'</a></p>';
				html += '<div style="width:99%;height:1px;margin-left:0.5%;margin-bottom:20px;padding:0px;background-color:#D5D5D5;overflow:hidden;"></div>';
				html += '</div>';
				html += '</div>';
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
			$("#total_page").val(d.total_page);	//获取总页数
		}
		else
		{
			html += '<div style="text-align:center;">暂无数据</div>';
		}
		
		$('.fileList').html(html);
		init();
	});
	
	$('.uploadFile').css('display','block');
}

function tuling(){
	$('.tuling').css('display','block');
	$('.weixin').css('display','none');
	$('.uploadFile').css('display','none');
	$('.health').css('display','none');
	$('.music').css('display','none');
	$('.weather').css('display','none');
	$('.holiday').css('display','none');
	
	$(document).keydown(function(event){
		if(event.keyCode == 13){
			$("#jqrBut").click();
		}
	});
	
	$('#jqrBut').click(function(){
		var info = $('#info').val();	//输入的聊天内容
		var userimgs = $('#userimgs').val();
		$.ajax({
			type:'post',
			url:'<?php echo U("Home/Fun/tuling");?>',
			data:{'info':info},
			
			success:function(list){
				if(list.errno == 10001){
					$('#chatContent').html("<div style='font-size:20px;padding-top:20%;padding-left:40%;'>"+list.errmsg+"</div>");
					return false;
				}
				
				var jqrurl = "/Public/tuling.png";	//图灵头像
				var d = eval('('+list+')');	//解析json数据
				if(d.code == 100000){
					
					$('#chatContent').before("<img src="+userimgs+" style='width:50px;height:50px;float:right;padding:5px 5px 0 0;'>");
					$('#chatContent').before("<span style='float:right;padding:10px 5px 0 0;'>"+info+"</span><br/>");
					
					$('#chatContent').before("<img src="+jqrurl+" style='width:50px;height:50px;margin-left:5px;'>");
					$('#chatContent').before("<span style='padding:0 5px 0 8px;'>"+d.text+"</span><br/>");
				}else if(d.code == 200000){	//链接类
					
					$('#chatContent').before("<img src="+userimgs+" style='width:50px;height:50px;float:right;padding:5px 5px 0 0;'>");
					$('#chatContent').before("<span style='float:right;padding:10px 5px 0 0;'>"+info+"</span><br/>");
					
					$('#chatContent').before("<img src="+jqrurl+" style='width:50px;height:50px;margin-left:5px;'>");
					$('#chatContent').before("<span style='padding:0 5px 0 8px;'>"+d.text+"</span><a href="+d.url+" target='_blank'>点此链接跳转</a><br/>");
				}else if(d.code == 302000){	//新闻类
					
					$('#chatContent').before("<img src="+userimgs+" style='width:50px;height:50px;float:right;padding:5px 5px 0 0;'>");
					$('#chatContent').before("<span style='float:right;padding:10px 5px 0 0;'>"+info+"</span><br/>");
					
					$('#chatContent').before("<img src="+jqrurl+" style='width:50px;height:50px;margin-left:5px;'>");
					for(var o in d.list){
						$('#chatContent').before("<span style='padding:0 5px 0 8px;'>"+d.list[o].article+"</span>");
						$('#chatContent').before("<span style='padding:0 5px 0 5px;font-size:12px;'>"+d.list[o].source+"</span>");
						$('#chatContent').before("<a href="+d.list[o].detailurl+" target='_blank'>点此链接查看新闻内容</a><br/>");
					}
				}else if(d.code == 308000){	//菜谱类
					
				}else if(d.code == 40001 || d.code == 40002 || d.code == 40004 || d.code == 40007){	//异常类
					$('#chatContent').before("<img src="+userimgs+" style='width:50px;height:50px;float:right;padding:5px 5px 0 0;'>");
					$('#chatContent').before("<span style='float:right;padding:10px 5px 0 0;'>"+info+"</span><br/>");
					
					$('#chatContent').before("<img src="+jqrurl+" style='width:50px;height:50px;margin-left:5px;'>");
					$('#chatContent').before("<span style='padding:0 5px 0 8px;'>"+d.text+"</span><br/>");
				}
				
			}
		});
	});	
}

function clears(){
	//清空聊天记录

}
</script>

<script type="text/javascript">
function health(){
	$('.health').css('display','block');
	$('.weixin').css('display','none');
	$('.uploadFile').css('display','none');
	$('.tuling').css('display','none');
	$('.music').css('display','none');
	$('.weather').css('display','none');
	$('.holiday').css('display','none');
	
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
}

//点击重置
$('#health_reset').click(function(){
	$('#height').val('');
	$('#weight').val('');
	$('.youHealth').css('display','none');
	$('.youGoodHealth').css('display','none');
});
</script>

<script>
function music(){
	$('.music').css('display','block');
	$('.weixin').css('display','none');
	$('.uploadFile').css('display','none');
	$('.tuling').css('display','none');
	$('.health').css('display','none');
	$('.weather').css('display','none');
	$('.holiday').css('display','none');
	
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
    
    var ap2 = new APlayer({
        element: document.getElementById('player2'),
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
    ap2.init();
	
    var ap3 = new APlayer({
        element: document.getElementById('player3'),
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
    ap3.init();
}
</script>

<script>
function weather(){
	$('.weather').css('display','block');
	$('.weixin').css('display','none');
	$('.uploadFile').css('display','none');
	$('.tuling').css('display','none');
	$('.health').css('display','none');
	$('.music').css('display','none');
	$('.holiday').css('display','none');
	
	$('#cityButton').click(function(){
		var city = $('#city').val();
		$.post('<?php echo U("Home/Fun/weather");?>',{'city':city},
			function(data){
				var d = eval("("+data+")");
				var html = '';
				var status = d.HeWeather5[0].status;
				if(status !== 'ok'){
					html += '<div style="font-size:20px;padding-top:20%;padding-left:30%;">抱歉，暂时只支持中国地区的城市天气查询！</div>';
				}else{
					var city = d.HeWeather5[0].basic.city;
					html += '<div style="width:90%;height:60px;padding:20px 0 20px 0;text-align:center;">';
					html += '<p style="font-size:18px;font-weight:bold;">城市：'+city+'</p>';
					html += '</div>';
					
					var dates;
					var txtd;
					var png;
					var url;
					var tmp_min;
					var tmp_max;
					for(var o in d.HeWeather5[0].daily_forecast){
						dates = d.HeWeather5[0].daily_forecast[o].date;	//日期
						txtd = d.HeWeather5[0].daily_forecast[o].cond.txt_d;	//天气
						png = d.HeWeather5[0].daily_forecast[o].cond.code_d+".png";	//天气状态码转变为相应的图片
						
						url = "/Public/weather/"+png;	//完整的图片路径
						tmp_min = d.HeWeather5[0].daily_forecast[o].tmp.min;	//最低气温
						tmp_max = d.HeWeather5[0].daily_forecast[o].tmp.max;	//最高气温
						
						html += '<div class="weathers" style="width:30%;height:300px;float:left;padding:20px 0 0 20px;text-align:center;">';
						html += '<p>日期：'+dates+'</p>';
						html += '<p>'+txtd+'<img src='+url+'></p>';
						html += '<p>最低温度：'+tmp_min+'</p>';
						html += '<p>最高温度：'+tmp_max+'</p>';
						html += '</div>';
					}
				}
				
				$('#weatherContent').html(html);
			},	
		);
	});
}
</script>

<script>
function holiday(){
	$('.holiday').css('display','block');
	$('.weixin').css('display','none');
	$('.uploadFile').css('display','none');
	$('.tuling').css('display','none');
	$('.health').css('display','none');
	$('.music').css('display','none');
	$('.weather').css('display','none');
	show_time();
}

function show_time(){ 
    var time_start = new Date().getTime(); //设定当前时间
    var time_end =  new Date("2018/2/16 00:00:00").getTime(); //设定目标时间
    // 计算时间差 
    var time_distance = time_end - time_start; 
    // 天
    var int_day = Math.floor(time_distance/86400000) 
    time_distance -= int_day * 86400000; 
    // 时
    var int_hour = Math.floor(time_distance/3600000) 
    time_distance -= int_hour * 3600000; 
    // 分
    var int_minute = Math.floor(time_distance/60000) 
    time_distance -= int_minute * 60000; 
    // 秒 
    var int_second = Math.floor(time_distance/1000)
      
    // 时分秒为单数时、前面加零 
    if(int_day < 10){ 
        int_day = "0" + int_day; 
    } 
    if(int_hour < 10){ 
        int_hour = "0" + int_hour; 
    } 
    if(int_minute < 10){ 
        int_minute = "0" + int_minute; 
    } 
    if(int_second < 10){
        int_second = "0" + int_second; 
    } 
    // 显示时间 
    $("#time_d").val(int_day); 
    $("#time_h").val(int_hour); 
    $("#time_m").val(int_minute); 
    $("#time_s").val(int_second);
    // 设置定时器
    setTimeout("show_time()",1000); 
}

//查询日期倒计时
function timess_but(){
	var year = $('#yearss').val();
	var month = $('#monthss').val();
	var day = $('#dayss').val();
	
	var oDate = new Date(); //实例一个时间对象；
	var oyear = oDate.getFullYear();   //获取系统的年；
	
	if(year == '' || month == '' || day == ''){
		errorDisplay();
		$('#contentsserror').html('请输入完整的日期！');
		return false;
	}
	
	if(Math.floor(year) != year){
		errorDisplay();
		$('#contentsserror').html('请输入正确的年份！');
		return false;
	}
	
	if(Math.floor(month) != month){
		errorDisplay();
		$('#contentsserror').html('请输入正确的月份！');
		return false;
	}
	
	if(Math.floor(day) != day){
		errorDisplay();
		$('#contentsserror').html('请输入正确的日期！');
		return false;
	}
	
	if(year < oyear){
		errorDisplay();
		$('#contentsserror').html('您输入的年代已成历史，请输入 >= 今年的日期！');
		return false;
	}
	
	var s = oyear+2;
	if(year > s){
		errorDisplay();
		$('#contentsserror').html('您输入的年代还太遥远，请输入现在到后两年之内的日期！');
		return false;
	}
	
	if(month < 1  || month > 12){
		errorDisplay();
		$('#contentsserror').html('月份只有（1-12）月，请输入正确的月份！');
		return false;
	}
	
	if(day < 1 || day > 31){
		errorDisplay();
		$('#contentsserror').html('每月只有（1-31）天，请输入正确的天数！');
		return false;
	}
	
	//月日为单数时、前面加零 
    if(month < 10){ 
        month = "0" + month; 
    }
    if(day < 10){ 
    	day = "0" + day; 
    }
    
    var userDirthday = year.toString()+"/"+month.toString()+"/"+day.toString();	//拼接用户输入的日期
	
	var time_start = new Date().getTime(); //设定当前时间
    var time_end =  new Date(userDirthday).getTime(); //设定目标时间(即用户输入的时间)
	
 	// 计算时间差 
    if(time_end < time_start){	//输入的日期已过
    	errorDisplay();
    	$('#contentsserror').html('您输入的查询日期已成历史！');
    	return false;
    }else{
    	$('#contentss').css('display','block');
    	$('#contentsserror').css('display','none');
    	
    	var time_distance = time_end - time_start; 
        // 天
        var int_day = Math.floor(time_distance/86400000) 
        time_distance -= int_day * 86400000; 
        // 时
        var int_hour = Math.floor(time_distance/3600000) 
        time_distance -= int_hour * 3600000; 
        // 分
        var int_minute = Math.floor(time_distance/60000) 
        time_distance -= int_minute * 60000; 
        // 秒 
        var int_second = Math.floor(time_distance/1000)
          
        // 时分秒为单数时、前面加零 
        if(int_day < 10){ 
            int_day = "0" + int_day; 
        } 
        if(int_hour < 10){ 
            int_hour = "0" + int_hour; 
        } 
        if(int_minute < 10){ 
            int_minute = "0" + int_minute; 
        } 
        if(int_second < 10){
            int_second = "0" + int_second; 
        } 
        // 显示时间 
        $("#timess_d").val(int_day); 
        $("#timess_h").val(int_hour); 
        $("#timess_m").val(int_minute); 
        $("#timess_s").val(int_second);
        // 设置定时器
        setTimeout("timess_but()",1000);
    }
}

function errorDisplay(){
	$('#contentss').css('display','none');
	$('#contentsserror').css('display','block');
}
</script>