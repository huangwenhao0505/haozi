<?php
namespace Admin\Controller;
use Think\Controller;

class UploadeController extends Controller {
    
    public function __construct(){
        parent::__construct();
        $this->A_login = A('Login');
        $this->A_login->isLogin();
        $this->A_img = A('Img');
    }
    
    /**
     * 使用ajaxFileUpload插件上传文件
     * 不能用TP自带的ajaxReturn返回
     * 要直接输出json_encode值*/
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        
        $data = json_encode($array);
        echo $data;
        exit;
    }
    
    /**
     * 文件上传*/
    public function index()
    {
        $this->display();
    }
    
    /**
     * 文件上传实现方法*/
    public function uploade(){
        header("Content-type:text/html;charset=utf-8");
        
        $adminId = session('a_id');//上传者id
        
        if( empty($_FILES) )
        {
            $this->errmsg(10001, "请选择要上传的文件");
        }
        
        if(is_uploaded_file($_FILES['fileNames']['tmp_name'])){//判断有没有上传服务端储存临时文件名
            
            $file = $_FILES['fileNames'];
            
            //设置文件存放目录
            $dir = "Public/Uploads/document/";
            
            //获取相应的值
            $name = $file['name'];  //文件原名称
            
            //这里必须要在 【解决不能上传中文名称的前面开始获取到】，不然就获取不到了，这里是为了插入数据库而另外取的
            $fileUploadName   = strstr($name, '.', TRUE);//获取文件名称，不包括后缀
            $fileUploadSuffix = strstr($name, '.');//获取文件后缀名
            $fileUPloadUrl    = $dir.$name;//文件上传成功后的完整路径
            
            //解决不能上传中文名称文件的问题
            $chinaName = iconv("utf-8", "gb2312", $name);

            $type = $file['type'];  //文件类型
            $size = $file['size'];  //文件大小
            $tmpname = $file['tmp_name'];   //临时文件名
            
            $suffix = strtolower(stristr($chinaName, "."));//获取文件后缀名(包含了点号),并后缀名小写化
            
            if(!$this->isOk($suffix))
            {
                $this->errmsg(10001, '只允许上传txt,doc,docx,xls,xlsx的文件');
            }
            
            //解决不能上传中文名称文件问题后的文件所在的路径
            $filename = $dir.$chinaName;
            
            //判断文件名称是否存在
            if( is_file($filename) )
            {
                echo $this->errmsg(10001, '文件名已经存在，请换一个文件名再来上传！');
            }
            
            //把上传的临时文件移动到up目录下面
            move_uploaded_file($tmpname, $filename);
            
            $error = $file['error'];    //文件上传信息
            if($error == 0)
            {
                $add['adminId']    = $adminId;//上传者id
                $add['filename']   = $fileUploadName;//文件名称
                $add['fileSuffix'] = $fileUploadSuffix;//文件后缀
                $add['fileUrl']    = $fileUPloadUrl;//文件所在路径
                $add['createDate'] = date('Y-m-d H:i:s', time());
                $res = M('file_upload')->add($add);
                if(!$res)
                {
                    unlink($filename);
                    $this->errmsg(10001, '文件上传成功，但写入数据库失败！');
                }
                
                $this->errmsg(10000, '文件上传成功啦！');
            }
            else if($error == 1)
            {
                $this->errmsg(10001, '上传文件大小超过了php.ini限制的值');
                
            }
            else if($error == 2)
            {
                $this->errmsg(10001, '超过了文件的大小MAX_FILE_SIZE选项指定的值');
            }
            else if ($error==3)
            {
                $this->errmsg(10001, '文件只有部分被上传');
            }
            else if($error==4)
            {
                $this->errmsg(10001, '没有文件被上传');
            }
            else
            {
                $this->errmsg(10001, '上传文件大小为0');
            }
        }
        else
        {
            $this->errmsg(10001, '上传失败');
        } 
    }
    
    /**
     * 文件列表*/
    public function fileList()
    {
        if(IS_AJAX)
        {
            //总记录数   每页显示数  总页数
            $count = M('file_upload')->count();
            $pageSize = 10;
            $total = ceil($count/$pageSize);
            
            //当前页  起始页
            $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
            $currPage = ($currPage >= 1 && $currPage <= total) ? $currPage : 1;
            $startRow = ($currPage - 1) * $pageSize;
            
            
            $list = M('file_upload u')
            ->field('u.*, a.nickname')
            ->join('__ADMIN__ a on a.id = u.adminId','Left')
            ->order('u.createDate desc')
            ->limit($startRow.','.$pageSize)
            ->select();
            
            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page'] = $total;//总页数
            $data['list'] = empty($list) ? false : $list;

            echo json_encode($data);
            exit;
        }
        
        $this->display('fileList');
    }
    
    /**
     * 文件下载实现方法
     * @param id int 文件所在的id*/
    public function download(){
        header("Content-type:text/html;charset=utf-8");
        
        $id = $_GET['id'];
        $where['id'] = $id;
        $info = M('file_upload')->where($where)->find();
        if(!$info)
        {
            $this->errmsg(10001, '文件不存在');
        }
        
        $filePath = $info['fileurl'];//文件所在的路径
        
        //拆分路径，文件名取出来
        $filename = trim(strrchr($filePath, '/'),'/');//截取最后一个斜杠后面的内容
        $path     = strstr($filePath, $filename, true);//截取除$filename的内容外的其他内容
        //解决中文不能显示出来的问题【这里必须要这么处理，不然上传的中文的文件取不到】
        $newFileName = iconv("utf-8","gb2312",$filename);
        //拼接成完整的路径
        $newFilePath = $path.$newFileName;
        
        //判断给定的文件存在与否
        if(!file_exists($newFilePath)){
            $this->error('该文件不存在！');
        }
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($newFilePath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($newFilePath));
        readfile($newFilePath);
    }
    
    /**
     * 删除文件
     * @param id int 文件所在的id*/
    public function delFile()
    {
        if(IS_AJAX)
        {
            $id = $_POST['id'];
            $where['id'] = $id;
            $info = M('file_upload')->where($where)->find();
            if(!$info)
            {
                $this->errmsg(10001, '该文件不存在');
            }
            
            $filePath = $info['fileurl'];//文件所在的路径
            
            //拆分路径，文件名取出来
            $filename = trim(strrchr($filePath, '/'),'/');//截取最后一个斜杠后面的内容
            $path     = strstr($filePath, $filename, true);//截取除$filename的内容外的其他内容
            //解决中文不能显示出来的问题【这里必须要这么处理，不然上传的中文的文件取不到】
            $newFileName = iconv("utf-8","gb2312",$filename);
            //拼接成完整的路径
            $newFilePath = $path.$newFileName;
            
            if(unlink($newFilePath) && M('file_upload')->where($where)->delete() )
            {
                $this->errmsg(10000, '删除成功');
            }
            else
            {
                $this->errmsg(10001, '删除失败');
            }
        }
    }
    
    /**
     * 批量删除文件
     * @param id string 文件所在的id(多个文件用,号连接)*/
    public function allDelFile()
    {
        if(IS_AJAX)
        {
            $idStr = $_POST['id'];
            $where['id'] = array('in', $idStr);
            $list = M('file_upload')->where($where)->select();
            foreach($list as $k => $v)
            {
                $id = $v['id'];
                $filePath = $v['fileurl'];//文件所在的路径
                
                //拆分路径，文件名取出来
                $filename = trim(strrchr($filePath, '/'),'/');//截取最后一个斜杠后面的内容
                $path     = strstr($filePath, $filename, true);//截取除$filename的内容外的其他内容
                //解决中文不能显示出来的问题【这里必须要这么处理，不然上传的中文的文件取不到】
                $newFileName = iconv("utf-8","gb2312",$filename);
                //拼接成完整的路径
                $newFilePath = $path.$newFileName;
                
                unlink($newFilePath);
            }
            
            $flag = M('file_upload')->where($where)->delete();
            if(!$flag)
            {
                $this->errmsg(10001, '删除失败');
            }
            
            $this->errmsg(10000, '删除成功');
        }
    }
    
    /**
     *判断文件后缀是否是允许上传的
     *@param string $suffix :带点的后缀名(如.txt)
     *@return bool 如果是允许上传的后缀名返回true,否则返回false
     */
    private function isOk($suffix){
        $suffix_arr = array('.txt', '.doc', '.docx', '.xls', '.xlsx');
        return in_array(strtolower($suffix), $suffix_arr);//strtolower把所有字符转换成小写
    }
}