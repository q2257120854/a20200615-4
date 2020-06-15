<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            编辑账号信息
        </span>
    </h3>
    <br>
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>admins/editsave/<?php echo $data['id']?>"
    method="post" autocomplete="off">
        <div class="form-group">
            <label for="adminname" class="col-md-2 control-label">
                账号名称：
            </label>
            <div class="col-md-4">
                <input type="text" id="adminname" class="form-control" maxlength="20"
                value="<?php echo $data['adminname'] ?>" disabled required>
            </div>
        </div>
        <div class="form-group">
            <label for="adminpass" class="col-md-2 control-label">
                登录密码：
            </label>
            <div class="col-md-4">
                <input type="password" name="adminpass" id="adminpass" class="form-control"
                maxlength="20">
            </div>
        </div>
        <div class="form-group">
            <label for="cirpwd" class="col-md-2 control-label">
                确认登录密码：
            </label>
            <div class="col-md-4">
                <input type="password" name="cirpwd" id="cirpwd" class="form-control"
                maxlength="20">
            </div>
        </div>
        <div class="form-group">
            <label for="is_state" class="col-md-2 control-label">
                设置状态：
            </label>
            <div class="col-md-4">
                <select name="is_state" class="form-control">
                    <option value="1" <?php echo $data[ 'is_state']=='1' ? ' selected' : '' ?>
                        >暂不开通
                    </option>
                    <option value="0" <?php echo $data[ 'is_state']=='0' ? ' selected' : '' ?>
                        >开通账号
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                登录IP内容：
            </label>
            <div class="col-md-4">
                <textarea name="limit_ip" class="form-control" rows="5">
                    <?php echo $data[ 'limit_ip']?>
                </textarea>
                <p class="gray">
                    多个IP中间使用 | 隔开
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                登录IP限制：
            </label>
            <div class="col-md-4">
                <select name="is_limit_ip" class="form-control">
                    <option value="0" <?php echo $data[ 'is_limit_ip']=='0' ? ' selected' : '' ?>
                        >不使用
                    </option>
                    <option value="1" <?php echo $data[ 'is_limit_ip']=='1' ? ' selected' : '' ?>
                        >使用
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="is_state" class="col-md-2 control-label">
                权限设置：
            </label>
            <div class="col-md-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default selectAll">
                        全选
                    </button>
                    <button type="button" class="btn btn-default cancelAll">
                        取消
                    </button>
                    <button type="button" class="btn btn-default unSelectAll">
                        反选
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
                <?php foreach($this->menu() as $key=>$val):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $key ?>
                        </div>
                        <div class="panel-body">
                            <?php foreach($val as $key2=>$val2): ?>
                                <label for="<?php echo $key2 ?>">
                                    <input type="checkbox" name="<?php echo $key2 ?>" id="<?php echo $key2?>"
                                    value="<?php echo $val2?>" <?php echo array_key_exists($key2,$data[
                                    'limits']) ? ' checked' : '' ?>>&nbsp;
                                    <?php echo $val2?>
                                        &nbsp;&nbsp;
                                </label>
                                <?php endforeach;?>
                        </div>
                    </div>
                    <?php endforeach;?>
            </div>
        </div>
        <div class="form-group">
            <label for="stacode" class="col-md-2 control-label">
            </label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success">
                    &nbsp;
                    <span class="glyphicon glyphicon-save">
                    </span>
                    &nbsp;保存设置&nbsp;
                </button>
            </div>
        </div>
    </form>
    <script>
        $(function() {
            $('.selectAll').click(function() {
                $('.panel-body [type="checkbox"]').prop('checked', true);
            });
            $('.cancelAll').click(function() {
                $('.panel-body [type="checkbox"]').prop('checked', false);
            });
            $('.unSelectAll').click(function() {
                $('.panel-body [type="checkbox"]').each(function() {
                    if ($(this).prop('checked')) {
                        $(this).prop('checked', false);
                    } else {
                        $(this).prop('checked', true);
                    }
                });
            });
        });
    </script>
    <?php require_once 'footer.php' ?>