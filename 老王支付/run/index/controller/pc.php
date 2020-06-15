<?php
namespace xh\run\index\controller;


use xh\library\model;
use xh\library\mysql;
use xh\library\functions;
use xh\library\request;


class pc{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    
    
    //ajax验证是否支持下载
    public function verification(){
        $pwd = functions::pwd(request::filter('get.pwd'), $_SESSION['MEMBER']['token']);
        //查询用户信息
        $pwd_server = $this->mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0];
        if ($pwd != $pwd_server['pwd']) functions::json(-1, '您的密码输入有误!');
        functions::json(200, '账户验证成功,下载中..');
    }
    
    
    //下载PC端
    public function download(){
        $pwd = functions::pwd(request::filter('get.pwd'), $_SESSION['MEMBER']['token']);
        //查询用户信息
        $pwd_server = $this->mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0];
        if ($pwd != $pwd_server['pwd']) functions::json(-1, '您的密码输入有误!');

        $filePath = ROOT_PATH . '/download/7b0506086cc37f9d444fab090ad90393.zip';
        $fileName = $_SESSION['MEMBER']['username'] . '.zip';
        
        $fp=fopen($filePath,"r");
        $file_size=filesize($filePath);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$fileName);
        $buffer=1024; //设置一次读取的字节数，每读取一次，就输出数据（即返回给浏览器）
        $file_count=0; //读取的总字节数
        //向浏览器返回数据
        while(!feof($fp) && $file_count<$file_size){
            $file_con=fread($fp,$buffer);
            $file_count+=$buffer;
            echo $file_con;
        }
        fclose($fp);
        //下载完成后删除压缩包，临时文件夹
        if($file_count >= $file_size)
        {
            //这里下载完成后做判断
            exit('下载完成');
        }
    }
    
}