<?php /* Smarty version 2.6.25, created on 2019-02-28 11:07:06
         compiled from index/bazi/order.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>八字综合详批、专业测算机构</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link href="/ffsm/statics/ffsm/bazimf/wap.min.css?v=0817" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/bazimf/index.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/bazimf/style.min.css" rel="stylesheet" type="text/css"/>
<script src="//apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/ffsm/statics/ffsm/public/js/require/require.min.js" data-main="/statics/ffsm/public/js/common.min.js?v=0817"></script>
</head>
<body>
<div class="container pay" style="padding-bottom:0px;">
  <div class="wrap">
    <div class="person">
      <div class="hd">
        <img src="/ffsm/statics/ffsm/bazimf/images/hd.jpg"></div>
      <div class="infos">
        <p>姓名：<?php echo $this->_tpl_vars['form']['username']; ?>
</p>
        <p>性别：<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?></p>
        <p>生日：<?php echo $this->_tpl_vars['form']['y']; ?>
年<?php echo $this->_tpl_vars['form']['m']; ?>
月<?php echo $this->_tpl_vars['form']['d']; ?>
日<?php if ($this->_tpl_vars['form']['h'] >= 0): ?><?php echo $this->_tpl_vars['form']['h']; ?>
<?php else: ?>未知<?php endif; ?>时</p>
      </div>
    </div>
    <p class="gk">已有
      <span class="red3">69852134</span>人进行测试，
      <span class="red3">98.7%</span>以上的测算用户都觉得对自身的前程有很大的帮助。
      <span class="red3">大师团队利用传统四柱八字推测出你的一生财运、事业、感情、健康、人际等重要问题！</span></p>
    <div class="price">
      <p class="tit1">测算项目：八字命格详批</p>
      <div class="clearfix inner">
        <div class="fl">
          <span class="yh">限时优惠￥<?php echo $this->_tpl_vars['form']['money']; ?>
元</span>
          <s class="gray">原价：￥118.00</s></div>
        <div class="fr">
          <p>距优惠结束</p>
          <p class="red">
            <span class="h" id="hour_show">00：</span>
            <span class="f" id="minute_show">57：</span>
            <span class="m" id="second_show">42</span></p>
        </div>
      </div>
    </div>
    <div class="price">
      <p class="tit1 tcenter">支付方式</p>
      <div class="clearfix inner">
        <ul class="pay-type">
          
          <a class="weixin" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1"><li class="on" id="wx_zf">
            <span class="pay-icon icon-wechat"></span>
            <span>微信支付</span>
            <em class="ico-arrow"></em>
          </li></a>
            
              <a class="alipay" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2"><li id="zfb_zf">
            <span class="pay-icon icon-zfb"></span>
            <span>支付宝支付</span>
            <em class="ico-arrow"></em>
          </li></a>
            
        </ul>
      </div>
    </div>
    <p class="tip">98.7%以上用户对分析结果非常满意！</p>
    <p class="tip red3">支付完成后</p>
    <p class="tip mb">将为你
      <span class="red3">解锁</span>以下
      <span class="red3">六项重要内容</span></p>
    <div class="info">
      <div class="box-top"></div>
      <div class="box-center">
        <h3 class="tit2">
          <img src="/ffsm/statics/ffsm/bazimf/images/title_1.png"></h3>
        <p>
          <span class="blur">你对金钱的态度非常务实，相信一分耕耘才有一分收你对金钱的态度非常务实，相信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分收你对金钱的态度非常务实信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分</span></p>
        <p class="btn-lock J_payPopupShow" style="margin-top:1.2rem;">支付后查看分析</p>
        <div class="genre">
          <p>1.想知道你的
            <span class="red3">五行属性？</span></p>
          <p>2.想知道你的
            <span class="red3">好运</span>需要
            <span class="red3">哪种五行帮助？</span></p>
          <p>3.想知道你的
            <span class="red3">人生高峰期</span>在什么时候？</p></div>
      </div>
      <div class="box-bottom"></div>
    </div>
    <div class="info">
      <div class="box-top"></div>
      <div class="box-center">
        <h3 class="tit2">
          <img src="/ffsm/statics/ffsm/bazimf/images/title_2.png"></h3>
        <p>
          <span class="blur">你对金钱的态度非常务实，相信一分耕耘才有一分收你对金钱的态度非常务实，相信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分收你对金钱的态度非常务实信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分</span></p>
        <p class="btn-lock J_payPopupShow" style="margin-top:.8rem;">支付后查看分析</p>
        <div class="genre">
          <p>1.想知道你
            <span class="red3">是不是有钱人？</span></p>
          <p>2.想知道你这两年的
            <span class="red3">财富机遇在哪？</span></p>
          <p>3.想知道你怎样做才能
            <span class="red3">增加财富？</span></p>
        </div>
      </div>
      <div class="box-bottom"></div>
    </div>
    <div class="info">
      <div class="box-top"></div>
      <div class="box-center">
        <h3 class="tit2">
          <img src="/ffsm/statics/ffsm/bazimf/images/title_3.png"></h3>
        <p>
          <span class="blur">你对金钱的态度非常务实，相信一分耕耘才有一分收你对金钱的态度非常务实，相信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分收你对金钱的态度非常务实信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分收你对金钱的态度非常务实相信一分耕耘才有一分</span></p>
        <p class="btn-lock J_payPopupShow" style="margin-top:1.2rem;">支付后查看分析</p>
        <div class="genre">
          <p>1.想知道你的
            <span class="red3">感情是否顺利？</span></p>
          <p>2.想知道你在感情中的
            <span class="red3">表现和异性对你的看法？</span></p>
          <p>3.想知道你适合
            <span class="red3">哪种类型的对象？</span></p>
        </div>
      </div>
      <div class="box-bottom"></div>
    </div>
    <div class="info">
      <img src="/ffsm/statics/ffsm/bazimf/images/title_other.png"></div>
    <div class="pop-footer" style="z-index: 2;"  id="publicPayBottom">
        <div class="maodian zhifu_">支付查看结果</div>
    </div>
  </div>
<!--<footer style="padding: 15px 0px;">
    <p class="p4" style="font-size:.24rem;color:white!important;">大师团队倾力打造，
      <a href="/" style="text-decoration: underline;color:#ffe6a7">查看大师团队简介</a></p>
    <p class="p4" style="font-size:.24rem;color:white!important;margin-bottom:.1rem">如需帮助点此
      <a style="color:#e9d39a;text-decoration: underline;" href="/">联系专属售后客服</a></p>
  </footer>-->
  <p style="height:.9rem;background-color: #b10400"></p>
</div>
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
<script type="text/javascript">
var intDiff = parseInt(5734);//倒計時總秒數量
function timer(intDiff){
	window.setInterval(function(){
	var day=0,
		hour=0,
		minute=0,
		second=0;//時間默認值		
	if(intDiff > 0){
		day = Math.floor(intDiff / (60 * 60 * 24));
		hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
		minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
		second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
	}
	if (minute <= 9) minute = '0' + minute;
	if (second <= 9) second = '0' + second;
	$('#day_show').html(day+"天");
	$('#hour_show').html('<s id="h"></s>'+hour+'小時');
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--塔罗占卜付费测算源码-->
</body>
</html>