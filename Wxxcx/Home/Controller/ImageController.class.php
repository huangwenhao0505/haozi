<?php
namespace Home\Controller;
use Home\Controller\MyController;

class ImageController extends MyController
{
    /**
     * 创建个人文件夹
     * @param openid 用户登录的openid
     * @param folderName 文件夹名称
     * @param remark 备注信息
     * */
    public function addUserFolder()
    {
        
        //$str = "深圳市福田区园岭东路3号";
        
        $openid = $_POST['openid'];
        $folder = $_POST['folderName'];
        $remark = $_POST['remark'];
        
        $this->checkLogin($openid);//判断是否已授权登录
        $userId = $this->getXcxUserId($openid);//根据openid获取用户id
        
        if($folder == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '文件夹名称不能为空！'));
        }
        
        //合理性处理，判断该用户是否已经创建了该文件夹名
        $where['userId'] = $userId;
        $where['folderName'] = $folder;
        $res = M('xcx_image_folder')->where($where)->find();
        if($res) 
        {
            $this->ajaxReturn($this->errmsg(10001, '该文件夹名称已经存在！'));
        }
        
        $add['userId'] = $userId;
        $add['folderName'] = $folder;
        $add['remark'] = $remark;
        $add['createDate'] = date('Y-m-d H:i:s', time());
        $rs = M('xcx_image_folder')->add($add);
        if(!$rs) 
        {
            $this->ajaxReturn($this->errmsg(10001, '创建失败！'));                
        }
        
        $this->ajaxReturn($this->errmsg(10000, '创建成功！'));
    }
    
    /**
     * 获取个人用户文件夹列表
     * @param openid 用户登录的openid
     * */
    public function getUserFolderList() 
    {
        $openid = $_POST['openid'];
        
        $this->checkLogin($openid);//判断是否已授权登录
        $userId = $this->getXcxUserId($openid);//根据openid获取用户id
        
        $where['userId'] = $userId;
        $list = M('xcx_image_folder')->where($where)->select();
        
        $this->ajaxReturn($this->errmsg(10000, "成功", $list));
        //echo json_encode($list);
    }
    
    /**
     * 保存图片地址到数据库
     * @param openid 用户登录的openid
     * @param folder 文件夹id
     * @param desc 备注说明
     * */
    public function addImageUrl()
    {
        $openid = $_POST['openid'];
        $folder = $_POST['folder'];
        //$desc   = $_POST['desc'];//图片备注信息不要了
         
        $this->checkLogin($openid);//判断是否已授权登录
        $userId = $this->getXcxUserId($openid);//根据openid获取用户id
        
        //判断是否选择文件夹
        if($folder == '' || $folder == 0)
        {
            $this->ajaxReturn($this->errmsg(10001, "请选择文件夹！"));
        }
         
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     10485760 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');//设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/xcximages/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录

        // 上传文件
        $info   =   $upload->upload();
        //var_dump($info);exit;
         
        if(!$info)
        {
            $this->ajaxReturn($this->errmsg(10001, $upload->getError()));
        }
         
        $savepath = $info['file']['savepath'];
        $savename = $info['file']['savename'];
         
        //拼接上传成功后的完整地址存入到数据库
        $rootPath = "/Public/Uploads/xcximages/";//存取的时候把根目录的.号去掉
        $imagePath = "https://".$_SERVER['HTTP_HOST'].$rootPath.$savepath.$savename;
    
        $add['userId'] = $userId;
        $add['imageFolderId'] = $folder;
        $add['imageUrl'] = $imagePath;
        //$add['remark'] = $desc;
        $add['createDate'] = date('Y-m-d H:i:s', time());
        $res = M('xcx_image')->add($add);
         
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, "失败"));
        }
         
        $this->ajaxReturn($this->errmsg(10000, "成功"));
    }
    
    /**
     * 获取个人相册列表
     * @param openid 用户的openid
     * */
    public function getMyFolderList() 
    {
        $openid = $_POST['openid'];
        
        $this->checkLogin($openid);//判断是否已授权登录
        $userId = $this->getXcxUserId($openid);//根据openid获取用户id
        $info   = $this->getXcxUserInfo($openid);//根据openid获取用户信息
        
        $where['i.userId'] = $userId;
        $list = M('xcx_image i')
        ->field('i.imageFolderId,i.userId, f.folderName, f.remark folderremark, f.createDate')
        ->join('__XCX_IMAGE_FOLDER__ f on f.id = i.imageFolderId', 'LEFT')
        ->where($where)
        ->group('i.imageFolderId')
        ->select();
        
        foreach($list as $k => $v)
        {
            $wh['imageFolderId'] = $v['imagefolderid'];
            $list[$k]['imageList'] = M('xcx_image')->where($wh)->select();   
        }
        
        //echo M()->getLastSql();exit;
        $data['info'] = $info;
        $data['list'] = $list;
        
        $this->ajaxReturn($this->errmsg(10000, "成功", $data));
    }
    
    /**
     * 根据相册显示其图片列表
     * @param userId 用户id
     * @param imageFolderId 相册id
     * */
    public function getMyFolderImageList() 
    {
        $userId = $_POST['userId'];
        $folderId = $_POST['imageFolderId'];
        
        if($folderId == '')
        {
            $this->ajaxReturn($this->errmsg(10001, "请选择相册名！"));
        }
        
        $where['userId'] = $userId;
        $where['imageFolderId'] = $folderId;
        $list = M('xcx_image')->where($where)->select();
        
        $this->ajaxReturn($this->errmsg(10000, '成功', $list));
    }
    
    /**
     * 获取创建相册的用户列表*/
    public function getCreateFolderUser() 
    {
        $list = M('xcx_image_folder f')
        ->field('f.*, u.nickname, u.avatarUrl, x.openid')
        ->join('__USER_XCX_USERINFO__ u on u.id = f.userId', 'LEFT')
        ->join('__USER_XCX__ x on x.id = u.userxcxId', 'LEFT')
        ->group('f.userId')
        ->select();
        
        $this->ajaxReturn($this->errmsg(10000, "成功", $list));
    }
}