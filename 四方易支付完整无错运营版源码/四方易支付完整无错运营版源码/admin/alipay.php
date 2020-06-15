<?php
/**
 * 转账到指定支付宝
**/
include("../includes/common.php");
$title='转账到指定支付宝';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './nav.php';
require_once SYSTEM_ROOT."f2fpay/lib/AopClient.php";
require_once SYSTEM_ROOT."f2fpay/model/request/AlipayFundTransToaccountTransferRequest.php";
?>
  
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
if(isset($_GET['reset'])){
	$batch=$_GET['batch'];
	unset($_SESSION['privatekey']);
	exit("<script language='javascript'>window.location.href='./alipay.php';</script>");
}elseif(isset($_POST['privatekey'])){
	if(strlen($_POST['privatekey'])<100)exit("<script language='javascript'>alert('商户私钥不正确');history.go(-1);</script>");
	$_SESSION['privatekey']=$_POST['privatekey'];
	exit("<script language='javascript'>window.location.href='./alipay.php';</script>");
}elseif(isset($_SESSION['privatekey'])){

if(isset($_POST['submit'])){
	$out_biz_no = $_POST['out_biz_no'];
	$payee_account = $_POST['payee_account'];
	$payee_real_name = $_POST['payee_real_name'];
	$value = $_POST['value'];
	
$BizContent = array(
	'out_biz_no' => $out_biz_no, //商户转账唯一订单号
	'payee_type' => 'ALIPAY_LOGONID', //收款方账户类型
	'payee_account' => $payee_account, //收款方账户
	'amount' => $value, //转账金额
	'payer_show_name' => $conf['payer_show_name'], //付款方显示姓名
	'payee_real_name' => $payee_real_name, //收款方真实姓名
);

$aop = new AopClient ();
$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
$aop->appId = $conf['alipay_appid'];
$aop->rsaPrivateKey = $_SESSION['privatekey'];
$aop->alipayrsaPublicKey='MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhdOanY+eK/HuQy0roGgGbT6QRAkDwBlXgkyZe1gM/pGkHDTwyoqlsAdA0MomAhm95so0qUVIEA/FaGTzF4TGP9NeN/BmNro/HPWU+BHIaZBfyL7N6R/AP6S+G1R7X1PYgjQ56WNwpf0JeGAkb8KXLEW9bYIDpsMQYpZXbiPE2jVep0Xtr3yY9WMq4LkDG2TgwWdyL43Jj94fUa1HGfWJeM8mhmMlLUqx6ePlUZbc/t0wZo7BvBJrlxU8vsDCSY4eokyUkJG1JXf8MoSNakUKYhClm2ACtoRdwdpZAnTOpNs/RoLsd0doLRGXOCoFBN1naDLfwtkcCx8ovdF+CG3kfQIDAQAB';
$aop->apiVersion = '1.0';
$aop->signType = 'RSA2';
$aop->postCharset='UTF-8';
$aop->format='json';
$request = new AlipayFundTransToaccountTransferRequest ();
$request->setBizContent(json_encode($BizContent));
$result = $aop->execute ( $request); 

$data = array();
$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
$resultCode = $result->$responseNode->code;
if(!empty($resultCode)&&$resultCode == 10000){
$result='支付宝转账单据号:'.$result->$responseNode->order_id.' 支付时间:'.$result->$responseNode->pay_date;
} elseif($resultCode == 40004) {
$result='失败 ['.$result->$responseNode->sub_code.']'.$result->$responseNode->sub_msg;
$DB->exec("update `pay_settle` set `transfer_status`='2',`transfer_result`='".$data['result']."' where `id`='$id'");} elseif(!empty($resultCode)){
$result='['.$result->$responseNode->sub_code.']'.$result->$responseNode->sub_msg;
} else {
$result='未知错误';
}

	showmsg($result,1);
	exit;
}
$out_biz_no = date("YmdHis").rand(11111,99999);
?>

	 <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">转账到指定支付宝</h3></div>
        <div class="panel-body">
          <form action="?" method="POST" role="form">
		    <div class="form-group">
				<div class="input-group"><div class="input-group-addon">交易号</div>
				<input type="text" name="out_biz_no" value="<?php echo $out_biz_no?>" class="form-control" required/>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">支付宝账号</div>
				<input type="text" name="payee_account" value="" class="form-control" required/>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">支付宝姓名</div>
				<input type="text" name="payee_real_name" value="" class="form-control" required/>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">转账金额</div>
				<input type="text" name="value" value="" class="form-control" placeholder="RMB/元" required/>
			</div></div>
            <p><input type="submit" name="submit" value="立即转账" class="btn btn-default form-control"/></p>
          </form>
        </div>
		<div class="panel-footer">
          <span class="glyphicon glyphicon-info-sign"></span> 交易号可以防止重复转账，同一个交易号只能提交同一次转账。
        </div>
      </div>
<?php }else{
?>
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">转账到支付宝</h3></div>
          <div class="panel-body box">
			<form action="alipay.php" method="post">
			<div class="form-group">
			<label>商户私钥：</label><br>
			<textarea class="form-control" name="privatekey" rows="4" placeholder="填写商户私钥" required></textarea>
			</div>
			<div class="form-group text-right">
			<button type="submit" class="btn btn-default form-control" id="save">保存</button>
			</div>
			</form>
		</div>
      </div>
<?php }?>
    </div>
  </div>