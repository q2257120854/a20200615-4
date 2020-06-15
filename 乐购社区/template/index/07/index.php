
<html>
<head>
    <meta name="csrf-token" content="sarD5S3zCVBaODxGX2FTtxPltIk7ZKFNznzjM8sl">
    <title><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></title>
    <meta name="keywords" content="<?=$site_key?>,亿乐社区,亿卡社区,亿乐3.0,代刷,刷赞,刷会员,玖伍社区,聚梦社区,乐购云"/>
    <meta name="description" content="<?=$site_key?>,亿乐社区,亿卡社区,亿乐3.0,代刷,刷赞,刷会员,玖伍社区,聚梦社区,乐购云"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="layoutmode" content="standard">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="renderer" content="webkit">
    <meta content="always" name="referrer">
    <!--uc浏览器判断到页面上文字居多时，会自动放大字体优化移动用户体验。添加以下头部可以禁用掉该优化-->
    <meta name="wap-font-scale" content="no">

    <meta content="telephone=no" name="format-detection">

    <link rel="stylesheet" type="text/css" href="http://assets.yilep.com/ylsq/assets/index/mobile/base.min.css">
    <link rel="stylesheet" type="text/css" href="http://assets.yilep.com/ylsq/assets/index/mobile/min.css">
    <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/swiper/css/swiper.min.css">
    <link href="http://assets.yilep.com/ylsq/css/index/icon.css?v=3.0.9" rel="stylesheet">
    <link rel="shortcut icon" href="https://s2.ax1x.com/2019/01/23/kAjoTA.png"/>
    <style></style>
    <style>
        .navbar .navItem:after {
            content: '';
        }
    </style>
</head>
<body id="g_body">
<div class="visualArea_leftTop"></div>
<div class="webLeft"></div>
<div id="vue" class="g_web jz_newTheme jz_otherTheme">
    <div id="fk-gWebPlaceholdPT" style="height: 2.25rem;"></div>
    <div id="webTopBox" class="webTopBox  ">
        <div id="webTop" class="webTop mobiTipsStyle" style="top: 0px;">
            <div id="navbar" class="navbar navBaseIcon jz_subMenu_fold">
                <div id="navbarList" class="navbarList" v-cloak>
                    <div class="itemSep"></div>
                    <div class="navItem itemSelected icon-navItem">
                        <a @click="selectClass(0)">
                            <i class="iconfont">&#xe61e;</i>
                            <span class="nameWrap">
                                <span class="navItemName"><span>所有分类</span></span>
                            </span>
                            <span class="icon-subNav"></span>
                        </a>
                    </div>
                    <template v-for="(row,i) in classList">
                        <div class="itemSep"></div>
                        <div class="navItem itemSelected icon-navItem" :key="i">
                            <a :id="'class-'+row.cid" @click="selectClass(row.cid)">
                                <i class="iconfont">&#xe61e;</i>
                                <span class="nameWrap">
                                <span class="navItemName"><span>{{ row.name }}</span></span>
                            </span>
                                <span class="icon-subNav"></span>
                            </a>
                        </div>
                    </template>
                </div>
                <div class="navLeft icon-navLeft"></div>
                <div class="navRight icon-navRight"></div>
                <div class="jz_subMenuSeoGhost"></div>
            </div>
        </div>
    </div>
    <div id="webHeaderBox" class="webHeaderBox    mobiTipsStyle" style="top: 0px;">
        <div class="navButton" id="navButton">
            <div class="navButtonPanel"></div>
            <div class="menuNav">
                <div class="menuNavTip" style="margin:0.6rem 1rem 0.25rem 0.25rem;"><i class="iconfont"
                                                                                       style="font-weight: bold;color: white;font-size: 1rem;">&#xe60b;</i>
                </div>
            </div>
        </div>
        <div id="headerWhiteBg" class="headerSiteMaskWhiteBg" style="display: none; height: 2.25rem;"></div>
        <div id="headerBg" class="headerSiteMaskBg" style="display: none; height: 2.25rem;"></div>
        <div id="webHeader" class="webHeader webHeaderBg">
            <div id="header" class="header" style="padding: 0px;">
               <span class="pageTitle">
                   <h1 style="font-weight:normal; font-size: inherit; display: inline-block; width: 100%; overflow: hidden; text-overflow: ellipsis;">
                       <a style="color:inherit;"><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></a></h1></span></div>
        </div>
    </div>

    <div id="webBannerBox" class="webBannerBox   mobiTipsBannerStyle moveAnimation">
        <div class="multilingualArea" id="webMultilingualArea">
            <div class="multilingual">
                <div style="float:left;" class="memberEntrance">
				<?php if ($member_name ==''){ ?>
				<a href="http://<?=$_SERVER['SERVER_NAME']?>/login.php" class="g_mullink member_a memberIcon"><i class="iconfont">&#xe66d;</i> <span class="g_mullinkFont">登录/注册</span></a>
				<?php }else{ ?>
                <a class="g_mullink member_a memberIcon"><i class="iconfont">&#xe64d;</i> <span class="g_mullinkFont"><?php echo $member_name; ?></span></a>
				<?php } ?>
				<?php
