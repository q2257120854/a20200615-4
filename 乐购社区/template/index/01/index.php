 <!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$site_name?>-<?=$site_sname?></title>
    <link href="/template/index/<?=$site_moban1?>/assets/common/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/index/<?=$site_moban1?>/assets/common/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/template/index/<?=$site_moban1?>/assets/index/default/style2.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <meta name="description" content="卡密社区,乐购,乐购云,乐购云社区,亿乐社区,乐购社区系统,乐购云系统,www.96ca.com,乐购卡密社区系统(www.96ca.com)">
<meta name="keywords" content="卡密社区,乐购,乐购云,乐购云社区,亿乐社区,乐购社区系统,乐购云系统,www.96ca.com,乐购卡密社区系统(www.96ca.com)">
    <style>
        .alert-notice{
            background: #1b6d85;
        }
    </style>
    <style>.web_title{background: #e38812;}.web_title h2{color: #FFF !important;}footer{background: #e38812;color: #FFF;}.alert-notice {background: rgba(255, 255, 255, 0.29);}
</style>
    <style>
        .main-menu{
            display: none;
        }
        @media (min-width: 768px) {
            .main-menu{
                display: block;
                position: absolute;
                margin-left:-180px;
                width:180px;
                background: rgba(33, 28, 28, 0.38);
            }
            .main-menu ul {
                position: relative;
                list-style: none;
            }
            .main-menu ul li {
                position: relative;
                background-color: transparent;
                border-bottom: 1px solid #17232c;
            }
            .main-menu ul li {
                position: relative;
                background-color: transparent;
                border-bottom: 1px solid #17232c;
            }
           .main-menu ul li a {
                position: relative;
                display: block;
                padding: 12px 15px 12px 2px;
                font-size: 11px;
                font-weight: 600;
                background: 0 0;
                color: #8dacc4;
                text-transform: uppercase;
                outline: 0;
            }
           .main-menu ul li h3{
               text-align: center;
               color: white;
               font-weight: bold;
           }
            .main-menu ul li a{
                text-align: center;
                font-size: 15px;
                background: #333;
            }
            .main-menu .active a{
                background: #3c763d;
                color: white;
            }
        }
        .gg_info{
            display:block;
            font-size:12px;
            line-height:18px;
            text-decoration:none;
            color:#333;
            font-family:Arial;
        }
    </style>
</head>
<body style="background-size:cover;background: #FFFFFF; background-image:url(<?=$site_bj?>)">
<!--顶部-->
<? require_once('header.php');?>

<!--中间-->
<div class="container">
        <div class="alert alert-notice">
        <div style="padding: 3px 40px 3px 3px;">
            <div id="gg_list" style="height:18px;overflow:hidden;">
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
        <a href="notice.html" target="_blank" class="btn-xs btn-info" style="float: right;margin-top: -22px;">更多</a>
        <script language="javascript">
            var boxTimes=0;
            var box=document.getElementById("gg_list"),can=true;
            box.innerHTML+=box.innerHTML;
            box.onmouseover=function(){can=false};
            box.onmouseout=function(){can=true};
            new function (){
                var stop=box.scrollTop%18==0&&!can;
                if (boxTimes>0) {
                    if (!stop)box.scrollTop == parseInt(box.scrollHeight / 2) ? box.scrollTop = 0 : box.scrollTop++;
                }
                boxTimes++;
                setTimeout(arguments.callee,box.scrollTop%18?10:1500);
            };
        </script>
    </div>
        <div class="main-menu">
        <ul class="accordion">
            <li><h3>社区商品导航</h3></li>
            
            	<?php
					 
						$result = mysql_query('select * from '.flag.'shop_channel where zt= 1  and zid = '.$zhu_id.' order by corder desc ,ID desc');
					     $x=1;
						while($row = mysql_fetch_array($result)){
				 
 						?>
						<? if ($_GET['id']!='') {?>

                       <li class="<? if ($row['ID']==$_GET['id']  ) {echo "active";}?>"><a href="#group_<?=$row['ID']?>" data-toggle="tab" aria-expanded="true"><?=$row['name']?></a>  </li>

                        <? } else {?>
                       <li class="<? if ($x==1  ) {echo "active";}?>"><a href="#group_<?=$row['ID']?>" data-toggle="tab" aria-expanded="true"><?=$row['name']?></a>  </li>
                       <? } $x++;  }?>
            
                    </ul>
    </div>
    <!--内容标签-->
    <div class="row">
        <div class="col-xs-12">
            <div class="tab-content">
 
            <?php
 						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and  zid = '.$zhu_id.' order by corder desc ,ID desc');
					     $x=1;
						while($row = mysql_fetch_array($result)){
  						?>
                                 <div class="tab-pane fade in active" id="group_<?=$row['ID']?>">
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
                                 <div class="div_url col-xs-6 col-sm-3 col-md-2">
                    <div class="thumbnail">
                        <a target="_blank"   href="login/<?=$ID?>">
                            <img class="img-rounded img-responsive" onerror="this.src='images/noimg.png';"
                                 src="<?=$pic?>"  
                                 title="<?=$name?>">
                        </a>
                    </div>
                    
                  </div>
                 <? }?>
                 
                 
                </div>      
                
                    <? $x++;  }?>
                             
                                  
                             </div>
        </div>
    </div>
</div>


<? require_once('footer.php');
?>

</body>
</html>
 