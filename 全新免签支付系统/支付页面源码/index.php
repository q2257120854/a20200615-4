<?php
	error_reporting(0);
	require_once('edlm.php');//载入运行所需类
	date_default_timezone_set('PRC');//设置时区
	session_start();//使用session
	//删除订单
	function ddh($appid,$dh,$type){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://支付地址/?appid=".$appid."&ddh=".$dh."&type=".$type);
 		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$output = curl_exec($ch);
		curl_close($ch);
        return $output;
	}
	//新增参数
	if(!empty($_GET['gu'])){
		$gu = $_GET['gu'];
	}else{
		$gu = "";
	}
	//判断是否为 or $_GET['type']=="tenpay"
	if($_GET['type']=="tenpay"){
		$_GET['type']="qqpay";
	}
	//结束
	//判断传入的信息
	if(isset($_GET['appid']) and strlen($_GET['appid'])==32){
		$appid = $_GET['appid'];
	}else{
		exit ('Pays:APPID Error');
	}
	if(!empty($_GET['ddh']) and !empty($_GET['type'])){
		if($_GET['type']=="alipay"){
			$row = adpost($appid,$_GET['ddh']);
			$row = json_decode($row);
			if($row){
				if($row->{'error'}==0){
					unset($_SESSION['dh']);
					if($_GET['rurl']!=''){
						exit('<script language="javascript">alert("取消付款成功");location.href="'.$_GET['rurl'].'";</script>');
					}
					exit('<script language="javascript">alert("取消付款成功");history.go(-2);</script>');
				}else{
					exit('<script language="javascript">alert("'.$row->{'msg'}.'");history.go(-2);</script>');
				}
			}else{
				exit('Pays:连接服务器失败,请检查网络');
			}
		}else if($_GET['type']=="wxpay"){
			$row = wdpost($appid,$_GET['ddh']);
			$row = json_decode($row);
			if($row){
				if($row->{'error'}==0){
					unset($_SESSION['dh']);
					if($_GET['rurl']!=''){
						exit('<script language="javascript">alert("取消付款成功");location.href="'.$_GET['rurl'].'";</script>');
					}
					exit('<script language="javascript">alert("取消付款成功");history.go(-2);</script>');
				}else{
					exit('<script language="javascript">alert("'.$row->{'msg'}.'");history.go(-2);</script>');
				}
			}else{
				exit('Pays:连接服务器失败,请检查网络');
			}
		}else if($_GET['type']=="qqpay"){
			$row = qdpost($appid,$_GET['ddh']);
			$row = json_decode($row);
			if($row){
				if($row->{'error'}==0){
					unset($_SESSION['dh']);
					if($_GET['rurl']!=''){
						exit('<script language="javascript">alert("取消付款成功");location.href="'.$_GET['rurl'].'";</script>');
					}
					exit('<script language="javascript">alert("取消付款成功");history.go(-2);</script>');
				}else{
					exit('<script language="javascript">alert("'.$row->{'msg'}.'");history.go(-2);</script>');
				}
			}else{
				exit('Pays:连接服务器失败,请检查网络');
			}
		}else{
			exit('Pays:暂时不支持此类型付款,请勿非法操作');
		}
	}
	if(!empty($_GET['rurl'])){
		$rurl = base64_decode($_GET['rurl']);
	}else{
		exit ('Pays:Return Url Error');
	}
	if(!empty($_SESSION['dh'])){
		$dh = rc4(md5('maddog'),$_SESSION['dh']);
		if($_GET['type']=='alipay'){
			$row = acpost($appid,$dh);
			$row = json_decode($row);
			$md5 = md5($dh.'maddog'.$appid);
			if($row){
				if($row->{'error'}==0){
					$type = '支付宝';
					$income = $row->{'income'};
					$url = $row->{'url'};
					$tc = $row->{'time'};
					if($row->{'token'}!=$md5){
						echo '<script language="javascript">alert("检测到当前环境不安全,请检查DNS或网络环境是否被修改后重新刷新付款页面!");</script>';
						unset($_SESSION['dh']);
						exit;
					}
					if($income!=$_GET['income']){
						ddh($appid,$dh,$_GET['type']);
						exit('<script language="javascript">location.replace(location.href);</script>');
					}
				}else{
					unset($_SESSION['dh']);
				}
			}else{
				unset($_SESSION['dh']);
			}
		}else if($_GET['type']=='wxpay'){
			$row = wcpost($appid,$dh);
			$row = json_decode($row);
			$md5 = md5($dh.'maddog'.$appid);
			if($row){
				if($row->{'error'}==0){
					$type = '微信';
					$income = $row->{'income'};
					$url = $row->{'url'};
					$tc = $row->{'time'};
					if($row->{'token'}!=$md5){
						echo '<script language="javascript">alert("检测到当前环境不安全,请检查DNS或网络环境是否被修改后重新刷新付款页面!");</script>';
						unset($_SESSION['dh']);
						exit;
					}
					if($income!=$_GET['income']){
						ddh($appid,$dh,$_GET['type']);
						exit('<script language="javascript">location.replace(location.href);</script>');
					}
				}else{
					unset($_SESSION['dh']);
				}
			}else{
				unset($_SESSION['dh']);
			}
		}else if($_GET['type']=='qqpay'){
			$row = qcpost($appid,$dh);
			$row = json_decode($row);
			$md5 = md5($dh.'maddog'.$appid);
			if($row){
				if($row->{'error'}==0){
					$type = 'QQ';
					$income = $row->{'income'};
					$url = $row->{'url'};
					$tc = $row->{'time'};
					if($row->{'token'}!=$md5){
						echo '<script language="javascript">alert("检测到当前环境不安全,请检查DNS或网络环境是否被修改后重新刷新付款页面!");</script>';
						unset($_SESSION['dh']);
						exit;
					}
					if($income!=$_GET['income']){
						ddh($appid,$dh,$_GET['type']);
						exit('<script language="javascript">location.replace(location.href);</script>');
					}
				}else{
					unset($_SESSION['dh']);
				}
			}else{
				unset($_SESSION['dh']);
			}
		}else{
			exit('Pays:暂时不支持此类型付款,请勿非法操作');
		}
	}
	if(!empty($_SESSION['dh'])){}else{
		if(!empty($_GET['income'])){
				if(isset($_GET['type'])){
					$income = str_replace(",","",number_format($_GET['income'],2));
					if(!empty($_GET['orderid']) and strlen($_GET['orderid'])>=18 and strlen($_GET['orderid'])<50){
						$dh = $_GET['orderid'];
					}else{
						$dh = dh();
					}
					if($_GET['type']=='alipay'){
						$type = '支付宝';
						$row = apost($_GET['appid'],$dh,$income,$gu);
						$row = json_decode($row);
						if($row){
							if($row->{'error'}==0){
								$md5 = md5($dh.'maddog'.$appid);
								$income = $row->{'income'};
								$url = $row->{'url'};
								$tc = $row->{'time'};
								$_SESSION['dh'] = rc4(md5('maddog'),$dh);;
							}else{
								exit('<script language="javascript">alert("'.$row->{'msg'}.'");history.go(-1);</script>');
							}
							if($row->{'token'}!=$md5){
								echo '<script language="javascript">alert("检测到当前环境不安全,请检查DNS或网络环境是否被修改后重新刷新付款页面!");</script>';
								unset($_SESSION['dh']);
								exit;
							}
						}else{
							exit('Pays:连接服务器失败,请检查网络');
						}
					}else if($_GET['type']=='wxpay'){
						$type = '微信';
						$row = wpost($_GET['appid'],$dh,$income,$gu);
						$row = json_decode($row);
						if($row){
							if($row->{'error'}==0){
								$md5 = md5($dh.'maddog'.$appid);
								$income = $row->{'income'};
								$url = $row->{'url'};
								$tc = $row->{'time'};
								$_SESSION['dh'] = rc4(md5('maddog'),$dh);;
							}else{
								exit('<script language="javascript">alert("'.$row->{'msg'}.'");history.go(-1);</script>');
							}
							if($row->{'token'}!=$md5){
								echo '<script language="javascript">alert("检测到当前环境不安全,请检查DNS或网络环境是否被修改后重新刷新付款页面!");</script>';
								unset($_SESSION['dh']);
								exit;
							}
						}else{
							exit('Pays:连接服务器失败,请检查网络');
						}
					}else if($_GET['type']=='qqpay'){
						$type = 'QQ';
						$row = qpost($_GET['appid'],$dh,$income,$gu);
						$row = json_decode($row);
						if($row){
							if($row->{'error'}==0){
								$md5 = md5($dh.'maddog'.$appid);
								$income = $row->{'income'};
								$url = $row->{'url'};
								$tc = $row->{'time'};
								$_SESSION['dh'] = rc4(md5('maddog'),$dh);;
							}else{
								exit('<script language="javascript">alert("'.$row->{'msg'}.'");history.go(-1);</script>');
							}
							if($row->{'token'}!=$md5){
								echo '<script language="javascript">alert("检测到当前环境不安全,请检查DNS或网络环境是否被修改后重新刷新付款页面!");</script>';
								unset($_SESSION['dh']);
								exit;
							}
						}else{
							exit('Pays:连接服务器失败,请检查网络');
						}
					}else{
						exit('Pays:暂时不支持此类型付款,请勿非法操作');
					}
				}else{
					exit ('Pays:Type Error');
				}
		}else{
			exit ('Pays:Income Error');
		}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php if($type)echo $type; ?>扫码支付 - Pays</title>
	<script type="text/javascript" src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
	<script src="qrcode.min.js"></script>
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
	<link rel="icon" sizes="196x196" href="favicon.ico">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon.ico">
	<link href="LPays.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
</head>
<body>
	<div class="pop-up">
		<div class="content">
			<div class="container">
				<a class="close" href="./?appid=<?php if($appid)echo $appid; ?>&ddh=<?php if($dh)echo $dh; ?>&type=<?php if($_GET['type'])echo $_GET['type']; ?>&rurl=<?php echo $_SERVER['HTTP_REFERER']; ?>">返回(取消付款)</a>
				<div class="dots">
					<div class="dot"></div>
					<div class="dot"></div>
					<div class="dot"></div>
				</div>
				<div class="title">
					<h1>￥<?php if($income)echo $income; ?></h1>
					<span style="margin-left: 18px;text-shadow:1px 1px 2px #000;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;">请支付上方显示的金额,否则支付无效!<br></span>
					<div style="position:relative;z-index:8888;" class="lpimg" id="qrcode"></div>
					<div class="subscribe">
						<h1>请使用<?php if($type)echo $type; ?>扫码完成付款<br><br><a style="font-size: 1.2rem;position:relative;z-index:10;" onclick="copys();">支付号:<?php if($dh)echo $dh; ?></a></h1>
					</div>
				</div>
				<div class="button">
					<button id="time"><span>请在<strong id="m">2</strong>分<strong id="s">59</strong>秒内完成付款</span></button>
				</div>
				<div style="display:none;" id="app"></div>
				<p>Pays</p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var m = <?php if($income)echo (double)$income; ?>;
		var om = <?php if(isset($_GET['income']) and $_GET['income']>0)echo (double)$_GET['income']; ?>;
		if(m>om){
			alert("注意:由于当前付款人数过多,付款金额存在变动,请支付“"+m+"”元,否则支付无效！");
		}
		new QRCode(document.getElementById("qrcode"), "<?php if($url)echo $url; ?>");
		//设置过期时间
	    var str="<?php if($tc)$tc = $tc - 3; echo date('Y/m/d H:i:s',$tc); ?>";
	    var endDate = new Date(str); 
	    var end = endDate.getTime(); 
		var appid = '<?php if($appid)echo $appid; ?>';//id
		var dh = '<?php if($dh)echo $dh; ?>';//订单号
		var type = '<?php if($_GET['type'])echo $_GET['type']; ?>';//支付类型
		var returnurl = '<?php 
							if($rurl){
								if(strstr($rurl, '?')){
									echo $rurl."&dh='+dh+'&ltype='+type";
								}else{
									echo $rurl."?dh='+dh+'&ltype='+type";
								}
							}
						?>;//指定支付成功后跳转到此地址

		var ua = navigator.userAgent;
		var ipad = ua.match(/(iPad).*OS\s([\d_]+)/),
		isIphone =!ipad && ua.match(/(iPhone\sOS)\s([\d_]+)/),
		isAndroid = ua.match(/(Android)\s+([\d.]+)/),
		isMobile = isIphone || isAndroid;
		//判断
		if(isMobile){
			//激活APP
			if(type=="alipay"){
				setTimeout(function (){
					document.getElementById('app').innerHTML='<iframe src="<?php if($url)echo $url; ?>"></iframe>';
                }, 1000);
			}
		}
	</script>
	<script type="text/javascript" src="LPays.js"></script>
</body>
</html>