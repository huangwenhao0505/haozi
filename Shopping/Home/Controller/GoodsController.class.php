<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 商品相关类*/
class GoodsController extends Controller {
    
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
    
    public function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 商品详情页*/
//     public function goodsView(){

//         $id = I('get.id');//商品id
//         $info = M('goods')->where('id='.$id)->find();//商品信息
        
        
//         $info['storeList'] = M('goods_store')->where('goodsId='.$id)->select();//商品规格信息
        
//         $totalStock = 0;//总库存
//         foreach($info['storeList'] as $k => $v){
//             $totalStock += $v['stock'];
//         }
        
//         $info['totalstock'] = $totalStock;
        
//         //商品规格属性值列表
//         $attr = explode(',', $info['attrnamelist']);
//         if(count($attr) == 2){
//             $attrValue1 = M('goods_store')->field('attrValue1 as attrValue')->where('goodsId='.$id)->group('attrValue1')->select();
//             $attrValue2 = M('goods_store')->field('attrValue2 as attrValue')->where('goodsId='.$id)->group('attrValue2')->select();
//             $info['attrList'] = array(
//                 array('attrName'=>$attr[0],'attrValue'=>$attrValue1),
//                 array('attrName'=>$attr[1],'attrValue'=>$attrValue2)
//             );
//         }else{
//             $attrValue = M('goods_store')->field('attrValue1 as attrValue')->where('goodsId='.$id)->group('attrValue1')->select();
//             $info['attrList'] = array(
//                 array('attrName'=>$attr[0],'attrValue'=>$attrValue),
//             );
//         }
        
//         //获取所有属性名称
//         $attrNameList = M('attribute_name')->field('id,attrname')->select();
//         foreach($attrNameList as $k => $v){
//             //根据属性名称id获取相对应的属性值
//             $attrNameList[$k]['attrValueList'] = M('attribute_value')->where('attrNameId='.$v['id'])->select();
//         }
        
//         //判断该商品是否存在该属性
//         foreach($info['attrList'] as $k => $v){
//             $arr[$v['attrName']] = $v['attrName'];
//         }
//         foreach($attrNameList as $k => $v){
//             if($arr[$v['attrname']] == ''){
//                 $attrNameList[$k]['isok'] = 0;
//             }else{
//                 $attrNameList[$k]['isok'] = 1;
//             }
//         }
        
//         //该商品的属性
//         $s = M('goods_store')->field('attrValue1,attrValue2')->where('goodsId='.$id)->select();
//         foreach($s as $k => $v){
//             $attrvalueArr1[] = $v['attrvalue1'];
//         }
        
//         $attrvalueArr1 = array_unique($attrvalueArr1);//去除重复的数据
        
//         //判断商品存在的该属性是否有库存在卖
//         foreach($attrNameList as $k => $v){
//             if($attrNameList[$k]['isok'] == 1){
//                 foreach($v['attrValueList'] as $key => $val){
//                     var_dump(in_array($val['value'], $attrvalueArr1));
//                     if(in_array($val['value'], $attrvalueArr1)){
//                         $attrNameList[$k]['attrValueList'][$key]['isok'] = 1;
//                     }else{
//                         $attrNameList[$k]['attrValueList'][$key]['isok'] = 0;
//                     }
//                 }
//             }
//         }
//             　　   
//         //购物车数量显示
        
// //         $uid = session('id');
// //         $w['userId'] = $uid;
// //         $w['isok'] = 1;
// //         $goodsCartNum = M('goods_cart')->where($w)->count();

//         $this->assign('attrNameList',$attrNameList);//所有属性名称
//         $this->assign('goodsInfo',$info);//商品相关信息
// //         $this->assign('cartNum',$goodsCartNum);//购物车数量显示
//         $this->display();
//     }
    
