<?php
namespace Home\Controller;
use Think\Controller;

class WxmenuController extends Controller {
    
    public function __construct(){
        parent::__construct();
        
        include_once './Wx/thirdParty/parth4/weixin.php';
    }
    
    /**
     * 获取微信的access_token*/
    public function token(){
        $appid = C(WXAPPID);
        $appsecret = C(WXAPPKEY);
    
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $json = file_get_contents($url);
        $data = json_decode($json);
        //$json = A('UrlUtile')->getHttps($url);
        //$data = json_decode($json);
    
        $access_token = $data->access_token;
        return $access_token;
    }
    
    public function b(){
        $token = $this->token();
        var_dump($token);
    }
    
    /**
     * 定义自定义菜单*/
    public function index(){
        $token = $this->token();
        
        $weixin = new \Weixin($token, true);

        $appid = C(WXAPPID);
        $appsecret = C(WXAPPKEY);
        
    	$xjson = '{ 
    	 "button":[
    		  {
                   "type":"click",
				   "name":"来点我哟1333",
				   "key":"V1001_NBA"
    		   },
    		   {
    			   "name":"体育",
    			   "sub_button":[
    					{
    					   "type":"click",
    					   "name":"世界足球",
    					   "key":"V1001_ZUQIU"
    					},
    					{
    					   "type":"click",
    					   "name":"国际排球",
    					   "key":"V1001_PAIQIU"
    					},
    	                {
    					   "type":"view",
    					   "name":"web跳转",
    					   "url":"https://www.beliv.cn/wxindex.php/home/oauth/wxurl"
    					}
    				]
    		   },
    		   {
    			   "name":"新闻",
    			   "sub_button":[
    					{
    					   "type":"view",
    					   "name":"搜索",
    					   "url":"https://www.beliv.com"
    					},
    					{
    					   "type":"click",
    					   "name":"获取二维码",
    					   "key":"V1001_CODE"
    					}
    				]
    		   }
    	   ]
    	}';
    	
    	$jsonMenu = json_encode($xjson);
    	$get_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
    	$get_return = file_get_contents($get_url);
    	$get_return = (array)json_decode($get_return);
    	if( !isset($get_return['access_token']) ){
    	    exit( '获取access_token失败！' );
    	}
    	
    	$post_url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}";
    	$result = $this->https_request($post_url,$xjson);

    }
    
    function https_request($url,$data = null){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        $respose_data = curl_exec($curl);
        curl_close($curl);
        return $respose_data;
    }
    
    function a(){
        $token = $this->token();
        $weixin = new \Weixin($token, true);
        
        $weixin->getMsg();
        $type = $weixin->msgtype; //消息类型
        $username = $weixin->msg['FromUserName'];//哪个用户给你发的消息,这个$username是微信加密之后的，每个用户都是一一对应的
        if ($type === 'event') {//点击菜单事件
            $eventkey = $weixin->eventkey;//获取当前菜单key
            if($eventkey=='V1001_NBA') {
                $reply = '您点击的NBA菜单，哈哈';
            }
            if($eventkey=='V1001_CBA') {
                $reply = '您点击的CBA菜单，哈哈';
            }
            else{
                $reply = '欢迎关注bqq！';
            }
        }
        if ($type === 'text') {//文本输入
            $kwds=$weixin->msg['Content'];
             
            $reply = $weixin->makeText('抱歉，根据您输入的文本，暂时未找到相关匹配信息');
             
        }
        if ($type === 'voice') {//语音输入
            $kwds = substr($weixin->msg['Recognition'],0,-3);
             
            $reply = $weixin->makeText('抱歉，根据您输入的语音，暂时未找到相关匹配信息');
             
        }
        $weixin->reply($reply);
    }
}