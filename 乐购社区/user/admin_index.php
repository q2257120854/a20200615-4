<?php 
 $title=''; 
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
    <title>管理首页-<?=$site_name?></title>
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
            
<div class="row">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-green">站点基本信息</div>
                                <div class="panel-body">
                                    <div class="list-group-item list-group-item-success">站点版本： <span class="btn-xs btn-danger"><?=$site_banben?>(分站)</span><? if($site_banben!='旗舰版'){?>
									<a class="btn-xs btn-success" data-toggle="modal" data-target="#modal-xf">升级</a><? }?>
                                    </div>
                                    <div class="list-group-item list-group-item-success">绑定域名：<a href="http://<?=$site_burl?>"><?=$site_burl?></a> 
                         	<?php
							
 					$result = mysql_query('select * from  '.flag.'fenzhan_domain where zid='.$zhu_id.'  and fid = '.$fen_id.'  order by ID  DESC');
					while ($row = mysql_fetch_array($result)){
						echo '<a href="http://'.$row['name'].'" target="_blank" >'.$row['name']. '</a>,';
					}
					?>
                                        <a href="http://"></a>
                                    </div>
                                    <div class="list-group-item list-group-item-success">开通时间：<?=$site_date?>  </div>
									<div class="list-group-item list-group-item-danger">到期时间：<?=$site_ddate?>                   </div>
                                    <div class="list-group-item list-group-item-info">分站额度：  
					   <?=get_fenzhan_banben_name(1)?> <span class="text-success"><?=$site_fed1?></span> 个 
					   <?=get_fenzhan_banben_name(2)?> <span class="text-success"><?=$site_fed2?></span> 个 
					   <?=get_fenzhan_banben_name(3)?> <span class="text-success"><?=$site_fed3?></span> 个 <a class="btn-xs btn-success" data-toggle="modal" data-target="#modal-buyPE">购买</a>
                                    </div>
                                    <!--<div class="list-group-item list-group-item-info">域名额度：<span class="text-success">0</span> 个 <a class="btn-xs btn-success" data-toggle="modal" data-target="#modal-ed" @click="ed=9">购买</a>
                                    </div>-->
                                    <div class="list-group-item list-group-item-success">APP权限： 有</div>
                                    <div class="list-group-item list-group-item-warning">可提现站长余额：<?=get_xiaoshu($site_point,6)?> 元(这个和你用户余额不是同一个哦) <a href="tx.php" class="btn-xs btn-info">提现</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
	

<div class="col-lg-6">
    <div class="panel">
        <div class="panel-heading bg-gradient-green">网站后台公告</div>
        <div class="panel-body">
            <div class="list-group-item list-group-item-success">
                <?=$site_fnotice?>
            </div>
        </div>
    </div>
</div>
</div>

<div id="vue-page">
    <div class="row">
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading bg-gradient-vine">
                    网站数据统计
                        </div>
                <div class="panel-body">
                        <div class="list-group-item list-group-item-info">
                            全部销售订单数：<?=get_ordersl($zhu_id,$fen_id)?>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            全部注册客户数：<?=get_membersl($zhu_id,$fen_id)?>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            全部搭建分站数：0
                        </div>
                        <div class="list-group-item list-group-item-success">
                            全部下单金额数：<?=get_orderje($zhu_id,$fen_id)?> 元
                        </div>
                        <div class="list-group-item list-group-item-success">
                            全部充值金额数：<?=get_czje()?>元
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading bg-gradient-vine">
                    <span class="btn-xs btn-primary" @click="day=0">今日</span></span> 数据统计
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
	                        </span>
                </div>
                <div class="panel-body">
                        <div class="list-group-item list-group-item-info">
                            今日销售订单数：<?=get_tdayordersl($zhu_id,$fen_id)?>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            今日注册客户数：<?=get_tdaymembersl($zhu_id,$fen_id)?>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            今日搭建分站数：<?=get_tdayfenzhan()?>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            今日下单金额数：<?=get_tdayorderje($zhu_id,$fen_id)?> 元
                        </div>
                        <div class="list-group-item list-group-item-success">
                            今日充值金额数：<?=get_tdczje($zhu_id,$fen_id)?> 元
                        </div>
                    </div>
                     
                </div>
            </div>
    </div>

    <div class="modal" id="modal-xf">
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <div class="modal-title"><h4>分站升级</h4></div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal"  method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">站长余额</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input class="form-control" value="<?=get_xiaoshu($site_point,6)?>" disabled>
                                    <span class="input-group-addon">元</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right">选择</label>
                            <div class="col-sm-10">
                                    <select name="fid" class="form-control">
                                <option value="1">
                                    <?=get_fenzhan_banben_name(1)?>(<?=$site_fprice1?>元/个)
                                </option>
                                 <option value="2">
                                    <?=get_fenzhan_banben_name(2)?>(<?=$site_fprice2?>元/个)
                                </option>
                                  <option value="3">
                                    <?=get_fenzhan_banben_name(3)?>(<?=$site_fprice3?>元/个)
                                </option> 
                                
                            </select>
                                
                            </div>
                        </div>
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <input name="提交" class="btn btn-primary" type="submit" value="升级">
                </div>
                  </form>
            </div>
        </div>
    </div>
</div>

        </div>
    </div><!-- /main-container -->

 <? include('footer.php');
?>
</div><!-- /wrapper -->

<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>

<div class="modal" id="modal-profile">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>个人资料</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  method="post"   >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$a_name?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">编号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$a_id?>"
                            disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">QQ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="qq" value="<?=$a_qq?>"
                                   onkeyup="value=value.replace(/[^\d\/]/ig,'')" placeholder="输入QQ号">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">修改密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="pwd" placeholder="不修改则留空">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <input name="提交" class="btn btn-primary" type="submit" value="保存">
             </div>
              </form>
        </div>
    </div>
</div>


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
<div class="modal" id="modal-buyYMPE">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>购买域名额度</h4></div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="buyYMPEForm">
                                        <div class="form-group">
                        <label class="col-lg-3 control-label">站长余额</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="1.888760" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">选择</label>
                        <div class="col-lg-8">
                            <select name="kind" class="form-control">
                                <option value="0">
                                    域名额度[剩余1个](5                                    元/个)
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="buyYMPE_btn">购买</button>
            </div>
        </div>
    </div>
</div>

 
 

 </body>
</html>
