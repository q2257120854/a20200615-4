<?php
	function rc4 ($pwd, $data) {
	    $key = [];
	    $box = []; 
	    $pwd_length = strlen($pwd);
	    $data_length = strlen($data);  
	    for ($i = 0; $i < 256; $i++) {
	    	$key[$i] = ord($pwd[$i % $pwd_length]);
	    	$box[$i] = $i;
	    }  
	    for ($j = $i = 0; $i < 256; $i++) {
	    	$j = ($j + $box[$i] + $key[$i]) % 256;
	    	$tmp = $box[$i];
	    	$box[$i] = $box[$j];
	    	$box[$j] = $tmp;
	    }  
	    for ($a = $j = $i = 0; $i < $data_length; $i++) {
	    	$a = ($a + 1) % 256;
	    	$j = ($j + $box[$a]) % 256;  
	    	$tmp = $box[$a];
	    	$box[$a] = $box[$j];
	    	$box[$j] = $tmp;  
	    	$k = $box[(($box[$a] + $box[$j]) %256)];
	    	@$cipher .= chr(ord($data[$i]) ^ $k);  
	    }  
	    return $cipher;  
	}
	function dh(){
		$md5="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
		str_shuffle($md5);
	    $dhs = substr(str_shuffle($md5),26,8).time();
	    return $dhs;
	}
	//支付宝
	function apost($appid,$dh,$income,$gu){
		$post_data = array('dh' => $dh,'income' => $income,'token' => md5($dh.$appid),'md5' => '','gu' => $gu);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/apost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function acpost($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid),'md5' => '');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/acpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function adpost($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/adpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function acc($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/acc/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	//微信
	function wpost($appid,$dh,$income,$gu){
		$post_data = array('dh' => $dh,'income' => $income,'token' => md5($dh.$appid),'md5' => '','gu' => $gu);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/wpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function wcpost($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid),'md5' => '');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/wcpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function wdpost($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/wdpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function wcc($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/wcc/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	//QQ
	function qpost($appid,$dh,$income,$gu){
		$post_data = array('dh' => $dh,'income' => $income,'token' => md5($dh.$appid),'md5' => '','gu' => $gu);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/qpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function qcpost($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid),'md5' => '');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/qcpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function qdpost($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/qdpost/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	function qcc($appid,$dh){
		$post_data = array('dh' => $dh,'token' => md5($dh.$appid));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api地址/lps/qcc/'.$appid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}