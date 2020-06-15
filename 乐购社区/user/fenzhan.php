<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
 if ($_POST['修改密码'] =='保存')
{
 	$_data['qq'] = $_POST['qq'];
	if ($_POST['pwd']!= '')
	{$_data['loginpassword'] = $_POST['pwd'];}
//$_data['c_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$fen_id.'';
	if(mysql_query($sql)){
		alert_href('修改成功!','');
	}else{
		alert_back('修改失败!');
	}
	
}


 
if ($_POST['提交'] =='升级')
{
 		if ($_POST['fid']<1)
 { 		alert_href('非法操作!',''); }
 		if ($_POST['fid']>3)
 { 		alert_href('非法操作!',''); }

 		if ($_POST['fid']<=$dqbanben)
 { 		alert_href('非法操作:不能降级!',''); }
 
 if ($_POST['fid']==1)
 {$fprice=$site_fprice1;}
 if ($_POST['fid']==2)
 {$fprice=$site_fprice2;}
 if ($_POST['fid']==3)
 {$fprice=$site_fprice3;}

  
  if ($fprice <= 0)
{ 		alert_href('升级失败:价格异常!',''); }

 if ($site_point < $fprice)

{ 		alert_href('升级:您的余额不足支付'.$fprice.'元请充值!',''); }

else
{
	
 	
	//扣除余额+改变版本
 	$_data['banben'] = $_POST['fid'];
 	$_data['point'] = $site_point-$fprice;
	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$fen_id.' ';
	if(mysql_query($sql)){
		//余额记录
	$_data1['zid'] = $zhu_id;
	$_data1['fid'] = $fen_id;
	$_data1['qje'] = $site_point;
	$_data1['je'] = $fprice;
 	$_data1['hje'] = $site_point-$fprice;
 	$_data1['date'] = $sj;
 	$_data1['desc'] = '版本升级';
 	$_data1['lx'] = 0;
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'fenzhanpricejl  ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);
  
 
		alert_href('升级成功!','');
	}else{
		alert_back('升级失败!');
	}
		}
}


 

