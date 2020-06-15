<?php
//数据库操作方式
define('DB_TYPE', 'pdo');
//主机地址
define('DB_HOST', '127.0.0.1');
//数据库名称
define('DB_NAME', '站码之家zhanmazj.com');
//数据库账号
define('DB_USER', '站码之家zhanmazj.com');
//数据库密码
define('DB_PWD', 'x6WHDdcNEHLtEXRH');
//数据库端口
define('DB_PORT', 3306);
//数据库编码
define('DB_CHAR', 'utf8');
//数据库前缀
define('DB_PREFIX', 'xh_');
//软件版本号
define('SYSTEM_VERSION', '1.0');
//网站名称
define('WEB_NAME', '站码之家支付');
//联系手机号码
define('WEB_MOBILE', '');
//联系QQ
define('WEB_QQ', "。");
//Redis配置 stop-writes-on-bgsave-error no
define("REDIS_ENABLE", true);
define("REDIS_PORT", 6379);
define("REDIS_HOST", '127.0.0.1');
define("REDIS_AUTH", '');

//server_bind_uid
define('SERVER_BIND_UID',5201314);

//数据库debug开启
define("DEBUG_LOG", true);
//CONFIG_SERVICE_INFO
define("DOMAINS_URL", 'www.zi~yuanbu.com');  //这里填写网站域名
define("ROOT_PATHS",  __DIR__);

//MQQT_INFO
define("MQQT_HOST",  '182.254.171.217');  //通讯服务器IP
define("MQQT_PORT",  61613);  //端口不用改
define("MQQT_USER",  'admin');  //通讯服务器用户名
define("MQQT_PASS",  'ackm2389'); //通讯服务器密码

//红包等待秒数
define("HONGBAO_TIME",  '120');  //红包等待秒数   