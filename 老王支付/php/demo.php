<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>接口网关DEMO演示</title>
    <style type="text/css">
        /* Basic Grey */
        .basic-grey {
            margin-left: auto;
            margin-right: auto;
            max-width: 500px;
            background: #F7F7F7;
            padding: 25px 15px 25px 10px;
            font: 12px Georgia, "Times New Roman", Times, serif;
            color: #888;
            text-shadow: 1px 1px 1px #FFF;
            border: 1px solid #E4E4E4;
        }

        .basic-grey h1 {
            font-size: 25px;
            padding: 0px 0px 10px 40px;
            display: block;
            border-bottom: 1px solid #E4E4E4;
            margin: -10px -15px 30px -10px;;
            color: #888;
        }

        .basic-grey h1 > span {
            display: block;
            font-size: 11px;
        }

        .basic-grey label {
            display: block;
            margin: 0px;
        }

        .basic-grey label > span {
            float: left;
            width: 20%;
            text-align: right;
            padding-right: 10px;
            margin-top: 10px;
            color: #888;
        }

        .basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
            border: 1px solid #DADADA;
            color: #888;
            height: 30px;
            margin-bottom: 16px;
            margin-right: 6px;
            margin-top: 2px;
            outline: 0 none;
            padding: 3px 3px 3px 5px;
            width: 70%;
            font-size: 12px;
            line-height: 15px;
            box-shadow: inset 0px 1px 4px #ECECEC;
            -moz-box-shadow: inset 0px 1px 4px #ECECEC;
            -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
        }

        .basic-grey textarea {
            padding: 5px 3px 3px 5px;
        }

        .basic-grey select {
            background: #FFF url('down-arrow.png') no-repeat right;
            background: #FFF url('down-arrow.png') no-repeat right);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-indent: 0.01px;
            text-overflow: '';
            width: 70%;
            height: 35px;
            line-height: 25px;
        }

        .basic-grey textarea {
            height: 100px;
        }

        .basic-grey .button {
            background: #E27575;
            border: none;
            padding: 10px 25px 10px 25px;
            color: #FFF;
            box-shadow: 1px 1px 5px #B6B6B6;
            border-radius: 3px;
            text-shadow: 1px 1px 1px #9E3F3F;
            cursor: pointer;
        }

        .basic-grey .button:hover {
            background: #CF7A7A
        }
    </style>
</head>
<body>
<form action="gateway.php" method="post" class="basic-grey">
    <h1>商户请求网关获得支付二维码DEMO
    </h1>
    <label>
        <span>商户ID :</span>
        <input id="account_id" type="text" name="account_id" value="10483"/>
    </label>
    <label>
        <span>请求的接口地址 :</span>
        <input id="post_url" type="text" name="post_url" value="http://bank.iswoole.com"/>
    </label>
    <label>
        <span>商户S_KEY :</span>
        <input id="s_key" type="text" name="s_key" value="402B576C6BC364"/>
    </label>
    <label>
        <span>支付金额 :</span>
        <input id="name" type="text" name="amount" value="1.00"/>
    </label>
    <label>
        这个参数为服务版专用,公开版无需附带此参数-- <span>支付方式 :</span>
        <select name="type">
            <option value="3">支付宝转银行卡</option>
            <option value="2">支付宝</option>
            <option value="1">微信</option>
        </select>
    </label>
    <label>
        <span>请求方式 :</span>
        <select name="content_type">
            <option value="text">扫码支付</option>
            <option value="json">获取接口支付</option>
            <option value="APP">APP支付</option>
        </select>
    </label>
    <label>
        <span>请求方式 :</span>
        <select name="thoroughfare">
            <option value="bank_auto">商户支付宝银行卡转账</option>
            <option value="service_auto">服务版支付宝转银行卡</option>
            <option value="alipay_auto">商户支付宝</option>
            <option value="wechat_auto">商户微信</option>
            <option value="service_auto">服务版</option>
        </select>
    </label>
    <label>
        <span>&nbsp;</span>
        <input type="submit" class="button" value="发起支付"/>
    </label>
</form>
</body>
</html>