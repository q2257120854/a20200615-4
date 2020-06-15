<?php /* Smarty version 2.6.25, created on 2019-02-20 13:32:45
         compiled from index/bzsy/order.tpl */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title><?php echo $this->_tpl_vars['form']['username']; ?>
八字事业运</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <!--full start-->
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <meta name="renderer" content="webkit">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="x5-fullscreen" content="true">
    <meta name="full-screen" content="yes">
    <!--full end-->
    <link rel="shortcut icon" href="/ffsm/statics/cdn.12ystar.com/img/favicon.ico"/>
    <link href="/ffsm/statics/cdn.12ystar.com/website/css/home/zywc.min.css?v=1" rel="stylesheet" type="text/css" />
    <link href="/ffsm/statics/cdn.12ystar.com/website/css/dashi_voice.css" rel="stylesheet" type="text/css" />
    <script src="/ffsm/statics/cdn.12ystar.com/website/Scripts/home/jquery.min.js"></script>
    <script type="text/javascript" src="/ffsm/statics/clipboard.min.js"></script>
    <link href="/ffsm/statics/cdn.12ystar.com/website/css/sm/jiyuange.css" rel="stylesheet" type="text/css" />
    <link href="/ffsm/statics/cdn.12ystar.com/website/css/sm/ziweidoushu2.css" rel="stylesheet" type="text/css">
    <style>
.time_count {
    text-align:right;
    font-size:0.3rem !important;
    color:#ee2222;
}

.time_count span {
    display:inline-block !important;
    background-color:#555;
    border-radius:4px;
    color:white !important;
    padding:0 4px;
    float:none !important;
}
    </style>


    
</head>

<body>
    <header class="public_header">
        <style>.public_h_home:after {
	            background-image: url("/ffsm/statics/cdn.12ystar.com/website/img/sm/icon_home.png") !important;
            }
        </style>
        <h1 class="public_h_con" style="color:#d23037">八字事业运</h1>
                <a class="public_h_home" href="/" ></a>
            <a class="public_h_menu" href="/?ac=history" style="color:#d23037;border-color:#d23037">我的订单</a>
    </header>


    


<div class="wrap" style="background:none">
    <div class="sm_seclet dashiPay  m_b_24 m_t_22">

    <h3 class="dsPayTitle" style="background-color:#e92c4d">钱韶光大师为您精批八字事业运势</h3>
    <div class="clearfix avBox" style="border-bottom: 0;padding-bottom:0.2rem">
        <div class="avLeft">
            <div class="avBos">
                <div class="imgBox">
                    <img src="/ffsm/statics/cdn.12ystar.com/img/dashi/ycq/head.png" alt="">
                    
                </div>
                <h4>袁承谦大师</h4>
                <p>知名命理学专家</p>
            </div>
        </div>
        <div class="avRight">
            <div class="avBos">
                <div class="imgBox"><img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/sm/<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>sm_user_male<?php else: ?>sm_user_female<?php endif; ?>.png" alt=""></div>
                <h4><span id='fullname'><?php echo $this->_tpl_vars['form']['username']; ?>
</span>（<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?>）</h4>
                <p> <?php echo $this->_tpl_vars['form']['birthday']; ?>
 </p>
            </div>
        </div>
    </div>

        <div class="order">
            
                <p style="line-height:0.8rem;height:0.8rem;border-bottom:0px">
                    <b class="hotPrice"><span>原价:68</span>结缘价:<strong><?php echo $this->_tpl_vars['form']['money']; ?>
</strong>元</b>
                </p>
            
                <p style="line-height:0.8rem;height:0.8rem;border-bottom:0px">订单号：<?php echo $this->_tpl_vars['form']['oid']; ?>
