<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='使用说明';
include './head.php';
?>
<?php

?>
 <section class="content profile-page">
	<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2><?php echo $conf['web_name']?>
                <small>Welcome to Oreo</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i>主页</a></li>
                    <li class="breadcrumb-item active">使用说明</li>
                </ul>                
            </div>
        </div>
    </div>
    <div class="card">
    	<div class="header">
            <h2> <strong><trans><?php echo $conf['web_name']?></trans></strong><trans> 使用说明</trans><small><trans>一分钟读懂<?php echo $conf['web_name']?>交易规则</trans></small></h2>
                    </div>
<div class="body">
                        <div class="alert alert-success">
                            <strong><trans>#1</trans></strong><trans> 123</trans></div>
                        <div class="alert alert-info">
                            <strong><trans>#2</trans></strong><trans> 123</trans></div>
                        <div class="alert alert-warning">
                            <strong><trans>#3</trans></strong><trans> 123</trans></div>
                        <div class="alert alert-danger">
                            <strong><trans>#4</trans></strong><trans> 123</trans></div>
                    </div>


<?php include 'foot.php';?>