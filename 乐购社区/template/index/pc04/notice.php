<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公告列表 <?=$site_name?>-<?=$site_sname?></title>
    <meta name="keywords" content="<?=$site_key?>"/>
    <meta name="description" content="<?=$site_des?>"/>
    <link href="<?=$site_skin?>assets/common/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$site_skin?>assets/common/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$site_skin?>assets/index/default/style2.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <!--<link href="<?=$site_skin?>assets/common/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
    <style>
        .alert-notice{
            background: #1b6d85;
        }
    </style>
    <style>.web_title{background: #e38812;}.web_title h2{color: #80cce8 !important;}footer{background: #e38812;color: #c73284;}.alert-notice {background: rgba(255, 255, 255, 0.29);}
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
<body style="background-size:cover;background: #3197e0;background-image:url(<?=$site_bj?>)">
<!--顶部-->
<? require_once('header.php');?>
 

<!--中间-->
<div class="container">
    <div class="panel panel-warning">
        <div class="panel-heading"><h5>公告列表</h5></div>
          <?php
					 
					if ($zhu=='true') 
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = 0 order by norder desc ,ID desc');}
else
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = '.$fen_id.' order by norder desc ,ID desc');}
						while($row = mysql_fetch_array($result)){
						 
							if (date('Y-m-d',strtotime($row['date'])) == date('Y-m-d'))
							{ $color='red';}
							else
							{$color='';}
						?>
                        
                                        <div class="list-group-item list-group-item-info"><b style="color: <?=$color;?>">[<?=date('Y-m-d',strtotime($row['date']))?>]</b> <?=$row['content']?></div>

                                                 <? }?>
                              
             </div>
</div>


<? require_once('footer.php');
?>

</body>
</html>