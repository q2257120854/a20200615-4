<?php /* Smarty version 2.6.25, created on 2019-04-16 15:28:39
         compiled from index/hehun/form.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>在线八字合婚、生辰八字合婚、八字姻缘配对合婚</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/bazihehun/1/wap.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/bazihehun/1/bazihehun.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/ffsm/statics/ffsm/public/sty.css">
<script src="/ffsm/statics//jquery.min.js"></script>
<script src="/ffsm/statics/ffsm/public/js/require/require.min.js"></script>
<script src="/ffsm/statics/ffsm/public/js/common.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">八字合婚</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/img/bzhehun_top_banner.png" alt="八字合婚"/>
<div class="maintxt">在婚恋中遇到一些难题，不知如何取舍，但大家都一样，都是希望对方与自己能情投意合，婚姻生活幸福美满。</div>
</div>
<div class="public_tab_item J_testFixedShow">
	<form class="J_ajaxForm" action="/?ac=hehun" method="post" id="submit1"  name="login">
		<div class="public_form_wrap">
			<div class="sub_left left">
				<span><img src="/ffsm/statics/ffsm/bazihehun/1/images/icon_man.png" alt="男方资料"/></span>男方
			</div>
			<ul>
				<li>
				<div class="left">
					男方姓名
				</div>
				<div class="auto">
					<input type="text" class="bg_no" id="username" name="username" value="" placeholder="请输入姓名"/>
				</div>
				</li>
				<li>
				<div class="left">
					出生日期
				</div>
				<div class="auto">
					<input type="text" id="birthday" name="birthday" data-input-id="b_input" class="Js_date" data-type="0" value="请选择出生日期" placeholder="请选择日期" data-toid-hour="birthday">
				</div>
				</li>
				
			</ul>
		</div>
		<div class="public_form_wrap">
			<div class="sub_left left">
				<span><img src="/ffsm/statics/ffsm/bazihehun/1/images/icon_woman.png" alt="女方资料"/></span>女方
			</div>
			<ul>
				<li>
				<div class="left">
					女方姓名
				</div>
				<div class="auto">
					<input type="text" class="bg_no" id="girl_username" name="girl_username" value="" placeholder="请输入姓名"/>
				</div>
				</li>
				<li>
				<div class="left">
					出生日期
				</div>
				<div class="auto">
					<input type="text" id="birthday1" name="birthday1" data-input-id="b_input" class="Js_date" data-type="0" value="请选择出生日期" placeholder="请选择日期" data-toid-hour="birthday1">
				</div>
				</li>
			</ul>
		</div>
        
      <input type="hidden" name="birthday00" id="birthday00"  value="">
      <input type="hidden" name="birthday01" id="birthday01"  value="">
      <input type="hidden" name="h"  class="auto input J-time" id='j_dd'  value="">
      <input type="hidden" name="h1"  class="auto input J-time1" id='j_dd'  value="">
                
		<div class="public_agreement">
			<input type="checkbox" checked="checked" id="agreeInput">同意<a href="javascript:;" id="protocolShowBtn">个人隐私协议</a>
		</div>
		<div class="public_btn_s">
        	<input type="submit" class="btn-submit J_ajax_submit_btnsub" value="马上测算">
		</div>
	</form>
	<div class="test_count ">
		<span>已有<font>13856706</font>人测算</span><a href="../inquiry/history.html" class="btn_link">我的测算</a>
	</div>
	<div class="public_bg_color">
		<div class="public_bzhh_title">
			<span class="left"></span><span class="right"></span><span class="center">你是否在困扰这些问题？</span>
		</div>
		<p class="pic">
			<img src="/ffsm/statics/ffsm/bazihehun/1/images/img_problem.jpg" alt="你是否在困扰这些问题？"/>
		</p>
	</div>
	<div class="public_bg_color">
		<div class="public_bzhh_title">
			<span class="left"></span><span class="right"></span><span class="center">通过八字合婚您将获得以下内容</span>
		</div>
		<p class="words">
			掌握命运和方法，轻松实现愿望
		</p>
		<p class="pic">
			<img src="/ffsm/statics/ffsm/bazihehun/1/images/img_get.jpg" alt="#"/>
		</p>
	</div>
	<div class="public_bg_color">
		<div class="public_bzhh_title">
			<span class="left"></span><span class="right"></span><span class="center">大师箴言，趋吉避凶</span>
		</div>
		<p>
			<img src="/ffsm/statics/ffsm/bazihehun/1/images/img_zhenyan.jpg" alt="#"/>
		</p>
	</div>
	<div class="box_scroll">
		<div class="public_bzhh_title">
			<span class="left"></span><span class="right"></span><span class="center">用户反馈</span>
		</div>
		<div class="bs_ui" id="con2_qhd_3">
			<ul>
				<li><span class="red">林先生 138****3216</span>
				<p>
					不错，老师建议很中肯，希望能得到女朋友父母的认同。
				</p>
				</li>
				<li><span class="red">秦小姐 150****5978</span>
				<p>
					一直被家里催婚，自己又在两个追求者中犹豫，现在终于能确定了。
				</p>
				</li>
				<li><span class="red">龚先生 186****6649</span>
				<p>
					女儿和对象处了7年了，还没有打算结婚，做家长挺着急的，通过测算才知道她们适合晚婚，我这才放心。
				</p>
				</li>
				<li><span class="red">余先生 150****9257</span>
				<p>
					测算的太准了，我现在婚姻情况就是浑浑噩噩的，希望今年能有所改善。
				</p>
				</li>
				<li><span class="red">李先生 180****1769</span>
				<p>
					按照老师的建议，和妻子的感情真的有所起色。
				</p>
				</li>
				<li><span class="red">文女士 138****8721</span>
				<p>
					很犹豫是不是要和对象结婚，测算过后豁然开朗。
				</p>
				</li>
				<li><span class="red">王先生 180****5042</span>
				<p>
					哈哈，老师怎么知道我们夫妻虽然经常争吵但是感情很好。
				</p>
				</li>
				<li><span class="red">韩先生 138****2787</span>
				<p>
					希望用老师的方法能说服家人接受我的女朋友。
				</p>
				</li>
				<li><span class="red">严女士 150****7571</span>
				<p>
					测算内容挺有参考性的，按照里面的建议确实和男朋友和好了。
				</p>
				</li>
				<li><span class="red">胡先生 186****6377</span>
				<p>
					太准了，最近确实和老婆有些矛盾，正愁无法解决呢。
				</p>
				</li>
				<li><span class="red">郑先生 133****2917</span>
				<p>
					对婚姻和人生的发展迷茫，测算之后终于有了方向。
				</p>
				</li>
				<li><span class="red">何女士 138****8154</span>
				<p>
					当初就觉得女儿和他不合适，唉，后悔没有早点来测算。
				</p>
				</li>
				<li><span class="red">洪女士 180****3483</span>
				<p>
					准备和男朋友结婚，特地来测算一次，希望能如结果所说，婚后生活幸福。
				</p>
				</li>
				<li><span class="red">陈女士 150****9130</span>
				<p>
					遵循老师的建议，和老公又重燃了婚姻激情，谢谢老师。
				</p>
				</li>
				<li><span class="red">张女士 150****7687</span>
				<p>
					看来儿子是真的找到自己的真命天女啦，开心！
				</p>
				</li>
			</ul>
		</div>
	</div>
	<div class="public_test_fixed" id="testFixedBtn">
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

    </script>
    <!--轮盘-->
    
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
				汇丰科技依据本协议的规定提供服务，本协议具有合同效力。您必须完全同意以下所有条款，才能保证享受到更好的汇丰科技服务。您使用服务的行为将视为对本协议的接受，并同意接受本协议各项条款的约束。
			</p>
			<p>
				用户在申请汇丰科技服务过程中，需要填写一些必要的个人信息，为了更好的为用户服务，请保证提供的这些个人信息的真实、准确、合法、有效并注意及时更新。<strong>若因填写的信息不完整或不准确，则可能无法使用本服务或在使用过程中受到限制。如因用户提供的个人资料不实或不准确，给用户自身造成任何性质的损失，均由用户自行承担。</strong>
			</p>
			<p>
				保护用户个人信息是汇丰科技的一项基本原则，汇丰科技运用各种安全技术和程序建立完善的管理制度来保护用户的个人信息，以免遭受未经授权的访问、使用或披露。<strong>未经用户许可汇丰科技不会向第三方（汇丰科技控股或关联、运营合作单位除外）公开、透露用户个人信息，但由于政府要求、法律政策需要等原因除外。</strong>
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
				如果您还有其他问题和建议，可以通过电子邮件88888888@qq.com联系我们。
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">   

$('.J_ajax_submit_btnsub').click(function(){
	
	var birthday = $("#birthday").attr("data-date");
	var birthday1 = $("#birthday1").attr("data-date");	
	
	var username = document.login.username.value;
		var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");
		if(!reg.test(username)){     
		   layer.msg("男主名字输入错误")
		   document.login.username.focus();
		   return false; 
		}
		
	var girl_username = document.login.girl_username.value;
		var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");
		if(!reg.test(girl_username)){     
		   layer.msg("女主名字输入错误")
		   document.login.girl_username.focus();
		   return false; 
		}	
		
		if (birthday == "" || typeof(birthday) == "undefined") {
			layer.msg("男主生日输入错误")
			return false;
		}else{
			$("#birthday").attr("value", birthday);
			$("#birthday00").attr("value", birthday);
		}
			
		if (birthday1 == "" || typeof(birthday1) == "undefined") {
			layer.msg("女主生日输入错误")
			return false;
		}else{
			$("#birthday1").attr("value", birthday1);
			$("#birthday01").attr("value", birthday1);
		}
		
		
		
		
		showLoading();
		setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
				//checkForm();
		  document.getElementById("submit1").submit();
		},2000);
		
		return false;
});

    
function AutoScroll(obj) {
            $(obj).find("ul:first").animate({
                marginTop: "-115px"
            }, 4000, function () {
                $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
            });
        }
        $(function () {
            var myar = setInterval('AutoScroll("#con2_qhd_3")', 500);
        });
    </script>
</body>
</html>