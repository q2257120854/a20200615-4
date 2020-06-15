<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
		<title>修改密码</title>
	</head>
	<body>
		<div class="nestable">
			<div class="console-title console-title-border drds-detail-title clearfix">
				<h5>修改密码</h5></div>
			<div class="public-btnArea public-btnArea1">
				<a href="javascript:window.history.go(-1);;" class="btn btn-grayBg">
					<span class="public-label">返回</span>
				</a>
			</div>
			<div class="public-selectArea public-selectArea1">
				<form action="<?php echo U('Index/changepass');?>" method="post">
					<div class="clearfix">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>原密码：</dt>
								<dd>
									<input type="password" name="oldpass">
								</dd>
							</dl>
						</div>
					</div>
					<div class="clearfix">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>新密码：</dt>
								<dd>
									<input type="password" name="password">
								</dd>
							</dl>
						</div>
					</div>
					<div class="clearfix">
						<div class="wp_box  col-xs-8">
							<dl>
								<dt>确认新密码：</dt>
								<dd>
									<input type="password" name="repass">
								</dd>
							</dl>
						</div>
					</div>
					<div class="btnArea">
						<a href="javascript:;" class="btn btn-sereachBg" id="submitBtn">
							<span class="public-label">提交</span>
						</a>
					</div>
				</form>
			</div>
		</div>
	</body>
	<script>
		$("#submitBtn").on('click',function(){
			cvphp.submit($("form"),function(data){
				if(data.status != 1){
					layer.msg(data.info);
				}else{
					layer.msg("密码修改成功,请牢记新密码");
					$("form").reset();
				}
			})
		});
	</script>
</html>