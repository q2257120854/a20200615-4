<?php /* Smarty version 2.6.25, created on 2019-04-15 11:13:47
         compiled from index/zhanxing/order.tpl */ ?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">

    <meta charset="UTF-8">
    

    <title>本命星盘解析</title>

    <style>

        *{

            margin: 0;

            padding: 0;

            border: none;

            box-sizing: border-box;

            color: white;

        }

        html, body{

            width: 100%;

            height: 100%;

            max-width: 640px;

            margin: 0 auto;

            background-color: #0e003d;

            font-family: 'PingFang SC', 'Lantinghei SC', 'Helvetica Neue', 'Helvetica', 'Arial', 'Microsoft YaHei', '微软雅黑', 'STHeitiSC-Light', 'simsun', '宋体', 'WenQuanYi Zen Hei', 'WenQuanYi Micro Hei', 'sans-serif';

        }

    </style>
    
    <script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/js/jquery-1.8.3.min.js"></script>

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
    

    <link rel="stylesheet" href="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/css/result.css?v=1.2">

    <style>

        img.newtitle {

            display: block;

            position: absolute;

            width: 50%;

            left: 25%;

            top: 0;

            transform: translateY(-50%);

            -webkit-transform: translateY(-50%);

        }

        .hasnewtitle {

            padding-top: 1rem;

            margin-top: 28px;

        }

    </style>

</head>

<body>

<div class="mainbox unpaybox">

    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/info/img/title.png" class="title_img">

    <div class="title_box">

                <p class="maindesc"><span>太阳<?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
丨月亮<?php echo $this->_tpl_vars['data']['yueliang']['xz']; ?>
丨上升<?php echo $this->_tpl_vars['data']['shangsheng']['xz']; ?>
</span></p>

    </div>

    <div class="contentbox">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/border-top.png" class="content_border" style="position: absolute;width: calc(100% - 0.36rem - 0.36rem);display: block;margin: 0 auto;">

                <img src="<?php echo $this->_tpl_vars['data']['img']; ?>
" id="horoscope"><!---->

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newpay-title.png?v=1.1" style="position: relative;width: 100%;margin: 20px auto 10px auto;">

        <div class="newpayinfobox" id="newpayinfoboxs">

            <p class="payinfo_text" style="color:#aaaaaa;">原价：<e style="font-weight: bold;text-decoration: line-through;color: #aaaaaa;">￥88.8</e> <span style="color: #fff;">距离优惠结束</span></p>

            <p class="payinfo_text" style="color: #e57700;margin-bottom: 0;">

                <e style="display: inline-block;width: 5em;text-align: center;height: 30px;line-height: 30px;background-color: #ff4852;border-radius: 6px;">限时优惠</e>

                <e style="display: inline-block;height: 30px;font-size: 18px;line-height: 30px;">￥<?php echo $this->_tpl_vars['row']['money']; ?>
</e>

                <span class="discount_time" style="position: absolute;right: 0.3rem;top: 0;display: block;height: 30px;line-height: 30px;font-size: 18px;color: #e57700;">02:00:00</span></p>

        </div>

        <div class="pay_btn" style="width: 90%; margin: 0 auto;">立即支付</div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/border-bottom.png" class="content_border">

    </div>

    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newpay-split.png" style="display: block;width: 60%;margin: 0 auto 20px auto;">

    <div class="contentbox hasnewtitle">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle1.png" class="newtitle">

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/border-top.png" class="content_border" style="position: absolute;width: calc(100% - 0.36rem - 0.36rem);display: block;margin: 0 auto;">

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/star-<?php echo $this->_tpl_vars['data']['taiyang']['number']; ?>
.png" class="sun_star_img">

        <p class="sun_star_title">太阳星座-<?php echo $this->_tpl_vars['data']['taiyang']['xz']; ?>
座</p>

        <p class="sun_star_desc"><?php echo $this->_tpl_vars['data']['taiyang']['title']; ?>
</p>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-7.png?v=1.2" class="unpay_img" data-id="7">

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/border-bottom.png" class="content_border">

    </div>



    <div class="contentbox">

        <div class="border_bg"></div>

        <div class="element_box">

            <div class="element_item">

                <p class="element_item_title">星座属性</p>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/<?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['icon']; ?>
.png" class="element_item_icon">

                <p class="element_item_desc"><?php echo $this->_tpl_vars['data']['taiyang']['shuxing']['title']; ?>
</p>

            </div>

            <div class="element_item">

                <div class="element_splitline"></div>

                <p class="element_item_title">星座模式</p>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/<?php echo $this->_tpl_vars['data']['taiyang']['moshi']['icon']; ?>
.png" class="element_item_icon">

                <p class="element_item_desc"><?php echo $this->_tpl_vars['data']['taiyang']['moshi']['title']; ?>
</p>

                <div class="element_splitline"></div>

            </div>

            <div class="element_item">

                <p class="element_item_title">守护星</p>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ruled-<?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['icon']; ?>
.png" class="element_item_icon">

                <p class="element_item_desc"><?php echo $this->_tpl_vars['data']['taiyang']['shouhu']['title']; ?>
