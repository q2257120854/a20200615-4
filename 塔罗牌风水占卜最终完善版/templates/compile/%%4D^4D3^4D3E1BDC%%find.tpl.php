<?php /* Smarty version 2.6.25, created on 2019-03-30 10:24:58
         compiled from index/xingzuo2019/find.tpl */ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0"/>
    <title>2019运势分析</title>
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/common.css?v=1.7">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/result_2.css?v=2.6">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/alert.css?v=1.0">
    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/css/loading.css?v=1.7">
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
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s1.png?v=1.0">
                    <span class="star-name">白羊座</span>
                    <span class="star-time">3.21-4.19</span>
                </div>
                <div class="star-item flex-column" data-star="2">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s2.png?v=1.0">
                    <span class="star-name">金牛座</span>
                    <span class="star-time">4.20-5.20</span>
                </div>
                <div class="star-item flex-column" data-star="3">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s3.png?v=1.0">
                    <span class="star-name">双子座</span>
                    <span class="star-time">5.21-6.21</span>
                </div>
                <div class="star-item flex-column" data-star="4">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s4.png?v=1.0">
                    <span class="star-name">巨蟹座</span>
                    <span class="star-time">6.22-7.22</span>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="5">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s5.png?v=1.0">
                    <span class="star-name">狮子座</span>
                    <span class="star-time">7.23-8.22</span>
                </div>
                <div class="star-item flex-column" data-star="6">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s6.png?v=1.0">
                    <span class="star-name">处女座</span>
                    <span class="star-time">8.23-9.22</span>
                </div>
                <div class="star-item flex-column" data-star="7">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s7.png?v=1.0">
                    <span class="star-name">天秤座</span>
                    <span class="star-time">9.23-10.23</span>
                </div>
                <div class="star-item flex-column" data-star="8">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s8.png?v=1.0">
                    <span class="star-name">天蝎座</span>
                    <span class="star-time">10.24-11.22</span>
                </div>
            </div>
            <div class="alert-item flex-row">
                <div class="star-item flex-column" data-star="9">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s9.png?v=1.0">
                    <span class="star-name">射手座</span>
                    <span class="star-time">11.23-12.21</span>
                </div>
                <div class="star-item flex-column" data-star="10">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s10.png?v=1.0">
                    <span class="star-name">摩羯座</span>
                    <span class="star-time">12.22-1.19</span>
                </div>
                <div class="star-item flex-column" data-star="11">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s11.png?v=1.0">
                    <span class="star-name">水瓶座</span>
                    <span class="star-time">1.20-2.18</span>
                </div>
                <div class="star-item flex-column" data-star="12">
                    <img class="star-img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/stars/s12.png?v=1.0">
                    <span class="star-name">双鱼座</span>
                    <span class="star-time">2.19-3.20</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page" style="padding-bottom: 1.6rem;">

    <section class="main-wrap flex-column">
        <div class="banner-wrap flex-column">
            <div class="xinzuo-wrap flex-center">
                <img class="xinzuo-name" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/preview_2/<?php echo $this->_tpl_vars['data']['data']['xz']; ?>
.png?v=1.0">
            </div>
            <img class="banner" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/banner.png?v=1.7">
        </div>

        <div class="title-wrap flex-center">
            <img class="first-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/main_01.png?v=1.0">
        </div>

        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="base-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/base_01.png?v=1.0">
                <div class="row flex-row">
                    <span class="col-l flex-row-2">个人特点：<em><?php echo $this->_tpl_vars['data']['base']['td']; ?>
</em></span>
                    <span class="col-r flex-row-2">四象属性：<em><?php echo $this->_tpl_vars['data']['base']['sixiang']; ?>
</em></span>
                </div>
                <div class="row flex-row">
                    <span class="col-l flex-row-2">掌管宫位：<em><?php echo $this->_tpl_vars['data']['base']['gongwei']; ?>
</em></span>
                    <span class="col-r flex-row-2">阴阳属性：<em><?php echo $this->_tpl_vars['data']['base']['yinyang']; ?>
</em></span>
                </div>
                <div class="row flex-row">
                    <span class="col-l flex-row-2">最强特征：<em><?php echo $this->_tpl_vars['data']['base']['strong']; ?>
</em></span>
                    <span class="col-r flex-row-2">守&ensp;护&ensp;星：<em><?php echo $this->_tpl_vars['data']['base']['shouhu']; ?>
