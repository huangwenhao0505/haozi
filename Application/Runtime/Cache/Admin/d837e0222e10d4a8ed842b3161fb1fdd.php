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
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo U('Admin/Index/index');?>">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?php echo U('Admin/Article/listArticle');?>">文章管理</a><span class="crumb-step">&gt;</span><span>新增文章</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        	<tr>
                        		<th style="width:100px;">所属类别：</th>
                        		<td>
                        			<select id="categoryId">
                        				<option value="0" onclick="removeSonCate(0)">请选择类别</option>
                        				<?php foreach($list as $k => $v){ ?>
                        					<option value="<?php echo $v['id'];?>" onclick="sonCategory(<?php echo $v['id'];?>)"><?php echo $v['name'];?></option>	                					
                        				<?php } ?>
                        			</select>
                        			
                        			<span id="sonlist"></span>
                        			
                        			<span id="error_cid" style="font-size:20px;color:red;text-align:center;"></span>
                        		</td>
                        	</tr>
                        	<tr>
                        		<th style="width:100px;">所属类型：</th>
                        		<td>
                        			<select id="fineId">
                        				<option value="0">普通类型</option>
                        				<option value="1"/>fine类型</option>
                        			</select>
                        			
                        			<span id="sonlist"></span>
                        			
                        			<span id="error_cid" style="font-size:20px;color:red;text-align:center;"></span>
                        		</td>
                        	</tr>
                            <tr>
                                <th style="width:100px;">标题：</th>
                                <td>
                                	<input type="text" id="title" name="title"/>
                                	<span id="error_title" style="font-size:20px;color:red;text-align:center;"></span>
                                </td>   
                            </tr>
                            <tr>
                                <th>简介：</th>
                                <td>
	                                <textarea name="jianjie" class="common-textarea" id="jianjie" cols="30" style="width: 80%;" rows="10"></textarea>
	                                <span id="error_jianjie" style="font-size:20px;color:red;text-align:center;"></span>
                                </td>
                                
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>封面图：</th>
                                <td>
	                                <input name="img" id="img" type="file" value="" onchange="uploadimg('img1','img')">
	                                <img class="load0" name="img1" id="img1" src=""/>
	                                <span id="error_img" style="font-size:20px;color:red;text-align:center;"></span>
                                </td>
                                
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td>
	                                <script type="text/plain" id="content" style="width:90%;height:300px;"></script>
	                                <span id="error_content" style="font-size:20px;color:red;text-align:center;"></span>
                                </td>
                                
                            </tr>
                            <tr><td colspan="2" class="error" style="font-size:20px;color:red;text-align:center;"><span></span></td></tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" id="but" value="提交" type="button">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->

</div>

<script src="/Public/jquery-1.8.3.min.js"></script>
<!-- 上传图片插件 -->
<script type="text/javascript" src="/Public/ajaxfileupload.js"></script>
<!-- 加载编辑器的容器 -->
  <!-- 配置文件 -->
  <script type="text/javascript" src="/third-party/ueditor/ueditor.config.js"></script>
  <!-- 编辑器源码文件 -->
  <script type="text/javascript" src="/third-party/ueditor/ueditor.all.js"></script>
  <!-- 实例化编辑器 -->
  <script type="text/javascript">
      var ue = UE.getEditor('content');
  </script>
  
<script>
//上传按钮改变时触发  增加用户体验度  实现实时显示选择的图片
function uploadimg(imgid,fileid) {
 //imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
    $("#"+imgid).attr("src","");//加载loading图片
    $.ajaxFileUpload({            
     	url: '<?php echo U("Admin/Article/artiPosterImg");?>',
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
	            		$('#error_img').html(err_msg);
	                	break;
	            	case "400": error_msg="非法上传";
	            		$('#error_img').html(err_msg);
	                	break;
	            	case "404": error_msg="文件为空";
	            		$('#error_img').html(err_msg);
	                	break;
	            	default :error_msg="服务器不稳定";
	            	$('#error_img').html(err_msg);
            	}
            	//alert(error_msg);
            }else{
            	$('#error_img').empty();
            	$("#"+imgid).attr("src",data.path);//加载返回的图片路径并附加上样式
                //$("#"+hiddenid).val(data.path);//给对应的隐藏域赋值，以便提交时给后台
            }              
        },
    });
}

//点击提交按钮时触发
$('#but').bind().click(function(){
	var cid = $('#soncat').val();
	var fineId = $('#fineId').val();
	var title = $('#title').val();
	var jianjie = $('#jianjie').val();
	var ue = UE.getEditor('content');
	var content = ue.getContent();
	
	$.ajaxFileUpload({
		type:'post',
		url:'<?php echo U("Admin/Article/artiPosterImg");?>',
	    secureuri: false,
        fileElementId: 'img',  //file标签的id
        dataType: 'json',  
		success:function(data){
			var img_url = data.path;	//获取上传的图片路径
			$.ajax({
				type:'post',
				url:'<?php echo U("Admin/Article/addArticle");?>',
				data:{'cid':cid,'fineId':fineId,'title':title,'jianjie':jianjie,'editorValue':content,'img_url':img_url}, 
		        dataType: 'json',
		        success:function(respon){
		        	if(respon.errno == 10001){
						$('#error_title').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_jianjie').empty();
						$('#error_img').empty();
						$('#error_content').empty();
						$('#error_cid').empty();
					}else if(respon.errno == 10002){
						$('#error_jianjie').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_title').empty();
						$('#error_img').empty();
						$('#error_content').empty();
						$('#error_cid').empty();
					}else if(respon.errno == 10003){
						$('#error_content').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_title').empty();
						$('#error_jianjie').empty();
						$('#error_img').empty();
						$('#error_cid').empty();
					}else if(respon.errno == 10004){
						$('tr td.error span').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
					}else if(respon.errno == 10005){
						$('#error_img').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_title').empty();
						$('#error_jianjie').empty();
						$('#error_content').empty();
						$('#error_cid').empty();
					}else if(respon.errno == 10006)
					{
						$('#error_cid').html('<img src="/Public/Home/login/images/tip-error.png">'+respon.errmsg);
						$('#error_title').empty();
						$('#error_jianjie').empty();
						$('#error_content').empty();
						$('#error_img').empty();
					}else if(respon.errno == 10000){
						window.location.href="<?php echo U('Admin/Article/listArticle')?>";
					}
		        }
			});	
		}
	}); 
})	

/** start类别处理 **/
//点击父类别，显示其对应的子类别
function sonCategory(id){
	$.post('<?php echo U("Admin/Category/sonCategoryList");?>',{'id':id},
		function(data)
		{
			var html = '';
			var d = eval("("+data+")");
			if(d.list != false && d.list != null)
			{
				html += '<select name="soncat" id="soncat" class="select">';
				for(var o in d.list)
				{
					html += '<option value="'+d.list[o].id+'">'+d.list[o].name+'</option>';
				}
				html += '</select>';
			}
			else
			{
				//没有子类别，这里就保存其父类别的id
				html += '<select name="soncat" id="soncat" class="select">';
				html += '<option value="'+id+'" selected="selected">该类别暂没有子类别</option>';
				html += '</select>';
			}
			
			$('#sonlist').show();
			$('#sonlist').html(html);
		}		
	);
}

//点击请选择时，隐藏掉span标签
function removeSonCate(id){
	var html = '';
	html += '<select name="soncat" id="soncat" class="select">';
	html += '<option value="'+id+'"></option>';
	html += '</select>';
	$('#sonlist').html(html);
	$('#sonlist').hide();
}
/** end 类别处理 **/
</script>
</body>
</html>