<?php
use xh\library\url;
use xh\library\model;
use xh\unity\in;
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
                <h5 class="breadcrumbs-title">我的消费订单</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">商城</a></li>
                    <li class="active">购物订单</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">
   

            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                     	
                        <th><div class="input-field col s7"> <input onchange="trade_no(this);" id="last_name" type="text" class="validate" value="<?php if ($sorting['name'] == 'trade_no') echo $_GET['code'];?>"> <label for="last_name">交易流水号</label></div></th>
                        <th>支付信息</th>
                        <th>商品信息</th>
                        <th>[ <a href="<?php echo url::s("index/shop/order");?>">全部</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=0");?>" style="color: red;">未支付</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=1");?>" style="color: #4caf50;">已支付</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=2");?>" style="color: #1de9b6;">已发货</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=3");?>" style="color: #e65100;">已收货</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=4");?>" style="color: #039be5;">退款中</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=5");?>" style="color: #64dd17;">退款成功</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=6");?>" style="color: #dd2c00;">退款失败</a> / <a href="<?php echo url::s("index/shop/order","sorting=status&code=7");?>" style="color: #9e9e9e;">订单已关闭</a> ]</th>
                        <th>订单时间</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
                    
                    <?php foreach ($result['result'] as $ru){  
                    //查询商品
                    $shopInfo = $mysql->query("shop","id={$ru['shop_id']}")[0];
                        ?>
                      <tr>
                        
                        
                        <td>订单号码：<span style="color:#424242;"><?php echo $ru['serial_no'];?></span>
                        <br>订单类型：<?php if ($shopInfo['category'] == 1) echo '<span style="color:#c0ca33;"><i class="mdi-social-group"></i> 用户组</span>';?><?php if ($shopInfo['category'] == 2) echo '<span style="color:#3f51b5;"><i class="mdi-action-credit-card"></i> 卡密信息</span>';?><?php if ($shopInfo['category'] == 3) echo '<span style="color:#43a047;"><i class="mdi-action-shopping-cart"></i> 商品货物</span>';?>
                        </td>
                        
                         <td>
                        订单金额：<span style="color:green;"><?php echo $ru['amount'];?></span><br>
                        支付方式：<?php if ($ru['pay_method'] == 1) echo '微信支付'; if ($ru['pay_method'] == 2) echo '支付宝支付'; if ($ru['pay_method'] == 3) echo '余额'; if ($ru['pay_method'] == 4) echo '盈利余额';?><br>
                        </td>
                        
                        <td>
                        商品名称：<span><?php echo $shopInfo['name'];?></span><br>
                        数量/单价：<?php echo '<span style="color:red;">'. $ru['quantity'] . '</span> / <span style="color:green;">' . $shopInfo['money'] . '</span>';?><br>
                        </td>
                        
                        <td>支付状态：<?php 
                        //退款原因  
                        $refund_schedule = json_decode($ru['refund_feedback'],true);
                        //送货地址
                        $address = json_decode($ru['address'],true);
                        if ($ru['status'] == 0) {
                            echo '<span style="color:red;">未支付</span>';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#00897b;color:white;" onclick="location.href=\''.url::s("index/shop/orderBuy","id=" . in::set($ru['id'])).'\'">立即支付</button> ]';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#039be5;color:white;" onclick="close_pay(\''.in::set($ru['id']).'\');">关闭交易</button> ]';
                        }
                        if ($ru['status'] == 1) {
                            echo '<span style="color:#4caf50;">已支付</span>';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#f57c00;color:white;" onclick="applyRefund(\''.in::set($ru['id']).'\');">申请退款</button> ]';
                            echo ' <span style="color:ba68c8;">[ 等待商家发货 ]</span>';
                        }
                        if ($ru['status'] == 2) {
                            echo '<span style="color:#33691e;">已发货</span>';
                            if ($shopInfo['category'] == 2){
                                echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#f57c00;color:white;" onclick="applyRefund(\''.in::set($ru['id']).'\');">申请退款</button> ]';
                                echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#689f38;color:white;" onclick="receipt(\''.in::set($ru['id']).'\');">确认收货</button> ]';
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="order_query(\''.in::set($ru['id']).'\',\'查看卡密信息\');">查看卡密信息</a> ]';
                            }
                            if ($shopInfo['category'] == 3){
                                echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#f57c00;color:white;" onclick="applyRefund(\''.in::set($ru['id']).'\');">申请退款</button> ]';
                                echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#689f38;color:white;" onclick="receipt(\''.in::set($ru['id']).'\');">确认收货</button> ]';
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="express(\''.in::set($ru['id']).'\',\'查看物流信息\');">查看物流信息</a> ]';
                                echo ' [ 收货地址：' . $address['address'] . ' / ' . $address['name'] . ' / ' .substr_replace($address['phone'], '****', 3, 4) . ' ]';
                            }
                        }
                        if ($ru['status'] == 3) {
                            echo '<span style="color:#e65100;"><b>已签收</b></span>';
                            if ($shopInfo['category'] == 2){
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="order_query(\''.in::set($ru['id']).'\',\'查看卡密信息\');">查看卡密信息</a> ]';
                            }
                            if ($shopInfo['category'] == 3){
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="express(\''.in::set($ru['id']).'\',\'查看物流信息\');">查看物流信息</a> ]';
                                echo ' [ 收货地址：' . $address['address'] . ' / ' . $address['name'] . ' / ' .substr_replace($address['phone'], '****', 3, 4) . ' ]';
                            }
                        }
                        if ($ru['status'] == 4) { 
                            echo '<span style="color:#039be5;"><b>退款中</b></span>';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#ff5252;color:white;" onclick="cancelRefund(\''.in::set($ru['id']).'\');">取消退款</button> ]';
                            echo ' <span style="color:#9e9e9e;">[ 原因：'.$refund_schedule['reason'] .' ]' . ' ( 提交时间：' . date("Y/m/d h:i:s",$refund_schedule['time']) . ' ) </span>';
                        }
                        if ($ru['status'] == 5) echo '<span style="color:#64dd17;"><b>退款已到达支付账户</b></span>';
                        if ($ru['status'] == 6) echo '<span style="color:#dd2c00;"><b>退款失败</b></span>';
                        if ($ru['status'] == 7) echo '<span style="color:#9e9e9e;"><b>订单已关闭</b></span>';
                        
                        ?> 
                       
                        </td>
                        
                       <td>创建时间：<?php echo date('Y/m/d H:i:s',$ru['add_time']);?>
                       <br>支付时间：<?php echo $ru['pay_time']!=0 ? '<span style="color:green;">'. date('Y/m/d H:i:s',$ru['pay_time']) . '</span>': '无信息';?>
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
      function trade_no(obj){
          location.href = "<?php echo url::s('index/service/order',"sorting=trade_no&code=");?>" + $(obj).val();
          }

	
      //关闭交易
      function close_pay(id){
    	  swal({
              title: "交易提醒", 
              text: "您确认要关闭该交易订单吗？", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "确认关闭", 
              cancelButtonText: "取消",
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/shop/closeBuy',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("交易提醒", result.msg, "success");
    	              	setTimeout(function(){location.href = '<?php echo url::s("index/shop/order");?>';},1000);
    	              }else{
    	            	swal("交易提醒", result.msg, "error");
    	              }
              	  });
            });	
      }

      function applyRefund(id){
		  swal({
		      title: "申请退款",
		      text: "请输入您退款的原因<input type='text' id='reason'>"
		      +"请输入需要退款的商品数量<input type='text' id='refundNum'>",
		      showCancelButton: true,     
              closeOnConfirm: false, 
		      html: true,
              confirmButtonText: "申请退款" , 
              cancelButtonText: "取消",
		      type: "input",
		  }, function(){
			  var dataTemp = {
					  id: id,
					  reason: $('#reason').val(),
					  refundNum: $('#refundNum').val()
					};

				console.log(dataTemp);
			  $.ajax({
		          type: "POST",
		          dataType: "json",
		          url: "<?php echo url::s('index/shop/applyRefund');?>",
		          data: dataTemp,
		          success: function (result) {
			          console.log(result);
		              if(result.code == '200'){
		            	  swal("交易提醒", result.msg, "success");
		            	  setTimeout(function(){location.href = '<?php echo url::s("index/shop/order");?>';},2000);
		              }else{
		            	  swal("交易提醒", result.msg, "error");
		            	  setTimeout(function(){applyRefund(id);},1000);
		              }
		          }
		  		});
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#refundNum').val('1');
	  }

      function cancelRefund(id){
    	  swal({
              title: "取消退款", 
              text: "您是否要取消退款申请?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "确认取消退款", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/shop/cancelRefund',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("交易提醒", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("交易提醒", result.msg, "error");
    	              }
              	  });
            });	
      }

      function receipt(id){
    	  swal({
              title: "确认收货", 
              text: "您确认已经收到商品了吗?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "我已收货", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/shop/receipt',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("交易提醒", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("交易提醒", result.msg, "error");
    	              }
              	  });
            });	
      }

      function order_query(id,title){ 
		  layer.open({
			  type: 2,
			  title: title,
			  shadeClose: true,
			  shade: 0.8,
			  area: ['500px', '760px'],
			  content: '<?php echo url::s('index/shop/logistics','id=');?>' + id
			}); 
	  	}

      function express(id,title){ 
    	  $.get("<?php echo url::s('index/shop/express',"id=");?>" + id, function(result){
		  		if(result.code == '200'){
		  			layer.open({
				  		type: 2,
				  title: title,
				  shadeClose: true,
				  shade: 0.8,
				  area: ['580px', '760px'],
				  content: result.data.url_id
					}); 
			  	}else{
	            	swal("查询提醒", result.msg, "error");
	              }
    	  });
	  	}

     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   