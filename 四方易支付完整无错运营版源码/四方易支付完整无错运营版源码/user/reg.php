<?php
$is_defend=true;
include("../includes/common.php");
if($conf['is_reg']==0)sysmsg('未开放商户申请');
$tid = $_GET['id'];
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>申请商户 | <?php echo $conf['web_name']?></title>
    <!-- Favicon-->
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
	<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
</head>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank"><?php echo $conf['web_name']?></a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-white btn-round" href="login.php">登入</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url(assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                
                    <div class="header">
                        <h5>Sign Up</h5>
                        <span>Register a new membership</span>
                        <form name="form" class="form-validation">
                        <?php if($conf['is_payreg']){?><p>申请费用：<b><?php echo $conf['reg_price']?></b>$</p><?php }?>
                    </div>

                    <div class="content">  
                        <div class="btn-group bootstrap-select form-control show-tick col-sm-12">
                        	<div class="dropdown-menu" role="combobox" style="max-height: 247px; overflow: hidden; min-height: 0px;"></div>
                        	<select class="form-control show-tick" tabindex="-98" name="type" >
                                    <?php if($conf['stype_1']){?><option value="1"><trans>支付宝结算</trans></option>
                                    <?php }if($conf['stype_2']){?><option value="2"><trans>微信结算</trans></option>
                                    <?php }if($conf['stype_3']){?><option value="3"><trans>QQ钱包结算</trans></option>
                                    <?php }if($conf['stype_4']){?><option value="4"><trans>银行卡结算</trans></option>
                                <?php }?></select>
                            </div>
                        <div class="input-group">
                            <input type="text" name="account" placeholder="结算账号" class="form-control" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="username" placeholder="真实姓名" class="form-control" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="url" placeholder="你的网站域名" class="form-control" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="email" name="email" placeholder="邮箱（用于接收商户信息）" class="form-control" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                        <?php if($conf['verifytype']==1){?>
                        <div class="input-group">
                            <input type="text" name="phone" placeholder="手机号码" class="form-control" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="code" placeholder="短信验证码" class="form-control" required>
                            <a class="input-group-addon" id="sendsms">获取验证码</a>
                        </div>
                        <?php }else{?>
                        <div class="input-group">
                            <input type="text" name="code" placeholder="验证码" class="form-control" required>
                            <a class="input-group-addon" id="sendcode">获取验证码</a>
                        </div>
                        <?php if (!empty($tid)) { ?>
                         <div class="input-group">
                         <input type="text" name="tid" value="<?=$tid?>" class="form-control" disabled>
                         </div> <?php } ?>
                        <?php }?>                      
                    </div>
                                        
                    <div class="footer text-center">
                        <button type="button" id="submit" class="btn btn-lg btn-primary btn-block" ng-click="login()" ng-disabled='form.$invalid'>立即注册</button>
                        <h5><a class="link" href="login.php">已有账户?</a></h5>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="copyright">
               
                <span>Designed by <a href="/" target="_blank"><?php echo $conf['web_name']?></a></span>
            </div>
        </div>
    </footer>
</div>

<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
</script>

<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="./assets/layer/layer.js"></script>
<script>
function invokeSettime(obj){
    var countdown=60;
    settime(obj);
    function settime(obj) {
        if (countdown == 0) {
            $(obj).attr("data-lock", "false");
            $(obj).text("获取验证码");
            countdown = 60;
            return;
        } else {
			$(obj).attr("data-lock", "true");
            $(obj).attr("disabled",true);
            $(obj).text("(" + countdown + ") s 重新发送");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
var handlerEmbed = function (captchaObj) {
	var phone;
	captchaObj.onReady(function () {
		$("#wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=sendsms",
			data : {phone:phone,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					new invokeSettime("#sendsms");
					layer.msg('发送成功，请注意查收！');
				}else{
					layer.alert(data.msg);
					captchaObj.reset();
				}
			} 
		});
	});
	$('#sendsms').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		phone=$("input[name='phone']").val();
		if(phone==''){layer.alert('手机号码不能为空！');return false;}
		if(phone.length!=11){layer.alert('手机号码不正确！');return false;}
		captchaObj.verify();
	})
	// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$(document).ready(function(){
	$("select[name='type']").change(function(){
		if($(this).val() == 1){
			$("input[name='account']").attr("placeholder","支付宝账号");
		}else if($(this).val() == 2){
			$("input[name='account']").attr("placeholder","微信号");
		}else if($(this).val() == 3){
			$("input[name='account']").attr("placeholder","QQ号");
		}else if($(this).val() == 4){
			$("input[name='account']").attr("placeholder","银行卡号");
		}
	});
	$("select[name='type']").change();
	if($.cookie('mch_info')){
		var data = $.cookie('mch_info').split("|");
		layer.open({
		  type: 1,
		  title: '你之前申请的商户',
		  skin: 'layui-layer-rim',
		  content: '<li class="list-group-item"><b>商户ID：</b>'+data[0]+'</li><li class="list-group-item"><b>商户密钥：</b>'+data[1]+'</li><li class="list-group-item"><a href="login.php?user='+data[0]+'&pass='+data[1]+'" class="btn btn-default btn-block">返回登录</a></li>'
		});
	}
	$("#sendcode").click(function(){
		if ($(this).attr("data-lock") === "true") return;
		var email=$("input[name='email']").val();
		if(email==''){layer.alert('邮箱不能为空！');return false;}
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
		if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=sendcode",
			data : {email:email},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					new invokeSettime("#sendcode");
					layer.msg('发送成功，请注意查收！');
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	});
	$("#submit").click(function(){
		if ($(this).attr("data-lock") === "true") return;
		var type=$("select[name='type']").val();
		var account=$("input[name='account']").val();
		var username=$("input[name='username']").val();
		var url=$("input[name='url']").val();
		var email=$("input[name='email']").val();
		var phone=$("input[name='phone']").val();
		var code=$("input[name='code']").val();
		var tid=$("input[name='tid']").val();
		if(account=='' || username=='' || url=='' || email=='' || phone=='' || code==''){layer.alert('请确保各项不能为空！');return false;}
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
		if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
		if (url.indexOf(" ")>=0){
			url = url.replace(/ /g,"");
		}
		if (url.toLowerCase().indexOf("http://")==0){
			url = url.slice(7);
		}
		if (url.toLowerCase().indexOf("https://")==0){
			url = url.slice(8);
		}
		if (url.slice(url.length-1)=="/"){
			url = url.slice(0,url.length-1);
		}
		$("input[name='url']").val(url);
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$(this).attr("data-lock", "true");
		$.ajax({
			type : "POST",
			url : "ajax.php?act=reg",
			data : {type:type,account:account,username:username,url:url,email:email,phone:phone,code:code,tid:tid},
			dataType : 'json',
			success : function(data) {
				$("#submit").attr("data-lock", "false");
				layer.close(ii);
				if(data.code == 1){
					layer.open({
					  type: 1,
					  title: '商户申请成功',
					  skin: 'layui-layer-rim',
					  content: '<li class="list-group-item"><b>商户ID：</b>'+data.pid+'</li><li class="list-group-item"><b>商户密钥：</b>'+data.key+'</li><li class="list-group-item">以上商户信息已经发送到您的邮箱中</li><li class="list-group-item"><a href="login.php?user='+data.pid+'&pass='+data.key+'" class="btn btn-default btn-block">返回登录</a></li>'
					});
					var mch_info = data.pid+"|"+data.key;
					$.cookie('mch_info', mch_info);
				}else if(data.code == 2){
					layer.open({
					  type: 1,
					  title: '支付确认页面',
					  skin: 'layui-layer-rim',
					  content: '<li class="list-group-item"><b>所需支付金额：</b>'+data.need+'元</li><li class="list-group-item text-center"><a href="../submit2.php?type=alipay&trade_no='+data.trade_no+'" class="btn btn-default"><img src="../assets/icon/alipay.ico" class="logo">支付宝</a>&nbsp;</li><li class="list-group-item">提示：支付完成后请勿关闭网页，才能显示商户注册成功信息</li>'
					});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$.ajax({
		// 获取id，challenge，success（是否启用failback）
		url: "ajax.php?act=captcha&t=" + (new Date()).getTime(), // 加随机数防止缓存
		type: "get",
		dataType: "json",
		success: function (data) {
			console.log(data);
			// 使用initGeetest接口
			// 参数1：配置参数
			// 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
			initGeetest({
				width: '100%',
				gt: data.gt,
				challenge: data.challenge,
				new_captcha: data.new_captcha,
				product: "bind", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
				offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
				// 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
			}, handlerEmbed);
		}
	});
});
</script>
</body>
</html>