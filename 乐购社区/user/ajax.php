<?php
require_once '../system/inc.php';
include '../data/function.php';
//获取下单模板
function getmoban($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'moban where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '';
    }
}
function alert_json($t0, $t1)
{
    die('{"code":' . $t1 . ',"message":"' . $t0 . '","url":""}');
}
//空值返回
function null_alertjson($t0, $t1)
{
    if ($t0 == '') {
        alert_json($t1, -1);
    }
}
function non_numeric_alertjson($t0, $t1)
{
    if (!is_numeric($t0) || $t0 < 0) {
        alert_json($t1, -1);
    } else {
        return true;
    }
}
$xiaoyewl_act = $_GET['act'];
switch ($xiaoyewl_act) {
	case 'checku':
	$sel = "select * from  " . flag . "user where ID = '" . $_POST['zuid'] . "'  and zid = " . $zhu_id . " ";
	$sl = @mysql_query($sel);
    $s = @mysql_fetch_array($sl);
	if (is_array($s)) {
	$a_name = $s['name'];
	$a_password = $s['password'];
	$code=0;
	$msg='获取成功';
	$date=array('uid'=>$_POST['zuid'],'username'=>"$a_name");
	}else{
	$code=1;
	$msg='不存在该用户';
	}
	$result=array("status"=>$code,"message"=>"$msg","date"=>$date);
die(json_encode($result));
	break;
}