<?php
namespace Home\Controller;
use Think\Controller;

class JokeController extends Controller {
    
    private $isMobile;
    
    public function __construct(){
        parent::__construct();
        $this->isMobile = A('IsMobile')->isMobile();
    }
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 新增幽默笑话*/
    public function addJoke(){
        if(IS_AJAX){
            //接收参数
            $content = trim($_POST['content']);
            $id = session('id');
            if(!$id){
                $this->ajaxReturn($this->errmsg(10001, '请先登录后再来发表哟!'));
            }
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10001, '内容不能为空!'));
            }

            //$info = M('user')->field('nickname,u_img')->where('id='.$id)->find();
            $sql = "select u.nickname,u.u_img,u.login_way,q.qq_nickname,q.qq_img from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = $id";
            $info = M()->query($sql);
            $author = $info[0]['login_way'] == 1 ? $info[0]['qq_nickname'] : $info[0]['nickname'];
            $img = $info[0]['login_way'] == 1 ? $info[0]['qq_img'] : $info[0]['u_img'];
            
            $add['uid'] = $id;
            $add['uid_type'] = 2;   //2用户发表  1为后台管理员发表
            $add['author'] = $author;
            $add['img'] = $img;
            $add['content']= $content;
            $add['maketime'] = date('Y-m-d H:i:s',time());
            
            $res = M('joke')->add($add);
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '新增成功，审核通过之后既可显示!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '新增失败!'));
            }
        }
    }
    
    /**
     * 幽默笑话列表*/
    public function listJoke(){
        A('Qq')->qqurl();//QQ登录入口
        
        $isMobile = $this->isMobile;
        if($isMobile == true)
        {
            //手机端浏览
            $this->display('JokeSj/listJoke2');
            exit;
        }
        
        $this->display('listJoke2');
    }
    
    /**
     * ajax无刷新显示幽默笑话列表*/
    public function ajaxListJoke(){
        if(IS_AJAX){
            //接收参数
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
            
            $count = M('joke')->where($where)->count();
            
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
            
            //当前页  起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){ //输入跳转页数
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{  //点击上一页下一页
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ( $currPage>=1 && $currPage<=$totalPage) ? $currPage : 1;
            }
            
            $stateRow = ($currPage-1)*$pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }

            $list = M('joke')->field('id,author,img,content,like_count,maketime')->where($where)->order('maketime desc')->limit($stateRow.','.$pageSize)->select();
            foreach($list as $k => $v){
                $list[$k]['maketime'] = date('Y-m-d',strtotime($v['maketime']));
            }
            
            $d['count'] = $count;   //总记录数
            $d['currPage'] = $currPage;//当前页
            $d['total_page']= $totalPage;//总页数
            $d['list'] = empty($list) ? false : $list;
            //var_dump($list);exit;
            
            echo json_encode($d);
        }
    }
    
    /**
     * 点赞  */
    public function likes(){
        if(IS_AJAX){
            $uid = session('id');    //用户ID
            $jid = $_POST['id'];     //语录ID
             
            if(!$uid){
                $uid = $_SERVER['REMOTE_ADDR'];  //游客IP地址
            }
            
            //sql语句时间相关语句
            //FROM_UNIXTIME(create_date, '%Y-%m-%d %H:%i:%S')   将时间戳转换成日期形式
            //curdate() 获取当前日期 如2017-04-10
            //now() 获取当前系统时间   如2017-04-10 11:29:35
            $sql = "select id from hwh_joke_like where FROM_UNIXTIME(create_date, '%Y-%m-%d') = curdate() and uid = '$uid' and joke_id = $jid";

            $res = M()->query($sql);
            //echo M()->getLastSql();exit;
            
            if($res){
                $this->ajaxReturn($this->errmsg(10001, '今天已点赞，明天再来吧'));
            }
             
            if($uid){
                $data['uid'] = $uid;
            }else{
                $data['uid'] = $_SERVER['REMOTE_ADDR'];
            }
    
            $data['joke_id'] = $jid;
            $data['create_date'] = date('Y-m-d H:i:s',time());
            $info = M('joke_like')->add($data);
    
            if($info){
                $sql2 = "update hwh_joke set like_count = (CASE WHEN like_count IS NULL THEN 1 ELSE like_count + 1 END) where id = $jid";
                M()->execute($sql2); //写操作用execute()方法    读操作用query()方法
                 
                $this->ajaxReturn($this->errmsg(10000, '点赞+1'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '点赞失败'));
            }
        }
    }
}