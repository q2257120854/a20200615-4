<?php
require_once '../system/inc.php';
$fxname = $_POST['fxname'];
$fxpwd = $_POST['fxpwd'];
$user = $REQUEST['user'];
$pwd = $REQUEST['pwd'];
$q_url = $REQUEST['q_url'];
//账号密码判断
if ($fxname == '') {
    alert_href('请输入用户名!', '');
} elseif ($fxpwd == '') {
    alert_href('请输入用户密码!', '');
}
//登陆部分
$result = mysql_query('select * from ' . flag . 'admin  where  a_name = "' . $fxname . '"  ');
$row = SqlArray($result);
if (!$row) {
    alert_href('登录账户不正确!', '');
}
if (md5($fxpwd) != $row[0]['a_password']) {
    alert_href('登录密码不正确!', '');
} else {
    $_SESSION['admin_check2'] = $fxname;
    $result = mysql_query('select * from ' . flag . 'admin  where  a_name = "' . $_SESSION['admin_check2'] . '"  ');
    $row = mysql_fetch_array($result);
    $a_name = $row['a_name'];
    $a_password = $row['a_password'];
    $a_ID = $row['ID'];
    $admin_name = $row['a_name'];
    $admin_password = $row['a_password'];
    $admin_ID = $row['ID'];
    $qx = $row['qx'];
    $admin_num = (int) $row['a_num'];
    $fx_num = (int) $row['b_num'];
}
null_back($REQUEST['title'], '请输入主站名称');
null_back($REQUEST['q_url'], '请输入主站前缀');
null_back($REQUEST['h_url'], '请输入主站尾缀');
null_back($REQUEST['bb'], '请输入主站版本');
null_back($REQUEST['user'], '请输入主站登录账号');
null_back($REQUEST['pwd'], '请输入主站登录密码');
null_back($REQUEST['sj'], '输入添加多少年');
null_back($_SESSION['admin_check2'], '请登录');
if ($admin_num < 1) {
    alert_back('搭建失败！您的额度受限！请联系上级购买额度！');
}
$newnum = $admin_num - 1;
//减少额度
if (mysql_query('update ' . flag . 'admin set a_num=' . $newnum . ' where ID = "' . $admin_ID . '"  ')) {
} else {
    alert_back('搭建失败！额度未扣除，请联系上级处理！');
}
if ($REQUEST['bb'] > 3) {
    die;
}
//完整域名
$zhu_url = $REQUEST['q_url'] . "." . $REQUEST['h_url'];
if ($zhu_url == sysurl) {
    alert_back('创建失败:' . $zhu_url . '域名 已经被绑定过了!!');
}
$resultcx = mysql_query('select * from ' . flag . 'zhuzhan where url = "' . $REQUEST['q_url'] . '"  ');
if ($rowcx = mysql_fetch_array($resultcx)) {
    alert_back('创建失败:' . $REQUEST['q_url'] . '域名 已经被绑定过了!!');
}
$_data['zt'] = 1;
//1开启
$_data['banben'] = $REQUEST['bb'];
$_data['zname'] = $REQUEST['title'];
$_data['name'] = $REQUEST['title'];
$_data['point'] = 0;
$_data['url'] = $REQUEST['q_url'];
$_data['url1'] = $REQUEST['h_url'];
$_data['czsxf'] = get_zhuzhan_banben('czsxf', $REQUEST['bb']);
$_data['txsxf'] = get_zhuzhan_banben('txsxf', $REQUEST['bb']);
$_data['fed1'] = get_zhuzhan_banben('fed1', $REQUEST['bb']);
$_data['fed2'] = get_zhuzhan_banben('fed2', $REQUEST['bb']);
$_data['fed3'] = get_zhuzhan_banben('fed3', $REQUEST['bb']);
$_data['fprice1'] = get_zhuzhan_banben('fprice1', $REQUEST['bb']);
$_data['fprice2'] = get_zhuzhan_banben('fprice2', $REQUEST['bb']);
$_data['fprice3'] = get_zhuzhan_banben('fprice3', $REQUEST['bb']);
$_data['loginname'] = $REQUEST['user'];
$_data['loginpassword'] = $REQUEST['pwd'];
$_data['txfs'] = $REQUEST['qq'];
$_data['txxm'] = $REQUEST['qq'];
$_data['txzh'] = $REQUEST['qq'];
$_data['qq'] = $REQUEST['qq'];
$_data['date'] = date('Y-m-d H:i:s');
$_data['ddate'] = date('Y-m-d H:i:s', strtotime('+' . $REQUEST['sj'] . 'year'));
$_data['qq'] = $REQUEST['qq'];
$_data['desc'] = NULL;
$_data['moban'] = $morenmoban;
$_data['background'] = $morenpic;
$_data['mid'] = 1;
$_data['level1_name'] = '普通会员';
$_data['level2_name'] = '高级会员';
$_data['level3_name'] = '贵宾会员';
$_data['level4_name'] = '至尊会员';
$_data['level5_name'] = '皇冠会员';
$_data['fxid'] = $admin_ID;
$str = arrtoinsert($_data);
$sql = 'insert into ' . flag . 'zhuzhan (' . $str[0] . ') values (' . $str[1] . ')';
if (mysql_query($sql)) {
    //查询主站ID
    //为主站绑定域名
    $resultcx = mysql_query('select * from ' . flag . 'zhuzhan where url = "' . $REQUEST['q_url'] . '"  ');
    if ($rowcx = mysql_fetch_array($resultcx)) {
        $_bdym['zid'] = $rowcx['ID'];
        $_bdym['name'] = $zhu_url;
        $bdymstr = arrtoinsert($_bdym);
        $bdymsql = 'insert into ' . flag . 'zhuzhan_domain (' . $bdymstr[0] . ') values (' . $bdymstr[1] . ')';
        mysql_query($bdymsql);
    }
    alert_href('添加成功!', '');
} else {
    alert_back('添加失败!');
}