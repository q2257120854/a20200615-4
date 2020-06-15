<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 
  if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'yzf where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
 	 
	 
  
		alert_href('删除成功!','tjlist.php');
	}else{
		alert_back('删除失败！');
	}
}
 

 ?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<title></title> 
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css?" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<!-- 必要元素 结束 -->

 
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

<!-- 弹窗元素 开始 -->
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
<!-- 弹窗元素 结束 -->
<script type="text/javascript">
$(document).ready(function(){
	
	$.datepicker.setDefaults({
						dateFormat : "yy-mm-dd", // 日期格式
						buttonImageOnly : true,
						selectOtherMonths : true,
						defaultDate : +7,// 默认时间
						dayNamesMin : [ "日", "一", "二", "三", "四", "五", "六" ],
						monthNames : [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月",
								"9月", "10月", "11月", "12月" ],
						beforeShow : function(picker) { // 开始日期小于结束日期
						}
				});
			
	$("#startTime,#endTime").datepicker();
	$("#startTime").val($.formatDate(new Date(), 2, 0));
	$("#endTime").val($.formatDate(new Date(), 2, 1));
});
</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#searchOrderForm").ajaxForm({
			url:"dSaleOrderList.html",
			type:"post",
			dataType:"html",
			success:function(data){
				$("#box").html(data);
			}
		});
		$("#searchOrderForm").submit();
	});
	</script>
	
 <script>
function subForm()
 {
form1.action="";
 form1.submit();
 //form1为form的id
 }
  function subForm1()
 {
form2.action="";
 form2.submit();
 //form1为form的id
 }
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
 </script>

</head> 
<body> 
<div id="body">
	<div class="dingdan-right list-right">
		<div class="chaxun">
 				<table width="100%">
				<tbody><tr>
					<td height="42" style="width:100px;"><input name="按钮" type="button" onclick="MM_goToURL('self','tj_add.php');return document.MM_returnValue"  class="list-chaxun" id="ownerSearch" value="新增推荐" /></td>
				</tr>
				
				 
				</tbody></table>
		 
		 
			
		</div>
		<div id="showData">










	<script type="text/javascript">
  $(document).ready(function(){
  	$("#isshowdir").click(function(){
  		var param = $.getAllId("box");
  		if(param.length>0){
  			if($("#isshowdir").is(":checked")){
  				$("span[name='diers']").show();
  				$.ajax({
  					url:"loadGoodsDirectorys.html?param="+param,
  					type:"post",
  					success:function(data){
  						for(var i=0;i<data.dirlist.length;i++){
  							var goodid=data.dirlist[i].id;
  							var title=data.dirlist[i].title;
  							for(var j=0;j<param.split(",").length;j++){
  								if(goodid==param.split(",")[j]){
  									$("#dirshow"+goodid).append("<span>"+title+"</span><br/>");
  								}
  							}
  						}
  					}
  				});
  			}else{
  				$("span[name='diers']").children().remove();
  			}
  		}
  	});
  });
  </script>


<div class="cxneirong">
	<table width="100%" align="center">
		<thead>
			<tr>
			  <th width="16%">排序</th>
				<th width="16%">名称</th>
				<th width="18%">域名</th>
				<th width="14%">操作</th>
			</tr>
		</thead>
		
		 <tbody>
		 	 
			 	<?php
						
							 if ($_GET['key']!='') 
							 {$sql = 'select * from '.flag.'yzf where name like "%'.$_GET['key'].'%"     order by ID asc , ID desc';}
  							 else
							 {$sql = 'select * from '.flag.'yzf order by ID asc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
 						 
 							?>
			 	<tr class="frameset_tr">
			 	  <td> <?=$row['px']?></td>
				 	<td><?=$name?> </td>
				 	<td><?=$row['url']?>&nbsp;</td>
				 	<!-- 目录显示 -->
				 	<td>
				 
					<a name="" id="<?=$row['ID']?>" href="tj_edit.php?id=<?=$row['ID']?>"  class="status1">编辑</a>
					<a  name="img_delete_" id="1" href="?act=del&amp;id=<?=$row['ID']?>"   class="status2">删除</a>			 		 		 	  </td>
		    </tr>
				 <? }?>
			 </tbody>
			 <tfoot>
			 <tr>
				<td colspan="27">
					<div class="bottom_right">
				   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>				   	</div>				</td>
			</tr>
			</tfoot>
	</table>
 <script type="text/javascript">
