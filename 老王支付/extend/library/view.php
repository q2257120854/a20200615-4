<?php
//视图操作类
namespace xh\library;
class view{
    public function __construct($path,$paramsArray=''){
        if (is_array($paramsArray)){
            foreach ($paramsArray as $key=>$value){
                $$key = $value;
            }
        }
        require (PATH_VIEW . $path . '.php');
    }
}