<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 购物车相关类*/
class CartController extends Controller {
    
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
    
    public function errmsg($errno, $errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 加入购物车
     * @param goodsId int 商品id
     * @param price double 商品价格
     * @param goodsNum int 购买数量
     * @param attrValue1 string 规格1
     * @param attrValue2 string 规格2*/
    public function addCart(){
        
        if(IS_AJAX){
            $uid = A('Public')->isLogin();
            
            $goodsId = I('post.goodsId');
            $price = I('post.price');
            $goodsNum = I('post.goodsNum');
            $attrValue1 = I('post.attrValue1');
            $attrValue2 = I('post.attrValue2');
    
            //判断验证
            if(!$uid){
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
            
            $priceCount = $price * $goodsNum;//总价钱
    
            $add['userId'] = $uid;
            $add['goodsId'] = $goodsId;
            $add['goodsNum'] = $goodsNum;
            $add['amount'] = $priceCount;
            $add['attrValue1'] = $attrValue1;
            $add['attrValue2'] = $attrValue2;
            $add['createDate'] = date('Y-m-d H:i:s',time());
    
            $res = M('goods_cart')->add($add);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '加入购物车失败'));
            }
    
            //加入购物车成功时，减去相应的数量
            $d['stock'] = $info['stock'] - $goodsNum;
            M('goods_store')->where($w)->save($d);
            
            //如果所加入的商品原先购物车里面就有，则合并在一起
            $w['userId'] = $uid;//加上条件用户id
            $w['isok'] = 1;//有效的
            $list = M('goods_cart')->where($w)->order('createDate desc')->select();
            if(count($list) >= 2){
                foreach($list as $k => $v){
                    $newnum += $v['goodsnum'];
                    $newamount += $v['amount'];
                }
                M('goods_cart')->where($w)->delete();//删除所有的该类商品，生成一条新的数据
                
                $s['userId'] = $uid;
                $s['goodsId'] = $goodsId;
                $s['goodsNum'] = $newnum;
                $s['amount'] = $newamount;
                $s['attrValue1'] = $attrValue1;
                $s['attrValue2'] = $attrValue2;
                $s['createDate'] = date('Y-m-d H:i:s',time());
                M('goods_cart')->add($s);
            }
    
            $this->ajaxReturn($this->errmsg(10000, '加入购物车成功'));
        }
    }
    
    /**
     * 购物车列表*/
    public function cartList(){
        if(IS_AJAX){
            $uid = A('Public')->isLogin();
            $w['userId'] = $uid;
            $list = M('goods_cart')->field('id as cartId,goodsNum,amount,attrValue1,attrValue2,isok,createDate')->where($w)->limit(3)->select();
            foreach($list as $k => $v){
                $where['goodsId'] = $v['goodsid'];
                $list[$k]['goodsInfo'] = M('goods')->field('id,name,img,description,price,unitName')->where($where)->find();
            }
            
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
        
        $this->display();
    }
    
    /**
     * 购物车商品选中与取消
     * 显示结算的商品数量与总价钱
     * @param cartIdList string 购物车id(多个以,号连接)*/
    public function subCart(){
        if(IS_AJAX){
            $cartIdList = I('post.cartIdList');
            $cartId = explode(',', $cartIdList);
            $count = count($cartId);//结算的商品数量
            $where['id'] = array('in',$cartIdList);
            $list = M('goods_cart')->where($where)->select();
            $amount = 0;
            foreach($list as $k => $v){
                $amount += $v['amount'];//结算商品的总价钱
            }
            $data['count'] = $count;
            $data['amount'] = $amount;
            echo json_encode($data);
        }
    }
    
    /**
     * 删除购物车某商品
     * @param id int 购物车id*/
    public function delCart(){
        if(IS_AJAX){
            $id = I('post.id');
            $w['id'] = $id;
            M('goods_cart')->where($w)->delete();
        }
    }

}