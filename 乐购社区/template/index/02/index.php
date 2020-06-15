
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></title>
    <meta name="keywords" content="<?=$site_key?>,乐购系统,乐购社区,卡密社区系统，卡密社区官网，卡密社区搭建，乐购社区系统"/>
    <meta name="description" content="<?=$site_des?>,乐购社区系统社区系统,乐购社区,卡密社区系统，卡密社区官网，卡密社区搭建，乐购社区系统"/>
    <link href="/template/04/assets/show/css/main.css" rel="stylesheet">
    <link href="/template/04/assets/show/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?=$site_ico?>"/>
 <? if ($site_style!='') {?>
 <style type="text/css">
 /*自定义CSS*/
 <?=$site_style?>
 /*自定义CSS*/
 </style>
 <? }?>
    <style>
        .container-fluid {
            min-height: calc(100vh - 4rem);
            background: url('<?=$site_bj?>');
        }

        .bd-navbar {
            min-height: 4rem;
            background-color: #563d7c;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .05), inset 0 -1px 0 rgba(0, 0, 0, .1);
        }

        .bd-sidebar {
            -webkit-box-ordinal-group: 1;
            -ms-flex-order: 0;
            order: 0;
            border-bottom: 1px solid rgba(0, 0, 0, .1)
        }

        @media (min-width: 768px) {
            .bd-sidebar {
                border-right: 1px solid rgba(0, 0, 0, .1)
            }

            @supports ((position:-webkit-sticky) or (position:sticky)) {
                .bd-sidebar {
                    position: -webkit-sticky;
                    position: sticky;
                    top: 4rem;
                    z-index: 1000;
                    height: calc(100vh - 4rem)
                }
            }
        }

        @media (min-width: 1200px) {
            .bd-sidebar {
                -webkit-box-flex: 0;
                -ms-flex: 0 1 320px;
                flex: 0 1 320px
            }
        }

        .bd-links {
            padding-top: 1rem;
            padding-bottom: 1rem;
            margin-right: -15px;
            margin-left: -15px
        }

        @media (min-width: 768px) {
            @supports ((position:-webkit-sticky) or (position:sticky)) {
                .bd-links {
                    max-height: calc(100vh - 9rem);
                    overflow-y: auto
                }
            }
        }

        @media (min-width: 768px) {
            .bd-links {
                display: block !important
            }

            .bd-navbar {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1071;
            }
        }

        .bd-toc-link {
            display: block;
            padding: .25rem 1.5rem;
            font-weight: 500;
            color: rgba(0, 0, 0, .65)
        }

        .bd-toc-link:hover {
            color: rgba(0, 0, 0, .85);
            text-decoration: none
        }

        .bd-toc-item.active > .bd-toc-link {
            color: rgba(0, 0, 0, .85)
        }

        .bd-toc-item.active > .bd-toc-link:hover {
            background-color: transparent
        }

        .bd-toc-item.active > .bd-sidenav {
            display: block
        }

        .bd-sidebar .nav > li > a {
            display: block;
            padding: .25rem 1.5rem;
            font-size: 90%;
            color: rgba(0, 0, 0, .65)
        }

        .bd-sidebar .nav > li > a:hover {
            color: rgba(0, 0, 0, .85);
            text-decoration: none;
            background-color: transparent
        }

        .bd-sidebar .nav > .active:hover > a, .bd-sidebar .nav > .active > a {
            font-weight: 500;
            color: rgba(0, 0, 0, .85);
            background-color: transparent
        }

        .thumbnail {
            margin: 0 0 20px 0;
            background-color: transparent;
        }

        .thumbnail {
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
        }

        .thumbnail {
            display: block;
            padding: 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: border .2s ease-in-out;
            -o-transition: border .2s ease-in-out;
            transition: border .2s ease-in-out;
        }

        .thumbnail a img {
            width: 100%;
            height: 225px;
            margin: 0 auto;
            border-radius: 8px;
        }

        .bd-toc-link {
            font-weight: 500
        }

        .bd-toc-item .active {
            color: green !important;
        }

        footer {
            text-align: center;
            width: 100%;
            margin-top: 25px;
        }
    </style>
    <style></style>
</head>
<body>

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <div>
        <img src="" height="28" style="max-width: 240px">
        <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button"
                data-toggle="collapse" data-target="#bd-sidebar">
            <i class="iconfont" style="color: white;font-size: 25px">&#xe60b;</i>
        </button>
    </div>
	
	
            <div class="ml-md-auto"   >
            <a href="/" style="color: white"><i class="iconfont">&#xe637;</i> <?=$site_name?></a>
        </div>
        <ul class="navbar-nav flex-row ml-md-auto d-none d-flex"  >
                
				 <?
                                        $array = explode("\n",$site_indexnav);
