<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 微信网页用户授权*/
class OauthController extends Controller {
    
    private $appId;
    private $appSecret;
    
    
    public function __construct(){
        parent::__construct();
        $this->appId = C('WXAPPID');
        $this->appSecret = C('WXAPPKEY');
        
        $this->host = $_SERVER['HTTP_HOST'];
    }
    
    /**
     * 授权后重定向的回调链接地址*/
    public function getBackurl() {
        return urlencode( "https://{$this->host}/wxindex.php/Home/index/goodsList" );
    }
    
    /**
     * 调用用户授权页面*/
    public function getOauthurl(){

        $url = $this->getBackurl();
        $wxurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appId}&redirect_uri={$url}&response_type=code&scope=snsapi_userinfo&state=2018#wechat_redirect";
        //return $wxurl;

        //header('location:'.$wxurl);
        //echo $wxurl;
        header("Location:$wxurl");
    }
    
    public function wxurl(){
        $url = $this->getBackurl();
        $wxurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appId}&redirect_uri={$url}&response_type=code&scope=snsapi_userinfo&state=2018#wechat_redirect";
        return $wxurl;
    }
    

}