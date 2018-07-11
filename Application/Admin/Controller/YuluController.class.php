<?php
namespace Admin\Controller;
use Think\Controller;

class YuluController extends Controller {
    
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
     * 上传图片
     */
    public function uploadImg(){
        $img = $this->A_img->uploadImg("Public/Uploads/yulu/");
        echo $img;
    }
    
    /**
     * 添加语录
     */
    public function yuluAdd(){
        if(IS_AJAX){
            //接收参数
            $content= trim($_POST['content']);
            $img = trim($_POST['img']);

            if($content == ''){
                $this->ajaxReturn($this->errmsg(10001,'内容不能为空'));
            }
            
            $id = session('a_id');
            $info = M('admin')->where('id='.$id)->find();
            
            if($img == ''){ //没上传图片则默认是发布者头像图片
                $add['img'] = $info['img']; 
            }else{
                $add['img'] = $img;
            }
            $add['uid'] = $id;
            $add['author']  = $info['nickname'];
            $add['content'] = $content;
            $add['maketime'] = time();
            
            $res = M('yulu')->add($add);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001,'新增失败'));
            }else{
                $this->ajaxReturn($this->errmsg(10000,'发布成功'));
            }
        }
        
        $this->display();
    }
    
    /**
     * 语录显示列表
     */
    public function yuluList(){
        $this->display('yuluList');
    }
    
    /**
     * ajax无刷新显示语录列表
     */
    public function yuluListAjax(){
        if(IS_AJAX){
            $uid_type = $_POST['uid_type'];
            $author = trim($_POST['author']);
            $keywords = trim($_POST['keywords']);   //关键字
            
            if($uid_type != ''){
                $where['uid_type'] = $uid_type;
            }
            
            if($author != ''){
                $where['author'] = array('like','%'.$author.'%');
            }
            
            if($keywords != ''){
                $where['content'] = array('like','%'.$keywords.'%');
            }
            
            //总记录数  页大小  总页数
            $count = M('yulu')->where($where)->count();// 查询满足要求的总记录数
            $pageSize = 10;
            $totalPage = ceil($count/$pageSize);
            
            //当前页  起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $totalPage) ? $currPage : 1;
            $startRow = $pageSize * ($currPage-1); 
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = M('yulu')->field(true)->where($where)->limit($startRow.','.$pageSize)->order('id')->select();
            foreach($list as $k => $v){
                $list[$k]['type'] = $v['uid_type'] == 1 ? '后台管理员' : '前台用户';
            }
            
            //echo M()->getLastSql();exit;
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;  //当前页
            $data['total_page'] = $totalPage;   //总页数
            $data['list'] = empty($list) ? false : $list;
            echo json_encode($data);
        }
    }
    
    /**
     * 语录禁用或启用
     */
    public function yuluChange(){
        if(IS_AJAX){
            $data['is_ok'] = $_POST['state'];
            $where['id'] = $_POST['id'];
            $info = M('yulu')->where($where)->save($data);
            $this->ajaxReturn($info);
        }
    }
    
    /**
     * 修改语录
     * 留用，可能语录不能修改，只能做删除处理
     * 因为用户也可添加自己的语录，所以管理员只能修改自己写的语录  可以禁用用户的语录，但不能删除
     */
    public function yuluEdit(){
        
        if(IS_AJAX){
            $id = $_POST['id'];
            $content = trim($_POST['content']);
            
            if(!$id){
                $this->ajaxReturn($this->errmsg(10001, '语录不存在'));
            }
            
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10001, '内容不能为空'));
            }
            
            $data['content'] = $content;
            $res = M('yulu')->where('id='.$id)->save($data);
            
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '修改失败'));
            }else{
                $this->ajaxReturn($this->errmsg(10000, '修改成功'));
            }
        }
        
        $id = $_GET['id'];
        $info = M('yulu')->where('id='.$id)->find();
        $this->assign('info',$info);
        
        $this->display();
    }
    
    /**
     * 删除语录
     * 管理员只能删除自己写的语录  不能删除用户写的  只能禁用用户的
     */
    public function yuluDel(){
        
        if(IS_AJAX){
            $id = $_POST['id'];
            if(!$id){
                $this->ajaxReturn($this->errmsg(10001, '语录不存在'));
            }
            
            $flag = M('yulu')->where('id='.$id)->delete();
            
            if($flag){
                
                M('yulu_like')->where('yulu_id='.$id)->delete();
                
                $this->ajaxReturn($this->errmsg(10000, '删除成功'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }    
        }    
    }
    
    /**
     * 批量删除语录
     */
    public function allDelYulu(){
        if(IS_AJAX){
            $id = trim($_POST['id']);
            //var_dump($id);
            $where['id'] = array('in',$id);
            $flag = M('yulu')->where($where)->delete();
            if($flag){
                
                $wh['yulu_id'] = array('in',$id);
                M('yulu_like')->where($wh)->delete();
                
                $this->ajaxReturn($this->errmsg(10000, '批量删除成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '批量删除失败!'));
            }
        }
    }
}