</em></span>
                </div>
                <div class="row flex-row">
                    <span class="col-l flex-row-2">吉祥饰物：<em><?php echo $this->_tpl_vars['data']['base']['jixiang']; ?>
</em></span>
                    <span class="col-r flex-row-2">开运金属：<em><?php echo $this->_tpl_vars['data']['base']['jinshu']; ?>
</em></span>
                </div>
                <div class="row flex-row">
                    <span class="col-l flex-row-2">幸运数字：<em><?php echo $this->_tpl_vars['data']['base']['number']; ?>
</em></span>
                    <span class="col-r flex-row-2">幸运颜色：<em><?php echo $this->_tpl_vars['data']['base']['yanse']; ?>
</em></span>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="base-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/base_02.png?v=1.0">
                <div class="overview flex-column-1">
                    <span>性格关键字：</span>
                    <p><?php echo $this->_tpl_vars['data']['base']['keyword']; ?>
</p>
                </div>
                <div class="overview flex-column-1">
                    <span>基础性格：</span>
                    <p><?php echo $this->_tpl_vars['data']['base']['xingge']; ?>
</p>
                </div>
                <div class="overview flex-column-1">
                    <span>优点缺点：</span>
                    <p><?php echo $this->_tpl_vars['data']['base']['youquedian']; ?>
</p>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="base-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/base_03.png?v=1.0">
                <div class="char-item flex-column-1">
                	<?php echo $this->_tpl_vars['data']['base']['zhongyao']; ?>

                </div>
            </div>
        </div>


        <div class="title-wrap flex-center">
            <img class="guide-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/main_02.png?v=1.0">
        </div>

        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="love-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/love_01.png?v=1.0">
                <div class="view-love flex-column-1">
                    <div class="line flex-row-2">
                        <span>综合评分：</span>
                        <div class="star-line flex-row-2" id="love_star"></div>
                    </div>
                    <div class="line flex-row-1 lines">
                        <span>星座匹配：</span>
                        <p><em>金牛座</em>配<em><?php echo $this->_tpl_vars['data']['aq']['peidui']; ?>
</em></p>
                        <!---->
                    </div>
                    <div class="line flex-row-1 lines">
                        <span>主动被动：</span>
                        <p>你仅有<?php echo $this->_tpl_vars['data']['aq']['master']; ?>
%的主动权</p>
                    </div>
                    <div class="line flex-row-1">
                        <span>简短总评：</span>
                        <p><?php echo $this->_tpl_vars['data']['aq']['txt']; ?>
</p>
                    </div>
                </div>
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/line/<?php echo $this->_tpl_vars['data']['aq']['line']; ?>
" class="star_line">
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <div class="content-love flex-column">
                    <img class="love-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/love_02.png?v=1.0">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['aq']['jiyu']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <div class="content-love flex-column">
                    <img class="love-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/love_03.png?v=1.0">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['aq']['taohua']; ?>
 </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="love-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/love_04.png?v=1.0">
                <div class="content-love flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['aq']['ganqing']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="title-wrap flex-center">
            <img class="guide-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/main_03.png?v=1.0">
        </div>

        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="cash-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/cash_01.png?v=1.0">
                <div class="view-cash flex-column-1">
                    <div class="line flex-row-2">
                        <span>综合评分：</span>
                        <div class="star-line flex-row-2" id="cash_star"></div>
                    </div>
                    <div class="line flex-row-1 lines">
                        <span>财运高点：</span>
                        <p><?php echo $this->_tpl_vars['data']['cy']['gaodian']; ?>
</p>
                    </div>
                    <div class="line flex-row-1 lines">
                        <span>低谷时期：</span>
                        <p><?php echo $this->_tpl_vars['data']['cy']['didian']; ?>
</p>
                    </div>
                    <div class="line flex-row-1">
                        <span>简短总评：</span>
                        <p><?php echo $this->_tpl_vars['data']['cy']['txt']; ?>
</p>
                    </div>
                </div>
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/line/<?php echo $this->_tpl_vars['data']['cy']['line']; ?>
" class="star_line">
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="cash-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/cash_02.png?v=1.0">
                <div class="content-cash flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['cy']['zong']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="cash-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/cash_03.png?v=1.0">
                <div class="content-cash flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['cy']['touzi']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="cash-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/cash_04.png?v=1.0">
                <div class="content-cash flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['cy']['zhichu']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="title-wrap flex-center">
            <img class="guide-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/main_04.png?v=1.0">
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="job-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/job_01.png?v=1.0">
                <div class="view-job flex-column-1">
                    <div class="line flex-row-2">
                        <span>综合评分：</span>
                        <div class="star-line flex-row-2" id="job_star"></div>
                    </div>
                    <div class="line flex-row-1 lines">
                        <span>遇到贵人：</span>
                        <p><?php echo $this->_tpl_vars['data']['sy']['guiren']; ?>
