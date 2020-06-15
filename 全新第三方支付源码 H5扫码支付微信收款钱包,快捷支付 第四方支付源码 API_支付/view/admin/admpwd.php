<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            修改管理员密码
        </span>
    </h3>
    <br>
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>pwd/save"
    method="post" autocomplete="off">
        <div class="form-group">
            <label for="oldpwd" class="col-md-2 control-label">
                原密码：
            </label>
            <div class="col-md-4">
                <input type="password" name="oldpwd" id="oldpwd" class="form-control"
                maxlength="20" required>
            </div>
        </div>
        <div class="form-group">
            <label for="newpwd" class="col-md-2 control-label">
                新密码：
            </label>
            <div class="col-md-4">
                <input type="password" name="newpwd" id="newpwd" class="form-control"
                maxlength="20" required>
            </div>
        </div>
        <div class="form-group">
            <label for="cirpwd" class="col-md-2 control-label">
                确认新密码：
            </label>
            <div class="col-md-4">
                <input type="password" name="cirpwd" id="cirpwd" class="form-control"
                maxlength="20" required>
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
    <?php require_once 'footer.php' ?>