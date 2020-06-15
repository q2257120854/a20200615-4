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
                none}#header{background: #337AB7;}#header .logo{line-height: 50px;font-size:
                1.4em;text-align: center;color:#fff}.paymoney{background: #fff;padding:20px
                0}.bf1{font-size: 2em;color:#E43D40;letter-spacing: 2px}.orderinfo{margin:10px
                auto;color:#999}.pay_list{background: #fff}.pay_list ul{margin:10px auto;}.pay_list
                ul li{border-bottom:1px solid #ddd}.pay_list ul li label{margin:10px 20px;}.fl1,.fl2{float:left}.fl1
                img{margin-left:8px;width:50px}.fl2{margin-left:12px}.fl2 p{color:#999;font-size:13px;line-height:
                24px}.fl2 h4{font-size:14px;margin-top:8px}.fl2 h4 span{background:#E43D40;color:#fff;font-size:12px;padding:2px;border-radius:
                3px}.plist{display:none;border-top:1px solid #ddd;background: #eee;padding:10px
                0 20px 0;}.plist p{float:left;margin-left:25px;margin-top:10px;border:
                1px solid #fff;}.plist p.current{border:1px solid #E43D40}#footer{background:#263445;text-align:center;color:#8392A7;margin-top:30px;padding:20px
                0;}
            </style>
            <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
            </script>
            <script src="/static/common/bootstrap.min.js" type="text/javascript">
            </script>
        </head>
        
        <body>
            <div id="header">
                <div class="logo">
                    收银台
                </div>
            </div>
            <div class="paymoney bf1 text-center">
                <p style="font-size:14px;color:#666">
                    应付金额
                </p>
                &yen;
                <?php echo $orders['total_fee']?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="orderinfo">
                        <div class="col-xs-6">
                            订单号：
                        </div>
                        <div class="col-xs-6 text-right">
                            <span style="color:#E43D40">
                                <?php echo $orders['sdorderno']?>
                            </span>
                        </div>
                        <div class="col-xs-6">
                            订单备注：
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="http://<?php echo $userinfo['siteurl']?>" target="_blank">
                                <?php echo $orderinfo['remark']?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/checkout/subpay?sign=<?php echo $token?>" method="post"
            target="_blank">
                <input type="hidden" name="bankcode" value="">
                <div class="pay_list">
                    <ul>
                        <?php if($this->checkacc->isAccExist($userinfo['userid'],'wxh5')):?>
                            <li>
                                <label>
                                    <div class="fl1">
                                        <input type="radio" name="paytype" value="wxh5">
                                        &nbsp;
                                        <img src="/static/default/images/weixin.png">
                                    </div>
                                    <div class="fl2">
                                        <h4>
                                            微信wap
                                        </h4>
                                        <p>
                                            推荐微信Wap用户使用
                                        </p>
                                    </div>
                                </label>
                            </li>
                            <?php endif;?>
                                <?php if($this->checkacc->isAccExist($userinfo['userid'],'alipaywap')):?>
                                    <li>
                                        <label>
                                            <div class="fl1">
                                                <input type="radio" name="paytype" value="alipaywap">
                                                &nbsp;
                                                <img src="/static/default/images/alipay.png">
                                            </div>
                                            <div class="fl2">
                                                <h4>
                                                    支付宝wap
                                                </h4>
                                                <p>
                                                    推荐支付宝Wap用户使用
                                                </p>
                                            </div>
                                        </label>
                                    </li>
                                    <?php endif;?>
                                        <?php if($this->checkacc->isAccExist($userinfo['userid'],'qqwallet')):?>
                                            <li>
                                                <label>
                                                    <div class="fl1">
                                                        <input type="radio" name="paytype" value="qqwallet">
                                                        &nbsp;
                                                        <img src="/static/default/images/qqwallet.png">
                                                    </div>
                                                    <div class="fl2">
                                                        <h4>
                                                            QQ钱包wap
                                                        </h4>
                                                        <p>
                                                            推荐QQ钱包用户使用
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <?php endif;?>
                                                <?php if($this->checkacc->isAccExist($userinfo['userid'],'tenpaywap')):?>
                                                    <li>
                                                        <label>
                                                            <div class="fl1">
                                                                <input type="radio" name="paytype" value="tenpaywap">
                                                                &nbsp;
                                                                <img src="/static/default/images/tenpay.png">
                                                            </div>
                                                            <div class="fl2">
                                                                <h4>
                                                                    财付通wap
                                                                </h4>
                                                                <p>
                                                                    推荐财付通Wap用户使用
                                                                </p>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <?php endif;?>
                                                        <?php if($this->checkacc->isAccExist($userinfo['userid'],'bank')):?>
                                                            <li>
                                                                <label>
                                                                    <div class="fl1">
                                                                        <input type="radio" name="paytype" value="bank">
                                                                        &nbsp;
                                                                        <img src="/static/default/images/ubank.png">
                                                                    </div>
                                                                    <div class="fl2">
                                                                        <h4>
                                                                            网银wap付款
                                                                        </h4>
                                                                        <p>
                                                                            支持多种手机Wap银行
                                                                        </p>
                                                                    </div>
                                                                </label>
                                                                <div class="plist banklist">
                                                                    <?php foreach($banklist as $key=>
                                                                        $val):?>
                                                                        <p>
                                                                            <img src="/static/payimg/<?php echo $val['img']?>" data-pid="<?php echo $val['code']?>">
                                                                        </p>
                                                                        <?php endforeach;?>
                                                                            <div style="clear:left">
                                                                            </div>
                                                                </div>
                                                            </li>
                                                            <?php endif;?>
                                                                <?php if($cardlist):?>
                                                                    <li>
                                                                        <label>
                                                                            <div class="fl1">
                                                                                <input type="radio" name="paytype" value="card">
                                                                                &nbsp;
                                                                                <img src="/static/default/images/cards.png">
                                                                            </div>
                                                                            <div class="fl2">
                                                                                <h4>
                                                                                    点卡支付
                                                                                </h4>
                                                                                <p>
                                                                                    支持多种充值卡支付
                                                                                </p>
                                                                            </div>
                                                                        </label>
                                                                        <div class="plist cardlist">
                                                                            <?php foreach($cardlist as $key=>
                                                                                $val):?>
                                                                                <p>
                                                                                    <img src="/static/payimg/<?php echo $val['img']?>" data-pid="<?php echo $val['gateway']?>">
                                                                                </p>
                                                                                <?php endforeach;?>
                                                                                    <div style="clear:left">
                                                                                    </div>
                                                                        </div>
                                                                    </li>
                                                                    <?php endif;?>
                    </ul>
                </div>
                <br>
                <div class="text-center" style="margin:auto 20px">
                    <button type="submit" class="btn btn-danger btn-block btn-lg">
                        &nbsp;&nbsp;&nbsp;
                        <span class="glyphicon glyphicon-check">
                        </span>
                        &nbsp;确认付款&nbsp;&nbsp;&nbsp;
                    </button>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                        重要提示：请尽快付款，30分钟内未付款的订单将会超时关闭。
                    </div>
                </div>
                <br>
                <br>
            </form>
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
                    var fp = $('.pay_list ul li').eq(0);
                    var pt = fp.find('input').val();
                    fp.find('input').attr('checked', true);
                    if (pt == 'bank' || pt == 'card') {
                        if (pt == 'bank') {
                            $('.banklist').show();
                        } else {
                            $('.cardlist').show();
                        }
                        $('.plist p').first().addClass('current');
                        $('[name=bankcode]').val($('.plist p:first').find('img').attr('data-pid'));
                    }
                    $('.pay_list ul li').click(function() {
                        $('.banklist,.cardlist').hide();
                        var paytype = $(this).find('input').val();
                        if (paytype == 'bank') {
                            $('.banklist').show();
                        }
                        if (paytype == 'card') {
                            $('.cardlist').show();
                        }
                    });
                    $('.plist p').click(function() {
                        $('.plist p').removeClass('current');
                        $(this).addClass('current');
                        $('[name=bankcode]').val($(this).find('img').attr('data-pid'));
                    });
                    $('form').submit(function() {
                        $('#myModal').modal('show');
                    });
                });
            </script>
            <div style="display:none">
                <?php echo $this->config['stacode'] ?>
            </div>
        </body>
    
    </html>