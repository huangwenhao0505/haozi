<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    
    /**
     * 获取微信的access_token*/
    public function token(){
        $appid = C(WXAPPID);
        $appsecret = C(WXAPPKEY);
        
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $json = file_get_contents($url);
        $data = json_decode($json);
        //$json = A('UrlUtile')->getHttps($url);
        //$data = json_decode($json);

        $access_token = $data->access_token;
        return $access_token;
    }
    
    public function responseMsg(){
        $access_token = $this->token();

        //接收客户端传递过来的XML格式的数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        
        if(!empty($postStr)){
            //解析XML时不解析XML实体，防止XXE攻击
            libxml_disable_entity_loader(true);
            //XML解析，生成SimpleXML对象
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            //获取微信公众平台账号gh_微信码
            $toUsername = $postObj->ToUserName;
            //获取客户端手机的openid(类似网卡的mac值，唯一的）
            $fromUsername = $postObj->FromUserName;
            //获取消息类型的类型MsgType（严格注意大小写）
            $msgType = $postObj->MsgType;
            //获取消息内容
            $content = $postObj->Content;
            //接收经纬度信息
            $latitude = $postObj->Location_X;
            $longitude = $postObj->Location_Y;
            //时间戳
            $time = time();
            
            //定义文本回复模板
            $textTpl = "<xml>
                     <ToUserName><![CDATA[%s]]></ToUserName>
                     <FromUserName><![CDATA[%s]]></FromUserName>
                     <CreateTime>%s</CreateTime>
                     <MsgType><![CDATA[%s]]></MsgType>
                     <Content><![CDATA[%s]]></Content>
                     <MsgId>%s</MsgId>
                     </xml>";
            
            //定义图片回复模板
            $imgTpl = "<xml>
                     <ToUserName><![CDATA[%s]]></ToUserName>
                     <FromUserName><![CDATA[%s]]></FromUserName>
                     <CreateTime>%s</CreateTime>
                     <MsgType><![CDATA[%s]]></MsgType>
                     <PicUrl><![CDATA[%s]]></PicUrl>
                     <MediaId><![CDATA[%s]]></MediaId>
                     <MsgId>%s</MsgId>
                     </xml>";
            
            //定义语音回复模板
            $voiceTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <MediaId><![CDATA[%s]]></MediaId>
                        <Format><![CDATA[%s]]></Format>
                        <MsgId>%s</MsgId>
                        </xml>";
            
            //定义视频回复模板
            $videoTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <MediaId><![CDATA[%s]]></MediaId>
                        <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                        <MsgId>%s</MsgId>
                        </xml>";
            
            //定义地理位置回复模板
            $locationTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Location_X>%s</Location_X>
                        <Location_Y>%s</Location_Y>
                        <Scale>%s</Scale>
                        <Label><![CDATA[%s]]></Label>
                        <MsgId>%s</MsgId>
                        </xml>";
            
            //定义链接回复模板
            $linkTpl = "<xml>
                    <ToUserName><![CDATA[toUser]]></ToUserName>
                    <FromUserName><![CDATA[fromUser]]></FromUserName>
                    <CreateTime>1351776360</CreateTime>
                    <MsgType><![CDATA[link]]></MsgType>
                    <Title><![CDATA[公众平台官网链接]]></Title>
                    <Description><![CDATA[公众平台官网链接]]></Description>
                    <Url><![CDATA[url]]></Url>
                    <MsgId>1234567890123456</MsgId>
                    </xml>";
        }

    }
    
    /**
     * PHP向服务器发送HTTP的POST请求
     * @param $ulr string 请求的Url地址
     * @param $post_data array 参数
     * */
    private function send_post($url, $post_data) {
        $postdata = http_build_query($post_data);   //转换为了key=key&info=info 这样的形式
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options); //创建并返回一个文本数据流并应用各种选项  如 file_get_contents()
    
        $result = file_get_contents($url, false, $context);
        return $result;
    
    }
    
    public function menu(){
        $access_token = $this->token();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";

        $data = '{
                     "button":[
                     {
                          "type":"click",
                          "name":"首页",
                          "key":"home"
                      },
                      {
                           "type":"click",
                           "name":"简介",
                           "key":"introduct"
                      },
                      {
                           "name":"菜单kwkwkw",
                           "sub_button":[
                            {
                               "type":"click",
                               "name":"hello word",
                               "key":"V1001_HELLO_WORLD"
                            },
                            {
                               "type":"click",
                               "name":"赞一下我们",
                               "key":"V1001_GOOD"
                            }]
                       }]
                }';
        
        $res = $this->send_post($url, $data);
        var_dump($res);
    }
    
    
}