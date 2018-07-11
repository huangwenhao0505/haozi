<?php
namespace Home\Controller;
use Home\Controller\MyController;

/**
 * 文件类*/
class FileController extends MyController
{  
    /**
     * 文件列表
     * @param page int 第几页
     * @param pageSize int 每页显示数
     * */
    public function fileList()
    {
        $page = $_GET['page'] == '' ? 1 : $_GET['page'];
        $pageSize = $_GET['pageSize'] == '' ? 10 : $_GET['pageSize'];
        $offset = ($page - 1) * $pageSize;

        $list = M('file_upload u')
        ->field('u.*, a.username, a.nickname')
        ->join('__ADMIN__ a on a.id = u.adminId','Left')
        ->order('u.createDate desc')
        ->limit($offset.','.$pageSize)
        ->select();

        echo json_encode($list);
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
        
        /**
         * 这里有两种方法（上传时用哪种，下载时就用哪种，不然文件会找不到）
         * 1，解决上传到服务器的文件中文名字正常显示的问题，但是这样下载时，下载的名字就会已乱码形式显示
         * 2，上传到服务器的文件中文名字以乱码形式显示，但是用户下载时，显示的是正常的中文名字
         * @综合用户体验度考虑，就已第2种方法去实现。而且服务器里的文件一般也不会去看，想看的话也可以通过下载来下载到本地查看 **/
        //$newFileName = iconv("utf-8","gb2312",$filename);//解决中文不能显示出来的问题
        $newFileName = $filename;
        
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
     * 文件下载实现方法
     * @param id int 文件所在的id*/
    public function downloadUrl(){
        header("Content-type:text/html;charset=utf-8");
    
        $id = $_GET['id'];
        $where['id'] = $id;
        $info = M('file_upload')->where($where)->find();
        if(!$info)
        {
            //$this->errmsg(10001, '文件不存在');
            $this->ajaxReturn($this->errmsg(10001, "文件不存在"));
        }
    
        $filePath = $info['fileurl'];//文件所在的路径
    
        //拆分路径，文件名取出来
        $filename = trim(strrchr($filePath, '/'),'/');//截取最后一个斜杠后面的内容
        $path     = strstr($filePath, $filename, true);//截取除$filename的内容外的其他内容
    
        /**
         * 这里有两种方法（上传时用哪种，下载时就用哪种，不然文件会找不到）
         * 1，解决上传到服务器的文件中文名字正常显示的问题，但是这样下载时，下载的名字就会已乱码形式显示
         * 2，上传到服务器的文件中文名字以乱码形式显示，但是用户下载时，显示的是正常的中文名字
        * @综合用户体验度考虑，就已第2种方法去实现。而且服务器里的文件一般也不会去看，想看的话也可以通过下载来下载到本地查看 **/
        //$newFileName = iconv("utf-8","gb2312",$filename);//解决中文不能显示出来的问题
        $newFileName = $filename;
    
        //拼接成完整的路径
        $newFilePath = $path.$newFileName;
    
        //判断给定的文件存在与否
        if(!file_exists($newFilePath)){
            $this->ajaxReturn($this->errmsg(10001, "文件不存在"));
        }
    
        $host = "https://".$_SERVER['HTTP_HOST']."/";
        $filenamePath = $host.$newFilePath;
        
        $data['filenamePath'] = $filenamePath;
        $data['info'] = $info;
        
        $this->ajaxReturn($this->errmsg(10000, "成功", $data));
    }
}