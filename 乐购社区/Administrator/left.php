<?php
 require_once('admin_check.php');
require_once('admin_config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统管理</title>
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<!-- 必要元素 结束 -->
</head>
<body>
	<div class="left-side">
		<div class="mem-logo">
			<img src="file/main/2017/images/logo.png" hight="55" />
		</div>
		<div id="menuBox" class="left-operate" style="overflow-y:scroll;width: 228px;">
			<ul id="fold-menu">
				
				
					<li  class="selected"   >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/1.png);"></i><em>网站管理</em>
						</h4>
						<div class="list-item">
							
								 
							
							 
								
								<span name="linetag" class="span" style="display:none">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            				<span id="13a" url="admin/addMain.html" name="showtab" target="main">管理员添加</span>&nbsp;||
           				<span id="13b" url="admin/adminMenu.html" name="showtab" target="main">管理</span>					            		</a>								</span>
						
						
							<span name="linetag" class="span">
										<a href="javascript:void(0);">
					            				<span id="33" url="set.php" name="showtab" target="main">系统配置</span> 
					            		</a>
								</span>
 
                                                          
                                <span name="linetag" class="span">
  										<a href="javascript:void(0);">
  					            				<span id="zhuzhan" url="zhuzhan.php" name="showtab" target="main">主站版本</span> 
 					            		</a>
									
								</span>

                                <span name="linetag" class="span">
  										<a href="javascript:void(0);">
  					            				<span id="fenzhan" url="fenzhan.php" name="showtab" target="main">分站版本</span> 
 					            		</a>
									
								</span>
								
                                
								     <span name="linetag" class="span">
  										<a href="javascript:void(0);">
  					            				<span id="moban" url="moban.php" name="showtab" target="main">下单模板</span> 
 					            		</a>
									
								</span>
                                
                                     <span name="linetag" class="span">
  										<a href="javascript:void(0);">
  					            				<span id="fengge" url="template.php" name="showtab" target="main">模板风格</span> 
 					            		</a>
									
								</span>
								
                                    <span name="linetag" class="span">
  										<a href="javascript:void(0);">
  					            				<span id="tj" url="tjlist.php" name="showtab" target="main">推荐列表</span> 
 					            		</a>
									
								</span>
								
                               
 
								
								
								</div>
					</li>
				
				
                <li >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/72.png);"></i><em>域名管理</em>
						</h4>
						<div class="list-item" style="display: none;">
 						 
                         <span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="domain_add" url="domain_add.php" name="showtab" target="main">新增域名</span>
 					            		</a>
 								</span>

 
                                
                                	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="domain" url="domain.php" name="showtab" target="main">管理域名</span>
 					            		</a>
 								</span>

 
								
								 
 						 
 								 
						</div>
					</li>
					
					 <li >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/72.png);"></i><em>分销管理</em>
						</h4>
						<div class="list-item" style="display: none;">
 						 
                         <span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="guanli_add" url="guanli_add.php" name="showtab" target="main">新增分销</span>
 					            		</a>
 								</span>

 
                                
                                	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="guanli" url="guanli.php" name="showtab" target="main">分销列表</span>
 					            		</a>
 								</span>

 
								
								 
 						 
 								 
						</div>
					</li>
				
					<li >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/72.png);"></i><em>主站管理</em>
						</h4>
						<div class="list-item" style="display: none;">
 						 
                                
 								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="61" url="web_add.php" name="showtab" target="main">主站搭建</span>
 					            		</a>
 								</span>
							
								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="62" url="web.php" name="showtab" target="main">主站列表</span>
 					            		</a>
 								</span>
                                
                               
	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="edu" url="edu.php" name="showtab" target="main">额度明细</span>
 					            		</a>
 								</span>
                                

								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="point" url="point.php" name="showtab" target="main">资金明细</span>
 					            		</a>
 								</span>

								
								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="tx" url="tx.php" name="showtab" target="main">提现管理</span>
 					            		</a>
 								</span>
								
								
								 
 							 
 								 
						</div>
					</li>
                    	 
				
                
                
					<li >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/72.png);"></i><em>数据查看</em>
						</h4>
						<div class="list-item" style="display: none;">
 						 
                                
 								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="order" url="order.php" name="showtab" target="main">订单列表</span>
 					            		</a>
 								</span>
							
							    
 							 
							 
                            	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="czjl" url="czjl.php" name="showtab" target="main">支付列表</span>
 					            		</a>
 								</span>
							
                          
								
								 
 							 
 								 
						</div>
					</li>
				
				<li >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/72.png);"></i><em>资源推荐</em>
						</h4>
						<div class="list-item" style="display: none;">
 						 
                                
 								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="doking" url="doking.php" name="showtab" target="main">推荐列表</span>
 					            		</a>
 								</span>
							
							    
 							 
							 
                            	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="doking_add" url="doking_add.php" name="showtab" target="main">添加推荐</span>
 					            		</a>
 								</span>
							
                          
								
								 
 							 
 								 
						</div>
					</li>
				
					<li  style="display:none">
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/9.png);"></i><em>网站运营</em>
						</h4>
						<div class="list-item" style="display: none;">
			 
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="25" url="log/logManage.html" name="showtab" target="main">系统日志查询</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="26" url="admin/online.html" name="showtab" target="main">普通管理员在线管理</span>
					            			
					            		</a>
									
								</span>
							
						</div>
					</li>
				
					<li  style="display:none">
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/14.png);"></i><em>商品管理</em>
						</h4>
						<div class="list-item" style="display: none;">
								<span name="linetag" class="span">
										<a href="javascript:void(0);">
					            				<span id="31" url="shop_channel.php" name="showtab" target="main">商品分类</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
   					            				<span id="32" url="shop.php" name="showtab" target="main">商品列表</span>
 					            		</a>
 								</span>
  							 
						</div>
					</li>
					
					
					<li  style="display:none">
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/76.png);"></i><em>卡密管理</em>
						</h4>
						<div class="list-item" style="display: none;">
							
								 	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
   					            				<span id="914" url="card.php" name="showtab" target="main">卡密列表</span>
 					            		</a>
 								</span>

								 	<span name="linetag" class="span">
  										<a href="javascript:void(0);">
   					            				<span id="1000" url="card.php?zt=0" name="showtab" target="main">库存卡密</span>
 					            		</a>
 								</span>
	
							
						 
						</div>
					</li>
				
				
				
				
					<li style="display:none" >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/35.png);"></i><em>采购货源</em>
						</h4>
						<div class="list-item" style="display: none;">
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="41" url="platform/platFormManage.html" name="showtab" target="main">平台对接</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="42" url="sup/supMain.html?tabIndex=2" name="showtab" target="main">SUP对接</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="43" url="platform/categoryMain.html" name="showtab" target="main">全网通对接</span>
					            			
					            		</a>
									
								</span>
							
						</div>
					</li>
				
					<li style="display:none" >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/28.png);"></i><em>客户管理</em>
						</h4>
						<div class="list-item" style="display: none;">
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="51" url="customer/customerLevel.html" name="showtab" target="main">客户级别体系添加/管理</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="52" url="customer/customer.html" name="showtab" target="main">客户列表档案管理</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="53" url="customer/categoryUser.html" name="showtab" target="main">对接商户管理</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="54" url="customer/customerAccount.html" name="showtab" target="main">客户账务金额明细及统计</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="55" url="customer/fluctionSetUp.html" name="showtab" target="main">客户上下级关系定义</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="56" url="customer/levelMoneySet.html" name="showtab" target="main">客户自助升级费用设置</span>
					            			
					            		</a>
									
								</span>
							
						</div>
					</li>
				
				 
					<li  style="display:none">
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/40.png);"></i><em>订单管理</em>
						</h4>
						<div class="list-item" style="display: none;">
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="71" url="order.php" name="showtab" target="main">订单管理</span>
					            			
					            		</a>
									
								</span>
							
						</div>
					</li>
				 
				
					 
				
					<li  style="display:none">
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/47.png);"></i><em>结算管理</em>
						</h4>
						<div class="list-item" style="display: none;">
							 
								
							 
							
								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
 					            				<span id="92" url="sqlist.php" name="showtab" target="main">结算记录</span>
					            			
					            		</a>
									
								</span>
							
							 
 							 
							
						</div>
					</li>
				
					<li style="display:none" >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/117.png);"></i><em>微信接口管理</em>
						</h4>
						<div class="list-item" style="display: none;">
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="141" url="weixin/configEdit.html" name="showtab" target="main">微信接口配置</span>
					            			
					            		</a>
									
								</span>
							
								<span name="linetag" class="span">
									
									
										<a href="javascript:void(0);">
					            			
					            			
					            			
					            				<span id="142" url="weixin/bindList.html" name="showtab" target="main">微信客户管理</span>
					            			
					            		</a>
									
								</span>
							
						</div>
					</li>
					
					
					<li >
						<h4 name="left_menu">
							<i style="background:url(file/main/2017/images/menu/42.png);"></i><em>账户管理</em>
						</h4>
						<div class="list-item" style="display: none;">
							
								<span name="linetag" class="span">
  										<a href="javascript:void(0);">
  					            				<span id="81" url="admin.php" name="showtab" target="main">密码修改</span>
 					            		</a>
									
								</span>
							
 
						 
							
						</div>
					</li>
				
			</ul>
		</div>
	</div>
	<script type="text/javascript">
	$(window).resize(function(){
		$("#menuBox").height($(window).height()-92);
	});
	
	$(document).ready(function(){
		$("#menuBox").height($(window).height()-92);
		
		//菜单隐藏展开
		$("h4[name='left_menu']").click(function(){
			var cl=$(this).parent().attr("class");
			if (cl!="selected") {
				$(this).parent().attr("class","selected");
				$(this).next().show();
			}else{
				$(this).parent().attr("class","");
				$(this).next().hide();
			}
		});
		
		$("span[name='showtab']").click(function(){
			$("span[name='linetag']").removeClass("menu_crrent");
			$(this).parent().parent().addClass("menu_crrent");
			
			var tourl=$(this).attr("url");
			var tabName=$(this).text();
			var leftTabId=$(this).attr("id");
			var rightTab = $("ul[id='rightTab']", window.parent.topFrame.document);
			var rightLiTab = $("li[id='rightLiTab']", window.parent.topFrame.document);
			
			if(leftTabId == "16b"){//管理员管理
				tabName = "管理员管理";
			}
			if(leftTabId == "23b"){//平台短信管理
				tabName = "模板管理";
			}
			if(leftTabId == "24b"){//首页公告管理
				tabName = "公告管理";
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
	</script>
 </body>
</html>


