<?php
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>
<link href="<?php echo str_replace("admin", 'index', URL_VIEW);?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">用户提现</li>
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
          提现记录 <span style="font-size: 15px;margin-left:20px;">[ 所有用户总提现金额: <?php //查询全部提现 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_withdraw where types=2");
                        echo '<span style="font-weight:bold;font-size:20px;color:red;"> '.floatval($order[0]['money']) .' </span> / 总提现笔数: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] </span>   
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>
                    <input onchange="flow_no(this);" style="width: 80%;"  type="text" class="form-control form-control-line" placeholder="订单号" value="<?php if ($sorting['name'] == 'flow_no') echo $_GET['code'];?>">
                </th>
                <th>用户信息</th>
                <th>金额</th>
                        <th>银行状态 [ <a href="<?php echo url::s("admin/member/withdraw","sorting=type&code=1");?>">未处理</a> / <a href="<?php echo url::s("admin/member/withdraw");?>">全部</a> ]</th>
                        <th>提现时间</th>
                        <th>打款信息</th>
                <td>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>
                        
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                    </div></td>
              </tr>
            </thead>
            <tbody>
            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="6" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
            
            <?php  foreach ($result['result'] as $ru){ $find_user = $mysql->query("client_user","id={$ru['user_id']}")[0];?>
              <tr>
               
                 <td><p>流水单号：<?php echo $ru['flow_no'];?></p>
                     <p>余额变更：提现前余额 ( <?php echo $ru['old_amount'];?> ) / 提现后余额 ( <?php echo $ru['new_amount'];?> )  </p>
                        </td>
                        
                        <td><p>用户名：<a href="<?php echo url::s("admin/member/index.do","member_id={$ru['user_id']}");?>"><?php $user = $mysql->query("client_user","id={$ru['user_id']}")[0]; echo $user['username'];?></a></p>
                     <p>手机号：<?php echo $user['phone'];?>  </p>
                        </td>
                
                
                <td><p>提现金额：<span style="color: green;"><?php echo $ru['amount'];?> ( 实际打款 : <b style="color:red;"><?php echo $ru['amount']-$ru['fees'];?></b> )</span></p>
                    <p>手续费用：<b><?php echo $ru['fees'];?></b></p>
                        </td>
                        
                        
                         <td>
                        <p>银行信息：<?php echo $ru['content'];?></p>
                        <p>提现状态：<?php 
                        if ($ru['types'] == 1) echo '<span style="color:#039be5;">等待管理员处理..</span>';
                        if ($ru['types'] == 2) echo '<span style="color:green;">已经处理</span>';
                        if ($ru['types'] == 3) echo '<span style="color:#bdbdbd;">已驳回该提现</span>';
                        if ($ru['types'] == 4) echo '<span style="color:red;">该流水异常</span>';
                        ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s",$ru['pay_time']) . ')';?></p>
                        </td>
                        
                        <td><p>提交时间：<?php echo date("Y/m/d H:i:s",$ru['apply_time']);?></p>
                        <p>处理时间：<?php if ($ru['deal_time'] != 0) {echo date("Y/m/d H:i:s",$ru['deal_time']);}else {echo '等待处理中';}?></p></td>
                        
                        <td><?php if ($ru['types'] == 1){?><p>
                        <?php //查询收款人信息
                        $bank = json_decode($find_user['bank'],true);
                        if ($bank['type'] == 1) echo '支付宝账号：<b style="color:red;font-size:15px;">' . $bank['card'] . '</b> / 姓名：<b style="color:green;font-size:15px;">' . $bank['name'] . '</b>'; //支付宝
                        if ($bank['type'] == 2) echo '银行卡号：<b style="color:red;font-size:15px;">' . $bank['card'] . '</b> / 姓名：<b style="color:green;font-size:15px;">' . $bank['name'] . '</b> / 银行：<b>' . $bank['bank'] .'</b>'; //支付宝
                        ?></p>
                        <p>请给该账户打款：<b style="font-size: 15px;color:red;"><?php echo $ru['amount']-$ru['fees'];?></b> 元</p>
                        
                        <?php }else {echo '已经处理';}?></td>
                        
                        
                        <td> 
                <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                            勾选订单!
                        </label>
                    </div></p>
                <p><?php if ($ru['types'] == 1){?><a href="#" onclick="ok('<?php echo $ru['id'];?>')" class="btn btn-success btn-xs"><i class="fa fa-user-md"></i>确认</a>  <a href="#" onclick="turnDown('<?php echo $ru['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-reply-all"></i>驳回</a>  <a href="#" onclick="error('<?php echo $ru['id'];?>')" class="btn btn-warning btn-xs"><i class="fa fa-close"></i>异常</a><?php }else {echo '已经处理';}?></p>
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

              function ok(id){
            
      		           swal({
      		                title: "确认打款", 
      		                text: "你确认已经为该提现订单打过款了吗？", 
      		                type: "warning", 
      		                showCancelButton: true, 
      		                confirmButtonColor: "#DD6B55", 
      		                confirmButtonText: "我已打款!", 
      		                closeOnConfirm: false 
      		              },
      		              function(){
        				         $.get("<?php echo url::s('admin/member/updateWithdraw',"type=2&id=");?>" + id, function(result){
          	                      	 if(result.code == '200'){
          	                       		    swal("操作提醒", result.msg, "success");
          	            	              	setTimeout(function(){location.href = '';},1000);
          	            	              }else{
          	            	            	swal.showInputError(result.msg);     
          	            	             }
          	                  		});
      						  
      		              });
      			
                  }

              function turnDown(id){
            	  swal({   title: "驳回确认",   
                      text: "请输入驳回信息反馈给用户:",   
                      type: "input",   showCancelButton: true,   
                      closeOnConfirm: false,   
                      animation: "slide-from-top",   
                      inputPlaceholder: "驳回信息",
                      confirmButtonText: "驳回" }, 
                      function(inputValue){   
                          if (inputValue === false) return false;      
                          if (inputValue === "") {     
                          swal.showInputError("请输入驳回信息!");     
                          return false   
                          }
                     $.get("<?php echo url::s('admin/member/updateWithdraw',"type=3&id=");?>" + id + "&msg=" + inputValue, function(result){
                      	 if(result.code == '200'){
                       		    swal("驳回提醒", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal.showInputError(result.msg);     
            	             }
                  		});
                 });
        		  $('.showSweetAlert input').val('您的收款账号有误,钱款已经退回至您的账户,请更新收款账户后重新提现!');
                  }

              function error(id){
            	  swal({   title: "异常确认",   
                      text: "请输入异常信息反馈给用户:",   
                      type: "input",   showCancelButton: true,   
                      closeOnConfirm: false,   
                      animation: "slide-from-top",   
                      inputPlaceholder: "异常信息",
                      confirmButtonText: "异常该提现" }, 
                      function(inputValue){   
                          if (inputValue === false) return false;      
                          if (inputValue === "") {     
                          swal.showInputError("请输入异常信息!");     
                          return false   
                          }
                     $.get("<?php echo url::s('admin/member/updateWithdraw',"type=4&id=");?>" + id + "&msg=" + inputValue, function(result){
                      	 if(result.code == '200'){
                       		    swal("操作提醒", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal.showInputError(result.msg);     
            	             }
                  		});
                 });
        		  $('.showSweetAlert input').val('当前提现资金来源异常,暂时冻结该款项,如有疑问,请联系客服!');
                  }
              
              

              function flow_no(obj){
                  location.href = "<?php echo url::s('admin/member/withdraw',"sorting=flow_no&code=");?>" + $(obj).val();
                  }

              function wechat(){
                  var wechat = $('#wechat').val();
                  console.log(wechat);
                  location.href = "<?php echo url::s('admin/alipay/automaticOrder',"sorting=alipay&code=");?>" + wechat;
                  
                  }



			function deletes(){ 
		           swal({
		                title: "非常危险", 
		                text: "你确定要批量删除已选中的记录吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些记录!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/member/deleteWithdraw','id=');?>" + $(this).val(), function(result){
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
<script type="text/javascript" src="<?php echo str_replace('admin', 'index', URL_VIEW);?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>  
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