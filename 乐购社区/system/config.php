<?php
date_default_timezone_set('PRC');
//获取当前IP
function xiaoyewl_ip()
{
    global $ip;
    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else {
            if (getenv("REMOTE_ADDR")) {
                $ip = getenv("REMOTE_ADDR");
            } else {
                $ip = "Unknow";
            }
        }
    }
    return $ip;
}
//获取当前时间
$sj = date("Y-m-d H:i:s", intval(time()));
//获取当前域名
$dq_url = $_SERVER['SERVER_NAME'];
//获取域名前缀
$child_addr = explode('.', $_SERVER['HTTP_HOST']);
$child_addr = $child_addr[0];
$fenzhan_row = null;
$qz_url = $child_addr;
function gonghuologin($t0, $t1, $t2)
{
    $result = mysql_query('select *   from  ' . flag . 'user where name ="' . $t0 . '" and password  ="' . md5($t1) . '"  and zid = ' . $t2 . '   and gh = 1   ');
    if (!!($row = mysql_fetch_array($result))) {
      
      	$_SESSION['gadmin_check'] = $row['name'];
        return alert_href('登录成功', './Supplier_Index.php');
    } else {
        return alert_href('用户名或密码不正确!', './');
    }
}
//系统信息
$result = mysql_query('select * from ' . flag . 'set  where  ID =1 ');
$row = mysql_fetch_array($result);
$site_notice = $row['notice'];
$site_zfms = $row['zfms'];
$site_zfid = $row['zfid'];
$site_zfkey = $row['zfkey'];
$site_shanghuurl = $row['shanghuurl'];
$site_shanghuid = $row['shanghuid'];
$site_shanghukey = $row['shanghukey'];
$site_shanghuzt = $row['shanghuzt'];
$site_shanghumoney = $row['shanghumoney'];
$allowzd = $row['allowzd'];
$sqname = '宝乐云';
if ($site_zfms == 'zfb') {
    $payurl = '/alipay/alipayapi.php';
} elseif ($site_zfms == 'yzf') {
    $payurl = '/sdk/epayapi.php';
}
//根据域名查询主站
$result = mysql_query('select * from ' . flag . 'zhuzhan_domain  where  name = "' . $dq_url . '" ');
if ($row = mysql_fetch_array($result)) {
    $zhu_id = $row['zid'];
    $zhu = 'true';
} else {
    $zhu = 'flash';
}
//根据域名查询分站
if ($zhu == 'flash') {
    $result = mysql_query('select * from ' . flag . 'fenzhan_domain  where  name = "' . $dq_url . '" ');
    if ($row = mysql_fetch_array($result)) {
        $zhu_id = $row['zid'];
        $fen_id = $row['fid'];
        $fen = 'true';
    } else {
        $fen = 'flash';
    }
}
//抽奖信息
//主站相关信息
    $result = mysql_query('select * from ' . flag . 'zhuzhan  where  ID = ' . $zhu_id . ' ');
    $row = mysql_fetch_array($result);
	$cjprice=$row['cjprice'];
	$cjzt=$row['cjzt'];
