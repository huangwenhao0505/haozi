<?php
namespace Home\Controller;
use Think\Controller;

class WorkermanController extends Controller
{
    /**
     * 聊天室页面
     * https://www.workerman.net/web-sender
     * */
    public function index()
    {
        $this->display("index");
    }
    
    /**
     * 一个数如果恰好等于它的因子之和，这个数就称为"完数"
     * 例如6=1＋2＋3.
     * 找出1000以内的所有完数
     * */
    public function getFactor()
    {
        for($i=1; $i<=1000; $i++)
        {
            $sum=0;
            for($j=1; $j<=$i/2; $j++)
            {
                if($i%$j == 0)//所有可以整除这个数的数,不包括这个数自身(因子)
                {
                    $sum+=$j;//所有因子之和
//                     $i=> 1  2  3  4  5  6      8
//                     $j=>    1     1,2   1,2,3  1,2,3,4
//                  $i%$j=>    1     1,2   1,2,3  1,2,4
//                   $sum=>    1     3     6      7
                }
            }
            if($sum == $i)//因子之和等于这个数
            {
                echo $i.' ';
            }
        }
    }
}