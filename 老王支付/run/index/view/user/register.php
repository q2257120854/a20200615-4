<?php
use xh\unity\cog;
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo WEB_NAME; ?> - 3秒钟部署你的快捷支付通道!</title>
    <link rel="stylesheet" href="/static/home/css/layui.css">
    <link rel="stylesheet" href="/static/home/css/public.css">
    <link href="/static/home/css/Login.css?v=1551096721" rel="stylesheet" />
    <link rel="stylesheet" href="/static/home/css/public.css">
    <link rel="stylesheet" href="/static/home/css/signin.css">
    <link rel="stylesheet" href="/static/home/css/signin_user.css">

  <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
    <style>
        .loginHead .signin_btn:hover{
            border: 1px solid #587ffd; 
        }
    </style>


<body>
    <div class="head js_loginHead" style="top:0px;">
        <div class="head_c_w">
            <div class="logo"></div>
            <ul class="clear-a">
                <li class="a_btn signin_btn">
                    <a href="<?php echo url::s("index/user/register");?>"><span>注册</span></a>
                </li>
                <li class="login_btn">
                    <a href="<?php echo url::s("index/user/login");?>"><span>登录</span></a>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="warp signin_warp clear-a" style="margin-top:100px;">
        <h5 style="padding:0px 30px;">注册商户</h5>
        <div class="signin_content">
          

          
           <form class="login-form" id="from">
                <input type="hidden" name="xz" id="xz" value="1">
                <div class="layui-form-item">
                    <label class="layui-form-label">注册用户名*：</label>
                    <div class="layui-input-block">
                        <input name="username" id="username" class="layui-input" type="text" placeholder="请输入用户名" autocomplete="off" lay-verify="title">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">注册密码*：</label>
                    <div class="layui-input-inline">
                        <input name="password" id="password" class="layui-input" id="pwd" type="password" placeholder="请输入密码" autocomplete="off" lay-verify="pass">
                    </div>
                    <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">确认注册密码*：</label>
                    <div class="layui-input-inline">
                        <input  class="layui-input" id="password-again" name="pwd_repeat" type="password" placeholder="请重复输入注册密码" autocomplete="off" lay-verify="confirm_pwd">
                    </div>
                    <div class="layui-form-mid layui-word-aux">请确保两次输入的注册密码一致</div>
                </div>
               
              
                <div style="border-top:solid 1px #f2f2f2;padding-bottom:30px;margin-top:30px;"></div>

                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">手机号码*：</label>
                        <div class="layui-input-inline">
                            <input name="phone" id="phone-code" class="layui-input E-mail" type="text" placeholder="请输入手机号码"  >
                        </div>
                    </div>
                  
                </div>
				 <?php if (cog::read('registerCog')['scale_open'] == 1){?>
				  <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">推荐人*：</label>
                        <div class="layui-input-inline">
                            <input id="text" type="text" name="recommend_username" class="layui-input"  placeholder="推荐人会员名,选填"  >
                        </div>
                    </div>
                  
                </div>
				 <?php }?>
              <div class="layui-form-item">
              <div class="layui-inline">
            <p class="margin center medium-small sign-up" style="    margin-left: 400px;"> 
                      <input type="checkbox" name="provision" value="1" class="filled-in" id="filled-in-box" checked="checked" />
                      <label for="filled-in-box"></label>
                   	  <a href="">《老王支付网站服务条款》</a>
           </p>
          </div>  </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn btn_sbm" type="button" onclick="register_check()" lay-filter="btn_sbm" lay-submit="">同意条款并注册</button>
			
                    </div>
                </div>
             
          </form>



    </div>
</div>
</div>

<style>
    .password-progress {
        margin-top: 10px;
        margin-bottom: 0;
    }
</style>
 <script>
 
  function register_check(){
	  $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo url::s('index/user/registerCheck');?>",
          data: $('#from').serialize(),
          success: function (data) {
              console.log(data);
              if(data.code == '200'){

                  $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo url::s('index/user/registerIn');?>",
          data: "",
          success: function (data) {
              console.log(data);
              if(data.code == '200'){
                 swal("注册提示", data.msg, "success");
                 location.href="<?php echo url::s('index/user/login');?>";
              }
          }
                
            	  });
              }else{
                  if(data.code == '-18'){
                	  play(['<?php echo FILE_CACHE . '/download/sound/会员名过短1.mp3';?>']);
                  }
                  if(data.code == '-19'){
                	  play(['<?php echo FILE_CACHE . '/download/sound/用户名重复2.mp3';?>','<?php echo FILE_CACHE . '/download/sound/用户名重复1.mp3';?>']);
                  }
                  if(data.code == '-23'){
                	  play(['<?php echo FILE_CACHE . '/download/sound/六位密码1.mp3';?>']);
                  }
                  if(data.code == '-20'){
                	  play(['<?php echo FILE_CACHE . '/download/sound/第二次密码错误1.mp3';?>']);
                  }
                  if(data.code == '-21'){
                    	  play(['<?php echo FILE_CACHE . '/download/sound/手机号错误1.mp3';?>']);
                  }
              	  if(data.code == '-22'){
              	  	  play(['<?php echo FILE_CACHE . '/download/sound/手机号已注册1.mp3';?>']);
              	  }
               
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
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/formatter/jquery.formatter.min.js"></script>   
  <script type="text/javascript" src ="<?php echo URL_STATIC . '/js/jike.js'?>"></script>
</body>
</html>