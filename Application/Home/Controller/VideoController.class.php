<?php
namespace Home\Controller;
use Think\Controller;

class VideoController extends Controller
{
    /**
     * 加载视频列表页面
     * */
    public function index()
    {
        $userList = M('video')->select();
        
        $adminIdArr = array();
        $userIdArr  = array();
        foreach($userList as $k => $v)
        {
            if($v['type'] == 1){//管理员上传
                $adminIdArr[] = $v['userid'];
            }else{//用户上传
                $userIdArr[] = $v['userid'];
            }
        }
        
        //去除重复的数据
        $adminIdNewArr = array_unique($adminIdArr);//所有上传视频的管理员id
        $userIdNewArr  = array_unique($userIdArr);//所有上传视频的用户id
        
        //存储所有上传者
        $arr = array();
        //所有上传视频的管理员信息
        foreach($adminIdNewArr as $k => $v)
        {
            $arr[] = M('admin a')->field('a.id, a.nickname, v.type')->where('type=1 and a.id='.$v)->join('__VIDEO__ v on v.userId = a.id')->find();
        }
        //所有上传视频的用户信息
        foreach($userIdNewArr as $k => $v)
        {
            $arr[] = M('user u')->field('u.id, u.nickname, v.type')->where('type=2 and u.id='.$v)->join('__VIDEO__ v on v.userId = u.id')->find();
        }
        
        $this->assign('userList', $arr);
        $this->display('listVideo2');
    }
    
    /**
     * AJAX无刷新获取视频列表
     * @param userType String 上传视频者信息  参数以userId-type拼接组合
     * @param tiaoPage int 跳转页
     * @param currPage int 当前页
     * */
    public function ajaxListVideo()
    {
        if(IS_AJAX)
        {
            $userType = I('post.userType');
            
            if($userType != 0)
            {
                $userTypeArr = explode('-', $userType);
                $userId = $userTypeArr[0];//上传者id
                $type   = $userTypeArr[1];//上传者类型
                
                $where['userId'] = $userId;
                $where['type']   = $type;
            }
            else
            {
                $where['type'] != 3;//容错处理，如果没有传参数，会报错，这里给个条件就可以了
            }
            
            //总记录数  每页显示数  总页数
            $count     = M('video')->where($where)->count();
            $pageSize  = 10;
            $totalPage = ceil($count/$pageSize);
            
            //当前页  起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){ //输入跳转页数
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{  //点击上一页下一页
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ( $currPage>=1 && $currPage<=$totalPage) ? $currPage : 1;
            }
            
            $stateRow = ($currPage-1)*$pageSize;
            
            $list = M('video v')->where($where)->limit($stateRow.','.$pageSize)->select();
            foreach($list as $k => $v)
            {
                if($v['type'] == 1){//管理员
                    $list[$k]['info'] = M('admin')->field('nickname')->where('id='.$v['userid'])->find();
                }else{//用户
                    $list[$k]['info'] = M('user')->field('nickname')->where('id='.$v['userid'])->find();
                }
            }
            
            $d['count'] = $count;   //总记录数
            $d['currPage'] = $currPage;//当前页
            $d['total_page']= $totalPage;//总页数
            $d['list'] = empty($list) ? false : $list;
            //var_dump($list);exit;
            
            echo json_encode($d);
            exit;
        }
    }
    
    /**
     * 新增视频*/
    public function addVideo()
    {
        $this->display('addVideo2');
    }
    
}