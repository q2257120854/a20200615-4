<?php
include("../includes/common.php");
$title='代理首页';
include './head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$sites=$DB->count("SELECT count(*) from auth_site WHERE 1");
$numrows=$DB->count("SELECT count(*) from auth_daili");
$qq=daddslashes($_GET['qq']);
$sql=" `uid`='{$qq}'";
$gls=$DB->count("SELECT count(*) from auth_site WHERE{$sql} and daili='{$daili_id}'");

?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-6 col-lg-6">
            <div class="card bg-primary">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">我的授权</p>
                  <p class="h3 text-white m-b-0"><?php echo $gls ?>/个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-amazon-clouddrive fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-6">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">全站用户</p>
                  <p class="h3 text-white m-b-0"><?php echo $numrows ?>/个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-account fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>        
          </div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户资料</h4>
</div>
<div class="card-body">
<a href="javascript:void(0)" class="widget">
<div class="widget-content text-center">
<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $udata['qq']?>&amp;spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
<h2 class="widget-heading h3 text-muted"></h2>
</div>
<div class="widget-content themed-background-muted text-dark text-center">
</div>
<div class="widget-content">
<div class="row text-center">

<div class="col-xs-6">
<h3 class="widget-heading"><i class="fa fa-plus-square text-primary"></i> <br><small>正版用户</br><font><span class='label label-info'><?php echo $sites?>个</span></font></small></h3>
</div>

<div class="col-xs-6">
<?php if($udata['per_tj']==1){$p="<span class='label label-info'>授权商</span>";}elseif($udata['per_tj']==0){$p="<span class='label label-warning'>合作商</span>";} ?>         
<h3 class="widget-heading"><i class="fa fa-vimeo-square text-primary"></i><br><small>用户权限</br><font STYLE='color:green;'><?php echo $p; ?></font></small></h3>
</div>

</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>网站公告</h4></div>
<div class="card-body">
<div class="widget-content">
<ul class="media-list">
<?php echo $conf['gg']?>
</ul></div></div></div>
</div> 
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>