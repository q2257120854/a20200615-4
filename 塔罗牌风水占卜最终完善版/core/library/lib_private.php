<?php
/********************************
 * 为了保持框架文件的整洁性，所有项目自身私有的公共函数写在此文件
*********************************/

/**
 * 页面 302 跳转
 *
 * @param string $url
 * @return void
 */
function go_url($url)
{
    if (!headers_sent())
    {
        header("Location: " . $url);
    }
    else
    {
        echo "<script>window.location.href='{$url}';</script>";
    }
    exit();
}

/**
 * 提示消息
 *
 * @access public
 * @param string $msg
 * @param string $gourl
 * @param string $ico
 * @param string $title
 * @param int $limittime
 * @return void
 */
function show_msg($msg, $gourl = '', $ico = '', $title = '', $limittime = 3000)
{
    if(empty($gourl))
    {
        $gourl = empty($_SERVER['HTTP_REFERER'])  ? URL : $_SERVER['HTTP_REFERER'];
    }
    $ico_title = array('show'=>'提示', 'suc'=>'成功', 'err'=>'错误');

    if (empty($ico))
    {
        $ico = 'show';
    }

    if (empty($title))
    {
        $title = isset($ico_title[$ico]) ? $ico_title[$ico] : '提示';
    }

    cls_msgbox::show($title, $msg, $gourl, $ico, $limittime);
}

/**
 * 404
 *
 * @access public
 * @return void
 */
function show_404()
{
    go_url('/404.html');
}

/**
 * 抛出异常错误
 *
 * @access public
 * @param string $msg
 * @param int $code
 * @return void
 */
function _E($msg, $code = 0)
{
    throw new Exception($msg, $code);
}

/**
 * 记录日志信息
 *
 * @access public
 * @param mixed $msg
 * @param string $type error|warn|debug|crond
 * @return void
 */
function log_msg($msg, $type='debug')
{
    if (empty($msg) || empty($type))
    {
        return;
    }
    if (is_array($msg))
    {
        $msg = serialize($msg);
    }
    elseif ($msg instanceof Exception)
    {
        $msg = $msg -> getMessage();
    }

    //trace
    ob_start();
    debug_print_backtrace();
    $trace = ob_get_contents();
    ob_end_clean();

    $name = date('Y-m-d') . '.log';
    $path = path_exists(PATH_LOG . '/trace/' . strtolower($type));
    @error_log(date('Y-m-d H:i:s')."\n" . $msg . "\n" . $trace . "\n", 3, $path . '/' . $name);
}


/**
 * 截取字符串(UTF-8)
 *
 * @access public
 * @param string $str
 * @param int $len
 * @return string
 */
function strcut($str, $len=0, $extra="...")
{
    if (strlen($str) == 0 || $len == 0)
    {
        return '';
    }

    $code    = 'utf-8';
    $mb_len  = mb_strlen($str, $code);
    $str_len = strlen($str);
    $scale   = $str_len / $mb_len;

    $len *= round(3 / $scale);
    if ($mb_len > $len)
    {
        return mb_substr($str, 0, $len, $code) . $extra;
    }
    else
    {
        return $str;
    }
}


/**
 * 清理不在字段里的数据
 *
 * @access public
 * @param array $params
 * @param array $fields
 * @return mixed
 */
function strip_fields(&$params, $fields)
{
    $return = array();
    if (is_array($params) && is_array($fields))
    {
        foreach($fields as $k)
        {
            if (array_key_exists($k, $params))
            {
                $return[$k] = $params[$k];
            }
        }
        $params = $return;
    }

    return $return;
}


/**
 * 模板标题处理
 *
 * @access public
 * @param mixed $data
 * @param string $separator
 * @return void
 */
function assign_title($data, $separator = '_')
{
    static $title = '';
    if (is_array($data))
    {
        $data = implode($separator, $data);
    }
    $title = trim($data . $separator . $title, $separator);
    cls_template::assign('TITLE', $title);
}


/**
 * 检查字段
 *
 * @access public
 * @param array $data
 * @param array $required
 * @return bool
 */
function check_fields(&$data, $required)
{
    if (empty($data) || !is_array($data))
    {
        return FALSE;
    }

    foreach($required as $field)
    {
        if (!isset($data[$field]) || trim($data[$field]) == '')
        {
            return FALSE;
        }
    }

    return TRUE;
}

