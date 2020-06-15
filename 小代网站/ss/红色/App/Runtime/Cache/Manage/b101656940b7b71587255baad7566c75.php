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
		<title>用户列表</title>
		<style>
			.redText{
				color: red;font-size: 20px;
			}
		</style>
	</head>
	<body>
		<div class="nestable">
			<div class="console-title console-title-border drds-detail-title clearfix">
				<h5>用户列表</h5>
			</div>
			<form method="get" id="seachForm">
				<input type="hidden" name="m" value="User" />
				<input type="hidden" name="a" value="index" />
				<div class="public-selectArea">
					<div class="clearfix">
						<div class="wp_box col-xs-6">
							<dl>
								<dt>手机号：</dt>
								<dd>
									<input type="text" name="s-username" value="<?php echo ($_GET['s-username']); ?>">
								</dd>
							</dl>
						</div>
						<div class="wp_box col-xs-6">
							<dl>
								<dt>注册时间：</dt>
								<dd>
									<input type="date" class="time-inp" name="s-timeStart" value="<?php echo ($_GET['s-timeStart']); ?>" />
								</dd>
								<dd>
									<input type="date" class="time-inp" name="s-timeEnd" value="<?php echo ($_GET['s-timeEnd']); ?>" />
								</dd>
							</dl>
						</div>
					</div>
					<div class="btnArea">
						<a href='javascript:$("#seachForm").submit();' class="btn btn-sereachBg">
							<i class="glyphicon glyphicon-search public-ico"></i>
							<span class="public-label">查询</span>
						</a>
					</div>
				</div>
			</form>
			<div class="scroll-bar-table">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>用户ID</th>
							<th>用户名/手机号</th>
							<th>名称</th>
							<th>额度</th>
							<th>状态</th>
							<th>注册时间</th>
							<th>借款统计</th>
							<th>账单统计</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
<?php $status=array('禁用','启用'); ?>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="list-<?php echo ($vo["id"]); ?>">
							<td align="center"><?php echo ($vo["id"]); ?></td>
							<td><?php echo ($vo["telnum"]); ?></td>
							<td><?php echo ($vo["name"]); ?></td>
							<td><span style="color: red;"><?php echo ($vo["quota"]); ?></span> 元</td>
							<td class="td-status">
								<a href="javascript:resetStatus('<?php echo ($vo["id"]); ?>','<?php echo ($vo["status"]); ?>');"><?php echo ($status[$vo['status']]); ?></a>
							</td>
							<td><?php echo (date("Y-m-d H:i:s",$vo["reg_time"])); ?></td>
							<td>
								成功借款<span class="redText"><?php echo ($vo["succLoan"]); ?></span>次
							</td>
							<td>
								累计借款<span class="redText"><?php echo ($vo["loanMoney"]); ?></span>元
							</td>
							<td class="text-left">
								<a href="<?php echo U('Info/view',array('uid'=>$vo['id']));?>" target="_blank">查看资料</a>｜ 
								<a href="javascript:resetQuota('<?php echo ($vo["id"]); ?>','<?php echo ($vo["telnum"]); ?>');">调整额度</a>｜ 
								<a href="javascript:resetTel('<?php echo ($vo["id"]); ?>','<?php echo ($vo["telnum"]); ?>');" style="display:none;">修改手机号</a>  
								<a href="javascript:resetPass('<?php echo ($vo["id"]); ?>','<?php echo ($vo["telnum"]); ?>');">重置密码</a>｜ 
								<!--<a href="javascript:delUser('<?php echo ($vo["id"]); ?>','<?php echo ($vo["telnum"]); ?>');">删除会员</a>-->
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
			<div class="table-pagin-container">
				<div class="pull-right page-box">
					<?php echo ($page); ?>
				</div>
			</div>
		</div>
	</body>
	<script>
		//账户启用禁用
		function resetStatus(id,status){
			if(status == 1) status = 0;
			else status = 1;
			cvphp.post(
				"<?php echo U('User/resetStatus');?>",
				{
					id:id,
					status:status
				},
				function(data){
					if(data.status!=1){
						layer.msg(data.info);
					}else{
						var html;
						if(status == 1){
							layer.msg("账户已启用");
							html = '<a href="javascript:resetStatus('+"'"+id+"','1'"+');">启用</a>';
						}else{
							layer.msg("账户已禁用");
							html = '<a href="javascript:resetStatus('+"'"+id+"','0'"+');">禁用</a>';
						}
						$("#list-"+id+" .td-status").html(html);
					}
				}
			);
		}
		//调整额度
		function resetQuota(id,name){
			layer.prompt(
				{
					title: '输入用户  ['+name+'] 的新额度',
					formType: 0
				},
				function(quota,index){
					cvphp.post(
						"<?php echo U('User/resetQuota');?>",
						{
							id:id,
							quota:quota
						},
						function(data){
							if(data.status!=1){
								layer.msg(data.info);
							}else{
								layer.close(index);
								layer.msg("用户资料已保存");
								setTimeout(function(){location.reload();},1000);
							}
						}
					);
				}
			);
		}
		//修改账户手机号
		function resetTel(id,name){
			layer.prompt(
				{
					title: '输入用户  ['+name+'] 的新手机号',
					formType: 0
				},
				function(tel,index){
					cvphp.post(
						"<?php echo U('User/resetTel');?>",
						{
							id:id,
							tel:tel
						},
						function(data){
							if(data.status!=1){
								layer.msg(data.info);
							}else{
								layer.close(index);
								layer.msg("用户资料已保存");
								setTimeout(function(){location.reload();},1000);
							}
						}
					);
				}
			);
		}
		//重置密码方法
		function resetPass(id,name){
			layer.confirm(
				'确认要重置用户[ '+name+' ]登录密码吗？',
				{
					btn: ['确认','取消']
				},function(){
					cvphp.post(
						"<?php echo U('User/resetPass');?>",
						{
							id:id
						},
						function(data){
							if(data.status!=1){
								layer.msg(data.info);
							}else{
								layer.alert("用户 ["+name+"] 密码已修改为  ["+data.info+"]");
							}
						}
					);
				}
			);
		}
		//删除会员方法
		function delUser(id,name){
			layer.confirm(
				'用户[ '+name+' ]删除后不可恢复且用户附带账单订单资料等同步删除不可恢复,确认要删除吗？',
				{
					btn: ['确认删除','取消']
				},function(){
					cvphp.post(
						"<?php echo U('User/del');?>",
						{
							id:id
						},
						function(data){
							if(data.status!=1){
								layer.msg(data.info);
							}else{
								$("#list-"+id).remove();
								layer.msg("操作成功");
							}
						}
					);
				}
			);
		}
	</script>
</html>