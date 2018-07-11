<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/Shopping/Public/Admin/css/style.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="/Shopping/Public/Admin/js/jquery.js"></script>
<script src="/Shopping/Public/Admin/js/jquery.mCustomScrollbar.concat.min.js"></script>
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
    <dd><a href="<?php echo U('Goods/goodsList');?>" class="active">商品管理</a></dd>
    <dd><a href="<?php echo U('Goods/listAttr');?>">属性管理</a></dd>
    <dd><a href="<?php echo U('Category/getGoodsCategoryList')?>">分类管理</a></dd>
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
       <h2 class="fl">商品列表</h2>
       <a href="<?php echo U('Goods/goodsAdd');?>" class="fr top_rt_btn add_icon">新增商品</a>
      </div>
      <section class="mtb">
       <select class="select" name="categoryId" id="categoryId">
        <option value="0">商品类型选择</option>
        <?php foreach($categoryList as $k => $v){ ?>
        	<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
        <?php } ?>
       </select>
       <input type="text" name="goodsName" id="goodsName" class="textbox textbox_225" placeholder="输入产品关键词或产品货号..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
       <thead>
       <tr>
        <th>缩略图</th>
        <th>商品名称</th>
        <th>商品类型</th>
        <th>单价</th>
        <th>销售数量</th>
        <th>创建时间</th>
        <th>修改时间</th>
        <th>是否上架</th>
        <th>操作</th>
       </tr>
       </thead>
       <tbody>
       <tr><td colspan="9" align="center">暂无数据!</td></tr>
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
	$('.group_btn').unbind('click').click(function(){
		do_sub();
	});
}

function do_sub(){
	var categoryId = $('#categoryId').val();
	var goodsName = $('#goodsName').val();
	$.post('<?php echo U("Goods/goodsList");?>',{'categoryId':categoryId,'goodsName':goodsName},function(data){
		var html = '';
		var d = eval("("+data+")");
		if(d.list != false && d.list != null){
			for(var i in d.list){
		       html += '<tr>';
		       html += '<td class="center"><img src="" width="50" height="50"/></td>';
		       html += '<td class="center">'+d.list[i].name+'</td>';
		       html += '<td class="center">'+d.list[i].categoryname+'</td>';
		       html += '<td class="center"><strong class="rmb_icon">'+d.list[i].price+'</strong></td>';
		       html += '<td class="center">'+d.list[i].soldnum+'</td>';
		       html += '<td class="center">'+d.list[i].createdate+'</td>';
		       html += '<td class="center">'+d.list[i].updatedate+'</td>';
		       html += '<td class="center">'+d.list[i].isshow+'</td>';
		       html += '<td class="center">';
			   html += '<a href="/mall.php/Admin/Goods/goodsEdit?id='+d.list[i].id+'" title="编辑" class="link_icon">&#101;</a>';
			   if(d.list[i].ismarketable == 1){
				   html += '<a href="javascript:void(0);" style="color:blue;" onclick="changeMarke('+d.list[i].id+',0)">下架</a>';
			   }else{
				   html += '<a href="javascript:void(0);" style="color:blue;" onclick="changeMarke('+d.list[i].id+',1)">上架</a>';
			   }
			   html += '<a href="javascript:void(0);" onclick="goodsDel('+d.list[i].id+')" title="删除" class="link_icon">&#100;</a>';
			   html += '<span id="error_'+d.list[i].id+'" style="color:red;"></span>'
			   html += '</td>';
		       html += '</tr>';
			}
			
			$('.table>tbody').html(html);
			init();
		}
	});
}

//商品上架或下架操作
function changeMarke(id,type){
	$.ajax({
		type:'post',
		url:'<?php echo U("Goods/changeMarketable")?>',
		data:{'id':id,'type':type},
		success:function(respon){
			location.replace(location.href);
		}
	});
}

//删除商品
function goodsDel(id){
	$.ajax({
		type:'post',
		url:'<?php echo U("Goods/goodsDel");?>',
		data:{'id':id},
		success:function(respon){
			if(respon.errno == 10001){
				$('#error_'+id).html(respon.errmsg);
			}else{
				do_sub();
			}
		}
	});
}
</script>