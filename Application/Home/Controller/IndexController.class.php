<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\IsMobileModel;

class IndexController extends Controller {
    
    private $isMobile;
    
    public function __construct(){
        parent::__construct();
        $this->isMobile = A('IsMobile')->isMobile();
    }
    
    public function index(){
        //经典语录
        $sql = "select * from hwh_yulu where is_ok = 1 order by id desc limit 5";
        $model = M();
        $yuluList = $model->query($sql);

        //幽默笑话
        $jokeList = M('joke')->where('is_ok=1')->order('maketime desc')->limit(5)->select();
        if($jokeList == array()){   //没有幽默笑话
            $jokeList = $yuluList;
        }

        //优美文章
        $articleList = M('Article')->where('is_ok=1 and is_fine=0')->order('create_date desc')->limit(4)->select();
        
        /* 图片显示在前台html页面会变形，不采用
        //人员显示   上传过图片的则显示在网站前端页面
        $photoId = M('user_photo')->field('uid')->where('is_ok=1')->select();
        $newarr = array();
        foreach($photoId as $k => $v){
            if($v['uid'] != '' || $v['uid'] != 0){
                $fid = $v['uid'];
                $newarr[] = $fid;   //把遍历的值添加到数组里面
            }else{
                $newarr[] = '';
            }   
        }
        $newarr = array_unique($newarr);    //去除数组里面相同的数据，只保留一个
        
        if($newarr != array()){
            $w['u.id'] = array('in',$newarr);
            $userList = M('user u')->field('u.*,q.qq_img,q.qq_nickname')->where($w)->join('left join hwh_user_qq q on q.qq_openid = u.qq_openid')->order("u.regist_time desc")->limit(5)->select();

            foreach($userList as $k => $v){
                if($v['u_img'] == "" && $v['qq_img'] == ""){  //如果用户没上传头像  则显示封面图像
                    $wh['uid'] = $v['id'];
                    $wh['is_photo_show'] = 1;
                    $img = M('user_photo')->field('img')->where($wh)->find();
                    $userList[$k]['u_img'] = $img['img'];
                }else{
                    $userList[$k]['u_img'] = $v['u_img'] != "" ? $v['u_img'] : "";
                }
            
                $userList[$k]['nickname'] = $v['username'] == '' ? $v['qq_nickname'] : ($v['nickname'] != "" ? $v['nickname'] : $v['username']);
                $userList[$k]['u_sign'] = $v['u_sign'] != "" ? $v['u_sign'] : "暂未发表人生格言~~";
            }
        }else{
            $userList = array();
        }*/
        
        //echo M()->getLastSql();exit;
        
        //首页推荐文章内容展示（只会有一篇）
        $ar['is_recommend'] = 1;
        $ar['is_ok'] = 1;
        $artiRecommend = M('Article')->where($ar)->order('create_date desc')->limit(1)->find();
        
        $this->assign('jokeList',$jokeList);    //幽默笑话列表
        $this->assign('articleList',$articleList);//文章列表
        $this->assign('artiRecommend',$artiRecommend);//首页推荐文章
        
        A('Qq')->qqurl();//QQ登录入口
        
        $isMobile = $this->isMobile;
        if($isMobile == true)
        {
            //手机端浏览
            $this->display('indexSj');
            exit;
        }
        
        $this->display('index'); 
    }
    
    public function water(){

        if(IS_AJAX){
            $key = C(HEWEATHER_KEY);
            $city = trim($_POST['city']);

            $durl = "https://api.heweather.com/v5/search?city={$city}&key={$key}";

            $data = file_get_contents($durl);   //返回的是json格式
            
            echo $data;
        }
    }

}