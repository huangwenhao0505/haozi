<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 云之讯短信验证 
 * */
class SmsController extends Controller
{

    private $appid = "9a3c0d72968c40dca85909da67232c0e";//应用id
    private $accountsid = "e2411f67cebb79a26e89e3d90c41f27d";//用户sid
    private $token = "b2f586ec78c4214a022ac0b9a947386c";//鉴权密钥
    
    public function __construct()
    {
        parent::__construct();
        include_once './Application/Home/Model/Ucpaas.class.php';//载入ucpass类
    }
    
    /**
     * 发送短信验证码
     * @param $templateid 模板id ----->345891
     * @param $param 模板中的参数   多个参数使用英文逗号隔开（如：param=“a,b,c”）
     * @param $mobilephone 要发送短信的手机号
     * */
    public function sendCode()
    {
        $templateid = 345891;
        $code = rand(1000, 9999);//随机4位数
        $param = $code.",5";//随机验证码加有效时间5分钟
        $mobilephone = $_GET['mobilephone'];
        if($mobilephone == null)
        {
            echo "手机号不能为空!";
            exit;
        }
        
        $options = array(
            "token"      => $this->token,
            "accountsid" => $this->accountsid
        );
        
        $Ucpass = new \Ucpaas($options);
        
        $result = $Ucpass->SendSms($this->appid, $templateid, $param, $mobilephone, null);
        
        $add['uid'] = $code;
        $add['user_time'] = date('Y-m-d H:i:s', time());
        $add['user_ip'] = $mobilephone;
        $res = M('user_log')->add($add);
        
        echo "成功".$result;
        exit;
    }
}