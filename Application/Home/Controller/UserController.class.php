<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    
    private $isCheckQQ;
    
    public function __construct(){
        parent::__construct();
        A('IsMobile')->getIsMobile();//判断是否是手机端浏览
        $this->A_login = A('Login');
        $this->A_login->checkLogin();//检查是否已登录
        $this->A_img = A('Img');
        $this->A_photo = A('ImgMuch');
        $this->A_Message = A('Message');
        
        $this->isCheckQQ = $this->A_login->checkQQ();//账号登录判断是否已绑定QQ
    }
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    
    /**
     *个性签名
     */
    private function sing($id){
        $info = M('user')->field('u_sign')->where('id='.$id)->find();
        return $info;
    }
    
    /**
     *上传相片总张数
     */
    private function numPhoto($id){
        $count = M("user_photo")->where("uid=".$id)->count();
        $photoCount = array("num"=>$count);
        return $photoCount;
    }
    
    /**
     * 个人中心 主页 首页 */
    public function index(){
        $uid = session('id');
        
        $where['uid'] = $uid;
        $where['uid_type'] = 2;
        $yuluCon = M('yulu')->where($where)->count();
        $jokeCon = M('joke')->where($where)->count();
        $artiCon = M('Article')->where($where)->count();
         
        $yuluList = M('yulu')->where($where)->limit(5)->select();
        foreach($yuluList as $k => $v){
            $yuluList[$k]['maketime'] = date('Y-m-d H:i:s',$v['maketime']);
            $yuluList[$k]['is_ok'] = $v['is_ok'] == 0 ? "未通过" : "已通过";
        }
         
        $jokeList = M('joke')->where($where)->limit(5)->select();
        foreach($jokeList as $k => $v){
            $jokeList[$k]['maketime'] = date('Y-m-d H:i:s',$v['maketime']);
            $jokeList[$k]['is_ok'] = $v['is_ok'] == 0 ? "未通过" : "已通过";
        }
         
        $artiList = M('article')->where($where)->limit(5)->select();
        foreach($artiList as $k => $v){
            $artiList[$k]['maketime'] = date('Y-m-d H:i:s',$v['create_date']);
            $artiList[$k]['is_ok'] = $v['is_ok'] == 0 ? "未通过" : "已通过";
        }
         
        $this->assign('yuluCon',$yuluCon); //语录总数
        $this->assign('jokeCon',$jokeCon); //笑话总数
        $this->assign('artiCon',$artiCon); //文章总数
         
        $this->assign('yuluList',$yuluList); //语录列表
        $this->assign('jokeList',$jokeList); //笑话列表
        $this->assign('artiList',$artiList); //文章列表
         
        $sign = $this->sing($uid);          //个性签名
        $numPhoto = $this->numPhoto($uid);  //照片总数
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $messageList = $this->A_Message->messageList(); //已查看的留言列表
        $showMessageList = $this->A_Message->showMessageList(); //未查看的留言列表
        $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
        $myMessageCount = $this->A_Message->myMessageCount();   //我的留言条目数
        $this->assign("messageList",$messageList);
        $this->assign("showMessageList",$showMessageList);
        $this->assign("numMessage",$numMessage);
        $this->assign("myMessageCount",$myMessageCount);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
		$this->display('admin-index');
    }
    
    /**
     *上传个人图像
     *第三方插件ajaxFileUpload
     */
    public function uploadChangeImg() {
        $img = $this->A_img->uploadImg('Public/Uploads/user/');
        echo $img;
    }
    
    /**
     *改变个人头像
     */
    public function userHeadImg(){
        if(IS_AJAX){
            $uid = session('id');
            $img = trim($_POST['u_img']);
            
            if($img == ''){
                $this->ajaxReturn($this->errmsg(10001, '请按正确的格式上传图像!'));
            }
            
            //保存到数据库
            $d['u_img'] = $img;
            M('user')->where('id='.$uid)->save($d);
        }
    }
    
    /**
     * 供userInfo调用的函数
     * @param $id 登录成功后保存的session值
     * @param $type int  0时更新操作   1时QQ绑定账号操作
     * */
    public function _userInfo($id,$type=0){
        if($type == 0){
            if(IS_AJAX){
                $nickname = trim($_POST['nickname']);
                $u_sign = trim($_POST['u_sign']);
                $address= trim($_POST['address']);
                $prov = trim($_POST['prov']);
                $city = trim($_POST['city']);
                $drstry = trim($_POST['drstry']);
                $month = trim($_POST['month']);
                $days = trim($_POST['days']);
                if(strlen($u_sign) < 6){
                    $this->ajaxReturn($this->errmsg(10003, '字数太少了,不够个性哟!'));
                }
                if(strlen($u_sign) > 250){
                    $this->ajaxReturn($this->errmsg(10003, '字数太多了哟,太个性化了!'));
                }
                if($prov == '' || $city == ''){//$drstry有的市没有区的选择，所以这里不能做限制
                    $this->ajaxReturn($this->errmsg(10004, '请选择省市区!'));
                }
                if($address == ''){
                    $this->ajaxReturn($this->errmsg(10004, '请填写您的详细地址!'));
                }
                if(strlen($address) > 50){
                    $this->ajaxReturn($this->errmsg(10004, '憋欺负我没读过书!'));
                }
                if(is_numeric($month) == false || is_numeric($days) == false){
                    $this->ajaxReturn($this->errmsg(10005, '请谨慎对待，填写您的日期'));
                }
                if($month<0 || $month>12){
                    $this->ajaxReturn($this->errmsg(10005, '你个逗B，月份只有（1-12）月'));
                }
                if(ceil($month) != $month){
                    $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                }
                if($days<0 || $days>31){
                    $this->ajaxReturn($this->errmsg(10005, '你个逗B，每月只有（1-31）天'));
                }
                if(ceil($days) != $days){
                    $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                }
                $birthday = $month.",".$days;    //以,号连接起来

                $data['nickname'] = $nickname;
                $data['u_sign'] = $u_sign;
                $data['province'] = $prov;
                $data['city'] = $city;
                $data['district'] = $drstry;
                $data['address'] = $address;
                $data['u_birthday'] = $birthday;
                $res = M('user')->where('id='.$id)->save($data);
                if(!$res){
                    $this->ajaxReturn($this->errmsg(10001, '没有任何修改哟!'));
                }else{
                    //修改成功   用户昵称改变  则发表的语录  笑话  文章 的作者也都要随之改变
                    $d['author'] = $nickname;
                    M('yulu')->where("uid = $id and uid_type = 2")->save($d);
                    M('joke')->where("uid = $id and uid_type = 2")->save($d);
                    M('article')->where("uid = $id and uid_type = 2")->save($d);
                
                    $this->ajaxReturn($this->errmsg(10000, '修改成功!'));
                }
            }//end is_ajax
            $info = M('user')->field(true)->where('id='.$id)->find();
            $bir = explode(',', $info['u_birthday']);
            $info['month'] = $bir[0];
            $info['days'] = $bir[1];
            $this->assign('info',$info);
            
            $sign = $this->sing($id);
            $numPhoto = $this->numPhoto($id);
            $this->assign("sign",$sign);
            $this->assign("numPhoto",$numPhoto);

            /*$numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
            $this->assign("numMessage",$numMessage);*/
            
            $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
            
            A('Qq')->qqurl();//QQ登录入口

            $this->display('admin-user');
        }else{//end type=0
            $w['qq_openid'] = $id;
            $info = M('user')->where($w)->find(); //根据qq_openid查询出生成的user记录，取出id
            session('id',$info['id']);//保存其session
            
            if(IS_AJAX){
                $nickname = trim($_POST['nickname']);
                $u_sign = trim($_POST['u_sign']);
                $address= trim($_POST['address']);
                $prov = trim($_POST['prov']);
                $city = trim($_POST['city']);
                $drstry = trim($_POST['drstry']);
                $month = trim($_POST['month']);
                $days = trim($_POST['days']);
                //进行相应验证，现在略
                //if(mb_strlen($nickname) < 9 || mb_strlen($nickname) > 24){
                //$this->ajaxReturn($this->errmsg(10002, '昵称请设置在3-8个字符之间!'));
                //}
                //QQ登录绑定账号进行的插入操作
                $username = trim($_POST['username']);
                $userpass = trim($_POST['password']);
                //合理性验证
                $where['username'] = $username;
                $info = M('user')->field('username,password,qq_openid')->where($where)->find();
                
                if($username == ''){
                    $this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
                }
                
                if($info['username'] != ''){
                    //填写的用户名已存在时，有两种情况要处理（被绑定了和未被绑定）
                    if($info['qq_openid'] != ''){
                        //被绑定了
                        $this->ajaxReturn($this->errmsg(10001, '该用户名已被绑定'));
                    }else{
                        if($userpass == ''){
                            $this->ajaxReturn($this->errmsg(10002, '该账号已被注册，为保护账号安全，请输入密码验证此账号属于你本人的'));
                        }
                        //未被绑定，这里要考虑的详细一点，必须要输入这个账号的密码验证，如果匹配才允许绑定，不匹配就不允许（以免绑定了别人的账号）
                        $wa['username'] = $username;
                        $wa['password'] = md5($userpass);
                        $flag = M('user')->where($wa)->find();
                        if(!$flag){
                           $this->ajaxReturn($this->errmsg(10001, '该账号已被注册，出于安全考虑，你输入的账号与密码不匹配，请重新验证或绑定其他账号！')); 
                        }
                    }
                }
                
                if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$username)){
                    $this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度6-16字符之间'));
                }
                if(strlen($username) < 6 || strlen($username) > 16){
                    $this->ajaxReturn($this->errmsg(10001, '用户名请设置在6-16个字符之间'));
                }
                if(strlen($userpass) < 6 || strlen($userpass) > 16){
                    $this->ajaxReturn($this->errmsg(10002, '密码请设置在6-16位字符之间'));
                }
                //当填写了个性签名时
                if($u_sign != ''){
                    if(strlen($u_sign) < 6){
                        $this->ajaxReturn($this->errmsg(10003, '字数太少了,不够个性哟!'));
                    }else if(strlen($u_sign) > 250){
                        $this->ajaxReturn($this->errmsg(10003, '字数太多了哟,太个性化了!'));
                    }
                }
                //当选择了城市时
                if($prov != ''){
                    if($prov == '' || $city == ''){//$drstry有的市没有区的选择，所以这里不能做限制
                        $this->ajaxReturn($this->errmsg(10004, '请选择省市区!'));
                    }
                    /*if($address == ''){
                        $this->ajaxReturn($this->errmsg(10004, '请填写您的详细地址!'));
                    }*/
                    if(strlen($address) > 50){
                        $this->ajaxReturn($this->errmsg(10004, '憋欺负我没读过书!'));
                    }
                }
                //当填写了日期时
                if($month != '' || $days != ''){
                    if(is_numeric($month) == false || is_numeric($days) == false){
                        $this->ajaxReturn($this->errmsg(10005, '请谨慎对待，填写您的日期'));
                    }
                    if($month<0 || $month>12){
                        $this->ajaxReturn($this->errmsg(10005, '你个逗B，月份只有（1-12）月'));
                    }
                    if(ceil($month) != $month){
                        $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                    }
                    if($days<0 || $days>31){
                        $this->ajaxReturn($this->errmsg(10005, '你个逗B，每月只有（1-31）天'));
                    }
                    if(ceil($days) != $days){
                        $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                    }
                    $birthday = $month.",".$days;    //以,号连接起来
                }
                 
                $d['username'] = $username;
                $d['password'] = md5($userpass);
                $d['nickname'] = $nickname;
                $d['u_birthday'] = $birthday;
                $d['u_sign'] = $u_sign;
                $d['province'] = $prov;
                $d['city'] = $city;
                $d['district'] = $drstry;
                $d['address'] = $address;
                //$add['qq_openid'] = $id;
                $d['states'] = 1; //qq登录的进行账号绑定的默认为激活状态
                $d['regist_time'] = date('Y-m-d H:i:s',time());
                //$rs = M('user')->add($add);   qq登录时默认创建了一条该用户的记录（只保存了qq_openid），所以这里也是要做更新操作

                $wh['qq_openid'] = $id;
                $rs = M('user')->where($wh)->save($d);
                if($rs){
                    $uid = session('id');
                    $res = M('user')->field(true)->where('id='.$uid)->find();
                    $bir = explode(',', $res['u_birthday']);
                    $info['month'] = $bir[0];
                    $info['days'] = $bir[1];
                    $this->assign('info',$res);
                    
                    $sign = $this->sing($uid);
                    $numPhoto = $this->numPhoto($uid);
                    $this->assign("sign",$sign);
                    $this->assign("numPhoto",$numPhoto);
                    
                    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
                    $this->assign("numMessage",$numMessage);
                    
                    //这里要进行判断，如果是绑定的自己原来的账号，那绑定成功之后要删除原来的那条数据，不然就有重复的了
                    $whe['username'] = $username;
                    $list = M('user')->where($whe)->select();
                    if(count($list) > 1){
                        $s = M('user')->where($whe)->order('id')->find();
                        $id = $s['id'];
                        $sql = "delete from hwh_user where id = $id";
                        M()->execute($sql);
                    }
                    
                    $this->ajaxReturn($this->errmsg(10000, '绑定账号成功！'));
                }else{
                    $this->ajaxReturn($this->errmsg(10006, '绑定账号失败！'));
                }
            }//end is_ajax
            
            $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
            
            A('Qq')->qqurl();//QQ登录入口
            
            $this->display('admin-user-qqbind');
        }//end else
        
        
    }
	
	/**
	 * 个人资料*/
	public function userInfo(){
		$qq_openid = session('qq_openid');    //qq登录保存的qq_openid

		if( $qq_openid != '' ){//qq进行的登录
		    //查看有没有绑定本网站的账号
		    $w['qq_openid'] = $qq_openid;
		    $res = M('user')->where($w)->find();
		    
		    if($res['is_black'] == 1){//查询是否已被加入黑名单 
		        session(null);
		        $this->error('你已被加入黑名单！',U('Home/Login/ajaxLogin'));
		    }
		    
		    if( $res['username'] != '' ){ //绑定了本网站的账号（根据username来判断，因为网站账号不能为空）
		        session('id',$res['id']);
		        $id = session('id');
                $this->_userInfo($id);
		    }else{//未绑定本网站的账号，提示进行绑定
		        $this->_userInfo($qq_openid,1);
		    }
		}else{//账号进行的登录
		    $id = session('id');
		    $this->_userInfo($id);
		}

	}
	
	/**
	 * 个人资料页面的一个小模块div
	 * 用户修改之后无刷新显示最新内容*/
	public function userInfoSon(){
	    $id = session('id');
	    //$id = $this->A_login->checkLogin();
	    
	    if(IS_AJAX){
	        $info = M('user')->where('id='.$id)->find();
	        $list = empty($info) ? false : $info;
            $list['address'] = $list['province'].$list['city'].$list['district'].$list['address'];
            if($list['u_birthday'] != ''){
                $birthday = explode(',', $list['u_birthday']);
                $month = $birthday[0]."月";
                $days = $birthday[1]."日";
                $list['u_birthday'] = $month.$days;
            }else{
                $list['u_birthday'] = '';
            }
            
            $list['nickname'] = $list['nickname'] == null ? '' : $list['nickname'];
            $list['u_sign'] = $list['u_sign'] == null ? '' : $list['u_sign'];
            
	        echo json_encode($list);
	    }
	}
	
	/**
	 * 用户相册 弃用 */
	public function userPhoto(){
	
	    if(IS_POST){
	        $uid = session('id');
	        //$uid = $this->A_login->checkLogin();
	
	        $upload = new \Think\Upload();// 实例化上传类
	        $upload->maxSize   =     3145728 ;// 设置附件上传大小
	        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	        $upload->rootPath  =      './Public/Uploads/'; //文件上传保存的根路径
	        $upload->savePath  = 	 'user/';	//文件上传的保存路径（相对于根路径）
	
	        // 上传文件
	        $info   =   $upload->upload();
	
	        if(!$info) {// 上传错误提示错误信息
	            $this->error = $upload->getError();	//将上传的错误信息赋值给error属性
	            //$this->ajaxReturn($this->errmsg(10001, $this->error));
	            $this->error($this->error,'',2);
	        }else{// 上传成功 获取上传文件信息
	            foreach($info as $k => $v){
	                $data['img'] = $info[$k]['savepath'].$info[$k]['savename'];
	                $data['uid'] = $uid;
	                $data['create_date'] = time();
	
	                $res = M('user_photo')->add($data);
	
	            }
	
	        }
	
	        if($res){
	            $this->redirect('User/userInfo','',1,'上传成功');
	            //$this->success('上传成功',U('User/userInfo'),1);
	        }else{
	            $this->error('上传失败','',1);
	        }
	
	        //             if($res){
	        //                 $this->ajaxReturn($this->errmsg(10000, '上传成功'));
	        //             }else{
	        //                 $this->ajaxReturn($this->errmsg(10001, '上传失败'));
	        //             }
	    }
	
	    $this->display();
	}
	
	/**
	 * 修改密码*/
	public function changePassWord(){
	    $id = session('id');
	    if(IS_AJAX){
	        $this->A_login->checkUsername();//检查是否绑定了本网站的账号
	        //$id = $this->A_login->checkLogin();
	        //接收参数
	        $oldPwd = trim($_POST['oldPwd']);
	        $newPwd = trim($_POST['newPwd']);
	        $newPwd2 = trim($_POST['newPwd2']);
	        
	        $where['id'] = $id;
	        $where['password'] = md5($oldPwd);
	        $info = M('user')->where($where)->find();
	        if(!$info){
	            $this->ajaxReturn($this->errmsg(10001, '原密码不正确!'));
	        }
	        
	        if($oldPwd == $newPwd){
	            $this->ajaxReturn($this->errmsg(10002, '新密码和原始密码不能相同!'));
	        }
	        
	        if(strlen($newPwd) < 6 || strlen($newPwd) > 16 || $newPwd == ''){
	            $this->ajaxReturn($this->errmsg(10002, '新密码请设置在6-16位字符之间!'));
	        }
	        
	        if($newPwd != $newPwd2){
	            $this->ajaxReturn($this->errmsg(10003, '新密码和确认密码不一致!'));
	        }
	        
	        //密码强弱
	        if(strlen($newPwd) >= 6 && strlen($newPwd) <= 8){
	            $data['password_leven'] = 1;
	        }else if(strlen($newPwd) > 8 && strlen($newPwd) <= 12){
	            $data['password_leven'] = 2;
	        }else if(strlen($newPwd) > 12 && strlen($newPwd) <= 16){
	            $data['password_leven'] = 3;
	        }
	        
	        $data['password'] = md5($newPwd);
	        $flag = M('user')->where('id='.$id)->save($data);
	        if($flag){
	            //记录日志表
	            $add['uid'] = $id;
	            $add['user_time'] = date('Y-m-d H:i:s',time());
	            $add['user_ip'] = $_SERVER['REMOTE_ADDR'];
	            $add['user_type'] = 2;
	            M('user_log')->add($add);
	            
	            $this->ajaxReturn($this->errmsg(10000, '修改成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10004, '未知错误,修改失败!'));
	        }
	    }
	    
	    $sign = $this->sing($id);
	    $numPhoto = $this->numPhoto($id);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-changePwd');
	}
	
	/**
	 * 验证原密码是否正确
	 * 前台ajax无刷新显示（失去焦点时触发）
	 * 提高用户体验度  */
	public function oldPwdAjax(){
	    if(IS_AJAX){
	        $id = session('id');
	        //$id = $this->A_login->checkLogin();
	        $oldPwd = trim($_POST['oldPwd']);
	        $where['id'] = $id;
	        $where['password'] = md5($oldPwd);
	        $info = M('user')->where($where)->find();
	        if(!$info){
	            $this->ajaxReturn($this->errmsg(10001, '原密码不正确!'));
	        }
	    }
	}
	
	/**
	 * 验证新密码和原密码是否相同
	 * 前台ajax无刷新显示（失去焦点时触发）
	 * 提高用户体验度  */
	public function pwdsAjax(){
	    if(IS_AJAX){
	        $id = session('id');
	        //$id = $this->A_login->checkLogin();
	        $newPwd = trim($_POST['newPwd']);
	        $info = M('user')->field('password')->where('id='.$id)->find();
	        if(md5($newPwd) == $info['password']){
	            $this->ajaxReturn($this->errmsg(10002, '新密码和原始密码不能相同!'));
	        }
	        
	        if(strlen($newPwd) < 6 || strlen($newPwd) > 16 || $newPwd == ''){
	            $this->ajaxReturn($this->errmsg(10002, '新密码请设置在6-16位字符之间!'));
	        }
	        
	    }
	}
	
	/**
	 * 修改密码成功后退出登录*/
	public function logOutUserPass(){
	    //请空session
	    session(null);
	    sleep(2);  //停留2秒执行下面代码
	    $this->redirect('Home/Login/ajaxLogin');
	}
	
	/**
	 * 经典语录列表 */
	public function yuluList(){
	    $id = session("id");
	    
	    $sign = $this->sing($id);
	    $numPhoto = $this->numPhoto($id);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-yuluList');
	}
	
	/**
	 * ajax无刷新分页显示经典语录列表 */
	public function yuluListAjax(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        //搜索条件
	        $datetime1 = trim($_POST['datetime1']);
	        $datetime2 = trim($_POST['datetime2']);
	        
	        $datetime1 = strtotime($datetime1);
	        $datetime2 = strtotime($datetime2);
	        //容错处理，以免用户随意选择之后报错
	        if($datetime2 != ''){
	            if($datetime1 > $datetime2){
	                $a = $datetime1;
	                $datetime1 = $datetime2;
	                $datetime2 = $a;
	            }
	        }
	        
	        if($datetime1 != '' && $datetime2 == ''){
	            $where['maketime'] = array('EGT',$datetime1);
	        }
	        
	        if($datetime1 == '' && $datetime2 != ''){
	            $datetime2 += 86400;    //加1天，这样就可以查出当天的选择日期了
	            $where['maketime'] = array('ELT',$datetime2);
	        }
	        
	        if($datetime1 != '' && $datetime2 != ''){
	            $datetime2 += 86400;
	            $where['maketime'] = array('BETWEEN',array($datetime1,$datetime2));
	        }
	        
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        
	        //总记录数   每页显示数  总页数
	        $count = M('yulu')->where($where)->count();
	        $pageSize = 8;
	        $totalPage = ceil($count/$pageSize);
	        
	        //当前页 起始页
	        $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
	        $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
	        $startRow = ($currPage-1)*$pageSize;
	        
	        //分页跳转时要带的参数，保证点击下一页时查询条件还存在
	        foreach($where as $key=>$val) {
	            $Page->parameter[$key]   =   urlencode($val);
	        }
	        
	        $list = M('yulu')->where($where)->order('maketime desc')->limit($startRow.',',$pageSize)->select();
	        foreach($list as $k => $v){
	            $list[$k]['is_ok'] = $v['is_ok'] == 0 ? '未通过' : '已通过';
	        }
	        
	        $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
	    }
	}
	
	/**
	 * 删除语录 */
	public function yuluDel(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	       $id = $_POST['id']; //语录ID
	       if(!$id){
	           $this->ajaxReturn($this->errmsg(10001, '不存在该语录!'));
	       }
	       
	       $where['id'] = $id;
	       $where['uid'] = $uid;
	       $where['uid_type'] = 2;
	       
	       $flag = M('yulu')->where($where)->delete();

	       if($flag){
	           //删除成功,删除点赞记录
	           M('yulu_like')->where('yulu_id='.$id)->delete();
	       
	           $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
	       }else{
	           $this->ajaxReturn($this->errmsg(10001, '未知原因,删除失败!'));
	       }
	       
	    }
	}
	
	/**
	 * 批量删除语录 */
	public function allDelYulu(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        $id = $_POST['id'];
	        $where['id'] = array('in',$id);
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        
	        $flag = M('yulu')->where($where)->delete();
	        if($flag){
	            //删除成功,删除点赞记录
	            $w['yulu_id'] = array('in',$id);
	            M('yulu_like')->where($w)->delete();
	        
	            $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,删除失败!'));
	        }
	    }
	}
	
	/**
	 * 新增语录 */
	public function yuluAdd(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        //接收参数
	        $content = trim($_POST['content']);
	        if($content == ''){
	            $this->ajaxReturn($this->errmsg(10001, '内容不能为空!'));
	        }
	        
	        //$user = M('user')->where('id='.$uid)->find();
	        $sql = "select u.username,u.nickname,u.login_way,u.u_img,q.qq_nickname,q.qq_img from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = {$uid}";
	        $res = M()->query($sql);
	        $nickname = $res[0]['login_way'] == 0 ? $res[0]['nickname'] : $res[0]['qq_nickname'];
	        $img = $res[0]['login_way'] == 0 ? $res[0]['u_img'] : $res[0]['qq_img'];

	        $add['content'] = $content;
	        $add['uid'] = $uid;
	        $add['uid_type'] = 2;
	        $add['img'] = $img;
	        $add['author'] = $nickname;
	        $add['maketime'] = date('Y-m-d H:i:s',time());
	        $add['is_ok'] = 0;
	        
	        $flag = M('yulu')->add($add);
	        if($flag){
	            $this->ajaxReturn($this->errmsg(10000, '新增成功,审核通过之后既可显示!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,新增失败!'));
	        }
	    }
	    
	    $sign = $this->sing($uid);
	    $numPhoto = $this->numPhoto($uid);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-yuluAdd');
	}
	
	/**
	 * 编辑语录 */
	public function yuluEdit(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        $yuluId = $_POST['id'];
	        $content = trim($_POST['content']);
	        $where['id'] = $yuluId;
	        $where['uid'] = $uid;
	        $data['content'] = $content;
	        
	        $flag = M('yulu')->where($where)->save($data);
	        if($flag){
	            $this->ajaxReturn($this->errmsg(10000, '编辑成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,编辑失败!'));
	        }
	    }
	    
	    $id = $_GET['id'];
	    $info = M('yulu')->where('id='.$id)->find();
	    $this->assign('info',$info);
	    
	    $sign = $this->sing($uid);
	    $numPhoto = $this->numPhoto($uid);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-yuluChange');
	}
	
	/**
	 * 幽默笑话列表 */
	public function jokeList(){
	    $id = session("id");
	    $sign = $this->sing($id);
	    $numPhoto = $this->numPhoto($id);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-jokeList');
	}
	
	/**
	 * ajax无刷新分页显示幽默笑话列表 */
	public function jokeListAjax(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        //搜索条件
	        $datetime1 = trim($_POST['datetime1']);
	        $datetime2 = trim($_POST['datetime2']);
	        
	        $datetime1 = strtotime($datetime1);
	        $datetime2 = strtotime($datetime2);
	        //容错处理，以免用户随意选择之后报错
	        if($datetime2 != ''){
	            if($datetime1 > $datetime2){
	                $a = $datetime1;
	                $datetime1 = $datetime2;
	                $datetime2 = $a;
	            }
	        }
	        
	        if($datetime1 != '' && $datetime2 == ''){
	            $where['maketime'] = array('EGT',$datetime1);
	        }
	        
	        if($datetime1 == '' && $datetime2 != ''){
	            $datetime2 += 86400;    //加1天，这样就可以查出当天的选择日期了
	            $where['maketime'] = array('ELT',$datetime2);
	        }
	        
	        if($datetime1 != '' && $datetime2 != ''){
	            $datetime2 += 86400;
	            $where['maketime'] = array('BETWEEN',array($datetime1,$datetime2));
	        }
	        
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        
	        //总记录数   每页显示数  总页数
	        $count = M('joke')->where($where)->count();
	        $pageSize = 8;
	        $totalPage = ceil($count/$pageSize);
	        
	        //当前页 起始页
	        $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
	        $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
	        $startRow = ($currPage-1)*$pageSize;
	        
	        //分页跳转时要带的参数，保证点击下一页时查询条件还存在
	        foreach($where as $key=>$val) {
	            $Page->parameter[$key]   =   urlencode($val);
	        }
	        
	        $list = M('joke')->where($where)->order('maketime desc')->limit($startRow.',',$pageSize)->select();
	        foreach($list as $k => $v){
	            $list[$k]['is_ok'] = $v['is_ok'] == 0 ? '未通过' : '已通过';
	        }
	        
	        $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
	    }
	}
	
	/**
	 * 删除幽默笑话 */
	public function jokeDel(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        $id = $_POST['id']; //语录ID
	        if(!$id){
	            $this->ajaxReturn($this->errmsg(10001, '不存在该笑话!'));
	        }
	
	        $where['id'] = $id;
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	
	        $flag = M('joke')->where($where)->delete();
	
	        if($flag){
	            //删除成功,删除点赞记录
	            M('joke_like')->where('joke_id='.$id)->delete();
	
	            $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,删除失败!'));
	        }
	
	    }
	}
	
	/**
	 * 批量删除幽默笑话 */
	public function jokeAllDel(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        $id = $_POST['id'];
	        $where['id'] = array('in',$id);
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	         
	        $flag = M('joke')->where($where)->delete();
	        if($flag){
	            //删除成功,删除点赞记录
	            $w['joke_id'] = array('in',$id);
	            M('joke_like')->where($w)->delete();
	             
	            $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,删除失败!'));
	        }
	    }
	}
	
	/**
	 * 新增幽默笑话 */
	public function jokeAdd(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        //接收参数
	        $content = trim($_POST['content']);
	        if($content == ''){
	            $this->ajaxReturn($this->errmsg(10001, '内容不能为空!'));
	        }
	         
	        //$user = M('user')->where('id='.$uid)->find();
	        $sql = "select u.username,u.nickname,u.login_way,u_img,q.qq_nickname,qq_img from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = {$uid}";
	        $res = M()->query($sql);
	        $nickname = $res[0]['login_way'] == 0 ? $res[0]['nickname'] : $res[0]['qq_nickname'];
	        $img = $res[0]['login_way'] == 0 ? $res[0]['u_img'] : $res[0]['qq_img'];
	         
	        $add['content'] = $content;
	        $add['uid'] = $uid;
	        $add['uid_type'] = 2;
	        $add['img'] = $img;
	        $add['author'] = $nickname;
	        $add['maketime'] = date('Y-m-d H:i:s',time());
	        $add['is_ok'] = 0;
	         
	        $flag = M('joke')->add($add);
	        if($flag){
	            $this->ajaxReturn($this->errmsg(10000, '新增成功,审核通过之后既可显示!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,新增失败!'));
	        }
	    }
	    
	    $sign = $this->sing($uid);
	    $numPhoto = $this->numPhoto($uid);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-jokeAdd');
	}
	
	/**
	 * 编辑幽默笑话 */
	public function jokeEdit(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        $yuluId = $_POST['id'];
	        $content = trim($_POST['content']);
	        $where['id'] = $yuluId;
	        $where['uid'] = $uid;
	        $data['content'] = $content;
	         
	        $flag = M('joke')->where($where)->save($data);
	        if($flag){
	            $this->ajaxReturn($this->errmsg(10000, '编辑成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '未知原因,编辑失败!'));
	        }
	    }
	     
	    $id = $_GET['id'];
	    $info = M('joke')->where('id='.$id)->find();
	    $this->assign('info',$info);
	    
	    $sign = $this->sing($uid);
	    $numPhoto = $this->numPhoto($uid);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-jokeChange');
	}
	
	/**
	 * 优美文章列表 */
	public function articleList(){
	    $id = session("id");
	    
	    $sign = $this->sing($id);
	    $numPhoto = $this->numPhoto($id);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('admin-artiList');
	}
	
	/**
	 * ajax无刷新分页显示优美文章列表 */
	public function articleListAjax(){
        if(IS_AJAX){
            
            $uid = session('id');
            
            $title = trim($_POST['title']);
            $datetime1 = trim($_POST['datetime1']);
            $datetime2 = trim($_POST['datetime2']);
            
            $datetime1 = strtotime($datetime1);
            $datetime2 = strtotime($datetime2);
            //容错处理，以免用户随意选择之后报错
            if($datetime2 != ''){
                if($datetime1 > $datetime2){
                    $a = $datetime1;
                    $datetime1 = $datetime2;
                    $datetime2 = $a;
                }
            }
            
            if($datetime1 != '' && $datetime2 == ''){
                $where['create_date'] = array('EGT',$datetime1);
            }
            
            if($datetime1 == '' && $datetime2 != ''){
                $datetime2 += 86400;    //加1天，这样就可以查出当天的选择日期了
                $where['create_date'] = array('ELT',$datetime2);
            }
            
            if($datetime1 != '' && $datetime2 != ''){
                $datetime2 += 86400;
                $where['create_date'] = array('BETWEEN',array($datetime1,$datetime2));
            }
            
            if($title != ''){
                $where['title'] = array('like','%'.$title.'%');
            }
            
            $where['uid'] = $uid;
            $where['uid_type'] = 2;
            
            //总记录数   每页显示数   总页数
            $count = M('article')->where($where)->count();
            $pageSize = 8;
            $totalPage = ceil( $count/$pageSize );
            
            //当前页   起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            $startRow = ($currPage - 1) * $pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = M('article')->field(true)->where($where)->limit($startRow.','.$pageSize)->order('create_date desc')->select();
            foreach($list as $k => $v){
                $list[$k]['is_ok'] = $v['is_ok'] == 0 ? '未通过' : '已通过';
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page']= $totalPage;//总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }
	}
	
	/**
	 * 文章详情  */
	Public function article(){
	    //接收参数
	    $id = $_GET['id'];
	    $find = M('article')->where('id='.$id)->find();
	    $this->assign("info",$find);
	    
	    $uid = session("id");
	    $sign = $this->sing($uid);
	    $numPhoto = $this->numPhoto($uid);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display("admin-article");
	}
	
	/**
	 * 删除文章  */
	public function articleDelete(){
	    if(IS_AJAX){
	        $uid = session('id');
	        $id = $_POST['id']; //文章ID
	        
	        $where['id'] = $id;
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        
	        $flag = M('article')->where($where)->delete();
	
	        if($flag){
	
	            M('article_comment')->where('article_id='.$id)->delete();
	            M('article_img')->where('article_id='.$id)->delete();
	            M('article_like')->where('acticle_id='.$id)->delete();
	
	            $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '删除失败!'));
	        }
	    }
	}
	
	/**
	 * 批量删除文章  */
	public function articleAllDel(){
	    if(IS_AJAX){
	        $uid = session('id');
	        $id = trim($_POST['id']);
	        //var_dump($id);
	        $where['id'] = array('in',$id);
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        $flag = M('article')->where($where)->delete();
	
	        if($flag){
	
	            $wh['article_id'] = array('in',$id);
	            M('article_comment')->where($wh)->delete();
	            M('article_img')->where($wh)->delete();
	            M('article_like')->where($wh)->delete();
	
	            $this->ajaxReturn($this->errmsg(10000, '批量删除成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10001, '批量删除失败!'));
	        }
	    }
	}
	
	/**
	 * 编辑文章  */
	public function articleEdit(){
	    $uid = session('id');
	    if(IS_AJAX){
	        $id = $_POST['id'];
	        $title = trim($_POST['title']);
	        $jianjie = trim($_POST['jianjie']);
	        $content = trim($_POST['content']);
	        //$content = trim($_POST['editorValue']);
	        $img_url = trim($_POST['img_url']);
	
	        if($title == ''){
	            $this->ajaxReturn($this->errmsg(10001,'标题不能为空!'));
	        }
	
	        //if(!perg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,15})$/",$title)){
	        //$this->ajaxReturn($this->errmsg(10001, '标题不能包含特殊字符，15字以内!'));
	        //}
	
	        if($jianjie == ''){
	            $this->ajaxReturn($this->errmsg(10002, '简介不能为空!'));
	        }
	
	        //if(!perg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,50})$/",$jianjie)){
	        //$this->ajaxReturn($this->errmsg(10002, '简介不能包含特殊字符，50字以内!'));
	        //}
	
	        if($content == ''){
	            $this->ajaxReturn($this->errmsg(10003, '内容不能为空!'));
	        }
	        
	        if($img_url != ''){ //有传图片时就修改，没有则用原来的
	            $data['img_url'] = $img_url;
	        }
	        
	        $where['id'] = $id;
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	
	        $data['title'] = $title;
	        $data['jianjie'] = $jianjie;
	        $data['content'] = $content;
	        $data['img'] = $img_url;
	
	        $res = M('article')->where($where)->save($data);
	        //echo M()->getLastSql();exit;
	
	        if($res){
	            $this->ajaxReturn($this->errmsg(10000, '编辑成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10004, '未知原因,编辑失败!'));
	        }
	    }
	
	    $id = $_GET['id'];
	    $list = M('article')->field(true)->where('id='.$id)->find();
	    
	    $sign = $this->sing($uid);
	    $numPhoto = $this->numPhoto($uid);
	    $this->assign("sign",$sign);
	    $this->assign("numPhoto",$numPhoto);
	    
	    $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
	    $this->assign("numMessage",$numMessage);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	
	    $this->assign('list',$list);
	    $this->display('admin-artiChange');
	}
	
    /**
     * 添加文章  */
    public function articleAdd(){
        if(IS_AJAX){
            $title = trim($_POST['title']);
            $jianjie = trim($_POST['jianjie']);
            $content = trim($_POST['content']);
            $img_url = trim($_POST['img_url']);
            //var_dump($img_url);exit;
            
            if($title == ''){
                $this->ajaxReturn($this->errmsg(10001,'标题不能为空!'));
            }
            
            //if(!preg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,15})$/",$title)){
                //$this->ajaxReturn($this->errmsg(10001, '标题不能包含特殊字符，15字以内!'));
            //}
            
            if($jianjie == ''){
                $this->ajaxReturn($this->errmsg(10002, '简介不能为空!'));
            }
            
            //if(!preg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,50})$/",$jianjie)){
               // $this->ajaxReturn($this->errmsg(10002, '简介不能包含特殊字符，50字以内!'));
            //}
            
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10003, '内容不能为空!'));
            }
            
            if($img_url == ''){
                $this->ajaxReturn($this->errmsg(10005, '请上传封面图!'));
            }
            
            $uid = session('id');
            //$info = M('user')->field(true)->where('id='.$uid)->find();
            $sql = "select u.username,u.nickname,u.login_way,q.qq_nickname from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = {$uid}";
            $res = M()->query($sql);
            $nickname = $res[0]['login_way'] == 0 ? $res[0]['nickname'] : $res[0]['qq_nickname'];
            
            $add['uid'] = $uid;
            $add['uid_type'] = 2;
            //$add['author'] = $info['nickname'];
            $add['author'] = $nickname;
            $add['title'] = $title;
            $add['jianjie'] = $jianjie;
            $add['content'] = $content;
            $add['img_url'] = $img_url;
            $add['create_date'] = date('Y-m-d H:i:s',time());
            
            $res = M('article')->add($add);
            
            if($res){              
                $this->ajaxReturn($this->errmsg(10000, '发布成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10004, '未知原因,发布失败!'));
            }
        }
        
        $uid = session("id");
        $sign = $this->sing($uid);
        $numPhoto = $this->numPhoto($uid);
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
        $this->assign("numMessage",$numMessage);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-artiAdd');
    }
    
    /**
     * 个人相册列表  */
    public function photo(){
        $id = session("id");
        
        $sign = $this->sing($id);
        $numPhoto = $this->numPhoto($id);
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
        $this->assign("numMessage",$numMessage);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-photo');
    }
    
    /**
     * ajax无刷新显示个人相册列表  */
    public function ajaxPhotoList(){
        if(IS_AJAX){
            $uid = session('id');
            
            $datetime1 = trim($_POST['datetime1']);
            $datetime2 = trim($_POST['datetime2']);
            
            $datetime1 = strtotime($datetime1);
            $datetime2 = strtotime($datetime2);
            //容错处理，以免用户随意选择之后报错
            if($datetime2 != ''){
                if($datetime1 > $datetime2){
                    $a = $datetime1;
                    $datetime1 = $datetime2;
                    $datetime2 = $a;
                }
            }
            
            if($datetime1 != '' && $datetime2 == ''){
                $where['create_date'] = array('EGT',$datetime1);
            }
            
            if($datetime1 == '' && $datetime2 != ''){
                $datetime2 += 86400;    //加1天，这样就可以查出当天的选择日期了
                $where['create_date'] = array('ELT',$datetime2);
            }
            
            if($datetime1 != '' && $datetime2 != ''){
                $datetime2 += 86400;
                $where['create_date'] = array('BETWEEN',array($datetime1,$datetime2));
            }
            
            $where['uid'] = $uid;
            
            //总记录数  每页显示数  总页数
            $count = M('user_photo')->where($where)->count();
            $page_size = 12;
            $total_page = ceil($count/$page_size);
            
            //当前页  起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >=1 && $currPage <= $total_page) ? $currPage : 1;
            $startRow = ($currPage-1)*$page_size;
            
            $userCoverImg = C(USERCOVERIMG);
            $imgarr = array(
                array(
                    'id'=>0,
                    'uid'=>$uid,
                    'img'=>$userCoverImg,
                    'is_ok'=>1,
                    'create_date'=>'',
                    'is_photo_show'=>1,
                )
            );
            
            //判断用户是否有封面图
            $w['uid'] = $uid;
            $w['is_photo_show'] = 1;
            $isShow = M('user_photo')->where($w)->find();
            if($isShow){    //有封面图
                $list = M('user_photo')->where($where)->order('is_photo_show desc,create_date desc')->limit($startRow.','.$page_size)->select();
                foreach($list as $k => $v){
                    if($v['is_photo_show'] == 1){
                        $list[$k]['maketime'] = "<span style='color:red;font-size:14px;'>封面图：</span>".$v['create_date']."<input type='button' onclick='userEditCoverImg()' value='编辑'/>";
                    }else{
                        $list[$k]['maketime'] = $v['create_date'];
                    }
                }
            }else{  //没有封面图
                $list = M('user_photo')->where($where)->order('is_photo_show desc,create_date desc')->limit($startRow.','.$page_size)->select();
                $list = array_merge($imgarr,$list); //添加返回信息$imgarr
                foreach($list as $k => $v){
                    if($v['is_photo_show'] == 1){
                        $list[$k]['maketime'] = "<span style='color:red;font-size:14px;'>封面图</span><input type='button' onclick='userEditCoverImg()' value='编辑'/>";
                    }else{
                        $list[$k]['maketime'] = $v['create_date'];
                    }
                    
                }
                
            }
            
            $data['count'] = $count;
            $data['total_page'] = $total_page;
            $data['currPage'] = $currPage;
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
        }
    }
    
    /**
     * 添加个人图片（相册）  */
    public function photoAdd(){
        $id = session("id");
        
        $sign = $this->sing($id);   //个性签名
        $numPhoto = $this->numPhoto($id);   //图片数量
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
        $this->assign("numMessage",$numMessage);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-photoAdd');
    }
    
    /**
     * 添加个人封面图片  */
    public function photoCoverAdd(){
        $id = session("id");
        
        //显示相册列表封面图像（用户）
        if($id != '' || $id != null){
            $where['uid'] = $id;
            $where['is_ok'] = 1;
            $where['is_photo_show'] = 1;
            $info = M('user_photo')->where($where)->find();
            $this->assign('info',$info);
        }
        $this->assign("info",$info);
        
        $sign = $this->sing($id);
        $numPhoto = $this->numPhoto($id);
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
        $this->assign("numMessage",$numMessage);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-photoCoverAdd');
    }
    
    /**
     * 多图片上传  */
    public function uploadPhoto(){
        $photo = $this->A_photo->muchPhotoUpload('Public/Uploads/user/photo/');
        echo $photo;
    }
    
    /**
     * 添加个人相册到数据库  */
    public function photoUserAdd(){
        $uid = session('id');
        
        if(IS_AJAX){
            if(!$uid){
                $this->ajaxReturn($this->errmsg(20001, '请先登录后再来添加哟!'));
            }
    
            //接收参数
            $img = trim($_POST['img']);
            if($img == ''){
                $this->ajaxReturn($this->errmsg(10001, '请上传至少一张图片哟!'));
            }
    
            $add['uid'] = $uid;
            $add['img'] = $img;
            $add['create_date'] = date('Y-m-d H:i:s',time());
            $add['is_photo_show'] = 0;
            $res = M('user_photo')->add($add);
    
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '上传成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '未知原因,上传成功!'));
            }
    
        }
    
        //$this->display('addUserPhoto');
    }
    
    /**
     * 删除相片*/
    public function delPhoto(){
        $id = session("id");
        if(IS_AJAX){
            $imgId = trim($_POST['imgId']);
            $where['uid'] = $id;
            $where['id'] = $imgId;
            
            $res = M('user_photo')->where($where)->delete();
            if($res){
                $this->ajaxReturn($this->errmsg(10000, "删除成功！"));
            }else{
                $this->ajaxReturn($this->errmsg(10001, "删除失败！"));
            }
        }
    }
    
    /**
     * 安全日志*/
    public function safeLog(){
        $id = session("id");
        
        $sign = $this->sing($id);
        $numPhoto = $this->numPhoto($id);
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $numMessage = $this->A_Message->showOneMessageCount();  //未查看的留言条目数
        $this->assign("numMessage",$numMessage);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-log');
    }
    
    /**
     * ajax无刷新分页显示安全日志列表*/
    public function safeLogList(){
        if(IS_AJAX){
            $uid = session('id');
            //总记录数  每页显示数  总页数
            $count = M('user_log')->where('uid='.$uid)->count();
            $pageSize = 18;
            $total_page = ceil($count/$pageSize);
            
            //当前页   起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $total_page) ? $currPage : 1;
            $startRow = ($currPage - 1) * $pageSize;
            
            $list = M('user_log')->where('uid='.$uid)->order('user_time desc')->limit($startRow.','.$pageSize)->select();
            foreach($list as $k => $v){
                $list[$k]['times'] = $v['user_time'];
                $list[$k]['type'] = $v['user_type'] == 1 ? ($v['login_type'] == 1 ? '<span style="color:#FF8C69;font-weight:bold;">使用账号密码登录了系统!</span>' : '<span style="color:#FF8C69;font-weight:bold;">使用QQ号登录了系统!</span>') : '<span style="color:#FF6347;font-weight:bold;">进行了密码修改!</span>';
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page']= $total_page;//总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }  
    }
    
    /**
     * 我给别人留言的列表*/
    public function myMessageList(){
        $id = session("id");

        $where['uid'] = $id;
        $where['uid_type'] = 2;
        $yuluCon = M('yulu')->where($where)->count();
        $jokeCon = M('joke')->where($where)->count();
        $artiCon = M('Article')->where($where)->count();
        $this->assign('yuluCon',$yuluCon); //语录总数
        $this->assign('jokeCon',$jokeCon); //笑话总数
        $this->assign('artiCon',$artiCon); //文章总数
        
        $sign = $this->sing($id);//个性签名
        $numPhoto = $this->numPhoto($id);//照片数量
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-index-my-message');
    }
    
    /**
     * 别人给我的留言列表*/
    public function messageAllList(){
        $id = session("id");
        
        $sign = $this->sing($id);//个性签名
        $numPhoto = $this->numPhoto($id);//照片数量
        $this->assign("sign",$sign);
        $this->assign("numPhoto",$numPhoto);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('admin-index-messageList');
    }
    
    /**
     * 我的绑定信息
     * $res=1 账号和QQ号进行了绑定
     * $res=2 注册了本网站账号，但未进行QQ号绑定
     * $res=3 进行了QQ登录，但未注册本网站账号*/
    public function bindList(){
        $id = session("id");
        $where['id'] = $id;
        $info = M('user')->where($where)->find();
        if($info['username'] != '' && $info['qq_openid'] != ''){
            $res = 1;
        }else if($info['username'] != '' && $info['qq_openid'] == ''){
            $res = 2;
            A('Qq')->qqurl();//QQ登录入口
        }else if($info['username'] == '' && $info['qq_openid'] != ''){
            $res = 3;
        }
        
        $this->assign('res',$res);
        $this->display('admin-bindList');
    }

}