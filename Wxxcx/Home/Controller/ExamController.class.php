<?php
namespace Home\Controller;
use Home\Controller\MyController;

class ExamController extends MyController
{
    /**
     * 试卷列表*/
    public function examlist()
    {
        $page = $_GET['page'];
        $list = M('exam')->limit($page)->order('createDate desc')->select();
        foreach($list as $k => $v){
            $list[$k]['nowtimes'] = time();
            $list[$k]['endtimes'] = strtotime($v['enddate']);
            $list[$k]['enddate']  = date('Y-m-d',strtotime($v['enddate']));
        }
        $data['data'] = $list;
        echo json_encode($data);
    }
    
    /**
     * 题目列表
     * @param id int 所属试卷的id
     * @param openid string 用户openid
     */
    public function questionList()
    {
        $examId = I('get.id');
        $openId = I('get.openid');
        
        $this->checkLogin($openId);//判断是否授权登录
        
        $userId = $this->getXcxUserId($openId);//获取用户id
        
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
        
        //判断该用户是否已经回答了该试卷
        $wh['userId'] = $userId;
        $wh['examId'] = $examId;
        $row = M('exam_rank_list')->where($wh)->find();
        if($row)
        {
            $type = 1;//回答了
        }
        else
        {
            $type = 2;//还未做答
        }
        
    
        $where['examId'] = $examId;
        $list = M('exam_question')->where($where)->select();
        foreach($list as $k => $v)
        {
            $list[$k]['typename'] = $v['type'] == 1 ? '单选' : '多选';
        }
        
        $data['type'] = $type;
        $data['info'] = $res;//试卷信息
        $data['list'] = $list;//试题列表
        echo json_encode($data);
    }
    
    /**
     * 提交试卷
     * @param openId string 用户openid
     * @param examId int 试卷id
     * @param radioIdList string 单选题的答案  题目id-答案 （多题就是这样的  "questionId-A,questionId-C,..."）
     * @param checkIdList string 多选题的答案  题目id-答案（多题就是这样的  "questionId-A|B|C,questionId-C|D,..."）
     * @param questionIdList string 所有题目的id*/
    public function getExam()
    {
        $openId = I('post.openId');
        $examId = I('post.examId');
        $radioIdList = I('post.radioIdList');
        $checkIdList = I('post.checkIdList');
        $questionIdList = I('post.questionIdList');

        $this->checkLogin($openId);//判断是否授权登录
        
        $userId = $this->getXcxUserId($openId);//获取用户id
    
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
        
        //判断是否已经答题
        $rs['userId'] = $userId;
        $rs['examId'] = $examId;
        $flag = M('exam_user_result')->where($rs)->select();
        if($flag)
        {
            $this->ajaxReturn($this->errmsg(10001, '已答题'));
        }
       
        //把单选题所选答案的题目id放在数组中
        if($radioIdList != '')
        {
            $radioIdArr = explode(',', $radioIdList);
            $idArr = array();//存放所选答案id(单选题)
            foreach($radioIdArr as $k => $v)
            {
                $arr = explode('-', $v);
                $idArr[] = $arr[0];
            }
        }
        else
        {
            $idArr = array();
        }
        
        //把多选题所选答案的题目id放在数组中
        if($checkIdList != '')
        {
            $checkIdArr = explode(',', $checkIdList);
            $idArr2 = array();//存放所选答案id(多选题)
            foreach($checkIdArr as $k => $v)
            {
                $arr2 = explode('-',$v);
                $idArr2[] = $arr2[0];
            }
        }
        else
        {
            $idArr2 = array();
        }
        
        //单选题和多选题的答案id相组合
        $newIdArr2 = array_unique($idArr2);//去除数组中相同的元素，既多选题相同的题目id只保留一个
        $idAllArr = array_merge($idArr,$newIdArr2);
        
        //判断所有题目是否全部已选择答案
        $questionIdArr = explode(',', $questionIdList);
        foreach($questionIdArr as $k => $v)
        {
            if(in_array($v, $idAllArr) == false)
            {
                $this->ajaxReturn($this->errmsg(10001, '请完成做答再提交'));
            }
        }
        
        //判断多选题的答案选择是否多于一个[试卷有多选题时才处理]
        if(!empty($idArr2))
        { 
            $countArr = array_count_values($idArr2);//计算数组中相同元素出现的次数，既题目id
            foreach($countArr as $k => $v)
            {
                if($v <=1 )
                {
                    $this->ajaxReturn($this->errmsg(10001, '多选题请至少选则两个答案'));
                }
            }
        }

        //单选题的处理[试卷有单选题时才处理]
        if($radioIdList != '')
        {
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
        }

        //多选题的处理[试卷有多选题时才处理]
        if($checkIdList != '')
        {
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
                $adds['userId'] = $userId;
                $adds['examId'] = $examId;
                $adds['questionId'] = $optionId;
                $adds['userOption'] = $optionString;
                M('exam_user_result')->add($adds);
            }
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
            
            //容错处理,用户多选时可能先选C，再选A
            $quesOptionNew = explode('|', $quesOption);//拆分正确答案
            $userOptionNew = explode('|', $userOption);//拆分用户答案
            $isRight = array_diff($quesOptionNew,$userOptionNew);

            if($isRight == array()){//回答正确
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
     * 排行榜
     * @param examId int 试卷id*/
    public function rankList()
    {
        $examId = I('post.examId');
        
        if($examId == '')
        {
            $this->ajaxReturn($this->errmsg(10001, '请选择试卷'));
        }
        
        $w['id'] = $examId;
        $res = M('exam')->where($w)->find();
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, '该试卷不存在'));
        }
        
        $info = M('exam')->where('id='.$examId)->find();
        
        $list = M('exam_rank_list as r')
        ->field('u.userxcxId,u.nickname,u.avatarUrl,r.accuracy')
        ->join('__USER_XCX_USERINFO__ as u on u.userxcxId = r.userId','LEFT')
        ->where('r.examId='.$examId)
        ->order('r.accuracy desc')
        ->select();
        
        $data['data'] = $list;
        $data['info'] = $info;
        echo json_encode($data);
    }
}