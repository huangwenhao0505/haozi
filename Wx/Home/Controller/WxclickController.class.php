<?php
namespace Home\Controller;
use Think\Controller;

class WxclickController extends Controller {
    private $token;
    
    public function __construct(){
        $this->token = 'haozi';
        
        include_once './Wx/thirdParty/click.php';
    }
    
    public function index(){
        $wechatObj = new \wechatCallbackapiTest();
        if (!isset($_GET['echostr'])) {
            $wechatObj->responseMsg();
        }else{
            $wechatObj->valid();
        }
    }
}





