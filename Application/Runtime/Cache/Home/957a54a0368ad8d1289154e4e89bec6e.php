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

<!-- 多图上传插件 -->
<link href="/third-party/diyupload/css/webuploader.css" rel="stylesheet"><!-- 多图上传必须样式 -->
<link href="/third-party/diyupload/css/diyUpload.css" rel="stylesheet"><!-- 多图上传必须样式 -->

<script src="/third-party/diyupload/js/jquery-2.1.4.min.js"></script><!-- 必须jq -->
<script src="/third-party/diyupload/js/webuploader.html5only.min.js"></script><!-- 多图上传必须的js -->
<script src="/third-party/diyupload/js/diyUpload.js"></script><!-- 多图上传必须的js -->

  <!-- content start -->
  <div class="admin-content">

    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf">
          <strong class="am-text-primary am-text-lg">相册</strong> / <small>Photos</small>
          <input type="button" onclick="do_sub()" style="height:32px;background:#20b2aa;margin-left:30px;margin-right:10px;" value="统一尺寸显示"/>
          <input type="button" onclick="do_sub2()" style="height:32px;background:#F37B1D;" value="原图尺寸显示"/>

     	  <input type="text" style="margin-left:30px;" name="datepicker3" id="datetimepicker3" placeholder="2017-5-5" value=""/>
         		至
		  <input type="text" name="datepicker4" id="datetimepicker4" placeholder="2017-5-8" value=""/>

          <input  type="button" style="height:32px;background:#0E90D2;color:#FFFFFF;font-size:14px;" name="sub" id="sub_but" value="点击查询">
           
            <input type="hidden" id="total_page" value="1"/>
      		<input type="hidden" id="curr_page" value="1"/>
        </div>
      </div>

      <hr>

      <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-margin gallery-list">
        
        <!-- ajax动态获取内容 -->
        <!-- 
        <li>
          <a href="#">
            <img class="am-img-thumbnail am-img-bdrs" src="http://s.amazeui.org/media/i/demos/bing-1.jpg" alt=""/>
            <div class="gallery-title">远方 有一个地方 那里种有我们的梦想</div>
            <div class="gallery-desc">2375-09-26</div>
          </a>
        </li>
         -->
        
      </ul>
      
      <div class="pages"></div>

	  <!-- 
      <div class="am-margin am-cf">
        <hr/>
        <p class="am-fl">共 15 条记录</p>
        <ol class="am-pagination am-fr">
          <li class="am-disabled"><a href="#">&laquo;</a></li>
          <li class="am-active"><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&raquo;</a></li>
        </ol>
      </div>
       -->
       
    </div>

    
    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">Copyright © 2017 黄文豪  版权所有.</p>
    </footer>

  </div>
  <!-- content end -->

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

