<?php require_once 'header.php' ?>
    <div class="row wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <em class="fa fa-list">
                                        </em>
                             <?php echo $title ?>
                               
                       
                </div>
                            </div>
          
  
            <div class="panel-body">
			 &nbsp;&nbsp;
                        <span style="margin-top:-20px;margin-bottom:20px;text-align:center;font-size:12px;color:#666">
                            提交订单数：
                            <span class="blue"> <?php echo $count['total_orders']?>
                            </span>
                            &nbsp;&nbsp;订单总金额：
                            <span class="blue">
                                &yen;
                                <?php echo number_format($count['total_money'],2, '.', '')?>
                            </span>
                            &nbsp;&nbsp;已付订单数：
                            <span class="green"><?php echo $count['success_orders']?>
                            </span>
                            &nbsp;&nbsp;已付总金额：
                            <span class="green">&yen;<?php echo number_format($count['success_money'],2, '.', '')?>
                            </span>
                            &nbsp;&nbsp;预计收入:<span class="green">&yen;<?php echo number_format($count['income_user'],2, '.', '')?>
                            </span>
                            &nbsp;&nbsp;未付订单数：
                            <span class="red"> <?php echo $count['total_orders']-$count['success_orders'] ?>
                            </span>
                          未付总金额：
                            <span class="red">&yen;<?php echo number_format($count['total_money']-$count['success_money'],2, '.', '')?>
                            </span>
                            &nbsp;&nbsp;
                        </span><br><br>
                                    <form method="get" class="form-inline m-b-xs" action="" method="get">
                <div class="form-group">
                    <select name="is_state" class="form-control">
                        <option value="-1" <?php echo $search['is_state']=='-1' ? ' selected' : ''?>>全部
                        </option>
                        <option value="0" <?php echo $search['is_state']=='0' ? ' selected' : ''?>>未付款
                        </option>
                        <option value="1" <?php echo $search['is_state']=='1' ? ' selected' : ''?>>已付款
                        </option>
                    </select>
                </div>
                &nbsp;&nbsp;
                <div class="form-group">
                    <select class="form-control" name="accid">
                        <option value="0">
                            全部通道
                        </option>
                        <?php foreach($acc as $key=>
                            $val):?>
                            <option value="<?php echo $val['id']?>" <?php echo $val['id']==$search[
                            'accid'] ? ' selected' : ''?>>
                                <?php echo $val['name']?>
                            </option>
                            <?php endforeach;?>
                    </select>
                </div>
                &nbsp;&nbsp;
                <div class="form-group">
                    <input type="text" class="form-control" name="sdorderno" placeholder="商户订单号"
                    value="<?php echo $search['sdorderno']?>" size="15">
                </div>
                &nbsp;&nbsp;
                <div class="form-group">
                    <input type="text" class="form-control" name="sdpayno" placeholder="平台订单号"
                    value="<?php echo $search['sdpayno']?>" size="15">
                </div>
                &nbsp;&nbsp;
                <div class="form-group">
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
                </div>
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    &nbsp;立即查询
                </button>
            </form>
  
        <?php if($search['is_state']=='1' ): ?>
            <div class="cb-title">
                <span class="glyphicon glyphicon-stats">
                </span>
                &nbsp;订单对比&nbsp;&nbsp;
                <span style="margin-top:-20px;margin-bottom:20px;text-align:center;font-size:12px;color:#666">
                    昨日此时订单：
                    <span class="red">
                        <?php echo $yestoday_orders ?>
                    </span>
                    &nbsp;&nbsp;今日此时订单：
                    <span class="red">
                        <?php echo $count['success_orders']?>
                    </span>
                    &nbsp;&nbsp;
                    <?php echo ($result_order=$count['success_orders']-$yestoday_orders)>
                        0 ? '
                        <span class="green">
                            ↑'.$result_order.'
                        </span>
                        ' : '
                        <span class="red">
                            ↓'.($yestoday_orders-$count['success_orders']).'
                        </span>
                        '?>&nbsp;&nbsp;昨日此时金额：
                        <span class="red">
                            <?php echo $yestoday_money['realmoney'] ?>
                        </span>
                        &nbsp;&nbsp;今日此时金额：
                        <span class="red">
                            <?php echo $count['success_money']?>
                        </span>
                        &nbsp;&nbsp;
                        <?php echo ($result_money=$count['success_money']-$yestoday_money['realmoney'])>0 ? '<span class="green">↑'.$result_money.' </span>' : '<span class="red">↓'.($yestoday_money['realmoney']-$count['success_money']).'</span>'?>
                </span>
            </div>
            <?php endif?>
                     <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                    
                            <tr>
                                <th>
                                    订单时间
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
                                    收入金额
                                </th>
                                <th>
                                    付款渠道
                                </th>
                                <th>
                                    订单状态
                                </th>
                                <th>
                                    通知状态
                                </th>
                                <th>
                                    通知
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($lists):?>
                                <?php foreach($lists as $key=>$val):$orderinfo=$this->model()->select('remark')->from('orderinfo')->where(array('fields'=>'id=?','values'=>array($val['orderinfoid'])))->fetchRow();$remark=$orderinfo ? $orderinfo['remark'] : '-';$acc=$this->model()->select('name')->from('acc')->where(array('fields'=>'id=?','values'=>array($val['channelid'])))->fetchRow();$cname=$acc  ? $acc['name'] : '-';switch($val['is_state']){case 0: $state='
                                    <span class="label label-warning">未付 </span>'; break;case 1: $state='<span class="label label-success"> 已付 </span>'; break;case 2: $state=' <span class="label label-danger">冻结</span>'; break;default:$state='-';}$notifyMsg='-';$notify=$this->model()->select('is_status')->from('ordernotify')->where(array('fields'=>'orid=?','values'=>array($val['id'])))->fetchRow();if($notify){switch($notify['is_status']){case '0': $notifyMsg='<span class="label label-warning">等待 </span>'; break;case '1': $notifyMsg=' <span class="label label-success">成功 </span>'; break;case '2': $notifyMsg='
                                    <span class="label label-danger">失败</span>'; break;}}?>
                                    <tr>
                                        <td class="text-center blue">
                                            <?php echo date( 'm-d H:i:s',$val['addtime'])?>
                                        </td>
                                             <td class="text-center ">
                                            <?php echo $val['sdorderno']?>
                                                <br>
                                                <span class="gray">
                                                    <?php echo $remark ?>
                                                </span>
                                        </td>
                                             <td class="text-center">
                                            <?php echo $val['orderid']?>
                                        </td>
                                             <td class="text-center">
                                            <?php echo $val['total_fee']?>
                                        </td>
                                        <td class="text-center green">
                                            <?php echo $val['realmoney']?>
                                        </td>
                                        <td class="text-center green">
                                            <?php echo $val['realmoney']*$val['uprice']?>
                                        </td>
                                             <td class="text-center">
                                            <?php echo $cname ?>
                                        </td>
                                             <td class="text-center">
                                            <?php echo $state ?>
                                        </td>
                                             <td class="text-center">
                                            <?php echo $notifyMsg ?>
                                        </td>
                                             <td class="text-center">
                                            <a href="javascript:;" onclick="refresh('<?php echo $val['orderid']?>')">
                                                <span class="glyphicon glyphicon-refresh" data-toggle="tooltip" title="通知">
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                        <?php else:?>
                                              <tr>
                                                    <td class="text-center" colspan="10">
                                                        <h4>
                                                            暂无记录
                                                        </h4>
                                                    </td>
                                                </tr>
                                            <?php endif;?>
                        </tbody>
                    </table>
                  
                </div> <?php if($lists):?>
					 <div class="dataTables_paginate">
                                        <ul class="pagination">
                            <?php echo $pagelist ?>
							</u>
                        </div>
                        <?php endif;?>
    </div>
	    </div>
		
		    </div>
			
			    </div>
				
				    </div>
						 
						</div>
    <script>
        function refresh(sdpayno) {
            $.post('/member/orders/refresh', {
                sdpayno: sdpayno,
                t: new Date().getTime()
            },
            function(ret) {
                alert(ret);
            });
        }
    </script>

                               
    <?php require_once 'footer.php' ?>