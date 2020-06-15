<?php /* Smarty version 2.6.25, created on 2019-02-20 12:02:18
         compiled from index/hmjx/form.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
  	<link rel="shortcut icon" href="statics/ffsm/favicon.ico"/>
    <title>号码解析-手机号码测试-车牌号码吉凶测算</title>
    <!--[if lt IE 9]>  
        <script src="/ffsm/statics/ffsm/hmjx/js/html5.js"></script>
        <script src="/ffsm/statics/ffsm/hmjx/js/respond.min.js"></script>    
    <![endif]-->
    <link rel="stylesheet" href="/ffsm/statics/ffsm/hmjx/css/zm_share.css"/>
    <link rel="stylesheet" href="/ffsm/statics/ffsm/hmjx/css/_szjx.css"/>
 
   <link rel="stylesheet" type="text/css" href="/ffsm/statics/ffsm/public/sty.css"/>
   <link href="/ffsm/statics/ffsm/public/wap.min.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="/ffsm/statics/ffsm/hmjx/js/rem.js"></script>

	<script src="https://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>

    
</head>
<body>
    <header class="share_header">
        <h1 class="zm">号码解析</h1>
        <a href="/" class="zm_titel"></a>
<a href="/?ac=history" class="zm_cs">我的测算</a>

    </header>
    <div class="zm_banner">
        <img src="/ffsm/statics/ffsm/hmjx/picture/banner.jpg" width="100%" />
    </div>
    <div class="cs_bgcolor" id="scrollT" >
        <div class="dashi_title"><img src="/ffsm/statics/ffsm/hmjx/picture/ds_title.png" width="100%" alt=""></div>
        <div class="dashi_jianjie"> 
            <div class="dashi_txt">
                <p>易恒大师，中国易学领军人物，30年专业专注数字研究，曾应邀参加全球易经协会、中华周易研究会、中华易学专家联合会等许多国内权威易学机构举办的会议。</p>
                <p>获得过“中华权威易学专家”</p>
                <p>获得“中国十大杰出命名策划师”</p>
                <p>获得“注册国际国学讲师”等荣誉</p>
            </div>
            <div class="dashi_head"><img src="/ffsm/statics/ffsm/hmjx/picture/dashi.png" width="100%" alt=""></div> 
        </div>
        <div class="m_form_container">
            <form class="J_ajaxForm J_testFixedTop" id="submit1" action="/?ac=hmjx" name="login" method="POST">
            <input type="hidden" name="username" value="王小丫">
                <!-- <p class="m_form_p">请输入您的生辰八字：我们将根据您的八字为您自动推算。</p> -->
				
                <ul class="m_form_ul">
                    <li>
                        <div class="f_left">出生日期</div>
                        <div class="f_auto">
                        
                    <input type="text" id="birthday" data-toid-date="b_input" data-toid-hour="b_hour" class="Js_date" data-type="0" data-date="1985-7-1" value="" placeholder="请选择日期" />
                    <input type="hidden" name="birthday" id="b_input" />
                    <input type="hidden" name="h" id="b_hour" value="0" />
                        
                        </div>
                      
                    </li>
                    <li>
                        <div class="f_left">测算种类</div>
                        <div class="f_auto">
                            <select name="sztestType" class="_select" onchange="_selectEvent(this)">
                                <option value="1" selected>手机号</option>
                                <option value="2">车牌号</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="f_left">数字号码</div>
                        <div class="f_auto"><input type="text" id="numberjx" name="numberjx" placeholder="请输入手机号码"></div>
                        <input type="hidden" id="birthday" name="numberjx_e">
                    </li>
                </ul>
				  
                <div class="m_form_btnwrap"><div class="m_form_submit"><a class="J_ajax_submit_btn">立即测算</a></div></div>
            </form>
        </div>
    </div>
    <div class="sz_service">
        <ul class="sz_ul">
            <li><div class="li_textimg"><img src="/ffsm/statics/ffsm/hmjx/picture/forum_02.png"  width="100%" alt=""></div></li>
            <li><div class="li_textimg"><img src="/ffsm/statics/ffsm/hmjx/picture/forum_03.png"  width="100%" alt=""></div></li>
            <li><div class="li_textimg"><img src="/ffsm/statics/ffsm/hmjx/picture/forum_04.png"  width="100%" alt=""></div></li>
            <li><div class="li_textimg"><img src="/ffsm/statics/ffsm/hmjx/picture/forum_05.png"  width="100%" alt=""></div></li>
            <!--<li><div class="li_textimg"><img src="/ffsm/statics/ffsm/hmjx/picture/forum_06.png"  width="100%" alt=""></div></li>-->
            <li><div class="li_textimg"><img src="/ffsm/statics/ffsm/hmjx/picture/forum_07.png"  width="100%" alt=""></div></li>
        </ul>
    </div>
<script>
    let hotcs_item = document.querySelectorAll('.hotcs_item');
    let r_foot = document.querySelectorAll('.r_foot');

    hotcs_item.forEach(function(item){
        item.onclick = function(e){
            var type=this.getAttribute('data-type');
            $.getJSON("/zhiming/index.php/home-index-zmclick",{type:type},function(data){//回调入库
            });
            window.location.href = this.getAttribute('data-url');
        }
    })

    r_foot.forEach(function(item){
        item.childNodes[0].onclick = function(e){
            e.stopPropagation();
            var type=this.getAttribute('data-type');
            if(this.classList.toggle('on')){
                $.getJSON("/zhiming/index.php/home-index-zmclickz",{type:type},function(data){//回调入库
                });
                this.textContent++;
            }else{
                this.textContent--;
            }
        }
    })
</script>

<!--轮盘-->
  <div class="luopan_bg_color"></div>
    <div id="luopan_box" class="lunpan_box" style="display: ">
        <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/zixun/luopan.png" alt="" class="img-1" />
        <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/zixun/zhizheng.png" alt="" class="img-2">
    </div>
    <style type="text/css">
    #luopan_box {height: 170px;width: 170px;margin: 0 auto;position: fixed;top: 40%;left: 50%;z-index: 9999999;margin-left: -85px;display: none;vertical-align: middle;}
	#luopan_box .img-2 {width: 20px;height: 140px;position: fixed;top: 42%;left: 50%;margin: 0 auto; margin-left: -10px; -webkit-animation: rotate2 4s linear infinite;animation: rotate2 4s linear infinite;}
	#luopan_box img.img-1 {width: 170px;height: 170px;-webkit-animation: rotate 4s linear infinite;animation: rotate 4s linear infinite;}
	.luopan_bg_color { width: 100%;height: 100%;    position: fixed;    left: 0;    top: 0;    z-index: 9999998;    background: #000;    opacity: 0.7;    transition: opacity 0.5s;    display: none;}
    </style>
    <script>
        function showLoading() {
            if ($('luopan_box') == null)
                return false;
            $('#luopan_box').fadeToggle(500);
            $('#luopan_box').show();
            $('.luopan_bg_color').show();
            return true;
        }

        function hideLoading() {
            if ($('luopan_box') == null)
                return false;
            $('#luopan_box').hide();
            $('.luopan_bg_color').hide();
            return true;
        }

    </script>
    <!--轮盘-->
    
    
    <script src="/ffsm/statics/cdn.12ystar.com/website/Scripts/home/require.min.js" data-main="/ffsm/statics/cdn.12ystar.com/website/Content/hlybz/js/common.min.js"></script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './index/public/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!-- 悬浮按钮 -->
    <div class="fiex_bt" id="fiex"><a href="javascript:;">立即测算</a></div>
	<script src="/ffsm/statics/suanming-hmjx.js"></script>
    <script>
	
	
	
        
        // 监听选择的类别
        function _selectEvent(element){
            var Stype = element.value;
            if(Stype == 1){
                $("#numberjx").attr('placeholder','请输入手机号码')
            }else if(Stype == 2){
                $("#numberjx").attr('placeholder','请输入车牌号(例:粤B88888)')
            }
        }
        // 表单提交
        $('.m_form_submit').on('click',function(){
            checkForm();
        })

        // 日期
        
        //测算底部悬浮
        $(function(){
            var topShow=$(".m_form_submit");
            if(topShow.length){
                var topShow=topShow.offset().top;
                var testBtn=$("#fiex");
                $(window).scroll(function(){
                    var wt=$(window).scrollTop();
                    wt>topShow?(testBtn.fadeIn(),$('.footer_severs').css('padding-bottom','1.2rem')):(testBtn.fadeOut(),$('.footer_severs').css('padding-bottom','0.4rem'));
                });
                // goTop
                $('#fiex').on('click',function(){$('html,body').animate({scrollTop:$('#scrollT')[0].offsetTop},500)});
            }
        });
        // 车牌号验证
        function isVehicleNumber(vehicleNumber) {
            var result = false;
            if (vehicleNumber.length == 7){
                var express = /^[京津沪渝冀豫云辽黑湘皖鲁新苏浙赣鄂桂甘晋蒙陕吉闽贵粤青藏川宁琼使领A-Z|a-z]{1}[A-Z|a-z]{1}[A-Z0-9|a-z0-9]{4}[A-Z0-9挂学警港澳|a-z0-9挂学警港澳]{1}$/;
                result = express.test(vehicleNumber);
            }
            return result;
        }
    </script>
	
<!--塔罗占卜付费测算源码-->
</body>
</html>