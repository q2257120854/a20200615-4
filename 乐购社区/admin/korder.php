<?php 
$title='卡密订单';
  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'korder';

 
 

if($_POST['act'] =='pl' and $_POST['提交'] =='删除选中'){
  if(empty($_POST['id'])){
    echo"<script>alert('请选择后才可以进行更改!');history.back(-1);</script>";
    exit;
  } 
  else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str='delete from '.flag.'shopkm where id in ('.$id.') and zid = '.$zhu_id.'';
   mysql_query($str);
   echo "<script>alert('操作成功！');window.location.href='';</script>";
}
}


 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>卡密订单</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap core CSS -->
    <link href="assets/style/bootstrap/css/bootstrap.min.css?" rel="stylesheet">

    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
    <script src="assets/common/md5.min.js"></script>
    
		<script type="text/javascript" language="javascript">
    function selectBox(selectType){
    var checkboxis = document.getElementsByName("id[]");
    if(selectType == "reverse"){
      for (var i=0; i<checkboxis.length; i++){
        //alert(checkboxis[i].checked);
        checkboxis[i].checked = !checkboxis[i].checked;
      }
    }
    else if(selectType == "all")
    {
      for (var i=0; i<checkboxis.length; i++){
        //alert(checkboxis[i].checked);
        checkboxis[i].checked = true;
      }
    }
   }
</script>

    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



<div class="wrapper preload">
 
<?php 
 include('header.php');
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-green">
                <div class="smart-widget-header">
                    卡密订单                    <span class="smart-widget-option">

                    <span class="refresh-icon-animated">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                    <a href="#" class="widget-toggle-hidden-option">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="#" class="widget-collapse-option" data-toggle="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="widget-refresh-option load-data-btn">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                </div>
                <div class="smart-widget-inner">
                    <div class="smart-widget-hidden-section">
                     
                    </div>
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="subform" name="subform" class="form-inline"  method="get">
                            <input type="text" class="hidden" disabled>
                         <select  class="form-control"  name="zt">
                           <option  <? if ($_GET['zt']=="") {echo "selected";}?>  value="">所有</option>
                           <option  <? if ($_GET['zt']=="0") {echo "selected";}?>  value="0">未使用</option>
                           <option <? if ($_GET['zt']=="1") {echo "selected";}?> value="1">已使用</option>
                         </select>
                    <div class="form-group"><input type="text"  name="key" placeholder="请输入搜索内容" class="form-control"></div>



                            <a class="btn btn-default purple"  onclick="document.getElementById('subform').submit();return false"  ><i class="fa fa-search"></i> 搜索</a>
                    </form>                    </div>
                    
                    
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                    <form action="" method="post" >
                    <input name="act" type="hidden" value="pl">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
							  <th class="" width="20"  onClick="selectBox('reverse')" ><span>选</span></th>
							  <th>商品信息</th>
							  <th>卡密状态</th>
                            <th>卡密信息</th>
                            <th>备注</th>
                            <th>生成时间</th>
                            <th>用户信息</th>
                             <th>购买时间</th>
                        
                          </tr>
                        </thead>
                        <tbody>
                          <?php


if ($_GET['key']!='' and $_GET['zt']!='')
{	  $sql = 'select * from '.flag.'shopkm  where zid = '.$zhu_id.' and kahao like   "%'.$_GET['key'].'%"  and  zt = '.$_GET['zt'].'     order by ID desc , ID desc';}

elseif ($_GET['key']!='' and $_GET['zt']=='')
{	  $sql = 'select * from '.flag.'shopkm  where zid = '.$zhu_id.' and  zt = '.$_GET['zt'].'     order by ID desc , ID desc';}

elseif ($_GET['key']=='' and $_GET['zt']!='')
{	  $sql = 'select * from '.flag.'shopkm  where zid = '.$zhu_id.' and  zt = '.$_GET['zt'].'        order by ID desc , ID desc';}

elseif ($_GET['key']=='' and $_GET['zt']=='')
{	  $sql = 'select * from '.flag.'shopkm  where zid = '.$zhu_id.'   order by ID desc , ID desc';}

 

 								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
  						  	 $kahao=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['kahao']);
 						  	 $desc=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['desc']);

 							?>
                          <tr>
                            <td><input type="checkbox" name="id[]" value="<?=$row['ID']?>" style="background:none; border:none;">&nbsp;</td>
                            <td><?=get_shop($row['sid'],'name')?>(<?=$row['sid']?>)&nbsp;</td>
                            <td><? if ($row['zt']==0){echo "<font color='green'>未使用</font>";}?><? if ($row['zt']==1){echo "<font color='red'>已使用</font>";}?>&nbsp;</td>
                            <td><?=$kahao?></td>
                            <td><?=$desc?></td>
                            <td><?=$row['date']?></td>
                            <td><?=$row['hyname']?>[<?=$row['hyid']?>]</td>
                            <td>
        <?=$row['pdate']?>

                            </td>
        
                          </tr>
                          
                         
                          <? }?>
                          
                           <tr align="left">
                            <td colspan="7" align="left">
                            <div align="left">
                              <span   onClick="selectBox('reverse')"   class="btn btn-purple purple">批量修改选择项</span>
      
      <input name="提交" class="btn btn-info purple"  type="submit" value="删除选中">
      </div>
      </td>
                            <td>                            
                          </tr>
                          
                          
                           
                        
                          </td>
                          </tr>
                        </tbody>
                      </table>
                      </form>
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

    
     
   


 <!-- /main-container -->

 <? include('footer.php');
?>
</div><!-- /wrapper -->


 
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


//获取商品状态反馈
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
