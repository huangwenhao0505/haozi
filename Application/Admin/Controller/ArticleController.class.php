<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleController extends Controller {
    
    public function __construct(){
        parent::__construct();
        $this->A_login = A('Login');
        $this->A_login->isLogin();
        $this->A_img = A('Img');
    }
    
    public function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     *上传图像
     */
    public function artiPosterImg(){
        $img = $this->A_img->uploadImg('Public/Uploads/article/');
        echo $img;
    }
    
    /**
     * 添加文章  */
    public function addArticle(){
        if(IS_AJAX){
            $cid   = trim($_POST['cid']);
            $fineId = trim($_POST['fineId']);
            $title = trim($_POST['title']);
            $jianjie = trim($_POST['jianjie']);
            $content = trim($_POST['editorValue']);
            $img_url = trim($_POST['img_url']); //文章封面图
            
            if($cid == 0)
            {
                $this->ajaxReturn($this->errmsg(10006, '请选择所属类别!'));
            }
            
            if($title == ''){
                $this->ajaxReturn($this->errmsg(10001,'标题不能为空!'));
            }
            
            //if(!preg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,15})$/",$title)){
            //$this->ajaxReturn($this->errmsg(10001, '标题不能包含特殊字符，15字以内!'));
            //}
            
            if($jianjie == ''){
                $this->ajaxReturn($this->errmsg(10002, '简介不能为空!'));
            }
            
            //if(!preg_match("/^([\u4e00-\u9fa5]+|[a-zA-Z0-9]{6,50})$/",$jianjie)){
            //$this->ajaxReturn($this->errmsg(10002, '简介不能包含特殊字符，50字以内!'));
            //}
            
            if($img_url == '' || $img_url == null){
                $this->ajaxReturn($this->errmsg(10005, '请按正确的格式上传封面图!'));
            }
            
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10003, '内容不能为空!'));
            }
            
            $id = session('a_id');
            $info = M('admin')->field('username,nickname')->where('id='.$id)->find();
            
            $add['img_url'] = $img_url;
            $add['uid'] = $id;
            $add['categoryId'] = $cid;
            $add['is_fine'] = $fineId;
            $add['author'] = $info['nickname'];
            $add['title'] = $title;
            $add['jianjie'] = $jianjie;
            $add['content'] = $content;
            $add['create_date'] = date('Y-m-d H:i:s',time());
            
            $res = M('article')->add($add);
            
            if($res){
                //新增文章成功之后，删除redis键，以免缓存导致新增的文章无法显示
                //A('redis')->redis()->del('articleList');
                
                $this->ajaxReturn($this->errmsg(10000, '发布成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10004, '发布失败!'));
            }
        }
        
        //显示顶级分类列表
        $w['parentId'] = 0;
        $list = M('article_category')->where($w)->select();
        $this->assign('list',$list);
        $this->display('artAdd');
    }
    
    /**
     * 显示文章列表页面  */
    public function listArticle(){
        $this->display('artList');
    }
    
    /**
     * ajax无刷新分页文章列表  */
    public function ajaxListArticle(){

        if(IS_AJAX){
            $uid_type = $_POST['uid_type'];
            $author = trim($_POST['author']);
            $title = trim($_POST['title']);
            
            if($uid_type != ''){
                $where['uid_type'] = $uid_type;
            }
            
            if($author != ''){
                $where['author'] = array('like','%'.$author.'%');
            }
            
            if($title != ''){
                $where['title'] = array('like','%'.$title.'%');
            }
            
            //总记录数   每页显示数   总页数
            $count = M('article')->where($where)->count();
            $pageSize = 10;
            $totalPage = ceil( $count/$pageSize );
            
            //当前页   起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            $startRow = ($currPage - 1) * $pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            /*//redis运用
            $redis = A('redis')->redis();
            // 获取存储的数据并输出
            $result = json_decode($redis->get("articleList"),'true');
            
            if(empty($result)){
                echo 1;
                // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
                $list = M('article')->field(true)->where($where)->limit($startRow.','.$pageSize)->order('create_date desc')->select();
                //重新将缓存放入数据库 redis不能直接存数组需要转成json
                $redis->set('articleList',json_encode($list));
            }else{
                echo 2;
                // 获取存储的数据并输出
                $list = json_decode($redis->get("articleList"),'true');
            }*/
            
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = M('article')->field(true)->where($where)->limit($startRow.','.$pageSize)->order('create_date desc')->select();
            foreach($list as $k => $v){
                $w['id'] = $v['categoryid'];
                $category = M('article_category')->where($w)->find();
                $list[$k]['cateName'] = $category['name'];
                $list[$k]['isTop'] = $v['is_top'] == 0 ? '否' : '是';
                $list[$k]['isRecommend'] = $v['is_recommend'] == 0 ? '否' : '是';
                $list[$k]['type'] = $v['uid_type'] == 1 ? "后台管理员" : "前台用户";
                $list[$k]['isFine'] = $v['is_fine'] == 1 ? "是" : "否";
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['totalPage']= $totalPage;//总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }      
    }
    
    /**
     * 删除文章  */
    public function deleteArticle(){
        if(IS_AJAX){
            $id = $_POST['id']; //文章ID
            $flag = M('article')->where('id='.$id)->delete();

            if($flag){
                
                //删除文章成功之后，删除redis键，以免缓存导致删除的文章还显示在页面
                //A('redis')->redis()->del('articleList');
                
                M('article_comment')->where('article_id='.$id)->delete();
                M('article_img')->where('article_id='.$id)->delete();
                M('article_like')->where('acticle_id='.$id)->delete();
                
                $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '删除失败!'));
            }
        }
    }
    
    /**
     * 批量删除文章  */
    public function allDelArt(){
        if(IS_AJAX){
            $id = trim($_POST['id']);
            //var_dump($id);
            $where['id'] = array('in',$id);
            $flag = M('article')->where($where)->delete();

            if($flag){
                
                $wh['article_id'] = array('in',$id);
                M('article_comment')->where($wh)->delete();
                M('article_img')->where($wh)->delete();
                M('article_like')->where($wh)->delete();
                
                $this->ajaxReturn($this->errmsg(10000, '批量删除成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '批量删除失败!'));
            }
        }
    }
    
    /**
     * 编辑文章  */
    public function editArticle(){
        $id = $_GET['id'];
        $list = M('article')->field(true)->where('id='.$id)->find();
        
        $this->assign('list',$list);
        $this->display('artEdit');
    }
    
    /**
     * ajax编辑文章
     * 必须与editArticle分开写，不然运用了第三方插件会报错 */
    public function editArticleAjax(){
        
        if(IS_AJAX){
            $id = $_POST['id'];
            $title = trim($_POST['title']);
            $jianjie = trim($_POST['jianjie']);
            $content = trim($_POST['content']);
            $img_url = trim($_POST['img_url']); //文章封面图
        
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
        

            if($img_url != ''){ //有传图片时就修改，没有则用原来的
                $data['img_url'] = $img_url;
            }
            $data['title'] = $title;
            $data['jianjie'] = $jianjie;
            $data['content'] = $content;
        
            $res = M('article')->where('id='.$id)->save($data);

            if($res){
                //编辑文章成功之后，删除redis键，以免缓存导致新增的文章无法显示
                //A('redis')->redis()->del('articleList');
                
                $this->ajaxReturn($this->errmsg(10000, '编辑成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10004, '编辑失败!'));
            }
        }
    }
    
    /**
     * 文章详情*/
    public function articleDetail(){
        $id = I('get.id');  //文章ID
        $info = M('Article')->where('id='.$id)->find();
        if(!$info){
            $this->redirect('listArticle','',1,'该文章不存在!');
        }
        
        $this->assign('info',$info);
        $this->display('artDetail');
    }
    
    /**
     * 置顶  
     * @param id int 文章ID
     * @param is_top int 是否置顶  0未置顶  1已置顶*/
    public function articleComment(){
        
        if(IS_AJAX){
           $id = $_POST['id']; 
           $isTop = $_POST['is_top'];
           
           if($isTop == 1){
               $this->ajaxReturn($this->errmsg(10001, '已置顶!'));
               
           }else if($isTop == 0){
               $data['is_top'] = 1;
               $res = M('article')->where('id='.$id)->save($data);
               if($res){
                   
                   $this->ajaxReturn($this->errmsg(10000, '成功!'));
               }else{
                   $this->ajaxReturn($this->errmsg(10001, '失败!'));
               }
           }
           
        }
    }
    
    /**
     * 推荐
     * @param id int 文章ID
     * @param is_recommend int 是否置顶  0未推荐 1已推荐*/
    public function articleRecommend(){
        
        if(IS_AJAX){
            $id = $_POST['id'];
            $isRecommend = $_POST['is_recommend'];
            
            if($isRecommend == 1){
                $this->ajaxReturn($this->errmsg(10001, '已推荐!'));
            }else if($isRecommend == 0){
                $data['is_recommend'] = 1;
                $res = M('article')->where('id='.$id)->save($data);
                if($res){
                    $this->ajaxReturn($this->errmsg(10000, '成功!'));
                }else{
                    $this->ajaxReturn($this->errmsg(10001, '失败!'));
                }
            }
        }
        
    }
    
    /**
     * 评论列表
     */
    public function articleCommentList(){
        $this->display('artCommentList');
    }
    
    /**
     * ajax无刷新显示评论列表
     * @param title string 文章标题*/
    public function articleCommentListAjax(){
        if(IS_AJAX){
            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            if($title != ''){
                $where['hwh_article.title'] = array('like','%'.$title.'%');
            }
            
            if($author != ''){
                $where['hwh_article.author'] = array('like','%'.$author.'%');
            }

            //总记录数   每页显示数   总页数
            $count = M('article_comment')->join('hwh_article ON hwh_article.id = hwh_article_comment.article_id','left')->where($where)->count();
            $pageSize = 5;
            $totalPage = ceil($count/$pageSize);
            
            //当前页   起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            $startRow = ($currPage - 1)* $pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $sql = "select a.author,a.title,a.img_url,a.comment_count,c.id,c.parent_id,c.content,u.username,u.nickname
            from hwh_article_comment c 
            LEFT JOIN hwh_article a ON c.article_id = a.id 
            LEFT JOIN hwh_user u ON u.id = c.uid
            where a.title like '%".$title."%' and a.author like '%".$author."%' and c.state = 1 order by c.article_id desc, c.parent_id asc, c.create_date desc limit $startRow,$pageSize";
            $list = M()->query($sql);
            //echo M()->getLastSql();exit;
            
            foreach($list as $k => $v){
                $list[$k]['username'] = $v['nickname'] != '' ? $v['nickname'] : $v['username'];
                $list[$k]['parent_name'] = $v['parent_id'] == 0 ? '一级评论' : '————二级评论';
                
                //$id = $v['id'];
                //$sql2 = "select parent_id,content from hwh_article_comment where parent_id = $id";
                //$list['parent'] = M()->query($sql2);
            }
            
            $data['count'] = $count;
            $data['currPage'] = $currPage;
            $data['totalPage']= $totalPage;
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
        }
    }
    
    /**
     * 删除评论
     * @param id int 评论ID*/
    public function articleCommentDel(){
        if(IS_AJAX){
            $id = $_POST['id'];

            if(!$id){
                $this->ajaxReturn($this->errmsg(10001, '评论不存在!'));
            }
            
            $pid = M('article_comment')->field('parent_id,article_id')->where('id='.$id)->find();
            
            if($pid['parent_id'] == 0){ //一级评论被删除，则删除所有二级评论
                
                $res = M('article_comment')->where('id='.$id)->delete();
                if($res){
                    //该一级评论下的所有二级评论数量
                    $count = M('article_comment')->where('parent_id='.$id)->count();
                    //删除所有二级评论
                    M('article_comment')->where('parent_id='.$id)->delete();
                    
                    //被删除的评论总数量（一级和二级）
                    $counts = $count + 1;
                    //更新评论数量
                    $articleId = $pid['article_id'];
                    $sql = "update hwh_article set comment_count = (comment_count - $counts) where id = $articleId";
                    M()->execute($sql);
                    //echo M()->getLastSql();exit;
                    $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
                }else{
                    $this->ajaxReturn($this->errmsg(10001, '删除失败!'));
                } 
                  
            }else{
                $res = M('article_comment')->where('id='.$id)->delete();

                if($res){
                    //更新评论数量
                    $articleId = $pid['article_id'];
                    $sql2 = "update hwh_article set comment_count = (comment_count - 1) where id = $articleId";
                    M()->execute($sql2);
                    //echo M()->getLastSql();exit;
                    $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
                }else{
                    $this->ajaxReturn($this->errmsg(10001, '删除失败!'));
                } 
            }
        }
    }
    
    /**
     * 拉黑文章（用户的文章）*/
    public function addArticleBlack(){
        if(IS_AJAX){
            $id = $_POST['id'];
            $info = M('article')->where('id='.$id)->find();
            if(!$info){
                $this->ajaxReturn($this->errmsg(10001, '该文章不存在！'));
            }
            
            $res = M('article')->where('id='.$id)->data('is_black=1')->save();
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '拉黑成功！'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '拉黑失败！'));
            }
        }
    }
    
}