<?php
$duijiekey1 = 'input1';
$duijiekey2 = 'input2';
$duijiekey3 = 'input3';
$duijiekey4 = 'input4';
$time = strtotime('now');
$params = array(
    'username' => $loginname,
    //账户
    'time' => $time,
    //支付方式
	'paytype' => 1,
    'goodsid' => $s_duijiesid,
    //商品ID
    'num' => $_GET['num'],
    //下单数量
    $duijiekey1 => $_GET[$key1],
    $duijiekey2 => $_GET[$key2],
    $duijiekey3 => $_GET[$key3],
    $duijiekey4 => $_GET[$key4],
);
$key = $loginpassword;
$sign = getSign($params, $key);
$post_data = array(
    'username' => $loginname,
    //账户
    'time' => $time,
	//支付方式
	'paytype' => 1,
    //密码
    'sign' => $sign,
    //
    'goodsid' => $s_duijiesid,
    //商品ID
    'num' => $_GET['num'],
    //下单数量
    $duijiekey1 => $_GET[$key1],
    $duijiekey2 => $_GET[$key2],
    $duijiekey3 => $_GET[$key3],
    $duijiekey4 => $_GET[$key4],
);
$post_data = http_build_query($post_data , '' , '&');
$jg = yilepost('http://' . $duijieurl . '.api.jumsq.com/Api/UserApi/OrderAdd.html', $post_data);
if ($query = json_decode($jg, true)) {
    $s_duijiezt = $query['content'];
    $duijiefanhuizt = $query['content'];
}else{
	$s_duijiezt = $query;
}