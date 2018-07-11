<?php
namespace Home\Controller;
use Think\Controller;

class VueController extends Controller {
    
    public function index(){
        $this->display();
    }
    
    public function vue()
    {
        $this->display();
    }
    
    public function like()
    {
        $this->display();
    }
    
    
    /**
     * 数据列表*/
    public function getList()
    {
        $sql = "select * from g_category order by createDate desc";
        $list = M()->query($sql);
        foreach($list as $k => $v)
        {
            $list[$k]['createdate'] = date('Y-m-d H:i',strtotime($v['createdate']));
        }
        $data['list'] = $list;
        echo json_encode($data);
    }
    
    /**
     * 新增数据*/
    public function addData()
    {
//         $name = $_GET['name'];
//         $num  = $_GET['ordernum'];
        $name = $_POST['name'];
        $num  = $_POST['ordernum'];
        $date = date('Y-m-d H:i:s', time());
        
        $sql = "insert into g_category (name, orderNum, createDate) values ('{$name}', $num, '{$date}')";
        $res = M()->execute($sql);
        
        echo json_encode($res);
    }
    
    /**
     * 删除数据*/
    public function delData()
    {
        $id = $_GET['id'];
        
        $sql = "delete from g_category where id = $id";
        $res = M()->execute($sql);
        
        echo json_encode($res);
    }
}