<?
include('../system/inc.php');
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$site_name?>-<?=$site_sname?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="/template/index/04/assets/swiper-4.3.3.min.css"/>
    <link rel="stylesheet" type="text/css" href="/template/index/04/assets/style.css"/>
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
 <style type="text/css">
 <? if ($site_style!='') {?>
 <style type="text/css">
 /*自定义CSS*/
 <?=$site_style?>
 /*自定义CSS*/
 </style>
 <? }?>
<style type="text/css">
    [v-cloak] {
        display: none;
    }

    body {
        background: #c73295;
    }
</style>
<body>
<div class="wk">
    <div class="head">
        <div class="head-logo"><img
                    src="<?=$site_logo?>"
                    style="    width: 180px;    height: 40px;    margin-top: 35px;"
                    alt="LOGO"/></div>
        <div class="head-qq"><i></i> <span><img
                        src="/template/index/04/assets/img/dian.png"/>&nbsp;售后热线：<?=$site_phone?></span>
        </div>
        <div class="head-gg"><i class="head-gg-icon"></i> <span class="head-gg-text"><p>                        <a href="/notice.php" style="color: white">平台公告：<?=$site_number?>
                    </p></span>
              <div class="head-login" id="head-login-1">
            <a  href="/reg.php"><img src="/template/index/04/assets/img/login.png"/></a>
            </div>
        </div>
                
            </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide swiper-slide-center">
                <div style="    color: white;font-size: 50px;position: absolute;font-weight: 500;left: 15%;"><?=$site_name?>-<?=$site_sname?>
                    <br><br><br></div>
                <img class="banner" src="/template/index/04/assets/img/xcy.png"/>
            </div>
                          <div class="swiper-slide list2" id="vue">
                <div class="nav-list-box" id="list-nav-1">
                    <ul class="nav-list" id="nav-list">
                        </li>
                    </ul>
                </div>
                  <div class="list-imgbox" id="list-imgbox">
                    <ul class="list-img  scroll-zd">
                        <div class="tab" style="display:block">
                            <ul>
            <?php
 						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and  zid = '.$zhu_id.' order by corder desc ,ID desc');
					     $x=1;
						while($row = mysql_fetch_array($result)){
  						?>

            <div class="cont-mod book-mod">
        <div class="cont-hd mb20 clearfix">
        </div>
        <div class="cont-bd">
            <ul class="book-detail-list clearfix">
            	<?php
									if ($zhu=='true')
{$result1 = mysql_query('select * from '.flag.'shop where cid in ('.$row['ID'].') and zt = 1 and zid = '.$zhu_id.'   order by sorder desc ,ID desc'); 	}
else
{$result1 = mysql_query('select * from '.flag.'fshop where cid in ('.$row['ID'].')  and  zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc ,ID desc'); 	}
					     $x=1;
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
						}
  						?>
                        
                          <li><a target="_blank"   href="login/<?=$ID?>" ><img
                        src="<?=$pic?>" onerror="this.src='/template/index/04/assets/img/xcy.png';"  alt=""></a></li>
                                                        <? }?>      
                                                            </ul>
        </div>
    </div>
<? } ?>  </ul>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="swiper-button-prev swiper-button-white swiper-button-prev-a"></div>
        <div class="swiper-button-next swiper-button-white swiper-button-next-a"></div>
    </div>
</div>
<script src="/template/index/04/assets/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://assets.yilep.com/ylsq/assets/index/5/js/swiper-4.3.3.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  var swiper = new Swiper('.swiper-container', {
    pagination: {
      el: '.swiper-pagination',
      type: 'fraction',
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  function showhide () {
    var odiv = document.getElementById('aaa');

    if (odiv.style.display == 'block') {
      odiv.style.display = 'none';
    } else {
      odiv.style.display = 'block';
    }
  };

  function show (type) {
    if (type == "1") {
      $('.denlu-form1').show(300);
      $('.denlu-form2').hide(300)
    } else {
      $('.denlu-form1').hide(300);
      $('.denlu-form2').show(300)
    }
  }
</script>