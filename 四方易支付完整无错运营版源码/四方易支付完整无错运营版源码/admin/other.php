<?php
/**
 * 系统设置
**/
$title='后台管理中心';
include("../includes/common.php");
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$my=isset($_GET['my'])?$_GET['my']:null;
include 'nav.php';
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php 
if(isset($_POST['submit'])) {
    foreach ($_POST as $k => $value) {
        if($k=='admin_pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into zz_pay_config set `k`='{$k}',`v`='{$value}' on duplicate key update `v`='{$value}'");
    }
    if(!empty($_POST['admin_pwd'])){
        $pwd =  md5($_POST['admin_pwd'].$password_hash."admin");
        $DB->query("update `zz_pay_config` set `v` ='{$pwd}' where `k`='admin_pwd'");
    }
    showmsg('修改成功！',1);
    exit();
}
if($my == "glj"){
?>
      
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">商品拦截配置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">
	
        
       
	<div class="form-group">
	  <label class="col-sm-2 control-label">拦截关键字:</label>
	  <div class="col-sm-10">

              <textarea name="goods_lj" rows="5" class="form-control"><?php echo $conf['goods_lj']; ?></textarea>
            <small>* 多个关键字用、分割 如：刷钻、黑号、AV</small>
          </div>
        
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">拦截提示:</label>
	  <div class="col-sm-10">
              <input type="text" name="goods_ljtis" value="<?php echo $conf['goods_ljtis']; ?>" class="form-control"/>
    
          </div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div>
        <?php
}elseif($my == "admin"){
    ?>
        <div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">管理员配置</h3></div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal" role="form">
	
        
       
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户名:</label>
	  <div class="col-sm-10">
              <input type="text" name="admin_user" required value="<?php echo $conf['admin_user']; ?>" class="form-control"/>
    
          </div>
	</div><br/>
        
	<div class="form-group">
	  <label class="col-sm-2 control-label">登陆密码:</label>
	  <div class="col-sm-10">
              <input type="text" name="admin_pwd" value="" class="form-control" required/>
    
          </div>
	</div><br/>
        
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存修改" class="btn btn-default form-control"/><br/>
	 </div>
	</div>
      
  </form>
  
</div>
</div>
        
   <?php
}
        ?>

    </div>
  </div>