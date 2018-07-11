<?php
namespace Home\Controller;
use Think\Controller;

class RedisController extends Controller
{
    /**
     * 连接redis*/
    public function redis()
    {
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        return $redis;
    }
    
    /**
     * 模拟抢购页面*/
    public function goodsCate()
    {
        $redis = $this->redis();

        $userId = session('id');

        //假设该商品有10件库存
        $goodsNum = 10;

        $redis->lPush("goodsStore", $userId);//追加
        
        //获取列表中所有的值
        //$list = $redis->lrange('goodsStore', 0, -1);
        //var_dump($list);
        
        $count = $redis->lLen("goodsStore");
        if($count){}
    }
    
    public function index()
    {
        $price=10;
        $user_id=1;
        $goods_id=12;
        $sku_id=11;
        $number=1;

        //模拟下单操作
        //下单前判断redis队列库存量
        $redis = $this->redis();
        $count = $redis->lpop('goods_store');//移除并返回列表 key 的头元素。
        
        if(!$count){
            $this->insertLog('error:no store redis');
            return;
        }
        
        $order_sn = $this->build_order_no();//生成订单
        
        $add['userId']    = $user_id;
        $add['goodsId']   = $goods_id;
        $add['goodsNum']  = $number;
        $add['amount']    = 100;
        $add['createDate']= date('Y-m-d H:i:s',time());
        M('goods_cart')->add($add);
        
        //库存减少
        $sql = "update hwh_goods_store set stock = stock - {$number} where goodsId = {$goods_id}";
        $res = M()->query($sql);
        if($res >= 1)
        {
            $this->insertLog('库存减少成功');
        }
        else
        {
            $this->insertLog('库存减少失败');
        }
    }
    
    //生成唯一订单
    public function build_order_no()
    {
        return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    
    //记录日志
    public function insertLog($event)
    {
        $add['event'] = $event;
        $add['createDate'] = date('Y-m-d H:i:s', time());
        M('goods_log')->add($add);
    }
    
}