<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            管理员列表
        </span>
        &nbsp;/&nbsp;
        <span>
            添加账号
        </span>
    </h3>
    <br>
    <div class="set set0">
       <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th class="text-center">
                        编号
                    </th>
                    <th>
                        账号名称
                    </th>
                    <th>
                        状态
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
                            <td>
                                <?php echo $val['adminname']?>
                            </td>
                            <td>
                                <?php echo $val['is_state']=='0' ?
                                '<span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span>' :
                                '<span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span>' ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo $this->dir?>admins/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>admins/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="4">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
    </div>
    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>admins/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="adminname" class="col-md-2 control-label">
                    账号名称：
                </label>
                <div class="col-md-4">
                    <input type="text" name="adminname" id="adminname" class="form-control"
                    maxlength="20" required>
                </div>
            </div>
            <div class="form-group">
                <label for="adminpass" class="col-md-2 control-label">
                    登录密码：
                </label>
                <div class="col-md-4">
                    <input type="password" name="adminpass" id="adminpass" class="form-control"
                    maxlength="20" required>
                </div>
            </div>
            <div class="form-group">
                <label for="cirpwd" class="col-md-2 control-label">
                    确认登录密码：
                </label>
                <div class="col-md-4">
                    <input type="password" name="cirpwd" id="cirpwd" class="form-control"
                    maxlength="20" required>
                </div>
            </div>
            <div class="form-group">
                <label for="is_state" class="col-md-2 control-label">
                    设置状态：
                </label>
                <div class="col-md-4">
                    <select name="is_state" class="form-control">
                        <option value="1">
                            暂不开通
                        </option>
                        <option value="0">
                            开通账号
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
                        <option value="0">
                            不使用
                        </option>
                        <option value="1">
                            使用
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
                    <?php foreach($this->
                        menu() as $key=>$val):?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $key ?>
                            </div>
                            <div class="panel-body">
                                <?php foreach($val as $key2=>$val2): ?>
                                    <label for="<?php echo $key2 ?>">
                                        <input type="checkbox" name="<?php echo $key2 ?>" id="<?php echo $key2?>"
                                        value="<?php echo $val2?>">
                                        &nbsp;
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
    </div>
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