</p>
                    </div>
                    <div class="line flex-row-1 lines">
                        <span>低谷时期：</span>
                        <p><?php echo $this->_tpl_vars['data']['sy']['didian']; ?>
</p>
                    </div>
                    <div class="line flex-row-1">
                        <span>简短总评：</span>
                        <p><?php echo $this->_tpl_vars['data']['sy']['txt']; ?>
</p>
                    </div>
                </div>
                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/line/<?php echo $this->_tpl_vars['data']['sy']['line']; ?>
" class="star_line">
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="job-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/job_02.png?v=1.0">
                <div class="content-cash flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['sy']['zong']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="job-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/job_03.png?v=1.0">
                <div class="content-cash flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['sy']['work']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-center">
            <div class="content-box flex-column">
                <img class="job-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/job_04.png?v=1.0">
                <div class="content-cash flex-column">
                    <div class="content flex-column-1">
                        <p><?php echo $this->_tpl_vars['data']['sy']['zy']; ?>
</p>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="comment-box flex-column"   >
            <div class="content-panel flex-column">
                <img class="comment-title" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/title_comment.png?v=1.7">
                <div class="nickname-wrap flex-row">
                    <div class="input-group flex-row">
                        <label for="nickname">昵称:</label>
                        <input class="nickname" id="nickname" type="text" value="匿名" maxlength="8" onblur="scrollToBottom()">
                    </div>
                    <span class="un-name-wrap flex-row">
                        <input type="checkbox" id="un_name" class="un-name"><span>匿名评价</span>
                    </span>
                </div>
                <div class="expres-wrap flex-row">
                    <span class="pinfen">评分:</span>
                    <div id="star" class="stars flex-row"></div>
                    <span class="emoji-wrap flex-center">
                        <img class="emoji" id="emoji" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/expres_05.png?v=1.7">
                        <span class="emoji-desc" id="emoji_desc">非常满意</span>
                    </span>
                </div>
                <div class="edit-wrap flex-center">
                    <textarea class="comment-text" id="comment_content" placeholder="请在下方留下您真实的评价和建议，我们将在您的督促下不断提升服务品质。" maxlength="50" rows="5" onblur="scrollToBottom()"></textarea>
                </div>
                <img class="submit-img" id="submit_img" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/submit_btn.png?v=1.7" alt="提交">
            </div>
        </div> -->
        
        
        <div class="content-wrap flex-center">
        
        <div class="comment-box content-box  public_hot_test">
        <div class="border_bg"></div>
	<div class="public_ht_title">
		热门测算
	</div>
<ul class="public_ht_ul">
		<li><a href="/?ac=bzjp"><img src="/ffsm/statics/tu/mip/bazi.png" alt="八字精批"><p>八字精批</p></a></li>
		<li><a href="/?ac=bzsy"><img src="/ffsm/statics/tu/mip/caiyun.png" alt="八字财运"><p>八字事业</p></a></li>
		<li><a href="/?ac=xmfx"><img src="/ffsm/statics/tu/mip/ming.png" alt="姓名详批"><p>姓名详批</p></a></li>
		<li><a href="/?ac=yuncheng"><img src="/ffsm/statics/tu/mip/2019.png" alt="2018流年运程"><p>2019运程</p></a></li>
		<li><a href="/?ac=yinyuan"><img src="/ffsm/statics/tu/mip/yinyuan.png" alt="姻缘分析"><p>姻缘分析</p></a></li>
		<li><a href="/?ac=zhanxing"><img src="/ffsm/statics/tu/mip/ziwei.png" alt="灵犀占星"><p>灵犀占星</p>
		<li><a href="/?ac=hehun"><img src="/ffsm/statics/tu/mip/hehun.png" alt="八字合婚"><p>八字合婚</p></li></a>
		<li><a href="/?ac=xmpd"><img src="/ffsm/statics/tu/mip/peidui.png" alt="姓名配对"><p>姓名配对</p></a></li>
	</ul>
