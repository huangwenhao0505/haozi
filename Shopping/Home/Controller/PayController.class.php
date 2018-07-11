<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 支付相关类（支付宝）
 * */
class PayController extends Controller {
    
    public function __construct($alipay_config){
        parent::__construct();
        
        include_once './Shopping/Public/alipay/aop/AopClient.php';
        include_once './Shopping/Public/alipay/aop/request/AlipayTradePagePayRequest.php';
        include_once './Shopping/Public/alipay/aop/request/AlipayTradeRefundRequest.php';
    }
    
    /**
     * 支付宝支付的公用参数*/
    public function payMember(){
        //include_once './Shopping/Public/alipay/aop/AopClient.php';
        $alipay_config = C('alipay_config');
        
        //构造参数
        $aop = new \AopClient ();
        $aop->gatewayUrl = $alipay_config['getewayUrl'];
        $aop->appId = $alipay_config['app_id'];
        $aop->rsaPrivateKey = $alipay_config['merchant_private_key'];//商户私钥
        $aop->apiVersion = '1.0';
        $aop->signType = $alipay_config['sign_type'];
        $aop->postCharset= $alipay_config['charset'];
        $aop->format='json';
        
        return $aop;
    }
    
    /**
     * @param $orderIdStr string 订单号（多个之间以,号连接）*/
    public function doalipay(){
        //include_once './Shopping/Public/alipay/aop/request/AlipayTradePagePayRequest.php';
        
        $alipay_config = C('alipay_config');
        
        $userId = session('id');
        $orderIdStr = I('get.orderIdStr');

        $w['id'] = array('in',$orderIdStr);
        $w['userId'] = $userId;
        $list = M('order')->field('id,payAmount,payState,orderNo')->where($w)->select();

        if(empty($list)){
            $this->success('系统繁忙，请稍后再试！',U('Usercenter/userorder'));exit;
        }
        
        $totalAmount = 0;//订单总金额
        $orderNo = array();//订单号
        $title = array();//订单标题
        $rename = array();//订单描述（可为空）
        foreach($list as $k => $v){
            $where['orderId'] = $v['id'];
            $list[$k]['goodsitem'] = M('order_item i')
            ->field('i.attrValue1,i.attrValue2,g.name')
            ->join('__GOODS__ g on g.id = i.goodsId','left')
            ->where($where)
            ->select();

            if($v['paystate'] == 2){
                continue;
            }else{
                $totalAmount += $v['payamount'];
                $orderNo[] = $v['orderno'];
                foreach($list[$k]['goodsitem'] as $key => $val){
                    $title[] = $val['name'];
                    if($val['attrvalue2'] == ''){
                        $rename[] = $val['attrvalue1'];
                    }else{
                        $rename[] = $val['attrvalue1'].'-'.$val['attrvalue2'];
                    }
                }
            }
        }
        
        $orderNo = implode(',', $orderNo);
        $title = implode(',', $title);
        $rename = implode(',', $rename);
        
        $typeArray = array(
            "product_code" => "FAST_INSTANT_TRADE_PAY",
            "out_trade_no" => $orderNo,
            "subject"      => $title,
            "total_amount" => $totalAmount,
            "body"         => $rename
        );

        $request = new \AlipayTradePagePayRequest ();
        $request->setReturnUrl($alipay_config['return_url']);//同步跳转
        $request->setNotifyUrl($alipay_config['notify_url']);//异步跳转
        $request->setBizContent(json_encode($typeArray));
        
        //请求
        $result = $this->payMember()->pageExecute ($request);
        
        //输出
        echo $result;
    }
    
    /**
     * 服务器通知（支付宝发送一个post请求）*/
    public function notify_url(){

        //include_once './Shopping/Public/alipay/aop/AopClient.php';

        $aop = new \AopClient; 
        $verify_result = $aop->rsaCheckV1($_POST, NULL, "RSA2"); 

        $file = "./Shopping/Public/log/log.txt";
        $myfile = fopen($file, "w") or die("Unable to open file!");
//         $txt = $_POST;
//         if($txt == ''){
//             $txt = "sdsdssdsdsddsds";
//         }
        fwrite($myfile, json_encode($_POST));
        fclose($myfile);

        if($verify_result){
            if($_POST['trade_status'] == "TRADE_SUCCESS" || $_POST['trade_status'] == "TRADE_FINISHED"){
                $trade_no       = $_POST['trade_no'];          //支付宝交易号
                $orderStr = explode(',',$_POST['out_trade_no']);//订单号
                foreach($orderStr as $k => $v){
                    $w['orderNo'] = $v;
                    $d['payState'] = 2;
                    $d['payChannel'] = 'alipay';
                    $d['payDate'] = $_POST['gmt_payment'];//支付时间
                    M('order')->where($w)->save($d);
                    
                    //记录到消费记录表
                    $res = M('order')->where($w)->find();
                    $add['userId'] = session('id');
                    $add['orderId'] = $res['id'];//订单id
                    $add['payAmount'] = $res['payamount'];//订单金额
                    $add['payTimes'] = $_POST['gmt_payment'];//支付时间
                    M('user_pay_log')->add($add);
                } 
            }
            
            echo "success"; //这里必须是success，不能修改
        }else{
            echo "file";
        }
 
    }
    
    /**
     * 支付成功后的跳转页面（返回页面）*/
    public function return_url(){
        header("content-type:text/html;charset=utf-8");  //设置编码
        //include_once './Shopping/Public/alipay/aop/AopClient.php';

        $request = new \AopClient();

        $verify_result = $request->rsaCheckV1($_GET, null,'RSA2'); 

        if($verify_result){
            $this->success('支付成功，正在跳转',U('/Home/Usercenter/orderList'));exit;
        }else{
            $this->success('支付失败，正在跳转。。。',U('Index/index'));exit;
        }
    }
    
    /**
     * 支付宝统一收单交易退款
     * @param orderId int 订单id*/
    public function refundPay(){
        
        //include_once './Shopping/Public/alipay/aop/request/AlipayTradeRefundRequest.php';
        
        $id = I('get.orderId');
        
        $info = M('order')->field('id,orderNo,payAmount')->where('id='.$id)->find();
        
        $out_trade_no  = $info['orderno'];//订单号
        $refund_amount = $info['payamount'];//订单总金额  
        
        $typeArray = array(
            'out_trade_no' => $out_trade_no,
            'refund_amount'=> $refund_amount
        );
        
        $request = new \AlipayTradeRefundRequest ();
        $request->setBizContent(json_encode($typeArray));
        
        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $this->payMember()->execute($request)->$responseNode->code;
        
        if(!empty($resultCode)&&$resultCode == 10000){
            echo "成功";
        } else {
            echo "失败";
        }
    }

}