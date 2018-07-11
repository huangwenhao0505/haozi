<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    
    Public function __construct(){
        parent::__construct();
        //$this->isLogin();
    }
    
    public function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 验证登陆信息  */
    public function isLogin(){
        $id = session('a_id');
        $username = session('a_username');
        
        if(empty($id) || empty($username)){
            $this->redirect('Admin/Login/login');
        }
        
        return $id;
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
     * 管理员登录  */
    public function ajaxlogin(){
         if(IS_AJAX){
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $code     = trim($_POST['code']);
            
            //验证
            if($username == ''){
                $this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
            }
            
            if($password == ''){
                $this->ajaxReturn($this->errmsg(10001, '密码不能为空'));
            }
            
            if($code == ''){
                $this->ajaxReturn($this->errmsg(10001, '验证码不能为空'));
            }
            
            $Verify = new \Think\Verify();
            if(!$Verify->check($code)){
                $this->ajaxReturn($this->errmsg(10001, '验证码不正确'));
            }
            
            $where['username'] = $username;
            $where['password'] = md5($password);
            $info = M('admin')->where($where)->find();
            
            if(!$info){
                $this->ajaxReturn($this->errmsg(10001, '用户名和密码不匹配'));
            }
            
            //登录成功，保存session
            session('a_id',$info['id']);
            session('a_username',$info['username']);
            
            //记录日志表
            $add['admin_id'] = session('a_id');
            $add['login_ip'] = $_SERVER['REMOTE_ADDR'];
            $add['login_time'] = date('Y:m:d H:i:s',time());
            M('admin_log')->add($add);
            
            $this->ajaxReturn($this->errmsg(20000, '登录成功'));
        } 
        $this->display('login');
    }
    
    /**
     * 退出登录
     */
    public function logout(){
        if(IS_AJAX){
            $id = session('a_id');
			session(null);  //清空用户session

            if($id == null){
				$this->ajaxReturn($this->errmsg(20003, '退出成功'));
			}else{
				$this->ajaxReturn($this->errmsg(20001, '退出失败'));
			}
        }
    }
    
    /**
     *上传图像
     *第三方插件ajaxFileUpload
     */
    public function uploadImg(){
    
        if(isset($_FILES)&&(!empty($_FILES))){
            foreach($_FILES as $el){//获取文件，这里默认都是每次都单文件上传
                $file=$el;
            }
            if(is_uploaded_file($file["tmp_name"])){//确认是POST方式上传的文件
                $cache_path="Public/Uploads/admin/";//暂存文件的目录
                $fname=$file["name"];//获取文件名
                $ftype=$file["type"];//获取文件类型
                $ftmp_name=$file["tmp_name"];//获取临时文件路径
                $fsize=$file["size"];//获取文件大小
                $ferror=$file["error"];//获取文件错误代号
    
                //判断文件大小是否符合规则
                if(!$this->check_size($fsize)){
                    echo json_encode(array("error"=>"102"));//102错误码代表文件过大
                    exit;
                }
    
                $suffix=strtolower(stristr($fname, "."));//获取文件后缀名(包含了点号),并后缀名小写化
                //判断文件类型是否为图片
                if(!$this->is_img($suffix)){
                    //如果不是图片类型，直接返回error为101，代表文件类型错误
                    echo json_encode(array("error"=>"101"));
                    exit;
                }
    
                $uniqStr=uniqid(strtotime("now")."_".mt_rand(100000,999999)."_");//创建随机ID
                $fname_new = $cache_path.$uniqStr.$suffix;//利用当前时间戳构造新的文件名称
                move_uploaded_file($ftmp_name, $fname_new);//将临时文件区的文件移动到暂存区中
                $fname_new=stristr($fname_new,"/");
                $fname_new = "http://".$_SERVER['HTTP_HOST'].'/Public'.$fname_new;
                 
                echo json_encode(array("path"=>$fname_new));//返回文件路径给看、客户端
            }else{
                echo json_encode(array("error"=>"400"));//400错误码代表文件非法上传(不是httppost提交)
            }
    
        }else{
            echo json_encode(array("error"=>"404"));//404错误码代表文件为空
        }
    }
    
    /**
     *判断文件后缀是否是图片
     *@param string $suffix :带点的后缀名(如.jpg)
     *@return bool 如果是图片后缀名返回true,否则返回false
     */
    private function is_img($suffix){
        $suffix_arr=array('.jpg','.png','.gif','.jpeg','.bmp');
        return in_array(strtolower($suffix), $suffix_arr);
    }
    
    /**
     *判断文件大小是否非法
     *@param int $size :单位为byte的整数，文件大小
     *@return bool 如果文件大小小于或等于规定的最大值返回true,否则返回false
     */
    private function check_size($size){
        $postMaxSize=intval(ini_get("post_max_size"));//post文件最大值
        $uploadMaxFilesize = intval(ini_get("upload_max_filesize"));//upload上传文件最大值
        $max=min($postMaxSize,$uploadMaxFilesize) *1024*1024;//将MB转换为byte单位数据
        if(intval($size)<=$max){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 用于修改头像昵称等  
     * @param nickname 昵称
     * @param img 头像
     */
    Public function changeAdmin(){
        $uid = $this->isLogin();
        
        $info = M('admin')->where('id='.$uid)->find();  //获取个人信息

        if(IS_AJAX){
            $nickname = trim($_POST['nickname']);
            $img = trim($_POST['img']); //上传头像
            
            //验证
            //if(!preg_match("/^([\u4E00-\u9FA5]|\w){6,16}$/",$nickname)){    //包括中文
                //$this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度6-16字符之间'));
            //}
            
            if($info['img'] == ''){ //当没有头像时，第一次更改必须上传头像，只有第一次必须
                if($img == ''){
                    $this->ajaxReturn($this->errmsg(10002, '请按正确的格式上传头像!'));
                }
            }
            
            $data['nickname'] = $nickname;
            if($img == ''){ //为空时则为原来的头像
                $data['img'] = $info['img'];
            }else{  //不为空时则是现在上传的头像
                $data['img'] = $img;
            }
            
            $res = M('admin')->where('id='.$uid)->save($data);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '修改失败'));
            }else{
                //该管理员发表的相关内容作者都相应改变
                $where['uid'] = $uid;
                $where['uid_type'] = 1;
                $d['author'] = $nickname;
                M('yulu')->where($where)->save($d);
                M('joke')->where($where)->save($d);
                M('article')->where($where)->save($d);
                
                $this->ajaxReturn($this->errmsg(10000, '修改成功'));
            }
        }
        
        $this->assign('info',$info);
        $this->display('adminInfo');
    }
    
    /**
	 * 个人资料页面的一个小模块div
	 * 用户修改之后无刷新显示最新内容*/
    public function adminInfoSon(){
        $id = $this->isLogin();
        if(IS_AJAX){
            $info = M('admin')->where('id='.$id)->find();
            $list = empty($info) ? false : $info;
            echo json_encode($list);
        }
    }
    
    /**
     * 修改密码
     * @param password 原密码
     * @param newpwd   新密码
     * @param newpwd2  确认新密码
     */
    public function changePass(){
        $id = $this->isLogin();
        $info = M('admin')->where('id='.$id)->find();
        if(IS_AJAX){
            $password = trim($_POST['password']);//原密码
            $newpwd   = trim($_POST['newpwd']); //新密码
            $newpwd2  = trim($_POST['newpwd2']);//确认新密码
            
            $where['username'] = $info['username'];
            $where['password'] = md5($password);
            $res = M('admin')->where($where)->find();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '原密码不正确'));
            }
            
            if(strlen($newpwd)<6 || strlen($newpwd)>16){
                $this->ajaxReturn($this->errmsg(10002, '密码请设置在6-16字符之间'));
            }
            
            if($newpwd != $newpwd2){
                $this->ajaxReturn($this->errmsg(10003, '新密码和确认新密码不一致'));
            }
            
            //验证成功
            $d['password'] = md5($newpwd);
            $flag = M('admin')->where('id='.$id)->save($d);

            if(!$flag){
                $this->ajaxReturn($this->errmsg(10004, '未知原因,修改失败'));
            }else{
                //记录日志表
                $add['admin_id'] = session('a_id');
                $add['login_ip'] = $_SERVER['REMOTE_ADDR'];
                $add['login_time'] = date('Y:m:d H:i:s',time());
                $add['type'] = 2;
                M('admin_log')->add($add);
                
                $this->ajaxReturn($this->errmsg(10000, '修改成功'));
            }
        }
        
        $this->display('changePass');
    }
    
    /**
     * 修改密码成功后退出登录*/
    public function logOutPass(){
        //请空session
        session(null);
        sleep(2);  //停留2秒执行下面代码
        $this->display('login');
    }
    
}