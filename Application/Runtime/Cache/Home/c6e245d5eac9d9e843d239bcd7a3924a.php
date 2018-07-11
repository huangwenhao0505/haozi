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

        <div class="tm-about-img-container">
            
        </div>

        <section class="tm-section">
            <div class="container-fluid">
            
            	<!-- 搜索栏 -->
            	<tr>
		           <th width="70">作者:</th>
		           <td><input style="margin-right:10px;" placeholder="作者" name="author" value="" id="author" type="text"></td>
		           <th width="70">标题:</th>
		           <td><input style="margin-right:10px;" placeholder="标题" name="title" value="" id="title" type="text"></td>
		           <th width="70">分类:</th>
		           <td>
		           	<select id="categoryId" style="marign-right:10px;">
		           		<option value="">请选择类别</option>
		           		<?php foreach($list as $k => $v){ ?>
		           			<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
		           			<?php foreach($v['sonCate'] as $key => $val){ ?>
           						<option value="<?php echo $val['id'];?>">-----<?php echo $val['name'];?></option>
                    		<?php } ?>
		           		<?php } ?>
		           	</select>
		           	
		           	<span id="sonlist"></span>
		           </td>
		           <th width="70">日期:</th>
		           <td>
		           		<input type="text" size='8' name="datepicker3" id="datetimepicker3" placeholder="2017-5-5" value=""/>
		           		至
						<input type="text" size='8' name="datepicker4" id="datetimepicker4" placeholder="2017-5-8" value=""/>
		           </td>
		           <td>
		           		<input type="button" class="btn btn-info" onclick="addArticle()" style="margin-left:40px;margin-top:1px;" value="我要发表文章"/>
		           </td>
		           <td>
			           <input type="button" class="btn btn-primary" style="margin-left:20px;margin-top:1px;" name="sub" id="sub_but" value="点击查询">
			           <input type="hidden" id="curr_page" value="1"/>
					   <input type="hidden" id="total_page" value="1"/>
					   <input type="hidden" id="session_user_id" value="<?php echo $_SESSION['id'];?>"/>	<!-- 判断用户是否有登录 -->
		           </td>
		           
		        </tr>
                
                <!-- 文章列表 ajax获取 -->
                <div class="row tm-margin-t-mid list_news"></div>
                <div class="pages"></div>

            </div>
        </section>
        
<script type="text/javascript">
$(function (){
	/**  时间选择  9:00 - 12:00
	$("#datetimepicker1").on("click",function(e){
		e.stopPropagation();
		$(this).lqdatetimepicker({
			css : 'datetime-hour'
		});

	});


	$("#datetimepicker2").on("click",function(e){
		e.stopPropagation();
		$(this).lqdatetimepicker({
			css : 'datetime-hour'
		});

	});
	*/

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
		var currPage = $('#curr_page').val();	//当前页
		if( Number(currPage)>1 ){
			$('#curr_page').val( Number(currPage)-1 );
			do_sub();
		}
	});
	
	//点击下一页
	$('#nex_page').unbind('click').click(function(){
		var currPage = $('#curr_page').val();
		var totalPage = $('#total_page').val();
		if( Number(currPage) < Number(totalPage) ){
			$('#curr_page').val( Number(currPage)+1 );
			do_sub();
		}
	});
	//搜索条件发生变化 
	$('#author').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	})
	
	$('#title').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	})
	
	$('#categoryId').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
	
	$('#datetimepicker3').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
	
	$('#datetimepicker4').unbind('change').click(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});

}

function do_sub(){
	var author = $('#author').val();
	var title  = $('#title').val();
	var cid	   = $('#categoryId').val();
	var datetime1 = $('#datetimepicker3').val();
	var datetime2 = $('#datetimepicker4').val();
	var currPage = $('#curr_page').val();
	var tiaoPage = $('#tiao_page').val();

	$.post('<?php echo U("Home/Article/ajaxListArti");?>',{'author':author,'title':title,'cid':cid,'datetime1':datetime1,'datetime2':datetime2,'currPage':currPage,'tiaoPage':tiaoPage},
		function(data){
			var html = '';
			var d = eval("("+data+")");	//解析json格式
			if(d.list != false && d.list != null){	//内容不为空
				for(var o in d.list){	//遍历
                	
                	html += '<div class="col-xs-12">';
                	html += '<h3 class="tm-gold-text"><img src="'+d.list[o].img_url+'" style="width:30px;height:30px;"/><span style="padding-left:10px;margin-bottom:5px;margin-top:5px;"><a style="color:#CC9900" href="/index.php/Home/Article/detailArti?id='+d.list[o].id+'">'+d.list[o].title+'</a></span><span style="padding-left:20px;color:#666666;font-size:14px;">----'+d.list[o].jianjie+'</span></h3>';
					html += '<p class="intro" style="margin-bottom:5px;margin-top:5px;font-size:13px;">作者：'+d.list[o].author+'<span style="padding-left:25px;">所属分类：'+d.list[o].catename+'</span><span style="padding-left:25px;">发布时间：'+d.list[o].maketime+'</span><span style="padding-left:25px;">浏览量：'+d.list[o].view_count+'</span><span style="padding-left:25px;">点赞量：<span class="count_'+d.list[o].id+'">'+d.list[o].like_count+'</span><span style="padding-left:25px;">评论量：'+d.list[o].comment_count+'</span></span></p>';
					html += '<p style="padding-bottom:5px;font-size:15px;padding-top:10px;"><a style="color:#61BD1A;" href="/index.php/Home/Article/detailArti?id='+d.list[o].id+'">[点击查看文章内容详细...]</a></p>';
					html += '<span style="color:red; font-size:16px; text-align:right; margin-left:50%;" class="likes_msg_'+d.list[o].id+'"></span>';
                	html += '<div style="width:88%;height:1px;margin-left:0.5%;margin-top:-20px;margin-bottom:20px;padding:0px;background-color:#D5D5D5;overflow:hidden;"></div>';
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
				
			}else{
				
				html += '<div class="col-xs-12">';
            	html += '<p class="intro" style="margin-bottom:5px;margin-top:5px;><span style="padding-left:25px;"></span><span style="padding-left:25px;"></span></span></p>';
				html += '<p style="padding-bottom:5px;font-size:15px;" ><a href="javascript:void(0)" style="color:#FE9D10;" onclick="addArticle()">暂无数据，亲来发表一个呗!!!<a></p>';
				html += '<span style="color:red; font-size:15px; text-align:right; margin-left:50%;" class="likes_msg_"></span>';
				html += '</div>';
				
			}
			
			$(".list_news").html(html);
			init();
		}		
	);
}

function addArticle(){
	var session = $('#session_user_id').val();
	if(session == ''){
		alert('请先登录哟！');
	}else{
		window.location.href="<?php echo U('Home/Article/addArticle');?>";	
	}
	
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