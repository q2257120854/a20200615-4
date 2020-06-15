<?php require_once 'header.php' ?>
    <style>
        .table td{height: 50px}a.current{color:red}
    </style>
    <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                          统计
               
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
                </div><hr> <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    &nbsp;立即查询
                </button>
                &nbsp;&nbsp;
                <a href="?day=1" <?php echo $search[ 'day']=='1' ? ' class="current"' : ''?>>今天
                </a>
                <span class="v-line">
                    |
                </span>
                <a href="?day=2" <?php echo $search[ 'day']=='2' ? ' class="current"' : ''?>
                    >昨天
                </a>
                <span class="v-line">
                    |
                </span>
                <a href="?day=7" <?php echo $search[ 'day']=='7' ? ' class="current"': ''?> >7天
                </a>
                <span class="v-line">
                    |
                </span>
                <a href="?day=30" <?php echo $search[ 'day']=='30' ? ' class="current"' : ''?>
                    >30天
                </a>
            </form>
			<hr><span style="margin-bottom:2;font-size:14px;color:#333">
                    实付总额：
                    <span class="red">
                        <?php echo $count[ 'total_money']?>
                    </span>
                    元&nbsp;&nbsp;商户收入：
                    <span class="blue">
                        <?php echo $count[ 'user_money']?>
                    </span>
                    元&nbsp;&nbsp;
                </span>
				<hr>

               
     
                                                 <div class="table-responsive">
                                        <table class="table table-bordered">
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
                            付款渠道
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>$val):$acc=$this->model()->select('name')->from('acc')->where(array('fields'=>'id=?','values'=>array($val['channelid'])))->fetchRow();$cname=$acc
                            ? $acc['name'] : '-';?>
                            <tr>
                                    <td class="text-center blue">
                                    <?php echo date('m-d H:i:s',$val['addtime'])?>
                                </td>
                                    <td class="text-center">
                                    <?php echo $val['userid']?>
                                </td>
                                     <td class="text-center">
                                    <?php echo $val['sdorderno']?>
                                </td>
                                <td class="text-center red">
                                    <?php echo $val['realmoney']?>
                                </td>
                                <td class="text-center blue">
                                    <?php echo $val['realmoney']*$val[ 'uprice']?>
                                </td>
                                    <td class="text-center">
                                    <?php echo $cname ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            暂无记录
                                        </td>
                                    </tr>
                                    <?php endif;?>
                </tbody>
            </table>
          
        </div>
		  <?php if($lists):?>
            
                    <?php echo $pagelist ?>
   
              
                <?php endif;?>
    </div></div></div></div></div></div>
    <?php require_once 'footer.php' ?>