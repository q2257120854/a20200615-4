<?php if(!defined( 'WY_ROOT'))exit; ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>智通付 - 完善商户信息</title>
<meta name="description" content="<?php echo $this->config['description']?>">
<meta name="keywords" content="<?php echo $this->config['keyword']?>">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link href="/2018new/css/bootstrap.min.css" rel="stylesheet" />
<link href="/2018new/css/index.min.css" rel="stylesheet" />
<script src="/2018new/js/jquery.min.js" type="text/javascript"></script>
<script src="/2018new/js/index.min.js" type="text/javascript"></script>
<script src="/static/common/jquery-1.12.1.min.js" type="text/javascript"></script>
<script src="/static/common/bootstrap.min.js" type="text/javascript"> </script>
<script src="/static/default/app.js" type="text/javascript"></script>
<style type="text/css">
body{background:url(/images/sh_bg.jpg) repeat-y left top;}
</style>
<script language="javascript">
function checkReg(form)
{
	var p=/^[a-zA-Z0-9]+$/;
	//if(form.login_name.value=="" || form.login_name.value.length<6 || !p.test(form.login_name.value))
	
	if(form.agree.checked==false)
	{
		alert("你没有同意合作协议！");
		return false;
	}
	
	return true;
}
</script>

        </head>
        
        <body>
           <body>

<div class="welcome"></div>

<div class="quality1">
 
  <div class="box">

    <div class="items">
      <div class="in-login">
	  <form class="form-ajax" action="/register/savetwo" method="post" autocomplete="off" onsubmit="return checkReg(this)">
        <input type="hidden" name="email" value="<?php echo $email?>">
                                        <input type="hidden" name="token" value="<?php echo $token?>">
          <input type="hidden" name="agentId"  />
          <div class="in-login-con">
		  <a href="/" title="首页"><img src="/images/login2_02.png" alt="智通付首页" /></a>
            <div class="zhdl"> <strong>智通付 - 完善商户信息</strong> <strong>
              <p id="corp_errtips" class="error"></p>
              </strong> </div>
			  <div class="dlk-box"> <span class="input-icon1"></span>
			
              <input type="text" class="dlk2 input-bg1" value="<?php echo $email?>" disabled>
            </div>
            <br>
            <div class="dlk-box"> <span class="input-icon1"></span>
              <input name="username" type="text" id="txtloginName" class="dlk2 input-bg1" placeholder="请输入账户名" maxlength="20" required>
            </div>
            <br>
            <div class="dlk-box"> <span class="input-icon2"></span>
              <input name="userpass" type="password" id="txtpassWord" class="dlk2 input-bg2" placeholder="请输入登陆密码" maxlength="20" required>
            </div>
            <br>
            <div class="dlk-box"> <span class="input-icon2"></span>
              <input name="cirmpwd" type="password"  class="dlk2 input-bg2" placeholder="确认密码" maxlength="20" required>
            </div>
            <br>
            <div class="dlk-box"> <span class="input-icon2"></span>
              <input name="phone" type="text" id="txtpassWord" class="dlk2 input-bg2" placeholder="手机号码" maxlength="11" required>
            </div>
          
            <br>
            <div class="dlk-box"> <span class="input-icon2"></span>
              <input name="qq" type="text" id="txtpassWord" class="dlk2 input-bg2" placeholder="QQ号码" maxlength="20" required>
            </div>
			<br>
            <div class="dlk-box"> <span class="input-icon2"></span>
              <input name="sitename" type="text" id="txtpassWord" class="dlk2 input-bg2" placeholder="接入网站名称" value="" maxlength="30" required>
            </div>
            <br>
            <div class="dlk-box"> <span class="input-icon2"></span>
              <input name="siteurl" type="text" id="txtpassWord" class="dlk2 input-bg2" placeholder="接入网站地址" value="" maxlength="30" required>
            </div>
            <br>
			<div class="dlk-box"> <span class="input-icon2"></span>
              <input type="text" name="chkcode" class="dlk3 input-bg2" placeholder="验证码"
                                            maxlength="5" required> <img src="/chkcode" onclick="javascript:this.src=this.src+'?t=new Date().getTime()'" class="imgcode" style="cursor:pointer; margin: 0px auto 0 0px;height:34px;" title="点击刷新验证码">
               

		  <p></p>


            <div class="dlk-box"> <span class="input-icon5"></span>
			<td height="40" colspan="2" bgcolor="#FFFFFF" ><input name="agree" type="checkbox"  class="textbox" id="agree" value="agree" />
              <font>
              <a style="cursor:pointer;" for="agree" href="/i/merchant_agreement.html" target="_blank"> 同意并认真阅读<font color="red">商户合作协议</font></a></font></td>
			  </div>  
            <div class="dlan">
              <button id="corp_loginbtn" class="dlan-input" name="Submit" type="submit">已完善信息,立即注册</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>