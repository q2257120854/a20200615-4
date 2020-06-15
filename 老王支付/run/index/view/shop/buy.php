<?php
use xh\unity\cog;
use xh\library\url;
use xh\unity\dictionary;
$fix = DB_PREFIX;
//收货信息
$suc = json_decode($_COOKIE['FULL_INFO'],true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="<?php echo cog::web()['description'];?>">
    <meta name="keywords" content="<?php echo cog::web()['keywords'];?>">
    <title>Fast payment platform - <?php echo cog::web()['name'];?></title>
    <!-- CORE CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
<body>
    <!-- START CONTENT -->
      <section id="content">


        <!--start container-->
        <div class="container">

                <div class="col s12 m12 l12" style="margin-top: 8px;">
                  <div class="row">
                    <form class="col s12" id="from" method="post" action="<?php echo url::s("index/shop/pay");?>" target="_blank">
     				<input name="id" value="<?php echo $result['id'];?>" type="hidden">
     				<?php if ($result['category'] == 1){?>
                      
                      <div class="row">
                        <div class="input-field col s6">
                          <input disabled value="<?php echo $result['name'];?>" id="disabled" type="text" class="validate" style="color:#e65100;">
                          <label for="disabled" style="color:green;">您当前要购买的用户组为</label>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s6">
                          <input disabled value="<?php echo $result['money'];?> 元" id="disabled" type="text" class="validate" style="color:red;">
                          <label for="disabled" style="color:green;">当前用户组购买价格为</label>
                        </div>
                      </div>
                     
                     <?php }?>
                     
                     
                     <?php if ($result['category'] == 2){  
                     //库存计算
                         $stock = $mysql->select("select count(id) as count from {$fix}shop_card where shop_id={$result['id']} and status=0")[0]['count'];
                         
                         ?>
                     <div class="row">
                        <div class="input-field col s8">
                          <input disabled value="<?php echo $result['name'];?>" id="disabled" type="text" class="validate" style="color:#e65100;">
                          <label for="disabled" style="color:green;">您当前需购买的卡密为</label>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="input-field col s8">
                          <input disabled value="<?php echo $result['money'];?> 元 / 个" id="disabled" type="text" class="validate" style="color:red;">
                          <label for="disabled" style="color:green;">当前卡密单价为</label>
                        </div>
                      </div>
                      
                  	  <div class="row">
                         <div class="input-field col s8">
                          <input id="num" name="num" type="text" class="validate" value="1">
                          <label for="num" style="color:green;">购买数量 ( 限购：<?php echo $result['restriction'] == 0 ? '不限' : $result['restriction'];?> / <?php echo '剩余库存：' . $stock;?> )</label>
                        </div>
                      </div>
                      
                      
                     <?php }?>
                     
                     
                     
                     <?php if ($result['category'] == 3){?>
                     
                     
                     <div class="row">
                        <div class="input-field col s8">
                          <input disabled value="<?php echo $result['name'];?>" id="disabled" type="text" class="validate" style="color:#e65100;">
                          <label for="disabled" style="color:green;">商品名称</label>
                        </div>
                      </div>
                      
                      <div class="row">
                         <div class="input-field col s8">
                          <input id="num" name="num" type="text" class="validate" value="1">
                          <label for="num" style="color:green;">购买数量 ( 限购：<?php echo $result['restriction'] == 0 ? '不限' : $result['restriction'];?> / <?php echo '剩余库存：<b style="color:red;">' . $result['warehouse'] . '</b>';?> )</label>
                        </div>
                      </div>
                      
                      <div class="row">
                         <div class="input-field col s8">
                          <input id="full_name" name="full_name" type="text" class="validate" value="<?php echo $suc['full_name'];?>" placeholder="请输入收货人姓名">
                          <label for="full_name" style="color:green;">收货人姓名</label>
                        </div>
                      </div>
                      
                     <div class="row">
                         <div class="input-field col s8">
                          <input id="phone" name="phone" type="text" class="validate" value="<?php echo $suc['phone'];?>" placeholder="请输入收货人手机号">
                          <label for="phone" style="color:green;">收货人手机号</label>
                        </div>
                      </div>
                      
                      <div class="row">
                         <div class="input-field col s8">
                          <input id="address" name="address" type="text" class="validate" value="<?php echo $suc['address'];?>" placeholder="请输入收货地址">
                          <label for="address" style="color:green;">收货地址（详细到门牌号）</label>
                        </div>
                      </div>
                     <?php }?>
                     
                     
                     <?php if ($result['discount'] != '0'){
                     //卡密、商品货物类折扣显示
                         ?>
                      <div class="row">
                        <div class="input-field col s8" style="padding-top:-5px;padding-bottom:15px;">
                          	<?php 
                          	echo '购买数量: <span style="color:green;font-weight:bold;">1</span> 个起 <span style="color:red;font-weight:bold;">' . number_format($result['money'],2) . ' </span>元/单价<br>';
                          	$discount = json_decode($result['discount'],true);
                          	foreach ($discount as $dc){
                          	    echo '购买数量: <span style="color:green;font-weight:bold;">' .$dc['num'] . '</span> 个起 <span style="color:red;font-weight:bold;">' . number_format($dc['money'],2) . ' </span>元/单价<br>';
                          	}
                          	?>
                        </div>
                      </div>
                     <?php }?>
                     
                     <?php if ($result['category'] == 1){ ?>
                     <div class="row">
                        <div class="input-field col s8" style="padding-top:-5px;padding-bottom:20px;">
                         <?php //查询用户组
                         $groupc = $mysql->query("client_group","id={$result['bind_special']}")[0];
                         if (is_array($groupc)){
                             $authority = json_decode($groupc['authority'],true);
                             if (is_array($authority)){
                                 foreach ($authority as $key => $value){
                                     echo $rc = dictionary::userModule($key, $value['open'], $value['cost'], $value['quantity'],$value['gateway']);
                                     if ($rc) echo '<br>';
                                 }
                             }else{
                                 echo '该商品有损坏,请勿购买';
                             }
                             
                         }else{
                             echo '该商品有损坏,请勿购买';
                         }?>
                    </div>
                      </div>
                   <?php }?>
                     
                      
                   <div class="row" id="input-select">
                       <div class="input-field col s6">
                       <label style="color:green;">支付方式</label>
                   		<select id="type" name="pay_type">
                     		 <option value="" disabled selected>请选择一个支付方式</option>
                      		 <option value="1" selected>微信支付</option>
                      		 <option value="2">支付宝支付</option>
                      		 <option value="3">余额（¥<?php echo $_SESSION['MEMBER']['balance'];?>）</option>
                      		 <option value="4">盈利余额（¥<?php echo $_SESSION['MEMBER']['money'];?>）</option>
                    	</select>
                  		</div>
                  </div>
                      
           
                       <div class="row"><div class="input-field col s4">
                       <button type="button" class="btn waves-effect waves-light teal" onclick="payc(this);">确认下单</button></div>
                      
                       </div>

                    </form>

                  </div>
                </div>

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
      <script>
		function payc(obj){
			$(obj).attr('disabled',true);
			$(obj).text('请稍等..');
			setTimeout(function(){$(obj).attr('type','submit');$(obj).addClass('green');$(obj).attr('disabled',false);$(obj).text('立即支付');$(obj).attr('onclick','');},1200)
		}
      </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   