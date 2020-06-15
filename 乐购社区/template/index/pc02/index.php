 <!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$site_name?>-<?=$site_sname?></title>
    <meta name="keywords" content="<?=$site_key?>"/>
    <meta name="description" content="<?=$site_des?>"/>
    <link href="/<?=$site_skin?>assets/common/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?=$site_skin?>assets/common/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/<?=$site_skin?>assets/index/default/style2.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <!--<link href="/<?=$site_skin?>assets/common/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
    <style>
        .alert-notice{
            background: #1b6d85;
        }
    </style>
    <style>.web_title{background: #3484ed;}.web_title h2{color: #FFF !important;}footer{background: #3484ed;color: #FFF;}.alert-notice {background: rgba(255, 255, 255, 0.29);}
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
<body style="background-size:cover;background: #d9edf7; background-image:url(<?=$site_bj?>)">
<!--顶部-->
<? require_once('header.php');?>

<!--中间-->
<div class="container">
<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
<?php
					 

					if ($zhu=='true') 
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = 0 order by norder desc ,ID desc');}
else
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = '.$fen_id.' order by norder desc ,ID desc');}


						while($row = mysql_fetch_array($result)){
						?>				
<div class="list-group-item list-group-item-info">
	<b style="color:red;"> [<?=$site_name?>]</b><?=$row['content']?></div>
<? }?>
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
 