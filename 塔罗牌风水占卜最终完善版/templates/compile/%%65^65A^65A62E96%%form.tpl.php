<?php /* Smarty version 2.6.25, created on 2019-04-16 15:26:27
         compiled from index/zhanxing/form.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta charset="utf-8">
    <title>本命星盘解析</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            border: none;
        }
        html, body{
            width: 100%;
            height: 100%;
            max-width: 640px;
            margin: 0 auto;
            background-color: #0e003d;
            font-family: 'PingFang SC', 'Lantinghei SC', 'Helvetica Neue', 'Helvetica', 'Arial', 'Microsoft YaHei', '微软雅黑', 'STHeitiSC-Light', 'simsun', '宋体', 'WenQuanYi Zen Hei', 'WenQuanYi Micro Hei', 'sans-serif';
        }
        div.swiper-wrapper{
            -webkit-transition-timing-function: linear;
            -o-transition-timing-function: linear;
            transition-timing-function: linear;
        }
    </style>
    <script type="text/javascript">
        (function(doc, win) {
            var docEl = doc.documentElement,
                    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                    recalc = function() {
                        var clientWidth = docEl.clientWidth > 640 ? 640: docEl.clientWidth;
                        if (!clientWidth) return;
                        docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';
                    };
            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
            recalc();
        })(document, window);
    </script>
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/css/index-v=1.3.css">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/card/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/css/mobileSelect.css">
    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/js/mobileSelect-v=1.2.js" type="text/javascript"></script>
</head>
<body>
    <div class="mainbox">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/title.png" class="title_img">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/history.png" class="history_img" id="history_img">
        <div class="index_infobox">
            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/1208_tips.png" class="index_info_tip">
            
            <div class="birthday_box">
                <span>你的姓名：</span>
                <p class="userinput_name"><input id="userinput_name" placeholder="请输入名字" type="text" name="username" border="0" style="background-color:#ded9ed; height:36px; font-size:18px; width:180px;"></p>
            </div>
            
            
       <!--<div class="birthday_box">
            <span>你的性别：</span>
            <p class="userinput_name">
                <input name="Fruit" type="radio" value="" checked="true" />男  &nbsp; <input name="Fruit" type="radio" value="" />女 
            </p>
        </div>-->
            
            <div class="birthday_box">
                <span>出生日期：</span>
                <p class="birthday_input_value" id="birthday_input_value">选择你的出生日期<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/1208_arrow.png" class="index_info_arrow"></p>
            </div>
            <div class="birthday_box">
                <span>出生地点：</span>
                <p class="birthplace_input_value" id="birthplace_input_value">选择你的出生地点<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/1208_arrow.png" class="index_info_arrow"></p>
            </div>
        </div>
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/newbtn-v=1.1.png" class="btn_img">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/splite.png" class="splite_img">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/index-bg-v=1.1.png" class="content_img ">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/comment_top.png" class="comment_top_border">
        <div class="comment_box">
            <div class="comment_border swiper-container">
                <div class="swiper-wrapper parent-wrapper">
                    <div class="swiper-slide">
                            <p class="comment_title">海南秦**</p>
                            <p class="comment_desc">准！比较详细，我就喜欢这种比较专业的，最烦那种模棱两可的。不过有一些细节不是很深入，想找老师帮忙再详细算一遍。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">洛阳周**</p>
                            <p class="comment_desc">假性外向型人格也太准了把，哈哈哈哈！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">哈尔滨李**</p>
                            <p class="comment_desc">缺点全被说中了，哼我就算知道了也不会改的</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">西安李*</p>
                            <p class="comment_desc">连我的隐藏起来的性格都说中了，比我妈还了解我。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">乌鲁木齐朱**</p>
                            <p class="comment_desc">这是什么神仙软件，太过分了吧！7个大项全部说中</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">上海赵**</p>
                            <p class="comment_desc">我本身的星座是处女，上升星座也是处女，强迫症看来是没救了</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">上海孙*</p>
                            <p class="comment_desc">有没有跟我一样全被说中的</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">无锡孙**</p>
                            <p class="comment_desc">原来以前说的都是太阳星座，真正的占星还有上升，月亮，象限，属性好多好多，一大堆东西</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">上海贾**</p>
                            <p class="comment_desc">我的天，第一次见到有星盘的测评，好专业啊我的天，超级无敌值</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">杭州吴**</p>
                            <p class="comment_desc">就两个字： 超值！！！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">杭州李*</p>
                            <p class="comment_desc">星盘找占星师来看起步就得一千块，我居然找到了一个可以解析星盘的测评，哈哈哈哈哈</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">苏州钱*</p>
                            <p class="comment_desc">好专业，很详细，真得挺准```</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">西安何**</p>
                            <p class="comment_desc">比较推荐，测完整体感觉很满意~</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">太原孙**</p>
                            <p class="comment_desc">人工智能占星？</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">石家庄龙*</p>
                            <p class="comment_desc">真得挺准```HOHO，炒鸡感谢呢！！！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">深圳雷**</p>
                            <p class="comment_desc">准的我想砸手机，人家辣么多缺点你毫不留情都讲出来了，坏死了</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">深圳高**</p>
                            <p class="comment_desc">个人觉得非常实用准确，推荐！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">重庆任*</p>
                            <p class="comment_desc">太神奇了，真得好准```</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">天津王*</p>
                            <p class="comment_desc">还行，比之前我测过的专业很多，内容也更详细！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">天津张**</p>
                            <p class="comment_desc">个人觉得还是蛮准的,并且很详细,很值！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">北京石*</p>
                            <p class="comment_desc">内容上比较有针对性,也很容易懂,不会很文绉绉的,比较直白。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">北京洪**</p>
                            <p class="comment_desc">本年度测过性价比最高的占星了，没有之一！！！墙裂推荐</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">北京樊*</p>
                            <p class="comment_desc">和我找的占星师讲的一模一样，难道这公司老板是个占星师。。。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">上海刘**</p>
                            <p class="comment_desc">解说详细，内容令人信服！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">台北马**</p>
                            <p class="comment_desc">无意间点进来的，忍不住好奇心就测了。emmm…真的蛮准的，性价比很高！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">香港汤*</p>
                            <p class="comment_desc">还可以，比之前测过其他家的好很多，比较推荐！</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">广州刁*</p>
                            <p class="comment_desc">这是一群占星师做出来的嘛，居然有星盘。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">昆明孟*</p>
                            <p class="comment_desc">刚看到一条评论说有星盘，我才不信，进去一看卧槽真的有。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">大理刘*</p>
                            <p class="comment_desc">我要给我男神测，然后把他拿下哈哈哈哈。</p>
                            <p class="comment_splitline"></p>
                        </div><div class="swiper-slide">
                            <p class="comment_title">丽江殷*</p>
                            <p class="comment_desc">我把内容背下来跟女神一顿吹，当天就成了，现在她让我帮她现场看星盘，我又不会看我咋办啊</p>
                            <p class="comment_splitline"></p>
                        </div>                </div>
            </div>
        </div>
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/comment_bottom.png" class="comment_bottom_border">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/newbtn-v=1.1.png" class="btn_img">
        <div style="height: 50px;"></div>
    </div>

    <div id="daily_recommend_box">
        <div class="daily_recommend">
            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/recommend_content-v=1.3.png" class="recommend_content">
            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/img/recommend_next_btn.png" class="recommend_next_btn" id="recommend_next_btn">
        </div>
    </div>

    <div class="loading_box">
        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loadingbg.png" class="loadingbg">

        <div class="loading_progress_box">
            <div class="loading_progress progress_1">
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loading_load.png" alt="" class="loadingimg loading_animation progress_loadimg_1">
                <span class="loadingtext progress_text_1">外在性格分析中</span>
            </div>
            <div class="loading_progress progress_2">
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loading_load.png" alt="" class="loadingimg loading_animation progress_loadimg_2">
                <span class="loadingtext progress_text_2">隐藏性格分析中</span>
            </div>
            <div class="loading_progress progress_3">
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loading_load.png" alt="" class="loadingimg loading_animation progress_loadimg_3">
                <span class="loadingtext progress_text_3">擅长领域分析中</span>
            </div>
            <div class="loading_progress progress_4">
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loading_load.png" alt="" class="loadingimg loading_animation progress_loadimg_4">
                <span class="loadingtext progress_text_4">性格成分分析中</span>
            </div>
            <div class="loading_progress progress_5">
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/loading_load.png" alt="" class="loadingimg loading_animation progress_loadimg_5">
                <span class="loadingtext progress_text_5">主被动人格分析中</span>
            </div>

            <p class="loading_finish">分析完成，生成报告中...</p>
        </div>
    </div>

    <div class="toastbox"></div>

    <div id="trigger1"></div>

    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/js/jquery-1.8.3.min.js"></script>
    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/card/js/swiper-3.4.2.jquery.min.js"></script>
    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/daily/js/loc.gps-v=1.0.js"></script>
    
    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/home/js/check-v=1.72.js"></script>
    
    <script src="/ffsm/statics/divine.cdn.h55u.com/platform/js/zwSdk.js"></script>
    
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

    <script>
        var query = window.location.search.substring(1);
        var btndoms = document.getElementsByClassName('btn_img');
        for(var i = 0; i < btndoms.length; i++){
            btndoms[i].addEventListener('click', function(){
                try{
                    if(typeof(MtaH5) != 'undefined' ){
                        MtaH5.clickStat("index_play_click")
                        MtaH5.clickStat('benmingpanzhuan',{'indexclick':'true'})
                    }
                }catch(err){
                    console.log(err)
                }
                setTimeout(function(){
                    submitOrder();
                    // window.location.href = "/index.php/home/constell/dcinfo?" + query;
                }, 300);
            });
        }
        var recdom = document.getElementById('history_img');
        if(recdom){
            recdom.addEventListener('click', function(){
                try{
                    if(typeof(MtaH5) != 'undefined' ){
                        MtaH5.clickStat("index_history_click")
                    }
                }catch(err){
                    console.log(err)
                }
                window.location.href = "/?ac=history";
                // window.location.href = "/index.php/home/constell/dclist";
            });
        }
		//历史
		
		

        var showdate = "2019-03-18";
        try{
            if(!localStorage.getItem('dc_recommend_showdate')){
                document.getElementById('daily_recommend_box').style.display = 'block';
                localStorage.setItem('dc_recommend_showdate', showdate);

                document.getElementById('recommend_next_btn').addEventListener('click', function(){
                    document.getElementById('daily_recommend_box').style.display = 'none';
                });
            }
        }catch(err){

        }

        var mySwiper = new Swiper('.swiper-container', {
            speed: 2500,
            autoplay: {
                delay: 2500,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            },
            initialSlide: 0,
            direction: 'vertical',
            spaceBetween: 15,
            slidesPerView: 3,
            height: 300,
            mousewheel: false,
            nested:true,
            swipeHandler : '.swipe-handler',
            allowTouchMove: false,
            loop : true,
        })

        setTimeout(function(){
            try{
                if(typeof(MtaH5) != 'undefined' ){
                    MtaH5.clickStat("index_view");
                    MtaH5.clickStat('benmingpanzhuan',{'indexview':'true'});
                }
            }catch(err){
                console.log(err)
            }
        }, 1000);

    </script>
    
</body>
</html>