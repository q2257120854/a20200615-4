<?php
//简单路由设置、系统配置
namespace xh;
class init{
    //构造函数、构造系统结构以及初始化模块
    function __construct($params) {
        $this->protocol($params['protocol']);
        $this->route($params['route'],$params['global']);
    }

    //网页协议头设置
    private function protocol($params){
        switch ($params['errorLevel'])
        {
            case 0:
                // 关闭错误报告
                error_reporting(0);
                break;
            case 1:
                // 报告 runtime 错误
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                break;
            case 2:
                // 报告所有错误
                error_reporting(E_ALL);
                break;
            case 3:
                // 报告 E_NOTICE 之外的所有错误
                error_reporting(E_ALL & ~E_NOTICE);
                break;
        }
        //自动设置程序为UTF-8编码
        header('Content-Type:text/html;charset=utf-8');
        //SESSION会话支持
        if ($params['session'] === true) {
            session_start();
        }
        //浏览器缓冲区开启
        if ($params['OB_CACHE'] === true){
            ob_start();
        }
        //设置当前时区
        date_default_timezone_set($params['timezone']);
    }
    
    //导入库以及路径
    private function global_config($params,$params2,$params3){
        //扩展函数功能库目录路径
        define('PATH_UNITY', $params['unityPath']);
        //当前模块名称
        define('MODEL_NAME', $params2['module']);
        //定义静态目录绝对地址
        define('PATH_STATIC', ROOT_PATH . '/static/');
        //定义私有库路径
        define('PATH_PRIVATE', ROOT_PATH . '/extend/private/');
        //当前模块下的模型绝对路径
        define('PATH_MODEL', ROOT_PATH . '/run/' . $params2['module'] . '/model/');
        //当前模块下的视图绝对路径
        define('PATH_VIEW', ROOT_PATH . '/run/' . $params2['module'] . '/view/');

        define('PATH_DOWNLOAD', ROOT_PATH . '/download/');
        //载入数据库配置信息
        require (ROOT_PATH . '/config.php');
        //伪静态
        define('URL_REWRITE', $params3['rewrite']);
        //路由权重
        define('URL_WEIGHT', $params3['routingWeight']);
        //定义url根物理路径
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

        define('URL_ROOT', str_replace("\\", "", $http_type . trim( $_SERVER['HTTP_HOST'] .  dirname($_SERVER['SCRIPT_NAME']),"/")));
        //定义视图静态访问目录
        define('URL_VIEW', URL_ROOT . '/run/' . MODEL_NAME . '/view/');
        //定义静态目录url
        define('URL_STATIC', URL_ROOT . '/static/');
        //定义url后缀
        define('URL_FIX', $params3['fix']);
        //自动加载library本地库地址
        if($handle = opendir($params['libraryPath'])){
            while (false !== ($file = readdir($handle))){
               //检测是否为php文件
                if (substr(strrchr($file, "."), 1) == 'php'){
                   //库路径
                   require_once ($params['libraryPath'] . $file);
                }
            }
            closedir($handle);
        }
        //自动加载功能扩展对象库
        if($unity = opendir($params['unityPath'])){
            while (false !== ($file = readdir($unity))){
                //检测是否为php文件
                if (substr(strrchr($file, "."), 1) == 'php'){
                    //库路径
                    require_once ($params['unityPath'] . $file);
                }
            }
            closedir($unity);
        }
    }

    
    //路由
    private function route($params,$params2){
        $_gk = array();
        foreach ($_GET as $key => $val){
            $_gk[] = $key;
        }
        // 0 - 模块   1 - 控制器  2 - 方法
        $arg = explode("_", str_replace('.', '_', $_gk[0]));
        //删除arg 0 路由信息，防止出错
        unset($_GET[$_gk[0]]);
        //构造路由信息
        $routingInfo = $this->routingAuto(array(
            //路径权重
            'weight'=>$params['routingWeight'],
            //默认路径
            'default'=>explode('.', $params['default']),
            //访问路径
            'visit'=>$arg
        ));
        //启动配置
        $this->global_config($params2,$routingInfo,$params);
        //控制器路径
        require_once (ROOT_PATH . '/run/' . $routingInfo['module'] . '/controller/' . $routingInfo['controller'] . '.php');
        //控制器命名空间
        $namespace = 'xh\run\\'. $routingInfo['module'] .'\\controller\\' . $routingInfo['controller'];
        //实例化控制器
        $routeInit = new $namespace();
        //访问
        $action = $routingInfo['action'];
        //渲染界面
        $routeInit->$action();
    }
    
    
    /**
     * 构造路由信息
     * @param unknown $params
     * @return unknown[] 数组
     */
    protected function routingAuto($params){
        //初始化
        $routingArray = array();
        //权力分配
        switch ($params['weight']){
            //权0 满配
            case 0:
                //模块
                if ($params['visit'][0] != ''){
                    $routingArray['module'] = $params['visit'][0];
                }else{
                    $routingArray['module'] = $params['default'][0];
                }
                //控制器
                if ($params['visit'][1] != ''){
                    $routingArray['controller'] = $params['visit'][1];
                }else{
                    $routingArray['controller'] = $params['default'][1];
                }
                //方法
                if ($params['visit'][2] != ''){
                    $routingArray['action'] = $params['visit'][2];
                }else{
                    $routingArray['action'] = $params['default'][2];
                }
                break;
            case 1:
                //模块
                    $routingArray['module'] = $params['default'][0];
                //控制器
                if ($params['visit'][0] != ''){
                    $routingArray['controller'] = $params['visit'][0];
                }else{
                    $routingArray['controller'] = $params['default'][1];
                }
                //方法
                if ($params['visit'][1] != ''){
                    $routingArray['action'] = $params['visit'][1];
                }else{
                    $routingArray['action'] = $params['default'][2];
                }
                break;
            case 2:
                //模块
                $routingArray['module'] = $params['default'][0];
                //控制器
                $routingArray['controller'] = $params['default'][1];
                //方法
                if ($params['visit'][0] != ''){
                    $routingArray['action'] = $params['visit'][0];
                }else{
                    $routingArray['action'] = $params['default'][2];
                }
                break;
                
        }
        
        return $routingArray;
    }
    
    
}