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
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">试题管理</span></div>
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
                    	所属试卷：<span style="color:red;font-size:18px"><?php echo $examInfo['papername'];?></span>
                        <a href="<?php echo U('Admin/Exam/createExam');?>"><i class="icon-font"></i>新增试题</a>
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
                            <th>试题名称</th>
                            <th>试题类型</th>
                            <th>A选项</th>
                            <th>B选项</th>
                            <th>C选项</th>
                            <th>D选项</th>
                            <th>正确选项</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($list as $k => $v){?>
                        		<tr>
	                        		<td></td>
	                        		<td><?php echo $v['id'];?></td>
	                        		<td><?php echo $v['title'];?></td>
	                        		<td><?php echo $v['type'];?></td>
	                        		<td><?php echo $v['optiona'];?></td>
	                        		<td><?php echo $v['optionb'];?></td>
	                        		<td><?php echo $v['optionc'];?></td>
	                        		<td><?php echo $v['optiond'];?></td>
	                        		<td><?php echo $v['rightoption'];?></td>
	                        		<td><?php echo $v['createdate'];?></td>
	                        		<td>
	                        		<input type="button" onclick='delQuestion(<?php echo $v["id"]?>)' value="删除试题"/>
	                        		</td>
                        		</tr>
                        	<?php } ?>
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

</body>
</html>

<script>
function delQuestion(id){
	$.ajax({
		type:'get',
		url:'<?php echo U("Admin/exam/delQuestion");?>',
		data:{'id':id},
		success:function(respon){
			if(respon.errno == 10001)
			{
				alert(respon.errmsg);
			}
			else
			{
				location.replace(location.href);
			}
		}
	});
}


</script>