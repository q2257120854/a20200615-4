 
<?
 	if ($_SESSION['member_name']!='')
	{
	header('location: /index/home/order/id/'.$_GET['id'].'.html');
}
$ll='true';
  

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户登录 - <?=$site_name?></title>
   <link rel="shortcut icon" href="<?=$site_ico?>"/>
  <link rel="stylesheet" href="/template/login/03/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/login/03/assets/css/main.css">


    <style>
        html, body {
            height: 100%
        }

        .align-center {
            padding: 10px;
            height: 100%;
        }

        @media (min-width: 768px) {
            .align-center {
                display: flex;
                align-items: center;
            }
        }

        @media (min-width: 580px) {
            .container {
                max-width: 580px !important;
            }
        }

        .form-header {
            background: url(/template/login/03/assets/js/login_banner.jpg);
            min-height: 130px;
            background-size: 100% 102%;
            color: white;
        }

        .form-header a {
            color: white;
            font-size: 20px;
            margin-top: 36px;
            display: block;
            text-align: center;
        }

        .input-group-text {
            background: white !important;
        }

        footer {
            position: absolute;
            bottom: 0;
            text-align: center;
            width: 100%;
            color: white;
        }
    </style>
</head>
<body style="background: linear-gradient(#74a0e7,#c7d8ea,#8796ad);">
<div id="vue" class="container align-center">
    <div class="card" style="border: 0;width: 100%;">
        <div class="card-header text-center form-header">
            <a style="color: white" href="/"><?=$site_name?></a>
        </div>
        <div class="card-body" v-if="act==='login'">
            <form action="#" id="form-login">
                <input type="hidden" name="type" v-model="loginType">
                
                                <form method="post" id="loginForm">
                                                                <input name="act" type="hidden" value="login">                                    
                 <ul class="nav nav-tabs" style="margin-bottom: 15px">
                            <li class="nav-item">
                                <a class="nav-link" :class="{'active':loginType==='user'}"
                                   @click="loginType='user'">用户登录</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :class="{'active':loginType==='card'}"
                                   @click="loginType='card'">卡密登录</a>
                            </li>
                        </ul>



                               <div v-if="loginType==='card'" v-cloak>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="iconfont">&#xe626;</i></div>
                            </div>
                            <input type="text" name="card" class="form-control" placeholder="输入卡密">
                        </div>
                        <div class="form-group"   style="display:none">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="iconfont">&#xe640;</i></div>
                                </div>
                                <input type="password" name="pass" class="form-control" placeholder="输入卡密,没有则不填写">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                        <a href="#" class="btn btn-block btn-primary"
                           @click="kmlogin">卡密登录</a>
                    </div>
                    
                    
                    </div>
                </div>
                <div v-else>
                                                  <p>欢迎免费注册！<span style="float: right"><a href="/reg.php">用户注册</a></span></p>
                                        <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="iconfont">&#xe64d;</i></div>
                            </div>
                            <input type="text" name="m_name" id="m_name" class="form-control" placeholder="输入用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="iconfont">&#xe640;</i></div>
                            </div>
                            <input type="password" name="m_password" id="m_password" class="form-control" placeholder="输入用户密码">
                        </div>
                    </div>
                    <div class="form-check" style="font-size: 15px;margin: 15px 0px">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">记住密码</label>
                    </div>
                    
                    
                    <div class="form-group">
                        <a href="#" class="btn btn-block btn-primary"
                           @click="login">登录</a>
                    </div>
                    
                    
                </div>
                                     
                    <div class="text-center" style="font-size: 45px">
                        <hr>
                        <a href="http://dawns.618ka.cn/qqlogin?url=http://<?=$dq_url?>/qq.php&url1=http://<?=$dq_url?>/login/<?=$_GET['id']?>.html"><i class="iconfont">&#xe60d;</i></a>
                        <a onclick="alert('暂不支持')"><i class="iconfont">&#xe607;</i></a>
                    </div>
        </div>                            </form>

          
        </div>
    </div>
</div>
<footer class="an-footer">
</footer>
<script src="/template/login/03/assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="/doc/file/js/layer.js"></script>
  <script src="/template/login/03/assets/js/main.js"></script>
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
            if (data.code === 0) {
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
            if (data.code === 0) {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
            } else {
                
                layer.alert(data.message);
         
            }
          });
      },
	   
         reg: function () {
        var vm = this;
        this.$post('/ajax.php?act=reg', new FormData(document.getElementById("form-reg")))
          .then(function (data) {
            $("#code").click();
            if (data.code === 0) {
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
        if (code === 13) {
          vm.act === 'login' ? vm.login() : vm.reg();
        }
      }
    }
  });
</script>
</body>
</html>
