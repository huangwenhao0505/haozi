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
		//接收客户端传递过来的XML格式的数据
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		if(empty($postStr)){
		    echo "发生了错误哟！";
		    exit;
		}

        libxml_disable_entity_loader(true);//解析XML时不解析XML实体，防止XXE攻击
      	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//XML解析，生成SimpleXML对象
        $fromUsername = $postObj->FromUserName;//获取客户端手机的openid(类似网卡的mac值，唯一的）
        $toUsername = $postObj->ToUserName;//获取微信公众平台账号gh_微信码
        $rec = $postObj->Recognition;//获取语音识别后的结果
        $keyword = trim($postObj->Content);//获取用户发送过来的关键词
        $time = time();//时间戳
        
        //接收经纬度信息
        $latitude = $postObj->Location_X;
        $longitude = $postObj->Location_Y;
        
        //回复消息模板
        $textTpl  = $this->transmitText();//文本
        $newsTpl  = $this->transmitNews();//图文
        $musicTpl = $this->transmitMusic();//音乐
        
        $msgType = $postObj->MsgType;//获取接收消息的类型MsgType（严格注意大小写）
        
        //判断用户发送的消息类型MsgType
		if($msgType=='text') {
		    
			//判断用户发送的关键词是否为空
			if(!empty( $keyword ))
			{
				if($keyword=='?' || $keyword=='？') {
				    //以text文本形式返回数据到客户端
					$msgType = "text";
					//定义回复内容
					//$contentStr = "感谢您关注简易号码簿，请输入【】中的内容：\n【1】特种服务号码\n【2】通讯服务号码\n【3】银行服务号码\n【4】用户反馈";
					$contentStr = "请输入【】中的内容：\n【1】黄文豪是傻逼\n【2】黄文豪是大大傻逼\n【3】任盟是谁\n【4】任盟是蠢货";
					//格式化XML字符串
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

				} elseif($keyword=='1') {
					$msgType = "text";
					$contentStr = "常用特种服务号码：\n匪警：110\n火警：119\n急救：120";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

				} elseif($keyword=='2') {
					$msgType = "text";
					$contentStr = "常用通讯服务号码：\n中移动：10086\n中电信：10000\n中联通：10010";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					
				} elseif($keyword=='3') {
					$msgType = "text";
					$contentStr = "常用银行服务号码：\n建设：95533\n工商：99588\n农业：95599";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					
				} elseif($keyword=='4') {
					$msgType = "text";
					$contentStr = "尊敬的用户，为了更好的为您服务，请将系统的不足之处反馈给我们。\n反馈格式：@+建议内容\n例如：@希望增加***号码";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					
				} elseif(strpos($keyword,'@')===0) {
					$msgType = "text";
					$contentStr = "感谢您的宝贵建议，我们会努力为您提供更好的服务！";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					
				} elseif($keyword=='音乐') {

					//以音乐形式返回数据到客户端
					$msgType = "music";
					//定义音乐标题
					$title = "速度与激情7";
					//定义音乐描述
					$desc = "速度与激情原声大碟...";
					//定义音乐地址
					$url = "http://czbk888.duapp.com/music.mp3";
					//定义高清音乐地址
					$hqurl = "http://czbk888.duapp.com/music.mp3";
					//格式化XML格式的数据
					$resultStr = sprintf($musicTpl, $fromUsername, $toUsername, $time, $msgType, $title, $desc, $url, $hqurl);
					
				} elseif($keyword=='单图文') {
					//定义回复类型为图文回复
					$msgType = "news";
					//定义图文回复数量
					$count = 1;
					//组装第三个参数
					$str = '<Articles>';
					for($i=1;$i<=$count;$i++) {
						$str .= "<item>
								 <Title><![CDATA[微信开发教程]]></Title> 
								 <Description><![CDATA[和涛哥学习微信开发...]]></Description>
								 <PicUrl><![CDATA[http://czbk.sinaapp.com/images/{$i}.jpg]]></PicUrl>
								 <Url><![CDATA[https://www.beliv.cn/index.php/home/login/login]]></Url>
								 </item>";
					}
					$str .= '</Articles>';
					//格式化XML格式的数据
					$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $count, $str);
					
				} elseif($keyword=='多图文') {
					//定义回复类型为图文回复
					$msgType = "news";
					//定义图文回复数量
					$count = 4;
					//组装第三个参数
					$str = '<Articles>';
					for($i=1;$i<=$count;$i++) {
						$str .= "<item>
						<Title><![CDATA[微信开发教程]]></Title>
						<Description><![CDATA[和涛哥学习微信开发...]]></Description>
						<PicUrl><![CDATA[http://czbk.sinaapp.com/images/{$i}.jpg]]></PicUrl>
						<Url><![CDATA[http://czbk.sinaapp.com/]]></Url>
						</item>";
					}
					$str .= '</Articles>';
					//格式化XML格式的数据
					$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $count, $str);
					
				} else {
					//以text文本形式返回数据到客户端
					$msgType = "text";
					
					//定义url地址(图灵机器人)
					$url = "http://www.tuling123.com/openapi/api?key=9009fc44f168cfc7055c8a469821ce9b&info={$keyword}";
					//通过file_get_contents发送get请求
					$str = file_get_contents($url);
					//获取json对象
					$json = json_decode($str);
					//获取返回内容
					$contentStr = $json->text;
					
					//定义回复内容
					
					//格式化XML字符串
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					
				}
				
				//输出返回XML数据到客户端
				echo $resultStr;
				
			}else{
				echo "Input something...";
			}
			
		} elseif($msgType=='image') {
			//以text文本形式返回数据到客户端
			$msgType = "text";
			//定义回复内容
			$contentStr = "您发送的是图片消息，图片真漂亮！";
			//格式化XML字符串
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			//输出返回XML数据到客户端
			echo $resultStr;
		} elseif($msgType=='voice') {
			//以text文本形式返回数据到客户端
			$msgType = "text";
			
			//定义url地址
			$url = "http://www.tuling123.com/openapi/api?key=9009fc44f168cfc7055c8a469821ce9b&info={$rec}";
			//通过file_get_contents发送get请求
			$str = file_get_contents($url);
			//获取json对象
			$json = json_decode($str);
			//获取返回内容
			$contentStr = str_replace("<br>", "", $json->text);
			
			//定义回复内容
			
			//格式化XML字符串
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			//输出返回XML数据到客户端
			echo $resultStr;
			
		} elseif($msgType=='video' || $msgType=='shortvideo') {
			//以text文本形式返回数据到客户端
			$msgType = "text";
			//定义回复内容
			$contentStr = "您发送的是视频消息，不会是大片吧！";
			//格式化XML字符串
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			//输出返回XML数据到客户端
			echo $resultStr;
		} elseif($msgType=='location') {
			//以text文本形式返回数据到客户端
			$msgType = "text";
			
			//定义一个请求的url地址
			$url = "http://api.map.baidu.com/telematics/v3/reverseGeocoding?location={$longitude},{$latitude}&coord_type=gcj02&output=json&ak=2pReiGS2nQV9Gi7tslO9r2UZ";
			//模拟发送get请求
			$str = file_get_contents($url);
			//把json格式字符串转化对象或数组
			$json = json_decode($str);
			//输出当前地理位置的详细信息
			$addr = $json->description;
			
			//定义回复内容
			$contentStr = "您发送的是地理位置消息，位置如下：{$addr}";
			//格式化XML字符串
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			//输出返回XML数据到客户端
			echo $resultStr;
		} elseif($msgType=='link') {
			//以text文本形式返回数据到客户端
			$msgType = "text";
			//定义回复内容
			$contentStr = "您发送的是链接消息，感谢分享，好人！";
			//格式化XML字符串
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			//输出返回XML数据到客户端
			echo $resultStr;
			
		} elseif($msgType=='event') {
            //点击事件
            if($postObj->Event == 'CLICK'){
                if($postObj->EventKey == 'V1001_NBA'){
                    $msgType = 'text';
                    $contentStr = "豪子，www.beliv.cn";
                    
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }
            }

        }else{
            $msgType = "text";
            //定义回复内容
            $contentStr = "您发送的是链接消息，感谢分享，好人！";
            //格式化XML字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //输出返回XML数据到客户端
            echo $resultStr;
            	
        }
			
        
    }

    /**
     * 定义文本回复模板*/
    private function transmitText(){
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
    
        return $textTpl;
    }
    
    /**
     * 定义音乐回复模板*/
    private function transmitMusic(){
        $musicTpl = "<xml>
					 <ToUserName><![CDATA[%s]]></ToUserName>
					 <FromUserName><![CDATA[%s]]></FromUserName>
					 <CreateTime>%s</CreateTime>
					 <MsgType><![CDATA[%s]]></MsgType>
					 <Music>
					 <Title><![CDATA[%s]]></Title>
					 <Description><![CDATA[%s]]></Description>
					 <MusicUrl><![CDATA[%s]]></MusicUrl>
					 <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
					 </Music>
					</xml>";
        return $musicTpl;
    }
    
    /**
     * 定义图文回复模板*/
    private function transmitNews(){
        $newsTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					%s
					</xml>";
        return $newsTpl;
    }
}