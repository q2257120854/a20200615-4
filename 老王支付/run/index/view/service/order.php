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
                <h5 class="breadcrumbs-title">我的服务订单</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">我的服务</a></li>
                    <li class="active">订单列表</li>
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
           <!-- <a href="<?php echo url::s("index/alipay/automatic");?>" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left" style="width: 10px;"></i>支付宝列表</a> --> 
            <span style="font-size: 15px;margin-left:20px;">[ <b>今日收入:</b> <?php //查询今日收入 
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $where_call = "creation_time > {$nowTime} and status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where {$where_call}");
                        
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money']-$order[0]['fees'],3) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  / 订单数量: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] - [ <b>昨日收入:</b> <?php 
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
                        $where_call = "creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money']-$order[0]['fees'],3) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  / 订单数量: <span style="color:green;font-weight:bold;">'. intval($order[0]['count']).'</span> ';
                        ?> ] - [ <b>全部收入:</b> <?php 
                        $where_call = "status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.number_format($order[0]['money']-$order[0]['fees'],3) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  / 订单数量: <span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> ';
                        ?>  ] </span>
            </p>
            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                    <tr>
                        <form action="" method="get">
                            <th>开始时间: <input type="" style="width:160px" id="start_time" name="start_time" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>"></th>
                            <th>结束时间： <input type="" style="width:160px" id="end_time" name="end_time" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>"></th>
                            <th>订单号: <input type="text" name="code" style="width:110px;height: 35px" value="<?php if(!empty($_GET['user_id'])){  echo $_GET['user_id']; }?>"></th>
                            <input type="hidden" name="sorting" value="trade_no">
                            <th><input style="
                                background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;" type="submit" value="查询"></th>
                        </form>
                    </tr>
                      <tr>
                     	<th>
                     	
                  <div class="input-field col s6" style="font-weight:normal;width:100%;">
                    <select multiple id="service" >
                      <option value="" disabled selected>选择通道</option>
                      <?php  $gateway = json_decode($_SESSION['MEMBER']['group']['authority'],true)['service_auto']['gateway']; $gateway_count = count($gateway);
                      for ($i=0;$i<$gateway_count;$i++){ 
                        //查询通道信息
                          $find_service = $mysql->query("service_account","id={$gateway[$i]}")[0];
                          ?>
                      <option value="<?php echo $find_service['id'];?>" ><?php echo $find_service['id'];?></option>
                      <?php }?>
                    </select>
                  </div>
                
                     	</th>
                        <th>支付信息 <?php if ($sorting['code'] != 0 && $sorting['name'] == 'status'){?>(<?php if ($sorting['code'] == 1) echo '获取订单中';if ($sorting['code'] == 2) echo '未支付';if ($sorting['code'] == 3) echo '订单超时';if ($sorting['code'] == 4) echo '已支付';?>)<?php }?><a href='<?php echo url::s('index/service/order',"sorting=status&code=".($sorting['code']+1));?>'><i class="mdi-image-healing"></i></a></th>
                        <th>异步通知 <?php if ($sorting['code'] != -1 && $sorting['name'] == 'callback'){?>(<?php if ($_GET['code'] == 0) echo '未回调';if ($_GET['code'] == 1) echo '已回调';?>)<?php }?><a href='<?php echo url::s('index/service/order',"sorting=callback&code=".($sorting['code']+1));?>'><i class="mdi-image-healing"></i></a></th>
                        <th>回调信息 [ 回调测试: <a href="#" onclick="robinTest(13);">支付宝固码</a>]</th>
            
                                        <label> [ <a href="<?php echo url::s('index/service/order',"sorting=gateway&code=all");?>">全部</a> / <a href="<?php echo url::s('index/service/order',"sorting=gateway&code=alipaygm");?>">支付宝固码</a>] <?php if ($_SESSION['SERVICE']['ORDER']['WHERE'] == ''){?>(<a href="#" onclick="service();">开始查询</a>)<?php }else{?>(<a href="<?php echo url::s('index/service/order',"sorting=service&code=closed");?>">取消</a>)<?php }?></label>

                        <th style="
                                background-color: red; /* Green */
    border: none;
    color: white;
    padding: 10px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;" onclick="exportData()">
                              导出
                          </th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
                    
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td>支付类型：<?php if ($ru['types'] == 1) echo '<b style="color:green;">微信</b>';?><?php if ($ru['types'] == 2) echo '<b style="color:red;">支付宝</b>';?><?php if ($ru['types'] == 3) echo '<b style="color:red;">银行转账</b>';?><?php if ($ru['types'] == 4) echo '<b style="color:red;">拉卡拉</b>';?><?php if ($ru['types'] == 5) echo '<b style="color:red;">云闪付</b>';?><?php if ($ru['types'] == 6) echo '<b style="color:red;">农信微信</b>';?><?php if ($ru['types'] == 7) echo '<b style="color:red;">农信支付宝</b>';?><?php if ($ru['types'] == 8) echo '<b style="color:red;">农信银联</b>';?> / 订单ID：<?php echo $ru['id'];?> ( <a target="_blank" href="<?php echo url::s('gateway/pay/service',"id={$ru['id']}");?>">支付链接</a> )
                        <br>创建时间：<?php echo date('Y/m/d H:i:s',$ru['creation_time']);?>
                        </td>
                        
                         <td>系统订单号码：<?php echo $ru['trade_no'];?></br>
                      外部订单号码：<?php echo $ru['out_trade_no'];?>
                        <br>订单信息：<span style="color:green;"><?php echo htmlspecialchars($ru['out_trade_no']);?></span>
                        </td>
                        
                        <td>支付金额：<span style="color: green;"><b><?php echo $ru['amount'];?></b> <?php echo $ru['callback_status'] == 1 ? " ( 利: ". ($ru['amount']-$ru['fees']) ." )" : '';?></span>
                        <br>支付状态：<?php 
                        if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                        if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                        if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                        if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                        ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s",$ru['pay_time']) . ')';?>
                        </td>
                        
                        <td>
                        <b>异步通知时间：</b> <?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s',$ru['callback_time']) : '无信息';?><br>
                        <b>异步通知状态：</b> <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>';?><br>
                        </td>
                        
                        <td>单笔接口费用：<?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '暂无信息';?>
                        <br>接口返回信息：<span style="color:green;"><?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调';?></span>
                        
                       
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
        <script type="text/javascript" src="<?php echo URL_ROOT;?>/static/js/laydate/laydate.js"></script>

      <!-- END CONTENT -->
      <script type="text/javascript">
      function trade_no(obj){
          location.href = "<?php echo url::s('index/service/order',"sorting=trade_no&code=");?>" + $(obj).val();
          }

      laydate.render({
          elem: '#start_time',
          type: 'datetime'
          ,done: function(value, date, endDate){
              console.log(value); //得到日期生成的值，如：2017-08-18
              console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
              console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
          }
      });
      laydate.render({
          elem: '#end_time',
          type: 'datetime'
          ,done: function(value, date, endDate){
              console.log(value); //得到日期生成的值，如：2017-08-18
              console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
              console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
          }
      });
      function service(){
          var service = $('#service').val();
          location.href = "<?php echo url::s('index/service/order',"sorting=service&code=");?>" + service;
          }
      function exportData () {
          var code = GetQueryString('code');
          var start_time = GetQueryString('start_time');
          var end_time = GetQueryString('end_time');
          location.href = "<?php echo url::s('index/service/export', "sorting=trade_no&start_time=");?>" + start_time + '&end_time=' + end_time + '&code=' + code;
      }
      function GetQueryString(name)
      {
          var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
          var r = window.location.search.substr(1).match(reg);
          if(r!=null)return  unescape(r[2]); return null;
      }
      function robinTest(type){
		  swal({
		      title: "通道测试",
		      text: "请输入要测试支付的金额<input type='text' id='amount' value='1.00'>"
		      +"请输入要接收异步通知的回调url<input type='text' id='callback_url'>",showCancelButton: true,   
		      html: true,
              confirmButtonText: "确认测试" , 
		      type: "prompt",
		  }, function(){

		       window.open('<?php echo url::s("index/service/robinTest");?>' + '?amount=' + $('#amount').val() + '&callback_url=' + $('#callback_url').val() + "&type=" + type);
			   location.href='';
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#amount').val('1.00');
		 $('#callback_url').val('<?php echo URL_ROOT; ?>/index/index/callback.do');
	  }

     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   