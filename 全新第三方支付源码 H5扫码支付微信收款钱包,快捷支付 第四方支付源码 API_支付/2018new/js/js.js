// JavaScript Document
$(document).ready(function(e) {
	
	
	
  //  $("#menu div img").mouseover(function(e) {
//        var src = $(this).attr("src");
//		$(this).attr("src",$(this).attr("m"));
//		$(this).attr("m",src);
//    });
//	
//	$("#menu div img").mouseout(function(e) {
//        var src = $(this).attr("src");
//		$(this).attr("src",$(this).attr("m"));
//		$(this).attr("m",src);
//    });
	
	
	$("#qydl").click(function(e) {
		$(this).css("background-image","url(/Public/images/login_tab_item_selected.png)").removeClass("login_title_left").css({"color":"#000","font-weight":"bold"});
        $("#grdl").css("background-image","url(/Public/images/login_tab_item.png)").addClass("login_title_right").css({"color":"#999","font-weight":"normal"});
		//$("#login_Content_qyyh").show();
		//$("#login_Content_gryh").hide();
		$("#logintj").attr("src","/Public/images/qydl.png");
		$("#UserType").val(2);  //商户登录
    });
	
	
	$("#grdl").click(function(e) {
		$("#qydl").css("background-image","url(/Public/images/login_tab_item.png)").addClass("login_title_left").css({"color":"#999","font-weight":"normal"});
        $(this).css("background-image","url(/Public/images/login_tab_item_selected.png)").removeClass("login_title_right").css({"color":"#000","font-weight":"bold"});
		//$("#login_Content_qyyh").hide();
		//$("#login_Content_gryh").show();
		$("#logintj").attr("src","/Public/images/grdl.png");
		$("#UserType").val(0);  //商户的工员登录
    });
	
	/////////////////////////////////////////////////新加///////////////////////////////////////////////////////////////
	
	
	$("#menu_div div").mouseover(function(e) {
		if($(this).attr("name") != "a"){
		$("#menu_div div[name!='a']").css("background-image","");
		$("#menu_div div[name!='a'] a").css("color","");
        $(this).css("background-image","url(/Public/images/sbgb.jpg)");
		$(this).children("a").css("color","#11638b");
		}
		$(this).children(".menu_div_show").show();
    });
	$("#menu_div div").mouseout(function(e) {
		if($(this).attr("name") != "a"){
          $(this).css("background-image","");
		  $(this).children("a").css("color","");
		  $(this).children(".menu_div_show").hide();
		}
		$(this).children(".menu_div_show").hide();
    });
	///////////////////////////////////////////////新加///////////////////////////////////////////////////////////////////
	
	/*$(".menumenu_div").mouseover(function(e) {
		if($(this).index() == 1 || $(this).index()==2){
			$("#toptopmenudiv").show();
		    $(this).children(".menu_div_show").show();
		}
		
    }).mouseout(function(e) {
        $("#toptopmenudiv").hide();
		$(this).children(".menu_div_show").hide();
    });*/
	
});


function check(){
	
	$.ajax({
			type:'POST',
			url:"/Index_Login.html",
			data:"UserName="+ $("#UserName").val()+"&LoginPassWord="+$("#LoginPassWord").val()+"&verify="+$("#verify").val()+"&UserType="+$("#UserType").val()+"&mbk="+$("#mbk").val(),
			dataType:'text',
			success:function(str){
				str = $.trim(str);
				if(str != "ok"){
					if(str == "mbk"){
						// var sheight = "120px";
//                         var swidth = "500px";
//   
//var k = window.showModalDialog("/Index_mbkshow.html?aaa="+ Math.random(),window,'dialogWidth:'+swidth+'px;dialogHeight:'+sheight+'px;edge:raised;resizable:no;scroll:no;status:no;center:yes;help:no;minimize:no;maximize:no;fullscreen:no;');
//
//$("#mbk").val(k);
//    
//	document.Form1.onsubmit();

                    $("#mbkcontent").load("/Index_mbkshow.html?aaa="+ Math.random()).show();

					}else{

					    alert(str);
						
						Form1.mbk.value = "";
					}
				}else{
					location.href = "/User";
					
					}
				///////////////////////////////////
				},
			error:function(str){
				//////////////////////////
				}	
			});
	
	return false;		
}