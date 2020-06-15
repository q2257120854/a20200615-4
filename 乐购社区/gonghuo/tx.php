<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'tx';
if ($_POST['提交']=='提现')
 
{
	$rmb=$_POST['rmb'];
   	   	non_numeric_back($_POST['rmb'],'请输入提现金额');
   	   	null_back($_POST['image'],'请上传收款图');
 if ($rmb > $suprmb)

{ 		alert_href('提现失败:您的余额不足提现'.$rmb.'元请充值!',''); }

 else
//提现成功
{
 

			//提现记录
	$_data2['zid'] = $zhu_id;
 	$_data2['uid'] = $supid;
 	$_data2['money'] = $rmb;
 	$_data2['image'] = $_POST['image'];
 	$_data2['date'] = $sj;
 	$_data2['zt'] = 0;
 
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'insert into '.flag.'suptx ('.$str2[0].') values ('.$str2[1].')';
    mysql_query($sql2);

	 $xfhje=$suprmb-$rmb;
	 
	     $_data1['hyid'] = $supid;
	$_data1['hyname'] = $supname;
 	$_data1['xf_qje'] = $suprmb;
 	$_data1['xf_je'] = $rmb;
 	$_data1['xf_hje'] = $xfhje;
 	$_data1['xf_date'] = $sj;
 	$_data1['xf_qk'] = '余额提现';
 	$_data1['zid'] = $zhu_id;
  	$_data1['xf_lx'] =0;   
	
  	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'xfjl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
	
 
	$sql3 = 'update '.flag.'user set point= point-'.$rmb.'  where id = '.$supid.' and zid= '.$zhu_id.'';
     mysql_query($sql3);

 
		alert_href('提现成功!','');


}

}
 
 

 

 ?> 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/common/md5.min.js"></script>
    
    <script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>

 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#images').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#images').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#images').val(url);
				editor.hideDialog();
				}
			});
		});
	});
	 
 
	
	 
	
	 
	
	 
	
});

 </script>
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
                          <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        资金提现
                    </div>
                     <div class="panel-body">
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
                  
                  
                   <div class="list-group-item list-group-item-danger"><i class="fa fa-volume-up"></i>
                    当前余额:<?=$suprmb?>元  </div>
  <div style="height:10px"></div>


<form id="subform" name="subform" class="form-inline"  method="get">
  <a class="btn btn-default purple" data-toggle="modal"
                           data-target="#modal-tx"><i class="fa fa-plus"></i> 申请提现</a>
                           
                            <input type="text" class="hidden" disabled>
                 
                             <div class="form-group">
                                <select name="zt"   class="form-control" id="">
                                    <option  <? if ($_GET['zt'] == "") {echo "selected";}?> value="">所有</option>
                                     <option  <? if ($_GET['zt']=="0") {echo "selected";}?> value="0">等待中</option>
                                    <option  <? if ($_GET['zt']== "2") {echo "selected";}?> value="2">异常中</option>
                                    <option  <? if ($_GET['zt']== "1") {echo "selected";}?> value="1">已转账</option>
                                    <option  <? if ($_GET['zt']== "3") {echo "selected";}?> value="3">已驳回</option>
 
                              </select>
                            </div>
 
<script type="text/javascript" src="/js/adddate.js" ></script> 

 
                            <div class="form-group">
                            
                              <input type="text"  value="<?=$_GET['date1']?>"  onclick="SelectDate(this,'yyyy-MM-dd')" class="form-control" name="date1" placeholder="请选择提现时间">
                            
                    </div>
                            到
                            <div class="form-group">
                                <input type="text" value="<?=$_GET['date2']?>" onclick="SelectDate(this,'yyyy-MM-dd')"  class="form-control" name="date2" placeholder="选择结束时间">
                            </div>
                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i
                                    class="fa fa-search"></i> 搜索</a>
                    </form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>提现金额</th>
                            <th>申请时间</th>
                            <th>处理时间</th>
                              <th>状态</th>
                            <th>备注</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
//所有条件						 
  if (     $_GET['date1']!='' and  $_GET['date2']!=''  and  $_GET['zt']!='' )	 
{	  $sql = 'select * from '.flag.'suptx where   zid='.$zhu_id.'   and zt ='.$_GET['zt'].'       and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"        and uid ='.$supid.'      order by ID desc , ID desc';}


