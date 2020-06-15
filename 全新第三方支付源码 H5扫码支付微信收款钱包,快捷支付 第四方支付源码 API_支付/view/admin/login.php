<?php if(!defined( 'WY_ROOT')) exit;?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<!-- 启用360浏览器的极速模式(webkit) -->
<meta name="renderer" content="webkit">
<!-- 避免IE使用兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
<meta name="HandheldFriendly" content="true">
<!-- 微软的老式浏览器 -->
<meta name="MobileOptimized" content="320">
<!-- uc强制竖屏 -->
<meta name="screen-orientation" content="portrait">
<!-- QQ强制竖屏 -->
<meta name="x5-orientation" content="portrait">
<!-- UC强制全屏 -->
<meta name="full-screen" content="yes">
<!-- QQ强制全屏 -->
<meta name="x5-fullscreen" content="true">
<!-- UC应用模式 -->
<meta name="browsermode" content="application">
<!-- QQ应用模式 -->
<meta name="x5-page-mode" content="app">
<!--这meta的作用就是删除默认的苹果工具栏和菜单栏-->
<meta name="apple-mobile-web-app-capable" content="yes">
<!--网站开启对web app程序的支持-->
<meta name="apple-touch-fullscreen" content="yes">
<!--在web app应用下状态条（屏幕顶部条）的颜色-->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- windows phone 点击无高光 -->
<meta name="msapplication-tap-highlight" content="no">
<!--移动web页面是否自动探测电话号码-->
<meta http-equiv="x-rim-auto-match" content="none">
 <title>
           <?php echo $this->config['sitename']?><?php echo $title ?>
        </title>

    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="stylesheet" href="/static/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/static/assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/static/assets/css/app.css">
	   <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
        </script>
        <script src="/static/common/bootstrap.min.js" type="text/javascript">
        </script>
        <script src="/static/common/jquery.zclip.min.js" type="text/javascript">
        </script>
        <script src="/static/common/datetimepicker.min.js" type="text/javascript">
        </script>
        <script src="/static/admin/app.js" type="text/javascript">
        </script>
		<script>
function KeyDown()
{
  if (event.keyCode == 13)
  {
    event.returnValue=false;
    event.cancel = true;
    Form.submit.click();
  }
}
</script>

		<style>
		
.login-form li {margin-bottom: 0.5rem;}
.login-form{
    margin-top: 1.4rem;
  }
.login-form li input{
    width: 12.53rem;
    border-radius: 4px;
    border: 1px solid #e6ebf0;
    margin: 0 auto;
    padding:0.25rem;
    height:1.19rem;
    background: -webkit-linear-gradient(#fafafa, #fff);
    background: -o-linear-gradient(#fafafa, #fff);
    background: -moz-linear-gradient(#fafafa, #fff);
    background: linear-gradient(#fafafa, #fff);
  }
.login-form li input.vcode{
    /*width: auto;
    position: relative;
    right:40px;
    left:0;
    margin-right: 104px;*/
  }
.login-form .code{
    right:2px;
    top:0.25rem;
    height: auto;
  }
.login-form .f-pr{position:relative;}
.login-form,
.registerForm{
    margin-top: 10px;
    color: #000000;
    overflow: hidden;
}

.login-form li ,
.registerForm > li{
    margin-bottom: 20px;
}

.login-form li input,
.registerForm > li input{
    height: 40px;
    padding: 10px;
    width: 314px;
    border: 0 none;
    background: #ffffff;
    line-height: 20px;
    font-size: 14px;
}
.registerForm > li input[readonly]{
    background: #bbbbbb;
}

.login-form li .code ,
.registerForm li .code{
    display: inline-block;
    vertical-align: top;
    height: 40px;
    width: 80px;
    margin-left: 40px;
    position: absolute;
    top: 0;
    right: 4px;
}

.login-form li .code>div ,
.registerForm li .code>div{
    width: 100%;
    height: 100%;
    display: table;
    vertical-align: middle;
    text-align: center;
}

.login-form li .code>div>div,
.registerForm li .code>div>div {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}

.login-form li .code>div>div img,
.registerForm li .code>div>div img {
    width: 80px;
}
  </style>
</head>

<body data-type="login"  class="theme-white">
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">
                </div>
     <form  name="Form" class="am-form login-form form-ajax form-horizontal" action="<?php echo $this->dir ?>login/sigin" method="post" autocomplete="off">
                                   <div class="am-form-group">
                        <input type="text" class="tpl-form-input" id="username"   name="username" placeholder="请输入账号"  required>
                    </div>

                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input" name="password" id="password"  placeholder="请输入密码"  required>

                    </div>

  <ul class="login-form">
							<li class="f-pr">	
								 
									<input   type="text" size="10" name="chkcode"  class="vcode" autocomplete="off" maxlength="5" placeholder="验证码" required>
							
							  <div class="code">
                                 <div>
                                     <div>  <img src="/chkcode" title="点击刷新验证码" onclick="javascript:this.src=this.src+'?t=new Date().getTime()'">  </div>
                                 </div>
                             </div>
                                      
									
		</li> </ul> 
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox" checked="checked">
                        <label for="remember-me">
                        记住密码
                         </label>
                      <a href="/" class="home_btn" style="float:right">返回<?php echo $this->config['sitename']?>平台首页</a>

                    </div>







                    <div class="am-form-group">

                        

                        <input class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn" type="submit" name="submit"  value="登 陆">

                    </div>
                </form>
				<div>&#25042;&#20154;&#28304;&#30721;&#119;&#119;&#119;&#46;&#108;&#97;&#110;&#114;&#101;&#110;&#122;&#104;&#105;&#106;&#105;&#97;&#46;&#99;&#111;&#109;&#32;&#20840;&#31449;&#36164;&#28304;&#50;&#48;&#22359;&#20219;&#24847;&#19979;&#36733;</div>
            </div>
        </div>
    </div>

</body>

</html>