$(document).ready(function(){
	
	$("a[name='goodsLog']").click(function(){
		var goodId=$(this).attr("id");
		var dialog = $.dialog({
			id:"importCard",
			lock:true,
			background:'#fff',
			title:"商品操作日志",
			width: 1100,
			height:700
		});
		$.ajax({
			url:"../log/goodsLog.html?goodId="+goodId,
			type:"post",
			dataType:"html",
			success:function(data){
				dialog.content(data);
			}
		 });
	});
	
	//设置推荐商品
	$("a[name='tuijian']").click(function(){
		if($.isChecked("box")){
			if(!window.confirm("确定要执行该操作吗？")){
				return false;
			}
			var param = $.getDelIds("box");
   			 $.ajax({
   				url:"doReCommendGoods.html?goodsId="+param,
   				type:"post",
   				success:function(data){
   					var code = data.code;
   					var result = data.result;
   					if(code == "1000"){
   						alert("操作成功");
   					}else{
   						alert(result);
   					}
   				}
   			});
		}
	});
	//目录颜色
	$("a[name='setColor']").click(function(){
		if($.isChecked("box")){
			 var param = $.getDelIds("box");
			 var dialog = $.dialog({
					id:"goodsColorId",
					lock:true,
					background: '#fff', // 背景色
					fixed: true,
					title : "批量修改商品颜色",
					width: 400,
					height:130
			});
			 $.ajax({
				url:"batchSetGoodsColor.html",
				dataType:"html",
				data:{"goodIds":param,"type":"2"},
				type:"post",
				success:function(data){
					dialog.content(data);
				}
			});
		}
	});
	$("#paixu").click(function(){
		var goodOrder=$("#goodOrder").val();
		if(goodOrder==1){
			$("input[name='goodOrder']").val(2);
		}else{
			$("input[name='goodOrder']").val(1);
		}
		
		$("#queryGoodsForm").ajaxForm({
				url:"ownHaveManagmentDataForm.html",
				dataType:"html",
				type:"post",
				success:function(data){
					$("#showData").html(data);
				}
			});
		$("#queryGoodsForm").submit();
	});
	
		$("a[name='setDir']").click(function(){
			if($.isChecked("box")){
			 var param = $.getDelIds("box");
			 var dialog = $.dialog({
				id:"batchUpdateDirId",
				fixed: true,
				lock:true,
				background: '#000', // 背景色
				opacity: 0.2,
				title : "选中商品在目录下展示",
				width: 620,
				height:460
			 });
			 $.ajax({
				url:"batchUpdateDir.html?params="+param,
				dataType:"html",
				type:"post",
				success:function(data){
					dialog.content(data);
				}
			});
		}
		});
		
		//页面加载控制目录显示
	var v = $("#isshow").val();
	if(v == ""){
		v = 0;
	}
	$("#showVal").val(v);
	if(v == 1){
		//目录的span显示
		$("span[name='span_dir']").css("display","block");
		$("#isshow").val(0);
	}else{
		$("span[name='span_dir']").css("display","none");
		$("#isshow").val(1);
	}
	//显示商品目录
	$("#isshow").click(function(){
		var v = $(this).val();
		if(v == ""){
			v = 1;
		}
		$("#showVal").val(v);
		if(v == 1){
			//目录的span显示
			$("span[name='span_dir']").css("display","block");
			$(this).val(0);
		}else{
			$("span[name='span_dir']").css("display","none");
			$(this).val(1);
		}
	});
	$("a[name='rateValue']").click(function() {
		var goodsId = $(this).attr("id");
		var dialog = $.dialog({
			title : "设置商品费率",
			id : "dialogFee",
			fixed: true,
			lock:true,
			background: '#000', // 背景色
			opacity: 0.2,
			width : 450,
			height : 200
		});
		$.ajax({
			url:"ownSetHandFee.html?goodsId="+goodsId,
			dataType:"html",
			type:"post",
			success:function(data){
				dialog.content(data);
			}
		});
	});
	// 批量设置费率
	$("a[name='setFei']").click(function() {
		if ($.isChecked("box")) {
			 var param = $.getDelIds("box");
			var dialog = $.dialog({
				fixed: true,
				lock:true,
				background: '#000', // 背景色
				opacity: 0.2,
				title : "设置商品费率",
				id : "dialogFee",
				width : 450,
				height : 200
			});
			$.ajax({
				url:"ownSetHandFee.html",
				dataType:"html",
				type:"post",
				data:{goodsId:param},
				success:function(data){
					dialog.content(data);
				}
			});
		}
	});
	$("a[name='checkState1']").click(function(){
		var goodsId = $(this).attr("id");
		var dialog = $.dialog({
			fixed: true,
			lock:true,
			background: '#000', // 背景色
			opacity: 0.2,
			title : "商品审核",
			id : "dialogCheck",
			width : 450,
			height : 200
		});
		$.ajax({
			url:"ownGoodsCheck.html?goodsId="+goodsId,
			dataType:"html",
			type:"post",
			success:function(data){
				dialog.content(data);
			}
		});
	});
	// 批量审核
	$("a[name='checkState']").click(function() {
		if ($.isChecked("box")) {
			 var param = $.getDelIds("box");
			 var dialog = $.dialog({
				fixed: true,
				lock:true,
				background: '#000', // 背景色
				opacity: 0.2,
				title : "商品审核",
				id : "dialogCheck",
				width : 450,
				height : 200
			});
			$.ajax({
				url:"ownGoodsCheck.html?goodsId="+param,
				dataType:"html",
				type:"post",
				success:function(data){
					dialog.content(data);
				}
			});
		}
	});
	//单个修改销售状态
	// 打开设置商品状态
	$("a[id='salestate']").click(function(){
		var goodsId = $(this).attr("name");
		var dialog = $.dialog({
			fixed: true,
			lock:true,
			background: '#000', // 背景色
			opacity: 0.2,
			title : "设置商品销售状态",
			id : "opSellState1",
			width : 600,
			height : 200
		});
		$.ajax({
			url:"openSellState1.html?goodsId="+goodsId,
			dataType:"html",
			type:"post",
			success:function(data){
				dialog.content(data);
			}
		});
	});
	//批量修改商品销售状态  销售
	$("a[name='setOwnerState']").click(function(){
		if($.isChecked("box")){
			if(!window.confirm("确定要执行该操作吗？")){
				return false;
			}
			 var param = $.getDelIds("box");
			 var stateId = $(this).attr("stateId");
			 $.ajax({
				url:"batchSetSaleState1.html?goodsId="+param+"&stateId="+stateId,
				type:"post",
				success:function(data){
					if(data.flag){
						$("#queryGoodsForm").ajaxForm({
							url:"ownHaveManagmentDataForm.html",
							dataType:"html",
							type:"post",
							success:function(data){
								$("#showData").html(data);
							}
						});
						$("#queryGoodsForm").submit();
						alert("操作成功");
					}
				}
			});
		}
	});
	
	
	$("a[name='setOwnerStatezhanting']").click(function(){
		if($.isChecked("box")){
			
			 var param = $.getDelIds("box");
			
			 var dialog = $.dialog({
					id:"updateGoods",
					lock:true,
					background: '#000', // 背景色
					opacity: 0.2,
					title:"设置商品状态",
					width: 400,
					height:200
				});
				$.ajax({
					url:"batchSetGoodStatePage.html?goodsId="+param+"&type=2",
					type:"post",
					dataType:"html",
					success:function(data){
						dialog.content(data);
					}
			});
		}
	});
	
	//查看商品信息
	$("a[name='updateGoods']").click(function(){
		var goodsId = $(this).attr("id");
		var dialog = $.dialog({
			id:"saveGood",
			lock:true,
			background: '#000', // 背景色
			opacity: 0.2,
			title:"添加商品",
			width: 1000,
			height:500
		});
		$.ajax({
			url:"ownSeeGoodInfo.html?goodsId="+goodsId,
			type:"post",
			dataType:"html",
			success:function(data){
				dialog.content(data);
			}
		 });
		
		
	});
	//显示库存信息
	$("a[name='setPrice']").click(function(){
		var goodId=$(this).attr("id");
		var dialog = $.dialog({
			id:"setPriceDiv",
			lock:true,
			background: '#000', // 背景色
			opacity: 0.2,
			title:"商品定价",
			width: 1000,
			height:500
		});
		$.ajax({
			url:"http://baidu.com",
			data:{"goodId":goodId},
			type:"post",
			success:function(data){
				dialog.content(data);
			}
		 });
	});
	
	//删除商品
	$("a[name='img_delete_']").click(function(){
		if(!window.confirm("确定要删除该模板吗？")){
			return false;
		}
		var goodsId = $(this).attr("id");
		if ($("#isVerifyPassword").val()=="true") {
			layer.prompt({
				title:"请输入后台管理密码"
			},function(value, index, elem){
				layer.close(index);
				
				$.ajax({
					url:"batchDeleteOwner.html?goodsId="+goodsId+"&verifyCode="+value,
					type:"post",
					success:function(data){
						var code = data.code;
						var value = data.value;
						if(code == 1000){
							$("#queryGoodsForm").ajaxForm({
								url:"ownHaveManagmentDataForm.html",
								dataType:"html",
								type:"post",
								success:function(data){
									$("#showData").html(data);
								}
							});
							$("#queryGoodsForm").submit();
							alert("删除成功");
						}else{
							alert(value);
						}
					}
				});
			});
		} else {
			$.ajax({
				url:"batchDeleteOwner.html?goodsId="+goodsId,
				type:"post",
				success:function(data){
					var code = data.code;
					var value = data.value;
					if(code == 1000){
						$("#queryGoodsForm").ajaxForm({
							url:"ownHaveManagmentDataForm.html",
							dataType:"html",
							type:"post",
							success:function(data){
								$("#showData").html(data);
							}
						});
						$("#queryGoodsForm").submit();
						alert("删除成功");
					}else{
						alert(value);
					}
				}
			});
		}
	});
	//批量删除
	$("a[name='deleteGood']").click(function(){
		if($.isChecked("box")){
			if(!window.confirm("确定要删除该商品吗？")){
				return false;
			}
			var param = $.getDelIds("box");
			if ($("#isVerifyPassword").val()=="true") {
				layer.prompt({
					title:"请输入后台管理密码"
				},function(value, index, elem){
					layer.close(index);
					
					$.ajax({
						url:"batchDeleteOwner.html?goodsId="+param+"&verifyCode="+value,
						type:"post",
						success:function(data){
							var code = data.code;
							var value = data.value;
							if(code == 1000){
								$("#queryGoodsForm").ajaxForm({
									url:"ownHaveManagmentDataForm.html",
									dataType:"html",
									type:"post",
									success:function(data){
										$("#showData").html(data);
									}
								});
								$("#queryGoodsForm").submit();
								alert("删除成功");
							}else{
								alert(value);
							}
						}
					});
				});
			} else {
				$.ajax({
					url:"batchDeleteOwner.html?goodsId="+param,
					type:"post",
					success:function(data){
						var code = data.code;
						var value = data.value;
						if(code == 1000){
							$("#queryGoodsForm").ajaxForm({
								url:"ownHaveManagmentDataForm.html",
								dataType:"html",
								type:"post",
								success:function(data){
									$("#showData").html(data);
								}
							});
							$("#queryGoodsForm").submit();
							alert("删除成功");
						}else{
							alert(value);
						}
					}
				});
			}
		}
	});
	//设置每页条数
	$("select[name='everyPageSelect']").change(function() {
		var everyPage=$(this).val();
	    $("#everypage").val(everyPage);
	    $("#nowpage").val(1);
	    $("#queryGoodsForm").ajaxForm({
			url:"ownHaveManagmentDataForm.html",
			dataType:"html",
			type:"post",
			success:function(data){
				$("#showData").html(data);
			}
		});
		$("#queryGoodsForm").submit();
	});
	$("a[name='goPageButton']").click(function(){
		var nowPage = $("#goPage").val();
		var everyPage=$("select[name='everyPageSelect']").val();
		var allPage=$("#allpage").val();
		if(nowPage <= 0){
			nowPage = 1;
		}
		if(nowPage > allPage){
			nowPage = allPage;
		}
	    $("#everypage").val(everyPage);
	    $("#nowpage").val(nowPage);
	    
	    $("#queryGoodsForm").ajaxForm({
			url:"ownHaveManagmentDataForm.html",
			dataType:"html",
			type:"post",
			success:function(data){
				$("#showData").html(data);
			}
		});
		$("#queryGoodsForm").submit();
	});
	//上一页下一页
	$("a[class='sortBtn']").click(function(){
		var num = $(this).attr("id");
		var nowPage=$("#nowpage").val();
		var allPage=$("#allpage").val();
		if(num==0){
			$("#nowpage").val("1");
		}
		if(num==-1){
			nowPage=nowPage-1;
			if(nowPage<1){
				nowPage=1;
			}
			$("#nowpage").val(nowPage);
		} 
		if(num==1){
			nowPage=parseInt(nowPage)+1;
			if(nowPage>=allPage){
				nowPage=allPage;
			}
			$("#nowpage").val(nowPage);
		}
		if(num==2){
			$("#nowpage").val(allPage);	
		}
		
		 $("#queryGoodsForm").ajaxForm({
				url:"ownHaveManagmentDataForm.html",
				dataType:"html",
				type:"post",
				success:function(data){
					$("#showData").html(data);
				}
			});
			$("#queryGoodsForm").submit();
	});
	//全选
	$("#chooseAll").click(function(){
		$.checkAll2017("box",$(this));
	});
	//反选
	$("#unChooseAll").click(function(){
		$.inversCheck2017("box",$(this));
	});
	
	$("em[name='setIsHuo']").click(function(){
		
		var params=$(this).attr("id");
		var dialog = $.dialog({
					id:"closeId",
					fixed: true,
					lock:true,
					background: '#000', // 背景色
					opacity: 0.2,
					title : "开通全网供货",
					width:560,
					height:430
				});
				$.ajax({
					url:"openIsHuo.html?params="+params+"&type=2",
					dataType:"html",
					type:"post",
					success:function(data){
						dialog.content(data);
					}
				});
		
	});
	
		//批量全网供货
	$("a[name='batchSetOpenHuo']").click(function(){
		if($.isChecked("box")){
			 var param = $.getDelIds("box");
			 var dialog = $.dialog({
				id:"closeId",
				fixed: true,
				lock:true,
				background: '#000', // 背景色
				opacity: 0.2,
				title : "选中商品全网供货设置",
				width: 620,
				height:260
			 });
			 $.ajax({
				url:"batchSetOpenHuo.html?params="+param+"&type=2",
				dataType:"html",
				type:"post",
				success:function(data){
					dialog.content(data);
				}
			});
		}
	});
	
	$("a[name='leaveDir']").click(function(){
	if($.isChecked("box")){
			 var param = $.getDelIds("box");
			 var dialog = $.dialog({
				id:"closeId",
				fixed: true,
				lock:true,
				background: '#000', // 背景色
				opacity: 0.2,
				title : "取消目录展示",
				width: 520,
				height:260
			 });
			 $.ajax({
				url:"batchleaveDir.html?params="+param,
				dataType:"html",
				type:"post",
				success:function(data){
					dialog.content(data);
				}
			});
		}
	});
	
	
	});
	
	</script>


