<?php
namespace Home\Controller;
use Home\Controller\MyController;

/**
 * 视频相关类
 * */
class VideoController extends MyController
{ 
    /**
     * 保存视频地址到数据库
     * @param openid 用户登录的openid
     * @param size 视频文件大小
     * @param desc 备注说明
     * */
   public function addVideoUrl()
   {
       $openid = $_POST['openid'];
       $size   = $_POST['size'];
       $desc   = $_POST['desc'];
       
       $this->checkLogin($openid);//判断是否已授权登录
       $userId = $this->getXcxUserId($openid);//根据openid获取用户id
       
       $upload = new \Think\Upload();// 实例化上传类
       $upload->maxSize   =     10485760 ;// 设置附件上传大小
       $upload->exts      =     array('mp4', '3gp', 'avi', 'rmvb');// 设置附件上传类型
       $upload->rootPath  =     './Public/Uploads/videos/'; // 设置附件上传根目录
       $upload->savePath  =     ''; // 设置附件上传（子）目录
       
       // 上传文件
       $info   =   $upload->upload();
       //var_dump($info);
       
       if(!$info)
       {
           $this->ajaxReturn($this->errmsg(10001, $upload->getError()));
       }
       
       $savepath = $info['file']['savepath'];
       $savename = $info['file']['savename'];
       
       //拼接上传成功后的完整地址存入到数据库
       $videoPath = "https://".$_SERVER['HTTP_HOST'].$upload->rootPath.$savepath.$savename;

       $add['userId'] = $userId;
       $add['videoUrl'] = $videoPath;
       $add['size'] = $size;
       $add['remark'] = $desc;
       $add['createDate'] = date('Y-m-d H:i:s', time());
       $res = M('xcx_video')->add($add);
       
       if(!$res)
       {
           $this->ajaxReturn($this->errmsg(10001, "失败"));
       }
       
       $this->ajaxReturn($this->errmsg(10000, "成功"));
   } 
   
   /**
    * 单个用户上传的视频文件列表
    * @param openid 用户登录的openid
    */
   public function myVideoList()
   {
       $openid = $_GET['openid'];
       
       $this->checkLogin($openid);//判断是否已授权登录
       $userId = $this->getXcxUserId($openid);//根据openid获取用户id

       $where['userId'] = $userId;
       $list = M('xcx_video')->where($where)->order('createDate desc')->select();
       
       $data['data'] = $list;
       echo json_encode($data);
   }
   
   /**
    * 用户删除某个视频文件
    * @param openid 用户登录的openid
    * @param id 视频id
    * */
   public function delMyVideo()
   {
       $openid = $_GET['openid'];
       $id     = $_GET['id'];
       
       $this->checkLogin($openid);//判断是否已授权登录
       $userId = $this->getXcxUserId($openid);//根据openid获取用户id
       
       //判断视频文件是否存在
       $w['id'] = $id;
       $info = M('xcx_video')->where($w)->find();
       if(!$info)
       {
           $this->ajaxReturn($this->errmsg(10001, "该视频文件不存在"));
       }
       
       $file = $info['videourl'];//视频存放的完整路径
       $host = "https://".$_SERVER['HTTP_HOST'];
       $newFile = str_replace($host, '', $file);//去除掉请求头，得到视频路径
       
       $where['id'] = $id;
       $where['userId'] = $userId;
       if(unlink($newFile) && M('xcx_video')->where($where)->delete())
       {
           $this->ajaxReturn($this->errmsg(10000, "删除成功"));
       }
       else
       {
           $this->ajaxReturn($this->errmsg(10001, "删除失败"));
       }
   }
   
   /**
    * 所有的视频列表*/
   public function getVideoList()
   {
       $list = M('xcx_video')->order('createDate desc')->select();
       foreach($list as $k => $v)
       {
           $list[$k]['createdate'] = date('Y-m-d H:i',strtotime($v['createdate']));
       }
       $data['data'] = $list;
       echo json_encode($data);
   }
   
   /**
    * 视频详情
    * @param id 视频id
    * @param userId 发布人id
    * */
   public function getVideoDetail()
   {
       $id = $_GET['id'];
       $userId = $_GET['userId'];
       
       $where['v.id'] = $id;
       $where['v.userId'] = $userId;
       $info = M('xcx_video v')
           ->field('v.*,u.nickname,u.avatarUrl')
           ->join('__USER_XCX_USERINFO__ u on u.userxcxId = v.userId', 'LEFT')
           ->where($where)
           ->find();
       
       echo json_encode($info);
   }

}