<?php
namespace Home\Controller;
use Think\Controller;

class UsersjController extends Controller {
    
    private $isCheckQQ;
    
    public function __construct(){
        parent::__construct();
        $this->A_login = A('Login');
        $this->A_login->checkLogin();//检查是否已登录
        $this->A_img = A('Img');
        $this->A_photo = A('ImgMuch');
        $this->A_Message = A('Message');
        
        $this->isCheckQQ = $this->A_login->checkQQ();//账号登录判断是否已绑定QQ
    }
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     *上传个人图像
     *第三方插件ajaxFileUpload
     */
    public function uploadChangeImg() {
        $img = $this->A_img->uploadImg('Public/Uploads/user/');
        echo $img;
    }
    
    /**
     *改变个人头像
     */
    public function userHeadImg(){
        if(IS_AJAX){
            $uid = session('id');
            $img = trim($_POST['u_img']);
            
            if($img == ''){
                $this->ajaxReturn($this->errmsg(10001, '请按正确的格式上传图像!'));
            }
            
            //保存到数据库
            $d['u_img'] = $img;
            M('user')->where('id='.$uid)->save($d);
        }
    }
    
    /**
     * 供userInfo调用的函数
     * @param $id 登录成功后保存的session值
     * @param $type int  0时更新操作   1时QQ绑定账号操作
     * */
    public function _userInfo($id,$type=0){
        if($type == 0){
            if(IS_AJAX){
                $nickname = trim($_POST['nickname']);
                $u_sign = trim($_POST['u_sign']);
                $address= trim($_POST['address']);
                $prov = trim($_POST['prov']);
                $city = trim($_POST['city']);
                $drstry = trim($_POST['drstry']);
                $month = trim($_POST['month']);
                $days = trim($_POST['days']);
                if(strlen($u_sign) < 6){
                    $this->ajaxReturn($this->errmsg(10003, '字数太少了,不够个性哟!'));
                }
                if(strlen($u_sign) > 250){
                    $this->ajaxReturn($this->errmsg(10003, '字数太多了哟,太个性化了!'));
                }
                if($prov == '' || $city == ''){//$drstry有的市没有区的选择，所以这里不能做限制
                    $this->ajaxReturn($this->errmsg(10004, '请选择省市区!'));
                }
                if($address == ''){
                    $this->ajaxReturn($this->errmsg(10004, '请填写您的详细地址!'));
                }
                if(strlen($address) > 50){
                    $this->ajaxReturn($this->errmsg(10004, '憋欺负我没读过书!'));
                }
                if(is_numeric($month) == false || is_numeric($days) == false){
                    $this->ajaxReturn($this->errmsg(10005, '请谨慎对待，填写您的日期'));
                }
                if($month<0 || $month>12){
                    $this->ajaxReturn($this->errmsg(10005, '你个逗B，月份只有（1-12）月'));
                }
                if(ceil($month) != $month){
                    $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                }
                if($days<0 || $days>31){
                    $this->ajaxReturn($this->errmsg(10005, '你个逗B，每月只有（1-31）天'));
                }
                if(ceil($days) != $days){
                    $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                }
                $birthday = $month.",".$days;    //以,号连接起来

                $data['nickname'] = $nickname;
                $data['u_sign'] = $u_sign;
                $data['province'] = $prov;
                $data['city'] = $city;
                $data['district'] = $drstry;
                $data['address'] = $address;
                $data['u_birthday'] = $birthday;
                $res = M('user')->where('id='.$id)->save($data);
                if(!$res){
                    $this->ajaxReturn($this->errmsg(10001, '没有任何修改哟!'));
                }else{
                    //修改成功   用户昵称改变  则发表的语录  笑话  文章 的作者也都要随之改变
                    $d['author'] = $nickname;
                    M('yulu')->where("uid = $id and uid_type = 2")->save($d);
                    M('joke')->where("uid = $id and uid_type = 2")->save($d);
                    M('article')->where("uid = $id and uid_type = 2")->save($d);
                
                    $this->ajaxReturn($this->errmsg(10000, '修改成功!'));
                }
            }//end is_ajax
            $info = M('user')->field(true)->where('id='.$id)->find();
            $bir = explode(',', $info['u_birthday']);
            $info['month'] = $bir[0];
            $info['days'] = $bir[1];
            $this->assign('info',$info);
            
            $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
            
            A('Qq')->qqurl();//QQ登录入口

            $this->display('index');
        }else{//end type=0
            $w['qq_openid'] = $id;
            $info = M('user')->where($w)->find(); //根据qq_openid查询出生成的user记录，取出id
            session('id',$info['id']);//保存其session

            if(IS_AJAX){
                $nickname = trim($_POST['nickname']);
                $u_sign = trim($_POST['u_sign']);
                $address= trim($_POST['address']);
                $prov = trim($_POST['prov']);
                $city = trim($_POST['city']);
                $drstry = trim($_POST['drstry']);
                $month = trim($_POST['month']);
                $days = trim($_POST['days']);
                //进行相应验证，现在略
                //if(mb_strlen($nickname) < 9 || mb_strlen($nickname) > 24){
                //$this->ajaxReturn($this->errmsg(10002, '昵称请设置在3-8个字符之间!'));
                //}
                //QQ登录绑定账号进行的插入操作
                $username = trim($_POST['username']);
                $userpass = trim($_POST['password']);
                //合理性验证
                $where['username'] = $username;
                $info = M('user')->field('username')->where($where)->find();
                
                if($username == ''){
                    $this->ajaxReturn($this->errmsg(10001, '用户名不能为空'));
                }
                
                if($info['username'] != ''){
                    //填写的用户名已存在时，有两种情况要处理（被绑定了和未被绑定）
                    if($info['qq_openid'] != ''){
                        //被绑定了
                        $this->ajaxReturn($this->errmsg(10001, '该用户名已被绑定'));
                    }else{
                        if($userpass == ''){
                            $this->ajaxReturn($this->errmsg(10002, '该账号已被注册，为保护账号安全，请输入密码验证此账号属于你本人的'));
                        }
                        //未被绑定，这里要考虑的详细一点，必须要输入这个账号的密码验证，如果匹配才允许绑定，不匹配就不允许（以免绑定了别人的账号）
                        $wa['username'] = $username;
                        $wa['password'] = md5($userpass);
                        $flag = M('user')->where($wa)->find();
                        if(!$flag){
                            $this->ajaxReturn($this->errmsg(10001, '该账号已被注册，出于安全考虑，你输入的账号与密码不匹配，请重新验证或绑定其他账号！'));
                        }
                    }
                }
                
                if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$username)){
                    $this->ajaxReturn($this->errmsg(10001, '用户名不能包含特殊字符,长度6-16字符之间'));
                }
                if(strlen($username) < 6 || strlen($username) > 16){
                    $this->ajaxReturn($this->errmsg(10001, '用户名请设置在6-16个字符之间'));
                }
                if(strlen($userpass) < 6 || strlen($userpass) > 16){
                    $this->ajaxReturn($this->errmsg(10002, '密码请设置在6-16位字符之间'));
                }
                //当填写了个性签名时
                if($u_sign != ''){
                    if(strlen($u_sign) < 6){
                        $this->ajaxReturn($this->errmsg(10003, '字数太少了,不够个性哟!'));
                    }else if(strlen($u_sign) > 250){
                        $this->ajaxReturn($this->errmsg(10003, '字数太多了哟,太个性化了!'));
                    }
                }
                //当选择了城市时
                if($prov != ''){
                    if($prov == '' || $city == ''){//$drstry有的市没有区的选择，所以这里不能做限制
                        $this->ajaxReturn($this->errmsg(10004, '请选择省市区!'));
                    }
                    /*if($address == ''){
                        $this->ajaxReturn($this->errmsg(10004, '请填写您的详细地址!'));
                    }*/
                    if(strlen($address) > 50){
                        $this->ajaxReturn($this->errmsg(10004, '憋欺负我没读过书!'));
                    }
                }
                //当填写了日期时
                if($month != '' || $days != ''){
                    if(is_numeric($month) == false || is_numeric($days) == false){
                        $this->ajaxReturn($this->errmsg(10005, '请谨慎对待，填写您的日期'));
                    }
                    if($month<0 || $month>12){
                        $this->ajaxReturn($this->errmsg(10005, '你个逗B，月份只有（1-12）月'));
                    }
                    if(ceil($month) != $month){
                        $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                    }
                    if($days<0 || $days>31){
                        $this->ajaxReturn($this->errmsg(10005, '你个逗B，每月只有（1-31）天'));
                    }
                    if(ceil($days) != $days){
                        $this->ajaxReturn($this->errmsg(10005, '请输入正确的日期！'));
                    }
                    $birthday = $month.",".$days;    //以,号连接起来
                }
                 
                $d['username'] = $username;
                $d['password'] = md5($userpass);
                $d['nickname'] = $nickname;
                $d['u_birthday'] = $birthday;
                $d['u_sign'] = $u_sign;
                $d['province'] = $prov;
                $d['city'] = $city;
                $d['district'] = $drstry;
                $d['address'] = $address;
                //$add['qq_openid'] = $id;
                $d['states'] = 1; //qq登录的进行账号绑定的默认为激活状态
                $d['regist_time'] = date('Y-m-d H:i:s',time());
                //$rs = M('user')->add($add);   qq登录时默认创建了一条该用户的记录（只保存了qq_openid），所以这里也是要做更新操作

                $wh['qq_openid'] = $id;
                $rs = M('user')->where($wh)->save($d);
                if($rs){
                    $uid = session('id');
                    $res = M('user')->field(true)->where('id='.$uid)->find();
                    $bir = explode(',', $res['u_birthday']);
                    $info['month'] = $bir[0];
                    $info['days'] = $bir[1];
                    $this->assign('info',$res);
                    
                    //这里要进行判断，如果是绑定的自己原来的账号，那绑定成功之后要删除原来的那条数据，不然就有重复的了
                    $whe['username'] = $username;
                    $list = M('user')->where($whe)->select();
                    if(count($list) > 1){
                        $s = M('user')->where($whe)->order('id')->find();
                        $id = $s['id'];
                        $sql = "delete from hwh_user where id = $id";
                        M()->execute($sql);
                    }
                    
                    $this->ajaxReturn($this->errmsg(10000, '绑定账号成功！'));
                }else{
                    $this->ajaxReturn($this->errmsg(10006, '绑定账号失败！'));
                }
            }//end is_ajax
            
