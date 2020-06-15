<?php
error_reporting(0);
error_reporting(E_ALL || ~E_NOTICE); 
header("Content-type:text/html;charset=utf-8");//字符编码设置  
    $url = "127.0.0.1";
    $user = "123";
    $password = "123";
/**
 * 作者:QQ120182408
 * 版权:xy3
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $url = ($_POST["url"]);
    $user = ($_POST["user"]);
    $password = ($_POST["password"]);
    $yk = ($_POST["yk"]);
    echo "直接访问的链接是 ".$_SERVER['HTTP_HOST']."/api/hq.php?url=".$url."&z=".$user."&m=".$password."&yk=".$yk;
  echo "<iframe src='hq.php?url=".$url."&z=".$user."&m=".$password."&yk=".$yk."' name='myframe' width='100%' height='100%'></iframe>";
  exit;
}
?>
<html>
<head>
<title>方便的html</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h2>欢迎来到一键获取亿卡商品</h2>
 * 作者:xy3
 * 版权:QQ3301200869</h1>
<form name="" method="post">
    <label for="name">社区地址:</label></p>
    <input type="text" name="url" value="<?php echo $url?>"/></p>
    <label for="name">账号:</label></p>
    <input type="text" name="user" value="<?php echo $user?>"/></p>
    <label for="name">密码:</label></p>
    <input type="password" name="password" value="<?php echo $password?>"/></p>
    <label for="name">函数类型:</label></p>
    <input type="hidden" name="yk" value="c"/></p>
    <input type="submit" value="提交" name="idbtn"/></p>
</form>
</body>
</html>
