<?php require_once 'header.php' ?>
<header class="aui-bar aui-bar-nav baiset" align="center">
   向商户付款
</header>
<div id="qrcode" style="margin-left:auto; margin-right:auto; margin-top:20px; width:90%;" align="center">
	<img src="/static/common/shtb.png"/><span style="color:#838383;">虎付实体用户</span><?php echo $payzh['realname'];?><br>
<style>
	input[type="text"]{
		border:1px solid #ccc;
		background:#fff;
		width:90%;
		margin-left:5%;
	}
	 html,body,div,p,span,ul,dl,ol,h1,h2,h3,h4,h5,h6,table,td,tr{padding:0;margin:0}
    .content{width:400px;margin:100px auto;border:1px solid #ddd}
    h1{margin-bottom:30px;background-color:#eee;;border-bottom:1px solid #ddd;padding:10px;text-align: center}
    table{border-collapse:collapse;width:90%;margin:20px auto}
    table tr td{height:40px;font-size:14px}
    input,select{width:100%;line-height:25px}
    button{font-size:16px}
	.btn{
		width:90%;
		margin-left:5%;
		margin-right:auto;
		color:#fff;
		font-size:20px;
		height:40px;
		line-height:40px;
		background:#A3DEA3;
		border:1px solid #ccc;
		padding:0px;
		border-radius:5px;
	}
</style>
<form action="/personpay/payMobile.php" method="post">
    <input type="hidden" name="userid" value="<?php echo $userpay['id'];?>">
    <input type="hidden" name="userkey" value="<?php echo $userpay['apikey'];?>">
    <br/><br/>
   <div><input type="text" name="money" placeholder="请输入金额"></div>
   <br/>
   <br/>
   <div style="width:100%; height:20xp;"></div>
   <div><button type="submit" class="btn">确定支付</button></div>
</form>
</div>
<div>

</div>