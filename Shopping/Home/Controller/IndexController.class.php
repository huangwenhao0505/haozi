<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    
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
            'errno'  =>$errno,
            'errmsg' => $errmsg    
        );
        return $array;
    }
    
    public function a(){
        $this->display();
    }
    
    /**
     * 首页商品展示
     * */
    public function index()
    {
        //商品列表
        $goodsName = I('post.goodsName');
        if($goodsName != '')
        {
            $w['name'] = array('like','%'.$goodsName.'%');
        }
        
        $w['isMarketable'] = 1;
        
        $goodsList = M('goods')->where($w)->select();
        
        //分类信息
        $categoryList = M('goods_category')->where('parentId=0 and isShow=1')->select();
        foreach($categoryList as $k => $v)
        {
            $wh['parentId'] = $v['id'];
            $categoryList[$k]['sonCategory'] = M('goods_category')->where($wh)->select();
        }

        $this->assign('categoryList', $categoryList);
        $this->assign('goodsList', $goodsList);
        $this->display();
    }
    
}