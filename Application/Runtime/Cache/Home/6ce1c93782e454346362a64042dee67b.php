<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $info['nickname']."相册集";?></title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
        <meta name="description" content="Responsive Image Gallery with jQuery" />
        <meta name="keywords" content="jquery, carousel, image gallery, slider, responsive, flexible, fluid, resize, css3" />
		<meta name="author" content="Codrops" />
		
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
	
		<meta name="apple-mobile-web-app-capable" content="yes">
		
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<meta name="format-detection" content="telephone=no">
				
		<link rel="shortcut icon" href="">
        <link rel="stylesheet" type="text/css" href="/third-party/Chajian_photo/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="/third-party/Chajian_photo/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/third-party/Chajian_photo/css/elastislide.css" />
		<!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' /> -->
		<noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
    </head>
    <body>
		<div class="container">
			<div class="header">
				<div class="clr"></div>
			</div><!-- header -->
			
			<div class="content">
				<h1><?php echo $info['nickname']?>的个人相册 <span>I believe I am unique in the world</span>
					<div style="font-size:14px;" id="timeYes">
					<?php echo $info['nickname']?>(<?php echo $info['month'];?>月<?php echo $info['days'];?>日)的生日还剩：
					<input type="text" id="time_d" style="width:50px">天
					<input type="text" id="time_h" style="width:50px">时
					<input type="text" id="time_m" style="width:50px">分
					<input type="text" id="time_s" style="width:50px">秒
					</div>
					<div style="font-size:14px;display:none;" id="timeNo">
					<?php echo $info['nickname']?>的生日是：<?php echo $info['month'];?>月<?php echo $info['days'];?>日，
					今年生日已经过了哟！
					</div>
					<input type="hidden" id="month" value="<?php echo $info['month'];?>"/>
					<input type="hidden" id="days" value="<?php echo $info['days'];?>"/>
				</h1>
				<div id="rg-gallery" class="rg-gallery">
					<div class="rg-thumbs">
						<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class="es-carousel-wrapper">
							<div class="es-nav">
								<span class="es-nav-prev">Previous</span>
								<span class="es-nav-next">Next</span>
							</div>
							<div class="es-carousel">
								<ul>
									<?php foreach( $list as $v ) { ?>
									<li><a href="#"><img src="<?php echo $v['img'];?>" width="65px" height="65px" data-large="<?php echo $v['img'];?>" alt="image01" data-description="<?php echo $info['nickname']?>：<?php echo $info['u_sign']?>" /></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->
				<p class="sub">想查看更多精美相册？ <a href="<?php echo U('Home/Photo/index');?>" style="font-size:16px;">返回相册列表</a>  <span style="font-size:16px; padding-left:5px;padding-right:5px;">|</span>  <a href="javascript:history.go(-1);" style="font-size:16px;">返回上一页</a></p>
			</div><!-- content -->
		</div><!-- container -->
		<script type="text/javascript" src="/Public/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="/third-party/Chajian_photo/js/jquery.tmpl.min.js"></script>
		<script type="text/javascript" src="/third-party/Chajian_photo/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="/third-party/Chajian_photo/js/jquery.elastislide.js"></script>
		<script type="text/javascript" src="/third-party/Chajian_photo/js/gallery.js"></script>
    </body>
</html>

<script type="text/javascript">
$(function(){ 
    show_time();
}); 
 
function show_time(){
	
	var oDate = new Date(); //实例一个时间对象；
	var oyear = oDate.getFullYear();   //获取系统的年；

	//获取用户的生日
	var userMonth = $('#month').val();
	var userDays = $('#days').val();
	
	if(userMonth == 0 || userDays == 0){	//用户没有输入生日
		$("#timeNo").css("display","none");
		$("#timeYes").css("display","none");
	}else{
		//用户输入生日，进行下面的操作
		if(userMonth < 10){
			userMonth = "0" + userMonth;	//月份前面加零
		}
		if(userDays < 10){
			userDays = "0" + userDays;	//日期前面加零
		}
		
		var userDirthday = oyear.toString()+"/"+userMonth.toString()+"/"+userDays.toString();	//拼接用户的生日
		
		var time_start = new Date().getTime(); //设定当前时间
	    var time_end =  new Date(userDirthday).getTime(); //设定目标时间(即用户的当年的生日时间)
		
	    // 计算时间差 
	    if(time_end < time_start){	//今年生日已过
	    	$('#timeNo').css("display","block");
	    	$('#timeYes').css("display","none");
	    }else{
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
	}
 
}
</script>