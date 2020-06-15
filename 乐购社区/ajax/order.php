<?php
include_once ('../system/inc.php');
require_once ('../data/member.php');
require_once ('../app/shop.php');
$xfhje=0;
function alert_json($t0, $t1) {
	global $xfhje;
    die('{"status":' . $t1 . ',"message":"' . $t0 . '","rmb":'.$xfhje.'}');
}
//空值返回
function null_alertjson($t0, $t1) {
    if ($t0 == '' or empty($t0)) {
        alert_json($t1, -1);
    }
}
function non_numeric_alertjson($t0, $t1) {
    if (!is_numeric($t0) || $t0 < 0) {
        alert_json($t1, -1);
    } else {
        return true;
    }
}
$num = $_REQUEST['num'];
if ($member_name == '') {
    die();
}
header("Content-type:text/html;charset=utf-8"); //字符编码设置
$xiaoyewl_act = $_REQUEST['action'];
switch ($xiaoyewl_act) {
    case 'order':
	if ($s_xid == 0 and $member_id != '') { //发卡
if($s_wh==0)alert_json('商品维护不能下单!', 1);
    $spkucun = get_kmshop($_REQUEST['gid'], $zhu_id);
null_alertjson($_POST['num'], '请输入购买数量');
null_alertjson($_POST['email'], '请输入接收邮箱');
if ($_POST['email'] != '') {
    $jsemail = $_POST['email'];
} else {
    $jsemail = $member_qq . "@qq.com";
}
if ($_POST['num'] < $s_dnum) {
    alert_json('购买失败:'.$s_name.'的数量不能低于' . $s_dnum . '!', 1);
}
if ($_POST['num'] > $s_gnum) {
    alert_json('购买失败:'.$s_name.'的数量不能高于' . $s_gnum . '!', 1);
}
if ($spkucun <= 0) {
    alert_json('购买失败:商品库存不足!', 1);
}
if ($_POST['num'] > $spkucun) {
    alert_json('购买失败:商品库存不足!', 1);
}
$pay_price = $s_price * $_POST['num']; //实际购买价格
if ($member_point < $pay_price) {
    alert_json('购买失败:您的余额' . $member_point . '元不足以支付' . $pay_price . '元!', 1);
} else {
    $xfhje = $member_point - $pay_price;
    $_data['point'] = $xfhje;
    $str = arrtoinsert($_data);
    $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where id = ' . $member_id . '';
    if (mysql_query($sql)) {
        //消费记录
        $_data1['hyid'] = $member_id;
        $_data1['hyname'] = $member_name;
        $_data1['xf_qje'] = $member_point;
        $_data1['xf_je'] = $pay_price;
        $_data1['xf_hje'] = $xfhje;
        $_data1['xf_date'] = $sj;
        $_data1['xf_qk'] = '购买商品:' . $s_name . '';
        $_data1['xf_lx'] = 0; //0扣除 -增加
        $_data1['zid'] = $zhu_id; //
        if ($zhu == 'true') {
            $_data1['fid'] = 0;
        } else {
            $_data1['fid'] = $fen_id;
        }
        $str1 = arrtoinsert($_data1);
        $sql1 = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
        mysql_query($sql1);
        $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        //订单记录
        $_data2['dingdanhao'] = $danhao;
        $_data2['sid'] = $_REQUEST['gid'];
        $_data2['sname'] = $s_name;
        $_data2['hyid'] = $member_id;
        $_data2['hyname'] = $member_name;
			if ($keyname1!=''){
				$_data2['keyname1'] = $keyname1;
			}
			if ($keyname2!=''){
				$_data2['keyname2'] =$keyname2;
			}
			if ($keyname3!=''){
				$_data2['keyname3'] = $$keyname3;
			}
			if ($keyname4!=''){
				$_data2['keyname4'] = $keyname4;
			}
			$_data2['key1'] = $_REQUST[$key1];
			$_data2['key2'] = $_REQUST[$key2];
			$_data2['key3'] = $_REQUST[$key3];
			$_data2['key4'] = $_REQUST[$key4];
        $_data2['num'] = $_POST['num'];
        $_data2['price'] = $pay_price;
        $_data2['zt'] = 6;
        $_data2['date'] = $sj;
$_data2['djid'] = $s_duijiedingdan;
        $_data2['zid'] = $zhu_id;
        if ($zhu == 'true') {
            $_data2['fid'] = 0;
        } else {
            $_data2['fid'] = $fen_id;
        }
if($gh!=0){$_data2['gh'] =$gh;}
        $str2 = arrtoinsert($_data2);
        $sql2 = 'insert into ' . flag . 'order (' . $str2[0] . ') values (' . $str2[1] . ')';
$arrr = array('""' => "NULL");$sql2 = strtr($sql2, $arrr);
        mysql_query($sql2);
        //供货增加收入开始
        if ($gh != 0) {
            $sqlgh = 'select * from ' . flag . 'user  where   name like "%' . $gh . '%"   and zid = ' . $zhu_id . ' or  ID like "%' . $gh . '%"   and zid = ' . $zhu_id . '   or  qq like "%' . $gh . '%"  and zid = ' . $zhu_id . '   order by ID desc , ID desc';
            $resultgh = mysql_query($sqlgh);
            while ($row = mysql_fetch_array($resultgh)) {
                $point = $row['point'];
                $hyname = $row['name'];
                $xf_qje = $row['point'];
            }
                $xy = $point + $shop_price * $_POST['num'];
                $_data1['hyid'] = $gh;
                $_data1['hyname'] = $hyname;
                $_data1['xf_qje'] = $point;
                $_data1['xf_je'] = $shop_price * $_POST['num'];
            $_data1['xf_hje'] = $xy;
            $_data1['xf_date'] = $sj;
            $_data1['xf_qk'] = '供货商品提成';
            $_data1['zid'] = $zhu_id;
            $_data1['xf_lx'] = 1;
            $str1 = arrtoinsert($_data1);
            $sql1g = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
            mysql_query($sql1g);
            $_data['point'] = $xy;
            $str = arrtoinsert($_data);
            $sqlg = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where id = ' . $gh . '';
            mysql_query($sqlg);
        }
        //供货增收入结束
        if ($fen == 'true') {
            //分站增加收入
            $chajia = $jprice * $_POST['num'];
            $_fenzhanshouru['point'] = $site_point + $chajia;
            $fenzhanshourusql = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $fen_id . '';
            mysql_query($fenzhanshourusql);
            //分站资金积累
            $_fenzhanzjjl['zid'] = $zhu_id;
            $_fenzhanzjjl['fid'] = $fen_id;
            $_fenzhanzjjl['qje'] = $site_point;
            $_fenzhanzjjl['je'] = $chajia;
            $_fenzhanzjjl['hje'] = $site_point + $chajia;
            $_fenzhanzjjl['date'] = $sj;
            $_fenzhanzjjl['lx'] = 1;
            $_fenzhanzjjl['desc'] = '售出商品:' . $s_name;
            $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
            $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
            mysql_query($fenzhanzjjlsql);
            #上级提成
            if ($up_banben == 1) {
                $chajiaa = $chajia2 * $_POST['num'];
                $_fenzhanshouru['point'] = $up_point + $chajiaa;
                $xy3 = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $up_id . '';
                if (!mysql_query($xy3)) die('错误: ' . mysql_error());
                #die($xy3);
                //分站资金积累
                $_fenzhanzjjl['zid'] = $zhu_id;
                $_fenzhanzjjl['fid'] = $up_id;
                $_fenzhanzjjl['qje'] = $up_point;
                $_fenzhanzjjl['je'] = $chajiaa;
                $_fenzhanzjjl['hje'] = $up_point + $chajiaa;
                $_fenzhanzjjl['date'] = $sj;
                $_fenzhanzjjl['lx'] = 1;
                $_fenzhanzjjl['desc'] = '下级提成:' . $s_name;
                $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
                $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
               mysql_query($fenzhanzjjlsql;
                # die($fenzhanzjjlsql);
                
            }
            #上级结束
            
        }
        //查询卡密并取出
        $result = mysql_query('select  *  from ' . flag . 'shopkm  where sid= ' . $_REQUEST['gid'] . ' and zt = 0 and zid = ' . $zhu_id . '    order by ID asc  limit ' . $_POST['num'] . ' ');
        $x = 0;
        while ($row = mysql_fetch_array($result)) {
            $x++;
            $kmsql = 'update  ' . flag . 'shopkm set zt = 1,hyid=' . $member_id . ',hyname="' . $member_name . '",pdate="' . $sj . '"  where ID = ' . $row['ID'] . ' ';
            mysql_query($kmsql);
            $kahao = $row['kahao'];
        }
        alert_json('购买成功!请登录网站查看卡密', 0);
    } else {
        alert_json('购买失败!', 1);
    }
}

}
    if ($s_xid != 0 and $member_id != '') { //普通商品
if($s_wh==0)alert_json('商品维护不能下单!', 1);
             if ($key1 != '') {
            null_alertjson($_POST[$key1], '请输入' . $keyname1 . '('.$key1.')');
        }
        if ($key2 != '') {
            null_alertjson($_POST[$key2], '请输入' . $keyname2 . '('.$key2.')');
        }
        if ($key3 != '') {
            null_alertjson($_POST[$key3], '请输入' . $keyname3 . '('.$key3.')');
        }
        if ($key4 != '') {
            null_alertjson($_POST[$key4], '请输入' . $keyname4 . '('.$key4.')');
        }
        null_alertjson($_POST['num'], '请输入下单数量');
if ($_POST['num'] < $s_dnum) {
    alert_json('购买失败:'.$s_name.'的数量不能低于' . $s_dnum . '!', 1);
}
if ($_POST['num'] > $s_gnum) {
    alert_json('购买失败:'.$s_name.'的数量不能高于' . $s_gnum . '!', 1);
}
        $pay_price = $s_price * $_POST['num']; //实际购买价格
        if ($member_point < $pay_price) {
            alert_json('下单失败:您的余额' . $member_point . '元不足以支付' . $pay_price . '元!', 1);
        } else {
            $xfhje = $member_point - $pay_price;
            $_data['point'] = $xfhje;
            $str = arrtoinsert($_data);
            $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where id = ' . $member_id . '';
            if (mysql_query($sql)) {
                //消费记录
                $_data1['hyid'] = $member_id;
                $_data1['hyname'] = $member_name;
                $_data1['xf_qje'] = $member_point;
                $_data1['xf_je'] = $pay_price;
                $_data1['xf_hje'] = $xfhje;
                $_data1['xf_date'] = $sj;
                $_data1['xf_qk'] = '购买商品:' . $s_name . '';
                $_data1['xf_lx'] = 0; //0扣除 -增加
                $_data1['zid'] = $zhu_id; //
                if ($zhu == 'true') {
                    $_data1['fid'] = 0;
                } else {
                    $_data1['fid'] = $fen_id;
                }
                $str1 = arrtoinsert($_data1);
                $sql1 = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
                mysql_query($sql1);
                $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                if ($pingtai == 1) {
                    require_once ('duijie/zhu.php');
                }
                if ($pingtai == 2) {
                    require_once ('duijie/yile.php');
                }
                if ($pingtai == 3) {
                    require_once ('duijie/95.php');
                }
                if ($pingtai == 4) {
                    require_once ('duijie/yile3.php');
                }
                if ($pingtai == 5) {
                    require_once 'duijie/jumeng.php';
                }
                //订单记录
                $_data2['dingdanhao'] = $danhao;
                $_data2['sid'] = $_REQUEST['gid'];
                $_data2['sname'] = $s_name;
                $_data2['hyid'] = $member_id;
                $_data2['hyname'] = $member_name;
			if ($keyname1!=''){
				$_data2['keyname1'] = $keyname1;
			}
			if ($keyname2!=''){
				$_data2['keyname2'] =$keyname2;
			}
			if ($keyname3!=''){
				$_data2['keyname3'] = $$keyname3;
			}
			if ($keyname4!=''){
				$_data2['keyname4'] = $keyname4;
			}
            $_data2['key1'] = $_REQUEST[$key1];
            $_data2['key2'] = $_REQUEST[$key2];
            $_data2['key3'] = $_REQUEST[$key3];
            $_data2['key4'] = $_REQUEST[$key4];
                $_data2['csnum'] = 0;
                $_data2['num'] = $_REQUEST['num'];
                $_data2['dqnum'] = 0;
                $_data2['price'] = $pay_price;
                $_data2['zt'] = $s_zt;
                $_data2['duijiezt'] = $s_duijiezt;
                $_data2['date'] = $sj;
                $_data2['zid'] = $zhu_id;
                if ($zhu == 'true') {
                    $_data2['fid'] = 0;
                } else {
                    $_data2['fid'] = $fen_id;
                }
                $str2 = arrtoinsert($_data2);
                $sql2 = 'insert into ' . flag . 'order (' . $str2[0] . ') values (' . $str2[1] . ')';
				$arrr = array('""' => "NULL");$sql2 = strtr($sql2, $arrr);
                mysql_query($sql2);
				#pr($sql2);
                //供货增加收入开始
                if ($gh != 0) {
                    $sqlgh = 'select * from ' . flag . 'user  where   name like "%' . $gh . '%"   and zid = ' . $zhu_id . ' or  ID like "%' . $gh . '%"   and zid = ' . $zhu_id . '   or  qq like "%' . $gh . '%"  and zid = ' . $zhu_id . '   order by ID desc , ID desc';
                    $resultgh = mysql_query($sqlgh);
                    while ($row = mysql_fetch_array($resultgh)) {
                        $point = $row['point'];
                        $hyname = $row['name'];
                        $xf_qje = $row['point'];
                    }
                $xy = $point + $shop_price * $_POST['num'];
                $_data1['hyid'] = $gh;
                $_data1['hyname'] = $hyname;
                $_data1['xf_qje'] = $point;
                $_data1['xf_je'] = $shop_price * $_POST['num'];
                    $_data1['xf_hje'] = $xy;
                    $_data1['xf_date'] = $sj;
                    $_data1['xf_qk'] = '供货商品提成';
                    $_data1['zid'] = $zhu_id;
                    $_data1['xf_lx'] = 1;
                    $str1 = arrtoinsert($_data1);
                    $sql1g = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
                    mysql_query($sql1g);
                    $_data['point'] = $xy;
                    $str = arrtoinsert($_data);
                    $sqlg = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where id = ' . $gh . '';
                    mysql_query($sqlg);
                }
                //供货增收入结束
                if ($fen == 'true') {
                    //分站增加收入
                    $chajia = $jprice * $_POST['num'];
                    $_fenzhanshouru['point'] = $site_point + $chajia;
                    $fenzhanshourusql = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $fen_id . '';
                    mysql_query($fenzhanshourusql);
                    //分站资金积累
                    $_fenzhanzjjl['zid'] = $zhu_id;
                    $_fenzhanzjjl['fid'] = $fen_id;
                    $_fenzhanzjjl['qje'] = $site_point;
                    $_fenzhanzjjl['je'] = $chajia;
                    $_fenzhanzjjl['hje'] = $site_point + $chajia;
                    $_fenzhanzjjl['date'] = $sj;
                    $_fenzhanzjjl['lx'] = 1;
                    $_fenzhanzjjl['desc'] = '售出商品:' . $s_name;
                    $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
                    $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
                    mysql_query($fenzhanzjjlsql);
                    #上级提成
                    if ($up_banben == 1) {
                        $chajiaa = $chajia2 * $_POST['num'];
                        $_fenzhanshouru['point'] = $up_point + $chajiaa;
                        $xy3 = 'update ' . flag . 'fenzhan set ' . arrtoupdate($_fenzhanshouru) . ' where  ID = ' . $up_id . '';
                        if (!mysql_query($xy3)) die('错误: ' . mysql_error());
                        #die($xy3);
                        //分站资金积累
                        $_fenzhanzjjl['zid'] = $zhu_id;
                        $_fenzhanzjjl['fid'] = $up_id;
                        $_fenzhanzjjl['qje'] = $up_point;
                        $_fenzhanzjjl['je'] = $chajiaa;
                        $_fenzhanzjjl['hje'] = $up_point + $chajiaa;
                        $_fenzhanzjjl['date'] = $sj;
                        $_fenzhanzjjl['lx'] = 1;
                        $_fenzhanzjjl['desc'] = '下级提成:' . $s_name;
                        $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
                        $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
                        mysql_query($fenzhanzjjlsql);
                        # die($fenzhanzjjlsql);
                        
                    }
                    #上级结束
                    
                }
                alert_json('下单成功!', 0);
            } else {
                alert_json('下单失败!', 1);
            }
        }
}
        break;
    }