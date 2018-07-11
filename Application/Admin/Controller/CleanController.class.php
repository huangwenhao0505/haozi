<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 清除注册但24小时之内未激活的账号*/
class CleanController extends Controller 
{
    
    public function index()
    {
        $where['states'] = 0;
        $list = M('user')->where($where)->select();//未被激活的用户列表
        foreach($list as $k => $v)
        {
            if($v['activate_code_times'] < time())
            {
                $uid = $v['id'];
                M('user')->where('id='.$uid)->delete();
            }
        }
        
        echo "清除成功！";
    }
    
}