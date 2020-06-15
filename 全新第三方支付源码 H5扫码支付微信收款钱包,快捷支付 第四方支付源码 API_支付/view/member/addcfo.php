<form class="form-ajax1 form-horizontal" action="/member/userinfo/savecfo"
method="post">
    <div class="form-group">
        <label class="col-md-3 control-label">
            收款银行：
        </label>
        <div class="col-md-6">
            <select name="bankname" class="form-control">
                <?php foreach($this->setConfig->cfoBank() as $code => $bank):?>
                    <option value="<?php echo $bank ?>">
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
            <input type="text" name="provice" class="form-control" placeholder="例如 海南"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户城市：
        </label>
        <div class="col-md-6">
            <input type="text" name="city" class="form-control" placeholder="例如 三亚"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            支行名称：
        </label>
        <div class="col-md-6">
            <input type="text" name="branchname" class="form-control" placeholder="例如 凤凰支行"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户名称：
        </label>
        <div class="col-md-6">
            <input type="text" name="accountname" class="form-control" placeholder=""
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            银行卡号：
        </label>
        <div class="col-md-6">
            <input type="text" name="cardno" class="form-control" maxlength="25" placeholder=""
            required>
        </div>
    </div>
	<div class="form-group">
        <label class="col-md-3 control-label">
            身份证号码：
        </label>
        <div class="col-md-6">
            <input type="text" name="sfz" class="form-control" placeholder="和银行户名相同" maxlength="25"
            required>
        </div>
    </div>
	<div class="form-group">
        <label class="col-md-3 control-label">
           手机号码：
        </label>
        <div class="col-md-6">
            <input type="text" name="shouji" class="form-control" placeholder="接收银行短信通知" maxlength="25"
            required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-4">
            <button type="submit" class="btn btn-success">
                &nbsp;
              <i class="fa fa-check-square-o"></i>
                &nbsp;立即保存&nbsp;
            </button>
        </div>
    </div>
</form>
<br>
<script>
    $(function() {
        $('.form-ajax1').submit(function(e) {
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
        $('#waModal').on('hidden.bs.modal',
        function(e) {
            getCfo();
        });
    })
</script>