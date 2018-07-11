<?php
namespace Home\Controller;
use Think\Controller;

class FunController extends Controller {
    
    private $isMobile;
    
    public function __construct(){
        parent::__construct();
        $this->isMobile = A('IsMobile')->isMobile();
    }
    
    private function errmsg($errno,$errmsg){
        $array = array(
            'errno' => $errno,
            'errmsg'=> $errmsg
        );
        return $array;
    }
    
    public function index(){
        $userid = session('id');
        if($userid != '' || $userid != null){
            //$info = M('user')->field('u_img')->where("id=".$userid)->find();
            //$info['u_img'] = $info['u_img'] != '' ? $info['u_img'] : '/Public/touxiang.png';
            $sql = "select u.u_img,u.login_way,q.qq_img from hwh_user u left join hwh_user_qq q on q.qq_openid = u.qq_openid where u.id = $userid";
            $info = M()->query($sql);
            $info[0]['u_img'] = $info[0]['login_way'] == 1 ? $info[0]['qq_img'] : ($info[0]['u_img'] != '' ? $info[0]['u_img'] : '/Public/touxiang.png');
        }else{
            $info = array();
        }
        $this->assign("userInfo",$info);
        
        A('Qq')->qqurl();//QQ登录入口
        
        $isMobile = $this->isMobile;;
        if($isMobile == true)
        {
            //手机端浏览
            $this->display('FunSj/index');
            exit;
        }
        $this->display();
    }
    
