<?php
require_once('../system/inc.php');
require_once('../system/safe.php');
require_once('admin_config.php');
$navpd="guanli";
if($_GET['act'] =='del'){
	//删除
	$sql = 'delete from '.flag.'admin where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		$_data['zt'] = 0;
		$str = arrtoinsert($_data);
	$sqll = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where fxid = '.$_GET['id'].'';
		mysql_query($sql1);
		alert_href('删除成功!','');
	}else{
		alert_back('删除失败！');
	}
} ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css?" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<link rel="stylesheet" href="file/main/css/jQueryUI/jquery-ui.css?" type="text/css" />
<script type="text/javascript" src="file/main/js/jQueryUI/jquery-ui.js"></script>
<script type="text/javascript" src="file/main/js/util/DateUtil.js"></script>
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css?" type="text/css"></link>
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
 
 </script>

<body> 
<div id="body">
	<div class="dingdan-right list-right">
		<div class="chaxun">
 				<table width="100%">
				<tbody><tr>
					<td height="42" style="width:100px;">
					<em class="shangpinxx">搜索管理：</em>					</td>
				    <td>
				  			<form name="form1" id="form1" >
 <input  value="<?=$_GET['key']?>" class="txt1" style="width:150px;" type="text" id="" name="key">
				  <input id="" name="" type="button" onclick="subForm()"  class="list-chaxun" value="确认查询" >
				  	</form>
</td>
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
	<table>
		<thead>
			<tr>

              
					<tr class="text-c">
					  	<th width="40">ID</th>
						<th width="200">账号</th>
						<th>额度</th>
 						<th width="70">操作</th>
					</tr>
				</thead>
				<tbody>
<?php 
if ($_GET['key'] != '') {
    $sql = 'select * from ' . flag . 'admin where a_name like "%'.$_GET['key'].'%" order by ID desc , ID desc';
} else {
    $sql = 'select * from ' . flag . 'admin order by ID desc , ID desc';
}
$pager = page_handle('page', 20, mysql_num_rows(mysql_query($sql)));
$result = mysql_query($sql . ' limit ' . $pager[0] . ',' . $pager[1] . '');
while($row= mysql_fetch_array($result)){
	$w_title=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
	$w_url=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['url']);					 
?>
					<tr class="text-c">
					  <td class="frameset_tr"><?=$row['ID']?>&nbsp;</td>
					  <td class="frameset_tr"><?=$row['a_name']?>&nbsp;</td>
					  <td class="frameset_tr"><?=$row['a_num']?>&nbsp;</td>
 				 	  <td class="f-14">    
                        					<a name="" id="<?=$row['ID']?>" href="guanli_edit.php?id=<?=$row['ID']?>" class="status1">编辑</a>
					<a name="img_delete_" title="删除" href="?act=del&amp;id=<?=$row['ID']?>" onClick="return confirm('确认要删除?')" class="status3">删除</a>				 		 	  </td>
					  </td>
					</tr>
                    <?php }?>
                          <tr class="text-c">
					  <td colspan="11"> 	<div class="bottom_right">
				   <?php  echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>				   	</div>	</td>
				  </tr>
				</tbody>
			</table>
			</div>
		</article>
	</div>
</section>

<script type="text/javascript">
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('主站列表谨慎删除，确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
</script>

 <?php
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