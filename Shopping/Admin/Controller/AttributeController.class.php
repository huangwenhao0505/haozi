<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 商品属性类
 * */
class AttributeController extends Controller
{
    public function errmsg($errno,$errmsg,$data){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg,
            'data'  => $data
        );
        return $array;
    }
    
    /**
     * 新增商品属性及其属性值
     * @param attrName string 属性名
     * @param attrValue string 属性值
     * */
    public function addAttr(){
        if(IS_AJAX){
            $attrName = I('post.attrName');
            $attrValue = I('post.attrValue');//字符串形式
            if($attrName == ''){
                $this->ajaxReturn($this->errmsg(10001, '请填写商品属性名'));
            }
            $w['attrName'] = $attrName;
            $row = M('attribute_name')->where($w)->find();
            if($row){
                $this->ajaxReturn($this->errmsg(10001, '商品属性名称已存在'));
            }
            if($attrValue == ','){//没有添加属性值
                $this->ajaxReturn($this->errmsg(10002, '请填写属性值，没有请填写"通用"'));
            }
    
            $add['attrName'] = $attrName;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $res = M('attribute_name')->add($add);
            if($res){
                $attrNameId = $res['id'];
                //添加属性成功时，保存其相对应的属性值
                $strValue  = rtrim($attrValue, ",");//去除最后一个,号
                $attrArray = explode(',', $strValue);
                foreach($attrArray as $k => $v){
                    $d['attrNameId'] = $attrNameId;
                    $d['value'] = $v;
                    M('attribute_value')->add($d);
                }
    
                $this->ajaxReturn($this->errmsg(10000, '新增成功'));
    
            }else{
                $this->ajaxReturn($this->errmsg(10003, '新增失败'));
            }
        }
        $this->display('attrAdd');
    }
    
    
    /**
     * 商品属性列表
     * @param attrName string 属性名
     * */
    public function listAttr(){
        if(IS_AJAX){
            $attrName = I('post.attrName');
            if($attrName != ''){
                $where['attrName'] = array('like','%'.$attrName.'%');
            }
            $list = M('attribute_name')->where($where)->select();
            foreach($list as $k => $v){
                $list[$k]['updatedate'] = $v['updatedate'] == '' ? '无' : $v['updatedate'];
    
                $w['attrNameId'] = $v['id'];
                $arr = M('attribute_value')->field('value')->where($w)->select();//二维数组
                $newArray = array();
                foreach($arr as $key => $val){
                    $newArray[] = $val['value'];//取出想要的数据，合并为一维数组
                }
                $string = implode(' ', $newArray);//以空格拼接为字符串
                $list[$k]['attrValue'] = $string;
            }
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
        $this->display('attrList');
    }
    
    
    
    /**
     * 编辑商品属性
     * @param id int 属性名id
     * @param attrName string 属性名
     * @param attrIdStr string 属性值id (各属性值id以,号连接)
     * @param attrValue string 属性值 (各属性值以,号连接)
     * @param addAttrValue string 新增的属性值
     * 注解：attrIdStr的值与attrValue的值相对应  如  (1,2, 红,黑,) => (1-红  2-黑)
     * */
    public function editAttr(){
        if(IS_AJAX){
            $id = I('post.id');
            $attrName = I('post.attrName');
            $attrIdStr = I('post.attrIdStr');
            $attrValue = I('post.attrValue');
            $addAttrValue = I('post.addAttrValue');
            //验证
            if($attrName == ''){
                $this->ajaxReturn($this->errmsg(10001, '请填写商品属性名'));
            }
    
            $where['id'] = $id;
            $info = M('attribute_name')->where($where)->find();
            if($info['attrname'] != $attrName){
                $w['attrName'] = $attrName;
                $row = M('attribute_name')->where($w)->find();
                if($row){
                    $this->ajaxReturn($this->errmsg(10001, '商品属性名称已存在'));
                }
            }
    
            if($attrValue == ','){
                $this->ajaxReturn($this->errmsg(10002, '请填写属性值，没有请填写"通用"'));
            }
    
            //编辑操作
            $d['attrName'] = $attrName;
            $d['updateDate'] = date('Y-m-d H:i:s',time());
            M('attribute_name')->where($where)->save($d);
    
            if($attrValue != '' && $attrIdStr != ''){
                $strId = rtrim($attrIdStr, ",");//去除最后一个,号
                $attrIdArray = explode(',', $strId);
                foreach($attrIdArray as $k => $v){
                    $newAttrId[] = $v;//取出id的值，合并为一个数组
                }
    
                $strValue  = rtrim($attrValue, ",");
                $attrArray = explode(',', $strValue);
                foreach($attrArray as $k => $v){
                    $newAttrValue[] = $v;//取出value的值，合并为一个数组
                }
    
                $newArray = array_combine($newAttrId,$newAttrValue);//把两数组合并，一个数组做为另一个数组的键值
    
                foreach($newArray as $k => $v){
                    $f['id'] = $k;
                    $data['value'] = $v;
                    M('attribute_value')->where($f)->save($data);
                }
    
            }
    
            //如果有新增的数据，则添加
            if($addAttrValue != ''){
                $addAttr = rtrim($addAttrValue, ",");
                $addAttrArray = explode(',', $addAttr);
                foreach($addAttrArray as $k => $v){
                    $wh['value'] = $v;
                    $rs = M('attribute_value')->where($wh)->find();
                    if(!$rs){//如果不存在则添加，存在的话就忽略，但不能给出错误提示，不然遍历就终止，没有的数据也不会添加进去
                        if($v != "" || $v != null){//添加了空白数据时，不插入到数据库
                            $add['attrNameId'] = $id;
                            $add['value'] = $v;
                            M('attribute_value')->add($add);
                        }
                    }
                }
            }
    
            $this->ajaxReturn($this->errmsg(10000, '修改成功'));
        }
    
        $id = I('get.id');//属性的id
        $attrName = M('attribute_name')->where('id='.$id)->find();
        $attrValue = M('attribute_value')->where('attrNameId='.$id)->order('id')->select();
        $this->assign('attrName',$attrName);
        $this->assign('attrValue',$attrValue);
        $this->display('attrEdit');
    }
    
    /**
     * 删除单个商品的属性值
     * @param id int 商品属性值id*/
    public function delAttrValue(){
        if(IS_AJAX){
            $id = I('post.id');
            if($id == ''){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            $where['id'] = $id;
            $flag = M('attribute_value')->where($where)->delete();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
    
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 删除商品属性
     * @param id int 商品属性id*/
    public function delAttr(){
        if(IS_AJAX){
            $id = I('post.id');
            $wh['id'] = $id;
            $res = M('attribute_name')->where($wh)->delete();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
    
            //删除成功，也删除对应的商品属性值
            $w['attrNameId'] = $id;
            M('attribute_value')->where($w)->delete();
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    } 
}