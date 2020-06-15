<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='修改资料';
include './head.php';
?>
<?php

if(strlen($userrow['phone'])==11){
	$userrow['phone']=substr($userrow['phone'],0,3).'****'.substr($userrow['phone'],7,10);
}

?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">验证密保信息</h4>
            </div>
            <div class="modal-body">
			<?php if($conf['verifytype']==1){?>
			<div class="input-group">密保手机：<?php echo $userrow['phone']?></div>
			<div class="input-group">
			<input type="text" name="code" placeholder="输入短信验证码" class="form-control" required>
			<a class="input-group-addon" id="sendcode">获取验证码</a>
			</div>
			<?php }else{?>
			<div class="input-group">密保邮箱：<?php echo $userrow['email']?></div>
			<div class="input-group">
			<input type="text" name="code" placeholder="输入验证码" class="form-control" required>
			<a class="input-group-addon" id="sendcode">获取验证码</a>
			</div>
			<?php }?>
			<button type="button" id="verifycode" class="btn btn-primary btn-block">确定</button>
			<div id="embed-captcha"></div>
		</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">修改密保信息</h4>
            </div>
            <div class="modal-body">
			<?php if($conf['verifytype']==1){?>
			<div class="input-group">密保手机：<?php echo $userrow['phone']?></div>
			<div class="input-group">
				<input type="text" name="phone_n" placeholder="输入新的手机号码" class="form-control" required>
				</div>
			<div class="input-group">
			<input type="text" name="code_n" placeholder="输入短信验证码" class="form-control" required>
			<a class="input-group-addon" id="sendcode2">获取验证码</a>
			</div>
			<?php }else{?>
			<div class="input-group">密保邮箱：<?php echo $userrow['email']?></div>
			<div class="input-group">
				<input type="email" name="email_n" placeholder="输入新的邮箱" class="form-control" required>
				</div>
			<div class="input-group">
			<input type="text" name="code_n" placeholder="输入验证码" class="form-control" required>
			<a class="input-group-addon" id="sendcode2">获取验证码</a>
			</div>
			<?php }?>
			<button type="button" id="editBind" class="btn btn-primary btn-block">确定</button>
			<div id="embed-captcha"></div>
		</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel"><?php echo $conf['web_name']?> 获取微信OpenID</h4>
            </div>
            <div class="modal-body">
            <p>微信关注公众号dadajidi点击底部导肮获取 或者微信扫码一下二维码获取</p>
            <center><img src="http://p7176v90q.bkt.clouddn.com/o_1ciket19q4fi57s1hb1cqg8kka.png"></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect">官方公告</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">了解</button>
            </div>
        </div>
    </div>
</div>



<section class="content profile-page">
	<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2><?php echo $conf['web_name']?>
                <small>Welcome to Oreo</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i>主页</a></li>
                    <li class="breadcrumb-item active">修改资料</li>
                </ul>                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong><trans oldtip="Input"><?php echo $conf['web_name']?></trans></strong> 商户信息查看</h2>                        
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                  
                                    <input type="text" class="form-control" value="ID：<?php echo $pid?>" disabled>
                                </div>
                                <div class="form-group">                                   
                                    <input type="text" class="form-control" value="KEY：<?php echo $userrow['key']?>" disabled>
                                </div>
                                <div class="form-group">                                   
                                    <input type="text" class="form-control" value="MONEY：￥<?php echo $userrow['money']?>" disabled>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input --> 
        <!-- Textarea -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong><trans><?php echo $conf['web_name']?></trans></strong> 收款账号设置</h2>
                    </div>
                    <div class="body">
                    	<form class="form-horizontal devform">

                        <div class="btn-group bootstrap-select form-control show-tick col-sm-6">
                        	<div class="dropdown-menu" role="combobox" style="max-height: 247px; overflow: hidden; min-height: 0px;"></div>
                        	<select class="form-control show-tick" tabindex="-98" name="stype" >
                                    <?php if($conf['stype_1']){?><option value="1"><trans>支付宝结算</trans></option>
                                    <?php }if($conf['stype_2']){?><option value="2"><trans>微信结算</trans></option>
                                    <?php }if($conf['stype_3']){?><option value="3"><trans>QQ钱包结算</trans></option>
                                    <?php }if($conf['stype_4']){?><option value="4"><trans>银行卡结算</trans></option>
                                <?php }?></select>
                            </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
<div class="form-group">                                   
                                    <input type="text" class="form-control" value="当前结算方式：<?php if($userrow['settle_id'] ==1){
echo "支付宝" ;
}elseif($userrow['settle_id'] ==2){
echo "微信" ;
}elseif($userrow['settle_id'] ==3){
echo "QQ" ;
}else{
echo "银行卡" ;
}

