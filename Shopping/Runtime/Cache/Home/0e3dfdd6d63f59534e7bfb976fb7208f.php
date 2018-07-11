<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Shopping/Public/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Shopping/Public/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Shopping/Public/Home/css/user_style.css" rel="stylesheet" type="text/css" />
<link href="/Shopping/Public/Home/skins/all.css" rel="stylesheet" type="text/css" />
<script src="/Shopping/Public/Home/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/footer.js" type="text/javascript"></script>
<script src="layer/layer.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/iCheck.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/custom.js" type="text/javascript"></script>
<title>订单管理</title>
</head>

<body>
<head>
 <div id="header_top">
  <div id="top">
    <div class="Inside_pages">
      <div class="Collection"><a href="#" class="green">请登录</a> <a href="#" class="green">免费注册</a></div>
	<div class="hd_top_manu clearfix">
	  <ul class="clearfix">
	   <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="#">首页</a></li> 
	   <li class="hd_menu_tit" data-addclass="hd_menu_hover"> <a href="#">我的小充</a> </li>
	   <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="#">消息中心</a></li>
       <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="#">商品分类</a></li>
        <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="#">我的购物车<b>(23)</b></a></li>	
	  </ul>
	</div>
    </div>
  </div>
  <div id="header"  class="header page_style">
  <div class="logo"><a href="index.html"><img src="/Shopping/Public/Home/images/logo.png" /></a></div>
  <!--结束图层-->
  <div class="Search">
        <div class="search_list">
            <ul>
                <li class="current"><a href="#">产品</a></li>
                <li><a href="#">信息</a></li>
            </ul>
        </div>
        <div class="clear search_cur">
           <input name="searchName" id="searchName" class="search_box" onkeydown="keyDownSearch()" type="text">
           <input name="" type="submit" value="搜 索"  class="Search_btn"/>
        </div>
        <div class="clear hotword">热门搜索词：香醋&nbsp;&nbsp;&nbsp;茶叶&nbsp;&nbsp;&nbsp;草莓&nbsp;&nbsp;&nbsp;葡萄&nbsp;&nbsp;&nbsp;菜油</div>
</div>
 <!--购物车样式-->
 <div class="hd_Shopping_list" id="Shopping_list">
   <div class="s_cart"><a href="#">我的购物车</a> <i class="ci-right">&gt;</i><i class="ci-count" id="shopping-amount">0</i></div>
   <div class="dorpdown-layer">
    <div class="spacer"></div>
	 <!--<div class="prompt"></div><div class="nogoods"><b></b>购物车中还没有商品，赶紧选购吧！</div>-->
	 <ul class="p_s_list">	   
		<li>
		    <div class="img"><img src="/Shopping/Public/Home/images/tianma.png"></div>
		    <div class="content"><p class="name"><a href="#">产品名称</a></p><p>颜色分类:紫花8255尺码:XL</p></div>
			<div class="Operations">
			<p class="Price">￥55.00</p>
			<p><a href="#">删除</a></p></div>
		  </li>
		</ul>		
	 <div class="Shopping_style">
	 <div class="p-total">共<b>1</b>件商品　共计<strong>￥ 515.00</strong></div>
	  <a href="Shop_cart.html" title="去购物车结算" id="btn-payforgoods" class="Shopping">去购物车结算</a>
	 </div>	 
   </div>
 </div>
</div>
<!--菜单栏-->
	<div class="Navigation" id="Navigation">
		 <ul class="Navigation_name">
			<li><a href="Home.html">首页</a></li>
			<li><a href="#">你身边的超市</a></li>
			<li><a href="#">预售专区</a><em class="hot_icon"></em></li>
			<li><a href="products_list.html">商城</a></li>
			<li><a href="#">半小时生活圈</a></li>
			<li><a href="#">好评商户</a></li>
			<li><a href="#">热销活动</a></li>
			<li><a href="Brands.html">联系我们</a></li>
		 </ul>			 
		</div>
	<script>$("#Navigation").slide({titCell:".Navigation_name li",trigger:"click"});</script>
    </div>
