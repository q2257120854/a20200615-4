<?php /* Smarty version 2.6.25, created on 2019-03-23 09:33:00
         compiled from index/ziwei/form.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<title>紫微斗数-紫微精批</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<link rel="shortcut icon" href="/ffsm/statics/ffsm/favicon.ico"/>
<link href="/ffsm/statics/ffsm/public/wap.min.css" rel="stylesheet" type="text/css"/>
<link href="/ffsm/statics/ffsm/ziwei/1/ziwei.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/ffsm/statics/ffsm/public/sty.css">

<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<header class="public_header">
<h1 class="public_h_con">紫微精批</h1>
<a class="public_h_home" href="/"></a><a href="/?ac=history" class="public_h_menu">我的测算</a></header>
<div class="public_banner">
	<img src="/ffsm/statics/ffsm/ziwei/1/images/img_banner.jpg" alt="紫微精批"/>
</div>
<div class="introduction">
	紫微斗数是东方中国最著名的占星学，利用人类出生时夏历时间进行斗数星盘的排列，将满天星曜飞布人生十二宫，并据以解释人生命运起伏，紫微斗数经老师团队多年研究，准确率高达95%！
</div>
<form class="J_ajaxForms" action="/?ac=ziwei" method="post" id="submit1" name="login">
	<div class="public_form_wrap" id="form_wrapper">
		<ul>
			<li>
			<div class="left">
				姓名
			</div>
			<div class="auto">
				<input type="text" class="bg_no" id="username" name="username" placeholder="请输入名字（必须汉字）"/>
			</div>
			</li>
			<li>
		
			<div class="left">
				性别
			</div>
			<div class="auto sex J_sex">
				<span class="cur" data-value="1">男</span><span data-value="0">女</span><input type="hidden" id="sex" name="gender" value="1"/>
			</div>  
			</li> 
			<li>
			<div class="left">
				生日
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
	<div class="public_btn_s J_testFixedShow">
    <a href="javascript:;" class="J_ajax_submit_btn public_btn" >开启命盘</a>
	</div>
	<p class="text_number">
		已有 <span>4985559</span> 人测算
	</p>
</form>
<div class="public_box">
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title">
		全面解析你的人生
	</div>
	<div class="public_box_pic">
		<p>
			<img src="/ffsm/statics/ffsm/ziwei/1/images/img01.jpg"/>
		</p>
		<p>
			<img src="/ffsm/statics/ffsm/ziwei/1/images/img02.jpg"/>
		</p>
	</div>
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title">
		专业精批值得信赖
	</div>
	<div class="public_box_pic">
		<p>
			<img src="/ffsm/statics/ffsm/ziwei/1/images/img03.jpg"/>
		</p>
	</div>
	<div class="pb_txt">
		<p class="violet_words">
			数万
		</p>
		<p>
			真人命盘验证
		</p>
		<p>
			准确率高达<span class="public_red">95%</span>以上
		</p>
	</div>
	<p class="public_box_pic">
		<img src="/ffsm/statics/ffsm/ziwei/1/images/img04.jpg"/>
	</p>
	<p class="publci_bg_top">
	</p>
	<div class="destiny">
		<p class="d_title">
			知命用命,方成大事
		</p>
		<p>
			每个人的运势都如同海上的波浪,有时起有时落,走运的时候我们可以努力加把劲,不顺的时候我们积蓄力量等待机会爆发,<span class="public_red">紫微可以让我们把这种起伏看得更清楚。</span>
		</p>
	</div>
	<div class="public_box_pic">
		<p>
			<img src="/ffsm/statics/ffsm/ziwei/1/images/img05.jpg"/>
		</p>
	</div>
	<p class="destiny_list">
		<span class="public_red">50</span>%以上的人在本该努力的时候选择了安逸
	</p>
	<p class="destiny_list">
		<span class="public_red">80</span>%以上的人在本该坚持的时候放弃了
	</p>
	<p class="destiny_list">
		<span class="public_red">95</span>%以上的穷其一生执着于错误的选择
	</p>
	<div class="destiny_last">
		<p>
			而只有<span class="public_red">1%</span>的人才真正懂得:
		</p>
		<p>
			知命用命,把握时机。
		</p>
	</div>
	<div class="public_btn_s ">
		<a href="javascript:;" class="public_btn btn2 " onclick="$('html, body').animate({scrollTop : $('#form_wrapper').offset().top}, 500);">查看我的紫微详批</a>
	</div>
	<p class="publci_bg_top">
	</p>
	<div class="public_box_title">
		95%命主一致好评
	</div>
	<div class="user_feedback">
		<div class="uf_ul_wrap" id="feedbackScroll">
			<ul class="uf_ul">
				<li><strong>王先生 150****1946</strong>
				<p>
					最近非常的烦躁，迷茫。按照紫微精批里的建议做了改变，生活、工作渐渐有起色。
				</p>
				</li>
				<li><strong>张女士 186****4160</strong>
				<p>
					通过紫微精批知道自己转运就在明年此时，重新燃起对未来的希望。
				</p>
				</li>
				<li><strong>林女士 180****9949</strong>
				<p>
					事业和感情方面都分析的很对，希望明年能够顺利结婚！
				</p>
				</li>
				<li><strong>洪先生 186****8384</strong>
				<p>
					我之前对考公有些抗拒，测算后发现自己更适合事业单位，现在已经入职啦。
				</p>
				</li>
				<li><strong>郑先生 138****7116</strong>
				<p>
					结果显示我下半辈子的主要收入来源还是在于主业。看来要好好经营店铺了！
				</p>
				</li>
				<li><strong>许女士 150****7913</strong>
				<p>
					婚后天天吵架，日子过的不顺心，经过老师开解，运势有了极大改善。
				</p>
				</li>
				<li><strong>贝先生 186****3325</strong>
				<p>
					爱情部分说的很准，自已已经单身很多年了，希望早日告别单身狗行列！
				</p>
				</li>
				<li><strong>周先生 133****2187</strong>
				<p>
					我的性格和测算中说的一摸一样，自己在事业上老师犹豫不决，还好有老师的建议。谢谢老师！
				</p>
				</li>
				<li><strong>黄女士 180****1310</strong>
				<p>
					这个真的好准，如老师所说今年确实因为意外耗费了一大笔钱财。
				</p>
				</li>
				<li><strong>方先生 138****0223</strong>
				<p>
					听人说房屋朝向最好是能根据自己的紫微命盘特点来选择，特地请教了老师。
				</p>
				</li>
				<li><strong>李小姐 150****5709</strong>
				<p>
					原来我是做行政工作的，工作并不顺心。希望能如测算结果所说通过跳槽改善自己的事业运势。
				</p>
				</li>
				<li><strong>龙先生 186****0301</strong>
				<p>
					通过该测算得知自己最近3个月的运势不佳，赶紧按照老师建议调整自己的床头方向，佩戴吉祥物等。运势有了很大的改观，生活，工作渐渐有起色。
				</p>
				</li>
				<li><strong>徐女士 138****1238</strong>
				<p>
					开了个中档次的服装店生意一直不好。听从老师建议以后对店铺进行了装修改造，现在生意真是越来越火爆！
				</p>
				</li>
				<li><strong>叶女士 150****7364</strong>
				<p>
					和相处了2年的男朋友分手之后很沮丧，后来听了老师的解析，了解了自己的姻缘运势，现在只想沉下心来好好工作，希望能像老师说的早日碰到适合自己的另一半。
				</p>
				</li>
			</ul>
		</div>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
            $(function(){
                // 服务轮播
                var scrollTop=0;
                var scrollUl=$('#feedbackScroll').children('ul');
                function scrollTip(){
                    var top=scrollUl.children('li').eq(0).outerHeight();
                    if(Math.abs(scrollTop)==Math.abs(top)){
                        scrollUl.children('li').eq(0).appendTo(scrollUl);
                        scrollUl.css("top",0);
                        scrollTop=0;
                    }else{
                        scrollTop--;
                        scrollUl.css("top",scrollTop);
                    }
                }
                setInterval(scrollTip,50);
            })
</script>
<script>
	var sexCheckbox = $(".J_sex");
	if (sexCheckbox.length && sexCheckbox.children("span").on("click", function() {
		$(this).addClass("cur"), $(this).siblings("span").removeClass("cur");
		var e = $(this).data("value");
		$(this).parent().find("input").val(e)
	}), $("form.J_ajaxForms").length > 0) for (var formInput = $("form.J_ajaxForms").find("input"), inp = 0, inpMax = formInput.length; inp < inpMax; inp++) {
		var fthis = formInput.eq(inp),
			fname = fthis.attr("name");
		if ("" != fname && window.localStorage && localStorage.getItem(fname)) switch (!0) {
		case /gender / .test(fname):
			1 == localStorage.getItem(fname) ? fthis.parent(".J_sex").children("span[data-value=1]").addClass("cur").siblings("span").removeClass("cur") : fthis.parent(".J_sex").children("span[data-value=0]").addClass("cur").siblings("span").removeClass("cur"), fthis.val(localStorage.getItem(fname));
			break;
		case /birthday / .test(fname):
			$("#" + fname).attr("data-date", localStorage.getItem(fname));
			break;
		default:
			if ("true" == fthis.attr("nolocal")) break;
			"text" == fthis.attr("type") && fthis.val(localStorage.getItem(fname))
		}
	}
</script>

</body>
</html>