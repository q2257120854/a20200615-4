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
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acc/editsave/<?php echo $data['id']?>"
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
                    <?php foreach($acp as $key=>$val):?>
                        <option value="<?php echo $val['code']?>" <?php echo $data['acpcode']==$val['code'] ? ' selected' : ''?>
                            >
                            <?php echo $val['name']?>
                        </option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group gateway">
            <label for="name" class="col-md-2 control-label">
                选择网关：
            </label>
            <div class="col-md-4">
                <select name="gateway" class="form-control">
                    <?php foreach($acl as $key=>$val):?>
                        <option value="<?php echo $val['gateway']?>" <?php echo $data['gateway']==$val['gateway'] ? ' selected' : ''?>>
                            <?php echo $val['name']?>
                        </option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                通道名称：
            </label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" required value="<?php echo $data['name']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="wprice" class="col-md-2 control-label">
                平台分成：
            </label>
            <div class="col-md-4">
                <input type="text" name="wprice" class="form-control" placeholder="0.98"
                maxlength="6" required value="<?php echo $data['wprice']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="gprice" class="col-md-2 control-label">
                代理分成：
            </label>
            <div class="col-md-4">
                <input type="text" name="gprice" class="form-control" placeholder="0.97"
                maxlength="6" required value="<?php echo $data['gprice']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="uprice" class="col-md-2 control-label">
                用户分成：
            </label>
            <div class="col-md-4">
                <input type="text" name="uprice" class="form-control" placeholder="0.96"
                maxlength="6" required value="<?php echo $data['uprice']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="sortid" class="col-md-2 control-label">
                排序：
            </label>
            <div class="col-md-4">
                <input type="text" name="sortid" class="form-control" maxlength="6" value="<?php echo $data['sortid']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                设置状态：
            </label>
            <div class="col-md-4">
                <select name="is_state" class="form-control">
                    <option value="0" <?php echo $data['is_state']=='0' ? 'selected' : ''?>
                        >正式开通
                    </option>
                    <option value="1" <?php echo $data['is_state']=='1' ? 'selected' : ''?>
                        >暂不开通
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
                    <option value="0" <?php echo $data['is_display']=='0' ? 'selected':''?>>是
                    </option>
                    <option value="1" <?php echo $data['is_display']=='1' ? 'selected' :''?>>否
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
            </label>
            <div class="col-md-4">
                <label>
                    <input type="checkbox" name="is_check" value="1" checked>
                    &nbsp;为所有用户更新此通道
                </label>
            </div>
        </div>
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