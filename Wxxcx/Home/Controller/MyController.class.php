<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 自定义基础类*/
class MyController extends Controller
{
    /**
     * @param errno int 状态码
     * @param errmsg string 状态说明
     * @param result 返回值*/
    public function errmsg($errno,$errmsg,$result='')
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
     * 判断是否已授权登录
     * @param openid string 用户openid*/
    public function checkLogin($openid)
    {
        /*if($openid == '')
        {
            $this->ajaxReturn($this->errmsg(20001, '请先授权登录哟'));
        }*/
        $w['openid'] = $openid;
        $res = M('user_xcx')->where($w)->find();//用户没有授权也会存入用户的openid到数据库，但是获取不到用户的信息
        
        $where['userxcxId'] = $res['id'];
        $row = M('user_xcx_userinfo')->where($where)->find();
        if(!$row){
            $this->ajaxReturn($this->errmsg(20001, '请先授权登录哟'));
        }
    }
    
    /**
     * 根据用户openid得出用户userid
     * @param openid string 用户openid*/
    public function getXcxUserId($openid)
    {
        $w['openid'] = $openid;
        $info = M('user_xcx')->where($w)->find();
        $userid = $info['id'];
        return $userid;
    }
    
    /**
     * 根据用户openid得出用户信息
     * @param openid string 用户openid*/
     public function getXcxUserInfo($openid)
     {
         $userid = $this->getXcxUserId($openid);
         $info = M('user_xcx_userinfo')->where('userxcxId='.$userid)->find();
         return $info;
     }
}