//只看时间						 
  elseif (     $_GET['date1']!='' and  $_GET['date2']!=''  and  $_GET['zt']=='' )	 
{	  $sql = 'select * from '.flag.'suptx where   zid='.$zhu_id.'         and  date between  "'.$_GET['date1'].'"  and  "'.$_GET['date2'].'"           and uid  ='.$supid.'      order by ID desc , ID desc';}

//只看状态						 
  elseif (     $_GET['date1']=='' and  $_GET['date2']==''  and  $_GET['zt']!='' )	 
{	  $sql = 'select * from '.flag.'suptx where   zid='.$zhu_id.'   and zt ='.$_GET['zt'].'        and uid ='.$supid.'        order by ID desc , ID desc';}

 
   			 //无条件状态
  elseif (   $_GET['date1']=='' and  $_GET['date2']=='' and  $_GET['zt']==''  )	 
{	  $sql = 'select * from '.flag.'suptx  where   zid='.$zhu_id.'    and uid ='.$supid.'  order by ID desc , ID desc';}
 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                          <tr>
                            <td><a data-toggle="modal" data-target="#modal-sort" class="btn-xs btn-primary">
                              <?=$row['ID']?>
                            </a></td>
                            <td><?=get_xiaoshu($row['money'],2)?></td>
                            <td><?=$row['date']?></td>
                            <td><?=$row['dates']?></td>
                            <td><? if ($row['zt']==0) {echo "<span class='text-info'>等待中</span>";}?>
                            <? if ($row['zt']==1) {echo "<span class='text-success'>已转账</span>";}?>
                            <? if ($row['zt']==2) {echo "<span class='text-warning'>异  常</span>";}?>
                            <? if ($row['zt']==3) {echo "<span class='text-info'>已驳回</span>";}?>
                            
                            
                            </td>

                             <td> <?=$row['desc']?></td>
                             
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
 

        </div>   </div>   </div>   </div>
    </div><!-- /main-container -->

 <? include('footer.php');
?>
</div>

  <div class="modal" id="modal-tx"  style="z-index:9999">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>申请提现</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="txForm" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">提现金额</label>
                            <div class="col-sm-10">
                                <input value="100" name="rmb" type="number" class="form-control"
                                       placeholder="输入要提现金额，最低100元">
                               
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">收款图片</label>
                            <div class="col-sm-10">
                                <input value="" name="image" id="images" type="text" class="form-control"
                                       placeholder="请上传收款图片">
                               
                            </div>
                        </div>
                        
                        
                         
                        
                            
                            
      
      
      
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                     <input name="提交"  value="提现" class="btn btn-primary" type="submit">
                </div>
            </div></form>
            
        </div>
    </div>

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
		$page_back = '<li class="page-item"><a class="page-link" href="'.$page_link.$page_parameter.'='.($page_current - 1).'" title="上一页">上一页</a></LI>';
	}
	for ($i = $page_start; $i <= $page_end; $i++) {
		if ($i == $page_current) {
			$page_list = $page_list.' <li class="active page-item"><a href="javascript:;" class="page-link">'.$i.'</a></li>';
		} else {
			$page_list = $page_list.'<li class="page-item"><a href="'.$page_link.$page_parameter.'='.$i.'" title="第'.$i.'页" class="page-link"> '.$i.'</a></LI>';
		}
	}
	if ($page_current < $page_sum - $page_len) {
		$page_last = '<li class="page-item"><a href="'.$page_link.$page_parameter.'='.$page_sum.'"  class="page-link" title="尾页">...'.$page_sum.'</a></li>';
	}
	if ($page_current == $page_sum) {
		$page_next = '';
	} else {
		$page_next = ' <li class="page-item"><a href="'.$page_link.$page_parameter.'='.($page_current + 1).'" title="下一页"  class="page-link">下一页</a></LI>';
	}
	$tmp = $tmp.$page_back.$page_home.$page_list.$page_last.$page_next.'';
	return $tmp;
}


?> 


 <? include_once('footer.php');
?><? include('password.php');?> </body>
</html>