/**
 * 根据请求的参数输出 json 格式的数据
 *
 * @param mixed $data
 * @return null
 */
function json_print($data)
{
    if (!headers_sent())
    {
        header('Content-Type: application/json; Charset=UTF-8', true);
    }
    if (isset($data['state']))
    {
        $data['state'] = (int)$data['state'];
    }
    if (isset($data['code']))
    {
        $data['code'] = (int)$data['code'];
    }
    exit(json_encode($data));
}

/**
 * 检查是否手机访问
 * @return bool
 */
function is_mobile()
{
    $is_mobile = isset(cls_request::$forms['mobile']) ? cls_request::$forms['mobile'] : NULL;
    if ($is_mobile || (!isset($is_mobile) && in_array(mod_misc::agent2code(), array(1, 3, 9))))
    {
        return true;
    }
    return false;
}

/**
 * 发送请求数据
 * @param string $url
 * @param array|string $query
 * @param bool $use_post
 * @param int $timeout
 * @param bool $is_api
 * @return array
 */
function send_request($url, $query = '', $use_post = TRUE, $timeout = 3, $is_api = TRUE)
{
    $query = is_array($query) ? http_build_query($query) : $query;
    $ch    = curl_init();
    if ($use_post)
    {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    }
    elseif ($query)
    {
        $url .= (strpos($url, '?') === false ? '?' : '&') . $query;
    }

    @error_log(date('Y-m-d H:i:s')."\t".$url."\n", 3, PATH_LOG ."/url.log");

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    if ($is_api) {
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/114la-API/' . PHP_VERSION);
    }  else {
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 Chrome/25.0.1364.152 Safari/537.22');
    }
    $result = curl_exec($ch);
    $errno  = curl_errno($ch);
    $error  = curl_error($ch);
    curl_close($ch);
    return array(
        'errno' => $errno,
        'error' => $error,
        'result'=> $result,
    );
}

/**
 * 获取图片类型
 * @param string $img_file
 * @return string
 */
function get_image_type($img_file)
{
    $result = 'jpg';
    //直接通过扩展获取
    if (preg_match('/(jpe?g|gif|png|webp)/i', $img_file, $m))
    {
        return strtolower($m[1]);
    }

    return $result;

    //根据前几个字符串获取
    $context = stream_context_create(array(
            'http' => array(
                'timeout' => 10,
            ),
        )
    );

    $header = file_get_contents($img_file, false, $context, 0 , 5);
    if ($header{0} . $header{1} == "/x89/x50")
    {
        $result = 'png';
    }
    elseif ($header{0} . $header{1} == "/xff/xd8")
    {
        $result = 'jpg';
    }
    elseif ($header{0} . $header{1} . $header{2} == "/x47/x49/x46")
    {
        $result = 'gif';
    }
    return $result;
}

/**
 * 获得文件的扩展名
 * @param string $mime_type
 * @return string
 */
function get_ext_from_mime($mime_type)
{
    $shortname = 'jpg';
    switch ($mime_type)
    {
        case 'image/jpeg':
            $shortname = 'jpg';
            break;
        case 'image/pjpeg':
            $shortname = 'jpg';
            break;
        case 'image/gif':
            $shortname = 'gif';
            break;
        case 'image/png':
            $shortname = 'png';
            break;
        case 'image/xpng':
            $shortname = 'png';
            break;
        case 'image/wbmp':
            $shortname = 'bmp';
            break;
        case 'image/webp':
            $shortname = 'webp';
            break;
    }
    return $shortname;
}

    /**
 * 获取客户端类型
 * @return string
 */
function get_app_type()
{
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : '';
    if (!empty($user_agent))
    {
        $user_agent = strtolower($user_agent);
        if (strstr($user_agent, "android"))
        {
            return "android";
        }
        elseif (strstr($user_agent, "ios"))
        {
            return "ios";
        }
        elseif (strstr($user_agent, "ios"))
        {
            return "ipad";
        }

        return 'android';
    }

    return 'android';
}

/**
 * 获取缩略图地址
 * @param $source_url
 * @param int $size
 * @param bool $static
 * @return string
 */
function get_thumb_url($source_url, $size = 200, $static = true)
{
    return URL_IMG . sprintf('/thumb/%d%s/%s', $size, $static ? 's' : '', ltrim($source_url, '/'));
}

/** End of file lib_private.php */