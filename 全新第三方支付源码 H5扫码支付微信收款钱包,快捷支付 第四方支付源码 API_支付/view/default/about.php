<?php require_once 'header.php' ?>
        <div class="row home-row-3">
            <div class="container clearfix">
                <img src="/static/default/images/banner.png">
            </div>
        </div>
        <div class="row mt-30">
            <div class="container">
                <div class="about-page row">
                    <div class="col-md-3 nav-left">
                        <dl class="nav-menu">
                            <dt class="nav-title">
                                关于我们
                            </dt>
                          

                <?php require_once'page_nav.php' ?>

                        </dl>
                    </div>
                    <div class="col-md-9">
                        <div class="about-container">
                            <article id="about" class="about about-part" >
                                <div class="row">
                                    <h3 class="high-light">
                                       关于我们
                                    </h3>
                                    <div class="contact-content">
                                        <p>
                                            安易支付平台由大连智未蓝网络科技公司研发的主要服务于互联网和移动互联网领域，
面向消费者，提供简单、快捷的付费体验，面向页游和移动应用开发者与平台运营商，提供专业、全面的一站式收费及运营支撑解决方案，帮助开发者在任何时候、任何地方、任何用户都能收到钱
一站式接入网银，支付宝，微信，财付通，QQ钱包，游戏点卡，支付宝WAP,微信WAP，QQ钱包WAP，财付通WAP，快捷支付等主流支付方式，让你公司运营利润迅速提升！
                                        </p>
                                        
                                        <p>
                                            现在互联网行业竞争非常激烈，在运营利润越来越低的大环境下，软件开发商很难再去投入资金自建销售客服和售后服务渠道。自建渠道对于销售、客服人员都有很高的要求，会造成资源的极大浪费,并且客服人员不足，客服不专业等难免会流失生意。
                                        </p>
                                        <p>
                                            有的开发人员白天需要上班,只是在空闲的时间开发程序来提高自己的收入，如果放在网店销售的话，但又不想在工作时店铺无人打理，自己上班、软件开发等事情已经够忙了，还要把时间放在与零散客户的交流上；有的已经有专门的客服人员，但不专业也不能24小时轮班，并且工资不低等等。
                                        </p>
                                        <p>
                                               安易支付托管销售系统就是根据目前软件开发行业这种情况，为开发商量身设计的全新产品，开发商可以更便捷的销售自己的产品，减轻自己负担的同时也大大的增加了收益;
                                        </p>
                                        <p>
                                               安易支付有着强大的技术团队力量，采用目前市场上最简单化、 最便捷化的配置使用，同时我们也给开发商提供协助安装使用以及技术方面的咨询，
                                            更稳定、安全的技术手段让您在运营迅速发展竞争越来越大的情况下节省时间与精力，同时达到更多的赢利;
                                        </p>
                                        <p>
                                            我们有着专业、成熟的团队，无论是对用户方面的咨询，还是对开发商使用过程中的一切问题以及咨询我们都将以专业的态度完成疑难解答、协助技术服务等。
                                        </p>
                                    </div>
                                </div>
                            </article>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() { !
                function() {
                    var a = window.location.pathname.replace('/about', '');
                    console.log(a);
                    $('.nav-left .nav-list a[href="/about' + a + '"]').addClass("active");
                    var b = a.replace('/', '');
                    if (b == '') b = 'index';
                    $('#' + b).show();
                } ();
            });
        </script>
      
        

<?php require_once 'footer.php' ?>