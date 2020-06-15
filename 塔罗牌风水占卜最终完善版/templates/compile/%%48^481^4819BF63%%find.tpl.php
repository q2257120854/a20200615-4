<?php /* Smarty version 2.6.25, created on 2019-03-22 15:27:16
         compiled from index/xingzuo/find.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>星座命盘详解</title>

<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/ziwei/1/ziwei.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/ziwei/1/swiper.min.css" rel="stylesheet" type="text/css"/>
<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/ffsm/statics/ffsm/ziwei/1/swiper.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">星盘详解</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_box J_payBottomShow">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		命主信息
	</div>
	<div class="ziwei_disc">
<ul class="user-info">
              <li>
                <div>性别:<?php if ($this->_tpl_vars['info']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?></div></li>
              <li>
                <div>公历:<?php echo $this->_tpl_vars['info']['birthday']; ?>
</div></li>
               <li>
                <div>出生地:<?php echo $this->_tpl_vars['info']['city']; ?>
</div></li>
            </ul>
            
            </span>。
	</div>
</div>
<div class="public_box">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		你的本命盘
	</div>
<div class="ziwei_disc">
<img width="100%" src="<?php echo $this->_tpl_vars['data']['img']; ?>
"><br>
<strong>上升星座：<span style="color:#bb4543;"><?php echo $this->_tpl_vars['data']['xzinfo']['shangsheng']; ?>
</span> 下降星座：<span style="color:#bb4543;"><?php echo $this->_tpl_vars['data']['xzinfo']['xiajiang']; ?>
</span> <br>天顶星座：<span style="color:#bb4543;"><?php echo $this->_tpl_vars['data']['xzinfo']['tianding']; ?>
</span> 天底星座：<span style="color:#bb4543;"><?php echo $this->_tpl_vars['data']['xzinfo']['tiandi']; ?>
</span></strong>

</div>
</div>
<div class="public_box">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		行星星座宫位
	</div>
<div class="ziwei_disc">
<p class="part_tips">太阳<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['taiyang']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['taiyang']['gw']['title']; ?>
</span></p>
<p class="part_tips">月亮<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['yueliang']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['yueliang']['gw']['title']; ?>
</span></p>
<p class="part_tips">水星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['shuixing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['shuixing']['gw']['title']; ?>
</span></p>
<p class="part_tips">金星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['jinxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['jinxing']['gw']['title']; ?>
</span></p>
<p class="part_tips">火星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['huoxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['huoxing']['gw']['title']; ?>
</span></p>
<p class="part_tips">木星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['muxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['muxing']['gw']['title']; ?>
</span></p>
<p class="part_tips">土星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['tuxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['tuxing']['gw']['title']; ?>
</span></p>
<p class="part_tips">天王星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['tianwangxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['tianwangxing']['gw']['title']; ?>
</span></p>
<p class="part_tips">海王星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['haiwangxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['haiwangxing']['gw']['title']; ?>
</span></p>
<p class="part_tips">冥王星<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['mingwangxing']['xz']['title']; ?>
</span>；在命盘的<span style="color:#dd9ec5;"><?php echo $this->_tpl_vars['data']['xingxing']['mingwangxing']['gw']['title']; ?>
</span></p>

</div>
</div>
<div class="public_box">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		详细解释
	</div>
<div class="ziwei_disc">
<p class="part_tips">太阳<?php echo $this->_tpl_vars['data']['xingxing']['taiyang']['xz']['title']; ?>
；在命盘的<?php echo $this->_tpl_vars['data']['xingxing']['taiyang']['gw']['title']; ?>
</p>
<p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xingxing']['taiyang']['xz']['content']; ?>
</p>

<p class="part_tips">月亮<?php echo $this->_tpl_vars['data']['xingxing']['yueliang']['xz']['title']; ?>
；在命盘的<?php echo $this->_tpl_vars['data']['xingxing']['yueliang']['gw']['title']; ?>
</p>
<p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xingxing']['yueliang']['xz']['content']; ?>
</p>
                
</div>
</div>

<div class="public_box">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title2">
		名师点评
	</div>
<div class="ziwei_disc">
				<p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['0']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['0']['content']; ?>
</p>
				
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['1']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['1']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['2']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['2']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['3']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['3']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['4']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['4']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['5']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['5']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['6']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['6']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['7']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['7']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['8']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['8']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['9']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['9']['content']; ?>
</p>
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['10']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['10']['content']; ?>
</p>
                
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['11']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['11']['content']; ?>
</p>
                
                
                <p class="part_tips"><?php echo $this->_tpl_vars['data']['xxxxdu']['12']['title']; ?>
</p>
                <p class="part_tips" style="color:#F00"><?php echo $this->_tpl_vars['data']['xxxxdu']['12']['content']; ?>
</p>
                
</div>
</div>

<style>
.ziwei_disc p{margin: 10px 0px;text-align: justify;text-indent: 1.2em;line-height: 1.8;}
.public_pp_box {width:90%;}
.public_pp_tit {font-weight:600;padding:5px 0 20px;}
.public_pp_img img {width:270px;height:96px;margin:0 auto;vertical-align:middle;}
.public_pp_add {font-size:12px;color:#333333;margin-top:16px;}
.public_pp_axs {font-size:12px;color:#00b98c;margin-top:5px;}
.public_pp_money {margin-top:25px;}
.public_pp_money img {width:100%;vertical-align:middle;}
.public_pp_ljzf {display:block;border-radius:3px;height:50px;line-height:50px;background-color:#D60F00;font-size:18px;color:#ffffff;text-align:center;margin:27px auto 26px;}
.public_pp_point {padding:0 10px;}
.public_pp_point p {font-size:10px;color:#333333;position:relative;padding-left:20px;text-align:left;margin-bottom:10px;}
.public_pp_point p:nth-child(1):before {content:"注：";display:inline-block;position:absolute;left:0;top:0;font-size:10px;color:#333333;}
.dashi_point_warp {padding:25px 10px 30px 10px;}
.dashi_point_title {font-size:15px;color:#2c170f;}
.dashi_point_content {display:-webkit-flex;display:flex;align-items:center;margin-top:15px;}
.portrint {width:40px;height:40px;border-radius:50%;}
.dashi_point_box {display:-webkit-flex;display:flex;align-items:center;width:170px;height:40px;box-sizing:border-box;padding:10px;border-radius:5px;background-color:#A0E75A;margin-left:20px;position:relative;font-size:16px;color:#ffffff;}
.dashi_point_box::after {content:'';width:0;height:0;display:inline-block;border:20px solid transparent;border-right-color:#A0E75A;position:absolute;left:-28px;z-index:-1;}
.dashi_audio_time {font-size:14px;color:#999999;padding:10px;position:relative;}
.newMsg::after {content:'';width:8px;height:8px;border-radius:50%;background-color:#eb4d4b;display:inline-block;right:0;top:0;position:absolute;}
.dashi_icon {width:24px;height:24px;padding-right:10px;}
.kefu_point {padding:10px;font-size:14px;color:#000000;}
.kefu_btn {height:50px;margin-top:20px;background-color:#FC9208;border-radius:5px;font-size:18px;color:#ffffff;line-height:50px;text-align:center;position:relative;}
.kefu_btn::before {content:'';width:30px;height:30px;background:url('http://sm.03ky.com/statics/ffsm/bazijp/img/wen.png') no-repeat;background-size:100% 100%;display:inline-block;vertical-align:middle;margin-right:15px;margin-bottom:8px;}
.kefu_btn::after {content:"8";font-size:12px;width:20px;height:20px;position:absolute;top:0;margin-left:15px;line-height:20px;text-align:center;color:#ffffff;display:inline-block;background-color:#D40D0A;border-radius:50%;animation:msgSclac 1s infinite ease-out;-webkit-animation:msgSclac 1s infinite ease-out;-moz-animation:msgSclac 1s infinite ease-out;-o-animation:msgSclac 1s infinite ease-out;-ms-zoom-animation:msgSclac 1s infinite ease-out;}
.border2 {border-top:1px solid #e2ccb0;margin-top:20px;}
.fiex_bt {position:fixed;bottom:0;left:0;width:100%;z-index:35;line-height:46px;font-size:16px;height:46px;background-color:rgba(0,0,0,.5);text-align:center;display:none;}
.fiex_bt a {margin:5px 5px 0;line-height:36px;height:36px;text-decoration:none;background-color:red;display:block;font-size:16px;color:#fff;border-radius:5px;}
.fiex_bt a .suo {display:inline-block;height:40px;width:40px;background:url("../images/public/public_lock.png") center/80% no-repeat;vertical-align:top;margin-right:5px;}
.fiex_bt {height:50px;line-height:50px;font-size:18px;}
.fiex_bt a {background-color:#D60F00;height:40px;line-height:40px}

</style>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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