</p>

            </div>

        </div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-8.png?v=1.2" class="unpay_img" data-id="8">

    </div>



    <div class="contentbox hasnewtitle">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle2.png" class="newtitle">

        <div class="moon_star_header_box">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ruled-1.png" class="moon_star_img">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/icon-<?php echo $this->_tpl_vars['data']['yueliang']['number']; ?>
.png" class="moon_cons_img">

            <p class="moon_star_text">月亮星座-<?php echo $this->_tpl_vars['data']['yueliang']['xz']; ?>
座</p>

            <span class="moon_star_flag"><?php echo $this->_tpl_vars['data']['yueliang']['title']; ?>
</span>

        </div>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-1.png?v=1.2" class="unpay_img" data-id="1">

    </div>



    <div class="contentbox hasnewtitle">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle3.png" class="newtitle">

        <div class="moon_star_header_box">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/Asc.png" class="moon_star_img">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/icon-<?php echo $this->_tpl_vars['data']['shangsheng']['number']; ?>
.png" class="moon_cons_img">

            <p class="moon_star_text">上升星座-<?php echo $this->_tpl_vars['data']['shangsheng']['xz']; ?>
座</p>

            <span class="up_star_flag"><?php echo $this->_tpl_vars['data']['shangsheng']['title']; ?>
</span>

        </div>

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-2.png?v=1.2" class="unpay_img" data-id="2">

    </div>



    <!--<div class="contentbox">-->

        <!--<div class="border_bg"></div>-->

        <!--&lt;!&ndash; 命主星&ndash;&gt;-->

        <!--<div class="Lagnadhipati_box">-->

            <!--<div class="lagnadhipati_item">-->

                <!--<div class="lagnadhipati_img_box">-->

                    <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/bigstar-4.png" class="lagnadhipati_bigstar_img">-->

                <!--</div>-->

                <!--<p class="lagnadhipati_name">命主星-火星</p>-->

            <!--</div>-->

            <!--<div class="lagnadhipati_item">-->

                <!--<div class="lagnadhipati_split_line"></div>-->

                <!--<div class="lagnadhipati_img_box">-->

                    <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/bigstar-4.png" class="lagnadhipati_smallstar_img">-->

                    <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/arrow.png" class="lagnadhipati_smallstar_arrow">-->

                    <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/big-6.png" class="lagnadhipati_smallstar_number">-->

                <!--</div>-->

                <!--<p class="lagnadhipati_name">命主星在第6宫</p>-->

            <!--</div>-->

        <!--</div>-->

        <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-3.png?v=1.2" class="unpay_img" data-id="3">-->

    <!--</div>-->



    <div class="contentbox hasnewtitle">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle4.png" class="newtitle">

        <!-- 象限分析-->

        <div class="region_box">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/quadrant-<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxiannumber']; ?>
.png" class="region_bg">

            <div class="region_item region_item1">

                <div class="normal_region_box">
                
                	<?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                
                

                    <!--<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-0.png" class="region_icon_items region_normalicon_1">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-1.png" class="region_icon_items region_normalicon_2">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-2.png" class="region_icon_items region_normalicon_3">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-6.png" class="region_icon_items region_normalicon_4">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-7.png" class="region_icon_items region_normalicon_5">
                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-8.png" class="region_icon_items region_normalicon_6"> -->
                </div>

            </div>

            <div class="region_item region_item2">

                <div class="normal_region_box">

                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                 
               </div>

            </div>

            <div class="region_item region_item3">

                <div class="normal_region_box">
                	<?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>
                </div>

            </div>

            <div class="region_item region_item4">

                <div class="normal_region_box">

                	<?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxianarr']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    	<img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="region_icon_items region_normalicon_<?php echo $this->_tpl_vars['k']+1; ?>
">
                    <?php endforeach; endif; unset($_from); ?>  
                    
                </div>

            </div>

        </div>

        <p class="region_desc">能量最强在第<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['xiangxiannumber']; ?>
象限</p>

        <p class="region_main_title">星盘象限分析：<span><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['info']['title']; ?>
