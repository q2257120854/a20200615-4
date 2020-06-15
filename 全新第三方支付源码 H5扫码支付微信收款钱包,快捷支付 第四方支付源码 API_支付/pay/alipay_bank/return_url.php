<?php
require_once 'inc.php';
use WY\app\model\Pushorder;

$orderid=isset($_GET['out_trade_no']) ? $_GET['out_trade_no'] : '';
$push=new Pushorder($orderid);
$push->sync();
?>
