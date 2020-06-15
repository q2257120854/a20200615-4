<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="r1xjAm1r9U6Atm8vHXk2iuT68M7kFfYTFVKiikz5">
    <title><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></title>
	<meta name="keywords" content="<?=$site_key?>,乐购，乐购云,<?=$site_name?>,亿乐社区,<?=$site_name?>系统,乐购云系统,www.96ca.com,乐购云卡密社区系统(www.96ca.com)"/>
    <meta name="description" content="<?=$site_des?>,乐购,乐购云,<?=$site_name?>,亿乐社区,<?=$site_name?>系统乐购云系统,www.96ca.com,乐购云卡密社区系统(www.96ca.com)"/>
    <link href="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/swiper/css/swiper.min.css">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/index/new1/css/style.css?v=1.0">
    <link rel="shortcut icon" href="https://s2.ax1x.com/2019/01/23/kAjoTA.png"/>
<? if ($site_style!='') {?>
 <style type="text/css">
 /*自定义CSS*/
 <?=$site_style?>
 /*自定义CSS*/
 </style>
 <? }?>
</head>
<body>
<div class="header">
    <div class="show-xs menu" id="menu">
        <i class="iconfont">&#xe60b;</i>
    </div>
            <a class="show-xs user-btn"> <i class="iconfont" style="color: green;font-weight: bold">&#xe64d;</i></a>
        <div class="logo limit">
        <?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?>
    </div>
    <div class="link">
        <ul>
            <li>
                <a href="/">首页</a>
            </li>
                        <li>
            
            </li>
<?php
$site_dh2 = explode("\n",$site_dh);//导航
$i=0;

foreach ($site_dh2 as $rrr){
$site_dh2[$i]=explode("|",$rrr);
?>
      <li>
                    <a href="<?=$site_dh2[$i][1]?>" target="_blank"><?=$site_dh2[$i][0]?></a>
                </li>
   <?php $i++;} ?>
                                    </ul>
    </div>
    <div class="hidden-xs">
					<?php if ($member_name!='') {?>
					<a class="reg" style="border: 0px;width: auto">
                <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$member_qq?>&spec=100" style="width: 20px;height: 20px;margin-top: -5px"><?=$member_name?></a>
					<?php }else{?><a href="/login.php" class="reg" style="border: 0px;width: auto">登录/注册</a>
				<?php }?>
			<?php if ($zhu=='true')
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = 0 order by k_order desc ,ID desc');}
else
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = '.$fen_id.' order by k_order desc ,ID desc');}


						while($row = mysql_fetch_array($result)){
						?>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$row['qq']?>&site=qq&menu=yes" class="kefu"
           target="_blank">客服QQ</a>
		   <? goto kfend;} kfend:?>
    </div>
</div>
<div class="main" id="vue">
    <div class="sidebar-menu">
        <ul>
            <li :class="{'active':cid==0}" @click="selectClass(0)"><i class="iconfont show-xs">&#xe61e;</i> 全部商品</li>
            <li v-for="(row,i) in classList" :key="i" :id="'class-'+row.cid" @click="selectClass(row.cid)"
                :class="{'active':cid==row.cid}">
                <i class="iconfont show-xs">&#xe61e;</i> {{ row.name }}
            </li>
        </ul>
        <hr class="hidden-xs">
        <div class="hidden-xs" style="text-align: center;font-size: 12px">
            © 2017-2019 <?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?> 版权所有
                            <br><a href="http://www.beian.gov.cn" target="_blank">赣ICP备17005539号-12</a>
                    </div>
    </div>
    <div class="content">
        <div class="m-link show-xs">
            
												<?php
$site_dh2 = explode("\n",$site_dh);//导航
$i=0;

foreach ($site_dh2 as $rrr){
$site_dh2[$i]=explode("|",$rrr);
?>
                    <a href="<?=$site_dh2[$i][1]?>" target="_blank"><?=$site_dh2[$i][0]?></a>
   <?php $i++;} ?>
                                    </div>

        <div class="content-header">
            <div class="p120" v-if="cid==0">
