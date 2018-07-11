<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 留言类*/
class MessageController extends Controller {
    
    Public function __construct(){
        parent::__construct();
        //A('IsMobile')->getIsMobile();//判断是否是手机端浏览
        $this->A_login = A('Login');
        $this->A_login->checkLogin();
    }
    
    /**
	 * 返回错误信息
	 * @param unknown $errno
	 * @param unknown $errmsg
	 * @return multitype:unknown  */
	private function errmsg($errno,$errmsg){
		$array = array(
			'errno' => $errno,
			'errmsg'=> $errmsg
		);
		return $array;
	}
    
	/**
	 * 留言*/
    public function message(){
        if(IS_AJAX){
            $uid = session('id');   //留言id
            $user_id = $_POST['user_id'];//被留言id
            
            if($uid == $user_id){
                $this->ajaxReturn($this->errmsg(10001, '自己不能给自己留言！'));
            }
            
            $content = trim($_POST['content']);
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10001, '留言内容不能为空！'));
            }
            
            $add['uid'] = $uid;
            $add['user_id'] = $user_id;
            $add['content'] = $content;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $info = M('user_message')->add($add);   //$info为刚插入数据的id值
            
            if($info){
                $sql2 = "update hwh_user_message set top_protect_id = $info where uid = $uid and user_id = $user_id and id = $info";
                M()->execute($sql2);
                $this->ajaxReturn($this->errmsg(10000, '留言成功！'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '留言失败！'));
            }
        }
    }
    
    /**
     * 回复留言*/
    public function replyMessage(){
        //当访问该方法时，就说明用户已经看到了留言消息，改变其留言状态为已读
        $protect_id = $_POST['protect_id'];//回复消息id
        $sql = "update hwh_user_message set state = 1 where id = $protect_id";
        M()->execute($sql);
        
        $sq = "select top_protect_id as id from hwh_user_message where id = $protect_id";
        $topId = M()->query($sq);
        $topProtectId = $topId[0][id];
        
        $uid = session('id');   //回复人的Id
        $user_id = $_POST['id'];//被回复人的id
        $content = trim($_POST['content']);
        
        if($uid == $user_id){
            $this->ajaxReturn($this->errmsg(10001, '自己不能给自己留言！'));
        }
        
        if($content == ''){
            $this->ajaxReturn($this->errmsg(10001, '留言内容不能为空！'));
        }
        
        $add['uid'] = $uid;
        $add['user_id'] = $user_id;
        $add['protect_id'] = $protect_id;
        $add['content'] = $content;
        $add['top_protect_id'] = $topProtectId;
        $add['createDate'] = date('Y-m-d H:i:s',time());
        $info = M('user_message')->add($add);
        if($info){
            $this->ajaxReturn($this->errmsg(10000, '留言成功！'));
        }else{
            $this->ajaxReturn($this->errmsg(10001, '留言失败！'));
        }
    }
    
    /**
     * 新的留言消息改变状态为已读*/
    public function changeMessage(){
        //当访问该方法时，就说明用户已经看到了留言消息，改变其留言状态为已读
        $protect_id = $_POST['protect_id'];//回复消息id
        $sql = "update hwh_user_message set state = 1 where id = $protect_id";
        M()->execute($sql);
    }
    
    /**
     * 留言消息第一次显示通知
     * 点击查看消息之后，以后则不显示通知*/
    public function showOneMessageCount(){
        $uid = session('id');
        
        $sql = "select count(id) as id from hwh_user_message where user_id = $uid and state = 0";
        $counts = M()->query($sql);
        $count = $counts[0][id];
        return $count;
    }
    
    /**
     * 未查看的留言列表*/
    public function showMessageList(){
        $uid = session("id");
        
        $sql = "select m.*,u.username,u.nickname,u.u_img,u.login_way,q.qq_nickname,q.qq_img 
        from hwh_user u 
        left join hwh_user_message m on m.uid = u.id 
        left join hwh_user_qq q on q.qq_openid = u.qq_openid
        where m.user_id = $uid and m.state = 0";
        $list = M()->query($sql);
        foreach($list as $k => $v){
            //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
            $list[$k]['username'] = $v['login_way'] == 1 ? $v['qq_nickname'] : ($v['nickname'] == '' ? $v['username'] : $v['nickname']);
            $list[$k]['u_img'] = $v['login_way'] == 1 ? $v['qq_img'] : $v['u_img'];
        }
        return $list;
    }
    
    /**
     * 已查看过的留言列表*/
    public function messageList(){
        $uid = session("id");
    
        //protect_id=0 条件是为了筛选出有顶级留言的那条 （既给别人留言的人，留言信息将不显示在自己最近留言列表上）
        $sql = "select m.*,u.username,u.nickname,u.u_img,u.login_way,q.qq_nickname,q.qq_img 
        from hwh_user u 
        left join hwh_user_message m on m.uid = u.id 
        left join hwh_user_qq q on q.qq_openid = u.qq_openid
        where m.user_id = $uid and m.state = 1 and protect_id = 0";
        $list = M()->query($sql);
        foreach($list as $k => $v){
            //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
            $list[$k]['username'] = $v['login_way'] == 1 ? $v['qq_nickname'] : ($v['nickname'] == '' ? $v['username'] : $v['nickname']);
            $list[$k]['u_img'] = $v['login_way'] == 1 ? $v['qq_img'] : $v['u_img'];
            
            //留言下面对应的回复内容
            $sql = "select m.*,u.username,u.nickname,u.u_img,u.login_way,q.qq_nickname,q.qq_img 
            from hwh_user u 
            left join hwh_user_message m on m.uid = u.id 
            left join hwh_user_qq q on q.qq_openid = u.qq_openid
            where m.top_protect_id = {$v['id']} and protect_id != 0";
            $list[$k]['twoList'] = M()->query($sql);
            foreach($list[$k]['twoList'] as $key => $val){
                if($uid == $val['uid']){    //是自己回复的内容
                    $list[$k]['twoList'][$key]['mySelf'] = 1;
                }else{
                    $list[$k]['twoList'][$key]['mySelf'] = 0;
                }
                
                //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
                $list[$k]['twoList'][$key]['username'] = $val['login_way'] == 1 ? $val['qq_nickname'] : ($val['nickname'] == '' ? $val['username'] : $val['nickname']);
                $list[$k]['twoList'][$key]['u_img'] = $val['login_way'] == 1 ? $val['qq_img'] : $val['u_img'];
            }
            
        }
        return $list;
    }
    
    /**
     * ajax无刷新显示留言列表*/
    public function messageAllListAjax(){
        $uid = session('id');
        if(IS_AJAX){
            $where['user_id'] = $uid;
            //总记录  每页显示数  总页数
            $count = M('user_message')->where($where)->count();
            $pageSize = 10;
            $totalPage = ceil($count/$pageSize);
            
            //当前页  起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){  //输入跳转页数
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{  //点击上一页下一页
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            }
            
            $startPage= ($currPage-1)*$pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            $sql = "select m.*,u.username,u.nickname,u.u_img,u.login_way,q.qq_img,q.qq_nickname
            from hwh_user u
            left join hwh_user_message m on m.uid = u.id
            left join hwh_user_qq q on q.qq_openid = u.qq_openid
            where m.user_id = $uid and protect_id = 0 order by m.state,m.createDate desc limit $startPage,$pageSize";
            $list = M()->query($sql);
            foreach($list as $k => $v){
                //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
                $list[$k]['username'] = $v['login_way'] == 1 ? $v['qq_nickname'] : ($v['nickname'] == '' ? $v['username'] : $v['nickname']);
                $list[$k]['u_img'] = $v['login_way'] == 1 ? $v['qq_img'] : $v['u_img'];
                
                //查看该条留言下面的所有回复
                $sql = "select m.*,u.username,u.nickname,u.u_img,u.login_way,q.qq_img,q.qq_nickname 
                from hwh_user u
                left join hwh_user_message m on m.uid = u.id
                left join hwh_user_qq q on q.qq_openid = u.qq_openid
                where top_protect_id = {$v['id']} and protect_id != 0 order by m.createDate";
                $list[$k]['twoList'] = M()->query($sql);
                foreach($list[$k]['twoList'] as $key => $val){
                    if($key == count( $list[$k]['twoList'])-1 ){//最后一条数组元素内容（即回复的最后一条信息）
                        if($val['uid'] != $uid){//最后一条内容不是自己回复的
                            $myMessageList[$k]['twoList'][$key]['isReplyMessage'] = 1;
                        }else{
                            $myMessageList[$k]['twoList'][$key]['isReplyMessage'] = 0;
                        }
                    }else{
                        $myMessageList[$k]['twoList'][$key]['isReplyMessage'] = 0;
                    }
                    
                    //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
                    $list[$k]['twoList'][$key]['username'] = $val['login_way'] == 1 ? $val['qq_nickname'] : ($val['nickname'] == '' ? $val['username'] : $val['nickname']);
                    $list[$k]['twoList'][$key]['u_img'] = $val['login_way'] == 1 ? $val['qq_img'] : $val['u_img'];
                }
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }
    }
    
    /**
     * 我给别人留言的条目数*/
    public function myMessageCount(){
        $uid = session('id');
        $where['uid'] = $uid;
        $where['protect_id'] = 0;
        $count = M('user_message')->where($where)->count();//我留言的条目数(总记录数)
        return $count;
    }
    
    /**
     * ajax无刷新显示我给别人的留言列表*/
    public function myMessageListAjax(){
        $uid = session('id');
        if(IS_AJAX){
            $where['uid'] = $uid;
            $where['protect_id'] = 0;
            //总记录数  每页显示数  总页数
            $count = M('user_message')->where($where)->count();//我留言的条目数(总记录数)
            $pageSize = 5;
            $totalPage = ceil($count/$pageSize);
            
            //当前页  起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){  //输入跳转页数 
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{  //点击上一页下一页
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            }

            $startPage= ($currPage-1)*$pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            $sql = "select m.*,u.username,u.nickname,u.u_img,u.login_way,q.qq_img,q.qq_nickname 
            from hwh_user u 
            left join hwh_user_message m on m.uid = u.id
            left join hwh_user_qq q on q.qq_openid = u.qq_openid 
            where uid = $uid and protect_id = 0 limit $startPage,$pageSize";
            $myMessageList = M()->query($sql);
            foreach($myMessageList as $k => $v){
                //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
                $myMessageList[$k]['username'] = $v['login_way'] == 1 ? $v['qq_nickname'] : ($v['nickname'] == '' ? $v['username'] : $v['nickname']);
                $myMessageList[$k]['u_img'] = $v['login_way'] == 1 ? $v['qq_img'] : $v['u_img'];
                
                //查出是给谁留言
                $myMessageList[$k]['toUser'] = M('user')->field('username,nickname,u_img')->where('id='.$v['user_id'])->find();
                $myMessageList[$k]['toUser']['username'] = $myMessageList[$k]['toUser']['nickname'] == '' ? $myMessageList[$k]['toUser']['username'] : $myMessageList[$k]['toUser']['nickname'];
                
                //我的留言下面的回复内容
                $sql = "select m.*,u.username,u.nickname,u.u_img from hwh_user_message m left join hwh_user u on u.id = m.uid where m.top_protect_id = {$v['id']} and protect_id != 0";
                $myMessageList[$k]['twoList'] = M()->query($sql);
                foreach($myMessageList[$k]['twoList'] as $key => $val){
                    if($key == count( $myMessageList[$k]['twoList'])-1 ){//最后一条数组元素内容（即回复的最后一条信息）
                        if($val['uid'] != $uid){//最后一条内容不是自己回复的
                            $myMessageList[$k]['twoList'][$key]['isReplyMessage'] = 1;
                        }else{
                            $myMessageList[$k]['twoList'][$key]['isReplyMessage'] = 0;
                        }
                    }else{
                        $myMessageList[$k]['twoList'][$key]['isReplyMessage'] = 0;
                    }
                    
                    //qq登录就显示qq_nickname, 账号登录判断nickname是否为空，为空显示username，不为空显示nickname
                    $myMessageList[$k]['twoList'][$key]['username'] = $val['login_way'] == 1 ? $val['qq_nickname'] : ($val['nickname'] == '' ? $val['username'] : $val['nickname']);
                    $myMessageList[$k]['twoList'][$key]['u_img'] = $val['login_way'] == 1 ? $val['qq_img'] : $val['u_img'];
                }
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($myMessageList) ? false : $myMessageList;
            echo json_encode($data);
        }

    }
}