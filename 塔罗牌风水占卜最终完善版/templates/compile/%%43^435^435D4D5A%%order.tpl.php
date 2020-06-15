<?php /* Smarty version 2.6.25, created on 2019-03-29 14:00:01
         compiled from index/xingzuo2019/order.tpl */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0"/>
    <title>2019运势分析</title>
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/common.css?v=1.7">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/preview_2.css?v=1.0">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/alert.css?v=1.1">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/success.css?v=1.0">
    <script type="text/javascript" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/script/rem.js?v=1.7"></script>
</head>

<body>
<section class="alert" style="display: none">
    <div class="alert-wrap flex-column">
        <div class="alert-box flex-column">
            <div class="alert-banner-box flex-center">
                <img class="close-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/close_btn.png?v=1.0">
                <img class="alert-banner" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/banner.png?v=1.0">
                <div class="banner-desc flex-column">
                    <p class="banner-title">选择星座</p>
                    <p class="banner-tips">查看对应星座的2019运势</p>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="1">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s1.png?v=1.1">
                    <span class="star-name">白羊座</span>
                    <span class="star-time">3.21-4.19</span>
                </div>
                <div class="star-item flex-column" data-star="2">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s2.png?v=1.1">
                    <span class="star-name">金牛座</span>
                    <span class="star-time">4.20-5.20</span>
                </div>
                <div class="star-item flex-column" data-star="3">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s3.png?v=1.1">
                    <span class="star-name">双子座</span>
                    <span class="star-time">5.21-6.21</span>
                </div>
                <div class="star-item flex-column" data-star="4">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s4.png?v=1.1">
                    <span class="star-name">巨蟹座</span>
                    <span class="star-time">6.22-7.22</span>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="5">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s5.png?v=1.1">
                    <span class="star-name">狮子座</span>
                    <span class="star-time">7.23-8.22</span>
                </div>
                <div class="star-item flex-column" data-star="6">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s6.png?v=1.1">
                    <span class="star-name">处女座</span>
                    <span class="star-time">8.23-9.22</span>
                </div>
                <div class="star-item flex-column" data-star="7">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s7.png?v=1.1">
                    <span class="star-name">天秤座</span>
                    <span class="star-time">9.23-10.23</span>
                </div>
                <div class="star-item flex-column" data-star="8">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s8.png?v=1.1">
                    <span class="star-name">天蝎座</span>
                    <span class="star-time">10.24-11.22</span>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="9">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s9.png?v=1.1">
                    <span class="star-name">射手座</span>
                    <span class="star-time">11.23-12.21</span>
                </div>
                <div class="star-item flex-column" data-star="10">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s10.png?v=1.1">
                    <span class="star-name">摩羯座</span>
                    <span class="star-time">12.22-1.19</span>
                </div>
                <div class="star-item flex-column" data-star="11">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s11.png?v=1.1">
                    <span class="star-name">水瓶座</span>
                    <span class="star-time">1.20-2.18</span>
                </div>
                <div class="star-item flex-column" data-star="12">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s12.png?v=1.1">
                    <span class="star-name">双鱼座</span>
                    <span class="star-time">2.19-3.20</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page">

    <section class="main-wrap flex-column">
        <div class="banner-wrap flex-column">
            <div class="xinzuo-wrap flex-column">
                <div class="switch-wrap flex-row">
                    <div class="star-box flex-row-2"><label for="star_name">当前星座:</label><span data-sid="1" id="star_name"><?php echo $this->_tpl_vars['data']['data']['username']; ?>
</span></div>
                    <img class="switch-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/index_2/switch_btn.png?v=1.0">
                </div>
                <img class="xinzuo-name" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview_2/<?php echo $this->_tpl_vars['data']['data']['username']; ?>
.png?v=1.0">
            </div>
            <img class="banner" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview_2/banner_2.png?v=1.0">
        </div>

        <div class="pay-wrap flex-column">
            <div class="pay-box flex-column">
                <img class="guide-text" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/guide_text.png?v=1.7" >
                <div class="price-box flex-row">
                    <div class="prices flex-column">
                        <div class="first-line flex-row">
                            <span class="title">原价</span>
                            <span class="false-price">￥138.8</span>
                        </div>
                        <div class="second-line flex-row">
                            <span class="title">限时优惠</span>
                            <span class="true-price">￥<?php echo $this->_tpl_vars['data']['money']; ?>
