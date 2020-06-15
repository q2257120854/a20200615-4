<?php 
$title='机器人帮助';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'irhelp';
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



	<?
 include('header.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        使用帮助
                    </div>
                    <div class="panel-body">
                        <div class="list-group-item list-group-item-danger">
                            使用前说明：1、此插件是结合酷cleverQQ软件开发的一款插件，软件官方：https://www.cleverqq.cn/<br>
                            由于要自己挂软件，所以你最好要有自己的服务器！挂机宝也可以
							
						   <br><br>
                            此插件主要功能 <br>1、QQ加款(直接转账给该QQ进行加款)<BR> 2、引流功能(引导别人加入（邀请好友加入）你的QQ群，以达到你在QQ群里做推广！)
                        </div>
                        <div class="list-group-item ">
                            1、下载软件 <a class="btn-xs btn-success" href="#">正在开发</a>
                        </div>
                        <div class="list-group-item ">
                            2、解压压缩包，然后运行CleverQQ Air.exe
                        </div>
                        <div class="list-group-item ">
                            3、输入QQ账号密码登录进去
                        </div>
                        <div class="list-group-item ">
                            4、找到左侧《插件管理》 鼠标右键》启用尘埃云社区系统QQ机器人
                        </div>
                        <div class="list-group-item ">
                            5、启动之后 鼠标右键》设置》 进入设置界面<br>
                            输入相应的域名及密钥！<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div><!-- /main-container -->

</div><!-- /wrapper -->


 <? include_once('footer.php');
?></body>
</html>
