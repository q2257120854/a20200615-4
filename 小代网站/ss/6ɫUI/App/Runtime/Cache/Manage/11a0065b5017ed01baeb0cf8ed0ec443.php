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
		<script type="text/javascript" src="__PUBLIC__/Manage/js/wangEditor/wangEditor.min.js"></script>
		<title>借款设置</title>
		<style type="text/css">
			.layer-anim{
				top:180px !important;
			}
		</style>
	</head>

	<body>
		<div class="nestable">
			<div class="console-title console-title-border drds-detail-title clearfix">
				<h5>借款设置</h5>
			</div>
			<div class="public-selectArea public-selectArea1 margin_10">
				<form action="<?php echo U('Setting/loan');?>" method="post">
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>放款类型：</dt>
								<dd>
									<label><input type="radio" name="Loan_TYPE" value="0" <?php if(C("Loan_TYPE")== 0): ?>checked<?php endif; ?> >单期（期限单位：天）</label>
									<label><input type="radio" name="Loan_TYPE" value="1" <?php if(C("Loan_TYPE")== 1): ?>checked<?php endif; ?> >分期（期限单位：月）</label>
								</dd>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>日息：</dt>
								<dd>
									<input type="text" name="Interest_D" value="<?php echo ((C("Interest_D"))?(C("Interest_D")):''); ?>" />
								</dd>
								<em class="tishi">放款类型为单期时生效</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>月息：</dt>
								<dd>
									<input type="text" name="Interest_M" value="<?php echo ((C("Interest_M"))?(C("Interest_M")):''); ?>" />
								</dd>
								<em class="tishi">放款类型为分期时生效</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>逾期费率：</dt>
								<dd>
									<input type="text" name="Overdue" value="<?php echo ((C("Overdue"))?(C("Overdue")):''); ?>" />
								</dd>
								<em class="tishi">逾期日开始按日计算</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>期限范围（单期）：</dt>
								<?php if(C('Deadline_D')) $str = implode(',',C('Deadline_D')); ?>
								<dd>
									<input type="text" name="Deadline_D" value="<?php echo (($str)?($str):''); ?>" />
								</dd>
								<em class="tishi">放款类型为单期时生效，以逗号隔开</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>期限范围（分期）：</dt>
								<?php if(C('Deadline_D')) $str = implode(',',C('Deadline_M')); ?>
								<dd>
									<input type="text" name="Deadline_M" value="<?php echo (($str)?($str):''); ?>" />
								</dd>
								<em class="tishi">放款类型为分期时生效，以逗号隔开</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>单次借款最低金额：</dt>
								<dd>
									<input type="text" name="Money_MIN" value="<?php echo ((C("Money_MIN"))?(C("Money_MIN")):'100'); ?>" />
								</dd>
								<em class="tishi">单位：元</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>单次借款最高金额：</dt>
								<dd>
									<input type="text" name="Money_MAX" value="<?php echo ((C("Money_MAX"))?(C("Money_MAX")):'1000'); ?>" />
								</dd>
								<em class="tishi">单位：元</em>
							</dl>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>借款金额选择跨度：</dt>
								<dd>
									<input type="text" name="Money_STEP" value="<?php echo ((C("Money_STEP"))?(C("Money_STEP")):'100'); ?>" />
								</dd>
								<em class="tishi">单位：元</em>
							</dl>
						</div>
					</div>
					
				</form>
				<div class="btnArea margin_20">
					<a href="javascript:;" class="btn btn-grayBg">
						<span class="public-label">提交</span>
					</a>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$(function(){
			$(".btnArea a").on('click',function(){
				cvphp.submit($("form"),function(data){
					if(data.status!=1){
						layer.msg(data.info);
					}else{
						layer.alert('保存成功');
					}
				});
			});
		});
	</script>
</html>