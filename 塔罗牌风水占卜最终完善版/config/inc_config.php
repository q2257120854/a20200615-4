<?php
if( !defined('CORE') ) exit('Request Error!');

//-------------------------------------------------------------
//基本常量
//-------------------------------------------------------------
define('OPEN_DEBUG', false);
define('PATH_MODEL', './model');
define('PATH_CONTROL', './control');
define('PATH_ROOT', substr(CORE, 0, -5) );
define('PATH_LIBRARY', CORE . '/library');
define('PATH_SHARE', CORE . '/share');
define('PATH_CONFIG', PATH_ROOT . '/config');
define('PATH_DATA', PATH_ROOT . '/data');
define('PATH_CACHE', PATH_DATA . '/cache');
define('PATH_DM_CONFIG', PATH_CONFIG . '/dm_config');

//正式环境中如果要考虑二级域名问题的应该用 .xxx.com
define('COOKIE_DOMAIN', '');
define('PHP_ERROR_LOG', false);//正式线上要改为false
//主应用URL
define('URL', 'http://www.xxxx.com/');//**结尾急需要带/

define('FILTER_KEYWORD', '115');//过滤词库  115 orther all
//缓存相关
define("CACHE_DATA", false);  //是否启用数据缓存
define("CACHE_PAGE",false);  //是否启用文件缓存
define("SYS_STR", "www114lacom@2014#11&14");    //114la用户登录后验证ssoid的加密串

//session类型 file || mysql || memcache
define('SESSION_TYPE', 'file');

define('WXAPPID'    , 'wx04d74152a89ebc31');
define('WXMCHID'   , '1528380971');
define('WXKEY'    , 'uhpzcpy24bnketnjodosffp4lxv2l5ul');
define('WXAPPSECRET'   , 'a97c8415782cd1c7170101f27ea40159');

//支付宝

define('ALIAPPID','2017021905752774');
define('ALIPRIVATE','MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCFaQEWdUC+G7FkIjiS3zXGLvoC3m47fgM4SI5WRipTGbFA79ZIER0FTF/GWqFKDuWAxmRj+fBXvivefHR8YMCRYb7+uhcgTbHHtrJ52fmnN8/tG3LKim10LEnOo1SZXakXO4OIZLTNvvLjVmvXKmwIuyytApL8WHizzYY6PjfUwmenDVV/A0ZEBGavBT2eoIfjeVyx0DhMo6LMprWUZupnA/Zx+eLhS2puMJHXEasTwqxPNyVuF8KplltJR++gCGon6LOnkgCVB9FM63zBe2fTypu0icLJOkzA5hSMc5gNDBWaXdJHv9790jRrR2ADLagMkD0M3ITPvKE7+/hIliTDAgMBAAECggEAFmy4ChZbc5kkEDjQWZ+7YjyzOZg53zYnRGatxkK1CpLfAJNP6X0265US5DyHr/MhEKxIY6W3iIgmx5cT3XRF6ioL+LU+/ecRYwiKp4DEPh9bi/d5LCJok4Z+QYWiysS7j3Qpf9utqIfYO+5i4h/3WOBdehdcrZ4Ra+e4EEI1EEX+3iDm18UxKHUpE5X0JOKn24dmmfoMxwD5zddXfOH6vn5OaEGuEG1mCi58VDIcKbXdRfj8MMtiDwTBqP6+MgbxEXpN/90mdeO8C4B32DR1ypL8l2dg4EC77hYbIfAtNhsRyA3wcPUk87z2dRoSXOs7IXP8ggTcovQ45zdmes6twQKBgQDI4d+xUg2bac7N4hdHCXn+s0eWN2IcDpxpWBUZ5b6aH4oS3oWGuyIbQJVjv92CCZqJcZwsYjJCud8rHwrIuu4QGU+AQaxBsEBT6Yz0ybTU/pGfxibiXelYi67hO62rAtAxvbSWqoGYiwWp5o/2RwJEZpibZqu5bTWr4Gjh5Jxo1QKBgQCqA9X2JZ2GGLb0n5b2hEKvKAgU5p2L81gTvim+6EGDZNNiZqXZ9k05zt9CG1SAJLHrj5Ajw8XUGTOMDrbxVaVXccv3e/KczR4UXa/h7vAUEFMH9br9/Njxoe0t7E3Y0MfiTVRyHKYP9LThGuuqpD4qR1vilCAX/BHuNpI2IUyjNwKBgQC+DMxoY3vSJCluqU9ierm7WXwJxz3/02bxV08nYC+SevJTZckoLZVX+SMc6yGy7EkTbbPWXdS1Qkq77jNysz+VZYzMh9VjlE9X1CbyVH7L4Eh/w6V4Fmc0yXpbRu3IU/IKjTL0ND5FxolGM4bR9l5Tvkj1BQ7EcGkNwlMYHARKPQKBgQCIiiYW1iTJYiXlFhouhw/rDdJXvtI+aEOPL4TlTi/3L01Y1KlUACwLRiolND/L3iyJyzVuk7bYXRj53YNtFGSCcuDlNEUnStBieM9dOwDSjD2ywdXYT22HuYz6+bGXdC1jgMlWD84KOHPf6TflRpyqZb7UnDOeL5HS5z7LfDjJRwKBgEjLfrQ82VQ3Vd/JPqzikwmi6TBy8ya2JLQa6VplawXYySLhKD6Bl/DXMVD/UOJ268ZfRmAF9xFnoRHyawUX62c7gFPY+OMiNHSa1Z/bMU8vOus1i2tUVFNAXU1FDBRo46CBlKt4bZDMy6liznLedLPOsOxImEWawDWGqSwYXKl6');
define('ALIPUBLIC','MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgdwHXm3o2RzD15IwChFqi/FqtZk7kl0L8p0SBM/j3ro+Qlj6fRCsQ/OPyLM6OsJRIZjgEp1v9xrRwZ3HaPu7jDdlwlHOt4pA/DgKy5Vc1MLSBUUzYmX3uDXgGwDnD9ATZOPM4COkBwZewrTaGQBPupSKRzY5b9Rr2ERJxWloidmCZ7XV0iybCkWmrUe8Z5W7RynRs64EN/O0adOVdjCZP4XuYdnZVdeM1GD0fF9CTDZCyM2l6YYLHQ0mHZ6KLoE3O7jKYgyGWdIyDiD8aZ2li8jL8qRXcl/bQJbAVqDgCtoSU0zQ5xyobXUSclmyFrjw2K3oHze5IR2vzk6zDPatxwIDAQAB');

