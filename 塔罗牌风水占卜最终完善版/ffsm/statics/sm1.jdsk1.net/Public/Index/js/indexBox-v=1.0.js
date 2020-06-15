(function(){
	'use strict';
	//设置常用变量
	var doc=document,
		fatherBox=document.getElementById('bzjpBox');//父级盒子
	var createEle=function(eleStr){
		return doc.createElement(eleStr);
	}
	//header
	var	header=createEle('header');
		header.className='public_header';
		fatherBox.appendChild(header);
	//header Conter
	var head_h1=createEle('h1');
		head_h1.className='public_h_con';
		head_h1.innerHTML='八字精批';
	var	head_eq=createEle('a'),
		head_eqB=createEle('a');
		head_eq.className='public_h_home';
		head_eqB.className='public_h_menu';
		head_eq.setAttribute('href','/index');
		head_eqB.setAttribute('href',"/Home/Index/history");
		head_eqB.innerHTML='我的订单';
	header.appendChild(head_h1);
	header.appendChild(head_eq);
	header.appendChild(head_eqB);
	//banner
	var banner=createEle('div');
		banner.className='public_banner';
	var bannerImg=createEle('img');
		bannerImg.setAttribute('src','/Public/Index/images/bzzy_banner.jpg');
	fatherBox.appendChild(banner);
	banner.appendChild(bannerImg);
	//信息提交板块
	var infoBox=createEle('div');
		infoBox.className='public_bg_color';
	var infoTop='<div class="public_border_title"><div class="b_t_up"><span></span></div><div class="b_t_body"><span>测算老师-孙弘均简介</span></div><div class="b_t_down"><span></span></div></div><div class="master_introduction"><p>孙弘均老师作为国学易学专家，潜心研习易经及各类命理经典，拥有20多年的命理测算经验，独立创办清风国学社，弘扬具有深厚底蕴的国学文化和易学文化，成为了华南地区十大国学老师之一，享誉国际。</p></div><p class="rn_words" id="dianwocesuan">立即揭开八字奥秘</p>';
	infoBox.innerHTML=infoTop;
	var infoCon='<div class="sm_form"><div class="qm_form_2"><form action="'+infoButUrl+'" class="form_c"><ul><li><span class="sm_form_name">您的姓名：</span><div class="sm_form_txt"><input class="animated" style="width:100%;float:left" type="text" id="smname" name="surname" placeholder="请输入姓名" value="'+infoName+'" autocomplete="off" /></div></li><li><span class="sm_form_name">您的性别：</span><div class="sm_form_txt sm_form_sex"><span class="'+(gender == 1 ? ("cur"):(""))+'" data-value="1"><i><em></em></i><font>男</font></span><span class="'+(gender == 0 ? ("cur"):(""))+'"  data-value="0"><i><em></em></i><font>女</font></span><input type="hidden" name="sex" id="gender" value="'+gender+'"></div></li><li><span class="sm_form_name">出生日期：</span><div class="sm_form_txt"><span class="icon_right"></span><input type="text" id="birthday" data-toid-date="b_input" data-toid-hour="hour" class="Js_date animated patternData" data-type="0"placeholder="请选择出生日期"value="'+AllData+'"data-hour="'+dataHour+'"data-date="'+dataDate+'" /><input type="hidden" name="birthday" id="b_input" value="'+b_input+'"><input type="hidden" name="hour" id="hour" value="'+hour+'"></div></li></ul><input type="hidden" name="__hash__" value="'+hash+'"></form><div class="sm_btn"><div id="agreebox" style="text-align:center;font-size:14px;padding:0.2rem;"></div><p class=""><a href="javascript:;" id="cs" style="text-align:center;line-height:50px;height:50px;font-size:20px;">立即测算</a></p></div></div></div>';
	fatherBox.appendChild(infoBox);
	$('.public_bg_color').append(infoCon)
	//调用时间插件
	var calendar1 = new ruiDatepicker().init('#birthday');
	//日期插件点击输入框确保其失去焦点,导致页面跳转问题
	$('.patternData').on('click', function() {
	   	$(this).blur();
	})
	
	//内容板块1   测算后您将知道以下信息
	var ConBoxa=createEle('div');
		ConBoxa.className='public_bg_color';
	var conBoxaHtml='<div class="public_border_title"><div class="b_t_up"><span></span></div><div class="b_t_body"><span>测算后您将知道以下信息</span></div><div class="b_t_down"><span></span></div></div><p class="public_bzjp_box"><img src="/Public/Index/images/img_bazi_1.png" alt="测算后您将知道以下信息" /></p>';
	ConBoxa.innerHTML=conBoxaHtml;
	fatherBox.appendChild(ConBoxa);
	//内容板块2   测算内容对您有什么帮助
	var ConBoxb=createEle('div');
		ConBoxb.className='public_bg_color';
	var ConBoxbHtml='<div class="public_border_title"><div class="b_t_up"><span></span></div><div class="b_t_body"><span>测算内容对您有什么帮助</span></div><div class="b_t_down"><span></span></div></div><p class="public_bzjp_box"><img src="/Public/Index/images/img_help01_1.png" alt="测算后您将知道以下信息" /><img src="/Public/Index/images/img_help02_1.png" alt="测算后您将知道以下信息" /></p>';
	ConBoxb.innerHTML=ConBoxbHtml;
	fatherBox.appendChild(ConBoxb);
	//评论滚动  测算用户真实反馈
	if(url_comment == 1){
		var pinglun=createEle('div');
		var	pinglunHtmlTop='<div class="public_border_title"><div class="b_t_up"><span></span></div><div class="b_t_body"><span>测算用户真实反馈</span></div><div class="b_t_down"><span></span></div></div><div class="true_feedback"><p class="center"><span class="red">98.6%</span>的用户通过测算</p><p class="center mb10" style="border-bottom:1px solid #959595;">明确了自己的人生方向</p><div class="gunK"><ul id="gunD"></ul></div><div id="xinxinTips"><h2 class="xinxinNav"><span>请您点评此项测算</span></h2><div class="xinxinBox"><div class="xxSelect"><span>满意度</span><div class="xxBoxBJ manyi"><i></i><i></i><i></i><i></i><i></i><input type="hidden" id="m_yi" value="" /></div><em></em></div></div><div class="xinxinBox"><div class="xxSelect"><span>准确度</span><div class="xxBoxBJ zhunque"><i></i><i></i><i></i><i></i><i></i><input type="hidden" id="z_que" value="" /></div><em></em></div></div><div class="xxPhone"><input type="text" id="xxPhoneCon" value="" placeholder="请输入您的订单号"/></div><div class="xxText"><textarea name="xxTextCon" rows="8" cols="8" placeholder="请输入想说的话"></textarea></div><div class="xxSubmit"><button>提交评价</button></div></div></div>';
		var	pinglunHtmlLi='';
		pinglun.innerHTML=pinglunHtmlTop;
		fatherBox.appendChild(pinglun);
		$.ajax({
			type:"post",
			url:pinglUrl,
			dataType:'json',
			success:function(data){
				if(data.code == '8004'){
					for(var i in data.info){
						pinglunHtmlLi+='<li><div class="plTopHeader"><i class="sex'+data.info[i].sex+'"></i><div class="xinxin myxinxin2"><em></em><em></em><em></em><em></em><em></em></div></div><dl><dd>'+data.info[i].content+'</dd><dt >订单号：'+data.info[i].order_id+'&nbsp;&nbsp;手机号：'+data.info[i].phone+'<span>'+data.info[i].area+'</span></dt></dl></li>';
					}
					//滚动
					var showTrueB=true;
					$.fn.imgscroll = function(o){
						var defaults = {
							speed: 40,
							amount: 0,
							width: 1,
							dir: "left"
						};
						o = $.extend(defaults, o);
						return this.each(function(){
							var _li = $("li", this);
							_li.parent().parent().css({overflow: "hidden", position: "relative"}); //div
							_li.parent().css({margin: "0", overflow: "hidden", position: "relative", "list-style": "none"}); //ul
					
							_li.css({position: "relative", overflow: "hidden"}); //li
							if(o.dir == "left") _li.css({float: "left"});
							var _li_size = 0;
							for(var i=0; i<_li.size(); i++)
								_li_size += o.dir == "left" ? _li.eq(i).outerWidth(true) : _li.eq(i).outerHeight(true);
							if(o.dir == "left") _li.parent().css({width: (_li_size*3)+"px"});
							_li.parent().empty().append(_li.clone()).append(_li.clone()).append(_li.clone());
							_li = $("li", this);
							var _li_scroll = 0;
							function goto(){
								_li_scroll += o.width;
								if(_li_scroll > _li_size)
								{
									_li_scroll = 0;
									_li.parent().css(o.dir == "left" ? { left : -_li_scroll } : { top : -_li_scroll });
									_li_scroll += o.width;
								}
									_li.parent().animate(o.dir == "left" ? { left : -_li_scroll } : { top : -_li_scroll }, o.amount);
							}
							var move = setInterval(function(){
								if(showTrueB == true){
									goto();
								}else{
								}
							}, o.speed);
					//			_li.parent().hover(function(){
					//					clearInterval(move);
					//			},function(){
					//					clearInterval(move);
					//					move = setInterval(function(){ goto(); }, o.speed);
					//			});
						});
					};
					$('#gunD').append(pinglunHtmlLi);
					$("#gunD").imgscroll({speed: 30,amount: 1,dir: "up"});
				}
			}
		});
	}
	
	//内容板块3   核心优势
	var ConBoxc=createEle('div');
		ConBoxc.className='dsTeam';
	var ConBoxcHtml='<div class="public_border_title" style="margin-bottom:0;"><div class="b_t_up"><span></span></div><div class="b_t_body"><span>核心优势</span></div><div class="b_t_down"><span></span></div></div><div class="team_jj"><div class="teamTit"><span><i class="teFang"></i>周易文化20年精诚局钜献<i class="teFang"></i></span></div><ul class="teamTxt"><li>【忠实用户】超过1亿用户，覆盖48个国家及华人地区</li><li>【专业名师】签约合作华人易学权威数十人</li><li>【精英团队】数百位玄学精英编撰后台内容</li><li>【内容丰富】每项超值数万字内容精析</li></ul><div class="teamTit"><span><i class="teFang"></i>合作华人易学权威<i class="teFang"></i></span></div><div class="team_dashijianjie"><img src="/Public/Index/images/team_jieshao.png"/></div></div>';
	ConBoxc.innerHTML=ConBoxcHtml;
	fatherBox.appendChild(ConBoxc);
	
	//热门测算
	var hotBox=createEle('div');
		hotBox.className='measure';
		fatherBox.appendChild(hotBox);
	var hotBoxHtml='<h2>热门测算</h2><ul class="measure_img" style="box-sizing:border-box"></ul></div>';
	hotBox.innerHTML=hotBoxHtml;
	$.ajax({
		type:"post",
		url:hotUrl,
		dataType:'json',
		success:function(data){
			var hotBoxLi='';
			if(data.code=='8004'){
				for(var j in data.info){
					hotBoxLi+='<a href="'+data.info[j][3]+'"><li><img src="'+data.info[j][2]+'" alt="'+data.info[j][0]+'" /><p>'+data.info[j][0]+'</p></li></a>';
				}
				$('.measure_img').append(hotBoxLi);
			}
		}
	});
	//<li style="width:100%;overflow: hidden;margin-top:11px;"><img src="/Public/static/images/New_dbzz_3_27.png" style="width:53.2%;display: block;margin:0 auto;"/></li>；
	//底部资质
	var footerBox=createEle('footer');
	footerBox.className='public_footer_servers';
	footerBox.setAttribute('style','margin: 0!important; text-align: center; color: #000; background: #fbf2d3;');
	fatherBox.appendChild(footerBox);
	var footerHtml='<ul><li style="font-size: 14px!important;">'+footerzzBah+'</li><li class="footerPhone" style="font-size: 14px!important;">客服电话:'+footerzzKfPhone+'</li><li class="footerzzFoot" style="font-size: 14px!important;">'+footerzzFoot+'|网站广告支持</li><!--<li style="font-size: 14px!important;line-height:25px;">更多测算信息、问题反馈，请联系在线客服</li>--><li style="font-size: 14px!important;display: none;">周易文化</li><li class="newDbzz"><a href="http://tb.53kf.com/code/client/10169566/1"><span class="is_kf">在线客服</span></a><span class="is_wt" onclick="issueShow()">问题反馈</span></li></ul><div style="height:15px;"></div><div class="isPopup"><div class="isPopupBj" onclick="issueHide()"></div><div class="isPopBox"><span class="isPopNo" onclick="issueHide()"><i></i></span><h2 class="isPopTit"><span>问题反馈</span></h2><div class="isPopBoxInfo"><p>您遇到的问题是：</p><div class="isPoptext isZb"><textarea name="isTxt" rows="8" cols="8"></textarea></div><p class="marBot">手机号码<i>*</i></p><div class="isPopPhone"><input type="text" name="isPhone" id="isPhone" value="" placeholder="请输入您的手机号" /></div><button class="isButton" onclick="issueInfo()">提&nbsp;&nbsp;交</button></div></div></div>';
	footerBox.innerHTML=footerHtml;
	footerzzKfPhone==''?document.querySelector('.footerPhone').style.display='none':document.querySelector('.footerPhone').style.display='block';
	footerzzFoot == ''?document.querySelector('.footerzzFoot').style.display='none':document.querySelector('.footerzzFoot').style.display='block';
	//老师微信
	if(dswxstate == 1){
		var teacherWx=createEle('div'),
			teacherWxHtml="<img style='width:100%' src='/Public/Wap2/images/default_3.0/dswx.png'>";
			teacherWx.innerHTML=teacherWxHtml;
		teacherWx.setAttribute('id','dashi_wx');
		teacherWx.setAttribute('style','display:block;width:4.3rem;height:4.3rem;position:fixed;bottom:7rem;right:0;z-index: 9999;');
		teacherWx.setAttribute('onclick','wxBoxShow()');
		document.getElementsByTagName('body')[0].appendChild(teacherWx);
	}
	//微信弹出层
	var Micro=createEle('div'),
		MicroHtml='<div class="tanchu_box_no" onclick="wxBoxShow()"></div><div class="tanchu_box_con"><div style="width:100%;position:relative;"><b style="width:21px;height:21px;background:url('+publicImg+'/static/images/weixintanchuNo.png) no-repeat;background-size:100%;display:block;position:absolute;top:10px;right:-15px;" onclick="wxBoxShow()"></b><div style="height:15px"></div><div><table><tbody><tr><td><div style="display:flex;flex-flow:column"><div style="flex:1"></div><img style="width:3rem;height:3rem" src="/Public/Wap2/images/default_1.0/weixin_touxiang.png"><div style="flex:1"></div></div></td><td style="font-size:0.9rem;line-height:1.2rem;padding-left:5px"><p>每天只通过50个名额<br>添加微信号<span id="tc_box_wei2">'+nWeixin+'</span>立即咨询</p></td></tr></tbody></table></div><div style="height:15px"></div><div style="display:flex;line-height:40px"><div style="flex:1;border:1px solid #bb1b21;border-top-left-radius:4px;border-bottom-left-radius:5px;text-align:center"><p id="tc_box_wei3" style="color:#bb1b21;text-align:center;font-size:20px">'+nWeixin+'</p></div><div style="width:3rem;background-color:#bb1b21;border-top-right-radius:4px;border-bottom-right-radius:4px"><button style="text-align:center;color:white;font-size:0.9rem;border:0;padding:0;margin:0;display:block;width:100%;height:100%;background:none;line-height:40px;" data-clipboard-action="copy" data-clipboard-target="#tc_box_wei3" class="wxCopynum3">复制</button></div></div><p style="font-size:1rem;color:red;text-align:center;margin:15px 0"></p><div style="width:100%"><div style="width:100%;height:40px;background-color:#3a9e13;color:white !important;font-size:1rem;text-align:center;line-height:40px;border-radius:5px;display:flex" id="wxUrl" class="wxButHide"><div style="flex:1"></div><div style="display:flex;flex-direction:column"><div style="flex:1"></div><img src="/Public/Wap2/images/default_1.0/weixin_icon.png" style="height:20px;width:24px;vertical-align:middle;display:block"> <div style="flex:1"></div></div><div style="margin-left:8px">点击打开微信</div><div style="flex:1"></div></div></div><div style="height:15px"></div><p style="font-size:0.6rem;color:dimgrey;text-align:center;font-style:italic">打开微信，点击右上角“<span style="color:#3cbe0b">+</span>”，点击“<span style="color:#3cbe0b">添加朋友</span>”</p><div style="text-align:center;margin-top:5px"><img style="width:80%" src="/Public/Wap2/images/default_1.0/weixin_demo.png"></div><div style="height:15px"></div></div></div>';
	Micro.innerHTML=MicroHtml;
	Micro.setAttribute('id','newWinx');
	Micro.setAttribute('style','z-index: 10000000;box-sizing: border-box;');
	Micro.className='tanchu_box wei_show2';
	fatherBox.appendChild(Micro);
	var clipboard = new ClipboardJS('.wxCopynum3');
    clipboard.on('success', function(e) {
       layer.msg('复制成功');
       e.clearSelection();
    });
    clipboard.on('error', function(e) {
        layer.msg('请长按微信号进行复制!');
    });
    document.getElementById('wxUrl').onclick=function(){
    	window.location.href='weixin://';
    }
})()
//点击微信显示和关闭
function wxBoxShow(){
	document.getElementById('newWinx').style.display=='block' ? document.getElementById('newWinx').style.display='none': document.getElementById('newWinx').style.display='block';
}