            $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
            
            A('Qq')->qqurl();//QQ登录入口
            
            $this->display('index-qqbind');
        }//end else
        
        
    }
	
	/**
	 * 个人资料*/
	public function userInfo(){
		$qq_openid = session('qq_openid');    //qq登录保存的qq_openid

		if( $qq_openid != '' ){//qq进行的登录
		    //查看有没有绑定本网站的账号
		    $w['qq_openid'] = $qq_openid;
		    $res = M('user')->where($w)->find();
		    
		    if($res['is_black'] == 1){//查询是否已被加入黑名单 
		        session(null);
		        $this->error('你已被加入黑名单！',U('Home/Login/ajaxLogin'));
		    }
		    
		    if( $res['username'] != '' ){ //绑定了本网站的账号（根据username来判断，因为网站账号不能为空）
		        session('id',$res['id']);
		        $id = session('id');
                $this->_userInfo($id);
		    }else{//未绑定本网站的账号，提示进行绑定
		        $this->_userInfo($qq_openid,1);
		    }
		}else{//账号进行的登录
		    $id = session('id');
		    $this->_userInfo($id);
		}

	}
	
	/**
	 * 个人资料页面的一个小模块div
	 * 用户修改之后无刷新显示完整地址*/
	public function userInfoSon(){
	    $id = session('id');
	    //$id = $this->A_login->checkLogin();

	    if(IS_AJAX){
	        $info = M('user')->where('id='.$id)->find();
	        $list = empty($info) ? false : $info;
	        $address = $list['province'].$list['city'].$list['district'].$list['address'];
	        echo json_encode($address);
	    }
	}
	
	/**
	 * 修改密码*/
	public function changePassWord(){
	    $id = session('id');
	    if(IS_AJAX){
	        $this->A_login->checkUsername();//检查是否绑定了本网站的账号
	        //$id = $this->A_login->checkLogin();
	        //接收参数
	        $oldPwd = trim($_POST['oldPwd']);
	        $newPwd = trim($_POST['newPwd']);
	        $newPwd2 = trim($_POST['newPwd2']);
	        
	        $where['id'] = $id;
	        $where['password'] = md5($oldPwd);
	        $info = M('user')->where($where)->find();
	        if(!$info){
	            $this->ajaxReturn($this->errmsg(10001, '原密码不正确!'));
	        }
	        
	        if($oldPwd == $newPwd){
	            $this->ajaxReturn($this->errmsg(10002, '新密码和原始密码不能相同!'));
	        }
	        
	        if(strlen($newPwd) < 6 || strlen($newPwd) > 16 || $newPwd == ''){
	            $this->ajaxReturn($this->errmsg(10002, '新密码请设置在6-16位字符之间!'));
	        }
	        
	        if($newPwd != $newPwd2){
	            $this->ajaxReturn($this->errmsg(10003, '新密码和确认密码不一致!'));
	        }
	        
	        //密码强弱
	        if(strlen($newPwd) >= 6 && strlen($newPwd) <= 8){
	            $data['password_leven'] = 1;
	        }else if(strlen($newPwd) > 8 && strlen($newPwd) <= 12){
	            $data['password_leven'] = 2;
	        }else if(strlen($newPwd) > 12 && strlen($newPwd) <= 16){
	            $data['password_leven'] = 3;
	        }
	        
	        $data['password'] = md5($newPwd);
	        $flag = M('user')->where('id='.$id)->save($data);
	        if($flag){
	            //记录日志表
	            $add['uid'] = $id;
	            $add['user_time'] = date('Y-m-d H:i:s',time());
	            $add['user_ip'] = $_SERVER['REMOTE_ADDR'];
	            $add['user_type'] = 2;
	            M('user_log')->add($add);
	            
	            $this->ajaxReturn($this->errmsg(10000, '修改成功!'));
	        }else{
	            $this->ajaxReturn($this->errmsg(10004, '未知错误,修改失败!'));
	        }
	    }
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('changePwd');
	}
	
	/**
	 * 验证原密码是否正确
	 * 前台ajax无刷新显示（失去焦点时触发）
	 * 提高用户体验度  */
	public function oldPwdAjax(){
	    if(IS_AJAX){
	        $id = session('id');
	        //$id = $this->A_login->checkLogin();
	        $oldPwd = trim($_POST['oldPwd']);
	        $where['id'] = $id;
	        $where['password'] = md5($oldPwd);
	        $info = M('user')->where($where)->find();
	        if(!$info){
	            $this->ajaxReturn($this->errmsg(10001, '原密码不正确!'));
	        }
	    }
	}
	
	/**
	 * 验证新密码和原密码是否相同
	 * 前台ajax无刷新显示（失去焦点时触发）
	 * 提高用户体验度  */
	public function pwdsAjax(){
	    if(IS_AJAX){
	        $id = session('id');
	        //$id = $this->A_login->checkLogin();
	        $newPwd = trim($_POST['newPwd']);
	        $info = M('user')->field('password')->where('id='.$id)->find();
	        if(md5($newPwd) == $info['password']){
	            $this->ajaxReturn($this->errmsg(10002, '新密码和原始密码不能相同!'));
	        }
	        
	        if(strlen($newPwd) < 6 || strlen($newPwd) > 16 || $newPwd == ''){
	            $this->ajaxReturn($this->errmsg(10002, '新密码请设置在6-16位字符之间!'));
	        }
	        
	    }
	}
	
	/**
	 * 修改密码成功后退出登录*/
	public function logOutUserPass(){
	    //请空session
	    session(null);
	    sleep(2);  //停留2秒执行下面代码
	    $this->redirect('Home/Login/ajaxLogin');
	}
	
	/**
	 * 经典语录列表 */
	public function yuluList(){
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口

	    $this->display('yuluList');
	}
	
	/**
	 * ajax无刷新分页显示经典语录列表 */
	public function yuluListAjax(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        
	        //总记录数   每页显示数  总页数
	        $count = M('yulu')->where($where)->count();
	        $pageSize = 8;
	        $totalPage = ceil($count/$pageSize);
	        
	        //当前页 起始页
	        $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
	        $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
	        $startRow = ($currPage-1)*$pageSize;
	        
	        //分页跳转时要带的参数，保证点击下一页时查询条件还存在
	        foreach($where as $key=>$val) {
	            $Page->parameter[$key]   =   urlencode($val);
	        }
	        
	        $list = M('yulu')->where($where)->order('maketime desc')->limit($startRow.',',$pageSize)->select();
	        foreach($list as $k => $v){
	            $list[$k]['maketime'] = date('Y-m-d',strtotime($v['maketime']));
	            $list[$k]['is_ok'] = $v['is_ok'] == 0 ? '未通过' : '已通过';
	        }
	        
	        $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
	    }
	}
	
	/**
	 * 幽默笑话列表 */
	public function jokeList(){

	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('jokeList');
	}
	
	/**
	 * ajax无刷新分页显示幽默笑话列表 */
	public function jokeListAjax(){
	    $uid = session('id');
	    //$uid = $this->A_login->checkLogin();
	    if(IS_AJAX){
	        $where['uid'] = $uid;
	        $where['uid_type'] = 2;
	        
	        //总记录数   每页显示数  总页数
	        $count = M('joke')->where($where)->count();
	        $pageSize = 8;
	        $totalPage = ceil($count/$pageSize);
	        
	        //当前页 起始页
	        $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
	        $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
	        $startRow = ($currPage-1)*$pageSize;
	        
	        //分页跳转时要带的参数，保证点击下一页时查询条件还存在
	        foreach($where as $key=>$val) {
	            $Page->parameter[$key]   =   urlencode($val);
	        }
	        
	        $list = M('joke')->where($where)->order('maketime desc')->limit($startRow.',',$pageSize)->select();
	        foreach($list as $k => $v){
	            $list[$k]['maketime'] = date('Y-m-d',strtotime($v['maketime']));
	            $list[$k]['is_ok'] = $v['is_ok'] == 0 ? '未通过' : '已通过';
	        }
	        
	        $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
	    }
	}

	/**
	 * 优美文章列表 */
	public function articleList(){
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display('articleList');
	}
	
	/**
	 * ajax无刷新分页显示优美文章列表 */
	public function articleListAjax(){
        if(IS_AJAX){
            
            $uid = session('id');
            
            $where['uid'] = $uid;
            $where['uid_type'] = 2;
            
            //总记录数   每页显示数   总页数
            $count = M('article')->where($where)->count();
            $pageSize = 8;
            $totalPage = ceil( $count/$pageSize );
            
            //当前页   起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            $startRow = ($currPage - 1) * $pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = M('article')->field(true)->where($where)->limit($startRow.','.$pageSize)->order('create_date desc')->select();
            foreach($list as $k => $v){
                $list[$k]['create_date'] = date('Y-m-d',strtotime($v['create_date']));
                $list[$k]['is_ok'] = $v['is_ok'] == 0 ? '未通过' : '已通过';
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page']= $totalPage;//总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }
	}
	
	/**
	 * 文章详情  */
	Public function article(){
	    //接收参数
	    $id = $_GET['id'];
	    $find = M('article')->where('id='.$id)->find();
	    $this->assign("info",$find);
	    
	    $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
	    
	    A('Qq')->qqurl();//QQ登录入口
	    
	    $this->display("article");
	}

    /**
     * 个人相册列表  */
    public function photo(){
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('photoList');
    }
    
    /**
     * ajax无刷新显示个人相册列表  */
    public function ajaxPhotoList(){
        if(IS_AJAX){
            $uid = session('id');
            
            $where['uid'] = $uid;
            
            //总记录数  每页显示数  总页数
            $count = M('user_photo')->where($where)->count();
            $page_size = 12;
            $total_page = ceil($count/$page_size);
            
            //当前页  起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >=1 && $currPage <= $total_page) ? $currPage : 1;
            $startRow = ($currPage-1)*$page_size;
            
            $userCoverImg = C(USERCOVERIMG);
            $imgarr = array(
                array(
                    'id'=>0,
                    'uid'=>$uid,
                    'img'=>$userCoverImg,
                    'is_ok'=>1,
                    'create_date'=>'',
                    'is_photo_show'=>1,
                )
            );
            
            //判断用户是否有封面图
            $w['uid'] = $uid;
            $w['is_photo_show'] = 1;
            $isShow = M('user_photo')->where($w)->find();
            if($isShow){    //有封面图
                $list = M('user_photo')->where($where)->order('is_photo_show desc,create_date desc')->limit($startRow.','.$page_size)->select();
                foreach($list as $k => $v){
                    if($v['is_photo_show'] == 1){
                        $list[$k]['maketime'] = "<span style='color:red;font-size:14px;'>封面图：</span>".date('Y-m-d',strtotime($v['create_date']))."<input type='button' class='box_but' onclick='userEditCoverImg()' value='编辑'/>";
                    }else{
                        $list[$k]['maketime'] = date('Y-m-d',strtotime($v['create_date']));
                    }
                }
            }else{  //没有封面图
                $list = M('user_photo')->where($where)->order('is_photo_show desc,create_date desc')->limit($startRow.','.$page_size)->select();
                $list = array_merge($imgarr,$list); //添加返回信息$imgarr
                foreach($list as $k => $v){
                    if($v['is_photo_show'] == 1){
                        $list[$k]['maketime'] = "<span style='color:red;font-size:14px;'>封面图</span><input type='button' class='box_but' onclick='userEditCoverImg()' value='编辑'/>";
                    }else{
                        $list[$k]['maketime'] = date('Y-m-d',strtotime($v['create_date']));
                    }
                    
                }
                
            }
            
            $data['count'] = $count;
            $data['total_page'] = $total_page;
            $data['currPage'] = $currPage;
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
        }
    }
    
    /**
     * 添加个人图片（相册）  */
    public function photoAdd(){
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口

        $this->display('photoAdd');
    }
    
    /**
     * 添加个人封面图片  */
    public function photoCoverAdd(){
        $id = session("id");
        
        //显示相册列表封面图像（用户）
        if($id != '' || $id != null){
            $where['uid'] = $id;
            $where['is_ok'] = 1;
            $where['is_photo_show'] = 1;
            $info = M('user_photo')->where($where)->find();
            $this->assign('info',$info);
        }
        $this->assign("info",$info);
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口
        
        $this->display('photoCoverAdd');
    }
    
    /**
     * 多图片上传  */
    public function uploadPhoto(){
        $photo = $this->A_photo->muchPhotoUpload('Public/Uploads/user/photo/');
        echo $photo;
    }
    
    /**
     * 添加个人相册到数据库  */
    public function photoUserAdd(){
        $uid = session('id');
        
        if(IS_AJAX){
            if(!$uid){
                $this->ajaxReturn($this->errmsg(20001, '请先登录后再来添加哟!'));
            }
    
            //接收参数
            $img = trim($_POST['img']);
            if($img == ''){
                $this->ajaxReturn($this->errmsg(10001, '请上传至少一张图片哟!'));
            }
    
            $add['uid'] = $uid;
            $add['img'] = $img;
            $add['create_date'] = date('Y-m-d H:i:s',time());
            $add['is_photo_show'] = 0;
            $res = M('user_photo')->add($add);
    
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '上传成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '未知原因,上传成功!'));
            }
    
        }
    
        //$this->display('addUserPhoto');
    }
    
    /**
     * 删除相片*/
    public function delPhoto(){
        $id = session("id");
        if(IS_AJAX){
            $imgId = trim($_POST['imgId']);
            $where['uid'] = $id;
            $where['id'] = $imgId;
            
            $res = M('user_photo')->where($where)->delete();
            if($res){
                $this->ajaxReturn($this->errmsg(10000, "删除成功！"));
            }else{
                $this->ajaxReturn($this->errmsg(10001, "删除失败！"));
            }
        }
    }
    
    /**
     * 安全日志*/
    public function safeLog(){
        
        $this->assign('isCheckQQ',$this->isCheckQQ);//账号登录判断是否已绑定QQ
        
        A('Qq')->qqurl();//QQ登录入口

        $this->display('safeLog');
    }
    
    /**
     * ajax无刷新分页显示安全日志列表
     * @param type int 操作类型(1登录系统  2修改密码)*/
    public function safeLogList(){
        if(IS_AJAX){
            $uid = session('id');
            $where['uid'] = $uid;
            
            //接收参数
            $type = I('post.type');
            if($type == 1){
                $where['user_type'] = 1;
            }else if($type == 2){
                $where['user_type'] = 2;
            }
            
            //总记录数  每页显示数  总页数
            $count = M('user_log')->where($where)->count();
            $pageSize = 18;
            $total_page = ceil($count/$pageSize);
            
            //当前页   起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $total_page) ? $currPage : 1;
            $startRow = ($currPage - 1) * $pageSize;
            
            $list = M('user_log')->where($where)->order('user_time desc')->limit($startRow.','.$pageSize)->select();
            foreach($list as $k => $v){
                $list[$k]['times'] = $v['user_time'];
                $list[$k]['type'] = $v['user_type'] == 1 ? ($v['login_type'] == 1 ? '<span style="color:#FF8C69;font-weight:bold;">使用账号密码登录了系统!</span>' : '<span style="color:#FF8C69;font-weight:bold;">使用QQ号登录了系统!</span>') : '<span style="color:#FF6347;font-weight:bold;">进行了密码修改!</span>';
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page']= $total_page;//总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }  
    }

    /**
     * 我的绑定信息
     * $res=1 账号和QQ号进行了绑定
     * $res=2 注册了本网站账号，但未进行QQ号绑定
     * $res=3 进行了QQ登录，但未注册本网站账号*/
    public function bindList(){
        $id = session("id");
        $where['id'] = $id;
        $info = M('user')->where($where)->find();
        if($info['username'] != '' && $info['qq_openid'] != ''){
            $res = 1;
        }else if($info['username'] != '' && $info['qq_openid'] == ''){
            $res = 2;
            A('Qq')->qqurl();//QQ登录入口
        }else if($info['username'] == '' && $info['qq_openid'] != ''){
            $res = 3;
        }
    
        $this->assign('res',$res);
        $this->display('bindList');
    }

}