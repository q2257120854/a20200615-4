<?php

if (!defined('CORE')) {
    exit('Request Error!');
}
class req
{
    public static $cookies = array();
    public static $forms = array();
    public static $gets = array();
    public static $posts = array();
    public static $request_mdthod = 'GET';
    public static $files = array();
    public static $url_rewrite = false;
    public static $filter_filename = '/\\.(php|pl|sh|js)$/i';
    public static function init()
    {
        if (empty($_SERVER['REQUEST_METHOD'])) {
            return false;
        }
        $magic_quotes_gpc = ini_get('magic_quotes_gpc');
        self::$url_rewrite = isset($GLOBALS['config']['use_rewrite']) ? $GLOBALS['config']['use_rewrite'] : false;
        self::$request_mdthod = '';
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::$request_mdthod = 'GET';
            $request_arr = $_GET;
        } else {
            if (self::$request_mdthod == 'POST') {
                self::$request_mdthod = 'POST';
                $request_arr = $_POST;
            } else {
                self::$request_mdthod = $_SERVER['REQUEST_METHOD'];
                $request_arr = $_REQUEST;
            }
        }
        if (count($request_arr) > 0) {
            foreach ($request_arr as $k => $v) {
                if (preg_match('/^config/i', $k)) {
                    throw new Exception('request var name not alllow!');
                    exit;
                }
                if (!$magic_quotes_gpc) {
                    self::add_s($v);
                }
                self::$forms[$k] = $v;
                if (self::$request_mdthod == 'POST') {
                    self::$posts[$k] = $v;
                } else {
                    if (self::$request_mdthod == 'GET') {
                        self::$gets[$k] = $v;
                    }
                }
            }
        }
        if (!self::$forms['ct']) {
            self::$forms['ct'] = $_REQUEST['ct'];
        }
        if (!self::$forms['ac']) {
            self::$forms['ac'] = $_REQUEST['ac'];
        }
        unset($_POST, $_GET, $_REQUEST);
        if (self::$url_rewrite) {
            $gstr = empty($_SERVER['QUERY_STRING']) ? '' : $_SERVER['QUERY_STRING'];
            if (empty($gstr)) {
                $gstr = empty($_SERVER['PATH_INFO']) ? '' : $_SERVER['PATH_INFO'];
            }
        }
        self::$forms['ct'] = isset(self::$forms['ct']) ? self::$forms['ct'] : 'index';
        self::$forms['ac'] = isset(self::$forms['ac']) ? self::$forms['ac'] : 'index';
        if (count($_COOKIE) > 0) {
            if (!$magic_quotes_gpc) {
                self::add_s($_COOKIE);
            }
            foreach ($_COOKIE as $k => $v) {
                self::$cookies[$k] = $v;
            }
        }
        if (isset($_FILES) && count($_FILES) > 0) {
            if (!$magic_quotes_gpc) {
                self::add_s($_FILES);
            }
            self::filter_files($_FILES);
        }
    }
    public static function add_s(&$array)
    {
        if (!is_array($array)) {
            $array = addslashes($array);
        } else {
            foreach ($array as $key => $value) {
                if (!is_array($value)) {
                    $array[$key] = addslashes($value);
                } else {
                    self::add_s($array[$key]);
                }
            }
        }
    }
    public static function myeval($phpcode)
    {
        return eval($phpcode);
    }
    public static function item($formname, $defaultvalue = '')
    {
        return isset(self::$forms[$formname]) && self::$forms[$formname] != '' ? self::$forms[$formname] : $defaultvalue;
    }
    public static function post($formname, $defaultvalue = '')
    {
        preg_match('/[\\w][\\w-]*\\.(?:com\\.cn|com|cn|co|net|org|gov|cc|biz|info|top|xin)/isU', URL, $domain);
        return isset(self::$forms[$formname]) && self::$forms[$formname] != '' ? self::$forms[$formname] : $defaultvalue;
    }
    public static function upfile($formname, $defaultvalue = '')
    {
        return isset(self::$files[$formname]['tmp_name']) && self::$files[$formname]['tmp_name'] != '' ? self::$files[$formname]['tmp_name'] : $defaultvalue;
    }
    public static function filter_files(&$files)
    {
        foreach ($files as $k => $v) {
            self::$files[$k] = $v;
        }
        unset($_FILES);
    }
    public static function move_upload_file($formname, $filename, $filetype = '')
    {
        if (self::is_upload_file($formname)) {
            if (preg_match(self::$filter_filename, $filename)) {
                return false;
            } else {
                return move_uploaded_file(self::$files[$formname]['tmp_name'], $filename);
            }
        }
    }
    public static function get_shortname($formname)
    {
        $filetype = strtolower(isset(self::$files[$formname]['type']) ? self::$files[$formname]['type'] : '');
        $shortname = '';
        switch ($filetype) {
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
            default:
                $filename = isset(self::$files[$formname]['name']) ? self::$files[$formname]['name'] : '';
                if (preg_match('/\\./', $filename)) {
                    $fs = explode('.', $filename);
                    $shortname = strtolower($fs[count($fs) - 1]);
                }
                break;
        }
        return $shortname;
    }
    public static function get_file_info($formname, $item = '')
    {
        if (!isset(self::$files[$formname]['tmp_name'])) {
            return false;
        } else {
            if ($item == '') {
                return self::$files[$formname];
            } else {
                return isset(self::$files[$formname][$item]) ? self::$files[$formname][$item] : '';
            }
        }
    }
    public static function is_upload_file($formname)
    {
        if (!isset(self::$files[$formname]['tmp_name'])) {
            return false;
        } else {
            return is_uploaded_file(self::$files[$formname]['tmp_name']);
        }
    }
    public static function check_subfix($formname, $subfix = 'csv')
    {
        if (self::get_shortname($formname) != $subfix) {
            return false;
        }
        return true;
    }
}