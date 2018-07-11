<?php
namespace Admin\Controller;
use Think\Controller;

class JokeController extends Controller {
    
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
     * 添加图片 */
    public function uploadImg(){
        $img = $this->A_img->uploadImg('Public/Uploads/joke/');
        echo $img;
    }
    
    /**
     * 添加幽默笑话  */
    public function addJoke(){
        
        if(IS_AJAX){
            //接收参数
            $content = trim($_POST['content']);
            $img = trim($_POST['img']);
            
            if ($content == ''){
                $this->ajaxReturn($this->errmsg(10001, '内容不能为空!'));
            }
            
            $id = session('a_id');
            $info = M('admin')->field('nickname,img')->where('id='.$id)->find();
            
            if($img == ''){ //没上传图片则默认为个人头像
                $data['img'] = $info['img'];
            }else{
                $data['img'] = $img;
            }
            $data['uid'] = $id;
            $data['author'] = $info['nickname'];
            $data['content'] = $content;
            $data['maketime'] = time();
            
            $res = M('joke')->add($data);
            
            if ($res){
                $this->ajaxReturn($this->errmsg(10000, '添加成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '添加失败!'));
            }
        }
        
        $this->display('addJoke');
    }
    
    /**
     * 幽默笑话列表  */
    public function listJoke(){
        $this->display('listJoke');
    }
    
    /**
     * ajax无刷新分页显示幽默笑话  */
    public function ajaxListJoke(){
        if(IS_AJAX){
            //接收参数
            $uid_type = $_POST['uid_type'];
            $author = trim($_POST['author']);
            $content = trim($_POST['keywords']);
            
            if($uid_type != ''){
                $where['uid_type'] = $uid_type;
            }
            
            if ($author != ''){
                $where['author'] = array('like','%'.$author.'%');
            }
            
            if ($content != ''){
                $where['content'] = array('like','%'.$content.'%');
            }
            
            //总记录数   每页显示数   总页数
            $count = M('joke')->where($where)->count();
            $pageSize = 10;
            $pageTotal = ceil($count/$pageSize);
            
            //当前页  起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= $pageTotal) ? $currPage : 1;
            $startRow = ($currPage - 1)* $pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            $list = M('joke')->field('id,uid_type,author,img,content,like_count,maketime,is_ok')->where($where)->order('maketime desc')->limit($startRow.','.$pageSize)->select();
            
            //echo M()->getLastSql();exit;

            foreach ($list as $k => $v){
                $list[$k]['type'] = $v['uid_type'] == 1 ? '后台管理员' : '前台用户';
            }
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page'] = $pageTotal;//总页数
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
        }
    }
    
    /**
     * 禁用/启用幽默笑话  */
    public function changeJoke(){
        if(IS_AJAX){
            $id = trim($_POST['id']);
            $data['is_ok'] = trim($_POST['state']);
            $info = M('joke')->where('id='.$id)->save($data);
            $this->ajaxReturn($info);
        }
    }
    
    /**
     * 修改幽默笑话  
     * 留用，可能不需要，只能删除不允许修改*/
    public function editJoke(){
        if(IS_AJAX){
            $id = $_POST['id'];
            $content = trim($_POST['content']);
            
            if(!$id){
                $this->ajaxReturn($this->errmsg(10001, '幽默笑话不存在!'));    
            }
            
            if($content == ''){
                $this->ajaxReturn($this->errmsg(10001, '内容不能为空!'));
            }
            
            $data['content'] = $content;
            $flag = M('joke')->where('id='.$id)->save($data);
            if($flag){
                $this->ajaxReturn($this->errmsg(10000, '修改成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '修改失败!'));
            }
        }
        
        $id = $_GET['id'];
        $row = M('joke')->where('id='.$id)->find();
        $this->assign('info',$row);
        $this->display();
    }
    
    /**
     * 删除幽默笑话  */
    public function delJoke(){
        if(IS_AJAX){
            $id = $_POST['id'];
            $flag = M('joke')->where('id='.$id)->delete();
            if($flag){
                
                M('joke_like')->where('joke_id='.$id)->delete();
                
                $this->ajaxReturn($this->errmsg(10000, '删除成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '删除失败!'));
            }
        }
    }
    
    /**
     * 批量删除幽默笑话  */
    public function allDelJoke(){
        if(IS_AJAX){
            $id = trim($_POST['id']);
            //var_dump($id);exit;
            $where['id'] = array('in',$id);
            $flag = M('joke')->where($where)->delete();
            if($flag){
                
                $wh['joke_id'] = array('in',$id);
                M('joke_like')->where($wh)->delete();
                
                $this->ajaxReturn($this->errmsg(10000, '批量删除成功!'));
            }else{
                $this->ajaxReturn($this->errmsg(10001, '批量删除失败!'));
            }
        }
    }
      
}