<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            接入商信息
        </span>
        &nbsp;/&nbsp;
        <span>
            增加新接入商
        </span>
    </h3>
    <br>
    <div class="set set0">
        <?php if($lists):?>
            <?php foreach($lists as $key=>$val):?>
                <div class="panel panel-info" data-id="<?php echo $val['id']?>">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-th-list">
                        </span>
                        &nbsp;
                        <?php echo $val['name']?>
                    </div>
                    <div class="panel-body">
                        <form class="form-ajax form-inline" action="<?php echo $this->dir?>acp/editsave/<?php echo $val['id']?>"
                        method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        账号
                                    </span>
                                    <input type="text" name="email" class="form-control" placeholder="账号"
                                    value="<?php echo $val['email']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        编号
                                    </span>
                                    <input type="text" name="userid" class="form-control" placeholder="ID"
                                    value="<?php echo $val['userid']?>" size="15">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        密钥
                                    </span>
                                    <input type="text" name="userkey" class="form-control" placeholder="密钥"
                                    value="<?php echo $val['userkey']?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <button type="submit" class="btn btn-success">
                                    &nbsp;
                                    <span class="glyphicon glyphicon-save">
                                    </span>
                                    &nbsp;保存设置&nbsp;
                                </button>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>acp/del')"
                                data-toggle="tooltip" data-placement="top" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach;?>
                    <?php endif?>
    </div>
    <script>
        $(function() {
            $('.panel').mouseover(function() {
                $(this).removeClass('panel-info').addClass('panel-primary');
            }).mouseleave(function() {
                $(this).removeClass('panel-primary').addClass('panel-info');
            });
        });
    </script>
    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acp/save"
        method="post">
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入商名称：
                </label>
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入商编号：
                </label>
                <div class="col-md-4">
                    <input type="text" name="code" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入账号：
                </label>
                <div class="col-md-4">
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入ID：
                </label>
                <div class="col-md-4">
                    <input type="text" name="userid" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入密钥：
                </label>
                <div class="col-md-4">
                    <input type="text" name="userkey" class="form-control" required>
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
    </div>
    <?php require_once 'footer.php' ?>