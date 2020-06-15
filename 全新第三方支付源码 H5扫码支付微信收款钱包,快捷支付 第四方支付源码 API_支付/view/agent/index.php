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
            <div class="row">
                <div class="col-md-12">
 <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
								<a href="/agent/orders">
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
                                        <?php echo number_format($unpaid, '2', '.', '')?>
                                    </h4>
                                   
                                        </a>
                                
                                        </div>
                                    </div>
                                </div>
                           <div class="col-md-3 col-xs-6">
						   <a href="/agent/payments">
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
                                        已付金额
                                    </h4>
                                            <h4 class="pull-right text-primary">
                                        <?php echo $this->userData['paid']?>
                                    </h4>
                                   
                                        </a>
                                   
                                 </div>
                                    </div>
                                </div>
                             <div class="col-md-3 col-xs-6">
							 <a href="/agent/orders?fdate=<?php echo date('Y-m-d').' 00:00'?>">
                                    <div class="panel">
                                        <div class="panel-body brand-primary" style="background:#8E44AD;">
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
                                            <h4 class="pull-right text-primary">
                                        <?php echo $today_orders ?>
                                     </h4>
                                   
                                        </a>
                                   
                                </div>
                                    </div>
                                </div>
                            <div class="col-md-3 col-xs-6">
							<a href="/agent/count?day=1">
                                    <div class="panel">
                                        <div class="panel-body brand-primary" style="background:#1FA67A;">
                                            <div class="text-center">
                                                <span class="img-circle">
                                                   <i class="fa fa-diamond fa-3x">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <h4 class="pull-left">
                                        今日收入
                                     </h4>
                                            <h4 class="pull-right text-primary">
                                        <?php echo $today_income ?>
                                    </h4>
                                   
                                        </a>
                                    </p>
                                </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
				
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="row">
                                           <?php if($this->
            userData['is_state']=='0'):?>
                   <div class="alert alert-warning" style="margin-bottom:0;">&nbsp;
                &nbsp;您当前的账号状态为
                <span class="label label-danger">
                    未审核
                </span>
                ，请继续完善注册信息然后联系客服以便审核。
            </div>
            <?php else:?>
                <?php if($this->userData['ship_type']):?>
                       <div class="alert alert-warning" style="margin-bottom:0;">
                    <span class="glyphicon glyphicon-info-sign"style="margin-left:30px;"></span>
              
                        &nbsp;您当前的账号结算周期为：
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
                        &nbsp;系统公告
                   </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="list-group">
                            <?php if($notice):?>
                                <?php foreach($notice as $key=>$val):?>
                                    
                                        <a href="javascript:;" onclick="showContent('系统公告','/agent/news/view/<?php echo $val['id']?>')" class="list-group-item">
                                           <span class="pull-right">
                                                [
                                                <?php echo date( 'm-d',$val[ 'addtime'])?>
                                                    ]
                                            </span><em class="fa fa-fw fa-volume-up mr">
                                                    </em>
                                            &nbsp;
                                            <?php echo $val[ 'title']?>
                                        </a>
                                    </dd>
                                    <?php endforeach;?>
                                        <?php else:?>
                                            <dd>
                                                no data.
                                            </dd>
                                            <?php endif;?>
                       </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div></div>
    <?php require_once 'footer.php' ?>