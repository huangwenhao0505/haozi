<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/Shopping/Public/css/style.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="/Shopping/Public/js/jquery.js"></script>
<script src="/Shopping/Public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

	(function($){
		$(window).load(function(){
			
			$("a[rel='load-content']").click(function(e){
				e.preventDefault();
				var url=$(this).attr("href");
				$.get(url,function(data){
					$(".content .mCSB_container").append(data); //load new content inside .mCSB_container
					//scroll-to appended content 
					$(".content").mCustomScrollbar("scrollTo","h2:last");
				});
			});
			
			$(".content").delegate("a[href='top']","click",function(e){
				e.preventDefault();
				$(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
			});
			
		});
	})(jQuery);
</script>
</head>
<body>
<!--header-->
<header>
 <h1><img src="images/admin_logo.png"/></h1>
 <ul class="rt_nav">
  <li><a href="http://www.mycodes.net" target="_blank" class="website_icon">站点首页</a></li>
  <li><a href="#" class="clear_icon">清除缓存</a></li>
  <li><a href="#" class="admin_icon">DeathGhost</a></li>
  <li><a href="#" class="set_icon">账号设置</a></li>
  <li><a href="login.html" class="quit_icon">安全退出</a></li>
 </ul>
</header>
<!--aside nav-->
<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar">
 <h2><a href="index.html">起始页</a></h2>
 <ul>
  <li>
   <dl>
    <dt>常用布局示例</dt>
    <!--当前链接则添加class:active-->
    <dd><a href="product_list.html" class="active">商品列表示例</a></dd>
    <dd><a href="product_detail.html">商品详情示例</a></dd>
    <dd><a href="recycle_bin.html">商品回收站示例</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>订单信息</dt>
    <dd><a href="order_list.html">订单列表示例</a></dd>
    <dd><a href="order_detail.html">订单详情示例</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>会员管理</dt>
    <dd><a href="user_list.html">会员列表示例</a></dd>
    <dd><a href="user_detail.html">添加会员（详情）示例</a></dd>
    <dd><a href="user_rank.html">会员等级示例</a></dd>
    <dd><a href="adjust_funding.html">会员资金管理示例</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>基础设置</dt>
    <dd><a href="setting.html">站点基础设置示例</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>配送与支付设置</dt>
    <dd><a href="express_list.html">配送方式</a></dd>
    <dd><a href="pay_list.html">支付方式</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>在线统计</dt>
    <dd><a href="discharge_statistic.html">流量统计</a></dd>
    <dd><a href="sales_volume.html">销售额统计</a></dd>
   </dl>
  </li>
  <li>
   <p class="btm_infor">© DeathGhost.cn 版权所有</p>
  </li>
 </ul>
</aside>

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">商品属性（颜色、尺码、类型、材质。。。）</h2>
      </div>
     <section>
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">属性名称：</span>
        <input type="text" name="attrName" id="attrName" class="textbox textbox_295" placeholder="属性名称"/>
        <span id="errorAttrName"></span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">属性值(X XL)：</span>
        <input type="text" name="attrValue" class="textbox textbox_100 attrValue" placeholder="属性值"/>
        <span id="attrValue"></span>
        <button onclick="addAttrValueBox()">添加</button>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"/>
        <span id="errorSubmit"></span>
       </li>
      </ul>
     </section>
 </div>
</section>

<script>
function addAttrValueBox(){
	html = '<input type="text" name="attrValue" class="textbox textbox_100" style="margin-right:5px;" placeholder="属性值"/>';
	$('#attrValue').append(html);
}

$('.link_btn').bind('click').click(function(){
	var attrName = $('#attrName').val();
	var obj = document.getElementsByName("attrValue");
    var attrValue = "";
    for(var i=0;i<obj.length;i++){
        attrValue += obj[i].value + ",";
    }
	$.ajax({
		type:'post',
		url:'<?php echo U("Goods/addAttr")?>',
		data:{'attrName':attrName,'attrValue':attrValue},
		dataType: 'json',
		success:function(respon){
			if(respon.errno == 10001){
				$("#errorAttrName span").addClass('errorTips');
				$('#errorAttrName').html(respon.errmsg);
			}else if(respon.errno == 10002){
				$('#errorSubmit').html(respon.errmsg);
			}else{
				$('#errorAttrName').empty();
				$('#errorSubmit').html(respon.errmsg);
				window.location.href = "<?php echo U('Goods/listAttr');?>";
			}
		}
	});
});
</script>
</body>
</html>