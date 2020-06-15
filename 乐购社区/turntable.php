<?php
include 'system/inc.php';
require_once 'data/member.php';
mysql_query('set names utf8');
//获取下单模板
function getmoban($t0, $t1) {
    $result = mysql_query('select *   from  ' . flag . 'moban where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '';
    }
}
function alert_json($t0, $t1) {
    die('{"code":' . $t1 . ',"message":"' . $t0 . '","url":""}');
}
//空值返回
function null_alertjson($t0, $t1) {
    if ($t0 == '') {
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
$xiaoyewl_act = $_GET['act'];
switch ($xiaoyewl_act) {
    case 'list':
        //列表
        $sql = 'select * from ' . flag . 'cjjp  where zid = ' . $zhu_id . ' order by ID desc';
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
            $ok = 1;
            if ($row['image'] == NULL) {
                $icon = $row['kind'];
            } else {
                $icon = $row['image'];
            }
            $arr2[] = array('id' => "{$row['ID']}", 'name' => "{$row['name']}", 'icon' => "{$icon}");
        }
        if (!$ok) {
            $msg = mysql_error();
        }
        $arr = array('status' => 0, 'message' => "{$msg}", 'data' => $arr2);
        die(json_encode($arr));
    break;
    case 'start':
        //开始
        if ($member_point < $cjprice) {
            $arr['status'] = 1;
            $arr['message'] = '下单失败:您的余额' . $member_point . '元不足以支付' . $cjprice . '元!';
        } else {
            $sql = 'select * from ' . flag . 'cjjp  where zid = ' . $zhu_id . '';
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $i++;
                $sum = mysql_query('select sum(number) from ' . flag . 'cjjp  where zid = ' . $zhu_id . '');
                $sum = mysql_fetch_array($sum);
                $sum = $sum[0];
                $arr['status'] = 0;
                $jpnum = $row['number'];
                $gl = $jpnum / $sum * 100;
                //$gl=get_xiaoshu($gl,6);
                $gl = intval($gl);
                $arr['gl'] = $gl; //$jpnum.'|'.$sum;
                $gl2 = mt_rand(0, 100);
                $arr['gl2'] = $gl2;
				$name = '谢谢参与';
                $arr['prize'] = $i;
                $arr['message'] = '谢谢参与';
                if ($jpnum > 0) {
                    if ($gl > $gl2 or $gl = $gl2) { //中奖
                        $xy3 = $row['ID'];
						$rmb = $row['rmb'];
						$kind = $row['kind'];
                        $arr['prize'] = $row['ID'];
                        $name = $row['name'];
                        goto a;
                    }
                }
            }
            a:
                if ($xy3) {
					        if ($kind== 1) {
                            $arr['message'] = '恭喜你中奖了，余额已经自动充值';
                            $xy = $member_point + $rmb;
                            $_data['point'] = $xy;
                            $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where ID = ' . $member_id . '';
                            if(!mysql_query($sql))$arr['应该设置的'] = mysql_error();
                           /* $arr['应该设置的'] = $xy;
                            $arr['实际金额'] = $member_point;*/
                            unset($_data1);
                            unset($_data);
                            $_data1['hyid'] = $member_id;
                            $_data1['hyname'] = $member_name;
                            $_data1['xf_qje'] = $member_point;
                            $_data1['xf_je'] = $rmb;
                            $_data1['xf_hje'] = $xy;
                            $_data1['xf_date'] = $sj;
                            $_data1['xf_qk'] = '中奖';
                            $_data1['zid'] = $zhu_id;
                            $_data1['xf_lx'] = 1;
                            $str1 = arrtoinsert($_data1);
                            $sql1 = 'insert into ' . flag . 'xfjl (' . $str1[0] . ') values (' . $str1[1] . ')';
                            mysql_query($sql1);
                            unset($_data1);
                            unset($_data);
                        } elseif ($kind== 0) {
                            $arr['message'] = '谢谢参与';
                        } else {
                            $arr['message'] = '恭喜你中奖了，请联系客服发放';
                        }
                    $_data['number'] = $jpnum - 1;
                    $str = arrtoinsert($_data);
                    $sql1 = 'update ' . flag . 'cjjp set ' . arrtoupdate($_data) . ' where ID = ' . $xy3 . ' and zid = ' . $zhu_id . '';
                    mysql_query($sql1);
                    unset($_data1);
                    unset($_data);
					
				$xfhje = $member_point + $rmb - $cjprice;
                $_data['point'] = $xfhje;
                $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where ID = ' . $member_id . '';
                mysql_query($sql);
                unset($_data1);
                unset($_data);
                //消费记录
                $_data1['hyid'] = $member_id;
                $_data1['hyname'] = $member_name;
                $_data1['xf_qje'] = $member_point;
                $_data1['xf_je'] = $cjprice;
                $_data1['xf_hje'] = $xfhje;
                $_data1['xf_date'] = $sj;
                $_data1['xf_qk'] = '抽奖';
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
                unset($_data1);
                unset($_data);
                //抽奖记录
                $_data1['userid'] = $member_id;
                $_data1['name'] = $name;
                $_data1['zjtime'] = $sj;
                $_data1['fftime'] = $sj;
                $_data1['zid'] = $zhu_id;
                $str1 = arrtoinsert($_data1);
                $sql1 = 'insert into ' . flag . 'cjjl (' . $str1[0] . ') values (' . $str1[1] . ')';
                mysql_query($sql1);
                unset($_data1);
                unset($_data);
                }else{
                $xfhje = $member_point - $cjprice;
                $_data['point'] = $xfhje;
                $sql = 'update ' . flag . 'user set ' . arrtoupdate($_data) . ' where ID = ' . $member_id . '';
                mysql_query($sql);
                unset($_data1);
                unset($_data);
                //消费记录
                $_data1['hyid'] = $member_id;
                $_data1['hyname'] = $member_name;
                $_data1['xf_qje'] = $member_point;
                $_data1['xf_je'] = $cjprice;
                $_data1['xf_hje'] = $xfhje;
                $_data1['xf_date'] = $sj;
                $_data1['xf_qk'] = '抽奖';
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
                unset($_data1);
                unset($_data);
                //抽奖记录
                $_data1['userid'] = $member_id;
                $_data1['name'] = $name;
                $_data1['zjtime'] = $sj;
                $_data1['fftime'] = $sj;
                $_data1['zid'] = $zhu_id;
                $str1 = arrtoinsert($_data1);
                $sql1 = 'insert into ' . flag . 'cjjl (' . $str1[0] . ') values (' . $str1[1] . ')';
                mysql_query($sql1);
                unset($_data1);
                unset($_data);
				}
            }
            $arr['rmb'] = $member_point + $rmb - $cjprice;
            die(json_encode($arr));
        break;
    }
    