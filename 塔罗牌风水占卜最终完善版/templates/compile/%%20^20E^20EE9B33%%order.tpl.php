<?php /* Smarty version 2.6.25, created on 2019-03-02 12:48:42
         compiled from index/xmfx/order.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title><?php echo $this->_tpl_vars['form']['xing']; ?>
<?php echo $this->_tpl_vars['form']['username']; ?>
-姓名详批</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min.css?v=0817" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/jieming/1/jieming.css" rel="stylesheet" type="text/css"/>
<script src="/ffsm/statics/jquery-3.2.1.min.js"></script>
<script src="/ffsm/statics/ffsm/public/js/require/require.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">姓名详批</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/ffsm/jieming/1/images/banner-jm2.png" alt="姓名解名"/>
</div>
<div class="public_binding">
	<div class="pb_tit">
		绑定订单可以多次查看
	</div>
	<div class="pb_con">
    	<div>
			<span>产品名称：</span><?php echo $this->_tpl_vars['form']['xing']; ?>
<?php echo $this->_tpl_vars['form']['username']; ?>
姓名祥批
		</div>
		<div>
			<span>订单编号：</span><?php echo $this->_tpl_vars['form']['oid']; ?>

		</div>
	</div>
</div>
<div class="jieming_box">
	<p class="jm_words">
		本次为您免费提供的结果：
	</p>
	<ul class="jm_ui">
		<li class="cur"><a href="javascript:;">姓名测算结果</a></li>
		<li class="cur"><a href="javascript:;">您的八字命盘</a></li>
		<li><a href="javascript:;">您的性格特征</a></li>
		<li><a href="javascript:;">您的事业财运</a></li>
		<li><a href="javascript:;">您的恋爱婚姻</a></li>
		<li><a href="javascript:;">您的健康运势</a></li>
		<li><a href="javascript:;">您的晚景解析</a></li>
	</ul>
	<div class="jm_yellow">
		一次购买解锁查看所有内容：<span class="price">￥<?php echo $this->_tpl_vars['form']['money']; ?>
</span>
	</div>
	<div class="public_d_btn">
		<div class="public_pay_box">
			<a class="weixin" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">微信安全支付</a>
            <a class="alipay" target="_self" href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2">支付宝安全支付</a>
		</div>
	</div>
</div>
<div class="jieming_box J_payBottomShow ">
	<div class="jb_title relative">
		您的姓名测算结果 <span class="r">免费</span>
	</div>
	<div class="jb_content">
		<p class="n">
			<?php echo $this->_tpl_vars['return']['user']['xingming']; ?>
（<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?>）
		</p>
		<p>
			公历生日：<?php echo $this->_tpl_vars['return']['user']['nianling']['y']; ?>
年<?php echo $this->_tpl_vars['return']['user']['nianling']['m']; ?>
月<?php echo $this->_tpl_vars['return']['user']['nianling']['d']; ?>
日 <?php echo $this->_tpl_vars['return']['user']['nianling']['h']; ?>
时
		</p>
		<p>
			农历生日：<?php echo $this->_tpl_vars['return']['user']['jiuli']['y']; ?>
年<?php echo $this->_tpl_vars['return']['user']['jiuli']['m']; ?>
<?php echo $this->_tpl_vars['return']['user']['jiuli']['d']; ?>
日<?php echo $this->_tpl_vars['return']['user']['jiuli']['h']; ?>
时
		</p>
		<p>
			您的姓名三才五行组合：<?php echo $this->_tpl_vars['return']['info']['rssancai']['title']; ?>

		</p>
		<div class="jbc_gezi">
			<div class="jg_left left">
				<div class="g01 public_w">
					<p class="t">
						迁移宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['waige']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['waige_sancai']; ?>
</span>
					</p>
				</div>
				<div class="g02 public_w">
					<p class="t">
						命宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['zhongge']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['zongge_sancai']; ?>
</span>
					</p>
				</div>
			</div>
			<span class="jg_line left"></span>
			<div class="jl_words left">
				<span><span style="color:#f2ac65"><?php if ($this->_tpl_vars['return']['xm_arr']['xing2']): ?><?php echo $this->_tpl_vars['return']['xm_arr']['xing1']; ?>
<?php else: ?>白<?php endif; ?></span></span><span><?php if ($this->_tpl_vars['return']['xm_arr']['xing2']): ?><?php echo $this->_tpl_vars['return']['xm_arr']['xing2']; ?>
<?php else: ?><?php echo $this->_tpl_vars['return']['xm_arr']['xing1']; ?>
<?php endif; ?></span><span><?php echo $this->_tpl_vars['return']['xm_arr']['ming1']; ?>
</span><span><?php if ($this->_tpl_vars['return']['xm_arr']['ming2']): ?><?php echo $this->_tpl_vars['return']['xm_arr']['ming2']; ?>
<?php else: ?>白<?php endif; ?></span>
			</div>
			<div class="jg_bihua left">
				<span><?php if ($this->_tpl_vars['return']['bh_wh_arr']['bihua2'] == ''): ?>1<?php else: ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua2']; ?>
<?php endif; ?></span><span><?php if ($this->_tpl_vars['return']['bh_wh_arr']['bihua2'] == ''): ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua1']; ?>
<?php else: ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua1']; ?>
<?php endif; ?></span><span><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua3']; ?>
</span><span><?php if ($this->_tpl_vars['return']['bh_wh_arr']['bihua4']): ?><?php echo $this->_tpl_vars['return']['bh_wh_arr']['bihua4']; ?>
<?php else: ?>1<?php endif; ?></span>
			</div>
			<div class="jg_line2 left">
				<span></span><span></span><span></span>
			</div>
			<div class="jg_right left">
				<div class=" public_w">
					<p class="t">
						父母宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['tiange']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['tian_sancai']; ?>
</span>
					</p>
				</div>
				<div class="g02 public_w">
					<p class="t">
						疾厄宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['renge']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['ren_sancai']; ?>
</span>
					</p>
				</div>
				<div class="g02 public_w">
					<p class="t">
						奴仆宫
					</p>
					<p class="b">
						<span><?php echo $this->_tpl_vars['return']['tdr_ge']['dige']; ?>
</span><span><?php echo $this->_tpl_vars['return']['tdr_ge']['di_sancai']; ?>
</span>
					</p>
				</div>
			</div>
		</div>
		<!-- end -->
	</div>
</div>
<div class="jieming_box">
	<div class="jb_title relative">
		您的八字命盘<span class="r">免费</span>
	</div>
	<div class="jb_bzmp">
		<p class="words">
			下列是您的八字命盘。您是<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['sx']; ?>
，出生于<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['sx']; ?>
年。日天干代表您，所以您是属<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['wh']; ?>
。
		</p>
		<div class="jb_bzmp_content">
			<dl>
				<dt class="ct">年（祖先）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['wh_py']; ?>
.png" alt="阴火"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['0']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
			<dl>
				<dt class="ct">月（父母）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['whsx']['wh_py']; ?>
.png" alt="阴火"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['1']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
			<dl>
				<dt class="ct">日（自己）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['wh_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['2']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
			<dl>
				<dt class="ct">时（子孙）</dt>
				<dd class="jb_bzmp_c_dd">
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/wu<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['whsx']['wh_py']; ?>
.png" alt="阳土"/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['layin']; ?>

					</p>
				</div>
				<div>
					<p>
						<img src="/ffsm/statics/ffsm/jieming/1/images/bzmp/<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['whsx']['sx_py']; ?>
.png" alt=""/>
					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['jiazi']; ?>

					</p>
					<p>
						<?php echo $this->_tpl_vars['return']['info']['nayin']['3']['whsx']['sx']; ?>

					</p>
				</div>
				</dd>
			</dl>
		</div>
		<p class="jb_bzmp_bottom">
			八字命盘从阴阳干支三合历取得。上排是天干由五行“金水木火土”轮流排列。下排是地支用十二生肖顺序排列。十二生肖可转换成五行八字姓名详批是依据文字的音、形、义、意、数的原理，综合姓氏文化、文字阴阳五行，并结合测算者的八字信息，解读你的姓名中所暗藏的各项运势，让你更好的了解自己，掌握命运。
		</p>
	</div>
</div>
<div class="public_jm_title">
	您的性格特征 <span class="r"></span>
</div>
<div class="public_jm_title">
	您的事业职业分析 <span class="r"></span>
</div>
<div class="public_jm_title">
	您的恋爱婚姻解析 <span class="r"></span>
</div>
<div class="public_jm_title">
	您的健康运势解析 <span class="r"></span>
</div>
<div class="public_jm_title">
	您的晚景如何 <span class="r"></span>
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
<div style=" height: 25px;">
</div>
<div class="public_pay_bottom" id="publicPayBottom">
	<span><i></i>付费解锁所有项</span>
</div>
<script>
	var inquiry_lock = 0;
    $(function () {
        setInterval(function () {
            inquiry();
        }, 2000);
    });
    function inquiry() {
        if (inquiry_lock) {
            return;
        }
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                window.location = data.url;
            }
        }, 'json');
    }
    //底部悬浮
    (function($){
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
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                $('div.weixin .green').html('支付成功');
                window.location = data.url;
            }
        }, 'json');
    }
</script>
<!--天玄算命网付费测算源码-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './ffsm/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>