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


<!-- 多图上传插件 -->
<link href="/third-party/diyupload/css/webuploader.css" rel="stylesheet"><!-- 多图上传必须样式 -->
<link href="/third-party/diyupload/css/diyUpload.css" rel="stylesheet"><!-- 多图上传必须样式 -->

<script src="/third-party/diyupload/js/jquery-2.1.4.min.js"></script><!-- 必须jq -->
<script src="/third-party/diyupload/js/webuploader.html5only.min.js"></script><!-- 多图上传必须的js -->
<script src="/third-party/diyupload/js/diyUpload.js"></script><!-- 多图上传必须的js -->

<style>
/** 去除file标签的未选择任何标签字样 **/
input[type="file"] {
  color: transparent;
}
</style>
            
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
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Article/listArti');?>" class="nav-link">优美文章</a>
                                </li>
                                <li class="nav-item active">
                                    <a href="<?php echo U('Home/Photo/index');?>" class="nav-link">相册列表</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo U('Home/Fun/index');?>" class="nav-link">休闲娱乐</a>
                                </li>
                            </ul>                        
                        </div>
                        
                    </nav>  

                </div>                                  
            </div>            
        </div>
        
        <!-- <div class="tm-about-img-container"></div> -->
        
<form action="">

	<!-- 个人相册列表封面图  -->
	<div class="am-g" style="width:100%;float:left;padding-left:10%;">
		<div style="width:48%;float:left;">
		  <p style="color:#333;"><span style="color:red;font-size:30px;">1.</span>个人相册列表封面图，用于在网站相册列表页显示，只能有一张哟，可以更改! </p>
		  <form class="am-form" method="post" enctype="multipart/form-data" >
		    <div>
		      <input type="file" name="fileImg" id="user-pic" onchange="uploadChangeImg('user-img','user-pic')" accept="image/jpeg,image/jpg,image/png,image/gif">
		      <img style="widht:200px;height:150px;" class="am-img-circle am-img-thumbnail" id="user-img" src="<?php echo $info['img'];?>" alt=""/><br/>
		      <p>
		      	<span id="abcd">请选择要上传的文件...</span>
		   		<span id="error_img" style="font-size:20px;color:red;text-align:center;"></span>
		      </p>
		      <button type="button" onclick="location.replace(location.href)" class="btn btn-primary btn-xs">取消</button>
			  <button type="button" onclick="uploadimg('user-img','user-pic')" class="btn btn-success btn-xs">保存</button>
			  <span id="shuaxing"></span>
			  <input type="hidden" name="user_uid" id="user_uid" value="<?php echo session('id');?>"/>
		    </div>
		  </form>
	    </div>
	    
	    <div style="width:40%;margin-top:15px;padding-left:2%;float:left;">
	    	<p style="color:red;">说明：只有登录的用户才可以上传图片哟~~</p>
	    	<p style="color:#333;"><span style="color:red;font-size:20px;">①</span>请先上传封面图!</p>
	    	<p style="color:#333;"><span style="color:red;font-size:20px;">②</span>上传相册图片!</p>
	    	<p style="color:#333;"><span style="color:red;font-size:20px;">③</span>没有上传封面图的,就算上传了相册图片别人也是看不到你的图片的哟!</p>
	    	<p></p>
	    	<!-- <p>不懂的看我<span style="font-size:30px;color:red;">→</span>简单来说就是<span style="color:red;font-size:30px;">1.</span>上传封面图  <span style="color:red;font-size:30px;">2.</span>上传你的个性图片</p> -->
	    </div>
	</div>

	<!-- 个人相册图片（插件自带的）  -->
	<div style="width:90%;float:left;margin-left:10%;">
		<p style="padding-top:10px;color:#333;"><span style="color:red;font-size:30px;">2.</span>上传相册图片，可以有多张<span id="photo_span_id" style="padding-left:15px;color:red;"></span></p>
		<div id="box" style="width:60%;padding-left:10px;"> 
		<span id="photo_error_span" style="color:red;"></span>
	        <div id="test" class="webuploader-container"></div>  <!--上传控件按钮-->
			
			<!--回填区域 以下是图片回填的区域，用于编辑页的信息回填-->
			<!-- 
			<div class="parentFileBox" style="" id="gallery">             
	          <ul class="fileBoxUl">
	            
	            <li class="diyUploadHover" id="aaa1"> 
	              <div class="viewThumb">
	              
	                <img src="uploadfiles/57da3c766d143.jpg"/>
	               
	              </div>
	              <div class="diyCancel" onclick="del_img(this);"></div>      
	            </li>
				
				<li class="diyUploadHover" id="aaa2"> 
	              <div class="viewThumb">
	              
	                <img src="uploadfiles/d39212643ae699fb82c89e661454_600_469.jpg"/>
	                
	              </div>
	              <div class="diyCancel" onclick="del_img(this);"></div>      
	            </li>
	            
	          </ul>         
	        </div>
	         -->
			<!--回填区域-->
			
	    </div>
    </div> 
	

	<!--例子2-->
	<!-- 
	<p>图片上传例子2</p>
    <div id="demo">  
        <div id="as"></div>  上传控件按钮
    </div>  
	
	<input type="button" value="提交" />
	-->
</form>

