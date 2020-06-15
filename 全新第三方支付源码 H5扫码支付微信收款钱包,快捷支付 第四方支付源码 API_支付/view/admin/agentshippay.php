<form class="form-horizontal" action="<?php echo $this->dir?>agentship/savepay/<?php echo $userid ?>"
method="post" autocomplete="off">
    <input type="hidden" name="sn" value="b<?php echo time()?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">
            代理编号：
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
            真实姓名：
        </label>
        <div class="col-sm-8">
            <input type="text" name="realname" class="form-control" value="<?php echo $realname?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            收款银行：
        </label>
        <div class="col-sm-8">
            <input type="text" name="batype" class="form-control" value="<?php echo $batype?>"
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