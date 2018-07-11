<?php
namespace Home\Controller;
use Think\Controller;

class YuluController extends Controller {
    
    private $isMobile;
    
    public function __construct(){
        parent::__construct();
        $this->isMobile = A('IsMobile')->isMobile();
    }
    
    private function errmsg($errno,$errmsg,$result=''){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg,
            'result'=> $result
        );
        return $array;
    }
    
    public function index(){
        
        $this->display();
    }
    
    public function a()
    {
        $this->display();
    }
    
    public function b()
    {
        $sql = "SELECT * FROM g_order WHERE DATE_FORMAT( createDate, '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' );";
    }
    
    /**
     * 活动倒计时
     * */
    public function daojishi()
    {
        if(IS_AJAX)
        {
            // 注意：php的时间是以秒算。js的时间以毫秒算
            date_default_timezone_set('PRC');// 设置时区
            //配置每天的活动时间段
            $starttimestr = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));//开始时间
            $endtimestr = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime('+1 day'))));//结束时间
            $starttimestr = date('Y-m-d H:i:s', strtotime(date('2018-3-1 17:31')));
            $endtimestr = date('Y-m-d H:i:s', strtotime(date('2018-3-8 17:59')));
            
            $starttime = strtotime($starttimestr);//开始时间戳
            $endtime = strtotime($endtimestr);//结束时间戳
            $nowtime = time();//当前时间戳
            if ($nowtime < $starttime)
            {
                $d['errno'] = "10001";
                $d['errmsg']= "活动还没开始,活动时间是：{$starttimestr}至{$endtimestr}";
                $d['lefttime']= -1;
            }
            else if ($endtime >= $nowtime)
            {
                $lefttime = $endtime - $nowtime; //实际剩下的时间（秒）
                $d['errno'] = "10000";
                $d['errmsg']= "活动进行中";
                $d['lefttime']= $lefttime;
            } 
            else if($endtime < $nowtime)
            {
                $d['errno'] = "10002";
                $d['errmsg']= "活动已经结束！";
                $d['lefttime']= 0;
            }
            
            $d['starttimestr'] = $starttimestr;
            $d['endtimestr']   = $endtimestr;
            
            echo json_encode($d);
            exit;
        }
    }
    
    /**
     * 商品秒杀
     * 使用redis队列
     * 先实现抢购,加入到订单,抢购成功之后再去提示用户进行付款,这样就减轻了压力*/
    public function miaosha() 
    {
        $info = M('goods g')
        ->field('g.*, s.stock')
        ->join('__GOODS_STORE__ s on s.goodsId = g.id', 'LEFT')
        ->find();
        
        if(IS_AJAX)
        {
            //$userId  = session('id');//用户id
            $userId = 11;
            $goodsId = $info['id'];//商品id
            $store   = $info['stock'];//商品库存
            $price   = $info['price'];//商品价格
            $num     = 1;//商品数量(限制只能抢购一个)
            
            //查看该用户是否已经抢购了该商品
            $m['userId'] = $userId;
            $m['remake'] = $goodsId;
            $res = M('order')->where($m)->find();
            if($res)
            {
                $this->ajaxReturn($this->errmsg(10001, '你已经抢购了该商品'));
            }
            
            //连接本地的 Redis 服务
            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);
            
            $length = $redis->llen('goods_store');//返回列表的长度
            $count  = $store - $length;//商品剩余库存
            if ( $count <= 0 )
            {
                $this->ajaxReturn($this->errmsg(10001, '商品已被抢光'));
            }
            
            $redis->lPush('goods_store',1);//将一个或多个值插入到列表头部
            
            //echo $redis->llen('goods_store');
            //生成唯一订单
            $orderNo = $this->build_order_no();
            
            //查询出用户默认收货地址(如果没有则先定义为0)
            $addressId = 0;
            $userAddress = M('user_ship_address')->field('id')->where('isDefault=1 and userId='.$userId)->find();
            if ($userAddress != null)
            {
                $addressId = $userAddress['id'];
            }
            
            //插入到订单表
            $add['userId'] = $userId;
            $add['orderNo']= $orderNo;
            $add['totalAmount'] = $price * $num;
            $add['payAmount'] = $price * $num;
            $add['shipAdressId'] = $addressId;
            $add['createDate'] = date('Y-m-d H:i:s', time());
            $add['remake'] = $goodsId;
            $res = M('order')->add($add);
            if($res <= 0)
            {
                $this->ajaxReturn($this->errmsg(10001, '抢购失败！'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '抢购成功!'));
        }
        
        $this->assign('info', $info);
        $this->display();
    }
    
    /**
     * 生成唯一订单号*/
    public function build_order_no()
    {
        return date('ymd').substr(implode(NULL, array_map('hwh', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    
    /**
     * 语录列表  */
    /* 
    public function yuluList(){

        $author = trim($_POST['author']);
        $keywords = trim($_POST['keywords']);
        
        if($author != ''){
            $where['author'] = array('like','%'.$author.'%');
        }
        
        if($keywords != ''){
            $where['content'] = array('like','%'.$keywords.'%');
        }
        
        $where['is_ok'] = 1;    //审核通过才显示
        
        $count = M('yulu')->where($where)->count();// 查询满足要求的总记录数
        $Page  = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        
        $list = M('yulu')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($list as $k => $v){
            $list[$k]['maketime'] = date('Y-m-d H:i:s',$v['maketime']);
        }
        
        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display('list');
    } */
    
    public function yuluList(){
        A('Qq')->qqurl();//QQ登录入口
        
        $isMobile = $this->isMobile;
        if($isMobile == true)
        {
            //手机端浏览
            $this->display('YuluSj/listYulu2');
            exit;
        }
        
        $this->display('listYulu2');
    }
    
    /**
     * ajax无刷新显示语录列表  */
    public function yuluListAjax(){
    
        if(IS_AJAX){
            //搜索条件
            $author = trim($_POST['author']);
            $datetime1 = trim($_POST['datetime1']);
            $datetime2 = trim($_POST['datetime2']);
            
            $datetime1 = strtotime($datetime1);
            $datetime2 = strtotime($datetime2);
            //容错处理，以免用户随意选择之后报错
            if($datetime2 != ''){
                if($datetime1 > $datetime2){
                    $a = $datetime1;
                    $datetime1 = $datetime2;
                    $datetime2 = $a;
                }
            }
            
            if($datetime1 != '' && $datetime2 == ''){
                $where['maketime'] = array('EGT',$datetime1);
            }
            
            if($datetime1 == '' && $datetime2 != ''){
                $datetime2 += 86400;    //加1天，这样就可以查出当天的选择日期了
                $where['maketime'] = array('ELT',$datetime2);
            }
            
            if($datetime1 != '' && $datetime2 != ''){
                $datetime2 += 86400;
                $where['maketime'] = array('BETWEEN',array($datetime1,$datetime2));
            }
    
            if($author != ''){
                $where['author'] = array('like','%'.$author.'%');
            }
    
            $where['is_ok'] = 1;
    
            //总记录数   每页数   总页数
            $count = M('yulu')->where($where)->count();
            
            $isMobile = $this->isMobile;
            if($isMobile == true)
            {
                //手机端浏览
                $pageSize = 3;
            }
            else
            {
                $pageSize = 5;
            }
            
            $totalPage = ceil($count/$pageSize);
    
            //当前页   起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){ //输入跳转页数
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            }
            
            $startRow = $pageSize*($currPage-1);
    
            $list = M('yulu')->field(true)->limit($startRow.','.$pageSize)->order('id desc')->where($where)->select();
            foreach($list as $k => $v){
                $list[$k]['maketime'] = date('Y-m-d',strtotime($v['maketime']));
            }
            
            $data['count'] = $count;
            $data['currPage'] = $currPage;
            $data['total_page']= $totalPage;
            $data['list'] = $list;
    
            echo json_encode($data);
    
        }
    }
    
    /**
     * 点赞  */
    public function likes(){
        if(IS_AJAX){
           $uid = session('id');    //用户ID
           $yid = $_POST['id'];     //语录ID
           
           if(!$uid){
               $uid = $_SERVER['REMOTE_ADDR'];  //游客IP地址
           }

           $sql = "select id from hwh_yulu_like where TO_DAYS(create_date) = TO_DAYS(now()) and uid = '$uid' and yulu_id = $yid";

           $res = M()->query($sql);

           if($res){
               $this->ajaxReturn($this->errmsg(10001, '今天已点赞，明天再来吧'));
           }
           
           $data['uid'] = $uid;
           $data['yulu_id'] = $yid;
           $data['create_date'] = date('Y-m-d H:i:s',time());
           $info = M('yulu_like')->add($data);

           if($info){
               $sql2 = "update hwh_yulu set like_count = (CASE WHEN like_count IS NULL THEN 1 ELSE like_count + 1 END) where id = $yid";
               M()->execute($sql2); //写操作用execute()方法    读操作用query()方法
               
               $this->ajaxReturn($this->errmsg(10000, '点赞+1'));
           }else{
               $this->ajaxReturn($this->errmsg(10001, '点赞失败'));
           }
        }
    }
    
    /**
     * 用户新增语录  */
    public function addYulu(){
        if(IS_AJAX){
            $uid = session('id');
            if(!$uid){
                $this->ajaxReturn($this->errmsg(10001, '请先登录后再来发表哟！'));
            }
            
            /*$info = M('user')->where('id='.$uid)->find();
            $author = $info['nickname'];
            $img = $info['u_img'];*/
            $sql = "select u.nickname,u.u_img,u.login_way,q.qq_nickname,q.qq_img from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = $uid";
            $info = M()->query($sql);
            $author = $info[0]['login_way'] == 1 ? $info[0]['qq_nickname'] : $info[0]['nickname'];
            $img = $info[0]['login_way'] == 1 ? $info[0]['qq_img'] : $info[0]['u_img'];
            
            $content = trim($_POST['content']);
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10001, '内容不能为空'));
            }
            
            $add['uid'] = $uid;
            $add['uid_type'] = 2;   //2用户发表  1为后台管理员发表
            $add['content'] = $content;
            $add['author'] = $author;
            $add['img'] = $img;
            $add['maketime'] = date('Y-m-d H:i:s',time());
            
            $res = M('yulu')->add($add);
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '新增成功，审核通过之后既可显示'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '新增失败'));
            }
        }
    }
    
    
    
}