</div>

</div>

<style type="text/css">

.public_ht_ul {
    position: relative;
    overflow: hidden;
    padding: 15px 0 0 0;
}
.public_ht_ul li {
	list-style-type:none;
    float: left;
    width: 25%;
    margin-bottom: 10px;
}
.public_ht_ul li a {
    display: block;
	text-decoration:none;
}
.public_ht_ul li p {
	color:#FFF;
    line-height: 24px;
    height: 26px;
    font-size: 15px;
    text-align: center;
    overflow: hidden;
}
.public_ht_ul li img {
    display: block;
    width: 70%;
    margin: 0 auto;
}
.public_ht_title {
    height: 30px;
    line-height: 24px;
    padding: 10px;
    color: #FFF;
    font-weight: 800;
    text-align: center;
    font-size: 16px;
}

</style>
        
    </section>

    <div class="toast-wrap flex-center">
        <div class="toast-box flex-center">
            <span></span>
        </div>
    </div>

    <div class="float-wrap flex-center">
        <div class="float-btn flex-center">
            <img class="stars-btn" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result_2/stars_btn.png?v=1.0">
        </div>
    </div>
    <div class="success-wrap flex-center" style="display:none;">
        <div class="success-box flex-column">
            <div class="success-banner flex-column">
                <img class="banners" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/interim/banner.png?v=1.7">
            </div>
            <div class="owner-wrap flex-column">
                <span class="owner flex-center"><em><?php echo $this->_tpl_vars['data']['data']['username']; ?>
</em>的</span>
                <span class="owner-2 flex-center">2019运势分析已购买</span>
            </div>
            <span class="over-text flex-center">正在进入...</span>
        </div>
    </div>

</section>

</body>