<script type="text/javascript">  
    /**  
     * 服务器地址,成功返回,失败返回参数格式依照jquery.ajax习惯;  
     * 其他参数同WebUploader  
     */
    var uid = $('#user_uid').val();
    if(uid == '' || uid == null){
    	var msg = "登录后此处可显示上传控件,请先登录!";
    	var button = '<button type="button" class="btn btn-info" onclick="login()" style="margin-left:10px;">点击登录</button>';
    	$('#photo_error_span').html(msg+button);
    }else{
    	
	    $('#test').diyUpload({  
	        url : '<?php echo U("Home/Photo/uploadUserMuchPhoto");?>',  //这个是文件上传处理文件 用框架的请对应文件上传的控制器 
			//formData: { _token: "{{csrf_token()}}"}, //Laravel 框架下需要 csrf_token 才能上传，可以在 formData 里面添加需要带过去的参数
			dataType:"json",
	        success : function(data) {  
	            console.info(data); 
				if(data.status == 1){
					//var span =$("<input type='hidden' value='"+data.imagepath+"' name='img[]'>");//将上传后保存的路径返回 通过隐藏域放进表单里面 
					//$("#test").append(span);
					
					/* 此处把得到的Img地址传入到后台，保存到数据库*/
					var img = data.imagepath;
					$.ajax({
			    		type:'post',
			    		url:'<?php echo U("Home/Photo/addUserPhoto");?>',
			    		data:{'img':img},
			    		success:function(respon){
		        			if(respon.errno == 10001 || respon.errno == 20001){
		        				$('#photo_span_id').html(respon.errmsg);
		        			}
		        		}
			    	});
					
				}
				
	        },  
	        error : function(err) {  
	            console.info(err);  
	        }  
	    }); 
    
    }
  
	/**下面的这个例子是可以设置多图上传插件的一些参数：最多上传多少个图片，总上传文件大小、单个文件大小等*/
    /**$('#as').diyUpload({  
        url : '<?php echo U("Home/Photo/uploadUserMuchPhoto");?>',  
        success : function(data) {  
            console.info(data);  
        },  
        error : function(err) {  
            console.info(err);  
        },  
        buttonText : '选择文件',  
        chunked : true,  
        // 分片大小  
        chunkSize : 10 * 1024 * 1024,  
        //最大上传的文件数量, 总文件大小,单个文件大小(单位字节);  
        fileNumLimit : 50,  
        fileSizeLimit : 100 * 1024 * 1024,  
        fileSingleSizeLimit : 10 * 1024 * 1024,  
        accept : {}  
    });*/  
	
	/**回填区域图片删除*/
	function del_img(obj){
		$(obj).parent().remove();
	}
	
	/**跳转到登录页面*/
	function login(){
		window.location.href="<?php echo U('Home/Login/ajaxLogin');?>";
	}
	
</script> 

<!-- 上传单张图片插件 -->
<script type="text/javascript" src="/Public/ajaxfileupload.js"></script>

<script>
//选择图片时，图片位置的图片改变，  但不保存到数据库
function uploadChangeImg(imgid,fileid){
//imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
   $("#"+imgid).attr("src","");//加载loading图片
   $.ajaxFileUpload({            
    	url: '<?php echo U("Home/Photo/uploadUserPhotoIndex");?>',
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
            		$('#error_img').html(error_msg);
                	break;
            	case "400": error_msg="非法上传";
            		$('#error_img').html(error_msg);
                	break;
            	case "404": error_msg="文件为空";
            		$('#error_img').html(error_msg);
                	break;
            	default :error_msg="服务器不稳定";
            		$('#error_img').html(error_msg);
           	}
           	//alert(error_msg);
           }else{
        	$('#abcd').empty();
        	$('#error_img').empty();
           	$("#"+imgid).attr("src",data.path).addClass("load1");//加载返回的图片路径并附加上样式
               //$("#"+hiddenid).val(data.path);//给对应的隐藏域赋值，以便提交时给后台
           }              
       }
   });	
}

//点击保存，图片位置的图片改变，图片保存到数据库
function uploadimg(imgid,fileid) {
 //imgid指<img />标签id,fileid表示<input type='file' />文件上传标签的id,hiddenid指隐藏域标签id
    $("#"+imgid).attr("src","");//加载loading图片
    $.ajaxFileUpload({ 
    	type:'post',
     	url:'<?php echo U("Home/Photo/uploadUserPhotoIndex");?>',
        secureuri:false,
        fileElementId:fileid,  
        dataType:'json',              
        success:function (data){   //data的内容都是在后台php代码中自定义的,json格式返回后在这里以对象的方式的访问
            
        	if(typeof (data.error) != 'undefined'){
             	var error_msg = "你没有选择任何文件哟!";
             	var button = '<button type="button" onclick="location.replace(location.href)" class="btn btn-info">刷新</button>';
             	switch(data.error){
              	case "101": error_msg;
              		$('#error_img').html(error_msg);
              		$('#shuaxing').html(button);
                  	break;
              	case "102": error_msg;
              		$('#error_img').html(error_msg);
              		$('#shuaxing').html(button);
                  	break;
              	case "400": error_msg;
              		$('#error_img').html(error_msg);
              		$('#shuaxing').html(button);
                  	break;
              	case "404": error_msg;
              		$('#error_img').html(error_msg);
              		$('#shuaxing').html(button);
                  	break;
              	default :error_msg;
              		$('#error_img').html(error_msg);
              		$('#shuaxing').html(button);
             	}
             	//alert(error_msg);
             }else{
          	   var img = data.path;
              	$.ajax({
              		type:'post',
              		url:'<?php echo U("Home/Photo/addUserPhotoIndex");?>',
              		data:{'img':img},
              		success:function(respon){
              			if(respon.errno == 10001 || respon.errno == 10002 || respon.errno == 20001){
              				$('#error_img').html(respon.errmsg);
              			}else if(respon.errno == 10000){
              				$('#error_img').html(respon.errmsg);
              				$("#"+imgid).attr("src",data.path);
              			}
              		}
              	});
             }
        }
    });
}

</script>