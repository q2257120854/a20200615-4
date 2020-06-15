<?php
	require_once('edlm.php');//载入运行所需类
	if(isset($_GET['appid']) and strlen($_GET['appid'])==32){
		$appid = $_GET['appid'];
	}else{
		exit ('L Pays:APPID Error');
	}
	if(isset($_GET['dh']) and $_GET['dh']){
		if(isset($_GET['type']) and $_GET['type']=='alipay'){
			$row = acc($appid,$_GET['dh']);
			exit($row);
		}else if(isset($_GET['type']) and $_GET['type']=='wxpay'){
			$row = wcc($appid,$_GET['dh']);
			exit($row);
		}else if(isset($_GET['type']) and $_GET['type']=='qqpay'){
			$row = qcc($appid,$_GET['dh']);
			exit($row);
		}else{
			$error = array('error' => '2','msg' => 'Type错误');
			exit(json_encode($error));
		}
	}else{
		$error = array('error' => '1','msg' => '参数不完整');
		exit(json_encode($error));
	}
?>