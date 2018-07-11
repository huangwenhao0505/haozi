<?php
namespace Home\Controller;
use Think\Controller;

class MusicController extends Controller {
    
    public function index(){
        $this->display();
    }
    
    public function webIndex(){
        $this->display();
    }
    
    public function music(){
        $this->display();
    }
}