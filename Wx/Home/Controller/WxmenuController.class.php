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
        //"url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx40f988df4cff4211&redirect_uri=https%3A%2F%2Fwww.beliv.cn%2Fwxindex.php%2FHome%2Findex%2FgoodsList&response_type=code&scope=snsapi_userinfo&state=2017&uin=MjkyMzM5ODMxMw%3D%3D&key=aff23a6180f965ab061d38d29a4d3dae9ca655edd22201cfe08fa14541e382dec682485781779b9705b35a7942887a52&pass_ticket=0uG83UVmCYdHPSZVVvLXga6tWgaXEmpTf9um0z5fQvDa7Qaj4d3ojw3JOg36gmkQ31NQn2+Gtj2f7L+gYQyrGg=="
        
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
    	                   "url":"https://www.beliv.cn/wxindex.php/home/Oauth/getOauthurl"
                        }
    				]
    		   },
    		   {
    			   "name":"新闻",
    			   "sub_button":[
    					{
    					   "type":"view",
    					   "name":"搜索",
    					   "url":"https://www.beliv.cn"
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
    	
    	$xjson = '{
    	 "button":[
    	       {
    			   "name":"点击事件",
    			   "sub_button":[
    					{
    					   "type":"click",
    					   "name":"图文",
    					   "key":"LZD_TUWEN"
    					},
    					{
    					   "type":"click",
    					   "name":"获取二维码",
    					   "key":"LZD_MA"
    					},
    	                {
                            "type":"view",
    	                    "name":"跳转测试",
    	                    "url":"http://119.29.182.238/wx/oauth/getOauthurl?activityId=2"
                        },
    	                {
                            "type":"click",
    	                    "name":"活动测试",
    	                    "key":"LZD_HUODONG"
                        }
    				]
    		   },
    		  {
                   "type":"view",
				   "name":"下载APP",
				   "url":"http://android.myapp.com/myapp/detail.htm?apkName=com.gotsun.longzhidui&ADTAG=mobile"
    		   },
    		   {
    			   "name":"龙之队",
    			   "sub_button":[
    					{
    					   "type":"view",
    					   "name":"龙之队官网",
    					   "url":"http://417386.m.weimob.net/Weisite/Home?pid=417386&bid=806047&wechatid=fromUsername&_tt=2&channel=menu%5E%23%5E6b6Z5LmL6Zif5a6Y572R"
    					},
    					{
    					   "type":"view",
    					   "name":"龙之队介绍",
    					   "url":"http://417386.m.weimob.net/weisite/channel?pid=417386&bid=806047&wechatid=fromUsername&categoryid=1080034&wxref=mp.weixin.qq.com&_tt=2&channel=menu%5E%23%5E6b6Z5LmL6Zif5LuL57uN"
    					},
    	                {
    					   "type":"view",
    					   "name":"龙之队大使",
    	                   "url":"http://417386.m.weimob.net/weisite/detail?pid=417386&bid=806047&wechatid=fromUsername&did=1546444&from=list&wxref=mp.weixin.qq.com&_tt=2&channel=menu%5E%23%5E6b6Z5LmL6Zif5aSn5L2/"
                        },
    	                {
    					   "type":"view",
    					   "name":"入队技能get√",
    	                   "url":"http://417386.m.weimob.net/weisite/detail?pid=417386&bid=806047&wechatid=fromUsername&did=1549623&from=list&wxref=mp.weixin.qq.com&_tt=2&channel=menu%5E%23%5E5YWl6Zif5oqA6IO9Z2V04oia"
                        },
    				]
    		   },
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