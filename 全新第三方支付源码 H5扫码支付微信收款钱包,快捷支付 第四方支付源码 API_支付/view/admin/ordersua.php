<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            商户订单统计
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="kw" placeholder="用户名/编号"
                    value="<?php echo $search['kw']?>">
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
                    <a href="?by=userid&sort=<?php echo $by=='userid' && $sort ? 0 : 1 ?>">
                        <font color="#ffffff">用户编号
                        <span class="glyphicon glyphicon-triangle-<?php echo $by=='userid' && $sort ? 'bottom' : 'top'?>">
                        </span></font>
                    </a>
                </th>
                <th>
                    <a href="?by=total_orders&sort=<?php echo $by=='total_orders' && $sort ? 0 : 1 ?>">
                        <font color="#ffffff">订单总数
                        <span class="glyphicon glyphicon-triangle-<?php echo $by=='total_orders' && $sort ? 'bottom' : 'top'?>">
                        </span></font>
                    </a>
                </th>
                <th>
                    <a href="?by=total_fee&sort=<?php echo $by=='total_fee' && $sort ? 0 : 1 ?>">
                        <font color="#ffffff">订单总额
                        <span class="glyphicon glyphicon-triangle-<?php echo $by=='total_fee' && $sort ? 'bottom' : 'top'?>">
                        </span></font>
                    </a>
					
                </th>
                <th>
                    <a href="?by=total_income&sort=<?php echo $by=='total_income' && $sort ? 0 : 1 ?>">
                        <font color="#ffffff">订单收入总额
                        <span class="glyphicon glyphicon-triangle-<?php echo $by=='total_income' && $sort ? 'bottom' : 'top'?>">
                        </span></font>
                    </a>
                </th>
                <th>
                    <a href="?by=pt_income&sort=<?php echo $by=='pt_income' && $sort ? 0 : 1 ?>">
                        <font color="#ffffff">平台收入总额
                        <span class="glyphicon glyphicon-triangle-<?php echo $by=='pt_income' && $sort ? 'bottom' : 'top'?>">
                        </span></font>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if($lists):?>
                <?php foreach($lists as $key=>$val):?>
                    <tr data-id="<?php echo $val['userid']?>">
                        <td>
                            <div class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" id="menulist" data-toggle="dropdown"
                                aria-expanded="true">
                                    <?php echo $val['userid']?>
                                        <span class="caret">
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="menulist">
                                            <li>
                                                <a href="javascript:;" onclick="showContent('基本信息','<?php echo $this->dir?>users/getuserinfo/<?php echo $val['userid']?>')">
                                                    <span class="glyphicon glyphicon-triangle-right">
                                                    </span>
                                                    &nbsp;基本信息
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="showContent('设置分成比率','<?php echo $this->dir?>users/getuserprice/<?php echo $val['userid']?>')">
                                                    <span class="glyphicon glyphicon-triangle-right">
                                                    </span>
                                                    &nbsp;分成比率
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="showContent('收款信息','<?php echo $this->dir?>users/getbadata/<?php echo $val['userid']?>')">
                                                    <span class="glyphicon glyphicon-triangle-right">
                                                    </span>
                                                    &nbsp;收款信息
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="showContent('接入信息','<?php echo $this->dir?>users/getapidata/<?php echo $val['userid']?>')">
                                                    <span class="glyphicon glyphicon-triangle-right">
                                                    </span>
                                                    &nbsp;接入信息
                                                </a>
                                            </li>
                                        </ul>
                            </div>
                        </td>
                        <td>
                            <?php echo $val['total_orders']?> 
                        </td>
                      <td>
                            <?php echo $val['total_fee']?>
                        </td>
                        <td>
                            <?php echo number_format($val['total_income'],2, '.', '')?>
                        </td>
                        <td>
                            <?php echo number_format($val['pt_income'],2, '.', '')?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                        <?php $total_orders=$total_fee=$total_income=$pt_income=0;foreach($total_count
                        as $key=>
                            $val){$total_orders+=$val['total_orders'];$total_fee+=$val['total_fee'];$total_income+=$val['total_income'];$pt_income+=$val['pt_income'];}?>
                            <tr class="active">
                                <td>
                                    总统计：
                                </td>
                                <td class="red">
                                    <?php echo $total_orders?>
                                </td>
                                <td class="blue">
                                    <?php echo $total_fee?>
                                </td>
                                <td class="green">
                                    <?php echo number_format($total_income,2, '.', '')?>
                                </td>
                                <td class="orange">
                                    <?php echo number_format($pt_income,2, '.', '')?>
                                </td>
                            </tr>
                            <?php else:?>
                                <tr>
                                    <td colspan="5">
                                        no data.
                                    </td>
                                    <?php endif;?>
        </tbody>
    </table> </div>
    <?php echo $lists ? $pagelist : '' ?>
        <?php require_once 'footer.php' ?>