<?php
if (!defined('CORE')) {
	exit('Request Error!');
}

/**
 * 首页控制器
 *
 * @version 2013.07.05
 */
class ctl_pay {

	public static $userinfo;
	public static $control;
	public $cache_enable = true; //缓存开关,调试时可设为false
	public $cachetime = 7200; //缓存时间,秒(注意:内容页缓存是单独的在video_view中设置)
	public $cache_prefix = 'taluo.yibeiyv.com';
	public $cache_key = 'h5_index/index';
	public $str_where_ext = '`status`!=9';

	public function __construct() {
		if (empty($this->items)) {
			$this->items = new items();
		}

	}
	
	
	public function go() {//跳转支付
		$oid = req::item('oid');
		$type = req::item('type');//订单
		
		if($type==2){//支付宝支付
			$row = mod_order::get_order($oid);
			$orders = array('WIDout_trade_no'=>$row['oid'],'WIDsubject'=>$row['des'],'WIDtotal_amount'=>$row['money'],'WIDbody'=>$row['des']);
			$gourl = URL.'payment/alipay_wap/wappay/pay.php?'.http_build_query($orders);
            mod_order::up_order(array('paytype'=>2,'paytime'=>date('Y-m-d G:i:s',time()))," `oid`='".$oid."'");
        }else{
            
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {//微信内
					header('Location: '.URL.'getcode.php?auk=demo3&oid='.$oid);
					exit;
                }else{
					
				if(preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){
					$row = mod_order::get_order($oid);
					$ac=mod_order::typetochannel($row['type']);
					$orders = array('WIDout_trade_no'=>$row['oid'],'WIDsubject'=>$row['des'],'WIDtotal_amount'=>$row['money'],'WIDbody'=>$row['des'],'ac'=>$ac);
					self::h5pay($orders);
				}else{
					//die('pc扫码支付');
					$row = mod_order::get_order($oid);
					$orders = array('WIDout_trade_no'=>$row['oid'],'WIDsubject'=>$row['des'],'WIDtotal_amount'=>$row['money'],'WIDbody'=>$row['des']);
					$httpdata = http_build_query($orders);
					header('Location: '.URL.'payment/Wxpay_gz/example/native.php?'.$httpdata);
					die;
				}
                                                                            
            }
			
            //mod_order::up_order(array('paytype'=>1,'paytime'=>date('Y-m-d G:i:s',time()))," `oid`='".$oid."'");
		}
		#echo $gourl;
		echo "<script language=\"javascript\">";
		echo "document.location=\"" . $gourl . "\"";
		echo "</script>";
		exit;
		#header("Location:?ct=h5_suanming&ac=sm_form&base=365&oid=$oid");
	}
	
	public function notify() {
		$out_trade_no = req::item('out_trade_no');
		$trade_no = req::item('trade_no');
		$tk = req::item('tk');

        $orders = mod_order::get_order($out_trade_no);
        if($tk==md5($out_trade_no.'55k')){
           // if (1 == 1) {//查看商户号以及订单状态
                mod_order::up_order(array('trade_status' => $trade_no,'status'=>1,'time'=>date('Y-m-d H:i:s')), 'oid=' . $out_trade_no);
                $ac=mod_order::typetochannel($orders['type']);
                header("Location:".URL."?ac=".$ac."&oid=".$out_trade_no."&token=".base64_encode(md5($out_trade_no)));
                exit;
           // }
        }
    }
	
	
	public function scanquery(){
		$oid = req::item('oid');
		$row = mod_order::get_order($oid);
		if($row['status']=='1'){
			$return['status'] = true;
			$ac=mod_order::typetochannel($row['type']);
			$return['url'] = URL."?ac=".$ac."&oid=".$oid;
		}else{
			$return['status'] = false;
			$return['url'] = '';
		}
		exit(json_encode($return));
	}

    
    public function h5pay($row){//$row['money']
		//$orders = array('WIDout_trade_no'=>$row['oid'],'WIDsubject'=>$row['des'],'WIDtotal_amount'=>1,'WIDbody'=>$row['des']);
		$orders = $row;
		//$orders['WIDtotal_amount'] = $row['money'];
		$httpdata = http_build_query($orders);
		header('Location: '.URL.'payment/Wxpay_gz/example/h5api.php?'.$httpdata);
		die; 
    }


    public function h5paycallback(){
        $xml = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");//$GLOBALS['HTTP_RAW_POST_DATA'];

        $result = WxPayResults::Init($xml);


        die;
    }




    public function wxjsapi(){
		
        $code = req::item('code');
        $oid = req::item('oid');
		$openid = req::item('openid');
		
        if(!empty($code)){

            $appid = WXAPPID;
            $secret = WXAPPSECRET;
            $weixin =  file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code");//通过code换取网页授权access_token
            $jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
            $array = get_object_vars($jsondecode);//转换成数组
            $openid = $array['openid'];//输出openid
        }

        if(!$openid){
            die('openid is null');
        }
		
		$row = mod_order::get_order($oid);
		
		$ac=mod_order::typetochannel($row['type']);
		$row['url'] = URL."?ac=".$ac."&oid=".$oid."&token=".base64_encode(md5($oid));
		$row['oid'] = $oid;
        $sub_openid = $openid;
		
		$data['openid'] = $openid;
		$data['oid'] = $oid;
		$data['des'] = $row['des'];
		$data['money'] = $row['money'];

        $return = send(URL.'payment/Wxpay_gz/example/jsapi.php',$data);
		
		$return = json_decode($return,true);
		
		
		if($return){
			$rows["appId"]= $return["appId"]; //公众号名称，由商户传入
			$rows["timeStamp"]= $return["timeStamp"]; //时间戳，自1970 年以来的秒数
			$rows["nonceStr"]= $return["nonceStr"]; //随机串
			$rows["package"]= $return["package"];
			$rows["signType"]= $return["signType"]; //微信签名方式:
			$rows["paySign"]= $return["paySign"]; //微信签名
		}
		tpl::assign('row',$row);
        tpl::assign('pay_info',$rows);

        $tpl     = 'index/wx_gzh_pay.tpl';

        $contents = tpl::fetch($tpl);

        exit($contents);

    }


}
