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
                <h5 class="breadcrumbs-title">领取记录</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo url::s('index/panel/home');?>">仪表盘</a></li>
                    <li><a href="<?php echo url::s('index/alipaygm/automatic');?>">微博红包</a></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">
			<p class="caption">
			
			<font color=blue>总计领取总额：<font color=red><?php  $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_take where  user_id={$_SESSION['MEMBER']['uid']}")[0];
                                        echo number_format($order['money'],3);
                                        ?>  </font></font>
                                        
				</p>

 
            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>发包微博昵称</th>
                          <th>发包ID</th>
                          <th>收包ID</th>
                          <th>微博订单号</th>
                          <th>收包金额</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                      	
                                                
                                                
                        <td><?php echo $ru['id'];?></td>
                        <td><span style="color: green;"><b><?php echo $ru['get_name'];?></b></span></td>

                        <td><b><?php echo $ru['owner_uid'];?></b></td>
                        <td><b><?php echo $ru['seler_uid'];?></b></td>
                        <td><font color=red><b><?php echo $ru['set_id'];?><b></font></td>
                        <td><font color=purple><b><?php echo $ru['amount'];?><b></font></td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
              
              <div class="row"><ul class="pagination"><?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?></ul></div>
  
            </div>
            
            

          </div>


        </div>
        <!--end container-->

      </section>

      <!-- END CONTENT -->
      <script type="text/javascript">
      
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   