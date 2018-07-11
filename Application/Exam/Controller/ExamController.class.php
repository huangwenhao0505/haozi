<?php
namespace Exam\Controller;
use Exam\Controller\MyController;

/**
 * 题库类*/
class ExamController extends MyController
{
    
    /**
     * 创建试卷
     * @param name string 试卷名
     * @param time int 答题时长（单位分  答题过程中时间到了自动结束）
     * @param startDate datetime 开始时间
     * @param endDate datetime 结束时间（过了这个时间就不允许答题了）
     * @param remake text 备注*/
    public function createExam()
    {
        if(IS_AJAX)
        {
            $paperName    = I('post.name');
            $exerciseTime = I('post.time');
            $startDate    = I('post.startDate');
            $endDate      = I('post.endDate');
            $remake       = I('post.remake');
            
            if($paperName == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '试卷名不能为空'));
            }
            
            $w['paperName'] = $paperName;
            $res = M('exam')->where($w)->find();
            if($res)
            {
                $this->ajaxReturn($this->errmsg(10001, '试卷名已经存在'));
            }
            
            if($exerciseTime == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '请填写答题时长'));
            }
            
            if($startDate == '' || $endDate == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '请填写 开始时间和结束时间'));
            }
            
            $add['paperName'] = $paperName;
            $add['exerciseTime'] = $exerciseTime;
            $add['startDate'] = $startDate;
            $add['endDate'] = $endDate;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            $add['remake'] = $remake;
            $info = M('exam')->add($add);
            
            if(!$info)
            {
                $this->ajaxReturn($this->errmsg(10001, '创建失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '创建成功'));
        }

        $this->display('addExam');
    }
    
    /**
     * 添加题目
     * @param examId int 试卷id
     * @param title string 题目标题
     * @param optionA string 题目选项（A B C D）
     * @param type int 类型单选或多选（1单选 2多选）
     * @param rightOption string 正确答案 （多个以&号连接）*/
    public function addQuestion()
    {
        $examId = I('post.examId');
        $title  = I('post.title');
        $optionA= I('post.optionA');
        $optionB= I('post.optionB');
        $optionC= I('post.optionC');
        $optionD= I('post.optionD');
        $type   = I('post.type');
        $rightOption = I('post.rightOption');
        
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
        
        //当时多选时，判断其正确答案的个数
        if($type == 2)
        {
            $num = explode('&', $rightOption);
            if(count($num) < 2)
            {
                $this->ajaxReturn($this->errmsg(10001, '多选题请至少设置两个正确答案'));
            }
        }
        
        $add['type'] = $type;
        $add['examId'] = $examId;
        $add['title'] = $title;
        $add['optionA'] = $optionA;
        $add['optionB'] = $optionB;
        $add['optionC'] = $optionC;
        $add['optionD'] = $optionD;
        $add['rightOption'] = $rightOption;
        $row = M('exam_question')->add($add);
        if(!$row)
        {
            $this->ajaxReturn($this->errmsg(10001, '添加失败'));
        }
        
        $this->ajaxReturn($this->errmsg(10000, '添加成功'));
    }
    
    /**
     * 计算公布排行榜
     * @param examId int 试卷id*/
    public function rankList()
    {
        if(IS_AJAX)
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
                $this->ajaxReturn($this->errmsg(10001, '选择的试卷不存在'));
            }
            
            $where['examId'] = $examId;
            $list = M('exam_rank_list')->where($where)->order('accuracy desc')->select();
            
            $this->ajaxReturn($this->errmsg(10000, '成功', $list));
        }

    }
    
}