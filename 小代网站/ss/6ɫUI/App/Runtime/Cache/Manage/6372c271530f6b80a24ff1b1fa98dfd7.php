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
		<title>首页</title>
		<link rel="stylesheet" href="__PUBLIC__/Manage/css/index.css">
		<script src="__PUBLIC__/Manage/js/echarts-all.js"></script>
		<script>var apiUrl = "<?php echo U('Index/apidata');?>";</script>
		<script src="__PUBLIC__/Manage/js/echarts-demo.min.js"></script>
	</head>
	<body>
		<div class="wrapper-content">
			<div class="row">
				<!--数据统计-->
				<div class="tongji">
					<div class="tj_title">今日数据</div>
					<div class="tj_list">
						<ul>
							<li class="col-sm-3">
								<span>当天注册用户数</span>
								<div class="em">
									<?php echo (num2str($dayRegNum)); ?>
								</div>
							</li>
							<li class="col-sm-3">
								<span>借款申请订单数</span>
								<div class="em">
									<?php echo (num2str($dayLoanNum)); ?>
								</div>
							</li>
							<li class="col-sm-3">
								<span>当天放款订单数</span>
								<div class="em">
									<?php echo (num2str($dayAgreeOrderNum)); ?>
								</div>
							</li>
							<li class="col-sm-3">
								<span>当天放款金额（约）</span>
								<div class="em">
									<?php echo (num2str($dayAgreeOrderMoney)); ?>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!--数据统计-->
			</div>

			<!--统计图-->
			<div class="row row1">
				<div class="col-sm-6 row1">

					<!--地图统计图-->
					<div class="mapcon" id="echarts-map-chart" style="height:350px">
					</div>
					<!--地图统计图-->

					<!--环形统计图-->
					<div class="mapcon" id="echarts-funnel-chart" style="height:200px">
					</div>
					<!--环形统计图-->

				</div>

				<div class="col-sm-6 row2">
					<div class="tj_title">累计数据</div>
					<!--累计数据-->
					<div class="leiji">

						<!--累计放款-->
						<div class="credit">
							<div class="credit_left">
								<ul>
									<li>
										<h2>累计放款数</h2></li>
									<li><span><?php echo ($agreeOrderNum); ?> 单</span></li>
									<li><span><?php echo ($agreeOrderMoney); ?>万元</span></li>
								</ul>
							</div>
							<div class="credit_shape">
								<h3>放款</h3>
							</div>
						</div>
						<!--累计放款-->

						<!--待还款总额-->
						<div class="reimbursement">
							<div class="reimbursement_left">
								<ul>
									<li>
										<strong>待还款总额</strong>
										<em><?php echo ($waitOrderMoney); ?> 万</em>
									</li>
									<li>
										<strong>待还款单</strong>
										<em><?php echo ($waitOrderNum); ?> 单</em>
									</li>
								</ul>
							</div>

							<div class="reimbursement_shape">
								<h3>待还款</h3>
							</div>
						</div>
						<!--待还款总额-->

						<!--逾期-->
						<div class="overdue">
							<div class="overdue_left">
								<h2>逾期数据</h2>
								<ul>
									<li>
										<strong>逾期未收回</strong>
										<em><?php echo ($overdueOrderNum); ?> 单</em>
									</li>
									<li>
										<strong>逾期未收金额</strong>
										<em><?php echo ($overdueOrderMoney); ?> 元</em>
									</li>
								</ul>
							</div>

							<div class="overdue_shape">
								<h3>逾期</h3>
							</div>
						</div>
						<!--逾期-->
					</div>
					<!--累计数据-->

				</div>
			</div>
			<!--统计图-->
		</div>
	</body>

</html>