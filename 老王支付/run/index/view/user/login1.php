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
  <title>登录账号 | <?php echo cog::web()['name'];?></title>

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
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name="pwd" onchange="check_pwd();">
            <label for="password" id="pwd_title">你的登录密码</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="<?php echo url::s("index/user/register");?>" style="font-size: 8px;">免费注册</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="<?php echo url::s("index/user/forget");?>" style="font-size: 8px;">忘记密码 ?</a></p>
          </div>
        </div>

      </form>
    </div>
  </div>
  <script type="text/javascript">
  function check_member_id(){
	  $.get("<?php echo url::s('index/user/checkUsername','member_id=');?>" + $('#member_id').val(), function(result){
	     	 if(result.code == '200'){
		     	 play(['<?php echo FILE_CACHE . '/download/sound/该输登录密码了1.mp3';?>']);
	         	 $('#pwd').show(1000);
		         $('#member_id').attr('disabled',true);
		         $('#member_title').text('手机号/会员名');
		         if(getByteLen(result.data.avatar) > 2){
			         $('#avatar').attr('src','<?php echo URL_VIEW . 'upload/avatar/';?>' + result.data.uid + '/' + result.data.avatar);
			     }
			     $('#password').focus();
	           }else{
		          if($('#member_id').val() == ''){
			          //disabled
		        	  $('#member_title').text('手机号/会员名');
				  }else{
					  $('#member_title').text(result.msg);
					  if(result.code == '-12'){
						  play(['<?php echo FILE_CACHE . '/download/sound/会员名错误1.mp3';?>','<?php echo FILE_CACHE . '/download/sound/会员名错误2.mp3';?>']);
					  }
					  if(result.code == '-11'){
						  play(['<?php echo FILE_CACHE . '/download/sound/手机号错误1.mp3';?>']);
					  }

				 }
	           }
	     	  });
  }

  function check_pwd(){
	  $.get("<?php echo url::s('index/user/checkPwd','pwd=');?>" + $('#password').val() + "&member_id=" + $('#member_id').val(), function(result){
	     	 if(result.code == '200'){
	         	  location.href = "<?php echo url::s("index/panel/home");?>";
	           }else{
					if($('#password').val() == ''){
				          //disabled
			        	  $('#pwd_title').text('你的登录密码');
					  }else{
						  $('#pwd_title').text(result.msg);
						  play(['<?php echo FILE_CACHE . '/download/sound/密码错误1.mp3';?>']);
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