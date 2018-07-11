<?php
namespace Admin\Controller;
use Think\Controller;

class WxxcxController extends Controller
{
    public function getUserInfo()
    {
        $code = $_REQUEST['code'];
        
        $add['openId'] = $code;
        $res = M('xcx')->add($add);
        var_dump($res);
    }
}