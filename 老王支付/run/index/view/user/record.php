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
                <h5 class="breadcrumbs-title">我的收款记录</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">个人中心</a></li>
                    <li class="active">收款记录</li>
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
            
            <span style="font-size: 15px;margin-left:20px;">[ <b>今日收款:</b> <?php //查询今日收入 
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $where_call = "pay_time > {$nowTime} and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pay_record where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money'],2) .' </span> / 收款次数: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] - [ <b>昨日收款:</b> <?php 
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
                        $where_call = "pay_time > {$zrTime} and pay_time<{$nowTime} and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pay_record where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money'],2) .' </span> / 收款次数: <span style="color:green;font-weight:bold;">'. intval($order[0]['count']).'</span> ';
                        ?> ] - [ <b>全部收款:</b> <?php 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pay_record where {$where}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money'],2) .' </span> / 收款次数: <span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> ';
                        ?> ]</span>
   
            </p>
        

            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                     	<th>类型</th>
                        <th><div class="input-field col s6"> <input onchange="note(this);" id="last_name" type="text" class="validate" value="<?php if ($sorting['name'] == 'note') echo $_GET['code'];?>"> <label for="last_name">收款信息</label></div></th>
                        <th>收款金额</th>
                        <th>设备版本</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
                    
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td><?php echo $ru['types']==1 ? '<span style="color:green;">微信</span>' : '<span style="color:red;">支付宝</span>';?></td>
                        <td><?php echo $ru['pay_note'] == '' ? '无':$ru['pay_note'];?></td>
                        
                        <td>
                        <span style="color: red;font-weight:bold;"><?php echo $ru['amount'];?></span>（支付时间：<?php echo date("Y/m/d H:i:s",$ru['pay_time']);?>）
                        </td>

                        <td>
                        <?php if ($ru['version_code'] == 'wechat_auto') echo '微信[公开版]';if ($ru['version_code'] == 'alipay_auto') echo '支付宝[公开版]';if ($ru['version_code'] == 'service_auto') echo '自动服务版';?>
                        </td>
                        
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


      function note(obj){
          location.href = "<?php echo url::s('index/member/record',"sorting=note&code=");?>" + $(obj).val();
          }

	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   