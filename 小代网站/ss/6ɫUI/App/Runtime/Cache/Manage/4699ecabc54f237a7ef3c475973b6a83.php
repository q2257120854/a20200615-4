<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
<link rel="stylesheet" href="__PUBLIC__/Manage/css/bootstrap.css">
<link rel="stylesheet" href="__PUBLIC__/Manage/fonts/web-icons/web-icons.css">
<link rel="stylesheet" href="__PUBLIC__/Manage/fonts/font-awesome/font-awesome.css">
<script src="__PUBLIC__/Manage/js/jquery.js"></script>
<script src="__PUBLIC__/Manage/js/jquery.form.js"></script>
<script src="__PUBLIC__/Manage/js/bootstrap.js"></script>
<script src="__PUBLIC__/Manage/js/layer/layer.js"></script>
<script src="__PUBLIC__/Manage/js/cvphp.js"></script>
		<link rel="stylesheet" href="__PUBLIC__/Manage/css/table.css">
		<title>借款订单：<?php echo ($data["oid"]); ?>合同</title>
		<style>
			.title{
				font-size: 24px;
				text-align: center;
				background-color: #78ea81;
			    line-height: 48px;
			}
			.content{
				width: 90%;
				margin: 16px auto;
			}
			.nestable{
				margin: 20px !important;
				border: 1px solid #5961c7;
				padding: 0px !important;
			}
		</style>
	</head>
	<body>
		<div class="nestable">
			<div class="title">借款订单：<?php echo ($data["oid"]); ?>合同</div>
			<div class="public-selectArea public-selectArea1 margin_10 content">
				<?php echo ($tpl); ?>
			</div>
		</div>
	</body>
</html>