    /**
     * 文件列表
     * @param fileCate string 文件后缀
     * @param currPage int 当前页
     * @param tiaoPage int 跳转到第几页*/
    public function fileList()
    {
        if(IS_AJAX)
        {
            $fileCate = $_POST['fileCate'];
            if($fileCate != '')
            {
                $where['u.fileSuffix'] = $fileCate;
            }
            
            //总记录数  每页显示数  总页数
            $count = M('file_upload u')->where($where)->count();
            
            $isMobile = $this->isMobile;;
            if($isMobile == true)
            {
                //手机端浏览
                $pageSize = 4;
            }
            else
            {
                $pageSize = 12;
            }
            
            $totalPage = ceil($count/$pageSize);
            
            //当前页  起始页
            if($_POST['tiaoPage'] != '' || $_POST['tiaoPage'] != null){ //输入跳转页数
                $tiaoPage = isset($_POST['tiaoPage']) ? trim($_POST['tiaoPage']) : 1;
                $currPage = ($tiaoPage >= 1 && $tiaoPage <= $totalPage) ? $tiaoPage : 1;
            }else{  //点击上一页下一页
                $currPage = isset($_POST['currPage']) ? trim($_POST['currPage']) : 1;
                $currPage = ( $currPage>=1 && $currPage<=$totalPage) ? $currPage : 1;
            }
            
            $stateRow = ($currPage-1)*$pageSize;
            
            //分页跳转时要带的参数，保证点击下一页时查询条件还存在
            foreach($where as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            
            $list['filelist'] = M('file_upload u')
                    ->field('u.*,a.nickname')
                    ->join('__ADMIN__ a on a.id = u.adminId','LEFT')
                    ->where($where)
                    ->order('u.createDate desc')
                    ->limit($stateRow.','.$pageSize)
                    ->select();
            
            foreach($list['filelist'] as $k => $v)
            {
                $filename   = $v['filename'];//文件名
                $fileSuffix = $v['filesuffix'];//文件后缀

                $list['filelist'][$k]['filename'] = $filename.$fileSuffix;//完整文件名
                $list['filelist'][$k]['createdate'] = date('Y-m-d H:i',strtotime($v['createdate']));
            }
            
            //文件所存在类型列表
            $fileCategoryList = M('file_upload')->group('fileSuffix')->select();
            $list['filecategorylist'] = $fileCategoryList;

            $data['count'] = $count;    //总记录数
            $data['currPage'] = $currPage;//当前页
            $data['total_page'] = $totalPage;//总页数
            $data['list'] = empty($list) ? false : $list;
            
            echo json_encode($data);
            exit;
        }
    }
    
    /**
     * 文件下载
     * @param id int 文件所在的id*/
    public function document()
    {
        header("Content-type:text/html;charset=utf-8");
        
        $id = $_GET['id'];
        $where['id'] = $id;
        $info = M('file_upload')->where($where)->find();
        if(!$info)
        {
            $this->errmsg(10001, '文件不存在');
        }
        
        $filePath = $info['fileurl'];//文件所在的路径
        
        //拆分路径，文件名取出来
        $filename = trim(strrchr($filePath, '/'),'/');//截取最后一个斜杠后面的内容
        $path     = strstr($filePath, $filename, true);//截取除$filename的内容外的其他内容
        
        /** 
         * 这里有两种方法（上传时用哪种，下载时就用哪种，不然文件会找不到）
         * 1，解决上传到服务器的文件中文名字正常显示的问题，但是这样下载时，下载的名字就会已乱码形式显示
         * 2，上传到服务器的文件中文名字以乱码形式显示，但是用户下载时，显示的是正常的中文名字
         * @综合用户体验度考虑，就已第2种方法去实现。而且服务器里的文件一般也不会去看，想看的话也可以通过下载来下载到本地查看 **/
        //$newFileName = iconv("utf-8","gb2312",$filename);//解决中文不能显示出来的问题
        $newFileName = $filename;
        
        //拼接成完整的路径
        $newFilePath = $path.$newFileName;
        
        //判断给定的文件存在与否
        if(!file_exists($newFilePath)){
            $this->error('该文件不存在！');
        }
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($newFilePath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($newFilePath));
        readfile($newFilePath);
    }
               
    /**
     * PHP向服务器发送HTTP的POST请求
     * @param url string 访问地址
     * @param post_data array 参数
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
    
    public function toJava()
    {
        $innerOrderNo = "20180522155140200000356";
        $fee = "0";
        $sign = "";
        $orderStatus = "3";
        $outerOrderNo = "F2018052309325303257";
        $totalAmount = "0.01";
        $field1 = "622876000500001434";
        $signType = "RSA";
        $currency = "CNY";
        $partnerId = "96ede999f1704270a469d931af1d60c0";
        $field3 = "";
        $field2 = "20180511144609";
        $partnerBuyerId = "";
        
        $arr = array(
            "innerOrderNo"  => $innerOrderNo,
            "fee"           => $fee,
            "sign"          => $sign,
            "orderStatus"   => $orderStatus,
            "outerOrderNo"  => $outerOrderNo,
            "totalAmount"   => $totalAmount,
            "field1"        => $field1,
            "field2"        => $field2,
            "field3"        => $field3,
            "signType"      => $signType,
            "currency"      => $currency,
            "partnerBuyerId"=> $partnerBuyerId,
            "partnerId"     => $partnerId
        );
        
        $url = "http://www.zglzd.com.cn/lzd_app/admin/light/webPay/payNotify";
        $content = $this->send_post($url, $arr);
        echo $content;
    }
    
    /**
     * 图灵机器人*/
    public function tuling(){ 
        if(IS_AJAX){
            $userid = session('id');
            $key = C(TULING_KEY);
            $info = trim($_POST['info']);
            $loc = trim($_POST['loc']);
            
            if($userid == "" || $userid == null){
                $this->ajaxReturn($this->errmsg(10001, "请先登录哟！"));
            }
            
            $array = array("key"=>$key,"info"=>$info,"loc"=>$loc,"userid"=>$userid);
            $url = "http://www.tuling123.com/openapi/api";  //请求的网址
    
            $content = $this->send_post($url, $array);

            echo $content;
        }
    }
    
    /**
     * 城市天气查询*/
    public function weather(){
    
        if(IS_AJAX){
            $key = C(HEWEATHER_KEY);
            $city = trim($_POST['city']);
    
            //$durl = "https://api.heweather.com/v5/search?city={$city}&key={$key}";
            $durl = "https://free-api.heweather.com/v5/weather?city={$city}&key={$key}";
    
            $data = file_get_contents($durl);   //返回的是json格式
            
            echo $data;
        }
    }
}