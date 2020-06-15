<?php require_once 'header.php' ?>
      <style type="text/css">
                    .panel{overflow: hidden;padding: 1px;} @media (min-width: 992px) and (max-width: 1024px){
                    .col-xs-6 .panel .panel-body h4{font-size: 12px;width: 100%;text-align:
                    center;margin-bottom: 0;} } @media (max-width: 668px){ .col-xs-6 .panel{margin-bottom:
                    10px;} .col-xs-6 .panel .panel-body{padding: 6px 4px;} .col-xs-6 .panel
                    .panel-body .img-circle .fa{font-size: 2.4em;} .col-xs-6 .panel .panel-body
                    h4{font-size: 12px;width: 100%;text-align: center;margin-bottom: 0;} .col-xs-4
                    .panel-body a.btn{padding: 6px;} .col-xs-4 .panel-body .btn .fa{display:
                    none;} .col-xs-4 .panel-body {padding: 8px 4px;} } .btn-pink { color: #fff;
                    background-color: #f532e5; border-color: transparent; } .btn-purple { color:
                    #fff; background-color: #7266ba; border-color: transparent; } .brand-primary
                    { background-color: #337ab7; } .brand-success { background-color: #5cb85c;
                    } .brand-info { background-color: #5bc0de; } .brand-warning { background-color:
                    #f0ad4e; } .brand-danger { background-color: #d9534f; } .img-circle .fa{color:
                    #fff;} .text-primary{color: #337ab7;} .text-danger{color: #d9534f;} .text-warning{color:
                    #f0ad4e;} .text-info{color: #5bc0de;} .text-success{color: #5cb85c;} .col-xs-4
                    .panel-body .btn.focus, .col-xs-4 .panel-body .btn:focus, .col-xs-4 .panel-body
                    .btn:hover { color: #2f4050; text-decoration: none; }
                </style>
                <div class="row wrapper wrapper-content">
                    <div class="row1">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
								<a href="/member/orders" style="text-decoration:none;"> 
                                    <div class="panel">
                                        <div class="panel-body brand-danger" style="background:#F05033;">
                                            <div class="text-center">
                                                <span class="img-circle">
                                                    <i class="fa fa-user fa-3x">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="panel-body">
										  
                                            <h4 class="pull-left">
                                                账户余额
                                            </h4>
                                            <h4 class="pull-right text-danger">
                                       
                                                  <?php echo number_format($unpaid, '2', '.', '')?> 元
													
                                          
                                            </h4>
                                        </div>
                                    </div> </a>
                                </div>
                                <div class="col-md-3 col-xs-6">
								<a href="/member/count?day=1"  style="text-decoration:none;">
                                    <div class="panel">
                                        <div class="panel-body brand-primary" style="background:#3498DB;">
                                            <div class="text-center">
                                                <span class="img-circle">
                                                    <i class="fa fa-usd fa-3x">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                          <h4 class="pull-left">
                                                今日收入
                                            </h4>
                                            <h4 class="pull-right text-danger">
                                     
                                                   <?php echo $today_income ?> 元
											</h4> 
                                        </div>
                                    </div>
                                </a></div>
                                <div class="col-md-3 col-xs-6">
								<a href="/member/orders?fdate=<?php echo date('Y-m-d').' 00:00'?>"  style="text-decoration:none;">
                                    <div class="panel">
                                        <div class="panel-body brand-info" style="background:#8E44AD;">
                                            <div class="text-center">
                                                <span class="img-circle">
                                                    <i class="fa fa-bar-chart fa-3x">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <h4 class="pull-left">
                                                今日交易
                                            </h4>
                                           <h4 class="pull-right text-danger">
                                                             <?php echo $today_orders ?> 笔
                                            </h4>
                                        </div>
                                    </div> </a>
                                </div>
                                <div class="col-md-3 col-xs-6">
								<a href="/member/payments"  style="text-decoration:none;">
                                    <div class="panel">
                                        <div class="panel-body brand-info" style="background:#1FA67A;">
                                            <div class="text-center">
                                                <span class="img-circle">
                                                    <i class="fa fa-diamond fa-3x">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <h4 class="pull-left">
                                                已付金额
                                            </h4>
                                           <h4 class="pull-right text-danger">
                                                     <?php echo $this->userData['paid']?> 元
                                            </h4>
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="row">
                                           <?php if($this->
            userData['is_state']=='0'):?>
                   <div class="alert alert-warning" style="margin-bottom:0;">&nbsp;&nbsp;<span class="glyphicon glyphicon-info-sign"></span>&nbsp;
               &nbsp;&nbsp;您当前的账号状态为
                <span class="label label-danger">
                    未审核
                </span>
                ，请继续完善注册信息然后联系客服以便审核。
            </div>
            <?php else:?>
                <?php if($this->userData['ship_type']):?>
                       <div class="alert alert-warning" style="margin-bottom:0;">
                   &nbsp;&nbsp; <span class="glyphicon glyphicon-info-sign"style="margin-left:30px;"></span>
              
                      &nbsp;&nbsp;您当前的账号结算周期为：
                        <span class="label label-success">
                            <?php echo $this->setConfig->shipCycle($this->userData['ship_cycle'])?>
                        </span>
                        &nbsp;&nbsp;进入申请结算才可以划入余额提现。
                    </div>
                    <?php endif;?>
                        <?php endif;?>
										
								 </div>  	
										
                                 </div>         
                                </div>  
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <em class="fa fa-bell-o fa-fw">
                                                </em>
                                                最新公告
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="list-group">
                                               
                                                <?php if($notice):?>
                                            <?php foreach($notice as $key=>$val):?>
									
											   <a href="javascript:;" onclick="showContent('系统公告','/member/news/view/<?php echo $val['id']?>')" class="list-group-item">
                                                       <span class="pull-right">
                                                            [
                                                            <?php echo date( 'm-d',$val[ 'addtime'])?>
                                                                ]
                                                        </span>
                                                    <em class="fa fa-fw fa-volume-up mr">
                                                    </em>
                                                        <?php echo $val[ 'title']?>
                                                    </a>
												<?php endforeach;?>
                                                    <?php else:?>
                                                        <dd>
                                                           暂无数据
                                                        </dd>
                                                        <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <em class="fa fa-clock-o fa-fw">
                                                </em>
                                                最近登录日志
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                登陆时间
                                                            </th>
                                                            <th class="text-center">
                                                                登陆IP
                                                            </th>
                                                            <th class="text-center">
                                                                地区概要
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                         
                              <?php if($lists):?>
                        <?php foreach($lists as $key=>$val):?>
                            <tr>
                                <td class="text-center">
                                    <?php echo date( 'Y-m-d H:i:s',$val[ 'addtime'])?>
                                </td class="text-center">
                                      <td class="text-center">
                                    <?php echo $val[ 'ip']?>
                                </td class="text-center">
								         <td class="text-center">
                                    <?php echo $val[ 'address']?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
         <tr>    
					 <td class="text-center" colspan="5">
                                                                <h5>
                                                                  暂无数据
                                                                </h5>
                                                            </td>
                                    <?php endif;?>
                                             
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <a href="/member/userlogs" class="btn btn-default btn-sm">
                                                查看更多
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <em class="fa fa-clock-o fa-fw">
                                                </em>
                                                结算记录TOP5
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                提交时间
                                                            </th>
                                                            <th class="text-center">
                                                                结算金额
                                                            </th>
                                                            <th class="text-center hidden-cx">
                                                                手续费
                                                            </th>
                                                            <th class="text-center">
                                                                结算模式
                                                            </th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													  <?php if($payments):?>
                        <?php foreach($payments as $key=>$val):switch($val['is_state']){case 0: $state='
                            <span class="label label-warning">
                                '.$this->setConfig->billState($val['is_state']).'
                            </span>
                            ';break;case 1: $state='
                            <span class="label label-success">
                                '.$this->setConfig->billState($val['is_state']).'
                            </span>
                            ';break;case 2: $state='
                            <span class="label label-default">
                                '.$this->setConfig->billState($val['is_state']).'</span>
                            ';break;case 3: $state='
                            <span class="label label-danger">
                                '.$this->setConfig->billState($val['is_state']).'</span>';break;}?>
                            <tr>
                                    <td class="text-center">
                                    <?php echo date( 'm-d H:i:s',$val[ 'addtime'])?>
                                </td>
                  
                                <td class="text-center green">
                                    <?php echo $val[ 'money']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                                 <td class="text-center">
                                    <?php echo $val[ 'fee']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                    
                                  <td class="text-center">
                                    <?php echo $state ?>
                                </td>
              
                            </tr>
                            <?php endforeach;?>
                                <?php else:?>
                     <tr>    
					 <td class="text-center" colspan="3">
                                                                <h5>
                                                                    没有结算记录
                                                                </h5>
                                                            </td>
                                                        </tr>
                                    <?php endif;?>
									
									
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <a href="/member/payments" class="btn btn-default btn-sm">
                                                查看更多
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		               
    <?php require_once 'footer.php' ?>