<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP+JS活动秒杀倒计时原理</title>
    <script src="/Public/Home/index/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
</head>
<body>
    <h1 id="startTime">活动开始时间:</h1>
    <h1 id="endTime">活动结束时间:</h1>
    <h4 id="huodong">距离活动结束还有 <strong id="RemainD"></strong>天
        <strong id="RemainH"></strong>小时
        <strong id="RemainM"></strong>分钟
        <strong id="RemainS"></strong>.<strong id="RemainL"></strong>秒
    </h4> 
    
    <div>
    	<p><?php echo $info['name'];?>  <span style="font-size:18px;">库存:<?php echo $info['stock']; echo $info['unitName'];?></span></p>
    	<p style="color">原价：<?php echo $info['oldprice'];?>   <span style="color:red;font-size:20px;padding-left:10px;">现价：<?php echo $info['price'];?></span></p>
    </div>
    
    <!-- 
    <div id="app">
    	<input type="hidden" id="code"/>
    	<input type="hidden" id="msg"/>
    	<button v-bind:disabled="dis" id="qiangou">{{message}}</button>
    </div>
     -->
     <button id="qiangou">抢购</button>
</body>
    
<script>
$(function(){
	//setTimeout() 载入后延迟指定时间后,去执行一次表达式    和setInterval() 是有区别的
	refresh();
	setInterval("refresh()", 100);//从载入后,每隔指定的时间就执行一次表达式
	getRTime();
})

var runtimes = 0;//记录秒
function getRTime() {
	$.post('<?php echo U("Home/Yulu/daojishi");?>',function(result){
		var d = eval("("+result+")");//解析json数据
		
		//活动开始时间和结束时间
		var startTime = d.starttimestr;
		var endTime   = d.endtimestr;
		$("#startTime").html("活动开始时间:"+startTime);
		$("#endTime").html("活动结束时间:"+endTime);
		
		//判断活动类型
		var code = Number(d.errno);//活动类型（10000进行中  10001 未开始  10002已结束）
		var msg  = d.errmsg;//提示语
		
		//按钮点击（抢购）
		new Vue({
			el: "#app",
			data: {
				dis: true,
				message: ''
			},
			created: function() {
				this.getData();//实例化成功之后调用这个方法
			},
			methods : {
				getData: function() {
					var that = this;
					//console.log(that);
					if (code == 10000) {
						that.dis = false;//可以点击
						that.message = msg;
					} else {
						that.dis = true;
						that.message = msg;
					}
				},
				
				
			}
		});
		
		var lefttime = d.lefttime * 1000 - runtimes * 1000;
		if(code == 10001 || code == 10002) {
			$("#huodong").hide();
			
		} else {
			if (lefttime > 0) {
				var nD = Math.floor(lefttime / (1000 * 60 * 60 * 24)) % 24;
		        var nH = Math.floor(lefttime / (1000 * 60 * 60)) % 24;
		        var nM = Math.floor(lefttime / (1000 * 60)) % 60;
		        var nS = Math.floor(lefttime / 1000) % 60;
		        $("#RemainD").html(nD);
		        $("#RemainH").html(nH);
		        $("#RemainM").html(nM);
		        $("#RemainS").html(nS);
		        if (lefttime == 5 * 60 * 1000) {
		        	alert("还有最后五分钟！");
		        }
		        runtimes + 1;
		        //runtimes++;不能这样写，否则会跳2秒= =
		        setTimeout("getRTime()", 1000);//载入后延迟指定时间后,去执行一次表达式
			} else {
				location.reload();
			}
		}
	});
}

var num = 0;//记录分秒
function refresh() {
	if(num < 10) {
		$("#RemainL").html(num);
		num = num + 1;
	} else {
		num = 0;
	}
}

/** 实现商品抢购 **/
$('#qiangou').click(function(){
	$.ajax({
		type: 'post',
		url: '<?php echo U("Home/Yulu/miaosha");?>',
		success: function(respon){
			if(respon.errno == 10001){
				alert(respon.errmsg);
			}else if(respon.errno == 10000){
				alert(respon.errmsg);
			}
		}
	});
});
</script>
</html>