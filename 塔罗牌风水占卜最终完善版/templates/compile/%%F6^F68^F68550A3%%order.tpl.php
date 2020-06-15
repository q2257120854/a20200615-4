<?php /* Smarty version 2.6.25, created on 2019-04-16 12:11:50
         compiled from index/taluo/jixu/order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'index/taluo/jixu/order.tpl', 95, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0"/>
    <title>你和TA该继续吗？</title>
    <script src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/common/js/rem_tool.js"></script>
    <link rel="stylesheet" href="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/css/common-v=1.4.css">
    <link rel="stylesheet" href="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/css/preview.css?v=1.5">
</head>

<body>
<section class="page">
    <section class="main-wrap flex-column">
        <div class="banner-wrap flex-center">
            <img class="banner" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/banner.png?v=1.1">
        </div>

        <div class="content-wrap flex-column">
            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column">
                        <img class="main-title" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/main_title.png?v=1.1">
                        <div class="top-wrap flex-column">
                            <div class="guide-wrap flex-column">
                                <div class="guide flex-column">
                                    <p class="guide-text first-line" id="first_line">亲爱的<em>测试者</em>：</p>
                                    <p class="guide-text" id="second_line">
                                        曾经亲密的人，心中还有你吗？你到底该放手还是该坚持？关于你们该不该继续，我将根据你所选择的4张牌，给予进一步指引...
                                    </p>
                                </div>
                            </div>
                            <div class="card-group flex-column">
                                <img class="card-wall" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/card_wall2.png?v=1.1">
                                <div class="tarot-card tarot-card-1 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['0']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div><div class="tarot-card tarot-card-2 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['1']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div><div class="tarot-card tarot-card-3 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['2']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div><div class="tarot-card tarot-card-4 flex-column">
                                        <img src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['img']; ?>
">
                                        <p class="card-name"><?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['title']; ?>
</p>
                                        <span>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['3']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</span>
                                    </div>                            </div>
                            <div class="price-wrap flex-column">
                                <p class="project-name flex-center">咨询项目: 你和TA该继续吗？</p>
                                <div class="price-content flex-row" style="border-top: none">
                                    <div class="price-box flex-column">
                                        <span class="false-price flex-row"><label>原价：</label><em>￥88.80</em></span>
                                        <span class="true-price flex-row"><label style="background-color: #e0706f;">限时优惠</label><em>￥<?php echo $this->_tpl_vars['data']['money']; ?>
</em></span>
                                    </div>
                                    <div class="time-box flex-column">
                                        <span class="time-title">距优惠结束</span>
                                        <span class="time-discount">02: 00: 00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="user-count flex-row">
                                <span>已有<em>374718</em>人测算</span>
                                <span>好评率: <em>99.8%</em></span>
                            </div>
                            <img class="start-btn start-btn-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/pay_btn.png?v=1.1">
                            <!--<span class="start-span start-btn-top flex-center">立即支付</span>-->
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

            <div class="content-box flex-column">
                <img class="title" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/guide_title.png?v=1.1">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column">
                        <img class="desc-subtitle" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/nav_01.png?v=1.1">
                        <div class="tarot-box flex-column">
                            <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['img']; ?>
">
                            <div class="card-intro flex-center">
                                <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/num_01.png">
                                <span><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['title']; ?>
&nbsp;<em>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['0']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</em></span>
                            </div>
                            <div class="explan-box flex-column">
                                <p class="explan-title">象征意义:</p>
                                <p class="explan-text"><?php echo $this->_tpl_vars['data']['data']['carinfo']['0']['des']; ?>
</p>
                                <p class="explan-title">对方想法:</p>
                                <p class="explan-text"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['data']['carinfo']['0']['content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...", true) : smarty_modifier_truncate($_tmp, 40, "...", true)); ?>
</p>
                            </div>
                            <div class="card-desc flex-center">
                                <img class="blur-img" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/blurry_01.png?v=1.1">
                                <div class="parse-box flex-column">
                                    <img class="start-btn-mid" data-no="1" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/unlock.png?v=1.1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column">
                        <img  class="desc-subtitle" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/nav_02.png?v=1.1">
                        <div class="tarot-box flex-column">
                            <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['img']; ?>
">
                            <div class="card-intro flex-center">
                                <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/num_02.png">
                                <span><?php echo $this->_tpl_vars['data']['data']['carinfo']['1']['title']; ?>
&nbsp;<em>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['1']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</em></span>
                            </div>
                            <div class="card-desc flex-center">
                                <img class="blur-img" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/blurry_02.png?v=1.1">
                                <div class="parse-box flex-column">
                                    <ul class="parse-list flex-column">
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>对方心里有你吗？</span></li>
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你的付出值得吗？</span></li>
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你们之间<em>真的合适吗</em>？</span></li>
                                    </ul>
                                    <img class="start-btn-mid" data-no="2" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/unlock.png?v=1.1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column">
                        <img  class="desc-subtitle" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/nav_03.png?v=1.1">
                        <div class="tarot-box flex-column">
                            <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['img']; ?>
">
                            <div class="card-intro flex-center">
                                <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/num_03.png">
                                <span><?php echo $this->_tpl_vars['data']['data']['carinfo']['2']['title']; ?>
&nbsp;<em>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['2']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</em></span>
                            </div>
                            <div class="card-desc flex-center">
                                <img class="blur-img" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/blurry_03.png?v=1.1">
                                <div class="parse-box flex-column">
                                    <ul class="parse-list flex-column">
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你们的感情<em>会有什么阻碍</em>？</span></li>
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你会因此失去TA吗？</span></li>
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>应当如何面对这些阻碍？</span></li>
                                    </ul>
                                    <img class="start-btn-mid" data-no="3"src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/unlock.png?v=1.1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column">
                        <img class="desc-subtitle" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/nav_04.png?v=1.1">
                        <div class="tarot-box flex-column">
                            <img class="card-image" src="<?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['img']; ?>
">
                            <div class="card-intro flex-center">
                                <img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/num_04.png">
                                <span><?php echo $this->_tpl_vars['data']['data']['carinfo']['3']['title']; ?>
&nbsp;<em>(<?php if ($this->_tpl_vars['data']['data']['carinfo']['3']['zf'] == 0): ?>逆位<?php else: ?>正位<?php endif; ?>)</em></span>
                            </div>
                            <div class="card-desc flex-center">
                                <img class="blur-img" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/blurry_04.png?v=1.1">
                                <div class="parse-box flex-column">
                                    <ul class="parse-list flex-column">
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你们的感情能够维持多久？</span></li>
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你们的关系还能否更进一步？</span></li>
                                        <li class="item flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/point.png"><span>你们还<em>应该继续走下去吗</em>？</span></li>
                                    </ul>
                                    <img class="start-btn-mid" data-no="4" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/unlock.png?v=1.1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

            <div class="content-box flex-column">
                <img class="border border-top" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_top.png?v=1.1">
                <div class="content-panel">
                    <div class="content flex-column comment-box">
                        <p class="comment-title flex-center">已为超过<em>12万</em>人提供情感指引</p>
                        <div class="detail-data flex-row">
                            <span class="person-count flex-row">已测算人数:<em>123343</em></span>
                            <span class="rate-num flex-row"><img src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/index/emoji.png?v=1.1">好评率:<em>99.8%</em></span>
                        </div>
                        <div class="labels flex-row">
                            <span id="label_0">非常有用(<em>24234</em>)</span>
                            <span id="label_1">符合现状(<em>4532</em>)</span>
                            <span id="label_2">超级准(<em>3842</em>)</span>
                            <span id="label_3">很专业(<em>2408</em>)</span>
                            <span id="label_4">真实(<em>64543</em>)</span>
                        </div>
                        <div class="upto-wrap">
                            <ul class="comment-list info-list-box">
                                <li>
                                        <p class="user">刁*女士</p>
                                        <p class="detail">以前一直觉得他不好，占卜完以后我试着去理解他，才发现原来他真的很爱我！</p>
                                    </li><li>
                                        <p class="user">吴*先生</p>
                                        <p class="detail">还可以，比之前测过其他家的好很多，当下感情遇到的阻碍跟我本身很匹配！比较推荐！
</p>
                                    </li><li>
                                        <p class="user">马*女士</p>
                                        <p class="detail">总体感觉很准确，其实有些问题自己是想到过的，只是当局者迷，需要一个外界的指引。
</p>
                                    </li><li>
                                        <p class="user">刘*先生</p>
                                        <p class="detail">不管怎么样，解开了我心里的疑惑，以后感情发展更有方向啦。
</p>
                                    </li><li>
                                        <p class="user">樊*女士</p>
                                        <p class="detail">给他测了一份，给我测了一份，两个结果居然出奇的匹配！！！疯狂打call！
</p>
                                    </li><li>
                                        <p class="user">李*女士</p>
                                        <p class="detail">内容很丰富，对未来的预测和建议也是比较具体的。
</p>
                                    </li><li>
                                        <p class="user">简*先生</p>
                                        <p class="detail">真的很准，钱没有白花，一开始的时候确实很犹豫，结果真的是很准，真的很棒！
</p>
                                    </li><li>
                                        <p class="user">谢*女士</p>
                                        <p class="detail">最近感情很糟心，占卜结果说我还不能操之过急，因为勉强为之反而会适得其反，果然我调整了一下心态，很多事都变得顺利了。
</p>
                                    </li><li>
                                        <p class="user">冯*女士</p>
                                        <p class="detail">还行，比之前的好多占卜详细很多，也得到了一些有用的建议！
</p>
                                    </li><li>
                                        <p class="user">王*女士</p>
                                        <p class="detail">第一次用塔罗测试，本来是不太信的，但是测了两次结果都比较接近，而且当前的状态和阻碍跟我本身也很匹配~
</p>
                                    </li><li>
                                        <p class="user">张*女士</p>
                                        <p class="detail">解牌马上就看出了问题的关键，说的很到位，感觉对未来不再是那么迷茫了！
</p>
                                    </li><li>
                                        <p class="user">曹*先生</p>
                                        <p class="detail">跟简介很匹配，想看的都看到了，希望能像说的那样，跟她一直继续下去！
</p>
                                    </li><li>
                                        <p class="user">许*先生</p>
                                        <p class="detail">对方的家长比较反对，本来有些担心，但牌面显示她会陪我渡过困难，这下我就放心了。
</p>
                                    </li><li>
                                        <p class="user">孙*先生</p>
                                        <p class="detail">我是朋友介绍过来的，没想到这么不错，说的很准！强烈推荐！！！
</p>
                                    </li><li>
                                        <p class="user">沈*女士</p>
                                        <p class="detail">非常有用，不仅有用还给了我很客观的建议！
</p>
                                    </li><li>
                                        <p class="user">赵*先生</p>
                                        <p class="detail">准确，是很好的感情指导工具。
</p>
                                    </li><li>
                                        <p class="user">李*先生</p>
                                        <p class="detail">好评，很专业！
</p>
                                    </li><li>
                                        <p class="user">陈*先生</p>
                                        <p class="detail">赞赞赞！
</p>
                                    </li><li>
                                        <p class="user">魏*女士</p>
                                        <p class="detail">特别特别有用，能说到问题的关键。
</p>
                                    </li><li>
                                        <p class="user">钱*女士</p>
                                        <p class="detail">准！比较详细，我喜欢这种不模棱两可的，比较直接。不过有一些细节不是很深入，想找老师帮忙再详细算一遍。
</p>
                                    </li>                            </ul>
                        </div>
                    </div>
                </div>
                <img class="border border-bot" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/common/border_bot.png?v=1.1">
            </div>

        </div>

        <div class="float-wrap flex-center" style="display:none;">
            <div class="float-btn flex-center">
                <img class="start-btn start-btn-bot" style="margin: 0rem" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/image/preview/pay_btn_2.png?v=1.2">
            </div>
        </div>

    </section>
</section>

    <script type="text/javascript" src="http://divine.iqsacc.com/static_res/platform/js/zwSdk.js?v=19041519"></script><script type="text/javascript" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/script/jquery.min.js"></script>
<script type="text/javascript" src="/ffsm/statics/taluo/divine.cdn.h55u.com/AppDivine/farewell/script/scroll.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var count = "374718";
        var rate = "99.8%";
        var labels = [16487,14988,26230,7494,9742];
        count = parseInt(count);
        $('.person-count em').text(count);
        if(count<10000){
            count =(count/10000).toFixed(1) + '万';
        }else{
            count = parseInt(count/10000)+'万';
        }
        $('.comment-title em').text(count);
        $('.rate-num em').text(rate);
        for (var i = 0; i < labels.length; i++) {
            $("#label_"+i+" em").text(labels[i]);
        }

        var remain = parseInt("7200");
        remain = 1200;
        initTimer(remain--);
        var animate = setInterval(function () {
            initTimer(remain--);
        }, 1000);

        function initTimer(seconds) {
            if (seconds > 0) {
                var h = Math.floor(seconds / 3600);
                var m = Math.floor((seconds % 3600) / 60);
                var s = Math.ceil((seconds % 3600) % 60);
                h = h < 10 ? ('0' + h) : h;
                m = m < 10 ? ('0' + m) : m;
                s = s < 10 ? ('0' + s) : s;
                $('.time-discount').text(h + ': ' + m + ': ' + s);
            } else {
                window.clearInterval(animate);
                window.location.href = "/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['data']['oid']; ?>
&type=1";
            }
        }
    });

    window.onscroll = function () {
        window.onscroll = function () {
            var height_1 =  $(".banner-wrap").outerHeight();
            var height_2 =  $(".top-wrap").outerHeight();
            var height = height_1 + height_2;
            var top = document.documentElement.scrollTop || document.body.scrollTop;
            top > height ? $('.float-wrap').fadeIn() : $('.float-wrap').fadeOut();
        };
    }

    $('.start-btn-top').click(function(){
        paymoney();
    });
    $('.start-btn-mid').click(function(){
        paymoney();
    });

    $('.start-btn-bot').click(function(){
        paymoney();
    });

    function paymoney() {
        window.location.href = "/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['data']['oid']; ?>
&type=1";
    }

</script>

<script>
    
	var inquiry_lock = 0;
    $(function () {
        setInterval(function () {
            inquiry();
        }, 2000);
    });
    function inquiry() {
        if (inquiry_lock) {
            return;
        }
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['data']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                window.location = data.url;
            }
        }, 'json');
    }
    
    </script>

</body>
</html>