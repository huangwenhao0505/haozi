<?php
namespace Home\Controller;
use Think\Controller;

class UrlUtileController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     *  发送https请求
     * @param $url https://www.xxxx.com
     * @param $paramData 发送的数据
     * @param int $isPost 发送post 还是get请求 默认post
     * @param $cfg $cfg['header'] =  array('Content-Type: application/json'); 默认空
     * @return $data;
     */
    public function httpsSend($url,$paramData,$isPost=true,$cfg=array()) {
        if( !function_exists('curl_init') ) {
            echo "请开启curl！";
            exit;
        }
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);//ssl不强制
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//返回结果
        if( $isPost ) {
            curl_setopt($ch,CURLOPT_POST,1);
        }
        if( !empty($data) ) {
            curl_setopt($ch,CURLOPT_POSTFIELDS,$paramData);
        }
        if( !empty($cfg['header']) ) {
            curl_setopt($ch,CURLOPT_HTTPHEADER,$cfg['header']);
        }
        $data = curl_exec($ch);
        curl_close($ch);
    
        return $data;
    }
    
    /**
     * 发送get请求
     * @param $url
     */
    public function getHttps($url) {
        return $this->httpsSend($url,null,false);
    }
}