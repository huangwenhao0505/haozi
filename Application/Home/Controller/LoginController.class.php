<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {
    
    Public function __construct(){
        parent::__construct();
        //A('IsMobile')->getIsMobile();//判断是否是手机端浏览
        $this->A_Qq = A('Qq');
        $this->A_UrlUtile = A('UrlUtile');
    }
    
    /**
	 * 返回错误信息
	 * @param unknown $errno
	 * @param unknown $errmsg
	 * @return multitype:unknown  */
	private function errmsg($errno,$errmsg){
		$array = array(
			'errno' => $errno,
			'errmsg'=> $errmsg
		);
		return $array;
	}
	
	/**
	 * 生成验证码  */
	public function verify(){
	    $Verify = new \Think\Verify();
	
	    $Verify->fontSize = 30;     // 验证码字体大小
	    $Verify->length   = 4;      // 验证码位数
	    $Verify->useNoise = false;  // 关闭验证码杂点
	
	    $Verify->entry();
	}
	
	/**
	 * 验证是否已登录  */
	public function checkLogin(){
	    $id = session('id');
	    $qq_openid = session('qq_openid');
	    $username = session('username');

	    if(empty($id) && empty($username) && empty($qq_openid) && $id == null && $username == null && $qq_openid == null){
	        //$this->ajaxReturn($this->errmsg(20001, '你没有权限访问!'));
	        $this->redirect('Login/ajaxLogin');
	    }

	    //return $id;
	}
	
	/**
	 * 判断是否绑定了账号
	 * 当QQ登录时，没有绑定账号时，存在userid，但其username为空
	 * 关于user的操作，全部给出提示*/
	public function checkUsername(){
	    $id = session('id');
	    $info = M('user')->where('id='.$id)->find();
	    if($info['username'] == ''){
	        $this->ajaxReturn($this->errmsg(30001, '您使用的QQ登录，还没绑定本网站账号哟，请前去（个人资料）绑定后再来操作！'));
	    }
	}
	
	/**
	 * 判断是否绑定了QQ号
	 * 当账号登录时，没有绑定QQ，username存在，但qq_openid为空
	 * 注意一点：要判断$id是否为空，不然当没有任何登录时，使用QQ快速登录就会报错，因为不存在其session，这里的查询条件就不存在了，就会报错*/
	public function checkQQ(){
	    $id = session('id');
	    if(empty($id)){
	        $res = 2;
	    }else{
	        $info = M('user')->where('id='.$id)->find();
	         
	        if($info['username'] != '' && $info['qq_openid'] == ''){
	            $res = 1;
	        }else if($info['qq_openid'] != ''){
	            $res = 0;
	        }
	    }
	    
	    return $res;
	}
	
	/**
	 * 判断用户名是否已被注册  
	 * 此方法用于在前台用户输入时显示，提高用户体验
	 * */
	public function ajaxUser(){
		if(IS_AJAX){
			$username = trim($_POST['username']);
			$where['username'] = $username;
			$info = M('user')->field('username')->where($where)->find();
			if($info){
				$this->ajaxReturn($this->errmsg(10001, '用户名已存在，请重新输入'));
			}
			
			//判断用户名是否合法
			if($username == ''){
				$this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
			}
				
			/*if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$username)){
				$this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度在6-16字符之间'));
			}*/
			
			if(preg_match("/[!@#$%^&*()?\/\|\\()-+={}\"':;,.]+/", $username)){
			    $this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度在6-16字符之间'));
			}
				
			if($this->abslength($username) < 6 || $this->abslength($username) > 16){
				$this->ajaxReturn($this->errmsg(10001, '用户名请设置在6-16个字符之间'));
			}
		}
	}
	
	/**
	 * 判断邮箱是否已被注册
	 * 此方法用于在前台用户输入时显示，提高用户体验
	 * */
	public function ajaxEmail(){
	    if(IS_AJAX){
	        $email = trim($_POST['email']);
	        
	        if($email == ''){
	            $this->ajaxReturn($this->errmsg(10001, '邮箱不能为空'));
	        }
	        
	        $where['email'] = $email;
	        $where['states'] = 1;
	        $info = M('user')->field('email')->where($where)->find();
	        if($info){
	            $this->ajaxReturn($this->errmsg(10001, '该邮箱已被注册，请换一个邮箱'));
	        }
	        
	        if(!preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",$email)){
	            $this->ajaxReturn($this->errmsg(10001, '请输入正确的邮箱格式!'));
	        }
	    }
	}
	
	public function regist(){
	    $this->display('regist');
	}
	
	/**
	 * 用户注册  */
	public function ajaxRegist(){
		
		if(IS_AJAX){
			$username = trim($_POST['username']);
			$userpass = trim($_POST['userpass']);
			$userpass2 = trim($_POST['userpass2']);
			$email = trim($_POST['email']);
			$code = trim($_POST['code']);
			
			//合理性验证
			$where['username'] = $username;
			$info = M('user')->field('username')->where($where)->find();
			if($info){
				$this->ajaxReturn($this->errmsg(10001, '用户名已存在，请重新输入'));
			}
			
			if($username == ''){
				$this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
			}
			
			/*if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$username)){
				$this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度6-16字符之间'));
			}
			
			if(strlen($username) < 6 || strlen($username) > 16){
				$this->ajaxReturn($this->errmsg(10001, '用户名请设置在6-16个字符之间'));
			}*/
			
			if(preg_match("/[!@#$%^&*()?\/\|\\()-+={}\"':;,.]+/", $username)){
			    $this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度在6-16字符之间'));
			}
			
			if($this->abslength($username) < 6 || $this->abslength($username) > 16){
			    $this->ajaxReturn($this->errmsg(10001, '用户名请设置在6-16个字符之间'));
			}
			
			if(strlen($userpass) < 6 || strlen($userpass) > 16){
				$this->ajaxReturn($this->errmsg(10002, '密码请设置在6-16位字符之间'));
			}
			
			if($userpass !== $userpass2){
				$this->ajaxReturn($this->errmsg(10003, '两次输入的密码不一致'));
			}
			
			if($email == ''){
			    $this->ajaxReturn($this->errmsg(10005, '请输入邮箱'));
			}
			
			if(!preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",$email)){
			    $this->ajaxReturn($this->errmsg(10005, '邮箱格式错误'));
			} 
			
			if($code == ''){
			    $this->ajaxReturn($this->errmsg(10004, '验证码不能为空'));
			}
			
			$verify = new \Think\Verify();
			
			if(!$verify->check($code)){
			    $this->ajaxReturn($this->errmsg(10004, '验证码不正确,点击刷新验证码重试'));
			}
			
			
			$a = md5('haozi'.$userpass);
			$b = $email;
			$c = time();
			$activate_code = md5($a.$b.$c);//创建用于激活识别码
			$activate_code_time = time()+60*60*24;//过期时间为24小时后
			
			//验证成功，写入数据库
			//密码强弱
			if(strlen($userpass) >= 6 && strlen($userpass) <= 8){
			    $data['password_leven'] = 1;
			}else if(strlen($userpass) > 8 && strlen($userpass) <= 12){
			    $data['password_leven'] = 2;
			}else if(strlen($userpass) > 12 && strlen($userpass) <= 16){
			    $data['password_leven'] = 3;
			}
			$data['username'] = $username;
			$data['password'] = md5($userpass);
			$data['regist_time'] = date('Y-m-d H:i:s',time());
			$data['email'] = $email;
			$data['activate_code'] = $activate_code;
			$data['activate_code_times'] = $activate_code_time;
			
			$res = M('user')->add($data);
			
			//写入默认头像
			/* $upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath  =     '/Public/Uploads/'; // 设置附件上传根目录
			$upload->savePath  =     'user/'; // 设置附件上传（子）目录
			// 上传文件
			$info   =   $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->error($upload->getError());
			}else{// 上传成功
				$oriPath = $info['u_img']['savepath'].$info['u_img']['savename'];	//上传后原始图片的路径
                $img['u_img'] = $oriPath;	//插入到数据库
                
                $uid = $res['id'];	//用户ID
                $img['u_id'] = $uid;
                
                M('u_img')->add($img);
			} */
			
			if(!$res){
				$this->ajaxReturn($this->errmsg(20001, '注册失败'));
				die();
			}else{
			    //注册成功，发送邮件
			    //sendMail(用户邮箱, 主题, 内容);
			    $w['username'] = $username;
			    $info = M('user')->field("id")->where($w)->find();
			    $id = $info['id'];   //获取当注册的用户id
			    
			    $title = "欢迎您注册本网站会员";
			    $content = "请点击此链接完成激活，此链接24小时以内有效http://".$_SERVER['HTTP_HOST']."/Home/Login/userActivate?id={$id}&verify=".$activate_code."&time={$activate_code_time}<br/><h3>如果此链接不能点击，请复制此链接到浏览器里访问！</h3><h3>注意：如不是本人操作，请忽略此条信息，勿点击！</h3>";
			    sendMail($email, $title, $content);
			    
				$this->ajaxReturn($this->errmsg(20000, "注册成功！请登录到您的邮箱及时激活您的帐号！"));
			}
		}
		$this->display('regist');
	}
	
	/**
	 * 计算字符串长度，中文(UTF8格式)算3个字符，英文算一个字符
	 * */
	private function abslength($str)
	{
	    $len = strlen($str);
	    $i = 0;
	    while ($i < $len)
	    {
	        if (preg_match("/^[" . chr(0xa1) . "-" . chr(0xff) . "]+$/", $str[$i]))
	        {
	            $i += 2;
	        }
	        else
	        {
	            $i += 1;
	        }
	    }
	
	    return $i;
	}
	
	/**
	 * 完成邮箱激活功能
	 * 激活账户 */
	public function userActivate(){
	    //接收参数
	    $id = trim($_GET['id']);
	    $verify = trim($_GET['verify']);
	    $time = trim($_GET['time']);
	    
	    //判断是否已过有效期时间
	    if($time < time())
	    {
	       $this->redirect("Login/regist","",3,"已过有效期时间！");
	    }
	    
	    $where['id'] = $id;
	    $where['activate_code'] = $verify;
	    $data['states'] = 1;
	    $res = M('user')->where($where)->save($data);
	    if($res){
	        //激活成功，清空activate_code
	        $w['states'] = 1;
	        $w['id'] = $id;
	        $d['activate_code'] = "";
	        $d['activate_code_times'] = "";
	        M('user')->where($w)->save($d);
	        
	        $this->redirect("Login/ajaxLogin","",2,"激活成功，正在跳转到登录页面。。。");
	    }else{
	        $this->redirect("Login/regist","",3,"激活失败！");
	    }
	}
	
	/**
	 * 用户登录  */
	public function ajaxLogin(){
	
		if(IS_AJAX){
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$code = trim($_POST['code']);
			
			if($code == ''){
			    $this->ajaxReturn($this->errmsg(0, '验证码不能为空'));
			}
			
			$verify = new \Think\Verify();
			if(!$verify->check($code)){
			    $this->ajaxReturn($this->errmsg(0, '验证码不正确,点击验证码刷新'));
			}
	
			if($username == ''){
				$this->ajaxReturn($this->errmsg(-1, '用户名不能为空'));
			}
	
			if($password == ''){
				$this->ajaxReturn($this->errmsg(-2, '密码不能为空'));
			}
	
			$where['username'] = $username;
			$where['password'] = md5($password);
			$info = M('user')->where($where)->find();
			if(!$info){
				$this->ajaxReturn($this->errmsg(20001, '用户名和密码不匹配'));
			}else{
			    $isBlack = $info['is_black'];
			    $state = $info['states'];
			    if($isBlack == 1){
			        $this->ajaxReturn($this->errmsg(20001, '你已经被加入黑名单！'));
			    }
			    if($state == 0){
			        $this->ajaxReturn($this->errmsg(20001, '抱歉，该账号还未激活！'));
			    }
			}
			
			//登录成功，保存session
			session('id',$info['id']);
			session('username',$info['username']);
			if($info['u_img'] != ''){
			    session('u_img',$info['u_img']);
			}
			$id = session('id');
			
			M('user')->where('id='.$id)->data('login_way=0')->save();//账号登录，改变login_way标志为0
			
			$info = M('user')->field('username,nickname')->where('id='.$id)->find();
			$nickname = $info['nickname'] == '' ? $info['username'] : $info['nickname'];
			session('nickname',$nickname);   //用于在个人管理中心顶部显示
			
			//记录日志表
			$add['uid'] = $id;
			$add['user_time'] = date('Y-m-d H:i:s',time());
			$add['user_ip'] = $_SERVER['REMOTE_ADDR'];
			M('user_log')->add($add);
	
			//是否选择了记住密码
			if($_POST['remember_me'] == 1){
			    setcookie('id',$id,time()+3600*24*7);
				setcookie('username',$username,time()+3600*24*7);  //保存7天
				setcookie('password',$password,time()+3600*24*7);
				//M('user')->where('username='.session('username'))->data('remember_me=1')->save();
			}

			$this->ajaxReturn($this->errmsg(20000, '登录成功'));
		}
		
		/*$qqurl = $this->A_Qq->getLoginurl();
		$this->assign("qqurl",$qqurl);*/
		
		A('Qq')->qqurl();//QQ登录入口
	
		$this->display('login');
	}
	
	/**
	 * 忘记密码，用户重置   */
	public function wjPassword(){
	    if(IS_AJAX){

	        $username = trim($_POST['username']);
	        $email = trim($_POST['email']);
	        
	        if($username == ''){
	            $this->ajaxReturn($this->errmsg(10001, "请输入用户名！"));
	        }
	        
	        if($email == ''){
	            $this->ajaxReturn($this->errmsg(10002, "请输入邮箱！"));
	        }
	        
	        if(!preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",$email)){
	            $this->ajaxReturn($this->errmsg(10002, '邮箱格式错误'));
	        }
	        
	        $sql = "select id from hwh_user where username = '{$username}' and email = '{$email}'";
	        $res = M()->query($sql);
	        if($res[0][id] == ''){
	            $this->ajaxReturn($this->errmsg(10003, '用户名和注册邮箱不匹配！'));
	        }
	        
	        $a = md5('haozi'.$username);
	        $b = $email;
	        $c = time();
	        $activate_code = md5($a.$b.$c);//创建用于激活识别码
	        $activate_code_time = time()+60*60*24;//过期时间为24小时后
	        
	        //更新密码找回识别码字段
	        $d['reset_password_code'] = $activate_code;
	        $w['email'] = $email;
	        $res = M('user')->where($w)->save($d);
	       
            $title = "密码找回";
            $content = "请点击此链接来验证您的信息，此链接24小时以内有效http://".$_SERVER['HTTP_HOST']."/index.php/Home/Login/passActivate?username={$username}&verify=".$activate_code."<br/><h3>如果此链接不能点击，请复制此链接到浏览器里访问！</h3><h3>注意：如不是本人操作，请忽略此条信息，勿点击！</h3>";
            sendMail($email, $title, $content);    //sendMail(用户邮箱, 主题, 内容);
            $this->ajaxReturn($this->errmsg(10000, "邮件已发送，请前往您的邮箱验证您的信息！"));
	        
	    }
	    $this->display('getPass');
	}
	
	/**
	 * 完成邮箱激活功能
	 * 找回密码 */
	public function passActivate(){
	    //接收参数
	    $username = trim($_GET['username']);
	    $verify = trim($_GET['verify']);
	    $where['username'] = $username;
	    $where['reset_password_code'] = $verify;
	    $data['reset_password_state'] = 1;
	    $res = M('user')->where($where)->save($data);

        $this->redirect("Login/resetPassView","",3,"验证成功，正在跳转到重置密码界面。。。");
	    
	}
	
	/**
	 * 重置密码*/
	public function resetPassView(){
	    $this->display('resetPass');
	}
	
	public function resetPass(){
	    if(IS_AJAX){
	        $username = trim($_POST['username']);
	        $password = trim($_POST['password']);
	        $password2 = trim($_POST['password2']);
	        
	        if(strlen($password) < 6 || strlen($password) > 16){
	            $this->ajaxReturn($this->errmsg(10001, '密码请设置在6-16位字符之间'));
	        }
	        	
	        if($password !== $password2){
	            $this->ajaxReturn($this->errmsg(10002, '两次输入的密码不一致'));
	        }
	        
	        $w['username'] = $username;
	        $w['reset_password_state'] = 1;    //只有当是通过邮箱验证信息重置密码的，才有权限
	        $d['password'] = md5($password);
	        $res = M('user')->where($w)->save($d);
	        
	        if($res){
	            //重置成功，改变权限状态，清空密码找回识别码
	            $da['reset_password_state'] = 0;
	            $da['reset_password_code'] = "";
	            M('user')->where($w)->save($da);
	            
	            $this->ajaxReturn($this->errmsg(10000, '密码重置成功，正在为您跳转到登录界面'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10003, '非法操作，重置失败！'));
	        }
	    }
	    
	}
	
	/**
	 * 退出登录   */
	public function ajaxOut(){
	
		if(IS_AJAX){
			$username = session('username');
			$id = session('id');
			session(null);  //清空用户session
			if($username == null || $id == null || $username == '' || $id == ''){
				$this->ajaxReturn($this->errmsg(20003, '退出成功'));
			}else{
				$this->ajaxReturn($this->errmsg(20001, '退出失败'));
			}
		}
	}
	
	public function logOut(){
	
        $username = session('username');
        $id = session('id');
        session(null);  //清空用户session
        if($username == null || $id == null || $username == '' || $id == ''){
            $this->redirect('Home/Index/index');
        }else{
            $this->redirect('Home/Index/index');
        }

	}
	
	public function user(){
		$session = isset($_SESSION['username']) ? $_SESSION['username'] : '';
		$cookie = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
	
		if(empty($session)){
			if(empty($cookie)){
				$this->redirect('Home/User/ajaxLogin');
			}else{
				$_SESSION['username'] = $_COOKIE['username'];
				$info = M('user')->where('username='.$_SESSION['username']) ->find();
				$this->assign('info',$info);
			}
		}
		$this->display();
	}
	
	
	/**
	 * 微博登录*/
	public function weiBoLogin(){
	    include_once C(ROOT_PATH).'/third-party/weibo/config.php';
	    include_once C(ROOT_PATH).'/third-party/weibo/saetv2.ex.class.php';

	    $c = new \SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
	    $ms  = $c->home_timeline(); // done
	    $uid_get = $c->get_uid();
	    $uid = $uid_get['uid'];
	    $user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
	    var_dump($user_message);
	}
	
    /*public function qqLogin(){
        include_once C(ROOT_PATH).'/third-party/qq/API/qqConnectAPI.php';
        $qc = new \QC();
        $acs = $qc->qq_callback();//callback主要是验证 code和state,返回token信息，并写入到文件中存储，方便get_openid从文件中度
        $oid = $qc->get_openid();//根据callback获取到的token信息得到openid,所以callback必须在openid前调用
        $qc = new \QC($acs,$oid);
        $uinfo = $qc->get_user_info();
        var_dump($uinfo);
    }*/
	
	/**
	 * QQ登录*/
	public function qqLogin(){
	    $code = I('get.code');
	    $state = I('get.state');
	    if(empty($code)){
	        $this->error('登录失败！',U('Index/index'));
	        exit;
	    }
	    
	    if($_SESSION['qq_state'] != $state){
	        $this->error('登录状态异常！',U('Index/index'));
	        exit;
	    }
	    
	    $qq = $this->A_Qq;
	    $back = $qq->getBackurl();
	    
	    $appid = C(QQAPPID);
	    $appkey= C(QQAPPKEY);
	    //获取token
	    $resp = $this->A_UrlUtile->getHttps("https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id={$appid}&client_secret={$appkey}&code={$code}&redirect_uri={$back}");
	    $respArgs = array();
	    parse_str($resp, $respArgs);
	     
	    if( !empty($respArgs['code']) || empty($respArgs['access_token'])) {
			$this->error('登录失败请重新登录',U('Login/login'));
			exit;
		}
		
		$token = $respArgs['access_token'];
		//通过token获得openid
		
		$resp  = $this->A_UrlUtile->getHttps( "https://graph.qq.com/oauth2.0/me?access_token={$token}");
		if (strpos($resp, "callback") !== false)  {
		    $lpos = strpos($resp, "(");
		    $rpos = strrpos($resp, ")");
		    $resp  = substr($resp, $lpos + 1, $rpos - $lpos -1);
		}
		$user = json_decode($resp,true);
		if (isset($user['error'])) {
		    $this->error('QQ登录识别获取失败，请重新登录',U('Login/index'));
		    exit;
		}

        //获取用户信息
        $reuser = $this->A_UrlUtile->getHttps( "https://graph.qq.com/user/get_user_info?access_token={$token}&oauth_consumer_key={$appid}&openid={$user['openid']}&format=json" );
	    $qquser = json_decode($reuser,true);  //true 强制生成PHP关联数组
	    if($qquser['ret'] < 0){
	        $this->error($qquser['msg'],U('Login/index'));
	        exit;
	    }
	    
	    
	    $isCheckQQ = $this->checkQQ();
	    if($isCheckQQ == 1){//账号登录绑定QQ号操作
	        $qq_openid = $user['openid'];
	        //判断该QQ号是否已经被绑定
	        $dd['qq_openid'] = $qq_openid;
	        $row = M('user_qq')->where($dd)->find();
	        if($row){
	            $this->error('该QQ号以被使用，请重新进行绑定！',U('User/bindList'));
	            exit;
	        }
	        //把qq_openid写入到hwh_user表中
	        $w['id'] = session('id');
	        $flag = M('user')->where($w)->save($dd);
	        if(!$flag){
	            $this->error('未知原因，绑定失败！',U('Login/index'));
	            exit;
	        }
	         
	        //绑定成功写入到hwh_user_qq表中
	        $data['qq_openid'] = $user['openid'];
	        $data['qq_gender'] = $qquser['gender'];
	        $data['qq_nickname'] = $qquser['nickname'];
	        $data['qq_img'] = $qquser['figureurl_qq_1'];
	        $data['createDate'] = date('Y-m-d H:i:s',time());
	        $rs = M('user_qq')->add($data);
	         
	        session('qq_openid',$user['openid']);//绑定成功，保存其openid
	        session('qq_nickname',$qquser['nickname']);
	        session('qq_img',$qquser['figureurl_qq_1']);
	        
	        M('user')->where($w)->data('login_way=1')->save();//qq登录，改变login_way标志为1
	        
	        $this->redirect('/Home/User/userInfo');
	        exit;
	    }//end 账号登录绑定QQ号操作


	    //以下是正常的QQ登录操作
	    $wh['qq_openid'] = $user['openid'];
	    $info = M('user_qq')->where($wh)->find();
	    
	    if( !$info ){  //没有登录过，则写入表hwh_user_qq表
	        $data['qq_openid'] = $user['openid'];
	        $data['qq_gender'] = $qquser['gender'];
	        $data['qq_nickname'] = $qquser['nickname'];
	        $data['qq_img'] = $qquser['figureurl_qq_1'];
	        $data['createDate'] = date('Y-m-d H:i:s',time());
	        $rs = M('user_qq')->add($data);
	        if( !$rs ){
	            $this->error('登录失败，请重新登录',U('Login/index'));
	            exit;
	        }
	    }
	    
	    session('qq_openid',$user['openid']);//登录成功，保存其openid
	    session('qq_nickname',$qquser['nickname']);
	    session('qq_img',$qquser['figureurl_qq_1']);
	    
	    $res = M('user')->where($wh)->find();
	    if( !$res ){//没有绑定账号,创建一个（只是保存其qq_openid）
	        $add['qq_openid'] = $user['openid'];
	        $add['states'] = 1;
	        $add['login_way'] = 1; //qq登录
	        $add['regist_time'] = date('Y-m-d H:i:s',time());
	        $id = M('user')->add($add);
	    }else{
	        $id = $res['id'];
	    }
	    
	    //记录日志表
	    $add['uid'] = $id;
	    $add['user_time'] = date('Y-m-d H:i:s',time());
	    $add['user_ip'] = $_SERVER['REMOTE_ADDR'];
	    $add['login_type'] = 2;
	    M('user_log')->add($add);
	    
	    M('user')->where($w)->data('login_way=1')->save();//qq登录，改变login_way标志为1
	    
	    $this->redirect('/Home/User/userInfo');
    }
	
}