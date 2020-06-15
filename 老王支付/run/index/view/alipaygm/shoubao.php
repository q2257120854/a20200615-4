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
          <!--
\u706b\u5c71\u652f\u4ed8\u0020\u4f5c\u8005\u0051\u0051\uff1a\u0033\u0038\u0032\u0033\u0039\u0030\u0033\u0020\u4e92\u7ad9\u5e97\u94fa\uff1a\u0068\u0074\u0074\u0070\u0073\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0068\u0075\u007a\u0068\u0061\u006e\u002e\u0063\u006f\u006d\u002f\u0069\u0073\u0068\u006f\u0070\u0038\u0035\u0030\u0032\u002f

-->
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">微博红包支付</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo url::s('index/panel/home');?>">仪表盘</a></li>
                    <li><a href="#">微博红包信息列表</a></li>
                   
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
		          <a onclick="addsbzh();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light "  style="    background-color: #b33030 !important;"><i class="mdi-content-add left" style="width: 10px;"></i>添加收包账号</a> 	
 
            </p>
        

            <!--Striped Table-->
             <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  
                  
                  <div style="font-size:16px;padding:15px">
      
                    
                    
                    <font color=red>账号总数 ：<font color=red><?php
                                        $account = $mysql->select("select count(id) as count from {$fix}client_alipaygm_automatic_appid where user_id={$_SESSION['MEMBER']['uid']}")[0];
                                        echo $account['count'];
                                        ?></font></font>&nbsp;	&nbsp;	
                                        <font color=red>今日领取笔数 ：<font color=red><?php  $order = $mysql->select("select sum(today_number) as money,count(id) as count from {$fix}client_alipaygm_automatic_appid where  user_id={$_SESSION['MEMBER']['uid']}")[0];
                                        echo number_format($order['money']);
                                        ?></font>  </font>&nbsp;	&nbsp;	
                                        <font color=red>今日领取总额 ：<font color=red><?php  $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipaygm_automatic_appid where  user_id={$_SESSION['MEMBER']['uid']}")[0];
                                        echo number_format($order['money'],3);
                                        ?></font>  </font>&nbsp;	&nbsp;	
                                         <font color=red>总计领取笔数 ：<font color=red><?php  $order = $mysql->select("select sum(all_number) as money,count(id) as count from {$fix}client_alipaygm_automatic_appid where  user_id={$_SESSION['MEMBER']['uid']}")[0];
                                        echo number_format($order['money']);
                                        ?>  </font></font>&nbsp;	&nbsp;	
                                        <font color=red>总计领取总额 ：<font color=red><?php  $order = $mysql->select("select sum(all_amount) as money,count(id) as count from {$fix}client_alipaygm_automatic_appid where  user_id={$_SESSION['MEMBER']['uid']}")[0];
                                        echo number_format($order['money'],3);
                                        ?>  </font></font>
                    
                    
                  </div>
                  
                  
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                           <th>ID</th>
                          <th>备注</th>
                          <th>状态</th>
                          <th>收款UID</th>
                          <th>今日领取笔数</th>
                          <th>今日领取金额</th>
                          <th>总计领取笔数</th>
                          <th>总计领取金额</th>
                          <th>每日领取限额</th>
						  <th>状态操作</th>	
                      </tr>
                    </thead>

                    
                    <tbody>
                   <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td><?php echo $ru['id'];?></td>
                       <td><?php echo $ru['beizhu'];?></td>
                        <!--<td><?php echo $ru['key_id'];?></td>-->
                       <td><p><?php
                                       if ($ru['status']==4){
                                       $zt='正常使用';
                                       $ys='red';
                                       }else if ($ru['status']==1||$ru['status']==5){
                                         $zt='禁用中';
                                         $ys='rainbow';
                                       };
                                        ?>
                                       <font color=<?php echo $ys;?> ><?php echo $zt;?></font></p></td>
                        <td><?php echo $ru['appid'];?></td>
                        
                        <td><?php echo $ru['today_number'];?></td>
                        <td><?php echo $ru['amount'];?></td>
                        <td><?php echo $ru['all_number'];?></td>
                        <td><?php echo $ru['all_amount'];?></td>
                        <td><?php echo $ru['max_amount'];?></td>
                            <td>
                                  
                               <?php echo $ru['status'] ==4 ? '<span style="color:#4caf50;">启用中 ( <a href="#" style="color:#006064;" onclick="startAutomaticzt(' . $ru['id'] . ');">禁用 </a> )</span>' : '<span style="color:red;">禁用中 ( <a href="#" style="color:#e57373;" onclick="startAutomaticzt(' . $ru['id'] . ');">启用 </a>)</span>'; ?>
                            		<br>

									<a href="#" onclick="del('<?php echo $ru['id'];?>');" style="color:#757575;">删除账号</a>
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
        

 
 function addsbzh(){
       	
          swal({   title: "请输入微博收款账号信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "备注:<input type='text' id='name'>"+"微博UID:（<a href='/index/doc/video.do' target='_blank'>点击这里看获取教程</a>）<input type='text' id='uid' value=''>"
                  +"微博COOKIE:<input type='text' id='cookie'>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("微博UID不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('index/alipaygm/shoubaoAdd',"uid=");?>"+$('#uid').val()+"&cookie="+$('#cookie').val()+"&name="+$('#name').val()+"&id="+$('#id').val(), function(result){
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
      
      //收款状态启用关闭
  function startAutomaticzt(id) {
        swal({
                title: "微博红包提醒",
                text: "当前操作是更改账号状态,您是否继续?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的,继续!",
                closeOnConfirm: false
            },
            function () {
                $.get("<?php echo url::s('index/alipaygm/startAutomaticzt', "id=");?>" + id, function (result) {
                    if (result.code == '200') {
                        swal("微博红包提示", result.msg, "success");
                        setTimeout(function () {
                            location.href = '';
                        }, 1000);
                    } else {
                        swal("微博红包提示", result.msg, "error");
                    }
                });
            });
    }
     
        
	  function del(id){
		  swal({   title: "微博红包提醒",   
              text: "请验证您的登录密码:",   
              type: "input",   showCancelButton: true,   
              closeOnConfirm: false,   
              animation: "slide-from-top",   
              inputPlaceholder: "会员登录密码",
              confirmButtonText: "确认删除" }, 
              function(inputValue){   
                  if (inputValue === false) return false;      
                  if (inputValue === "") {     
                  swal.showInputError("请输入您的登录密码!");     
                  return false   
                  }
             $.get("<?php echo url::s('index/alipaygm/shoubaoDelete',"id=");?>" + id + "&pwd=" + inputValue, function(result){
              	 if(result.code == '200'){
               		    swal("微博红包提醒", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal.showInputError(result.msg);     
    	             }
          		});
         });
		  $('.showSweetAlert input').attr('type','password');
	  }

	
         function editMaxAmount(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "当天最大收款",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的最大收款金额!");
                      return false
                  }
                  $.get("<?php echo url::s('index/alipaygm/editMaxAmount',"id=");?>" + id + "&amount=" + inputValue, function(result){
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
                  $.get("<?php echo url::s('index/alipaygm/editMaxdd',"id=");?>" + id + "&dd=" + inputValue, function(result){
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
        
        
		//微博红包设置
	  function setting(){ 
		  layer.open({
			  type: 2,
			  title: '微博红包配置',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['600px', '400px'],
			  content: '<?php echo url::s('index/alipaygm/automaticConfig');?>' //iframe的url
			}); 
	  }

	
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   