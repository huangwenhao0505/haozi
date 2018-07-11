<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 题库类*/
class ExamController extends Controller
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
     * 试卷列表*/
    public function examList()
    {
        $list = M('exam')->order('id desc')->select();
        $this->assign('list',$list);
        $this->display('examList');
    }
    
    /**
     * 删除试卷
     * @param id int 试卷id*/
    public function delExam()
    {
        if(IS_AJAX)
        {
            $id = $_POST['id'];
            $w['id'] = $id;
            $res = M('exam')->where($w)->delete();
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
            
            $where['examId'] = $id;
            M('exam_question')->where($where)->delete();//删除所有的题目
            M('exam_user_result')->where($where)->delete();//删除用户所答的该试卷的相关内容
            M('exam_rank_list')->where($where)->delete();//删除该试卷的排行榜
            
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    }
    
    /**
     * 添加题目
     * @param examId int 试卷id
     * @param title string 题目标题
     * @param optionA string 题目选项（A B C D）
     * @param type int 类型单选或多选（1单选 2多选）
     * @param rightOption string 正确答案 （多个以|号连接）*/
    public function addQuestion()
    {
        if(IS_AJAX)
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
            
            if($title == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '请填写试题名称'));
            }
            
            $wh['title'] = $title;
            $res = M('exam_question')->where($wh)->find();
            if($res)
            {
                $this->ajaxReturn($this->errmsg(10001, '该试题已经存在'));
            }
            
            if($rightOption == '')
            {
                $this->ajaxReturn($this->errmsg(10001, '请设置正确答案'));
            }
            
            //当多选时，判断其正确答案的个数
            if($type == 2)
            {
                $num = explode('|', $rightOption);
                if(count($num) <= 1)
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
        
        $examId = I('get.id');  //试卷id get请求
        $this->assign('examId',$examId);
        $this->display('addQuestion');
    }
    
    /**
     * 删除试题
     * @param id int 试题id*/
    public function delQuestion()
    {
        if(IS_AJAX)
        {
            $id = I('get.id');
            $res = M('exam_question')->where('id='.$id)->delete();
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '删除失败'));
            }
    
            $this->ajaxReturn($this->errmsg(10000, '删除成功'));
        }
    
    }
    
    /**
     * 题目列表
     * @param id int 所属试卷的id
     */
    public function questionList()
    {
        $examId = I('get.id');
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
        $list = M('exam_question')->where($where)->select();
        foreach($list as $k => $v)
        {
            $list[$k]['type'] = $v['type'] == 1 ? '单选' : '<span style="color:red;">多选</span>';
        }
        
        $this->assign('examInfo',$res);//试卷信息
        $this->assign('list',$list);    //试题列表
        $this->display('questionList');
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
            $data['list'] = $list;
            
            echo json_encode($data);
        }

    }
    
}