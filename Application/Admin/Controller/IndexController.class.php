<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {
    
    public function __construct(){
        parent::__construct();
        $this->A_login = A('Login');
        $this->A_login->isLogin();
    }
    
    /**
     * 后台首页*/
    public function index(){
        $this->display();
    }
    
}