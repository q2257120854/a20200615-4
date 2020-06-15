<?php
/**
 * @desc：SG11云加密内裤
 * @author [MoLeft] <[<moshixiaoli@qq.com>]>
 */
class SG11{
    private $user;
    private $pass;
    
    public function __construct($user,$pass){
        $this->user=$user;
        $this->pass=$pass;
    }
    
    public function encode($input,$output,$comment,$ver){
    	if(!is_file($input)){
    		return '$input不是一个有效的文件';
    	}
    	$post_data = array(
    		"user" => $this->user,
    		"pass" => $this->pass,
    		"comment" => $comment,
    		"ver" => json_encode($ver),
			"file" => new CURLFile($input)
		);	
    	$result=json_decode($this->post_data('http://sg11.moleft.cn/api.php',$post_data),true);
    	if($result['code']<0){
    		return $result;
    	}else{
    		file_put_contents($output,$this->post_data($result['down']));
    		//unset($result['down']);
    		return $result;
    	}
    }
    
	/**
	 * post提交函数
	*/
	private function post_data($url, $post=0, $referer=0, $cookie=0, $header=0, $ua=0, $nobaody=0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$httpheader[] = "Accept:*/*";
		$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
		$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
		$httpheader[] = "Connection:close";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
		if ($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		if ($header) {
			curl_setopt($ch, CURLOPT_HEADER, true);
		}
		if ($cookie) {
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
		if($referer){
			if($referer==1){
				curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
			}else{
				curl_setopt($ch, CURLOPT_REFERER, $referer);
			}
		}
		if ($ua) {
			curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		}
		else {
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0");
		}
		if ($nobaody) {
			curl_setopt($ch, CURLOPT_NOBODY, 1);
		}
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}
}