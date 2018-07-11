<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>个人信息管理</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/Public/Home/usersj/css/style.css">
<!--[if lt IE 9]>
<script src="/Public/Home/usersj/js/html5.js"></script>
<![endif]-->
<script src="/Public/Home/usersj/js/jquery.js"></script>
<script src="/Public/Home/usersj/js/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- 上传图片插件 -->
<script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
  
<!-- 时间日期插件 -->
<link rel="stylesheet" type="text/css" href="/third-party/date/css/lq.datetimepick.css"/>
<script src='/third-party/date/js/selectUi.js' type='text/javascript'></script>
<script src='/third-party/date/js/lq.datetimepick.js' type='text/javascript'></script>
	
<script>

	(function($){
		$(window).load(function(){
			
			$("a[rel='load-content']").click(function(e){
				e.preventDefault();
				var url=$(this).attr("href");
				$.get(url,function(data){
					$(".content .mCSB_container").append(data); //load new content inside .mCSB_container
					//scroll-to appended content 
					$(".content").mCustomScrollbar("scrollTo","h2:last");
				});
			});
			
			$(".content").delegate("a[href='top']","click",function(e){
				e.preventDefault();
				$(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
			});
			
		});
	})(jQuery);
</script>

<style>
/** 按钮样式 **/
.boxbutton{
	border:1px solid #48DGCG ; 
	background-color:#48D1CC; 
	text-align:center;
	height:32px;
	ling-height:32px;
}

.unboxbutton{
	border:1px solid #BGBGBG ; 
	background-color:#B5B5B5; 
	text-align:center;
	height:32px;
	ling-height:32px;
}

/** 分页样式 **/
.paging {PADDING-RIGHT: 3px; PADDING-LEFT: 30%; PADDING-BOTTOM:20px; PADDING-TOP:20px; TEXT-ALIGN: center}
.paging A { padding:2px 5px; border:1px solid #ccc; margin-right:5px; background:#5BC0DE; color:#fff;}
.paging A:hover{ border:1px solid #ccc; padding:2px 5px; background:#0E90D2; margin-right:5px; color:#fff;}
.paging A:active{ border:1px solid #ccc; padding:2px 5px; background:#0E90D2; margin-right:5px; color:#fff;}
.paging SPAN.current{ padding:2px 5px; border:1px solid #ccc; margin-right:5px; background:#5BC0DE; color:#fff;}

.paging li{
	float:left;
	list-style:none;
	padding-left:5px;
}
</style>
</head>
<body>
<!--header-->
<header>
 <h1><img src="/Public/Home/usersj/images/admin_logo.png"/></h1>
 <ul class="rt_nav">
  <li><a href="<?php echo U('Home/Index/index');?>" target="_blank" class="website_icon">网站首页</a></li>
  <?php if($isCheckQQ == 1){ ?>
  	<li><a href="<?php echo $qqurl;?>" class="admin_icon"><span style="font-weight:bold;">绑定QQ号</span></a><li>
  <?php }?>
  <li><a href="<?php echo U('Home/Usersj/userInfo');?>" class="admin_icon">个人资料</a></li>
  <li><a href="<?php echo U('Home/Usersj/changePassWord');?>" class="set_icon">账号设置</a></li>
  <li><a href="<?php echo U('Home/Login/logOut')?>" class="quit_icon">安全退出</a></li>
 </ul>
</header>
<!--aside nav-->


<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar" id="boxboxbox">
 <h2><a href="index.html">起始页</a></h2>
 <ul>
  <li>
   <dl>
    <dt>个人设置</dt>
    <!--当前链接则添加class:active-->
    <dd><a href="<?php echo U('Home/Usersj/userInfo');?>" class="active">个人资料</a></dd>
    <dd><a href="<?php echo U('Home/Usersj/changePassWord');?>">密码修改</a></dd>
    <dd><a href="<?php echo U('Home/Usersj/safeLog');?>">安全日志</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>列表信息</dt>
    <dd><a href="<?php echo U('Home/Usersj/yuluList')?>">经典语录列表</a></dd>
    <dd><a href="<?php echo U('Home/Usersj/jokeList')?>">幽默笑话列表</a></dd>
    <dd><a href="<?php echo U('Home/Usersj/articleList');?>">优美文章列表</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>相册管理</dt>
    <dd><a href="<?php echo U('Home/Usersj/photo');?>">相册列表</a></dd>
    <dd><a href="<?php echo U('Home/Usersj/photoAdd');?>">增加相册</a></dd>
    <dd><a href="<?php echo U('Home/Usersj/photoCoverAdd')?>">封面图像修改</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>账号绑定</dt>
    <dd><a href="<?php echo U('Home/Usersj/bindList')?>">账号绑定信息</a></dd>
   </dl>
  </li>
 </ul>
</aside>
<!-- end aside nav -->

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <section>
      <h2><strong style="color:grey;">个人信息</strong></h2>
      <ul class="ulColumn2">
       <li>
        <span style="width:120px;">名称：</span>
        <input type="text" disabled="true" value="<?php echo $info['username'];?>" class="textbox textbox_295" placeholder="用户名"/>
        <span></span>
       </li>
       <li>
        <span style="width:120px;">昵称：</span>
        <input type="text" id="user-nickname" value="<?php echo $info['nickname'];?>" class="textbox textbox_295" placeholder="昵称"/>
        <span class="error_nickname" style="color:red;"></span>
       </li>
       <li>
        <span style="width:120px;">生日：</span>
        <input type="text" id="month" onblur="month()" value="<?php echo $info['month'];?>" placeholder="月份(1-12)填写数字1-12" style="width:20%; margin-right:20px;" class="textbox textbox_295"/>
        <input type="text" id="days" onblur="days()" value="<?php echo $info['days'];?>" placeholder="日期(1-31)填写数字1-31" style="width:20%; marign-right:20px;" class="textbox textbox_295"/>
       	<span class="error_birthday" style="color:red;"></span>
       </li>
       <li><span style="width:120px;">地址：</span></li>
        <div data-toggle="distpicker">
		  <select id="prov" data-province="---- 选择省 ----" style="width:30%;float:left;margin-right:5%;"></select>
		  <select id="city" data-city="---- 选择市 ----" style="width:30%;float:left;margin-right:5%;"></select>
		  <select id="drstry" data-district="---- 选择区 ----" style="width:30%;float:left;"></select>
		</div>
       <li style="padding-top:50px;">
       <span style="width:120px;">详细地区：</span>
       <span class="error_address" style="color:red;"></span>
       <input type="text" id="user-address" value="<?php echo $info['address'];?>" class="textbox textbox_295" placeholder="详细地区"/>
       <input type="text" disabled="true" id="showAddress" class="textbox textbox_295"  style="display:none;"/><!-- 完整地址ajax动态显示 -->
       </li>
       <li><span style="width:120px;">个性签名：</span></li>
       <li>
        <textarea placeholder="个性签名" id="user-sign" class="textarea" style="width:500px;height:100px;"><?php echo $info['u_sign'];?></textarea>
       </li>
       <li>
        <span style="width:120px;"></span>
        <input type="button" id="sub-button" class="boxbutton" value="提交" style="margin-left:30%;width:30%;"/>
       </li>
      </ul>
     </section>
     <!--tabStyle-->
     <script>
     $(document).ready(function(){
		 //tab
		 $(".admin_tab li a").click(function(){
		  var liindex = $(".admin_tab li a").index(this);
		  $(this).addClass("active").parent().siblings().find("a").removeClass("active");
		  $(".admin_tab_cont").eq(liindex).fadeIn(150).siblings(".admin_tab_cont").hide();
		 });
		 });
     </script>
     
 </div>
 
 <p style="font-size:17px;padding-left:5%;">
Address：湖北省仙桃市陈场镇幼松村八组.    
<span style="padding-left:10px;">Copyright © 2017-2018 黄文豪  版权所有.</span>
</p>
 
</section>


<script src="/Public/Home/usersj/js/amcharts.js" type="text/javascript"></script>
<script src="/Public/Home/usersj/js/serial.js" type="text/javascript"></script>
<script src="/Public/Home/usersj/js/pie.js" type="text/javascript"></script>

<script>
<script>
function month(){
	var month = $('#month').val();
	if(isNaN(month)){
		$('#error_birthday').html('请谨慎对待，填写您的日期');
		return false;
	}
	
	if(Math.floor(month) != month){
		$('#error_birthday').html('请输入正确的日期！');
		return false;
	}
	
	if(month<0 || month>12){
		$('#error_birthday').html('你个逗B，月份只有（1-12）月');
		return false;
	}
}

function days(){
	var days = $('#days').val();
	if(isNaN(days)){
		$('#error_birthday').html('请谨慎对待，填写您的日期');
		return false;
	}
	
	if(Math.floor(days) != days){
		$('#error_birthday').html('请输入正确的日期！');
		return false;
	}
	
	if(days<0 || days>31){
		$('#error_birthday').html('你个逗B，每月只有（1-31）天');
		return false;
	}
}
</script>

<!-- 开始：地址插件 -->
<script src="/third-party/address/js/distpicker.data.js"></script>
<script src="/third-party/address/js/distpicker.js"></script>
<script src="/third-party/address/js/main.js"></script>

<script type="text/javascript">
$(function (){
	
	$("#datetimepicker3").on("click",function(e){
		e.stopPropagation();
		$(this).lqdatetimepicker({
			css : 'datetime-day',
			dateType : 'D',
			selectback : function(){

			}
		});

	});

});
</script> 
<!-- 结束：地址插件 -->

<script>
$('#sub-button').click(function(){
	var nickname = $('#user-nickname').val();
	var u_sign = $('#user-sign').val();
	var address = $('#user-address').val();
	var prov = $('#prov').val();
	var city = $('#city').val();
	var drstry = $('#drstry').val();
	var month = $('#month').val();
	var days = $('#days').val();
	$.ajax({
		type:'post',
		url:'<?php echo U("Home/Usersj/userInfo");?>',
		data:{'nickname':nickname,'u_sign':u_sign,'address':address,'prov':prov,'city':city,'drstry':drstry,'month':month,'days':days},
		success:function(respon){
			if(respon.errno == 10002){
				$('.error_nickname').html(respon.errmsg);
				$('.error_but').html(respon.errmsg);
				$('.error_address').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10003){
				//$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_address').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10004){
				$('.error_address').html(respon.errmsg);
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10001){
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_address').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10005){
				$('.error_birthday').html(respon.errmsg);
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_address').hide();
			}else if(respon.errno == 10000){	//成功
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_address').hide();
				$('.error_birthday').hide();
				setTimeout( "close()",500);	//停留0.5秒，执行close()函数
			}
		}
	});
});

$(function(){
	close();
});

function close(){
	$.post('<?php echo U("Home/Usersj/userInfoSon");?>',
		function(list){
			var html = '';
			var d = eval('('+list+')');	//解析json数据
			if(d != false && d != null){
				$('#showAddress').show();
				$('#showAddress').val(d);
			}
		}	
	);
}
</script>

</body>
</html>