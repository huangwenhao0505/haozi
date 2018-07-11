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
       <h2 class="fl">新增商品</h2>
       <a class="fr top_rt_btn" href="<?php echo U('Goods/goodsList');?>">返回商品列表</a>
      </div>
     <section>
      <ul class="ulColumn2">
       <li>
        <input type="hidden" id="goodsId"/>
        <span class="item_name" style="width:120px;">商品分类：</span>
        <select class="select" name="categoryId" id="categoryId">
         <option value="0">选择商品分类</option>
         <?php foreach($categoryList as $k => $v){ ?>
         	<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
         <?php } ?>
        </select>
        <span id="sonCategoryName"></span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品属性：</span>
         <?php foreach($goodsAttrList as $k => $v){ ?>
         	<input type="checkbox" name="attrName" id="attrName_<?php echo $v['id'];?>" onclick="abc(<?php echo $v['id'];?>)" value="<?php echo $v['id'];?>" style="margin-right:2px;"><?php echo $v['attrname'];?>
         	<span style="margin-right:10px;"></span>
         <?php } ?>
       </li>
       <li id="attrValues">
    	<span class="item_name" style="width:120px;">商品库存：</span>
    	<span id="attrValues1" style="display:none;"><!-- 存取属性列表   --></span>
    	<span id="attrValues2"><input type='text' class="textbox" name='attrValueStock' id='attrValueStock' value="0" placeholder="库存"/></span>
       	<input type="button" value="添加" onclick="addAttrValue()"/>
       	<span id="errorAddAttrValue" style="color:red;"></span>
       </li>
       
       <li>
    	<table id="goodsAttrValueList" class="table contents" style="width:50%;margin-left:120px;">
    		<thead>
    			<th style="width:8%;text-align:center;">颜色</th>
    			<th style="width:8%;text-align:center;">尺码</th>
    			<th style="width:8%;text-align:center;">库存</th>
    			<th style="width:8%;text-align:center;">已售</th>
    			<th style="width:8%;text-align:center;">操作</th>
    		</thead>
    		<tbody></tbody>
    	</table>
       </li>

	   <li style="clear:both;">
        <span class="item_name" style="width:120px;">商品名称：</span>
        <input type="text" name="name" id="name" class="textbox textbox_295" placeholder="商品名称..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品原价：</span>
        <input type="text" name="oldPrice" id="oldPrice" class="textbox" placeholder="商品销售价格"/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品销售价格：</span>
        <input type="text" name="price" id="price" class="textbox" placeholder="商品销售价格"/>
       </li>
       
       <li>
        <span class="item_name" style="width:120px;">是否上架：</span>
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
        <span class="item_name" style="width:120px;">商品详情：</span>
        <script id="editor" type="text/plain" style="width:1024px;height:500px;margin-left:120px;margin-top:0;"></script>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"/>
        <span class="errorTips"></span>
       </li>
      </ul>
     </section>
 </div>
</section>

<script>
$(function(){
	goodStoreList();
});

//选择分类时，显示其相应的子分类列表
$('#categoryId').change(function(){
	var id = $('#categoryId').find('option:selected').val();
	if(id != 0){
		$.post('<?php echo U("Goods/showSonCategory");?>',{'id':id},function(data){
			var html = "";
			var d = eval("("+data+")");
			if(d.list != false && d.list != null){
				html += '<select class="select" name="sonCategoryId" id="sonCategoryId" style="margin-left:20px;">';
				html += '<option value="0">请选择</option>';
				for(var i in d.list){
					html += '<option value="'+d.list[i].id+'">'+d.list[i].name+'</option>';
				}
				html += '</select>';
				
				$('#sonCategoryName').append(html);//追加到sonCategoryName标签里
			    $('#sonCategoryId').show();//显示id=sonCategoryId的select标签
			}else{
				$('#sonCategoryId').remove();//去除id=sonCategoryId的select标签
			}
		});
	}else{
		$('#sonCategoryId').remove();
	}
});

//判断某商品属性是否已选择，选择则触发subAttr()函数，反之则去除相对应生成的select元素
function abc(id){
	if($("#attrName_"+id).is(':checked')){
		subAttr(id);
	}else{
		$("#attrNameValue_"+id).remove();
	} 
}

