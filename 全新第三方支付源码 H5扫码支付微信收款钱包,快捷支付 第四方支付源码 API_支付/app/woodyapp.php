<?php

namespace WY\app;

use WY\app\libs\Router;
use WY\app\libs\Log;
if (!defined('WY_ROOT')) {
    exit;
}
class woodyapp
{
    private static $instance = null;
    static $modelObj = null;
    function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }
    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new woodyapp();
        }
        return self::$instance;
    }
    public function loadClass($class)
    {
        $class = str_replace('WY\\app', '', $class);
        $class = str_replace('\\', '/', $class);
        $file = WY_ROOT . '' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            $msg = $class . ' load fail.';
            Log::$type = '';
            Log::write($msg);
            echo '<html><head><title>404</title><head><body>page not found.</body></html>';
            exit;
        }
    }
    public function run()
    {


        $router = Router::put();



		$houtaipath		=	Config::db()['path'];



		$router[0]	=	str_replace($houtaipath,"admfor035",$router[0]);

        if (file_exists(WY_ROOT . '/controller/' . $router[0])) {
            $className = !isset($router[1]) ? 'main' : $router[1];

            $class = __NAMESPACE__ . '\\controller\\' . $router[0] . '\\' . $className;
            if ($className == 'main') {
                $method = isset($router[1]) && $router[1] ? $router[1] : 'index';
            } else {
                $method = isset($router[2]) && $router[2] ? $router[2] : 'index';
            }
        } else {
            $class = __NAMESPACE__ . '\\controller\\' . $router[0];
            $method = isset($router[1]) && $router[1] ? $router[1] : 'index';
        }

        $object = new $class();
        $method = method_exists($object, $method) ? $method : 'index';
        $object->{$method}();
    }
	//juhesms

       
}