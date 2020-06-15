<?php 

include('../system/inc.php');
include('./admin_config.php');
 
$act = $_POST['act'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['pass'];
$sj = date("Y-m-d H:i:s",intval(time()));   
$ip =xiaoyewl_ip();
  if ($zhu=='flash')
 { alert_url('/'); }
 function gonghuologin2($t0, $t1, $t2)
{
    $result = mysql_query('select *   from  ' . flag . 'user where name ="' . $t0 . '" and password  ="' . md5($t1) . '"  and zid = ' . $t2 . '   and gh = 1   ');
    if (!!($row = mysql_fetch_array($result))) {
		$_SESSION['gh_check'] = $t0;
        return 0;
    } else {
        return 1;
    }
}
 if($act){}

 if($_SESSION['admin_check'])alert_url('admin_index.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录-主站</title>
	<link rel="stylesheet" type="text/css" href="./xy/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./xy/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./xy/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="./xy/util.css">
	<link rel="stylesheet" type="text/css" href="./xy/main.css">
    <style type="text/css">
	.input101 {
  font-family: 'Microsoft Yahei';
  font-size: 16px;
  color: #333333;
  line-height: 1.5;
   display: block;
  width: 100%;
  height: 45px;
  background: transparent;
  padding: 0 7px 0 43px;
}
.label-input101 {
  font-family: 'Microsoft Yahei';
  font-size: 14px;
  color: #333333;
  line-height: 1.5;
  padding-left: 7px;
}

</style>
<link rel="stylesheet" href="./xy/layer.css" id="layuicss-layer"></head>

<body>

	<div class="limiter" id="vue">
		<div class="container-login100" style="background-image: url('http://assets.19sky.cn/assets/img/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form" name="form-login" id="form-login" method="post">
				<input name="act" type="hidden" value="login">

					<span class="login100-form-title p-b-49">登录</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate="请输入用户名">
						<span class="label-input100">用户名</span>
						<input name="username" type="text" class="input100" placeholder="请输入用户名" autocomplete="off">
						<span class="focus-input100" data-symbol=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="请输入密码">
						<span class="label-input100">密码</span>
						<input name="pass" type="password" class="input100" placeholder="请输入密码">
						<span class="focus-input100" data-symbol=""></span>
					</div>
                        <div style="height:7PX"></div>
                    <div class="wrap-input100 " data-validate="">
						<span class="label-input101">登录类型</span>
                         <select name="type" class="input101" style="margin-top:10PX">
                          <option value="0">站长</option>
                          <option value="1">管理员</option>
                          <option value="2">供应商</option>
                        </select>
 						<span class="focus-input100" style="margin-top:7PX" data-symbol=""></span>
					</div>
                    

				  <div class="text-right p-t-8 p-b-31">
						<a onclick="alert('请联系您的上级处理!');" href="javascript:">忘记密码？</a>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" onclick="login()" class="login100-form-btn">登 录</button>
						</div>
					</div>

					 
 
				 
				</form>
			</div>
		</div>
	</div>

	<script src="./xy/jquery-3.2.1.min.js"></script>
<script src="./xy/main(1).js"></script>
<script src="./xy/layer.js"></script>
<script>
 function login()
{
	
	   var vm = this;
        this.$post('ajax_login.php', new FormData(document.getElementById("form-login")))
          .then(function (data) {
            if (data.status === 0) 
			{
			 window.location.href = data.message;
				        } 
						else {
                 layer.alert(data.message);
         
            }
          });
}
  
</script>


 

</body><div id="translate-button" style="display: none;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABqlBMVEUAAABQksElnfxHgsVYm9NMlvE0QnEzRKcxRa8wQ68uQaoqPKQqOo8rPZFGXttLeP4aM1Zgs/tZp+QMDypOmM5Hi/gyd9Y5ZahJm/oaLEoSEzQTIHgUIXsUH1kRFBQPGS1ChuY2e9k/aJgKQ7xOpv83fN5etv8xSXFIcIk3nf8vXIsweugyffMYHDVcgv9EYMk2WnxZof8xcOE7ddgUU+Jhsv8wWIwtptI2d+gpaMEqbdE2WIkzdOY8gtknSIk8YMJCZspDZ8c/Y75DaLc2WJs7d9Q3V5kHAAAzX9ExW4oujudLgN85eN49f+g5eeQ4eeM3d+A5euI8hegrW7o2a9A+Z6gGBx0radAuWYFco/8nRHFmwv9Xtv9TqP9DhvdHjPpeq/9muP9ktvpjtvlhtPtfsfxgsf9gr/hzwf9Rr/9EjftNkvpOmf9OnP9Om/9QnP9QlftDivtFkv9ft/9XpP9w0f9Wnf9ftP9vyP9pv/9osv9w0v9irf9MnP9cuv9lt/9Mlv9XqP9Qn/9PoP9QoP9Onf9dt/9Cg/U/kP9u1v9OoP9hvf9qzP8AAADAaXBVAAAAW3RSTlMAbyaqrvQmICEiIiIiIiIQG+eDFsf9iJH4GRIVFRUVFLF+iwS7eFpjUiNZkWNMAhGSn0X1AbCAEEzlnWlM8oiGiIeGhoPJjhFaUSmIiYiIiIeHhoLHcASnWp5xRWw5awAAAAFiS0dEAIgFHUgAAAAJcEhZcwASBa4AEgWuAWmKs1MAAADGSURBVBjTY2AAAkYmBhTAHI3KZ4lhZWPn4OTi5uHl42dgEBCMjYtPSExKTklNS88QYmAQFsnMEs3Oyc3Lyy8oLBIDaREvlpCUkpaRlZNXKFEEG6JUqgwxTaVMFUiqqTNoaEIEtMq1gaROhS6Eq6fPYGAIpI0qjSECJqZmDOZA2qLKEuogq2prEGVTY2tn7+Do5OziWlvn5s7A4FHf0NjU3NLc2tbS3tHpycDg5e3j6+cfEBgUHNLVHRqG7KnwnghUX0ZGAQkARdEoBO6NYQwAAAAASUVORK5CYII="></div></html>