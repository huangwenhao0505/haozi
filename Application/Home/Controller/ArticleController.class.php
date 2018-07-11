<?php
namespace Home\Controller;
use Think\Controller;

class ArticleController extends Controller {
    
    private $isMobile;
    
    public function __construct(){
        parent::__construct();
        $this->isMobile = A('IsMobile')->isMobile();
        $this->A_img = A('Img');
    }
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 文章详情  */
    public function detailArti(){
        $id = $_GET['id'];  //文章ID
        $articleList = 
        M('Article a')
        ->field('a.*,c.name categoryname')
        ->join('__ARTICLE_CATEGORY__ c on c.id = a.categoryId','LEFT')
        ->where('a.id='.$id)
        ->find();
        
        //浏览一次增加一次浏览量
        $sql = "update hwh_article set view_count=(CASE WHEN view_count IS NULL THEN 1 ELSE view_count+1 END) where id = $id";
        M()->execute($sql);
        
        $articleList['maketime'] = date('Y-m-d',strtotime($articleList['create_date']));
        $this->assign('artiList',$articleList);
        
        //根据当前文章ID，显示上一篇和下一篇文章
        $w1['id'] = array('LT',$id);
        $w1['is_ok'] = 1;
        $w2['id'] = array('GT',$id);
        $w2['is_ok'] = 1;
        $prev = M('article')->field('id,title')->where($w1)->order('id desc')->find();
        $next = M('article')->field('id,title')->where($w2)->order('id asc')->find();
        
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        
        A('Qq')->qqurl();//QQ登录入口

        $isMobile = $this->isMobile;
        if($isMobile == true)
        {
            //手机端浏览
            $this->display('ArticleSj/blog');
            exit;
        }
        $this->display('blog');
    }
    
    /**
     * 文章列表  */
    public function listArti(){
        A('Qq')->qqurl();//QQ登录入口
        
        //列出顶级分类列表
        $list = M('article_category')->where('parentId=0')->select();
        foreach($list as $k => $v)
        {
            $w['parentId'] = $v['id'];
            $list[$k]['sonCate'] = M('article_category')->where($w)->select();
        }
        //var_dump($list);exit;
        
        $this->assign('list',$list);
        
        $isMobile = $this->isMobile;
        if($isMobile == true)
        {
            //手机端浏览
            $this->display('ArticleSj/listArti2');
            exit;
        }
        
        $this->display('listArti2');
    }
    
