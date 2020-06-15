<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
load()->model('extension');
load()->model('cloud');
load()->func('communication');
load()->func('db');
load()->model('system');

$cloud_ready = cloud_prepare();
if (is_error($cloud_ready)) {
	iajax(-1, $cloud_ready['message']);
}

$dos = array('process', 'get_upgrade_info', 'get_error_file_list', 'files', 'scripts', 'schemas', 'module_build', 'module_install', 'module_upgrade');
$do = in_array($do, $dos) ? $do : 'process';

if ('process' == $do) {
	$packet = cloud_build();
	if (is_error($packet)) {
		iajax(-1, $packet['message']);
	}
	$packet['database'] = array();
	if (!empty($packet) && (!empty($packet['upgrade']) || !empty($packet['install']))) {
		$schemas = array();
		if (!empty($packet['schemas'])) {
			$packet['database'] = cloud_build_schemas($packet['schemas']);
			foreach ($packet['database'] as $key => $schema) {
				$packet['database'][$key]['tablename'] = substr($schema['tablename'], 4);
			}
			unset($packet['schemas']);
		}
		$scripts = array();
		if (empty($packet['install'])) {
			$updatefiles = array();
			if (!empty($packet['scripts']) && empty($packet['type'])) {
				$updatedir = IA_ROOT . '/data/update/';
				load()->func('file');
				rmdirs($updatedir, true);
				mkdirs($updatedir);
				$cversion = IMS_VERSION;
				$crelease = IMS_RELEASE_DATE;
				foreach ($packet['scripts'] as $script) {
					if ($script['release'] <= $crelease) {
						continue;
					}
					$fname = "update({$crelease}-{$script['release']}).php";
					$crelease = $script['release'];
					$script['script'] = @base64_decode($script['script']);
					if (empty($script['script'])) {
						$script['script'] = <<<DAT
<?php
load()->model('setting');
setting_upgrade_version('{$packet['family']}', '{$script['version']}', '{$script['release']}');
return true;
DAT;
					}
					$updatefile = $updatedir . $fname;
					file_put_contents($updatefile, $script['script']);
					$updatefiles[] = $updatefile;
					$s = array_elements(array('message', 'release', 'version'), $script);
					$s['fname'] = $fname;
					$scripts[] = $s;
				}
			}
		}
	}
	$packet['scripts'] = $scripts ? $scripts : array();
	iajax(0, $packet);
}
if ('files' == $do && $_W['ispost']) {
	$ret = cloud_download($_GPC['path'], $_GPC['type']);
	if (is_error($ret)) {
		iajax(-1, $ret['message']);
	}
	iajax(0, 'success');
}
if ('scripts' == $do && $_W['ispost']) {
	$fname = trim($_GPC['fname']);
	$tipversion = safe_gpc_string($_GPC['tipversion']);
	$entry = IA_ROOT . '/data/update/' . $fname;
	if (is_file($entry) && preg_match('/^update\(\d{12}\-\d{12}\)\.php$/', $fname)) {
		set_time_limit(0);
		$evalret = include $entry;
		if (!empty($evalret)) {
			cache_build_users_struct();
			cache_build_setting();
			@unlink($entry);
			if ($tipversion) {
				$version_file = file_get_contents(IA_ROOT . '/framework/version.inc.php');
				$match_version = strpos($version_file, $tipversion);
				if ($match_version) {
					iajax(0, 'showtips');
				}
			}
			iajax(0, 'success');
		}
	}
	iajax(-1, 'failed');
}
if ('schemas' == $do && $_W['ispost']) {
	$tablename = $_GPC['table'];
	$packet = cloud_build();
	foreach ($packet['schemas'] as $schema) {
		if (substr($schema['tablename'], 4) == $tablename) {
			$remote = $schema;
			break;
		}
	}
	if (!empty($remote)) {
		load()->func('db');
		$local = db_table_schema(pdo(), $tablename);
		$sqls = db_table_fix_sql($local, $remote);
		$error = false;
		foreach ($sqls as $sql) {
			if (false === pdo_query($sql)) {
				$error = true;
				$errormsg .= pdo_debug(false);
				break;
			}
		}
		if (!$error) {
			iajax(0, 'success');
		}
	}
	iajax(-1, 'failed');
}

