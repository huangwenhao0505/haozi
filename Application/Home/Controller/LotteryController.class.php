<?php
namespace Home\Controller;
use Think\Controller;

class LotteryController extends Controller 
{
    /*public function index(){
        $prize_arr = array(
            '0' => array('id' => 1, 'title' => 'iphone5s', 'v' => 5), 
            '1' => array('id' => 2, 'title' => '联系笔记本', 'v' => 10), 
            '2' => array('id' => 3, 'title' => '音箱设备', 'v' => 20), 
            '3' => array('id' => 4, 'title' => '30GU盘', 'v' => 30), 
            '4' => array('id' => 5, 'title' => '话费50元', 'v' => 10), 
            '5' => array('id' => 6, 'title' => 'iphone6s', 'v' => 15), 
            '6' => array('id' => 7, 'title' => '谢谢，继续加油哦！~', 'v' => 10),
        );
        
        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val['v'];
        }
        
        $prize_id = $this->getRand($arr); //根据概率获取奖品id 
        $data['msg'] = ($prize_id == 7) ? 0 : 1; //如果为0则没中  
        $data['prize_title'] = $prize_arr[$prize_id - 1]['title']; //中奖奖品 
        echo json_encode($data);
        exit; //以json数组返回给前端
    }*/
    
    public function index(){
        $this->display();
    }
    
    public function lottery(){
        //prize表示奖项内容，v表示中奖几率(若数组中七个奖项的v的总和为100，如果v的值为1，则代表中奖几率为1%，依此类推)
        $prize_arr = array(
            '0' => array('id' => 1, 'prize' => '唱歌', 'v' => 1),
            '1' => array('id' => 2, 'prize' => '跳舞', 'v' => 1),
            '2' => array('id' => 3, 'prize' => '发红包5元', 'v' => 1),
            '3' => array('id' => 4, 'prize' => '真心话', 'v' => 1),
            '4' => array('id' => 5, 'prize' => '喝酒', 'v' => 1),
            '5' => array('id' => 6, 'prize' => '谢谢惠顾', 'v' => 1),
            '6' => array('id' => 7, 'prize' => '七等奖', 'v' => 1),
            '7' => array('id' => 8, 'prize' => '八等奖', 'v' => 1),
            '8' => array('id' => 9, 'prize' => '九等奖', 'v' => 1),
            '9' => array('id' => 10, 'prize' => '十等奖', 'v' => 1),
            '10' => array('id' => 11, 'prize' => '十一等奖', 'v' => 25),
            '11' => array('id' => 12, 'prize' => '谢谢惠顾', 'v' => 25),
        );
        foreach ($prize_arr as $k=>$v) {
            $arr[$v['id']] = $v['v'];
        
        }
        
        $prize_id = $this->getRand($arr); //根据概率获取奖项id
        foreach($prize_arr as $k => $v){ //获取前端奖项位置
            if($v['id'] == $prize_id){
                $prize_site = $k;
                break;
            }
        }
        $res = $prize_arr[$prize_id - 1]; //中奖项
        
        $data['prize_name'] = $res['prize'];
        $data['prize_site'] = $prize_site;//前端奖项从-1开始
        $data['prize_id'] = $prize_id;
        echo json_encode($data);
    }
    
    function getRand($proArr) { //计算中奖概率 
        $rs = ''; //中奖结果 
        $proSum = array_sum($proArr); //概率数组的总概率精度
        //概率数组循环 
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $rs = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        
        unset($proArr);
        return $rs;
    }
}