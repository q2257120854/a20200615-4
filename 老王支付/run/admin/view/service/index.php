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
        <li class="active">服务账号管理</li>
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
     	 <div class="panel-title" >

             <button type="button" onclick="addalipaygm();" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> 新增支付宝固码</button>
       



             </p>
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <td>设备信息  <br>[ <a href="<?php echo url::s('admin/service/index','sorting=type&code=go');?>">全部</a> / <a href="<?php echo url::s('admin/service/index','sorting=type&code=13');?>">支付宝固码</a> ]</td>
                
                 <th>当天最大收款</th>
                 <th>网关</th>
                <td>收款</td>
                <td>类型</td>
             
                <td>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>

                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>

                    </div></td>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($result['result'] as $ru){?>
              <tr>
                <td>
                 
                  
                   APP唯一登录商户号： <?php echo $ru['app_user']?>
                      [ <a href="#" onclick="editAppuser('<?php echo $ru['id'];?>');">修改</a> ]
                  
                    <p><b id="a_name">设备ID：<?php echo $ru['id'];?> . <?php echo (new model())->load('service', 'types')->get($ru['types']);?> <br/> ( <a href="<?php echo url::s('admin/service/order',"sorting=service&code={$ru['id']}");?>">交易订单</a> )</p>
                  备注: <?php echo $ru['name'] ;?> </br>
                  <?php if($ru['types'] == '1'){ ?>
                        二维码链接 : <?php echo $ru['ewmurl'] ;?> 
                       
                         <?php }else if($ru['types'] == '2'){ ?> 
                         <br>支付宝账号: <?php echo $ru['account'] ;?>
						  <br>PID: <?php echo $ru['alipay_pid'] ;?>
                          
                          <?php }else if($ru['types'] == '3'){ ?> 
                         <br>卡号: <?php echo $ru['account_no'] ;?>
						  <br>卡名: <?php echo $ru['gathering_name'] ;?>
                         <br>卡ID: <?php echo $ru['cardid'] ;?>
                          
                          <?php }else if($ru['types'] == '4'){ ?> 
                         <br>拉卡拉账户: <?php echo $ru['lakala_account'] ;?>
                          
                          <?php }else if($ru['types'] == '5'){ ?> 
                         <br>云闪付账户: <?php echo $ru['yunshanfu_account'] ;?>

                         <?php }else if($ru['types'] == '6'){ ?> 
                         <br>农信易扫账户: <?php echo $ru['nxys_account'] ;?>
                          <br>农信易扫二维码: <?php echo $ru['ewmurl'] ;?>
                
            		     <?php }else if($ru['types'] == '7'){ ?> 
                         <br>农信易扫账户: <?php echo $ru['nxys_account'] ;?>
                        <br>农信易扫二维码: <?php echo $ru['ewmurl'] ;?>
                
              		   <?php }else if($ru['types'] == '8'){ ?> 
                         <br>农信易扫二维码: <?php echo $ru['ewmurl'] ;?>
                            <br>农信易扫账户: <?php echo $ru['nxys_account'] ;?>
                         
                 <?php }else if($ru['types'] == '9'){ ?> 
                二维码链接 : <?php echo $ru['ewmurl'] ;?> </br>
                        微信名称 : <?php echo $ru['dy_name'] ;?>  [ <a href="#" onclick="editdyname('<?php echo $ru['id'];?>');">修改</a> ]
                 <?php }else if($ru['types'] == '10'){ ?> 
                        二维码链接 : <?php echo $ru['ewmurl'] ;?> 
                 <?php }else if($ru['types'] == '11'){ ?> 
                        <br>卡号: <?php echo $ru['account_no'] ;?>
						  <br>卡名: <?php echo $ru['gathering_name'] ;?>
                    
                 <?php }else if($ru['types'] == '12'){ ?> 
                        二维码链接 : <?php echo $ru['ewmurl'] ;?> 
                 <?php }else if($ru['types'] == '13'){ ?> 
                        二维码链接 : <?php echo $ru['ewmurl'] ;?> 
                
                <?php } ?>
						
                
                
                        </td>
                 

              <td>
                             <p><font color="red">设置0为无限制</font></p>
                             当天最大收款额度：  <?php echo $ru['max_amount']?>
                          [ <a href="#" onclick="editMaxAmount('<?php echo $ru['id'];?>');">修改</a> ]
                              <br/>
                              当天最大收款笔数：  <?php echo $ru['max_dd']?>
                          [ <a href="#" onclick="editMaxdd('<?php echo $ru['id'];?>');">修改</a> ]
                              <br/>
                            指定收款地区：   <?php echo $ru['area']; ?>
                              [ <a href="#" onclick="addArea('<?php echo $ru['id'];?>');">修改</a> ]
                              <br/>
                          </td>
            
            
            
            
                 <td>
                    <p><b>轮训开关: </b><?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭轮训 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动轮训 </a>)</span>';?></p>
                    <p><b>网关开关: </b><?php echo $ru['receiving'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticGateway('.$ru['id'].');">停止网关 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticGateway('.$ru['id'].');">启动网关 </a>)</span>';?></p>
                </td>

                <td>
                        <p><b>今日收入:</b> <?php //查询今日收入
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where service_id={$ru['id']} and creation_time > {$nowTime} and status=4");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?></p>
                        <p><b>昨日收入:</b> <?php
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间

                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where service_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?></p>
                        </td>

                         <td>
                        <p><b>账号类型:</b> <?php if ($ru['types'] == 1) echo '<span style="color:green;">微信</span>'; if ($ru['types'] == 2) echo '<span style="color:red;">支付宝</span>'; ?> [ <?php if ($ru['lord'] == 0){?><a href="#" onclick="setLord('<?php echo $ru['id'];?>');" style="color: green;font-size:8px;">设置为系统主用</a><?php }else {?><a href="#" onclick="stopLord('<?php echo $ru['id'];?>');" style="color: red;font-size:8px;">取消系统主用</a><?php }?> ] [ <a href="#" onclick="gatewayTest('<?php echo $ru['key_id'];?>','<?php echo $ru['types'];?>')">单通道测试</a> ]</p>
                        <p><b>全部收入:</b> <?php
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}service_order where service_id={$ru['id']} and status=4");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?></p>
                        </td>
                
                <td>
                <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                            勾选,准备操作!
                        </label>
                    </div></p>
                <p><a href="#" onclick="del('<?php echo $ru['id'];?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除<?php echo (new model())->load('service', 'types')->get($ru['types']);?></a></p>
                <p><a href="#" onclick="edit('<?php echo $ru['id'];?>',<?php echo $ru['types'];?>);" class="btn btn-xs"><i class="fa"></i>修改<?php echo (new model())->load('service', 'types')->get($ru['types']);?>名称</a></p>
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
      <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
             <!-- End Panel -->
            <script type="text/javascript">
            var result = <?php echo json_encode($result['result']);?>;
            var signKey = '<?php echo $signkey;?>';


            function withdraw(key_id,status,types) {
                var id = 0;
                if(status != '4'){
                    swal("通道在线才可申请提现");
                    return;
                }
                var type = 'alipay';
                if(types == '1'){
                    type = 'wechat'
                }
                swal({
                        title: "提现提示(提交后会关闭网关，提现成功后需手动开启)",
                        type: "input", showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        inputPlaceholder: "请输入支付宝支付密码",
                        confirmButtonText: "确认提现"
                    },
                    function (inputValue) {
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("请输入支付密码!");
                            return false
                        }
                        $.get("<?php echo url::s('admin/service/withdraw', "id=");?>" + id + "&pwd=" + inputValue +"&key_id="+key_id +"&type="+type, function (result) {
                            if (result.code == '200') {
                                swal("提现信息", result.msg, "success");
                                setTimeout(function () {
                                    location.href = '';
                                }, 2000);
                            } else {
                                swal.showInputError(result.msg);
                            }
                        });
                    });
                $('.showSweetAlert input').attr('type', 'text');
            }

            function editAppuser(id){
                swal({   title: "修改提醒",
                        type: "input",   showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        inputPlaceholder: "APP唯一商户号",
                        confirmButtonText: "确认提交" },
                    function(inputValue){
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("请输入商户号");
                            return false
                        }
                        $.get("<?php echo url::s('admin/service/editAppuser',"id=");?>" + id + "&app_user=" + inputValue, function(result){
                            if(result.code == '200'){
                                swal("提醒", result.msg, "success");
                                setTimeout(function(){location.href = '';},1000);
                            }else{
                                swal.showInputError(result.msg);
                            }
                        });
                    });
                $('.showSweetAlert input').attr('type','text');
            }

            function editMaxAmount(id){
                swal({   title: "修改提醒",
                        type: "input",   showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        inputPlaceholder: "最大收款",
                        confirmButtonText: "确认提交" },
                    function(inputValue){
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("请输入您的最大收款金额!");
                            return false
                        }
                        $.get("<?php echo url::s('admin/service/editMaxAmount',"id=");?>" + id + "&amount=" + inputValue, function(result){
                            if(result.code == '200'){
                                swal("提醒", result.msg, "success");
                                setTimeout(function(){location.href = '';},1000);
                            }else{
                                swal.showInputError(result.msg);
                            }
                        });
                    });
                $('.showSweetAlert input').attr('type','text');
            }
              
                 function editdyname(id){
                swal({   title: "修改提醒",
                        type: "input",   showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        inputPlaceholder: "店长微信名称",
                        confirmButtonText: "确认提交" },
                    function(inputValue){
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("请输入店长微信名称!");
                            return false
                        }
                        $.get("<?php echo url::s('admin/service/editdyname',"id=");?>" + id + "&amount=" + inputValue, function(result){
                            if(result.code == '200'){
                                swal("提醒", result.msg, "success");
                                setTimeout(function(){location.href = '';},1000);
                            }else{
                                swal.showInputError(result.msg);
                            }
                        });
                    });
                $('.showSweetAlert input').attr('type','text');
            }
              
               function addArea(id){
          swal({   title: "请选择收款地区",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "<select id='area' name='area' style='display:block;'><option value='aaaa'>请选择收款地区</option><option value='0'>全国收款（无限制）</option><?php echo $areaStr;?></select>",
                  confirmButtonText: "提交" },
              function(inputValue){
                
                  $.get("<?php echo url::s('admin/service/areaAdd',"id=");?>" + id + "&area=" +$('#area').val() , function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }

         function editMaxdd(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "当天最大订单数",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的最大收款金额!");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/editMaxdd',"id=");?>" + id + "&dd=" + inputValue, function(result){
                      if(result.code == '200'){
                          swal("提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert input').attr('type','text');
      }
              
              var listen_login = 0;
              //伪造线程
              function login_listen(id){
              	listen_login = setInterval(function(){ $.get("<?php echo url::s('admin/service/loginStatus',"id=");?>" + id, function(result){
              		if(result.code > 0){
              			if(result.code == '2' || result.code == '3' ){ $('.showSweetAlert p').html(result.msg); }
              			if(result.code == '7'){
        				//将二维码展现出来扫码
              				$('.showSweetAlert h2').html('请使用扫一扫');
              				$('.showSweetAlert p').html("<img style='width:200px;height:200px;' src='data:image/png;base64," + result.data.img + "'/>");
                      	}
              			if(result.code == '4'){
        	            	swal("服务登录", result.msg, "success");
        	              	setTimeout(function(){location.href = '';},1000);
                        }
                     }else{
                    	 swal("服务登录", result.msg, "error");
                    	 setTimeout(function(){location.href = '';},1000);
                     }
              	  });  },1000);
              }


            //添加微信
               function addWechat(){
            swal({   title: "请输入微信宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "微信二维码链接<input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addWechat',"ewmurl=");?>" +$('#ewmurl').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
             //添加微信
               function addalipaygm(){
            swal({   title: "请输入微信宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "支付宝二维码链接<input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addalipaygm',"ewmurl=");?>" +$('#ewmurl').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
                //添加微信
               function addwechatdy(){
            swal({   title: "请输入微信宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "微信二维码链接<input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addWechatdy',"ewmurl=");?>" +$('#ewmurl').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
               //添加微信
               function addwechatsj(){
            swal({   title: "请输入微信宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "微信二维码链接<input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addWechatsj',"ewmurl=");?>" +$('#ewmurl').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
               //添加微信
               function addpdd(){
            swal({   title: "请输入微信宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "微信二维码链接<input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addpddgm',"ewmurl=");?>" +$('#ewmurl').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
                //添加拉卡拉
               function addlakala(){
            swal({   title: "请输入拉卡拉配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "请输入拉卡拉账号<input type='text' id='lakala_account' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("拉卡拉帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addlakala',"lakala_account=");?>" +$('#lakala_account').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
                            
                //添加农信易扫
               function addnxwx(){
            swal({   title: "请输入农信易扫配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "请输入农信易扫账号<input type='text' id='nxys_account' value=''>"
                   +"二维码连接（请解析二维码添加）<a target='_blank' href='http://jiema.wwei.cn/'>点击这里解析二维码</a><input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("农信易扫帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addnxys',"nxys_account=");?>" +$('#nxys_account').val() +'&name='+ $('#name').val() +'&ewmurl='+ $('#ewmurl').val() + '&type=0&types=6', function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
              //添加农信易扫
               function addnxalipay(){
            swal({   title: "请输入农信易扫配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "请输入农信易扫账号<input type='text' id='nxys_account' value=''>"
                   +"二维码连接（请解析二维码添加）<a target='_blank' href='http://jiema.wwei.cn/'>点击这里解析二维码</a><input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("农信易扫帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addnxys',"nxys_account=");?>" +$('#nxys_account').val() +'&name='+ $('#name').val()+'&ewmurl='+ $('#ewmurl').val() + '&type=1&types=7', function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
              //添加农信易扫
               function addnxyl(){
            swal({   title: "请输入农信易扫配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "请输入农信易扫账号<input type='text' id='nxys_account' value=''>"
                   +"二维码连接（请解析二维码添加）<a target='_blank' href='http://jiema.wwei.cn/'>点击这里解析二维码</a><input type='text' id='ewmurl' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("农信易扫帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addnxys',"nxys_account=");?>" +$('#nxys_account').val() +'&name='+ $('#name').val() +'&ewmurl='+ $('#ewmurl').val() + '&type=3&types=8', function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              

                 //添加云闪付
               function addyunshanfu(){
            swal({   title: "请输入云闪付配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "请输入云闪付账号<input type='text' id='yunshanfu_account' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("云闪付帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addyunshanfu',"yunshanfu_account=");?>" +$('#yunshanfu_account').val() +'&name='+ $('#name').val(), function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
              
                 function addwechatbank(){
          swal({   title: "请输入账户配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "收款人姓名<input type='text' id='gathering_name'>"
                      +"卡号<input type='text' id='account_no'>"
                  +"<select id='bank_id' name='bank_id' style='display:block;width:100%;height:43px'><option value='0'>请选择银行</option><?php echo $bankStr;?></select>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("账户帐号不能为空");
                      return false
                  }
                  var bank_id = $('#bank_id').val();
                  if(bank_id == false || bank_id == null){
                      swal.showInputError("请选择银行");
                      return false
                  }
                  var gathering_name = $('#gathering_name').val();
                  if(gathering_name == false || gathering_name == null){
                      swal.showInputError("收款人不能为空");
                      return false
                  }
                
                  var account_no = $('#account_no').val();
                  if(account_no == false || account_no == null){
                      swal.showInputError("带*卡号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addWechatbank',"gathering_name=");?>"+ $('#gathering_name').val()+'&bank_id='+bank_id+'&account_no='+account_no, function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
              //添加支付宝转账
               function addzhuanzhang(){
              swal({   title: "请输入支付宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "支付宝帐号<input type='text' id='account' value=''>"
                 +"支付宝PID<input type='text' id='pid' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addAlipay',"account=");?>" +$('#account').val() +'&name='+ $('#name').val() +'&pid='+ $('#pid').val()+'&is_new_version=1', function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
        //添加支付宝红包
         function addhongbao(){
          swal({   title: "请输入支付宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "支付宝帐号<input type='text' id='account' value=''>"
                 +"支付宝PID<input type='text' id='pid' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('admin/service/addAlipay',"account=");?>" +$('#account').val() +'&name='+ $('#name').val() +'&pid='+ $('#pid').val()+'&is_hongbao=1', function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }
              
              
         
            //新增支付宝转银行卡
            function addbank(){
                swal({   title: "请输入支付宝配置信息",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        html: true,
                        text: "银行卡帐号<input type='text' id='account' value=''>"
                            +"收款人姓名<input type='text' id='gathering_name'>"
                            +"cardid(<a href='http://120.79.231.25/cardid.php' target='_blank'>点击查看如何获取</a>)<input type='text' id='cardid'>"
                            +"带*卡号(<a href='http://120.79.231.25/cardid.php' target='_blank'>点击查看如何获取</a>)<input type='text' id='account_no'>"
                            +"<select id='bank_id' name='bank_id' style='display:block;width:100%;height:43px'><option value='0'>请选择银行</option><?php echo $bankStr;?></select>",
                        confirmButtonText: "提交" },
                    function(inputValue){
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("银行卡帐号不能为空");
                            return false
                        }
                        var gathering_name = $('#gathering_name').val();
                        if (gathering_name == false || gathering_name == null) {
                            swal.showInputError("收款人不能为空");
                            return false
                        }
                        var bank_id = $('#bank_id').val();
                        if (bank_id == false || bank_id == null) {
                            swal.showInputError("请选择银行");
                            return false
                        }
                        var cardid = $('#cardid').val();
                        if (cardid == false || cardid == null) {
                            swal.showInputError("请选择银行");
                            return false
                        }
                        var account_no = $('#account_no').val();
                        if (account_no == false || account_no == null) {
                            swal.showInputError("请选择银行");
                            return false
                        }
                        $.get("<?php echo url::s('admin/service/addAlipayBank',"account=");?>" +$('#account').val() +  '&gathering_name='+ $('#gathering_name').val()+  '&bank_id='+bank_id+'&cardid='+cardid+'&account_no='+account_no, function(result){
                            if(result.code == '200'){
                                swal("成功提醒", result.msg, "success");
                                setTimeout(function(){location.href = '';},1000);
                            }else{
                                swal.showInputError(result.msg);
                            }
                        });
                    });
                $('.showSweetAlert fieldset input').attr('type','hidden');
            }



            function addAlipay(){
                swal({
                        title: "支付宝提醒",
                        text: "您确定要新增加一个支付宝服务通道吗?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "是的,我要新增!",
                        closeOnConfirm: false
                    },
                    function(){
                        $.get("<?php echo url::s('admin/service/addAlipay');?>", function(result){
                            if(result.code == '200'){
                                swal("支付宝提示", result.msg, "success");
                                setTimeout(function(){location.href = '';},1000);
                            }else{
                                swal("支付宝提示", result.msg, "error");
                            }
                        });
                    });
            }
            function startAutomaticRb(id){
            	  swal({
                      title: "服务提醒",
                      text: "当前操作是更改服务轮训状态,您是否继续?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "确认",
                      closeOnConfirm: false
                    },
                    function(){
                       $.get("<?php echo url::s('admin/service/startRobin',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("服务提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("服务提示", result.msg, "error");
            	              }
                      	  });
                    });
              }

            function startAutomaticGateway(id){
            	  swal({
                      title: "服务提醒",
                      text: "当前操作是更改网关状态,您是否继续?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "是的,继续!",
                      closeOnConfirm: false
                    },
                    function(){
                       $.get("<?php echo url::s('admin/service/startGateway',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("服务提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("服务提示", result.msg, "error");
            	              }
                      	  });
                    });
              }

            function startAutomaticLogOut(id){
            	  swal({
                      title: "服务提醒",
                      text: "您是否要退出当前服务?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "是的,我要退出!",
                      closeOnConfirm: false
                    },
                    function(){
                       $.get("<?php echo url::s('admin/service/startLogOut',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("服务提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("服务提示", result.msg, "error");
            	              }
                      	  });
                    });
              }

			function del(id){
		              swal({
		                title: "服务提醒",
		                text: "你确定要删除该服务吗？",
		                type: "warning",
		                showCancelButton: true,
		                confirmButtonColor: "#DD6B55",
		                confirmButtonText: "是的,我要删除该服务!",
		                closeOnConfirm: false
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/service/delete','id=');?>" + id, function(result){

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
		                text: "你确定要批量删除已选中的服务吗？",
		                type: "warning",
		                showCancelButton: true,
		                confirmButtonColor: "#DD6B55",
		                confirmButtonText: "是的,我要删除这些服务!",
		                closeOnConfirm: false
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/service/delete','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '';},1500);
				                	  });
				           });

		              });

				}


			//轮训测试
			  function robinTest(type){
				  swal({
				      title: "轮训通道测试",
				      text: "请输入要测试支付的金额<input type='text' id='amount' value='1.00'>"
				      +"请输入要接收异步通知的回调url<input type='text' id='callback_url'>",showCancelButton: true,
				      html: true,
		              confirmButtonText: "确认测试" ,
				      type: "prompt",
				  }, function(){
				       window.open('<?php echo url::s("admin/service/robinTest");?>' + '?type='+type+'&amount=' + $('#amount').val() + '&callback_url=' + $('#callback_url').val());
					   location.href='';
				      })
				 $('.showSweetAlert fieldset input').attr('type','hidden');
				 $('#amount').val('1.00');
				 $('#callback_url').val('<?php echo URL_ROOT; ?>/index/index/callback.do');
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





			function setLord(id){
	          	  swal({
	                    title: "服务提醒",
	                    text: "您确定要将该服务号设置为系统主要使用收款账号吗?",
	                    type: "warning",
	                    showCancelButton: true,
	                    confirmButtonColor: "#DD6B55",
	                    confirmButtonText: "确认",
	                    closeOnConfirm: false
	                  },
	                  function(){
	                     $.get("<?php echo url::s('admin/service/setLord',"id=");?>" + id, function(result){
	                    	 if(result.code == '200'){
	          	            	swal("服务提示", result.msg, "success");
	          	              	setTimeout(function(){location.href = '';},1000);
	          	              }else{
	          	            	swal("服务提示", result.msg, "error");
	          	              }
	                    	  });
	                  });
	            }


			function gatewayTest(id,types){
				  swal({
				      title: "单通道测试",
				      text: "请输入要测试支付的金额<input type='text' id='amount' value='1.00'>"
				      +"请输入要接收异步通知的回调url<input type='text' id='callback_url'>",showCancelButton: true,
				      html: true,
		              confirmButtonText: "确认测试" ,
				      type: "prompt",
				  }, function(){
				       window.open('<?php echo url::s("admin/service/gatewayTest");?>' + '?amount=' + $('#amount').val()  + "&type="+types+"&keyId=" + id + '&callback_url=' + $('#callback_url').val());
					   location.href='';
				      })

				 $('.showSweetAlert fieldset input').attr('type','hidden');
				 $('#amount').val('1.00');
				 $('#callback_url').val('<?php echo URL_ROOT; ?>/index/index/callback.do');
			  }

            function edit(id,type){
                swal({
                    title: "修改名称",
                    text: "",
                    showCancelButton: true,
                    html: true,
                    confirmButtonText: "确认修改" ,
                    type: "prompt",
                }, function(text){
                    if(!text){
                        return false;
                    }
                    var a = '<?php echo url::s("server/index/editName")?>';
                    $.ajax({
                        url  : a,//请求url
                        type : "POST",	//请求类型  post|get
                        data : {id:id,name:text,type:type},	//后台用 request.getParameter("key");
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        success : function(data){	//回调函数 和 后台返回的 数据
                            if(data.code == 200){
                                // swal(data.msg);
                                location.reload();
                            }
                            swal(data.msg);
                        }
                    });
                })
            }

          

			function stopLord(id){
	          	  swal({
	                    title: "服务提醒",
	                    text: "你确定要取消该服务号对系统的服务吗？",
	                    type: "warning",
	                    showCancelButton: true,
	                    confirmButtonColor: "#DD6B55",
	                    confirmButtonText: "确认",
	                    closeOnConfirm: false
	                  },
	                  function(){
	                     $.get("<?php echo url::s('admin/service/setLord',"id=");?>" + id, function(result){
	                    	 if(result.code == '200'){
	          	            	swal("服务提示", '取消成功', "success");
	          	              	setTimeout(function(){location.href = '';},1000);
	          	              }else{
	          	            	swal("服务提示", result.msg, "error");
	          	              }
	                    	  });
	                  });
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
<!--<script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>-->
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