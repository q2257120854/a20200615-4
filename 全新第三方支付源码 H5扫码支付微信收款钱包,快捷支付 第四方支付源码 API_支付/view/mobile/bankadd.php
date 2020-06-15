<?php require_once 'header.php' ?>
<header class="aui-bar aui-bar-nav baiset">
    <a onclick="tiao(&#39;/mobile/bank&#39;)" class="aui-pull-left aui-btn">
        <span style="color:#fff" class="aui-iconfont c-b"><取消</span>
    </a>
    <div class="aui-title">添加银行卡</div>
</header>
<style>
	.con{
		background:#fff;
		width:90%;
		margin-left:auto;
		margin-right:auto;
		height:100%;
	}
</style>
<div class="con">
	<div style="width:100%; height:20px;"></div>
	<form class="form-ajax2 form-horizontal" action="/mobile/bankadd/savecfo/"
method="post">
    <div class="form-group">
        <label class="col-md-3 control-label">
            收款银行：
        </label>
        <div class="col-md-6">
            <select name="bankname" class="form-control">
                <?php foreach($this->
                    setConfig->cfoBank() as $code=>$bank):?>
                    <option value="<?php echo $bank ?>" >
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
            <input type="text" name="provice" class="form-control"  required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户城市：
        </label>
        <div class="col-md-6">
            <input type="text" name="city" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            支行名称：
        </label>
        <div class="col-md-6">
            <input type="text" name="branchname" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            开户名称：
        </label>
        <div class="col-md-6">
            <input type="text" name="accountname" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            卡号：
        </label>
        <div class="col-md-6">
            <input type="text" name="cardno" class="form-control" maxlength="25" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-4">
            <button type="submit" class="btn btn-success">
                &nbsp;
        <i class="fa fa-check-square-o"></i>
                &nbsp;保存修改&nbsp;
            </button>
        </div>
    </div>
</form>
<br>
<script>
    $(function() {
        $('.form-ajax2').submit(function(e) {
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
</div>
<?php require_once 'footer.php' ?>