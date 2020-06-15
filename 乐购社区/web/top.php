<?php
 require_once('admin_check.php');
require_once('admin_config.php');

  

?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<!-- 必要元素 结束 -->
<!-- 弹窗元素 开始 -->
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
<!-- 弹窗元素 结束 -->
<!-- 表单元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<!-- 表单元素 结束 -->
<!-- 表单验证元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<!-- 表单验证元素 结束 -->
<!-- 时间元素 开始 -->
<link rel="stylesheet" href="file/main/css/jQueryUI/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="file/main/js/jQueryUI/jquery-ui.js"></script>
<script type="text/javascript" src="file/main/js/util/DateUtil.js"></script>
<!-- 时间元素 结束 -->
</head>
<body class="body">
	
	<table width="100%" height="50px" style="background-color: #228AE4;margin-top:3px;color:#fff;font-size:14px;">
		<tr>
			<td style="width:240px;white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主控端</td>
			<td>&nbsp;</td>
			<td style="width:22px;text-align: center;">&nbsp;</td>
			<td style="width:300px;text-align: center;vertical-align: middle;">
			<a href='logout.php+'onclick='return confirm("确定要退出?")'  style="color:#FFFFFF">安全退出</A>
			<div class="user" style=" display:none">
					<div style="height:50px;line-height:50px;">
						<span class="avatar">
							
 							 				</span>
						<b class="price-amount">
							<a href="javascript:void(0);" target="_blank" id="easyLogin"><span id="sup_use_money">安全退出</span></a>						</b>					</div>
					<div class="user-dropdown">
						<span class="rechg">
							<i class="menu-left"><a href="easyLogin.html?serviceName=pay" target="_blank">充值</a></i>
							<i class="menu-right"><a href="javascript:void(0);" id="collect">提现</a></i>						</span>
						<span class="shanghu-zijin">
							<i class="menu"><a name="showtab" href="javascript:void(0);" url="general/generalMerchant.html">商户设置</a></i>
							<i class="menu"><a href="javascript:void(0);" id="moneyDetail">资金明细</a></i>						</span>
						<span class="shanghu-zijin">
							<i class="menu">
								<a id="top_message" name="showtab" href="javascript:void(0);" url="message/mainMessageList.html">
									系统消息
									<span name="mainMessageUnredCoun" class="count" style="display: inline;">0</span>								</a>							</i>
							<i class="menu"><a id="showsupmessage" href="javascript:void(0);" >SUP账户信息</a></i>						</span>
						<span class="shanghu-zijin">
							<i class="menu"><a id="closePlat" href="javascript:void(0);">安全退出</a></i>						</span>					</div>
				</div>			</td>
		</tr>
	</table>
<script type="text/javascript">
					$(function() {
						//提现
						$("a[id='collect']").click(function(){
							var dialog = $.dialog({
								id:"collectId",
								lock:true,
								background: '#000', // 背景色
								opacity: 0.2,
								title:"SUP提现",
								width: 600,
								height:400
							});
							$.ajax({
								url:"sup/supCollect.html",
								type:"post",
								dataType:"html",
								success:function(data){
									dialog.content(data);
								}
							 });
						});
						//资金明细
						$("a[id='moneyDetail']").click(function(){
							var dialog = $.dialog({
								id:"moneyDetail",
								lock:true,
								background: '#000', // 背景色
								opacity: 0.2,
								title:"SUP资金明细",
								width: 1100,
								height:700
							});
							$.ajax({
								url:"sup/supMoneyDetail.html",
								type:"post",
								dataType:"html",
								success:function(data){
									dialog.content(data);
								}
							 });
						});
						$(".user").hover(function() {
							$(this).find("b").addClass("pabg");
							$(this).find(".user-dropdown").show().parent().addClass("userbg");
						},function() {
							$(this).find("b").removeClass("pabg");
							$(this).find(".user-dropdown").hide().parent().removeClass("userbg")
							
						});
					});
				</script>
	<div class="top">
	  <div>
			<ul id="rightTab" class="title-list">
				<li id="rightLiTab" class="active" style="margin-left: 14px;">
					<a href="javascript:void(0);" id="rightTopTab0" onclick="openUrl('set.php,0')" target="main" name="rightTopTab">首页</a>
				</li>
			</ul>
	  </div>
		
