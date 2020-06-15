<?php 
use xh\library\url;
use xh\library\model;
use xh\library\ip;
use xh\unity\in;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>
<link href="<?php echo str_replace("admin", "index", URL_VIEW);?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">服务订单</li>
      </ol>
  </div>
  <!-- End Page Header -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">
    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          交易统计  [ <b>今日交易:</b> <?php //查询今日收入
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $where_call = "pay_time > {$nowTime} and status!=0 and status!=5 and status!=7 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}shop_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money'],2) .' </span> / 下单数量: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] - [ <b>昨日交易:</b> <?php 
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
                        $where_call = "pay_time > {$zrTime} and pay_time<{$nowTime} and status!=0 and status!=5 and status!=7 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}shop_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money'],2) .' </span>   / 下单数量: <span style="color:green;font-weight:bold;">'. intval($order[0]['count']).'</span> ';
                        ?> ] - [ <b>全部交易:</b> <?php 
                        $where_call = "status!=0 and status!=5 and status!=7 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}shop_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money'],2) .' </span>  / 总共下单: <span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> ';
                        ?> ] - [ <b>等待发货:</b> <?php 
                        $where_call = "status=1 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select count(id) as count from {$fix}shop_order where {$where_call}");
                        echo '<span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> 订单';
                        ?> ] - [ <b>等待收货:</b> <?php 
                        $where_call = "status=2 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select count(id) as count from {$fix}shop_order where {$where_call}");
                        echo '<span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> 订单';
                        ?> ] - [ <b>等待退款:</b> <?php 
                        $where_call = "status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select count(id) as count from {$fix}shop_order where {$where_call}");
                        echo '<span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> 订单';
                        ?> ] <?php if (!empty($_SESSION['SHOP']['ORDER']['WHERE'])) echo '- [ <a href="'.url::s("admin/shop/order","sorting=session&code=unset").'" style="color:red;">查看全部交易订单</a> ]';?>
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th><input onchange="serial_no(this);" style="width: 95%;"  type="text" class=" form-control-line" placeholder="查询订单号" value="<?php if ($sorting['name'] == 'serial_no') echo $_GET['code'];?>"></th>
 				<th>商品信息</th>
                <th>
                    收货信息
                </th>
                
                <th>[ <a href="<?php echo url::s("admin/shop/order");?>">全部</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=0");?>" style="color: red;">未支付</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=1");?>" style="color: #4caf50;">已支付</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=2");?>" style="color: #1de9b6;">已发货</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=3");?>" style="color: #e65100;">已收货</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=4");?>" style="color: #039be5;">退款中</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=5");?>" style="color: #64dd17;">退款成功</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=6");?>" style="color: #dd2c00;">退款失败</a> / <a href="<?php echo url::s("admin/shop/order","sorting=status&code=7");?>" style="color: #9e9e9e;">订单已关闭</a> ]</th>
                <th>
                    <input onchange="member(this);" style="width: 90%;"  type="text" class="form-control-line" placeholder="商户ID" value="<?php if ($sorting['name'] == 'user') echo $_GET['code'];?>">
                </th>
                <th>处理时间</th>
                
                <th>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>
                        
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                    </div></th>
              </tr>
            </thead>
            <tbody>
            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="7" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
            
            <?php  foreach ($result['result'] as $ru){ 
                //查询商品
                $shopInfo = $mysql->query("shop","id={$ru['shop_id']}")[0];
                //收货地址
                if ($shopInfo['category'] == 3){
                    $address = json_decode($ru['address'],true);
                }
                ?>
              <tr>
                <td><p>订单号码：<?php echo $ru['serial_no'];?></p>
                 <p>商品类型：<?php if ($shopInfo['category'] == 1) echo '<span style="color:#c0ca33;"><i class="fa fa-group"></i> 用户组</span>';?><?php if ($shopInfo['category'] == 2) echo '<span style="color:#3f51b5;"><i class="fa fa-credit-card"></i> 卡密信息</span>';?><?php if ($shopInfo['category'] == 3) echo '<span style="color:#43a047;"><i class="fa fa-shopping-cart"></i> 商品货物</span>';?></p>
                 </td>
               <td>
                 <p>商品名称：<a href="<?php echo url::s("admin/shop/index","id={$shopInfo['id']}");?>"><?php echo $shopInfo['name'];?></a></p>
                 <p>商品单价：<?php echo $shopInfo['money'];?></p>
                 </td>
               
                 <td>
                 <p> <?php if ($shopInfo['category'] == 3){?>收货信息：<?php echo $address['name'] . ' / ' . $address['phone'];?><?php }else {echo '虚拟物品,无需发货';}?></p>
                 <p><?php if ($shopInfo['category'] == 3){?>收货地址：<span style="color:green;"><?php echo htmlspecialchars($address['address']);?><?php }else {echo '虚拟物品,无需发货';}?></span>
                 </td>
                
                
                <td><p>支付金额：<span style="color: green;"><b><?php echo $ru['amount'];?></b> <?php echo $ru['callback_status'] == 1 ? " ( 利: ". ($ru['amount']-$ru['fees']) ." )" : '';?></p><p></span>
                        支付状态：<?php 
                        //退款原因  
                        $refund_schedule = json_decode($ru['refund_feedback'],true);
                        if ($ru['status'] == 0) {
                            echo '<span style="color:red;">未支付</span>';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#039be5;color:white;" onclick="close_pay(\''.$ru['id'].'\');">关闭交易</button> ]';
                        }
                        if ($ru['status'] == 1) {
                            echo '<span style="color:#4caf50;">已支付</span>';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#f57c00;color:white;" onclick="ship(\''.$ru['id'].'\');">立即发货</button> ]';
                            echo ' <span style="color:ba68c8;">[ 等待发货 ]</span>';
                        }
                        if ($ru['status'] == 2) {
                            echo '<span style="color:#33691e;">等待收货</span>';
                            if ($shopInfo['category'] == 2){
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="order_query(\''.$ru['id'].'\',\'查看卡密信息\');">查看卡密信息</a> ]';
                            }
                            if ($shopInfo['category'] == 3){
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="express(\''.$ru['id'].'\',\'查看物流信息\');">查看物流信息</a> ]';
                                echo ' [ 收货地址：' . $address['address'] . ' / ' . $address['name'] . ' / ' . $address['phone']. ' ]';
                            }
                        }
                        if ($ru['status'] == 3) {
                            echo '<span style="color:#e65100;"><b>已签收</b></span>';
                            if ($shopInfo['category'] == 2){
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="order_query(\''.$ru['id'].'\',\'查看卡密信息\');">查看卡密信息</a> ]';
                            }
                            if ($shopInfo['category'] == 3){
                                echo ' [ <a href="javascript:void(0);" style="color:#424242;" onclick="express(\''.$ru['id'].'\',\'查看物流信息\');">查看物流信息</a> ]';
                                echo ' [ 收货地址：' . $address['address'] . ' / ' . $address['name'] . ' / ' .$address['phone'] . ' ]';
                            }
                        }
                        if ($ru['status'] == 4) {
                            echo '<span style="color:#039be5;"><b>申请退款</b></span>';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#ff5252;color:white;" onclick="refund(\''.$ru['id'].'\');">确认退款('.$ru['refund_amount'].'元)</button> ]';
                            echo ' [ <button type="button" style="border-radius:3px;border:0px;font-size:10px;background:#ff5252;color:white;" onclick="cancelrefund(\''.$ru['id'].'\');">拒绝退款</button> ]';
                            echo ' <span style="color:#9e9e9e;">[ 原因：'.$refund_schedule['reason'] .' ]' . ' ( 提交时间：' . date("Y/m/d h:i:s",$refund_schedule['time']) . ' ) </span>';
                        }
                        if ($ru['status'] == 5) echo '<span style="color:#64dd17;"><b>已退款</b></span>';
                        if ($ru['status'] == 6) echo '<span style="color:#dd2c00;"><b>拒绝退款</b></span>';
                        if ($ru['status'] == 7) echo '<span style="color:#9e9e9e;"><b>订单已关闭</b></span>';
                        
                        ?> </p>
                        </td>
                   
                        <td><p>商户信息：<?php $userInfo = $mysql->query("client_user","id={$ru['user_id']}")[0]; echo is_array($userInfo) ? '<a href="'. url::s("admin/shop/order","sorting=user&code={$userInfo[id]}") .'"><span style="color:green;font-size:14px;font-weight:bold;">'.$userInfo['username'] .'</span></a>' . ' ( 商户ID: ' .  $userInfo['id']  . ' ) ' : '<span style="color:red;font-size:8px;">系统账户</span>';?></p>
                        <p>手机号码：<span style="color:green;"><?php echo is_array($userInfo) ? $userInfo['phone'] : '无';?></span></p>
                        </td>
                        
                         <td>
                       <p>创建时间：<?php echo date("Y/m/d H:i:s",$ru['add_time']);?></p>
                       <p>支付时间：<?php echo $ru['pay_time'] != 0 ? date("Y/m/d H:i:s",$ru['pay_time']) : '无信息';?></p>
                        </td>
                        
                  
                       
                <td>
                <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                            勾选订单!
                        </label>
                    </div></p>
                <p><a href="#" onclick="del('<?php echo $ru['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除该订单</a></p>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>
          
        </div>

      </div>
    </div>
    <!-- End Panel -->
    
            
            <script type="text/javascript">

            function reissue(id){
            	  swal({   title: "订单通知",   
                      text: "手动补发也是需要扣除手续费,您是否要继续?",   
                      type: "info",   showCancelButton: true,   
                      closeOnConfirm: false,   
                      showLoaderOnConfirm: true,
                      confirmButtonText: "是的,我愿意承担手续费!"
                       }, 
                      function(){
                      //开始请求支付宝登录
                    	   $.get("<?php echo url::s('admin/alipay/automaticReissue',"id=");?>" + id, function(result){
                          	 if(result.code == '200'){
                           			swal("支付宝提示", result.msg, "success");
            	              		setTimeout(function(){location.href = '';},1000);
                	              }else{
                	            	swal("订单通知", result.msg, "error");
                	             }
                      		});
                          
                 });
              }

              function serial_no(obj){
                  location.href = "<?php echo url::s('admin/shop/order',"sorting=serial_no&code=");?>" + $(obj).val();
                  }

              function member(obj){
                  location.href = "<?php echo url::s('admin/shop/order',"sorting=user&code=");?>" + $(obj).val();
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
                       $.get("<?php echo url::s('admin/shop/closeBuy',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("交易提醒", result.msg, "success");
            	              	setTimeout(function(){location.href = '<?php echo url::s("admin/shop/order");?>';},1000);
            	              }else{
            	            	swal("交易提醒", result.msg, "error");
            	              }
                      	  });
                    });	
              }


				//发货
              function ship(id){
        		  swal({
        		      title: "确认发货",
        		      text: "请输入快递运单号<input type='text' id='waybill'>"
        		      +"请输入快递代码<input type='text' id='courierCode'>",
        		      showCancelButton: true,     
                      closeOnConfirm: false, 
        		      html: true,
                      confirmButtonText: "确认发货" , 
                      cancelButtonText: "取消",
        		      type: "input",
        		  }, function(){
        			  var dataTemp = {
        					  id: id,
        					  waybill: $('#waybill').val(),
        					  courierCode: $('#courierCode').val()
        					};
        				console.log(dataTemp);
        			  $.ajax({
        		          type: "POST",
        		          dataType: "json",
        		          url: "<?php echo url::s('admin/shop/ship');?>",
        		          data: dataTemp,
        		          success: function (result) {
        			          console.log(result);
        		              if(result.code == '200'){
        		            	  swal("交易提醒", result.msg, "success");
        		            	  setTimeout(function(){location.href = '<?php echo url::s("admin/shop/order");?>';},1000);
        		              }else{
        		            	  swal("交易提醒", result.msg, "error");
        		            	  setTimeout(function(){applyRefund(id);},1000);
        		              }
        		          }
        		  		});
        		      })
        		 
        		 $('.showSweetAlert fieldset input').attr('type','hidden');
        		 $('#courierCode').val('shunfeng');
        	  }

				//卡密查询
              function order_query(id,title){ 
        		  layer.open({
        			  type: 2,
        			  title: title,
        			  shadeClose: true,
        			  shade: 0.8,
        			  area: ['500px', '760px'],
        			  content: '<?php echo url::s('admin/shop/logistics','id=');?>' + id
        			}); 
        	  	}

              function express(id,title){ 
            	  $.get("<?php echo url::s('admin/shop/express',"id=");?>" + id, function(result){
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

        	  	
             function refund(id){
	              swal({
	                title: "确认退款", 
	                text: "你是否要确认退款给该用户，退款后款项会直接到达用户盈利余额？", 
	                type: "warning", 
	                showCancelButton: true, 
	                confirmButtonColor: "#DD6B55", 
	                confirmButtonText: "确认退款!", 
	                closeOnConfirm: false 
	              },
	              function(){
	                 $.get("<?php echo url::s('admin/shop/refund','id=');?>" + id, function(result){
	                	 if(result.code == '200'){
			            	swal("交易提醒", result.msg, "success");
			              	setTimeout(function(){location.href = '';},1500);
			              }else{
			            	swal("交易提醒", result.msg, "error");
			              }
	                	  });
	              });		
		}

          	//拒绝
             function cancelrefund(id){
          		  swal({   title: "拒绝退款",   
                        text: "是否拒绝该退款申请，拒绝后商户无法再次申请退款。",   
                        type: "input", 
                        showCancelButton: true,   
                        closeOnConfirm: false,   
                        animation: "slide-from-top",   
                        inputPlaceholder: "请输入拒绝理由",
                        confirmButtonText: "确认拒绝" }, 
                        function(inputValue){   
                            if (inputValue === false) return false;      
                            if (inputValue === "") {     
                            swal.showInputError("请输入拒绝理由");     
                            return false   
                            }
                       $.get("<?php echo url::s('admin/shop/cancelRefund',"reason=");?>" + inputValue + "&id=" + id, function(result){
                        	 if(result.code == '200'){
                         		swal("交易提醒", result.msg, "success");
              	              	setTimeout(function(){window.open(url)},1000);
              	              }else{
              	            	swal.showInputError(result.msg);
              	             }
                    		});
                   });
          	  }

              
			function del(id){
		              swal({
		                title: "交易提醒", 
		                text: "你确定要删除该订单吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除该订单!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/shop/del','id=');?>" + id, function(result){

		                	 if(result.code == '200'){
				            	swal("操作提示", result.msg, "success");
				              	setTimeout(function(){location.href = '';},1000);
				              }else{
				            	  swal("操作提示", result.msg, "error");
				              }
		                	  });

						  
		              });		
			}


			function deletes(){ 
		           swal({
		                title: "非常危险", 
		                text: "你确定要批量删除已选中的订单吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些订单!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/shop/del','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '';},1500);
				                	  });
				           });  
						  
		              });
		           
				}


			





			function showBtn(){
				var Inc = 0;
				$("input[name='items']:checkbox").each(function(){
                    if(this.checked){
                    	$('#deletes').show();
                    
                    	return true;
                    }
                    Inc++;
              });
	              if($("input[name='items']:checkbox").length == Inc){
	            	  $('#deletes').hide();
	            	 
		          }
			}

            </script>
            

<!-- End Moda Code -->


 
  </div>
  <!-- End Row -->
  
</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<?php include_once (PATH_VIEW . 'common/footer.php');?>

</div>
<!-- End Content -->

<?php include_once (PATH_VIEW . 'common/chat.php');?>

<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/plugins.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script type="text/javascript" src="<?php echo str_replace("admin", 'index', URL_VIEW);?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>  
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>
<!-- layer -->
<script src="<?php echo URL_STATIC . 'js/layer/layer.js';?>" charset="utf-8"></script>
<script>


$(function(){
       //实现全选与反选  
       $("#checkboxAll").click(function() {
           if (this.checked){
               $("input[name='items']:checkbox").each(function(){   
                     $(this).prop("checked", true);
               });
               showBtn();
           } else {     
               $("input[name='items']:checkbox").each(function() {     
                     $(this).prop("checked", false);    
               });
               showBtn();
           }   
       });  
   });  
</script>

</body>
</html>