// JavaScript Document
$(document).ready(function(){
    //帮助页面单击问题显示答案
	$("#wenti li").click(function(){
		$("#wenti p").hide();
		$("#wenti li span").removeClass("thisspan")
		$(this).find("p").show();
		$(this).find("span").addClass("thisspan");
	});

	//登录注册切换
	$(".tab li").click(function(){
		$(this).removeClass("action")
		var index=$(this).index();
		$(this).siblings().addClass("action");
		$(".con div:eq("+index+")").show();
		$(".con div:eq("+index+")").siblings().hide();
		
	});
});