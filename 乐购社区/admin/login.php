<?php 

include('../system/inc.php');
include('./admin_config.php');
 

?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="4kwVcgC3fUovVyLFh1BGZKGW7IUV0x2iOK3ANEoT">
    <title>后台登录 - <?=$site_name?></title>
    <meta name="keywords" content="<?=$site_name?>"/>
    <meta name="description" content="<?=$site_name?>"/>
    <link href="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/common/css/style.css?v=1.1">
    <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<body id="admin_body">
<div id="vue" class="admin_login_page">
    <div class="admin_login_content">
        <div class="admin_login_img hidden-xs">
            <h1 class="limit"><?=$site_name?></h1>
        </div>
        <div class="admin_login_form">
            <h1>后台登录</h1>
            <form action="#" id="form-login">
            	<input name="act" type="hidden" value="login">
                <input type="text" class="input username" name="user" placeholder="输入用户名">
                <input type="password" class="input password" name="pass" placeholder="输入密码">
                <select name="kind" class="input power">
                    <option value="9">站长</option>
                    <option value="8">管理员</option>
                                    </select>
                                    
                                <div class="login_btn" onclick="login()">登 录</div>
                <div class="mt30" style="position: relative">
                    <hr>
                    <div class="hr">第三方登录</div>
                    <a href="/qqLogin" class="third_btn mt30" style="margin: 0 auto"></a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="footer">
    版权所有 © 2017-2019 乐购社区
</div>
<script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-1.10.0.min.js" type="text/javascript"></script>
												<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js" type="text/javascript"></script>
												<script src="http://assets.yilep.com/ylsq/js/admin/main.js?v=3.0.9"></script>
<script>
												 function login()
{
	
	   var vm = this;
        this.$post('ajax_login.php', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.status === 0) 
			{
			 window.location.href = data.message;
				        } 
						else {
                 layer.alert(data.message);
         
            }
          });
}
  
</script>
</body>
</html>
