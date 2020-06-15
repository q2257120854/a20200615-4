$(function(){
	/*if($('.qm .sm_form').length){
		$(window).JqSelect();
	}*/

    var $xjFenxi = $('.xjFenxi');
    var height = 0;
    $xjFenxi.each(function () {
        if ($(this).height() > height) {
            height = $(this).height();
        }
    });
    $xjFenxi.height(height);


	//2
	$('#showme,#unlock').each(function(){
		$(this).click(function(){
			$('#mask').show();
			$('#maskpay').show();
		});
	});

	$('#mask').on('click',function(event){
		$('#mask').hide();
		$('#maskpay').hide();
	});
	//3	
	var he = parseInt($('.maskpay').outerHeight())/2;
	$('.maskpay').css('margin-top', -he);

	$('.qmLinksBtn').each(function(){
		$(this).click(function(){
			var clickNum = parseInt($(this).attr('data-click'));
			if(clickNum==0){
				$('#maskpay, #mask').show();
			}else{
				clickNum--;
				if(clickNum==0){
					$(this).find('.qmL_num').html('优惠价<i>¥8.8</i>');
					$(this).addClass('qmLinksEnd');
				}else{
					$(this).find('.qmL_num i').html(clickNum);
				}
				$(this).attr('data-click', clickNum);
			}
		});
	});
	$('#mask').click(function(){
		$('#maskpay, #mask').hide();
	});
});