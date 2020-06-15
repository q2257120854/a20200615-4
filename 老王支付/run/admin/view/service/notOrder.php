<?php 
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">无匹配服务订单</li>
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
          交易订单  [ <b>今日收入:</b> <?php //查询今日收入
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $where_call = "creation_time > {$nowTime} and status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  / 订单数量: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] - [ <b>昨日收入:</b> <?php 
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
                        $where_call = "creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  / 订单数量: <span style="color:green;font-weight:bold;">'. intval($order[0]['count']).'</span> ';
                        ?> ] - [ <b>全部收入:</b> <?php 
                        $where_call = "status=4 and " . $where;
                        $where_call = trim(trim($where_call),'and');
                        
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  / 订单数量: <span style="color:green;font-weight:bold;">'. floatval($order[0]['count']) .'</span> ';
                        ?> ] 
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
            <tr>
                <button style="
                                background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;" onclick="exportDoc()">导出表格</button>
            </tr>
            <tr>
                <form action="" method="get">
                    <th>开始时间: <input type="" style="width:160px" name="start_time" id="start_time" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>"></th>
                    <th>结束时间： <input type="" style="width:160px" name="end_time" id="end_time" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>"></th>
                    <th></th>
                    <input type="hidden" name="sorting" value="trade_no">
                    <th><input style="
                                background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    line-height: 14px;
    font-size: 14px;" type="submit" value="查询"></th>
                </form>
            </tr>
              <tr>
                <td>金额</td>
                <th>支付时间</th>
                <th>
                   支付账户
                </th>
                <th>手续费</th>
                <td>操作 <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>

                       <!-- <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>-->
                        <button type="button" id="callback" onclick="callback();" class="btn btn-success btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>回调</button>
                    </div></td>
              </tr>
            </thead>
            <tbody>
            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="6" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
            
            <?php  foreach ($result['result'] as $ru){ ?>
              <tr>
                  <td><?php echo $ru['amount_true'];?></td>
                  <td><?php echo date('Y-m-d H:i:s',$ru['time']);?></td>
                  <td><?php echo $ru['bank_acount'];?></td>
                  <td><?php echo $ru['status'] == 1 ? $ru['fees'] : '暂无信息';?></td>
                  <td>

                      <p>
                      <?php if($ru['status'] == 1){?>
                          <span style="color:green;"> 已补发</span>
                      <?php }else{?>
                      <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                          <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                          <label for="checkbox<?php echo $ru['id'];?>">
                              补单勾选订单!
                          </label>
                      </div></p>
                      <?php }?>
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

      <script type="text/javascript" src="<?php echo URL_ROOT;?>/static/js/laydate/laydate.js"></script>

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
            function GetQueryString(name)
            {
                var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if(r!=null)return  unescape(r[2]); return null;
            }
            function exportDoc () {
                var code = GetQueryString('code');
                var start_time = GetQueryString('start_time');
                var end_time = GetQueryString('end_time');
                location.href = "<?php echo url::s('admin/service/export', "code=");?>" + code+ '&start_time='+start_time + '&end_time=' + end_time + '&sorting=trade_no';
            }
              function trade_no(obj){
                  location.href = "<?php echo url::s('admin/service/order',"sorting=trade_no&code=");?>" + $(obj).val();
                  }

              function member(obj){
                  location.href = "<?php echo url::s('admin/service/order',"sorting=user&code=");?>" + $(obj).val();
                  }

              function wechat(){
                  var wechat = $('#wechat').val();
                  console.log(wechat);
                  location.href = "<?php echo url::s('admin/service/order',"sorting=alipay&code=");?>" + wechat;
                  
                  }
           
			function del(id){
		              swal({
		                title: "支付宝提醒", 
		                text: "你确定要删除该订单吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除该订单!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/service/orderDelete','id=');?>" + id, function(result){

		                	 if(result.code == '200'){
				            	swal("操作提示", result.msg, "success");
				              	setTimeout(function(){location.href = '';},1500);
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
				        	 $.get("<?php echo url::s('admin/service/orderDelete','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '';},1500);
				                	  });
				           });  
						  
		              });
		           
				}


			function callback(){ 
		           swal({
		                title: "危险操作", 
		                text: "你确定你要以管理员的方式回调已勾选过的订单？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要帮助这些订单回调!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/service/callbackNo','id=');?>" + $(this).val(), function(result){
				        	     console.log(result);
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '';},1000);
				               });
				           });  
						  
		              });
		           
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
			function showBtn(){
				var Inc = 0;
				$("input[name='items']:checkbox").each(function(){
                    if(this.checked){
                    	$('#deletes').show();
                    	$('#callback').show();
                    	return true;
                    }
                    Inc++;
              });
	              if($("input[name='items']:checkbox").length == Inc){
	            	  $('#deletes').hide();
	            	  $('#callback').hide();
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
<script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>

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