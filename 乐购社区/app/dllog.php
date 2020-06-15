<?php
include_once('../system/inc.php');
include './check.php';
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
    <title>登录明细</title>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="http://static.xiaoyewl.net/app/css/aui.css"/>
</head>

<body>
<div id="page">
    <header class="aui-bar aui-bar-nav" id="aui-header">
        <div class="aui-pull-left aui-btn">
            <span class="aui-iconfont aui-icon-left"  onClick="javascript:history.back()" ></span>
        </div>
        <div class="aui-title">登录明细</div>
    </header>
    
    
      <section class="aui-refresh-content">
        <div class="aui-content"  >
            <ul class="aui-list aui-media-list">
            <?php
						 
									$sql = 'select * from '.flag.'login_log where hyname = "'.$member_name.'"   and zid ='.$zhu_id.' order by ID desc , ID desc';
 					 
							
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row= mysql_fetch_array($result)){
						
 						 
 							?>
                            <li class="aui-list-item" >
                    <div class="aui-media-list-item-inner">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-text">
                                <div class="aui-list-item-title"><?php if($row['ip']==real_ip()){  ?><font Color=red>[当前]</font><?php } ?><?=$row['ip']?></div>
                                <div class="aui-list-item-right">
                                    <?=$row['qk']?>                                </div>
                            </div>
                                </div>
                                <div class="aui-info-item"><?=$row['date']?></div>
                            </div>
                         </li>
               
                              <? } ?></div>
                    </div>
                            </ul>
        </div>
    </section>



</div>
</body>
 
</html>
