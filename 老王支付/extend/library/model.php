<?php
//模型操作类
namespace xh\library;
class model{
    public function load($package,$model){
        include_once (PATH_MODEL . $package . '/' . $model . '.php');
        $namespace = '\\xh\\run\\' . MODEL_NAME . '\\model\\' . $model;
        return new $namespace();
    }
}