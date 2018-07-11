<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    private $token;
    
    public function __construct(){
        parent::__construct();
        $this->token = 'haozi';//token密匙
        
        include_once './Wx/thirdParty/wxapi.php';
    }

    public function index(){
        $token = $this->token;
        
        $wechatObj = A('WechatCallbackapiTest');
        //$wechatObj = new \WechatCallbackapiTest;
        
        if (!isset($_GET['echostr'])) {
            $wechatObj->responseMsg();
        }else{
            $wechatObj->valid($token);
        }
        
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
    
    /**
     * 生成带参数的二维码*/
    public function code(){
        //获取微信token凭证
        $token = $this->token();
        
        //通过post请求获取数据
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$token}";
        $post = '{
                    "expire_seconds": 604800,
                    "action_name": "QR_SCENE", 
                    "action_info": {"scene": {"scene_id": 123}}
                }';
        $result = A('WechatCallbackapiTest')->httpsSend($url,$post);
        $dataInfo = json_decode($result);
        
        //创建二维码ticket
        $ticket = $dataInfo->ticket;
        
        //通过ticket换取二维码
        $ticket = urlencode($ticket);
        $codeUrl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";
        
        //输出显示二维码图片
        header("Content-Type:image/png");
        echo file_get_contents($codeUrl);
    }
    
    /**
     * 微信网页相关*/
    public function goodsList(){
        
        header("Content-Type: text/html;charset=utf-8");
        
        $appid = C(WXAPPID);
        $appsecret = C(WXAPPKEY);
        $code = $_GET['code'];//获取code
        
        //获取access_token
        $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";
        $res = $this->https_request($oauth2Url);

        //刷新access_token
        $refresh_token = $res['refresh_token'];
        $refreshUrl = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$appid}&grant_type=refresh_token&refresh_token={$refresh_token} ";
        $data = $this->https_request($refreshUrl);
        
        //拉取用户信息
        $access_token = $data['access_token'];//网页授权接口调用凭证
        $openid = $data['openid'];//用户唯一标识
        $userUrl = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        $userInfo = $this->https_request($userUrl);
        
        //var_dump($userInfo);exit;
        
        $where['isMarketable'] = 0;
        $where['isDelete'] = 0;
        $list = M('goods')->where($where)->limit(5)->select();

        $this->assign('list',$list);
        $this->display();
    }
    
    public function web(){
        
        $signPackage = A("Jssdk")->getSignPackage();
        $this->assign("signPackage",$signPackage);

        $id = I('get.id');
        $where['id'] = $id;
        $info = M('goods')->where($where)->find();
        
        $wxurl = A('Oauth')->wxurl();
        $info['link'] = $wxurl;
        
        //header("Content-Type: text/html;charset=utf-8");
        //echo "<pre>";
        //var_dump($info);exit;
        
        $this->assign('data',$info);
        $this->display('webindex');
    }
    
    function https_request($url,$type='get',$res='json',$data = ''){ 
        //1.初始化curl 
        $curl = curl_init(); 
        //2.设置curl的参数 
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,2); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        if ($type == "post"){ 
            curl_setopt($curl, CURLOPT_POST, 1); 
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
        } 
        //3.采集
        $output = curl_exec($curl); 
        //4.关闭 
        curl_close($curl); 
        if ($res == 'json') { 
            return json_decode($output,true); 
        } 
    }
    
}