    /**
     * ajax无刷新显示文章列表  */
    public function ajaxListArti(){
        if(IS_AJAX){
            //接收参数
            $author = trim($_POST['author']);
            $title  = trim($_POST['title']);
            $cid    = trim($_POST['cid']);
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
                $where['create_date'] = array('EGT',$datetime1);
            }
            
            if($datetime1 == '' && $datetime2 != ''){
                $datetime2 += 86400;
                $where['create_date'] = array('ELT',$datetime2);
            }
            
            if($datetime1 != '' && $datetime2 != ''){
                $datetime2 += 86400;    //加1天，这样就可以查出当天的选择日期了
                $where['create_date'] = array('BETWEEN',array($datetime1,$datetime2));
            }
            
            if($author != ''){
                $where['author'] = array('like','%'.$author.'%');
            }
            
            if($title != ''){
                $where['title'] = array('like','%'.$title.'%');
            }
            
            if($cid != '')
            {
                $w['id'] = $cid;
                $info = M('article_category')->field('parentId')->where($w)->find();
                if($info['parentId'] == 0)
                {
                    //是顶级分类，查询这个的时候，所有的子分类下的文章也显示出来
                    $wh['parentId'] = $cid;
                    $sid = M('article_category')->field('id')->where($wh)->select();
                    $cidSon = '';
                    foreach($sid as $k => $v)
                    {
                        $cidSon .= $v['id'].',';//字符串拼接子分类id
                    }
                    //拼接完整的满足要求的分类id，即连上该父分类的id
                    $cidSonString = $cidSon.$cid;
                    $where['categoryId'] = array('in',$cidSonString);
                }
                else
                {
                    //否则
                    $where['categoryId'] = $cid;
                }
            }
            
            $where['is_ok'] = 1;    //是否显示  1显示
            $where['is_black'] = 0; //是否加入黑名单   0否
            $where['is_fine'] = 0;  //是否是fine类型 0否
            
            //总记录   每页显示数   总页数
            $count = M('article')->where($where)->count();
            
            $isMobile = $this->isMobile;;
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
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){  //输入跳转页数 
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{  //点击上一页下一页
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            }
            
            $stateRow = ($currPage-1)*$pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            $list = M('article')->where($where)->order('create_date desc')->limit($stateRow.','.$pageSize)->select();
            foreach($list as $k => $v){
                
                $ds['id'] = $v['categoryid'];
                $catename = M('article_category')->where($ds)->find();
                $list[$k]['catename'] = $catename['name'];//类别名称
                $list[$k]['maketime'] = date('Y-m-d',strtotime($v['create_date']));
            }

            $data['count'] = $count;
            $data['total_page'] = $totalPage;
            $data['currPage'] = $currPage;
            $data['tiaoPage'] = $tiaoPage;
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
        }
    }
    
    /**
     * 发表评论  */
    public function addComment(){
        if(IS_AJAX){
            //接收参数
            $artiId = $_POST['article_id']; //文章ID
            $content = $_POST['content'];   //评论内容
            $commentId = $_POST['commentId'];    //被评的评论ID 空则是评论文章（一级评论） 有则是评论该用户评论内容（二级评论）
            
            if($commentId == ''){  //一级评论
                $uid = session('id');
                if(!$uid){
                    $this->ajaxReturn($this->errmsg(10001, '请先登录后再来发表哟!'));
                }
                
                $find = M('article')->where('id='.$artiId)->find();
                if(!$find){
                    $this->ajaxReturn($this->errmsg(10001, '文章不存在!'));
                }
                
                if($content == ''){
                    $this->ajaxReturn($this->errmsg(10001, '评论内容不能为空!'));
                }
                
                $add['uid'] = $uid;
                $add['article_id'] = $artiId;
                $add['content'] = $content;
                $add['create_date'] = date('Y-m-d H:i:s',time());
                
                $res = M('article_comment')->add($add);
                if($res){
                
                    //更新评论数量
                    $sql = "update hwh_article set comment_count = (case when comment_count is null then 1 else comment_count + 1 end) where id = $artiId";
                    M()->execute($sql);
                
                    $this->ajaxReturn($this->errmsg(10000, '评论成功!'));
                }else{
                    $this->ajaxReturn($this->errmsg(10001, '评论失败!'));
                }
                
            }else{  //二级评论
                
                $uid = session('id');
                if(!$uid){
                    $this->ajaxReturn($this->errmsg(10001, '请先登录后再来发表哟!'));
                }
                
                if($content == ''){
                    $this->ajaxReturn($this->errmsg(10001, '评论内容不能为空!'));
                }
                
                $add['uid'] = $uid;
                $add['article_id'] = $artiId;
                $add['parent_id'] = $commentId;
                $add['content'] = $content;
                $add['create_date'] = date('Y-m-d H:i:s',time());
                
                $res = M('article_comment')->add($add);
                if($res){
                
                    //更新评论数量
                    $sql = "update hwh_article set comment_count = (case when comment_count is null then 1 else comment_count + 1 end) where id = $artiId";
                    M()->execute($sql);
                
                    $this->ajaxReturn($this->errmsg(10000, '评论成功!'));
                }else{
                    $this->ajaxReturn($this->errmsg(10001, '评论失败!'));
                }
                
            }
            
        }
    }
    
    /**
     * ajax无刷新显示评论列表  */
    public function ajaxCommentArti(){
        if(IS_AJAX){
            //接收参数
            $id = $_POST['id']; //文章ID
            
            $where['article_id'] = $id;
            $where['parent_id'] = 0;    //只统计一级评论的数量，统计二级评论的到时候会出错，因为二级评论都是在对应的一级评论下显示
            $where['state'] = 1;    //状态（显示）
            
            //总记录数   每页显示数   总页数
            $count = M('article_comment')->where($where)->count();
            $pageSize = 5;
            $totalPage = ceil($count/$pageSize);
            
            //当前页   起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){ //输入了跳转页数
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
            
            $w['hwh_article_comment.article_id'] = $id;
            $w['hwh_article_comment.state'] = 1;
            $w['hwh_article_comment.parent_id'] = 0;    //一级评论
            $list = M('article_comment')
            ->field('hwh_article_comment.id,hwh_article_comment.content,hwh_article_comment.create_date,hwh_user.nickname,hwh_user.u_img')
            ->where($w)
            ->join('LEFT JOIN hwh_user ON hwh_user.id = hwh_article_comment.uid')
            ->order('hwh_article_comment.create_date desc')
            ->limit($stateRow.','.$pageSize)
            ->select();
            
            foreach($list as $k => $v){
                $list[$k]['maketime'] = $v['create_date'];
                
                //一级评论下对应的二级评论
                $wh['hwh_article_comment.state'] = 1;
                $wh['hwh_article_comment.parent_id'] = $v['id'];   //对应的评论id，二级评论
                $list[$k]['twoList'] = M('article_comment')
                ->where($wh)
                ->field('hwh_article_comment.content,hwh_article_comment.create_date,hwh_user.nickname,hwh_user.u_img')
                ->join('LEFT JOIN hwh_user ON hwh_user.id = hwh_article_comment.uid')
                ->select();
                
                /*foreach($list[$k]['towList'] as $k2 => $v2){
                    $list[$k]['towList'][$k2]['maketime'] = $v2['create_date'];
                }*/
                
            }
            
            $data['count'] = $count;
            $data['total_page'] = $totalPage;
            $data['currPage'] = $currPage;
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
        }
    }
    
    /**
     * 点赞*/
    public function addLikes(){
        if(IS_AJAX){
            //接收参数
            $uid = session('id');
            $artiId = $_POST['article_id']; //文章ID
            
            if(!$uid){
                $uid = $_SERVER['REMOTE_ADDR'];  //游客IP地址
            }
            
            $find = M('article')->where('id='.$artiId)->find();
            if(!$find){
                $this->ajaxReturn($this->errmsg(10001, '文章不存在!'));
            }
            
            $s = "select id from hwh_article_like where FROM_UNIXTIME(create_date,'%Y-%m-%d') = curdate() and uid = '$uid' and acticle_id = $artiId";
            $flag = M()->query($s);
            if($flag){
                $this->ajaxReturn($this->errmsg(10001, '您今天已点赞哟!'));
            }
            
            $add['uid'] = $uid;
            $add['acticle_id'] = $artiId;
            $add['create_date'] = date('Y-m-d H:i:s',time());
            
            $res = M('article_like')->add($add);

            if($res){
                //更新该文章点赞数量
                $sql = "update hwh_article set like_count = (CASE WHEN like_count IS NULL THEN 1 ELSE like_count + 1 END) where id = $artiId";
                M()->execute($sql);
                
                $this->ajaxReturn($this->errmsg(10000, '点赞成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '点赞失败!'));
            }
        }
    }
    
    /**
     *上传文章封面图像
     */
    public function artiPosterImg(){
        $img = $this->A_img->uploadImg('Public/Uploads/article/');
        echo $img;
    }
    
    
    /**
     * 发表文章 */
    public function addArticle(){
        if(IS_AJAX){
            
            $uid = session('id');
            if(!$uid){
                $this->ajaxReturn($this->errmsg(20001, '请先登录后再来发表哟!'));
            }
            
            //每个用户一天只能发表三篇文章
            $sql = "select count(*) as count from hwh_article where FROM_UNIXTIME(create_date,'%Y-%m-%d') = curdate() and uid = $uid";
            $counts = M()->query($sql);

            foreach($counts as $k => $v){
                $count = $v['count'];
            }

            if($count > 3){
                $this->ajaxReturn($this->errmsg(10008, '每天只能发表三篇文章哟!'));
            }
            
            //接收参数
            $title = trim($_POST['title']);
            $jianjie = trim($_POST['jianjie']);
            $content = trim($_POST['editorValue']);
            $img_url = trim($_POST['img_url']);
            
            if($title == ''){
                $this->ajaxReturn($this->errmsg(10001,'标题不能为空!'));
            }
            
            //if(!perg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,15})$/",$title)){
                //$this->ajaxReturn($this->errmsg(10001, '标题不能包含特殊字符，15字以内!'));
            //}
            
            if($jianjie == ''){
                $this->ajaxReturn($this->errmsg(10002, '简介不能为空!'));
            }
            
            //if(!perg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,50})$/",$jianjie)){
                //$this->ajaxReturn($this->errmsg(10002, '简介不能包含特殊字符，50字以内!'));
            //}
            
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10003, '内容不能为空!'));
            }
            
            if($img_url == ''){
                $this->ajaxReturn($this->errmsg(10005, '请上传封面图!'));
            }
            
            //$find = M('user')->field(true)->where('id='.$uid)->find();
            $sql = "select u.nickname,u.login_way,q.qq_nickname from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = $uid";
            $info = M()->query($sql);
            $nickname = $info[0]['login_way'] == 1 ? $info[0]['qq_nickname'] : $info[0]['nickname'];
            
            $add['uid'] = $uid;
            $add['uid_type'] = 2;   //2用户发表  1为后台管理员发表
            $add['author'] = $nickname;
            $add['title'] = $title;
            $add['jianjie'] = $jianjie;
            $add['content'] = $content;
            $add['img_url'] = $img_url;
            $add['create_date'] = date('Y-m-d H:i:s',time());
            
            $res = M('article')->add($add);
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '发表成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10004, '发表失败!'));
            }
        }
        $this->display('addArti2');
    }

}