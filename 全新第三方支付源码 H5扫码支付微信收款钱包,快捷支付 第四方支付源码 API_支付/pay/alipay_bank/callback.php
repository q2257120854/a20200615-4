<?php
require_once 'inc.php';
use WY\app\model\Handleorder;

$orderid=$_POST['orderid'];
$total_fee=$_POST['money'];
$sign=$_POST['sign'];

if($orderid=='' || $total_fee=='' || $sign==''){
    echo 'paramerr';exit;
}

$mysign=md5($orderid.$total_fee.$userkey);
if($sign==$mysign){
    echo 'success';
    $handle=new Handleorder($orderid,$total_fee);
    $handle->updateUncard();
} else {
    echo 'signstr';
}
?>
