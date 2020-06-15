<?php
 require_once('admin_check.php');
require_once('admin_config.php');
 if($_GET['delIds'] !=''){
	$sql = 'delete from '.flag.'info where id = '.$_GET['delIds'].'';
	if(mysql_query($sql)){
		alert_href('删除成功!','info.php');
	}else{
		alert_back('删除失败！');
	}
}
if ($_GET['page']=='')
{ $page=1;}
else
{$page=$_GET['page'];}

if ($_GET['everyPageSelect']=='')
{ $everyPageSelect=20;}
else
{$everyPageSelect=$_GET['everyPageSelect'];}


 ?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<title>公告管理</title> 
<!-- 必要元素 开始 -->
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<script type="text/javascript" src="file/main/js/jquery-1.9.1.js"></script>
<!-- 必要元素 结束 -->

<!-- 表单元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.form.js"></script>
<!-- 表单元素 结束 -->

<!-- 表单验证元素 开始 -->
<script type="text/javascript" src="file/main/js/jquery.validate.js"></script>
<!-- 表单验证元素 结束 -->

<!-- 全选元素 开始 -->
<script type="text/javascript" src="file/main/js/util/CheckBoxUtil.js"></script>
<!-- 全选元素 结束 -->

<!-- 弹窗元素 开始 -->
<script type="text/javascript" src="file/artDialog/jquery.artDialog.js"></script>
<link rel="stylesheet" href="file/artDialog/skins/cool.css" type="text/css"></link>
<!-- 弹窗元素 结束 -->

	<script type="text/javascript">
		$(document).ready(function(){
			var target = $("#target").val();
	        $("a[name='"+target+"']").attr("class", "on");
			$.ajax({
	  			url:"../general/announcement1.html?tag="+target,
	  			type:"post",
	  			dataType:"html",
	  			success:function(data){
	  				$("#orderHandDiv").html(data);
	  			}
	  		});
			$("#setType").click(function(){
				 var dialog = $.dialog({
						id:"customTypeId",
						lock:true,
						background: '#000', // 背景色
						opacity: 0.2,
						title : "自定义公告类型管理",
						width: 450,
						height:350
				});
				 $.ajax({
						url:"../general/annCustomTypeList.html",
						dataType:"html",
						type:"post",
						success:function(data){
							dialog.content(data);
						}
				});
			});
			$("#subAnnouncement").click(function(){
				var target = $("#target").val();
				window.location.href="info_add.php?target="+target;
			});
		});
		function tab0(tabId, tabNum) {
	        //设置点击后的切换样式
	        $("#target").val(tabNum);
	         $(".tab-nav li").attr("class","");
	        $(".tab-nav li").eq(tabId).attr("class", "on");
	        $.ajax({
	  			url:"../general/announcement1.html?tag="+tabNum,
	  			type:"post",
	  			dataType:"html",
	  			success:function(data){
	  				$("#orderHandDiv").html(data);
	  			}
	  		});
	    }
	</script>
