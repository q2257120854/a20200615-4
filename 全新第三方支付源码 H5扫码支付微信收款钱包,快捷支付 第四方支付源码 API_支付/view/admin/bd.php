<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            订单补发
        </span>
    </h3>
    <br>
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <div class="set">
        <div class="panel panel-default">
            <div class="panel-heading">
                平台订单补发：
            </div>
            <div class="panel-body">
                <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>bd/save"
                method="post">
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">
                            平台订单号：
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="orderid" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" class="col-md-2 control-label">
                            订单金额：
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-4">
                            <button type="submit" class="btn btn-success">
                                &nbsp;
                                <span class="glyphicon glyphicon-save">
                                </span>
                                &nbsp;立即补发&nbsp;
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                商户订单批量通知：
            </div>
            <div class="panel-body">
                <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>bd/notify"
                method="post">
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">
                            日期：
                        </label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
                                <input size="16" type="text" name="fdate" readonly class="form_datetime form-control"
                                value="<?php echo date('Y-m-d')?>">
                                <span class="input-group-addon">
                                    至
                                </span>
                                <input size="16" type="text" name="tdate" readonly class="form_datetime form-control"
                                value="<?php echo date('Y-m-d')?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" class="col-md-2 control-label">
                            商户ID：
                        </label>
                        <div class="col-md-4">
                            <input type="text" name="userid" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-4">
                            <button type="submit" class="btn btn-success">
                                &nbsp;
                                <span class="glyphicon glyphicon-save">
                                </span>
                                &nbsp;立即通知&nbsp;
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once 'footer.php' ?>