if ('get_error_file_list' == $do) {
	$error_file_list = array();
	cloud_file_permission_pass($error_file_list);
	iajax(0, !empty($error_file_list) ? $error_file_list : array());
}
if ('get_upgrade_info' == $do) {
	$upgrade = cloud_build(true);
	if (is_error($upgrade)) {
		iajax(-1, $upgrade['message']);
	}

	if (!$upgrade['upgrade']) {
		cache_delete(cache_system_key('checkupgrade'));
		cache_delete(cache_system_key('cloud_transtoken'));
		iajax(0, array());
	}
	if (!empty($upgrade['schemas'])) {
		$upgrade['database'] = cloud_build_schemas($upgrade['schemas']);
		unset($upgrade['schemas']);
	} else {
		$upgrade['database'] = array();
	}
	if (!empty($upgrade['files'])) {
		foreach ($upgrade['files'] as &$file) {
			if (is_file(IA_ROOT . $file)) {
				$file = 'M ' . $file;
			} else {
				$file = 'A ' . $file;
			}
		}
		unset($value);
	}
	iajax(0, $upgrade);
}

if ('module_build' == $do) {
	$m = safe_gpc_string($_GPC['m']);
	$type = 'module';
	$is_upgrade = intval($_GPC['is_upgrade']);
	$packet = cloud_m_build($m, $is_upgrade ? 'upgrade' : '');
	if (is_error($packet)) {
		iajax(-1, $packet['message']);
	}
	$manifest = ext_module_manifest_parse($packet['manifest']);
	if (empty($manifest)) {
		iajax(-1, '模块安装配置文件不存在或是格式不正确，请刷新重试！');
	}
	if (!empty($manifest['platform']['main_module'])) {
		$main_module_fetch = module_fetch($manifest['platform']['main_module']);
		if (empty($main_module_fetch)) {
			iajax(-1, '请先安装主模块后再安装插件');
		}
	}
		if (!empty($packet) && !json_encode($packet['scripts'])) {
		iajax(-1, '模块安装脚本有代码错误，请联系开发者解决！');
	}
	unset($packet['manifest'], $packet['sql'], $packet['token'], $packet['scripts'], $packet['schemas']);
	iajax(0, $packet);
}

