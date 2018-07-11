<?php
namespace Admin\Controller;
use Think\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $this->display('list');
    }
    
    /**
     * 爬取数据
     * @param id int 规则id
     * */
    public function startCrawler()
    {
        $id   = $_GET['id'];
        $url  = "http://localhost:8081/news/startCrawler?ruleId={$id}";
        $data = file_get_contents($url);
        echo $data;
    }
    
    /**
     * 爬虫规则列表
     * */
    public function getRuleList()
    {
        if(IS_AJAX)
        {
            $ruleUrl  = "http://localhost:8081/rule/getRuleList";
            $ruleData = file_get_contents($ruleUrl);
            echo $ruleData;
        }
    }
    
    /**
     * 新增爬虫规则
     * @param taskId int 任务id
     * @param url  string 种子链接url
     * @param cateName string 种子名称（如：中超）
     * */
    public function addRule()
    {
        if(IS_AJAX)
        {
            $taskId   = $_POST['taskId'];
            $url      = $_POST['url'];
            $cateName = $_POST['cateName'];
            
            $dataUrl  = "http://localhost:8081/rule/addRule?taskId={$taskId}&url={$url}&cateName={$cateName}";
            $data = file_get_contents($dataUrl);
            
            echo $data;
            exit;
        }
        
        //任务来源列表
        $url  = "http://localhost:8081/rule/getTaskList";
        $data = file_get_contents($url);
        $res  = json_decode($data,true);
        $list = $res['result'];
        
        $this->assign('taskList', $list);
        $this->display('add');
    }
    
    /**
     * 删除某个抓取规则
     * @param id int 规则id
     * */
    public function delRule()
    {
        if(IS_AJAX)
        {
            $id   = $_GET['id'];
            $url  = "http://localhost:8081/rule/delRule?id={$id}";
            $data = file_get_contents($url);
            echo $data;    
        }
    }
    
    /**
     * 根据任务id获取任务链接*/
    public function getTaskUrl()
    {
        if(IS_AJAX)
        {
            $id  = $_GET['id'];
            $url = "http://localhost:8081/rule/getTaskUrl?id={$id}";
            $data= file_get_contents($url);
            echo $data;
        }
    }
    
}