$content_texture = $site_indexnav;
$result_texture = str_replace(array("\n", "\r\n") , "<br>", $content_texture);
$array =explode('<br>',$result_texture);
 
foreach($array as $key=>$val){
	$nav =explode('|',$val);?>

      <li class="nav-item">
                    <a class="nav-link " href="<?=$nav[1]?>" target="_blank"><i
                                class="iconfont">&#xe658;</i> <?=$nav[0]?></a>
                </li>
   <?
}
?>


				 


                    <? if ($member_name!='') {?>
                       <li class="nav-item">
                            <a class="nav-link"><i class="iconfont">&#xe64d;</i> <?=$member_name?></a>
                    </li>

                    <? } ?>
    </ul>
</header>
<div class="container-fluid" id="vue">
    <div class="row flex-xl-nowrap">
        <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
          <nav class="bd-links collapse" id="bd-sidebar"><div class="bd-toc-item">
          <a id="class-0"  href="/" class="bd-toc-link <? if ($_GET['cid']==''){echo "active";}?>">所有分类</a></div> 
          
                <?php
					 
						$result = mysql_query('select * from '.flag.'shop_channel where zt= 1  and zid = '.$zhu_id.' order by corder desc ,ID asc');
					     $x=1;
						while($row = mysql_fetch_array($result)){
				 
 						?>
          <div class="bd-toc-item"><a   href="?cid=<?=$row['ID']?>" id="class-<?=$row['ID']?>" class="bd-toc-link <? if ($_GET['cid']==$row['ID']){echo "active";}?>"><?=$row['name']?></a></div>
          
          <? }?>
          </nav>
        </div>
        <main class="col-12 col-md-9 col-xl-9 py-md-8 pl-md-8 bd-content" role="main">
            <div class="row">
			<? if ($sitenotice!='') {?>
			
			        <div class="col-12 p-1">
                        <div class="alert alert-success">
  <?=$sitenotice?>
 
                        </div>
                    </div>

                           <? }?>   

 	<?php
	
	 
	
 									if ($zhu=='true' && $_GET['cid']!='')
 {$result1 = mysql_query('select * from '.flag.'shop where cid in ('.$_GET['cid'].') and zt = 1 and zid = '.$zhu_id.'   order by sorder desc ,ID desc'); 	}
 elseif ($zhu=='true' && $_GET['cid']=='')
 
{$result1 = mysql_query('select * from '.flag.'shop where   zt = 1 and zid = '.$zhu_id.'   order by sorder desc ,ID desc'); 	}

 elseif ($zhu!='true' && $_GET['cid']!='')
 {$result1 = mysql_query('select * from '.flag.'fshop where cid in ('.$_GET['cid'].')  and  zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by forder desc ,ID desc'); 	}

 elseif ($zhu!='true' && $_GET['cid']=='')
 {$result1 = mysql_query('select * from '.flag.'fshop where   zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by forder desc ,ID desc'); 	}

 
 
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
						
				$pic1=$pic; 
  						?>   <div class="col-xl-2 col-md-3 col-6 text-center p-1" >
                                            <div class="thumbnail">
                        <a    target="_blank"    href="/login/<?=$ID?>"  >
                            <img src="<?=$pic1?>"   /  >
                            <div style=" overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?=$name?>
                            </div>
                        </a>
                    </div>
                     </div>
                    <? }?>
                
            </div>
            <footer>
                  <?=$site_content?>
                            </footer>
        </main>
    </div>
</div>
<script src="/template/04/assets/show/js/jquery.min.js"></script>
<script src="/template/04/assets/show/js/popper.min.js"></script>
<script src="/template/04/assets/show/js/bootstrap.min.js"></script>
<script src="/template/04/assets/admin/js/layer.js"></script>
<script src="/template/04/assets/show/js/main.js"></script>
 
