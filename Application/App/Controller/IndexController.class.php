<?php
namespace App\Controller;
use App\Controller\AppController;

class IndexController extends AppController {
    
    /**
     * 首页列表*/
    public function index(){
        
        //首页推荐列表4篇文章
        $articleList = M('article')->where('is_ok=1')->order('id desc')->limit(4)->select();
        
        //幽默笑话列表
        $jokeList = M('joke')->where('is_ok=1')->order('id desc')->limit(2)->select();
        
        //文章内容展示1篇
        $detailArticle = M('article')->where('is_ok=1 and is_recommend=1')->order('create_date desc')->limit(1)->find();

        $data['articleList'] = $articleList;
        $data['jokeList'] = $jokeList;
        $data['detailArti'] = $detailArticle;
        
        $res = $this->ajaxReturn($this->errmsg(10000, '成功！', $data));
        echo json_encode($res);
    }
    
    
}