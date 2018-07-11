<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>试卷列表</title>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>
<body>
<table>
	<input type="hidden" id="timestamp" value="<?php echo $timestamp;?>"/>
	<input type="hidden" id="times" value="<?php echo $examInfo['exercisetime'];?>"/>
	<input type="hidden" id="examId" value="<?php echo $examInfo['id'];?>"/>
	<h2>
	<?php echo $examInfo['papername']?>  
	<span>答题时长：<?php echo $examInfo['exercisetime']?>分钟</span>
	<input type="text" class="boxxtext" id="time_m" value="<?php echo $examInfo['exercisetime'];?>">分
	<input type="text" class="boxxtext" id="time_s" value="00">秒
	</h2>
	<?php foreach($list as $k => $v){ ?>
		<lable>题目：<?php echo $v['title'];?></lable> </t><span style="color:red;font-size:12px;">(<?php echo $v['typename'];?>)</span> <span id="rightOption_<?php echo $v['id'];?>"></span><br/>
		<?php if($v['type'] == 1){ ?>
			<div class="questionRadio">
				<input type="radio" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-A"/>选项A：<?php echo $v['optiona'];?><br/>
				<input type="radio" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-B"/>选项B：<?php echo $v['optionb'];?><br/>
				<input type="radio" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-C"/>选项C：<?php echo $v['optionc'];?><br/>
				<input type="radio" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-D"/>选项D：<?php echo $v['optiond'];?><br/>
			</div>
		<?php }else if($v['type'] == 2){ ?>
			<div class="questionCheckbox">
				<input type="checkbox" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-A"/>选项A：<?php echo $v['optiona'];?><br/>
				<input type="checkbox" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-B"/>选项B：<?php echo $v['optionb'];?><br/>
				<input type="checkbox" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-C"/>选项C：<?php echo $v['optionc'];?><br/>
				<input type="checkbox" name="option_<?php echo $v['id'];?>" value="<?php echo $v['id']?>-D"/>选项D：<?php echo $v['optiond'];?><br/>
			</div>
		<?php } ?>
	<?php } ?>
	
	<input type="button" value="提交答案" id="sub" onclick="subExam(<?php echo $examInfo['id'];?>)"/>
</table>
</body>
</html>

<script>
$(function(){
	time_but();//进入此页面开始倒计时
});

function time_but(){
	
	var time_start = new Date().getTime(); //设定当前时间
	
	var timelong = ($('#times').val()) * 60 * 1000;//答题的时长
	var time_end = Number($('#timestamp').val()) + Number(timelong);//设定目标时间（开始答题时的时间戳+答题的时长）
	
	//计算时间差
	var time = time_end -　time_start;
	
	if(time < 0)
	{
		//时间到了，隐藏提交答案按钮，并提示用户时间已到
		$('#sub').hide();
		var pre = confirm('时间已经到啦！！！');
		if(pre == true || pre == false)
		{
			var examId = $('#examId').val();
			//不管点击是还是否，都执行提交试卷操作
			subExam(examId);
		}
	}
	else
	{
		//时间未到，继续倒计时
		// 分
	    var int_minute = Math.floor(time/60000) 
	    time -= int_minute * 60000; 
	    // 秒 
	    var int_second = Math.floor(time/1000)
	    
	    //分秒不足两位数、前面加0
	    if(int_minute < 10)
	    {
	    	int_minute = "0"+int_minute;
	    }
	    if(int_second < 10)
	    {
	    	int_second = "0"+int_second;
	    }
	    
	    //显示时间
	    $('#time_m').val(int_minute);
	    $('#time_s').val(int_second);
	    
	 	// 设置定时器
	    setTimeout("time_but()",1000);
	}
}

//提交试卷
function subExam(examId){
	//获取type=radio（即单选题目）被选中的值，以,号连接
	var radioArray = new Array();
	$("input[type='radio']:checked").each(function(){
		radioArray.push($(this).val());
	});
	var radioString = radioArray.toString();

	//获取type=checkbox（即多选题目）被选中的值，以,号连接
	var checkboxArray = new Array();
	$("input[type='checkbox']:checked").each(function(){
		checkboxArray.push($(this).val());
	});
	var checkboxString = checkboxArray.toString();
	
	$.ajax({
		type:'post',
		url:'<?php echo U("Exam/User/getExam");?>',
		data:{'examId':examId,'radioIdList':radioString,'checkIdList':checkboxString},
		success:function(respon){
			if(respon.errno == 10001)
			{
				alert(respon.errmsg);
			}
			else
			{
				$.post('<?php echo U("Exam/User/setUserExam");?>',{'examId':examId},
					function(data)
					{
						var d = eval("("+data+")");
						
						if(d.quesResult != null || d.quesResult != false)
						{
							for(var i in d.quesResult)
							{
								var isright = d.quesResult[i].isrightoption;
								if(isright == 1)
								{
									var html = '\t<span style="color:green">（答案：'+d.quesResult[i].quesoption+'\t\t\t）</span>';
								}
								else
								{
									var html = '\t<span style="color:red">（答案：'+d.quesResult[i].quesoption+'\t\t\t）</span>';
								}
								
								$("#rightOption_"+d.quesResult[i].questionid).html(html);
								
								//获取用户所选的答案
								var uoption = d.quesResult[i].useroption;
								//拆分答案
								var uoptionArr = uoption.split('|');
								
								if(uoptionArr.length > 1)
								{
									//多选遍历
									for(var o in uoptionArr)
									{
										//题目id与答案组合
										var value = d.quesResult[i].questionid+"-"+uoptionArr[o];
										//给其用户选中的答案添加其标识
										$("input[name='option_"+d.quesResult[i].questionid+"'][value='"+value+"']").prop("checked", "checked");
									}
								}
								else
								{
									//单选
									var value = d.quesResult[i].questionid+"-"+uoptionArr;//题目id与答案组合
									//给其用户选中的答案添加其标识
									$("input[name='option_"+d.quesResult[i].questionid+"'][value='"+value+"']").prop("checked", "checked");
								}
							}//end for
						}//end if
						
						//隐藏掉提交答案按钮
						$('#sub').hide();
						
					}//end func		
				);
			}
		}
	});
}
</script>