<script>!window.jQuery && document.write("<script src=\"http://assets.yilep.com/ylsq/assets/jquery.min.js\">" + "</scr" + "ipt>");</script>
<style>
    .rides-cs {
        font-size: 12px;
        background: #29a7e2;
        position: fixed;
        top: 250px;
        right: 0px;
        _position: absolute;
        z-index: 1500;
        border-radius: 6px 0px 0 6px;
    }

    .rides-cs a {
        color: #00A0E9;
    }

    .rides-cs a:hover {
        color: #ff8100;
        text-decoration: none;
    }

    .rides-cs .floatL {
        width: 36px;
        float: left;
        position: relative;
        z-index: 1;
        margin-top: 21px;
        height: 181px;
    }

    .rides-cs .floatL a {
        font-size: 0;
        text-indent: -999em;
        display: block;
    }

    .rides-cs .floatR {
        width: 130px;
        float: left;
        padding: 5px;
        overflow: hidden;
    }

    .rides-cs .floatR .cn {
        background: #F7F7F7;
        border-radius: 6px;
        margin-top: 4px;
    }

    .rides-cs .cn .titZx {
        font-size: 14px;
        color: #333;
        font-weight: 600;
        line-height: 24px;
        padding: 5px;
        text-align: center;
    }

    .rides-cs .cn ul {
        padding: 0px;
    }

    .rides-cs .cn ul li {
        line-height: 38px;
        height: 38px;
        border-bottom: solid 1px #E6E4E4;
        overflow: hidden;
        text-align: center;
    }

    .rides-cs .cn ul li span {
        color: #777;
    }

    .rides-cs .cn ul li a {
        color: #777;
    }

    .rides-cs .cn ul li img {
        vertical-align: middle;
    }

    .rides-cs .btnOpen, .rides-cs .btnCtn {
        position: relative;
        z-index: 9;
        top: 25px;
        left: 0;
        background-image: url(http://assets.yilep.com/ylsq/images/chat.png);
        background-repeat: no-repeat;
        display: block;
        height: 146px;
        padding: 8px;
    }

    .rides-cs .btnOpen {
        background-position: 0 0;
    }

    .rides-cs .btnCtn {
        background-position: -37px 0;
    }

    .rides-cs ul li.top {
        border-bottom: solid #ACE5F9 1px;
    }

    .rides-cs ul li.bot {
        border-bottom: none;
    }
</style>
<div id="floatTools" class="rides-cs" style="height:246px;">
    <div class="floatL">
        <a id="aFloatTools_Show" class="btnOpen" title="查看在线客服" style="top:20px;display:block"
           href="javascript:void(0);">展开</a>
        <a id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" style="top:20px;display:none" href="javascript:void(0);">收缩</a>
        <div style="text-align: center;margin-top: 50px;">
             
        </div>
    </div>
    <div id="divFloatToolsView" class="floatR" style="display: none;height:237px;width: 140px;">
        <div class="cn" style="height: 210px;">
            <h3 class="titZx"><?=$site_name?></h3>

  <?php
					 

					 if ($zhu=='true')
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = 0 order by k_order desc ,ID desc');}
else
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = '.$fen_id.' order by k_order desc ,ID desc');}


						while($row = mysql_fetch_array($result)){
						 
						 
						?>
                                    <ul id="kfqq_list_<?=$row['ID']?>"></ul>

 		<? }?>

        </div>
    </div>
</div>
<script>
    $(function () {
        $("#aFloatTools_Show").click(function () {
            $('#divFloatToolsView').animate({width: 'show', opacity: 'show'}, 100, function () {
                $('#divFloatToolsView').show();
            });
            $('#aFloatTools_Show').hide();
            $('#aFloatTools_Hide').show();
        });
        $("#aFloatTools_Hide").click(function () {
            $('#divFloatToolsView').animate({width: 'hide', opacity: 'hide'}, 100, function () {
                $('#divFloatToolsView').hide();
            });
            $('#aFloatTools_Show').show();
            $('#aFloatTools_Hide').hide();
        });
<?php
					 

					 if ($zhu=='true')
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = 0 order by k_order desc ,ID desc');}
else
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = '.$fen_id.' order by k_order desc ,ID desc');}

						while($row = mysql_fetch_array($result)){
						 
						 
						?>
        $("#kfqq_list_<?=$row['ID']?>").html(loadKfqq('<?=$row['name']?>|<?=$row['qq']?>'));
		<? }?>    });

    function loadKfqq(str) {
        var html = "";
        var qqs = str.split(',');
        for (var i = 0; i < qqs.length; i++) {
            if (qqs[i] != "") {
                info = qqs[i].split('|');
                html += '<li><span>' + info[0] + '</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' + info[1] + '&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:' + info[1] + ':7" alt="点这里给我发消息"/></a></li>';
            }
        }
        return html;
    }
</script>
</body>
</html>