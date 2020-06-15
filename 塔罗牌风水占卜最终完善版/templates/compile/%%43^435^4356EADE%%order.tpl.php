<?php /* Smarty version 2.6.25, created on 2019-02-20 12:02:30
         compiled from index/hmjx/order.tpl */ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>号码解析-号码测算</title>
    <!--[if lt IE 9]>  
        <script src="/ffsm/statics/ffsm/hmjx/js/html5.js"></script>
        <script src="/ffsm/statics/ffsm/hmjx/js/respond.min.js"></script>    
    <![endif]-->
    <link rel="stylesheet" href="/ffsm/statics/ffsm/hmjx/css/zm_share.css"/>
    <link rel="stylesheet" href="/ffsm/statics/ffsm/hmjx/css/_szjx_zhifu.css"/>
    <script type="text/javascript" src="/ffsm/statics/ffsm/hmjx/js/rem.js"></script>
    <script type="text/javascript" src="/ffsm/statics/ffsm/hmjx/js/jquery.min.js"></script>
    <script type="text/javascript" src="/ffsm/statics/ffsm/hmjx/js/layer.js"></script>
    <style>
        .bzjp_zf_font_t{
            height:0.8rem;
            width:60%;
            margin: 0 auto 0.2rem; 
            line-height: 0.8rem;
            text-align: center;
            background:url('/ffsm/statics/ffsm/hmjx/images/title.png') no-repeat;
            background-size:100% 100%;
            color:#333333;
            font-weight: 700;
            font-size:0.36rem;
            text-shadow: 0.05rem 0.05rem 0.02rem #989898;
        }
        .bzjp_zf_foot_title{padding:0.3rem;}
    </style>
</head>
<body>
    <header class="share_header">
        <h1 class="zm">号码解析</h1>
        <a href="/" class="zm_titel"></a>
<a href="/?ac=history" class="zm_cs">我的测算</a>

    </header>
    <div class="bzjp_zf_container">
        <!-- top -->
        <div class="bzjp_zf_top">
            <div class="bzjp_zf_flex">
                <div class="bzjp_zf_content">
                    <p>你的出生日期是 <span class="redColor">公历 <?php echo $this->_tpl_vars['form']['birthday']; ?>
 <?php if ($this->_tpl_vars['form']['h']): ?><?php echo $this->_tpl_vars['form']['h']; ?>
<?php else: ?>未知<?php endif; ?>时</span></p>
                    <p class="jx_num">测算号码：<span class="redColor"><?php echo $this->_tpl_vars['data']['word']; ?>
</span></p>
                    <p>您的八字与这个号码有特殊的风水磁场，相生相助，相生相克，影响着你一生的运势，请一定要看。</p>
                    <p class="TImemoney">只需<?php echo $this->_tpl_vars['form']['money']; ?>
元</p>
                    <div class="ljck_btn J_pay_class">立即查看</div>
                </div>
                <div class="dashi_head"><img src="/ffsm/statics/ffsm/hmjx/picture/dashi.png" width="100%" alt=""></div>
            </div>
            <p class="bzjp_zf_time">距优惠结束:&nbsp;&nbsp;<span class="bzjp_color" id="hour_show">00:00:00</span></p>
        </div>
        <!-- 分析 -->
        <!-- <div class="hmfx_wrap"><div class="fx_btn J_pay_class">立即查看</div></div> -->
        <!-- center -->
        <!-- <div class="bzjp_zf_center">
            <div class="bzjp_zf_center_bg">
                <p class="bzjp_zf_center_title">你的号码分析报告</p>
                <p class="bzjp_zf_center_lineNum">(8000-2万字)</p>
                <p class="zf_line">1.内含你从小到大的经历，婚姻情况，2018年运势事业、财运、健康、流月运势等情况</p>
                <p class="zf_line">2.分析此号码对你的凶吉影响以及大师为你定制的趋吉避凶的开运方法</p>
                <div class="J_btn J_pay_class"><img src="/ffsm/statics/ffsm/hmjx/picture/img_btn2.png" alt="" width="100%"></div>
                <p class="bzjp_zf_center_foot">共123页</p>
            </div>
        </div> -->
        <!-- foot -->
        <div class="bzjp_zf_foot_wrap">
            <p class="bzjp_zf_font_t">你的号码分析报告</p>
            <div class="bzjp_zf_foot_title">结合你的号码分析你的人生运势</div>
            <ul class="bzjp_zf_foot_list">
                <li>
                    <h3>号码对你的事业和财运的影响</h3>
                    <p>1.是能成为<span class="bzjp_color">领导老板</span>还是只能做一个小职员？</p>
                    <p>2.会有<span class="bzjp_color">偏财、暗财、意外之财</span>吗？</p>
                    <p>3.会因为是非<span class="bzjp_color">破财</span>吗？投资能赚到钱吗？</p>
                </li>
                <li>
                    <h3>号码对你的恋爱和婚姻的影响</h3>
                    <p>1.是<span class="bzjp_color">恩爱幸福、美满和谐</span>还是互相猜忌、天天吵架？</p>
                    <p>2.又或是遭遇<span class="bzjp_color">分手、离婚、婚外情</span>？</p>
                </li>
                <li>
                    <h3>号码对你的人际关系的影响</h3>
                    <p>1.<span class="bzjp_color">人缘</span>好吗？<span class="bzjp_color">朋友</span>多吗？</p>
                    <p>2.容易被小人<span class="bzjp_color">陷害算计</span>吗？</p>
                    <p>3.是只能依靠自己奋斗还是会有<span class="bzjp_color">贵人帮助</span>？</p>
                </li>
                <li>
                    <h3>号码对你性格形成的影响</h3>
                    <p>1.是冲动急躁、自负好胜、还是乐观随缘、聪明单纯？</p>
                    <p>2.是保守固执、优柔寡断？</p>
                </li>
                <li>
                    <h3>号码对你身体健康的影响</h3>
                    <p>1.你在生活中容易出现<span class="bzjp_color">车祸、血光、官司</span>等意外灾祸吗？</p>
                    <p>2.你的<span class="bzjp_color">健康状况</span>会出问题吗？</p>
                </li>
            </ul>
        </div>
    </div>
    <!-- 悬浮按钮 -->
    <div class="bzjp_zf_fiexd_btn J_pay_class"><div class="btn_bg"></div></div>
    <!-- 支付弹窗 -->
    <div class="public_pay_popup" id="publicPayPopup" style="display: none;">
        <div class="public_pp_box">
            <div class="public_pp_close" id="publicPPClose">X</div>
            <div class="public_pp_tit">解锁查看所有测算结果</div>
            <div class="public_pp_price">
                <span>统一鉴定价：</span><strong>￥<?php echo $this->_tpl_vars['form']['money']; ?>
