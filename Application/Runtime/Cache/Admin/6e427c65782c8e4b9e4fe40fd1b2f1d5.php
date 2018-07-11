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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?php echo U('Admin/Exam/createExam');?>">答题系统</a><span class="crumb-step">&gt;</span><span>添加试题</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <input type="button" onclick="addQuestion()" value="添加试题"/>
                <input type="hidden" id="clickNum" value="0"/>
                <input type="hidden" id="examId" value="<?php echo $examId;?>"/>
            </div>
            <div id="boxQuestion"></div>
        </div>

    </div>
    <!--/main-->
</div>

</body>
</html>

<script>
//添加试题
function addQuestion(){
	//每点击一次加1
	var num = $('#clickNum').val();
	num = parseInt(num)+1;
	$('#clickNum').val(num);//再重新给clickNum赋值
	var numId = $('#clickNum').val();//获取新的值

	var html = '';
	html += '<div id="box_'+numId+'">';
	html += '<table class="result-tab" width="100%">';
	html += '<thead><tr>';
	html += '<th class="tc" width="5%"><input class="allChoose" id="allChoose" name="" type="checkbox"></th>';	   
	html += '<th>标题</th><th>类型</th><th>选项A</th><th>选项B</th><th>选项C</th><th>选项D</th><th>正确答案</th><th>操作</th>';   
	html += '</tr></thead>';      
	html += '<tbody><tr>';      
	html += '<td></td>';
	html += '<td><input type="text" name="title" id="title_'+numId+'"/></td>';       
	html += '<td>';
	html += '<input type="radio" name="type_'+numId+'" value="1" checked="checked" onclick="radioOrCheckbox(1)"/>单选<\t>';
	html += '<input type="radio" name="type_'+numId+'" value="2" onclick="radioOrCheckbox(2)"/>多选';
	html += '</td>';
	
	html += '<td><input type="text" name="optionA" id="optionA_'+numId+'"/></td>';   
	html += '<td><input type="text" name="optionB" id="optionB_'+numId+'"/></td>';   
	html += '<td><input type="text" name="optionC" id="optionC_'+numId+'"/></td>';   
	html += '<td><input type="text" name="optionD" id="optionD_'+numId+'"/></td>';
	
	/** 点击单选时此项显示 **/
	html += '<td class="raidoRightOption">';
	html += '<input type="radio" name="rightOption_'+numId+'" value="A"/>A<br/>';
	html += '<input type="radio" name="rightOption_'+numId+'" value="B"/>B<br/>';
	html += '<input type="radio" name="rightOption_'+numId+'" value="C"/>C<br/>';
	html += '<input type="radio" name="rightOption_'+numId+'" value="D"/>D';
	html += '</td>';
	
	/** 点击多选时此项显示 **/
	html += '<td class="checkboxRightOption" style="display:none;">';
	html += '<input type="checkbox" name="rightOption_'+numId+'" value="A"/>A<br/>';
	html += '<input type="checkbox" name="rightOption_'+numId+'" value="B"/>B<br/>';
	html += '<input type="checkbox" name="rightOption_'+numId+'" value="C"/>C<br/>';
	html += '<input type="checkbox" name="rightOption_'+numId+'" value="D"/>D';
	html += '</td>';
	
	html += '<td><input type="button" onclick="subQuestion('+numId+')" value="确定"/> |';   
	html += '<input type="button" onclick="" value="取消"/> ';
	html += '<span id="error_'+numId+'"></span></td>';
	html += '</tr></tbody>';   
	html += '</table>'; 
	html += '</div>';
	html += '<br/>';
	       
	$('#boxQuestion').append(html);
}

//点击试题答案类型显示不同的正确答案选项
function radioOrCheckbox(type){
	if(type == 1)
	{
		$('.raidoRightOption').css('display','block');
		$('.checkboxRightOption').css('display','none');
	}
	else if(type == 2)
	{
		$('.raidoRightOption').css('display','none');
		$('.checkboxRightOption').css('display','block');
	}
}

//提交试题
function subQuestion(numId){
	var examId = $('#examId').val();
	var title = $('#title_'+numId).val();
	var type = $('input[name="type_'+numId+'"]:checked ').val();//获取试题类型
	var optionA = $('#optionA_'+numId).val();
	var optionB = $('#optionB_'+numId).val();
	var optionC = $('#optionC_'+numId).val();
	var optionD = $('#optionD_'+numId).val();

	//获取正确答案
	if(type == 1)
	{
		var rightOption = $('input[name="rightOption_'+numId+'"]:checked').val();
	}
	else if(type == 2)
	{
		var rightOptionArray = new Array();
		$('input[name="rightOption_'+numId+'"]:checked').each(function(){
			rightOptionArray.push($(this).val());
		});
		//var rightOption = rightOptionArray.toString();
		var rightOption = rightOptionArray.join("|");
	}
	
	$.ajax({
		type:'post',
		url:'<?php echo U("Admin/Exam/addQuestion");?>',
	    data:{'examId':examId,'title':title,'type':type,'optionA':optionA,'optionB':optionB,'optionC':optionC,'optionD':optionD,'rightOption':rightOption},
	    success:function(respon)
	    {
	    	if(respon.errno == 10001)
	    	{
	    		$('#error_'+numId).html(respon.errmsg);
	    	}
	    	else
	    	{
	    		alert(respon.errmsg);	
	    	}
	    },dataType:'json'
	});
}
</script>