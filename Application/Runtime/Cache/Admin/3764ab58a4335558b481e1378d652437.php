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
                        <li><a href="<?php echo U('Admin/Uploade/addVideo');?>"><i class="icon-font">&#xe017;</i>上传视频</a></li>
                        <li><a href="<?php echo U('Admin/Uploade/fileList');?>"><i class="icon-font">&#xe017;</i>视频列表</a></li>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">博文评论管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">作者:</th>
                            <td><input class="common-text" placeholder="作者" name="author" value="" id="author" type="text"></td>
                            <th width="120">标题:</th>
                            <td><input class="common-text" placeholder="标题" name="title" value="" id="title" type="text"></td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="keywords" type="text"></td>
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
                        <a href="<?php echo U('Admin/Article/addArticle');?>"><i class="icon-font"></i>新增文章</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" id="result-tab" width="100%">
                    	<thead>
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>评论ID</th>
                            <th>发布人</th>
                            <th>封面图</th>
                            <th>标题</th>
                            <th>评论量</th>
                            <th>评论级别</th>
                            <th>评论内容</th>
                            <th>评论用户</th>
                            <th>评论时间</th>
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
		var curr_page = $('#curr_page').val();
		if( Number(curr_page) > 1){
			$('#curr_page').val( Number(curr_page)-1 );
			do_sub();
		}
	});
	
	//点击下一页
	$('#nex_page').unbind('click').click(function(){
		var curr_page = $('#curr_page').val();
		var total_page = $('#total_page').val();
		if( Number(curr_page) < Number(total_page) ){
			$('#curr_page').val( Number(curr_page)+1 );
			do_sub();
		}
	});
	
	//搜索条件发生改变
	$('#author').unbind('change').change(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
	
	$('#title').unbind('change').change(function(){
		$('#curr_page').val(1);
		$('#total_page').val(1);
	});
}

function do_sub(){
	var author = $('#author').val();
	var title = $('#title').val();
	var curr_page = $('#curr_page').val();
	$.post('<?php echo U("Admin/Article/articleCommentListAjax");?>',{'author':author,'title':title,'currPage':curr_page},
		function(data){
			var html = '';
			var d = eval('('+data+')');	//解析json数据
			if(d.list != false && d.list != null){
				for(var o in d.list){
					html += '<tr>';
					html += '<td></td>';
					html += '<td>'+d.list[o].id+'</td>';
					html += '<td>'+d.list[o].author+'</td>';
					html += '<td></td>';
					html += '<td>'+d.list[o].title+'</td>';
					html += '<td>'+d.list[o].comment_count+'</td>';
					html += '<td>'+d.list[o].parent_name+'</td>';
					html += '<td>'+d.list[o].content+'</td>';
					html += '<td>'+d.list[o].username+'</td>';
					html += '<td>'+d.list[o].create_date+'</td>';
					html += '<td class="error">';
                    html += '<a class="link-del" href="javascript:void(0)" onclick="articleCommentDel('+d.list[o].id+')">删除</a>';
                    html += '<span style="font-size:20px;color:red;text-align:center;"></span>';
                    html += '</td>';
					html += '</tr>';
					html += '</html>';
				}
				
				if(d.totalPage == 1){	//只有一页时
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.totalPage+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.totalPage >= 2 && d.currPage == 1){	//有两页以上，当前页为第一页时
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.totalPage+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.totalPage >= 2 && d.currPage == d.totalPage){	//有两页以上，当前页为最后一页
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.totalPage+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.totalPage >= 3 && d.currPage > 1 && d.currPage < d.totalPage){	//当前页不在第一页，也不在最后一页
					$("#result-tab>tfoot").html('<tr><td colspan="11" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.totalPage+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}
				$("#total_page").val(d.totalPage);	//获取总页数
				
			}else{
				html = '<tr><td colspan="11" align="center">暂无符合条件记录！</td></tr>';
			}
			
			$('#result-tab>tbody').html(html);
			init();
		}	
	);
}
</script>

<script>
function articleCommentDel(id){
	var con = confirm('删除后不可恢复，确定要删除吗？');
	if(con == true){
		$.ajax({
			type:'post',
			url:'<?php echo U("Admin/Article/ArticleCommentDel")?>',
			data:{'id':id},
			success:function(respon){
				if(respon.errno == 10001){
					$('tr td.error span').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
				}else{
					do_sub();
				}
			},dataType:'json'
		});
	}
}

</script>
</body>
</html>