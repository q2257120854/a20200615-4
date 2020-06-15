<?php
/**用法
我们以GET变量类型为例，说明下I方法的使用：
echo I('get.id'); // 相当于 $_GET['id']
echo I('get.name'); // 相当于 $_GET['name']
复制代码
支持默认值：
echo I('get.id',0); // 如果不存在$_GET['id'] 则返回0
echo I('get.name',''); // 如果不存在$_GET['name'] 则返回空字符串
复制代码
采用方法过滤：
echo I('get.name','','htmlspecialchars'); // 采用htmlspecialchars方法对$_GET['name'] 进行过滤，如果不存在则返回空字符串
复制代码
支持直接获取整个变量类型，例如：
I('get.'); // 获取整个$_GET 数组
复制代码
用同样的方式，我们可以获取post或者其他输入类型的变量，例如：
I('post.name','','htmlspecialchars'); // 采用htmlspecialchars方法对$_POST['name'] 进行过滤，如果不存在则返回空字符串
I('session.user_id',0); // 获取$_SESSION['user_id'] 如果不存在则默认为0
I('cookie.'); // 获取整个 $_COOKIE 数组
I('server.REQUEST_METHOD'); // 获取 $_SERVER['REQUEST_METHOD'] 
复制代码
param变量类型是框架特有的支持自动判断当前请求类型的变量获取方式，例如：
echo I('param.id'); 
复制代码
如果当前请求类型是GET，那么等效于 $_GET['id']，如果当前请求类型是POST或者PUT，那么相当于获取 $_POST['id'] 或者 PUT参数id。
并且param类型变量还可以用数字索引的方式获取URL参数（必须是PATHINFO模式参数有效，无论是GET还是POST方式都有效），例如：
当前访问URL地址是
http://serverName/index.php/New/2013/06/01 
复制代码
那么我们可以通过
echo I('param.1'); // 输出2013
echo I('param.2'); // 输出06
echo I('param.3'); // 输出01
复制代码
事实上，param变量类型的写法可以简化为：
I('id'); // 等同于 I('param.id')
I('name'); // 等同于 I('param.name')
**/
namespace xh\library;
class request{
    static public function filter($name,$default='',$filter=null) {
        if(strpos($name,'.')) { // 指定参数来源
            list($method,$name) =   explode('.',$name,2);
        }else{ // 默认为自动判断
            $method =   'param';
        }
        switch(strtolower($method)) {
            case 'get'     :   $input =& $_GET;break;
            case 'post'    :   $input =& $_POST;break;
            case 'put'     :   parse_str(file_get_contents('php://input'), $input);break;
            case 'param'   :
                switch($_SERVER['REQUEST_METHOD']) {
                    case 'POST':
                        $input  =  $_POST;
                        break;
                    case 'PUT':
                        parse_str(file_get_contents('php://input'), $input);
                        break;
                    default:
                        $input  =  $_GET;
                }
                break;
            case 'request' :   $input =& $_REQUEST;   break;
            case 'session' :   $input =& $_SESSION;   break;
            case 'cookie'  :   $input =& $_COOKIE;    break;
            case 'server'  :   $input =& $_SERVER;    break;
            case 'globals' :   $input =& $GLOBALS;    break;
            default:
                return NULL;
        }
        if(empty($name)) { // 获取全部变量
            $data       =   $input;
            array_walk_recursive($data,'filter_exp');
            $filters    =   isset($filter)?$filter:self::cc('DEFAULT_FILTER');
            if($filters) {
                $filters    =   explode(',',$filters);
                foreach($filters as $filter){
                    $data   =   array_map_recursive($filter,$data); // 参数过滤
                }
            }
        }elseif(isset($input[$name])) { // 取值操作
            $data       =   $input[$name];
            is_array($data) && array_walk_recursive($data,'filter_exp');
            $filters    =   isset($filter)?$filter:self::cc('DEFAULT_FILTER');
            if($filters) {
                $filters    =   explode(',',$filters);
                foreach($filters as $filter){
                    if(function_exists($filter)) {
                        $data   =   is_array($data)?array_map_recursive($filter,$data):$filter($data); // 参数过滤
                    }else{
                        $data   =   filter_var($data,is_int($filter)?$filter:filter_id($filter));
                        if(false === $data) {
                            return   isset($default)?$default:NULL;
                        }
                    }
                }
            }
        }else{ // 变量默认值
            $data       =    isset($default)?$default:NULL;
        }
        return $data;
    }
    
    function array_map_recursive($filter, $data) {
        $result = array();
        foreach ($data as $key => $val) {
            $result[$key] = is_array($val)
            ? array_map_recursive($filter, $val)
            : call_user_func($filter, $val);
        }
        return $result;
    }
    
    static private function cc($name=null, $value=null,$default=null) {
        static $_config = array();
        // 无参数时获取所有
        if (empty($name)) {
            return $_config;
        }
        // 优先执行设置获取或赋值
        if (is_string($name)) {
            if (!strpos($name, '.')) {
                $name = strtolower($name);
                if (is_null($value))
                    return isset($_config[$name]) ? $_config[$name] : $default;
                    $_config[$name] = $value;
                    return;
            }
            // 二维数组设置和获取支持
            $name = explode('.', $name);
            $name[0]   =  strtolower($name[0]);
            if (is_null($value))
                return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
                $_config[$name[0]][$name[1]] = $value;
                return;
        }
        // 批量设置
        if (is_array($name)){
            $_config = array_merge($_config, array_change_key_case($name));
            return;
        }
        return null; // 避免非法参数
    }
}