//生成select元素，元素的name名称固定为attrNameValue，以便好获取值；id设置为不同，以便没选择该属性时，好去除相对应生成的select元素
function subAttr(id){
	$.post('<?php echo U("Goods/attrValueList");?>',{'id':id},function(data){
		var html = "";
		var d = eval("("+data+")");
		console.log(d);
		if(d.list != false && d.list != null){
			html += '<select class="select" name="attrNameValue" id="attrNameValue_'+id+'" style="margin-right:20px;">';
			html += '<option value="0">请选择</option>';
			for(var i in d.list){
				html += '<option value="'+d.list[i].value+'">'+d.list[i].value+'</option>';
			}
			html += '</select>';
		}
		$('#attrValues1').append(html);
	    $('#attrValues1').show();
	});
}

//点击添加按钮时
function addAttrValue(){
	var attrNameArray = new Array();
	$("input[name='attrName']:checked").each(function(){
		attrNameArray.push($(this).val());
	});
	var attrNameValueArray = new Array();
	$("select[name='attrNameValue']").find("option:selected").each(function(){
		attrNameValueArray.push($(this).val());
	});
	
	var goodsId = $('#goodsId').val();
	var attrIdList = attrNameArray.toString();
	var attrValueList = attrNameValueArray.toString();
	var price = $('#price').val();
	var stock = $('#attrValueStock').val();
	$.post('<?php echo U("Goods/goodStoreAdd")?>',{'goodsId':goodsId,'attrIdList':attrIdList,'attrValueList':attrValueList,'price':price,'stock':stock},function(respon){
		if(respon.errno == 10001){
			$('#errorAddAttrValue').html(respon.errmsg);
		}else{
			//添加成功，展示列表
			$('#errorAddAttrValue').empty();
			goodStoreList();
		}
	});
}

//商品属性规格列表展示
function goodStoreList(){
	var goodsId = $('#goodsId').val();
	$.post('<?php echo U("Goods/goodStoreList");?>',{'goodsId':goodsId},function(data){
		var html = '';
		var d = eval("("+data+")");
		if(d.list != false && d.list != null){
			for(var i in d.list){
				html += '<tr style="text-align:center;">';
				html += '<td>'+d.list[i].attrvalue1+'</td>';
				html += '<td>'+d.list[i].attrvalue2+'</td>';
				html += '<td>'+d.list[i].stock+'</td>';
				html += '<td>'+d.list[i].soldnum+'</td>';
				html += '<td>';
				html += '<a href="javascript:void(0);" onclick="editGoodStore('+d.list[i].id+','+d.list[i].goodsid+')">编辑</a>';
				html += '<a href="javascript:void(0);" onclick="delGoodStore('+d.list[i].id+','+d.list[i].goodsid+')">删除</a>';
				html += '</td>';
				html += '</tr>';
			}
		}
		
		$('#goodsAttrValueList>tbody').html(html);
	});
}

//编辑商品属性规格
function editGoodStore(id,goodsId){
	var stock = prompt("请输入库存：");
	$.post('<?php echo U("Goods/goodStoreEdit")?>',{'id':id,'goodsId':goodsId,'stock':stock},function(){
		goodStoreList();
	});
}

//删除商品属性规格
function delGoodStore(id,goodsId){
	var con = confirm('删除后不可恢复，确定要删除吗？');
	if(con == true){
		$.post('<?php echo U("Goods/goodStoreDel");?>',{'id':id,'goodsId':goodsId},function(respon){
			goodStoreList();
		});
	}
}

//点击提交按钮时
$('.link_btn').unbind('click').click(function(){
	var attrNameArray = new Array();
	$("input[name='attrName']:checked").each(function(){
		attrNameArray.push($(this).val());
	});
	
	var attrIdList = attrNameArray.toString();//把数组转换成字符串形式  属性id
	var categoryId = $('#categoryId').val();//父分类id
	var sonCategoryId = $('#sonCategoryId').val();//对应的子分类id
	var goodsName = $('#name').val();
	var oldPrice = $('#oldPrice').val();
	var unitName = $('#unitName').val();
	var price = $('#price').val();
	var isShow = $("input[type='radio']:checked").val();
	
	categoryId = sonCategoryId == 0 ? categoryId : sonCategoryId; //选择子分类时就保存子分类id

	$.post('<?php echo U("Goods/goodsAdd");?>',
		{
			'attrIdList':attrIdList,
			'categoryId':categoryId,
			'name':goodsName,
			'oldPrice':oldPrice,
			'unitName':unitName,
			'price':price,
			'isShow':isShow,
			'attrIdList': attrIdList,
			'attrValueList': attrValueList
		},function(respon){
		if(respon.errno == 10001){
			$('.errorTips').html(respon.errmsg);
		}else{
			$('#goodsId').val(respon.data);//把新增的商品id赋值给goodsId标签
			$('.errorTips').html(respon.errmsg);
		}
	});
});

</script>
</body>
</html>