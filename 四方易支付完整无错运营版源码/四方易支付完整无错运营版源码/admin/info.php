<?php
include("../includes/common.php");
$title='监控地址-卓林云支付';
include './head.php';
include 'nav.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

 <div class="container" style="padding-top:70px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h3 class="panel-title">订单监控地址</h3>
                </div>
                <div class="panel-body">
               <center>
                <h4>余额监控：<?php echo "http://".$_SERVER['HTTP_HOST']."/cron.php";?><a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/cron.php";?>" title="点击我执行" class="btn btn-xs btn-danger glyphicon glyphicon-eye-open"></a></h4>
                <h4>结算监控：<?php echo "http://".$_SERVER['HTTP_HOST']."/cron.php?do=settle";?><a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/cron.php?do=settle";?>" title="点击我执行" class="btn btn-xs btn-danger glyphicon glyphicon-eye-open"></a></h4><hr>
                <h4>如不准确请以真实地址为准！或者监控不懂的点击上面执行即可手动监控</h4>
                <hr>

               </center>
                </div>
            </div>
        </div>
    </div>
