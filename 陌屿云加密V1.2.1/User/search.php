<?php
/**
 * 搜索授权
**/
include("../includes/common.php");
$title='搜索授权';
include './head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
if(isset($_POST['kw']) && isset($_POST['type'])){
	exit("<script language='javascript'>window.location.href='./list.php?type=".$_POST['type']."&kw=".urlencode(base64_encode($_POST['kw']))."&method=".$_POST['method']."';</script>");
}
?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>搜索授权</h4>
</div>
<div class="card-body">
<form action="./search.php" method="post" class="form-horizontal" role="form">
<div class="form-group">
<label>类别</label>
<select name="type" class="form-control">
<option value="0">全部</option>
<option value="1">ＱＱ</option>
<option value="2">域名</option>
<option value="3">授权码</option>
<option value="4">特征码</option>
</select>
</div>
<div class="form-group">
<label>内容</label>
<input type="text" name="kw" value="" class="form-control" autocomplete="off" required/>
</div>
<div class="form-group">
<select name="method" class="form-control">
<option value="0">精确搜索</option>
<option value="1">模糊搜索</option>
</select>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">添加授权</button>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>