</p>
        </div>
        
        <div class="pay-list">
            <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">
                <div class="pay-item-wx">
                    <div class="pay-item-wrap">
                        <img src="/ffsm/statics/img/pay/wx_pay_icon.png" />
                        <nobr>微信安全支付</nobr>
                    </div>
                </div>
            </a>
            <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2" style="display:">
                <div class="pay-item-ali">
                    <div class="pay-item-wrap">
                        <img src="/ffsm/statics/img/pay/ali_pay_icon.png" />
                        <nobr>支付宝安全支付</nobr>
                    </div>
                </div>
            </a>
        </div>

        <div class="pay-check" style="margin:15px 30px 10px 30px;display:none">
            <div class="btn_payed" style="border:1px solid #888;border-radius:5px;text-align:center;color:#444;font-size:15px;padding:6px">已完成支付</div>
            <div class="btn_unpay" style="border:1px solid #888;border-radius:5px;text-align:center;color:#444;font-size:15px;padding:6px;margin-top:15px">未支付</div>
        </div>

        <div style='text-align:center;padding:10px 0;font-size:14px !important'>
            <img src='/ffsm/statics/cdn.12ystar.com/website/img/pay/pay_secure3.png' style="width:80%" /><br>
            <span style='color:#0D8000'>安全联盟已验证请放心支付</span>
        </div>
        <div style="background-color: #ffcebd;border-radius: 5px;padding: 10px 10px;margin:5px 20px;">
            <p style="font-size: 0.3rem;">已为 <span class="c_red"><span id="tjs">48154766</span></span> 缘主进行测试分析，帮忙他们找到美满的恋爱婚姻、事业工作，99.7%用户觉得本测算对人生规划发展有帮助！</p>
            <p style="display: none">钱韶光师已经为您分析出一生恋爱婚姻、事业、财富等命运情况，还有2017~2018年运势分析，让您在新的一年事事顺利，升职加薪！</p>
        </div>

       

    </div>

    <div class="lock_content" id='showme'>
    
    	<dl>
            <dt>事业运势分析</dt>
            <dd>
                <div class="a3_bz_intro" style="display: block;text-indent: 0;"></div>
                <div style="position: relative">

                    <div style="position: relative;width: 100%;top: 0">
                        <p class="bigtip" style="padding-top: 0.5rem">今年有没有升职加薪的机会？</p>
                        <p class="bigtip">今年的事业发展方向是什么？</p>
                        <p class="bigtip">是否适合跳槽、转行、创业？</p>
                        <p class="bigtip">少年得志还是到老才事业安稳？</p>
                        <p class="bigtip">困境时，会不会有贵人相助？</p>
                        <div style="text-align: center;margin:0.1rem 0 0.3rem 0">
                            <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/sm/ziwei/lijijiexiao.png" style="width: 4.5rem" />
                        </div>
                    </div>
                </div>
            </dd>
        </dl>
        
        <dl>
            <dt>2019年八字事业运势</dt>
            <dd>
                <img src="/ffsm/statics/img/pay-body-ad.png" style="width: 100%" />
            </dd>
        </dl>
        
        
        
        
    </div>

    <div style="height:10px"></div>
    

    <div class="mask" id="mask" style="z-index: 999998;"></div>
    <div class="maskpay" id="maskpay" style="display: none; z-index: 999999;">
        <div class="maskMiddle">
            <div class="sm_seclet dashiPay" style="background:#fff">

    <h3 class="dsPayTitle" style="background-color:#e92c4e;display:none">钱韶光大师为您进行一生命格详批</h3>
    <div class="clearfix avBox" style="padding-bottom:0.3rem">
        <div class="avLeft">
            <div class="avBos">
                <div class="imgBox">
                    <img src="/ffsm/statics/cdn.12ystar.com/website/img/dashi/ycq/head.png" alt="">
                    
                </div>
                <h4>钱韶光大师</h4>
                <p>资深命理学专家</p>
            </div>
        </div>
        <div class="avRight">
            <div class="avBos">
                <div class="imgBox"><img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/sm/<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>sm_user_male<?php else: ?>sm_user_female<?php endif; ?>.png" alt=""></div>
                <h4><span id='fullname'><?php echo $this->_tpl_vars['form']['username']; ?>
</span>（<?php if ($this->_tpl_vars['form']['gender'] == 1): ?>男<?php else: ?>女<?php endif; ?>）</h4>
                <p> <?php echo $this->_tpl_vars['form']['y']; ?>
