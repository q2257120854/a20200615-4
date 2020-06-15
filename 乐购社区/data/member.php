<?php
session_start();
if ($_SESSION['member_name'] != '') {
    //用户信息
    $sql = 'select * from ' . flag . 'user where name = "' . $_SESSION['member_name'] . '" and zid = ' . $zhu_id . ' ';
    $result = mysql_query($sql);
    if (!!$row = mysql_fetch_array($result)) {
        $member_id = $row['ID'];
        $member_name = $row['name'];
        $member_password = $row['password'];
        $member_point = $row['point'];
        $member_qq = $row['qq'];
        $m_level = $row['level'];
        $member_date = $row['date'];
    }
    if ($m_level == 1) {
        $member_level = $site_level1_name;
    }
    if ($m_level == 2) {
        $member_level = $site_level2_name;
    }
    if ($m_level == 3) {
        $member_level = $site_level3_name;
    }
    if ($m_level == 4) {
        $member_level = $site_level4_name;
    }
    if ($m_level == 5) {
        $member_level = $site_level5_name;
    }
    if ($fen_zz == $member_id) {
        $m_level = 6;
        $member_level = '站长';
        $_SESSION['admin_check'] = $member_name;
    }
	$sql = 'select * from ' . flag . 'mj where uid = "' . $member_id . '" and zid = ' . $zhu_id . ' ';
    $result = mysql_query($sql);
    if (!!$row = mysql_fetch_array($result)) {
		$mj_name='(密价)';
        $mj_rate = $row['rate'];
        $mj_kind = $row['kind'];
    }
}
?>