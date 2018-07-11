<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 生成二维码*/
class QrcodeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        include_once './third-party/phpqrcode/phpqrcode.php';
    }
    
    /**
     * 生成原始的二维码(不生成图片文件)
     * 只显示输出
     * */
    public function getPng()
    {
        $value = 'https://www.beliv.cn'; //二维码内容
        $errorCorrectionLevel = 'L';     //容错级别
        $matrixPointSize = 12;            //生成图片大小
        
        //生成二维码图片
        $QR = \QRcode::png($value);
        
        //生成二维码图片，并保存在./Public/code文件中，文件名为code.png
        //$filename = './Public/code/code.png';
        //\QRcode::png($value, $filename , $errorCorrectionLevel, $matrixPointSize, 2);
    }
    
    /**
     * 在生成的二维码中加上logo(生成图片文件) 
     * */
    public function getPngLogo()
    {
        $value = 'https://www.beliv.cn'; //二维码内容
        $errorCorrectionLevel = 'L';     //容错级别
        $matrixPointSize = 12;            //生成图片大小
        
        //生成二维码图片(保存到文件./Public/code，文件名为code.png)
        $filename = './Public/code/code.png';
        \QRcode::png($value, $filename , $errorCorrectionLevel, $matrixPointSize, 2);
        
        $QR = $filename; //生成二维码图片
        $logo   = "./Public/code/logo.png";  //logo图片   

        if (file_exists($logo) !== FALSE) 
        {
            $QR = imagecreatefromstring(file_get_contents($QR));//目标图象连接资源。 
            $logo = imagecreatefromstring(file_get_contents($logo));//源图象连接资源。  
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;//组合之后logo的宽度(占二维码的1/5)
            $scale = $logo_width/$logo_qr_width;//logo的宽度缩放比(本身宽度/组合后的宽度)  
            $logo_qr_height = $logo_height/$scale;//组合之后logo的高度  
            $from_width = ($QR_width - $logo_qr_width) / 2;//组合之后logo左上角所在坐标点
            //重新组合图片并调整大小
            //imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        
        //输出图片
        imagepng($QR, './Public/code/qrcode.png');//保存新的图片,图片名为qrcode.png,保存在文件./Public/code/
        echo "成功：/Public/code/qrcode.png";
        /*imagedestroy($QR);
        imagedestroy($logo);
        echo '<img src="Public/qrcode.png" alt="使用微信扫描支付">';*/
    }
}