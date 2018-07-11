<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 相册类（多图片上传）
 * @author Administrator
 *  */
class PhotoController extends Controller {
    
    public function __construct(){
        parent::__construct();
        //A('IsMobile')->getIsMobile();//判断是否是手机端浏览
        $this->A_img = A('Img');
        $this->A_photo = A('ImgMuch');
    }
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 所有相册列表  */
    public function index(){
        $where['hwh_user_photo.is_ok'] = 1;
        $where['hwh_user_photo.is_photo_show'] = 1;
        $join = "LEFT JOIN hwh_user ON hwh_user.id = hwh_user_photo.uid LEFT JOIN hwh_user_qq ON hwh_user.qq_openid = hwh_user_qq.qq_openid";
        $field = "hwh_user_photo.uid,hwh_user_photo.img,hwh_user.username,hwh_user.nickname,hwh_user.login_way,hwh_user_qq.qq_nickname";
        $list = M('user_photo')->field($field)->join($join)->where($where)->order('hwh_user_photo.create_date desc')->select();
        foreach($list as $k => $v){
            $list[$k]['nickname'] = $v['login_way'] == 1 ? $v['qq_nickname'] : (empty($v['nickname']) ? $v['username'] : $v['nickname']);
        }
        $this->assign('photoList',$list);
        
        A('Qq')->qqurl();//QQ登录入口
        
        $isMobile = A('IsMobile')->isMobile();
        if($isMobile){
            //手机端浏览
            $this->display('indexSj2');
        }else{
            $this->display('index2');
        }
        
        
    }
    
    /**
     * 个人相册列表  */
    public function userPhoto(){
        //接收参数
        $uid = $_GET['id'];
        
        $where['uid'] = $uid;
        $where['is_ok'] = 1;
        
        //个人相册列表显示
        $list = M('user_photo')->where($where)->order('is_photo_show desc,create_date desc')->select();
        
        //个人年月日
        $sql = "select u.username,u.nickname,u.u_sign,u.u_birthday,u.login_way,q.qq_nickname from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = $uid";
        $info = M()->query($sql);
        $info[0]['nickname'] = $info[0]['login_way'] == 1 ? $info[0]['qq_nickname'] : ($info[0]['nickname'] != "" ? $info[0]['nickname'] : $info[0]['username']);

        if($info[0]['u_birthday'] != ""){
            $birthday = explode(',', $info[0]['u_birthday']);
            $month = $birthday[0];
            $days = $birthday[1];
        }else{
            $month = 0;
            $days = 0;
        }
        
        $info[0]['month'] = $month;
        $info[0]['days'] = $days;
        $info = $info[0];
        
        $this->assign('list',$list);
        $this->assign('info',$info);
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('photo_list');
    }
    
    /**
     * 上传个人相册的封面图像  */
    public function uploadUserPhotoIndex(){
        $img = $this->A_img->uploadImg('Public/Uploads/user/photo/cover/');
        echo $img;
    }
    
    /**
     * 添加个人相册封面图像到数据库  */
    public function addUserPhotoIndex(){
        if(IS_AJAX){
            $uid = session('id');
            if(!$uid){
                $this->ajaxReturn($this->errmsg(20001, '请先登录后再来上传哟!'));
            }
            
            $img = trim($_POST['img']);
            if($img == '' || $img == null){
                $this->ajaxReturn($this->errmsg(10001, '请按正确格式上传图片!'));
            }
            
            //查找该用户是否已存在封面图像 
            $where['uid'] = $uid;
            $where['is_ok'] = 1;
            $where['is_photo_show'] = 1;
            $info = M('user_photo')->where($where)->find();
            if($info){  //存在则更新
                $d['img'] = $img;
                $res = M('user_photo')->where($where)->save($d);
                
                if(!$res){
                   $this->ajaxReturn($this->errmsg(10002, '未知原因,上传失败!')); 
                }else{
                    $this->ajaxReturn($this->errmsg(10000, '上传成功!'));
                }
                
            }else{  //不存在则写入
                $add['uid'] = $uid;
                $add['img'] = $img;
                $add['create_date'] = date('Y-m-d H:i:s',time());
                $add['is_photo_show'] = 1;
                $res = M('user_photo')->add($add);
                
                if(!$res){
                   $this->ajaxReturn($this->errmsg(10002, '未知原因,上传失败!')); 
                }else{
                    $this->ajaxReturn($this->errmsg(10000, '上传成功!'));
                }
            }
 
        }
    }
    
    /**
     * 多图片上传  */
    public function uploadUserMuchPhoto(){
        $photo = $this->A_photo->muchPhotoUpload('Public/Uploads/user/photo/');
        echo $photo;
    }
    
    /**
     * 添加个人相册到数据库  */
    public function addUserPhoto(){
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
            
            $where['uid'] = $uid;
            $where['is_ok'] = 1;
            $where['is_photo_show'] = 1;
            
            //判断是否存在个人相册封面图像
            //$info = M('user_photo')->where($where)->find();
            //if(!$info){
                //$this->ajaxReturn($this->errmsg(10001, '请先上传个人相册的封面图像哟!'));
            //}
            
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
        
        //显示相册列表封面图像（用户）
        if($uid != '' || $uid != null){
            $where['uid'] = $uid;
            $where['is_ok'] = 1;
            $where['is_photo_show'] = 1;
            $info = M('user_photo')->where($where)->find();
            $this->assign('info',$info);
        }
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('addUserPhoto');
    }
    
    
    
}