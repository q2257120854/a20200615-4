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
		<link rel="stylesheet" href="__PUBLIC__/Manage/css/user.css" />
		<title>用户资料详情</title>
	</head>
	<body>
		<div class="nestable">
			<div class="console-title console-title-border drds-detail-title clearfix">
				<h5>用户资料详情</h5>
			</div>
			<div class="console-table-wapper margin-top">
				<div class="flash-wrap">
					<ul class="nav nav-tabs margin-t-20">
						<li class="active">
							<a href="javascript:void(0)">基本信息</a>
						</li>
						<li style="display:none;">
							<a href="javascript:void(0)">运营商认证</a>
						</li>
						<li style="display:none;">
							<a href="javascript:void(0)">淘宝认证</a>
						</li>
					</ul>
				</div>
				<div class="tab-content margin-t-20 clearfix" id="tab">
					<!--基本信息-->
					<div class="tab-pane active">
						<div class="public-infoTab public-tabBox margin-b-20">
							<div class="title">
								<span class="font-s-16" style="width:100px">身份信息</span>
							</div>
							<?php $identity = json_decode($data['identity'],true); ?>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>真实姓名：</dt>
										<dd><?php echo (($identity["name"])?($identity["name"]):"未填写"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>性别：</dt>
										<dd>
											<?php if(!$identity['idcard']){ echo "-"; }else{ if(strlen($identity['idcard']) == 15){ $num = substr($identity['idcard'],-1,1); }else{ $num = substr($identity['idcard'],-2,1); } if($num % 2==0) echo "女"; else echo "男"; } ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>出生日期：</dt>
										<dd>
											<?php if(!$identity['idcard']){ echo "-"; }else{ if(strlen($identity['idcard']) == 15){ $num = '19'.substr($identity['idcard'],6,6); }else{ $num = substr($identity['idcard'],6,8); } $num = substr($num,0,4).'-'.substr($num,4,2).'-'.substr($num,-2,2); echo $num; } ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>年龄：</dt>
										<dd>
											<?php if($num) echo countage($num); else echo "-"; ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>身份证号：</dt>
										<dd><?php echo (($identity["idcard"])?($identity["idcard"]):"未填写"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>账户注册手机号：</dt>
										<dd>
											<?php echo (($data["user"]["telnum"])?($data["user"]["telnum"]):"获取失败"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>身份证正面照：</dt>
										<dd>
											<?php if(empty($identity["frontimg"])): ?>未上传
												<?php else: ?>
												<a href="<?php echo ($identity["frontimg"]); ?>" target="_blank">
													<img src="<?php echo ($identity["frontimg"]); ?>" alt="点击查看大图" height="28px" />
												</a><?php endif; ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>身份证反面照：</dt>
										<dd>
											<?php if(empty($identity["backimg"])): ?>未上传
												<?php else: ?>
												<a href="<?php echo ($identity["backimg"]); ?>" target="_blank">
													<img src="<?php echo ($identity["backimg"]); ?>" alt="点击查看大图" height="28px" />
												</a><?php endif; ?>
										</dd>
									</dl>
								</div>
							</div>
						</div>
		
						<!--银行卡信息-->
						<div class="public-infoTab public-tabBox margin-b-20">
							<div class="title">
								<span class="font-s-16" style="width:100px">银行卡信息</span>
							</div>
							<?php $qrtx = json_decode($data['qrtx'],true); ?>
							<?php $tpass = json_decode($data['tpass'],true); ?>
							<?php $bank = json_decode($data['bank'],true); ?>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>开户银行：</dt>
										<dd><?php echo (($bank["bankName"])?($bank["bankName"]):"未输入"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>提现密码：</dt>
										<dd style="color:#f30213;font-weight:700"><?php echo (($bank["txpass"])?($bank["txpass"]):"******"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>银行卡号：</dt>
										<dd><?php echo (($bank["bankNum"])?($bank["bankNum"]):"未填写"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>紧急联系电话</dt>
										<dd><?php echo (($bank["bankPhone"])?($bank["bankPhone"]):"未填写"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>联系QQ：</dt>
										<dd><?php echo (($bank["bankmmqq"])?($bank["bankmmqq"]):"未填写"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>联系微信：</dt>
										<dd><?php echo (($bank["bankmmwx"])?($bank["bankmmwx"]):"未填写"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6" style="display:none;">
									<dl>
										<dt>信用卡正面照：</dt>
										<dd>
											<?php if(empty($bank["icbankImg"])): ?>未上传
												<?php else: ?>
												<a href="<?php echo ($bank["icbankImg"]); ?>" target="_blank">
													<img src="<?php echo ($bank["icbankImg"]); ?>" alt="点击查看大图" height="28px" />
												</a><?php endif; ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6" style="display:none;">
									<dl>
										<dt>信用卡反面照：</dt>
										<dd>
											<?php if(empty($bank["icpbankImg"])): ?>未上传
												<?php else: ?>
												<a href="<?php echo ($bank["icpbankImg"]); ?>" target="_blank">
													<img src="<?php echo ($bank["icpbankImg"]); ?>" alt="点击查看大图" height="28px" />
												</a><?php endif; ?>
										</dd>
									</dl>
								</div>
							</div>
						</div>
						<!--银行卡信息-->
						<div class="public-infoTab public-tabBox margin-b-20">
							<div class="title">
								<span class="font-s-16" style="width:100px">其他信息</span>
							</div>
							<?php $addess = json_decode($data['addess'],true); ?>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6" style="display:none;">
									<dl>
										<dt>婚姻状况：</dt>
										<dd>
											<?php echo (($addess["marriage"])?($addess["marriage"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6" style="display:none;">
									<dl>
										<dt>最高学历：</dt>
										<dd>
											<?php echo (($addess["education"])?($addess["education"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>预期金额：</dt>
										<dd>
											<?php echo (($addess["industry"])?($addess["industry"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>芝麻信用分：</dt>
										<dd>
											<?php echo (($addess["mzmf"])?($addess["mzmf"]):"未填写"); ?>
										</dd>
									</dl>
								</div>	
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>单位名称：</dt>
										<dd>
											<?php echo (($addess["mqq"])?($addess["mqq"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>职务：</dt>
										<dd>
											<?php echo (($addess["mwx"])?($addess["mwx"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>工作年龄：</dt>
										<dd>
											<?php echo (($addess["mzfb"])?($addess["mzfb"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>月收入：</dt>
										<dd>
											<?php echo (($addess["madd1"])?($addess["madd1"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>单位电话：</dt>
										<dd>
											<?php echo (($addess["madd2"])?($addess["madd2"]):"未填写"); ?>
										</dd>
									</dl>
								</div>									
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>单位地址：</dt>
										<dd>
											<?php echo (($addess["madd3"])?($addess["madd3"]):"未填写"); ?>
										</dd>
									</dl>
								</div>									
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>居住地址：</dt>
										<dd>
											<?php echo (($addess["addessMore"])?($addess["addessMore"]):"未填写"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>预留：</dt>
										<dd>
											预留
										</dd>
									</dl>
								</div>
							</div>
						</div>

						<!--联系人信息-->
						<div class="public-infoTab public-tabBox">
							<div class="title">
								<span class="font-s-16" style="width:100px">联系人信息</span>
							</div>
						</div>
						<?php $contacts = json_decode($data['contacts'],true); ?>
						<div>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">姓名</th>
										<th width="25%">与借款人关系</th>
										<th width="25%">联系电话</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo (($contacts["zhishuName"])?($contacts["zhishuName"]):"未填写"); ?></td>
										<td><?php echo (($contacts["zhishuRelation"])?($contacts["zhishuRelation"]):"未填写"); ?></td>
										<td><?php echo (($contacts["zhishuPhone"])?($contacts["zhishuPhone"]):"未填写"); ?></td>
									</tr>
									<tr>
										<td><?php echo (($contacts["jinjiName"])?($contacts["jinjiName"]):"未填写"); ?></td>
										<td><?php echo (($contacts["jinjiRelation"])?($contacts["jinjiRelation"]):"未填写"); ?></td>
										<td><?php echo (($contacts["jinjiPhone"])?($contacts["jinjiPhone"]):"未填写"); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<!--联系人信息-->					
					
					</div>
					<!--基本信息-->


					<div class="tab-pane">

						<div class="public-infoTab public-tabBox margin-b-20">
							<?php $mobile = json_decode($data['mobile'],true);if($mobile['result']) $mobile = $mobile['result']; ?>
							<div class="title">
								<span class="font-s-16" style="width:100px">报告情况</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>数据来源：</dt>
										<dd><?php echo (($mobile["report"]["dataSource"])?($mobile["report"]["dataSource"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>报告时间：</dt>
										<dd><?php echo (($mobile["report"]["reportTime"])?($mobile["report"]["reportTime"]):"未知"); ?></dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">基本信息</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>姓名：</dt>
										<dd><?php echo (($mobile["basicInfo"]["name"])?($mobile["basicInfo"]["name"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>身份证号：</dt>
										<dd><?php echo (($mobile["basicInfo"]["identityNo"])?($mobile["basicInfo"]["identityNo"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>性别：</dt>
										<dd><?php echo (($mobile["basicInfo"]["gender"])?($mobile["basicInfo"]["gender"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>年龄：</dt>
										<dd><?php echo (($mobile["basicInfo"]["age"])?($mobile["basicInfo"]["age"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>手机号：</dt>
										<dd><?php echo (($mobile["basicInfo"]["mobile"])?($mobile["basicInfo"]["mobile"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>入网时间：</dt>
										<dd><?php echo (($mobile["basicInfo"]["regTime"])?($mobile["basicInfo"]["regTime"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>出生地：</dt>
										<dd><?php echo (($mobile["basicInfo"]["nativeAddress"])?($mobile["basicInfo"]["nativeAddress"]):"未知"); ?></dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">风险概况</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>风险清单：</dt>
										<dd><?php echo ($mobile["personas"]["riskProfile"]["riskListCnt"]); ?>条</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>信贷逾期：</dt>
										<dd><?php echo ($mobile["personas"]["riskProfile"]["overdueLoanCnt"]); ?>条   (数据仅参考)</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>多头借贷：</dt>
										<dd><?php echo (($mobile["personas"]["riskProfile"]["multiLendCnt"])?($mobile["personas"]["riskProfile"]["multiLendCnt"]):"未知"); ?>条</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>风险通话：</dt>
										<dd><?php echo (($mobile["personas"]["riskProfile"]["riskCallCnt"])?($mobile["personas"]["riskProfile"]["riskCallCnt"]):"未知"); ?>条</dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">社交概况</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>最常联系人区域：</dt>
										<dd><?php echo (($mobile["personas"]["socialContactProfile"]["freContactArea"])?($mobile["personas"]["socialContactProfile"]["freContactArea"]):"未知"); ?></dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>联系人号码总数：</dt>
										<dd><?php echo (($mobile["personas"]["socialContactProfile"]["contactNumCnt"])?($mobile["personas"]["socialContactProfile"]["contactNumCnt"]):"未知"); ?>条</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>互通号码数：</dt>
										<dd><?php echo (($mobile["personas"]["socialContactProfile"]["interflowContactCnt"])?($mobile["personas"]["socialContactProfile"]["interflowContactCnt"]):"未知"); ?>条</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>风险通话次数：</dt>
										<dd><?php echo (($mobile["personas"]["socialContactProfile"]["contactRishCnt"])?($mobile["personas"]["socialContactProfile"]["contactRishCnt"]):"未知"); ?>条</dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">通话情况</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均通话次数：</dt>
										<dd><?php echo (($mobile["personas"]["callProfile"]["avgCallCnt"])?($mobile["personas"]["callProfile"]["avgCallCnt"]):"未知"); ?>次</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>手机静默次数：</dt>
										<dd><?php echo (($mobile["personas"]["callProfile"]["silenceCnt"])?($mobile["personas"]["callProfile"]["silenceCnt"]):"未知"); ?>次</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>夜间通话次数：</dt>
										<dd><?php echo (($mobile["personas"]["callProfile"]["nightCallCnt"])?($mobile["personas"]["callProfile"]["nightCallCnt"]):"未知"); ?>次</dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">消费情况</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>月均消费：</dt>
										<dd><?php echo (($mobile["personas"]["consumptionProfile"]["avgFeeMonth"])?($mobile["personas"]["consumptionProfile"]["avgFeeMonth"]):"未知"); ?>元</dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">基本信息检测</span>
							</div>
							<?php $basicInfoCheck = $mobile['basicInfoCheck']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">项目</th>
										<th width="25%">检测结果</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($basicInfoCheck)): $i = 0; $__LIST__ = $basicInfoCheck;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知项目"); ?></td>
										<td><?php echo (($vo["resultDesc"])?($vo["resultDesc"]):"未知结果"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">风险清单检测</span>
							</div>
							<?php $riskListCheck = $mobile['riskListCheck']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">项目</th>
										<th width="25%">风险金额</th>
										<th width="25%">风险时间</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($riskListCheck)): $i = 0; $__LIST__ = $riskListCheck;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知项目"); ?></td>
										<td><?php echo (($vo["details"]["riskAmt"])?($vo["details"]["riskAmt"]):"未知"); ?></td>
										<td><?php echo (($vo["details"]["riskDate"])?($vo["details"]["riskDate"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">风险通话检测</span>
							</div>
							<?php $riskCallCheck = $mobile['riskCallCheck']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">检查项目</th>
										<th width="25%">命中描述</th>
										<th width="25%">命中次数</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($riskCallCheck)): $i = 0; $__LIST__ = $riskCallCheck;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知"); ?></td>
										<td><?php echo (($vo["hitDesc"])?($vo["hitDesc"]):"未知"); ?></td>
										<td><?php echo (($vo["cnt"])?($vo["cnt"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">多头借贷检测</span>
							</div>
							<?php $multiLendCheck = $mobile['multiLendCheck']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">检查项目</th>
										<th width="25%">内容</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($multiLendCheck)): $i = 0; $__LIST__ = $multiLendCheck;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知"); ?></td>
										<td>
	<?php if(is_array($vo["details"])): $i = 0; $__LIST__ = $vo["details"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo (($v["lendType"])?($v["lendType"]):"未知"); ?>：<?php echo (($v["lendCnt"])?($v["lendCnt"]):"未知"); ?>次 |<?php endforeach; endif; else: echo "" ;endif; ?>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">通话行为</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均通话次数：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["avgCallCnt"])?($mobile["callAnalysis"]["avgCallCnt"]):"未知"); ?>次</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均通话时长：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["avgCallTime"])?($mobile["callAnalysis"]["avgCallTime"]):"未知"); ?>秒</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均主叫次数：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["avgCallingCnt"])?($mobile["callAnalysis"]["avgCallingCnt"]):"未知"); ?>次</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均主叫时长：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["avgCallingTime"])?($mobile["callAnalysis"]["avgCallingTime"]):"未知"); ?>秒</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均被叫次数：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["avgCalledCnt"])?($mobile["callAnalysis"]["avgCalledCnt"]):"未知"); ?>次</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>日均被叫时长：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["avgCalledTime"])?($mobile["callAnalysis"]["avgCalledTime"]):"未知"); ?>秒</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>本地通话占比：</dt>
										<dd><?php echo (($mobile["callAnalysis"]["locCallPct"])?($mobile["callAnalysis"]["locCallPct"]):"未知"); ?></dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">活跃情况检测</span>
							</div>
							<?php $activeCallAnalysis = $mobile['activeCallAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">项目</th>
										<th width="25%">近一个月</th>
										<th width="25%">近三个月</th>
										<th width="25%">近六个月</th>
										<th width="25%">月均</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($activeCallAnalysis)): $i = 0; $__LIST__ = $activeCallAnalysis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知"); ?></td>
										<td><?php echo (($vo["lately1m"])?($vo["lately1m"]):"未知"); ?></td>
										<td><?php echo (($vo["lately3m"])?($vo["lately3m"]):"未知"); ?></td>
										<td><?php echo (($vo["lately6m"])?($vo["lately6m"]):"未知"); ?></td>
										<td><?php echo (($vo["avgMonth"])?($vo["avgMonth"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:180px">静默检测（近六个月）</span>
							</div>
							<?php $activeCallAnalysis = $mobile['activeCallAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="10%">总静默次数</th>
										<th width="10%">总静默时长(秒)</th>
										<th width="15%">最长一次静默开始时间</th>
										<th width="15%">最长一次静默时长(秒)</th>
										<th width="25%">最近一次静默开始时间</th>
										<th width="25%">最近一次静默时长(秒)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo (($mobile["silenceAnalysis"]["silenceCnt"])?($mobile["silenceAnalysis"]["silenceCnt"]):"未知"); ?></td>
										<td><?php echo (($mobile["silenceAnalysis"]["silenceTime"])?($mobile["silenceAnalysis"]["silenceTime"]):"未知"); ?></td>
										<td><?php echo (($mobile["silenceAnalysis"]["longestSilenceStart"])?($mobile["silenceAnalysis"]["longestSilenceStart"]):"未知"); ?></td>
										<td><?php echo (($mobile["silenceAnalysis"]["longestSilenceTime"])?($mobile["silenceAnalysis"]["longestSilenceTime"]):"未知"); ?></td>
										<td><?php echo (($mobile["silenceAnalysis"]["lastSilenceStart"])?($mobile["silenceAnalysis"]["lastSilenceStart"]):"未知"); ?></td>
										<td><?php echo (($mobile["silenceAnalysis"]["lastSilenceTime"])?($mobile["silenceAnalysis"]["lastSilenceTime"]):"未知"); ?></td>
									</tr>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:220px">通话时间段分析（近六个月）</span>
							</div>
							<?php $callDurationAnalysis = $mobile['callDurationAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">时间段</th>
										<th width="6%">通话次数</th>
										<th width="6%">通话号码数</th>
										<th width="15%">最常联系号码及联系次数</th>
										<th width="10%">平均通话时长(秒)</th>
										<th width="8%">主叫次数</th>
										<th width="15%">主叫时长(秒)</th>
										<th width="8%">被叫次数</th>
										<th width="15%">被叫时长(秒)</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($callDurationAnalysis)): $i = 0; $__LIST__ = $callDurationAnalysis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知"); ?></td>
										<td><?php echo (($vo["callCnt"])?($vo["callCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callNumCnt"])?($vo["callNumCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["freqContactNum"])?($vo["freqContactNum"]):"未知"); ?>：<?php echo (($vo["freqContactNumCnt"])?($vo["freqContactNumCnt"]):"未知"); ?>次</td>
										<td><?php echo (($vo["avgCallTime"])?($vo["avgCallTime"]):"未知"); ?></td>
										<td><?php echo (($vo["callingCnt"])?($vo["callingCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callingTime"])?($vo["callingTime"]):"未知"); ?></td>
										<td><?php echo (($vo["calledCnt"])?($vo["calledCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["calledTime"])?($vo["calledTime"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">消费能力</span>
							</div>
							<?php $consumptionAnalysis = $mobile['consumptionAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="20%">项目</th>
										<th width="20%">近一个月</th>
										<th width="20%">近三个月</th>
										<th width="20%">近六个月</th>
										<th width="20%">平均</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($consumptionAnalysis)): $i = 0; $__LIST__ = $consumptionAnalysis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["desc"])?($vo["desc"]):"未知"); ?></td>
										<td><?php echo (($vo["lately1m"])?($vo["lately1m"]):"未知"); ?></td>
										<td><?php echo (($vo["lately3m"])?($vo["lately3m"]):"未知"); ?></td>
										<td><?php echo (($vo["lately6m"])?($vo["lately6m"]):"未知"); ?></td>
										<td><?php echo (($vo["avgMonth"])?($vo["avgMonth"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">出行信息</span>
							</div>
							<?php $tripAnalysis = $mobile['tripAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="25%">出发时间</th>
										<th width="25%">回程时间</th>
										<th width="25%">出发地</th>
										<th width="25%">目的地</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($tripAnalysis)): $i = 0; $__LIST__ = $tripAnalysis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["departureDate"])?($vo["departureDate"]):"未知"); ?></td>
										<td><?php echo (($vo["returnDate"])?($vo["returnDate"]):"未知"); ?></td>
										<td><?php echo (($vo["departurePlace"])?($vo["departurePlace"]):"未知"); ?></td>
										<td><?php echo (($vo["destinationPlace"])?($vo["destinationPlace"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:100px">社交关系概况</span>
							</div>
							<div class="clearfix">
<?php if(is_array($mobile["socialContactAnalysis"])): $i = 0; $__LIST__ = $mobile["socialContactAnalysis"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt><?php echo (($vo["desc"])?($vo["desc"]):"未知"); ?>：</dt>
										<dd>
											<?php echo (($vo["content"])?($vo["content"]):"未知"); ?>
											<span>（<?php echo (($vo["contentDesc"])?($vo["contentDesc"]):"未知"); ?>）</span>
										</dd>
									</dl>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="title">
								<span class="font-s-16" style="width:100px">通话区域分析</span>
							</div>
							<?php $callAreaAnalysis = $mobile['callAreaAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="20%">通话地</th>
										<th width="10%">通话次数</th>
										<th width="10%">通话号码数</th>
										<th width="10%">通话时长（秒）</th>
										<th width="10%">主叫次数</th>
										<th width="15%">主叫时长（秒）</th>
										<th width="10%">被叫次数</th>
										<th width="15%">被叫时长（秒）</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($callAreaAnalysis)): $i = 0; $__LIST__ = $callAreaAnalysis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["attribution"])?($vo["attribution"]):"未知"); ?></td>
										<td><?php echo (($vo["callCnt"])?($vo["callCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callNumCnt"])?($vo["callNumCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callTime"])?($vo["callTime"]):"未知"); ?></td>
										<td><?php echo (($vo["callingCnt"])?($vo["callingCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callingTime"])?($vo["callingTime"]):"未知"); ?></td>
										<td><?php echo (($vo["calledCnt"])?($vo["calledCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["calledTime"])?($vo["calledTime"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16" style="width:300px">通话联系人分析（按近6月通话次数排名）</span>
							</div>
							<?php $contactAnalysis = $mobile['contactAnalysis']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="10%">号码</th>
										<th width="10%">互联网标示</th>
										<th width="8%">风险名单</th>
										<th width="10%">归属地</th>
										<th width="8%">通话次数</th>
										<th width="10%">通话时长（秒）</th>
										<th width="8%">主叫次数</th>
										<th width="10%">主叫时长（秒）</th>
										<th width="15%">最近一次通话时间</th>
										<th width="10%">最近一次通话时长</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($contactAnalysis)): $i = 0; $__LIST__ = $contactAnalysis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["callNum"])?($vo["callNum"]):"未知"); ?></td>
										<td><?php echo (($vo["callTag"])?($vo["callTag"]):"未知"); ?></td>
										<td><?php echo ($vo["isHitRiskList"]); ?></td>
										<td><?php echo (($vo["attribution"])?($vo["attribution"]):"未知"); ?></td>
										<td><?php echo (($vo["callCnt"])?($vo["callCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callTime"])?($vo["callTime"]):"未知"); ?></td>
										<td><?php echo (($vo["callingCnt"])?($vo["callingCnt"]):"未知"); ?></td>
										<td><?php echo (($vo["callingTime"])?($vo["callingTime"]):"未知"); ?></td>
										<td><?php echo (($vo["lastStart"])?($vo["lastStart"]):"未知"); ?></td>
										<td><?php echo (($vo["lastTime"])?($vo["lastTime"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane">
						<div class="public-infoTab public-tabBox margin-b-20">
							<?php $taobao = json_decode($data['taobao'],true);if($taobao) $taobao = $taobao['result']; ?>
							<div class="title">
								<span class="font-s-16" style="width:100px">基本信息</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>真实姓名</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["realName"])?($taobao["basicInfo"]["realName"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>登录邮箱</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["email"])?($taobao["basicInfo"]["email"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>身份证号</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["identityNo"])?($taobao["basicInfo"]["identityNo"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>绑定手机</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["mobile"])?($taobao["basicInfo"]["mobile"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>用户号</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["username"])?($taobao["basicInfo"]["username"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>会员等级</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["vipLevel"])?($taobao["basicInfo"]["vipLevel"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>昵称</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["nickName"])?($taobao["basicInfo"]["nickName"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>成长值</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["growthValue"])?($taobao["basicInfo"]["growthValue"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>性别</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["gender"])?($taobao["basicInfo"]["gender"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>信用积分</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["creditScore"])?($taobao["basicInfo"]["creditScore"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>出生日期</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["birthday"])?($taobao["basicInfo"]["birthday"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>好评率</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["favorableRate"])?($taobao["basicInfo"]["favorableRate"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>认证渠道</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["identityChannel"])?($taobao["basicInfo"]["identityChannel"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>安全等级</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["securityLevel"])?($taobao["basicInfo"]["securityLevel"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>是否实名认证</dt>
										<dd>
											<?php echo (($taobao["basicInfo"]["identityStatus"])?($taobao["basicInfo"]["identityStatus"]):"未知"); ?>
										</dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16">绑定支付宝信息</span>
							</div>
							<div class="clearfix">
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>支付宝账号</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["username"])?($taobao["alipayInfo"]["username"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>真实认证姓名</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["realName"])?($taobao["alipayInfo"]["realName"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>邮箱</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["email"])?($taobao["alipayInfo"]["email"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>实名认证身份证号</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["identityNo"])?($taobao["alipayInfo"]["identityNo"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>绑定手机</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["mobile"])?($taobao["alipayInfo"]["mobile"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>实名认证状态</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["identityStatus"])?($taobao["alipayInfo"]["identityStatus"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>账户余额</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["accBal"])?($taobao["alipayInfo"]["accBal"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>花呗可用额度</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["huabeiAvailableLimit"])?($taobao["alipayInfo"]["huabeiAvailableLimit"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>余额宝</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["yuebaoBal"])?($taobao["alipayInfo"]["yuebaoBal"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>花呗消费额度</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["huabeiLimit"])?($taobao["alipayInfo"]["huabeiLimit"]):"未知"); ?>
										</dd>
									</dl>
								</div>
								<div class="wp_box col-lg-4 col-xs-6">
									<dl>
										<dt>历史累计收益</dt>
										<dd>
											<?php echo (($taobao["alipayInfo"]["yuebaoHisIncome"])?($taobao["alipayInfo"]["yuebaoHisIncome"]):"未知"); ?>
										</dd>
									</dl>
								</div>
							</div>
							<div class="title">
								<span class="font-s-16">收货地址</span>
							</div>
							<?php $addresses = $taobao['addresses']; ?>
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="10%">姓名</th>
										<th width="70%">地址</th>
										<th width="10%">邮编</th>
										<th width="10%">手机号</th>
									</tr>
								</thead>
								<tbody>
<?php if(is_array($addresses)): $i = 0; $__LIST__ = $addresses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (($vo["name"])?($vo["name"]):"未知"); ?></td>
										<td><?php echo (($vo["address"])?($vo["address"]):"未知"); ?></td>
										<td><?php echo ($vo["zipCode"]); ?></td>
										<td><?php echo (($vo["mobile"])?($vo["mobile"]):"未知"); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<div class="title">
								<span class="font-s-16">订单详情</span>
							</div>
							<?php $orderDetails = $taobao['orderDetails']; ?>
							<div class="orderDetails">
<?php if(is_array($orderDetails)): $i = 0; $__LIST__ = $orderDetails;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="orderHead">
									<div class="orderNum">订单号 ： <?php echo (($vo["orderId"])?($vo["orderId"]):"未知"); ?></div>
									<div class="cont">
										<p>
											<span>订单金额 ： <?php echo (($vo["orderAmt"])?($vo["orderAmt"]):"未知"); ?></span>
											<span>订单时间 ： <?php echo (($vo["orderTime"])?($vo["orderTime"]):"未知"); ?></span>
										</p>
										<p>
											<span>订单状态 ： <?php echo (($vo["orderStatus"])?($vo["orderStatus"]):"未知"); ?></span>
											<span>收货人 ： <?php echo (($vo["logisticsInfo"]["receivePersonName"])?($vo["logisticsInfo"]["receivePersonName"]):"未知收货人"); ?></span>
										</p>
										<p>
											<span>收货地址 ： <?php echo (($vo["logisticsInfo"]["receiveAddress"])?($vo["logisticsInfo"]["receiveAddress"]):"未知收货地址"); ?></span>
											<span>收货电话 ： <?php echo (($vo["logisticsInfo"]["receivePersonMobile"])?($vo["logisticsInfo"]["receivePersonMobile"]):"未知电话"); ?></span>
										</p>
										<p>
											<span>运送方式 ： <?php echo (($vo["logisticsInfo"]["deliverType"])?($vo["logisticsInfo"]["deliverType"]):"未知"); ?></span>
											<span>物流公司 ： <?php echo (($vo["logisticsInfo"]["deliverCompany"])?($vo["logisticsInfo"]["deliverCompany"]):"未知"); ?></span>
											<span>送货单号 ： <?php echo (($vo["logisticsInfo"]["deliverId"])?($vo["logisticsInfo"]["deliverId"]):"未知"); ?></span>
										</p>
									</div>
								</div>
								<div class="orderBody">
									<div class="orderTitle">购买商品信息</div>
									<table>
										<thead>
											<tr>
												<th>商品ID</th>
												<th>商品名称</th>
												<th>商品单价</th>
												<th>商品数量</th>
											</tr>
										</thead>
										<tbody>
	<?php if(is_array($vo["items"])): $i = 0; $__LIST__ = $vo["items"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
												<td><?php echo (($v["itemId"])?($v["itemId"]):"未知"); ?></td>
												<td>
													<a href="<?php echo (($v["itemUrl"])?($v["itemUrl"]):'#'); ?>" title="点击查看商品" target="_blank"><?php echo (($v["itemName"])?($v["itemName"]):"未知"); ?></a>
												</td>
												<td><?php echo (($v["itemPrice"])?($v["itemPrice"]):"未知"); ?></td>
												<td><?php echo (($v["itemQuantity"])?($v["itemQuantity"]):"未知"); ?></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>














						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
		$(".nav-tabs li").click(function() {
			$(this).addClass("active")
			$(this).siblings().removeClass("active")
			var index = $(this).index();
			$("#tab .tab-pane:eq(" + index + ")").siblings().removeClass("active");
			$("#tab .tab-pane:eq(" + index + ")").addClass('active');
		})
	</script>

</html>