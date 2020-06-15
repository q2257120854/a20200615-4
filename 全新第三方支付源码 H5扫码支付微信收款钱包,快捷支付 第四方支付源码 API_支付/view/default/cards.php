<?php if(!defined( 'WY_ROOT'))exit; ?>
    <!doctype html>
    <html>
        
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title>
                <?php echo $this->
                    config['sitename'] ?>
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
                solid #CD1C20}.pay img{border:1px solid #ddd}.select_pay{background: #328061;padding-top:5px;padding-left:20px}.select_pay
                ul li{float:left;margin-right:20px;color:#fff;line-height: 35px;cursor:
                pointer}.select_pay ul li.current{background:#fff;line-height: 40px;padding:0
                10px;border-top-left-radius: 3px;border-top-right-radius: 3px;color:#666}.woody-prompt{display:none}
            </style>
            <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
            </script>
            <script src="/static/default/app.js" type="text/javascript">
            </script>
        </head>
        
        <body>
            <div style="position:absolute;left:40%">
                <div class="woody-prompt">
                    <div class="prompt-error alert alert-danger">
                    </div>
                </div>
            </div>
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
                                                        <?php echo $orders[ 'sdorderno']?>
                                                    </span>
                                                </dd>
                                                <dd>
                                                    订单备注：
                                                    <a href="http://<?php echo $userinfo['siteurl']?>" target="_blank">
                                                        <?php echo $orderinfo[ 'remark']?>
                                                    </a>
                                                </dd>
                                                <dd>
                                                    商户信息：
                                                    <?php echo $userinfo[ 'sitename']?>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="paymoney bf1 text-right">
                                                &yen;
                                                <?php echo $orders[ 'total_fee']?>
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
                                            <form class="form-ajax" action="/checkout/cardpay" method="post">
                                                <input type="hidden" name="sign" value="<?php echo $token ?>">
                                                <input type="hidden" name="accid" value="<?php echo $acc['id'] ?>">
                                                <div class="bf">
                                                    填写充值卡信息：
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <select name="cardvalue" class="form-control">
                                                            <?php foreach($cardvalue as $val):?>
                                                                <option value="<?php echo $val?>">
                                                                    <?php echo $cardname?>
                                                                        <?php echo $val?>
                                                                            元面值
                                                                </option>
                                                                <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="cardnum" class="form-control" maxlength="<?php echo $cardlength[0]?>"
                                                        placeholder="<?php echo $cardlength[0]?>位充值卡卡号" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="cardpwd" class="form-control" maxlength="<?php echo $cardlength[1]?>"
                                                        placeholder="<?php echo $cardlength[1]?>位充值卡密码" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-danger btn-lg">
                                                        &nbsp;&nbsp;&nbsp;
                                                        <span class="glyphicon glyphicon-check">
                                                        </span>
                                                        &nbsp;确认提交支付&nbsp;&nbsp;&nbsp;
                                                    </button>
                                                </div>
                                                <br>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display:none">
                    <?php echo $this->
                        config['stacode'] ?>
                </div>
        </body>
    
    </html>