?>" disabled>
                                </div>
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" placeholder="收款账户" name="account" value="<?php echo $userrow['account']?>">                                 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" placeholder="真实姓名" name="username" value="<?php echo $userrow['username']?>">                                   
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                    <input type="button" id="editSettle" value="确定修改" class="btn btn-primary btn-round"/>
                                    <input type="button" data-toggle="modal" data-target="#myModal1" value="获取微信Openid" class="btn btn-primary btn-round"/>                                                  
                                </div>
                            </div>
                        </div>                         
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Textarea --> 

        <!-- Select -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> <strong><trans><?php echo $conf['web_name']?></trans></strong> 联系方式设置</h2>
                    </div>
                    <div class="body">
                    	<?php if($conf['verifytype']==1){?>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <div class="input-group">                          
                                    <input class="form-control" type="text" name="phone" value="<?php echo $userrow['phone']?>" disabled>
						            <a class="input-group-addon" id="checkbind">修改绑定</a>                                   
                                </div>
                                </div>
                            </div>
                        </div>
						<div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                   <input type="text" class="form-control" placeholder="邮箱" name="email" value="<?php echo $userrow['email']?>">
                               </div>
                            </div>
                        </div>
                        <?php }else{?>
                        	<div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <div class="input-group">                          
                                    <input class="form-control" type="text" name="email" value="<?php echo $userrow['email']?>" disabled>
						            <a class="input-group-addon" id="checkbind">修改绑定</a>                                   
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" placeholder="QQ" name="qq" value="<?php echo $userrow['qq']?>">                                   
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" placeholder="网站域名" name="url" value="<?php echo $userrow['url']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">                                    
                                    <input type="button" id="editInfo" value="确定修改" class="btn btn-primary btn-round"/>                                   
                                </div>
                            </div>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div> 




    <?php include 'foot.php';?>
<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="assets/layer/layer.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
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
	var target;
	captchaObj.onReady(function () {
		$("#wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var situation=$("#situation").val();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=sendcode",
			data : {situation:situation,target:target,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					new invokeSettime("#sendcode");
					new invokeSettime("#sendcode2");
					layer.msg('发送成功，请注意查收！');
				}else{
					layer.alert(data.msg);
					captchaObj.reset();
				}
			} 
		});
	});
	$('#sendcode').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		captchaObj.verify();
	});
	$('#sendcode2').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		if($("input[name='phone_n']").length>0){
			target=$("input[name='phone_n']").val();
			if(target==''){layer.alert('手机号码不能为空！');return false;}
			if(target.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			target=$("input[name='email_n']").val();
			if(target==''){layer.alert('邮箱不能为空！');return false;}
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(target)){layer.alert('邮箱格式不正确！');return false;}
		}
		captchaObj.verify();
	})
	// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$(document).ready(function(){
	$("select[name='stype']").change(function(){
		if($(this).val() == 1){
			$("#typename").html("支付宝账号");
		}else if($(this).val() == 2){
			$("#typename").html("微信Openid");
		}else if($(this).val() == 3){
			$("#typename").html("QQ号");
		}else if($(this).val() == 4){
			$("#typename").html("银行卡号");
		}
	});
	$("#editSettle").click(function(){
		var stype=$("select[name='stype']").val();
		var account=$("input[name='account']").val();
		var username=$("input[name='username']").val();
		if(account=='' || username==''){layer.alert('请确保各项不能为空！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_settle",
			data : {stype:stype,account:account,username:username},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！');
				}else if(data.code == 2){
					$("#situation").val("settle");
					$('#myModal').modal('show');
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editInfo").click(function(){
		var email=$("input[name='email']").val();
		var qq=$("input[name='qq']").val();
		var url=$("input[name='url']").val();
		if(email=='' || qq=='' || url==''){layer.alert('请确保各项不能为空！');return false;}
		if(email.length>0){
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
		}
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
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_info",
			data : {email:email,qq:qq,url:url},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.alert('修改成功！');
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#checkbind").click(function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "GET",
			url : "ajax2.php?act=checkbind",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					$("#situation").val("bind");
					$('#myModal2').modal('show');
				}else if(data.code == 2){
					$("#situation").val("mibao");
					$('#myModal').modal('show');
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#editBind").click(function(){
		var phone=$("input[name='phone_n']").val();
		var email=$("input[name='email_n']").val();
		var code=$("input[name='code_n']").val();
		if(code==''){layer.alert('请输入验证码！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=edit_bind",
			data : {phone:phone,email:email,code:code},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.msg('修改绑定成功，正在跳转中...', {icon: 16,shade: 0.01,time: 15000});
					setTimeout(window.location.reload(), 1000);
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$("#verifycode").click(function(){
		var code=$("input[name='code']").val();
		var situation=$("#situation").val();
		if(code==''){layer.alert('请输入验证码！');return false;}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax2.php?act=verifycode",
			data : {code:code},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					layer.msg('验证成功！');
					$('#myModal').modal('hide');
					if(situation=='settle'){
						$("#editSettle").click();
					}else if(situation=='mibao'){
						$("#situation").val("bind");
						$('#myModal2').modal('show');
					}else if(situation=='bind'){
						$('#myModal2').modal('hide');
						window.location.reload();
					}
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
	var items = $("select[default]");
	for (i = 0; i < items.length; i++) {
		$(items[i]).val($(items[i]).attr("default")||1);
	}
});
</script>