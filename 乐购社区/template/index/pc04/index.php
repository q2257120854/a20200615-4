<?php require_once('./data/member.php') ;  ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="kvnq4h00cRovk2kHlUTglt3ud8cLinY6w5bnlfd8">
    <title><?=$site_name?>-<?=$site_sname?></title>
    <meta name="keywords" content="<?=$site_key?>"/>
    <meta name="description" content="<?=$site_des?>"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="http://assets.yilep.com/ylsq/assets/index/5/css/swiper-4.3.3.min.css"/>
    <link rel="stylesheet" type="text/css" href="http://assets.yilep.com/ylsq/assets/index/5/css/style.css"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<script type="text/javascript">

  function $ (id) {
    return typeof id === 'string' ? document.getElementById(id) : id;
  }

  window.onload = function () {
    // 标签的索引
    var index = 0;
    var timer = null;

    var lis = document.getElementById("nav-list").getElementsByTagName('li'),
      divs = document.getElementById("list-imgbox").getElementsByTagName('div');
    //console.log(lis.length);
    //alert(divs.length);
    if (lis.length != divs.length) return;

    // 遍历所有的页签
    for (var i = 0; i < lis.length; i++) {
      lis[i].id = i;
      lis[i].onclick = function () {
        // 用that这个变量来引用当前滑过的li
        var that = this;
        for (var j = 0; j < lis.length; j++) {
          lis[j].className = '';
          divs[j].style.display = 'none';
        }
        lis[that.id].className = 'select';
        divs[that.id].style.display = 'block';
      }
    }
  }
</script>
<style type="text/css">
    [v-cloak] {
        display: none;
    }

    body {
        background: #c73295;
    }
</style>
<style></style>
<body>
<div class="wk">
    <div class="head">
        <!--<div class="head-logo"><img
                    src="<?=$site_name?>"
                    style="    width: 180px;    height: 40px;    margin-top: 35px;"
                    alt="<?=$site_name?>"/></div> -->
      
        <div class="head-qq"><i></i> <span><img
                        src="/<?=$site_skin?>/assets/dian.png"/>&nbsp;售后热线：联系客服QQ</span>
        </div>
        <div class="head-gg">
          <?php
					 

					if ($zhu=='true') 
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = 0 order by norder desc ,ID desc');}
else
{$result = mysql_query('select * from '.flag.'notice where zid = '.$zhu_id.' and fid = '.$fen_id.' order by norder desc ,ID desc');}


						$row = mysql_fetch_array($result);
						?>
          <i class="head-gg-icon"></i> <span class="head-gg-text"><p><a href="/notice.php" style="color: white">公告：<?=$row['content']?></a></p></span>
         
        </div>
                    <div class="head-login" id="head-login-1" style="color: white">
                <a href="#" target="_blank"
                   style="color: red;">APP下载</a>&nbsp;&nbsp;&nbsp;&nbsp;<?=$member_name?>
            </div>
            </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide swiper-slide-center">
                <div style="    color: white;font-size: 50px;position: absolute;font-weight: 500;left: 15%;"><?=$site_sname?>
                    <br><br><br></div>
                <img class="banner" src="http://assets.yilep.com/ylsq/assets/index/5/img/xcy.png"/>
            </div>
            <div class="swiper-slide list2" id="vue">
                <div class="nav-list-box" id="list-nav-1">
                    <ul class="nav-list" id="nav-list">
                      <?php
 						$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and  zid = '.$zhu_id.' order by corder desc ,ID desc');
					     $x=1;
						while($row = mysql_fetch_array($result)){
  						?>
                        <li v-for="(row,i) in classList" :key="i" v-cloak>
                            <a href="index.php?fenlei=<?=$row['ID']?>" data="<?=$row['ID']?>" class="demo"><?=$row['name']?></a>
                        </li>
                      <?php } ?>
                    </ul>
                </div>
                <div class="list-imgbox" id="list-imgbox">
                    <ul class="list-img  scroll-zd">
                        <div class="tab" style="display:block">
                            <ul>

                              <?php
                              if($_GET['fenlei']==''){
 								$result = mysql_query('select * from '.flag.'shop_channel where zt = 1  and  zid = '.$zhu_id.' order by corder desc ,ID desc');
                              }else{
                              	$result = mysql_query('select * from '.flag.'shop_channel where ID = '.$_GET['fenlei'].' and zt = 1  and  zid = '.$zhu_id.' order by corder desc ,ID desc');
                              }
					     $x=1;
						while($row = mysql_fetch_array($result)){
  						?>


                              <?php
										
									if ($zhu=='true'){
                                      $result1 = mysql_query('select * from '.flag.'shop where cid in ('.$row['ID'].') and zt = 1 and zid = '.$zhu_id.'   order by sorder desc ,ID desc'); 	
                                    }else{
                                      $result1 = mysql_query('select * from '.flag.'fshop where cid in ('.$row['ID'].')  and  zid = '.$zhu_id.'  and fid = '.$fen_id.'  order by ID desc ,ID desc'); 	
                                    }
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
                                <li v-for="(row,i) in data" :key="i"  data="<?=$row['ID']?>" style="text-align: center">
                                    <a target="_blank"   href="login/<?=$ID?>">
                                        <img src="<?=$pic?>" alt="<?=$name?>" title="<?=$name?>"
                                             onerror="this.src='http://assets.yilep.com/ylsq/images/noimg.jpg';"> <?=$name?>
                                    </a>
                                </li>
                              
                             <?php } ?><?php } ?>
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

<script src="http://assets.yilep.com/ylsq/assets/index/5/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
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
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>

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
        background-image: url(http://demo.lanrenzhijia.com/2014/service1031/images/lanrenzhijia.png);
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
    </div>
    <div id="divFloatToolsView" class="floatR" style="display: none;height:237px;width: 140px;">
        <div class="cn" style="height: 210px;">
            <h3 class="titZx">在线客服</h3>
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
		<? }?>
 
    });

    function loadKfqq(str) {
        var html = "";
        var qqs = str.split(',');
        for (var i = 0; i < qqs.length; i++) {
            if (qqs[i] != "") {
                info = qqs[i].split('|');
                html += '<li> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' + info[1] + '&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:' + info[1] + ':7" alt="点这里给我发消息"/></a><span>' + info[0] + '</span></li>';
            }
        }
        return html;
    }
</script>
 
 


<script src="/<?=$site_skin?>/assets/common/jquery/1.12.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/<?=$site_skin?>/assets/common/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/<?=$site_skin?>/assets/common/toastr/toastr.min.js"></script>
<script src="/<?=$site_skin?>/assets/common/md5.min.js"></script>
<script src="/<?=$site_skin?>/assets/common/layer_mobile/layer.js"></script>
<script src="/<?=$site_skin?>/assets/common/klsf.js"></script>



 
 

<? if ($site_gg!='' and $ll==''){?>
<div id="modal-dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title showTitle text-center"><?=$site_name?>-<?=$site_sname?></h4>
            </div>
            <div class="modal-body bg-warning">
                <?=$site_gg?>            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-info" data-dismiss="modal">知道了</button>
            </div>
        </div>
    </div>
</div>
<? }?>
<script>
    $("#modal-dialog").modal("show");
</script>
  
  
</body>
</html>