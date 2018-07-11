<?php
namespace Admin\Controller;
use Think\Controller;

class ExcelController extends Controller {

    //创建一个读取excel数据，可用于入库
    public function _readExcel($path)
    {
        //引用PHPexcel 类
        include_once('./third-party/excel/PHPExcel.php');
        include_once('./third-party/excel/PHPExcel/IOFactory.php');//静态类
        $type = 'Excel2007';//设置为Excel5代表支持2003或以下版本，Excel2007代表2007版
        $xlsReader = \PHPExcel_IOFactory::createReader($type);
        $xlsReader->setReadDataOnly(true);
        $xlsReader->setLoadSheetsOnly(true);
        $Sheets = $xlsReader->load($path);
        //开始读取上传到服务器中的Excel文件，返回一个二维数组
        $dataArray = $Sheets->getSheet(0)->toArray();
        return $dataArray;
    }
    
    public function index(){
       $this->display();
    }
    
    /**
     * 接收前台文件 file_stu 接收的表单名
     */
    public function addExcel()
    {
       if(!empty($_FILES['file_stu']['name'])){
           $ex = $_FILES['file_stu'];
           $file_types = explode ( ".", $ex['name'] );
           $file_type = $file_types[count ( $file_types ) - 1];
           if($file_type != "xls" && $file_type != "xlsx"){
               $this->error('不是Excel文件，重新上传');
           }
           
           //以当前时间戳重置文件名
           $filename = time().substr($ex['name'], stripos($ex['name'], '.'));
           
           //设置文件上传的路径
           $path = './Public/Uploads/excel/';
           
           //文件上传的完整路径名（设置移动的路径）
           $pathName = $path.$filename; 
    
           //将上传的文件移动到新位置
           $r = move_uploaded_file($ex['tmp_name'], $pathName);
           if($r == false){
               $this->error('上传失败');
           }
           
           //保存到数据库
           $add['uid'] = session('a_id');
           $add['excel'] = $pathName;
           M('excel')->add($add);
           
           //表用函数方法 返回数组
           $exfn = $this->_readExcel($pathName);
           var_dump($exfn);
           exit;
       }
       
       $this->error('请选择上传文件');
    }
   

    public function export_file()
    {
        $uid = session('a_id');
        $data = M('excel')->where('uid='.$uid)->find();
        $title = array(
            'id' => $data['id'],
            'uid'=> $data['uid'],
            'excel' => $data['excel']
        );
        $this->exportexcel($data);
        
    }
    
    /**
     * 导出数据为excel表格
     *@param $data    一个二维数组,结构如同从数据库查出来的数组
     *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
     *@param $filename 下载的文件名
     *@examlpe
     $stu = M ('User');
     $arr = $stu -> select();
     exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
     */
    function exportexcel($data=array(),$title=array(),$filename='report'){
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=".$filename.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        //导出xls 开始
        if (!empty($title)){
            foreach ($title as $k => $v) {
                $title[$k]=iconv("UTF-8", "GB2312",$v);
            }
            $title= implode("\t", $title);
            echo "$title\n";
        }
        if (!empty($data)){
            foreach($data as $key=>$val){
                foreach ($val as $ck => $cv) {
                    $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                }
                $data[$key]=implode("\t", $data[$key]);
    
            }
            echo implode("\n",$data);
        }
    }
    
    /* 导出excel函数*/
    public function push($data,$name='Excel')
    {
    
        include_once('./third-party/excel/PHPExcel.php');
        error_reporting(E_ALL);
        date_default_timezone_set('Europe/Shanhai');
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
            $objPHPExcel->setActiveSheetIndex(0)//Excel的第A列，uid是你查出数组的键值，下面以此类推
            ->setCellValue('A'.$num, $v['id'])
            ->setCellValue('B'.$num, $v['uid'])
            ->setCellValue('C'.$num, $v['excel']);
        }
    
        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: applicationnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('./third-party/excel/');
        exit;
    }
}