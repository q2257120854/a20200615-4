<style>
    table.customize{border-collapse: collapse;width:100%}table.customize td{height:
    40px;border-bottom:1px solid #ddd}table.customize td.title{color:#999;background:
    #fff}
</style>
<div class="panel panel-info">
    <div class="panel-heading">
        订单信息
    </div>
    <div class="panel-body">
        <table class="customize">
            <tr>
                <td class="title">
                    平台订单号：
                </td>
                <td>
                    <?php echo $orders['orderid']?>
                </td>
                <td class="title">
                    商户订单号：
                </td>
                <td>
                    <?php echo $orders['sdorderno']?>
                </td>
            </tr>
            <tr>
                <td class="title">
                    订单金额：
                </td>
                <td>
                    <?php echo $orders['total_fee']?>
                        元
                </td>
                <td class="title">
                    实付金额：
                </td>
                <td>
                    <?php echo $orders['realmoney']?>
                        元
                </td>
            </tr>
            <tr>
                <td class="title">
                    提交时间：
                </td>
                <td>
                    <?php echo date( 'Y-m-d H:i:s',$orders['addtime'])?>
                </td>
                <td class="title">
                    订单状态：
                </td>
                <td>
                    <?php switch($orders['is_state']){case '0': $state='<span class="label label-warning">未付</span>'
                    ;break;case '1': $state='<span class="label label-success">已付</span>' ;break;case
                    '2': $state='<span class="label label-danger">冻结</span>' ;break;case '3':
                    $state='<span class="label label-default">关闭</span>' ;break;}echo $state;?>
                </td>
            </tr>
            <tr>
                <td class="title">
                    后台通知：
                </td>
                <td>
                    <a href="<?php echo $orderinfo['notifyurl']?>" target="_blank">
                        <span class="glyphicon glyphicon-link">
                        </span>
                    </a>
                </td>
                <td class="title">
                    前台通知：
                </td>
                <td>
                    <a href="<?php echo $orderinfo['returnurl']?>" target="_blank">
                        <span class="glyphicon glyphicon-link">
                        </span>
                    </a>
                </td>
            </tr>
            <tr>
                <td class="title">
                    订单备注：
                </td>
                <td>
                    <?php echo $orderinfo['remark']?>
                </td>
                <td class="title">
                    接入编号：
                </td>
                <td>
                    <?php echo $orderinfo['paytype']?>
                        (
                        <?php echo $orderinfo['bankcode']?>
                            )
                </td>
            </tr>
        </table>
    </div>
</div>
<?php if($orderinfo['cardnum']):?>
    <div class="panel panel-success">
        <div class="panel-heading">
            充值卡信息
        </div>
        <div class="panel-body">
            <table class="customize">
                <tr>
                    <td class="title">
                        充值卡卡号：
                    </td>
                    <td>
                        <?php echo $orderinfo['cardnum']?>
                    </td>
                    <td class="title">
                        充值卡密码：
                    </td>
                    <td>
                        <?php echo $orderinfo['cardpwd'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="title">
                        充值卡面值：
                    </td>
                    <td>
                        <?php echo $orderinfo['faceno']?>
                            元
                    </td>
                    <td class="title">
                        接口返回结果：
                    </td>
                    <td style="width:200px;word-wrap:break-word;word-break:break-all;">
                        <?php echo $orderinfo['retmsg']?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif;?>
        <?php if($ordernotify):?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    通知信息
                </div>
                <div class="panel-body">
                    <table class="customize">
                        <tr>
                            <td class="title">
                                通知状态：
                            </td>
                            <td>
                                <?php switch($ordernotify['is_status']){case '0': $notifyMsg='<span class="label label-warning">等待</span>'
                                ; break;case '1': $notifyMsg='<span class="label label-success">成功</span>'
                                ; break;case '2': $notifyMsg='<span class="label label-danger">失败</span>'
                                ; break;}echo $notifyMsg;?>
                            </td>
                            <td class="title">
                                收到回复：
                            </td>
                            <td style="width:200px;word-wrap:break-word;word-break:break-all;">
                                <?php echo $ordernotify['retmsg'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                推送次数：
                            </td>
                            <td>
                                <?php echo $ordernotify['times']?>
                                    次
                            </td>
                            <td class="title">
                                下个推送点：
                            </td>
                            <td>
                                <?php echo $ordernotify['nexts']?>
                                    秒
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif;?>