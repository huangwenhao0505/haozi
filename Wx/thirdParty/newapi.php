<?php
class wechatCallbackapiTest{
    
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
            $time = time();//时间戳
            //接收经纬度信息
            $latitude = $postObj->Location_X;
            $longitude = $postObj->Location_Y;
            
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
                    $result = $this->receiveLocation($postObj);  
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
     * 处理点击事件*/
    public function receiveEvent($postObj){
        if($postObj->Event == 'CLICK'){
            
            $eventKey = $postObj->EventKey;//自定义菜单接口中KEY
            
            if($eventKey == 'V1001_NBA'){
                $content = "豪子，www.beliv.cn";
                $result = $this->transmitText($postObj, $content);
                return $result;
                
            }else if($eventKey == 'V1001_ZUQIU'){
                $content = A('Index')->zhuqiu();
                $result = $this->transmitText($postObj, $content);
                return $result;
                
            }
        }
    }
    
    /**
     * 回复文本消息
     * @param unknown $object
     * @param unknown $content
     * @return string*/
    private function transmitText($object, $content)
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

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $msgType, $content);  //格式化输出
        return $result;
    }
    
    /**
     * 回复图片消息
     * @param unknown $object
     * @param unknown $imageArray
     * @return string*/
    private function transmitImage($object, $imageArray)
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
        
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    
    /**
     * 回复语音消息
     * @param unknown $object
     * @param unknown $voiceArray
     * @return string*/
    private function transmitVoice($object, $voiceArray)
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

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    
    /**
     * 回复视频消息
     * @param unknown $object
     * @param unknown $videoArray
     * @return string*/
    private function transmitVideo($object, $videoArray)
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

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    
        /**
         * 回复图文消息
         * @param unknown $object
         * @param unknown $newsArray
         * @return void|string*/
    private function transmitNews($object, $newsArray)
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
                    <MsgType><![CDATA[news]]></MsgType>
                    <Content><![CDATA[]]></Content>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>
                    $item_str</Articles>
                    </xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }
    
    /**
     * 回复音乐消息
     * @param unknown $object
     * @param unknown $musicArray
     * @return string*/
    private function transmitMusic($object, $musicArray)
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

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
}