//------------------------------------------------------------------------------------------
//配置变量，或系统定义的全局性变量，建议都用 config 开头，在路由器中默认拦截这种变量名
//------------------------------------------------------------------------------------------

//调试选项（指定某些IP允许开启调试，数组格式为 array('ip1', 'ip2'...)
$GLOBALS['config']['safe_client_ip'] = array( '192.168.1.145');

//网站日志配置
$GLOBALS['config']['log'] = array(
   'file_path' => PATH_DATA.'/log',
   'log_type'  => 'file',
);

//cache配置(df_prifix建议按网站名分开,如mc_114la_ / mc_tuan_ 等)
//cache_type一般是memcache，如无可用则用file，如有条件，用memcached
$GLOBALS['config']['cache'] = array(
    'enable'  => false,
    'cache_type' => 'file',
    'cache_time' => 7200,
    'file_cachename' => PATH_CACHE.'/cfc_data',
    'df_prefix' => 'mc_df_',
    'memcache' => array(
        'time_out' => 1,
        'host' => array( 'memcache://127.0.0.1:11212' )
    )
);

//MySql配置
//slave数据库从库可以使用多个
$GLOBALS['config']['db'] = array(
    'host'    => array(
        'master'  => '127.0.0.1',
        'slave' => array('127.0.0.1')
    ),
    'user'    => 'root',
    'pass'    => 'root',
    'name'    => 'demo',
    'charset' => 'utf-8',
);

//session
$GLOBALS['config']['session'] = array(
   'live_time' => 86400,
);

//默认时区
$GLOBALS['config']['timezone_set'] = 'Asia/Shanghai';

// url重写是否开启(本版仅在<{rewrite}><{/rewriet}>中使用rewrite替换有效)
// 此项需要修改 PATH_DATA/rewrite.ini
$GLOBALS['config']['use_rewrite'] = false;

//指示替换网址是在编译前还是输出前，0--前者性能好，1--后者替换更彻底(此项本版没意义)
$GLOBALS['config']['rewrite_rptype'] = 0;

//cookie加密码
$GLOBALS['config']['cookie_pwd'] = '&uop_Ysd@erw!tr';

//默认上传目录
$GLOBALS['config']['upload_dir'] = '/static/uploads';

//微博API APPKEY
$GLOBALS['config']['WB_AKEY'] = '870395067';
//微博API SECRETKEY
$GLOBALS['config']['WB_SKEY'] = '812a53e60e65201d4811a7d5bd07643a';
//微博API 登录回调URL
//$GLOBALS['config']['WB_CALLBACK_LOGINURL'] = 'http://gaoxiao.114la.com/admin30a7169208fb13d8972c/index.php?ct=weibo&ac=index';