</head> 
<body> 
<div id="body">
<div class="zl-tab-hd">
		<ul class="tab-nav" id="mainTab">
	   		
	   			<li style="margin-left:20px;" class="on"><a id="1" name="1" href="javascript:void(0);" onclick="tab0('0','1');">公告管理</a></li>
	   		
 	   		
	   			 
	   		
	 	</ul>
 	</div>
	<div class="dingdan-right list-right">
      <div class="chaxun"> <span class="tianjia"> <a id="subAnnouncement" href="javascript:void(0);">发布公告</a> </span> </div>
	  <div id="orderHandDiv">
        <title>公告管理</title>
        <div class="cxneirong">
          <table>
            <thead>
              <tr>
                <th width="7%">ID</th>
                <th width="11%">排序</th>
                <th width="10%">公告标题</th>
                <th width="39%">公告内容</th>
                <th width="17%">添加时间</th>
                <th width="8%">修改</th>
                <th width="8%">删除</th>
              </tr>
            </thead>
            <tbody>
				<?php
						
								if ($_GET['cid'] != ''){
									$sql = 'select * from '.flag.'info where i_cid in ('.$_GET['cid'].') order by i_order desc , id desc'; 							 
								} 
						 
							if (isset($_GET['key'])) {
								$sql = 'select * from '.flag.'info where i_name like "%'.$_GET['key'].'%" order by i_order desc , id desc';
 							}
							else{
									$sql = 'select * from '.flag.'info order by i_order desc , id desc';
 								}
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $key1=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['i_name']);
						 
 							?>
              <tr class="frameset_tr">
                <td><?=$row['ID']?></td>
                <td align="center" ><?=$row['i_order']?></td>
                <td align="left" style="line-height:20px;<?=$row['i_font']?>"><font color="<?=$row['i_color']?>" ><?=$key1?></font> </td>
                <td align="center"><?=$row['i_content']?></td>
        
                 <td align="center"><?=$row['i_date']?></td>
                <td><a name="img_update_" id="<?=$row['ID']?>" href="javascript:void(0);" title="修改"><img src="file/main/images/icon_edit.png" width="16" height="16" border="0" /></a> </td>
                <td><a name="img_delete_" id="<?=$row['ID']?>" href="?delIds=<?=$row['ID']?>" title="删除"><img src="file/main/images/icon_del.png" width="16" height="16" border="0" /></a> </td>
              </tr>
			  <? }?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="9"><div class="bottom_right"> 
 
				 
				 <form action="" method="get" id="search_form">
		 <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?>  
                        <input style="border:1px solid #ccc; width:30px;" type="text" size="1" value="<?=$page?>" id="page" name="page" />
                        <a id="" name="goPageButton" href="javascript:void(0);" onclick="document:search_form.submit();"  class="bottom_a">转 到</a>
				  
                        <label></label>
				 </form>
                </div></td>
              </tr>
            </tfoot>
            <tfoot>
            </tfoot>
          </table>
        </div>
	    <form method="post" id="cutPageForm">
	    </form>
	    <script type="text/javascript">
	$(document).ready(function() {
		//删除
		$("a[name='img_delete_']").click(function(){
			if(!window.confirm("确定要删除吗？")){
				return false;
			}
			$.ajax({
			   url : "info_edit.php?delIds="+$(this).attr("id"),
			   type:"get",
			   success : function(data) {
				    //刷新列表
				    if(data.flag){
				    	var everyPage=$("select[name='everyPageSelect']").val();
				    	$("#everypage").val(everyPage);
					    $("#nowpage").val(1);
					    
					    $("#cutPageForm").ajaxForm({
							url:"info.php",
							dataType:"html",
							type:"post",
							success:function(data){
								$("#orderHandDiv").html(data);
							}
						});
						$("#cutPageForm").submit();
				    	alert("删除成功！");
				    }
				}
			});
		});
		//单个更改状态
		$("a[name='img_state_']").click(function(){
			var id = $(this).attr("id");
			var temp = $(this).attr("temp");
			if(temp == 0){
				temp = "1";
			}else{
				temp = "0"
			}
			$.ajax({
				 url : "info.php",
				   type:"post",
				   data:{delIds:id,stateId:temp},
				   success : function(data) {
					    //刷新列表
					    if(data.flag){
					    	var everyPage=$("select[name='everyPageSelect']").val();
					    	$("#everypage").val(everyPage);
						    $("#nowpage").val($("#nowpage").val());
						    
						    $("#cutPageForm").ajaxForm({
								url:"announcementQuery.html",
								dataType:"html",
								type:"post",
								success:function(data){
									$("#orderHandDiv").html(data);
								}
							});
							$("#cutPageForm").submit();
					    }
				   	}
				});
		});
		//批量更改状态
		$("a[name='batchChangeState']").click(function(){
			var id = $(this).attr("id");
			if($.isChecked("box")){
				 var param = $.getDelIds("box");
				 $.ajax({
				   url : "changeAnnounState.html",
				   data:{delIds:param,stateId:id},
				   type:"post",
				   success : function(data) {
					    if(data.flag){
					    	var everyPage=$("select[name='everyPageSelect']").val();
					    	$("#everypage").val(everyPage);
						    $("#nowpage").val(1);
						    
						    $("#cutPageForm").ajaxForm({
								url:"announcementQuery.html",
								dataType:"html",
								type:"post",
								success:function(data){
									$("#orderHandDiv").html(data);
								}
							});
							$("#cutPageForm").submit();
					    }
					}
				});
			}
		});
		//修改
		$("a[name='img_update_']").click(function(){
			var target = $("#target").val();
			window.location.href="info_edit.php?id="+$(this).attr("id")+"&target="+target;
		});
		$("a[name='btn_delete_']").click(function(){
			if($.isChecked("box")){
				 var param = $.getDelIds("box");
				 if(!window.confirm("确定要删除吗？")){
					return false;
				}
				$.ajax({
					 url : "info.php?delIds="+param,
				   type:"GET",
				   success : function(data) {
					    if(data.flag){
					    	var everyPage=$("select[name='everyPageSelect']").val();
					    	$("#everypage").val(everyPage);
						    $("#nowpage").val(1);
						    
						    $("#cutPageForm").ajaxForm({
								url:"announcementQuery.html",
								dataType:"html",
								type:"post",
								success:function(data){
									$("#orderHandDiv").html(data);
								}
							});
							$("#cutPageForm").submit();
					    	alert("删除成功！");
					    }
					}
				});
			}
		});
		//**************************
		$("select[name='everyPageSelect']").change(function() {
			var everyPage=$(this).val();
		    $("#everypage").val(everyPage);
		    $("#nowpage").val(1);
		    $("#cutPageForm").ajaxForm({
				url:"announcementQuery.html",
				dataType:"html",
				type:"post",
				success:function(data){
					$("#orderHandDiv").html(data);
				}
			});
			$("#cutPageForm").submit();
		});
		//跳转到指定页码
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
		    
		    $("#cutPageForm").ajaxForm({
				url:"announcementQuery.html",
				dataType:"html",
				type:"post",
				success:function(data){
					$("#orderHandDiv").html(data);
				}
			});
			$("#cutPageForm").submit();
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
			$("#cutPageForm").ajaxForm({
				url:"announcementQuery.html",
				dataType:"html",
				type:"post",
				success:function(data){
					$("#orderHandDiv").html(data);
				}
			});
			$("#cutPageForm").submit();
		});
		//全选
		$("#chooseAll").click(function(){
			$.checkAll2017("box",$(this));
		});
		//反选
		$("#unChooseAll").click(function(){
			$.inversCheck2017("box",$(this));
		});
	});
    </script>
      </div>
</div>
	<script  type="text/javascript">
$(document).ready(function(){
	$("a[name='shengcheng']").click(function(){
		var tag=$("#target").val();
		$.ajax({
			url:"announcementShengCheng.html?tag="+tag,
			type:"post",
			success:function(data){
				alert("生成成功!");
			}
		});
	});
});
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
