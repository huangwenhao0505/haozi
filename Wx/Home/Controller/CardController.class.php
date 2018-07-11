<?php
namespace Home\Controller;
use Think\Controller;

class CardController extends Controller {
    
    private $access_token;
    
    public function __construct(){
        parent::__construct();
        
        $this->access_token = A('Index')->token();

    }
    
    /**
     * 上传卡券logo*/
    public function cardLogo(){
        
        $token = $this->access_token;
        
        $logo = "/Public/tuling.png";
        $data = array("buffer" => "@".$logo);
        
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=$token";

        $result = A('WechatCallbackapiTest')->httpsSend($url,$data);
        
        $jsoninfo = json_decode($result, true);
        
        return $jsoninfo;
    }
    
    /**
     * 创建卡券*/
    public function createCard(){
        $token = $this->access_token;
        
        $data = "";
    }
}