
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
                                     人才招聘
                            </dt>
                          

                <?php require_once'page_nav.php' ?>

                        </dl>
                    </div>
                    <div class="col-md-9">
                        <div class="about-container">
                            <article id="about" class="about about-part" >
                
<div class="row">

<h3 class="high-light">人才招聘</h3>

<div class="contact-content">
<div class="row"
><ul class="list-unstyled">

 <?php if($news):?>
                                <?php foreach($news as $key=>$val):?>
								<li style="padding: 2px 0;">
								<div class="col-md-12">
								<div class="pull-left hidden-xs"> <?php echo date( 'Y-m-d H:i:s',$val[ 'addtime'])?></div>
								<div class="col-sm-9">
								                        <a href="/news/view/<?php echo $val['id']?>">      <?php echo $val[ 'title']?></a>
								</div>
								</div>
								</li>
                                                                    <?php endforeach;?>
                                        <?php endif;?>
										







</ul>





</div></div></div></article>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() { !
                function() {
                    var a = window.location.pathname.replace('/jobs', '');
                    console.log(a);
                    $('.nav-left .nav-list a[href="/jobs' + a + '"]').addClass("active");
                    var b = a.replace('/', '');
                    if (b == '') b = 'index';
                    $('#' + b).show();
                } ();
            });
        </script>
      
        

<?php require_once 'footer.php' ?>
   