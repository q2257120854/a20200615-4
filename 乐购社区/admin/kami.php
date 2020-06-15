<?php 
$title='余额明细';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'kami';
check_qx($site_qx,'卡密管理');

if ($_POST['act']=='pldel')
{
 if(empty($_POST['id'])){
    echo"<script>alert('必须选择一个ID,才可以删除!');history.back(-1);</script>";
    exit;
  }else{
/*如果要获取全部数值则使用下面代码*/ 
   $id= implode(",",$_POST['id']);
   $str='DELETE FROM '.flag.'kami where id in ('.$id.') and zid = '.$zhu_id.'  ';
   mysql_query($str);
  echo "<script>alert('删除成功！');window.location.href='';</script>";
}

}


if($_GET['act'] =='del'){
	$sql = 'delete from '.flag.'kami where zt = '.$_GET['zt'].' and zid = '.$zhu_id.' and fid = 0 ';
	if(mysql_query($sql)){
 
		alert_href('清空成功!','kami.php');
	}else{
		alert_back('删除失败！');
	}
}


if($_GET['act'] =='del1'){
	$sql = 'delete from '.flag.'kami where ID = '.$_GET['id'].' and zid = '.$zhu_id.'  and fid = 0  ';
	if(mysql_query($sql)){
 

		alert_href('删除成功!','kami.php');
	}else{
		alert_back('删除失败！');
	}
}



