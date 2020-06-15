<?php

namespace WY\app\libs;

use WY\app\libs\Res;
use WY\app\libs\Req;
if (!defined('WY_ROOT')) {
    exit;
}
class Log
{
    static $path = 'logs';
    static $type = '';
    function __construct()
    {
    }
    static function write($message)
    {
        $dir = WY_ROOT . '/../' . self::$path . '/';
        if (!file_exists($dir)) {
            @mkdir($dir, 0777, true);
        }
        if (!self::$type) {
            $filename = 'log_' . date('Y') . date('m') . date('d') . '.log';
        } else {
            $rand = Res::getRandomString(6);
            $filename = 'mysql_db.log';
        }
        $message = Req::server('PHP_SELF') . "\n" . $message . "\n" . date('Y-m-d H:i:s') . "\n" . Req::server('REMOTE_ADDR') . "\n\n";
        $fp = @fopen($dir . $filename, 'ab');
        @fwrite($fp, $message);
        @fclose($fp);
    }
}
?>