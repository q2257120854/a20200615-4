<?php
$url = "http://" . $duijieurl . "/index.php?m=home&c=order&a=add";
$data = "Api_UserName=" . urlencode($loginname) . "&Api_UserMd5Pass=" . md5($loginpassword) . "&goods_id=" . $s_duijiesid . "&goods_type=" . $s_duijiesqlx . "&need_num_0=" . $_REQUEST['num'] .  "&pay_type=1";
$arr = array($canshu1=>$_REQUEST[$key1],$canshu2=>$_REQUEST[$key2],$canshu3=>$_REQUEST[$key3],$canshu4=>$_REQUEST[$key4]);  //定义参数  
	if (is_array($arr) && $arr) {
		foreach ($arr as $_var_9 => $_var_10) {
			$data = $data . ("&" . $_var_9 . "=" . urlencode($_var_10));
		}
	}
	$qingqiu = jiuwu_get_curl($url, $data);
	if($query = json_decode($qingqiu, true)){
	if (isset($query["order_id"])) {
		$_var_6 = array("code" => 0, "message" => "success", "id" => $query["order_id"]);
		$duijiefanhuizt= $query['info'] ;
   			$s_duijiedingdan= $query['order_id'] ;$duijiefanhuizt = $query["info"];
   			$after_use_rmb= $query['after_use_rmb'] ;
   			$after_use_cardnum= $query['after_use_cardnum'] ;
	} else {
		if (isset($query["info"])) {
			$duijiefanhuizt = $query["info"];
		} else {
			if (preg_match("/<p\\sclass=\"error\">(.*?)<\\/p>/", $qingqiu, $_var_12)) {
				$duijiefanhuizt = $_var_12[1];
			} else {
				$duijiefanhuizt = $data;
			}
		}
	}  
	}    
  ?>