//标准体重计算表达式：(kg)
//男: (身高 - 100)*0.9   女:  (身高 - 105)*0.92
//1.大于标准体重  20%以上   肥胖
//2.大于标准体重  10%~20%  过重
//3.实际体重在标准体重 小于10%或大于10%之间 正常    
//4.小于标准体重  10%~20%  瘦
//5.小于标准休息  20%以上   严重消瘦

//正常范围BMI计算表达式：
//例：175cm 50kg 的人的BMI值为：    50/1.75/1.75
//1. BMI<18.5      过轻
//2. 18.5<=BMI<24  正常
//3. 24<=BMI<27    轻度胖
//4. 27<=BMI<30    中度胖
//5. 30<=BMI<35    很胖
//6. BMI>=35       严重胖

//标签的ID属性
//身高height   体重weight   性别sex(1男  2女)
//理想体重 loveHeight   身体BMI指数 loves  现在的状况提示 nowLovePoint
//开始测试  health_but   重新填写 reset_health_but

//点击测试按钮
$('#health_but').click(function(){
	var height = $('#height').val();
	var weight = $('#weight').val();
	var sex = $('#sex').val();
	
	//判断输入的正确性
	if(height == '' || height == null || weight == '' || weight == null){	//身高体重是否为空
		$('#nowLovePoint').val('你以为我真的是神仙吗?你什么都不告诉我,我怎么给你测啊!!!');
		return false;
	}
	
	if(isNaN(height) || isNaN(weight)){	//判断是否是数字   
		$('#nowLovePoint').val('搞个撒子哟,请正确输入你的身高和体重!!!');
		return false;
	}
	
	if(height >= 300){
		$('#nowLovePoint').val('喔!你好伟大啊!!替我向上帝问好!!!');
		return false;
	}
	
	if(height < 100){
		$('#nowLovePoint').val('sorry,目前只能测100cm以上的!');
		return false;
	}
	
	if(weight >= 300){
		$('#nowLovePoint').val('你不用测了,你的体重已经把我的秤压坏了!!');
		return false;
	}
	
	if(weight <= 0){
		$('#nowLovePoint').val('哇喔,不得鸟了,你轻的连地心引力对你都不起作用了!!');
		return false;
	}
	
	if(sex == 1){	//男
		var gb = (height-100)*0.9;	//标准体重
		var lv = (weight-gb)/gb;	//实际体重与标准体重的百分比之差
		if(lv > 0.20){
			$('#nowLovePoint').val('哇!你好胖啊!必须开始减肥了,听我的没错!');
		}else if(lv > 0.10 && lv <= 0.20){
			$('#nowLovePoint').val('哎呀!你可是比较胖啊,赶快开始减肥计划吧!');
		}else if(lv > (-0.10) && lv <= 0.10){
			$('#nowLovePoint').val('男神!你这可是魔鬼身材啊!!!');
		}else if(lv > (-0.20) && lv <= (-0.10)){
			$('#nowLovePoint').val('有点瘦!你应该多吃点东西啊!');
		}else if(lv <= (-0.20)){
			$('#nowLovePoint').val('你实在是太瘦太瘦了!快点大量吃东西吧!');
		}
		$('#loveHeight').val(gb);
	}else{	//女
		var gb = (height-105)*0.92;	//标准体重
		var lv = (weight-gb)/gb;	//实际体重与标准体重的百分比之差
		if(lv > 0.20){
			$('#nowLovePoint').val('哇!你好胖啊!必须开始减肥了,听我的没错!');
		}else if(lv > 0.10 && lv <= 0.20){
			$('#nowLovePoint').val('哎呀!你可是比较胖啊,赶快开始减肥计划吧!');
		}else if(lv > (-0.10) && lv <= 0.10){
			$('#nowLovePoint').val('女神!你这可是魔鬼身材啊!!!');
		}else if(lv > (-0.20) && lv <= (-0.10)){
			$('#nowLovePoint').val('有点瘦!你应该多吃点东西啊!');
		}else if(lv <= (-0.20)){
			$('#nowLovePoint').val('你实在是太瘦太瘦了!快点大量吃东西吧!');
		}
		$('#loveHeight').val(gb);
	}

	//BMI
	var bmi = weight/height/height*100*100;
	$('#loves').val(bmi);
});

//点击重置按钮
$('#reset_health_but').click(function(){
	$('#height').empty();
	$('#weight').empty();
	$('#sex').val(1);
	$('#nowLovePoint').empty();
	$('#loveHeight').empty();
});