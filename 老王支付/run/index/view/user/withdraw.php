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
                <h5 class="breadcrumbs-title">我的提现</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">个人中心</a></li>
                    <li class="active">我的提现</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">

            <p class="caption" >
            <a href="#" onclick="withdraw();" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-action-accessibility left" style="width: 10px;"></i>申请提现 ( 余额：<?php echo $_SESSION['MEMBER']['money'];?> )</a>
             <span style="font-size: 15px;margin-left:20px;">[ 当前盈利余额: <b style="font-size: 20px;color:red;"><?php echo $_SESSION['MEMBER']['money'];?></b>  / 总提现金额: <?php //查询全部提现 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_withdraw where user_id={$_SESSION['MEMBER']['uid']} and types=2");
                        echo '<span style="font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 总提现笔数: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] </span>
            </p>
        

            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                     	
                        <th><div class="input-field col s8" style="margin-left: -15px;"> <input onchange="flow_no(this);" id="last_name" type="text" class="validate" value="<?php if ($sorting['name'] == 'flow_no') echo $_GET['code'];?>"> <label for="last_name">流水号</label></div></th>
                        <th>金额</th>
                        <th>银行状态</th>
                        <th>提现时间</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="4" style="text-align: center;">暂时没有查询到您的提现记录!</td></tr>';?>
                    
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                      
                        
                        <td>流水单号：<?php echo $ru['flow_no'];?>
                        <br>余额变更：提现前余额 ( <?php echo $ru['old_amount'];?> ) / 提现后余额 ( <?php echo $ru['new_amount'];?> )  
                        </td>
                        
                        <td>提现金额：<span style="color: green;"><b><?php echo $ru['amount'];?></b> ( 实际到款 : <?php echo $ru['amount']-$ru['fees'];?> )</span>
                        <br>手续费用：<b style="color:red;"><?php echo $ru['fees'];?></b>
                        </td>
                        
                        <td>
                        银行信息：<?php echo $ru['content'];?><br>
                        提现状态：<?php 
                        if ($ru['types'] == 1) echo '<span style="color:#039be5;">银行正在处理..</span>';
                        if ($ru['types'] == 2) echo '<span style="color:green;">已经到账</span>';
                        if ($ru['types'] == 3) echo '<span style="color:#bdbdbd;">银行驳回</span>';
                        if ($ru['types'] == 4) echo '<span style="color:red;">流水异常</span>';
                        ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s",$ru['pay_time']) . ')';?>
                        </td>
                        
                        <td>提交时间：<?php echo date("Y/m/d H:i:s",$ru['apply_time']);?>
                        <br>处理时间：<?php if ($ru['deal_time'] != 0) {echo date("Y/m/d H:i:s",$ru['deal_time']);}else {echo '银行处理中';}?>
                       
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

      function withdraw(){
    		  layer.open({
    			  type: 2,
    			  title: '申请提现',
    			  shadeClose: true,
    			  shade: 0.8,
    			  area: ['500px', '340px'],
    			  content: '<?php echo url::s('index/member/applyWithdraw');?>' //iframe的url
    			}); 
      }

      function flow_no(obj){
          location.href = "<?php echo url::s('index/member/withdraw',"sorting=flow_no&code=");?>" + $(obj).val();
          }

     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   