</span></p>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-5.png?v=1.2" class="unpay_img" data-id="5">

    </div>



    <div class="contentbox hasnewtitle">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle5.png" class="newtitle">

        <!-- 你的元素-->

        <p class="element_title">你的元素构成</p>

        <div class="element_title_box">

            <div class="element_title_item">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-fire.png" class="element_title_icon">

                <span class="element_title_text">火</span>

            </div>

            <div class="element_title_item">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-soil.png" class="element_title_icon">

                <span class="element_title_text">土</span>

            </div>

            <div class="element_title_item">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-wind.png" class="element_title_icon">

                <span class="element_title_text">风</span>

            </div>

            <div class="element_title_item">

                <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/ele-water.png" class="element_title_icon">

                <span class="element_title_text">水</span>

            </div>

        </div>

        <div class="element_histogram_box">

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['huo']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['huo']['count']; ?>
%</span>

                    <div class="histogram histogram_1" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['huo']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">

                    <?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['huo']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['huo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?>  
                            </div>

            </div>

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['tu']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['tu']['count']; ?>
%</span>

                    <div class="histogram histogram_2" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['tu']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">
					<?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['tu']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['tu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?> 
                </div>

            </div>

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['feng']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['feng']['count']; ?>
%</span>

                    <div class="histogram histogram_3" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['feng']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">
                
                <?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['feng']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['feng']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?> 

                                    </div>

            </div>

            <div class="element_histogram_item">

                <div class="histogram_box">

                    <span class="histogram_number" style="bottom: calc(<?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['shui']['rem']; ?>
% + 0.2rem);"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['shui']['count']; ?>
%</span>

                    <div class="histogram histogram_4" style="height: <?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['shui']['rem']; ?>
%;"></div>

                </div>

                <div class="histogram_star_box">
						<?php if ($this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['shui']): ?>
                    <?php $_from = $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['shui']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                        <div class="histogram_star_item">
                                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-<?php echo $this->_tpl_vars['v']; ?>
.png" class="histogram_star_icon">
    
                        </div>  
                    <?php endforeach; endif; unset($_from); ?>  
                    <?php endif; ?> 
                </div>

            </div>

            <div class="spliteline spliteline_1"></div>

            <div class="spliteline spliteline_2"></div>

            <div class="spliteline spliteline_3"></div>

        </div>

        <p class="histogram_main_title">你的元素属性为</p>

        <div class="histogram_main_result">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/earth.png" class="histogram_main_icon">

            <span class="histogram_main_span"><?php echo $this->_tpl_vars['data']['xgcy']['xiangxiang']['yuansu']['info']['max']; ?>
象</span>

        </div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-4.png?v=1.2" class="unpay_img" data-id="4">

    </div>



    <div class="contentbox hasnewtitle">

        <div class="border_bg"></div>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/newtitle6.png" class="newtitle">

        <!-- 行星能量-->

        <p class="planets_title">行星能量分析</p>

        <div class="planets_percentage_box">

            <div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-0.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                        <span class="planets_percentage_progress planets_percentage_progress_max" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['taiyang']['rem']; ?>
%;"></span>

                            

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-1.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['yueliang']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-2.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['shuixing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-3.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['jinxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-4.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['huoxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-5.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['muxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-6.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['tuxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-7.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['tianwangxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-8.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['haiwangxing']['rem']; ?>
%;"></span>

                    </div>

                </div><div class="planets_percentage_item">

                    <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/small-star-9.png" class="planets_percentage_icon">

                    <div class="planets_percentage_progressbox">

                                                    <span class="planets_percentage_progress" style="width: <?php echo $this->_tpl_vars['data']['mwrx']['mingwangxing']['rem']; ?>
%;"></span>

                    </div>

                </div>        </div> 

        <p class="planets_desc">你的<?php echo $this->_tpl_vars['data']['mwrx']['zuiqiang']['xz']; ?>
能量最强</p>

        <p class="planets_main_name">你是：<span><?php echo $this->_tpl_vars['data']['mwrx']['zuiqiang']['xz']; ?>
人</span></p>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/unpay-6.png?v=1.2" class="unpay_img" data-id="6">

    </div>



    <div style="height: 50px;"></div>

</div>



<div class="paybox">

    <div class="paycontentbox">

        <div class="closebox">

            <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/close.png" class="closepaybox">

        </div>

        <p class="pay_title">解锁报告中所有内容</p>

        <p class="pay_number">84804人购买</p>

        <p class="pay_desc">一次性解锁报告内所有的专业解析</p>

        <img src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/destinychart/result/img/report.png?v=1.1" class="pay_desc_img">

        <div class="payinfobox">

            <p class="payinfo_text">原价<span style="font-weight: bold;text-decoration: line-through;">￥88.8</span></p>

            <p class="payinfo_text" style="color: #e57700;">限时优惠<span style="font-size: 18px;font-weight: bold;color: #e57700;">￥<?php echo $this->_tpl_vars['row']['money']; ?>
</span></p>

            <div class="pay_btn">立即支付</div>

        </div>

    </div>

</div>



<script src="/ffsm/statics/const.cdn.xingzuozhuanjia.com/Constell/js/zepto.min.js"></script>

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
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['row']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                window.location = data.url;
            }
        }, 'json');
    }
    
    </script>

<script>

    


    $('.unpay_img').click(function(){
		
		window.location.href = "/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['row']['oid']; ?>
&type=1";

    });



    $('.closebox').click(function(){

        $('.paybox').hide();

    });



    $('.pay_btn').click(function(){
		
		window.location.href = "/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['row']['oid']; ?>
&type=1";

    });

    var remain = parseInt("7200");

    function initTimer(seconds){

        var h = Math.floor(seconds / 3600);

        var m = Math.floor( (seconds % 3600) / 60 );

        var s = Math.ceil( (seconds % 3600) % 60 );

        h = h < 10 ? ('0' + h) : h;

        m = m < 10 ? ('0' + m) : m;

        s = s < 10 ? ('0' + s) : s;

        $('.discount_time').text(h+'：'+m+'：'+s);

    }

    initTimer(remain--);

    setInterval(function(){

        initTimer(remain--);

    }, 1000);



    

</script>

</body>

</html>