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

 <!--右侧样式-->
  <div class="right_style">
  <div class="title_style"><em></em>购物车列表</div> 
   <div class="Order_form_style">
     <div class="Order_Operation">
	     <div class="left"> <label><input name="allCheckBox" id="allCheckBox" type="checkbox" class="checkbox"/>全选</label></div>
	     <div class="right_search"><input name="" type="text"  class="add_Ordertext" placeholder="请输入产品标题或订单号进行搜索"/><input name="" type="submit" value="搜索订单" id="subCart"  class="search_order"/></div>
     </div>
     <div class="Order_form_list">
        <table id="goodsCateList">
	        <thead>
	         <tr>
	         <td style="width:25%;">商品</td>
	         <td class="list_name_title4">属性</td>
	         <td class="list_name_title1">单价(元)</td>
	         <td class="list_name_title2">数量</td>
	         <td class="list_name_title4">实付款(元)</td>
	         <td class="list_name_title6">操作</td>
	        </tr>
	        </thead> 
	        <tbody></tbody> 
	        <thead>
	        <!-- 结算样式 -->
		    <tr class="Order_Details" id="subGoodsCart" style="height:200px;display:none;">
			    <td colspan="4"></td>
		    	<td colspan="2" class="operating">
		    	已选商品：<span style="color:red;font-size:20px;padding-right:10px;"><span id="goodsCartCount">0</span></span>
		    	合计：<span style="color:red;font-size:20px;">￥<span id="goodsCartPrice">0</span></span>
		    	<input type="button" id="confirmOrder" value="结算" class="confirm_Order"/>
		    	<span style="color:red;font-size:20px;" id="errorConfirmOrder"></span>
		    	</td>
		   	</tr>
	        </thead>        
        </table>
    </div>

    
   </div>
  </div>
   
<script>
$(function(){
	init();
	do_sub();
});

function init(){
	$('#subCart').click(function(){
		do_sub();
	});
}

function do_sub(){
	$.post('<?php echo U("Usercenter/myCartList")?>',function(data){
		var html = "";
		var d = eval("("+data+")");
		if(d.list != false && d.list != null){
			for(var i in d.list){
				if(d.list[i].isok == 0){
					//失效的购物车商品
					html += '<tr class="Order_info">';
			    	html += '<td colspan="6" class="Order_form_time">';
			    	html += '创建时间：'+d.list[i].createdate+' <em></em>';
			    	html += '</td>';
			    	html += '</tr>';
			    	html += '<tr class="Order_Details" style="background:#D3D3D3;">';//失效的购物车商品加灰色背景
				    html += '<td colspan="4">';
					html += '<table class="Order_product_style">';
			    	html += '<tbody>';
			    	html += '<tr>';
		    		html += '<td>';
			    	html += '<div class="product_name clearfix">';
			    	html += '<a href="#" class="product_img"><img src="'+d.list[i].goodsInfo.img+'" width="80px" height="80px"></a>';
			    	html += '<a href="3" class="p_name">'+d.list[i].goodsInfo.name+'</a>';
			    	html += '<p class="specification">'+d.list[i].goodsInfo.unitname+'</p>';
			    	html += '</div>';
			    	html += '</td>';
			    	html += '<td>'+d.list[i].attrvalue1+' '+d.list[i].attrvalue2+'</td>';
			    	html += '<td>￥'+d.list[i].goodsInfo.price+'</td>';
			    	html += '<td>'+d.list[i].goodsnum+'</td>';
			    	html += '</tr>';
			    	html += '</tbody>';
			    	html += '</table>';
			    	html += '</td>';
			    	html += '<td class="split_line">￥'+d.list[i].amount+'</td>';
			    	html += '<td class="operating">';
			    	html += '<span style="color:red;">已失效</span>';
			    	html += '<a href="javascript:void(0);" onclick="delCartGoods('+d.list[i].cartid+')">删除</a>';
			    	html += '</td>';
			    	html += '</tr>';
				}else{
					//正常的购物车商品
			    	html += '<tr class="Order_info">';
			    	html += '<td colspan="6" class="Order_form_time">';
			    	html += '<input name="check" id="abc" type="checkbox" value="'+d.list[i].cartid+'"  class="checkbox"/>创建时间：'+d.list[i].createdate+' <em></em>';
			    	html += '</td>';
			    	html += '</tr>';
			    	html += '<tr class="Order_Details">';
				    html += '<td colspan="4">';
					html += '<table class="Order_product_style">';
			    	html += '<tbody>';
			    	html += '<tr>';
		    		html += '<td>';
			    	html += '<div class="product_name clearfix">';
			    	html += '<a href="#" class="product_img"><img src="'+d.list[i].goodsInfo.img+'" width="80px" height="80px"></a>';
			    	html += '<a href="3" class="p_name">'+d.list[i].goodsInfo.name+'</a>';
			    	html += '<p class="specification">'+d.list[i].goodsInfo.unitname+'</p>';
			    	html += '</div>';
			    	html += '</td>';
			    	html += '<td>'+d.list[i].attrvalue1+' '+d.list[i].attrvalue2+'</td>';
			    	html += '<td>￥'+d.list[i].goodsInfo.price+'</td>';
			    	html += '<td>'+d.list[i].goodsnum+'</td>';
			    	html += '</tr>';
			    	html += '</tbody>';
			    	html += '</table>';
			    	html += '</td>';
			    	html += '<td class="split_line">￥'+d.list[i].amount+'</td>';
			    	html += '<td class="operating">';
			    	html += '<a href="#">编辑</a>';
			    	html += '<a href="javascript:void(0);" onclick="delCartGoods('+d.list[i].cartid+')">删除</a>';
			    	html += '</td>';
			    	html += '</tr>';
				}
			}
			$('#goodsCateList > tbody').html(html);
		}else{
			html += '<tr><td colspan="6" class="Order_form_time" style="text-align:center;">购物车中还没有商品，赶紧选购吧！</td></tr>';
			$('#goodsCateList > tbody').html(html);
		}
	});
}

//批量选择
$('#allCheckBox').unbind('click').click(function(){
	$("input[name='check']").prop("checked",this.checked);
	
	var arr = new Array();
	$("input[name='check']:checked").each(function(){
		arr.push($(this).val());
	});
	var str = arr.toString();
	$.post('<?php echo U("Cart/subCart");?>',{'cartIdList':str},function(data){
		var d = eval("("+data+")");
		$('#subGoodsCart').show();
		$('#goodsCartCount').html(d.count)
		$('#goodsCartPrice').html(d.amount);
	});
});

//删除单个购物车商品
function delCartGoods(id){
	$.post('<?php echo U("Cart/delCart");?>',{'id':id},function(respon){
		do_sub();
	});
}

//点击结算按钮，跳转到确认订单
$('#confirmOrder').unbind('click').click(function(){
	var arr = new Array();
	$("input[name='check']:checked").each(function(){
		arr.push($(this).val());
	});
	var cartIdList = arr.toString();
	var amount = $('#goodsCartPrice').html();//总金额
	if(arr.length <= 0){
		$('#errorConfirmOrder').html('请选择商品！');
		return false;
	}else{
		window.location.href="/mall.php/home/Order/confirmOrder?cartIdList="+cartIdList+"&totalAmount="+amount;
		/*$.post('<?php echo U("Order/confirmOrder");?>',{'cartIdList':cartIdList,'totalAmount':amount},function(data){
			window.location.href="<?php echo U('Order/confirmOrder');?>";
		});*/
	}
})
	

</script>
  </div>
 </div>
</div>

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