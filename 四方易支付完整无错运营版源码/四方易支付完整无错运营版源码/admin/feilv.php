<?php
/**
 * 商户列表
**/
include("../includes/common.php");
$title='费率设置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include 'nav.php';
?>
<?php 
if(isset($_POST['submit'])) {
    foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into zz_pay_config set `k`='{$k}',`v`='{$value}' on duplicate key update `v`='{$value}'");
    }
    showmsg('修改成功！',1);
    exit();
}

?>
<div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">费率设置</h3></div>
<div class="panel-body">
  <form method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">支付宝:</label>
	  <div class="col-sm-10">
              <input type="text" name="alirate" value="<?php echo $conf['alirate']; ?>" class="form-control"/>
          </div>
</div>
<div class="form-group">
	  <label class="col-sm-2 control-label">微信:</label>
	  <div class="col-sm-10">
              <input type="text" name="wxrate" value="<?php echo $conf['wxrate']; ?>" class="form-control"/>
          </div>
</div>
         <div class="form-group">
	  <label class="col-sm-2 control-label">QQ:</label>
	  <div class="col-sm-10">
              <input type="text" name="qqrate" value="<?php echo $conf['qqrate']; ?>" class="form-control"/>
          </div>
	</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
</div>
  </div>