if ($zhu == 'true') {
    //主站相关信息
    $result = mysql_query('select * from ' . flag . 'zhuzhan  where  ID = ' . $zhu_id . ' ');
    $row = mysql_fetch_array($result);
    $site_zt = $row['zt'];
    $site_gonghuo = explode(',', $row['gh']);
    $site_regmb = $row['moban_reg'];
    $site_zfms = $row['zfms'];
	$sitenotice = $row['notice'];
    //
    $site_shurl = $row['shurl'];
    //
    $site_shid = $row['shid'];
    //
    $site_shkey = $row['shkey'];
    //
    $site_moban1 = $row['moban1'];
    //
    $site_moban2 = $row['moban2'];
    //
    $site_moban3 = $row['moban_login'];
    //
    $site_sjmb = $row['sjmb'];
    //
    if ($site_sjmb == '') {
        $site_sjmb = '01';
    }
	$site_jkms = $row['jkms'];
	$klms = $row['kelongkey'];
	$site_jkcid = explode(',',$row['pricejk']);
    $site_banben = get_zhuzhan_banben_name($row['banben']);
    $site_qx = get_zhuzhan_banben_qx($row['banben']);
    $site_price = get_zhuzhan_banben_price($row['banben']);
    //主站续费价格
    $site_fnotice = $row['fnotice'];
    //分站公告
    $site_url1 = $row['url'];
    $site_url2 = $row['url1'];
    $site_isktfz = $row['isktfz'];
    $site_ispay = $row['ispay'];
    $site_isktdl = $row['isktdl'];
    $site_point = $row['point'];
    $site_czsxf = $row['czsxf'];
    $site_txsxf = $row['txsxf'];
    $site_txfs = $row['txfs'];
    $site_txzh = $row['txzh'];
    $site_txxm = $row['txxm'];
    $site_ico = $row['ico'];
    $site_skin = 'template/index/' . $row['moban1'] . '/';
    $site_skin1 = $row['moban1'];
    $site_name = $row['name'];
    $site_sname = $row['sname'];
    $site_gg = $row['tcnotice'];
    $site_key = $row['key'];
    $site_des = $row['des'];
    $site_bj = $row['background'];
    $site_topcolor = $row['topcolor'];
    $site_endcolor = $row['endcolor'];
    $site_content = $row['bqcontent'];
    $site_content1 = $row['endcontent'];
    $site_mid = $row['mid'];
    $site_level1_name = $row['level1_name'];
    $site_level2_name = $row['level2_name'];
    $site_level3_name = $row['level3_name'];
    $site_level4_name = $row['level4_name'];
    $site_level5_name = $row['level5_name'];
    $site_level1_price = $row['level1_price'];
    $site_level2_price = $row['level2_price'];
    $site_level3_price = $row['level3_price'];
    $site_level4_price = $row['level4_price'];
    $site_level5_price = $row['level5_price'];
    $a_qq = $row['qq'];
    $a_name = $row['loginname'];
    $a_password = $row['loginpassword'];
    $site_fed1 = $row['fed1'];
    $site_fed2 = $row['fed2'];
    $site_fed3 = $row['fed3'];
    $ymed = $row['ymed'];
    $site_fprice1 = $row['fprice1'];
    $site_fprice2 = $row['fprice2'];
    $site_fprice3 = $row['fprice3'];
    $site_zfprice1 = get_zhuzhan_banben_info('fprice1', $row['banben']);
    $site_zfprice2 = get_zhuzhan_banben_info('fprice2', $row['banben']);
    $site_zfprice3 = get_zhuzhan_banben_info('fprice3', $row['banben']);
    $site_date = $row['date'];
    $site_ddate = $row['ddate'];
    $fxid = $row['fxid'];
	$site_dh =$row['dh'];//导航
	if($fxid != 1){
$resultxy = mysql_query('select * from ' . flag . 'admin  where  ID ='.$fxid.' ');
$rowxy = mysql_fetch_array($resultxy);
if($rowxy['notice']!=''){
$site_notice = $rowxy['notice'];
}
if($rowxy['sqname']!='' and $rowxy['qx']>0){
$sqname = $rowxy['sqname'];
}
	}
} else {
    //主站发布的公告
    $result = mysql_query('select * from ' . flag . 'zhuzhan  where  ID = ' . $zhu_id . ' ');
    $row = mysql_fetch_array($result);
    $site_fnotice = $row['fnotice'];
    //分站公告
    //分站相关信息
    $result = mysql_query('select * from ' . flag . 'fenzhan  where  ID = ' . $fen_id . ' ');
    $row = mysql_fetch_array($result);
    $site_zt = $row['zt'];
   $up_id = $row['upid'];
    $dqbanben = $row['banben'];
    $site_regmb = $row['moban_reg'];
    $site_moban1 = $row['moban1'];
    //
    $site_moban2 = $row['moban2'];
    //
    $site_moban3 = $row['moban3'];
    //
    $site_sjmb = $row['sjmb'];
    //
    if ($site_sjmb == '') {
        $site_sjmb = '01';
    }
	$site_dh =$row['dh'];//导航
    $site_regmb = $row['moban_reg'];
    $site_moban3 = $row['moban_login'];
    //
    $site_zfms = get_zhuzhan('zfms', $row['zid']);
    //
    $site_shurl = get_zhuzhan('shurl', $row['zid']);
    //$row['shurl'];//
    $site_shid = get_zhuzhan('shid', $row['zid']);
    //$row['shid'];//
    $site_shkey = get_zhuzhan('shkey', $row['zid']);
    //$row['shkey'];//
    $site_czsxf = get_zhuzhan('czsxf', $row['zid']);
    $site_banben = get_fenzhan_banben_name($row['banben']);
    $site_price = get_zhuzhan_banben_price($row['banben']);
    //主站续费价格
    $site_qx = get_fenzhan_banben_qx($row['banben']);
    $site_url1 = $row['url'];
    $site_url2 = $row['url1'];
    $site_isktfz = $row['isktfz'];
    $site_ispay = $row['ispay'];
    $site_isktdl = $row['isktdl'];
    $site_point = $row['point'];
    //$site_czsxf = $row['czsxf'];
    $site_txsxf = $row['txsxf'];
    $site_txfs = $row['txfs'];
    $site_txzh = $row['txzh'];
    $site_txxm = $row['txxm'];
    $site_ico = $row['ico'];
    $site_skin = 'template/index/' . $row['moban1'] . '/';
    $site_skin1 = $row['moban1'];
    $site_name = $row['name'];
    $site_sname = $row['sname'];
    $site_gg = $row['tcnotice'];
    $site_key = $row['key'];
    $site_des = $row['des'];
    $site_bj = $row['background'];
    $site_topcolor = $row['topcolor'];
    $site_endcolor = $row['endcolor'];
    $site_content = $row['bqcontent'];
    $site_content1 = $row['endcontent'];
    $site_mid = $row['mid'];
    $site_level1_name = $row['level1_name'];
    $site_level2_name = $row['level2_name'];
    $site_level3_name = $row['level3_name'];
    $site_level4_name = $row['level4_name'];
    $site_level5_name = $row['level5_name'];
    $site_level1_price = $row['level1_price'];
    $site_level2_price = $row['level2_price'];
    $site_level3_price = $row['level3_price'];
    $site_level4_price = $row['level4_price'];
    $site_level5_price = $row['level5_price'];
   // $a_name = $row['loginname'];
   // $a_password = $row['loginpassword'];
    $a_qq = $row['qq'];
    $site_fed1 = $row['fed1'];
    $site_fed2 = $row['fed2'];
    $site_fed3 = $row['fed3'];
    $site_zfms = get_zhuzhan('zfms', $row['zid']);
    $site_shurl = get_zhuzhan('shurl', $row['zid']);
    $site_shid = get_zhuzhan('shid', $row['zid']);
    $site_shkey = get_zhuzhan('shkey', $row['zid']);
    $site_fprice1 = get_zhuzhan('fprice1', $row['zid']);
    $site_fprice2 = get_zhuzhan('fprice2', $row['zid']);
    $site_fprice3 = get_zhuzhan('fprice3', $row['zid']);
    $site_date = $row['date'];
    $site_ddate = get_zhuzhan('ddate', $row['zid']);
	$fen_zz = $row['uid'];
	$sel = "select * from  " . flag . "user where ID = '" . $fen_zz . "'  and  zid = " . $zhu_id . " ";
	$sl = @mysql_query($sel);
    $s = @mysql_fetch_array($sl);
	$a_name = $s['name'];
	$a_password = $s['password'];
    $resulttt = mysql_query('select * from ' . flag . 'fenzhan  where  ID = ' . $up_id . ' ');
    $rowww = mysql_fetch_array($resulttt);
    $up_banben = $rowww['banben'];
    $up_point = $rowww['point'];
}

if(isset($_SESSION[ 'gly']) and !isset($_SESSION[ 'admin_id'])){
	$result = mysql_query('select *  from '.flag.'guanli  where loginname = "'.$username.'"  and  loginpassword = "'.$password.'"  and zid = '.$zhu_id.'  ');
 	$row = mysql_fetch_array($result);
	$site_qx = $row['qx'];
}


//查询状态
//默认使用模板
$morenmoban = '01';
$morenpic = '';
$fmorenmoban = '01';
$fmorenpic = '';
?>