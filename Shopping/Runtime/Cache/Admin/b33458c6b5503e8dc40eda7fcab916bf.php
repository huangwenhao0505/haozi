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
    <dd><a href="<?php echo U('Attribute/listAttr');?>">属性管理</a></dd>
    <dd><a href="<?php echo U('Category/getGoodsCategoryList')?>">分类管理</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>订单信息</dt>
    <dd><a href="<?php echo U('Order/orderList');?>">订单列表</a></dd>
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
       <h2 class="fl">添加商品分类</h2>
       <a href="<?php echo U('Category/getGoodsCategoryList');?>" class="fr top_rt_btn">返回分类列表</a>
      </div>
     <section>
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">分类名称：</span>
        <input type="text" name="goodsCategoryName" id="goodsCatName" class="textbox textbox_295" placeholder="分类名称"/>
        <span id="errorCatName"></span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">分类：</span>
        <select class="select" name="goodsCategoryId" id="goodsCatId">
         <option value="0">选择商品分类(不选为顶级)</option>
         <?php foreach($goodsCatList as $k => $v){ ?>
         	<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
         <?php } ?>
        </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;">排序：</span>
        <input type="text" name="orderNum" id="orderNum" class="textbox" value="99" placeholder="排序..."/>
       </li>
	   <li>
        <span class="item_name" style="width:120px;">是否显示：</span>
        <input type="radio" name="isShow" value="1" checked="checked"/>是
        <input type="radio" name="isShow" value="0"/>否
       </li>
       <li>
        <span class="item_name" style="width:120px;">上传图片：</span>
        <label class="uploadImg">
         <input type="file"/>
         <span>上传图片</span>
        </label>
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
$('.link_btn').bind('click').click(function(){
	var goodsCatName = $('#goodsCatName').val();
	var goodsCatId = $('#goodsCatId').val();
	var orderNum = $('#orderNum').val();
	var isShow = $("input[type='radio']:checked").val();
	$.ajax({
		type:'post',
		url:'<?php echo U("Category/addGoodsCategory")?>',
		data:{'goodsCategoryName':goodsCatName,'goodsCategoryId':goodsCatId,'orderNum':orderNum,'isShow':isShow},
		dataType: 'json',
		success:function(respon){
			if(respon.errno == 10001){
				$("#errorCatName span").addClass('errorTips');
				$('#errorCatName').html(respon.errmsg);
			}else if(respon.errno == 10002){
				$('#errorSubmit').html(respon.errmsg);
			}else{
				$('#errorCatName').empty();
				$('#errorSubmit').html(respon.errmsg);
			}
		}
	});
});
</script>
</body>
</html>