年<?php echo $this->_tpl_vars['form']['m']; ?>
月<?php echo $this->_tpl_vars['form']['d']; ?>
日 </p>
            </div>
        </div>
    </div>

                
                <div class="order">
                        <p style="line-height:0.8rem;height:0.8rem;border-bottom:0px">
                            <b class="hotPrice"><span>原价:68</span>结缘价:<strong><?php echo $this->_tpl_vars['money']; ?>
</strong>元</b>
                        </p>
                    
                    <p style="height:5px"></p>
                </div>

                <div class="pay-list">
                    <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=1">
                        <div class="pay-item-wx">
                            <div class="pay-item-wrap">
                                <img src="/ffsm/statics/img/pay/wx_pay_icon.png" />
                                <nobr>微信安全支付</nobr>
                            </div>
                        </div>
                    </a>
                    <a href="/?ct=pay&ac=go&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
&type=2" style="display:">
                        <div class="pay-item-ali">
                            <div class="pay-item-wrap">
                                <img src="/ffsm/statics/img/pay/ali_pay_icon.png" />
                                <nobr>支付宝安全支付</nobr>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="pay-check" style="margin:15px 30px 10px 30px;display:none">
                    <div class="btn_payed" style="border:1px solid #888;border-radius:5px;text-align:center;color:#444;font-size:15px;padding:6px">已完成支付</div>
                    <div class="btn_unpay" style="border:1px solid #888;border-radius:5px;text-align:center;color:#444;font-size:15px;padding:6px;margin-top:15px">未支付</div>
                </div>

                <div style='text-align:center;padding:10px 0;font-size:14px !important'>
                    <img src='/ffsm/statics/cdn.12ystar.com/website/img/pay/pay_secure3.png' style="width:80%" /><br>
                    <span style='color:#0D8000'>安全联盟已验证请放心支付</span>
                </div>
            </div>
        </div>
    </div>

    <div class="footerFix" id="publicPayBottom" style="display:none">
        <a href="javascript:;" id='unlock'><i></i>付费解锁所有项</a>
    </div>
</div>


<style>
    .public_pay_popup {
	background-color:rgba(0,0,0,.6);
	position:fixed;
	width:100%;
	height:100%;
	top:0;
	left:0;
	z-index:39;
	display:none
}
.public_pp_box {
	position:absolute;
	width:80%;
	background-color:#fff;
	top:50%;
	left:50%;
	transform:translate(-50%,-50%);
	-webkit-transform:translate(-50%,-50%);
	padding:20px 10px 10px;
	box-sizing:border-box;
	text-align:center;
	color:#3a3a3a;
	font-size:16px;
	border-radius:6px
}
.public_pp_price,.public_pp_tit {
	padding:10px 0 6px
}
.public_pp_price strong {
	color:#ce0000;
	font-size:18px
}
.public_pp_close {
	position:absolute;
	right:0;
	top:0;
	width:40px;
	height:40px;
	font-weight:700;
	font-size:20px;
	line-height:40px;
	color:#666;
	cursor:pointer
}
</style>
<div class="public_pay_popup" id="popup_wxqrpay" style="z-index: 3000000;" onclick="$('#popup_wxqrpay').hide()">
    <div class="public_pp_box" style="max-width: 640px;" onclick="event.cancelBubble = true">
        <div class="public_pp_tit public_pp_price" style=""></div>
        <div class="public_pp_tit public_pp_price" style="">
            <div style="text-align:center;font-size:20px;font-weight:600;color:#008000">微信支付</div>
            <table>
                <tr>
                    <td style="width:50%">
                        <div>
                            <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/weixin_scan_pay.jpg" style="width:75%" />
                            <div style="padding:10px 30px">
                                <p>打开手机微信，在“发现”菜单中点击“扫一扫”</p>
                            </div>
                        </div>
                    </td>
                    <td style="width:50%">
                        <div>
                            <p style="color:#bb040c;font-size:18px;margin-top:0px" id="wxqrpay_title"></p>
                            <img src="" id="img_wxqrpay" style="margin-top:25px;width:auto" />
                            <p style="text-align:center;color:#df0000;font-size:16px;margin-top:25px">￥<strong id="wxqrpay_price"></strong>元</p>
                            <div style="height:50px"></div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>

    </div>
</div>

