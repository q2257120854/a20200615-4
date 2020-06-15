<?php
namespace WY\app\libs;

use WY\app\libs\Mailer\PHPMailer;
if (!defined('WY_ROOT')) {
    exit;
}
class Res
{
    static function sendMail($subject, $mailset)
    {
        if (!$subject || !$mailset) {
            return false;
        }
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = "UTF-8";
        $mail->Username = $mailset['smtp_email'];
        $mail->Password = $mailset['smtp_pwd'];
        $mail->Host = $mailset['smtp_server'];
        $mail->IsHTML(true);
        $mail->From = $mailset['smtp_email'];
        $mail->FromName = $mailset['sitename'];
        $mail->Subject = $subject['title'];
        $mail->Body = $subject['content'];
        $mail->AddAddress($subject['email'], $subject['email']);
        $mail->Send();
    }
    static function getHttpStatusCode($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_NOBODY, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_exec($curl);
        $rtn = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $rtn;
    }
    static function exportFile($filename, $content)
    {
        $ua = _S('HTTP_USER_AGENT');
        $ext = substr($filename, -4);
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        header('Pragam:no-cache');
        header('Expires:0');
        header('Content-Type: application/octet-stream');
        if ($ext == '.xls') {
            header("Content-type:application/vnd.ms-excel;charset=utf8");
        }
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
        } else {
            header('Content-Disposition: attachment; filename="' . $filename . '"');
        }
        if ($ext == '.xls') {
            echo $content;
        } else {
            echo mb_convert_encoding($content, 'gbk', 'utf-8');
        }
        exit;
    }
//ip查询
		static function getIPLoc($queryIP){    
		$url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$queryIP;    
		$ch = curl_init($url);     
		curl_setopt($ch,CURLOPT_ENCODING ,'utf8');     
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		$location = curl_exec($ch);    
		$location = json_decode($location);    
		curl_close($ch);         
		$loc = "";   
		if($location===FALSE) return "";     
		if (empty($location->area)) {    
		//$loc = $location->country.' '.$location->province.' '.$location->city.' '.$location->district.' '.$location->isp; 
		//$loc = '女儿国'.' '.'悟空省'.' '.'八戒市'.' '.'沙僧区'.' '.'6.6.6.6';
		$loc = $location->data->country.' '.$location->data->region.' '.$location->data->city.' '.$location->data->county.' '.$location->data->ip;
		}else{       
		  $loc = $location->area;    
		}    
		return $loc;
		}

//juhesms
   static function juhecurl($params=false,$ispost=0){
	$url = 'http://v.juhe.cn/sms/send';
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}

    static function getRandomString($len)
    {
        $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $charsLen = count($chars) - 1;
        shuffle($chars);
        $output = "";
        for ($i = 0; $i < $len; $i++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        $output = substr(md5(md5(uniqid()) . md5(microtime()) . md5($output)), 0, $len);
        return $output;
    }
    static function isMail($email)
    {
        return preg_match('/^([0-9a-zA-Z_-])+@([0-9a-zA-Z_-])+((\\.[0-9a-zA-Z_-]{2,3}){1,2})$/', $email);
    }
    static function subString($strings, $start, $length)
    {
        if (function_exists('mb_substr')) {
            return mb_substr($strings, $start, $length, 'utf8');
        }
        $str = substr($strings, $start, $length);
        $char = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if (ord($str[$i]) >= 128) {
                $char++;
            }
        }
        $str2 = substr($strings, $start, $length + 1);
        $str3 = substr($strings, $start, $length + 2);
        if ($char % 3 == 1) {
            if ($length <= strlen($strings)) {
                $str3 = $str3 .= '...';
            }
            return $str3;
        }
        if ($char % 3 == 2) {
            if ($length <= strlen($strings)) {
                $str2 = $str2 .= '...';
            }
            return $str2;
        }
        if ($char % 3 == 0) {
            if ($length <= strlen($strings)) {
                $str = $str .= '...';
            }
            return $str;
        }
    }
    static function fTime($time, $type = 0)
    {
        if ($type) {
            return strtotime($time);
        }
        return date('Y-m-d H:i:s', $time);
    }
    static function cTime($time)
    {
        $time = is_numeric($time) ? $time : strtotime($time);
        $now = time();
        $result = $now - $time;
        if ($result < 60) {
            return $result . '秒前';
        }
        if ($result / 60 < 60) {
            return intval($result / 60) . '分钟前';
        }
        if ($result / 60 / 60 < 24) {
            return intval($result / 60 / 60) . '小时 ' . ceil(($result / 3600 - intval($result / 60 / 60)) * 60) . '分钟前';
        }
        if ($result / 60 / 60 / 24 < 365) {
            return intval($result / 60 / 60 / 24) . '天前';
        }
        return date('Y-m-d H:i:s', $time);
    }
    static function redirect($url)
    {
        header('location:' . $url);
        exit;
    }
    static function isMobile()
    {
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        if (isset($_SERVER['HTTP_VIA'])) {
        }
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile', 'ios');
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        if (isset($_SERVER['HTTP_ACCEPT'])) {
            if (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))) {
                return true;
            }
        }
        return false;
    }
    static function getOrderID()
    {
        return date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(10000, 99999);  //平台ID
    }
    static function replaceMailTpl($mailtpl, $data = array())
    {
        if (!$mailtpl) {
            return false;
        }
        if ($data) {
            foreach ($data as $key => $val) {
                $title = str_replace('{' . $key . '}', $val, isset($title) ? $title : $mailtpl['title']);
                $content = str_replace('{' . $key . '}', $val, isset($content) ? $content : $mailtpl['content']);
            }
            return array('title' => $title, 'content' => $content);
        }
        return $mailtpl;
    }
}
?>