<?php
namespace App\Controller;
use App\Controller\AppController;

class UserController extends AppController {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {  
        $token = I('post.token');
        $uid = $this->checkLogin($token);

        $info = M('user')->where('id='.$uid)->find();//返回用户信息
        
        $this->ajaxReturn($this->errmsg(10000, '成功', $info));
    }
    
    
}