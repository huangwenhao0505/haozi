<?php
namespace Admin\Controller;
use Think\Controller;

class ExcController extends Controller{

    public function __construct() {

        /*导入phpExcel核心类  */
        include_once('./third-party/excel/PHPExcel.php');
    }

    /* 导出excel函数*/
    public function push2($data,$name='Excel'){

        error_reporting(E_ALL);
        date_default_timezone_set('Europe/London');
        $objPHPExcel = new \PHPExcel();

        /*以下是一些设置 ，什么作者  标题啊之类的*/
        $objPHPExcel->getProperties()->setCreator("转弯的阳光")
        ->setLastModifiedBy("转弯的阳光")
        ->setTitle("数据EXCEL导出")
        ->setSubject("数据EXCEL导出")
        ->setDescription("备份数据")
        ->setKeywords("excel")
        ->setCategory("result file");
        /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
        foreach($data as $k => $v){

            $num=$k+1;
            $objPHPExcel->setActiveSheetIndex(0)

            //Excel的第A列，uid是你查出数组的键值，下面以此类推
            ->setCellValue('订单号'.$num, $v['orderno'])
            ->setCellValue('会员姓名'.$num, $v['real_name'])
            ->setCellValue('会员昵称'.$num, $v['username'])
            ->setCellValue('会员电话'.$num, $v['mobilephone'])
            ->setCellValue('龙号'.$num, $v['account'])
            ->setCellValue('商品名称'.$num, $v['name'])
            ->setCellValue('尺码'.$num, $v['attrValue2'])
            ->setCellValue('颜色'.$num, $v['attrValue1'])
            ->setCellValue('价格'.$num, $v['price'])
            ->setCellValue('数量'.$num, $v['quantity']);
            
        }
       
        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * 数据导出
     * @param string $fileName  文件名
     * @param array $headArr    表头数据（一维）
     * @param array $data       列表数据（二维）
     * @param int   $width      列宽
     * @return bool
     */
    public function push($fileName="", $headArr=array(), $data=array(), $width=20)
    {

        if (empty($headArr) && !is_array($headArr) && empty($data) && !is_array($data)) {
            return false;
        }

        $date = date("YmdHis",time());
        $fileName .= "_{$date}.xls";

        $objPHPExcel = new \PHPExcel();

        //设置表头
        $tem_key = "A";
        foreach($headArr as $v){
            if (strlen($tem_key) > 1) {
                $arr_key = str_split($tem_key);
                $colum = '';
                foreach ($arr_key as $ke=>$va) {
                    $colum .= chr(ord($va));
                }
            } else {
                $key = ord($tem_key);
                $colum = chr($key);
            }
            $objPHPExcel->getActiveSheet()->getColumnDimension($colum)->setWidth($width); // 列宽
            $objPHPExcel->getActiveSheet()->getStyle($colum)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // 垂直居中
            $objPHPExcel->getActiveSheet()->getStyle($colum.'1')->getFont()->setBold(true); // 字体加粗
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $tem_key++;
        }

        $objActSheet = $objPHPExcel->getActiveSheet();

        $border_end = 'A1'; // 边框结束位置初始化

        // 写入内容
        $column = 2;
        foreach($data as $key => $rows){ //获取一行数据
            $tem_span = "A";
            foreach($rows as $keyName=>$value){// 写入一行数据
                if (strlen($tem_span) > 1) {
                    $arr_span = str_split($tem_span);
                    $j = '';
                    foreach ($arr_span as $ke=>$va) {
                        $j .= chr(ord($va));
                    }
                } else {
                    $span = ord($tem_span);
                    $j = chr($span);
                }
                $objActSheet->setCellValue($j.$column, $value);
                $border_end = $j.$column;
                $tem_span++;
            }
            $column++;
        }

        $objActSheet->getStyle("A1:".$border_end)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); // 设置边框

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');

        //设置活动单指数到第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
    
    public function getData(){
        
        $sql = "delete from stat_shop_traveler";
        M()->execute($sql);

        $sql = "select o.orderno,u.real_name,u.username,u.mobilephone,u.account,g.name,i.attrValue2,i.attrValue1,i.price,i.quantity,i.travelerIdList,i.createDate
                from s_order_item i 
                left join s_goods g on g.id = i.goodsId
                left join s_order o on o.id = i.orderid
                left join lzd_user u on u.id = o.userId
                where o.payState = 2 and categoryCode = '007'
                order by g.name desc
            ";
        $data = M()->query($sql);
        foreach($data as $k => $v){
            $idList = $v['traveleridlist'];
            $sql = "select name as xxname,mobilePhone as xxmobilePhone,identityNumber as xxidentityNumber from s_traveler where id in ($idList);";
            $data[$k]['traveler'] = M()->query($sql);
            foreach($data[$k]['traveler'] as $key => $val){
                $data[$k]['traveler'][$key]['orderno'] = $v['orderno'];
                $data[$k]['traveler'][$key]['real_name'] = $v['real_name'];
                $data[$k]['traveler'][$key]['username'] = $v['username'];
                $data[$k]['traveler'][$key]['mobilephone'] = $v['mobilephone'];
                $data[$k]['traveler'][$key]['account'] = $v['account'];
                $data[$k]['traveler'][$key]['name'] = $v['name'];
                $data[$k]['traveler'][$key]['attrValue2'] = $v['attrValue2'];
                $data[$k]['traveler'][$key]['attrValue1'] = $v['attrValue1'];
                $data[$k]['traveler'][$key]['price'] = $v['price'];
                $data[$k]['traveler'][$key]['createDate'] = $v['createdate'];
            }
            
        }
        //var_dump($data);exit;
        
        $newData = array();
        foreach($data as $k => $v){
            $orderno = $v['orderno'];
            $real_name = $v['real_name'];
            $username = $v['username'];
            $mobile = $v['mobilephone'];
            $account = $v['account'];
            $name = $v['name'];
            $attr2 = $v['attrvalue2'];
            $attr1 = $v['attrvalue1'];
            $price = $v['price'];
            $createDate = $v['createdate'];
            //$sql = "insert into stat_shop_traveler values ('{$orderno}','{$real_name}','{$username}','{$mobile}','{$account}','{$name}','{$attr1}','{$attr2}','{$price}',null,null,null)";
            //M()->execute($sql);
            foreach($data[$k]['traveler'] as $key => $val){
                $xxname = $val['xxname'];
                $xxmobile = $val['xxmobilephone'];
                $xxidentityNumber = $val['xxidentitynumber'];
                //$sql2 = "insert into stat_shop_traveler values ('{$orderno}','{$real_name}','{$username}','{$mobile}','{$account}','{$name}','{$attr1}','{$attr2}','{$price}','{$xxname}','{$xxmobile}','{$xxidentityNumber}')";
                //M()->execute($sql2);
                //echo M()->getLastSql();
                $newData[] = array($orderno,$real_name,$username,$mobile,$account,$name,$attr2,$attr1,$price,$xxname,$xxmobile,$xxidentityNumber,$createDate);
            }
        }
        var_dump($newData);exit;
        $name='Excelfile';    //生成的Excel文件文件名
        $headArr = array('订单号','会员姓名','会员昵称','会员电话','龙号','商品名称','尺码','颜色','价格','出行人姓名','出行人手机号','出行人身份证号','创建时间');
        $this->push($fileName="", $headArr, $newData);
    }
}