<form class="form-horizontal" action="" method="post" autocomplete="off">
    <div class="form-group">
        <label class="col-sm-3 control-label">
            平台订单号：
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $orders['orderid'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            商户订单号：
        </label>
        <div class="col-sm-8">
            <input type="text" name="money" class="form-control" value="<?php echo $orders['sdorderno'] ?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            通知参数：
        </label>
        <div class="col-sm-8">
            <textarea class="form-control" rows="6">
                <?php echo $params?>
            </textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            异步通知URL：
        </label>
        <div class="col-sm-8">
            <input type="text" name="realname" class="form-control" value="<?php echo $orderinfo['notifyurl']?>"
            required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            同步通知URL：
        </label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" name="realname" class="form-control" value="<?php echo $orderinfo['returnurl']?>">
                <span class="input-group-addon">
                    <a href="<?php echo $orderinfo['returnurl'].'?'.$params?>" target="_blank">
                        <span class="glyphicon glyphicon-link">
                    </a>
                    </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            返回结果：
        </label>
        <div class="col-sm-8">
            <textarea class="form-control" rows="6">
                <?php echo $ordernotify[ 'retmsg']?>
            </textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            通知状态：
        </label>
        <div class="col-sm-8">
            <?php switch($ordernotify[ 'is_status']){case '0': $notifyMsg='<span class="label label-warning">等待</span>'
            ; break;case '1': $notifyMsg='<span class="label label-success">成功</span>'
            ; break;case '2': $notifyMsg='<span class="label label-danger">失败</span>'
            ; break;}?>
                <?php echo $notifyMsg?>
        </div>
    </div>
</form>
</div>
<br>