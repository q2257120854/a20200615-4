<?php 
$title='系统APP';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'APP';
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
                        平台APP
                    </div>
                    <div class="panel-body">
                        <div class="list-group-item list-group-item-danger">
                            使用前说明：1、此app是整个乐购系统的app，只需要输入域名就可以使用                           
							
						   <br><br>
                            此插件主要功能 <br>快捷下单
                        </div>
                        <div class="list-group-item ">
                            1、下载软件 <a class="btn-xs btn-success" href="#">点击下载</a>
                        </div>
                        <div class="list-group-item ">
                            2、安装
                        </div>
                        <div class="list-group-item ">
                            3、输入社区域名
                        </div>
                        <div class="list-group-item ">
                            4、登录账号密码
                        </div>
                        <div class="list-group-item ">
                            5、开始下单<br>
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
