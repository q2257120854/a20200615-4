
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
                                     免责声明
                            </dt>
                          

                <?php require_once'page_nav.php' ?>

                        </dl>
                    </div>
                    <div class="col-md-9">
                        <div class="about-container">
                            <article id="about" class="about about-part" >
                
<div class="row">

<h3 class="high-light">免责声明</h3>
<p>您在使用和接受行 <?php echo $this->config['sitename'] ?>网站(以下简称 <?php echo $this->config['sitename'] ?>)各项服务前，请先阅读本声明。您访问本网站或使用本网站的任何服务，都视为对本声明全部内容的认可。如您不认可本声明，您应停止使用 <?php echo $this->config['sitename'] ?>及相关服务。</p>
　<p>　1、 <?php echo $this->config['sitename'] ?>作为网络交易平台，除 <?php echo $this->config['sitename'] ?>特定自行销售的产品外，您从 <?php echo $this->config['sitename'] ?>上获取的任何产品信息(包括但不限于商户名称、公司名称、联系方式、产品及其描述说明等)均为 <?php echo $this->config['sitename'] ?>用户(包括个人用户及商户)自行发布， <?php echo $this->config['sitename'] ?>对其真实性、合法性及有效性不做任何形式的保证，您应自行判断并承担风险。所有责任由该信息发布者承担， <?php echo $this->config['sitename'] ?>对此不承担任何法律责任。</p>
　　<p>2、您在 <?php echo $this->config['sitename'] ?>登记和发布的任何信息，应对其真实性及合法性负责，不得违反法律法规及 <?php echo $this->config['sitename'] ?>相关规则的要求，否则您应自行承担全部法律责任。</p>
　<p>　3、除以 <?php echo $this->config['sitename'] ?>名义发出的各类规则、公告外， <?php echo $this->config['sitename'] ?>刊载的各类文章、商户网店自行发布的广告、观点及链接的其他网站内容，仅为提供更多信息以供参考或学习交流，并不代表 <?php echo $this->config['sitename'] ?>的立场和观点。</p><p>4、因本公司系统停机维护、线路故障、硬件故障等造成的暂停服务期间给用户造成的一切损失， <?php echo $this->config['sitename'] ?>不承担任何法律责任。</p>
　<p>　5、因 <?php echo $this->config['sitename'] ?>控制范围外的原因(包括但不限于黑客攻击、电信部门技术调整或故障、银行方面原因、不可抗力等)导致 <?php echo $this->config['sitename'] ?>无法正常使用，或交易出错，或信息丢失泄漏，或其他一切损失， <?php echo $this->config['sitename'] ?>不承担任何法律责任。但 <?php echo $this->config['sitename'] ?>会及时采取相关措施，尽早恢复网站的正常运营。</p>
　<p>　6、 <?php echo $this->config['sitename'] ?>尊重用户隐私，承诺不主动向任何第三方泄漏用户隐私，除非符合《隐私条款》信息披露的情形。非因 <?php echo $this->config['sitename'] ?>原因造成的信息泄漏， <?php echo $this->config['sitename'] ?>不承担任何法律责任。</p>
　<p>　7、 <?php echo $this->config['sitename'] ?>尊重任何人的知识产权。如您认为 <?php echo $this->config['sitename'] ?>上的作品或信息侵犯了您的知识产权，您可及时向 <?php echo $this->config['sitename'] ?>发出权利通知(详见《作品权利保护声明》)。 <?php echo $this->config['sitename'] ?>在收到您的权利通知后，将会尽快处理。</p>
<p>　　8、 <?php echo $this->config['sitename'] ?>可能会修订包括本免责声明在内的服务协议、规则、声明等，修订后将在 <?php echo $this->config['sitename'] ?>上公告，不再另行通知。您应以最新的规则约束为准。</p>


</div></div></div></article>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() { !
                function() {
                    var a = window.location.pathname.replace('/statement', '');
                    console.log(a);
                    $('.nav-left .nav-list a[href="/statement' + a + '"]').addClass("active");
                    var b = a.replace('/', '');
                    if (b == '') b = 'index';
                    $('#' + b).show();
                } ();
            });
        </script>
      
        

<?php require_once 'footer.php' ?>
   
