<?php
namespace App\Controller;
use Think\Controller;

/**
 * 算法*/
class MatchController extends Controller
{
    /**
     * 牛年求牛：有一母牛，到4岁可生育，每年一头，所生均是一样的母牛，到15岁绝育，不再能生，20岁死亡，问n年后有多少头牛。
     * @param $n int 年*/
    public function niu($n){
        static $num = 1;
        for($j=1; $j<=$n; $j++)
        {
            if($j>=4 && $j<15)
            {
                $num++;
                $this->niu($n-$j);//递归
            }
            
            if($j == 20)
            {
                $num--;
            }
        }
        
        return $num;
    }
    
    /**
     * 杨辉三角
     * 每一行的第一位和最后一位是1
     * 中间是其前排的一位与左边一排的和
     * @param num int 几行*/
    public function sanjiao()
    {
        $num = 6;
        //每一行的第一位和最后一位是1
        for($i=0; $i<=$num; $i++)
        {
            $a[$i][0] = 1;
            $a[$i][$i] = 1;
        }
        //除去第一位和最后一位
        for($i=2; $i<=$num; $i++)
        {
            for($j=1; $j<=$i; $j++)
            {
                $a[$i][$j] = $a[$i-1][$j] + $a[$i-1][$j-1];
            }
        }
        
        //打印
        for($i=0; $i<$num; $i++)
        {
            for($j=0; $j<=$i; $j++) 
            {
                echo $a[$i][$j].' ';
            }
            echo '<br/>';
        } 
        
    }
    
    /**
     * 快速排序
     * 取出一个元素，然后其他的元素和这个比较，大的放右边数组，小的放左边数组，然后两个数组再递归完成其排序，最后合并数组
     * @param arr array 数组*/
    public function kuaisu($arr){
        
        if(count($arr) <= 1){ return $arr; }
        
        $first = $arr[0];//取出数组中一个元素
        
        //定义两个空数组
        $leftArr  = array();
        $rightArr = array();
        
        //遍历数组与第一个元素的值相比较，大的放右边，小的放左边
        for($i=1; $i<count($arr); $i++)
        {
            if($arr[$i] <= $first)
            {
                $leftArr[] = $arr[$i];
            }
            else
            {
                $rightArr[] = $arr[$i];
            }    
        }
        
        //递归进行自身排序
        $leftArr  = $this->kuaisu($leftArr);
        $rightArr = $this->kuaisu($rightArr);
        
        //合并数组
        $newArr = array_merge($leftArr,array($first),$rightArr);
        
        return $newArr;
    }
    
    /**
     * 冒泡排序
     * 相邻两元素比较，大的放右边小的放左边，依次这样排序
     * @param arr array 数组*/
    public function maopao($arr)
    {
        if(count($arr) <= 1)
        {
            return $arr;
        }
        
        for($i=0; $i<count($arr); $i++)
        {
            for($j=count($arr)-1; $j>$i; $j--)
            {
                if($arr[$j] < $arr[$j-1])
                {
                    $a = $arr[$j];
                    $arr[$j] = $arr[$j-1];
                    $arr[$j-1] = $a;
                }
            }
        }
        return $arr;
    }
    
    public function a(){
        $arr = array(6,2,7,6,1,9,4,8,2,0,3,5);
        var_dump($this->maopao($arr));
        
    }
    
}