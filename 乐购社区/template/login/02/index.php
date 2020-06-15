 
<?
 	if ($_SESSION['member_name']!='')
	{
	header('location: /index/home/order/id/'.$_GET['id'].'.html');
}
$ll='true';
  ?> 

      <html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>用户登录 - <?=$site_name?></title>
    <link href="/template/login/<?=$site_moban3?>/assect/css/boot.css" rel="stylesheet">
        <link href="/template/login/<?=$site_moban3?>/assect/css/layui.css" rel="stylesheet">
<link href="/template/login/<?=$site_moban3?>/assect/css/blobad.css" rel="stylesheet">
<script src="/template/login/<?=$site_moban3?>/assect/js/jquerimid.js"></script>
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
 </head>
<body style="background: url(<?=$site_bj?>) fixed;" class="">
 <nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
<span class="sr-only">切换导航</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
  
</li>
</ul>
</div>
</div>
</nav>
    <form method="post" id="loginForm">
<div class="container"> 
  
<div class="col-sm-10 center-block" style="float: none;">
     
	<div class="form-group" id="shopinfo" style="">
			<div class="panel panel-info">
				<div class="panel-heading text-center panel-headcolor-pink" id="panel-heading">
					<font color="#fff"><div id="selected">登录 <a class="btn btn-success btn-xs pull-right" href="/reg.php">用户注册</a></div></font>
				</div>
               <div class="tab-pane fade in active" id="user_login_form">
                                <form method="post" id="loginForm">
                                            <form method="post" id="loginForm">
                                                                <input name="act" type="hidden" value="login">
			<div class="panel-body">
			  <hr class="layui-bg-green">
			 
			<div class="layui-form layui-form-pane">
				<div class="layui-form-item">
				<label class="layui-form-label">登录账号</label>
				<div class="layui-input-block">
				<input type="text" name="m_name" id="m_name" class="layui-input"  >
				</div>
				</div>
			</div>
			
					<div class="layui-form layui-form-pane">
				<div class="layui-form-item">
				<label class="layui-form-label">登录密码</label>
				<div class="layui-input-block">
				<input type="password" name="m_password" id="m_password"   class="layui-input"  >
				</div>
				</div>
			</div>

			 
			 
			 
			<input name="按钮" type="button" class="layui-btn layui-btn-normal btn-block" id="login_btn" value="立即登录">
			
			
				<a href="/"><div class="layui-form-mid layui-word-aux"  style="width:100%"><div class="layui-btn layui-btn-danger onclick"   style="width:100%">QQ一键登录</div></div></a>
 
			</div>
			</div>
</div>
 </form>
     <link href="/template/login/02/assect/css/toastr.min.css" rel="stylesheet">
<script src="/template/login/02/assect/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/template/login/02/assect/js/toastr.min.js"></script>
 <script type="text/javascript">      
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
 