</span>
                        </div>
                    </div>
                    <div class="times flex-column">
                        <span>距优惠结束</span>
                        <span class="run-time">02: 00: 00</span>
                    </div>
                </div>
                <img class="pay-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/pay_btn.png?v=1.7">
            </div>
        </div>

        <div class="title-wrap flex-center">
            <img class="guide-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/guide_title.png?v=1.7">
        </div>

        <div class="items-wrap flex-column love-wrap">
            <div class="items-box flex-column">
                <span class="items-title">2019爱情运势详解</span>
                <div class="month-wrap flex-column">
                    <div class="rate-box flex-row">
                        <span class="rate-title">综合评分：</span>
                        <div class="star-line flex-row-2" id="love_star"></div>
                    </div>
                    <img class="month-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/month_love.png?v=1.7">
                </div>
                <div class="item-box flex-column">
                    <div class="item flex-column">
                        <span class="item-title flex-row">你的感情态度：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_01.png?v=1.7">
                    </div>
                    <div class="item flex-column">
                        <span class="item-title flex-row">单身桃花运势：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_02.png?v=1.7">
                    </div>
                    <div class="item flex-column">
                        <span class="item-title flex-row">情侣感情运势：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_03.png?v=1.7">
                    </div>
                </div>
            </div>
        </div>

        <div class="items-wrap flex-column cash-wrap">
            <div class="items-box flex-column">
                <span class="items-title">2019财富运势详解</span>
                <div class="month-wrap flex-column">
                    <div class="rate-box flex-row">
                        <span class="rate-title">综合评分：</span>
                        <div class="star-line flex-row-2" id="cash_star"></div>
                    </div>
                    <img class="month-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/month_cash.png?v=1.7">
                </div>
                <div class="item-box flex-column">
                    <div class="item flex-column">
                        <span class="item-title flex-row">财运总评：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_04.png?v=1.7">
                    </div>
                    <div class="item flex-column">
                        <span class="item-title flex-row">投资状况：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_05.png?v=1.7">
                    </div>
                    <div class="item flex-column">
                        <span class="item-title flex-row">支出详解：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_06.png?v=1.7">
                    </div>
                </div>
            </div>
        </div>

        <div class="items-wrap flex-column job-wrap">
            <div class="items-box flex-column">
                <span class="items-title">2019事业运势详解</span>
                <div class="month-wrap flex-column">
                    <div class="rate-box flex-row">
                        <span class="rate-title">综合评分：</span>
                        <div class="star-line flex-row-2" id="job_star"></div>
                    </div>
                    <img class="month-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/month_job.png?v=1.7">
                </div>
                <div class="item-box flex-column">
                    <div class="item flex-column">
                        <span class="item-title flex-row">事业运势总评：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_07.png?v=1.7">
                    </div>
                    <div class="item flex-column">
                        <span class="item-title flex-row">工作学习情况：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_08.png?v=1.7">
                    </div>
                    <div class="item flex-column">
                        <span class="item-title flex-row">职场学业发展：</span>
                        <img class="item-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/item_09.png?v=1.7">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="float-wrap flex-center" style="display:none;">
        <div class="float-btn flex-center">
            <div class="ceshi-box flex-center">
                <img class="start-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/pay_btn_bg.png?v=1.0">
                <span class="price-text flex-center">查看完整解析( <em>￥8.8</em>)</span>
            </div>
        </div>
    </div>

    <div class="success-wrap flex-center" style="display:none;">
        <div class="success-box flex-column">
            <div class="success-banner flex-column">
                <img class="banners" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/interim/banner.png?v=1.7">
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
<script type="text/javascript" src="/ffsm/statics/divine.cdn.h55u.com/platform/js/zwSdk.js"></script>

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

