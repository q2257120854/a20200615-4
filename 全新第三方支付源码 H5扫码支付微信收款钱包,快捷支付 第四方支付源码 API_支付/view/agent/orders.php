<?php require_once 'header.php' ?>
   <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                             <?php echo $title ?>
                                </div>
                            </div>
                            <div class="panel-body">
        <div style="background:#fff;padding:20px 15px;border:1px solid #ddd">
            <form class="form-inline" action="" method="get">
                <select name="is_state" class="form-control">
                    <option value="-1" <?php echo $search['is_state']=='-1' ? ' selected'
                    : ''?>
                        >全部
                    </option>
                    <option value="0" <?php echo $search['is_state']=='0' ? ' selected' :
                    ''?>
                        >未付款
                    </option>
                    <option value="1" <?php echo $search['is_state']=='1' ? ' selected' :
                    ''?>
                        >已付款
                    </option>
                </select>
                <input type="text" class="form-control" name="sdorderno" placeholder="商户订单号"
                value="<?php echo $search['sdorderno']?>" size="15">
                <input type="text" class="form-control" name="sdpayno" placeholder="平台订单号"
                value="<?php echo $search['sdpayno']?>" size="15">
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
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">
                    </span>
                    &nbsp;立即查询
                </button>
            </form>
        </div>
        <div class="content-box">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            订单时间
                        </th>
                        <th>
                            商户编号
                        </th>
                        <th>
                            商户订单号
                        </th>
                        <th>
                            平台订单号
                        </th>
                        <th>
                            订单金额
                        </th>
                        <th>
                            实付金额
                        </th>
                        <th>
                            商户收入
                        </th>
                        <th>
                            代理收入
                        </th>
                        <th>
                            付款渠道
                        </th>
                        <th>
                            订单状态
                        </th>
                        <th>
                            通知
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>
                            $val):$orderinfo=$this->model()->select('remark')->from('orderinfo')->where(array('fields'=>'id=?','values'=>array($val['orderinfoid'])))->fetchRow();$remark=$orderinfo
                            ? $orderinfo['remark'] : '-';$acc=$this->model()->select('name')->from('acc')->where(array('fields'=>'id=?','values'=>array($val['channelid'])))->fetchRow();$cname=$acc
                            ? $acc['name'] : '-';switch($val['is_state']){case 0: $state='
                            <span class="label label-warning">
                                未付
                            </span>
                            '; break;case 1: $state='
                            <span class="label label-success">
                                已付
                            </span>
                            '; break;case 2: $state='
                            <span class="label label-danger">
                                冻结
                            </span>
                            '; break;case 3: $state='
                            <span class="label label-danger">
                                关闭
                            </span>
                            '; break;}?>
                            <tr>
                                <td>
                                    <?php echo date( 'm-d H:i:s',$val['addtime'])?>
                                </td>
                                <td>
                                    <?php echo $val['userid']?>
                                </td>
                                <td>
                                    <?php echo $val['sdorderno']?>
                                        <br>
                                        <span class="gray">
                                            <?php echo $remark ?>
                                        </span>
                                </td>
                                <td>
                                    <?php echo $val['orderid']?>
                                </td>
                                <td>
                                    <?php echo $val['total_fee']?>
                                </td>
                                <td class="green">
                                    <?php echo $val['realmoney']?>
                                </td>
                                <td class="green">
                                    <?php echo $val['realmoney']*$val['uprice']?>
                                </td>
                                <td class="green">
                                    <?php echo $val['realmoney']*($val['gprice']-$val['uprice'])?>
                                </td>
                                <td>
                                    <?php echo $cname ?>
                                </td>
                                <td>
                                    <?php echo $state ?>
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="refresh('<?php echo $val['orderid']?>')">
                                        <span class="glyphicon glyphicon-refresh" data-toggle="tooltip" title="通知">
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            no data.
                                        </td>
                                    </tr>
                                    <?php endif;?>
                </tbody>
            </table>
            <?php if($lists):?>
                <div style="float:right">
                    <?php echo $pagelist ?>
                </div>
                <br>
                <br>
                <?php endif;?>
        </div>
    </div></div>
    </div></div></div></div>
 
    <script>
        function refresh(sdpayno) {
            $.post('/agent/orders/refresh', {
                sdpayno: sdpayno,
                t: new Date().getTime()
            },
            function(ret) {
                alert(ret);
            });
        }
    </script>
    <?php require_once 'footer.php' ?>