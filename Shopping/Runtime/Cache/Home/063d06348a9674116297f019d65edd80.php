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
<script src="/Shopping/Public/Home/layer/layer.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/iCheck.js" type="text/javascript"></script>
<script src="/Shopping/Public/Home/js/custom.js" type="text/javascript"></script>
<title>订单管理</title>
</head>

<body>

<head>
 <div id="header_top">
  <div id="top">
    <div class="Inside_pages">
      <?php if(empty($_SESSION["id"])){ ?>
      	<div class="Collection"><a href="/index.php/Home/Login/ajaxLogin" class="green">请登录</a> <a href="/index.php/Home/Login/ajaxRegist" class="green">免费注册</a></div>
      <?php }else{ ?>
      	<?php if($_SESSION['qq_nickname'] != ''){ ?>
      		<div class="Collection">
				<img src="<?php echo $_SESSION['qq_img'];?>" class="am-comment-avatar" style="width:30px;height:30px;margin-right:2px;"> 
				<span class="green" style="padding-bottom:5px;margin-bottom:5px;"><?php echo $_SESSION['qq_nickname'];?>你好</span>&nbsp;
			</div>
		<?php }else{ ?>
			<div class="Collection">
				<img src="<?php echo $_SESSION['u_img'];?>" class="am-comment-avatar" style="width:30px;height:30px;margin-right:2px;"> 
				<span class="green" style="padding-bottom:5px;margin-bottom:5px;"><?php echo $_SESSION['username'];?>你好</span>&nbsp;
			</div>
		<?php } ?>
      	<div class="Collection"><a href="<?php echo U('Usercenter/orderList')?>" class="green">会员中心</a> <a href="javascript:void(0);" id="loginOut" class="green">安全退出</a></div>
      <?php } ?>
	<div class="hd_top_manu clearfix">
	  <ul class="clearfix">
	   <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="<?php echo U('Home/Index/index');?>">商城首页</a></li> 
	   <li class="hd_menu_tit" data-addclass="hd_menu_hover"> <a href="/index.php/Home/Index/index">网站首页</a> </li>
        <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="<?php echo U('Home/Usercenter/myCartList');?>">我的购物车<b><?php echo $cartcount;?></b></a></li>	
	  </ul>
	</div>
    </div>
  </div>
  <div id="header"  class="header page_style">
  <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Shopping/Public/Home/images/logo.png" /></a></div>
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
           <input name="" type="button" onclick="searchGoods()" value="搜 索"  class="Search_btn"/>
        </div>
        <div class="clear hotword">热门搜索词：香醋&nbsp;&nbsp;&nbsp;茶叶&nbsp;&nbsp;&nbsp;草莓&nbsp;&nbsp;&nbsp;葡萄&nbsp;&nbsp;&nbsp;菜油</div>
</div>
 <!--购物车样式-->
 <div class="hd_Shopping_list" id="Shopping_list">
   <div class="s_cart"><a href="<?php echo U('Usercenter/myCartList')?>">我的购物车</a> <i class="ci-right">&gt;</i><i class="ci-count" id="shopping-amount"><?php echo $cartcount;?></i></div>
   <div class="dorpdown-layer">
    <div class="spacer"></div>
	 <!--<div class="prompt"></div><div class="nogoods"><b></b>购物车中还没有商品，赶紧选购吧！</div>-->
	 <ul class="p_s_list" id="p_s_lists">
	 	<?php if($cartcount <= 3){ ?>	   
			<?php foreach($cartlist as $k => $v){ ?>
			  <li>
			    <div class="img"><img src="<?php echo $v['img'];?>"></div>
			    <div class="content"><p class="name"><a href="#"><?php echo $v['name'];?></a></p><p><?php echo $v['attrvalue'];?></p></div>
				<div class="Operations">
				<p class="Price"><?php echo $v['goodsnum'];?> * ￥<?php echo $v['price'];?></p>
				<!-- <p><a href="javascript:void(0);" onclick="delCart(<?php echo $v['id'];?>)">删除</a></p> -->
				</div>
			  </li>
			 <?php } ?>
		 <?php }else{ ?>
		 	<?php foreach($cartlist as $k => $v){ ?>
			  <li>
			    <div class="img"><img src="<?php echo $v['img'];?>"></div>
			    <div class="content"><p class="name"><a href="#"><?php echo $v['name'];?></a></p><p><?php echo $v['attrvalue'];?></p></div>
				<div class="Operations">
				<p class="Price"><?php echo $v['goodsnum'];?> * ￥<?php echo $v['price'];?></p>
				<!-- <p><a href="javascript:void(0);" onclick="delCart(<?php echo $v['id'];?>)">删除</a></p> -->
				</div>
			  </li>
			 <?php } ?>
			 <li><a href="<?php echo U('Usercenter/myCartList');?>" style="float:right;font-size:16px;">...查看更多</a></li>
		 <?php } ?>
		</ul>		
	 <div class="Shopping_style">
	 <div class="p-total">共<b><?php echo $cartcount;?></b>件商品　共计<strong>￥ <?php echo $cartprice;?></strong></div>
	  <a href="<?php echo U('Usercenter/myCartList')?>" title="去购物车结算" id="btn-payforgoods" class="Shopping">去购物车结算</a>
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

<script>
$('#loginOut').click(function(){
	$.ajax({
		type:'post',
		url:'/index.php/Home/Login/ajaxOut',
		success:function(){
			window.location.href="<?php echo U('Home/Index/index')?>";
		}
	});
});
</script>


