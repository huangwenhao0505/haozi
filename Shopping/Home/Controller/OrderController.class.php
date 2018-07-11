<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 订单相关类
 * */
class OrderController extends Controller {
    
    public function __construct(){
        parent::__construct();
        $header = A('Public')->header();//公共部分的方法
        $this->img = $header['img'];//$img
        $this->nickname = $header['nickname']; //$nickname
        $this->logintime= $header['logintime'];//$logintime
        $this->cartcount= $header['cartcount'];//$cartcount
        $this->cartprice= $header['cartprice'];//$cartprice
        $this->cartlist = $header['cartlist']; //$cartlist
        
        //A('Public')->delCart();//公共部分，引入删除购物车操作
        //A('Public')->cartList();//公共部分，无刷新显示购物车
    }
    
    public function errmsg($errno, $errmsg,$data=""){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg,
            'data'  => $data
        );
        return $array;
    }
    
    /**
     * 提交订单（确认订单页面显示）
     * 结算选中的购物车商品跳转到确认订单页面（此时还没生成订单）
     * @param cartIdList string 购物车id(多个以,号连接)
     * @param totalAmount double 总金额*/
    public function confirmOrder(){
        $userId = A('Public')->isLogin();
        
        $cartIdList = I('get.cartIdList');
        $totalAmount = I('get.totalAmount');
        
        $cartId = explode(',', $cartIdList);
        $list = array();
        foreach($cartId as $k => $v){
            $w['c.id'] = $v;
            $list[$k] = M('goods_cart c')
            ->field('g.id,g.name,g.img,g.price,c.goodsNum,c.amount,c.attrValue1,c.attrValue2')
            ->join('__GOODS__ g on g.id = c.goodsId','LEFT')
            ->where($w)
            ->find();
        }

        foreach($list as $k => $v){
            if($v['attrvalue2'] != ''){
                $list[$k]['attrvalue'] = $v['attrvalue1'].','.$v['attrvalue2'];
            }else{
                $list[$k]['attrvalue'] = $v['attrvalue1'];
            }
        }
        
        $where['userId'] = $userId;
        $where['isDefault'] = 1;
        $address = M('user_ship_address')->where($where)->find();
        
        $this->assign('totalAmount',$totalAmount);//总金额
        $this->assign('list',$list);//列表
        $this->assign('address',$address);//收货地址
        $this->assign('cartIdList',$cartIdList);//购物车选中的id

        $this->display();
    }
    
    /**
     * 确认订单(生成订单)
     * @param addressId  int 收货地址id
     * @param cartIdList string 购物车id(多个以,号连接)
     * @param totalAmount double 总金额*/
    public function subOrder(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            
            //接收参数
            $addressId = I('post.addressId');
            $cartIdList = I('post.cartIdList');
            $totalAmount = I('post.totalAmount');

            if($addressId == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择收货地址'));
            }
            
            //生成订单，记录到订单表
            $add['userId'] = $userId;
            $add['orderNo'] = $this->orderNo($userId);
            $add['totalAmount'] = $totalAmount;
            $add['payAmount'] = $totalAmount;
            $add['shipAdressId'] = $addressId;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $res = M('order')->add($add);//订单id
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，提交失败'));
            }
            
            //生成订单成功，记录到订单明细表
            $cartId = explode(',', $cartIdList);
            foreach($cartId as $k => $v){
                $w['id'] = $v;
                $info = M('goods_cart')->where($w)->find();
    
                $d['orderId'] = $res;
                $d['goodsId'] = $info['goodsid'];
                $d['price'] = $info['amount'] / $info['goodsnum'];
                $d['goodsNum'] = $info['goodsnum'];
                $d['amount'] = $info['amount'];
                $d['attrValue1'] = $info['attrvalue1'];
                $d['attrValue2'] = $info['attrvalue2'];
                $d['createDate'] = date('Y-m-d H:i:s',time());
                M('order_item')->add($d);
            }
            
            //删除其购物车的这些商品
            $wh['id'] = array('in',$cartIdList);
            M('goods_cart')->where($wh)->delete();
            
            $this->ajaxReturn($this->errmsg(10000, '提交成功，正在跳转到支付界面',$res));
        }
    }
    
    /**
     * 立即购买（还未生成订单）
     * @param goodsId int 商品id
     * @param price double 商品售价
     * @param goodsNum int 购买数量
     * @param attrValue1 string 属性规格1
     * @param attrValue2 string 属性规格2*/
    public function subOrderNow(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            
            $goodsId = I('post.goodsId');
            $price = I('post.price');
            $goodsNum = I('post.goodsNum');
            $attrValue1 = I('post.attrValue1');
            $attrValue2 = I('post.attrValue2');
            
            //判断验证
            if(!$userId){
                $this->ajaxReturn($this->errmsg(20001, '请先登录'));
            }
            
            if($goodsId == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择所要购买的商品'));
            }
            
            if($attrValue1 == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择商品属性'));
            }
            
            $wh['id'] = $goodsId;
            $rs = M('goods')->where($wh)->find();
            if(!$rs){
                $this->ajaxReturn($this->errmsg(10001, '所选择的商品不存在'));
            }
            if($goodsNum == '' || $goodsNum == 0){
                $this->ajaxReturn($this->errmsg(10001, '所购买的数量至少为1'));
            }
            
            $w['goodsId'] = $goodsId;
            $w['attrValue1'] = $attrValue1;
            if($attrValue2 != ''){
                $w['attrValue2'] = $attrValue2;
            }
            $info = M('goods_store')->field('stock')->where($w)->find();
            if($info['stock'] < $goodsNum){
                $this->ajaxReturn($this->errmsg(10001, '库存数量不足，请重新选择'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '提交成功'));
        }
    }
    
    /**
     * 立即购买确认订单（生成订单）
     * 【确认订单页面显示和生成订单同时在这个方法里面写了 get请求 和 post请求】
     * @param goodsId int 商品id
     * @param goodsNum int 购买数量
     * @param attr1 string 属性规格1
     * @param attr2 string 属性规格2*/
    public function confirmOrderNow(){
        
        //ajax操作生成订单
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            
            $addressId = I('post.addressId');//收货地址id
            $goodsId = I('post.goodsId');
            $goodsNum = I('post.goodsNum');
            $attrValue = I('post.attrValue');//属性1和属性2以,号拼接成字符串
            $totalAmount = I('post.amount');
            
            if($addressId == 0 || $addressId == null){
                $this->ajaxReturn($this->errmsg(10001, '请选择收货地址'));
            }
            
            //生成订单，记录到订单表
            $add['userId'] = $userId;
            $add['orderNo'] = $this->orderNo($userId);
            $add['totalAmount'] = $totalAmount;
            $add['payAmount'] = $totalAmount;
            $add['shipAdressId'] = $addressId;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $res = M('order')->add($add);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，提交失败'));
            }
            
            $attr = explode(',', $attrValue);//分割属性
            $attrValue1 = $attr[0];
            $attrValue2 = $attr[1];
            //生成订单成功，记录到订单明细表
            $d['orderId'] = $res;
            $d['goodsId'] = $goodsId;
            $d['price'] = $totalAmount / $goodsNum;
            $d['goodsNum'] = $goodsNum;
            $d['amount'] = $totalAmount;
            $d['attrValue1'] = $attrValue1;
            $d['attrValue2'] = $attrValue2;
            $d['createDate'] = date('Y-m-d H:i:s',time());
            M('order_item')->add($d);
            
            //下单成功，减去其商品库存
            $w['goodsId'] = $goodsId;
            $w['attrValue1'] = $attrValue1;
            if($attrValue2 != ''){
                $w['attrValue2'] = $attrValue2;
            }
            $row = M('goods_store')->field('stock')->where($w)->find();
            
            $d['stock'] = $row['stock'] - $goodsNum;
            M('goods_store')->where($w)->save($d);
            
            $this->ajaxReturn($this->errmsg(10000, '提交成功，正在跳转到支付界面',$res));
            exit;
        }//end ajax
        
        //确认订单页面显示 
        $goodsId = I('get.goodsId');
        $goodsNum = I('get.goodsNum');
        $attr1 = I('get.attr1');
        $attr2 = I('get.attr2');
        $userId = A('Public')->isLogin();
        
        if($attr2 != ''){
            $attrValue = $attr1.','.$attr2;
        }else{
            $attrValue = $attr1;
        }
    
        $info = M('goods')->field('id,name,price,img')->where('id='.$goodsId)->find();
    
        $info['amount'] = $info['price'] * $goodsNum;//总金额
        $info['goodsnum'] = $goodsNum;
        $info['attrvalue'] = $attrValue;
    
        $wh['userId'] = $userId;
        $wh['isDefault'] = 1;
        $address = M('user_ship_address')->where($wh)->find();
    
        $this->assign('info',$info);
        $this->assign('address',$address);
    
        $this->display();
    }

    /**
     * 生成订单号*/
    private function orderNo($userId){
        $a = "H";
        $b = date('ymdhis',time());
        $c = time();
        $str = $a.$b.$userId.$c;
        return $str;
    }
    
    /**
     * 连接redis*/
    public function redis(){
        $host = $_SERVER['SERVER_ADDR'];
        $redis = new \Redis();
        $redis->connect($host);
        return $redis;
    }
    
    /**
     * 模拟商品抢购
     * */
    public function rushSale()
    {
        $userId = A('Public')->isLogin();
        
        //$goodsStock = M('goods_store')->field('stock')->where('id=17')->find();
        //$stock = $goodsStock['stock'];//商品库存
        
        //预先给出商品库存，不要从数据库里面动态去取。。。
        $stock = 3;
        
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        
        //返回列表 key的长度,key不存在则返回0
        $res = $redis->lLen("userId");

        //判断库存是否足够
        $count = $stock - $res;
        if($count <= 0)
        {
            echo "商品已被抢光";
            exit;
        }
        
        $listAll = $redis->lrange("userId",0,-1);//返回列表中所有的值
        if(in_array($userId, $listAll))
        {
            echo "您已经抢购了该商品!";
            exit;
        }
        
        //实现抢购
        $redis->rPush("userId", $userId);//将一个值插入到列表的尾部
        //实现抢购，将 key中储存的数字值增一
        //$redis->incr("userId");
        
        //下单付款
        $add['userId'] = $userId;
        $add['orderNo'] = $this->orderNo($userId);
        $add['totalAmount'] = 100;
        $add['payAmount'] = 100;
        $add['createDate'] = date('Y-m-d H:i:s',time());
        $add['remake'] = "商品抢购测试";
        
        if( M('order')->add($add) )
        {
            echo "抢购成功！";
        } else {
            echo "抢购失败！";
        }
        
    }

}