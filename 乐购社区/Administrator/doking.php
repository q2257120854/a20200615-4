<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 
  if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'tuijian where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
 	 
	 
  
		alert_href('删除成功!','doking.php');
	}else{
		alert_back('删除失败！');
	}
}
 

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css?" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<link rel="stylesheet" href="file/main/css/jQueryUI/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="file/main/js/jQueryUI/jquery-ui.js"></script>
<script type="text/javascript" src="file/main/js/util/DateUtil.js"></script>
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
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
					<td height="42" style="width:100px;"><input name="按钮" type="button" onclick="MM_goToURL('self','doking_add.php');return document.MM_returnValue"  class="list-chaxun" id="ownerSearch" value="新增推荐" /></td>
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
              	<th width="14%">社区系统</th>
				<th width="16%">社区名称</th>
				<th width="18%">平台域名</th>
				<th width="14%">客服QQ</th>
				<th width="14%">上缴押金</th>
				<th width="14%">操作</th>
			</tr>
		</thead>
		
		 <tbody>
		 	 
			 	<?php
							 if ($_GET['key']!='') 
							 {$sql = 'select * from '.flag.'tuijian where name like "%'.$_GET['key'].'%"     order by ID asc , ID desc';}
  							 else
							 {$sql = 'select * from '.flag.'tuijian order by ID asc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
 						 
 							?>
			 	<tr class="frameset_tr">
			 	  <td> <?=$row['px']?></td>
                     <td><?=$row['xitong']?>&nbsp;</td>
				 	<td><?=$name?> </td>
				 	<td><?=$row['url']?>&nbsp;</td>
                     <td><?=$row['qq']?>&nbsp;</td>
				 	<td><?=$row['money']?>&nbsp;</td>
				 	<!-- 目录显示 -->
				 	<td>
				 
					<a name="" id="<?=$row['ID']?>" href="doking_edit.php?id=<?=$row['ID']?>"  class="status1">编辑</a>
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
