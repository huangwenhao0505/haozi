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

<style>
.bg{
	background-color:#00C5CD;
	text-align:center;
}
.tb{
	text-align:center;
}
</style>

    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">类别管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="<?php echo U('Admin/Category/addCategory');?>"><i class="icon-font"></i>新增类别</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <!-- <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a> -->
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" id="result-tab" width="100%">
                    	<thead>
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" id="allChoose" name="" type="checkbox"></th>
                            <th class="tc">ID</th>
                            <th class="tc">顶级类别</th>
                            <th class="tc">二级类别</th>
                            <th class="tc">发布时间</th>
                            <th class="tc">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<tr><td colspan="9" align="center">请选择条件进行查询!</td></tr>
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
	$("#author").unbind("change").change(function(){
		$("#curr_page").val(1);
		$("#total_page").val(1);
	});
}

function do_sub(){
	$.post('<?php echo U("Admin/Category/listCategory");?>',
		function(data)
		{
			var html = '';
			var d = eval("("+data+")");
			if(d.list != false && d.list != null)
			{
				for(var i in d.list)
				{
					html += '<tr>';
					html += '<td class="tc" width="5%"><input class="allChoose" name="check" type="checkbox" value="'+d.list[i].id+'"></td>';
					html += '<td class="tb">'+d.list[i].id+'</td>';
					html += '<td class="bg">'+d.list[i].name+'</td>';
					html += '<td></td>';
					html += '<td class="tb">'+d.list[i].createdate+'</td>';
					html += '<td class="tb"><a href="javascript:void(0)" onclick="delCate('+d.list[i].id+')">删除</a></td>';
					html += '</tr>';
					for(var o in d.list[i].sonCategory)
					{
						html += '<tr>';
						html += '<td class="tc" width="5%"><input class="allChoose" name="check" type="checkbox" value="'+d.list[i].sonCategory[o].id+'"></td>';
						html += '<td class="tb">'+d.list[i].sonCategory[o].id+'</td>';
						html += '<td></td>';
						html += '<td class="tb">'+d.list[i].sonCategory[o].name+'</td>';
						html += '<td class="tb">'+d.list[i].sonCategory[o].createdate+'</td>';
						html += '<td class="tb"><a href="javascript:void(0)" onclick="delSonCate('+d.list[i].sonCategory[o].id+')">删除</a></td>';
						html += '</tr>';
					}
				}
			}
			else
			{
				html += '<tr><td colspan=6 align="center">暂无数据!</td></tr>';
			}
			
			$('#result-tab > tbody').html(html);
			init();
		}		
	);
}

//是否删除
function delCate(id){
	var res = confirm('删除之后不可恢复，其对应的所有子类别也将全部删除，是否确定要删除？');
	if(res == true){
		$.ajax({
			type:'post',
			url:'<?php echo U("Admin/Category/delCategory");?>',
			data:{'id':id},
			success:function(respon){
				if(respon.errno == 10001){
					$('tr td.error span').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
				}else{
					do_sub();
					//location.replace(location.href);
				}
			}
		});
	}
}

function delSonCate(id){
	var res = confirm('删除之后不可恢复，是否确定要删除？');
	if(res == true){
		$.ajax({
			type:'post',
			url:'<?php echo U("Admin/Category/delCategory");?>',
			data:{'id':id},
			success:function(respon){
				if(respon.errno == 10001){
					$('tr td.error span').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
				}else{
					do_sub();
					//location.replace(location.href);
				}
			}
		});
	}
}

//批量删除
$('#allChoose').unbind('click').click(function(){
	$("input[name='check']").prop('checked',this.checked);
});

$('#batchDel').unbind('click').click(function(){
	var checkedNum = $("input[name='check']:checked").length;
	if(checkedNum == 0){
		alert('请至少选择一项！');
		return false;
	}
	if(confirm("是否确定要删除所选项？")){
		var checkedList = new Array();
		$("input[name='check']:checked").each(function(){
			checkedList.push( $(this).val() );
		});
		$.ajax({
			type:'post',
			url:'<?php echo U("Admin/Category/allDelCategory");?>',
			data:{'idString':checkedList.toString()},
			success:function(result){
				if(result.errno == 10000){
					$("[name='check']:checkbox").attr('checked',false);
					window.location.reload(); //没有选中删除的刷新
				}else{
					alert(result.errmsg);
				}
			}
		});
	}
});
</script>
</body>
</html>