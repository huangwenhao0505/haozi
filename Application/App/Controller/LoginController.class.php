<?php
namespace App\Controller;
use App\Controller\AppController;

class LoginController extends AppController {
    
    /**
     * 用户登录
     * @param username string 用户名
     * @param password string 密码*/
    public function login()
    {
        $username = I('post.username');
        $password = I('post.password');
        
        if($username == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
        }
        
        if($password == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '请输入密码'));
        }
        
        $where['username'] = $username;
        $where['password'] = md5($password);
        $info = M('user')->where($where)->find();
        if(!$info)
        {
            $this->ajaxReturn($this->errmsg(10001, '用户名和密码不匹配'));
        }
        
        //获取用户id
        $uid = $info['id'];
        
        //生成随机的token
        $token = $this->token($uid);
        
        $d['token'] = $token;
        M('user')->where('id='.$uid)->save($d);
        
        //返回用户的信息
        $res = M('user')->where('id='.$uid)->find();
        $this->ajaxReturn($this->errmsg(10000, '登录成功',$res));
    }
    
    /**
     * 退出登录
     * @param token string 用户登录的token*/
    public function outLogin()
    {
        $token = I('post.token');
        $uid = $this->userinfo($token);
        
        //清除用户的token
        $d['token'] = '';
        $res = M('user')->where('id='.$uid)->save($d);
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, '退出失败'));
        }
        
        $this->ajaxReturn($this->errmsg(10000, '退出成功'));
    }
    
    /**
     * 注册账号
     * @param username string 用户名
     * @param password string 密码
     * @param email string 邮箱*/
    public function regist(){
        $username = I('post.username');
        $password = I('post.password');
        $email = I('post.email');
        
        //合理性验证
		$where['username'] = $username;
		$info = M('user')->field('username')->where($where)->find();
		if($info)
		{
			$this->ajaxReturn($this->errmsg(10001, '用户名已存在'));
		}
		
		if($username == '')
		{
			$this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
		}
		
		if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$username))
		{
			$this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度6-16字符之间'));
		}
		
		if(strlen($username) < 6 || strlen($username) > 16)
		{
			$this->ajaxReturn($this->errmsg(10001, '用户名请设置在6-16个字符之间'));
		}
		
		if(strlen($password) < 6 || strlen($password) > 16)
		{
			$this->ajaxReturn($this->errmsg(10001, '密码请设置在6-16位字符之间'));
		}
		
		if($email == '')
		{
		    $this->ajaxReturn($this->errmsg(10001, '请输入邮箱'));
		}
			
		if(!preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",$email))
		{
		    $this->ajaxReturn($this->errmsg(10001, '邮箱格式错误'));
		}
		
		//判断邮箱是否被注册
		$wh['email'] = $email;
		$wh['states'] = 1;
		$row = M('user')->where($wh)->find();
		if($row)
		{
		    $this->ajaxReturn($this->errmsg(10001, '该邮箱已被注册'));
		}
		
		$a = md5('haozi'.$password);
		$b = $email;
		$c = time();
		$activate_code = md5($a.$b.$c);//创建用于激活识别码
		$activate_code_time = time()+60*60*24;//过期时间为24小时后
			
		//验证成功，写入数据库
		//密码强弱
		if(strlen($password) >= 6 && strlen($password) <= 8){
		    $data['password_leven'] = 1;
		}else if(strlen($password) > 8 && strlen($password) <= 12){
		    $data['password_leven'] = 2;
		}else if(strlen($password) > 12 && strlen($password) <= 16){
		    $data['password_leven'] = 3;
		}
		
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['regist_time'] = date('Y-m-d H:i:s',time());
		$data['email'] = $email;
		$data['activate_code'] = $activate_code;
		$data['activate_code_times'] = $activate_code_time;
			
		$res = M('user')->add($data);
		
		if(!$res)
		{
		    $this->ajaxReturn($this->errmsg(10001, '注册失败'));
		}
		
	    //注册成功，发送邮件
	    //sendMail(用户邮箱, 主题, 内容);
	    $w['username'] = $username;
	    $info = M('user')->field("id")->where($w)->find();
	    $id = $info['id'];   //获取当注册的用户id
	     
	    $title = "欢迎您注册本网站会员";
	    $content = "请点击此链接完成激活，此链接24小时以内有效http://".$_SERVER['HTTP_HOST']."/App/Login/userActivate?id={$id}&verify=".$activate_code."&time={$activate_code_time}<br/><h3>如果此链接不能点击，请复制此链接到浏览器里访问！</h3><h3>注意：如不是本人操作，请忽略此条信息，勿点击！</h3>";
	    sendMail($email, $title, $content);
	     
	    $this->ajaxReturn($this->errmsg(10000, "注册成功！请登录到您的邮箱及时激活您的帐号！"));
    }
    
    /**
     * 完成邮箱激活功能
     * 激活账号 */
    public function userActivate(){
        //接收参数
        $id = trim($_GET['id']);
        $verify = trim($_GET['verify']);
        $time = trim($_GET['time']);
        
        //判断是否已过有效期
        if($time < time())
        {
            $this->ajaxReturn($this->errmsg(10001, '已过有效期时间'));
        }
        
        $where['id'] = $id;
        $where['activate_code'] = $verify;
        $data['states'] = 1;
        $res = M('user')->where($where)->save($data);
        
        if(!$res)
        {
            //$this->redirect("Login/regist","",3,"激活失败！");
            $this->ajaxReturn($this->errmsg(10001, '激活失败'));
        }
        
        //激活成功，清空activate_code
        $w['states'] = 1;
        $w['id'] = $id;
        $d['activate_code'] = "";
        $d['activate_code_times'] = "";
        M('user')->where($w)->save($d);
         
        //$this->redirect("Login/ajaxLogin","",2,"激活成功，正在跳转到登录页面。。。");
        $this->ajaxReturn($this->errmsg(10000, '激活成功'));
    }
}