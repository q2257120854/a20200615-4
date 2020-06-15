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
  <title>找回密码 | <?php echo cog::web()['name'];?></title>

  <!-- Favicons-->
  <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo URL_VIEW;?>/static/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo URL_VIEW;?>/static/css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?php echo URL_VIEW;?>/static/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
  <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
<div id="login-page" class="row" >
    <div class="col s12 z-depth-4 card-panel" style="border-radius:8px;">
      <form class="login-form">
        <div class="row">
          <div class="input-field col s12 center">
            <img id="avatar" src="<?php echo URL_VIEW;?>/static/images/avatar.png" class="circle responsive-img valign profile-image-login">
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-perm-identity prefix"></i>
            <input id="member_id" type="text" name="member_id" onchange="check_member_id();" >
            <label for="member_id" id="member_title">手机号/会员名</label>
          </div>
        </div>   
        <div class="row margin" style="display: none;" id="pwd">
          <div class="input-field col s12">
            <i class="mdi-hardware-phone-iphone prefix"></i>
            <input id="password" type="text" name="code" onchange="check_code();">
            <label for="password" id="pwd_title">请输入短信验证码</label>
          </div>
        </div>
        
        <div class="row margin" style="display: none;" id="pwd_n">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="pwdc" type="text" name="pwd" onchange="setpwd();">
            <label for="pwd" id="pwd_t">请设置新密码</label>
          </div>
        </div>  

        <div class="row">          
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="<?php echo url::s("index/user/register");?>" style="font-size: 8px;">免费注册</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="<?php echo url::s("index/user/login");?>" style="font-size: 8px;">返回登录</a></p>
          </div>
        </div>

      </form>
    </div>
  </div>
  <script type="text/javascript">
  function check_member_id(){
	  $.get("<?php echo url::s('index/user/forgetGetSms','member_id=');?>" + $('#member_id').val(), function(result){
	     	 if(result.code == '200'){
		         play(['<?php echo FILE_CACHE . '/download/sound/验证码已发送1.mp3';?>']);
	         	 $('#pwd').show(1000);
		         $('#member_id').attr('disabled',true);
		         $('#member_title').html("<span style='color:green;'>短信已发送至手机,请查收</span>");
		         if(getByteLen(result.data.avatar) > 2){
			         $('#avatar').attr('src','<?php echo URL_VIEW . 'upload/avatar/';?>' + result.data.uid + '/' + result.data.avatar);
			     }
		         $('#password').focus();
	           }else{
		           if($('#member_id').val() == ''){
			          //disabled
		        	  $('#member_title').text('手机号/会员名');
				  }else{
					  if(result.code == '-19'){
						  play(['<?php echo FILE_CACHE . '/download/sound/会员名错误1.mp3';?>','<?php echo FILE_CACHE . '/download/sound/会员名错误2.mp3';?>']);
					  }
					  if(result.code == '-18'){
						  play(['<?php echo FILE_CACHE . '/download/sound/手机号错误1.mp3';?>']);
					  }
					  $('#member_title').html('<span style="color:red;"> ' + result.msg + '</span>');
				 }
	           }
	     	  });
  }

  function check_code(){
	  $.get("<?php echo url::s('index/user/checkForgetCode','code=');?>" + $('#password').val(), function(result){
	     	 if(result.code == '200'){
		     		play(['<?php echo FILE_CACHE . '/download/sound/重设密码1.mp3';?>']);
		     		$('#pwd_title').html('<span style="color:green">正确</span>');
		     		$('#pwd_n').show(1000);
		     		$('#pwdc').focus();
	           }else{
					if($('#password').val() == ''){
				          //disabled
			        	  $('#pwd_title').text('请输入短信验证码');
					  }else{
						  if(result.code == '-17'){
							  play(['<?php echo FILE_CACHE . '/download/sound/验证码错误1.mp3';?>']);
					      }
						  $('#pwd_title').html('<span style="color:red">'+result.msg+'</span>');
					  }
		         }
	     	  });
  }
  
  function getByteLen(val) {
      var len = 0;
      for (var i = 0; i < val.length; i++) {
        var a = val.charAt(i);
        if (a.match(/[^\x00-\xff]/ig) != null) {
          len += 2;
        }
        else {
          len += 1;
        }
      }
      return len;
    }


  function setpwd(){
	  var pwdc = $('#pwdc').val();
	  swal({
          title: "密码提醒", 
          text: "你确定要将该账号密码重新设置为： " + pwdc + " 吗？", 
          type: "warning", 
          showCancelButton: true, 
          confirmButtonColor: "#DD6B55", 
          confirmButtonText: "是的,我要立即设置!", 
          closeOnConfirm: false 
        },
        function(){
           $.get("<?php echo url::s('index/user/pwdSet','pwd=');?>" + pwdc, function(result){
          	 if(result.code == '200'){
	            	swal("操作提示", result.msg, "success")
	              	setTimeout(function(){location.href = '<?php echo url::s('index/user/login');?>';},1000);
	              }else{
	            	  if(result.code == '-13'){
						  play(['<?php echo FILE_CACHE . '/download/sound/验证码错误1.mp3';?>']);
				      }
	            	  if(result.code == '-14'){
						  play(['<?php echo FILE_CACHE . '/download/sound/六位密码1.mp3';?>']);
				      }
	            	swal("操作提示", result.msg, "error")
	              }
          	  });
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
      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/custom-script.js"></script>
  <script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>

</body>

</html>