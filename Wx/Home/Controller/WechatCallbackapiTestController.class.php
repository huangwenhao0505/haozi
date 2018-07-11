<?php
namespace Home\Controller;
use Think\Controller;

class WechatCallbackapiTestController extends Controller {
    /**
     * 定义valid验证方法
     * @param token string 密钥常量*/
    public function valid($token)
    {
        //接收随机字符串
        $echoStr = $_GET["echostr"];
    
        //调用checkSignature方法，此方法返回布尔类型的值
        if($this->checkSignature($token)){
            //返回输出随机字符串
            echo $echoStr;
            //强制中止代码段的执行
            exit;
        }
    }
    
    /**
     * 定义checkSignature方法
     * @param token string 密钥常量*/
    private function checkSignature($token)
    {
        //1）将token、timestamp、nonce三个参数进行字典序排序
        $nonce = $_GET['nonce'];
        $timestamp = $_GET['timestamp'];
        $echostr = $_GET['echostr'];
        $signature = $_GET['signature'];
    
        //2）将三个参数字符串拼接成一个字符串进行sha1加密
        $array = array($nonce, $timestamp, $token);
        sort($array);
        $str = sha1( implode( $array ) );
    
        //3）获得加密后的字符串 ，然后与signature进行校验
        if( $str == $signature && $echostr ){ //第一次接入weixin api接口的时候
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 响应消息*/
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);  //获得对象信息
    
            $fromUsername = $postObj->FromUserName;//获取客户端手机的openid(类似网卡的mac值，唯一的）
            $toUsername = $postObj->ToUserName;//获取微信公众平台账号gh_微信码
            $keyword = trim($postObj->Content);//获取用户发送过来的关键词
            $rec = $postObj->Recognition;//获取语音识别后的结果
            
    
            $msgType = trim($postObj->MsgType);//获取接收消息的类型MsgType（严格注意大小写）
    
            switch ($msgType)
            {
                case "event":               //点击事件
                    $result = $this->receiveEvent($postObj);    //返回信息
                    break;
                case "text":                //文本信息
                    $result = $this->receiveText($postObj);
                    break;
                case "image":               //图片
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":            //维度
                    $result = $this->receiveLoction($postObj);
                    break;
                case "voice":               //音频
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":               //视频
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":                //链接
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$msgType;
                    break;
            }
    
            echo $result;
        }else {
            echo "";
            exit;
        }
    }
    
    /**
     * 处理点击事件
     * @param $postObj object 对象信息*/
    protected function receiveEvent($postObj){
        //点击事件
        if($postObj->Event == 'CLICK'){
    
            $eventKey = $postObj->EventKey;//自定义菜单接口中KEY
    
            if($eventKey == 'V1001_NBA'){
                $content = "爱足球的你，肯定很handsome!!!";
                $result = $this->transmitText($postObj, $content);
    
            }else if($eventKey == 'V1001_ZUQIU'){
                $content = "点击事件足球哟！";
                $result = $this->transmitText($postObj, $content);
    
            }else if($eventKey == 'V1001_PAIQIU'){//多图文
                
                $newArray = array(
                    array(
                        'Title' => '哈哈哈哈哈哈哈',//标题
                        'Description' => '要成功啊啊啊啊啊啊啊啊。。。',//简介
                        'PicUrl'=> 'http://zglzd-10055021.image.myqcloud.com/081dbbe5-6714-466e-ac66-6125f5e1b4f7',//封面图
                        'Url'   => 'www.baidu.com'//链接跳转地址
                    ),
                    array(
                        'Title' => '梦想成真',//标题
                        'Description' => '呀，好像是真的。',//简介
                        'PicUrl'=> 'http://zglzd-10055021.image.myqcloud.com/561a6905-f11f-410d-b566-c6862666fc2d',//封面图
                        'Url'   => 'www.hao774.com'//链接跳转地址
                    ),
                );
                
                $result = $this->transmitNews($postObj, $newArray);

            }else if($eventKey == 'V1001_CODE'){//获取二维码
                
                $token = A('Index')->token();
                //原始长链接
                $longUrl = "https://www.beliv.cn/wxindex.php/home/index/code";
                
                //长链接转换成短链接
                $wxUrl = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token={$token}";
                $postData = "{\"action\":\"long2short\",\"long_url\":\"{$longUrl}\"}";
                $newUrl = A('WechatCallbackapiTest')->httpsSend($wxUrl,$postData);
                
                //生成的短链接
                $shortUrl = json_decode($newUrl)->short_url;
                
                $result = $this->transmitText($postObj, $shortUrl);
            }
            
            return $result;
        }
        
        //关注事件
        if($postObj->Event == 'subscribe'){
            $content = "Hi,欢迎关注龙之队体育。爱运动，爱生活！！！";
            $result = $this->transmitText($postObj, $content);
            return $result;
        }
        
        //已关注时的事件推送
        if($postObj->Event == 'SCAN'){
            $content = "感谢您的支持与关怀！！！";
            $result = $this->transmitText($postObj, $content);
            return $result;
        }
        
        //获取用户地理位置
        if($postObj->Event == 'LOCATION'){
            $result = $this->transmitLocation($postObj);
            return $result;
        }
        
    }
    
    /**
     * 处理文本消息事件
     * @param $postObj object 对象信息*/
    protected function receiveText($postObj){
        
        $keyword = trim($postObj->Content);//获取用户发送过来的关键词
        
        if(empty($keyword)){
           echo "...";
           exit; 
        }
        
        if($keyword == "?" || $keyword == "？"){
            $content = "龙之队体育，好的很哟！！！";
            $result = $this->transmitText($postObj, $content);
            return $result;
            
        }else{
            $key = C(TULING_KEY);//图灵机器人key
            $url = "http://www.tuling123.com/openapi/api?key={$key}&info={$keyword}";//定义url地址(图灵机器人)
            $str = file_get_contents($url);
            $json = json_decode($str);//获取json对象
            $content = $json->text;//获取返回内容

            $result = $this->transmitText($postObj, $content);
            return $result;
        }
    }
    
    /**
     * 回复文本消息模板
     * @param unknown $postObj
     * @param unknown $content
     * @return string*/
    private function transmitText($postObj, $content)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
    
        $msgType = 'text';
    
        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $msgType, $content);  //格式化输出
        return $result;
    }
    
    /**
     * 回复图片消息模板
     * @param unknown $postObj
     * @param unknown $imageArray
     * @return string*/
    private function transmitImage($postObj, $imageArray)
    {
        $itemTpl = "<Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Image>";
    
        $item_str = sprintf($itemTpl, $imageArray['MediaId']);
    
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[image]]></MsgType>
        $item_str
        </xml>";
        
        $msgType = "image";
    
        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $msgType);
        return $result;
    }
    
    /**
     * 回复语音消息模板
     * @param unknown $postObj
     * @param unknown $voiceArray
     * @return string*/
    private function transmitVoice($postObj, $voiceArray)
    {
        $itemTpl = "<Voice>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>";
    
        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);
    
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[voice]]></MsgType>
        $item_str
        </xml>";
    
        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time());
        return $result;
    }
    
    /**
     * 回复视频消息模板
     * @param unknown $postObj
     * @param unknown $videoArray
     * @return string*/
    private function transmitVideo($postObj, $videoArray)
    {
        $itemTpl = "<Video>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    </Video>";
    
        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);
    
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[video]]></MsgType>
        $item_str
        </xml>";
    
        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time());
        return $result;
    }
    
    /**
     * 回复图文消息模板
     * @param unknown $postObj
     * @param unknown $newsArray*/
    private function transmitNews($postObj, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }

        $itemTpl = "<item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                    </item>";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>
                    $item_str</Articles>
                    </xml>";
        
        $msgType = 'news';
        
        $count = count($newsArray);
    
        $result = sprintf($newsTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $msgType, $count);
        return $result;
    }
    
    /**
     * 回复音乐消息模板
     * @param unknown $postObj
     * @param unknown $musicArray
     * @return string*/
    private function transmitMusic($postObj, $musicArray)
    {
        $itemTpl = "<Music>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <MusicUrl><![CDATA[%s]]></MusicUrl>
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                    </Music>";
    
        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);
    
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[music]]></MsgType>
        $item_str
        </xml>";
    
        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time());
        return $result;
    }
    
    private function transmitLocation($postObj){
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Event><![CDATA[LOCATION]]></Event>
                    <Latitude>%s</Latitude>
                    <Longitude>%s</Longitude>
                    <Precision>%s</Precision>
                    </xml>";
        
        $msgType = 'event';
        
        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $msgType, $this->Latitude, $this->Longitude, $this->Precision);
        return $result;
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
        if( !empty($paramData) ) {
            curl_setopt($ch,CURLOPT_POSTFIELDS,$paramData);
        }
        if( !empty($cfg['header']) ) {
            curl_setopt($ch,CURLOPT_HTTPHEADER,$cfg['header']);
        }
        $data = curl_exec($ch);
        curl_close($ch);
    
        return $data;
    }
    
    /*
    function httpGet($url) {    
        $curl = curl_init();  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($curl, CURLOPT_URL, $url);  
      
        $res = curl_exec($curl);  
        curl_close($curl);  
        return $res;  
      }  
    
    function httpPost($url,$data){  
        $curl = curl_init();  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($curl, CURLOPT_URL, $url);  
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");  
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  
  
        $res = curl_exec($curl);  
        curl_close($curl);  
        return $res;  
    }*/
    
}