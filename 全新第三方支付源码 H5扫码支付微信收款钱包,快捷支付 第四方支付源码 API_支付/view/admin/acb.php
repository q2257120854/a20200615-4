<?php require_once 'header.php' ?>
<h3><span class="current">网银列表</span>&nbsp;/&nbsp;<span>添加网银</span></h3>
<br>
<div class="set set0 table-responsive">
<table id="table-6" class="table table-hover ">
	<thead>
	<tr class="info">
		<th class="text-center">
			编号
		</th>
		<th class="text-center">
			银行图片
		</th>
		<th class="text-center">
			图片名称
		</th>
		<th class="text-center">
			银行名称
		</th>
		<th class="text-center">
			银行编号
		</th>
		<th class="text-center">
			状态
		</th>
		<th class="text-center">
			排序
		</th>
		<th class="text-center">
			操作
		</th>
	</tr>
	</thead>
	<tbody>
	<?php if($lists):?>
	<?php foreach($lists as $key=>$val):?>
	<tr data-id="<?php echo $val['id']?>">
		<td class="text-center">
			<?php echo $val['id']?>
		</td>
		<td class="text-center">
			<img src="/static/payimg/<?php echo $val['img']?>">
		</td>
		<td>
			<?php echo $val['img']?>
		</td>
		<td class="text-center">
			<?php echo $val['name']?>
		</td>
		<td class="text-center">
			<?php echo $val['code']?>
		</td>
		<td class="text-center">
			<?php echo $val['is_state'] ? '<span class="label label-danger">
			暂停</span>' : '<span class="label label-success">正常</span>'?>
		</td>
		<td class="text-center">
			<?php echo $val['sortid']?>
		</td>
		<td class="text-center">
			<a href="<?php echo $this->dir?>acb/edit/<?php echo $val['id']?>
			"  data-toggle="tooltip" title="编辑"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->
			dir?>acb/del')" data-toggle="tooltip" title="删除"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr>
		<td colspan="8">
			暂无数据
		</td>
	</tr>
	<?php endif;?>
	</tbody>
	</table>
</div>
<style>
.form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
</style>
<div class="set set1 hide">
	<form class="form-ajax form-horizontal" action="<?php echo $this->
		dir?>acb/save" method="post">
		<div class="form-group">
			<label for="name" class="col-md-2 control-label">银行名称：</label>
			<div class="col-md-4">
				<input type="text" name="name" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="code" class="col-md-2 control-label">银行编号：</label>
			<div class="col-md-4">
				<input type="text" name="code" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="img" class="col-md-2 control-label">银行图片：</label>
			<div class="col-md-4">
				<input type="text" name="img" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="sortid" class="col-md-2 control-label">排序：</label>
			<div class="col-md-4">
				<input type="text" name="sortid" class="form-control" value="0" maxlength="6">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">设置状态：</label>
			<div class="col-md-4">
				<select name="is_state" class="form-control">
					<option value="0">正式开通</option>
					<option value="1">暂不开通</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-2 col-md-4">
				<button type="submit" class="btn btn-success">&nbsp;<span class="glyphicon glyphicon-save"></span>&nbsp;保存设置&nbsp;</button>
			</div>
		</div>
	</form>
</div>
<?php require_once 'footer.php' ?>