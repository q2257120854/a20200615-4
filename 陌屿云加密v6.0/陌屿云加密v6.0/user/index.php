<?php
/*
Auat：陌屿
QQ：2763994904
Grup：777824195
Name：陌屿云加密系统
*/
$title='代理后台';
include './head.php';
include("../includes/common.php");
$rs=$DB->query("select * from moyu_dl where dl_user = '{$_SESSION['user']}'");
$count1=$DB->count("SELECT count(*) from moyu_dl WHERE 1");
$row = $DB->fetch($rs);
?>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-6">
<div class="widget">
<div class="widget-content border-bottom">
网站公告
</div>
<div class="widget-content border-bottom">
<ul class="fa-ul">
<?php
$rs=$DB->query("SELECT  *  FROM moyu_notice WHERE 1 order by id asc");
while($res = $DB->fetch($rs))
{
echo '<li style="line-height: 25px;"><i class="fa fa-caret-right fa-li"></i>'.$res['center'].'<small> - '.$res['date'].'</small>';
}
?>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12 col-lg-6">
<!-- Partial Responsive Block -->
<div class="widget" style="min-height: 337px;">
<!-- Partial Responsive Title -->
<div class="widget-content border-bottom text-dark">
<span class="pull-right text-muted"></span>
任务与活动列表
</div>
<!-- END Partial Responsive Title -->

<!-- Partial Responsive Content -->
<table class="table table-striped table-bordered table-vcenter">
<thead>
<tr>
<th>加密价格介绍</th>
<th class="hidden-sm hidden-xs">状态</th>
<th class="text-center">操作</th>
</tr>
</thead>
<tbody>
<tr>
<td>单个加密文件（1）陌屿币</td>
<td class="hidden-sm hidden-xs"><label class="label label-warning">运行中</label></td>
<td class="text-center">
<a href="./phpjm.php" onclick="swal('正在跳转');" class="btn btn-xs btn-info" target="_blank">点击加密</a>
</td>
</tr>
<tr>
<td>批量加密文件（5）陌屿币</td>
<td class="hidden-sm hidden-xs"><label class="label label-warning">运行中</label></td>
<td class="text-center">
<a href="./jiami.php" onclick="swal('正在跳转');" class="btn btn-xs btn-info" target="_blank">点击加密</a>
</td>
</tr>
</tbody>
</table>
<!-- END Partial Responsive Content -->
</div>
<!-- END Partial Responsive Block -->
</div>

<div class="col-sm-12 col-md-12 col-lg-6">
<!-- Stats User Widget -->
<div class="widget">
<div class="widget-content border-bottom text-dark">
<span class="pull-right text-muted">绑定QQ：<?php echo $_SESSION['qq']?></span><?php echo $_SESSION['user']?> [<small>加密余额：<?php echo $row['dl_money']?></small>]</div>
<div class="widget-content border-bottom text-center">
<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $_SESSION['qq']?>&spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
<h2 class="widget-heading h3 text-dark">
加密代理</font></li>
</h2>
</div>
<div class="widget-content widget-content-full-top-bottom">
<div class="row text-center">
<div class="col-xs-4 push-inner-top-bottom border-right">
<h3 class="widget-heading"><i class="fa fa-cloud text-dark push-bit"></i> <br>
<small><?php ?></small>
</h3>
</div>
<div class="col-xs-4 push-inner-top-bottom border-right">
<h3 class="widget-heading"><i class="fa fa-star text-dark push-bit"></i> <br>
<small><?php ?></small>
</h3>
</div>
<div class="col-xs-4 push-inner-top-bottom">
<h3 class="widget-heading"><i class="fa fa-child text-dark push-bit"></i> <br>
<small><?php ?></small>
</h3>
</div>
</div>
</div>
</div>
<!-- END Stats User Widget -->
</div>
<div class="col-sm-12">
<!-- First Row -->
<div class="row">
<!-- Simple Stats Widgets -->
<div class="col-sm-6 col-lg-3">
<a href="javascript:void(0)" class="widget">
<div class="widget-content widget-content-mini text-right clearfix">
<div class="widget-icon pull-left themed-background">
<i class="fa fa-users text-light-op"></i>
</div>
<h2 class="widget-heading h3">
<strong><span><?php echo $count1 ?>人</span></strong>
</h2>
<span class="text-muted">本站用户数</span>
</div>
</a>
</div>
<div class="col-sm-6 col-lg-3">
<a href="javascript:void(0)" class="widget">
<div class="widget-content widget-content-mini text-right clearfix">
<div class="widget-icon pull-left themed-background-success">
<i class="fa fa-cloud text-light-op"></i>
</div>
<h2 class="widget-heading h3 text-success">
<strong><span><?php if( $_SESSION['zt'] == 0){ echo "<font style='color: red'>未激活</font>"; }elseif($_SESSION['zt'] == -1){ echo "<font style='color: red'>账号已被禁封</font>"; }else{ echo "<font style='color: green;'>已激活</font>"; }?></span></strong>
</h2>
<span class="text-muted">账号状态</span>
</div>
</a>
</div>
<!-- END Simple Stats Widgets -->
</div>
<!-- END First Row -->
</div>
</div>
<?php include './foot.php';?>