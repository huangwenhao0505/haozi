<?php
namespace Admin\Controller;
use Think\Controller;

class OrderController extends Controller {
    
    public function errmsg($errno, $errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 订单列表
     * */
    public function orderList(){
        if(IS_AJAX){
            $list = M('order o')
                    ->field('o.*,s.name,s.phone,s.areaName,s.address')
                    ->join('__USER_SHIP_ADDRESS__ s on s.id = o.shipAdressId','left')
                    ->select();
            
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
        
        $this->display('orderList');
    }
    
    /**
     * 查看订单详情
     * @param orderId int 订单id*/
    public function orderDetail(){
        $orderId = I('get.orderId');
        $where['o.id'] = $orderId;
        $info = M('order o')
            ->field('o.*,s.name,s.phone,s.areaName,s.address')
            ->join('__USER_SHIP_ADDRESS__ s on s.id = o.shipAdressId','left')
            ->where($where)
            ->find();
        
        $w['i.orderId'] = $orderId;
        $info['detail'] = M('order_item i')
            ->field('i.price,i.goodsNum,i.amount,i.attrValue1,i.attrValue2,g.name,g.img,g.attrNameList')
            ->join('__GOODS__ g on g.id = i.goodsId','left')
            ->where($w)
            ->select();
        foreach($info['detail'] as $k => $v){
            $attrname = explode(',', $v['attrnamelist']);
            if($attrname[1] != ''){
                $arr = array(
                    $attrname[0].'：'.$v['attrvalue1'],
                    $attrname[1].'：'.$v['attrvalue2']
                );
            }else{
                $arr = array(
                    $attrname[0].'：'.$v['attrvalue1']
                );
            }
                
            $info['detail'][$k]['attrlist'] = $arr;
        }

        $this->assign('info',$info);

        $this->display('orderDetail');
    }
    
    /**
     * 删除订单
     * @param orderId int 订单id*/
    public function orderDelete(){
        if(IS_AJAX){
            $orderId = I('post.orderId');
            $w['id'] = $orderId;
            $flag = M('order')->where($w)->delete();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            
            //删除成功，则删除订单详细表的该订单相关信息
            $where['orderId'] = $orderId;
            M('order_item')->where($where)->delete();
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
}