<?php
if ($_POST['act'] == 'plpay' or $_POST['提交'] == '批量下单') {
    $array = $_POST['neirong'];
    $array = explode("\n", $array);
    foreach ($array as $v) {
        if ($v != '') {
            $v = explode('----', $v);
            if (isset($v[1])) {
                $s[] = '("' . $v[0] . '","' . $v[1] . '")';
                $sl[] = $v[0];
                $plkey1[] = $v[1];
                $plkey2[] = $v[2];
                $plkey3[] = $v[3];
                $plkey4[] = $v[4];
            }
        }
    }
    $plnum = array_sum($sl);
    $plprice = $plnum * $s_price;
    if ($plprice > $member_point) {
        alert_href('批量下单失败:您的余额不足以支付' . $plprice . '元!', '');
    } else {
        null_back($plnum, '请输入下单数量');
        if ($key1 != '') {
            null_back($plkey1[0], '请输入' . $keyname1 . '');
        }
        if ($key2 != '') {
            null_back($plkey2[0], '请输入' . $keyname2 . '');
        }
        if ($key3 != '') {
            null_back($plkey3[0], '请输入' . $keyname3 . '');
        }
        if ($key4 != '') {
            null_back($plkey3[0], '请输入' . $keyname4 . '');
        }
        //开始批量下单
        for ($i = 0; $i < sizeof($s); $i++) {
            //批量对接
            if ($pingtai == 1) {
                require_once 'duijie/zhu.php';
            }
            if ($pingtai == 2) {
                require_once 'duijie/yile.php';
            }
            if ($pingtai == 3) {
                require_once 'duijie/95.php';
            }
            if ($pingtai == 4) {
                require_once 'duijie/yile3.php';
            }
			if ($pingtai == 5) {
                require_once 'duijie/jumeng.php';
            }
            //消费记录
            $_data1['hyid'] = $member_id;
            $_data1['hyname'] = $member_name;
            $_data1['xf_qje'] = get_user_info('point', $member_id);
            $_data1['xf_je'] = $sl[$i] * $s_price;
            $_data1['xf_hje'] = get_user_info('point', $member_id) - $sl[$i] * $s_price;
            $_data1['xf_date'] = $sj;
            $_data1['xf_qk'] = '批量下单商品:' . $s_name . '';
            $_data1['xf_lx'] = 0;
            //0扣除 -增加
            $_data1['xf_ip'] = xiaoyewl_ip();
            //0扣除 -增加
            $_data1['zid'] = $zhu_id;
            //
            if ($zhu == 'true') {
                $_data1['fid'] = 0;
            } else {
                $_data1['fid'] = $fen_id;
            }
            $str1 = arrtoinsert($_data1);
            $sql1 = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
            mysql_query($sql1);
            //执行扣除余额
            $xfhje = get_user_info('point', $member_id) - $sl[$i] * $s_price;
            $_data['point'] = $xfhje;
            $str = arrtoinsert($_data);
            $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where id = ' . $member_id . '';
            mysql_query($sql);
            //订单记录
            $_data2['dingdanhao'] = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $_data2['sid'] = $_GET['id'];
            $_data2['sname'] = $s_name;
            $_data2['hyid'] = $member_id;
            $_data2['hyname'] = $member_name;
            if ($keyname1 != '') {
                $_data2['keyname1'] = $keyname1;
            }
            if ($keyname2 != '') {
                $_data2['keyname2'] = $keyname2;
            }
            if ($keyname3 != '') {
                $_data2['keyname3'] = $keyname3;
            }
            if ($keyname4 != '') {
                $_data2['keyname4'] = $keyname4;
            }
            $_data2['key1'] = $plkey1[$i];
            $_data2['key2'] = $plkey2[$i];
            $_data2['key3'] = $plkey3[$i];
            $_data2['key4'] = $plkey4[$i];
            $_data2['csnum'] = 0;
            $_data2['num'] = $sl[$i];
            $_data2['dqnum'] = 0;
            $_data2['price'] = $sl[$i] * $s_price;
            $_data2['zt'] = get_shopzt($_GET['id']);
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
            mysql_query($sql2);
        }
        if ($fen == 'true') {
            //分站增加收入
            $chajia = $jprice * $plnum;
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
            $_fenzhanzjjl['desc'] = '批量售出商品:' . $s_name;
            $fenzhanzjjl = arrtoinsert($_fenzhanzjjl);
            $fenzhanzjjlsql = 'insert into ' . flag . 'fenzhanpricejl (' . $fenzhanzjjl[0] . ') values (' . $fenzhanzjjl[1] . ')';
            mysql_query($fenzhanzjjlsql);
        }
        alert_href('批量下单成功!', '');
    }
}