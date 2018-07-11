<?php
namespace Home\Controller;
use Think\Controller;

class PhpController extends Controller
{
    /**
     * 用户名、邮箱、手机账号中间字符串以*隐藏
     * */
    public function hideStar($str) 
    {
        if (strpos($str, '@')) 
        {
            //邮箱
            $email_array = explode("@", $str);
            $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀
            $count = 0;//替换执行的次数
            $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count);
            $rs = $prevfix . $str;
        } 
        else 
        {
            $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i';
            if (preg_match($pattern, $str)) 
            {
                //手机号
                $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4);
            } 
            else 
            {
                //用户名
                $rs = substr($str, 0, 3) . "***" . substr($str, -1);
            }
        }
        return $rs;
    }
    
    public function getDateStringFromUrl()
    {
        //http://sports.sina.com.cn/china/j/2018-01-31/doc-ifyqyuhy7904789.shtml
        //http://sports.sina.com.cn/china/j/2018-01/31/doc-ifyqyuhy7904789.shtml
        //http://sports.sina.com.cn/china/j/2018/01/31/doc-ifyqyuhy7904789.shtml
        
        $str = 'http://sports.sina.com.cn/china/j/2018-01-31/2018-01/31/2018/01/31/20180506/doc-ifyqyuhy7904789.shtml';
        $preg = "'\d{4}[-|\/]\d{1,2}[-|\/]\d{1,2}|\d{8}'is";
        preg_match_all($preg,$str,$matches2);
        var_dump($matches2);
        
    }
    
    /**
     * 闭包*/
    public function printStr() {
        $func = function( $str ) {
            $sql = "select * from hwh_user where id = $str";
            $list = M()->query($sql);
            var_dump($list);
        };
        $func( 1 );
    }
    
    public function ip()
    {
        $ip  = $_SERVER['REMOTE_ADDR'];
        $ips = ip2long($ip);
        $ipr = long2ip($ips); 
        
        $ss = gethostbyname("www.beliv.cn");
        $rr = $_SERVER['SERVER_NAME'];
        var_dump($rr);
        
        $s = "索尼DSC-HX400  2998";
        
        $d = "why don't you do sth";
        $s = "why don't you take your son to a good doctor?";
        $a = "why don't you let him go";
        $r = "why don't you be youself";
        
        $s = "I'm thankful for everything that happens in my life";
        $r = "don't judge people before you truly know them";
        
    }
    
    
}