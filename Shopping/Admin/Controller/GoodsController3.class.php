<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 商品相关的类*/
class GoodsController extends Controller {
    
    public function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 新增商品属性及其属性值
     * @param attrName string 属性名
     * @param attrValue string 属性值
     * @param expandAttrValue string 扩展属性值
     * */
    public function addAttr(){
        if(IS_AJAX){
            //接收参数
            $attrName = I('post.attrName');
            $attrValue = I('post.attrValue');//字符串形式
            $expandAttrValue = I('post.expandAttrValue');//字符串形式
            
            //验证
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
            
            //处理扩展属性值
            $strExpandAttrValue = rtrim($expandAttrValue,",");
            
            //添加到数据库
            $add['attrName'] = $attrName;
            $add['expandAttrName'] = $strExpandAttrValue;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $res = M('attribute_name')->add($add);//新增成功的id
            if($res){
                //添加属性成功时，保存其相对应的属性值
                $strValue  = rtrim($attrValue, ",");//去除最后一个,号
                $attrArray = explode(',', $strValue);
                foreach($attrArray as $k => $v){
                    $d['attrNameId'] = $res;
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
                $list[$k]['attrvalue'] = $string;
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
     * 注解：attrIdStr的值与attrValue的值相对应  如  (1,2, 红,黑,) => (1-红  2-黑)
     * */
    public function editAttr(){
        if(IS_AJAX){
            //接收参数
            $id = I('post.id');
            $attrName = I('post.attrName');
            $attrIdStr = I('post.attrIdStr');
            $attrValue = I('post.attrValue');
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
            if($attrValue != ''){//属性值
                $addAttr = rtrim($attrValue, ",");
                $addAttrArray = explode(',', $addAttr);
                foreach($addAttrArray as $k => $v){
                    $wh['value'] = $v;
                    $rs = M('attribute_value')->where($wh)->find();
                    if(!$rs){//如果不存在则添加，存在的话就忽略，但不能给出错误提示，不然遍历就终止，没有的数据也不会添加进去
                        $add['attrNameId'] = $id;
                        $add['value'] = $v;
                        M('attribute_value')->add($add);
                    }
                }
            }
            
            $this->ajaxReturn($this->errmsg(10000, '修改成功'));
        }
        
        $id = I('get.id');//属性的id
        $attrName = M('attribute_name')->where('id='.$id)->find();
        $expandVal = explode(',', $attrName['expandattrname']);
        $attrValue = M('attribute_value')->where('attrNameId='.$id)->select();
        
        $this->assign('attrName',$attrName);//属性名
        $this->assign('expandValue',$expandVal);//扩展属性值
        $this->assign('attrValue',$attrValue);//属性值
        $this->display('attrEdit');
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
    
    /**
     * 添加商品
     * @param categoryId int 商品分类id
     * @param attrId int 商品属性id
     * @param name string 商品名称
     * @param oldPrice double 商品原价
     * @param price double 商品销售价
     * @param unitName string 计量单位（件，张..）
     * @param stock int 商品库存
     * @param isShow int 是否上架
     * @param newAttrValueArray array 扩展属性 （包括属性值id，扩展属性值，库存，计量单位）多维数组*/
    public function goodsAdd(){
        if(IS_AJAX){
            $categoryId = I('post.categoryId');
            $attrId = I('post.attrId');
            $attrIdList = I('post.attrIdList');
            $goodsName = I('post.name');
            $oldPrice = I('post.oldPrice');
            $unitName = I('post.unitName');
            $price = I('post.price');
            $stock = I('post.stock');
            $isShow= I('post.isShow');
            $newAttrValueArray = I('post.newAttrValueArray');
            
            if($categoryId == 0){
                $this->ajaxReturn($this->errmsg(10001, '请选择商品分类'));
            }
            if($attrId == 0){
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
            //库存处理  [填写了统一库存，商品库存就以统一库存为主 ; 没有填写统一库存，则商品库存填写扩展属性时的每个库存之和]
            if(empty($newAttrValueArray)){
                if($stock == ''){
                    $this->ajaxReturn($this->errmsg(10001, '请输入商品库存'));
                }
                if(is_numeric($stock) == false || $stock <= 0){
                    $this->ajaxReturn($this->errmsg(10001, '请输入正确的库存'));
                }
                $goodsStock = $stock;
            }else{
                if($stock != ''){
                    $goodsStock = $stock;
                }else{
                    $goodsStock = "";
                    foreach($newAttrValueArray as $k => $v){
                        $goodsStock += $v[0]['stock'];//库存
                    }
                }
            }

            //添加商品到数据库
            $d['categoryId'] = $categoryId;
            $d['attributeId'] = $attrId;
            $d['name'] = $goodsName;
            $d['price'] = $price;
            $d['oldPrice'] = $oldPrice;
            $d['stock'] = $goodsStock;
            //$d['img'] = $img;
            //$d['description'] = $description;
            $d['unitName'] = $unitName;
            $d['isMarketable'] = $isShow;
            $d['createDate'] = date('Y-m-d H:i:s',time());
            $goodsFlag = M('goods')->add($d);
            
            if(!$goodsFlag){
                $this->ajaxReturn($this->errmsg(10001, '新增失败'));
            }
            
            //新增成功，添加其具体商品的属性值
            //遍历$newAttrValueArray，得出其相对应的值
            foreach($newAttrValueArray as $k => $v){
                $aid = $v[0]['id'];//商品属性值id
                $wh['id'] = $aid;
                $info = M('attribute_value')->field('value')->where($wh)->find();
                $aname = $info['value'];//商品属性值名称
                $aStock = $v[0]['stock'];//库存
                $aunit = $v[0]['unit'];//计量单位
                if($aStock == ''){//如果商品扩展没有填写库存，则统一使用库存和计量单位
                    $aStock = $stock;
                    $aunit = $unitName;
                    if($aStock == ''){
                        $this->ajaxReturn($this->errmsg(10002, '请填写库存'));
                    }
                    if($aunit == ''){
                        $this->ajaxReturn($this->errmsg(10002, '请填写计量单位'));
                    }
                }
                $aExpandAttrStr = $v[0]['expandAttrStr'];//商品扩展属性值，字符串形式,号连接
                $aExpandAttrArr = explode(',', $aExpandAttrStr);//分割字符串为数组
                foreach($aExpandAttrArr as $key => $val){
                    //插入数据库
                    $add['goodsId'] = $goodsFlag;
                    $add['attrValue1'] = $aname;
                    $add['attrValue2'] = $val;
                    $add['stock'] = $aStock;
                    $add['unitName'] = $aunit;
                    $add['price'] = $price;
                    $add['createDate'] = date('Y-m-d H:i:s',time());
                    M('goods_store')->add($add);
                }
            }
            
            $this->ajaxReturn($this->errmsg(10000, '新增成功'));
        }
        
        $categoryList = M('goods_category')->field('id,name')->where('isShow=1 and parentId=0')->select();//商品分类
        foreach($categoryList as $k => $v){
           $parentId = $v['id'];
           $res = M('goods_category')->field('id,name')->where('parentId='.$parentId)->select(); 
           $categoryList[$k]['son'] = $res;
        }

        $goodsAttrList= M('attribute_name')->select();//商品属性
        $this->assign('categoryList',$categoryList);
        $this->assign('goodsAttrList',$goodsAttrList);
        $this->display();
    }
    
    /**
     * 当选择商品属性时，对应的商品属性值显示
     * @param id int 属性id
     * */
    public function attrValueList(){
        $wh['v.attrNameId'] = I('post.id');
        $attrValueList = M('attribute_value v')->field('v.id,v.value,n.expandAttrName')->join('__ATTRIBUTE_NAME__ n on n.id = v.attrNameId')->where($wh)->select();//商品属性值
        $data['list'] = $attrValueList == empty($attrValueList) ? false : $attrValueList;
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
            
            /*$list = M('goods_store s')
            ->field('c.name as categoryName,g.name,g.price,g.img,s.id,s.attrValue1,s.attrValue2,s.stock,s.soldNum,s.unitName,s.createDate,s.updateDate')
            ->join('__GOODS__ g ON s.goodsId = g.id','LEFT')
            ->join('__GOODS_CATEGORY__ c ON c.id = g.categoryId','LEFT')
            ->where($where)
            ->select();*/
            $list = M('goods g')->field('g.*,c.name as categoryName')->join('__GOODS_CATEGORY__ c ON c.id = g.categoryId')->select();
            foreach($list as $k => $v){
                $list[$k]['updatedate'] = $v['updatedate'] == '' ? '无' : $v['updatedate'];
                $list[$k]['ismarketable'] = $v['ismarketable'] == 1 ? '是' : '否';
            }
            $data['list'] = $list == empty($list) ? false : $list;
            echo json_encode($data);exit;
        }
        
        //获取商品类型
        $sql = "select c.id,c.name from hwh_goods g left join hwh_goods_category c on c.id = g.categoryId where g.isMarketable = 1 and c.parentId = 0 group by g.categoryId";
        $categoryList = M()->query($sql);
        $this->assign('categoryList',$categoryList);
        $this->display();
    }
    
    /**
     * 编辑商品
     * @param id int 商品id
     * @param name string 商品名称
     * @param oldPrice double 商品原价
     * @param unitName string 计量单位（件，张..）
     * @param isShow int 是否上架
     * @param goodsStoreValueList array 数组形式，商品的属性值列表【id-商品销售价格-库存】
     * */
    public function goodsEdit(){
        
        if(IS_AJAX){
            $id = I('post.id');
            $goodsName = I('post.name');
            $oldPrice = I('post.oldPrice');
            $unitName = I('post.unitName');
            $isShow = I('post.isShow');
            $goodsStoreValueList = I('post.goodsStoreValueList');
            
            $wh['id'] = $id;
            $row = M('goods')->where($wh)->find();
            if(!$row){
                $this->ajaxReturn($this->errmsg(10001, '编辑的商品不存在'));
            }
            if($id == ''){
                $this->ajaxReturn($this->errmsg(10001, '请选择要编辑的商品'));
            }
            if($goodsName == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品名称'));
            }
            if($oldPrice == ''){
                $this->ajaxReturn($this->errmsg(10001, '请输入商品原价'));
            }
            if(is_numeric($oldPrice) == false){
                $this->ajaxReturn($this->errmsg(10001, '请输入正确的商品原价'));
            }
            
            $stockNum = "";
            foreach($goodsStoreValueList as $k => $v){
                $value = explode('-', $v);//拆分为数组
                $storeId = $value[0];
                $price = $value[1];//销售价格
                $stock = $value[2];//库存
                $stockNum += $stock;//商品总库存
                if($price == ''){
                    $this->ajaxReturn($this->errmsg(10001, '请输入商品销售价'));
                }
                if($stock == ''){
                    $this->ajaxReturn($this->errmsg(10001, '请输入商品库存'));
                }
                
                if(is_numeric($price) == false){
                    $this->ajaxReturn($this->errmsg(10001, '请输入正确的商品销售价'));
                }
                if(is_numeric($stock) == false || $stock <= 0){
                    $this->ajaxReturn($this->errmsg(10001, '请输入正确的库存'));
                }
                
                //更新数据库
                $d['price'] = $price;
                $d['stock'] = $stock;
                $d['updateDate'] = date('Y-m-d H:i:s',time());
                $w['id'] = $storeId;
                M('goods_store')->where($w)->save($d);
            }
            
            $data['name'] = $goodsName;
            $data['oldPrice'] = $oldPrice;
            $data['stock'] = $stockNum;
            $data['isMarketable'] = $isShow;
            $data['updateDate'] = date('Y-m-d H:i:s',time());
            //$data['img'] = $img;
            //$data['description'] = $description;
            $r = M('goods')->where($wh)->save($data);

            if(!$r){
                $this->ajaxReturn($this->errmsg(10001, '未知原因，编辑失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '编辑成功'));
        }//end ajax
        
        $id = I('get.id');
        $goodsInfo = M('goods g')->field('g.*,c.name as categoryName')->join('__GOODS_CATEGORY__ c on c.id = g.categoryId')->where('g.id='.$id)->find();//商品内容
        $goodsStoreList = M('goods_store')->field('id,attrValue1,attrValue2,price,stock,unitName')->where('goodsId='.$id)->select();//商品属性列表
        $goodsInfo['goodsStoreList'] = $goodsStoreList;
        
        $this->assign('goodsInfo',$goodsInfo);//商品内容显示赋值
        $this->display();
    }
    
    /**
     * 删除商品
     * @param id int 商品id
     * */
    public function goodsDel(){
        if(IS_AJAX){
            $id = I('post.id');
            $w['id'] = $id;
            $res = M('goods')->where($w)->delete();
            if(!$res){
                $this->ajaxReturn($this->errmsg(10001, '未知原因,删除失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
}