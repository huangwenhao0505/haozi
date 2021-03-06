<?php if (!defined('THINK_PATH')) exit();?><!-- 引用公共头文件 -->
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <script type="text/javascript" src="/Public/Admin/js/modernizr.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    
    <!-- 图片上传插件 -->
    <script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="<?php echo U('Admin/Index/index')?>" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="<?php echo U('Admin/Index/index');?>">首页</a></li>
                <li><a href="<?php echo U('Home/Index/index');?>" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="<?php echo U('Admin/Login/changeAdmin');?>">管理员</a></li>
                <li><a href="<?php echo U('Admin/Login/changePass');?>">修改密码</a></li>
                <li><a href="javascript:void(0);" id="logout">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Yulu/yuluList');?>"><i class="icon-font">&#xe008;</i>语录管理</a></li>
                        <li><a href="<?php echo U('Admin/Article/listArticle');?>"><i class="icon-font">&#xe005;</i>文章管理</a></li>
                        <li><a href="<?php echo U('Admin/Article/articleCommentList')?>"><i class="icon-font">&#xe012;</i>文章评论管理</a></li>
                        <li><a href="<?php echo U('Admin/Joke/listJoke');?>"><i class="icon-font">&#xe006;</i>幽默笑话管理</a></li>
                        <li><a href="<?php echo U('Admin/User/userList');?>"><i class="icon-font">&#xe052;</i>人员管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="<?php echo U('Admin/Category/listCategory');?>"><i class="icon-font">&#xe033;</i>类别管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe006;</i>考试系统</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Exam/createExam');?>"><i class="icon-font">&#xe008;</i>创建试卷</a></li>
                    	<li><a href="<?php echo U('Admin/Exam/examList');?>"><i class="icon-font">&#xe052;</i>试卷列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>文件管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Uploade/index');?>"><i class="icon-font">&#xe017;</i>上传文件</a></li>
                        <li><a href="<?php echo U('Admin/Uploade/fileList');?>"><i class="icon-font">&#xe017;</i>文件列表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
<script>
$('#logout').bind().click(function(){
	$.ajax({
		type:'post',
		url:'<?php echo U("Admin/Login/logout");?>',
		success:function(){
			window.location.href="<?php echo U('Admin/Login/ajaxlogin')?>";
		}
	});
});
</script>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">用户名:</th>
                            <td><input class="common-text" placeholder="用户名" name="username" value="" id="username" type="text"></td>
                            <th width="70">昵称:</th>
                            <td><input class="common-text" placeholder="昵称" name="nickname" value="" id="nickname" type="text"></td>
                            <th width="'300">
	                           	<td>
		                           	<select name="state_type" id="state_type">
						              <option value="">激活状态</option>
						              <option value="0">未激活</option>
						              <option value="1">已激活</option>
						            </select>
					            </td>
                           	</th>
                           	
                           	<!-- 
                           	<th width="'300">
	                           	<td>
		                           	<select name="qq_type" id="qq_type">
						              <option value="">是否已注册网站账号</option>
						              <option value="1">已注册</option>
						              <option value="2">未注册</option>
						            </select>
					            </td>
                           	</th>
                           	 -->
                            <td>
                            <input class="btn btn-primary btn2" name="sub" id="sub_but" value="查询" type="button">
                            <input type="hidden" id="curr_page" value="1"/>
							<input type="hidden" id="total_page" value="1"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                    	<i class="icon-font"></i>用户管理
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" id="result-tab" width="100%">
                    	<thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>昵称</th>
                            <th>生日</th>
                            <th>头像</th>
                            <th>邮箱</th>
                            <th>是否激活</th>
                            <th>关联QQ昵称</th>
                            <th>关联QQ头像</th>
                            <th>账号注册时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<tr><td colspan="11" align="center">请选择条件进行查询!</td></tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>

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
		var cur = $('#curr_page').val();	//当前页
		if( Number(cur) > 1 ){
			$('#curr_page').val( Number(cur)-1 );	//上一页	
			do_sub();
		}
		
	});
	//点击下一页
	$('#nex_page').unbind('click').click(function(){
		var cur = $('#curr_page').val();	//当前页
		var total = $('#total_page').val();	//总页数
		if( Number(cur) < Number(total) ){
			var a = $('#curr_page').val( Number(cur) + 1 ); //下一页
			do_sub();
		}
		
	});
	//搜索条件发生改变
	$("#username").unbind("change").change(function(){
		$("#curr_page").val(1);
		$("#total_page").val(1);
	});
}

