<?php if(!defined( 'WY_ROOT'))exit; ?>
    <!doctype html>
    <html>
        
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title>
                <?php echo $this->config['sitename'] ?>
            </title>
            <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
            <link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
            <style>
                html,body,div,p,span,ul,ol,dl,h1,h2,h3,h4,h5,h6{margin:0;padding: 0}body{font-family:
                微软雅黑,'Microsoft Yahei';background: #eee}ul,ol{list-style: none}img{border:
                0;outline: none}a{color:#6B6D6E}a:hover{color:#CD1C20;text-decoration:
                none}#header{background: #fff;border-bottom: 1px solid #ddd;height: 65px}#header
                .logo{line-height: 55px}#header .logo span{font-size: 1.4em;margin-left:
                10px;position: absolute;margin-top:4px;color:#337AB7}#main{margin-top:30px;}#main
                .content{background: #fff;border:1px solid #ddd;padding:40px 45px;;border-radius:
                3px}.paymoney{padding-top:20px}.bf{font-size:1.3em}.bf1{font-size: 2em;color:#CD1C20;letter-spacing:
                2px}.bf1 span{font-size: 0.5em;color:#6B6D6E}dl.payinfo dd{line-height:
                25px}.pay_list{padding-top:30px;padding-left:40px;padding-bottom:30px;border:1px
                solid #eee;border-top:0}.pay_list ul li img{border:1px solid #ddd}.pay_list
                ul li{float:left;margin:5px 45px 5px 0;cursor: pointer}.pay_list ul li
                img:hover{border:1px solid #CD1C20}.pay_list ul li.current img{border:1px
                solid #CD1C20}.pay img{border:1px solid #ddd}.select_pay{background: #337AB7;padding-top:5px;padding-left:20px}.select_pay
                ul li{float:left;margin-right:20px;color:#fff;line-height: 35px;cursor:
                pointer}.select_pay ul li.current{background:#fff;line-height: 40px;padding:0
                10px;border-top-left-radius: 3px;border-top-right-radius: 3px;color:#666}#footer{background:#263445;text-align:center;color:#8392A7;margin-top:30px;padding:20px
                0;}.red{color:#CD1C20}
            </style>
            <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
            </script>
            <script src="/static/common/bootstrap.min.js" type="text/javascript">
            </script>
        </head>
        
        <body>
            <div id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-1">
                            <div class="logo">
                                <img src="/static/default/images/logo.png">
                                <span>
                                    收银台
                                </span>
                                </logo>
                            </div>
                        </div>
                        <div class="col-md-6 text-right" style="font-size:12px">
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->config['qq']?>&site=qq&menu=yes"
                            target="_blank" class="red">
                                <p style="margin-top:15px">
                                    <?php echo $this->config['sitename']?>客服：
                                        <?php echo $this->config['qq']?>
                                </p>
                                <p>
                                    欺诈/洗钱/涉黄，请立即举报
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="payinfo">
                                            <dd class="bf">
                                                订单号：
                                                <span style="color:#CD1C20">
                                                    <?php echo $orders['sdorderno']?>
                                                </span>
                                            </dd>
                                            <dd>
                                                订单备注：
                                                <a href="http://<?php echo $userinfo['siteurl']?>" target="_blank">
                                                    <?php echo $orderinfo['remark']?>
                                                </a>
                                            </dd>
                                            <dd>
                                                商户信息：
                                                <?php echo $userinfo['sitename']?>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="paymoney bf1 text-right">
                                            &yen;
                                            <?php echo $orders['total_fee']?>
                                                <span>
                                                    元
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div style="border-bottom:2px solid #337AB7">
                                            <div style="float:right;width:80px;background:#337AB7;text-align:center;color:#fff;line-height:30px">
                                                订单详情
                                            </div>
                                            <div style="clear:right">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:30px">
                                        <form action="/checkout/subpay?sign=<?php echo $token?>" method="post"
                                        target="_blank">
                                            <input type="hidden" name="bankcode" value="">
                                            <input type="hidden" name="paytype" value="">
                                            <div class="bf">
                                                选择付款方式：
                                            </div>
                                            <br>
                                            <div class="select_pay">
                                                <ul>
                                                    <li class="current">
                                                        <img src="/static/default/images/icon_bank.png">
                                                        &nbsp;网银和即时支付
                                                    </li>
                                                    <?php if($cardlist):?>
                                                        <li>
                                                            <img src="/static/default/images/icon_card.png">
                                                            &nbsp;充值卡支付
                                                        </li>
                                                        <?php endif;?>
                                                </ul>
                                                <div style="clear:left">
                                                </div>
                                            </div>
                                            <div class="pay_list">
                                                <ul class="banklist v0">
                                                    <?php if($this->checkacc->isAccExist($userinfo['userid'],'alipay')):?>
                                                        <li>
                                                            <img src="/static/payimg/ALIPAY.gif" data-pid="alipay" data-pty="alipay">
                                                        </li>
                                                        <?php endif;?>
                                                            <?php if($this->checkacc->isAccExist($userinfo['userid'],'tenpay')):?>
                                                                <li>
                                                                    <img src="/static/payimg/TENPAY.gif" data-pid="tenpay" data-pty="tenpay">
                                                                </li>
                                                                <?php endif;?>
                                                                    <?php if($this->checkacc->isAccExist($userinfo['userid'],'weixin')):?>
                                                                        <li>
                                                                            <img src="/static/payimg/WEIXIN.gif" data-pid="weixin" data-pty="weixin">
                                                                        </li>
                                                                        <?php endif;?>
                                                                            <?php if($this->checkacc->isAccExist($userinfo['userid'],'qqrcode')):?>
                                                                                <li>
                                                                                    <img src="/static/payimg/QQ2.gif" data-pid="qqrcode" data-pty="qqrcode">
                                                                                </li>
                                                                                <?php endif;?>
                                                                                    <?php if($this->checkacc->isAccExist($userinfo['userid'],'bank')):?>
                                                                                        <?php foreach($banklist as $key=>
                                                                                            $val):?>
                                                                                            <li>
                                                                                                <img src="/static/payimg/<?php echo $val['img']?>" data-pid="<?php echo $val['code']?>"
                                                                                                data-pty="bank">
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                                <?php endif;?>
                                                </ul>
                                                <?php if($cardlist):?>
                                                    <ul class="cardlist v1" style="display:none">
                                                        <?php foreach($cardlist as $key=>
                                                            $val):?>
                                                            <li>
                                                                <img src="/static/payimg/<?php echo $val['img']?>" data-pid="<?php echo $val['gateway']?>"
                                                                data-pty="card">
                                                            </li>
                                                            <?php endforeach;?>
                                                    </ul>
                                                    <?php endif;?>
                                                        <div style="clear:left">
                                                        </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-danger btn-lg">
                                                    &nbsp;&nbsp;&nbsp;
                                                    <span class="glyphicon glyphicon-check">
                                                    </span>
                                                    &nbsp;确认付款&nbsp;&nbsp;&nbsp;
                                                </button>
                                            </div>
                                            <br>
                                            <br>
                                        </form>
                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                            重要提示：请尽快付款，30分钟内未付款的订单将会超时关闭。
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                付款提示
                            </h4>
                        </div>
                        <div class="modal-body">
                            如果您已付款成功，请点击查看付款结果。如果还未付款，请重新选择付款方式进行付款。
                        </div>
                        <div class="modal-footer">
                            <a href="/checkout/payresult?sign=<?php echo $token?>" class="btn btn-success">
                                查看付款结果
                            </a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                重新选择付款方式
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                &copy;2016&nbsp;
                <?php echo $this->config['sitename']?>&nbsp;版权所有&nbsp;
                    <?php echo $this->config['icpcode']?>
            </div>
            <script>
                $(function() {
                    var fp = $('.pay_list ul li').first();
                    fp.addClass('current');
                    $('[name=bankcode]').val(fp.find('img').attr('data-pid'));
                    $('[name=paytype]').val(fp.find('img').attr('data-pty'));
                    $('.pay_list ul li img').click(function() {
                        $('.pay_list ul li').removeClass('current');
                        $(this).parent().addClass('current');
                        $('[name=bankcode]').val($(this).attr('data-pid'));
                        $('[name=paytype]').val($(this).attr('data-pty'));
                    });
                    $('.select_pay li').click(function() {
                        $('.pay_list ul').hide();
                        $('.pay_list ul.v' + $(this).index()).show();
                        $('.select_pay li').removeClass('current');
                        $(this).addClass('current');
                    });
                    $('form').submit(function() {
                        $('#myModal').modal('show')
                    });
                });
            </script>
            <div style="display:none">
                <?php echo $this->config['stacode'] ?>
            </div>
        </body>
    
    </html>