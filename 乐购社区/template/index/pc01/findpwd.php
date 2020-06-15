 
 <html  >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>找回密码 - <?=$site_name?></title>
    <meta name="keywords" content="找回密码,<?=$site_key?>"/>
    <meta name="description" content="找回密码<?=$site_des?>"/>
    <link href="/<?=$site_skin?>assets/common/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?=$site_skin?>assets/common/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/<?=$site_skin?>assets/index/default/style2.css">
    <link href="/<?=$site_skin?>assets/common/toastr/toastr.min.css" rel="stylesheet">
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
                        <h2 class="panel-title" style="background: #36C  ">找回密码</h2>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
 
                        <div class="tab-content" style="padding-top: 15px;">
                            <div class="tab-pane fade in active" id="user_login_form">
                                <form method="post" id="findpwdForm">
                                        <input name="act" type="hidden" value="login">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">帐号</div>
                                            <input class="form-control" name="m_name"   value="<?=$_SESSION['find_name']?>"  type="text" placeholder="输入你的用户帐号">
                                        </div>
                                    </div>
                                    <? if ($_SESSION['find_key']!='' && $_SESSION['find_key'] == $_GET['code'] && time()-$_SESSION['find_time']<300) {?>
                                    <? $getpwd='uppwd' ;?>
                                        <input name="find_key" type="hidden" value="<?=$_GET['code']?>">
                                       <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">新的密码</div>
                                            <input class="form-control" name="m_password"   value=""  type="password" placeholder="请重置您的密码">
                                        </div>
                                    </div>
                                    
                                        <div class="form-group">
                                        <a class="btn" id="findpwd_btn"     style="background:#3197e0;">确定重置</a>
                                    </div>
                                  
                                  
                                    <? }  else {?>
                                    <? $getpwd='findpwd' ;?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">验证码</div>
                                            <input name="m_key"
                                                   type="text" class="form-control user_register_input" id="m_key" placeholder="输入验证码">
                                            <span class="input-group-addon" style="padding: 0px;">
                                          
                                          
                                            <img  title="点击刷新" src="/system/verifycode.php" align="absbottom" onClick="this.src='/system/verifycode.php?'+Math.random();" style="width: 100px;height: 32px;"   ></img>
 
                                           </span>
 
                                        </div>
                                    </div>
                                    
                                        <div class="form-group">
                                        <a class="btn" id="findpwd_btn"     style="background:#3197e0;">下一步</a>
                                    </div>
                                  
                                    <? }?>
                                   
                                 
                                  
                                </form>
                            </div>
                            
                            
                           
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>提示</h4></div>
            </div>
            <div class="modal-body text-center">
                <h5 id="modal-msg"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"  onClick="window.open('//mail.qq.com')">登录邮箱</button>

                <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
            </div>
        </div>
    </div>
</div>


<? require_once('footer.php');
?>

 <script type="text/javascript">
    var action = 'login';
    $(document).ready(function () {
        $("#findpwd_btn").click(function () {
            var data = $("#findpwdForm").serialize();
            $.klsf.ajax("/ajax.php?act=<?=$getpwd?>", data, function (json) {
                if (json.code === 0) {
                    $("#modal-msg").html(json.message);
                    $("#modal-info").modal('show');
                } else {
                    $.klsf.showMessage(json.message, 'error');
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
 