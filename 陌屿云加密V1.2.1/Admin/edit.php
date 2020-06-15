<?php
/**
 * 编辑授权
**/
include("../includes/common.php");
$title='编辑授权';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<main class="lyear-layout-content">
<div class="container-fluid">
<?php
if($_GET['my']=='edit') {
$id=intval($_GET['id']);
$row=$DB->get_row("SELECT * FROM auth_site WHERE id='{$id}' limit 1");
if($row=='')exit("<script language='javascript'>alert('授权平台不存在该记录！');history.go(-1);</script>");
if(isset($_POST['submit'])) {
	$uid=daddslashes($_POST['uid']);
	$url=daddslashes($_POST['url']);
	$authcode=daddslashes($_POST['authcode']);
	$sign=daddslashes($_POST['sign']);
	$active=intval($_POST['active']);
	$ip=daddslashes($_POST['ip']);
	if(strlen($authcode)!=32)showmsg('授权码格式错误！');
	else{
		$sql="update `auth_site` set `uid` ='{$uid}',`url` ='{$url}',`authcode` ='{$authcode}',`sign` ='{$sign}',`active` ='{$active}',`ip` ='{$ip}' where `id`='{$id}'";
		if($DB->query($sql))showmsg('修改成功！',1,$_POST['backurl']);
		else showmsg('修改失败！<br/>'.$DB->error(),4,$_POST['backurl']);
	}
}else{
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>编辑授权</h4>
</div>
<div class="card-body">
          <form action="./edit.php?my=edit&id=<?php echo $id; ?>" method="post" class="form-horizontal" role="form">


            <div class="form-group">
              <label class="col-sm-2 control-label">授权ＱＱ</label>
              <div class="col-sm-10"><input type="text" name="uid" value="<?php echo $row['uid']; ?>" class="form-control" required/></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">授权域名</label>
              <div class="col-sm-10"><input type="text" name="url" value="<?php echo $row['url']; ?>" class="form-control" required/></div>
            </div><br/>
			<?php if($conf['ipauth']==1){?>
			<div class="form-group">
              <label class="col-sm-2 control-label">授权IP</label>
              <div class="col-sm-10"><input type="text" name="ip" value="<?php echo $row['ip']; ?>" class="form-control" placeholder="留空则自动获取并记录"/></div>
            </div><br/>
			<?php }?>
			<div class="form-group">
              <label class="col-sm-2 control-label">授权码</label>
              <div class="col-sm-10"><input type="text" name="authcode" value="<?php echo $row['authcode']; ?>" class="form-control"/></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">特征码</label>
              <div class="col-sm-10"><input type="text" name="sign" value="<?php echo $row['sign']; ?>" class="form-control"/></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">授权状态</label>
              <div class="col-sm-10"><select name="active" class="form-control">
				<?php if($row['active']==1){?>
                <option value="1">1_激活</option>
                <option value="0">0_封禁</option>
				<?php }else{?>
				<option value="0">0_封禁</option>
				<option value="1">1_激活</option>
				<?php }?>
              </select></div>
            </div><br/>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
			  <a href="list.php">返回授权列表</a></div>
            </div>
          </form>
        </div>
      </div>
<?php
}
}elseif($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$row=$DB->get_row("SELECT * FROM auth_site WHERE id='{$id}' limit 1");
	$sql="DELETE FROM auth_site WHERE id='$id' limit 1";
	if($DB->query($sql)){showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);
		$city=get_ip_city($clientip);
		$DB->query("insert into `auth_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','删除站点','".$date."','".$city."','".$row['uid']."|".$row['url']."|".$row['authcode']."|".$row['sign']."')");
		if(!$_SESSION['del_times_'.date("Ymd")])$_SESSION['del_times_'.date("Ymd")]=0;
		else $_SESSION['del_times_'.date("Ymd")]++;
		if($_SESSION['del_times_'.date("Ymd")]>=30)
			$DB->query("update auth_daili set active='0' where uid='{$udata['uid']}'");
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);
}elseif($_GET['my']=='delpirate'){
	$url=daddslashes($_GET['url']);
	$sql="DELETE FROM auth_block WHERE url='$url' limit 1";
	if($DB->query($sql))showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);
}?>

    </div>
  </div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>