if(isset($_POST['提交'])){
	
	//查询今日生成数量
	
	   
  $sel="select count(*) as sl from  ".flag."kami where zid = ".$zhu_id."  and day(date) = day(now())     ";
  $sl=@mysql_query($sel);
  $s=@mysql_fetch_array($sl);
  if ($s['sl']>=500)
  { echo  alert_href('生成失败:今日数量已达上限!'); }
 

  
  //批量生成
$kami_num = $_POST['num'];  
$point = $_POST['rmb']; 
//$k_qk = $_POST['qk']; 
$point1 =  $kami_num * $point ;
$point2 =  $member_point -  ($kami_num * $point) ;
   
 
 if ($kami_num>100)
 {		alert_href('生成失败:数量超出限制!','kami.php');  }

 if ($point>100)
 {		alert_href('生成失败:金额超出限制!','kami.php');  }


 
$pwdLen=26;
$c=$_POST['num'];//
  
 
$sNumArr=range(0,9);
$sPwdArr=array_merge($sNumArr,range('A','Z'));
 
$cards=array();
for($x=0;$x< $c;$x++){
 
$tempPwdStr=array();
for($i=0;$i< $pwdLen;$i++){
$tempPwdStr[]=$sPwdArr[array_rand($sPwdArr)];
}
 
$sql = "insert into ".flag."kami (kahao,point,date,zid,zt,fid)values('".implode($tempPwdStr)."','".$point."','".$sj."',".$zhu_id.",0,0)"; 
 mysql_query($sql,$conn);    

   }
 
		alert_href('生成成功!','kami.php');
 
}


 ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<script type="text/javascript" language="javascript">
    function selectBox(selectType){
    var checkboxis = document.getElementsByName("id[]");
    if(selectType == "reverse"){
      for (var i=0; i<checkboxis.length; i++){
        checkboxis[i].checked = !checkboxis[i].checked;
      }
    }
    else if(selectType == "all")
    {
      for (var i=0; i<checkboxis.length; i++){
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
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
   <div class="an-content-body" style="padding: 8px" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
                          <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        我的一卡通
                    </div>
                     <div class="panel-body">
                    <div class="list-group-item bg-grey" style="overflow: hidden;">
                      <form id="search_form" class="form-inline" method="get" role="form">
                            <input type="text" class="hidden" disabled>
                            <a data-toggle="modal" data-target="#modal-createKm" class="btn btn-danger purple">生成卡密</a>
                            <select   name="rmb" class="form-control">
                                <option  <? if ($_GET['rmb']==''){echo "selected";}?> value="">所有</option>
                                <option <? if ($_GET['rmb']==1){echo "selected";}?> value="1">1元</option>
                                <option <? if ($_GET['rmb']==5){echo "selected";}?> value="5">5元</option>
                                <option <? if ($_GET['rmb']==10){echo "selected";}?> value="10">10元</option>
                                <option <? if ($_GET['rmb']==20){echo "selected";}?> value="20">20元</option>
                                <option <? if ($_GET['rmb']==50){echo "selected";}?> value="50">50元</option>
                                <option <? if ($_GET['rmb']==100){echo "selected";}?> value="100">100元</option>
                                <option<? if ($_GET['rmb']==500){echo "selected";}?> value="500">500元</option>
                            </select>
                             <select    name="zt"  class="form-control">
                                <option <? if ($_GET['zt']==""){echo "selected";}?> value="">所有</option>
                                <option <? if ($_GET['zt']=='1'){echo "selected";}?> value="1">已充值</option>
                                <option <? if ($_GET['zt']=='0'){echo "selected";}?> value="0">未使用</option>
                            </select>
                                                        <div class="form-group">
                                <input type="text"  name="key" class="form-control" v-model="search.s" placeholder="输入要搜索的卡密">
                            </div>
                            <a class="btn btn-default purple"   onclick="document.getElementById('search_form').submit();return false"   ><i
                                    class="fa fa-search"></i> 搜索</a>
                            <div class="form-group" style="margin-left: 20px;">
                                     <a class="btn btn-danger"  href="?act=del&zt=1"  onclick="Javascript:return confirm('您确定要清空已使用的?');" >清空已使用</a>
                                <a class="btn btn-danger"   href="?act=del&zt=0" onclick="Javascript:return confirm('您确定要清空未使用的？');" >清空未使用</a>
                                
                                 <a class="btn btn-warning"    onclick="document.getElementById('subform').submit();return false"><i class="fa fa-trash"></i>批量删除</a>

                                                            </div>
                        </form>
                    </div>
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                    <form action="" method="post"  name="subform" id="subform">
                    <input name="act" type="hidden" value="pldel">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                                   <th style="width: 80px;">
                                
                                            <input type="checkbox" id="checkboxAll" class="checkbox-purple"
                                                 onClick="selectBox('reverse')"  >
                                  </th>

                                                                <th>卡密</th>
                                <th>面值</th>
                                <th>状态</th>
                                <th>使用者</th>
                                <th>使用时间</th>
                                <th>创建时间</th>
                                <th style="width: 50px;">操作</th>
                            </tr>
                            </thead>
                            <tbody id="kmList">
                            
                            	<?php
					if ($_GET['rmb']!='' and  $_GET['zt']!='' and  $_GET['key']!='' )	
					{$sql = 'select * from '.flag.'kami  where point = '.$_GET['rmb'].' and  zt = '.$_GET['zt'].' and key like "%'.$_GET['key'].'%"  and zid ='.$zhu_id.' and fid = 0  order by id desc , id desc';}

elseif ($_GET['rmb']!='' and  $_GET['zt']!='' and  $_GET['key']=='' )	
					{$sql = 'select * from '.flag.'kami  where point = '.$_GET['rmb'].' and  zt = '.$_GET['zt'].'  and zid ='.$zhu_id.'  and fid = 0 order by id desc , id desc';}
 elseif ($_GET['rmb']!='' and  $_GET['zt']=='' and  $_GET['key']=='' )	
					{$sql = 'select * from '.flag.'kami  where point = '.$_GET['rmb'].' and zid ='.$zhu_id.' and fid = 0  order by id desc , id desc';}
					
					elseif ($_GET['rmb']=='' and  $_GET['zt']!='' and  $_GET['key']=='' )	
					{$sql = 'select * from '.flag.'kami  where   zt = '.$_GET['zt'].'  and zid ='.$zhu_id.' and fid = 0  order by id desc , id desc';}
				 elseif ($_GET['rmb']=='' and  $_GET['zt']=='' and  $_GET['key']!='' )	
					{$sql = 'select * from '.flag.'kami  where   kahao like "%'.$_GET['key'].'%"  and zid ='.$zhu_id.' and fid = 0 order by id desc , id desc';}
				
					else
					
					{ 	$sql = 'select * from '.flag.'kami  where zid ='.$zhu_id.'  and fid = 0  order by id desc , id desc';}
									$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
									$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								 
							while($row= mysql_fetch_array($result)){
						
						 $key=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['kahao']);
  							?>
                              
                              <td>
                                
              <input type="checkbox" name="id[]" value="<?=$row['ID']?>"  >
                                                   
                                     
                                </td>

                            
                                                                <td><?=$key?></td>
                                <td><?=$row['point']?></td>
                                <td>
                                <? if ($row['zt']==0){?>
                                    <span class="text-success" v-if="parseInt(record.useid)===0">未使用</span>
                                    <? } else {?>
                                    <span class="text-danger" v-else>已充值</span>
                                    <? }?>
                                </td>
                                <td>
                                <? if($row['hyid']!='') {?>
								<?=$row['hyname']?>
                                    <span class="text-success" v-if="parseInt(record.useid)===0">-</span>
                                    <span class="text-danger" v-else> [编号:<?=$row['hyid']?></span>]
									<? }?>
                                </td>
                                <td><?=$row['cdate']?></td>
                                <td><?=$row['date']?></td>
                                <td>
                                    <a class="btn-xs btn-danger"   href="?act=del1&id=<?=$row['ID']?>"  onclick="Javascript:return confirm('您确定要删除所选卡密吗');"  ><i class="iconfont">&#xe632;</i></a>
                                </td>
                            </tr>
                            <? }?>
                            </tbody>
                            
                        </table>
                        </form>
                          <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                   <?php echo xiaoyewl_pape($pager[2],$pager[3],$pager[4],2);?> 
                 
                    
                    </ul></nav></div> 
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
    <div class="modal" id="modal-createKm">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>卡密生成</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="createKmForm" method="post">
                       
                        <div class="form-group" id="userRmbDiv">
                            <label class="col-sm-2 control-label no-padding-right">余额</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input class="form-control userRmb" value="<?=get_xiaoshu($site_point,6)?>" disabled>
                                    <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">数量</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" name="num" class="form-control" placeholder="输入生成卡密数量(1-50)"
                                           value="1">
                                    <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">面值</label>
                            <div class="col-sm-10">
                                <select name="rmb" class="form-control">
                                    <option value="1">1元</option>
                                    <option value="5">5元</option>
                                    <option value="10">10元</option>
                                    <option value="20">20元</option>
                                    <option value="50">50元</option>
                                    <option value="100">100元</option>
                                    <option value="500">500元</option>
                                </select>
                            </div>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <input name="提交" class="btn btn-primary"  type="submit" value="生成">
                 </div> </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-kmList">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>成功生成以下卡密</h4></div>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class="list-group-item" v-for="km in kmList">{{ km }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" @click="exportKm(kmIds)">导出</button>



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


?> 

 <? include_once('footer.php');
?></body>
</html>