<script type="text/javascript" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/script/jquery.min.js"></script>
<script type="text/javascript" src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/script/jquery.raty.min.js"></script>
<script src="/ffsm/statics/divine.cdn.h55u.com/platform/js/zwSdk.js?v=19032815"></script>
<script>
    $(function () {
        var u = navigator.userAgent, app = navigator.appVersion;
        var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1;
        var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
        if (isAndroid) {

        }
        if (isIOS) {
            $('.page span').css({'font-size': '18px'});
            $('.page p').css({'font-size': '16px'});
            $('.page em').css({'font-size': '16px'});
            $('.row span em').css({'font-size': '16px'});
        }
        setTimeout(function () {
            $('.spinner-wrap').fadeOut();
        },300)
    });
    $('.toast-wrap').hide();
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

    //字符替换
    var lines = document.getElementsByClassName('lines');
    for (var i = 0; i < lines.length; i++) {
        var str = lines[i].getElementsByTagName('p')[0].innerText;
        var flag_1 = false;
        var flag_2 = false;
        var flag_3 = false;
        str = str.replace(/\d+至\d+月/g, function () {
            if(arguments.length){
                flag_1 = true;
                flag_3 = true;
            }
            return '<em>' + arguments[0]+'</em>';
        });
        if(!flag_3){
            str = str.replace(/\d+月/g, function () {
                if(arguments.length){
                    flag_1 = true;
                }
                return '<em>' + arguments[0]+'</em>';
            });
        }
        str = str.replace(/\d+%/g, function () {
            if(arguments.length){
                flag_2 = true;
            }
            return '<em>' + arguments[0]+'</em>';
        });
        if(flag_1){
            lines[i].getElementsByTagName('p')[0].innerHTML = str;
        }
        if(flag_2){
            lines[i].getElementsByTagName('p')[0].innerHTML = str;
        }

    }

    //--初始化评论区--//
    var scores = 5;
    $(function () {
        $.fn.raty.defaults.path = '/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result';
        $('#star').raty({
            score: 5,
            click: function (score, e) {
                scores = parseInt(score);
                if (scores == 1) {
                    $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/expres_01.png?v=1.7");
                    $("#emoji_desc").text("失望");
                } else if (scores == 2) {
                    $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/expres_02.png?v=1.7");
                    $("#emoji_desc").text("不满");
                } else if (scores == 3) {
                    $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/expres_03.png?v=1.7");
                    $("#emoji_desc").text("一般");
                } else if (scores == 4) {
                    $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/expres_04.png?v=1.7");
                    $("#emoji_desc").text("满意");
                } else if (scores == 5) {
                    $("#emoji").attr('src', "/ffsm/statics/const.cdn.xingzuozhuanjia.com/Horoscope/image/result/expres_05.png?v=1.7");
                    $("#emoji_desc").text("非常满意");
                }
            }
        });
        var temp_name = "";
        $('#un_name').click(function (e) {
            var comment_nickname = "匿名";
            var cn_name = $('#un_name').prop("checked");
            if (cn_name) {
                temp_name = $("#nickname").val();
                $("#nickname").val("匿名");
                $("#nickname").attr("readonly", "readonly");
            } else {
                if (comment_nickname == "") {
                    $("#nickname").val(temp_name);
                    $("#nickname").removeAttr("readonly");
                } else {
                    $("#nickname").val(temp_name);
                    $("#nickname").removeAttr("readonly");
                }
            }
        })
        $('#comment_content').keyup(function () {
            /* Act on the event */
            var maxLength = 50;
            var len = $('#comment_content').val().length;
            if (len > maxLength - 1) {
                var res = $(this).val().substring(0, 50);
                $(this).val(res);
                showToast("评论字数不超过50字");
            }
        });
    });

    $('.stars-btn').click(function () {
        $('.alert').fadeIn();
    });
    $('.close-btn').click(function () {
        $('.alert').fadeOut();
    });
    var stars = ["白羊座","金牛座","双子座","巨蟹座","狮子座","处女座","天秤座","天蝎座","射手座","摩羯座","水瓶座","双鱼座"];
    var starid = 1;
    $('.star-item').click(function (event) {
        starid = parseInt(event.currentTarget.dataset.star);
        var star_name_old = "金牛座";
        var star_name_new = stars[starid-1];
        $('.owner em').text(stars[starid-1]);
        if(star_name_old ==star_name_new){
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
                var src = '1171';
                var paystatus = parseInt(res.paystatus);
                if(paystatus===1){
                    $('.success-wrap').fadeIn();
                    setTimeout(function () {
                        window.location.href = "/?ac=xingzuo2019&oid=" + orderId + '&src=' + src;
                        setTimeout(function () {
                            $('.success-wrap').hide();
                        },1000)
                    }, 1500);
                }else{
                    window.location.href = "/?ac=xingzuo2019&oid="+ orderId + "&src=" + src;
                }
                $('.alert').fadeOut();

            },
            fail: function (err) {
                console.log(err);
                $('.alert').fadeOut();
            }
        });
    });

    function forbidWord(e) {
        var t = ["QQ"],
            a = 0, n = e.replace(/(^\s*)|(\s*$)|(\s)/g, "");
        for (i = 0; i < t.length; i++) -1 != n.indexOf(t[i]) && a++;
        return 0 != a
    }

    function checkNameData() {
        var n = $("#nickname").val();
        if (!n) {

            showToast("您还没有填写昵称！");
            return false;
        }

        if (forbidWord(n)) {
            showToast("您填写的昵称属于敏感词汇");
            return false;
        }
        if (n.length > 8) {
            showToast("您的昵称超出字数限制");
            return false;
        }
        return true;
    }

    function checkCommentData() {
        var n = $("#comment_content").val();
        if (!n) {
            showToast("您还没有填写评论！");
            return false;
        }
        if (forbidWord(n)) {
            showToast("您填写的内容含有敏感词汇");
            return false;
        }
        return true;
    }

    function showToast(msg) {
        $('.toast-wrap').fadeIn();
        $('.toast-wrap span').addClass('toast');
        $('.toast-wrap span').text(msg);
        setTimeout(function () {
            $('.toast-wrap').fadeOut();
        }, 1200);
    }

    $('#submit_img').click(function() {
        var un_name = $('#un_name').prop("checked");
        var is_nickname = $('#un_name').prop("checked") ? true : checkNameData();
        var is_comment_content = checkCommentData();
        var nicknames = un_name ? '匿名' : $("#nickname").val();
        if (is_nickname && is_comment_content) {
            $.ajax({
                url: "/",
                method: 'POST',
                data: {
                    comment: $("#comment_content").val(),
                    order_id: '19032809431207d35b62751',
                    nickname: nicknames,
                    score: scores
                },
                success: function (res) {
                    $('.comment-box').fadeOut(1000);
                    showToast("感谢您的评价！");
                },
                fail: function (err) {
                    console.log(err);
                }
            });
        }
    });

    function scrollToBottom() {
        window.scrollTo(0,document.body.scrollHeight);
    }
</script>

</html>