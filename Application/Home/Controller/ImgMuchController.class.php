<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 多图片上传
 * @author Administrator
 *  */
class ImgMuchController extends Controller {
    
    /**
     * @param unknown $dir 保存图片的路径（文件夹） */
    public function muchPhotoUpload($dir){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $upfile=$_FILES["file"];
            //获取数组里面的值
            $name=$upfile["name"];//上传文件的文件名
            $type=$upfile["type"];//上传文件的类型
            $size=$upfile["size"];//上传文件的大小
            $tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径
            //判断是否为图片
            switch ($type){
                case 'image/pjpeg':
                    $okType = true;
                    break;
                case 'image/jpeg' :
                    $okType = true;
                    break;
                case 'image/gif':
                    $okType=true;
                    break;
                case 'image/png':
                    $okType=true;
                    break;
            }
        
            if($okType){
                /**
                 * 0:文件上传成功<br/>
                 * 1：超过了文件大小，在php.ini文件中设置<br/>
                 * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
                 * 3：文件只有部分被上传<br/>
                 * 4：没有文件被上传<br/>
                 * 5：上传文件大小为0
                 */
                $error=$upfile["error"];//上传后系统返回的值
                /*
                 echo "================<br/>";
                 echo "上传文件名称是：".$name."<br/>";
                 echo "上传文件类型是：".$type."<br/>";
                 echo "上传文件大小是：".$size."<br/>";
                 echo "上传后系统返回的值是：".$error."<br/>";
                 echo "上传文件的临时存放路径是：".$tmp_name."<br/>";
        
                 echo "开始移动上传文件<br/>";
                */
                
                //把上传的临时文件移动到 $dir 目录下面
                $suffix=strtolower(stristr($name, "."));//获取文件后缀名(包含了点号),并后缀名小写化
                $uniqStr=uniqid(strtotime("now")."_".mt_rand(100000,999999)."_");//创建随机ID
                
                $dir .= date('Ymd/',time()); //自动按日期生成文件夹
                if(!file_exists($dir))//文件夹不存在，先生成文件夹
                {
                    mkdir($dir);
                }
                
                $catch_path = $dir.$uniqStr.$suffix;//利用当前时间戳构造新的文件名称
                
                move_uploaded_file($tmp_name,$catch_path);//将临时文件区的文件移动到暂存区中
                $destination = "http://".$_SERVER['HTTP_HOST'].'/'.$catch_path;
                
                $data = array('status'=>1,'imagepath'=>$destination,'msg'=>'上传成功！');
        
                return json_encode($data);
        
                die;
        
            }elseif ($error==1){
        
                $data = array('status'=>0,'imagepath'=>null,'msg'=>'超过了文件大小，在php.ini文件中设置');
                return json_encode($data);die;
        
            }elseif ($error==2){
                 
                $data = array('status'=>0,'imagepath'=>null,'msg'=>'超过了文件的大小MAX_FILE_SIZE选项指定的值');
                return json_encode($data);die;
            }elseif ($error==3){
                $data = array('status'=>0,'imagepath'=>null,'msg'=>'文件只有部分被上传');
                return json_encode($data);die;
            }elseif ($error==4){
        
                $data = array('status'=>0,'imagepath'=>null,'msg'=>'没有文件被上传');
                return json_encode($data);die;
            }else{
                 
                $data = array('status'=>0,'imagepath'=>null,'msg'=>'上传文件大小为0');
                return json_encode($data);die;
            }
        }else{
            $data = array('status'=>0,'imagepath'=>null,'msg'=>'请上传jpg,gif,png等格式的图片！');
            return json_encode($data);die;
        }
    }
}