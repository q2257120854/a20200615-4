 <?
 $nav = 'dj';
error_reporting(0);
error_reporting(E_ALL || ~E_NOTICE); 
header("Content-type:text/html;charset=utf-8");//字符编码设置  
$api='api.19sky.top';
    $url = $_SERVER['HTTP_HOST'];
    $user = $member_name;
    $password = "";

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>对接获取-<?=$site_name?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap core CSS -->
    <link href="http://assets.19sky.cn/member/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="http://assets.19sky.cn/member/css/font-awesome.min.css" rel="stylesheet">

    <!-- ionicons -->
    <link href="http://assets.19sky.cn/member/css/ionicons.min.css" rel="stylesheet">

    <!-- Morris -->
    <link href="http://assets.19sky.cn/member/css/morris.css" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="http://assets.19sky.cn/member/css/datepicker.css" rel="stylesheet"/>

    <!-- Animate -->
    <link href="http://assets.19sky.cn/member/css/animate.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="http://assets.19sky.cn/member/css/owl.carousel.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Simplify -->
    <link href="http://assets.19sky.cn/member/css/simplify.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/bootstrap-switch.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="http://assets.19sky.cn/member/css/toastr.min.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <!-- Jquery -->
    <script>
 function subForm()
 {
form1.action="";
 form1.submit();
 //form1为form的id
 }
 </script>
    <script src="http://assets.19sky.cn/member/js/jquery-1.11.1.min.js"></script>
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

    <? require_once('m_left.php');?>


 <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-6">
            <div class="smart-widget widget-blue">
                <div class="smart-widget-header">
                    对接获取
                    <span class="smart-widget-option">
                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="#" class="widget-refresh-option">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                    <div class="smart-widget-hidden-section">
                        <ul class="widget-color-list clearfix">
                            <li style="background-color:#20232b;" data-color="widget-dark"></li>
                            <li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
                            <li style="background-color:#23b7e5;" data-color="widget-blue"></li>
                            <li style="background-color:#2baab1;" data-color="widget-green"></li>
                            <li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
                            <li style="background-color:#fbc852;" data-color="widget-orange"></li>
                            <li style="background-color:#e36159;" data-color="widget-red"></li>
                            <li style="background-color:#7266ba;" data-color="widget-purple"></li>
                            <li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
                            <li style="background-color:#fff;" data-color="reset"></li>
                        </ul>
                    </div>
					<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $url = ($_POST["url"]);
    $user = ($_POST["user"]);
    $password = ($_POST["password"]);
    $yk = ($_POST["yk"]);
  echo " <div class='smart-widget-body'><iframe src='http://".$api."/sq/hq.php?url=".$url."&z=".$user."&m=".$password."&yk=".$yk."' name='myframe' width='100%' height='100%'></iframe>";
}else{ ?>
                    <div class="smart-widget-body">
                        <form class="form-horizontal" id="form1" name="form1" method="post">
                        <input name="act" type="hidden" value="edit">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">用户名</label>
                                <div class="col-lg-8">
                                    <input type="text" name="user" class="form-control" value="<?=$member_name?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">密码</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="password"value="<?=$member_password?>">
                                </div>
                            </div>
<input name="act" type="hidden" value="edit"><input type="hidden" name="yk" value="c"/><input type="hidden" name="url" value="<?=$url?>"/>
                        
                    </div>
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
            
                            <button type="submit" onclick="subForm()"  class="btn btn-purple" >提交
                            
                             <i  class="fa fa-angle-right"></i></button></form>
                        </div><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div><!-- /main-container -->

 <? require_once('m_footer.php');?>

 

  </body>
</html>
