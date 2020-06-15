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
                &nbsp;&nbsp;
                <a href="?day=1" <?php echo $search[ 'day']=='1' ? ' class="current"'
                : ''?>
                    >今天
                </a>
                <span class="v-line">
                    |
                </span>
                <a href="?day=2" <?php echo $search[ 'day']=='2' ? ' class="current"'
                : ''?>
                    >昨天
                </a>
                <span class="v-line">
                    |
                </span>
                <a href="?day=7" <?php echo $search[ 'day']=='7' ? ' class="current"'
                : ''?>
                    >7天
                </a>
                <span class="v-line">
                    |
                </span>
                <a href="?day=30" <?php echo $search[ 'day']=='30' ?
                ' class="current"' : ''?>
                    >30天
                </a>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>
                            $val):$acc=$this->model()->select('name')->from('acc')->where(array('fields'=>'id=?','values'=>array($val['channelid'])))->fetchRow();$cname=$acc
                            ? $acc['name'] : '-';?>
                            <tr>
                                <td>
                                    <?php echo date( 'm-d H:i:s',$val[ 'addtime'])?>
                                </td>
                                <td>
                                    <?php echo $val[ 'userid']?>
                                </td>
                                <td>
                                    <?php echo $val[ 'sdorderno']?>
                                </td>
                                <td class="red">
                                    <?php echo $val[ 'realmoney']?>
                                </td>
                                <td class="blue">
                                    <?php echo $val[ 'realmoney']*$val[ 'uprice']?>
                                </td>
                                <td class="green">
                                    <?php echo $val[ 'gprice']>
                                        0 ? $val['realmoney']*($val['gprice']-$val['uprice']) : '0.00'?>
                                </td>
                                <td>
                                    <?php echo $cname ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="7" class="text-center">
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
        <div class="alert alert-warning text-center" style="margin-bottom:0">
            实付总额：
            <span class="red">
                <?php echo $count[ 'total_money']?>
            </span>
            元&nbsp;&nbsp;商户收入：
            <span class="blue">
                <?php echo $count[ 'user_money']?>
            </span>
            元&nbsp;&nbsp;代理收入：
            <span class="green">
                <?php echo $count[ 'agent_money']?>
            </span>
            元&nbsp;&nbsp;
        </div>
    </div> </div>
    </div> </div></div></div>
    <?php require_once 'footer.php' ?>