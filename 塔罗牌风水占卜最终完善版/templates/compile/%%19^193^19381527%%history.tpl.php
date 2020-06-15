<?php /* Smarty version 2.6.25, created on 2019-04-01 13:27:22
         compiled from index/history.tpl */ ?>
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
	<div class="public_os_info">
		温馨提示：已经付款的用户请输入订单号查询测算结果！如未正常显示请添加QQ号【88888888】反馈！
	</div>
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
        	<?php if ($this->_tpl_vars['data']): ?>
            <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
            <div class="oh_box">
                <div class="oh_name">
                    <span>测算名：</span><?php echo $this->_tpl_vars['v']['des']; ?>

                </div>
                <div class="oh_name">
                    <span>订单号：</span><?php echo $this->_tpl_vars['v']['oid']; ?>

                </div>
                <div class="oh_name">
                    <span>状态：</span><b class="on"><?php if ($this->_tpl_vars['v']['status'] == 1): ?>已付费<?php else: ?>未付费<?php endif; ?></b>
                </div>
                <a class="oh_look" href="<?php echo $this->_tpl_vars['v']['url']; ?>
">点击查看</a>
            </div>
            <?php endforeach; endif; unset($_from); ?>
            <?php endif; ?>
        </div>
	</div>
	<ul class="problem_feedback">
		<li><a class="after_sales_link" href="/?ac=feedback" hidetxt="问题反馈">问题反馈</a></li>
		<li><a href="javascript:;" onclick="history.go(-1);" class="btn_back">返回</a></li>
	</ul>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--塔罗占卜付费测算源码-->
</body>
</html>