</div>
	
	
		<iframe scrolling="auto" id="rightFrame" name="rightFrame" src="right.php" onload="changeFrameHeight();" frameborder="0" style="margin: 0;visibility: inherit; width: 100%; z-index: 1;"></iframe>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$("#closePlat").click(function(){
			if(confirm("确定要退出吗？")){
				top.location="closePlat.html";
			}
		});
		
		$("#showsupmessage").click(function(){
			
			$("iframe[id='rightFrame']", window.parent.topFrame.document).attr("src","general/showsupmessage.html");
			
		});
		
		
		$("a[name='showtab']").click(function(){
			$("span[name='linetag']").removeClass("menu_crrent");
			$(this).parent().parent().addClass("menu_crrent");
			
			var tourl=$(this).attr("url");
			var tabName=$(this).text();
			var leftTabId=$(this).attr("id");
			var rightTab = $("ul[id='rightTab']", window.parent.topFrame.document);
			var rightLiTab = $("li[id='rightLiTab']", window.parent.topFrame.document);
			
			if ("top_message"==leftTabId) {
				tabName = "系统消息"
			}
			
			var mess=rightTab.find("a[id='rightTopTab"+leftTabId+"']");
			if(mess.text()==tabName){
				rightTab.find("a").parent().attr("class","element");
				mess.parent().attr("class","active");
			
				$("iframe[id='rightFrame']", window.parent.topFrame.document).attr("src",tourl);
			}else{
				rightTab.find("a").parent().attr("class","element");
				rightLiTab.after("<li class='active'><a name='rightTopTab' id='rightTopTab"+leftTabId+"' urls='"+tourl+"' onclick='openUrl(\""+tourl+","+leftTabId+"\")'  href='javascript:void(0);' target='main'>"+tabName+"</a><a id='closeimage"+leftTabId+"' href='javascript:void(0);' onclick='closeTab2(\""+leftTabId+"\")'><em></em></a></li>");
				
				$("iframe[id='rightFrame']", window.parent.topFrame.document).attr("src",tourl);
			}
		});
	});
	
	$.ajax({
	 	url:"getAjaxAdminTop.html",
	 	type:"post",
	 	success:function(data){
	 		$("#handordercount").html(data.handOrder);
	 		$("#messagecount").html(data.message);
			$("#noticescount").html(data.notices);
	 	}
	 });
	
	$.ajax({
	 	url:"getCategoryGoodTop.html",
	 	type:"post",
	 	success:function(data){
	 		$("#crecharge_count").html(data.ordercount);
	 		$("#crecharge_duo").html(data.goodcount);
	 	}
	 });
	
	//对接平台。对接sup充值中订单的数量
	$.ajax({
		url:"getRechargeCount.html",
		type:"post",
		success:function(data){
			$("#recharge_count").html(data.rechargeCount);
			$("#sup_recharge_count").html(data.sup_recharge_count);
		}
	});
	//获取sup可用余额
	$.ajax({
		url:"getSupUseMoney.html",
		type:"post",
		success:function(data){
			var m = data.sup_use_money;
			if(m != undefined){
				$("#sup_use_money").html("￥"+data.sup_use_money);
			}else{
				$("#sup_use_money").html("￥  ***");
			}
		}
	});
	//获取sup异常数量
	$.ajax({
		url:"getSupExceptionCount.html",
		type:"post",
		success:function(data){
			$("#sup_exception_count").html(data.sup_exception_count);
		}
	});
	//sup短信
	$.ajax({
		url:"getAjaxAdminTop_message.html",
		type:"post",
		success:function(data){
			$("#sup_message_count").html(data.sup_message_count);
		}
	});
	$("a[id='easyLogin']").click(function(){
		$(this).attr("href","easyLogin.html?serviceName=pay");
	});
	
	$.ajax({
		url:"duanhuo.html",
		type:"post",
		success:function(data){
			$("#duanhuo").html(data.duanhuocount);
		}
	});
	
	function openUrl(sss){
 		var me=sss.split(",");
 		$("a[name='rightTopTab']").parent().attr("class","element");
 		$("#rightTopTab"+me[1]).parent().attr("class","active");
 		$("#rightFrame").attr("src",me[0]); 
 	}
 	
 	function closeTab2(num){
 		$("#rightTopTab"+num).parent().remove();
 		$("#closeimage"+num).remove();
 	}
 	
 	function changeFrameHeight(){
 	    var ifm= document.getElementById("rightFrame"); 
 	    ifm.height=document.documentElement.clientHeight-153;
 	   	
 	}
 	
 	$.ajax({
		url:"message/getUnredMainMessageCount.html",
		type:"post",
		success:function(data){
			$("span[name='mainMessageUnredCoun']").html(data.count);
		 }
	});
	</script>
</body>
</html>

