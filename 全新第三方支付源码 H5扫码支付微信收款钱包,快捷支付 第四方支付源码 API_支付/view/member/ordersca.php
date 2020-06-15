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
            <form class="form-inline m-b-xs" action="" method="get">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
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
                           <i class="fa fa-search"></i>
					     
                    &nbsp;立即查询
                </button>
            </form>
        <div class="table-responsive">
                                        <table class="table table-bordered">
			<thead>
                    <tr>
                        <th>
                            <a class="blue" href="?fdate=<?php echo $search['fdate']?>&tdate=<?php echo $search['tdate']?>&by=channelid&sort=<?php echo $by=='channelid' && $sort ? 0 : 1 ?>">
                                通道编号
                                <span class="glyphicon glyphicon-triangle-<?php echo $by=='channelid' && $sort ? 'bottom' : 'top'?>">
                                </span>
                            </a>
                        </th>
                        <th>
                            <a class="blue" href="?fdate=<?php echo $search['fdate']?>&tdate=<?php echo $search['tdate']?>&by=total_orders&sort=<?php echo $by=='total_orders' && $sort ? 0 : 1 ?>">
                                订单总数
                                <span class="glyphicon glyphicon-triangle-<?php echo $by=='total_orders' && $sort ? 'bottom' : 'top'?>">
                                </span>
                            </a>
                        </th>
                        <th>
                            <a class="blue" href="?fdate=<?php echo $search['fdate']?>&tdate=<?php echo $search['tdate']?>&by=total_fee&sort=<?php echo $by=='total_fee' && $sort ? 0 : 1 ?>">
                                订单总额
                                <span class="glyphicon glyphicon-triangle-<?php echo $by=='total_fee' && $sort ? 'bottom' : 'top'?>">
                                </span>
                            </a>
                        </th>
                        <th>
                            <a class="blue" href="?fdate=<?php echo $search['fdate']?>&tdate=<?php echo $search['tdate']?>&by=total_income&sort=<?php echo $by=='total_income' && $sort ? 0 : 1 ?>">
                                订单收入总额
                                <span class="glyphicon glyphicon-triangle-<?php echo $by=='total_income' && $sort ? 'bottom' : 'top'?>">
                                </span>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php $total[ 'orders']=0;$total[ 'money']=0;$total[ 'income']=0;foreach($lists
                        as $key=>
                            $val):$total['orders']+=$val['total_orders'];$total['money']+=$val['total_fee'];$total['income']+=$val['total_income'];$acc=$this->model()->select('name')->from('acc')->where(array('fields'=>'id=?','values'=>array($val['channelid'])))->fetchRow();$cname=$acc
                            ? $acc['name'] : '-';?>
                            <tr data-id="<?php echo $val['channelid']?>">
                                <td>
                                    <?php echo $cname?>
                                </td>
                                <td>
                                    <?php echo $val[ 'total_orders']?>
                                </td>
                                <td>
                                    <?php echo $val[ 'total_fee']?>
                                </td>
                                <td>
                                    <?php echo number_format($val[ 'total_income'],2, '.', '')?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <tr class="active">
                                    <td class="gray">
                                        总计：
                                    </td>
                                    <td class="red">
                                        <?php echo $total[ 'orders']?>
                                    </td>
                                    <td class="blue">
                                        <?php echo $total[ 'money']?>
                                            元
                                    </td>
                                    <td class="green">
                                        <?php echo $total[ 'income']?>
                                            元
                                    </td>
                                </tr>
                                <?php else:?>
								   <tr>
                                        <td colspan="4" class="text-center">
                                            暂无记录
                                        </td>
                                    </tr>
                                  
                                        <?php endif;?>
                </tbody>
            </table>
        </div>
    </div></div></div></div></div></div>
    <?php require_once 'footer.php' ?>