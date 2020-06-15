<?php
/* 一键获取亿卡系列社区所有商品API-咸鱼
*POWER BY 咸鱼
*QQ：120182408
*TIME：2018年9月15日
*放到代刷网根目录就可以用了
*/
include './function.php';header("Content-type:text/html;charset=utf-8");//字符编码设置  
$shequ_url = daddslashes($_GET['url']);
$z = daddslashes($_GET['z']);
$m = daddslashes($_GET['m']);
$yk = daddslashes($_GET['yk']);
echo '<title>最多只能获取有三个参数的哦</title>';
if($yk=='c'){
$url = "http://{$shequ_url}/api/shoplist.php";
		$ret = get_curl($url);
		if (!$ret = json_decode($ret, true)) {
			return '打开对接网站失败';
		} elseif ($ret['status'] != 1) {
			exit ('炸了');
		} else {
			$list = array();
			foreach ($ret['goods_rows'] as $v) {
				$param = '';
				$paramname = '';
				$i='';
				$u="http://".$shequ_url."/api.php";
				$p="act=add&sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]";
				$xy=json_decode(get_curl("http://{$shequ_url}/api/spl.php?xid=".$v['xid']), true);
				if($xy['k1']!=NULL){
					$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]&".$xy['k1']."=[value]";}
					if($xy['k2']!=NULL){
						$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]&".$xy['k1']."=[value]&".$xy['k2']."=[value2]";}
						if($xy['k3']!=NULL){
						$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]&".$xy['k1']."=[value]&".$xy['k2']."=[value2]&".$xy['k3']."=[value3]";}
				//echo $v['name']."的URL是".$u."<br/>POST是".$p."<br/><a href='".$u."?".$p."'>点我访问测试</a><br/><hr/>";
		}
				}
				}
//下面与saf无缘，重新写。。
$url = "http://{$shequ_url}/api/getGoodsList.php";
		$ret = get_curl($url);
		if (!$ret = json_decode($ret, true)) {
			return '打开对接网站失败';
		} elseif ($ret['code'] !== 0) {
			return $ret['message'];
		} else {
			$list = array();
			foreach ($ret['list'] as $v) {
				$param = '';
				$paramname = '';
				$i='';
				foreach ($v['post'] as $item) {
					$param .= $item['param'] . '|';
					$p .= '&' . $item['param'] . '=[value' . $i . ']';
					#$a='$p'.$i;
					$a .= '&' . $item['param'] . '=[value' . $i . ']';
					$paramname .= $item['name'] . '|';
					$i=$i+1;
		#if($a="&password=[value1]"){$a="&qq=[value]&password=[value1]";}
					#$nr=$v['name']."的链接是 http://".$shequ_url."/api/index.php?act=add&sid=".$v['goodsid']."&user=".$z."&password=".$m."&num=[num]".$a."<br/><hr/>";
					#$nr=trim($nr,$nr);echo $nr;
				}
				$param = trim($param, '|');
			$b=substr($param,strripos($param,'|')+1);		//如果qq|ssid，就是ssid
				if(substr_count($param,'|')==2){
$a=trim($param,'|'.$b);	//qq|ssid|pln，	
			$c=$b;	$b=substr($a,strripos($a,'|')+1);
			$a=trim($a,'|'.$b);
			$b=trim($param,$a.$c);
$c="&".$c."=[value3]";
			}elseif(substr_count($param,'|')==1){
$a=trim($param,'|'.$b);
$c='';
}else{$a=trim($param,'|');$c='';
}
		if($yk=='a'){echo $v['name']."的URL是 http://".$shequ_url."/api.php
		<br/>POST是goodsid=".$v['goodsid']."api_user=".$z."&api_pwd=".md5($m)."&num=[num]&".$a."=[value]";}elseif($yk=='b'){echo $v['name']."的URL是 http://".$shequ_url."/api/index.php
		<br/>POST是act=add&sid=".$v['goodsid']."&user=".$z."&password=".$m."&num=[num]&".$a."=[value]";}
		if(substr_count($param,'|')==1){$b=substr($param,strripos($param,'|')+1);
		echo "&".$b."=[value2]";}elseif(substr_count($param,'|')==2){
		$b=trim($b,'|');$b=trim($b,'|');
		echo "&".$b."=[value2]";}
		if($c!="&=[value3]")echo $c;
		echo "<br/><hr/>";
			}
		}

?>