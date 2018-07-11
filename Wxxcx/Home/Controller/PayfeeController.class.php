<?php
namespace Home\Controller;
use Home\Controller\MyController;

class PayfeeController extends MyController
{
    /**
     * 支付*/
    public function pay()
    {
        $appid  = C(WXXCXAPPID);//小程序APPid
        $mch_id = C(MCHID);//商户号
        $mch_key= C(MCHKEY);//商户密钥
        $out_trade_no = time();//商户订单号
        
        $openid = $_POST['openid'];//用户标识
        $total_fee = $_POST['price'];//商品金额 
        
        if(empty($total_fee)) //押金
        {
            $body = "充值押金";
            $total_fee = floatval(99*100);
        }
        else {
            $body = "充值余额";
            $total_fee = floatval($total_fee*100);
        }
        
        $weixinpay = new \WeixinPay($appid,$openid,$mch_id,$mch_key,$out_trade_no,$body,$total_fee);
        $return = $weixinpay->pay();
        
        echo json_encode($return);
    }

}

