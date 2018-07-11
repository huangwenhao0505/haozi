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
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>爬虫管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/News/index');?>"><i class="icon-font">&#xe017;</i>爬虫列表</a></li>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">爬虫管理</span></div>
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
                        <a href="<?php echo U('Admin/News/addRule');?>"><i class="icon-font"></i>新增爬虫规则</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <!-- <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a> -->
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" id="result-tab" width="100%">
                    	<thead>
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" id="allChoose" name="startCheck" type="checkbox"></th>
                            <th>规则id</th>
                            <th>任务来源</th>
                            <th>种子链接</th>
                            <th>种子名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<tr><td colspan="7" align="center">请选择条件进行查询!</td></tr>
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
	do_sub();
});

function do_sub(){
	$.post('<?php echo U("Admin/News/getRuleList");?>',
		function(data){
			var html = '';
			var d = eval("("+data+")");	//解析json格式
			if(d.result != false && d.result != null){	//内容不为空
				for(var i in d.result){	//遍历
					html += '<tr>';
					html += '<td class="tc" width="5%"><input class="allChoose" name="check" type="checkbox" value="'+d.result[i].id+'"></td>';
					html += '<td>'+d.result[i].id+'</td>';
					html += '<td>'+d.result[i].name+'</td>';
					html += '<td>'+d.result[i].url+'</td>';
					html += '<td>'+d.result[i].cateName+'</td>';
					html += '<td>'+d.result[i].createDate+'</td>';
					html += '<td>';
					html += '<a href="javascript:void(0);" onclick="delRule('+d.result[i].id+')">删除</a> | ';
					html += '<a href="/index.php/Admin/News/startCrawler?id='+d.result[i].id+'" target="_blank" onclick="startNews('+d.result[i].id+')">开始爬虫</a>';
					html += '</td>';
					html += '</tr>';
				}
				
			}else{
				html = '<tr><td colspan="7" align="center">暂无符合条件记录！</td></tr>';
			}
			
			$("#result-tab>tbody").html(html);
		}
	);
}

/**
 * 删除规则
 @param id 规则id
 */
function delRule(id){
	$.get('<?php echo U("Admin/News/delRule")?>',{'id':id},
		function(data)
		{
			var d = eval("("+data+")");
			if(d.status == 10001)
			{
				alert(d.msg);
				return;
			}
			else
			{
				do_sub();
			}
		}		
	);
}

/**
 * 批量选择
 */
$('#allChoose').unbind('click').click(function(){
	$("input[name='check']").prop("checked",this.checked);
});

/**
 * 批量删除
 */
 $('#batchDel').unbind('click').click(function(){
	var checkedNum = $("input[name='check']:checked").length; 
	if(checkedNum == 0) {
		alert("请选择至少一项！");
		return false;
	}
	
	alert("暂未进行处理。。。");
 })
</script>
</body>
</html>