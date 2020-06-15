<?php /* Smarty version 2.6.25, created on 2019-04-15 11:48:11
         compiled from index/xingzuo2019/form.tpl */ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0"/>
    <title>2019运势分析</title>
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/common.css">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/index_2.css">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/alert.css">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/loading.css">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/success.css">
    
    <link rel="stylesheet" type="text/css" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/css/mobileSelect.css">
    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/js/mobileSelect-v=1.2.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/script/rem.js"></script>
    
    
    
</head>

<body>
<section class="alert" style="display: none;">
    <div class="alert-wrap flex-column">
        <div class="alert-box flex-column">
            <div class="alert-banner-box flex-center">
                <img class="close-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/close_btn-v=1.0.png">
                <img class="alert-banner" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/banner-v=1.0.png">
                <div class="banner-desc flex-column">
                    <p class="banner-title">选择星座</p>
                    <p class="banner-tips">查看对应星座的2019运势</p>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="1">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s1-v=1.1.png">
                    <span class="star-name">白羊座</span>
                    <span class="star-time">3.21-4.19</span>
                </div>
                <div class="star-item flex-column" data-star="2">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s2-v=1.1.png">
                    <span class="star-name">金牛座</span>
                    <span class="star-time">4.20-5.20</span>
                </div>
                <div class="star-item flex-column" data-star="3">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s3-v=1.1.png">
                    <span class="star-name">双子座</span>
                    <span class="star-time">5.21-6.21</span>
                </div>
                <div class="star-item flex-column" data-star="4">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s4-v=1.1.png">
                    <span class="star-name">巨蟹座</span>
                    <span class="star-time">6.22-7.22</span>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="5">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s5-v=1.1.png">
                    <span class="star-name">狮子座</span>
                    <span class="star-time">7.23-8.22</span>
                </div>
                <div class="star-item flex-column" data-star="6">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s6-v=1.1.png">
                    <span class="star-name">处女座</span>
                    <span class="star-time">8.23-9.22</span>
                </div>
                <div class="star-item flex-column" data-star="7">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s7-v=1.1.png">
                    <span class="star-name">天秤座</span>
                    <span class="star-time">9.23-10.23</span>
                </div>
                <div class="star-item flex-column" data-star="8">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s8-v=1.1.png">
                    <span class="star-name">天蝎座</span>
                    <span class="star-time">10.24-11.22</span>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="9">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s9-v=1.1.png">
                    <span class="star-name">射手座</span>
                    <span class="star-time">11.23-12.21</span>
                </div>
                <div class="star-item flex-column" data-star="10">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s10-v=1.1.png">
                    <span class="star-name">摩羯座</span>
                    <span class="star-time">12.22-1.19</span>
                </div>
                <div class="star-item flex-column" data-star="11">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s11-v=1.1.png">
                    <span class="star-name">水瓶座</span>
                    <span class="star-time">1.20-2.18</span>
                </div>
                <div class="star-item flex-column" data-star="12">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s12-v=1.1.png">
                    <span class="star-name">双鱼座</span>
                    <span class="star-time">2.19-3.20</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page">
    <section class="main-wrap flex-column" style="padding-bottom: 3.4rem">

        <div class="banner-wrap flex-column">
            <img class="banner-bg" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/banner_bg-v=1.7.png">
            <div id="meteors"></div>
            <div class="banner-box flex-column">
                <div class="switch-wrap flex-row">
                    <div class="star-box flex-row-2"><label for="star_name">当前星座:</label><span data-sid="1" id="star_name">白羊座</span></div>
                    <img class="switch-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index_2/switch_btn-v=1.0.png">
                </div>
                                    <img class="banner" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index_2/star_01-v=1.0.png">
            </div>
            <div class="order-btn-wrap flex-center">
                <img class="order-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/order_btn-v=1.7.png">
            </div>
        </div>
        
        <div class="start-wrap flex-center">
        
        <style type="text/css">
		.index_infobox {
    position: relative;
    background-color: #ded9ed;
    width: 88.8%;
    margin: 1rem auto;
    border-radius: 10px;
    padding: 0.5rem 0;
    box-sizing: border-box;
}
        .birthday_box {
    display: block;
    width: 85%;
    height: 2rem;
    line-height: 2rem;
    margin: 0 auto;
    font-size: 18px;
    overflow: hidden;
}
img.index_info_tip {
    display: block;
    width: 70%;
    margin: 0 auto 0.5rem auto;
}
.birthday_box span {
    display: block;
    width: 5em;
    float: left;
    color: #110e15;
}
.birthday_box p {
    display: block;
    width: calc(100% - 5em);
    float: left;
    text-align: left;
    text-indent: 0.5em;
    color: #6f6d70;
}
        
        </style>
        
        
        <div class="index_infobox">
        
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/1208_tips.png" class="index_info_tip">
            
            <div class="birthday_box">
                <span>你的姓名：</span>
                <p class="userinput_name"><input id="userinput_name" placeholder="请输入名字" type="text" name="username" border="0" style="background-color:#ded9ed; height:36px; font-size:18px; width:180px;"></p>
            </div>
            
            <div class="birthday_box">
            <span>你的性别：</span>
            <p class="userinput_name">
                <input name="Fruit" type="radio" value="" checked="true" />男  &nbsp; <input name="Fruit" type="radio" value="" />女 
            </p>
        </div>
        
        
        	<div class="birthday_box">
                <span>出生日期：</span>
                <p class="birthday_input_value" id="birthday_input_value">选择你的出生日期<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/1208_arrow.png" class="index_info_arrow"></p>
            </div>
        
        </div>
        
        </div>
        

        <div class="start-wrap flex-center">
            <div class="start-btn start-zoom flex-center">
                <img class="start-bg" id="start_bg" style="display: none" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index_2/btn_bg-v=1.0.png">
                <span class="start-name flex-center" style="display: none">立即分析白羊座运势</span>
            </div>
        </div>

        <div class="trouble-wrap flex-column">
            <img class="star-big-r" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/star_br-v=1.7.png">
            <div class="trouble-box flex-center">
                <img class="trouble-text" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/trouble_text-v=1.7.png">
                <img class="arrow arrow_01" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_02" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_03" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_04" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_05" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_06" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
            </div>
        </div>

        <div class="answer-wrap flex-column">
            <img class="star-big-l" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/star_bl-v=1.7.png">
            <div class="answer-box flex-center">
                <img class="answer-text" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/answer_text-v=1.7.png">
                <img class="arrow arrow_07" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_08" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_09" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
                <img class="arrow arrow_10" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/arrow-v=1.7.png">
            </div>
        </div>

        <div class="chart-wrap flex-column">
            <div class="chart-box flex-center">
                <img class="chart-text" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/line/index-v=1.7.png">
            </div>
        </div>

        <div class="comment-wrap flex-column">
            <div class="comment-box flex-column">
                <!--<img class="comment-title" src="http://const.cdn.xingzuozhuanjia.com/Horoscope/image/index/comment_title.png?v=1.7">-->
                <p class="comment-title-text flex-center"><span>已为超过</span><em>12万</em><span>人提供运势指引</span></p>
                <div class="detail-data flex-row">
                    <span class="person-count flex-row">已测算人数: <em>123343</em></span>
                    <span class="rate-num flex-row"> <img
                            src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index/emoji-v=1.7.png">好评率: <em>99.8%</em></span>
                </div>
                <div class="labels flex-row">
                    <span id="label_0">专业精准(<em>24234</em>)</span>
                    <span id="label_1">符合现状(<em>4532</em>)</span>
                    <span id="label_2">超级准(<em>3842</em>)</span>
                    <span id="label_3">五星好评(<em>2408</em>)</span>
                    <span id="label_4">具体(<em>64543</em>)</span>
                </div>
                <div class="upto-wrap">
                    <ul class="comment-list info-list-box">
                        <li>
                                <p class="user">东北秦**</p>
                                <p class="detail">我本来是冲着爱情运势来的，没想到事业也这么准，说的1月的事情已经发生了，不错不错！</p>
                            </li><li>
                                <p class="user">西安周**</p>
                                <p class="detail">我水瓶的，说火星5月会给我带来一个温暖的人，好期待嘤嘤嘤^_^</p>
                            </li><li>
                                <p class="user">郑州李**</p>
                                <p class="detail">缺点全被说中了，哼我就算知道了也不会改的</p>
                            </li><li>
                                <p class="user">南京李*</p>
                                <p class="detail">财运好准，说我1月有一笔理赔方面的偏财，结果车蹭了前天收到保险公司理赔。</p>
                            </li><li>
                                <p class="user">黑龙江朱**</p>
                                <p class="detail">说我2019年3月会从以前的同学里面找到另一半哈哈哈哈，刚刚和高中暗恋的男同学重逢哈哈哈</p>
                            </li><li>
                                <p class="user">重庆赵**</p>
                                <p class="detail">财运真的好准呀！说我被什么土星和冥王星影响，今年会遭遇拆迁什么的，我们村等了2年，刚通知的7月份拆迁。</p>
                            </li><li>
                                <p class="user">深圳孙*</p>
                                <p class="detail">蛮不错的嘞，跟我自己解读的差不多，但是更详细一些。</p>
                            </li><li>
                                <p class="user">苏州孙**</p>
                                <p class="detail">神准！我准备给我老公再测一下</p>
                            </li><li>
                                <p class="user">常州贾**</p>
                                <p class="detail">还挺专业的，不错</p>
                            </li><li>
                                <p class="user">徐州吴**</p>
                                <p class="detail">就两个字： 超值！！！</p>
                            </li><li>
                                <p class="user">东北李*</p>
                                <p class="detail">我的主动权占98%？？？我昨天主动出击真的把男神拿下了，开心开心啦啦啦</p>
                            </li><li>
                                <p class="user">武汉钱*</p>
                                <p class="detail">一分钱一分货，这个价位算是很不错的了</p>
                            </li><li>
                                <p class="user">成都何**</p>
                                <p class="detail">比较推荐，测完整体感觉很满意~</p>
                            </li><li>
                                <p class="user">洛阳孙**</p>
                                <p class="detail">占星师解答还是人工智能占星？感觉都挺高大上的</p>
                            </li><li>
                                <p class="user">张掖龙*</p>
                                <p class="detail">真得挺准```HOHO，炒鸡感谢呢！！！</p>
                            </li><li>
                                <p class="user">北京雷**</p>
                                <p class="detail">人家都是一个运势卖一份，你这个3个运势卖一份不会亏嘛（括弧笑）</p>
                            </li><li>
                                <p class="user">天津高**</p>
                                <p class="detail">个人觉得非常实用准确，推荐！</p>
                            </li><li>
                                <p class="user">香港任*</p>
                                <p class="detail">说的蛮准的，想找大师提问几个问题，请问在哪里可以问到？</p>
                            </li><li>
                                <p class="user">广州王*</p>
                                <p class="detail">还行，比之前我测过的专业很多，内容也更详细！</p>
                            </li><li>
                                <p class="user">台北张**</p>
                                <p class="detail">想要找大师单独测算一下，有没有这个功能，求问？</p>
                            </li><li>
                                <p class="user">丽江石*</p>
                                <p class="detail">内容上比较有针对性,也很容易懂,不会很文绉绉的,比较直白。</p>
                            </li><li>
                                <p class="user">海南洪**</p>
                                <p class="detail">性价比很高，一份运势三份内容，爱情，财富，事业都说了</p>
                            </li><li>
                                <p class="user">杭州樊*</p>
                                <p class="detail">和我找的占星师讲的一模一样，难道这公司老板是个占星师。。。</p>
                            </li><li>
                                <p class="user">福州刘**</p>
                                <p class="detail">解说详细，内容令人信服！</p>
                            </li><li>
                                <p class="user">厦门马**</p>
                                <p class="detail">无意间点进来的，忍不住好奇心就测了。emmm…真的蛮准的，性价比很高！</p>
                            </li><li>
                                <p class="user">福州汤*</p>
                                <p class="detail">还可以，比之前测过其他家的好很多，比较推荐！</p>
                            </li>                    </ul>
                </div>
            </div>
        </div>

        <div class="guide-wrap flex-column">
            <div class="guide-box flex-column">
                <p class="guide-title">2019年365天的</p>
                <div class="guide-labels flex-center">
                    <span class="label">婚恋桃花</span>
                    <span class="label">财富增长</span>
                    <span class="label">升职加薪</span>
                </div>
                <p class="guide-desc">
                    只需<em>1分钟</em>,详细解析立即获取
                </p>
            </div>
        </div>

    </section>

    <div class="toast-wrap flex-center">
        <div class="toast-box flex-center">
            <span></span>
        </div>
    </div>

    <div class="float-wrap flex-center">
        <div class="float-btn flex-center">
            <div class="start-btn start-zoom flex-center">
                <img class="start-bg" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index_2/btn_bg-v=1.0.png">
                <span class="start-name flex-center">立即分析白羊座运势</span>
            </div>
        </div>
    </div>
    <div class="spinner-wrap flex-center" style="display: none">
        <div class="spinner-box flex-column" style="width: 180px">
            <div class="spinner">
                <div class="spinner-container container1">
                    <div class="circle1"></div>
                    <div class="circle2"></div>
                    <div class="circle3"></div>
                    <div class="circle4"></div>
                </div>
                <div class="spinner-container container2">
                    <div class="circle1"></div>
                    <div class="circle2"></div>
                    <div class="circle3"></div>
                    <div class="circle4"></div>
                </div>
                <div class="spinner-container container3">
                    <div class="circle1"></div>
                    <div class="circle2"></div>
                    <div class="circle3"></div>
                    <div class="circle4"></div>
                </div>
            </div>
            <span class="tips-text">星象计算中，请稍后...</span>
        </div>
    </div>

    <div class="success-wrap flex-center" style="display:none;">
        <div class="success-box flex-column">
            <div class="success-banner flex-column">
                <img class="banners" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/interim/banner-v=1.7.png">
            </div>
            <div class="owner-wrap flex-column">
                <span class="owner flex-center"><em>白羊座</em>的</span>
                <span class="owner-2 flex-center">2019运势分析已购买</span>
            </div>
            <span class="over-text flex-center">正在进入...</span>
        </div>
    </div>
</section>
</body>
<script type="text/javascript" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/script/jquery.min.js"></script>
<script type="text/javascript" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/script/scroll.js"></script>

<script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/daily/js/loc.gps-v=1.0.js"></script>

<script type="text/javascript" src="/ffsm/statics/divine.cdn.h55u.com/platform/js/zwSdk.js"></script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#start_bg').show();
            $('.start-name').show();
        },10);
        var needchoose = "1";
        needchoose = parseInt(needchoose);
        if(needchoose){
            // $('.page').css({height: "100%", overflow: "hidden"});
            $('.alert').fadeIn();
        }
        var stars = ["白羊座","金牛座","双子座","巨蟹座","狮子座","处女座","天秤座","天蝎座","射手座","摩羯座","水瓶座","双鱼座"];
        var starid = "1";
        starid = parseInt(starid);
        //页面统计
        setTimeout(function () {
            try {
                MtaH5.clickStat("index_view");
                MtaH5.clickStat('2019xingzuoyuns-2', {'homepageuv': 'true'})
            } catch (e) {
                console.log(e);
            }
        }, 1000);
        var meteors = document.getElementById('meteors');
        // 随机生成流星
        for (var j = 0; j < 10; j++) {
            var newStar = document.createElement("div");
            newStar.className = "meteor";
            newStar.style.top = randomDistance(16, -3) + 'rem';
            newStar.style.left = randomDistance(110, 20) + '%';
            meteors.appendChild(newStar)
        }

        var meteor = document.getElementsByClassName('meteor');

        // 封装随机数方法
        function randomDistance(max, min) {
            var distance = Math.floor(Math.random() * max + min);
            return distance
        }

        // 给流星添加动画延时
        for (var i = 0, len = meteor.length; i < len; i++) {
            if (i % 6 == 0) {
                meteor[i].style.animationDelay = '0s'
            } else {
                meteor[i].style.animationDelay = i * 0.8 + 's'
            }
        }

        $('.toast-wrap').hide();
        $('.float-wrap').hide();
        $('.switch-btn').click(function () {
            // $('.page').css({height: "100%", overflow: "hidden"});
            $('.alert').fadeIn();
        });
        $('.close-btn').click(function () {
            // $('.page').css({height: "auto", overflow: "auto"});
            $('.alert').fadeOut();
        });
        $('.star-item').click(function (event) {
            starid = parseInt(event.currentTarget.dataset.star);
            var star_name_old = $('#star_name').text();
            $('#star_name').text(stars[starid-1]);
            $('.owner em').text(stars[starid-1]);
            var star_name_new = $('#star_name').text();
            if(star_name_old ==star_name_new){
                $('.alert').fadeOut();
                return null;
            }

            var star_banner = starid<10?('0'+starid):starid;
            $('.banner').attr("src", "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index_2/star_"+star_banner+".png?v=1.0");
            $('.start-name').text("立即分析"+stars[starid-1]+"运势");
            // $('.page').css({height: "auto", overflow: "auto"});
            $('.alert').fadeOut();
        });

        var count = "125281";
        var rate = "99.8%";
        var labels = Array;
        count = parseInt(count);
        $('.person-count em').text(count);

        if (count < 10000) {
            count = (count / 10000).toFixed(1) + '万';
        } else {
            count = parseInt(count / 10000) + '万';
        }
        $('.comment-title-text em').text(count);

        $('.rate-num em').text(rate);
        for (var i = 0; i < labels.length; i++) {
            $("#label_" + i + " em").text(labels[i]);
        }

        function showToast(msg) {
            $('.toast-wrap').fadeIn();
            $('.toast-wrap span').addClass('toast');
            $('.toast-wrap span').text(msg);
            setTimeout(function () {
                $('.toast-wrap').fadeOut();
            }, 1200)
        }


        $('.order-btn-wrap').click(function () {
            try {
                MtaH5.clickStat("history_click");
            } catch (e) {
                console.log(e);
            }
            setTimeout(function(){
                window.location.href = "/?ac=history";
            },400)
        });

        $('.start-btn').click(function () {

            try {
                MtaH5.clickStat("astr_click");
                MtaH5.clickStat('2019xingzuoyuns-2', {'atsrclick': 'true'});
            } catch (e) {
                console.log(e);
            }
            zwDivine.recordUserInfo({
                'name': '',
                'gender': 0,
                'birthday': '',
                'extra': JSON.stringify({
                    'src': '1001',
                    'starid': starid
                })
            });
            $.ajax({
                url: "/?ac=adddcorder2019",
                method: 'POST',
                data: {
                    src: '1001',
                    starid: starid
                },
                success: function (res) {
                    res = JSON.parse(res);
                    var orderId = res.orderId;
                    var src = '1001';
                    var paystatus = parseInt(res.paystatus);

                    if (res.code == 1) {
                        if(paystatus===1){
                            $('.success-wrap').fadeIn();
                            setTimeout(function () {
                                window.location.href = "/?ac=xingzuo2019&oid=" + orderId + '&src=' + src;
                                setTimeout(function () {
                                    $('.success-wrap').hide();
                                },1000);
                            }, 1500);
                        }else{
                            $('.spinner-wrap').fadeIn();
                            setTimeout(function () {
                                $('.spinner-wrap').hide();
                                window.location.href = "/?ac=xingzuo2019interim&oid="+ orderId + "&src=" + src;
                            }, 400);

                        }
                    }
                }
            })
        });


        window.onscroll = function () {
            var top = document.documentElement.scrollTop || document.body.scrollTop;
            top > 740 ? $('.float-wrap').fadeIn() : $('.float-wrap').fadeOut();
        };
    });
</script>


<script>
        var loadingfinish = "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loadingfinish.png";
        var userinput_name = '';
        var userinput_date = '';
        var userinput_province = '';
        var userinput_city = '';
        var userinput_lat = '';
        var userinput_lng = '';
        //var addOrderUrl = "/index.php/home/constell/adddcorder";
		var addOrderUrl = "/?ac=adddcorder";
        //var unpayPage = "/index.php/home/constell/dcpay/src/0/orderId/";
		var unpayPage = "/?ac=zhanxing&oid=";
        var dcsrc = '0';

        var yearList = [];
        var moonList = [];
        var dayList = [];
        var hourList = ["时间未知", "00:00~00:59", "01:00~01:59", "02:00~02:59", "03:00~03:59", "04:00~04:59", "05:00~05:59", "06:00~06:59", "07:00~07:59", "08:00~08:59", "09:00~09:59", "10:00~10:59", "11:00~11:59", "12:00~12:59", "13:00~13:59", "14:00~14:59", "15:00~15:59", "16:00~16:59", "17:00~17:59", "18:00~18:59", "19:00~19:59", "20:00~20:59", "21:00~21:59", "22:00~22:59", "23:00~23:59"];
        var InitIndexArr;
        for (var y = 0; y < 90; y++) {
            yearList.push(y + 1930);
        };
        for (var m = 0; m < 12; m++) {
            moonList.push(m + 1);
        };
        for (var d = 0; d < 31; d++) {
            dayList.push(d + 1);
        };
        function getDay(year, moon) {
            moon = parseInt(moon, 10);
            var temp = new Date(year, moon, 0);
            return temp.getDate();
        };
        var mobileSelect1 = new MobileSelect({
            trigger: '#birthday_input_value',
            title: '',
            wheels: [{
                data: yearList
            }, {
                data: moonList
            }, {
                data: dayList
            }, {
                data: hourList
            }],
            position: [65, 0, 0, 0],
            transitionEnd: function (indexArr, data) {
                InitIndexArr = indexArr;
                var endD = getDay(data[0], data[1]);
                dayList = [];
                for (var d = 0; d < endD; d++) {
                    dayList.push(d + 1);
                };
                mobileSelect1.updateWheel(2, dayList);
                if (InitIndexArr[2] > dayList.length - 1) {
                    mobileSelect1.locatePosition(2, dayList.length - 1);
                };
            },
            callback: function (indexArr, data) {
                $('.birthday_input_value').html(data[0]+'年'+data[1]+'月'+data[2]+'日 '+data[3]);
                if(indexArr[3] == 0){
                    userinput_date = data[0]+'-'+data[1]+'-'+data[2]+' 12:00';
                }else{
                    userinput_date = data[0]+'-'+data[1]+'-'+data[2]+' '+ (indexArr[3] - 1) + ':30';
                }
            }
        });

        var province = '北京';
        var city = '东城区';
        var provList = [];
        var nowIndex = 0;
        var overIndex = 0;
        Object.keys(locGPS).forEach(function (key) {
            provList.push(key);
        });
        var cityList = [];
        var cites = locGPS[provList[0]];
        Object.keys(cites).forEach(function (key) {
            cityList.push(key);
        });
        var mobileSelect2 = new MobileSelect({
            trigger: '#birthplace_input_value',
            title: '',
            wheels: [{data: provList}, {data: cityList}],
            position: [0, 0],
            transitionEnd: function (indexArr, data) {
                nowIndex = indexArr[0];
                if (nowIndex != overIndex) {
                    overIndex = nowIndex;
                    cityList = onProvChange(indexArr[0]);
                    mobileSelect2.updateWheel(1, cityList);
                    mobileSelect2.locatePosition(1, 0);
                }
            },
            callback: function (indexArr, data) {
                userinput_province = data[0];
                userinput_city = data[1];
                $('#birthplace_input_value').html(userinput_province + ' ' + userinput_city);
            }
        });

        function onProvChange(index) {
            cityList = [];
            cites = locGPS[provList[index]];
            Object.keys(cites).forEach(function (key) {
                cityList.push(key);
            });
            return cityList;
        }

    </script>

</html>