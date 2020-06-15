
$(document).ready(function() {
	

	/*根据分辨率调整菜单*/
	if ($(window).width() < 769) {
		$('body').addClass('body-small')
	} else {
		$('body').removeClass('body-small')
	}

	if ($(window).width() < 1200 && !$('body').hasClass('body-small')) {
		$('body').addClass('mini-navbar')
	} else {
		$('body').removeClass('mini-navbar')
	}

	/*左侧菜单*/
	$('.navbar-minimalize').click(function () {
		var body = $('body');
		body.toggleClass("mini-navbar");
		SmoothlyMenu();
	});

	$('.nav-second-level').each(function(){
		$(this).find('li.active').parent().addClass('in');
		$(this).find('li.active').parent().parent().addClass('active');
	});

	/*全选*/
	$(document).on('click', '#check-all', function() {
		var op = $(this).is(':checked');
		if(op==true){
			$('[type=checkbox]').prop('checked', true);
		} else {
			$('[type=checkbox]').prop('checked', false);
		}
	});

	/*table项目点击*/
	$(document).on('click', '.table tbody tr', function() {
		$('.table tbody tr').removeAttr('id');
		$(this).attr('id','clicked');
	});
});

$(window).bind("resize", function () {
	if ($(this).width() < 769) {
		$('body').addClass('body-small')
	} else {
		$('body').removeClass('body-small')
	}

	if ($(window).width() < 1200 && !$('body').hasClass('body-small')) {
		$('body').addClass('mini-navbar')
	} else {
		$('body').removeClass('mini-navbar')
	}
});

/*单页显示条目*/
var page_size = function(){
	var u = window.location.href,
	sz = $('#sz').val(),
	url = '';

	if(u.indexOf('sz=') > 0 ) {
		url = u.replace(/sz=\d+/g, 'sz='+sz);
	} else {
		if(u.indexOf('=') > 0 ) {
			url = u + '&sz=' + sz;
		} else {
			url = u + '?sz=' + sz;
		}
	}
	//console.log(url);
	window.location.href = url;
}

/*删除和批量删除*/
var del_all=function(id,url){
	var ids = [];
	if(id>0){
		ids[0] = id;
	}else{
		var arr = $('input[name="id[]"]:checked');
		for (var i=0;i<arr.length;i++){
			ids[i] = arr[i].value;
		}
	}

	if(ids.length==0){
		bootbox.alert('请选择需要删除的条目');
		return false;
	}

	bootbox.confirm(
		'是否要删除选中的条目？',
		function(result){
			if (result) {
				window.location.href = url+ '?ids='+ ids;
				// $("#myModal").modal({
				// 	remote : url+ '?ids='+ ids
				// });
			}
		}
	);
};

function SmoothlyMenu() {
	if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
		$('#side-menu').hide();
		setTimeout(
			function () {
				$('#side-menu').fadeIn(400);
			}, 200);
	} else if ($('body').hasClass('fixed-sidebar')) {
		$('#side-menu').hide();
		setTimeout(
			function () {
				$('#side-menu').fadeIn(400);
			}, 100);
	} else {
		$('#side-menu').removeAttr('style');
	}
}
