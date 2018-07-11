<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js fixed-layout">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>致我们终将逝去的青春</title>
  <meta name="description" content="致我们终将逝去的青春">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/Public/Home/user/assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/Public/Home/user/assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="用户中心" />
  
  <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">

  <meta name="apple-mobile-web-app-capable" content="yes">
	
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
	
  <meta name="format-detection" content="telephone=no">
  
  <link rel="stylesheet" href="/Public/Home/user/assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/Public/Home/user/assets/css/admin.css">
  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="/Public/Home/js/jquery.min.1.8.2.js"></script>
  <!--<![endif]-->
  <script src="/Public/Home/user/assets/js/amazeui.min.js"></script>
  <script src="/Public/Home/user/assets/js/app.js"></script>
  
  <!-- 上传图片插件 -->
  <script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
  
  <!-- 时间日期插件 -->
	<link rel="stylesheet" type="text/css" href="/third-party/date/css/lq.datetimepick.css"/>
	<script src='/third-party/date/js/selectUi.js' type='text/javascript'></script>
	<script src='/third-party/date/js/lq.datetimepick.js' type='text/javascript'></script>
  
<style>
.pages {PADDING-RIGHT: 3px; PADDING-LEFT: 60%; PADDING-BOTTOM:20px; PADDING-TOP:20px; TEXT-ALIGN: center}
.pages A { padding:2px 5px; border:1px solid #ccc; margin-right:5px; background:#5BC0DE; color:#fff;}
.pages A:hover{ border:1px solid #ccc; padding:2px 5px; background:#0E90D2; margin-right:5px; color:#fff;}
.pages A:active{ border:1px solid #ccc; padding:2px 5px; background:#0E90D2; margin-right:5px; color:#fff;}
.pages SPAN.current{ padding:2px 5px; border:1px solid #ccc; margin-right:5px; background:#5BC0DE; color:#fff;}

.pager li{
	float:left;
	list-style:none;
	padding-left:5px;
}
</style>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
  <div class="am-topbar-brand">
    <strong>
    	<?php if($_SESSION['qq_nickname'] != ''){ ?>
			<?php echo $_SESSION['qq_nickname'];?>&nbsp;
		<?php }else{ ?>
			<?php echo $_SESSION['nickname'];?>&nbsp;
		<?php } ?>
    </strong> <small>个人中心</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <!-- <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 最近留言 <span class="am-badge am-badge-warning">5</span></a></li> -->
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="<?php echo U('Home/User/userInfo');?>"><span class="am-icon-user"></span> 个人资料</a></li>
          <li><a href="<?php echo U('Home/Login/logOut')?>"><span class="am-icon-power-off"></span> 安全退出</a></li>
        </ul>
      </li>
      
      <?php if($isCheckQQ == 1){ ?>
      	<li><a href="<?php echo $qqurl;?>"><span class="am-icon-arrows-alt"></span> <span style="color:#FF7F00;font-weight:bold;">绑定QQ号</span></a><li>
      <?php }?>
      <li><a href="<?php echo U('Home/Index/index');?>"><span class="am-icon-arrows-alt"></span> <span>返回网站首页</span></a></li>
      <!-- <li><a href="/mall.php/Home/Index/index"><span class="am-icon-arrows-alt"></span> <span>返回商城首页</span></a></li> -->
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="<?php echo U('Home/User/index');?>"><span class="am-icon-home"></span> 个人首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span>个人设置<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            <li><a href="<?php echo U('Home/User/userInfo');?>" class="am-cf"><span class="am-icon-check"></span> 个人资料<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
            <li><a href="<?php echo U('Home/User/changePassWord');?>"><span class="am-icon-puzzle-piece">密码修改</span></a></li>
            <li><a href="<?php echo U('Home/User/photo')?>"><span class="am-icon-th"></span> 个人相册<span class="am-badge am-badge-secondary am-margin-right am-fr"><?php echo $numPhoto['num'];?></span></a></li>
            <li><a href="<?php echo U('Home/User/safeLog')?>"><span class="am-icon-calendar"></span> 安全日志</a></li>
            <li><a href="<?php echo U('Home/User/bindList');?>"><span class="am-icon-bug"></span> 账号绑定信息</a></li>
            <!-- <li><a href="admin-404.html"><span class="am-icon-bug"></span> 404</a></li> -->
          </ul>
        </li>
        <!-- <li><a href="admin-table.html"><span class="am-icon-table"></span> 表格</a></li> -->
        <li><a href="<?php echo U('Home/User/yuluList');?>"><span class="am-icon-pencil-square-o"></span> 经典语录列表</a></li>
        <li><a href="<?php echo U('Home/User/jokeList');?>"><span class="am-icon-pencil-square-o"></span> 幽默笑话列表</a></li>
        <li><a href="<?php echo U('Home/User/articleList');?>"><span class="am-icon-pencil-square-o"></span> 优美文章列表</a></li>
        <li><a href="<?php echo U('Home/User/photoAdd');?>"><span class="am-icon-sign-out"></span> 增加相册</a></li>
      	<li><a href="<?php echo U('Home/User/photoCoverAdd');?>"><span class="am-icon-sign-out"></span> 封面图像修改</a></li>
      	<li>
	      	<a href="<?php echo U('Home/User/messageAllList');?>"><span class="am-icon-sign-out"></span> 留言列表
	      		<?php if($numMessage != 0){ ?>
	      			<span class="am-badge am-badge-secondary am-margin-right am-fr" style="background-color:red;">新 <?php echo $numMessage;?></span>
	      		<?php } ?>
	      	</a>
      	</li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 个性签名</p>
          <p><?php echo $sign[u_sign];?></p>
        </div>
      </div>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-tag"></span> 欢迎</p>
          <p>Welcome to visit this website![<a href="<?php echo U('Home/Index/index');?>">www.beliv.cn</a>]</p>
        </div>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal information</small></div>
      </div>

      <hr/>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
          <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
              <div class="am-g">
                <div class="am-u-md-4">
                  <img class="am-img-circle am-img-thumbnail" id="user-img" src="<?php echo $info['u_img'];?>" alt=""/><br/>
                  <span id="error_img" style="font-size:20px;color:red;text-align:center;"></span>
                </div>
                <div class="am-u-md-8">
                  <p>上传个人头像。 </p>
                  <form class="am-form" method="post" enctype="multipart/form-data" >
                    <div class="am-form-group">
                      <input type="file" name="fileImg" id="user-pic" onchange="uploadChangeImg('user-img','user-pic')" accept="image/jpeg,image/jpg,image/png,image/gif">
                      <p class="am-form-help">请选择要上传的文件...</p>
                      <button type="button" onclick="location.replace(location.href)" class="am-btn am-btn-primary am-btn-xs">取消</button>
                      <button type="button" onclick="uploadimg('user-img','user-pic')" class="am-btn am-btn-primary am-btn-xs">保存</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="am-panel am-panel-default usersss">
          <!-- ajax动态获取内容 -->
            <!-- 
            <div class="am-panel-bd">
              <div class="user-info">
                <p>等级信息</p>
                <div class="am-progress am-progress-sm">
                  <div class="am-progress-bar" style="width: 60%"></div>
                </div>
                <p class="user-info-order">
                	用户名：<strong><?php echo $info['username'];?></strong><br/> 
                	昵&nbsp;&nbsp;&nbsp; 称：<strong><?php echo $info['nickname'];?></strong> <br/>
                	地&nbsp;&nbsp;&nbsp; 址：<strong><?php echo $info['address'];?></strong><br/>
                                                            签&nbsp;&nbsp;&nbsp; 名：<strong><?php echo $info['u_sign'];?></strong><br/>
                </p>
              </div>
            </div>
             -->
          </div>

        </div>

        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
          <form class="am-form am-form-horizontal">
            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">用户名 / Name</label>
              <div class="am-u-sm-9">
                <input type="text" readonly="true" id="user-name" name="name" value="<?php echo $info['username'];?>" placeholder="姓名 / Name">
                <small>用于登录，不能修改。</small>
              </div>
            </div>
            
            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">昵称 / NiceName</label>
              <div class="am-u-sm-9">
                <input type="text" id="user-nickname" name="nickname" value="<?php echo $info['nickname'];?>" placeholder="昵称 / NiceName">
                <small>输入你的昵称，用于发表文章、语录、笑话时显示作者名。</small>
                <span class="error_nickname" style="color:red;"></span>
              </div>
            </div>
            
            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">生日 / Birthday</label>
              <div class="am-u-sm-9">
                <!-- <input type="text" name="datepicker3" id="datetimepicker3" placeholder="2017-5-5" value=""/> -->
                <input type="text" id="month" onblur="month()" value="<?php echo $info['month'];?>" placeholder="月份(1-12)填写数字1-12" style="width:200px; margin-right:20px;float:left;"/>
                <input type="text" id="days" onblur="days()" value="<?php echo $info['days'];?>" placeholder="日期(1-31)填写数字1-31" style="width:200px; marign-right:20px;float:left;"/>
                <small style="margin-left:10px;">填写您的生日</small>
                <span class="error_birthday" style="color:red;"></span>
              </div>
            </div>
            
            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">地址/ Address</label>
              <div class="am-u-sm-9">
                <div data-toggle="distpicker">
				  <select id="prov" data-province="---- 选择省 ----" style="width:30%;float:left;margin-right:5%;"></select>
				  <select id="city" data-city="---- 选择市 ----" style="width:30%;float:left;margin-right:5%;"></select>
				  <select id="drstry" data-district="---- 选择区 ----" style="width:30%;float:left;"></select>
				</div>
				<input type="text" id="user-address" name="address" value="<?php echo $info['address'];?>" placeholder="详细地区" style="margin-top:50px;">
                <small>你最想去的地方,或现居地...</small>
                <span class="error_address" style="color:red;"></span>
              </div>
            </div>

            <div class="am-form-group">
              <label for="user-intro" class="am-u-sm-3 am-form-label">个性签名/ Signature</label>
              <div class="am-u-sm-9">
                <textarea class="" rows="5" id="user-sign" placeholder="输入个性签名"><?php echo $info['u_sign'];?></textarea>
                <small>250字以内写出你的一生...</small>
                <span class="error_sign" style="color:red;"></span>
              </div>
            </div>

            <div class="am-form-group">
              <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="button" id="sub-button" class="am-btn am-btn-primary">保存修改</button>
                <span class="error_but" style="color:red;"></span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    
    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">Copyright © 2017-2018 黄文豪  版权所有.</p>
    </footer>

  </div>
  <!-- content end -->

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

</body>
</html>

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

<script>
//选择图片时，图片位置的图片改变，  但不保存到数据库
function uploadChangeImg(imgid,fileid){
//imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
   $("#"+imgid).attr("src","");//加载loading图片
   $.ajaxFileUpload({            
    	url: '<?php echo U("Home/User/uploadChangeImg");?>',
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
           	$("#"+imgid).attr("src",data.path).addClass("load1");//加载返回的图片路径并附加上样式
               //$("#"+hiddenid).val(data.path);//给对应的隐藏域赋值，以便提交时给后台
           }              
       }
   });	
}

//点击保存，图片位置的图片改变，图片保存到数据库
function uploadimg(imgid,fileid) {
 //imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
    $("#"+imgid).attr("src","");//加载loading图片
    $.ajaxFileUpload({ 
    	type:'post',
     	url:'<?php echo U("Home/User/uploadChangeImg");?>',
        secureuri:false,
        fileElementId:fileid,  
        dataType:'json',              
        success:function (data){   //data的内容都是在后台php代码中自定义的,json格式返回后在这里以对象的方式的访问
            var u_img = data.path;
        	$.ajax({
        		type:'post',
        		url:'<?php echo U("Home/User/userHeadImg");?>',
        		data:{'u_img':u_img},
        		success:function(respon){
        			if(respon.errno == 10001){
        				$('#error_img').html(respon.errmsg);
        			}else{
        				$("#"+imgid).attr("src",data.path);
        			}
        		}
        	});
        }
    });
}

</script>

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
		url:'<?php echo U("Home/User/userInfo");?>',
		data:{'nickname':nickname,'u_sign':u_sign,'address':address,'prov':prov,'city':city,'drstry':drstry,'month':month,'days':days},
		success:function(respon){
			if(respon.errno == 10002){
				$('.error_nickname').html(respon.errmsg);
				$('.error_but').html(respon.errmsg);
				$('.error_sign').hide();
				$('.error_address').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10003){
				$('.error_sign').html(respon.errmsg);
				//$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_address').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10004){
				$('.error_address').html(respon.errmsg);
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_sign').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10001){
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_sign').hide();
				$('.error_address').hide();
				$('.error_birthday').hide();
			}else if(respon.errno == 10005){
				$('.error_birthday').html(respon.errmsg);
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_sign').hide();
				$('.error_address').hide();
			}else if(respon.errno == 10000){	//成功
				$('.error_but').html(respon.errmsg);
				$('.error_nickname').hide();
				$('.error_sign').hide();
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
	$.post('<?php echo U("Home/User/userInfoSon");?>',
		function(list){
			var html = '';
			var d = eval('('+list+')');	//解析json数据
			if(d != false && d != null){
				
				html += '<div class="am-panel-bd">';
				html += '<div class="user-info">';
				html += '<p>个人信息：</p>';
				html += '<div class="am-progress am-progress-sm">';
				html += '<div class="am-progress-bar" style="width: 60%"></div>';
				html += '</div>';
				html += '<p class="user-info-order">用户名：<strong>'+d.username+'</strong><br/>昵&nbsp;&nbsp;&nbsp; 称：<strong>'+d.nickname+'</strong><br/>生&nbsp;&nbsp;&nbsp; 日：<strong>'+d.u_birthday+'</strong><br/>地&nbsp;&nbsp;&nbsp; 址：<strong>'+d.address+'</strong><br/>签&nbsp;&nbsp;&nbsp; 名：<strong>'+d.u_sign+'</strong><br/></p>';
				html += '</div></div>';
				
			}else{
				html += '<div class="am-panel-bd">';
				html += '<div class="user-info">';
				html += '<p>个人信息：</p>';
				html += '<div class="am-progress am-progress-sm">';
				html += '<div class="am-progress-bar" style="width: 60%"></div>';
				html += '</div>';
				html += '<p class="user-info-order">用户名：<strong></strong><br/>昵&nbsp;&nbsp;&nbsp; 称：<strong></strong><br/>地&nbsp;&nbsp;&nbsp; 址：<strong></strong><br/>签&nbsp;&nbsp;&nbsp; 名：<strong></strong><br/></p>';
				html += '</div></div>';
			}
			
			$('.usersss').html(html);
		}	
	);
}
</script>