<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 支付宝支付
 * */
class PayController extends Controller {
    
    public function __construct()
    {
        include_once './Alipay/Public/alipay/aop/AopClient.php';
        include_once './Alipay/Public/alipay/aop/request/AlipayTradePagePayRequest.php';
    }
    
    /**
     * 支付宝支付的公用参数*/
    public function payMember()
    {
        $alipay_config = C('alipay_config');
        
        //构造参数
        $aop = new \AopClient ();
        $aop->gatewayUrl = $alipay_config['gatewayUrl'];
        $aop->appId = $alipay_config['app_id'];
        $aop->rsaPrivateKey = $alipay_config['merchant_private_key'];
        $aop->apiVersion = '1.0';
        $aop->signType = $alipay_config['sign_type'];
        $aop->postCharset= $alipay_config['charset'];
        $aop->format='json';
        
        return $aop;
    }
    
    /**
     * 支付宝支付*/
    public function doPay()
    {
        $alipay_config = C('alipay_config');
        
        //商品相关信息
        $out_trade_no = $this->orderNo();//商户订单号
        $product_code = "FAST_INSTANT_TRADE_PAY";//与支付宝签约的产品码
        $total_amount = 100;
        $subject = "测试的哟！！！";
        
        $bizContent = array(
            'out_trade_no'  =>  $out_trade_no,
            'product_code'  =>  $product_code,
            'total_amount'  =>  $total_amount,
            'subject'       =>  $subject
        );
        
        $request = new \AlipayTradePagePayRequest ();
        $request->setReturnUrl($alipay_config['return_url']);
        $request->setNotifyUrl($alipay_config['notify_url']);
        $request->setBizContent(json_encode($bizContent));
        
        //请求
        $result = $this->payMember()->pageExecute ($request);
        
        //输出
        echo $result;
    }
    
    /**
     * 异步通知地址
     * 支付宝POST请求
     * */
    public function notify_url()
    {
        $alipon = new \AopClient ();
        $signVerified = $alipon->rsaCheckV1($_POST, null, 'RSA2');
        
        $file = "./Alipay/Public/log/log.txt";
        $myfile = fopen($file, "w");
        fwrite($myfile, json_encode($_POST));
        fclose($myfile);
        exit;
        if($signVerified){
            
        }else{
            echo "file";
        }
    }
    
    /**
     * 同步跳转地址
     * 支付宝GET请求
     * */
    public function return_url()
    {
        $alipon = new \AopClient ();
        $signVerified = $alipon->rsaCheckV1($_GET, null, 'RSA2');

        if($signVerified){
            echo "支付成功，正在跳转";
        }else{
            echo "支付失败！！！";
        }
    }
    
    /**
     * 生成订单号*/
    private function orderNo(){
        $a = "H";
        $b = date('ymdhis',time());
        $c = time();
        $str = $a.$b.$c;
        return $str;
    }
}