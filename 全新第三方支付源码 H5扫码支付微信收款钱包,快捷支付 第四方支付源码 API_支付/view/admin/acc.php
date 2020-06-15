<?php require_once 'header.php' ?>
<h3>
    <span class="current">
        通道列表
    </span>
    &nbsp;/&nbsp;
    <span>
        添加通道
    </span>
</h3>
<br>
<div class="set set0">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                    切换网关
                    <span class="caret">
                    </span>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach($acp as $key=>
                        $val):?>
                        <li>
                            <a href="<?php echo $this->dir?>acc/change/<?php echo $val['code']?>">
                                <?php echo $val['name']?>
                            </a>
                        </li>
                        <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="table-responsive">
     <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th>
                        通道编号
                    </th>
                    <th>
                        通道名称
                    </th>
                    <th>
                        接入编号
                    </th>
                    <th>
                        接入网关
                    </th>
                    <th>
                        商户分成
                    </th>
                    <th>
                        代理分成
                    </th>
                    <th>
                        平台分成
                    </th>
                    <th>
                        通道状态
                    </th>
                    <th>
                        排序
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):?>
                        <tr data-id="<?php echo $val['id']?>">
                            <td>
                                <?php echo $val['id']?>
                            </td>
                            <td>
                                <span class="<?php echo $val['is_display'] ? 'red' : 'green'?>">
                                    <?php echo $val['name']?>
                                </span>
                            </td>
                            <td>
                                <?php echo $val['acpcode']?>
                            </td>
                            <td>
                                <?php echo $val['gateway']?>
                                    (
                                    <?php echo $val['acwid']?>
                                        )
                            </td>
                            <td>
                                <?php echo $val['uprice']?>
                            </td>
                            <td>
                                <?php echo $val['gprice']?>
                            </td>
                            <td>
                                <?php echo $val['wprice']?>
                            </td>
                            <td>
                                <?php echo $val['is_state'] ?
                                '<span class="label label-danger">暂停</span>' : '<span class="label label-success">正常</span>'?>
                            </td>
                            <td>
                                <?php echo $val['sortid']?>
                            </td>
                            <td>
                                <a href="<?php echo $this->dir?>acc/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>acc/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="10">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<style>
    .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
</style>
<div class="set set1 hide">
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acc/save"
    method="post">
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                接入商：
            </label>
            <div class="col-md-4">
                <select name="acpcode" class="form-control">
                    <option value="">
                        请选择接入商
                    </option>
                    <?php foreach($acp as $key=>
                        $val):?>
                        <option value="<?php echo $val['code']?>">
                            <?php echo $val['name']?>
                        </option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group gateway hide">
            <label for="name" class="col-md-2 control-label">
                选择网关：
            </label>
            <div class="col-md-4">
                <select name="gateway" class="form-control">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                通道名称：
            </label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="wprice" class="col-md-2 control-label">
                平台分成：
            </label>
            <div class="col-md-4">
                <input type="text" name="wprice" class="form-control" placeholder="0.98"
                maxlength="6" required>
            </div>
        </div>
        <div class="form-group">
            <label for="gprice" class="col-md-2 control-label">
                代理分成：
            </label>
            <div class="col-md-4">
                <input type="text" name="gprice" class="form-control" placeholder="0.97"
                maxlength="6" required>
            </div>
        </div>
        <div class="form-group">
            <label for="uprice" class="col-md-2 control-label">
                用户分成：
            </label>
            <div class="col-md-4">
                <input type="text" name="uprice" class="form-control" placeholder="0.96"
                maxlength="6" required>
            </div>
        </div>
        <div class="form-group">
            <label for="sortid" class="col-md-2 control-label">
                排序：
            </label>
            <div class="col-md-4">
                <input type="text" name="sortid" class="form-control" value="0" maxlength="6">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                设置状态：
            </label>
            <div class="col-md-4">
                <select name="is_state" class="form-control">
                    <option value="0">
                        正式开通
                    </option>
                    <option value="1">
                        暂不开通
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                默认使用：
            </label>
            <div class="col-md-4">
                <select name="is_display" class="form-control">
                    <option value="0">
                        是
                    </option>
                    <option value="1">
                        否
                    </option>
                </select>
            </div>
        </div>
        <!--<div class="form-group"><label class="col-md-2 control-label"></label><div class="col-md-4"><label><input type="checkbox" name="is_check" value="1" checked>&nbsp;为所有用户更新此通道</label></div></div>-->
        <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
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
    $('[name=acpcode]').change(function() {
        if ($(this).val() == '') {
            $('.gateway').hide();
            $('.gateway select').html('');
        }
        $.post('<?php echo $this->dir?>acc/getAcl', {
            acpcode: $(this).val()
        },
        function(ret) {
            if (ret) {
                $('.gateway').removeClass('hide').show();
                $('.gateway select').html(ret);
            }
        });
    });
</script>
<?php require_once 'footer.php' ?>