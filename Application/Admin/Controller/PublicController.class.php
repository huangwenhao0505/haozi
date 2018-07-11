<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 后台公共部分
 * @author Administrator
 *  */
class PublicController extends Controller {
    
    public function header(){
        $this->display();
    }
}