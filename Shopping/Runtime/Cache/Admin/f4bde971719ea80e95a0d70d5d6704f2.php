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
       <h2 class="fl">商品分类列表</h2>
       <a href="<?php echo U('Category/addGoodsCategory');?>" class="fr top_rt_btn add_icon">添加分类</a>
      </div>
      <section class="mtb">
       <input type="text" name="categoryName" id="categoryName" class="textbox textbox_225" placeholder="输入产品关键词或产品货号..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table" id="categoryContent">
       <thead>
       <tr>
        <th>分类名称</th>
        <th>形象图</th>
        <th>是否显示</th>
        <th>序号</th>
        <th>创建时间</th>
        <th>操作</th>
       </tr>
       </thead>
       <tbody>
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
	$('.group_btn').bind('click').click(function(){
		do_sub();
	});
}

function do_sub(){
	var categoryName = $('#categoryName').val();
	$.post('<?php echo U("Category/getGoodsCategoryListAJAX");?>',{'categoryName':categoryName},function(data){
		var html = '';
		var d = eval("("+data+")");//解析json数据
		if(d.list != false && d.list != null){
			for(var o in d.list){
				html += '<tr>';
				html += '<td class="center">'+d.list[o].name+'</td>';
				html += '<td class="center">'+d.list[o].image+'</td>';
				html += '<td class="center"  style="color:red;">'+d.list[o].shows+'</td>';
				html += '<td class="center">'+d.list[o].ordernum+'</td>';
				html += '<td class="center">'+d.list[o].createdate+'</td>';
				html += '<td class="center">';
				html += '<a href="/mall.php/Admin/Category/editGoodsCategory?id='+d.list[o].id+'" title="编辑" class="link_icon">&#101;</a>';
				if(d.list[o].isshow == 1){
					html += '<a href="javascript:void(0);" style="color:blue;" onclick="shows('+d.list[o].id+','+d.list[o].parentid+',0)">隐藏</a>';
				}else{
					html += '<a href="javascript:void(0);" style="color:blue;" onclick="shows('+d.list[o].id+','+d.list[o].parentid+',1)">显示</a>';
				}
				html += '<a href="javascript:void(0);" title="删除" class="link_icon" onclick="delCategory('+d.list[o].id+')">&#100;</a>';
				html += '<span style="color:red;" id="errorDelCategory_'+d.list[o].id+'"></span>';
				html += '</td>';
				html += '</tr>';
				
				if(d.list[o].parentname != null || d.list[o].parentname != ''){
					for(var i in d.list[o].parentname){
						html += '<tr>';
						html += '<td class="center">———'+d.list[o].parentname[i].name+'</td>';
						html += '<td class="center">'+d.list[o].parentname[i].image+'</td>';
						html += '<td class="center">'+d.list[o].parentname[i].shows+'</td>';
						html += '<td class="center">'+d.list[o].parentname[i].ordernum+'</td>';
						html += '<td class="center">'+d.list[o].parentname[i].createdate+'</td>';
						html += '<td class="center">';
						html += '<a href="/mall.php/Admin/Category/editGoodsCategory?id='+d.list[o].parentname[i].id+'" title="编辑" class="link_icon">&#101;</a>';
						if(d.list[o].parentname[i].isshow == 1){
							html += '<a href="javascript:void(0);" style="color:blue;" onclick="shows('+d.list[o].parentname[i].id+','+d.list[o].parentname[i].parentid+',0)">隐藏</a>';
						}else{
							html += '<a href="javascript:void(0);" style="color:blue;" onclick="shows('+d.list[o].parentname[i].id+','+d.list[o].parentname[i].parentid+',1)">显示</a>';
						}
						html += '<a href="javascript:void(0);" title="删除" class="link_icon" onclick="delCategory('+d.list[o].parentname[i].id+')">&#100;</a>';
						html += '<span style="color:red;" id="errorDelCategory_'+d.list[o].parentname[i].id+'"></span>';
						html += '</td>';
						html += '</tr>';
					}
				}
			}
			
			$('#categoryContent>tbody').html(html);
			init();
		}
	});
}

//显示或隐藏
function shows(id,parentId,type){
	$.post('<?php echo U("Category/isShow");?>',{'id':id,'parentId':parentId,'type':type},function(respon){
		do_sub();
	});
}

//删除分类
function delCategory(id){
	$.post('<?php echo U("Category/delGoodsCategory");?>',{'id':id},function(respon){
		if(respon.errno == 10001){
			$('#errorDelCategory_'+id).html(respon.errmsg);
		}else{
			do_sub();
		}
	});
}

</script>