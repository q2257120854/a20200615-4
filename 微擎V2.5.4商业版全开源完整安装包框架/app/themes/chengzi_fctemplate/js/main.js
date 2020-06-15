$(function(){
	var timer = null;
	$('#openMenu').click(function(){
		var iH = $(window).height();
		
		//alert(iH);
		if($('#menu').css('display')=='none'){
			var msk = $('<div id="msk"></div>');
			
			$('body').append(msk);			
			$('#menu').show().animate({'right':0},500);
		}else{
			$('#menu').animate({'right':'-200px'},500);
			
			clearTimeout(timer);
			timer = setTimeout(function(){
				$('#msk').remove();
				$('#menu').hide();
			},500);
		}
	});
	
	$('#menu').swipeRight(function(){
		$('#menu').animate({'right':'-200px'},500);
			
		clearTimeout(timer);
		timer = setTimeout(function(){
			$('#msk').remove();
			$('#menu').hide();
		},500);
	});
	
});