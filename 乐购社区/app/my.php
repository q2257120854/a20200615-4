<?php
include_once('../system/inc.php');
require_once('../data/member.php'); 
/*
if($_SESSION['url']==$dq_url){
}elseif($_GET['act']=='app' and $_SESSION['url']!='' and $member_name ==''){
	header('location: http://'.$_SESSION['url'].'/app/login.php?act=login'); 
}elseif($_GET['act']=='app' and $_SESSION['url']!=''){
	header('location: http://'.$_SESSION['url'].'/app/my.php'); 
}elseif ($_SESSION['url']!='' and $member_name =='') {
	header('location: http://'.$_SESSION['url'].'/app/login.php?act=login'); 
}elseif($_SESSION['url']!=$dq_url){
	header('location: http://www.161sq.cn/app/domain_win.php'); 
}
*/
if($member_name ==''){
	header('location:/app/login.php?act=login&my=0'); 
}
?>
<!DOCTYPE HTML>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0" />
        <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
        <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
    </head>
    
    <body>
        <div id="page">
            <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
            <!-- CSS Code -->
            <link rel="stylesheet" href="css/person_style.css" type="text/css">
            <!-- JavaScript Code -->
            <header>个人中心
                <!--<a href="profile.php">
                    <div class="_right">
                        <img src="./image/person/nav_setting.png">
                    </div>
                </a>-->
            </header>
            <!-- ----------------------------北葵向暖...----------------------------->
            <nav class="_main" style="height:200PX">
                <div class="head">
                    <a>
                        <img src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?=$member_qq?>&spec=100">
                    </a>
                </div>
                <div class="name" style="margin-top:10PX">
                    <center><?=$member_name?></center>
                </div>
                <div class="LV" style="width:70px"><?=$member_level?></div>
                <ul style="height:50px">
                    
                        <li style="width:50%"><a href="profile.php">
                            <div class="num"><?=$member_id?></div>
                            <div class="category">我的编号</div></a>
                        </li>
                    
                    
                        <li style="width:50%">
                            <a href="rmblog.php"><div class="num"><?=get_xiaoshu($member_point,6)?></div>
                            <div class="category">我的余额</div></a>
                        </li>
                    
                </ul>
            </nav>
            <div style="height:5PX"></div>
            <section class="aui-content aui-margin-b-10">
                <div class="aui-grid">
                    <div class="aui-row">
                        <div class="aui-col-xs-3" @click="openAdmin" onclick="window.location='/app/home.php'"> <i class="icon aui-iconfont aui-text-default"></i>

                            <div class="aui-grid-label">网站首页</div>
                        </div>
                        <div class="aui-col-xs-3" onClick="alert('暂未开放')"> <i class="icon aui-iconfont aui-text-info"></i>

                            <div class="aui-grid-label">余额充值</div>
                        </div>
                        <div class="aui-col-xs-3" onClick="window.location='/app/rmblog.php'"> <i class="icon aui-iconfont aui-text-primary"></i>

                            <div class="aui-grid-label">余额明细</div>
                        </div>
                        <div class="aui-col-xs-3"> <i class="icon aui-iconfont aui-text-warning"></i>

                            <div class="aui-grid-label" onClick="window.location='/app/dllog.php'">登录记录</div>
                        </div>
                        <div class="aui-col-xs-3" onclick="window.location='/'"> <i class="icon aui-iconfont aui-text-default"></i>

                            <div class="aui-grid-label">手机H5</div>
                        </div>
                        <div class="aui-col-xs-3" onClick="window.location='/app/domain_win.php'"> <i class="icon aui-iconfont aui-text-warning"></i>
                            <div class="aui-grid-label">切换社区</div>
                        </div>
                       
                            <div class="aui-col-xs-3"> <i class="icon aui-iconfont aui-text-danger"></i>

                                <div class="aui-grid-label"> <a href="login.php?act=out" onClick="return confirm('确认退出登录？')">安全退出</a></div>
                            </div>
                        
                        <!--<div class="aui-hr aui-clearfix"></div>--></div>
                </div>
            </section>
            <div class="aui-content aui-margin-b-15">
                <ul class="aui-list aui-list-in">
                    <li class="aui-list-item" onclick="window.location='message.php'">
                        <div class="aui-list-item-label-icon"> <i class="aui-iconfont aui-icon-mail"></i>

                        </div>
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-title">我的消息</div>
                            <div class="aui-list-item-right">
                                <div class="aui-badge" style="position: static;"><?php $sql = 'select zid from '.flag.'message  where zid = '.$zhu_id.'  ';$i=0;
							while($row= mysql_fetch_array($result)){$i++;
							}echo $i;
							?></div>
                            </div>
                        </div>
                    </li>
                    <a class="aui-list-item">
                        <div class="aui-list-item-label-icon"> <i class="aui-iconfont icon"></i>

                        </div>
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-title">客服 Q Q</div>
                            <div class="aui-list-item-right"><!--<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$a_qq?>&site=qq&menu=yes">--><?=$a_qq?><!--</a>--></div>
                        </div>
                    </a>
                    <li class="aui-list-item" @click="call(web.phone)">
                        <div class="aui-list-item-label-icon"> <i class="aui-iconfont icon"></i>

                        </div>
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-title">售后热线</div>
                            <div class="aui-list-item-right">无</div>
                        </div>
                    </li>
                    <li class="aui-list-item">
                        <div class="aui-list-item-label-icon"> <i class="aui-iconfont icon"></i>

                        </div>
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-title">当前版本</div>
                            <div class="aui-list-item-right">V1.0</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </body>

</html>