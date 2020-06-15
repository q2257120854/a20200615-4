<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');


function welcome_get_ads() {
	// load()->classs('cloudapi');
	$result = array();
	// $api = new CloudApi();
	// $result = $api->get('store', 'we7_index_a');
	return $result;
}



function welcome_notices_get() {
	global $_W;
	$order = !empty($_W['setting']['notice_display']) ? $_W['setting']['notice_display'] : 'displayorder';
	$article_table = table('article_notice');
	$article_table->orderby($order, 'DESC');
	$article_table->searchWithIsDisplay();
	$article_table->searchWithPage(0, 15);
	$notices = $article_table->getall();
	if(!empty($notices)) {
		foreach ($notices as $key => $notice_val) {
			$notices[$key]['url'] = url('article/notice-show/detail', array('id' => $notice_val['id']));
			$notices[$key]['createtime'] = date('Y-m-d', $notice_val['createtime']);
			$notices[$key]['style'] = iunserializer($notice_val['style']);
			$notices[$key]['group'] = empty($notice_val['group']) ? array('vice_founder' => array(), 'normal' => array()) : iunserializer($notice_val['group']);
			if (!empty($_W['user']['groupid']) && !empty($notice_val['group']) && !in_array($_W['user']['groupid'], $notices[$key]['group']['vice_founder']) && !in_array($_W['user']['groupid'], $notices[$key]['group']['normal'])) {
				unset($notices[$key]);
			}
		}
	}
	return $notices;
}

function welcome_database_backup_days() {
	$cachekey = cache_system_key('back_days');
	$cache = cache_load($cachekey);
	if (!empty($cache)) {
		return $cache;
	}
	$reductions = system_database_backup();
	if (!empty($reductions)) {
		$last_backup_time = 0;
		foreach ($reductions as $key => $reduction) {
			if ($reduction['time'] <= $last_backup_time) {
				continue;
			}
			$last_backup_time = $reduction['time'];
		}
		$backup_days = floor((time() - $last_backup_time) / (3600 * 24));
	} else {
		$backup_days = -1;
	}

	cache_write($cachekey, $backup_days, 12 * 3600);
	return $backup_days;
}
