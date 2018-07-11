<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>幸运大转盘</title>
<style type="text/css">

.demo { height: 417px; margin: 50px auto; position: relative; width: 417px;}
#disk { background: url("/Public/lottery2/disk.jpg") no-repeat; height: 417px; width: 417px;}
#start { height: 320px; left: 130px; position: absolute; top: 46px; width: 163px;}

</style>

<script type="text/javascript" src="/Public/lottery2/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/Public/lottery2/jQueryRotate.2.2.js"></script>
<script type="text/javascript">
$(function(){ 
    $("#startbtn").click(function(){ 
       lottery(); 
   }); 
}); 
function lottery(){ 
   $.ajax({ 
       type: 'POST', 
       url: '<?php echo U(Home/lot/lottery);?>', 
       dataType: 'json', 
       cache: false, 
       error: function(){ 
           alert('出错了！'); 
           return false; 
       }, 
       success:function(json){ 
           $("#startbtn").unbind('click').css("cursor","default"); 
           var a = json.angle; //角度 
           var p = json.prize; //奖项 
           $("#startbtn").rotate({ 
               duration:3000, //转动时间 
               angle: 0, 
               animateTo:1800+a, //转动角度 
               easing: $.easing.easeOutSine, 
               callback: function(){ 
                   var con = confirm('恭喜你，中得'+p+'\n还要再来一次吗？'); 
                   if(con){ 
                       lottery(); 
                   }else{ 
                       //再次绑定click事件
                       $("#startbtn").css("cursor","pointer").on("click",function(){
                           lottery();
                       });                       
                       return false; 
                   } 
               } 
           }); 
       } 
   }); 
} 
</script>
</head>
<body>

	<div class="demo">
        <div id="disk"></div>
        <div id="start"><img id="startbtn" src="/Public/lottery2/start.png" style="cursor: pointer; transform: rotate(0deg);"></div>
   </div>
   
</body>
</html>