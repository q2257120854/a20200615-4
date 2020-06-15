<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
		<link rel="stylesheet" href="__PUBLIC__/Manage/css/style.css">
		<script src="__PUBLIC__/Manage/js/index.js"></script>
		<title>【<?php
 $value = C("siteName"); $content = ''; if($value){ $content = htmlspecialchars_decode(htmlspecialchars_decode($value)); } echo $content; ?>】管理系统</title>
	</head>
	<body>
		<div class="head">
			<div class="head_right">
				<ul>
					<li>
						<span>欢迎你：<em><?php echo ($adminInfo["username"]); ?></em></span>
					</li>
					<li>
						<a href="javascript:if(confirm('您确定要退出登录吗？'))window.location.href='<?php echo U('Index/logout');?>';" class="zhuxi">注销</a>
					</li>
					<li>
						<a href="<?php echo U('Index/changepass');?>" target="iframe" class="xiugai">修改密码</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content">
			<div class="nav">
				<div class="logo">
					<a href="<?php echo U('Index/index');?>"><img src="__PUBLIC__/Manage/images/logo2.png"><img src="__PUBLIC__/Manage/images/logo1.png"></a>
				</div>
				<ul class="nav_list">
					<li class="yiji" data-title="工作台">
						<a href="javascript:;" data-url="<?php echo U('Index/main');?>" class="one">工作台</a>
					</li>

					
					<li class="yiji" data-title="用户列表">
						<a href="javascript:;" data-url="<?php echo U('User/index');?>" class="three">用户列表</a>
					</li>
					<li class="yiji" data-title="资料审核" style="display:none;">
						<a href="javascript:;" data-url="<?php echo U('Info/index');?>" class="">资料审核</a>
					</li>
					<li class="yiji" data-title="资料审核" style="display:none;">
						<a href="javascript:;" data-url="<?php echo U('Loan/pending');?>"" class="">借款管理</a>
					</li>

					<li class="yiji" data-title="借款管理">
						<a href="javascript:void(0)" class="two action">借款管理</a>
						<ul class="erji" style="display: block;">
							<li data-title="资料审核">
								<a href="javascript:;" data-url="<?php echo U('Info/index');?>">资料审核</a>
							</li>
							<li data-title="借款管理">
								<a href="javascript:;" data-url="<?php echo U('Loan/pending');?>">借款管理</a>
							</li>
							<li data-title="驳回借款" style="display:none;">
								<a href="javascript:;" data-url="<?php echo U('Loan/refuse');?>">已拒绝</a>
							</li>
							<li data-title="逾期借款" style="display:none;">
								<a href="javascript:;" data-url="<?php echo U('Loan/overdue');?>">已逾期</a>
							</li>
							<li data-title="通过" style="display:none;">
								<a href="javascript:;" data-url="<?php echo U('Loan/index');?>">通过</a>
							</li>
							<li data-title="回款借款" style="display:none;">
								<a href="javascript:;" data-url="<?php echo U('Loan/payoff');?>">已还清</a>
							</li>
							<li data-title="账单列表" style="display:none;">
								<a href="javascript:;" data-url="<?php echo U('Loan/bill');?>">账单表</a>
							</li>
						</ul>
					</li>
					<li class="yiji" data-title="系统设置">
						<a href="javascript:void(0)" class="seven action">系统设置</a>
						<ul class="erji">
                          <!--  <li data-title="基本设置">
								<a href="javascript:;" data-url="<?php echo U('Setting/banner');?>">轮播图设置</a>
							</li>-->					
							<li data-title="基本设置">
								<a href="javascript:;" data-url="<?php echo U('Setting/index');?>">基本设置</a>
							</li>
						<!--	<li data-title="API设置">
								<a href="javascript:;" data-url="<?php echo U('Setting/api');?>">API设置</a>
							</li>-->
							<li data-title="借款设置">
								<a href="javascript:;" data-url="<?php echo U('Setting/loan');?>">借款设置</a>
							</li>
							<li data-title="合同设置">
								<a href="javascript:;" data-url="<?php echo U('Setting/contract');?>">合同设置</a>
							</li>
						</ul>
					</li>

				</ul>
			</div>
			<div class="con">
				<iframe src="<?php echo U('Index/main');?>" id="iframe" onload="changeFrameHeight();" name="iframe"></iframe>
			</div>
		</div>
	</body>

</html>