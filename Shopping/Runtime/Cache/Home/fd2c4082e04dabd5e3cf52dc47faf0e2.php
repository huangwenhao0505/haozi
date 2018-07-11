<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>17商城</title>
<link type="text/css" href="/Shopping/Public/Home/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/Shopping/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Shopping/Public/Home/js/js.js"></script>
<script src="/Shopping/Public/Home/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$("#kinMaxShow").kinMaxShow();
});
</script>
</head>

<body>
 <div class="mianCont">
  <div class="top">
   <span>您好！欢迎来到17商城 请&nbsp;<a href="login.html">[登录]</a>&nbsp;<a href="reg.html">[注册]</a></span>
   <span class="topRight">
    <a href="vip.html">我的17</a>&nbsp;| 
    <a href="order.html">我的订单</a>&nbsp;| 
    <a href="login.html">会员中心</a>&nbsp;|
    <a href="contact.html">联系我们</a>
   </span>
  </div><!--top/-->
  <div class="lsg">
   <h1 class="logo"><a href="index.html"><img src="/Shopping/Public/Home/images/logo.png" width="217" height="90" /></a></h1>
   <form action="#" method="get" class="subBox">
    <div class="subBoxDiv">
     <input type="text" class="subLeft" />
     <input type="image" src="/Shopping/Public/Home/images/subimg.png" width="63" height="34" class="sub" />
     <div class="hotWord">
      热门搜索：
      <a href="proinfo.html">冷饮杯</a>&nbsp;
      <a href="proinfo.html">热饮杯</a> &nbsp;
      <a href="proinfo.html">纸杯</a>&nbsp;
      <a href="proinfo.html">纸巾</a>  &nbsp;
      <a href="proinfo.html">纸巾</a> &nbsp;
      <a href="proinfo.html">纸杯</a>&nbsp;
     </div><!--hotWord/-->
    </div><!--subBoxDiv/-->
   </form><!--subBox/-->
   <div class="gouwuche">
    <div class="gouCar">
     <img src="/Shopping/Public/Home/images/gouimg.png" width="19" height="20" style="position:relative;top:6px;" />&nbsp;|&nbsp;
     <strong class="red">0</strong>&nbsp;件&nbsp;|
     <strong class="red">￥ 0.00</strong> 
     <a href="order.html">去结算</a> <img src="/Shopping/Public/Home/images/youjian.jpg" width="5" height="8" />    
    </div><!--gouCar/-->
    <div class="myChunlv">
     <a href="vip.html"><img src="/Shopping/Public/Home/images/mychunlv.jpg" width="112" height="34" /></a>
    </div><!--myChunlv/-->
   </div><!--gouwuche/-->
  </div><!--lsg/-->
  <div class="pnt">
   <div class="pntLeft">
    <h2 class="Title">所有商品分类</h2>
    <ul class="InPorNav">
     <?php foreach($goodsCategory as $k => $v){ ?>
	     <li><a href="product.html"><?php echo $v['name'];?></a>
	      <div class="chilInPorNav">
	      	<?php if($v['parentList'] != array()){ ?>
		      	<?php foreach($v['parentList'] as $key => $val){ ?>
		      		<a href="#"><?php echo $val['name']?></a>
		      	<?php } ?>
	      	<?php } ?>
	      </div><!--chilLeftNav/-->
	     </li>
     <?php } ?>
    </ul><!--InPorNav/-->
   </div><!--pntLeft/-->
   <div class="pntRight">
    <ul class="nav">
     <li class="navCur"><a href="index.html">商城首页</a></li>
     <li><a href="product.html">促销中心</a></li>
     <li><a href="login.html">会员中心</a></li>
     <li><a href="help.html">帮助中心</a></li>
     <div class="clears"></div>
     <div class="phone">TEL：021-12345678</div>
    </ul><!--nav/-->