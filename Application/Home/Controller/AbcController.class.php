<?php
namespace Home\Controller;
use Think\Controller;

class AbcController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }

    private function _msg($code,$msg,$result=null) {
        $ret['status'] = $code;
        $ret['msg'] = $msg;
        $ret['result'] = $result;
        echo json_encode($ret);
        exit;
    }
    
    private function checkLogin($token=FALSE){
        $token = $token==FALSE ? -1 : trim($_POST['token']);
    
        $w['token'] = $token;
        $find = M('user')->field('id')->where($w)->find();

        if( empty($find) ) {
            $ret['status'] = 20001;
            $ret['msg'] = '请先登录!';
            $ret['result'] = null;
            echo json_encode($ret);
            exit;
        }
        return $find;
    }
    
    /**
     * 用户第一次登录生成token值*/
    private function userToken($uid){
        $s = time();
        $str = md5( $uid . $s );
        return $str;
    }
    
    /**
     * 自动生成订单号
     * 格式:日期(20141012151220)+四位数字(0001)
     * 后四位数字,每天从0001开始增长
     */
    //201801310926420001
    public function get_order_sn(){
        $a = $arr[0]->url;
        var_dump($a);exit;
        $sql = "select order_sn from lzd_order order by id desc";
        //$rs = $this->db->query($sql)->row_array();
        $rs = array("order_sn"=>"201801310926420001");
        $strings = substr($rs['order_sn'], 0, 8);//20180131  截取前面8位
        if ($strings == date('Ymd', time())) {
            //是同一天的订单
            $num = substr($rs['order_sn'], -4, 4) + 10001;//截取后四位 + 10001
            var_dump(substr($rs['order_sn'], -4, 4));
            var_dump($num);exit;
            $strings = date('YmdHis', time()) . substr($num, -4, 4);//完整的订单号 201801311000230002
        } else {
            //不是同一天的订单，第一次生成的订单就是
            $strings = date('YmdHis', time()) . '0001';
        }
        echo $strings;
    }
    
    
    /**
     *  定义生成图片验证码*/
    public function Verify(){
        //实例化验证码对象
        $Verify = new \Think\Verify();
    
        //设置验证码相关信息
        $Verify->fontSize = 30;		//验证码大小
        $Verify->length   = 4;		//验证码长度
        $Verify->useNoise = false;	//是否添加杂点
    
        //调用方法生成验证码
        $Verify->entry();
    }

    /**
     * 用户登录
     * @param username string 用户名
     * @param password char 密码*/
    public function login(){
        //接收参数
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        //$username = 'dawenhao';
        //$password = '123456';

        if($username == ''){
            $this->_msg(20001,'用户名不能为空!',null);
        }

        if($password == ''){
            $this->_msg(20001,'密码不能为空!',null);
        }

        $password = md5($password);
        $where['username'] = $username;
        $where['password'] = $password;
        $res = M('user')->field('id,username,nickname,u_img,u_sign')->where($where)->find();

        if(!$res){
            $this->_msg(20001,'用户名和密码不匹配!',null);
        }else{
            //登录成功
            $id = session('id',$res['id']);
            $username = session('username',$res['username']);
            
            //每次登录生成新的token
            
            $userToken = $this->userToken($id); //生成token值
            
            $ds['token'] = $userToken;
            M('user')->where($where)->save($ds);
            
            $arr = array('token'=>$userToken);
            
            $r = array_merge($arr,$res);

            //存入用户登录记录到数据库
            $data['uid'] = $res['id'];
            $data['user_time'] = time();
            $data['user_ip'] = getenv('REMOTE_ADDR');   //登录IP
            $res = M('user_login')->data($data)->add();
             
            $this->_msg(10000, '登录成功!', $r);
             
        }
    }
    
    /**
     * 用户注册
     * @param username string 用户名
     * @param password  char 密码
     * @param password2 char 确认密码
     * @param code string 验证码 */
    public function userRegist(){
        //接收参数
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        //$password2= trim($_POST['password2']);
        $code = trim($_POST['code']);
        
        //合理性验证
		$where['username'] = $username;
		$info = M('user')->field('username')->where($where)->find();
		if($info){
			$this->_msg(10001, '用户名已经存在,请重新输入!',null);
		}
		
		if($username == ''){
			$this->_msg(10001, '用户名不能为空,请重新输入!',null);
		}
		
		if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$username)){
		    $this->_msg(10001, '用户名不能包含特殊字符,长度6-16字符之间!',null);
		}
		
		if(strlen($username) < 6 || strlen($username) > 16){
		    $this->_msg(10001, '用户名请设置在6-16个字符之间!',null);
		}
		
		if(strlen($password) < 6 || strlen($password) > 16){
		    $this->_msg(10001, '密码请设置在6-16位字符之间!',null);
		}
		
		/* if($password !== $password2){
		    $this->_msg(10001, '两次输入的密码不一致!');
		}
		
		if($code == ''){
		    $this->_msg(10001, '验证码不能为空!');
		}
		
		$verify = new \Think\Verify();
		
		if(!$verify->check($code)){
		    $this->_msg(10001, '验证码不正确,点击刷新验证码重试!');
		} */
        
        $add['username'] = $username;
        $add['password'] = md5($password);
        $add['regist_time'] = time();
        
        $res = M('user')->add($add);
        
        if($res){
            $this->_msg(10000, '注册成功!');
        }else{
            $this->_msg(10001, '注册失败!',null);
        }
    }

    /**
     * 获取用户信息*/
    public function userInfo(){
        
        $token = $_POST['token'];
        $find = $this->checkLogin($token);   //判断用户是否登录

        $id = $find['id'];  //获取用户ID
        
        $info = M('user')->field('id,username,nickname,u_img,u_sign')->where('id='.$id)->find();

        if(!$info){
            $this->_msg(10001, 'Fail',null);
        }else{
            $this->_msg(10000, 'Success',$info);
        }
    }

    /**
     * 上传图像
     * @param img string 上传图像*/
     public function uploadAvatar(){
        $token = $_POST['token'];
        $find = $this->checkLogin($token);   //判断用户是否登录
        
        $id = $find['id'];  //获取用户ID
        
        $file_name = base64_decode($_POST['img']);
        $upfile="Public/Uploads/user/".time().'.jpg';
        $file=$_SERVER['DOCUMENT_ROOT']."/Public/Uploads/user/".time().'.jpg';
        $m=fopen($file,"w");//当参数为"w"时是将内容覆盖写入文件，而当参数为"a"时是将内容追加写入。
        //$content=$result['keyword']."\t\t\n";
        fwrite($m,$file_name);
        //fclose($m);
        
        var_dump($m);exit;
        $data['img'] = $m;
        
        /* $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     '/Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'user/'; // 设置附件上传（子）目录
        
        // 上传文件
        $info   =   $upload->upload();
        if(IS_POST){
            if($info) {// 上传成功  获取原始图片信息
                $oriPath = $info['img']['savepath'].$info['img']['savename'];	//上传后原始图片的路径
                $data['img'] = $oriPath;	//插入到数据库
        
                $data['uid'] = $id;
                $data['create_date'] = time();
        
                $res = M('user_photo')->data($data)->add();
        
                if(!$res){
                    $this->_msg(10001, '上传失败!',null);
                }
        
                $a['id'] = $id;
                $a['img_url']= $oriPath;
                $this->_msg(10000, '上传成功!',$a);
                 
            } else {   // 上传错误提示错误信息
                $this->error = $upload->getError();	//将上传的错误信息赋值给error属性
                //$this->_msg($this->error);
                $this->_msg(10001, $this->error,null);
            }
        } */
    }  
    
    /**
     * @param 上传图像base64格式*/
    /* public function uploadAvatar(){
        
        $token = $_POST['token'];
        $find = $this->checkLogin($token);   //判断用户是否登录
        
        $id = $find['id'];  //获取用户ID
        
        //图片url
        $image_url = $_POST['image_url'];
        if($image_url){
            $add['uid'] = $id;
            $add['img'] = $image_url[0]['url'];
            $add['create_date'] = time();
            
            $res = M('user_photo')->add($add);
            
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '上传成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '上传失败!'));
            }
            
        }else{
            $this->ajaxReturn($this->errmsg(10001, '上传失败!'));
        }
    } */

    /**
     * 修改信息  头像，昵称，个性签名
     * @param nickname string 昵称
     * @param u_sign string 个性签名
     * @param img string 上传图像*/
    public function changeInfo(){
        
        $token = $_POST['token'];
        $find = $this->checkLogin($token);   //判断用户是否登录
        
        $id = $find['id'];  //获取用户ID
        
        if(IS_POST){
            $nickname = trim($_POST['nickname']);
            $u_sign = trim($_POST['u_sign']);

            if($nickname == ''){
                $this->_msg(10001, '昵称不能为空!',null);
            }

            $d['nickname'] = $nickname;
            $res = M('user')->where($d)->select();
            if($res){
                $this->_msg(10001, '该昵称已存在,请重新输入!',null);
            }

            if($u_sign == ''){
                $this->_msg(10001, '个性签名不能为空!',null);
            }
            
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     '/Public/Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     'user/'; // 设置附件上传（子）目录

            // 上传文件
            $info   =   $upload->upload();
            if(!$info){
                $this->error = $upload->getError();	//将上传的错误信息赋值给error属性
                //$this->_msg($this->error);
                $this->_msg(10001, $this->error,null);
            }

            // 上传成功  获取原始图片信息
            $oriPath = $info['img']['savepath'].$info['img']['savename'];	//上传后原始图片的路径
            $data['u_img'] = $oriPath;	//插入到数据库 

            $data['nickname'] = $nickname;
            $data['u_sign'] = $u_sign;

            $row = M('user')->where('id = '.$id)->data($data)->save();
            if(!$row){
                $this->_msg(10001, '修改失败!',null);
            }else{
                
                $a['id'] = $id;
                $a['nickname'] = $nickname;
                $a['u_sign'] = $u_sign;
                $a['img_url']= $oriPath;
                
                $this->_msg(10000, '修改成功!',$a);
            }

        }
    }
    
    /**
     * 修改信息  头像，昵称，个性签名
     * @param nickname string 昵称
     * @param u_sign string 个性签名
     * @param img string 上传图像*/
    /* public function changeInfo(){
    
        $token = $_POST['token'];
        $find = $this->checkLogin($token);   //判断用户是否登录
    
        $id = $find['id'];  //获取用户ID
    
        if(IS_POST){
            $nickname = trim($_POST['nickname']);
            $u_sign = trim($_POST['u_sign']);
    
            if($nickname == ''){
                $this->_msg(10001, '昵称不能为空!',null);
            }
    
            $d['nickname'] = $nickname;
            $res = M('user')->where($d)->select();
            if($res){
                $this->_msg(10001, '该昵称已存在,请重新输入!',null);
            }
    
            if($u_sign == ''){
                $this->_msg(10001, '个性签名不能为空!',null);
            }
            
            //图片url
            $image_url = $_POST['image_url'];
            if($image_url){

                $data['u_img'] = $image_url[0]['url'];
            
            }else{
                $this->ajaxReturn($this->errmsg(10001, '修改失败!'));
            }
    
            $data['nickname'] = $nickname;
            $data['u_sign'] = $u_sign;
    
            $row = M('user')->where('id = '.$id)->data($data)->save();
            if(!$row){
                $this->_msg(10001, '修改失败!',null);
            }else{
    
                $a['id'] = $id;
                $a['nickname'] = $nickname;
                $a['u_sign'] = $u_sign;
                $a['img_url']= $image_url[0]['url'];
    
                $this->_msg(10000, '修改成功!',$a);
            }
    
        }
    
    } */
}