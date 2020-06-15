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
                <h5 class="breadcrumbs-title">我的代理</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">个人中心</a></li>
                    <li class="active">我的代理</li>
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
<!--                  <div class="input-field col s6" style="font-weight:normal;width: 200px">-->
<!--                      <select multiple id="type">-->
<!--                          <option value="" disabled selected>选择类型</option>-->
<!--                              <option value="1" >服务版</option>-->
<!--                              <option value="2">商户版</option>-->
<!--                      </select>-->
<!--                      <label>选择类型查看--><?php //if ($_SESSION['WECHAT']['ORDER']['WHERE'] == ''){?><!--(<a href="#" onclick="wechat();">开始查询</a>)--><?php //}else{?><!--(<a href="--><?php //echo url::s('index/wechat/automaticOrder',"sorting=wechat&locking=closed");?><!--">取消锁定</a>)--><?php //}?>
<!--                      </label>-->
<!--                  </div>-->
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                    <tr>
                        <form action="" method="get">
                            <th>用户名: <input type="text" name="name" style="width:110px;height: 35px" value="<?php if(!empty($_GET['user_id'])){  echo $_GET['user_id']; }?>"></th>
                            <input type="hidden" name="sorting" value="note">
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
                        <a style="
                                background-color: red; /* Green */
    border: none;
    color: white;
    padding: 8px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;" onclick="addAgent(<?php echo $_SESSION['MEMBER']['uid']?>)">添加代理</a>
                    </tr>
                      <tr>
                        <th>用户名称</th>
                        <th>手机号码</th>
                        <th>微信订单数</th>
                        <th>微信总额</th>
                        <th>支付宝订单数</th>
                        <th>支付宝总额</th>
                        <th>总收款/元</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到数据!</td></tr>';?>
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                          <td><?php echo $ru['username'];?></td>
                          <td><?php echo $ru['phone'];?></td>
                          <td><?php echo $ru['wechat_order'];?></td>
                          <td><?php echo $ru['wechat_amount'];?></td>
                          <td><?php echo $ru['alipay_order'];?></td>
                          <td><?php echo $ru['alipay_amount'];?></td>
                        <td>
                        <span style="color: red;font-weight:bold;"><?php echo $ru['total'];?>
                        </td>
                          <td>
                              <a style="
                                background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;" onclick="editRate(<?php echo $ru['id']?>,<?php echo $ru['rate']['wechat_auto'] ? $ru['rate']['wechat_auto'] : 0?>,<?php echo $ru['rate']['alipay_auto'] ? $ru['rate']['alipay_auto'] : 0?>,<?php echo $ru['rate']['service_auto'] ? $ru['rate']['service_auto'] : 0?>)">设置费率</a>
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

          function editRate(id,wechat_auto,alipay_auto,service_auto){
              swal({   title: "设置费率",
                      type: "input",
                      showCancelButton: true,
                      closeOnConfirm: false,
                      html: true,
                      text: "微信费率<input type='text' id='wechat_auto' value=''>"
                      +"支付宝费率<input type='text' id='alipay_auto'>"
                      +"服务版费率<input type='text' id='service_auto'>",
                      confirmButtonText: "提交" },
                  function(inputValue){
                      if (inputValue === false) return false;
                      if (inputValue === "") {
                          swal.showInputError("请输入费率信息!");
                          return false
                      }
                      $.get("<?php echo url::s('index/member/rate',"id=");?>" + id + "&wechat_auto=" + $('#wechat_auto').val() + "&type=edit&alipay_auto=" + $('#alipay_auto').val()+ "&type=edit&service_auto=" + $('#service_auto').val(), function(result){
                          if(result.code == '200'){
                              swal("成功提醒", result.msg, "success");
                              setTimeout(function(){location.href = '';},1000);
                          }else{
                              swal.showInputError(result.msg);
                          }
                      });
                  });
              $('.showSweetAlert fieldset input').attr('type','hidden');
              $('#wechat_auto').val(wechat_auto);
              $('#alipay_auto').val(alipay_auto);
              $('#service_auto').val(service_auto);
          }

          function addAgent(uid){
              swal({   title: "添加代理",
                      type: "input",
                      showCancelButton: true,
                      closeOnConfirm: false,
                      html: true,
                      text: "代理用户id/代理用户名<input type='text' id='userId' value=''>",
                      confirmButtonText: "提交" },
                  function(inputValue){
                      if (inputValue === false) return false;
                      if (inputValue === "") {
                          swal.showInputError("代理账号!");
                          return false
                      }
                      $.get("<?php echo url::s('index/member/addAgent',"uid=");?>" + uid + "&userId="+$('#userId').val(), function(result){
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
      function note(obj){
          location.href = "<?php echo url::s('index/member/agent',"sorting=note&name=");?>" + $(obj).val();
          }

	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   