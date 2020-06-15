/*		
*@description	js工具类	
*@depend		zepto
*@author		lostyu
*@email			272620890@qq.com
*@date			2013-08-20
*@version		1.0
*/

(function($){
	//=============================================tool
	//获取浏览器可见窗口大小
	function getInner()
	{
		if(typeof window.innerWidth == 'undefiend'){
			return{
				X: document.documentElement.clientWidth,
				Y: document.documentElement.clientHeight
			}
		}else{
			return{
				X: window.innerWidth,
				Y: window.innerHeight
			}
		}
	}
	
	//遮罩层
	function createMask()
	{
		if($('#mask').length==0){
			var mask = document.createElement('div');			
			mask.id = 'mask';	
			mask.style.cssText = 'display:block; position: fixed;z-index: 2000;left: 0;top: 0;width: 100%;height: 100%;background: black; opacity:0.5;';
			
			document.body.appendChild(mask);	
		}else{
			$('#mask').css('display','block');
		}		
	}
	
	//关闭遮罩层
	function closeMask()
	{
		$('#mask').css('display','none');
		//document.body.removeChild(document.getElementById('mask'));
	}
	//=============================================tool
	
	$.extend($.fn, {
		
		//===导航工具===
		/*
		@---html---
			<div class="m-toolNav">
				<a class="menu" href="javascript:;"><span></span></a>
				<div class="m-toolNav-div">
					<ul>
						<li class="item1"><a href="tel:68920145"></a></li>
						<li class="item2"><a href="#"></a></li>
						<li class="item3"><a href="#"></a></li>
						<li class="item4"><a href="#"></a></li>
					</ul>
				</div>
			</div>
		@---use---
			$('.m-toolNav').toolNav({
				bgColor: 'black'
			});
		*/
		toolNav: function(options){
			var defaults = {
				bgColor: '#FF4733'
			};		
			var opts = $.extend(defaults, options);				
			var _this = $(this);
			
			$('.menu, li', _this).css('background-color', opts.bgColor);
			$('.menu span', _this).click(function(ev){
				var $this = $(this);
				
				if($(this).hasClass('on')){
										
					$this.parent().siblings().find('li').removeClass('on');
					$this.removeClass('on');
					setTimeout(function(){
						$this.parent().siblings().hide();	
					},200);									
				}else{			
					$(this).parent().siblings().show(100,function(){	
												
						$this.parent().siblings().find('li').addClass('on');
						$this.addClass('on');
					})					
				}	
				ev.preventDefault();
			});	
			
			$('.menu span', _this).click(function(){});
			
			$('.menu span', _this).on('touchmove',function(event){event.preventDefault();});
		},
		
		toolNav2: function(){							
			var _this = $(this);
			
			$('.menuBtn', _this).click(function(){
				if($(this).hasClass('on')){
					closeMask();
					$(this).removeClass('on');
					$(this).siblings().find('li').removeClass('on');
				}else{
					createMask();
					$(this).addClass('on');		
					$(this).siblings().find('li').addClass('on');
				}	
			});
		},
		//===导航工具===
		
		//===分享===
		share: function(){
			var _html = '<div id="gzTips"><img src="http://www.weiwut.com/template/plus/global/images/share.png" />';
			
			var _css = '<style>#gzTips{display:none; top:0; right:0; position:absolute; z-index:9999; width:293px;}#gzTips .img{ text-align:right; margin:8px 8px 0 0;}#gzTips .text{ margin:8px; margin-top:0; padding:8px; background-color:transparent; border-radius:10px; color:#fff; font-size:20px; line-height:1.6;}#gzTips .text a{ color:#f8ebb3; text-decoration:none;}#mask{display:none;}</style>';						
			
			if($('#gzTips').length==0){
				$('body').append(_css);
				$('body').append(_html);			
				createMask();
				
				$('#gzTips').show();
				$('#mask').css('display','block');
			}else{
				$('#gzTips').show();
				$('#mask').css('display','block');
			}			
			
			$('#gzTips').live('click', function(){
				$(this).hide();	
				$('#mask').css('display','none');			
			});
			$('#mask').live('click', function(){
				$(this).hide();	
				$('#gzTips').css('display','none');			
			});
		},
		//===分享===	
		
		mTabs:function(){
			var _this = $(this);
			var aTabsNav = $('ul.m-tabsNav li', _this);
			var aTabsDiv = $('div.m-tabsDiv', _this);
			
			aTabsNav.tap(function(){
				$(this).addClass('active').siblings().removeClass('active');				
				aTabsDiv.eq($(this).index()).show().siblings().hide();
			});
		},
		
		mBanner:function(id, bTxt){
			var elem = document.getElementById(id);
			
			if(bTxt){							
				window.mySwipe = Swipe(elem, {
				   auto: 3000,
				   callback: function(index, element) {
					   $('.swipe-text p').html($(element).find('img').attr('title'));		   
					   $('#slider_on li').removeClass('on')
					   $('#slider_on li').eq(index).addClass('on');  
				   }
				});
			}else{
				window.mySwipe = Swipe(elem, {
				   auto: 3000,
				   callback: function(index, element) {
					   $('#slider_on li').removeClass('on')
					   $('#slider_on li').eq(index).addClass('on');  
				   }
				});
			}			
		},
		
		//工具函数
		createMask: function(){createMask()},
		closeMask: function(){closeMask()}
		
	});		
	
})(Zepto);