if ($_POST['分站'] =='购买')
{
	
	if ($_POST['peie']<=0)

{ 		alert_href('购买失败:购买数量不能低于1!',''); }

 	
	if ($_POST['fid']==1)
	{
		$fxfprice =$_POST['peie']*$site_fprice1;
		$yedu = $site_fed1;
		}
	elseif ($_POST['fid']==2)
	{$fxfprice =$_POST['peie']*$site_fprice2;
			$yedu = $site_fed2;
}
	elseif ($_POST['fid']==3)
	{$fxfprice =$_POST['peie']*$site_fprice3;
			$yedu = $site_fed3;
}	
	
	   	non_numeric_back($_POST['peie'],'请输入购买个数');
if ($fxfprice <= 0)
{ 		alert_href('购买失败:价格异常!',''); }
 		
if ($site_point < $fxfprice)

{ 		alert_href('购买失败:您的余额不足支付'.$fxfprice.'元请充值!',''); }

else
{
	
 if ($_POST['fid']==1)	
 {	$_data['fed1'] =$site_fed1+$_POST['peie']  ;}
 elseif ($_POST['fid']==2)	
 {	$_data['fed2'] =$site_fed2+$_POST['peie']  ;}
 elseif ($_POST['fid']==3)	
 {	$_data['fed3'] =$site_fed3+$_POST['peie']  ;} 
  
  	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$fen_id.'';
	if(mysql_query($sql)){
		//余额记录
	$_data1['zid'] = $zhu_id;
	$_data1['fid'] = $fen_id;

	$_data1['qje'] = $site_point;
	$_data1['je'] = $fxfprice;
 	$_data1['hje'] = $site_point-$fxfprice;
 	$_data1['date'] = $sj;
 	$_data1['desc'] = '购买'.get_fenzhan_banben_name($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_data1['lx'] = 0;
   	$str1 = arrtoinsert($_data1);
	$sql1 = 'insert into '.flag.'fenzhanpricejl ('.$str1[0].') values ('.$str1[1].')';
    mysql_query($sql1);


		//额度记录
	$_data3['zid'] = $zhu_id;
	$_data3['fid'] = $fen_id;
 	{$_data3['qsl'] = $yedu;}		
	$_data3['sl'] = $_POST['peie'];
 	$_data3['hsl'] = $yedu+$_POST['peie'];
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '购买'.get_fenzhan_banben_name($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_data3['lx'] = 1; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'fedu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	
	//扣除余额
 	$_data2['point'] = $site_point-$fxfprice;
   	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'fenzhan set '.arrtoupdate($_data2).' where id = '.$fen_id.'';
     mysql_query($sql2);


//主站扣除额度
	
 if ($_POST['fid']==1)	
 {	$_zhudata['fed1'] =get_zhuzhan('fed1',$zhu_id)-$_POST['peie']  ;}
 elseif ($_POST['fid']==2)	
 {	$_zhudata['fed2'] =get_zhuzhan('fed2',$zhu_id)-$_POST['peie']  ;}
 elseif ($_POST['fid']==3)	
 {	$_zhudata['fed3'] =get_zhuzhan('fed3',$zhu_id)-$_POST['peie']  ;} 
  	$zhusql = 'update '.flag.'zhuzhan set '.arrtoupdate($_zhudata).' where id = '.$zhu_id.'';
	if(mysql_query($zhusql)){
  

		//额度记录
	$_zdata3['zid'] = $zhu_id;
		
 if ($_POST['fid']==1)	
 {	$_zdata3['qsl'] =get_zhuzhan('fed1',$zhu_id)  ;}
 elseif ($_POST['fid']==2)	
 {	$_zdata3['qsl'] =get_zhuzhan('fed2',$zhu_id)  ;}
 elseif ($_POST['fid']==3)	
 {	$_zdata3['qsl'] =get_zhuzhan('fed3',$zhu_id)  ;} 


	
 if ($_POST['fid']==1)	
 {	$_zdata3['hsl'] =get_zhuzhan('fed1',$zhu_id)-$_POST['peie']  ;}
 elseif ($_POST['fid']==2)	
 {	$_zdata3['hsl'] =get_zhuzhan('fed2',$zhu_id)-$_POST['peie']  ;}
 elseif ($_POST['fid']==3)	
 {	$_zdata3['hsl'] =get_zhuzhan('fed3',$zhu_id)-$_POST['peie']  ;} 
	
 	$_zdata3['sl'] = $_POST['peie'];
	
 	$_zdata3['date'] = $sj;
 	$_zdata3['desc'] = '分站开通'.get_fenzhan_banben_name($_POST['fid']).'分站额度'.$_POST['peie'].'个';
 	$_zdata3['lx'] = 0; //1=增加 0=扣除
   	$zstr3 = arrtoinsert($_zdata3);
	$zsql3 = 'insert into '.flag.'edu ('.$zstr3[0].') values ('.$zstr3[1].')';
    mysql_query($zsql3);
	
	
	}
		alert_href('购买成功!','');
	}else{
		alert_back('购买失败!');
	}
		}
}


$nav='home'; 

function get_czje()
{
	$result = mysql_query('select sum(je) as sl1 from '.flag.'czjl  where cz_zt = 1  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdczje($t0,$t1)
{
	$result = mysql_query('select sum(je) as sl1 from '.flag.'czjl  where day(pdate) = day(now()) and zt =1  and zid = '.$t0.' and fid = '.$t1.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}


function get_ordersl($t0,$t1)
{
	$result = mysql_query('select count(*) as sl1 from  '.flag.'order where zid = '.$t0.'  and fid = '.$t1.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}

function get_tdayordersl($t0,$t1)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'order  where day(date) = day(now()) and zid = '.$t0.'  and fid = '.$t1.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_membersl($t0,$t1)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'user where zid = '.$t0.'   and fid = '.$t1.'   ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdaymembersl($t0,$t1)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'user where day(date)  = day(now()) and zid = '.$t0.' and fid = '.$t1.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}

function get_fenzhansl()
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'fenzhan   ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdayfenzhan()
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'fenzhan  where day(f_date)  = day(now()) ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_orderje($t0,$t1)
{
	$result = mysql_query('select sum(price) as sl1 from '.flag.'order  where zid = '.$t0.' and fid = '.$t1.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return 0;
	}
}
function get_tdayorderje($t0,$t1)
{
	$result = mysql_query('select sum(price) as sl1 from '.flag.'order  where day(date)  =day(now())  and zid = '.$t0.' and fid = '.$t1.'');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}


 
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>分站列表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    
    <link rel="shortcut icon" href="assets/favicon.ico"/>
    <!-- Jquery -->
    <script src="assets/style/js/jquery-1.11.1.min.js"></script>
    <script src="assets/common/md5.min.js"></script>
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
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
  <div id="vue-page">
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-widget widget-purple">
                <div class="panel-heading bg-gradient-vine">
                    分站列表
                    <span class="smart-widget-option">
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
                    
                        
                  <div class="list-group-item bg-grey" style="overflow: hidden;">
<form id="search_form"  name="search_form" class="form-inline" method="get"> 
 
                            
                              <div class="form-group">
                                                                <a href="fenzhan_add.php" class="btn btn-success purple"><i class="fa fa-plus"></i> 新增</a>
                                <a data-toggle="modal" data-target="#modal-buyPE" class="btn btn-info purple"><i
                                        class="fa fa-cart-plus"></i> 购买分站额度</a>
                               
                                  <a data-toggle="modal" data-target="#modal-changePE" class="btn btn-info purple"><i
                                        class="fa fa-share-alt"></i> 划拨分站额度</a>

                    </div>


                      <div class="form-group"><input   style="width:250px" type="text" name="key" placeholder="分站名称/分站编号/分站域名" class="form-control"></div>
                              
                               <a onclick="document:search_form.submit();"  class="btn btn-default purple"><i class="fa fa-search"></i> 搜索</a></form>                    </div>
                    
                    
                    <div class="smart-widget-body table-responsive" style="overflow-y: hidden;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>分站编号</th>
                              <th>分站版本</th>
                                <th>分站名称</th>
                                <th>分站域名</th>
                                <th>分站余额</th>
                                <th>分站额度</th>
                                <th>分站状态</th>
                                <th>开通时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php
						 
  if (  $_GET['key'] !=''   )
					 {	$sql = 'select * from '.flag.'fenzhan  where   name like "%'.$_GET['key'].'%"   and zid ='.$zhu_id.'   or  ID like "%'.$_GET['key'].'%" and upid = '.$fen_id.'   and zid ='.$zhu_id.'     or  url like "%'.$_GET['key'].'%"  and upid = '.$fen_id.'  and zid ='.$zhu_id.'    or  url1 like "%'.$_GET['key'].'%" and upid = '.$fen_id.'   and zid ='.$zhu_id.'    or  qq like "%'.$_GET['key'].'%" and upid = '.$fen_id.'   and zid ='.$zhu_id.'  order by ID desc , ID desc';}


						 else
								{	$sql = 'select * from '.flag.'fenzhan   where zid = '.$zhu_id.' and upid = '.$fen_id.' order by ID desc , ID desc';}

 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
						 $f_name=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['name']);
						 $f_qq=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['qq']);
						 $f_id=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['ID']);
						 $f_url=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['url']);
						 
 							?>
                              <tr>
                                <td><?=$f_id?></td>
                                <td>
								   <? if ($row['banben']==1){ $banbenclass='btn-xs btn-info';}?>
                                    <? if ($row['banben']==2){ $banbenclass='btn-xs bg-purple';}?>
                                    <? if ($row['banben']==3){ $banbenclass='btn-xs bg-danger';}?>
                                 
                                 <a class="<?=$banbenclass?>"  ><?=get_fenzhan_banben_name($row['banben'])?></a></td>
                                <td><a   ><?=$f_name?> </a></td>
                                <td>
                                
                                 <?
   $result1 = mysql_query('select * from '.flag.'fenzhan_domain  where zid ='.$zhu_id.'  and  fid ='.$row['ID'].'  order by ID asc  ');
						while($row1 = mysql_fetch_array($result1)){
 						?>
                        <?=$row1['name'];?>
                        <? if ($row['name']=='分站开启删除域名模式'){?>
                        <a  href="?act=ymdel&id=<?=$row1['ID']?>" onclick="return confirm('确定删除<?=$row1['name'];?>?')"? >删</a>
                        <? }?>
                        <?
 						}
							?>
                            
                            </td>
                                <td><a  class="btn-xs btn-info">  <?=$row['point']?></a></td>
                                <td><a ><?=$row['fed1']?>,<?=$row['fed2']?>,<?=$row['fed3']?></A></td>
                                <td><? if ($row['zt']==1){?>
                                  <i class="fa fa-unlock text-success" title="启用中"></i>
                                  <? } else {?>
                                  <i class="fa fa-lock text-danger" title="停止"></i>
                                <? }?></td>
                                <td><?=$row['date']?>&nbsp;</td>
                                <td>
                                <? if ($row['banben'] != 3) {?>
                                   <a class="btn-xs btn-warning"   href="fenzhan_sj.php?id=<?=$row['ID']?>" >升级</a>
<? }?>

            <a class="btn-xs btn-success"   href="fenzhan_detail.php?id=<?=$row['ID']?>">资料</a>
                                                                      
                                                                      
                                             <a   style="display:none" class="btn-xs btn-warning"   href="fenzhan_tx.php?id=<?=$row['ID']?>"
                                        >提现账号</a>                                 
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

    <div class="modal" id="modal-sort">
        <div class="modal-dialog"></div>
    </div>
    <div class="modal" id="modal-add">
        <div class="modal-dialog"></div>
    </div>
   



        </div>
    </div><!-- /main-container -->


 
<div class="modal" id="modal-buyPE">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>购买分站额度</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"   method="POST" id="buyPEForm">
                                        <div class="form-group">
                        <label class="col-lg-3 control-label">站长余额</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="<?=get_xiaoshu($site_point,6)?>" disabled>
                        </div>
                    </div>
                     
                        
                        
                    <div class="form-group"   >
                        <label class="col-lg-3 control-label">选择</label>
                        <div class="col-lg-8">
                            <select name="fid" class="form-control">
                                <option value="1">
                                    <?=get_fenzhan_banben_name(1)?>[剩余<?=$site_fed1?>个](<?=$site_fprice1?>元/个)
                                </option>
                                 <option value="2">
                                    <?=get_fenzhan_banben_name(2)?>[剩余<?=$site_fed2?>个](<?=$site_fprice2?>元/个)
                                </option>
                                  <option value="3">
                                    <?=get_fenzhan_banben_name(3)?>[剩余<?=$site_fed3?>个](<?=$site_fprice3?>元/个)
                                </option> 
                                
                            </select>
                        </div>
                    </div>
                                        <div class="form-group">
                        <label class="col-lg-3 control-label">购买个数</label>
                        <div class="col-lg-8">
                            <input type="number" class="form-control" name="peie" placeholder="输入购买个数" value="1">
                        </div>
                    </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <input name="分站" class="btn btn-primary" type="submit" value="购买">
            </div>
               </form>
        </div>
    </div>
 </div>
 
 
 

<?

  if ($_POST['分站额度']=='确定'  and  $_POST['type']==1)


{
	 null_back($_POST['fid'],'请输入分站编号');
	 null_back($_POST['peie'],'请输入划拨个数');
if ($_POST['kind']>3)
 {		alert_back('非法操作!'); }
if ($_POST['kind']<1)
 {		alert_back('非法操作!'); }
 
 if ($_POST['peie']<1)
 {		alert_back('非法操作!'); }

 

if ($_POST['kind']==1)
{$fed =$site_fed1;}
if ($_POST['kind']==2)
{$fed =$site_fed2;}
if ($_POST['kind']==3)
{$fed =$site_fed3;}

if ($_POST['peie'] >$fed )

 {		alert_back('划拨失败:额度不足!'); }

   $result = mysql_query('select * from '.flag.'fenzhan  where  ID = "'.$_POST['fid'].'" and zid = '.$zhu_id.' ');
if ($row = mysql_fetch_array($result))
{ 

//额度记录
	$_data3['zid'] = $zhu_id;
	$_data3['fid'] = $fen_id;
 	{$_data3['qsl'] = $yedu;}		
	$_data3['sl'] = $_POST['peie'];
 	$_data3['hsl'] = $yedu+$_POST['peie'];
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '划拨额度给用户:'.$_POST['fid'].''.$_POST['peie'].'个';
 	$_data3['lx'] = 0; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	
	//扣除额度
if ($_POST['kind']==1)	
 	{$_data2['fed1'] = $fed-$_POST['peie'];}
if ($_POST['kind']==2)	
 	{$_data2['fed2'] = $fed-$_POST['peie'];}
if ($_POST['kind']==3)	
 	{$_data2['fed3'] = $fed-$_POST['peie'];}
    	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'fenzhan set '.arrtoupdate($_data2).' where id = '.$fen_id.'';
     mysql_query($sql2);

 
	//增加用户额度
if ($_POST['kind']==1)	
 	{$_data2['fed1'] = $row['fed1']+$_POST['peie'];}
if ($_POST['kind']==2)	
 	{$_data2['fed2'] = $row['fed2']+$_POST['peie'];}
if ($_POST['kind']==3)	
 	{$_data2['fed3'] = $row['fed3']+$_POST['peie'];}
    	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'fenzhan set '.arrtoupdate($_data2).' where id = '.$_POST['fid'].' and zid = '.$zhu_id.'';
     mysql_query($sql2);
 		alert_href('划拨成功!','fenzhan.php');
	  }  
else
 {		alert_back('划拨失败:分站不存在!'); }
}
 
  if ($_POST['分站额度']=='确定'  and  $_POST['type']==0)

{
	
 	  $result = mysql_query('select * from '.flag.'fenzhan  where  ID = "'.$_POST['fid'].'" and zid = '.$zhu_id.' ');
if ($row = mysql_fetch_array($result))
{ 

 	//扣除用户额度
if ($_POST['kind']==1)	
 	{$_data2['fed1'] = $row['fed1']-$_POST['peie'];}
if ($_POST['kind']==2)	
 	{$_data2['fed2'] = $row['fed2']-$_POST['peie'];}
if ($_POST['kind']==3)	
 	{$_data2['fed3'] = $row['fed3']-$_POST['peie'];}
    	$str2 = arrtoinsert($_data2);
	$sql2 = 'update '.flag.'fenzhan set '.arrtoupdate($_data2).' where id = '.$_POST['fid'].' and zid = '.$zhu_id.' ';
     mysql_query($sql2);
 		alert_href('扣除额度成功!','fenzhan.php');
	  }  
else
 {		alert_back('划拨失败:分站不存在!'); }
 
}
?>
   <div class="modal" id="modal-changePE">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>分站额度划拨</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal"  method="post" id="changePEForm">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">额度类型</label>
                            <div class="col-lg-8">
                                <select name="kind" class="form-control">
                                    <option value="1"><?=get_fenzhan_banben_name(1)?>[剩余<?=$site_fed1?>个]</option>
                                    <option value="2"><?=get_fenzhan_banben_name(2)?>[剩余<?=$site_fed2?>个]</option>
                                    <option value="3"><?=get_fenzhan_banben_name(3)?>[剩余<?=$site_fed3?>个]</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label no-padding-right">操作类型</label>
                            <div class="col-lg-8">
                                <select name="type" class="form-control">
                                    <option value="1">添加</option>
                                                                        <option value="0">扣除</option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label no-padding-right">分站编号</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" name="fid" placeholder="输入分站编号"
                                       @change="getPeie()">
                            </div>
                        </div>
                     
                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">划拨个数</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" name="peie" placeholder="输入划拨额度个数" value="1">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <input name="分站额度" type="submit"   class="btn btn-primary" value="确定">
                 </div>
                
                
            </div>  </form>
        </div>
    </div>



<?  include('password.php');?>
 
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
 </body>
</html>
