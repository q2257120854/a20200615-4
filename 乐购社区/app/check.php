<?php
$clientkeywords = array('jmsq');
if (!preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
    header('HTTP/1.1 404 Not Found');
    include '../404.php';
    exit;
}