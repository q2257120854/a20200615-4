<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>测算记录</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link href="/ffsm/statics/ffsm/public/wap.min-v=0817.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/inquiry/1/inquiry.min.css" rel="stylesheet" type="text/css"/>
<script src="/ffsm/statics//jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">我的测算</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<p class="public_banner">
	<img src="/ffsm/statics/ffsm/index/1/images/topbanner.gif.jpeg" alt="付费算命"/>
</p>
<div class="public_orders_search">
<!-- 	<div class="public_os_info">
		温馨提示：已经付款的用户请输入订单号查询测算结果！如未正常显示请添加QQ号【www.010xr.com】反馈！
	</div> -->
	<div class="public_os_form">
		<form class="J_ajaxForm" action="/?ac=select_orders" method="post">
			<input type="text" name="oid" nolocal="true" placeholder="订单号" class="input"/><input type="submit" value="查询" class="J_ajax_submit_btn btn"/>
		</form>
	</div>
	<div class="order_history">
		<div class="oh_tit">
			订单历史
		</div>
		<div class="oh_list">
        	<{if $data}>
            <{foreach from=$data item=v}>
            <div class="oh_box">
                <div class="oh_name">
                    <span>测算名：</span><{$v.des}>
                </div>
                <div class="oh_name">
                    <span>订单号：</span><{$v.oid}>
                </div>
                <div class="oh_name">
                    <span>状态：</span><b class="on"><{if $v.status==1}>已付费<{else}>未付费<{/if}></b>
                </div>
                <a class="oh_look" href="<{$v.url}>">点击查看</a>
            </div>
            <{/foreach}>
            <{/if}>
        </div>
	</div>
	<ul class="problem_feedback">
		<li><a class="after_sales_link" href="/?ac=feedback" hidetxt="问题反馈">问题反馈</a></li>
		<li><a href="javascript:;" onclick="history.go(-1);" class="btn_back">返回</a></li>
	</ul>
</div>

<{include file='./index/public/footer.tpl'}>

<!--塔罗占卜付费测算源码-->
</body>
</html>