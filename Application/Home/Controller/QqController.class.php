<?php
namespace Home\Controller;
use Think\Controller;

/**
 * qq登录 */
class QqController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->host = $_SERVER['HTTP_HOST'];
    }
    
    public function getBackurl() {
        return urlencode( "https://{$this->host}/index.php/Home/Login/qqLogin" );
    }
    
    public function getLoginurl() {
        $qq_state = md5(uniqid(rand(), TRUE));
        $_SESSION['qq_state'] = $qq_state;
        $url = $this->getBackurl();
        $qqurl = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=101374694&redirect_uri={$url}&scope=get_user_info&state={$qq_state}";
        return $qqurl;
    }
    
    /**
     * 网站头部公共部分返回$qqurl,跳转到QQ登录页面*/
    public function qqurl(){
        $qqurl = $this->getLoginurl();
        $this->assign('qqurl',$qqurl);
    }
    
}