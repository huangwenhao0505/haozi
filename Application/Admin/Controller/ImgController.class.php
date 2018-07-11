<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 图片上传类
 * @author Administrator
 *  */
class ImgController extends Controller {
    
    /**
     *上传图像
     *第三方插件ajaxFileUpload
     */
    public function uploadImg($dir){
    
        if(isset($_FILES)&&(!empty($_FILES))){
            foreach($_FILES as $el){//获取文件，这里默认都是每次都单文件上传
                $file=$el;
            }
            if(is_uploaded_file($file["tmp_name"])){//确认是POST方式上传的文件
                //$cache_path="Public/Uploads/yulu/";//暂存文件的目录
                $cache_path = $dir;
                $fname=$file["name"];//获取文件名
                $ftype=$file["type"];//获取文件类型
                $ftmp_name=$file["tmp_name"];//获取临时文件路径
                $fsize=$file["size"];//获取文件大小
                $ferror=$file["error"];//获取文件错误代号
    
                //判断文件大小是否符合规则
                if(!$this->check_size($fsize)){
                    return json_encode(array("error"=>"102"));//102错误码代表文件过大
                    exit;
                }
    
                $suffix=strtolower(stristr($fname, "."));//获取文件后缀名(包含了点号),并后缀名小写化
                //判断文件类型是否为图片
                if(!$this->is_img($suffix)){
                    //如果不是图片类型，直接返回error为101，代表文件类型错误
                    return json_encode(array("error"=>"101"));
                    exit;
                }
    
                $uniqStr=uniqid(strtotime("now")."_".mt_rand(100000,999999)."_");//创建随机ID
                $fname_new = $cache_path.$uniqStr.$suffix;//利用当前时间戳构造新的文件名称
                move_uploaded_file($ftmp_name, $fname_new);//将临时文件区的文件移动到暂存区中
                $fname_new=stristr($fname_new,"/");
                $fname_new = "http://".$_SERVER['HTTP_HOST'].'/Public'.$fname_new;
                 
                return json_encode(array("path"=>$fname_new));//返回文件路径给看、客户端
            }else{
                return json_encode(array("error"=>"400"));//400错误码代表文件非法上传(不是httppost提交)
            }
    
        }else{
            return json_encode(array("error"=>"404"));//404错误码代表文件为空
        }
    }
    
    /**
     *判断文件后缀是否是图片
     *@param string $suffix :带点的后缀名(如.jpg)
     *@return bool 如果是图片后缀名返回true,否则返回false
     */
    private function is_img($suffix){
        $suffix_arr=array('.jpg','.png','.gif','.jpeg','.bmp');
        return in_array(strtolower($suffix), $suffix_arr);
    }
    
    /**
     *判断文件大小是否非法
     *@param int $size :单位为byte的整数，文件大小
     *@return bool 如果文件大小小于或等于规定的最大值返回true,否则返回false
     */
    private function check_size($size){
        $postMaxSize=intval(ini_get("post_max_size"));//post文件最大值
        $uploadMaxFilesize = intval(ini_get("upload_max_filesize"));//upload上传文件最大值
        $max=min($postMaxSize,$uploadMaxFilesize) *1024*1024;//将MB转换为byte单位数据
        if(intval($size)<=$max){
            return true;
        }else{
            return false;
        }
    }
    
}