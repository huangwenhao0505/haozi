<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 人员管理类*/
class UserController extends Controller {
    
    public function __construct(){
        parent::__construct();
        $this->A_login = A('Login');
        $this->A_login->isLogin();
    }
    
    public function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 用户列表*/
    public function userList(){
        $this->display('userList');
    }
    
    /**
     * ajax无刷新显示用户列表*/
    public function userListAjax(){
        if(IS_AJAX){
            //接收参数 
            $username = I('post.username');
            $nickname = I('post.nickname');
            $stateType= I('post.stateType');
            $qqType   = I('post.qqType');
            
            if($username != ''){
                $where['u.username'] = array('like','%'.$username.'%');
            }
            if($nickname != ''){
                $where['u.nickname'] = array('like','%'.$nickname.'%');
            }
            if($stateType != ''){
                $where['u.states'] = $stateType;
            }
            
            //总记录数  每页显示数  总页数
            $count = M('user u')->where($where)->count();
            $pageSize = 10;
            $totalPage = ceil($count/$pageSize);
            
            //当前页  起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            $startRow = $pageSize * ($currPage-1); 
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            //$sql = "select u.username,u.nickname,u.u_birthday,u.u_img,u.email,u.states,u.qq_openid,u.regist_time,q.qq_nickname,q.qq_img from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid";
            $list = M('user u')
            ->field('u.id,u.username,u.nickname,u.u_birthday,u.u_img,u.email,u.states,u.qq_openid,u.regist_time,u.is_black,q.qq_nickname,q.qq_img')
            ->join('hwh_user_qq q on q.qq_openid = u.qq_openid','left')
            ->where($where)
            ->limit($startRow.','.$pageSize)
            ->select();
            foreach($list as $k => $v){
                $list[$k]['states'] = $v['states'] == 1 ? '已激活' : '未激活';
            }

            $data['count'] = $count;
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }
    }
    
    /**
     * 把某个用户加入黑名单*/
    public function addBlackUser(){
        if(IS_AJAX){
            $id = I('get.id');
            $res = M('user')->where('id='.$id)->data('is_black=1')->save();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '加入黑名单失败！'));
            }
            $this->ajaxReturn($this->errmsg(10000, '加入黑名单成功！'));
        }
    }
    
    /**
     * 解除其黑名单限制*/
    public function removeBlackUser(){
        if(IS_AJAX){
            $id = I('get.id');
            $res = M('user')->where('id='.$id)->data('is_black=0')->save();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '解除黑名单限制失败！'));
            }
            $this->ajaxReturn($this->errmsg(10000, '解除黑名单限制成功！'));
        }
    }
}