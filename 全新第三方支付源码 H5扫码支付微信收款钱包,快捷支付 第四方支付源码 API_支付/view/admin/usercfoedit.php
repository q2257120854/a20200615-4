<form class="form-ajax form-horizontal" action="<?php echo $this->dir?>usercfo/save/<?php echo $id ?>"
method="post" autocomplete="off">
    <div class="form-group">
        <label class="col-sm-3 control-label">
            商户编号：
        </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" disabled value="<?php echo $userid ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            收款银行：
        </label>
        <div class="col-md-6">
            <select name="bankname" class="form-control">
                <?php foreach($this->setConfig->cfoBank() as $code=>$bank):?>
                    <option value="<?php echo $bank ?>" <?php echo $bank==$bankname ?
                    ' selected' : ''?>
                        >
                        <?php echo $bank ?>
                    </option>
                    <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户省份：
        </label>
        <div class="col-md-6">
            <input type="text" name="provice" class="form-control" value="<?php echo $provice?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户城市：
        </label>
        <div class="col-md-6">
            <input type="text" name="city" class="form-control" value="<?php echo $city?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            支行名称：
        </label>
        <div class="col-md-6">
            <input type="text" name="branchname" class="form-control" value="<?php echo $branchname?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户名称：
        </label>
        <div class="col-md-6">
            <input type="text" name="accountname" class="form-control" value="<?php echo $accountname?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            收款帐号：
        </label>
        <div class="col-md-6">
            <input type="text" name="cardno" class="form-control" maxlength="25" value="<?php echo $cardno?>"
            required>
        </div>
    </div>
	<div class="form-group">
        <label class="col-md-3 control-label">
            身份证号码：
        </label>
        <div class="col-md-6">
            <input type="text" name="sfz" class="form-control" maxlength="25" value="<?php echo $sfz?>"
            required>
        </div>
    </div>
	<div class="form-group">
        <label class="col-md-3 control-label">
           手机号码：
        </label>
        <div class="col-md-6">
            <input type="text" name="shouji" class="form-control" maxlength="25" value="<?php echo $shouji?>"
            required>
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
                &nbsp;保存设置&nbsp;
            </button>
        </div>
    </div>
</form>
</div>
<br>
<script>
    $(function() {
        $('.form-ajax').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(ret) {
                    if (ret.status == '0') {
                        alert('保存失败');
                    }
                    if (ret.status == '1') {
                        alert('保存成功');
                        $('#waModal').modal('hide');
                    }
                }
            });
        });
    })
</script>