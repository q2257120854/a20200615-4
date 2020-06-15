<?php require_once 'header.php' ?>
<h3><span class="current">编辑网银</span></h3>
<br>
<style>
.form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
</style>
<form class="form-ajax form-horizontal" action="<?php echo $this->dir ?>acb/editsave/<?php echo $data['id']?>" method="post">
	<div class="form-group">
		<label for="name" class="col-md-2 control-label">银行名称：</label>
		<div class="col-md-4">
			<input type="text" name="name" class="form-control" required value="<?php echo $data['name']?>">
		</div>
	</div>
	<div class="form-group">
		<label for="code" class="col-md-2 control-label">银行编号：</label>
		<div class="col-md-4">
			<input type="text" name="code" class="form-control" required value="<?php echo $data['code']?>">
		</div>
	</div>
	<div class="form-group">
		<label for="img" class="col-md-2 control-label">银行图片：</label>
		<div class="col-md-4">
			<input type="text" name="img" class="form-control" required value="<?php echo $data['img']?>">
		</div>
	</div>
	<div class="form-group">
		<label for="sortid" class="col-md-2 control-label">排序：</label>
		<div class="col-md-4">
			<input type="text" name="sortid" class="form-control" value="0" maxlength="6" value="<?php echo $data['sortid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label">设置状态：</label>
		<div class="col-md-4">
			<select name="is_state" class="form-control">
				<option value="0"<?php echo $data['is_state']=='0' ? ' selected' : ''?>>正式开通</option>
				<option value="1"<?php echo $data['is_state']=='1' ? ' selected' : ''?>>暂不开通</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-offset-2 col-md-4">
			<button type="submit" class="btn btn-success">&nbsp;<span class="glyphicon glyphicon-save"></span>&nbsp;保存设置&nbsp;</button>
		</div>
	</div>
</form>
<?php require_once 'footer.php' ?>