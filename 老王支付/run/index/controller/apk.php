<?php
namespace xh\run\index\controller;


use xh\library\model;
use xh\library\mysql;
use xh\library\functions;
use xh\library\request;


class apk{
    
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
        //验证账户金额是否大于一千
        //if ($_SESSION['MEMBER']['balance'] < 1000) functions::json(-1, '您当前余额不足1000元,请预充值1000元或以上再下载');
        //检测下载次数
       // if ($pwd_server['apk_download_num'] > 0) functions::json(-1, '您已经下载过一次了,如需重新下载,需预充值1000元');
        functions::json(200, '账户验证成功,下载中..');
    }
    
    //apk文件下载
    public function download(){
        $pwd = functions::pwd(request::filter('get.pwd'), $_SESSION['MEMBER']['token']);
        //查询用户信息
        $pwd_server = $this->mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0];
        if ($pwd != $pwd_server['pwd']) functions::json(-1, '您的密码输入有误!');
        //验证账户金额是否大于一千
       // if ($_SESSION['MEMBER']['balance'] < 1000) functions::json(-1, '您当前余额不足1000元,请预充值1000元或以上再下载');
        //检测下载次数
        //if ($pwd_server['apk_download_num'] > 0) functions::json(-1, '您已经下载过一次了,如需重新下载,需预充值1000元');
        
        $filePath = ROOT_PATH . '/download/305a258c7d134c4990f0047f9a6d5f66079ab04b.zip';
     
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
        //更新用户信息
        $this->mysql->update("client_user", ['apk_download_num'=>1],"id={$pwd_server['id']}");
        //下载完成后删除压缩包，临时文件夹
        if($file_count >= $file_size)
        {
           //这里下载完成后做判断
        }
    }

}