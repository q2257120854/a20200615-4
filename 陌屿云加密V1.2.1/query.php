<?php
include("./includes/common.php");
define("VERSION",$conf['version']);//最新版本号
if(!$_GET['data'])exit();
$data=base64_decode($_GET['data']);
$time_data=json_decode($data,true);
$datetime1 = new DateTime(date("Y-m-d H:i:s"));
$datetime2 = new DateTime($time_data['time']);
$interval = $datetime1->diff($datetime2);
if($interval->format('%R%a')!=0){
 exit();
}
$json=json_decode(des_dejson($data),true);
if(!is_array($json) && ($json["host"]=='localhost' || $json["host"]=='127.0.0.1'))exit();
if($json["ver"]) {
	$param=base64_encode(authcode($json["ver"]."\t".$json["host"]."\t".$json["auth"]."\t".(time()+600),'ENCODE','auths!!'));
	$download=$siteurl.'download.php?update=true&param='.$param.'&rand='.rand(100000,999999);
	if($conf['update']==1) {
		if($json["ver"]>=VERSION) {
			$code=0;
			$msg='<font color="green">您使用的已是最新版本！</font><br/>当前版本：'.$conf['ver'].' (Build '.VERSION.')';
		} else {
			$code=1;
			$msg='<font color="red">发现新版本！</font> 最新版本：'.$conf['ver'].' (Build '.VERSION.')';
		}
	} else {
		$code=0;
		$msg='<font color="blue">更新服务器正在维护，请稍后访问！</font>';
	}
}
if($json["host"]&&$json["auth"]&&checkauth($json["host"],$json["auth"])) {
	if($json["ver"])
		$result=array('code'=>$code,'msg'=>$msg,'ver'=>$conf['ver'],'version'=>VERSION,'uplog'=>$conf['uplog'],'file'=>$download);
	else
		$result=array('code'=>'1','authcode'=>$json["auth"]);
} else {
	$result=array('code'=>'-1','msg'=>$conf['content']);
}
if($conf['switch']==0 && !$json["ver"])$result=array('code'=>'1','authcode'=>$json["auth"]);
echo des_enjson(json_encode($result));
$DB->close();
?>