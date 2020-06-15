<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='插件下载';
include './head.php';
?>
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/footable-bootstrap/css/footable.standalone.min.css">

<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/ecommerce.css">
<link rel="stylesheet" href="assets/css/color_skins.css">

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
                    <li class="breadcrumb-item active">插件下载</li>
                </ul>                
            </div>
        </div>
    </div>
            <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card product_item_list">
                    <div class="body table-responsive">
                        <table class="table table-hover m-b-0 footable footable-1 footable-paging footable-paging-center breakpoint-lg" style="">
                            <thead>
                                <tr class="footable-header">
                                <th class="footable-sortable footable-first-visible" style="display: table-cell;">图片<span class="fooicon fooicon-sort"></span></th>
								<th class="footable-sortable" style="display: table-cell;">插件名称<span class="fooicon fooicon-sort"></span></th>
								<th data-breakpoints="sm xs" class="footable-sortable" style="display: table-cell;">说明<span class="fooicon fooicon-sort"></span></th>
								<th data-breakpoints="xs" class="footable-sortable" style="display: table-cell;">价格<span class="fooicon fooicon-sort"></span></th>
								<th data-breakpoints="xs md" class="footable-sortable" style="display: table-cell;">作者<span class="fooicon fooicon-sort"></span></th>
								<th data-breakpoints="sm xs md" class="footable-sortable footable-last-visible" style="display: table-cell;">选项<span class="fooicon fooicon-sort"></span>
								</th>
								</tr>
                            </thead>
                            <tbody>
							<tr>
                                <td class="footable-first-visible" style="display: table-cell;"><img src="assets/images/ecommerce/1.png" width="48" alt="Product img"></td>
								<td style="display: table-cell;" class=""><h5>暂无</h5></td>
								<td style="display: table-cell;"><span class="text-muted">暂无</span></td>
								<td style="display: table-cell;">免费</td>
								<td style="display: table-cell;"><span class="col-green">易支付</span></td>
								<td class="footable-last-visible" style="display: table-cell;">
                                    <a href="javascript:void(0);" class="btn btn-default waves-effect waves-float waves-green"><i class="zmdi zmdi-archive"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-default waves-effect waves-float waves-red"><i class="zmdi zmdi-delete"></i></a>
                                </td>
							</tr>
							
						</tbody>
                        <tfoot>
						</tfoot>
						</table>
                    </div>
                </div>
                <div class="card">
                    <div class="body">                            
                        <ul class="pagination pagination-primary m-b-0">
                            <li class="page-item"><a class="page-link" href="#"><i class="zmdi zmdi-arrow-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <!--<li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>-->
                            <li class="page-item"><a class="page-link" href="#"><i class="zmdi zmdi-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include 'foot.php';?>
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/footable.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/js/pages/tables/footable.js"></script><!-- Custom Js --> 

   