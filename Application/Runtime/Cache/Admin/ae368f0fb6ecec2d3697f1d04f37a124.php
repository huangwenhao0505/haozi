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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">语录管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">作者:</th>
                            <td><input class="common-text" placeholder="作者" name="author" value="" id="author" type="text"></td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="keywords" type="text"></td>
                            <th width="'300">
	                           	<td>
		                           	<select name="uid_type" id="uid_type">
						              <option value="">作者类别</option>
						              <option value="1">后台管理员</option>
						              <option value="2">前台用户</option>
						            </select>
					            </td>
                           	</th>
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
                        <a href="<?php echo U('Admin/Yulu/yuluAdd');?>"><i class="icon-font"></i>新增语录</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <!-- <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a> -->
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" id="result-tab" width="100%">
                    	<thead>
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" id="allChoose" name="" type="checkbox"></th>
                            <th>ID</th>
                            <th>发布人</th>
                            <th>发布人类别</th>
                            <th>内容</th>
                            <th>审核状态</th>
                            <th>点赞量</th>
                            <th>发布时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<tr><td colspan="8" align="center">请选择条件进行查询!</td></tr>
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
	$.post('<?php echo U("Admin/Yulu/yuluListAjax")?>',{'uid_type':$('#uid_type').val(),'author':$('#author').val(),'keywords':$('#keywords').val(),'currPage':$('#curr_page').val()},
		function(data){
			var html = '';
			var d = eval("("+data+")");	//解析json格式
			if(d.list != false && d.list != null){	//内容不为空
				for(var o in d.list){	//遍历
					html += '<tr>';
					if(d.list[o].uid_type == 1){	//只有自己添加的才能被选中删除
						html += '<td class="tc" width="5%"><input class="allChoose" name="check" type="checkbox" value="'+d.list[o].id+'"></td>';
					}else{	//改变了name的值  check变为了user_check，这样全选时就选中不了用户写的数据了
						html += '<td class="tc" width="5%"><input class="allChoose" name="user_check" type="checkbox" disabled="disabled" value="'+d.list[o].id+'"></td>';
					}
					html += '<td>'+d.list[o].id+'</td>';
					html += '<td>'+d.list[o].author+'</td>';
					html += '<td style="color:#FE9D0E;">'+d.list[o].type+'</td>';
					html += '<td>'+d.list[o].content+'</td>';
					html += '<td>'
						if(d.list[o].is_ok == 0){
							html += '<span style="color:red;padding-left:5px;padding-right:5px;">未通过</span>';
							html += '<a href="javascript:void(0);" onclick = "change(this, '+d.list[o].id+', 1)" class="btn btn-primary btn2">通过</a>';
							
						}else if(d.list[o].is_ok == 1){
							html += '<span style="color:red;padding-left:5px;padding-right:5px;">已通过</span>';
							html += '<a href="javascript:void(0);" onclick = "change(this, '+d.list[o].id+', 0)" class="btn btn-warning btn2">禁用</a>';
						}
						+'</td>';
					html += '<td>'+d.list[o].like_count+'</td>';
					html += '<td>'+d.list[o].maketime+'</td>';
					html += '<td class="error">'
                        if(d.list[o].uid_type == 1){	//只能修改或删除管理员自己添加的
                        	html += '<a class="link-update" href="/index.php/Admin/Yulu/yuluEdit?id='+d.list[o].id+'">修改</a> | ';
                        	html += '<a class="link-del" href="" onclick="yuluDel('+d.list[o].id+')">删除</a>';
                        }else{
                        	html += '<a class="link-del" href="javascript:void(0)">没有权限(只能禁用)</a>';
                        }
                        html += '<span style="font-size:20px;color:red;text-align:center;"></span>';
							 +'</td>';
					html += '</tr>';
				}
				
				if(d.total_page == 1){
					$("#result-tab>tfoot").html('<tr><td colspan="9" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==1){
					$("#result-tab>tfoot").html('<tr><td colspan="9" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous disabled"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=2 && d.currPage==d.total_page){
					$("#result-tab>tfoot").html('<tr><td colspan="9" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next disabled"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}else if(d.total_page>=3 && d.currPage>1 && d.currPage<d.total_page){
					$("#result-tab>tfoot").html('<tr><td colspan="9" style="padding-left:40%; text-align:center;"><nav><ul class="pager"><li class="previous"><a href="javascript:void(0);" id="pre_page"><span aria-hidden="true">&larr;</span> 上一页</a></li><li class="disabled"><a>共 '+d.count+'条, 当前 '+d.currPage+'/'+d.total_page+' 页</a></li><li class="next"><a href="javascript:void(0);" id="nex_page">下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav></td></tr>');
				}
				$("#total_page").val(d.total_page);	//获取总页数
				
			}else{
				html = '<tr><td colspan="9" align="center">暂无符合条件记录！</td></tr>';
			}
			
			$("#result-tab>tbody").html(html);
			init();
		}
	);
}

//禁用和启用
function change(obj,id,state){
	if(state == 1){
		var res = confirm('通过后将会在前端显示，是否确认通过？');
		if(res == true){
			$.ajax({
				type:'post',
				url:'<?php echo U("Admin/Yulu/yuluChange")?>',
				data:{'id':id,'state':state},
				success:function(){
					do_sub();
					//location.replace(location.href);
				}
			});
		}
	}else if(state == 0){
		var res = confirm('禁用后将不会在前端显示，是否确认禁用？');
		if(res == true){
			$.ajax({
				type:'post',
				url:'<?php echo U("Admin/Yulu/yuluChange")?>',
				data:{'id':id,'state':state},
				success:function(){
					do_sub();
					//location.replace(location.href);
				}
			});
		}
	}
}

//删除
function yuluDel(id){
	var res = confirm('删除之后不可恢复，是否确定要删除？');
	if(res == true){
		$.ajax({
			type:'post',
			url:'<?php echo U("Admin/Yulu/yuluDel");?>',
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

/**
 * 批量删除
 */
$('#allChoose').unbind('click').click(function(){
	$("input[name='check']").prop("checked",this.checked);
});

$('#batchDel').unbind('click').click(function(){
	var checkedNum = $("input[name='check']:checked").length; 
	if(checkedNum == 0) {
		alert("请选择至少一项！");
		return false;
	}
	if(confirm("确定要删除所选项目？")) { 
		var checkedList = new Array(); 
		$("input[name='check']:checked").each(function() { checkedList.push($(this).val()); });
		//alert(checkedList.toString());
		$.ajax({ 
			type: "POST", 
			url: "<?php echo U('Admin/Yulu/allDelYulu');?>", 
			data: {'id':checkedList.toString()}, 
			success: function(result) {
				if(result.errno == 10000){
					$("[name ='check']:checkbox").attr("checked", false); 
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