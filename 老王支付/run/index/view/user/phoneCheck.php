<?php
use xh\unity\cog;
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="<?php echo cog::web()['description'];?>">
  <meta name="keywords" content="<?php echo cog::web()['keywords'];?>">
  <title>短信验证 | <?php echo cog::web()['name'];?></title>
  <!-- CORE CSS-->
  <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet">
  <link href="<?php echo URL_VIEW;?>/static/css/style.min.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->    
  <link href="<?php echo URL_VIEW;?>/static/css/custom/custom.min.css" type="text/css" rel="stylesheet">
  <link href="<?php echo URL_VIEW;?>/static/css/layouts/page-center.css" type="text/css" rel="stylesheet">
  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?php echo URL_VIEW;?>/static/js/plugins/prism/prism.css" type="text/css" rel="stylesheet">
  <link href="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
  
  <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" id="from">
        <div class="row">
          <div class="input-field col s12 center">
            <h4>验证短信</h4>
            <p class="center" style="font-size: 8px;">如果下方信息有误,可以<a href="<?php echo url::s("index/user/unregister");?>">取消注册</a></p>
          </div>
        </div>

      
      
		<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-hardware-phone-android prefix"></i>
            <input id="text" type="text" value="<?php echo $_SESSION['register_user']['phone'];?>" disabled>
            <label for="text" class="center-align">手机号码</label>
          </div>
        </div>
        
        <div class="row margin">
          <div class="input-field col s7">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="code" name="code" type="text">
            <label for="code">验证码</label>
          </div>
          <div class="input-field col s5" style="margin-top:25px;"> 
            <button type="button" class="btn waves-effect waves-light cyan darken-2 btn-mini" id="sms" onclick="smsGet()">获取</button>
          </div>
        </div>
        
        
        <div class="row">
          <div class="input-field col s12">
            <a onclick="registerIn()" class="btn waves-effect waves-light col s12">确认注册</a>
          </div>
        </div>
      </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->
  <script>
	var countdown=90;
	function smsGet(){
		var obj = $("#sms");
		 $.get("<?php echo url::s('index/user/smsGet');?>", function(data){
			 if(data.code == '200'){
				  play(['<?php echo FILE_CACHE . '/download/sound/验证码已发送1.mp3';?>']);
				  settime(obj);
	           	  swal("注册提示", data.msg, "success");
	             }else{
	           	  swal("注册提示", data.msg, "error");
	             }
			});
	    }
    
	function settime(obj) { //发送验证码倒计时
	    if (countdown == 0) { 
	        obj.attr('disabled',false); 
	        //obj.removeattr("disabled"); 
	        obj.text("获取");
	        countdown = 60;
	        return;
	    } else { 
	        obj.attr('disabled',true);
	        obj.text(countdown);
	        countdown--;
	    } 
	setTimeout(function() { 
	    settime(obj) }
	    ,1000) 
	}


	function registerIn(){
		$.ajax({
	          type: "POST",
	          dataType: "json",
	          url: "<?php echo url::s('index/user/registerIn');?>",
	          data: $('#from').serialize(),
	          success: function (data) {
	              if(data.code == '200'){
	            	  //swal("注册提示", data.msg, "success");
	            	  location.href="<?php echo url::s('index/user/login');?>";
	              }else{
	            	  play(['<?php echo FILE_CACHE . '/download/sound/验证码错误1.mp3';?>']);
	            	  swal("注册提示", data.msg, "error");
	              }
	          },
	          error: function(data) {
	              alert("error:"+data.responseText);
	           }
	  });
	}
  
  </script>

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/materialize.min.js"></script>
  <!--prism-->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/prism/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <!--sweetalert -->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>   
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins.min.js"></script>
  <!--custom-script.js - Add your own theme custom JS-->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/custom-script.js"></script>
  <script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>

</body>
</html>