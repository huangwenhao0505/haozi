<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 商品相关的类*/
class GoodsController extends Controller {
    
    public function errmsg($errno,$errmsg,$data){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg,
            'data'  => $data
        );
        return $array;
    }
    
    /**
     * 选择某分类时，显示相应的子分类信息
     * @param id int 分类id*/
    public function showSonCategory(){
        if(IS_AJAX){
            $id = I('post.id');
            $w['parentId'] = $id;
            $list = M('goods_category')->where($w)->select();
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);
        }
    }
    
    /**
     * 添加商品
     * @param categoryId int 分类id
     * @param attrIdList string 商品属性名称id（以,号连接）
     * @param name string 商品名称
     * @param oldPrice double 商品原价
     * @param price double 商品销售价
     * @param unitName string 计量单位（件，张..）
     * @param isShow int 是否上架
     * @param attrIdList 商品规格属性id(,连接   如: 1,4)
     * */
    public function goodsAdd(){
        if(IS_AJAX){
            $attrIdList = I('post.attrIdList');
            $categoryId = I('post.categoryId');
            $goodsName = I('post.name');
            $oldPrice = I('post.oldPrice');
            $unitName = I('post.unitName');
            $price = I('post.price');
            $isShow= I('post.isShow');
            $attrIdList = I('post.attrIdList');

            if($categoryId == 0){
                $this->ajaxReturn($this->errmsg(10001, '请选择商品分类'));
            }
            if($attrIdList == ""){
                $this->ajaxReturn($this->errmsg(10001, '请选择商品属性'));
            }
            $arr = explode(',', $attrIdList);
            if(count($arr) > 2){
                $this->ajaxReturn($this->errmsg(10001, '商品属性最多只能选择2个'));
            }
            if($goodsName == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品名称'));
            }
            if($oldPrice == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品原价'));
            }
            if($price == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品销售价'));
            }
            if(is_numeric($oldPrice) == false){
                $this->ajaxReturn($this->errmsg(10001, '请输入正确的商品原价'));
            }
            if(is_numeric($price) == false){
                $this->ajaxReturn($this->errmsg(10001, '请输入正确的商品销售价'));
            }
            //当商品存在时
            $wh['categoryId'] = $categoryId;
            $wh['name'] = $goodsName;
            $flag = M('goods')->where($wh)->find();
            if($flag){
                $this->ajaxReturn($this->errmsg(10001, '该商品已经存在'));
            }

            //根据商品属性id得出商品属性名称
            $newIdArray = explode(',', $attrIdList);
            foreach($newIdArray as $k => $v){
                $w['id'] = $v;
                $info = M('attribute_name')->field('attrName')->where($w)->find();
                $attrName[] = $info['attrname'];
            }
            $attrNameList = implode(',', $attrName);
            
            //插入数据库
            $add['categoryId'] = $categoryId;
            $add['name'] = $goodsName;
            $add['price'] = $price;
            $add['oldPrice'] = $oldPrice;
            //$add['img'] = $img;
            //$add['description'] = $description;
            $add['unitName'] = $unitName;
            $add['attrNameIdList'] = $attrIdList;
            $add['attrNameList'] = $attrNameList;
            $add['isMarketable'] = $isShow;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            
            $res = M('goods')->add($add);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，新增失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '新增成功',$res));
        }
        
        $categoryList = M('goods_category')->field('id,name')->where('isShow=1 and parentId=0')->select();//商品分类

        $goodsAttrList= M('attribute_name')->select();//商品属性
        $this->assign('categoryList',$categoryList);
        $this->assign('goodsAttrList',$goodsAttrList);
        $this->display('goodsAdd');
    }
    
    /**
     * 添加商品规格
     * @param goodsId int 所属商品id
     * @param attrIdList string 商品属性（多个属性值之间以,号连接）
     * @param attrValueList string 商品规格（多个规格之间以,号连接）
     * @param price double 商品价格
     * @param stock int 库存
     * */
    public function goodStoreAdd(){
        if(IS_AJAX){
            //接收参数
            $goodsId = I('post.goodsId');
            $attrIdList = I('post.attrIdList');
            $attrValueList = I('post.attrValueList');
            $price = I('post.price');
            $stock = I('post.stock');

            //验证
            if($goodsId == null || $goodsId == ''){
                $this->ajaxReturn($this->errmsg(10001, '请先保存商品信息！'));
            }
            
            //判断该商品规格是否已经存在
            $arr = explode(',', $attrValueList);//分割字符串
            if (count($arr) == 1) 
            {
                $attrValue1 = $arr[0];
                $attrValue2 = '';
            } 
            else if (count($arr) == 2) 
            {
                $attrValue1 = $arr[0];
                $attrValue2 = $arr[1];
                $attrValue3 = '';
            } 
            else 
            {
                $attrValue1 = $arr[0];
                $attrValue2 = $arr[1];
                $attrValue3 = $arr[2];
            }
            
            $sql = "select id from hwh_goods_store where goodsId = $goodsId and attrValue1 = '{$attrValue1}' and attrValue2 = '{$attrValue2}' and attrValue3 = '{$attrValue3}'";
            $info = M()->query($sql);
            if($info){
                $this->ajaxReturn($this->errmsg(10001, '该商品属性规格已经存在'));
            }

            //当有选择商品属性时，商品属性规格也必须选择
            if($attrIdList != ''){
                if(preg_match('/0/',$attrValueList)){//只要包含有0，则代表其中有  没有选择的属性规格
                    $this->ajaxReturn($this->errmsg(10001, '请选择商品属性规格'));
                }
            }

            //插入商品属性规格表
            $d['goodsId'] = $goodsId;
            $d['attrValue1'] = $attrValue1;
            $d['attrValue2'] = $attrValue2;
            $d['attrValue3'] = $attrValue3;
            $d['price'] = $price;
            $d['stock'] = $stock;
            $d['createDate'] = date('Y-m-d H:i:s',time());
            M('goods_store')->add($d);
        }
    }
    
    /**
     * 显示某个商品规格属性列表
     * @param goodsId int 商品id*/
    public function goodStoreList(){
        if(IS_AJAX){
            $goodsId = I('post.goodsId');
            $sql = "select id, goodsId, ifnull(attrValue1,'') attrvalue1, ifnull(attrValue2,'') attrvalue2, ifnull(attrValue3,'') attrvalue3, price, stock, soldNum from hwh_goods_store where goodsId = $goodsId";
            $list = M()->query($sql);
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);
        }
    }
    
    /**
     * 编辑某个商品规格属性
     * @param id int 属性规格id
     * @param goodsId int 商品id
     * @param stock int 库存*/
    public function goodStoreEdit(){
        if(IS_AJAX){
            $id = I('post.id');
            $goodsId = I('post.goodsId');
            $stock = I('post.stock');
            $w['id'] = $id;
            $w['goodsId'] = $goodsId;
            $d['stock'] = $stock;
            $res = M('goods_store')->where($w)->save($d);
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '编辑失败'));
            }
            $this->ajaxReturn($this->errmsg(10000, '编辑成功'));
        }
    }
    
    /**
     * 删除某个商品规格属性
     * @param id int 属性规格id
     * @param goodsId int 商品id*/
    public function goodStoreDel(){
        if(IS_AJAX){
            $id = I('post.id');
            $goodsId = I('post.goodsId');
            $w['id'] = $id;
            $w['goodsId'] = $goodsId;
            $res = M('goods_store')->where($w)->delete();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 根据商品属性名id，得出商品属性名称
     * @param attrNameId string 属性名Id(多个以,号连接)
     * */
    public function getAttrNameList()
    {
        $id = I('post.attrNameId');
        $w['id'] = array("in", $id);
        $list = M('attribute_name')->field('attrName')->where($w)->select();
        $data['list'] = $list;
        echo json_encode($data);
    }
    
    
    /**
     * 当选择商品属性时，对应的商品属性值显示
     * @param id int 属性id
     * */
    public function attrValueList(){
        $id = I('post.id');
        $wh['attrNameId'] = $id;
        $attrValueList = M('attribute_value')->field('id,attrNameId,value')->where($wh)->select();//商品属性值
        $data['list'] = $attrValueList;
        echo json_encode($data);
    }
    
    /**
     * 商品列表
     * @param categoryId int 商品类型id
     * @param goodsName string 商品名称*/
    public function goodsList(){
        if(IS_AJAX){
            $categoryId = I('post.categoryId');
            $goodsName = I('post.goodsName');
            if($categoryId != 0){
                $w['parentId'] = $categoryId;
                $list = M('goods_category')->field('id')->where($w)->select();//该商品类型下面的子类型id
                $idArray = array();
                foreach($list as $k => $v){
                    $idArray[] = intval($v['id']);
                }

                $idArray[] = $categoryId;
                $categoryIdStr = implode(',', $idArray);
                $where['g.categoryId'] = array('in',$categoryIdStr);
            }
            if($goodsName != ''){
                $where['g.name'] = array('like','%'.$goodsName.'%');
            }
            
            $list = M('goods g')->field('c.name as categoryName,g.*')->join('__GOODS_CATEGORY__ c ON c.id=g.categoryId','LEFT')->where($where)->order('createDate desc')->select();
            foreach($list as $k => $v){
                $list[$k]['updatedate'] = $v['updatedate'] == '' ? '无' : $v['updatedate'];
                $list[$k]['isshow'] = $v['ismarketable'] == 1 ? '是' : '否';
            }
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
        
        //获取商品类型
        $sql = "select categoryId as id from hwh_goods group by categoryId";
        $categoryList = M()->query($sql);
        foreach($categoryList as $k => $v){
            $wh['id'] = $v['id'];
            $info = M('goods_category')->field('name')->where($wh)->find();
            $categoryList[$k]['name'] = $info['name'];
        }

        $this->assign('categoryList',$categoryList);
        $this->display('goodsList');
    }
    
    /**
     * 商品上下架操作
     * @param id int 商品id
     * @param type int 上架或下架*/
    public function changeMarketable(){
        if(IS_AJAX){
            $id = I('post.id');
            $type = I('post.type');
            $w['id'] = $id;
            $d['isMarketable'] = $type;
            M('goods')->where($w)->save($d);
        }
    }
    
    /**
     * 编辑商品
     * @param id int 商品id
     * @param categoryId int 商品分类id
     * @param attrIdList string 商品属性名称id（以,号连接  如：1,2,3）
     * @param name string 商品名称
     * @param oldPrice double 商品原价
     * @param unitName string 计量单位（件，张..）
     * @param price double 商品销售价
     * @param isShow int 是否上架
     * */
    public function goodsEdit(){
        
        if(IS_AJAX){
            $id = I('post.id');
            $categoryId = I('post.categoryId');
            $attrIdList = I('post.attrIdList');
            $goodsName = I('post.name');
            $oldPrice = I('post.oldPrice');
            $unitName = I('post.unitName');
            $price = I('post.price');
            $isShow= I('post.isShow');

            if($categoryId == 0){
                $this->ajaxReturn($this->errmsg(10001, '请选择商品分类'));
            }
            if($attrIdList == ""){
                $this->ajaxReturn($this->errmsg(10001, '请选择商品属性'));
            }
            if($goodsName == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品名称'));
            }
            if($oldPrice == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品原价'));
            }
            if($price == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品销售价'));
            }
            if(is_numeric($oldPrice) == false){
                $this->ajaxReturn($this->errmsg(10001, '请输入正确的商品原价'));
            }
            if(is_numeric($price) == false){
                $this->ajaxReturn($this->errmsg(10001, '请输入正确的商品销售价'));
            }
            
            //根据商品属性名称id得出商品属性名称name
            $newIdList = rtrim($attrIdList,',');
            $newIdArray = explode(',', $newIdList);
            foreach($newIdArray as $k => $v){
                $w['id'] = $v;
                $info = M('attribute_name')->field('attrName')->where($w)->find();
                $attrName[] = $info['attrname'];
            }
            $attrNameList = implode(',', $attrName);

            //更新数据库
            $d['categoryId'] = $categoryId;
            $d['name'] = $goodsName;
            $d['price'] = $price;
            $d['oldPrice'] = $oldPrice;
            //$d['img'] = $img;
            //$d['description'] = $description;
            $d['unitName'] = $unitName;
            $d['attrNameIdList'] = $attrIdList;
            $d['attrNameList'] = $attrNameList;
            $d['isMarketable'] = $isShow;
            $d['updateDate'] = date('Y-m-d H:i:s',time());
            
            $where['id'] = $id;
            $r = M('goods')->where($where)->save($d);
            echo M()->getLastSql();
            if(!$r){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，编辑失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '编辑成功'));
            exit;
        }//end ajax
        
        $id = I('get.id');
        $info = M('goods')->where('id='.$id)->find();//商品内容
        $attrIdList = $info['attridlist'];//商品属性值id hwh_attribute_name
        $attrIdArray = explode(',', $attrIdList);
        
        $categoryList = M('goods_category')->field('id,name')->where('isShow=1 and parentId=0')->select();//商品分类
        foreach($categoryList as $k => $v){
            $parentId = $v['id'];
            $res = M('goods_category')->field('id,name')->where('parentId='.$parentId)->select();
            $categoryList[$k]['son'] = $res;
        }
        
        $goodsAttrList= M('attribute_name')->select();//商品属性列表
        foreach ($goodsAttrList as $k => $v)
        {
            $attrId = $v['id'];//属性id
            if(strstr($info['attrnameidlist'], $attrId))
            {
                //该商品存在该属性
                $goodsAttrList[$k]['ischecked'] = 1;
            } else {
                //该商品不存在该属性
                $goodsAttrList[$k]['ischecked'] = 0;
            }
        }

        $this->assign('goodsInfo',$info);//商品内容显示赋值
        $this->assign('categoryList',$categoryList);//商品类型列表显示赋值
        $this->assign('goodsAttrList',$goodsAttrList);//商品属性名列表显示赋值
        $this->display();
    }
    
    /**
     * 删除商品
     * @param id int 商品id*/
    public function goodsDel(){
        if(IS_AJAX){
            $id = I('post.id');
            if($id == ''){
                $this->ajaxReturn($this->errmsg(10001, '商品不存在'));
            }
            $w['id'] = $id;
            $flag = M('goods')->where($w)->find();
            if(!$flag){
                $this->ajaxReturn($this->errmsg(10001, '商品不存在'));
            }
            
            $res = M('goods')->where($w)->delete();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，删除失败'));
            }
            
            //删除商品成功时，商品的相关规格属性也要删除掉
            $wh['goodsId'] = $id;
            M('goods_store')->where($wh)->delete();
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
}