</div></div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#searchMoney").click(function(){
		$("#searchOrderForm").ajaxForm({
			url:"dSaleOrderList.html",
			type:"post",
			dataType:"html",
			success:function(data){
				$("#box").html(data);
			}
		});
		$("#searchOrderForm").submit();
	});
});
</script>


<script type="text/javascript">
		afterDay = function(t) {
			$("#startTime").val($.formatDate(new Date(), 2, t));
			$("#endTime").val($.formatDate(new Date(), 2, 1));
		};
		afterDay1 = function(t) {
			$("#startTime").val($.formatDate(new Date(), 2, t));
			$("#endTime").val($.formatDate(new Date(), 2, 0));
		};
		$("select[name='everyPageSelectLogin']").val("");
		var startTime = "";
		var endTime = "";
		
		if(startTime!=""){
			$("input[name='startTime']").val("");
		}
		
		if(endTime!=""){
			$("input[name='endTime']").val("");
		}
		if(""!=""){
			$("select[name='type']").val("");
		}
		
		if(""!=""){
			$("select[name='state']").val("");
		}
		
</script>


 <?
				 function xiaoyewl_pape($t0, $t1, $t2, $t3) {
	$page_sum = $t0;
	$page_current = $t1;
	$page_parameter = $t2;
	$page_len = $t3;
	$page_start = '';
	$page_end = '';
	$page_start = $page_current - $page_len;
	if ($page_start <= 0) {
		$page_start = 1;
		$page_end = $page_start + $page_end;
	}
	$page_end = $page_current + $page_len;
	if ($page_end > $page_sum) {
		$page_end = $page_sum;
	}
	$page_link = $_SERVER['REQUEST_URI'];
	$tmp_arr = parse_url($page_link);
	if (isset($tmp_arr['query'])){
		$url = $tmp_arr['path'];
		$query = $tmp_arr['query'];
		parse_str($query, $arr);
		unset($arr[$page_parameter]);
		if (count($arr) != 0){
			$page_link = $url.'?'.http_build_query($arr).'&';
		}else{
			$page_link = $url.'?';
		}
	}else{
		$page_link = $page_link.'?';
	}
	$page_back = '';
	$page_home = '';
	$page_list = '';
	$page_last = '';
	$page_next = '';
	$tmp = '';
	if ($page_current > $page_len + 1) {
		$page_home = '<a   class="sortBtn" href="'.$page_link.$page_parameter.'=1" title="首页">首页</a>';
	}
	if ($page_current == 1) {
		$page_back = '';
	} else {
		$page_back = '<a  class="sortBtn" href="'.$page_link.$page_parameter.'='.($page_current - 1).'" title="上一页">上一页</a>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.'<a class="sortBtn">'.$i.'</a>';
		} else {
			$page_list = $page_list.'<a  class="sortBtn"  href="'.$page_link.$page_parameter.'='.$i.'" title="第'.$i.'页">'.$i.'</a>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<a class="sortBtn"  href="'.$page_link.$page_parameter.'='.$page_sum.'" title="尾页">尾页</a>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = '<a class="sortBtn"  href="'.$page_link.$page_parameter.'='.($page_current + 1).'" title="下一页">下一页</a>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}
?>
</body> 
</html> 
