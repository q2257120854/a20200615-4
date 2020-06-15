 
<?
 	if ($_SESSION['member_name']!='')
	{
	header('location: /index/home/order/id/'.$_GET['id'].'.html');
}
$ll='true';
  

?> 
 <html  >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户登录-<?=$site_name?></title>
    <link href="/template/login/<?=$site_moban3?>/assets/common/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/login/<?=$site_moban3?>/assets/common/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/template/login/<?=$site_moban3?>/assets/index/default/style2.css">
    <link href="/template/login/<?=$site_moban3?>/assets/common/toastr/toastr.min.css" rel="stylesheet">
    <style>.web_title{background: #e38812;}.web_title h2{color: #80cce8 !important;}footer{background: #e38812;color: #c73284;}.alert-notice {background: rgba(255, 255, 255, 0.29);}
</style>
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
</head>
<body style="background-size:cover;background: #3197e0;background-image:url(<?=$site_bj?>)">
<!--顶部-->
<? require_once('header.php');
?>

<!--内容-->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
            <div class=" vertical-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="background: black">用户登录</h2>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active text-center" style="width: 50%;"><a href="#user_login_form"
                                                                                  data-toggle="tab" onClick="action='login';">帐号登录</a></li>
                            <li class="text-center" style="width: 50%;"><a href="#user_register_form" data-toggle="tab" onClick="action='reg';">注册帐号</a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding-top: 15px;">
                            <div class="tab-pane fade in active" id="user_login_form">
                                <form method="post" id="loginForm">
                                                                <input name="act" type="hidden" value="login">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">帐号</div>
                                            <input class="form-control" name="m_name" type="text" placeholder="输入你的用户帐号">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">密码</div>
                                            <input class="form-control" name="m_password" type="password"
                                                   placeholder="用户名的密码,必填">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <a class="btn" id="login_btn"     style="background:#3197e0;">登入<?=$site_name?></a>
                                    </div>
                                    <div class="form-group text-center"  style="display:none">
                                        <a href=""><img src="/images/qqLogin.png" width="48"></a>
                                        <a href=""><img src="/images/wxLogin.png" width="48"></a>
                                    </div>
                                    
                                </form>
                            </div>

                            <div class="tab-pane fade" id="user_register_form">
                                <form method="post" id="regForm">
                                <input name="act" type="hidden" value="reg">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">帐号</div>
                                            <input name="m_name" type="text" class="form-control" id="m_name" placeholder="输入你的用户帐号">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">密码</div>
                                            <input name="m_password" type="password" class="form-control" id="m_password"
                                                   placeholder="用户名的密码,必填">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Q号</div>
                                            <input name="m_qq" type="text" class="form-control user_register_input" id="m_qq"
                                                   placeholder="用于紧急联系,找回密码"
                                                   onkeyup="value=value.replace(/[^\d\/]/ig,'')">
                                        </div>
                                    </div>
                  
                                    <div class="form-group"    >
                                        <div class="input-group">
                                            <div class="input-group-addon">验证码</div>
                                            <input name="m_key"
                                                   type="text" class="form-control user_register_input" id="m_key" placeholder="输入验证码">
                                            <span class="input-group-addon" style="padding: 0px;">
                                            
                                            <img  title="点击刷新" src="/system/verifycode.php" align="absbottom" onClick="this.src='/system/verifycode.php?'+Math.random();" style="width: 100px;height: 32px;"   ></img>
<img
                                                   </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a  onclick="action='reg';" class="btn" id="reg_btn" style="background:#3197e0;">注册<?=$site_name?>账号</a>
                                         
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<? require_once('footer.php');
?>

 <script type="text/javascript">
    var action = 'login';
    $(document).ready(function () {
        $("#login_btn").click(function () {
            var data = $("#loginForm").serialize();
            $.klsf.ajax("/post/login.php?act=login", data, function (json) {
                if (json.code === 0) {
                    $.klsf.showMessage(json.message,'success');
                    setTimeout(function () {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
                    }, 1500);
                } else {
                    $.klsf.showMessage(json.message,'error');
                }
            });
        });
        $("#reg_btn").click(function () {
            var data = $("#regForm").serialize();
            $.klsf.ajax("/post/login.php?act=reg", data, function (json) {
                if (json.code === 0) {
                    $.klsf.showMessage(json.message,'success');
                    setTimeout(function () {
                        window.location.href = '/index/home/order/id/<?=$_GET['id']?>.html';
                    }, 1500);
                } else {
                    $(".code_img").click();
                    $.klsf.toastrError(json.message,'error');
                }
            });
        });
    });
    $.klsf.keyup(13, function () {
        $("#" + action + "_btn").click();
    })
</script>


</body>
</html>
 