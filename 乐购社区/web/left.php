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
                                
                               
 								</span>
								<?php if($qx==1){
									?>
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
								<? } ?>
								
								 
 							 
 								 
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


