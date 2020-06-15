
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
                                     接入流程
                            </dt>
                          

                <?php require_once'page_nav.php' ?>

                        </dl>
                    </div>
                    <div class="col-md-9">
                        <div class="about-container">
                            <article id="about" class="about about-part" >
                
<div class="row">

<h3 class="high-light">接入流程</h3>

<div class="contact-content">
<div class="row">

                        <?php if($list):?>
                            <dl class="help-list">
                                <?php foreach($list as $key=>$val): ?>
                                    <dt>
                                        <span class="glyphicon glyphicon-triangle-bottom">
                                        </span>
                                        &nbsp;
                                        <?php echo $val[ 'title']?>
                                    </dt>
                                    <dd>
                                        <?php echo $val[ 'content']?>
                                    </dd>
                                    <?php endforeach;?>
                            </dl>
       <?php endif;?>


</div></div></div></article>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() { !
                function() {
                    var a = window.location.pathname.replace('/process', '');
                    console.log(a);
                    $('.nav-left .nav-list a[href="/process' + a + '"]').addClass("active");
                    var b = a.replace('/', '');
                    if (b == '') b = 'index';
                    $('#' + b).show();
                } ();
            });
        </script>
      
        

<?php require_once 'footer.php' ?>
   