<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            通知记录
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="uname" placeholder="用户名/编号"
                    value="<?php echo $search['uname']?>" size="10">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="orderid" placeholder="平台订单号"
                    value="<?php echo $search['orderid']?>" size="12">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="sdorderno" placeholder="商户订单号"
                    value="<?php echo $search['sdorderno']?>" size="12">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                        <input size="16" type="text" name="fdate" readonly class="form_datetime form-control"
                        value="<?php echo $search['fdate']?>">
                        <span class="input-group-addon">
                            至
                        </span>
                        <input size="16" type="text" name="tdate" readonly class="form_datetime form-control"
                        value="<?php echo $search['tdate']?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">
                    </span>
                    &nbsp;立即查询
                </button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
   <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
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
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):$arr=json_decode($val['retmsg'],true);?>
                        <tr>
                            <td>
                                <?php echo date( 'Y-m-d H:i:s',$val[ 'addtime'])?>
                            </td>
                            <td>
                                <a href="javascript:;" onclick="showContent('订单详情','<?php echo $this->dir?>orders/getorderinfo/<?php echo $val['orid']?>')">
                                    <?php echo $val[ 'orderid']?>
                                </a>
                            </td>
                            <td>
                                <?php echo $arr[ 'code'] ?>
                            </td>
                            <td>
                                <?php echo $arr[ 'content'] ?>
                            </td>
                            <td>
                                <?php echo $val[ 'times'] ?>
                            </td>
                            <td>
                                <a href="javascript:;" onclick="pushOrder('<?php echo $val['orderid']?>')"
                                data-toggle="tooltip" title="通知">
                                    <span class="glyphicon glyphicon-refresh">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="6">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
    </div>
    <?php echo $lists ? $pagelist : '' ?><br><br>
        <script>
            function pushOrder(orderid) {
                $.post('<?php echo $this->dir?>orders/notify', {
                    orderid: orderid,
                    t: new Date().getTime()
                },
                function(ret) {
                    alert('收到回复：\r\n' + ret);
                });
            }
        </script>
        <?php require_once 'footer.php' ?>