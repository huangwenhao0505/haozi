<?php
namespace Home\Controller;
use Think\Controller;

class ListController extends Controller
{
    public function index()
    {
        $page = $_GET['page'];
        //$list = M('article')->select();
        $sql = "select author,title from hwh_article limit $page";
        $list = M()->query($sql);
        $data['data'] = $list;
        echo json_encode($data);
    }
}