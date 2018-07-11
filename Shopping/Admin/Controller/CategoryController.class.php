<?php
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends Controller {
    
    public function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 新增商品分类
     * @param goodsCategoryName string 分类名称
     * @param goodsCategoryId int 父分类id
     * @param orderNum int 排序号
     * @param isShow int 是否显示
     * @param image string 封面图*/
    public function addGoodsCategory(){
        if(IS_AJAX){
            $goodsName = I('post.goodsCategoryName');
            if($goodsName == ''){
                $this->ajaxReturn($this->errmsg(10001, '请填写商品分类名称！'));
            }
            $w['name'] = $goodsName;
            $row = M('goods_category')->where($w)->find();

            if($row){
                $this->ajaxReturn($this->errmsg(10001, '商品分类名称已经存在！'));
            }
            
            $parentId = I('post.goodsCategoryId');
            $orderNum = I('post.orderNum');
            $isShow   = I('post.isShow');
            $image    = I('post.image');
            
            $add['name'] = $goodsName;
            $add['parentId'] = $parentId;
            $add['orderNum'] = $orderNum;
            $add['isShow']   = $isShow;
            $add['image'] = $image;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $res = M('goods_category')->add($add);
            
            if($res){
                $this->ajaxReturn($this->errmsg(10000, '新增成功！'));
            }else{
                $this->ajaxReturn($this->errmsg(10002, '新增失败！'));
            }
        }
        
        $where['parentId'] = 0;
        $where['isShow'] = 1;
        $goodsCatList = M('goods_category')->where($where)->select();//商品顶级分类列表
        $this->assign('goodsCatList',$goodsCatList);
        
        $this->display('addGoodsCategory');
    }
    
    /**
     * 商品分类列表*/
    public function getGoodsCategoryList(){
        $this->display('goodsCatList');
    }
    
    /**
     * ajax无刷新显示商品分类列表*/
    public function getGoodsCategoryListAJAX(){
        if(IS_AJAX){
            $where['parentId'] = 0;
            $list = M('goods_category')->where($where)->order('orderNum')->select();
            foreach($list as $k => $v){
                $list[$k]['shows'] = $v['isshow'] == 1 ? "是" : "否";
                $w['parentId'] = $v['id'];
                $list[$k]['parentname'] = M('goods_category')->where($w)->select();
                foreach($list[$k]['parentname'] as $key => $val){
                    $list[$k]['parentname'][$key]['shows'] = $val['isshow'] == 1 ? "是" : "否";
                }
            }
            $data['list'] = $list != false ? $list : false;
            echo json_encode($data);
        }
    }
    
    /**
     * 编辑商品分类
     * @param id int 分类id
     * @param goodsCategoryName string 分类名称
     * @param goodsCategoryId int 父分类id
     * @param orderNum int 排序号
     * @param isShow int 是否显示
     * @param image string 封面图*/
    public function editGoodsCategory(){
        
        $id = I('get.id');
        $info = M('goods_category')->where('id='.$id)->find();
        
        $goodsCatList = M('goods_category')->where('parentId=0 and isShow=1')->select();
        foreach($goodsCatList as $k => $v){
            $goodsCatList[$k]['son'] = M('goods_category')->where('isShow = 1 and parentId='.$v['id'])->select();
        }

        $this->assign('categoryInfo',$info);//分类信息
        $this->assign('goodsCatList',$goodsCatList);//分类列表
        $this->display('editGoodsCategory');
    }
    
    /**
     * 显示或隐藏商品分类
     * @param id int 分类id
     * @param parentId int 是否是父分类id 0是  其他的不是
     * @param type int 显示或隐藏   0隐藏  1显示*/
    public function isShow(){
        if(IS_AJAX){
            $id = I('post.id');
            $parentId = I('post.parentId');
            $type = I('post.type');
            if($parentId == 0){//是父分类id，其下的子分类id也要随之而变
                $sql = "update hwh_goods_category set isShow = $type where id = $id or parentId = $id";
                M()->execute($sql);
            }else{//不是父分类id,则只隐藏或显示这个id
                $sql = "update hwh_goods_category set isShow = $type where id = $id";
                M()->execute($sql);
            }            
        }
    }
    
    /**
     * 删除商品分类
     * @param id int 分类id*/
    public function delGoodsCategory(){
        if(IS_AJAX){
            $id = I('post.id');
            if($id == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择要删除的分类'));
            }
            $where['id'] = $id;
            $res = M('goods_category')->where($where)->delete();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，删除失败'));
            }
            //删除成功，删除掉下面的子分类
            $w['parentId'] = $id;
            M('goods_category')->where($w)->delete();
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }

}