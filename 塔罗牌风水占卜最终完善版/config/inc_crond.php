<?php

/* CROND 定时器 配置文件  By jab <mixboy@gmail.com> */

$GLOBALS['CROND_TIMER'] = array(
    /* 配置支持的格式 */
    'the_format' => array(
        '*', //每分钟
        '*:i', //每小时 某分
        'H:i', //每天 某时:某分
        '@-w H:i', //每周-某天 某时:某分  0=周日
        '*-d H:i', //每月-某天 某时:某分
        'm-d H:i', //某月-某日 某时-某分
        'Y-m-d H:i', //某年-某月-某日 某时-某分
    ),
    /* 配置执行的文件 */
    'the_time' => array(
        /* 每天 某时:某分 */
//电影网  爱奇艺 土豆优酷 迅雷看看 56网 PPS 风行  华数影视 央视网 凤凰视频 酷6  pptv  乐视网

//华数
        //华数全量
/*
        '2014-12-01 15:05' => array('crond_huashu_tv.php'),
        '2015-02-09 11:03' => array('crond_huashu_catoon.php'),
*/
/*


		'2015-11-13 03:00' => array('crond_sohu_anime_all.php'),
		'2015-11-13 04:00' => array('crond_sohu_tv_all.php'),
		'2015-11-13 04:30' => array('crond_sohu_zongyi_all.php'),
		'2015-11-13 05:00' => array('crond_sohu_movie_all.php'),
		*/
		
		//'12:20' => array('crond_sohu_tv_all.php'),
		//'14:42' => array('crond_hunantv_all.php'),
		//'2016-07-11 17:35' => array('crond_m1905_fufei_all.php'),
		//APP0
		'13:55' => array('crond_web_list.php'),
		'13:55' => array('wxihua_xingzuowu_yunshi.php'),
		'12:22' => array('wxihua_xingzuowu_xingzuo.php'),
		'12:15' => array('wxihua_xingzuowu_shuxiang.php'),
		'12:25' => array('wxihua_xingzuowu_fengshui.php'),
		'12:35' => array('wxihua_xingzuowu_ceshi.php'),
		'11:27' => array('wxihua_shenpo_xingzuo.php'),
		'11:30' => array('wxihua_shenpo_shengxiao.php'),
		'11:34' => array('wxihua_shenpo_fengshui.php'),
		'11:18' => array('wxihua_shenpo_bazi.php'),
		'11:38' => array('wxihua_zgjmorg_yunfu.php'),
		
    ),
);
?>
