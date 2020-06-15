<?php
namespace WY\app\controller\mobile;
use WY\app\libs\Controller;
use WY\app\model\Bill;
if (!defined('WY_ROOT')) {
    exit;
}
class mycode extends CheckUser
{
    public function index()
    {
		//include('./phpqrcode.php'); 
		//$imgfurl="/code/".time().".png";
		$picUrl = 'http://7t1.cn/mobile/pay?payid='.$this->userInfo['userid'];     //二维码扫描出的链接
		//QRcode::jpg($picUrl,$imgfurl,'L',4,0);     //生成png图片
		//生成二维码图片，加载到网站中
		$data = array('title' => '管理银行卡', 'imgfurl' => $picUrl);
    	$this->put('mycode.php', $data);
    }
}
?>