</head>
<div class="user_style clearfix">
 <div class="user_center clearfix">
   <div class="left_style">
     <div class="menu_style">
     <div class="user_title"><a href="用户中心.html">用户中心</a></div>
     <div class="user_Head">
     <div class="user_portrait">
      <a href="#" title="修改头像" class="btn_link"></a> <img src="/Shopping/Public/Home/images/people.png">
      <div class="background_img"></div>
      </div>
      <div class="user_name">
       <p><span class="name">化海天堂</span><a href="#">[修改密码]</a></p>
       <p>访问时间：2016-1-21 10:23</p>
       </div>           
     </div>
     <div class="sideMen">
     <!--菜单列表图层-->
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_1"></em>订单管理</dt>
      <dd>
        <ul>
          <li> <a href="用户中心-我的订单.html">我的订单</a></li>
          <li> <a href="用户中心-收货地址.html">收货地址</a></li>
          <li> <a href="用户中心-产品预订.html">产品预订</a></li>
        </ul>
      </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_2"></em>会员管理</dt>
        <dd>
      <ul>
        <li> <a href="#"> 用户信息</a></li>
        <li> <a href="#"> 我的收藏</a></li>
        <li> <a href="#"> 我的留言</a></li>
        <li> <a href="#">我的标签</a></li>
        <li> <a href="#"> 我的推荐</a></li>
        <li><a href="#"> 我的评论</a></li>
      </ul>
    </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_3"></em>账户管理</dt>
      <dd>
       <ul>
       <li><a href="用户中心-账户管理.html">账户余额</a></li>
        <li><a href="用户中心-消费记录.html">消费记录</a></li>   
       <li><a href="#">跟踪包裹</a></li>
       <li><a href="#">资金管理</a></li>
      </ul>
     </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_4"></em>分销管理</dt>
      <dd>
        <ul>
          <li> <a href="#">店铺管理</a></li>
          <li> <a href="#">我的盟友</a></li>
          <li> <a href="#">我的佣金</a></li>
          <li> <a href="#">申请提现</a></li>
        </ul>
      </dd>
    </dl>
    </div>
      <script>jQuery(".sideMen").slide({titCell:"dt", targetCell:"dd",trigger:"click",defaultIndex:0,effect:"slideDown",delayTime:300,returnDefault:true});</script>
   </div>
 </div>

 <!--右侧样式属性-->
 <div class="right_style">
 <!--地址管理-->
  <div class="user_address_style">
    <div class="title_style"><em></em>地址管理</div> 
   <div class="add_address">
    <span class="name">编辑收货地址</span>
    <table cellpadding="0" cellspacing="0" width="100%">
     <input type="hidden" id="addressId" value="<?php echo $info['id'];?>"/>
     <tr><td class="label_name">收&nbsp;货&nbsp;&nbsp;人：</td><td><input name="name" id="username" type="text" value="<?php echo $info['name'];?>"  class="add_text" style=" width:100px"/><i>*</i></td></tr>
     <tr><td class="label_name">所在地区：</td><td>
            <select size="1" id="province" onchange="provinceChange()">
              <option value="0">请选择省</option>
            </select>
            <select size="1" id="city" onchange="cityChange()">
              <option value="2">请选择市</option>
            </select>
            <select size="1" id="zone">
              <option value="3">请选择县/区</option>
            </select><i>*</i></td></tr>
     <tr><td class="label_name">街道地址：</td><td><textarea name="content" id="content" cols="" rows="" style=" width:500px; height:100px; margin:5px 0px"><?php echo $info['address'];?></textarea><i>*</i></td></tr>
     <tr><td class="label_name">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编：</td><td><input name="code" id="code" value="<?php echo $info['zipcode'];?>" type="text" class="add_text" style=" width:100px"/><i>*</i></td></tr>
     <tr><td class="label_name">手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：</td><td><input name="phone" id="phone" value="<?php echo $info['phone'];?>" type="text" class="add_text" style=" width:200px"/>&nbsp;&nbsp;<i>*</i></td></tr>
     <tr class="moren_dz" style="color: #999"><td class="label_name"></td>
     	<td><label>
     	<?php if($info['isdefault'] == 1){ ?>
     		<input name="isDefault" type="checkbox" value="1" checked="checked"/>设置为默认地址
     	<?php }else{ ?>
     		<input name="isDefault" type="checkbox" value="1" />设置为默认地址
     	<?php } ?>
     	</label></td>
     </tr>
     <tr><td colspan="2" class="center"><input name="submit" onclick="subEditAddress()" type="submit" value="修改"  class="add_dzbtn"/><input name="" type="reset" onclick="quxiaoEditAddress()" value="取消"  class="reset_btn"/></td></tr>
    </table>
   </div>
   
<script>
$(function(){
	//给省列表赋值
	$.post('<?php echo U("Usercenter/areaList");?>',function(data){
		var d = eval("("+data+")");
		for(var i in d.province){
			$('#province').append('<option value="'+d.province[i].id+'">'+d.province[i].name+'</option>');
		}
	});

});

