<?php
namespace Home\Controller;
use Think\Controller;

class UploadeController extends Controller {
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    /**
     * 文件上传*/
    public function index(){
        $this->display();
    }
    
    /**
     * 文件上传实现方法*/
    public function uploade(){
        header("Content-type:text/html;charset=utf-8");
        
        if(is_uploaded_file($_FILES['zip']['tmp_name'])){//判断有没有上传服务端储存临时文件名
            
            $file = $_FILES['zip'];
            
            //获取相应的值
            $name = $file['name'];  //文件原名称
            $type = $file['type'];  //文件类型
            $size = $file['size'];  //文件大小
            $tmpname = $file['tmp_name'];   //临时文件名
            
            
            $suffix = strtolower(stristr($name, "."));//获取文件后缀名(包含了点号),并后缀名小写化
            
            if(!$this->isZip($suffix)){
                $this->error('只允许上传apk文件！');
            }
            
            //设置文件存放目录
            $dir = "Public/zip/";
            //把上传的临时文件移动到up目录下面
            move_uploaded_file($tmpname, $dir.$name);
            
            $filename = $dir;//文件上传成功后的路径
            
            $error = $file['error'];    //文件上传信息
            if($error == 0){
                echo "文件上传成功啦！";
                exit;

            }else if($error == 1){
                echo "上传文件大小超过了php.ini限制的值";
                exit;
                
            }else if($error == 2){
                echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
                exit;
                
            }elseif ($error==3){
                echo "文件只有部分被上传";
                exit;
                
            }elseif ($error==4){
                echo "没有文件被上传";
                exit;
                
            }else{
                echo "上传文件大小为0";
                exit;
            }
            
        }else{
            $this->error('上传失败！');
        } 
    }
    
    
    /**
     * 文件下载实现方法
     * @param file_name string 文件名*/
    public function download(){
        header("Content-type:text/html;charset=utf-8");
        
        $file_name = 'app-debug.apk';

        //用以解决中文不能显示出来的问题
        $file_name = iconv("utf-8","gb2312",$file_name);
        $file_sub_path = $_SERVER['DOCUMENT_ROOT']."/Public/zip/";
        $file_path = $file_sub_path.$file_name;
        
        //判断给定的文件存在与否
        if(!file_exists($file_path)){
            $this->error('该文件不存在！');
        }
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file_path));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        
        /*
                        方法2
        $fp = fopen($file_path,"r");
        $file_size = filesize($file_path);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$file_name);
        $buffer=1024;
        $file_count=0;
        //向浏览器返回数据
        while(!feof($fp) && $file_count<$file_size){
            $file_con=fread($fp,$buffer);
            $file_count+=$buffer;
            echo $file_con;
        }
        
        fclose($fp);
        */
    }
    
    /**
     *判断文件后缀是否是apk
     *@param string $suffix :带点的后缀名(如.apk)
     *@return bool 如果是zip后缀名返回true,否则返回false
     */
    private function isZip($suffix){
        $suffix_arr = array('.apk');
        return in_array(strtolower($suffix), $suffix_arr);//strtolower把所有字符转换成小写
    }
}