$site_dh = explode("\n",$site_dh);//导航
$i=0;

foreach ($site_dh as $rrr){
$site_dh[$i]=explode("|",$rrr);
?>
<a href="<?=$site_dh[$i][1]?>" class="g_mullink member_a memberIcon"><i class="iconfont">&#xe66d;</i> <span class="g_mullinkFont"><?=$site_dh[$i][0]?></span></a>
   <?php $i++;} ?>
                                                            </div>
            </div>
                    </div>
        <div id="webContainerBox" class="webContainerBox moveAnimation" style="overflow:visible;">
            <div id="webModuleContainer" class="webModuleContainer" style="overflow: hidden;">
                <div class="form Handle">
                                            <div style="background: -webkit-linear-gradient(bottom left,#11db7a,#06c2ac) #06c1ae;font-size: 0.6rem;text-align: center">
                            <a style="color: white" target="_blank"><i
                                        class="iconfont">&#xe637;</i> 合作共赢，共创辉煌！</a>
                        </div>
			<? if ($sitenotice!='') {?>
			        <div class="col-12 p-1">
                        <div class="alert alert-success">
  <?=$sitenotice?>
 
                        </div>
                    </div>

                           <? }?>  
                                        <div class="formBannerTitle formBannerTitle319" style="height: 2rem;">
                        <div class="titleLeft">
                        </div>
                        <div class="titleCenter">
                            <div class="titleText">
                                <div class="titleTextIcon icon-titleText">&nbsp;</div>
                                <div class="textContent">商品列表</div>
                            </div>
                        </div>
                        <div class="titleRight"></div>
                    </div>
                    <div style="width: calc(50% - 10px);display: inline-block;margin: 5px" v-for="(row,i) in data"
                         :key="i">
                        <div class="thumbnail">
                            <a @click="go(row.gid)">
                                <img :src="row.image" :alt="row.name" :title="row.name"
                                     onerror="this.src='http://assets.yilep.com/ylsq/images/noimg.jpg';">
                                <div style="width: calc(100% - 30px);display:block;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;color: black;font-size: 16px">
                                    {{row.name }}
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div id="webFooterBox" class="webFooterBox ">
            <div id="webFooter" class="webFooter moveAnimation">
                <div id="footer" class="footer mallThemeFooter">
                    <div class="technical">
                        <div class="technicalSupport footerInfo" style="color: rgb(153, 153, 153); font-size: 0.6rem;">
                            <font  face="Arial">©</font>© 2017-2019 <?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?> 版权所有
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="webRight"></div>
<div class="visualArea_rightBottom"></div>
<script src="http://assets.yilep.com/ylsq/assets/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="http://assets.yilep.com/ylsq/assets/index/mobile/jqmobi.min.js"></script>
<script type="text/javascript" charset="utf-8" src="http://assets.yilep.com/ylsq/assets/index/mobile/jqmobi_ui.min.js"></script>
<script type="text/javascript" charset="utf-8" src="http://assets.yilep.com/ylsq/assets/index/mobile/mobi.min.js"></script>
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
                this.$post('/ajax/goodslist.php', {
                    action: 'getGoodsAndClass',
                    collect: '0'
                })
                    .then(function (data) {
                        if (data.status == 0) {
                            vm.goodsList = data.data.goods;
                            vm.classList = data.data.class;
                            vm.collectList = data.data.collect;
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
                                    this.open("/login/" + gid+"", true);
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
        <!--<div style="text-align: center;margin-top: 50px;">
            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
              document.write(unescape("%3Cspan id='cnzz_stat_icon_1263103214'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1263103214%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
        </div>-->
    </div>
    <div id="divFloatToolsView" class="floatR" style="display: none;height:237px;width: 140px;">
        <div class="cn" style="height: 210px;">
            <h3 class="titZx"><?=$site_name?><? if ($site_sname!=''){echo " -".$site_sname;}?></h3>
            <ul id="kfqq_list"></ul>
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
        $("#kfqq_list").html(loadKfqq());
    });

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
    vueData.methods.indexNextTick = function () {
        Mobi.navSwipeMenu();
    };
    vueData.methods.selectClass = function (cid) {
        cid = parseInt(cid);
        var vm = this;
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
        Mobi.removeAllSwipeMenuClass();
    };
    new Vue(vueData);
    var swiper = new Swiper('.swiper-container', {
        autoplay: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
</body>
</html>