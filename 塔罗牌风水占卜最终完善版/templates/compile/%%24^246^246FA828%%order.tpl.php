<?php /* Smarty version 2.6.25, created on 2019-02-13 10:06:30
         compiled from index/ziwei/order.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title><?php echo $this->_tpl_vars['form']['username']; ?>
的紫微命盘精批-天玄算命网</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/ziwei/1/ziwei.min.css" rel="stylesheet" type="text/css"/>
<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">紫微精批</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/ffsm/ziwei/1/images/banner.png" alt="紫微精批"/>
</div>
<div class="orders_num">
	订单编号：<span class="red"><?php echo $this->_tpl_vars['form']['oid']; ?>
</span>
</div>
<div class="public_box border1">
	<div class="base_info">
		<p class="base_info_name">姓名：&nbsp;<?php echo $this->_tpl_vars['return']['data']['xingming']; ?>
 <!--(<?php if ($this->_tpl_vars['data']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?>)--></p>
		<p>阳历生日：&nbsp;<?php echo $this->_tpl_vars['return']['data']['nianling']['y']; ?>
年<?php echo $this->_tpl_vars['return']['data']['nianling']['m']; ?>
月<?php echo $this->_tpl_vars['return']['data']['nianling']['d']; ?>
日</p>
	</div>
	<ul class="zw_list">
		<li><span class="zw_list_left">紫微命盘</span><span class="zw_list_right">免费阅读</span></li>
		<li><span class="zw_list_left">自身状况</span><span class="zw_list_right">付费解锁</span></li>
		<li><span class="zw_list_left">家庭情况</span><span class="zw_list_right">付费解锁</span></li>
		<li><span class="zw_list_left">运势发展</span><span class="zw_list_right">付费解锁</span></li>
		<li><span class="zw_list_left">老师赠言</span><span class="zw_list_right">老师团队提点</span></li>
	</ul>
	<p class="test_number">
		已有<span>4985554</span>缘主进行在线测算，知晓了自己事业财运、婚姻情感的情况，并根据老师建议做出调整，产生显著效果，<span>95%</span>用户觉得本测算对人生规划发展有帮助！
	</p>
	<div class="zw_pay_wrapper">
		<p class="zw_pay_title">
			统一测算价：￥168
		</p>
		<div class="zw_pay_chose">
			<p class="zpc_price_bonds">
				优惠价：<span>￥<?php echo $this->_tpl_vars['form']['money']; ?>
</span>
			</p>
			<p class="zpc_after_payment">
				付款后即可获得<span>详细的紫微精批内容</span>
			</p>
			<div class="public_pay_box">
			<a class="weixin" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">微信安全支付</a>
          
            <a class="alipay" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2">支付宝安全支付</a>
          
			</div>
		</div>
	</div>
</div>
<div class="public_box J_payBottomShow">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		您的紫微命盘
	</div>
	<div class="ziwei_disc">
		<div class="zd_box">
			<div class="zd_con">
            	<p>
                	<?php echo $this->_tpl_vars['form']['username']; ?>

                </p>
				<p>
					阳历：<?php echo $this->_tpl_vars['return']['data']['nianling']['y']; ?>
年<?php echo $this->_tpl_vars['return']['data']['nianling']['m']; ?>
月<?php echo $this->_tpl_vars['return']['data']['nianling']['d']; ?>
日
				</p>
				<p>
					阴历：<?php echo $this->_tpl_vars['return']['data']['jiuli']['y']; ?>
年<?php echo $this->_tpl_vars['return']['data']['jiuli']['m']; ?>
<?php echo $this->_tpl_vars['return']['data']['jiuli']['d']; ?>

				</p>
                <p>
                	命主:<?php echo $this->_tpl_vars['return']['ziwei']['mingzhum']; ?>
&nbsp; 身主:<?php echo $this->_tpl_vars['return']['ziwei']['shenzhum']; ?>

                </p>
				<a class="public_bg_btn J_payPopupShow" href="javascript:;">观看详细命盘</a>
			</div>
            
			<div class="zd_block zd_block_1">
            
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['5']; ?>

                
			</div>
            
			<div class="zd_block zd_block_2">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['6']; ?>

			</div>
			<div class="zd_block zd_block_3">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['7']; ?>

			</div>
			<div class="zd_block zd_block_4">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['8']; ?>

			</div>
			<div class="zd_block zd_block_5">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['9']; ?>

			</div>
			<div class="zd_block zd_block_6">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['10']; ?>

			</div>
			<div class="zd_block zd_block_7">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['11']; ?>

			</div>
			<div class="zd_block zd_block_8">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['0']; ?>

			</div>
			<div class="zd_block zd_block_9">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['1']; ?>

			</div>
			<div class="zd_block zd_block_10">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['2']; ?>

			</div>
			<div class="zd_block zd_block_11">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['3']; ?>

			</div>
			<div class="zd_block zd_block_12">
				<?php echo $this->_tpl_vars['return']['ziwei']['pan']['4']; ?>

			</div>
		</div>
	</div>
</div>
<p class="payment_know">
	付款后即可获得<span class="public_red">以下所有内容</span>
</p>
<div class="public_box J_payPopupShow">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		您的自身状况
	</div>
	<p class="lock_pic">
		<img src="/ffsm/statics/ffsm/ziwei/1/images/img_lock01.jpg" alt="您的自身状况"/>
	</p>
</div>
<div class="public_box J_payPopupShow">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		您的家庭情况
	</div>
	<p class="lock_pic">
		<img src="/ffsm/statics/ffsm/ziwei/1/images/img_lock02.jpg" alt="您的家庭情况"/>
	</p>
</div>
<div class="public_box J_payPopupShow">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		您的运势发展
	</div>
	<p class="lock_pic">
		<img src="/ffsm/statics/ffsm/ziwei/1/images/img_lock03.jpg" alt="您的运势发展"/>
	</p>
</div>
<div class="public_box J_payPopupShow">
	<p class="publci_bg_top">
	</p>
	<div class="teacher_say">
		<p class="words">
			老师赠言
		</p>
		<p class="txt">
			针对你的现今境况和未来运势，专业老师为你提供了一些改善生活的建议，帮助你在未来的道路上趋吉避凶。
		</p>
	</div>
	<p class="teacher_say_bottom">
		紫微斗数是古代帝王专用算命方法，号称“天下第一神数”。专业易学权威团队40年紫微斗数论命经验总结，打造最准紫微斗数一生命格详批！
	</p>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="public_pay_popup" id="publicPayPopup">
	<div class="public_pp_box">
		<div class="public_pp_close" id="publicPPClose">
			X
		</div>
		<div class="public_pp_tit">
			解锁查看所有测算结果
		</div>
		<div class="public_pp_price">
			<span>统一鉴定价：</span><strong>￥<?php echo $this->_tpl_vars['form']['money']; ?>
元</strong>
		</div>
		<div class="public_pay_box">
			
			<a class="weixin" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">微信安全支付</a>
          
            <a class="alipay" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2">支付宝安全支付</a>
          
		</div>
	</div>
</div>
<div style=" height: 25px;">
</div>
<div class="public_pay_bottom" id="publicPayBottom">
	<span><i></i>付费解锁所有项</span>
</div>
<script>
    //底部悬浮
    ;(function($){
        $.fn.publicPopup=function(opt){
            var pp=$('#publicPayPopup');
            var ppClose=$('#publicPPClose');
            var topShow=$(".J_payBottomShow").length>0?$(".J_payBottomShow").offset().top:200;
            var ppShow=$(".J_payPopupShow").length>0?$(".J_payPopupShow"):'';
            return this.each(function(){
                var $this=$(this);
                $(window).scroll(function(){
                    var wt=$(window).scrollTop();
                    wt>topShow?$this.fadeIn():$this.fadeOut();
                });
                $this.on('click',function(){
                    pp.show();
                });
                ppClose.on('click',function(){
                    pp.hide();
                })
                ppShow?ppShow.on('click',function(){pp.show()}):'';
            });
        };
    })(jQuery);
    $("#publicPayBottom").publicPopup();
//支付后检测跳转
  <?php if ($this->_tpl_vars['yz_pay'] == 1): ?>
       var inquiry_lock = 0;
    $(function () {
        setInterval(function () {
            inquiry(); 
        }, 1000);
    });
    function inquiry() {
        if (inquiry_lock) {
            return;
        }
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                $('div.weixin .green').html('支付成功');
                window.location = data.url;
            }
        }, 'json');
    }
  <?php endif; ?>
</script>
<!--天玄算命网付费测算源码-->
</body>
</html>