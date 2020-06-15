<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            代理付款记录
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <select name="is_state" class="form-control">
                        <option value="-1">
                            全部状态
                        </option>
                        <option value="0" <?php echo $search['is_state']=='0' ? ' selected' : ''?>
                            >待处理
                        </option>
                        <option value="1" <?php echo $search['is_state']=='1' ? ' selected' : ''?>
                            >已付款
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="kw" placeholder="代理名/用户号/序号"
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
                    <th width="100">
                        记录序号
                    </th>
                    <th>
                        代理名
                    </th>
                    <th>
                        结算类型
                    </th>
                    <th>
                        开户名称
                    </th>
                    <th>
                        收款银行
                    </th>
                    <th>
                        <a href="?by=money&sort=<?php echo $by=='money' && $sort ? 0 : 1 ?>">
                            <font color="#ffffff">付款金额
                            <span class="glyphicon glyphicon-triangle-<?php echo $by=='money' &&$sort ? 'bottom' : 'top'?>">
                            </span></font>
                        </a>
                    </th>
                    <th>
                        <a href="?by=fee&sort=<?php echo $by=='fee' &&$sort ? 0 : 1 ?>">
                            <font color="#ffffff">手续费
                            <span class="glyphicon glyphicon-triangle-<?php echo $by=='fee' &&$sort ? 'bottom' : 'top'?>">
                            </span></font>
                        </a>
                    </th>
                    <th>
                        实付金额
                    </th>
                    <th>
                        账单状态
                    </th>
                    <th>
                        创建时间
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):$users=$this->model()->select('username,ship_type')->from('users')->where(array('fields'=>'id=?','values'=>array($val['userid'])))->fetchRow();?>
                        <tr data-id="<?php echo $val['id']?>">
                            <td>
                                <?php echo $val['sn']?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle" id="menulist" data-toggle="dropdown"
                                    aria-expanded="true">
                                        <?php echo $users['username']?>
                                            <span class="caret">
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="menulist">
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('基本信息','<?php echo $this->dir?>agent/getuserinfo/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;基本信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('设置分成比率','<?php echo $this->dir?>agent/getuserprice/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;分成比率
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('收款信息','<?php echo $this->dir?>agent/getbadata/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;收款信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('接入信息','<?php echo $this->dir?>agent/getapidata/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;接入信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->dir?>agentlogs/?uname=<?php echo $users['username']?>">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;登陆日志
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->dir?>users/?superid=<?php echo $val['userid']?>">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;下级用户
                                                    </a>
                                                </li>
                                            </ul>
                                </div>
                            </td>
                            <td>
                                <?php echo $this->setConfig->shipType($users['ship_type'])?>
                            </td>
                            <td>
                                <?php echo $val['realname']?>
                            </td>
                            <td>
                                <?php echo $val['batype']?>
                            </td>
                            <td class="green">
                                <?php echo $val['money']?>
                                    元
                            </td>
                            <td class="blue">
                                <?php echo $val['fee']?>
                                    元
                            </td>
                            <td class="red">
                                <?php echo $val['money']-$val['fee']?>
                                    元
                            </td>
                            <td>
                                <?php if($val['is_state']=='0' ):?>
                                    <span class="label label-warning">
                                        待处理
                                    </span>
                                    <?php else:?>
                                        <span class="label label-success">
                                            已付款
                                        </span>
                                        <?php endif;?>
                            </td>
                            <td>
                                <?php echo date( 'm-d H:i:s',$val['addtime'])?>
                            </td>
                            <td>
                                <a href="javascript:;" onclick="showContent('付款给代理','<?php echo $this->dir?>agentpay/pay/<?php echo $val['id']?>');"
                                class="btn btn-danger btn-sm">
                                    <span class="glyphicon glyphicon-credit-card">
                                    </span>
                                    &nbsp;付款
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="11">
                                        no data.
                                    </td>
                                    <?php endif;?>
            </tbody>
        </table>
    </div>
    <?php echo $lists ? $pagelist : '' ?>
        <?php require_once 'footer.php' ?>