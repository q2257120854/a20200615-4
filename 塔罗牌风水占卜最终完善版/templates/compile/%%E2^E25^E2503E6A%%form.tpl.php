<?php /* Smarty version 2.6.25, created on 2019-03-02 12:33:40
         compiled from index/xmfx/form.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>姓名详批-姓名吉凶分析、八字姓名详批</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min-v=0817.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/jieming/1/jieming.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/ffsm/statics/ffsm/public/sty.css">

<script src="https://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">姓名详批</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/ffsm/jieming/1/images/banner-jm2.png" alt="姓名解名"/>
</div>
<ul class="public_tab clear">
	<li class="current"><a href="javascript:;">姓名解名</a><span></span></li>
	<li><a href="/?ac=history">我的测算</a></li>
</ul>
<div class="public_tab_item">
	<form class="J_ajaxForm" action="/?ac=xmfx" name="login" method="post" id="submit1">
		<div class="public_form_wrap">
			<ul>
				<li>
				<div class="left">
					您的姓氏
				</div>
				<div class="auto">
					<input type="text" class="bg_no" id="xing" name="xing" placeholder="请输入姓氏（必须汉字）"/>
				</div>
				</li>
				<li>
				<div class="left">
					您的名字
				</div>
				<div class="auto">
					<input type="text" class="bg_no" id="username" name="username" placeholder="请输入名字（必须汉字）"/>
				</div>
				</li>
				<li>
				<div class="left">
					您的性别
				</div>
				<div class="auto sex J_sex">
					<span data-value="1" class="cur"><i></i><font>男</font></span><span  data-value="0"><i></i><font>女</font></span><input type="hidden" name="gender" value="1"/>
				</div>
				</li>
				<li>
				<div class="left">
					出生日期
				</div>
				<div class="auto">
					<input type="text" id="birthday" data-toid-date="b_input" data-toid-hour="b_hour" class="Js_date" data-type="0" data-date="1985-7-1" value="" placeholder="请选择日期" />
                    <input type="hidden" name="birthday" id="b_input" />
                    <input type="hidden" name="h" id="b_hour" value="0" />
				</div>
				</li>
				 
                
			</ul>
		</div>
		<div class="public_agreement">
			<input type="checkbox" checked="checked" id="agreeInput">同意<a href="javascript:;" id="protocolShowBtn">个人隐私协议</a>
		</div>
      </form>
      
      
      <div class="public_btn_s J_testFixedShow">
            <a href="javascript:;" class="J_ajax_submit_btn J_ajax_submit_btnsub" >马上解名</a>
        </div>
        
        
		<div class="product_introduction">
			<p class="pi_t">
				测算后你将了解如下信息：
			</p>
			<div class="xmjm_influence">
				<p class="public_red">
					我的姓名对我的影响？
				</p>
				<p class="words">
					点击测算后解锁所有信息
				</p>
				<p>
					<img src="/ffsm/statics/ffsm/jieming/1/images/img_lei.jpg" alt="#"/>
				</p>
			</div>
			<div class="xmjm_unlock">
				<p class="public_red">
					解开姓名背后的秘密，就等于掌握了自己人生的杠杆
				</p>
				<p class="words">
					一个人的健康、事业、家庭、人际关系等在一定程度上会从姓名上反映出来。姓名五格的生克关系对健康的影响很大，从天、人、地三格的数理关系可推断人的健康状况和生活顺利与否。
				</p>
				<p>
					<img src="/ffsm/statics/ffsm/jieming/1/images/img_syt.jpg" alt="#"/>
				</p>
				<p>
					<img src="/ffsm/statics/ffsm/jieming/1/images/commun.png" alt="#"/>
				</p>
			</div>
		</div>
        
	
	<div class="public_test_fixed J_ajax_submit_btnsub" id="testFixedBtn">
		<span>立即测算</span>
	</div>
    
    <!--轮盘-->
  <div class="luopan_bg_color"></div>
    <div id="luopan_box" class="lunpan_box" style="display: ">
        <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/zixun/luopan.png" alt="" class="img-1" />
        <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/zixun/zhizheng.png" alt="" class="img-2">
    </div>
    <style type="text/css">
    #luopan_box {height: 170px;width: 170px;margin: 0 auto;position: fixed;top: 40%;left: 50%;z-index: 9999999;margin-left: -85px;display: none;vertical-align: middle;}
	#luopan_box .img-2 {width: 20px;height: 140px;position: fixed;top: 42%;left: 50%;margin: 0 auto; margin-left: -10px; -webkit-animation: rotate2 4s linear infinite;animation: rotate2 4s linear infinite;}
	#luopan_box img.img-1 {width: 170px;height: 170px;-webkit-animation: rotate 4s linear infinite;animation: rotate 4s linear infinite;}
	.luopan_bg_color { width: 100%;height: 100%;    position: fixed;    left: 0;    top: 0;    z-index: 9999998;    background: #000;    opacity: 0.7;    transition: opacity 0.5s;    display: none;}
    </style>
    <script>
        function showLoading() {
            if ($('luopan_box') == null)
                return false;
            $('#luopan_box').fadeToggle(500);
            $('#luopan_box').show();
            $('.luopan_bg_color').show();
            return true;
        }

        function hideLoading() {
            if ($('luopan_box') == null)
                return false;
            $('#luopan_box').hide();
            $('.luopan_bg_color').hide();
            return true;
        }

    </script>
    <!--轮盘-->
    
    
    <script src="/ffsm/statics/cdn.12ystar.com/website/Scripts/home/require.min.js" data-main="/ffsm/statics/cdn.12ystar.com/website/Content/hlybz/js/common.min.js"></script>

	<script>
    //测算底部悬浮
    (function(){
    	var topShow=$(".J_testFixedShow");
    	if(topShow.length){
            var topShow=topShow.offset().top;
    		var topNum=$(".J_testFixedTop").length>0?($(".J_testFixedTop").offset().top-20):200;
    		var testBtn=$("#testFixedBtn");
    		$(window).scroll(function(){
                var wt=$(window).scrollTop();
                wt>topShow?(testBtn.fadeIn(),$('.public_footer_servers').css('padding-bottom','50px')):(testBtn.fadeOut(),$('.public_footer_servers').css('padding-bottom','20px'));
            });
            testBtn.add('.J_testScrollTop').on('click',function(){$('html,body').scrollTop(topNum)})
    	}
    })()
      
	</script>
</div>
<div class="protocol_pop_box" id="protocolPopBox">
	<div class="ppb_content">
		<div class="ppb_title">
			个人隐私协议
		</div>
		<div class="ppb_text">
			<p>
				尊敬的用户，欢迎阅读本协议：
			</p>
			<p>
				塔罗占卜科技依据本协议的规定提供服务，本协议具有合同效力。您必须完全同意以下所有条款，才能保证享受到更好的服务。您使用服务的行为将视为对本协议的接受，并同意接受本协议各项条款的约束。
			</p>
			<p>
				用户在申请塔罗占卜科技服务过程中，需要填写一些必要的个人信息，为了更好的为用户服务，请保证提供的这些个人信息的真实、准确、合法、有效并注意及时更新。<strong>若因填写的信息不完整或不准确，则可能无法使用本服务或在使用过程中受到限制。如因用户提供的个人资料不实或不准确，给用户自身造成任何性质的损失，均由用户自行承担。</strong>
			</p>
			<p>
				保护用户个人信息是塔罗占卜科技的一项基本原则，塔罗占卜科技运用各种安全技术和程序建立完善的管理制度来保护用户的个人信息，以免遭受未经授权的访问、使用或披露。<strong>未经用户许可塔罗占卜科技不会向第三方（塔罗占卜科技公司或关联、运营合作单位除外）公开、透露用户个人信息，但由于政府要求、法律政策需要等原因除外。</strong>
			</p>
			<p>
				在用户发送信息的过程中和本网站收到信息后，<strong>本网站将遵守行业通用的标准来保护用户的私人信息。但是任何通过因特网发送的信息或电子版本的存储方式都无法确保100%的安全性。因此，本网站会尽力使用商业上可接受的方式来保护用户的个人信息，但不对用户信息的安全作任何担保。</strong>
			</p>
			<p>
				此外，您已知悉并同意：<strong>在现行法律法规允许的范围内，塔罗占卜科技可能会将您非隐私的个人信息用于市场营销，使用方式包括但不限于：在网页或者app平台中向您展示或提供广告和促销资料，向您通告或推荐服务或产品信息，使用电子邮件，短信等方式推送其他此类根据您使用塔罗占卜科技服务或产品的情况所认为您可能会感兴趣的信息。</strong>
			</p>
			<p>
				本网站有权在必要时修改服务条例，<strong>本网站的服务条例一旦发生变动，将会在本网站的重要页面上提示修改内容，用户如不同意新的修改内容，须立即停止使用本协议约定的服务，否则视为用户完全同意并接受新的修改内容。</strong>根据客观情况及经营方针的变化，本网站有中断或停止服务的权利，用户对此表示理解并完全认同。
			</p>
			<p>
				如果您还有其他问题和建议，可以通过电子邮件88888888@qq.com联系我们。
			</p>
			<p>
				塔罗占卜科技保留对本协议的最终解释权。
			</p>
		</div>
		<div class="ppb_close" id="protocolHideBtn">
			<b>关闭</b>
		</div>
	</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--塔罗占卜网付费5G云测算源码-->
</body>
</html>