<script>

    $(document).ready(function () {
        //初始化星级
        var love_on = '<?php echo $this->_tpl_vars['data']['zh_on']['love_on']; ?>
';
        love_on = Number(love_on);
        var cash_on = '<?php echo $this->_tpl_vars['data']['zh_on']['cash_on']; ?>
';
        cash_on = Number(cash_on);
        var job_on = '<?php echo $this->_tpl_vars['data']['zh_on']['job_on']; ?>
';
        job_on = Number(job_on);
        var love_on_m = parseInt(love_on);
        var love_bool = love_on_m<love_on?true:false;
        var cash_on_m = parseInt(cash_on);
        var cash_bool = cash_on_m<cash_on?true:false;
        var job_on_m = parseInt(job_on);
        var job_bool = job_on_m<job_on?true:false;
        initStar();
        function initStar() {
            for (var i = 0; i < 5; i++) {
                if(i<love_on_m){
                    $('#love_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_d.png?v=1.7'>");
                }else{
                    if(love_bool){
                        $('#love_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_d_0.png?v=1.7'>");
                        love_bool = false;
                    }else{
                        $('#love_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_a.png?v=1.7'>");
                    }
                }
                if(i<cash_on_m){
                    $('#cash_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_c.png?v=1.7'>");
                }else{
                    if(cash_bool){
                        $('#cash_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_c_0.png?v=1.7'>");
                        cash_bool = false;
                    }else{
                        $('#cash_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_a.png?v=1.7'>");
                    }
                }
                if(i<job_on_m){
                    $('#job_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_b.png?v=1.7'>");
                }else{
                    if(job_bool){
                        $('#job_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_b_0.png?v=1.7'>");
                        job_bool = false;
                    }else{
                        $('#job_star').append("<img class='star' src='/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview/star_a.png?v=1.7'>");
                    }
                }
            }
        }
        //倒计时
        var remain = parseInt("7200");
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
                $('.run-time').text(h + ': ' + m + ': ' + s);
            } else {
                window.clearInterval(animate);
                window.location.href = "/?ac=xingzuo2019";
            }
        }

        $('.switch-btn').click(function () {
            $('.page').css({height: "100%", overflow: "hidden"});
            $('.alert').fadeIn();
        });
        $('.close-btn').click(function () {
            $('.page').css({height: "auto", overflow: "auto"});
            $('.alert').fadeOut();
        });
        var stars = ["白羊座","金牛座","双子座","巨蟹座","狮子座","处女座","天秤座","天蝎座","射手座","摩羯座","水瓶座","双鱼座"];
        var starid = 1;
        $('.star-item').click(function (event) {
            starid = parseInt(event.currentTarget.dataset.star);
            var star_name_old = "白羊座";
            $('#star_name').text(stars[starid-1]);
            $('.owner em').text(stars[starid-1]);
            var star_name_new = $('#star_name').text();
            if(star_name_old ==star_name_new){
                $('.page').css({height: "auto", overflow: "auto"});
                $('.alert').fadeOut();
                return null;
            }
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
                                window.location.href = "/index.php?ac=xingzuo2019&oid=" + orderId + '&src=' + src;
                                setTimeout(function () {
                                    $('.success-wrap').hide();
                                },1000)
                            }, 1500);
                        }else{
                            window.location.href = "/?ac=xingzuo2019interim&oid="+ orderId + "&src=" + src;
                        }
                    }
                    $('.page').css({height: "auto", overflow: "auto"});
                    $('.alert').fadeOut();

                },
                fail: function (err) {
                   console.log(err);
                    $('.page').css({height: "auto", overflow: "auto"});
                   $('.alert').fadeOut();
                }
            });
        });

        $('.pay-btn').click(function () {
            toPay();
        });
        $('.item-img').click(function () {
            toPay();
        });
        $('.ceshi-box').click(function () {
            toPay();
        });
        function toPay() {
            window.location.href = "/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['data']['oid']; ?>
&type=1";
        }
    });

    window.onscroll = function () {
        var top = document.documentElement.scrollTop || document.body.scrollTop;
        top > 740 ? $('.float-wrap').fadeIn() : $('.float-wrap').fadeOut();
    }
</script>

</html>