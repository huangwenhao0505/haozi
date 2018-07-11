<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 用户中心相关类
 * */
class UsercenterController extends Controller {
    
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
        
        //A('Public')->checkLogin();//检查是否登录
    }
    
    public function errmsg($errno, $errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 我的订单列表
     * @param type int 订单类型 */
    public function orderList(){
        $userId = A('Public')->isLogin();
        
        if(IS_AJAX){
            $type = I('post.type');
            
            $w['userId'] = $userId;
            
            if($type == 1){//待付款
                $w['payState'] = 1;
                
            }else if($type == 2){//待发货
                $w['payState'] = 2;
                $w['shipState'] = 1;
                
            }else if($type == 3){//待收货
                $w['payState'] = 2;
                $w['shipState'] = 2;
                
            }else if($type == 4){//退货、退款
                $w['payState'] = 2;
                $w['shipstate'] = 4;
                
            }else if($type == 5){//交易成功
                $w['payState'] = 2;
                $w['shipState'] = 3;
                
            }else if($type == 6){//交易关闭
                $w['payState'] = array('in',array(3,4));
            }
            
            $list = M('order')->field('id,orderNo,totalAmount,payState,shipState,isComment,createDate')->where($w)->select();
 
            foreach($list as $k => $v){
                $where['orderId'] = $v['id'];
                
                $list[$k]['goodsitem'] = M('order_item i')
                ->field('i.goodsId,i.goodsNum,i.price,i.amount,i.attrValue1,i.attrValue2,g.name,g.img')
                ->join('__GOODS__ g on g.id = i.goodsId')
                ->where($where)
                ->select();
                
                foreach($list[$k]['goodsitem'] as $key => $val){
                    if($val['attrvalue2'] != ''){
                        $list[$k]['goodsitem'][$key]['attrvalue'] = $val['attrvalue1'].','.$val['attrvalue2'];
                    }else{
                        $list[$k]['goodsitem'][$key]['attrvalue'] = $val['attrvalue1'];
                    }
                    unset($list[$k]['goodsitem'][$key]['attrvalue1'],$list[$k]['goodsitem'][$key]['attrvalue2']);
                }
                
                if($v['paystate'] == 1){
                    $list[$k]['orderName'] = '待付款';
                    $list[$k]['orderType'] = 1;
                    
                }else if($v['paystate'] == 2 && $v['shipstate'] == 1){
                    $list[$k]['orderName'] = '待发货';
                    $list[$k]['orderType'] = 2;
                    
                }else if($v['paystate'] == 2 && $v['shipstate'] == 2){
                    $list[$k]['orderName'] = '待收货';
                    $list[$k]['orderType'] = 3;
                    
                }else if($v['paystate'] == 2 && $v['shipstate'] == 4){
                    $list[$k]['orderName'] = '退货、退款';
                    $list[$k]['orderType'] = 4;
                    
                }else if($v['paystate'] == 2 && $v['shipstate'] == 3){
                    $list[$k]['orderName'] = '交易成功';
                    $list[$k]['orderType'] = 5;
                    
                }else if($v['paystate'] == 3 || $v['paystate'] == 4){
                    $list[$k]['orderName'] = '交易关闭';
                    $list[$k]['orderType'] = 6;
                }
                
            }
            
            //求出每个状态的订单数量
            $sql  = "select count(id) as count from hwh_order where userId = $userId";
            $sql1 = "select count(id) as count from hwh_order where userId = $userId and payState = 1";
            $sql2 = "select count(id) as count from hwh_order where userId = $userId and payState = 2 and shipState = 1";
            $sql3 = "select count(id) as count from hwh_order where userId = $userId and payState = 2 and shipState = 2";
            $sql4 = "select count(id) as count from hwh_order where userId = $userId and payState = 2 and shipState = 4";
            $sql5 = "select count(id) as count from hwh_order where userId = $userId and payState = 2 and shipState = 3";
            $sql6 = "select count(id) as count from hwh_order where userId = $userId and payState in (3,4)";
            
            $all = M()->query($sql);
            $daifukuan = M()->query($sql1);
            $daifahuo = M()->query($sql2);
            $daishouhuo = M()->query($sql3);
            $tuihuokuan = M()->query($sql4);
            $success = M()->query($sql5);
            $close =M()->query($sql6);
            
            $count['all']        = $all[0]['count'];      //全部
            $count['daifukuan']  = $daifukuan[0]['count'];//待付款
            $count['daifahuo']   = $daifahuo[0]['count']; //待发货
            $count['daishouhuo'] = $daishouhuo[0]['count'];//待收货
            $count['tuihuokuan'] = $tuihuokuan[0]['count'];//退货、退款
            $count['success']    = $success[0]['count'];   //交易成功
            $count['close']      = $close[0]['count'];     //交易关闭
            
            $data['list'] = $list == empty($list) ? false : $list;
            $data['count'] = $count;
            echo json_encode($data);exit;
        }//end ajax
        
        $this->display();
    }
    
    /**
     * 订单详情*/
    public function orderDetail(){
        $this->display();
    }
    
    /**
     * 取消订单
     * @param id int 订单id*/
    public function cancelOrder(){
        if(IS_AJAX){
            
            $id = I('post.id');
            $userId = A('Public')->isLogin();
            
            if($id == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择要取消的订单！'));
            }
            
            $w['userId'] = $userId;
            $w['id'] = $id;
            $flag = M('order')->where($w)->find();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '订单不存在！'));
            }
            
            $d['payState'] = 4;
            $res = M('order')->where($w)->save($d);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，取消失败！'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '取消成功！'));
        }
    }
    
    /**
     * 删除订单
     * @param id int 订单id*/
    public function deleteOrder(){
        if(IS_AJAX){
            
            $id = I('post.id');
            $userId = A('Public')->isLogin();
            
            if($id == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择要取消的订单！'));
            }
            
            $w['userId'] = $userId;
            $w['id'] = $id;
            $flag = M('order')->where($w)->find();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '订单不存在！'));
            }
            
            $res = M('order')->where($w)->delete();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，删除失败！'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功！'));
        }
    }
    
    /**
     * 选择订单时显示选择的个数和订单总价格
     * @param orderIdList string 订单id(多个订单以,号连接)*/
    public function showGoodsOrder(){
        if(IS_AJAX){
            $orderIdList = I('post.orderIdList');
            if($orderIdList == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择要付款的订单'));
            }
            $w['id'] = array('in',$orderIdList);
            $count = M('order')->where($w)->count();
            $price = M('order')->field('payAmount')->where($w)->select();
            $allPrcie = 0;
            foreach($price as $k => $v){
                $allPrcie += $v['payamount'];
            } 
            
            $data['count'] = $count;//选择订单的数量
            $data['allPrcie'] = $allPrcie;//订单应付总金额
            
            echo json_encode($data);
        }    
    }
    
    /**
     * 收货地址省市区联动
     * @param id int 省id*/
    public function areaList(){
        if(IS_AJAX){
            $provinceId = I('post.provinceId');
            $cityId = I('post.cityId');
            
            //获取省
            $w['tree_path'] = ",";
            $provinceList = M('area')->field('id,name')->where($w)->select();//省列表

            $wh['parent_id'] = $provinceId;
            $cityList = M('area')->field('id,name,tree_path,parent_id')->where($wh)->select();//省下面的市列表

            if($cityId != 0){
                $where['parent_id'] = $cityId;
                $zoneList = M('area')->field('id,name,tree_path,parent_id')->where($where)->select();//市下面的区列表
            }
            
            $list['province'] = $provinceList;
            $list['city'] = $cityList;
            $list['zone'] = $zoneList == empty($zoneList) ? false : $zoneList;
            
            echo json_encode($list);
        }
    }
    
    /**
     * 添加收货地址
     * */
    public function addAddress(){
        $this->display('address');
    }
    
    /**
     * ajax操作添加收货地址
     * @param name string 收货人
     * @param phone int 手机号
     * @param areaId int 省id
     * @param cityId int 市id
     * @param zoneId int 区id
     * @param address text 详细地址(除省市区)
     * @param zipCode int 邮编
     * @param isDefault int 是否默认收货地址(0：不默认  1：默认)*/
    public function addAddressAjax(){
        if(IS_AJAX){
            $name = I('post.name');
            $phone = I('post.phone');
            $areaId = I('post.areaId');
            $cityId = I('post.cityId');
            $zoneId = I('post.zoneId');
            $address = I('post.address');
            $zipCode = I('post.zipCode');
            $isDefault = I('post.isDefault');

            $userId = A('Public')->isLogin();
            
            if($name == ''){
				$this->ajaxReturn($this->errmsg(10001, '收货人不能为空！'));
			}
			
			if($phone == '' || is_numeric($phone) == false){
			    $this->ajaxReturn($this->errmsg(10001, '请输入正确的联系电话！'));
			}
			
			if($address == ''){
			    $this->ajaxReturn($this->errmsg(10001, '请填写详细地址！'));
			}
			
			if($zipCode == ''){
			    $this->ajaxReturn($this->errmsg(10001, '请填写邮编！'));
			}
			
			if(!is_numeric($zipCode)){
			    $this->ajaxReturn($this->errmsg(10001, '邮编格式错误！'));
			}
            
            if($zoneId == 0 || $zoneId == ''){
                $w['id'] = $cityId;
                $treePath = M('area')->field('full_name,tree_path')->where($w)->find();
            }else{
                $w['id'] = $zoneId;
                $treePath = M('area')->field('full_name,tree_path')->where($w)->find();
            }

            $add['userId'] = $userId;
            $add['name'] = $name;
            $add['phone'] = $phone;
            $add['areaId'] = $areaId;
            $add['areaName'] = $treePath['full_name'];
            $add['areaTreePath'] = $treePath['tree_path'];
            $add['address'] = $address;
            $add['zipCode'] = $zipCode;
            $add['isDefault'] = $isDefault;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            
            //最多只能新增5条收货地址
            $where['userId'] = $userId;
            $count = M('user_ship_address')->where($where)->count();

            if($count >= 5){
                $this->ajaxReturn($this->errmsg(10001, '最多只能新增5条收货地址哟！'));
            }else{
                $res = M('user_ship_address')->add($add);
                if($res){
                    //新增成功，如果新增的是设置为默认地址，则改变其他的地址全部为不默认
                    if($isDefault == 1){
                        $sql = "update hwh_user_ship_address set isDefault = 0 where userId = $userId and id != $res";
                        M()->execute($sql);
                    }
                    $this->ajaxReturn($this->errmsg(10000, '新增成功'));
                }else{
                    $this->ajaxReturn($this->errmsg(10001, '新增失败'));
                }
            }
        }

    }
    
    /**
     * 收货地址列表
     * 实时更新*/
    public function myAddressListAjax(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            $w['userId'] = $userId;
            $list = M('user_ship_address')->where($w)->select();
            
            $count = M('user_ship_address')->where($w)->count();
            
            $data['list'] = $list;//收货地址列表
            $data['count'] = $count;//已添加的地址条数
            echo json_encode($data);
        } 
    }
    
    /**
     * 删除收货地址
     * @param id int 收货地址id*/
    public function deleteAddress(){
        if(IS_AJAX){
            $id = I('post.id');
            $userId = A('Public')->isLogin();
            $w['id'] = $id;
            $w['userId'] = $userId;
            $flag = M('user_ship_address')->where($w)->delete();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 编辑收货地址
     * @param id int 收货地址id*/
    public function editAddress(){
        if(IS_AJAX){
            $id = I('post.id');
            $name = I('post.name');
            $phone = I('post.phone');
            $areaId = I('post.areaId');
            $cityId = I('post.cityId');
            $zoneId = I('post.zoneId');
            $address = I('post.address');
            $zipCode = I('post.zipCode');
            $isDefault = I('post.isDefault');

            $userId = A('Public')->isLogin();
            
            if($zoneId == 0 || $zoneId == ''){
                $w['parent_id'] = $areaId;
                $treePath = M('area')->field('full_name,tree_path')->where($w)->find();
            }else{
                $w['parent_id'] = $zoneId;
                $treePath = M('area')->field('full_name,tree_path')->where($w)->find();
            }
            
            $wh['id'] = $id;
            $d['userId'] = $userId;
            $d['name'] = $name;
            $d['phone'] = $phone;
            $d['areaId'] = $areaId;
            $d['areaName'] = $treePath['full_name'];
            $d['areaTreePath'] = $treePath['tree_path'];
            $d['address'] = $address;
            $d['zipCode'] = $zipCode;
            $d['isDefault'] = $isDefault;
            $d['updateDate'] = date('Y-m-d H:i:s',time());
            
            $res = M('user_ship_address')->where($wh)->save($d);
            if($res){
                //编辑成功，如果编辑的是设置为默认地址，则改变其他的地址全部为不默认
                if($isDefault == 1){
                    $sql = "update hwh_user_ship_address set isDefault = 0 where userId = $userId and id != $id";
                    M()->execute($sql);
                }
                $this->ajaxReturn($this->errmsg(10000, '编辑成功'));
            }
            
            $this->ajaxReturn($this->errmsg(10001, '编辑失败'));
        }
        
        $id = I('get.id');
        $userId = A('Public')->isLogin();
        $where['id'] = $id;
        $where['userId'] = $userId;
        $info = M('user_ship_address')->where($where)->find();
        
        $this->assign('info',$info);
        $this->display('addressEdit');
    }

    /**
     * 设为默认收货地址
     * @param id int 地址id*/
    public function changeDefault(){
        if(IS_AJAX){
            $id = I('post.id');
            $userId = A('Public')->isLogin();
            
            $w['id'] = $id;
            $w['userId'] = $userId;
            $d['isDefault'] = 1;
            $flag = M('user_ship_address')->where($w)->save($d);
            if($flag){
                //设置成功时，其他的地址全部设置为不默认
                $sql = "update hwh_user_ship_address set isDefault = 0 where userId = $userId and id != $id";
                M()->execute($sql);
            }
        }
    }
    
    /**
     * 我的购物车列表*/
    public function myCartList(){
        if(IS_AJAX){
            $uid = A('Public')->isLogin();
            $w['userId'] = $uid;
            $list = M('goods_cart')->field('id as cartId,goodsNum,amount,attrValue1,attrValue2,isok,createDate')->where($w)->select();
            foreach($list as $k => $v){
                $where['goodsId'] = $v['goodsid'];
                $list[$k]['goodsInfo'] = M('goods')->field('id,name,img,description,price,unitName')->where($where)->find();
            }
    
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
    
        $this->display('cartList');
    }
    
    /**
     * 我的消费记录*/
    public function myPayLogList(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            $where['l.userId'] = $userId;
            $list = M('user_pay_log l')
                    ->field('l.*,o.orderNo')
                    ->join('__ORDER__ o on o.id = l.orderId','left')
                    ->where($where)
                    ->select();
            
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);
            exit;
        }
        
        $this->display('payLogList');
    }
    
    /**
     * 消费记录详情
     * @param id int 消费记录id*/
    public function payLogDetail(){
        $id = I('get.id');
        $where['l.id'] = $id;
        $list = M('user_pay_log l')
                ->field('i.*,g.name')
                ->join('__ORDER__ o on o.id = l.orderId','left')
                ->join('__ORDER_ITEM__ i on i.orderId = o.id','left')
                ->join('__GOODS__ g on g.id = i.goodsId')
                ->where($where)
                ->select();
        $totalAmount = 0;
        foreach($list as $k => $v){
            if($v['attrvalue2'] == ''){
                $list[$k]['attrvalue'] = $v['attrvalue1'];
            }else{
                $list[$k]['attrvalue'] = $v['attrvalue1'].'-'.$v['attrvalue2'];
            }
            
            $totalAmount += $v['amount'];
        }
        
        $this->assign('list',$list);
        $this->assign('totalAmount',$totalAmount);//总消费金额
        $this->display();
    }
    
    /**
     * 收藏商品
     * @param id int 商品id*/
    public function addCollect(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            $goodsId = I('post.id');
            
            $add['userId'] = $userId;
            $add['goodsId'] = $goodsId;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $res = M('goods_collect')->add($add);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '收藏失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '收藏成功'));
        }
    }
    
    /**
     * 商品收藏列表*/
    public function myCollectList(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            $w['c.userId'] = $userId;
            $list = M('goods_collect c')
                    ->field('c.*,g.name,g.img,g.price')
                    ->join('__GOODS__ g on g.id = c.goodsId ','left')
                    ->where($w)
                    ->select();
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
        
        $this->display('collectList');
    }
    
    /**
     * 删除商品收藏
     * @param id int 收藏id*/
    public function deleteCollect(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            $id = I('post.id');
            $w['userId'] = $userId;
            $w['goodsId'] = $id;
            $flag = M('goods_collect')->where($w)->delete();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 评价商品
     * get请求获取相对应的商品信息
     * @param id int 订单id 
     * post请求提交商品评论
     * @param orderId int 订单id
     * @param goodsIdStr string 商品id（多个商品之间以,号连接）
     * @param goodsContentStr string 商品评论内容（多个商品评论内容之间以,号连接）
     * @param goodsTypeStr string 评论类型（多个类型之间以,号连接）*/
    public function goodsComment(){
        if(IS_AJAX){
            $userId = A('Public')->isLogin();
            
            //接收参数
            $orderId = I('post.orderId');
            $goodsIdStr = I('post.goodsIdStr');
            $goodsContentStr = I('post.goodsContentStr');
            $goodsTypeStr = I('post.goodsTypeStr');
            
            //分解参数
            $goodsId = explode(',', $goodsIdStr);
            $goodsType = explode(',', $goodsTypeStr);
            $goodsContent = explode(',', $goodsContentStr);
            
            //判断，当有多个商品需要评论时，评论类型也必须是多个，评论内容也不能为空
            if(count($goodsId) > 1){
                foreach($goodsId as $k => $v){
                    if($goodsType[$k] == ''){
                        $this->ajaxReturn($this->errmsg(10001, '请选择评论等级！'));
                    }
                    if($goodsContent[$k] == ''){
                        $this->ajaxReturn($this->errmsg(10001, '评论内容不能为空！'));
                    }
                }
            }
            
            //遍历插入评论内容表评论表
            foreach($goodsId as $k => $v){
                $type = $goodsType[$k];
                $content = $goodsContent[$k];
                
                $add['userId'] = $userId;
                $add['goodsId'] = $v;
                $add['type'] = $type;
                $add['content'] = $content;
                $add['createDate'] = date('Y-m-d H:i:s',time());
                
                M('goods_comment')->add($add);
            }
            
            //评论成功，改变订单的评论状态为已评论
            $w['userId'] = $userId;
            $w['id'] = $orderId;
            $d['isComment'] = 2;
            M('order')->where($w)->save($d);
            
            $this->ajaxReturn($this->errmsg(10000, '评论成功！'));exit;
        }
        
        $id = I('get.id');
        $list = M('order_item i')
            ->field('i.orderId,i.goodsId,i.goodsNum,i.price,i.amount,i.attrValue1,i.attrValue2,g.name,g.img')
            ->join('__GOODS__ g on g.id = i.goodsId')
            ->where('i.orderId='.$id)
            ->select();
        foreach($list as $k => $v){
            if($v['attrvalue2'] != ''){
                $list[$k]['attrvalue'] = $v['attrvalue1'].','.$v['attrvalue2'];
            }else{
                $list[$k]['attrvalue'] = $v['attrvalue1'];
            }
            unset($list[$k]['attrvalue1'],$list[$k]['attrvalue2']);
            
            $orderId = $v['orderid'];
        }

        $this->assign('list',$list);
        $this->assign('orderId',$orderId);//订单id
        $this->display('goodsComment');
    }

}