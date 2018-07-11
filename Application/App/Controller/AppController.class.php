<?php
namespace App\Controller;
use Think\Controller;

class AppController extends Controller {
    
    /**
     * @param errno 状态码
     * @param errmsg 提示语
     * @param result 返回结果集*/
    public function errmsg($errno, $errmsg, $result=null)
    {
        $arr = array(
            'errno' => $errno,
            'errmsg'=> $errmsg,
            'result'=> $result
        );
        
        return $arr;
        exit;
    }
    
    /**
     * 判断是否已登录
     * @param token string 登录的token*/
    protected function checkLogin($token)
    {
        $token = $token==FALSE ? -1 : trim($_POST['token']);

        $where['token'] = $token;
        $user = M('user')->field('id')->where($where)->find();
        if(empty($user))
        {
            $this->ajaxReturn($this->errmsg(20001, '请先登录'));
        }
        else 
        {
            return $user['id'];//返回用户id
        }
    }
    
    /**
     * 用户登录生成随机token
     * @param uid int 用户id*/
    protected function token($uid)
    {
        $s = time();
        $token = md5($uid.$s);
        return $token;
    }
    
    /**
     * 根据token获取用户id*/
    protected function userinfo($token)
    {
        $where['token'] = $token;
        $info = M('user')->field('id')->where($where)->find();
        if(!$info)
        {
            $this->ajaxReturn($this->errmsg(10001, '无效的token'));
        }
        
        return $info['id'];
    }
}