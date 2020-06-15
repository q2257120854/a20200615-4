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
		<title>合同设置</title>
		<style type="text/css">
			.layer-anim{
				top:180px !important;
			}
		</style>
	</head>

	<body>
		<div class="nestable">
			<div class="console-title console-title-border drds-detail-title clearfix">
				<h5>合同设置</h5>
			</div>
			<div class="public-selectArea public-selectArea1 margin_10">
				<form action="<?php echo U('Setting/contract');?>" method="post">
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dt>合同模板：</dt>
							<dl>
								<?php $contractTpl = empty(C('contractTpl'))?'':htmlspecialchars_decode(htmlspecialchars_decode(C('contractTpl'))); ?>
								<dd>
									<input type="hidden" name="contractTpl" value="" />
									<div class="editor" id="contractTpl" style="margin-left: 0px;"><?php echo (($contractTpl)?($contractTpl):''); ?></div>
								</dd>
							</dl>
							<em class="tishi">
								合同中可使用模板变量，变量使用时以“｛｝”包含即可自动生成<br />
								目前可使用变量：<br />
								借款人名称、借款人身份证号、借款人手机号、借款金额大写、借款金额小写、借款期限类型、
								借款利息、借款开始日、借款结束日、借款人用户名、收款银行账号、收款银行开户行、逾期利息、借款人签名、合同签订日期、借款人住所
								<br />
							</em>
						</div>
					</div>
					
					<div class="clearfix clearfix1">
						<div class="wp_box  col-xs-8">
							<dt>服务协议：</dt>
							<dl>
								<?php $agreementTpl = empty(C('agreementTpl'))?'':htmlspecialchars_decode(htmlspecialchars_decode(C('agreementTpl'))); ?>
								<dd>
									<input type="hidden" name="agreementTpl" value="" />
									<div class="editor" id="agreementTpl" style="margin-left: 0px;"><?php echo (($agreementTpl)?($agreementTpl):''); ?></div>
								</dd>
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
			var E = window.wangEditor;
			var editor1 = new E('#contractTpl');
			var editor2 = new E('#agreementTpl');
			editor1.create();
			editor2.create();
			$(".btnArea a").on('click',function(){
				$("input[name='contractTpl']").val(editor1.txt.html());
				$("input[name='agreementTpl']").val(editor2.txt.html());
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