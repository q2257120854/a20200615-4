<?php
$title='后台管理';
include 'head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$count1=$DB->count("SELECT count(*) from moyu_dl WHERE 1");
$count2=$DB->count("select count(*) from moyu_dl where dl_sta <=0");
$mysqlversion=$DB->count("select VERSION()");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">授权平台首页</h3></div>
          <ul class="list-group">
<img alt="image" class="b b-3x b-white" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['zzqq']; ?>&amp;spec=100"alt="Avatar" width="60" height="60" style="border:1px solid #FFF;-moz-box-shadow:0 0 3px #AAA;-webkit-box-shadow:0 0 3px #AAA;border-radius: 50%;box-shadow:0 0 3px #AAA;padding:3px;margin-right: 3px;margin-left: 6px;">&nbsp;&nbsp;<font color="black"><a href="./set.php">[修改信息]</a></li>
            <li class="list-group-item"><span class="icon-bar-chart"></span> <b>数据统计：</b> <?php echo $count1?></li>
            <li class="list-group-item"><span class="icon-bar-chart"></span> <b>没开通权限：</b> <?php echo $count2?></li>
            <li class="list-group-item"><span class="icon-user"></span> <b>用户账号：</b> <?php echo $conf['admin_user']?></li>
            <li class="list-group-item"><span class="icon-user"></span> <b>用户权限：</b>最高管理员</li>
            <li class="list-group-item"><span class="icon-reorder tooltips"></span> <b>功能菜单：</b> 
            <a href="./dllist.php" class="btn btn-xs btn-success">代理管理</a>&nbsp;<a href="./set.php" class="btn btn-xs btn-warning">网站设置</a>
            </li>
          </ul>
      </div>
