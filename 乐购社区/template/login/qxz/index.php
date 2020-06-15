<?
$templatename='qxz';
 	if ($_SESSION['member_name']!='')
	{
	header('location: /index/home/order/id/'.$_GET['id'].'.html');
}
$ll='true';
  

?> <!doctype html>
<html>
<head>
 <title>会员登录 - <?=$site_name?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--图标-->
	<link rel="stylesheet" type="text/css" href="/template/login/<?=$templatename?>/css/font-awesome.min.css">
	
	<!--布局框架-->
	<link rel="stylesheet" type="text/css" href="/template/login/<?=$templatename?>/css/util.css">
	
	<!--主要样式-->
	<link rel="stylesheet" type="text/css" href="/template/login/<?=$templatename?>/css/main.css">
</head>

<body>

<div class="login" id="vue">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="/template/login/<?=$templatename?>/picture/img-01.png" alt="IMG">
			</div>

        <div   v-if="act==='login'">

			<form class="login100-form validate-form" id="form-login" >
				<span class="login100-form-title">
					会员登陆
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="m_name" id="m_name" placeholder="用户名">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="password" name="m_password" placeholder="密码">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				
				<div class="container-login100-form-btn">
					<button class="login100-form-btn"   type="button" @click="login">
						登陆
					</button>
				</div>

				<div class="text-center p-t-12">
					<!--<a class="txt2"  @click="act='getpwd'" href="javascript:">
						忘记密码？
					</a>-->
				</div>

				<div class="text-center p-t-136">
					<a class="txt2" href="#reg" @click="act='reg'">
							还没有账号？立即注册
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
          </div>
            
            
            
            
            
            
            
            
            
        <div   v-if="act==='reg'">

			<form class="login100-form validate-form" id="form-reg" >
				<span class="login100-form-title">
					会员注册
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="m_name" id="m_name" placeholder="用户名">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="password" name="m_password" placeholder="密码">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				
                
                	<div class="wrap-input100 validate-input">
					<input class="input100" type="password" name="m_qq" placeholder="QQ">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-qq" aria-hidden="true"></i>
					</span>
				</div>
				
                
                
                
                	<div class="wrap-input100 validate-input">
                    <table width="100%" border="0">
  <tr>
    <td><input class="input100" type="text" name="m_key" placeholder="验证码"    ></td>
    <td>                        <img title="点击刷新"  src="picture/verifycode.php"  onClick="this.src='/system/verifycode.php?'+Math.random();"   style="height:40PX"  id="code"  >
</td>
  </tr>
</table>

					

					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-qrcode" aria-hidden="true"></i>
					</span>
				</div>
                
                
				<div class="container-login100-form-btn">
					<button class="login100-form-btn"   type="button" @click="reg">
						立即注册
					</button>
				</div>

				<div class="text-center p-t-12">
					<a class="txt2" @click="act='getpwd'"  href="javascript:">
						忘记密码？
					</a>
				</div>

				<div class="text-center p-t-136">
					<a class="txt2" href="#reg" @click="act='login'">
							已有账号？立即登陆
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
          </div>
            
            
            
            
            
            
            
            
            
            
            
                      
        <div   v-if="act==='getpwd'">

			<form class="login100-form validate-form" id="form-getpwd" >
				<!--<span class="login100-form-title">
					找回密码
				</span>-->

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="m_name" id="m_name" placeholder="用户名">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>

			 
                
                	<div class="wrap-input100 validate-input">
					<input class="input100" type="password" name="m_qq" placeholder="QQ">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-qq" aria-hidden="true"></i>
					</span>
				</div>
				
                
                
                
                	<div class="wrap-input100 validate-input">
                    <table width="100%" border="0">
  <tr>
    <td><input class="input100" type="text" name="m_key" placeholder="验证码"    ></td>
    <td>                        <img title="点击刷新"  src="picture/verifycode.php"  onClick="this.src='/system/verifycode.php?'+Math.random();"   style="height:40PX"  id="code"  >
</td>
  </tr>
</table>

					

					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-qrcode" aria-hidden="true"></i>
					</span>
				</div>
				
                
                
            
                
                
				<div class="container-login100-form-btn">
					<button class="login100-form-btn"   type="button" @click="pwd">
						立即找回
					</button>
				</div>

				<div class="text-center p-t-12">
					<a class="txt2" @click="act='login'"  href="javascript:">
						返回登陆
					</a>
				</div>

				<div class="text-center p-t-136">
					<a class="txt2" href="#reg" @click="act='reg'">
							还没有账号？立即注册
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
          </div>
            
            
		</div>
	</div>
</div>

<script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script>
 
   new Vue({
    el: '#vue',
    data: {
      act: 'login',
      loginType: 'user',
     },
     methods: {
 	 
      login: function () {
         var vm = this;
        this.$post('/post/login.php?act=login', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.code == 0) {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
            } else {
                
                layer.alert(data.message);
         
            }
          });
      },
	       kmlogin: function () {
         var vm = this;
        this.$post('/post/login.php?act=kmlogin', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.code == 0) {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
            } else {
                
                layer.alert(data.message);
         
            }
          });
      },
	   
         reg: function () {
        var vm = this;
        this.$post('/post/login.php?act=reg', new FormData(document.getElementById("form-reg")))
          .then(function (data) {
            $("#code").click();
            if (data.code == 0) {
              vm.act = 'login';
              layer.alert('恭喜你，注册成功。马上登录！');
            } 
               else {
                layer.alert(data.message);
             }
          });
      }
    },

    mounted: function () {
      var vm = this;
      document.onkeyup = function (e) {
        var code = parseInt(e.charCode || e.keyCode);
        if (code == 13) {
          vm.act == 'login' ? vm.login() : vm.reg();
        }
      }
    }
  });
</script>
</body>
</html> 