<?php
namespace xh\library;
class url{
    
    //url自动解析
    static public function s($stringIndex,$data_url=NULL){
        $indexArray = explode("/", trim($stringIndex,'/'));
        $durl = '';
        if (URL_REWRITE === true){
            if (!empty($data_url)){
                $data_url = trim($data_url , '&');
                $durl =  '?' . $data_url;
            }
            
            if (URL_WEIGHT == 0){
                //url权0
                $urlc = URL_ROOT . '/' . $indexArray[0] . '/' . $indexArray[1] . '/' . $indexArray[2] . URL_FIX . $durl;
            }
            if (URL_WEIGHT == 1){
                //url权1
                $urlc = URL_ROOT . '/' . $indexArray[0] . '/' . $indexArray[1] . URL_FIX  . $durl;
            }
            if (URL_WEIGHT == 2){
                //url权1
                $urlc = URL_ROOT . '/' . $indexArray[0] . URL_FIX . $durl;
            }
        }else{
            if (!empty($data_url)){
                $data_url = trim($data_url , '&');
                $durl =  '&' . $data_url;
            }
            if (URL_WEIGHT == 0){
                //url权0
                $urlc = URL_ROOT . '?' . $indexArray[0] . '.' . $indexArray[1] . '.' . $indexArray[2] . $durl;
            }
            if (URL_WEIGHT == 1){
                //url权1
                $urlc = URL_ROOT . '?' . $indexArray[0] . '.' . $indexArray[1] . $durl;
            }
            if (URL_WEIGHT == 2){
                //url权1
                $urlc = URL_ROOT . '?' . $indexArray[0]. $durl;
            }
        }
        return $urlc;
    }
    
    /**
     * 生成CSRF校验值
     * @return string
     */
    static public function found_csrf(){
        if (empty($_SESSION['_CSRF']) || (time() - $_SESSION['_CSRF']['time']) > 10){
            $_SESSION['_CSRF'] = array("value"=>substr(md5(mt_rand(10000,999999)), 0,mt_rand(12,24)),"time"=>time());
            return $_SESSION['_CSRF']['value'];
        }
        return $_SESSION['_CSRF']['value'];
    }
    /**
     * 验证CSRF
     */
    static public function check_csrf(){
        $csrf = request::filter('get._CSRF');
        if ($csrf == $_SESSION['_CSRF']['value']){
            if (time() - $_SESSION['_CSRF']['time'] > 1800){
                unset($_SESSION['_CSRF']);
                functions::json('404', '页面失效,请刷新后再操作!');
            }
        }else{
            functions::json('404', '页面失效,请刷新后再操作!');
        }
    }
    
    /**
     * URL跳转
     */
    static public function address($url,$msg='请稍后..',$time=0){
        header("Refresh:{$time};url={$url}");
        if ($time == 0) exit;
        require (ROOT_PATH . '/static/html/404.php');
        exit;
    }
    
    /**
     * 当前页面地址
     * @return string
     */
   static public function get(){
            $pageURL = 'http';
            if ($_SERVER["HTTPS"] == "on"){
                $pageURL .= "s";
            }
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80"){
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            }else{
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }
            return $pageURL;
    }
}