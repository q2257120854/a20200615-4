<?php
use xh\library\url;
use xh\library\model;
$fix = DB_PREFIX;
?>
	<?php include_once (PATH_VIEW . 'common/header.php');?>
    <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">商品购买</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">商品</a></li>
                    <li class="active">商品列表</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
 <!--start container-->
        <div class="container">
          <div class="section">

            <!-- <p class="caption">以下商品是本平台官方销售，请商家放心购买</p>
            <div class="divider"></div> -->
            <div class="row">
              <section class="plans-container" id="plans">
              <?php foreach ($result['result'] as $ru){ 
                if ($ru['category'] == 3) $css = 'green';
                if ($ru['category'] == 2) $css = 'cyan';
                if ($ru['category'] == 1) $css = 'purple';
                  ?>
                <article class="col s12 m6 l4">
                  <div class="card hoverable">
                    <div class="card-image <?php echo $css;?> waves-effect">
                      <div class="card-title"><?php echo $ru['name'];?></div>
                      <div class="price"><sup>¥</sup><?php echo $ru['money'];?><sub>/单价</sub></div> 
                      <div class="price-desc"><?php if ($ru['category'] == 1) echo '<i class="mdi-social-group"></i> 用户组';?><?php if ($ru['category'] == 2) echo '<i class="mdi-action-credit-card"></i> 卡密信息';?><?php if ($ru['category'] == 3) echo '<i class="mdi-action-shopping-cart"></i> 商品货物';?></div>
                    </div>
                    <div class="card-content" style="padding: 20px;">
                      <?php echo $ru['description'];?>
                    </div>
                    <div class="card-action center-align">                      
                      <button class="waves-effect waves-light btn" onclick="buy('<?php echo $ru['id'];?>');">立即购买</button>
                    </div>
                  </div>
                </article>
                <?php }?>
              </section>

              <div class="col s12">
                <br><br>
                <div class="divider"></div>
             <div class="row"><ul class="pagination"><?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?></ul></div> 
              </div>              
              
             
          </div>
            
          </div>
          <!-- Floating Action Button -->
            <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
                <a class="btn-floating btn-large">
                  <i class="mdi-action-stars"></i>
                </a>
                <ul>
                  <li><a href="css-helpers.html" class="btn-floating red"><i class="large mdi-communication-live-help"></i></a></li>
                  <li><a href="app-widget.html" class="btn-floating yellow darken-1"><i class="large mdi-device-now-widgets"></i></a></li>
                  <li><a href="app-calendar.html" class="btn-floating green"><i class="large mdi-editor-insert-invitation"></i></a></li>
                  <li><a href="app-email.html" class="btn-floating blue"><i class="large mdi-communication-email"></i></a></li>
                </ul>
            </div>
            <!-- Floating Action Button -->
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->
      <script type="text/javascript">
      function buy(id){
		  layer.open({
			  type: 2,
			  title: '购买商品',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['500px', '700px'],
			  content: '<?php echo url::s('index/shop/buy','id=');?>' + id //iframe的url
			});
    	  }
     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   