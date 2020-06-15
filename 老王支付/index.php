<?php

//花生米框架为你导航，请在php5.4版本或以上使用
use xh\init;
//设置根路径
define('ROOT_PATH', __DIR__);
//初始化入口
require ('extend/init.php');
//实例化入口
new init([
    //头设置
    'protocol'=>[
        //session会话支持开启
        'session'=>true,
        //时区设定
        'timezone'=>'PRC',
        //错误屏蔽级别[0:全部屏蔽,1:runtime错误,2:报告所有错误,3:报告E_NOTICE之外的错误]
        'errorLevel'=>0,
        //浏览器输出缓冲区
        'OB_CACHE'=>true,
    ],
    //路由设置
    'route'=>[
        //伪静态自动化
        'rewrite'=>true,
        //路由url权重 [0:模块/控制器/方法,1:控制器/方法,2:方法]
        'routingWeight'=>0,
        //设置默认加载
        'default'=>'index.index.home',
        //设置伪造后缀
        'fix'=>'.do'
    ],
    //全局配置设定
    'global'=>[
        //系统库路径，自动化加载该目录的所有文件，命名空间请按照类库名称命名
        'libraryPath' => ROOT_PATH . '/extend/library/',
        //函数支持库路径，该库下的类不会自动加载，但是可通过系统函数库调用外部函数
        'unityPath'=> ROOT_PATH . '/extend/unity/'
    ]
]);