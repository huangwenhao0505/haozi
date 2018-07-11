<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class UserController extends Controller {
    
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
     * 用户注册  */
    public function ajaxRegist(){
        
        if(IS_AJAX){
            $username = trim($_POST['username']);
            $pwd = trim($_POST['password']);
            $pwd2 = trim($_POST['password2']);
            
            //合理性验证
            $where['username'] = array('eq',$username);
            $info = M('user')->field('username')->where($where)->find();
            if($username == $info['username']){
                $this->ajaxReturn($this->errmsg(10001, '该账号已被注册'));
            }
            
            //合法性验证
            if($username == '' || $pwd == ''){
                $this->ajaxReturn($this->errmsg(10001, '用户名和密码都不能为空'));
            }
            
            if(strlen($pwd) < 6 || strlen($pwd) > 16){
                $this->ajaxReturn($this->errmsg(10001,'密码请设置在6-16位之间'));
            }
            
            if($pwd !== $pwd2){
                $this->ajaxReturn($this->errmsg(10001,'两次输入的密码不一致'));
            }
            
            $password = md5($pwd);
            
            $add['username'] = $username;
            $add['password'] = $password;
            //随机为用户选择默认的头像
            $res = M('user')->add($add);
            if(!$res){
                $this->ajaxReturn($this->errmsg(20001,'注册失败！'));
            }else{
                $this->ajaxReturn($this->errmsg(20000,'注册成功！'));
            }
        }

        $this->display('regist');
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
            }
            
            //登录成功，保存session
            session('id',$info['id']);
            session('username',$info['username']);
            $id = session('id');
            //是否选择了记住密码
            if($_POST['remember_me'] == 1){
                setcookie('id',$id,time()+3600*24*7);
                setcookie('username',$username,time()+3600*24*7);  //保存7天
                setcookie('password',$password,time()+3600*24*7);
                M('user')->where('username='.session('username'))->data('remember_me=1')->save();
            }

            $this->ajaxReturn($this->errmsg(20000, '登录成功'));
        }
        
        $this->display('login');
    }
    
    /**  
     * 退出登录   */
    public function ajaxOut(){
        
        if(IS_AJAX){
            $id = session('id');
            $username = session('username');           
            session(null);  //清空用户session
            $this->ajaxReturn($this->errmsg(20001, '退出成功'));          
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
     * 个人中心  */
    public function userCenter(){
        $this->display();
    }
    
    /**
     * 个人基本信息 */
    public function userInfo(){
        $id = session('id');
        
        if(IS_AJAX){
            $nickname = trim($_POST['nickname']);
            $u_sign = trim($_POST['u_sign']);
            $address= trim($_POST['address']);
            
            //进行相应验证，现在略
            
            $data['nickname'] = $nickname;
            $data['u_sign'] = $u_sign;
            $data['address'] = $address;
            $res = M('user')->where('id='.$id)->save($data);
            
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '修改失败'));
            }else{
                $this->ajaxReturn($this->errmsg(10000, '修改成功'));
            }
        }
        
        $info = M('user')->field(true)->where('id='.$id)->find();
        $this->assign('info',$info);
        
        $this->display();
    }
    
   /**
    * 用户详情  */
    public function userList(){
        $id = session('id');
        $where['id'] = $id;
        $info = M('user')->where($where)->find();
        $this->assign('info',$info);
        $this->display();
    } 
    
    public function userPhoto(){
        
        if(IS_POST){
            $uid = session('id');
            
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
    
}