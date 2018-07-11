<?php
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->A_login = A('Login');
        $this->A_login->isLogin();
    }
    
    public function errmsg($errno,$errmsg)
    {
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
        exit;
    }
    
    /**
     * 添加分类，文章分类标签*/
    public function addCategory()
    {
        if(IS_AJAX)
        {
            $parentId = $_POST['parentId'];
            $name     = $_POST['name'];
            
            if($name == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '分类名称不能为空'));
            }
            
            $w['parentId'] = $parentId;
            $w['name']     = $name;
            $flag = M('article_category')->where($w)->find();
            if($flag)
            {
                $this->ajaxReturn($this->errmsg(10001, '已存在该分类'));
            }
            
            $add['parentId']  = $parentId;
            $add['name']      = $name;
            $add['createDate']= date('Y-m-d H:i:s',time());
            $res = M('article_category')->add($add);
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '添加失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '添加成功'));
        }
        
        //获取顶级分类列表
        $wh['parentId'] = 0;
        $list = M('article_category')->where($wh)->select();
        $this->assign('list',$list);
        $this->display('addCategory');
    }
    
    /**
     * 分类列表*/
    public function listCategory()
    {
        if(IS_AJAX)
        {
            $w['parentId'] = 0;
            $list = M('article_category')->where($w)->select();
            foreach($list as $k => $v)
            {
                $wh['parentId'] = $v['id'];
                $list[$k]['sonCategory'] = M('article_category')->where($wh)->select();
            }
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);
            exit;
        }
        
        $this->display('listCategory');
    }
    
    /**
     * 删除分类
     * @param id int 分类id*/
    public function delCategory()
    {
        if(IS_AJAX)
        {
            $id = $_POST['id'];
            if($id == 0 || $id == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '请选择要删除的分类'));
            }
            
            //查询该分类是否是顶级分类
            $w['id'] = $id;
            $info = M('article_category')->field('parentId')->where($w)->find();
            if($info['parentid'] != 0)
            {
                //不是顶级分类
                $res = M('article_category')->where($w)->delete();
            }
            
            //是顶级分类则删除其对应的所有子分类
            $res = M('article_category')->where($w)->delete();
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            
            $wh['parentId'] = $id;
            M('article_category')->where($wh)->delete();
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 批量删除
     * @param idString string 分类id（多个,号连接）*/
    public function allDelCategory()
    {
        if(IS_AJAX)
        {
            $idString = $_POST['idString'];
            $w['id'] = array('in',$idString);
            $res = M('article_category')->where($w)->delete();
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 当点击顶级类别时，显示其子类别列表
     * @param id int 父类id*/
    public function sonCategoryList()
    {
        if(IS_AJAX)
        {
            $id = I('post.id');
            $where['parentId'] = $id;
            $res = M('article_category')->where($where)->order('createDate desc')->select();
            $data['list'] = $res == empty($res) ? false : $res;
            echo json_encode($data);
            exit;
        }
    }
    
    public function a(){
        $this->display();
    }
}