<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            接入网关列表
        </span>
        &nbsp;/&nbsp;
        <span>
            增加网关
        </span>
    </h3>
    <br>
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acl/editsave/<?php echo $data['id']?>"
    method="post">
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                接入商：
            </label>
            <div class="col-md-4">
                <select name="acpcode" class="form-control">
                    <?php foreach($acp as $key=>$val):?>
                        <option value="<?php echo $val['code']?>" <?php echo $data['acpcode']==$val['code'] ? ' selected' : ''?>
                            >
                            <?php echo $val['name']?>
                        </option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                通用网关：
            </label>
            <div class="col-md-4">
                <select name="acwid" class="form-control">
                    <?php foreach($acw as $key=>$val):?>
                        <option value="<?php echo $val['id']?>" <?php echo $data['acwid']==$val['id'] ? ' selected' : ''?>
                            >
                            <?php echo $val['name']?>
                        </option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                接入网关：
            </label>
            <div class="col-md-4">
                <input type="text" name="gateway" class="form-control" placeholder=""
                value="<?php echo $data['gateway']?>">
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
    <?php require_once 'footer.php' ?>