<script>
    function popup_wxqrpay(title,price, url)
    {
        $('#wxqrpay_title').text(title);
        $('#wxqrpay_price').text(price);
        $('#img_wxqrpay').attr('src', url);
        $('#popup_wxqrpay').show();
    }
</script>


    <footer class="public_footer_servers">
                    <p>汇丰科技信息技术有限公司 | 互联网广告业务合作伙伴</p>
        
        
        
        
        <div style="height:25px;"></div>
    </footer>


    <div class="luopan_bg_color"></div>
    <div id="luopan_box" style="display: none">
        <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/zixun/luopan.png" alt="" class="img-1" />
        <img src="/ffsm/statics/cdn.12ystar.com/img/m/610/img/zixun/zhizheng.png" alt="" class="img-2">
        

    </div>
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
    <script src="/ffsm/statics/cdn.12ystar.com/website/Scripts/sm/sm_common.js?v=3" type="text/javascript"></script>
    
    
    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function () {
                    var clientWidth = docEl.clientWidth;
                    
                    if (!clientWidth) return;
                    var fts = clientWidth / 10;
                    if (fts < 32) {
                        fts = 32;
                    } else if (fts > 56) {
                        fts = 56;
                    }
                    docEl.style.fontSize = fts + 'px';
                };
            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);
    </script>
    
    <script>
        $('#showme,#unlock').each(function () {
            $(this).click(function () {
                $('#mask').show();
                $('#maskpay').show();
                UpdateRecordPopPayTime("2d07159fecc645b3b1d76a8b522d1c06");
                
            });
        });

        $('#mask').on('click', '', function (event) {
            $('#mask').hide();
            $('#maskpay').hide();
        });
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
        $.get('/?ct=pay&ac=scanquery&oid=<?php echo $this->_tpl_vars['form']['oid']; ?>
', {t: Date.parse(new Date())}, function (data) {
            if (data.status) {
                inquiry = 1;
                window.location = data.url;
            }
        }, 'json');
    }
    
    </script>

    <script>
    //底部悬浮
    ;(function($){
        $.fn.publicPopup=function(opt){
            var pp=$('#publicPayPopup');
            var ppClose=$('#publicPPClose');
            var topShow=$(".J_payBottomShow").length>0?$(".J_payBottomShow").offset().top:200;
            var ppShow=$(".J_payPopupShow").length>0?$(".J_payPopupShow"):'';
            return this.each(function(){
                var $this=$(this);
                $(window).scroll(function(){
                    var wt=$(window).scrollTop();
                    wt>topShow?$this.fadeIn():$this.fadeOut();
                });
                $this.on('click',function(){
                    pp.show();
                });
                ppClose.on('click',function(){
                    pp.hide();
                })
                ppShow?ppShow.on('click',function(){pp.show()}):'';
            });
        };
    })(jQuery);
    $("#publicPayBottom").publicPopup();
    </script>

    
    <script>
            function GetRTime(){
                var key = "ziwei_test_end_time";
                var end = getStorage(key);
                var now = (new Date()).getTime();
                if(end==null|| (end-now < 10*60*1000)) {
                    end = now + (Math.random()*15+45)*60*1000;
                    writeStorage(key, end);
                }

                var t = end-now;
                var d=0;
                var h=0;
                var m=0;
                var s=0;
                if(t>=0){
                    d=Math.floor(t/1000/60/60/24);
                    h=Math.floor(t/1000/60/60%24);
                    m=Math.floor(t/1000/60%60);
                    s=Math.floor(t/1000%60);
                }

                $(".ct_hour").text(h<10?"0"+h:h);
                $(".ct_minute").text(m<10?"0"+m:m);
                $(".ct_second").text(s<10?"0"+s:s);

                setTimeout(GetRTime, 1000);
            }
            GetRTime();
    </script>



<!---->


<script>
    $(function(){
      $("#dashi_wx").click(function(){
        $("#newWinx").show();
      })
      $(".colseBtn,.tanchu_box_no").click(function(){
        $("#newWinx").hide();
      })
	  
	  var btn = document.getElementById('btn');
			var clipboard = new ClipboardJS(btn);
		
			clipboard.on('success', function(e) {
				layer.msg("复制成功")  
			});
		
    })
	
	function testApp(url) { 
           window.location.href='weixin://';
         } 
  </script>