function do_sub(){
	var username = $('#username').val();
	var nickname = $('#nickname').val();
	var stateType = $('#state_type').val();
	var qqType = $('#qq_type').val();
	var currPage = $('#curr_page').val()
	$.post('<?php echo U("Admin/User/userListAjax")?>',{'username':username,'nickname':nickname,'stateType':stateType,'qqType':qqType,'currPage':currPage},
		function(data){
			var html = '';
			var d = eval("("+data+")");	//解析json格式
			if(d.list != false && d.list != null){	//内容不为空
				for(var o in d.list){	//遍历
					
					html += '<tr>';
					html += '<td>'+d.list[o].id+'</td>';
					html += '<td>'+d.list[o].username+'</td>';
					html += '<td>'+d.list[o].nickname+'</td>';
					html += '<td>'+d.list[o].u_birthday+'</td>';
					if(d.list[o].u_img != '' || d.list[o].u_img != null){
						html += '<td><img src="'+d.list[o].u_img+'" style="width:50px;height:50px;"/></td>';
					}else{
						html += '<td>无头像</td>';
					}
					html += '<td>'+d.list[o].email+'</td>';
					html += '<td style="color:#FE9D0E;">'+d.list[o].states+'</td>';
					html += '<td>'+d.list[o].qq_nickname+'</td>';
					if(d.list[o].qq_img != '' || d.list[o].qq_img != null){
						html += '<td><img src="'+d.list[o].qq_img+'" style="width:50px;height:50px;"/></td>';
					}else{
						html += '<td>无头像</td>';
					}
					html += '<td>'+d.list[o].regist_time+'</td>';
					html += '<td class="error">'
						if(d.list[o].is_black == 1){
							html += '<span class="link-update">已是黑名单用户</span>  ';
							html += '<input type="button" onclick="removeBlack('+d.list[o].id+')" value="解除" class="btn btn-primary btn2"/>'
						}else{
							html += '<a href="javascript:void(0);" class="btn btn-warning btn2" style="width:50%;" onclick="addBlack('+d.list[o].id+')">加入黑名单</a>';
						}
                    html += '<span style="font-size:20px;color:red;text-align:center;"></span>';
					html += '</td>';
					html += '</tr>';
				}
				
				if(d.total_page == 1){
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==1){
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==d.total_page){
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=3 && d.currPage>1 && d.currPage<d.total_page){
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}
				$("#total_page").val(d.total_page);	//获取总页数
				
			}else{
				html = '<tr><td colspan="11" align="center">暂无符合条件记录！</td></tr>';
			}
			
			$("#result-tab>tbody").html(html);
			init();
		}
	);
}

function addBlack(id){
	var res = confirm('确定要将该用户加入黑名单吗？');
	if(res == true){
		$.ajax({
			type:'get',
			url:'<?php echo U("Admin/User/addBlackUser");?>',
			data:{'id':id},
			success:function(){
				do_sub();
			}
		});
	}
}

function removeBlack(id){
	var res = confirm('确定要将该用户从黑名单列表中解除限制吗？');
	if(res == true){
		$.ajax({
			type:'get',
			url:'<?php echo U("Admin/User/removeBlackUser");?>',
			data:{'id':id},
			success:function(){
				do_sub();
			}
		});
	}
}

</script>
</body>
</html>