if (in_array($do, array('module_install', 'module_upgrade'))) {
	$module_name = safe_gpc_string($_GPC['m']);
	$module_exists = table('modules')->getByName($module_name);
	$module_info = cloud_m_info($module_name);
	if (is_error($module_info)) {
		iajax(-1, $module_info['message']);
	}
	$packet = cloud_m_build($module_name, 'install');
	$manifest = ext_module_manifest_parse($packet['manifest']);
	if (empty($manifest)) {
		iajax(-1, '模块安装配置文件不存在或是格式不正确！');
	}
	if (!empty($_GPC['install_module_support'])) {
		$module_support_name = $_GPC['install_module_support'];
	}
	$module_all_support = module_support_type();
	if ($module_exists) {
		$do = 'module_upgrade';
		$has_new_support = true;
	}
}
if ('module_install' == $do) {
	if (!empty($manifest['platform']['main_module'])) {
		$main_module_fetch = module_fetch($manifest['platform']['main_module']);
		if (empty($main_module_fetch)) {
			iajax(-1, '请先安装主模块后再安装插件');
		}
		$plugin_exist = table('modules_plugin')->getPluginExists($manifest['platform']['main_module'], $manifest['application']['identifie']);
		if (empty($plugin_exist)) {
			pdo_insert('modules_plugin', array('main_module' => $manifest['platform']['main_module'], 'name' => $manifest['application']['identifie']));
		}
	}

	$check_manifest_result = ext_manifest_check($module_name, $manifest);
	if (is_error($check_manifest_result)) {
		iajax(-1, $check_manifest_result['message']);
	}
	$check_file_result = ext_file_check($module_name, $manifest);
	if (is_error($check_file_result)) {
		iajax(-1, '模块缺失文件，请检查模块文件中site.php, processor.php, module.php, receiver.php 文件是否存在！');
	}

	$module = ext_module_convert($manifest);

	if (file_exists(IA_ROOT . '/addons/' . $module['name'] . '/icon-custom.jpg')) {
		$module['logo'] = 'addons/' . $module['name'] . '/icon-custom.jpg';
	} else {
		$module['logo'] = 'addons/' . $module['name'] . '/icon.jpg';
	}
	if (!empty($manifest['platform']['plugin_list'])) {
		foreach ($manifest['platform']['plugin_list'] as $plugin) {
			pdo_insert('modules_plugin', array('main_module' => $manifest['application']['identifie'], 'name' => $plugin));
		}
	}
	$points = ext_module_bindings();
	if (!empty($points)) {
		$bindings = array_elements(array_keys($points), $module, false);
		table('modules_bindings')->deleteByName($manifest['application']['identifie']);
		foreach ($points as $name => $point) {
			unset($module[$name]);
			if (is_array($bindings[$name]) && !empty($bindings[$name])) {
				foreach ($bindings[$name] as $entry) {
					$entry['module'] = $manifest['application']['identifie'];
					$entry['entry'] = $name;
					if ('page' == $name && !empty($wxapp_support)) {
						$entry['url'] = $entry['do'];
						$entry['do'] = '';
					}
					table('modules_bindings')->fill($entry)->save();
				}
			}
		}
	}

	$module['permissions'] = iserializer($module['permissions']);

	$module_subscribe_success = true;
	if (!empty($module['subscribes'])) {
		$subscribes = iunserializer($module['subscribes']);
		if (!empty($subscribes)) {
			$module_subscribe_success = ext_check_module_subscribe($module['name']);
		}
	}

	if (!empty($module_info['version']['cloud_setting'])) {
		$module['settings'] = 2;
	}

	$module['title_initial'] = get_first_pinyin($module['title']);

	if ($packet['schemes']) {
		foreach ($packet['schemes'] as $remote) {
			$remote['tablename'] = trim(tablename($remote['tablename']), '`');
			$local = db_table_schema(pdo(), $remote['tablename']);
			$sqls = db_table_fix_sql($local, $remote);
			foreach ($sqls as $sql) {
				pdo_run($sql);
			}
		}
	}

	ext_module_run_script($manifest, 'install');

	if (!empty($module_support_name)) {
		$module_support_name_arr = explode(',', $module_support_name);
		foreach ($module_all_support as $support => $value) {
			if (!in_array($support, $module_support_name_arr)) {
				$module[$support] = $value['not_support'];
			}
		}
	}
	
		$module_store_goods_info = pdo_get('site_store_goods', array('module' => $module_name));
		if (!empty($module_store_goods_info) && 1 == $module_store_goods_info['is_wish']) {
			$module['title'] = $module_store_goods_info['title'];
			$module['title_initial'] = get_first_pinyin($module_store_goods_info['title']);
			$module['logo'] = $module_store_goods_info['logo'];
		}
	$module['from'] = 'cloud';

	if (pdo_insert('modules', $module)) {
			foreach ($module_all_support as $support => $value) {
				if ($module[$support] == $value['support']) {
					module_delete_store_wish_goods($module_name, $support);
				}
			}
			$store_goods_id = pdo_getcolumn('site_store_goods', array('module' => $module['name'], 'is_wish' => 1), 'id');
			if (!empty($store_goods_id)) {
				$store_goods_orders = pdo_getall('site_store_order', array('goodsid' => $store_goods_id));
			}
			if (!empty($store_goods_orders)) {
				foreach ($store_goods_orders as $store_order_info) {
					cache_build_account_modules($store_order_info['uniacid']);
				}
			}
		
		foreach ($module_all_support as $support => $value) {
			if ($module[$support] == $value['support']) {
				$install_support[$value['type']] = array('is_install' => 2);
			}
		}
		cloud_m_query(array($module_name => array('name' => $module_name, 'version' => $module['version'], 'support' => $install_support)));
		cache_build_module_subscribe_type();
		cache_build_module_info($module_name);
		cache_build_uni_group();
		cache_delete(cache_system_key('user_modules', array('uid' => $_W['uid'])));
		if (MODULE_SUPPORT_SYSTEMWELCOME_NAME == $module_support_name) {
			iajax(0, 'success');
		}
		iajax(0, 'success');
	} else {
		iajax(-1, '模块安装失败, 请联系模块开发者！');
	}
}
if ('module_upgrade' == $do) {
	$check_manifest_result = ext_manifest_check($module_name, $manifest);
	if (is_error($check_manifest_result)) {
		iajax(-1, $check_manifest_result['message']);
	}

	$check_file_result = ext_file_check($module_name, $manifest);
	if (is_error($check_file_result)) {
		iajax(-1, $check_file_result['message']);
	}

	if (!empty($manifest['platform']['plugin_list'])) {
		pdo_delete('modules_plugin', array('main_module' => $manifest['application']['identifie']));
		foreach ($manifest['platform']['plugin_list'] as $plugin) {
			pdo_insert('modules_plugin', array('main_module' => $manifest['application']['identifie'], 'name' => $plugin));
		}
	}

	$module_upgrade = ext_module_convert($manifest);
	unset($module_upgrade['name'], $module_upgrade['title'], $module_upgrade['ability'], $module_upgrade['description']);

		$points = ext_module_bindings();
	$bindings = array_elements(array_keys($points), $module_upgrade, false);
	foreach ($points as $point_name => $point_info) {
		unset($module_upgrade[$point_name]);
		if (is_array($bindings[$point_name]) && !empty($bindings[$point_name])) {
			foreach ($bindings[$point_name] as $entry) {
				$entry['module'] = $manifest['application']['identifie'];
				$entry['entry'] = $point_name;
				if ('page' == $point_name && !empty($wxapp_support)) {
					$entry['url'] = $entry['do'];
					$entry['do'] = '';
				}
				if ($entry['title'] && $entry['do']) {
										$not_delete_do[] = $entry['do'];
					$module_binding = table('modules_bindings')->getByEntryDo($module_name, $point_name, $entry['do']);
					if (!empty($module_binding)) {
						pdo_update('modules_bindings', $entry, array('eid' => $module_binding['eid']));
						continue;
					}
				} elseif ($entry['call']) {
					$not_delete_call[] = $entry['call'];
					$module_binding = table('modules_bindings')->getByEntryCall($module_name, $point_name, $entry['call']);
					if (!empty($module_binding)) {
						pdo_update('modules_bindings', $entry, array('eid' => $module_binding['eid']));
						continue;
					}
				}
				pdo_insert('modules_bindings', $entry);
			}
						$modules_bindings_table = table('modules_bindings');
			$modules_bindings_table
				->searchWithModuleEntry($manifest['application']['identifie'], $point_name)
				->where('call', '')
				->where('do !=', empty($not_delete_do) ? '' : $not_delete_do)
				->delete();
						$modules_bindings_table
				->searchWithModuleEntry($manifest['application']['identifie'], $point_name)
				->where('do', '')
				->where('title', '')
				->where('call !=', empty($not_delete_call) ? '' : $not_delete_call)
				->delete();
			unset($not_delete_do, $not_delete_call);
		} else {
			table('modules_bindings')->searchWithModuleEntry($manifest['application']['identifie'], $point_name)->delete();
		}
	}

	if ($packet['schemes']) {
		foreach ($packet['schemes'] as $remote) {
			$remote['tablename'] = trim(tablename($remote['tablename']), '`');
			$local = db_table_schema(pdo(), $remote['tablename']);
			$sqls = db_table_fix_sql($local, $remote);
			foreach ($sqls as $sql) {
				pdo_run($sql);
			}
		}
	}

	ext_module_run_script($manifest, 'upgrade');

	$module_upgrade['permissions'] = iserializer($module_upgrade['permissions']);
	if (!empty($module_info['version']['cloud_setting'])) {
		$module_upgrade['settings'] = 2;
	} else {
		$module_upgrade['settings'] = empty($module_upgrade['settings']) ? 0 : 1;
	}

	if ($has_new_support && !empty($module_support_name)) {
		$module_upgrade['cloud_record'] = STATUS_ON;
		$module_support_name_arr = explode(',', $module_support_name);
		foreach ($module_all_support as $support_name => $info) {
			if (!in_array($support_name, $module_support_name_arr)) {
				$module_upgrade[$support_name] = $module_exists[$support_name];
			}
		}
	}

	pdo_update('modules', $module_upgrade, array('name' => $module_name));
	foreach ($module_all_support as $support => $value) {
		if ($module_exists[$support] == $value['support']) {
			$install_support[$value['type']] = array('is_install' => 2);
		}
	}
	cloud_m_query(array($module_name => array('name' => $module_name, 'version' => $module_exists['version'], 'support' => $install_support)));
	cache_build_account_modules();
	if (!empty($module_upgrade['subscribes'])) {
		ext_check_module_subscribe($module_name);
	}
	cache_delete(cache_system_key('cloud_transtoken'));
	cache_build_module_info($module_name);
	cache_build_uni_group();
	if ($has_new_support) {
		
			foreach ($module_all_support as $support_name => $info) {
				if ($module_upgrade[$support_name] == $info['support']) {
					module_delete_store_wish_goods($module_name, $support_name);
				}
			}
	}
	iajax(0, 'success');
}
