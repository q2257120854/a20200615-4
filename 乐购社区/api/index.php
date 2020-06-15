  <? require_once ('../system/inc.php');
function null_apiback($t0, $t1) {
    if ($t0 == '') {
        die($t1);
    }
}
function json_fanhui($t0) {
    die($t0);
}
//权限检测
function check_qx1($t0, $t1, $t2) {
    if (strpos($t0, $t1) !== false) {
    } else {
        die($t2);
    }
}
check_qx1($site_qx, '商品被对接', '站点未开放对接!');
if ($_GET['act'] == 'add') {
    if ($_GET['user'] == '') {
        json_fanhui('请输入用户名!');
    } elseif ($_GET['password'] == '') {
        json_fanhui('请输入用户密码!');
    }
    $sel = "select * from " . flag . "user where name = '" . $_GET['user'] . "'  and  password = '" . md5($_GET['password']) . "' and zid = " . $zhu_id . "   ";
    $sl = @mysql_query($sel);
    $s = @mysql_fetch_array($sl);
    if (is_array($s)) {
        $api_member_id = $s['ID'];
        $api_member_point = $s['point'];
        $api_member_name = $s['name'];
        $m_level = $row['level'];
    } else {
        json_fanhui('用户名或密码不正确!');
    }
    require_once 'shop.php';
    #咸鱼装逼时间
    if ($key1 != '') {
        if (!$_GET['value1']) {
            null_apiback($_GET[$key1], '请输入' . $keyname1 . '');
        } else {
            $key1 == $_GET['value1'];
        }
    }
    if ($key2 != '') {
        if (!$_GET['value2']) {
            null_apiback($_GET[$key2], '请输入' . $keyname2 . '');
        } else {
            $key2 == $_GET['value2'];
        }
    }
    if ($key3 != '') {
        if (!$_GET['value3']) {
            null_apiback($_GET[$key3], '请输入' . $keyname3 . '');
        } else {
            $key3 == $_GET['value3'];
        }
    }
    if ($key4 != '') {
        if (!$_GET['value4']) {
            null_apiback($_GET[$key4], '请输入' . $keyname4 . '');
        } else {
            $key4 == $_GET['value4'];
        }
    }
    $_GET['value1'] = $key1;
    $_GET['value2'] = $key2;
    $_GET['value3'] = $key3;
    $_GET['value4'] = $key4;
    #装逼完了
    #大概就是没有附加参数的话就取k1，k2这些的
    null_apiback($_GET['num'], '请输入下单数量' . $s_dnum . '');
    if ($_GET['num'] < $s_dnum) {
        json_fanhui('请确保数量不能低于' . $s_dnum . '!');
    }
    if ($_GET['num'] > $s_gnum) {
        json_fanhui('请确保数量不能高于' . $s_gnum . '!');
    }
    //下单判断
    if ($s_iscfxd == 0) {
        $sel = "select * from  " . flag . "order where key1 = '" . $_GET[$key1] . "'  and zid = " . $zhu_id . " and sid = " . $_GET['sid'] . "   and  zt != 6 and    zt != 7  ";
        $sl = @mysql_query($sel);
        $s = @mysql_fetch_array($sl);
        if (is_array($s)) {
            json_fanhui('下单失败:您有未完成的订单正在处理!');
        }
    }
    $pay_price = $s_price * $_GET['num']; //实际购买价格
    if ($api_member_point < $pay_price) {
        json_fanhui('下单失败:您的余额' . $api_member_point . '不足以支付' . $pay_price . '元!');
    } else {
        $xfhje = $api_member_point - $pay_price;
        $_dataa['point'] = $xfhje;
        $sqla = 'update ' . flag . 'user set ' . arrtoupdate($_dataa) . ' where ID = ' . $api_member_id . '';
        if (mysql_query($sqla)) {
            //消费记录
            $_data1['hyid'] = $api_member_id;
            $_data1['hyname'] = $api_member_name;
            $_data1['xf_qje'] = $api_member_point;
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
            if($pingtai == 4) {
                require_once ('duijie/yile3.php');
            }
			if ($pingtai == 5) {
                require_once 'duijie/jumeng.php';
            }
            //订单记录
            $_data2['dingdanhao'] = $danhao;
            $_data2['sid'] = $_GET['sid'];
            $_data2['sname'] = $s_name;
            $_data2['hyid'] = $api_member_id;
            $_data2['hyname'] = $api_member_name;
            if ($keyname1 != '') {
                $_data2['keyname1'] = $keyname1;
            }
            if ($keyname2 != '') {
                $_data2['keyname2'] = $keyname2;
            }
            if ($keyname3 != '') {
                $_data2['keyname3'] = $$keyname3;
            }
            if ($keyname4 != '') {
                $_data2['keyname4'] = $keyname4;
            }
            $_data2['key1'] = $_GET[$key1];
            $_data2['key2'] = $_GET[$key2];
            $_data2['key3'] = $_GET[$key3];
            $_data2['key4'] = $_GET[$key4];
            $_data2['csnum'] = 0;
            $_data2['num'] = $_GET['num'];
            $_data2['dqnum'] = 0;
            $_data2['price'] = $pay_price;
            $_data2['zt'] = get_shopzt($_GET['sid']);;
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
            //供货增加收入开始
            if ($gh != 0) {
                $sqlgh = 'select * from ' . flag . 'user  where   name like "%' . $gh . '%"   and zid = ' . $zhu_id . ' or  ID like "%' . $gh . '%"   and zid = ' . $zhu_id . '   or  qq like "%' . $gh . '%"  and zid = ' . $zhu_id . '   order by ID desc , ID desc';
                $resultgh = mysql_query($sqlgh);
                while ($row = mysql_fetch_array($resultgh)) {
                    $point = $row['point'];
                    $hyname = $row['name'];
                    $xf_qje = $row['point'];
                }
                $xy = $point + $shop_price;
                $_data1['hyid'] = $gh;
                $_data1['hyname'] = $hyname;
                $_data1['xf_qje'] = $point;
                $_data1['xf_je'] = $shop_price;
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
            //分站增加收入开始
            if ($fen == 'true') { //分站增加收入
                $chajia = $jprice * $_GET['num'];
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
                    if (!mysql_query($fenzhanzjjlsql)) die('错误: ' . mysql_error());
                    # die($fenzhanzjjlsql);
                    
                }
                #上级结束
                
            }
            //分站增加收入结束
            json_fanhui('下单成功!');
        } else {
            json_fanhui('下单失败:扣除余额失败!');
        }
    }
}
function get_shopzt($t0) {
    $result = mysql_query('select *  from  ' . flag . 'shop where ID = ' . $t0 . '  ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['duijiecgzt'];
    } else {
        return '0';
    }
}
?>


 