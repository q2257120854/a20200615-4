<?php
include_once('../system/inc.php');
include './check.php';
require_once('../data/member.php'); 
if($member_name ==''){
	header('location: http://'.$_SESSION['url'].'/app/login.php?act=login'); 
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>消息列表</title>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/api.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/aui.css" />
    <link rel="stylesheet" type="text/css" href="http://assests.skywl.cc/app/css/app.css" />-->
</head>

<body>
<div id="page">
    <header class="aui-bar aui-bar-nav" id="aui-header">
        <div class="aui-pull-left aui-btn">
            <span class="aui-iconfont aui-icon-left"  onClick="javascript:history.back()"></span>
        </div>
        <div class="aui-title" onclick="window.location='home.php'">消息列表</div>
    </header>
    
         <section class="aui-refresh-content">
        <div class="aui-content"  >
            <section class="aui-content-padded" >
            	<?php
            	$sql = 'select * from '.flag.'message   where zid = '.$zhu_id.'  order by norder desc , ID desc';
            	$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						  	 $content=str_replace($_GET['key'],"<font color=red> ".$_GET['key']."</font>",$row['content']);
            	?>
                            <div class="aui-card-list">
                    <div class="aui-card-list-header"><?=$row['name']?></div>
                    <div class="aui-card-list-content-padded aui-border-b aui-border-t"  ><?=$row['content']?></div>
                    <div class="aui-card-list-footer"><?=$row['date']?></div>
                </div><? } ?>
                            </section>
        </div>
    </section>



</div>
</body>
 
</html>
