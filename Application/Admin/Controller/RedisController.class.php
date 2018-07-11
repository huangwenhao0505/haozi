<?php
namespace Admin\Controller;
use Think\Controller;

class RedisController extends Controller {
    
    /**
     * 连接redis*/
    public function redis(){
        $host = $_SERVER['SERVER_ADDR'];
        $redis = new \Redis();
        $redis->connect($host);
        return $redis;
    }
    
    /**
     * redis读取应用*/
    public function getinfo(){
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
    
        // 获取存储的数据并输出
        $result = json_decode($redis->get("articleList"),'true');
    
        if(empty($result)){
            $result = M('Article')->select();
            //重新将缓存放入数据库 redis不能直接存数组需要转成json
            $redis->set('articleList',json_encode($result));
        }else{
            //连接本地的 Redis 服务
            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);
            // 获取存储的数据并输出
            $result = json_decode($redis->get("articleList"),'true');
        }
    
        print_r($result);
        exit();
    }
    
    /**
     * redis新增应用*/
    public function addinfo(){
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        /*删除key*/
        $redis->del('tutoriallist');
    }
    
    /**
     * redis更新应用*/
    public function updateinfo(){
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        /*删除key*/
        $redis->del('tutoriallist');
    }
    
    /**
     * redis删除应用*/
    public function deleteinfo(){
    
        //运行sql语句
    
        //连接本地的 Redis 服务
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->del('tutoriallist');
    }
    
    /**
     * 入队操作*/
    public function listAdd(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        echo 1;
        while(True){
            try{
                $value = 'value_'.date('Y-m-d H:i:s');
                $redis->LPUSH('key1',$value);
                sleep(rand()%3);
                echo $value."\n";
            }catch(\Exception $e){
                echo $e->getMessage()."\n";
            }
        }
    
    }
    
    /**
     * 出队操作*/
    public function listOut(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        while(True){
            try{
                echo $redis->LPOP('key1')."\n";
            }catch(\Exception $e){
                echo $e->getMessage()."\n";
            }
            sleep(rand()%3);
        }
    }
}