元</strong>
            </div>
            <div class="public_pay_box">
              
              <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1" class="zf weixin"><img src="/ffsm/statics/ffsm/hmjx/picture/wxzf.png" alt="微信支付"/>微信支付</a>
              
              <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2" class="zf alipay"><img src="/ffsm/statics/ffsm/hmjx/picture/zfbzf.png" alt="支付宝支付"/>支付宝支付</a>
              
              </div>
        </div>
    </div>
    <!-- 返回弹窗 -->
    <style>
    .wxPay_container{
        width:100%;
        height:100%;
        background-color:rgba(0,0,0,0.3);
        position: fixed;
        top:0;
        left:0;
        z-index: 99;
        display: none;
    }
    .wxPay_wrap{
        font-size:14px;
        width:90%;
        border-radius: 10px;
        position: absolute;
        left:50%;
        top:50%;
        transform: translate(-50%,-50%);
        -moz-transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
        -o-transform: translate(-50%,-50%);
        background-color:#ffffff;
    }
    .wxPay_title{
        color:#ffffff;
        background-color:#951F2B;
        text-align: center;
        padding:10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .wxPay_content{padding:10px;}

    .wxPay_info{
        background-color:#FCF2D9;
        padding:10px;
    }
    .I_left{width:60px;display: inline-block;}
    
    .birth{display: flex;}
    .I_right{display:flex;flex-direction: column;width:100%;}
    .end_content{padding:15px 0;text-indent: 2em;}
    .wxPay_btn{
        width:60%;
        height:40px;
        line-height: 40px;
        text-align: center;
        color:#ffffff;
        background-color:#951F2B;
        border-radius:20px;
        margin:10px auto;
    }
    .close_bg{
        background:url('/ffsm/statics/ffsm/hmjx/images/close_.png') no-repeat;
        background-size:100% 100%;
        position: absolute;
        width:35px;
        height:35px;
        right:0;
        top:-18%;
    }
</style>



<script>
    $(function(){
        var wxlogin="";
        if(wxlogin == "1"){
            var sss;
            pushHistory();
            window.addEventListener("popstate", function(e) {
                //$.getJSON("/zhiming/index.php/home-index-jieguoyereturn",function(data){//回调统计入库
                });

                var s_type = window.location.href.split('#')[1];
                if(s_type == undefined){
                    $('.wxPay_container').css('display','block');
                    // 阻止弹窗滚动
                    var scrollTop = window.pageYOffset  
                    || document.documentElement.scrollTop  
                    || document.body.scrollTop  
                    || 0;
                    sss=scrollTop;//保存当前滚动条位置
                    document.body.style.top=-1*scrollTop+"px";
                    document.body.style.position='fixed';
                }
            }, false);
            $('.close_bg').on('click',function(){
                $('.wxPay_container').css('display','none');
                document.body.style.overflow='';
                document.body.style.position=null;
                document.body.style.top=null;
                window.scrollTo(0,sss);
            })
        }else{
            console.log('不是微信')
        }
    });
    
    function pushHistory() {
        var state = {
            title: "",
            url:""
        };
        window.history.pushState(state, state.title, state.url);
    }
</script>
 <script>
        $('.J_pay_class').on('click',function(){//悬浮付费解锁所有项
            $('#publicPayPopup').css('display','block');
        })
        $('#publicPPClose').on('click',function(){
            $('#publicPayPopup').css('display','none');
        })

       var intDiff = parseInt(655);//倒计时总秒数量
function timer(intDiff){
    window.setInterval(function(){
    var day=0,
        hour=0,
        minute=0,
        second=0;//时间默认值        
    if(intDiff > 0){
        day = Math.floor(intDiff / (60 * 60 * 24));
        hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
        minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
        second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
    }
    if (hour <= 9) hour = '0' + hour;
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;

    $('#hour_show').html(hour+' : '+minute+' : '+second);
    intDiff--;
    }, 1000);
} 

timer(intDiff);
//支付后检测跳转
  <?php if ($this->_tpl_vars['yz_pay'] == 1): ?>
       var inquiry_lock = 0;
    $(function () {
        setInterval(function () {
            inquiry(); 
        }, 1000);
    });
    function inquiry() {
        if (inquiry_lock) {
            return;
        }
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                $('div.weixin .green').html('支付成功');
                window.location = data.url;
            }
        }, 'json');
    }
  <?php endif; ?>
    </script>  
<!--天玄算命网付费测算源码-->
</body>
</html>