<style>
.tanchu_box {
	width: 100%;
	height: 100vh;
	position: fixed;
	top: 0;
	left: 0;
	display: none;
}

.tanchu_box_no {
	width: 100%;
	height: 100vh;
	background: rgba(0, 0, 0, 0.5);
	position: absolute;
	top: 0;
	left: 0;
}

.tanchu_box_con {
	width: 88%;
	overflow: hidden;
	background: #fff;
	border-radius: 5px;
	position: absolute;
	top: 50%;
	left: 50%;
	padding: 0 24px;
	-webkit-transform: translate(-50%, -50%);
	-moz-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	box-sizing: border-box;
}
</style>
  <div style="display: block;width:70px;height:70px;position:fixed;bottom:120px;right:0;z-index: 99;" id="dashi_wx">
    <img style="width:100%" src="/ffsm/statics/cdn.12ystar.com/images/dswx.png">
  </div>
  <div id="newWinx" class="tanchu_box wei_show2" style="z-index: 100000; display: none;">
    <div class="tanchu_box_no"></div>
    <div class="tanchu_box_con">
      <div style="width:100%;position:relative;">
        <b class="colseBtn" style="width:21px;height:21px;background:url(/ffsm/statics/cdn.12ystar.com/images/weixintanchuNo.png) no-repeat;background-size:100%;display:block;position:absolute;top:10px;right:-15px;"
         ></b>
        <div style="height:15px"></div>
        <div>
          <table>
            <tbody>
              <tr>
                <td>
                  <div style="display:flex;flex-flow:column">
                    <div style="flex:1"></div><img style="width:50px;height:50px" src="/ffsm/statics/cdn.12ystar.com/images/weixin_touxiang.png">
                    <div style="flex:1"></div>
                  </div>
                </td>
                <td style="font-size:14px;padding-left:5px">
                  <p>每天只通过50个名额<br>添加微信号<span id="tc_box_wei2">bycs1116</span>立即咨询</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div style="height:15px"></div>
        <div style="display:flex;line-height:40px">
          <div style="flex:1;border:1px solid #bb1b21;border-top-left-radius:4px;border-bottom-left-radius:5px;text-align:center">
            <p id="tc_box_wei3" style="color:#bb1b21;text-align:center;padding:0;margin:0;font-size:20px">bycs1116</p>
          </div>
          <div style="width:60px;background-color:#bb1b21;border-top-right-radius:4px;border-bottom-right-radius:4px"><button
              style="text-align:center;color:white;font-size:0.3rem;border:0;padding:0;margin:0;display:block;width:100%;height:100%;background:none;line-height:42px; font-size:18px;"
              data-clipboard-action="copy" id="btn" data-clipboard-target="#tc_box_wei3" class="wxCopynum3">复制</button></div>
        </div>
        <p style="font-size:0.35rem;color:red;text-align:center;margin:15px 0"></p>
        <div style="width:100%">
          <div style="width:100%;height:40px;background-color:#3a9e13;color:white !important;font-size:0.33rem;text-align:center;line-height:40px;border-radius:5px;display:flex"
            id="weixinShow" class="wxButHide">
            <div style="flex:1"></div>
            <div style="display:flex;flex-direction:column">
              <div style="flex:1"></div><img src="/ffsm/statics/cdn.12ystar.com/images/weixin_icon.png" style="width:24px;height:20px;vertical-align:middle;display:block">
              <div style="flex:1"></div>
            </div>
            <a href="javascript:testApp('weixin://')" style="margin-left:8px; color:#FFF; font-size:18px;">点击打开微信</a>
            <div style="flex:1"></div>
          </div>
        </div>
        <div style="height:15px"></div>
        <p style="font-size:0.2rem;color:dimgrey;text-align:center;font-style:italic">打开微信，点击右上角“<span style="color:#3cbe0b">+</span>”，点击“<span
            style="color:#3cbe0b">添加朋友</span>”</p>
        <div style="text-align:center;margin-top:5px"><img style="width:80%" src="/ffsm/statics/cdn.12ystar.com/images/weixin_demo.png"></div>
        <div style="height:15px"></div>
      </div>
    </div>
  </div>

<!---->




</body>
</html>