<div class="user_style clearfix">
 <div class="user_center clearfix">
   <div class="left_style">
     <div class="menu_style">
     <div class="user_title"><a href="javascript:void(0);">用户中心</a></div>
     <div class="user_Head">
     <div class="user_portrait">
      <!-- <a href="#" title="修改头像" class="btn_link"></a> --> <img src="<?php echo $img;?>">
      <div class="background_img"></div>
      </div>
      <div class="user_name">
       <p><span class="name"><?php echo $nickname;?></span><!-- <a href="#">[修改密码]</a> --></p>
       <p>访问时间：<?php echo $logintime;?></p>
       </div>           
     </div>
     <div class="sideMen">
     <!--菜单列表图层-->
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_1"></em>订单管理</dt>
      <dd>
        <ul>
          <li> <a href="<?php echo U('Usercenter/orderList');?>">我的订单</a></li>
          <li> <a href="<?php echo U('Usercenter/addAddress');?>">收货地址</a></li>
          <li> <a href="<?php echo U('Usercenter/myCartList');?>">我的购物车</a></li>
        </ul>
      </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_2"></em>会员管理</dt>
        <dd>
      <ul>
        <li> <a href="<?php echo U('Usercenter/myCollectList');?>"> 我的收藏</a></li>
        <!-- 
        <li> <a href="#"> 用户信息</a></li>
        <li> <a href="#"> 我的留言</a></li>
        <li> <a href="#"> 我的标签</a></li>
        <li> <a href="#"> 我的推荐</a></li>
        <li> <a href="#"> 我的评论</a></li>
         -->
      </ul>
    </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_3"></em>账户管理</dt>
      <dd>
       <ul>
        <!-- 
        <li><a href="用户中心-账户管理.html">账户余额</a></li>
        <li><a href="#">跟踪包裹</a></li>
        <li><a href="#">资金管理</a></li>
        -->
        <li><a href="<?php echo U('Usercenter/myPayLogList');?>">消费记录</a></li>   
      </ul>
     </dd>
    </dl>
     <!-- 
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
     -->
    </div>
      <script>jQuery(".sideMen").slide({titCell:"dt", targetCell:"dd",trigger:"click",defaultIndex:0,effect:"slideDown",delayTime:300,returnDefault:true});</script>
   </div>
 </div>

<!--发布商品样式-->
<div class="Inside_pages clearfix">

<div class="right_style">
  <!--内容详细-->
   <div class="title_style"><em></em>发布商品</div>
    <div class="content_style">
     <div class="Release_product_style">
     <form>
      <input type="hidden" id="orderId" value="<?php echo $orderId;?>"/>
      
      <?php foreach($list as $k => $v){ ?>
	      <table cellpadding="0" cellspacing="0" width="100%">
	      	<input type="hidden" name="goodsId" value="<?php echo $v['goodsid'];?>"/>
	      	<tr>
	       	   <td class="label"><img src="<?php echo $v['img'];?>" width="80px" height="80px"></td>
		       <td class="label"><?php echo $v['name'];?></td>
		       <td class="label"><?php echo $v['attrvalue'];?></td>
		       <td class="label"><?php echo $v['goodsnum'];?></td>
		       <td class="label">￥<?php echo $v['amount'];?></td>
	        </tr> 
	   			<table cellpadding="0" cellspacing="0" width="100%">
	   				<tr>
	   					<td class="label">发表评论：</td>
	   					<td colspan="4">
	     					<input type="radio" name="type_<?php echo $v['goodsid']?>" value="1" checked="checked"/>好评
	     					<input type="radio" name="type_<?php echo $v['goodsid']?>" value="2"/>中评
	     					<input type="radio" name="type_<?php echo $v['goodsid']?>" value="3"/>差评
	     				</td>
	   				</tr>
	       			<tr> 
	       				<td></td>
	       				<td colspan="4"><textarea style="border:solid 1px #f00;width:80%;height:100px;" id="textContent_<?php echo $v['goodsid'];?>"></textarea></td>
	       			</tr>
	      		</table>
	     </table>
     <?php } ?>
      
      <a href="javascript:void(0);" onclick="subGoodsComment()" class="Next_btn">提交商品资料</a>
      
     </form>
     </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function subGoodsComment(){
	//商品id
	var goodsIdArray = new Array();
	$("input[name='goodsId']").each(function(){
		goodsIdArray.push($(this).val());
	});
	//商品评论内容
	var goodsContentArray = new Array();
	for(var i in goodsIdArray){
		var content = $('#textContent_'+goodsIdArray[i]).val();
		goodsContentArray.push(content);
	}
	//商品评论类型
	var typeArray = new Array();
	for(var i in goodsIdArray){
		var type = $("input[name='type_"+goodsIdArray[i]+"']:checked").val();
		typeArray.push(type);
	}
	
	var goodsIdStr = goodsIdArray.toString();
	var goodsContentStr = goodsContentArray.toString();
	var goodsTypeStr = typeArray.toString();
	
	var orderId = $("#orderId").val();//订单id
	
	$.post('<?php echo U("Usercenter/goodsComment")?>',{'orderId':orderId,'goodsIdStr':goodsIdStr,'goodsContentStr':goodsContentStr,'goodsTypeStr':goodsTypeStr},function(respon){
		if(respon.errno == 10001){
			alert(respon.errmsg);
		}
	});
}
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