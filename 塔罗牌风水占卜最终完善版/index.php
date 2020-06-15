<?php
header('Content-Type: text/html; charset=utf-8');
$page_start_time = microtime(true); //程序开始执行时间
require './core/init.php';
/*
 * core是框架核心存放目录
 * Ylmf-PHP框架的入口点都是加载 init.php来初始化的
 * */


$config_pool_name = $config_appname  =  $config_cp_url = '';

/*
 * $config_pool_name:应用池参数(与权限管理有关)
 * $config_appname:应用名称(与模板文件夹有关，不一定与应用池名称一致)
 * $config_cp_url:用于未登录用户跳转到的url
 * */


run_controller();


/*
 * 实例化control
 * 调用control->method();
 * */
