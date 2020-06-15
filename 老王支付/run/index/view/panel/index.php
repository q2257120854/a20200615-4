<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
$fix = DB_PREFIX;
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
    <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/style.css" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/font-awesome.min.css" />
    <script src="<?php echo URL_VIEW;?>/static/js/assset/jquery.min.js"></script>
    <script src="<?php echo URL_VIEW;?>/static/js/assset/bootstrap.min.js"></script>

    <title>商户管理中心</title>
</head>

<body>
<div class="page-content clearfix">
   
    <div class="state-overview clearfix">
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="symbol terques">
                        <i class="icon-dollar"></i>
                    </div>
                    <div class="value">
                        <p class="card-money"><?php echo $_SESSION['MEMBER']['balance'];?></p>
                        <p class="card-text">账户余额(元)</p>
                    </div>
                </div>
        </div>
        </div>
    </div>
    <div id="card-stats">
        <div class="row">
           
       <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-core">
                        <div class="card-core-left card-left-red">
                        <p class="card-stats-title"><i class="mdi-maps-local-florist"></i> 支付宝固码</p>
                        <h4 class="card-stats-number"> <?php
                            $account = $mysql->select("select count(id) as count from {$fix}client_alipaygm_automatic_account where user_id={$_SESSION['MEMBER']['uid']}")[0];
                            echo $account['count'];
                            ?></h4>
                        </div>
                        <div class="card-core-right ">
                            <p class="card-money">
                                <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                                $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipaygm_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                echo number_format($order['money'],3);
                                ?>
                            </p>
                            <span class="card-text">今日交易额(元)</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    
  
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-core">
                        <div class="card-core-left card-left-yellow">
                        <p class="card-stats-title"><i class="mdi-action-trending-up"></i> 服务订单</p>
                        <h4 class="card-stats-number"><?php
                            $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                            $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}service_order where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                            echo $order['count'];
                            ?></h4>
                        </div>
                        <div class="card-core-right">
                            <p class="card-money">
                                <?php echo number_format($order['money'],3);?>
                            </p>
                            <span>今日盈利(元)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-core">
                    <div class="card-core-left card-left-blue">
                        <p class="card-stats-title"><i class="mdi-editor-attach-money"></i> 我的盈利</p>
                        <h4 class="card-stats-number"><?php echo $_SESSION['MEMBER']['money'];?></h4>
                    </div>
                        <div class="card-core-right">
                            <p class="card-money">
                                <?php
                                $order = $mysql->select("select sum(amount) as money from {$fix}client_withdraw where types=2 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                echo $order['money'];
                                ?>
                            </p>
                            <span>总提现金额(元)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="state-overview clearfix">
      
        <div class="col-lg-4 col-sm-6">
            <section class="panel">
                <div class="card-content">
                    <span class="card-title">商户信息</span>
                    <p><i class="icon-user"></i> <span style="color: green;">商户ID：<?php echo $_SESSION['MEMBER']['uid'];?></span></p>
                    <p><i class="icon-eye-open"></i> S_KEY：<span id="skey" style="color: red;"><a onclick="skey();">已隐藏,点击查看</span></a></p>
                    <script type="text/javascript">
                        function skey() {
                            $('#skey').text('<?php echo $_SESSION['MEMBER']['key_id'];?>');
                        }
                    </script>
                    <p><i class="icon-phone"></i> 手机号：<?php echo $_SESSION['MEMBER']['phone'];?></p>
                </div>
            </section>
        </div>
       
    <div style="height:20px"></div>
    <div class="state-overview clearfix">
        <div class="col-lg-6 col-sm-12">
            <ul id="projects-collection" class="collection">
                <li class="collection-item avatar">
                    <i class="icon-th-large circle light-blue darken-2"></i>
                    <span class="collection-header">我的服务订单</span>
                    <p>My Service order</p>
                </li>
                <?php foreach ($service_order as $order){?>

                    <li class="collection-item">
                        <div class="row">
                            <div class="col s6">
                                <p class="collections-title">交易金额：<span style="color:red;"><?php echo $order['amount'];?></span></p>
                                <p class="collections-content">流水单号：<?php echo $order['trade_no'];?></p>
                            </div>
                            <div class="col s3">
                                <?php
                                if ($order['status'] == 1) echo '<span class="task-cat cyan">未支付</span>';
                                if ($order['status'] == 2) echo '<span class="task-cat cyan">未支付</span>';
                                if ($order['status'] == 3) echo '<span class="task-cat grey darken-3">订单超时</span>';
                                if ($order['status'] == 4) echo '<span class="task-cat green">已支付</span>';
                                ?>
                            </div>
                            <div class="col s3">
                                创建时间：<?php echo date("Y/m/d H:i:s",$order['creation_time']);?><br>
                                订单信息：<?php echo $order['out_trade_no'];?>
                            </div>
                        </div>
                    </li>

                <?php }?>
            </ul>
        </div>
        <div class="col-lg-6 col-sm-12">
            <ul id="issues-collection" class="collection">
                <li class="collection-item avatar">
                    <i class="icon-credit-card circle red darken-2"></i>
                    <span class="collection-header">我的提现</span>
                    <p>My withdrawal</p>
                </li>
                <?php foreach ($withdrawal as $with){?>
                    <li class="collection-item">
                        <div class="row">
                            <div class="col s4">
                                <p class="collections-title">提现金额：<span style="color:red;"><?php echo $with['amount'];?></span></p>
                                <p class="collections-content">流水单号：<?php echo $with['flow_no'];?></p>
                            </div>
                            <div class="col s3">
                                提现时间：<?php echo date("Y/m/d H:i:s",$with['apply_time']);?><br>
                                订单信息：<?php echo $with['deal_time'] == 0 ? '银行处理中' : date("Y/m/d H:i:s",$with['deal_time']);?>
                            </div>
                            <div class="col s5" style="position:relative;right:-100px;">

                                提现状态：<?php
                                if ($with['types'] == 1) echo '<span style="color:#039be5;">银行正在处理</span>';
                                if ($with['types'] == 2) echo '<span style="color:green;">已经到账</span>';
                                if ($with['types'] == 3) echo '<span style="color:#bdbdbd;">银行驳回</span>';
                                if ($with['types'] == 4) echo '<span style="color:red;">流水异常</span>';
                                ?><br>
                                银行反馈：<?php echo $with['content'];?>
                            </div>
                        </div>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
</body>

</html>