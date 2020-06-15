<?php
use xh\library\functions;
use xh\library\url;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>接口调用</title>
</head>
<body>
<form action="<?php echo url::s('gateway/index/checkpoint');?>" method="post" id="frmSubmit">
    <?php $out_trade_no = date("YmdHis") . mt_rand(10000,99999);?>
    <input type="hidden" name="account_id" value="<?php echo $_SESSION['MEMBER']['uid'];?>" />
	<input type="hidden" name="content_type" value="text"/>
	<input type="hidden" name="thoroughfare" value="service_auto"/>
	<input type="hidden" name="out_trade_no" value="<?php echo $out_trade_no;?>"/>
	<input type="hidden" name="sign" value="<?php echo functions::sign($_SESSION['MEMBER']['key_id'], ['amount'=>floatval($_GET['amount']),'out_trade_no'=>$out_trade_no]);?>"/>
	<input type="hidden" name="robin" value="2" />
	<input type="hidden" name="callback_url" value="<?php echo $_GET['callback_url'];?>" />
	<input type="hidden" name="success_url" value="<?php echo url::s('index/service/order');?>" />
	<input type="hidden" name="error_url" value="<?php echo url::s('index/service/order');?>" />
	<input type="hidden" name="amount" value="<?php echo floatval($_GET['amount']);?>" />
	<input type="hidden" name="type" value="<?php echo $_GET['type'];?>" />
</form>
<script type="text/javascript">
document.getElementById("frmSubmit").submit();
</script>
</body>
</html>