    /**
     * 选择商品规格属性时显示商品相关信息
     * @param goodsId int 商品id
     * @param attrValue1 string 规格属性1
     * @param attrValue2 string 规格属性2*/
    public function goodsStoreView(){
        if(IS_AJAX){
            $goodsId = I('post.goodsId');
            $attrValue1 = I('post.attrValue1');
            $attrValue2 = I('post.attrValue2');
            $where['goodsId'] = $goodsId;
            $where['attrValue1'] = $attrValue1;
            if($attrValue2 != ''){
                $where['attrValue2'] = $attrValue2;
            }
            $list = M('goods_store')->field('stock,soldNum')->where($where)->find();
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);
        }
    }
    
    /**
     * ajax购物车数量实时更新显示*/
    public function goodsCartNum(){
        if(IS_AJAX){
            //$uid = session('id');
            $uid = 1;
            $w['userId'] = $uid;
            $w['isok'] = 1;
            $num = M('goods_cart')->where($w)->count();
            echo json_encode($num);
        }
    }
    
    /**
     * 商品的评论记录列表显示
     * @param goodsId int 商品id*/
    public function commentList(){
        if(IS_AJAX){
            $qq_openid = session('qq_openid');
            $where['qq_openid'] = $qq_openid;
            $info = M('user_qq')->field('qq_nickname')->where($where)->find();

            $id = I('post.goodsId');
            $w['c.goodsId'] = $id;
            //评论列表显示
            $list = M('goods_comment c')
                ->field('c.*,g.name,g.img,u.nickname,u.username')
                ->join('__GOODS__ g on g.id = c.goodsId','left')
                ->join('__USER__ u on u.id = c.userId','left')
                ->where($w)
                ->order('createDate desc')
                ->select();
            
            //用户名判断显示
            foreach($list as $k => $v){
                if($info['qq_nickname'] == ''){
                    $list[$k]['commentusername'] = $v['nickname'] == '' ? $v['username'] : $v['nickname'];
                }else{
                    $list[$k]['commentusername'] = $info['qq_nickname'];
                }
            }
            
            //对数组进行分组
            $arr = array();
            foreach($list as $k => $v){
                $arr[$v['type']]['commentList'][] = $v;//以type进行分组
                $arr[$v['type']]['type'] = $v['type'];
            }
            
            //好、中、差评的评论数量
            foreach($arr as $k => $v){
                $arr[$k]['count'] = count($v['commentList']);
            }
            
            $arr = array_values($arr);//对数组key从0重新开始排序
            
            //总评论数
            foreach($arr as $k => $v){
                $count += $v['count'];
            }
            
            //追加一个type=0的数组元素，表示总的评论
            $arr[] = array(
                'type' => 0,
                'count'=> $count,
                'commentList' => $list,
            );
            
            echo json_encode($arr);
        }
    }
    
    /**
     * 商品详情18565672276
     * @param id 商品id
     * */
    public function getGoodsDetail()
    {
        $id = $_GET['id'];
        
        $res = M('goods')->where('id='.$id)->find();
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, "商品不存在"));
        }
        
        //商品属性列表
        $goodsAttrNameList = $res['attrnamelist'];
        $attrList = array();//用于封装所有的属性的name和value
        if($goodsAttrNameList != '')
        {
            $attrArr = explode(',', $goodsAttrNameList);//分割属性名称列表 类似 "颜色,尺码"
            for($i=1; $i<=count($attrArr); $i++)
            {
                //查询出单个属性的所有value
                $sql = "select attrValue{$i} as attrvalue from hwh_goods_store where goodsId = {$id} group by attrValue{$i}";
                $info = M()->query($sql);
                
                $attrValueArray = array();//封装单个属性所有vlaue
                foreach ($info as $v)
                {
                    $attrValueArray[] = $v["attrvalue"];
                }
                
                $arr = array("attrname"=>$attrArr[$i-1], "attrvalue"=>$attrValueArray);//封装单个属性的name和value
                $attrList[] = $arr; 
            }
        }
        
        //商品属性库存列表
        $storeList = M('goods_store')->field('attrValue1,attrValue2,attrValue3,price,stock')->where('goodsId='.$id)->select();
        foreach($storeList as $k => $v)
        {
            if($v['price'] == '')
            {
                //价格为空则显示商品本身的价格
                $storeList[$k]['price'] = $res['price'];
            }
        }
        $map = array(
            'info'      =>$res,
            'attrList'  =>$attrList,
            'storeList' =>$storeList
        );
        
        $this->assign('map', $map);
        $this->display('goodsView');
        //echo json_encode($map); 
    }
    
    /**
     * ajax操作商品属性
     * */
    public function ajaxGetGoodsDetail()
    {
        if(IS_AJAX)
        {
            $id = $_POST['id'];
            
            $res = M('goods')->where('id='.$id)->find();
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, "商品不存在"));
            }
            
            //商品属性库存列表
            $storeList = M('goods_store')->field('attrValue1,attrValue2,attrValue3,price,stock')->where('goodsId='.$id)->select();
            foreach($storeList as $k => $v)
            {
                if($v['price'] == '')
                {
                    //价格为空则显示商品本身的价格
                    $storeList[$k]['price'] = $res['price'];
                }
            }

            echo json_encode($storeList);
            exit;
        }
        
    }
    
    /**
     * 根据商品属性判断是否还有库存
     * @param id 商品id
     * @param attrValue1 属性规格1
     * @param attrValue2 属性规格2
     * @param attrValue3 属性规格3
     * */
    public function getGoodsStoreStock()
    {
        if(IS_AJAX)
        {
            $id = $_POST['id'];
            $attr1 = $_POST['attrValue1'];
            $attr2 = $_POST['attrValue2'];
            $attr3 = $_POST['attrValue3'];
            
            $res = M('goods')->where('id='.$id)->find();
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '该商品不存在！'));
            }
            
            $sql = "select price, stock from hwh_goods_store where goodsId = {$id} ";
            if($attr1 != '')
            {
                $sql += " and attrValue1 = '{$attr1}' ";
            }
            
            if($attr2 != '')
            {
                $sql += " and attrValue2 = '{$attr2}' ";
            }
            
            if($attr3 != '')
            {
                $sql += " and attrValue3 = '{$attr3}' ";
            }
            
            $info = M()->query($sql);
        }
    }
}