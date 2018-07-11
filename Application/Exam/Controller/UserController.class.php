<?php
namespace Exam\Controller;
use Think\Controller;

/**
 * 用户相关类*/
class UserController extends Controller
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
    
    /**
     * 试卷列表*/
    public function listExam()
    {
        $list = M('exam')->select();
        $this->assign('list',$list);
        $this->display('index');
    }
    
    /**
     * 进入某个试卷
     * @param id int 试卷id
     * @param timestamp string 进入试卷的时间戳(经过了处理)*/
    public function onExam()
    {
        $id = $_GET['id'];
        $timestamp = $_GET['timestamp'];
        
        //还原时间戳
        $timestamp = substr($timestamp, 0, -1) * 24 * 60 * 60 * 1000;
        
        $examInfo = M('exam')->where('id='.$id)->find();
        $list = M('exam_question')->where('examId='.$id)->select();
        foreach($list as $k => $v)
        {
            $list[$k]['typename'] = $v['type'] == 1 ? '单选' : '多选';
        }
        
        $this->assign('timestamp',$timestamp);
        $this->assign('examInfo',$examInfo);
        $this->assign('list',$list);
        $this->display();
    }
    
    /**
     * 提交试卷
     * @param examId int 试卷id
     * @param radioIdList string 单选题的答案  题目id-答案 （多题就是这样的  "questionId-A,questionId-C,..."）
     * @param checkIdList string 多选题的答案  题目id-答案（多题就是这样的  "questionId-A|B|C,questionId-C|D,..."）*/
    public function getExam()
    {
        $userId = session('id');
        $examId = I('post.examId');
        $radioIdList = I('post.radioIdList');
        $checkIdList = I('post.checkIdList');
        if($userId == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '请先登录'));
        }
        
        if($examId == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '请选择试卷'));
        }
        
        $w['id'] = $examId;
        $res = M('exam')->where($w)->find();
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, '选择的试卷不存在'));
        }
        
        //单选题的处理
        $radioList = explode(',', $radioIdList);
        foreach($radioList as $k => $v)
        {
            $arr = explode('-', $v);
            $questionId = $arr[0];   //题目id
            $optionName = $arr[1];  //对应的答案
            
            $add['userId'] = $userId;
            $add['examId'] = $examId;
            $add['questionId'] = $questionId;
            $add['userOption'] = $optionName;
            M('exam_user_result')->add($add);
        }
        
        //多选题的处理
        $checkList = explode(',', $checkIdList);
        
        //把题目id和答案分割开来，生成二维数组
        $checkArr = array();
        foreach($checkList as $k => $v)
        {
            $checkArr[] = explode('-', $v);  
        }
        
        //把同一道题的多个答案组合在一起，生成二维数组
        $newarr = array();
        foreach($checkArr as $key => $val)
        {
            $newarr[$val[0]][] = $val;
        }
        
        //遍历插入到数据库
        foreach($newarr as $key => $val)
        {
            $optionValue = array();
            foreach($val as $k => $v)
            {
                $optionId = $v[0];//取出题目id
                $optionValue[] = $v[1];//把同一道题的答案放在同一个数组里
            }
            
            $optionString = implode('|', $optionValue);//把多答案拼接成字符串形式：如A|B|C
            //插入到数据库
            $ad['userId'] = $userId;
            $ad['examId'] = $examId;
            $ad['questionId'] = $optionId;
            $ad['userOption'] = $optionString;
            M('exam_user_result')->add($ad);
        }
        
        //根据用户id和试卷id查找用户选择回答的题目列表
        
        $wh['userId'] = $userId;
        $wh['examId'] = $examId;
        $questionList = M('exam_user_result')->where($wh)->select();

        foreach($questionList as $k => $v)
        {
            $userOption = $v['useroption'];//用户答案

            //根据试卷id和题目id判断用户回答的答案是否正确
            $where['examId'] = $v['examid'];
            $where['id'] = $v['questionid'];
            $info = M('exam_question')->where($where)->find();
            
            $quesOption = $info['rightoption'];//正确答案

            if($userOption == $quesOption){//回复正确
                $d['isRightOption'] = 1;
            }else{//回答不正确
                $d['isRightOption'] = 2;
            }
            $d['quesOption'] = $quesOption;
            
            //更新每题的正确答案和正确与否到数据库
            $r['userId'] = $v['userid'];
            $r['examId'] = $v['examid'];
            $r['questionId'] = $v['questionid'];
            M('exam_user_result')->where($r)->save($d);
        }
        
        //统计该用户回答的正确题目数
        $whe['userId'] = $userId;
        $whe['examId'] = $examId;
        $whe['isRightOption'] = 1;
        $rightCount = M('exam_user_result')->where($whe)->count();
        
        //错误题目数
        $err['userId'] = $userId;
        $err['examId'] = $examId;
        $err['isRightOption'] = 2;
        $errorCount = M('exam_user_result')->where($err)->count();
        
        //该试卷的题目数
        $wher['examId'] = $examId;
        $count = M('exam_question')->where($wher)->count();
        
        //判断其正确率
        $accuracy = ($rightCount / $count)*100;

        //写入相关信息到hwh_exam_rank_list表
        $dd['examId'] = $examId;
        $dd['userId'] = $userId;
        $dd['rightNum'] = $rightCount;
        $dd['errorNum'] = $errorCount;
        $dd['accuracy'] = $accuracy;
        $dd['createDate'] = date('Y-m-d H:i:s',time());
        M('exam_rank_list')->add($dd);
        
        $this->ajaxReturn($this->errmsg(10000, '成功'));
    }
    
    /**
     * 返回用户答题信息
     * @param examId int 试卷id*/
    public function setUserExam()
    {
        $userId = session('id');
        $examId = I('post.examId');
        
        //返回给用户答题信息
        $usr['examId'] = $examId;
        $usr['userId'] = $userId;
        $rankInfo = M('exam_rank_list')->where($usr)->find();
        $questionResult = M('exam_user_result')->where($usr)->select();
        $data['quesResult'] = $questionResult;
        $data['info'] = $rankInfo;
        
        echo json_encode($data);
        //$this->ajaxReturn($this->errmsg(10000, '成功', $data));
    }
    
    /**
     * 排行榜列表
     * @param examId int 试卷id*/
    public function rankList()
    {
        $examId = I('get.examId');
        if($examId == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '请选择试卷'));
        }
        
        $res = M('exam')->where('id='.$examId)->find();
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, '该试卷不存在'));
        }
        
        $sql = "select e.*,u.username,u.u_img
            from hwh_exam_rank_list e
            left join hwh_user u on u.id = e.userId
            where e.examId = $examId order by e.accuracy desc";
        $list = M()->query($sql);
        foreach($list as $k => $v)
        {
            $list[$k]['accuracy'] = $v['accuracy']."%";
        }
        
        $this->assign('list',$list);
        $this->display();
    }
}