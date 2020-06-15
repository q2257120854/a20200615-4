<?php
/* 一键获取创梦系列社区所有商品API-创梦
*POWER BY 创梦
*QQ：3337315561
*TIME：2019年1月31日
*放到代刷网根目录就可以用了
*/
include './function.php';header("Content-type:text/html;charset=utf-8");//字符编码设置  
$shequ_url = daddslashes($_GET['url']);
$z = daddslashes($_GET['z']);
$m = daddslashes($_GET['m']);
$yk = daddslashes($_GET['yk']);
echo '<title>获取页面</title>';
$url = "http://{$shequ_url}/api/shoplist.php";
		$ret = get_curl($url);
		if (!$ret = json_decode($ret, true)) {
			die('打开对接网站失败');
		} elseif ($ret['status'] != 1) {
			exit ('炸了');
		} else {
			foreach ($ret['goods_rows'] as $v) {
				$u="http://".$shequ_url."/api.php";
				$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]";
				$xy=json_decode(get_curl("http://{$shequ_url}/api/spl.php?xid=".$v['xid']), true);
				if($xy['k1']!=NULL){
					$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]&".$xy['k1']."=[input]";}
					if($xy['k2']!=NULL){
						$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]&".$xy['k1']."=[input]&".$xy['k2']."=[input2]";}
						if($xy['k3']!=NULL){
						$p="sid=".$v['ID']."&user=".$z."&pwd=".$m."&num=[num]&".$xy['k1']."=[input]&".$xy['k2']."=[input2]&".$xy['k3']."=[input3]";}
				echo "<div id='url'>".$u."</div><input type='button' onClick='url()' value='点击复制".$v['name']."的URL' /><div id='post'>".$p."</div><input type='button' onClick='post()' value='点击复制POST' /><br/><hr/>";
		}
		}
		echo '<script type="text/javascript">
		function url()
    {
        var Url2=document.getElementById("url").innerText;
        var oInput = document.createElement("input");
        oInput.value = Url2;
        document.body.appendChild(oInput);
        oInput.select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        oInput.className = "oInput";
        oInput.style.display="none";
        alert("复制成功");
    }
</script>
function post()
    {
        var Url2=document.getElementById("post").innerText;
        var oInput = document.createElement("input");
        oInput.value = Url2;
        document.body.appendChild(oInput);
        oInput.select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        oInput.className = "oInput";
        oInput.style.display="none";
        alert("复制成功");
    }
</script>';