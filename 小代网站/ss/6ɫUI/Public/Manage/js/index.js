// JavaScript Document
$(document).ready(function(){
    $(".yiji .action").click(function(){
		$(this).parents(".yiji").siblings().find(".erji").slideUp();
		$(this).parents(".yiji").find(".erji").slideToggle();
	});
	
	$(".erji li").click(function(){
		$(".erji li").removeClass("thisnav");
		$(this).addClass("thisnav");
		var url=$(this).attr("data-url");
		var title=$(this).attr("data-title");
		document.title=title + ' - CvPHP管理系统';
		$("#iframe").attr("src",url);
	});
	
    $(".yiji a").click(function(){
		var title=$($(this).parent()).attr("data-title");
		document.title=title + ' - CvPHP管理系统';
    	$(".erji li").removeClass("thisnav");
    	var url=$(this).attr("data-url");
		$("#iframe").attr("src",url);
	});
});

function changeFrameHeight(){
    var ifm= document.getElementById("iframe");
    var height = document.documentElement.clientHeight - 67;
    $(ifm).attr('style',"height: "+height+"px;");
}
window.onresize=function(){
    changeFrameHeight();  
}