<? if ($sitenotice!='') {?>
			        <div class="col-12 p-1">
                        <div class="alert alert-success">
  <?=$sitenotice?>
                        </div>
                    </div>
                           <? }?>   
                            </div>
        </div>
        <div class="goods" style="min-height: 100%">
            <div class="item" v-for="(row,i) in data" :key="i">
                <img :src="row.image" :alt="row.name" :title="row.name"
                     onerror="this.src='http://assets.yilep.com/ylsq/images/noimg.jpg';" @click="go(row.gid)">
                <div class="name limit hidden-xs" @click="go(row.gid)">{{row.name }}</div>
                <div class="hidden-xs">
                    <div class="btn btn-buy" @click="go(row.gid)">立即购买</div>
                </div>
                <div class="m-info show-xs">
                    <div class="limit name" @click="go(row.gid)">
                        {{row.name }}
                    </div>
                    <div class="m-collected" @click="collect(row.gid,0)"
                         v-if="collectList.indexOf(row.gid+'')>-1"></div>
                    <div class="m-collect" @click="collect(row.gid,1)" v-else></div>
                </div>
            </div>
        </div>
        <div>
            
        </div>
    </div>
    <div class="show-xs" style="text-align: center;font-size: 12px;padding: 10px 5px">
        © 2017-2019 <?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?> 版权所有
                    <br><a href="http://www.beian.gov.cn" target="_blank">赣ICP备17005539号-12</a>
            </div>
</div>
<script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/popper.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/bootstrap/bootstrap.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/swiper/js/swiper.min.js"></script>
<script src="http://assets.yilep.com/ylsq/assets/layer/layer.js"></script>
<script src="http://assets.yilep.com/ylsq/js/index/main.js?v=3.0.9"></script>
<script>
    var vueData = {
        el: '#vue',
        data: {
            goodsList: [],
            classList: [],
            collectList: [],
            data: [],
            cid: 0
        },
        methods: {
            collect: function (gid, act) {
                if (this.collectList.indexOf(gid + '') == -1) {
                    if (act) {
                        //收藏
                        this.collectList.push(gid + '');
                    }
                } else if (!act) {
                    //取消收藏
                    this.collectList.splice(this.collectList.indexOf(gid + ''), 1);
                }
                this.$post('/ajax', {action: 'collect', collect: this.collectList.join(',')});
            },
      getGoodsAndClass: function () {
        var vm = this;
        this.$post('/ajax/goodslist.php', {action: 'getGoodsAndClass'})
          .then(function (data) {
            if (data.status == 0) {
              vm.goodsList = data.data.goods;
              vm.classList = data.data.class;
              vm.data = data.data.goods;
              vm.$nextTick(function () {
                vm.indexNextTick();
              });
            } else {
              layer.alert(data.message);
            }
          });
      },
            open: function (url, target) {
                var a = document.createElement('a');
                a.setAttribute('href', url);
                if (target) {
                    a.setAttribute('target', '_blank');
                }
                a.setAttribute('id', 'goUrl');
                // 防止反复添加
                if (document.getElementById('goUrl')) {
                    document.body.removeChild(document.getElementById('goUrl'));
                } else {
                    document.body.appendChild(a);
                }
                a.click();
            },
            go: function (gid) {
                      this.open("/login/" + gid, true);
                },
            selectClass: function (cid) {
                cid = parseInt(cid);
                var vm = this;
                vm.cid = cid;
                if (cid == 0) {
                    vm.data = vm.goodsList;
                } else {
                    var _data = [];
                    vm.goodsList.forEach(function (goods) {
                        if (goods.cid == cid) {
                            _data.push(goods);
                        }
                    });
                    vm.data = _data;
                }
            },
            indexNextTick: function () {

            },
            init: function () {

            }
        },
        mounted: function () {
            this.init();
            this.getGoodsAndClass();
        }
    };
</script>
<?php if ($site_gg!='') {?>
	<div style="display: none" id="html-dialog">
      <?=$site_gg?>
    </div>
	<script>
      layer.alert($("#html-dialog").html());
    </script>
<? }?>  
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

  <?php if ($zhu=='true')
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
</script><script>
    var showMenu = false;
    vueData.methods.init = function () {
        var swiper = new Swiper('.swiper-container', {
            autoplay: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    };
    vueData.methods.selectClass = function (cid) {
        cid = parseInt(cid);
        var vm = this;
        vm.cid = cid;
        if (cid == 0) {
            vm.data = vm.goodsList;
        } else {
            var _data = [];
            vm.goodsList.forEach(function (goods) {
                if (goods.cid == cid) {
                    _data.push(goods);
                }
            });
            vm.data = _data;
        }
        $(".content").removeClass('moveAnimation');
        $(".sidebar-menu").removeClass('openMenu');
        $(".content").removeClass('moveRight');
        showMenu = false;
    };
    new Vue(vueData);
    $("#menu").click(function () {
        if (showMenu) {
            $(".sidebar-menu").removeClass('openMenu');
            $(".content").removeClass('moveRight');
            $(".content").addClass('moveAnimation');
            showMenu = false;
        } else {
            $(".content").removeClass('moveAnimation');
            $(".sidebar-menu").addClass('openMenu');
            $(".content").addClass('moveRight');
            showMenu = true;
        }
    });
</script>
</body>
</html>
