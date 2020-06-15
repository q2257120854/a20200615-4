<?php
require_once 'system/inc.php';
require_once 'system/safe.php';
function iswap()
{
    // Èç¹ûÓÐHTTP_X_WAP_PROFILEÔòÒ»¶¨ÊÇÒÆ¶¯Éè±¸
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    if (isset($_SERVER['HTTP_VIA'])) {
        //ÕÒ²»µ½Îªflase,·ñÔòÎªtrue
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        // ´ÓHTTP_USER_AGENTÖÐ²éÕÒÊÖ»úä¯ÀÀÆ÷µÄ¹Ø¼ü×Ö
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
}
if ($site_moban1 == '') {
    $site_moban1 = '100';
}

if (iswap() == 1) {
	$site_moban1=$site_sjmb;
    include 'template/index/' . $site_sjmb . '/index.php';
} else {
    include 'template/index/' . $site_moban1 . '/index.php';
}
require_once 'data/member.php';