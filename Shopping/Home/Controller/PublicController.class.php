<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 公共方法类*/
class PublicController extends Controller {
    
    public function errmsg($errno, $errmsg){
        $array = array(
            'errno'  =>$errno,
            'errmsg' => $errmsg
        );
        return $array;
    }
    
    /**
     * 分类列表*/
    public function category(){
        $goodsCategory = M('goods_category')->field('id,name')->where('parentId=0')->order('ordernum')->select();
        foreach($goodsCategory as $k => $v){
            $parentList = M('goods_category')->field('id,name')->where('parentId='.$v['id'])->select();
            $goodsCategory[$k]['parentList'] = $parentList;
        }
        
        return $goodsCategory;
    }
    
    /**
     * 公共部分
     * 相关内容显示*/
    public function header(){
        $userId = session('id');

        if(!$userId){//游客访问
            $arr = array(
                'img'  => '',//头像
                'nickname' => '',//昵称
                'logintime'=> '',//登录时间
                'cartcount'=> 0,//购物车数量
                'cartprice'=> 0,//购物车总价格
                'cartlist' => false//购物车列表
            );
        }else{//用户访问
            //根据userId查询用户是QQ登录还是账号登录
            $info = M('user')->where('id='.$userId)->find();
            if($info['login_way'] == 1){//qq登录
                $img = session('qq_img');
                $nickname = session('qq_nickname');
            }else{//账号登录
                $img = $info['u_img'];
                $nickname = $info['nickname'] == '' ? $info['username'] : $info['nickname'];
            }
             
            $w['uid'] = $userId;
            $w['user_type'] = 1;//登录
            $time = M('user_log')->field('user_time')->where($w)->order('id desc')->find();//获取最新的一次登录时间
            
             
            $wh['userId'] = $userId;
            $cartCount = M('goods_cart')->where($wh)->count();//购物车总数量
            $cartPrice = M('goods_cart')->where($wh)->select();
            $totalPrice = 0;
            foreach($cartPrice as $k => $v){
                $totalPrice += $v['amount'];//购物车总价格
            }
             
            $where['c.userId'] = $userId;
            $list = M('goods_cart c')//头部公共部分购物车列表，最多只显示3个
            ->field('c.id,c.goodsNum,c.amount,c.attrValue1,c.attrValue2,c.isok,c.createDate,g.price,g.name,g.img')
            ->join('__GOODS__ g on g.id = c.goodsId')
            ->where($where)
            ->limit(3)
            ->select();
            foreach($list as $k => $v){
                if($v['attrvalue2'] != ''){
                    $list[$k]['attrvalue'] = $v['attrvalue1'].'-'.$v['attrvalue2'];
                }else{
                    $list[$k]['attrvalue'] = $v['attrvalue1'];
                }
            }
             
            $arr = array(
                'img'  => $img,//头像
                'nickname' => $nickname,//昵称
                'logintime'=> $time['user_time'],//登录时间
                'cartcount'=> $cartCount,//购物车数量
                'cartprice'=> $totalPrice,//购物车总价格
                'cartlist' => $list//购物车列表
            );
        }
        
        return $arr;
    }
    
    /**
     * 验证是否已登录  
     * 未登录的直接跳转到登录页面（是index.php的登录）*/
    public function checkLogin(){
        $id = session('id');
        $qq_openid = session('qq_openid');
        $username = session('username');
    
        if(empty($id) && empty($username) && empty($qq_openid) && $id == null && $username == null && $qq_openid == null){
            
            header("location:/index.php/Home/Login/ajaxLogin");
        }
        
    }
    
    /**
     * 验证是否登录
     * 1.未登录给出错误提示，不直接跳转
     * 2.登录返回用户登录id*/
    public function isLogin(){
        $id = session('id');
        $qq_openid = session('qq_openid');
        $username = session('username');
        
        if(empty($id) && empty($username) && empty($qq_openid) && $id == null && $username == null && $qq_openid == null){
        
            $this->ajaxReturn($this->errmsg(20001, '请先登录'));
        }else{
            return $id;
        }
    }

}