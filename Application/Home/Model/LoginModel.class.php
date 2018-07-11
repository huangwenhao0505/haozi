<?php
/**
 * 登录授权辅助model
 */
namespace Home\Model;
use Think\Model;

class LoginModel extends Model {
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 检查用户是否登录
     * 如果没有登录则直接返回结果并退出
     * 如果登录成功则返回当前登录的店员信息
     */
    public function checkLogin($token=FALSE){
        $token = $token==false ? -1 : trim($_POST['token']);
        
        $w['token'] = $token;
        $find = M('user')->field('id')->where($w)->find();
        echo M()->getLastSql();exit;
        if( empty($find) ) {
            $ret['status'] = 20001;
            $ret['msg'] = '请先登录!';
            $ret['result'] = '';
            echo json_encode($ret);
            exit;
        }
        return $find;
    }
}