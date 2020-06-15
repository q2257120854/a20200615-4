//获取Url参数
function getParameter() {
    var obj = {};
    var url = document.URL;
    var para = "";
    if (url.lastIndexOf("?") > 0) {
        para = url.substring(url.lastIndexOf("?") + 1, url.length);
        var arr = para.split("&");
        para = "";
        for (var i = 0; i < arr.length; i++) {
            var key = arr[i].split("=")[0];
            var name = arr[i].split("=")[1];
            obj[key] = name;
        }
    }
    return obj;
}
//滑动预览
function scroll(scrollTop,speed) {
    var speed = speed > 0 ? speed :500;
    $("html,body").stop().animate({scrollTop:scrollTop},speed);
}

$(function(){
    (function () {
        //头部
        var str_header = '<div class="header" id="header">' +
                '<div class="wrap clearfix">' +
                    '<div class="logo">' +
                         '<a href="index.html" title="万智通付-首页">万智通付</a>' +
                    '</div>' +
                    '<div class="nav">' +
                        '<ul> ' +
                            '<li class="soluLinkBtn"> ' +
                                '<a href="javascript:;">支付解决方案 <i class="caret"></i></a>' +
                                '<div class="smenu clearfix">' +
                                    '<div class="mspace"></div>' +
                                    //'<div class="mtm"><a href="sao.html">扫咩</a></div>' +
                                    '<div class="mtm" data-target="phone"><a href="solution.html?m=phone">移动支付</a></div>' +
                                    '<div class="mtm" data-target="pc"><a href="solution.html?m=pc">PC支付</a></div>' +
                                    '<div class="mtm" data-target="code"><a href="solution.html?m=code">扫码支付</a></div>' +
                                    '<div class="mtm" data-target="company"><a href="solution.html?m=company">极速代付</a></div>' +
                                    //'<div class="mtm" data-target="subscribe"><a href="solution.html?m=subscribe">自助续费</a></div>' +
                                   // '<div class="mtm"><a href="rsb.html">智能POS机</a></div>' +
                                '</div>' +
                            '</li>' +
                            // '<li><a href="p2p.html">P2P资金存管</a></li>' +
                            // '<li><a href="rsb.html">融收宝</a></li> ' +
                            //'<li><a href="cost.html">费用</a></li> ' +
                            //'<li><a href="doc.html">商户指引</a></li> ' +
                            // '<li><a href="download.html">下载</a></li> ' +
                            '<li class="soluLinkBtn"> ' +
                                '<a href="javascript:;">开发文档 <i class="caret"></i></a>' +
                                '<div class="smenu clearfix" style="left:-10px;">' +
                                    '<div class="mspace"></div>' +
                                    '<div class="mtm"><a href="/upload/demo.rar">Demo文档</a></div>' +
                                    '<div class="mtm"><a href="/upload/万智通付API开发文档说明.docx">说明文档</a></div>' +
                                '</div>' +
                            '</li>' +
                            '<li><a href="/demo/">支付演示</a></li>' +
							'<li><a href="/xy.html">合作协议</a></li>' +
                        '</ul>'+
                    '</div>' +
                    '<div class="info">' +
                        '<p class="user">' +
                            '<a href="/login" target="_blank" class="lgBtn">商户登录</a>' +
                            '<a href="/register" target="_blank" class="lgBtn">商户注册</a>' +
                        '</p>' +
                    '</div> ' +
                '</div>' +
            '</div>';

        //尾部
        var str_footer = '<div class="footer clearfix">' +
                '<div class="w1200 clearfix">' +
                    '<div class="frlink">' +
                        '<h1>友情链接</h1>' +
                        '<div class="linkbox">' +
                            '<a target="_blank" href="https://www.alipay.com">支付宝</a><span>|</span>' +
                            '<a target="_blank" href="https://www.baifubao.com">百度钱包</a><span>|</span>' +
                            '<a target="_blank" href="http://jr.jd.com">京东金融</a><span>|</span>' +
                            '<a target="_blank" href="https://pay.weixin.qq.com">微信支付</a><span>|</span>' +
                            '<a target="_blank" href="http://www.chanpay.com">畅捷支付</a><span>|</span>' +
                            '<a target="_blank" href="http://www.chinapay.com">银联支付</a><span>|</span>' +
                            '<a target="_blank" href="http://www.sumapay.com">丰付</a><span>|</span>' +
                            '<a target="_blank" href="https://www.fuiou.com">富友集团</a><span>|</span>' +
                            '<a target="_blank" href="https://www.beijing.com.cn">首信易支付</a><span>|</span>' +
                            '<a target="_blank" href="http://www.allinpay.com">通联支付</a><span>|</span>' +
                            '<a target="_blank" href="https://www.ucfpay.com ">先锋支付</a><span></span>' +
                        '</div>' +
                    '</div>' +
                    '<div class="contact-nav">' +
                        '<a href="#">联系我们</a>' +
                        '<a href="#">关于我们</a>' +
                        '<a href="#">隐私政策</a>' +
                        '<a href="#">服务条款</a>' +
                    '</div>'+
                    '<p class="tele2">服务QQ：<strong>11210980</strong></p>' +
                    '<p class="f_email">电子邮箱：<a href="mailto: tz790@qq.com">tz790@qq.com</a></p>' +
                    '<p class="f_address">地址：广州市番禺区市桥街富华东路296号431</p>' +
                    '<p class="f_company">广州聚得益信息科技有限公司 粤ICP备15054944号-1</p>' +
                   
                '</div>' +
                '<div class="backTop" id="backTop">' +
                    '<div class="backTopBtn">' +
                        '<img src="images/common/backtop.png" width="17" height="10" alt="回到顶部" title="回到顶部" />' +
                        '<span>Top</span>' +
                    '</div>' +
                '</div>' +
            '</div>';

        var loadJSON = {
            "header":str_header,
            "footer":str_footer
        }
        //加载头和尾
        $("body").prepend(loadJSON.header).append(loadJSON.footer);
        //体验
        /*$("#tyBtn ").hover(function () {
            $(".imgWait").addClass('show');
        },function(){
            $(".imgWait").removeClass('show');
        });*/
    })();

    //支付解决方案
    (function () {
        var timer;
        //二级菜单
        $(".soluLinkBtn").hover(function(){
            $smenu = $(this).find(".smenu");
            $smenu.show();
            clearTimeout(timer);
            timer = setTimeout(function () {
                $smenu.addClass("inview");
            }, 300);
        },function(){
            $smenu = $(this).find(".smenu");
            clearTimeout(timer);
            $smenu.removeClass("inview");
            timer = setTimeout(function () {
                $smenu.hide();
            },500);
        });

        //链接过来后定位对应的支付方式。
        var getParas = getParameter();
        // console.log(getParas);
        var top;
        var target = "." + getParas.m; //?m=pc
        if(!getParas.m){ return;}
        if(target == 'phone'){
            top = $(target).offset().top-100;
        }else{
            top = $(target).offset().top-40;
        }
        scroll(top);
    })();

    //向下预览
    $("#arrow").on("click",function () {
        var char_top = $("#character").offset().top - $("#header").outerHeight();
        scroll(char_top);
    });

    //回到顶部.
    $("#backTop").on("click",function () {
        scroll(0);
    });

    //咨询台
    (function () {
        var timer;
        $(".advisory .contact li ").hover(function () {
            var index = $(this).index();
            var oDiv = $('.advisory').find(".adct");
            oDiv.hide().eq(index).fadeIn();

        },function(){
            var index = $(this).index();
            var oDiv = $('.advisory').find(".adct");
            oDiv.eq(index).fadeOut();
        });
        
        //回到顶部
        $(".btopBtn").on("click",function () {
            scroll(0);
        });
    })();

    //头部固定定位
    $(window).scroll(function(){
        var oStp = $(document).scrollTop();
        if (oStp >= 100) {
            if($('.header').hasClass('fixed')==false){
                $('.header').addClass('fixed');
            }
        }else{
            if($('.header').hasClass('fixed')){
                $('.header').removeClass('fixed');
            }
        }
    });

    //标记菜单栏
    (function () {
        var url = location.href; //地址链接
        var aLink = $("#header .nav ul > li");
        aLink.removeClass("active");
        if(getPara("solution.html")){
            aLink.eq(0).addClass("current");
        }
        // if(getPara("p2p.html")){
        //     aLink.eq(1).addClass("current");
        // }
        // if(getPara("rsb.html") || getPara("sao.html")){
        //     aLink.eq(0).addClass("current");
        // }
        if(getPara("cost.html")){
            aLink.eq(1).addClass("current");
        }
        if(getPara("doc.html")){
            aLink.eq(2).addClass("current");
        }
        if(getPara("download.html")){
            aLink.eq(3).addClass("current");
        }
        if(getPara("help.html")){
            aLink.eq(4).addClass("current");
        }
        //判断是否是当前页面。
        function  getPara(arg) {
            return url.indexOf(arg) > 0 ;
        }
    })();

    //跳转到手机页面
    /*if (/iPhone|iPod|Android|Windows Phone/i.test(navigator.userAgent)) {
        var path = pathName();
        if(path){
            location.href="../mzitopay/wap/" + path;
        }else{
            location.href="../mzitopay/wap/index.html";
        }
    }*/
    //获取当前页名字
    /*function pathName(){
        var strUrl = window.location.href;
        var arrUrl = strUrl.split("/");
        var strPage = arrUrl[arrUrl.length-1];
        var indexof = strPage.indexOf("?");
        if(indexof != -1){
            strPage = strPage.substr(0,strPage.indexOf("?"));
        }
        return strPage;
    }*/
});
