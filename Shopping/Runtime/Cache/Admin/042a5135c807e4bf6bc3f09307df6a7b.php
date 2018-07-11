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
       <h2 class="fl">商品属性列表</h2>
       <a href="<?php echo U('Goods/addAttr');?>" class="fr top_rt_btn add_icon">添加属性</a>
      </div>
      <section class="mtb">
       <input type="text" name="attrName" id="attrName" class="textbox textbox_225" placeholder="输入产品关键词或产品货号..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table contents">
       <thead>
       <tr>
        <th>属性</th>
        <th>属性值</th>
        <th>创建时间</th>
        <th>更新时间</th>
        <th>操作</th>
       </tr>
       </thead>
       <tbody>
       <tr><td colspan="5" align="center">暂无数据!</td></tr>
       </tbody>
      </table>
      <aside class="paging">
       <a>第一页</a>
       <a>1</a>
       <a>2</a>
       <a>3</a>
       <a>…</a>
       <a>1004</a>
       <a>最后一页</a>
      </aside>
 </div>
</section>
</body>
</html>

<script>
$(function(){
	init();
	do_sub();
});

function init(){
	//点击提交按钮
	$('.group_btn').bind('click').click(function(){
		do_sub();
	});
}

function do_sub(){
	var attrName = $('#attrName').val();
	$.post('<?php echo U("Goods/listAttrAjax");?>',{'attrName':attrName},function(data){
		var html = '';
		var d = eval("("+data+")");//解析json数据
		if(d.list != false && d.list != null){
			for(var o in d.list){
				html += '<tr>';
				html += '<td class="center">'+d.list[o].attrname+'</td>';
				html += '<td class="center">'+d.list[o].attrValue+'</td>';
				html += '<td class="center">'+d.list[o].createdate+'</td>';
				html += '<td class="center">'+d.list[o].updatedate+'</td>';
				html += '<td class="center">';
				html += '<a href="/mall.php/Admin/Goods/editAttr?id='+d.list[o].id+'" title="编辑" class="link_icon">&#101;</a>';
				html += '<a href="javascript:void(0);" onclick="delAttr('+d.list[o].id+')" title="删除" class="link_icon">&#100;</a>';
				html += '<span id="error_'+d.list[o].id+'"></span>'
				html += '</td>';
				html += '</tr>';
			}
			
			$('.contents>tbody').html(html);
			init();
		}
	});
}

//删除属性操作
function delAttr(id){
	$.post('<?php echo U("Goods/delAttr");?>',{'id':id},function(respon){
		if(respon.errno == 10001){
			$('#error_'+id).html(respon.errmsg);
		}else{
			//localhost.replace(localhost.href);
			do_sub();
		}
	});
}
</script>