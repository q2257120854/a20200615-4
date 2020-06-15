<html class="am-touch js cssanimations"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_name;?>-<?php echo $site_sname;?></title>
<meta name="description" content="卡密社区,乐购,乐购云,乐购云社区,亿乐社区,乐购社区系统,乐购云系统,www.96ca.com,乐购卡密社区系统(www.96ca.com)">
<meta name="keywords" content="卡密社区,乐购,乐购云,乐购云社区,亿乐社区,乐购社区系统,乐购云系统,www.96ca.com,乐购卡密社区系统(www.96ca.com)">
<link rel="stylesheet" href="/template/index/<?=$site_moban1?>/assets/css/mdui.min.css">
 <link rel="shortcut icon" href=""/>

<script src="/template/index/<?=$site_moban1?>/assets/js/mdui.min.js"></script>
  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

 
  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI">
 
  <!-- Tile icon for Win8 (144x144 + tile color) -->
   <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="/template/index/<?=$site_moban1?>/assets/css/amazeui.min.css">
     <link rel="stylesheet" href="/template/index/<?=$site_moban1?>/assets/css/pic.css">

<style>
.dz-box{
width:%100; height:48px;background:skyblue;color:white;
}
.dz-box1{
width:%100; height:48px;color:grey;border-bottom-style:inset;
}
.am-header{
height:48px;
}
.Footer{background:skyblue;color:white;}
//图片处理
</style>
<link href="/template/index/<?=$site_moban1?>/assets/css/layer.css" type="text/css" rel="styleSheet" id="layermcss">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body class="mdui-loaded" style="">
<!--顶栏开-->
 <header data-am-widget="header" class="am-header am-no-layout" style="background:skyblue;color:white">
      <div class="am-header-left am-header-nav">
          <a href="#">
                <i class="am-header-icon am-icon-user" style="color:white;margin-top:12px"></i>
          </a>
      </div>
      <h1 class="am-header-title">
          <a href="/" style="color:white">
           <?php echo $site_name;?>          </a>
      </h1>
      <div class="am-header-right am-header-nav"> 
          <a id="open1">
                <i class="am-header-icon am-icon-bars" style="color:white;margin-top:12px"></i>
          </a>
      </div>
      <?php #require_once('header.php');
?>

  </header>
<!--顶栏结束-侧栏开-->
<div class="mdui-drawer mdui-drawer-close" id="menu">
						

 
  						<?php
					 
						$resultt = mysql_query('select * from '.flag.'shop_channel where zt= 1  and zid = '.$zhu_id.' order by corder desc ,ID desc');
					     $y=1;
						 while($roww = mysql_fetch_array($resultt)){

						             	echo '<div class="dz-box">
<h3 style="text-align:center;line-height:48px;&gt;
&lt;i class=" mdui-icon="" material-icons"="">'.$roww['name'].'</h3>
</div>
';
	if ($zhu=='true')
 {$result1x = mysql_query('select * from '.flag.'shop where cid in ('.$roww['ID'].') and zt = 1 and zid = '.$zhu_id.'   order by sorder desc ,ID desc'); 	}	
elseif ($zhu!='true' && $_GET['cid']!='')
 {$result1x = mysql_query('select * from '.flag.'fshop where cid in ('.$roww['ID'].')  and  zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc ,ID desc'); 	}	
 					     $x=1;
						while($row1x = mysql_fetch_array($result1x)){
							
						if ($zhu=='true')
						{ 
						$ID=$row1x['ID'];
						$pic=$row1x['pic'];
						$name=$row1x['name'];
						
						}
					    else
						{ 
						$ID=$row1x['sid'];
						$pic=get_shop($row1x['sid'],'pic');
						$name=get_shop($row1x['sid'],'name');
						}
echo '<div class="dz-box1">
<h3 style="line-height:48px; ">
&nbsp;&nbsp;<i class="mdui-icon material-icons"></i>&nbsp;&nbsp;
<a  href="/login/'.$ID.'"  title="'.$name.'" >'.$name.'</a></h3>
</div>';
                       $x++;  }$y++;
						 }?>

                          
 
   </div>
<!--侧栏结束-主体开-->
<div class="mdui-container" style="padding-top:20px">
<div class="mdui-panel mdui-panel-popout" mdui-panel="">
  <div class="mdui-panel-item">
    <div class="mdui-panel-item-header"><?php echo $site_name;?>的公告:</div>
    <div class="mdui-panel-item-body">
	</div>
  
  <?php
					 

					if ($zhu=='true') 
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = 0 order by norder desc ,ID desc');}
else
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = '.$fen_id.' order by norder desc ,ID desc');}


						while($row = mysql_fetch_array($result)){
						?>
		  <div class="gg_info"><b>[<?=date('Y-m-d',strtotime($row['date']))?>]</b> <?=$row['content']?></div>
                                                <? }?>
  </div>
</div>


<div class="mdui-container" style="padding-top:20px">
<div class="mdui-row-xs-2 mdui-row-sm-2 mdui-row-md-4 mdui-row-lg-4 mdui-row-xl-4 mdui-grid-list">

<?php
 						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and  zid = '.$zhu_id.' order by corder desc ,ID desc');
					     $x=1;
						while($row = mysql_fetch_array($result)){
  						?>
                                 <div class="tab-pane fade in active" id="group_<?php $row['ID']?>">
                                       	<?php
										
									if ($zhu=='true')
{$result1 = mysql_query('select * from '.flag.'shop where cid in ('.$row['ID'].') and zt = 1 and zid = '.$zhu_id.'   order by sorder desc ,ID desc'); 	}
else
{$result1 = mysql_query('select * from '.flag.'fshop where cid in ('.$row['ID'].')  and  zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc ,ID desc'); 	}
					     
						while($row1 = mysql_fetch_array($result1)){
							
						if ($zhu=='true')
						{ 
						$ID=$row1['ID'];
						$pic=$row1['pic'];
						$name=$row1['name'];
						
						}
					    else
						{ 
						$ID=$row1['sid'];
						$pic=get_shop($row1['sid'],'pic');
						$name=get_shop($row1['sid'],'name');
						if($pic=='')$pic='assets/noimg.png';
						}
  						?>
                
  
<div class="mdui-col" style="padding-bottom:10px;">
<a href="login/<?php echo $ID;?>">
  <div class="mdui-card mdui-ripple mdui-hoverable">
  <div class="mdui-card-media" style="width:100%;height:210px">
    <img style="height:auth;padding-bottom:100%;" onerror="this.src='images/noimg.png';" src="<?php echo $pic;?>" title="<?php echo $name;?>">
     <div class="mdui-card-media-covered" style="height:40px;">
        <div style="text-align:center;line-height:48px;text-shadow:0 0 0.2em skyblue,-0 -0 0.2em skyblue;"><font size="2px"><?php echo $name;?></font></div>
    </div>
  </div>
</div>
</a>
</div>

 <?php }
 $x++;  }
# exit($name);
 ?>



 
 
</div>
<br>
<!--主体结束-底栏开-->
<script>
var inst = new mdui.Drawer('#menu');
// method
document.getElementById('open1').addEventListener('click', function () {
  inst.open();
});
// event
var drawer = document.getElementById('menu');
drawer.addEventListener('open.mdui.drawer', function () {
  console.log('open');
});

</script>
<!--底栏结束>
<!--[if (gte IE 9)|!(IE)]><!-->

<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/template/index/<?=$site_moban1?>/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

 
<!--底栏结束>
<!--[if (gte IE 9)|!(IE)]><!-->

<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<?php #require_once('footer.php');
?>


</div></div></body></html>
