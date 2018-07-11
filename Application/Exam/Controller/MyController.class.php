<?php
namespace Exam\Controller;
use Think\Controller;

/**
 * 基础类*/
class MyController extends Controller
{
    /**
     * 返回数据
     * @param errno int 状态码
     * @param errmsg string 状态说明
     * @param result array 返回结果集*/
    protected function errmsg($errno, $errmsg, $result=null)
    {
        $arr = array(
            'errno' => $errno,
            'errmsg'=> $errmsg,
            'result'=> $result
        );
        return $arr;
        exit;
    }
}