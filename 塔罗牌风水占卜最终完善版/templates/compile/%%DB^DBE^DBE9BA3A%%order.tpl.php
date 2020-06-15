<?php /* Smarty version 2.6.25, created on 2019-02-14 15:22:28
         compiled from index/yinyuan/order.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>精准八字解析-揭开婚姻奥秘</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/yunyincs/1/wap.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/yunyincs/1/style.min.css" rel="stylesheet" type="text/css"/>
<script src="//apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="statics/ffsm/public/js/require/require.min.js" data-main="/ffsm/statics/ffsm/public/js/common.min.js?v=0817"></script>
</head>
<body>

<style type="text/css">
.public_binding {
    margin: 10px 0px 10px 0px;
    background-color: #fff;
}
.pb_tit {
    border: 1px solid #ddd;
    height: 32px;
    line-height: 32px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    padding: 0 10px;
    color: #ed2340;
}
.pb_con {
    border: 1px solid #ddd;
    border-top: none;
    padding: 10px;
    font-size: 14px;
    color: #4b4b4b;
}
.pb_con div {
    height: 30px;
    line-height: 30px;
    position: relative;
    padding: 0 0 0 70px;
}
.pb_con div span {
    display: block;
    width: 70px;
    position: absolute;
    left: 0;
    top: 0;
}

</style>

<header class="public_header">
<h1 class="public_h_con">姻缘测算</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="order_box_pay">
<div class="beijingse">
	
    <div class="public_binding">
	<div class="pb_tit">
		绑定订单可以多次查看
	</div>
	<div class="pb_con">
    	<div>
			<span>产品名称：</span><?php echo $this->_tpl_vars['form']['username']; ?>
姻缘测算
		</div>
		<div>
			<span>订单编号：</span><?php echo $this->_tpl_vars['form']['oid']; ?>

		</div>
	</div>
</div>
    
    
	<div class="obp_pirce">
		<del>原价：￥168</del><em>&nbsp; &nbsp;&nbsp;<strong>吉时特价：<span style="color:#ff0000;">￥<?php echo $this->_tpl_vars['form']['money']; ?>
</span></strong></em>
<div class="time-item">
	<em>倒计时：</em>
	<em id="hour_show">1小时</em>
	<em id="minute_show">35分</em>
	<em id="second_show">34秒</em>
</div>
		<div class="public_pay_box">
			
			<a class="weixin" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">微信安全支付</a>
          
            <a class="alipay" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2">支付宝安全支付</a>
		</div>
	</div>
	<div style='text-align:center;font-size:14px !important'>
	<p>订单编号：<?php echo $this->_tpl_vars['form']['oid']; ?>
</p>
	<div class="obp_tip">
		已有<span>23302574</span>人进行了测算知晓了自己的<span>婚姻情感、桃花运势</span>的情况，并根据老师建议做出调整，<span>98.6%</span>的用户对自己的婚姻情感生活产生巨大帮助！
	</div>
</div>
</div>
<div class="public_bg_wrap mt10 J_payBottomShow">
  <div class="public_title_1">老师综合点评</div>
  <div class="start_tip"></div>
  <div class="order_unpaid_tip">
    <p>对于婚姻，大多数人都会有这样那样的疑问。这一生的婚姻会是怎样？是好还是坏？如何才能提高婚姻质量，过上理想的婚姻生活？在此综合命理纲要，给你一个圆满答案。</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">结婚建议</div>
  <div class="order_unpaid_tip">
    <p>针对我的一生的婚姻运势，专业老师为我提供了哪些建议和方法？我该采取哪些具体措施来助旺自己的姻缘运势？面对未来未知的情感生活，什么样的选择是最稳妥的？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">桃花运数</div>
  <div class="fraction_div">
    <div class="fd_left"></div>
    <div class="fd_right"></div>
    <div class="fd_con">
      <b>?</b>分</div>
  </div>
  <div class="order_unpaid_tip">
    <p>我的命里到底有没有桃花运？异性缘是多还是寡？爱慕和追求我的人会多吗？为何至今依然单身？是不是非得通过相亲才有结婚的可能？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">结婚时间</div>
  <div class="order_unpaid_tip">
    <p>最适合我的结婚时间是什么时候呢？是会年纪轻轻就已结婚，还是会年老色衰依然孤家寡人？我命中注定的那个人究竟在何方？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">配偶性格</div>
  <div class="fraction_div">
    <div class="fd_left"></div>
    <div class="fd_right"></div>
    <div class="fd_con">
      <b>?</b>分</div>
  </div>
  <div class="order_unpaid_tip">
    <p>我命中注定的那位会是个怎样的人呢？这样的性格对我会不会有什么影响？我又该如何面对配偶的性格才能使彼此更好的生活在一起？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">稳定系数</div>
  <div class="fraction_div">
    <div class="fd_left"></div>
    <div class="fd_right"></div>
    <div class="fd_con">
      <b>?</b>分</div>
  </div>
  <div class="order_unpaid_tip">
    <p>我的婚姻稳定吗？会不会有携手到白头的婚姻呢？有没有多婚的可能？命里的婚姻不良信息多还是少，会对婚姻的基石造成多大冲击？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">幸福指数</div>
  <div class="fraction_div">
    <div class="fd_left"></div>
    <div class="fd_right"></div>
    <div class="fd_con">
      <b>?</b>分</div>
  </div>
  <div class="order_unpaid_tip">
    <p>我会不会拥有幸福的婚姻？什么不必要的行为和决定可能会让我失去挚爱？婚后的感情会是甜蜜幸福还是争吵不休？该怎样才能拥有一段幸福恩爱的婚姻生活？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">助旺指数</div>
  <div class="fraction_div">
    <div class="fd_left"></div>
    <div class="fd_right"></div>
    <div class="fd_con">
      <b>?</b>分</div>
  </div>
  <div class="order_unpaid_tip">
    <p>我能旺妻或旺夫吗？能成为配偶的得力助手还是对方的累赘呢？又或者能有这样一个ta，能够与自己互相助旺、优势互补吗？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<div class="public_bg_wrap mt10">
  <div class="public_title_1">子女运数</div>
  <div class="fraction_div">
    <div class="fd_left"></div>
    <div class="fd_right"></div>
    <div class="fd_con">
      <b>?</b>分</div>
  </div>
  <div class="order_unpaid_tip">
    <p>命中的我是儿孙满堂，还是膝下空空呢？子女能否健康快乐的成长？将来能否出人头地，孝顺父母？</p>
    <a href="javascript:;" class="J_payPopupShow">马上揭晓</a></div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './ffsm/footer.tpl', 'smarty_include_vars' => array()));
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
			<span>统一鉴定价：</span><strong>￥<?php echo $this->_tpl_vars['money']; ?>
元</strong>
		</div>
		<div class="public_pay_box">
			
			<a class="weixin" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['oid']; ?>
&type=1">微信安全支付</a>
          
            <a class="alipay" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['oid']; ?>
&type=2">支付宝安全支付</a>
          
		</div>
	</div>
</div>
<div style=" height: 25px;">
</div>
<div class="public_pay_bottom" id="publicPayBottom">
	<span><i></i>付费解锁所有项</span>
</div>
<script type="text/javascript">
var intDiff = parseInt(5734);//倒计时总秒数量
function timer(intDiff){
	window.setInterval(function(){
	var day=0,
		hour=0,
		minute=0,
		second=0;//时间默认值		
	if(intDiff > 0){
		day = Math.floor(intDiff / (60 * 60 * 24));
		hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
		minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
		second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
	}
	if (minute <= 9) minute = '0' + minute;
	if (second <= 9) second = '0' + second;
	$('#day_show').html(day+"天");
	$('#hour_show').html('<s id="h"></s>'+hour+'小时');
	$('#minute_show').html('<s></s>'+minute+'分');
	$('#second_show').html('<s></s>'+second+'秒');
	intDiff--;
	}, 1000);
} 

$(function(){
	timer(intDiff);
});	
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
</script>
<!--天玄算命网付费测算源码-->
</body>
</html>