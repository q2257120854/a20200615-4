<?php
error_reporting(0);
error_reporting(E_ALL || ~E_NOTICE); 
header("Content-type:text/html;charset=utf-8");//字符编码设置  
    $url = $_SERVER['HTTP_HOST'];
    $user = $member_name;
    $password = $member_password;
/**
 * 作者:创梦
 * 版权:魔愿
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $url = ($_POST["url"]);
    $user = ($_POST["user"]);
    $password = ($_POST["password"]);
    $yk = ($_POST["yk"]);
    echo "直接访问的链接是 ".$_SERVER['HTTP_HOST']."/dj/hq.php?url=".$url."&z=".$user."&m=".$password."&yk=".$yk;
  echo "<iframe src='hq.php?url=".$url."&z=".$user."&m=".$password."&yk=".$yk."' name='myframe' width='100%' height='100%'></iframe>";
  exit;
}
?>
<html>
<head>
<title>一键获取社区商品</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<center><h1>欢迎来到一键获取社区商品</h1>
 * 作者:魔愿
 * 版权:创梦</h1></center>
  <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="panel panel-primary">
<div class="panel-heading">
<font color='orange'>
<form name="" method="post">
    <p><label for="name">社区地址:</label></p>
    <input type="text" name="url" value="<?php echo $url?>"/>
    <p><label for="name">账号:</label></p>
    <input type="text" name="user" value="<?php echo $user?>"/>
    <p><label for="name">密码:</label></p>
    <input type="password" name="password" value="<?php echo $password?>"/>

    <input type="hidden" name="yk" value="c"/>
    <p><input type="submit" value="提交" name="idbtn"/></p>
    </font>
</form>
</div>
</div>
</div>
</body>
</html>
