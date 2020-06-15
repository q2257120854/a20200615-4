<?php require_once 'header.php' ?>
    <style>
        .bf{font-size:2em}.main_content .panel{text-align: center}.main_content
        .panel:hover .panel-body{background: #f1f1f1}.main_content .panel .panel-footer{color:#fff}.main_content
        .panel .panel-footer a{color:#fff}.main_content a .bf{color:#E43D40}.main_content
        .panel-info .panel-footer{background: #39ABD2;}.main_content .panel-warning
        .panel-footer{background: #FFA600}.main_content .panel-danger .panel-footer{background:
        #D9534F}.main_content .panel-success .panel-footer{background: #328061}
    </style>
    <h3>
        <span class="current">
            管理首页
        </span>
    </h3>
    <br>
    <div class="main_content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>userpay?is_state=0&fdate=<?php echo date('Y-m-d')?>&tdate=<?php echo date('Y-m-d')?>">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $tx[ 'tcount'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            今日待处理提现
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3  col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>userpay?is_state=0&fdate=<?php echo date('Y-m-d')?>&tdate=<?php echo date('Y-m-d')?>">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $tx[ 'tmoney'][ 'money'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            今日待处理提现金额
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>userpay?fdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d'))-60*60*24)?>&tdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d').' 23:59:59')-60*60*24)?>">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $tx[ 'ycount'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            昨日申请提现
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>userpay?fdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d'))-60*60*24)?>&tdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d').' 23:59:59')-60*60*24)?>">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $tx[ 'ymoney'][ 'money'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            昨日提现金额
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>users?fdate=<?php echo date('Y-m-d')?>&tdate=<?php echo date('Y-m-d')?>">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $user[ 'tcount'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            今日注册用户
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>users?fdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d'))-60*60*24)?>&tdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d').' 23:59:59')-60*60*24)?>">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $user[ 'ycount'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            昨日注册用户
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>users?is_state=0">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $user[ 'unverify'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            未审核用户
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>agent">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $user[ 'agent'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            代理总数
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>orders?fdate=<?php echo date('Y-m-d')?>&tdate=<?php echo date('Y-m-d')?>">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $order[ 'tcount'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            今日订单数
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>orders?is_state=0&fdate=<?php echo date('Y-m-d')?>&tdate=<?php echo date('Y-m-d')?>">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $order[ 'unpaid'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            未付款订单
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>orders?is_state=1&fdate=<?php echo date('Y-m-d')?>&tdate=<?php echo date('Y-m-d')?>">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $order[ 'paid'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            已付款订单
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir?>orders?fdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d'))-60*60*24)?>&tdate=<?php echo date('Y-m-d',strtotime(date('Y-m-d').' 23:59:59')-60*60*24)?>">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $order[ 'ycount'] ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            昨日订单数
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="panel panel-default notifyList">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3 col-sm-8 col-xs-6">
                    通知记录
                </div>
                <div class="col-md-9 col-sm-4 col-xs-6 text-right">
                    <a href="javascript:;" onclick="loadNotify()" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-refresh">
                        </span>
                        &nbsp;刷新
                    </a>
                    <a href="<?php echo $this->dir?>ordernotify" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-option-horizontal">
                        </span>
                        &nbsp;更多
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            时间
                        </th>
                        <th>
                            平台订单号
                        </th>
                        <th>
                            status
                        </th>
                        <th>
                            响应结果
                        </th>
                        <th>
                            次数
                        </th>
                        <th>
                            手动通知
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        loadNotify();
        function loadNotify() {
            $('.notifyList table tbody').html('');
            $('.notifyList table tbody').html('<tr><td colspan="5">正在加载...</td></tr>');
            $.get('<?php echo $this->dir?>orders/getnotify', {
                t: new Date().getTime()
            },
            function(data) {
                if (data) {
                    $('.notifyList table tbody').html(data);
                }
            });
        }
        function pushOrder(orderid) {
            $.post('<?php echo $this->dir?>orders/notify', {
                orderid: orderid,
                t: new Date().getTime()
            },
            function(ret) {
                loadNotify();
                alert('收到回复：\r\n' + ret);
            });
        }
    </script>
    <?php require_once 'footer.php' ?>