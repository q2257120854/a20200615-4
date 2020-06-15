// JavaScript Document
$(function(){
	
	/****************** 公用 *********************/
	
	//获取可视区高度
	var vH = $(window).height();
	
	//table 隔行换色
	$('.table tbody tr:odd').addClass('highlight');
	
	
	//模拟select
	mySelect($('.j-select'));

	
	/************* 招聘 ****************/
	
	// 招聘首页， 设置元素高度为可视区高度-头部高度
	$('.j-index-main').height(vH-86);
	$(window).resize(function(){
		var vH = $(window).height();
		$('.j-index-main').height(vH-86);	
	})
	
	/************* 服务大厅 ************/
	//左侧导航
	$('.h-nav > li> a').click(function(){
		$(this).parent().siblings().find('.sMenu').hide();
		$('.h-nav a').removeClass('cur');
	
		if($(this).next('.sMenu').is(":hidden"))
		{
			$(this).next('.sMenu').show();
			$(this).addClass('cur');
		}
		else
		{
			$(this).next('.sMenu').hide();
			$(this).removeClass('cur');
		}
	})
	
	//当前点击的菜单高亮显示
	var url = window.location.href;
	var iflag = false;
	$(".sMenu > li > a").each(function(){
		var $this = $(this);
		if($this[0].href==String(url))
		{
			$(this).addClass('actived');
			$(this).parents('.sMenu').show();
			$(this).parents('.sMenu').prev('a').addClass('cur');
		}
	});
	
	
	//让左右两侧一样高
	var sideH = $('.h-side').height();
	var mainH = $('.h-main').height();
	if(sideH>mainH)
	{
		$('.h-main').height(sideH);	
	}
	else
	{
		$('.h-side').height(mainH);	
	}
	
	
	/***************** 商户中心 *******************/
	$('.c1').click(function(){
		$("html,body").animate({scrollTop:$(".payment").offset().top},500)	
	})
	$('.c2').click(function(){
		$("html,body").animate({scrollTop:$(".receipt").offset().top},500)	
	})
	$('.c3').click(function(){
		$("html,body").animate({scrollTop:$(".account").offset().top},1000)	
	})
	
	//让banner高度等于可视区高度-导航高度
	$('.b-banner .inner').height(vH);
	$('.samsung_banner').height(vH);
	$(window).resize(function(){
		var vH = $(window).height();
		$('.b-banner .inner').height(vH);
		$('.samsung_banner').height(vH);
	})
	
	
	/* web端 tab */
	$('.tab-title a').mouseover(function(){
		$(this).addClass('cur').siblings('a').removeClass('cur');
		var _index = $(this).index();
		$(this).parents('.tab-box').find('.tab-item').hide();
		$(this).parents('.tab-box').find('.tab-item').eq(_index).show();
	})


	/* 账户tab */
	$('.tab_title a').mouseover(function(){
		$(this).addClass('cur').siblings('a').removeClass('cur');
		var _index = $(this).index();
		$(this).parents('.zh_tab').find('.tab_item').hide();
		$(this).parents('.zh_tab').find('.tab_item').eq(_index).show();	
	})
	
	/* 移动端 tab */
	$('.side li').mouseover(function(){
		$(this).addClass('cur').siblings('li').removeClass('cur');
		var _index = $(this).index();
		$(this).parents('.mobile_box').find('.item').hide();
		$(this).parents('.mobile_box').find('.item').eq(_index).show();	
	})
	
	//
	var rz_webShouci = new Tabs($('#rz_webShouci'));
	var rz_webLici = new Tabs($('#rz_webLici'));
	var kj_webShouci = new Tabs($('#kj_webShouci'));
	var kj_webLici = new Tabs($('#kj_webLici'));
	var rz_mobileShouci = new Tabs($('#rz_mobileShouci'));
	var rz_mobileLici = new Tabs($('#rz_mobileLici'));
	
})


function Tabs(obj)
{
	this.aLi = obj.find('li');
	this.aSpan = obj.find('span');
	this.len = this.aSpan.length;
	this.liW = this.aLi.width();
	this.oUl = obj.find('ul');
	this.oUl.width(this.len * this.liW);
	var _this = this; 
	var i = 0;
	_this.tab(this);

}

Tabs.prototype.tab = function(oSpan){
	for(i=0; i<this.len; i++)
	{
		var $this = this;
		(function(i){
			$($this.aSpan[i]).mouseover(function(){
				$(this).addClass('cur').siblings().removeClass('cur');
				$this.oUl.animate({
					'left':	-$this.liW * i
				})
			})	
		})(i);
	}
}

//模拟select
function mySelect(obj){
	obj.click(function(event){
		var thisInput = $(this);
		var thisul = thisInput.parent().find('ul');
		obj.parent().find('ul').fadeOut(50);
		if(thisul.css('display')=='none')
		{
			if(thisul.height()>200)
			{
				thisul.css({height:"200"+"px","overflow-y":"scroll" })
			};
			thisul.fadeIn(50);
			console.log($(this))
			thisul.find('li').click(function(){
				thisul.find('li').removeClass('select');
				$(this).addClass('select');
				thisInput.val($(this).text());
				thisul.fadeOut(50)	
			})
		}
		event.stopPropagation(); 
	})
	
	$(document).click(function(){
		obj.parent().find('ul').fadeOut(50);	
	})	
}