</body>
</html>

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
	
	$("#datetimepicker4").on("click",function(e){
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
$(function(){
	init();
	do_sub();
});

function init(){
	//点击查询
	$('#sub_but').unbind('click').click(function(){
		do_sub();
	});
	
	//点击上一页
	$('#pre_page').unbind('click').click(function(){
		var curr = $('#curr_page').val();
		if(Number(curr) > 1){
			$('#curr_page').val( Number(curr)-1 );
			do_sub();
		}
	});
	
	
	//点击下一页
	$('#nex_page').unbind('click').click(function(){
		var curr = $('#curr_page').val();
		var total = $('#total_page').val();
		if(Number(curr) < Number(total)){
			$('#curr_page').val( Number(curr)+1 );
			do_sub();
		}
	});
	
	//搜索条件发生变化 
	$('#datetimepicker3').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
	
	$('#datetimepicker4').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
	
}

//统一尺寸显示
function do_sub(){
	var datetime1 = $('#datetimepicker3').val();
	var datetime2 = $('#datetimepicker4').val();
	var currPage = $('#curr_page').val();
	$.post('<?php echo U("Home/User/ajaxPhotoList")?>',{'datetime1':datetime1,'datetime2':datetime2,'currPage':currPage},
		function(data){
			var html = '';
			var d = eval("("+data+")");
			if(d.list != false || d.list != null){
				for(var o in d.list){
			        html += '<li>';
			        html += '<a href="javascript:void(0);">';
			        html += '<img class="am-img-thumbnail am-img-bdrs" onclick="bigImg('+d.list[o].id+')" id="img_'+d.list[o].id+'" src="'+d.list[o].img+'" style="height:200px;width:99%;" alt=""/>';
			        html += '</a>';
			        html += '<div class="gallery-title"></div>';
			        html += '<div class="gallery-desc" style="padding-left:20px;">'+d.list[o].maketime+'<input type="button" style="margin-left:5%;" onclick="imgDel('+d.list[o].id+','+d.list[o].is_photo_show+')" value="删除"></div>'
			        html += '</li>';
				}
				
				if(d.total_page == 1){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==1){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==d.total_page){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=3 && d.currPage>1 && d.currPage<d.total_page){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}
				$("#total_page").val(d.total_page);	//获取总页数
				
			}else{
				html += '<li>';
		        html += '<a href="javascript:void(0);">';
		        html += '<img class="am-img-thumbnail am-img-bdrs" alt=""/>';
		        html += '<div class="gallery-title">暂无数据</div>';
		        html += '<div class="gallery-desc"></div>'
		        html += '</a>';
		        html += '</li>';
			}
			
			$('.gallery-list').html(html);
			init();
		}		
	);
}

//原图片尺寸显示
function do_sub2(){
	var datetime1 = $('#datetimepicker3').val();
	var datetime2 = $('#datetimepicker4').val();
	var currPage = $('#curr_page').val();
	$.post('<?php echo U("Home/User/ajaxPhotoList")?>',{'datetime1':datetime1,'datetime2':datetime2,'currPage':currPage},
		function(data){
			var html = '';
			var d = eval("("+data+")");
			if(d.list != false || d.list != null){
				for(var o in d.list){
			        html += '<li>';
			        html += '<a href="javascript:void(0);">';
			        html += '<img class="am-img-thumbnail am-img-bdrs" src="'+d.list[o].img+'" alt=""/>';
			        html += '<div class="gallery-title"></div>';
			        html += '<div class="gallery-desc" style="padding-left:20px;">'+d.list[o].maketime+'<input type="button" style="margin-left:5%;" onclick="imgDel2('+d.list[o].id+','+d.list[o].is_photo_show+')" value="删除"></div>'
			        html += '</a>';
			        html += '</li>';
				}
				
				if(d.total_page == 1){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==1){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==d.total_page){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=3 && d.currPage>1 && d.currPage<d.total_page){
					$(".pages").html('<tr><td colspan="9" style="padding:0; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}
				$("#total_page").val(d.total_page);	//获取总页数
				
			}else{
				html += '<li>';
		        html += '<a href="javascript:void(0);">';
		        html += '<img class="am-img-thumbnail am-img-bdrs" src="" alt=""/>';
		        html += '<div class="gallery-title">暂无数据</div>';
		        html += '<div class="gallery-desc"></div>'
		        html += '</a>';
		        html += '</li>';
			}
			
			$('.gallery-list').html(html);
			init();
		}		
	);
}

//删除照片
function imgDel(imgId,isShow){
	if(isShow == 1){
		var res = confirm('删除封面图之后，网站将不再显示你的相册图片，确定要删除吗？');
		if(res == true){
			$.ajax({
				type:'post',
				url:'<?php echo U("Home/User/delPhoto");?>',
				data:{'imgId':imgId},
				success:function(respon){
					do_sub();//统一尺寸显示函数
				}
			});
		}
	}else{
		var res = confirm('删除之后不可恢复，是否确定要删除？');
		if(res == true){
			$.ajax({
				type:'post',
				url:'<?php echo U("Home/User/delPhoto");?>',
				data:{'imgId':imgId},
				success:function(respon){
					do_sub();	//统一尺寸显示函数
				}
			});
		}
	}
	
}

function imgDel2(imgId,isShow){
	if(isShow == 1){
		var res = confirm('删除封面图之后，网站将不再显示你的相册图片，确定要删除吗？');
		if(res == true){
			$.ajax({
				type:'post',
				url:'<?php echo U("Home/User/delPhoto");?>',
				data:{'imgId':imgId},
				success:function(respon){
					do_sub2();//原尺寸图片显示函数
				}
			});
		}
	}else{
		var res = confirm('删除之后不可恢复，是否确定要删除？');
		if(res == true){
			$.ajax({
				type:'post',
				url:'<?php echo U("Home/User/delPhoto");?>',
				data:{'imgId':imgId},
				success:function(respon){
					do_sub2();	//原尺寸图片显示函数
				}
			});
		}
	}
	
}

//点击图片缩放
/*function bigImg(id){
	var img_id = "#img_"+id;
	var height = $(img_id).css("height");
    if(height == '200px')
    {
        $(img_id).removeAttr("style");	//移除style样式
    }
    else
    {
    	$(img_id).css("width","99%");
        $(img_id).css("height","200px");
    }
}*/

//编辑封面图时的跳转
function userEditCoverImg(){
	window.location.href = "<?php echo U('Home/User/photoCoverAdd');?>";
}
</script>