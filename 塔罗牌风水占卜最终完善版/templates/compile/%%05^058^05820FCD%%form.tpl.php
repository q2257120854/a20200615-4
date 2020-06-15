<?php /* Smarty version 2.6.25, created on 2019-02-28 11:05:51
         compiled from index/bazi/form.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>四柱八字精批测算、2019流年运程大全-中国易经研究院</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/bazimf/wap.min-v=0817.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/bazimf/style.min.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="/ffsm/statics/ffsm/bazimf/sty.css"/>
<script src="https://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">八字综合详批</h1>
<a class="public_h_home" href="/"></a><a href="?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/ffsm/bazimf/images/banner.png" alt="八字精批"/>
</div>
<div class="public_bg_color">
	<form class="J_ajaxForm J_testFixedTop" id="submit1" action="/?ac=bazi" name="login" method="post">
		<div class="public_form_wrap" id="miaodian">
			<ul>
				<li>
				<div class="left">
					您的姓名
				</div>
				<div class="auto">
					<input type="text" class="bg_no" id="username" name="username" placeholder="请输入名字（必须汉字）" value=""/>
				</div>
				</li>
				<li>
				<div class="left">
					您的性别
				</div>
				<div class="auto sex sex J_sex">
					<span class="cur" data-value="1"><i></i><font>男</font></span><span data-value="0"><i></i><font>女</font></span><input type="hidden" name="gender" value="1"/>
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
		<div class="public_btn_s">
        <a href="javascript:;" class="J_ajax_submit_btn J_ajax_submit_btnsub" >立即测算</a>
		</div>
		<div class="form_bottom_txt J_testFixedShow">
			<span>已为<b>23285408</b>人查看2018八字命格详批</span><a href="/?ac=history"><span>查看历史订单 ></span></a>
		</div>
	</form>
</div>
<div class="public_bg_color">
	<div class="know_img">
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_1.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_2.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_3.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_4.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_5.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_6.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_8.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_9.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_10.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_11.png" alt="测算后您将知道以下信息"/>
		<img src="/ffsm/statics/ffsm/bazimf/images/jp_12.png" alt="测算后您将知道以下信息"/>
	</div>
</div>

<style type="text/css">
.input_btn {
    margin: 10px 2px;
    overflow: hidden;
}

.input_btn a {
    width: 100%;
    float: left;
	margin:0 auto;
    box-sizing: border-box;
    height: 36px;
    line-height: 36px;
    color: #fff;
    text-align: center;
}

.as_form .input_btn .cancel {
    background-color: #999;
	border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
	
}

.input_btn .sure {
    border: 1px solid #f90;
    background-color: #f90;
}

.input_text, .as_form .input_textarea {
    position: relative;
    display: block;
    overflow: hidden;
    padding: 0 0 0 100px;
    height: 32px;
    margin: 6px 4px;
}

.input_text span, .as_form .input_textarea span {
    width: 94px;
    padding: 0 0 0 6px;
    position: absolute;
    left: 0;
    top: 0;
    height: 32px;
    line-height: 32px;
}
.input_text input, .as_form .input_textarea textarea {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #ccc;
    height: 32px;
    padding: 0 4px;
}

.as_form {
    position: relative;
	margin:0;
}
</style>

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
				汇丰科技依据本协议的规定提供服务，本协议具有合同效力。您必须完全同意以下所有条款，才能保证享受到更好的服务。您使用服务的行为将视为对本协议的接受，并同意接受本协议各项条款的约束。
			</p>
			<p>
				用户在申请汇丰科技服务过程中，需要填写一些必要的个人信息，为了更好的为用户服务，请保证提供的这些个人信息的真实、准确、合法、有效并注意及时更新。<strong>若因填写的信息不完整或不准确，则可能无法使用本服务或在使用过程中受到限制。如因用户提供的个人资料不实或不准确，给用户自身造成任何性质的损失，均由用户自行承担。</strong>
			</p>
			<p>
				保护用户个人信息是汇丰科技的一项基本原则，汇丰科技运用各种安全技术和程序建立完善的管理制度来保护用户的个人信息，以免遭受未经授权的访问、使用或披露。<strong>未经用户许可汇丰科技不会向第三方（汇丰科技公司或关联、运营合作单位除外）公开、透露用户个人信息，但由于政府要求、法律政策需要等原因除外。</strong>
			</p>
			<p>
				在用户发送信息的过程中和本网站收到信息后，<strong>本网站将遵守行业通用的标准来保护用户的私人信息。但是任何通过因特网发送的信息或电子版本的存储方式都无法确保100%的安全性。因此，本网站会尽力使用商业上可接受的方式来保护用户的个人信息，但不对用户信息的安全作任何担保。</strong>
			</p>
			<p>
				此外，您已知悉并同意：<strong>在现行法律法规允许的范围内，汇丰科技可能会将您非隐私的个人信息用于市场营销，使用方式包括但不限于：在网页或者app平台中向您展示或提供广告和促销资料，向您通告或推荐服务或产品信息，使用电子邮件，短信等方式推送其他此类根据您使用汇丰科技服务或产品的情况所认为您可能会感兴趣的信息。</strong>
			</p>
			<p>
				本网站有权在必要时修改服务条例，<strong>本网站的服务条例一旦发生变动，将会在本网站的重要页面上提示修改内容，用户如不同意新的修改内容，须立即停止使用本协议约定的服务，否则视为用户完全同意并接受新的修改内容。</strong>根据客观情况及经营方针的变化，本网站有中断或停止服务的权利，用户对此表示理解并完全认同。
			</p>
			<p>
				如果您还有其他问题和建议，可以通过电子邮件2825971227@qq.com联系我们。
			</p>
			<p>
				汇丰科技保留对本协议的最终解释权。
			</p>
		</div>
		<div class="ppb_close" id="protocolHideBtn">
			<b>关闭</b>
		</div>
	</div>
</div>
<div class="public_test_fixed" id="testFixedBtn">
	<span>立即测算</span>
</div>
<script>

$('.sure').click(function(){
	alert('你没有付费不能评价');
	return false;
});
</script>

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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--塔罗占卜付费测算源码-->
</body>
</html>