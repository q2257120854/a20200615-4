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
        <div class="content-box">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            账单生成时间
                        </th>
                        <th>
                            账单序号
                        </th>
                        <th>
                            账单金额
                        </th>
                        <th>
                            手续费
                        </th>
                        <th>
                            实付金额
                        </th>
                        <th>
                            账单状态
                        </th>
                        <th>
                            真实姓名
                        </th>
                        <th>
                            收款银行
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>
                            $val):switch($val['is_state']){case 0: $state='
                            <span class="label label-warning">
                                待处理
                            </span>
                            '; break;case 1: $state='
                            <span class="label label-success">
                                已付款
                            </span>
                            '; break;}?>
                            <tr>
                                <td>
                                    <?php echo date( 'm-d H:i:s',$val[ 'addtime'])?>
                                </td>
                                <td>
                                    <?php echo $val[ 'sn']?>
                                </td>
                                <td class="green">
                                    <?php echo $val[ 'money']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                                <td>
                                    <?php echo $val[ 'fee']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                                <td class="red">
                                    <?php echo $val[ 'money']-$val[ 'fee']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                                <td>
                                    <?php echo $state ?>
                                </td>
                                <td>
                                    <?php echo $val[ 'realname']?>
                                </td>
                                <td>
                                    <?php echo $val[ 'batype']?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            no data.
                                        </td>
                                    </tr>
                                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div></div>
    </div></div></div></div>
    <?php require_once 'footer.php' ?>