<?php
/**
 * 系统设置
**/
$title='网站公告设置';
include("../includes/common.php");
include './head.php';
include 'nav.php';
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php 
if(isset($_POST['submit'])) {
        $value=$_POST['gg'];
        $DB->query("update `zz_pay_config` set `v` ='{$value}' where `k`='gg'");
        showmsg('修改成功！',1);
        exit();
}
?>
      
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">网站公告设置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">
	
        
       
	<div class="form-group">
	  <label class="col-sm-2 control-label">公告内容:</label>
	  <div class="col-sm-10">
              <textarea name="gg" rows="5" class="form-control"><?php echo $conf['gg']; ?></textarea>
          </div>
        
	</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div>

       

    </div>
  </div>