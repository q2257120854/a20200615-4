<form class="form-horizontal" action="<?php echo $this->dir?>usership/savepay/<?php echo $userid ?>" method="post" autocomplete="off">
    <input type="hidden" name="sn" value="b<?php echo time()+mt_rand(1000,9999)?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">
            商户编号：
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" disabled value="<?php echo $userid ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            可付金额：
        </label>
        <div class="col-sm-8">
            <input type="text" name="money" class="form-control" value="<?php echo $money ?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            手续费：
        </label>
        <div class="col-sm-8">
            <input type="text" name="fee" class="form-control" value="<?php echo $fee?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            付款记录状态：
        </label>
        <div class="col-sm-8">
            <select name="is_state" class="form-control">
                <option value="0">
                    待处理
                </option>
                <option value="1">
                    已付款
                </option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            开户名称：
        </label>
        <div class="col-sm-8">
            <input type="text" name="realname" class="form-control" value="<?php echo $realname?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            收款方式：
        </label>
        <div class="col-sm-8">
            <input type="text" name="batype" class="form-control" value="<?php echo $batype?>"
            required>
        </div>
    </div>

  <div class="form-group">
        <label class="col-sm-3 control-label">
            开户地址：
        </label>
        <div class="col-sm-8">
            <input type="text" name="baaddr" class="form-control" value="<?php echo $baaddr?>"
            required>
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            收款账号：
        </label>
        <div class="col-sm-8">
            <input type="text" name="baname" class="form-control" value="<?php echo $baname?>"
            required>
        </div>
    </div>
	<div class="form-group">
        <label class="col-sm-3 control-label">
            身份证号：
        </label>
        <div class="col-sm-8">
   
			
			<input type="text" name="idcard" class="form-control" value="<?php echo $idcard?>" required>
        </div>
    </div>
	
    <div class="form-group">
        <label class="col-sm-3 control-label">
            备注说明：
        </label>
        <div class="col-sm-8">
            <textarea name="remark" class="form-control" rows="5">
            </textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="stacode" class="col-sm-3 control-label">
        </label>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-success">
                &nbsp;
                <span class="glyphicon glyphicon-save">
                </span>
                &nbsp;立即付款&nbsp;
            </button>
        </div>
    </div>
</form>
</div>
<br>