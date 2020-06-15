<?php
use xh\library\url;
?>
<!doctype html>
<html lang="en" class="login-content">
 <head>
  <meta charset="UTF-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Peanut Meat System v <?php echo SYSTEM_VERSION;?></title> 
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <!-- Vendor CSS -->
  <link href="<?php echo URL_VIEW;?>/static/login/css/material-design-iconic-font/css/material-design-iconic-font.min.css" rel="stylesheet" type="text/css">
  <!-- CSS -->
  <link href="<?php echo URL_VIEW;?>/static/login/css/app.min.1.css" rel="stylesheet" type="text/css">
 </head>
 <body class="login-content" data-ng-controller="loginCtrl as lctrl">
    <div class="lc-block toggled" id="l-login" data-ng-class="{'toggled':lctrl.login === 1}">
    	<h1 class="lean">LOGIN</h1>
		<form id="data">
    	<div class="input-group m-b-20">
    		<span class="input-group-addon">
    			<i class="zmdi zmdi-account"></i>
    		</span>
    		<div class="fg-line">
    			<input type="text" name="username" value="" class="form-control" placeholder="用户名"/>
    		</div>
    	</div>

        <div class="input-group m-b-20">
    		<span class="input-group-addon">
    			<i class="zmdi zmdi-lock-outline"></i>
    		</span>
    		<div class="fg-line">
    			<input type="password" name="pwd" value=""  class="form-control" placeholder="密码" style="position:relative;left:-1px;"/>
    		</div>
    	</div>
    	
    	<div class="input-group m-b-20">
    		<span class="input-group-addon">
    			<i class="zmdi zmdi-mic"></i>
    		</span>
    		<div class="fg-line">
    			<input type="password" class="form-control" name="pwd_safe" placeholder="安全令牌" style="position:relative;left:-1px;"/>
    		</div>
    	</div>
    	<div class="clearfix"></div>
    	

    	</form>
    	<a href="javascript:Login();" id="login" class="btn btn-login btn-danger btn-float">
    		<i class="zmdi zmdi-arrow-forward"></i>
    	</a>
    </div>
 
<script>

	function Login(){
		layer.load();
	  	$.ajax({
	          type: "POST",
	          dataType: "json",
	          url: "<?php echo url::s('admin/user/loginResult','_CSRF='.url::found_csrf());?>",
	          data: $('#data').serialize(),
	          success: function (data) {
	              if(data.code == '200'){
	              	layer.closeAll('loading');
	              	location.href='<?php echo url::s('admin/index/home');?>';
	              }else{
	              	layer.closeAll('loading');
	              	layer.msg(data.msg, {icon: 2});
	              	if(data.code == '404'){
	              		setTimeout(function(){location.href='';},1000);
		            }
	              }
	          },
	          error: function(data) {
	        	    layer.closeAll('loading');
	             	layer.msg("网络异常波动,请稍后重试..",{icon: 2});
	           }
	  });
	}

</script>
 <script src="<?php echo URL_STATIC;?>js/jquery.min.js"></script>
 <script src="<?php echo URL_STATIC;?>js/layer/layer.js"></script>
 <script>
 document.onkeydown=keyDownSearch; 
 
 function keyDownSearch(e) {  
     // 兼容FF和IE和Opera  
     var theEvent = e || window.event;  
     var code = theEvent.keyCode || theEvent.which || theEvent.charCode;  
     if (code == 13) {   
    	 Login();
         return false;  
     }  
     return true;  
 } 
 </script>
 </body>
 </html>