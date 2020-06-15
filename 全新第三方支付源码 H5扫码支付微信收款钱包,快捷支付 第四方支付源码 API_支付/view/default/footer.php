<?php if(!defined('WY_ROOT'))exit; ?>
< <footer class="footer clearfix">
        <div class="container">
            <span class="fl">     <?php echo $this->config['sitename']?> &nbsp;版权所有|   © Copyright 2016-2017  <?php echo $this->config['sitename']?> All rights reserved&nbsp;
                <a href="http://www.miitbeian.gov.cn/" target="_blank" style="color: #7d7d7d;">
<?php echo $this->config['icpcode']?>
                </a></span>
            <span class="fr">
                
                        <a href="/a/case/" target="_self">成功案例</a>
                    |　
                
                        <a href="/a/solution/" target="_self">解决方案</a>
                    |　
                
                        <a href="/a/prolist/" target="_self">产品中心</a>
                    |　
                
                        <a href="/a/services/" target="_self">服务支持</a>
                    |　
                
                        <a href="/a/about/" target="_self">关于我们</a>
                    
                
            </span>
        </div>
    </footer>

    <!--右侧菜单-->
    <div class="ke_ConMenu">
        <ul>
            <li>
                <span class="keCon_icon">
                    <img src="/static/default/images/keCon_icon1.png" width="40" height="40" /><div class="keCon_show" style="width: 142px;"><a class="cor_bs" href="tel:0577-88888888">0577-88888888<img src="/static/default/images/keCon_icon1.png" width="40" height="40"></a></div>
                </span>
            </li>
            <li>
                <span class="keCon_icon">
                    <img src="/static/default/images/keCon_icon2.png" width="40" height="40" /><div class="keCon_show" style="width: 160px;"><a class="cor_bs" href="mailto:8932853#qq.com">8932853#qq.com<img src="/static/default/images/keCon_icon2.png" width="40" height="40"></a></div>
                </span>
            </li>
            <li>
                <span class="keCon_icon">
                    <img src="/static/default/images/keCon_icon3.png" width="40" height="40" /><div class="keCon_show" style="width: 40px;">
                        <img src="/static/default/images/keCon_icon3.png" width="40" height="40" />
                    </div>
                </span>
                <div class="keCon_wx">
                    <img src="/static/default/images/wxImg.jpg" width="180" height="180" /><br />
                    微信公众号
                </div>
            </li>
            <li class="backTop">
                <span class="keCon_icon">
                    <img src="/static/default/images/keCon_icon4.png" width="40" height="40" /><div class="keCon_show" style="width: 40px;">
                        <img src="/static/default/images/keCon_icon4.png" width="40" height="40" />
                    </div>
                </span>
            </li>
        </ul>
    </div>
    <script src="/static/default/jquery.js"></script>
    <script src="/static/default/prefixfree.min.js"></script>
    <script src="/static/default/TouchSlide.1.1.js"></script>
    <script src="/static/default/ss.js"></script>
    <script src="/static/default/bootstrap.min.js"></script>
    <script src="/static/default/swiper.min.js"></script>
    <script src="/static/default/swiper.animate1.0.2.min.js"></script>
    <script src="/static/default/jquery.scrollto.js"></script>
    <script src="/static/default/public.js"></script>
    <script>
        $(function () {
            $("#search").focus(function () {
                document.onkeydown = function (e) {
                    var ev = document.all ? window.event : e;
                    if (ev.keyCode == 13) {
                        if ($("#search").val() == "") {
                            return;
                        } else {
                            window.location.href = ("/plus/search.php?kwtype=0&q=" + $("#search").val());
                        }
                    }
                }
            });
            $("#searchBtn").click(function () {
                if ($("#search").val() == "") {
                    return;
                } else {
                    window.location.href = ("/plus/search.php?kwtype=0&q=" + $("#search").val());
                }
            });
        });
    </script>
    
    <!--左侧快捷菜单-->
    <ul class="hm_kmenu">
        <li class="on" oid='hm_m0'>
            <div class="hmKm_icon"></div>
            <div class="hmKm_nm"><i></i>首页</div>
        </li>
        <li oid='hm_m1'>
            <div class="hmKm_icon"></div>
            <div class="hmKm_nm"><i></i>产品中心</div>
        </li>
        <li oid='hm_m2'>
            <div class="hmKm_icon"></div>
            <div class="hmKm_nm"><i></i>电能讲武堂</div>
        </li>
        <li oid='hm_m3'>
            <div class="hmKm_icon"></div>
            <div class="hmKm_nm"><i></i>资讯中心</div>
        </li>
        <li oid='hm_m4'>
            <div class="hmKm_icon"></div>
            <div class="hmKm_nm"><i>关于我们</i></div>
        </li>
     
    </ul>

    <script type="text/javascript">
        $(".hm_kmenu li").click(function () {
            //$(this).addClass("on").siblings("li").removeClass("on");
            var cutId = $(this).attr("oid");
            $("#" + cutId).ScrollTo(500);
        });
        $(window).scroll(function () {
            if ($(document).scrollTop() < $("#hm_m1").offset().top) {
                $(".hm_kmenu li").removeClass("on");
                $(".hm_kmenu li").eq(0).addClass("on");
            }
            if ($(document).scrollTop() > $("#hm_m1").offset().top - 2 && $(document).scrollTop() < $("#hm_m2").offset().top) {
                $(".hm_kmenu li").removeClass("on");
                $(".hm_kmenu li").eq(1).addClass("on");
            }
            if ($(document).scrollTop() > $("#hm_m2").offset().top - 2 && $(document).scrollTop() < $("#hm_m3").offset().top) {
                $(".hm_kmenu li").removeClass("on");
                $(".hm_kmenu li").eq(2).addClass("on");
            }
            if ($(document).scrollTop() > $("#hm_m3").offset().top - 2 && $(document).scrollTop() < $("#hm_m4").offset().top) {
                $(".hm_kmenu li").removeClass("on");
                $(".hm_kmenu li").eq(3).addClass("on");
            }

            if ($(document).scrollTop() > $("#hm_m4").offset().top - 100) {
                $(".hm_kmenu li").removeClass("on");
                $(".hm_kmenu li").eq(5).addClass("on");
            }
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('.m2body').removeClass('m2body');
        });
    </script>

    



         
   <div style="display:none"><?php echo $this->config['stacode'] ?></div>
	</body>
	</html>
