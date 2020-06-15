<?php
namespace WY\app\libs;

if (!defined('WY_ROOT')) {
    exit;
}
class Router
{
    static $uri = '/';
    static $router = array(0 => 'main', 1 => 'index');
    static function get()
    {
        if (Req::server('REQUEST_URI')) {
            self::$uri = Req::server('REQUEST_URI');
        }
        if (Req::server('REDIRECT_URL')) {
            self::$uri = Req::server('REDIRECT_URL');
        }
        if (Req::server('HTTP_X_REWRITE_URL')) {
            self::$uri = Req::server('HTTP_X_REWRITE_URL');
        }
        return self::$uri;
    }
    static function put()
    {
        self::get();
        if (strpos(self::$uri, '?')) {
            $arr = explode('?', self::$uri);
            self::$uri = $arr[0];
        }
        if (self::$uri == '/') {
            return self::$router;
        }
        $arr = explode('/', self::$uri);
        $arr2 = array();
        foreach ($arr as $val) {
            if ($val != '') {
                $arr2[] = $val;
            }
        }
        return $arr2;
    }
}
?>