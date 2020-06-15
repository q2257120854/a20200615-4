<?php
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$site_name='数据统计';
$nav='count';
function get_czje($t0)
{
	$result = mysql_query('select sum(je) as sl1 from '.flag.'czjl  where zt = 1 and zid = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdczje($t0)
{
	$result = mysql_query('select sum(je) as sl1 from '.flag.'czjl  where day(pdate) = day(now()) and zt =1   and zid='.$t0.'');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}


function get_ordersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from  '.flag.'order where zid = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}

function get_tdayordersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'order  where day(date) = day(now()) and zid = '.$t0.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_membersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'user where zid = '.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdaymembersl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'user where day(date)  = day(now()) and zid = '.$t0.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}

function get_fenzhansl($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'fenzhan  where zid ='.$t0.'  ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdayfenzhan($t0)
{
	$result = mysql_query('select count(*) as sl1 from '.flag.'fenzhan  where day(date)  = day(now()) and zid = '.$t0.' ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_orderje($t0)
{
	$result = mysql_query('select sum(price) as sl1 from '.flag.'order  where zid = '.$t0.'   ');
	if (!!($row = mysql_fetch_array($result))) {
		return $row['sl1'];
	} else {
		return '0';
	}
}
function get_tdayorderje($t0)
{
	$result = mysql_query('select sum(price) as sl1 from '.flag.'order  where day(date)  =day(now())  and zid = '.$t0.'');
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
  <title><?=$site_name?>-乐购系统</title>
     <link rel="shortcut icon" href="<?=$site_ico?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/common/md5.min.js"></script>
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
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-blue">网站数据统计</div>
                    <div class="panel-body">
                        <div class="list-group-item list-group-item-info">全部销售订单数：<?=get_ordersl($zhu_id)?></div>
                        <div class="list-group-item list-group-item-success">全部注册客户数：<?=get_membersl($zhu_id)?></div>
                        <div class="list-group-item list-group-item-success">全部搭建分站数：<?=get_fenzhansl($zhu_id)?></div>
                        <div class="list-group-item list-group-item-danger">全部下单金额数：<?=get_orderje($zhu_id)?> 元</div>
                        <div class="list-group-item list-group-item-danger">全部充值金额数：<?=get_czje($zhu_id)?>元</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-blue">今日数据统计</div>
                    <div class="panel-body">
                        <div class="list-group-item list-group-item-info">今日销售订单数：<?=get_tdayordersl($zhu_id)?></div>
                        <div class="list-group-item list-group-item-success">今日注册客户数：<?=get_tdaymembersl($zhu_id)?></div>
                        <div class="list-group-item list-group-item-success">今日搭建分站数：<?=get_tdayfenzhan($zhu_id)?></div>
                        <div class="list-group-item list-group-item-danger">今日下单金额数：<?=get_tdayorderje($zhu_id)?> 元</div>
                        <div class="list-group-item list-group-item-info">今日充值金额数：<?=get_tdczje($zhu_id)?> 元</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once( 'footer.php'); ?>
 </body>
</html>
