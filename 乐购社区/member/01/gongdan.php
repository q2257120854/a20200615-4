<?php
$nav = 'gongdan';
//删除工单
if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'gongdan where id = '.$_GET['gdid'].' and zid = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('删除成功!','/index/home/gongdan/id/'.$_GET['id'].'.html');
	}else{
		alert_back('删除失败！');
	}
}
//提交工单
if(isset($_POST['提交工单'])){
	if ($_SESSION['member_name']!=$member_name)
{die ('非法操作');};
	 null_back($_POST['n_name'],'请输入工单标题');
	 null_back($_POST['n_neirong'],'请输入工单标题内容');

	$_data['name'] = $_POST['n_name'];
	$_data['neirong'] = $_POST['n_neirong'];
	$_data['date'] = $sj;
	$_data['huiyuanid'] = $member_id;
	$_data['zid'] = $zhu_id;
 	$str = arrtoinsert($_data);
	$sql = 'insert into '.flag.'gongdan ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('提交工单成功!','');
	}else{
		alert_back('提交工单失败!'.mysql_error());
	}
}


?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>工单系统-<?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">    <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css"> <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">    
       <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
	
	.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
	
    </style>
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
		
		
    </style>
    
</head>

<body class="overflow"  >
    <? require_once('m_head.php');?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
            
<div id="vue">
    <div class="row">
        <div class="col-md-12">
                <div class="panel">
                <div class="panel-heading bg-gradient-vine">
                    工单系统
                </div>
                <div class="smart-widget-inner">
                  <div class="smart-widget-hidden-section">
                    </div>
                    <div class="list-group-item bg-grey" style="overflow: hidden;">
                        <a class="btn btn-default purple" data-toggle="modal"
                           data-target="#modal-add"><i class="fa fa-plus"></i> 新增</a>
                    </div>					
                  <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>id</th>
                                <th>工单标题</th>
                                <th>提交时间</th>
                                <th>操作</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
								$sql = 'select * from '.flag.'gongdan  where zid = '.$zhu_id.' and huiyuanid = '.$member_id.' order by id asc';
 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $c_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 
 							?>
                          <tr>
                            <td>
                              <?=$row['id']?></td>
							<td> <?=$row['name']?></td>
                            <td><?=$row['date']?></td>
                            <td>
							<? if($row['zhuangtai'] == 0){?>
							<a class="btn-xs btn-danger">等待处理</a>
							<?}else{?>
							<a class="btn-xs btn-success"  href="javascript:void(0);" onclick="loadMessage(' <?=$row['name']?>               ','<?=$row['huifu']?>                                      ','<?=$row['date']?>');">已回复查看</a> 
							<?}?>
							<a href="javascript:if(confirm('确定删除id<?=$row['id']?>这个工单吗?'))location='/member/gongdan.php?id=<?=$_GET['id']?>&act=del&gdid=<?=$row['id']?>'" class="btn-xs btn-warning">删除</a>
							</td>
                          </tr>
                          <? }?>
                        </tbody>
                      </table>
                    </div> 
                  <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div> </div> </div>  
                       
                       
        </div>
                    <div class="smart-widget-footer text-center">
                        <pagination ref="pagination" :total="total" :current_page="search.page"
                                    :page_size="search.pageSize"
                                    @page-phange="pageChange"></pagination>
                    </div>
          </div>
      </div>
  </div>
</div>
    <script language="javascript">
  
    
   
 function loadMessage($gname,$gcontent,$gdate) {
      
                 if ($gname != '') {
 			   document.getElementById("msg_bt").value = $gname;				
			   document.getElementById("msg_time").value = $gdate;				
			   document.getElementById("msg_info").value = $gcontent;				
 			   document.getElementById("modal-msg").style.display = "block";				
                   } 
				   else {
                 alert('查看失败:工单不存在!');
                 }
            
	
 }
  function closemsg() 
  {document.getElementById("modal-msg").style.display = "none"; }
  
 </script>
 
 
 
 <div class="modal" id="modal-msg">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" onClick="closemsg()"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>工单回复</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">发件人</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="1" style="resize:none" readonly id="msg_user">平台管理员</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">标题</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="1" style="resize:none" readonly id="msg_bt"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">发送时间</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="1" style="resize:none" readonly id="msg_time"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">内容</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="8" style="resize:none" readonly id="msg_info"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white"   onClick="closemsg()"  data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

    <div class="modal" id="modal-sort">
        <div class="modal-dialog"></div>
    </div>
<div class="modal" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" ><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>发布工单</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="addForm" method="post">
                      <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">工单标题</label>
                            <div class="col-sm-10">
                              <input name="n_name" type="text" class="form-control" id="n_name" placeholder="请输入标题" value="">
                            </div>
                      </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">工单内容</label>
                            <div class="col-sm-10">
                              <textarea name="n_neirong" class="form-control" id="n_neirong" placeholder="请输入工单内容"></textarea>
                            </div>
                        </div>                     
                      <div class="modal-footer">
                
                  <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <input name="提交工单"  type="submit"  class="btn btn-primary" id="" value="增加">

                </div>
              </form>
            </div>
            
            
        </div>
    </div>
    </div>

    <!-- /main-container -->
<? require_once('m_footer.php');?>
<!-- /wrapper -->
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
		$page_home = ' <li class="disabled page-item"><a class="page-link" href="'.$page_link.$page_parameter.'=1" title="首页">首页</a></li>';
	}
	if ($page_current == 1) {
		$page_back = '';
	} else {
		$page_back = '<li class="page-item"><a class="page-link" href="/member/gongdan.php?id='.$_GET['id'].'&page='.($page_current - 1).'" " title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a  href="/member/gongdan.php?id='.$_GET['id'].'&page='.$i.'" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="/member/gongdan.php?id='.$_GET['id'].'&page='.$page_sum.'"    class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="/member/gongdan.php?id='.$_GET['id'].'&page='.($page_current + 1).'" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


	 function get_shopzt($t0)
{
	$result = mysql_query('select *  from  '.flag.'shop where ID = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['duijiecgzt'];
	} else {
		return '0';
	}
}

?>
 </body>
</html>
