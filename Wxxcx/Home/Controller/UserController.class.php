<?php
namespace Home\Controller;
use Home\Controller\MyController;

/**
 * 获取小程序用户授权信息，存入到数据库*/
class UserController extends MyController {
    
    public function __construct()
    {
        parent::__construct();
        $this->appid = C('WXXCXAPPID');
        $this->secret= C('WXXCXAPPKEY');
    }
    
    /**
     * 根据code获取用户的openid*/
    public function getUserOpenid()
    {
        //获取code
        $code = $_REQUEST['code'];
        
        //code 换取 session_key
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$this->appid}&secret={$this->secret}&js_code={$code}&grant_type=authorization_code";
        
        $json = file_get_contents($url);
        $data = json_decode($json);
        
        $openid = $data->openid;//获取用户openid
        $w['openid'] = $openid;
        $info = M('user_xcx')->where($w)->find();
        if(!$info)
        {
            $add['openid'] = $openid;
            $add['createDate'] = date('Y-m-d H:i:s',time());
            M('user_xcx')->add($add);
        }
        
        $res['data'] = $openid;
        echo json_encode($res);
    }
    
    /**
     * 存入用户信息到数据库*/
    public function getUserInfo()
    {
        $openid     = $_POST['openid'];
        $nickname   = $_POST['nickname'];
        $avatarUrl  = $_POST['avatarUrl'];
        $gender     = $_POST['gender'];
        $city       = $_POST['city'];
        $province   = $_POST['province'];
        $country    = $_POST['country'];
        $language   = $_POST['language'];
        //var_dump($_POST);exit;
        
        //根据openid获取用户userid
        $userId = $this->getXcxUserId($openid);
        
        //判断该用户信息是否已写入数据库
        $flag = $this->getXcxUserInfo($openid);
        
        //存在则更新信息
        if($flag)
        {
            $d['nickname'] = $nickname;
            $d['avatarUrl']= $avatarUrl;
            $d['gender']   = $gender;
            $d['city']     = $city;
            $d['province'] = $province;
            $d['country']  = $country;
            $d['language'] = $language;
            $d['updateDate'] = date('Y-m-d H:i:s',time());
            $w['userxcxId'] = $userId;
            $res = M('user_xcx_userinfo')->where($w)->save($d);
            if(!$res)
            {
                $this->ajaxReturn($this->errmsg(10001, '更新失败'));
            }
            
            $this->ajaxReturn($this->errmsg(10000, '更新成功'));
        }
        
        //不存在则插入到数据库
        $add['userxcxId']= $userId;
        $add['nickname'] = $nickname;
        $add['avatarUrl']= $avatarUrl;
        $add['gender']   = $gender;
        $add['city']     = $city;
        $add['province'] = $province;
        $add['country']  = $country;
        $add['language'] = $language;
        $add['createDate'] = date('Y-m-d H:i:s',time());
        $res = M('user_xcx_userinfo')->add($add);
        if(!$res)
        {
            $this->ajaxReturn($this->errmsg(10001, '插入失败'));
        }
        
        $this->ajaxReturn($this->errmsg(10000, '插入成功'));
    }
    
    /**
     * 获取已答题列表
     * @param openid string 用户登录的openid*/
    public function onExamList()
    {
        $openid = I('get.openid');
        $userid = $this->getXcxUserId($openid);
        $where['r.userId'] = $userid;
        $list = M('exam_rank_list r')
                ->field('r.userId,r.examId,r.accuracy,r.createDate,e.papername')
                ->join('__EXAM__ as e on e.id = r.examId','LEFT')
                ->where($where)
                ->order('r.createDate desc')
                ->select();
        foreach($list as $k => $v)
        {
            $list[$k]['createdate'] = date('Y-m-d',strtotime($v['createdate']));
        }
        $data['data'] = $list;
        echo json_encode($data);
    }
    
    /**
     * 我所答试卷的具体内容
     * @param id int 试卷id
     * @param openid string 用户openid
     * @param */
    public function examResult()
    {
        $id = I('get.id');
        $openid = I('get.openid');
        
        $userid = $this->getXcxUserId($openid);
        
        $where['r.examId'] = $id;
        $where['r.userId'] = $userid;
        $list = M('exam_user_result as r')
                ->field('q.title,q.optionA,q.optionB,q.optionC,q.optionD,q.type,r.userOption,r.quesOption,r.isRightOption')
                ->join('__EXAM_QUESTION__ as q on q.id = r.questionId','LEFT')
                ->where($where)
                ->select();
        foreach($list as $k => $v)
        {
            $list[$k]['typename'] = $v['type'] == 1 ? '单选' : '多选';
            //把用户多选答案按|分割
            $uoption = explode('|', $v['useroption']);
            $list[$k]['useroption'] = $uoption;
        }
        
        $examInfo = M('exam')->where('id='.$id)->find();//试卷信息
        
        //按正确率由大到小排序
        $wh['examId'] = $id;
        $rankList = M('exam_rank_list')->where($wh)->order('accuracy desc')->select();
        
        //用户具体的答题内容
        $w['userId'] = $userid;
        $w['examId'] = $id;
        $info = M('exam_rank_list')->where($w)->find();
        $info['countnum'] = $info['rightnum'] + $info['errornum'];//总的答题数
        foreach($rankList as $k => $v)
        {
            if($info['userid'] == $v['userid'])
            {
                $info['rankorder'] = $k+1;//该用户在本试卷内的名次
            }
        }

        $data['info'] = $examInfo;//试卷信息
        $data['data'] = $list;//具体内容列表
        $data['ranklist'] = $info;//排行显示
        echo json_encode($data);
    }
}