//点击省时给其市赋值
function provinceChange(){
	//每次改变省时，市的内容清空，下面会给其赋值，如果不清空就会一直叠加。区也对应的清空，加上一个请选择区
	$('#city').empty();
	$('#zone').empty();
	$('#zone').append('<option value="0">请选择区</option>');
	
	//给市赋值
	var provinceId = $('#province').find("option:selected").val();
	var cityId = $('#city').find("option:selected").val();
	$.post('<?php echo U("Usercenter/areaList");?>',{'provinceId':provinceId,'cityId':cityId},function(data){
		var d = eval("("+data+")");
		for(var i in d.city){
			$('#city').append('<option value="'+d.city[i].id+'">'+d.city[i].name+'</option>');
		}
	});
}

//点击市时给其区赋值
function cityChange(){
	//每次市改变时，区的清空，下面会给其赋值，如果不清空就会一直叠加。
	$('#zone').empty();

	//给区赋值
	var provinceId = $('#province').find("option:selected").val();
	var cityId = $('#city').find("option:selected").val();
	$.post('<?php echo U("Usercenter/areaList");?>',{'provinceId':provinceId,'cityId':cityId},function(data){
		var d = eval("("+data+")");
		if(d.zone != false && d.zone != null){
			for(var i in d.zone){
				$('#zone').append('<option value="'+d.zone[i].id+'">'+d.zone[i].name+'</option>');
			}
		}else{
			$('#zone').append('<option value="0">-------</option>');
		}
		
	});
}

//取消编辑收货地址
function quxiaoEditAddress(){
	window.location.href = "/mall.php/Home/Usercenter/addAddress";
}

//保存编辑
function subEditAddress(){
	var id = $('#addressId').val();
	var name = $('#username').val();
	var phone = $('#phone').val();
	var areaId = $('#province').find("option:selected").val();
	var cityId = $('#city').find("option:selected").val();
	var zoneId = $('#zone').find("option:selected").val();
	var address = $('#content').val();
	var zipCode = $('#code').val();
	var isDefault = $("input[name='isDefault']:checked").val();
	$.post('<?php echo U("Usercenter/editAddress");?>',{'id':id,'name':name,'phone':phone,'areaId':areaId,'cityId':cityId,'zoneId':zoneId,'address':address,'zipCode':zipCode,'isDefault':isDefault},function(respon){
		if(respon.errno == 10001){
			alert(respon.errmsg);
		}else{
			window.location.href = "/mall.php/Home/Usercenter/addAddress";
		}
	});
}
</script>
   
  </div>
 </div>
 </div>
 </div>
<script>
$(document).ready(function(){
  $('.moren_dz input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
});
</script>

<script>

</script>

<!--网站地图-->
<div class="fri-link-bg clearfix">
    <div class="fri-link">
        <div class="logo left margin-r20"><img src="/Shopping/Public/Home/images/fo-logo.jpg" width="152" height="81" /></div>
        <div class="left"><img src="/Shopping/Public/Home/images/qd.jpg" width="90"  height="90" />
            <p>扫描下载APP</p>
        </div>
       <div class="">
    <dl>
	 <dt>新手上路</dt>
	 <dd><a href="#">售后流程</a></dd>
     <dd><a href="#">购物流程</a></dd>
     <dd><a href="#">订购方式</a> </dd>
     <dd><a href="#">隐私声明 </a></dd>
     <dd><a href="#">推荐分享说明 </a></dd>
	</dl>
	<dl>
	 <dt>配送与支付</dt>
	 <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
	</dl>
	<dl>
	 <dt>售后保障</dt>
	 <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
	</dl>
	<dl>
	 <dt>支付方式</dt>
	 <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
	</dl>	
    <dl>
	 <dt>帮助中心</dt>
	 <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
	</dl>
     <dl>
	 <dt>帮助中心</dt>
	 <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
	</dl>
     <dl>
	   
   </div>
    </div>
</div>
<!--网站地图END-->
<!--网站页脚-->
<div class="copyright">
    <div class="copyright-bg">
        <div class="hotline">为生活充电在线 <span>招商热线：****-********</span> 客服热线：400-******</div>
        <div class="hotline co-ph">
            <p>版权所有Copyright ©***************</p>
            <p>*ICP备***************号 不良信息举报</p>
            <p>总机电话：****-*********/194/195/196 客服电话：4000****** 传 真：********
                
                <a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
        </div>
    </div>
</div>
</body>
</html>