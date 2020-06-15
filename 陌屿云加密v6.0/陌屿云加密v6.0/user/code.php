<?php
/*
Auat：陌屿
QQ：2763994904
Grup：777824195
Name：陌屿云加密系统
*/
session_start();
define('ROOT_PATH', dirname(__FILE__));
require '../includes/code.class.php';
$_mulin = new ValidateCode();
$_mulin->doimg();
$_SESSION['mulin_code'] = $_mulin->getCode();
?>