<?php
include("../includes/common.php");
$title='晓超云-管理中心';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
 
<?php
include 'nav.php';
$count1=$DB->query("SELECT count(*) from pay_order")->fetchColumn();
$count2=$DB->query("SELECT count(*) from pay_user")->fetchColumn();
$data=unserialize(file_get_contents(SYSTEM_ROOT.'db.txt'));
$mysqlversion=$DB->query("select VERSION()")->fetch();
?>
<!-- container -->
  <div class="container" style="padding-top:70px;">
   <div class="row">  
    <div class="col-md-12">
     <div class="row">
          <div class="alert alert-default">
                <li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <b>余额与结算每小时更新一次</b>晓超云</li>
              <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b> <?=$date?></li>
            </div>        
      <div class="col-md-3 col-xs-6">
       <div class="panel">
        <div class="panel-body brand-danger" style="background: rgb(240, 80, 51);">
         <div class="text-center">
          <span class="img-circle"><i class="glyphicon glyphicon-user"></i></span>
         </div>
        </div> 
        <div class="panel-body">
         <h6 class="pull-left">商户数量</h6> 
         <h5 class="pull-right text-1"><?php echo $count2?>位</h5>
        </div>
       </div>
      </div> 
      <div class="col-md-3 col-xs-6">
       <div class="panel">
        <div class="panel-body brand-primary" style="background: rgb(52, 152, 219);">
         <div class="text-center">
          <span class="img-circle"><i class="glyphicon glyphicon-th-list"></i></span>
         </div>
        </div> 
        <div class="panel-body">
         <h6 class="pull-left">订单总数</h6> 
         <h5 class="pull-right text-2"><?php echo $count1?>笔</h5>
        </div>
       </div>
      </div> 
      <div class="col-md-3 col-xs-6">
       <div class="panel">
        <div class="panel-body brand-info" style="background: rgb(142, 68, 173);">
         <div class="text-center">
          <span class="img-circle"><i class="glyphicon glyphicon-euro"></i></span>
         </div>
        </div> 
        <div class="panel-body">
         <h6 class="pull-left">总计余额</h6> 
         <h5 class="pull-right text-3"><?php echo $data['usermoney']?>￥</h5>
        </div>
       </div>
      </div> 
      <div class="col-md-3 col-xs-6">
       <div class="panel">
        <div class="panel-body brand-info" style="background: rgb(31, 166, 122);">
         <div class="text-center">
          <span class="img-circle"><i class="glyphicon glyphicon-check"></i></span>
         </div>
        </div> 
        <div class="panel-body">
         <h6 class="pull-left">结算金额</h6> 
         <h5 class="pull-right text-5"><?php echo $data['settlemoney']?>￥</h5>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div> 
<!-- end  -->  
<div class="col-lg-100 col-md-100">
<div class="panel panel-dark">
<div class="panel-heading font-bold" style="background:#F5F5F5;">数据分析</div>
<div class="panel-body text-center">          
<div class="col-md-6 col-xs-12">
  <div class="panel-heading font-bold" style="background:#F5F5F5;">今日收入</div>   
    <div class="btn-group btn-group-justified">      
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/alipay.ico" class="logo"><br><?php echo round($data['order_today']['alipay'],2)?></font></a>
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/wechat.ico" class="logo"><br><?php echo round($data['order_today']['wxpay'],2)?></font></a>        
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/qqpay.ico" class="logo"><br><?php echo round($data['order_today']['qqpay'],2)?></font></a>
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/tenpay.ico" class="logo"><br><?php echo round($data['order_today']['tenpay'],2)?></font></a>      
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/zj.ico" class="logo"><br><?php echo round($data['order_today']['all'],2)?></font></a>              
        </div>
        </div>
        <div class="col-md-6 col-xs-12">
  <div class="panel-heading font-bold" style="background:#F5F5F5;">昨日收入</div>             
        <div class="btn-group btn-group-justified">
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/alipay.ico" class="logo"><br><?php echo round($data['order_lastday']['alipay'],2)?></font></a>
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/wechat.ico" class="logo"><br><?php echo round($data['order_lastday']['wxpay'],2)?></font></a>        
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/qqpay.ico" class="logo"><br><?php echo round($data['order_lastday']['qqpay'],2)?></font></a>
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/tenpay.ico" class="logo"><br><?php echo round($data['order_lastday']['tenpay'],2)?></font></a>      
        <a class="btn btn-default"><font color="#58666E"><img src="../assets/icon/zj.ico" class="logo"><br><?php echo round($data['order_lastday']['all'],2)?></font></a>                      

        </div>
        </div>
      </div>
    </div>
  </div>


   <div class="row">
    <div class="col-lg-100 col-md-12">
     <div class="row">
      <div class="col-md-12">
       <div class="panel panel-default">
        <div class="row" style="width: 100%;">
         <div class="col-xs-4">
          <div class="panel-body text-center">
           <a href="ulist.php" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> <span> 
           商户管理</span></a>
          </div>
         </div> 
         <div class="col-xs-4">
          <div class="panel-body text-center">
           <a href="settle.php" class="btn btn-danger"><span class="glyphicon glyphicon-fire"></span> <span> 结算管理</span></a>
          </div>
         </div> 
         <div class="col-xs-4">
          <div class="panel-body text-center">
           <a href="order.php" class="btn btn-default"><span class="glyphicon glyphicon-minus"></span> <span> 订单管理</span></a>
          </div>
         </div>
        </div> 
        <div class="row" style="width: 100%;">
         <div class="col-xs-4">
          <div class="panel-body text-center">
           <a href="slite.php" class="btn btn-warning"><span class="glyphicon glyphicon-glass"></span> <span> 
           结算记录</span></a>
          </div>
         </div> 
         <div class="col-xs-4">
          <div class="panel-body text-center">
           <a href="info.php" class="btn btn-success"><span class="glyphicon glyphicon-barcode"></span> <span> 监控管理</span></a>
          </div>
         </div> 
         <div class="col-xs-4">
          <div class="panel-body text-center">
           <a href="dlog.php" class="btn btn-info"><span class="glyphicon glyphicon-euro"></span> <span> 
           系统日志</span></a>
          </div>
         </div>                
        </div>
       </div>
      </div> 
<!--       <div class="col-md-12">
       <div class="panel panel-default">
        <div class="panel-heading">
         <h4 class="panel-title"><span class="glyphicon glyphicon-time"></span> 最新登录记录 </h4>
        </div> 
        <div class="panel-body">
         <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
           <thead>
            <tr>
             <th class="text-center">#</th> 
             <th class="text-center">IP地址</th> 
             <th class="text-center">登录时间</th> 
             <th class="text-center">登录ID</th>
            </tr>
           </thead> 
           <tbody>
            <tr>
             <td>#</td> 
             <td class="text-center">183.131.184.124</td> 
             <td class="text-center">2018-01-25 21:04:25</td> 
             <td class="text-center">成功</td>
            </tr>
           </tbody>
          </table>
         </div>
        </div> 
        <div class="panel-footer text-right">
         <a href="./order" class="btn btn-default btn-sm">查看更多</a>
        </div>
       </div>
      </div>
     </div>
    </div>  -->
<!-- 订单记录  -->  
 <!--    <div class="col-lg-6 col-md-12">
     <div class="row">
      <div class="col-md-12">
       <div class="panel panel-default">
        <div class="panel-heading">
         <h4 class="panel-title"><span class="glyphicon glyphicon-time"></span> 最新订单记录 </h4>
        </div> 
        <div class="panel-body">
         <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
           <thead>
            <tr>
             <th class="text-center">订单金额</th> 
             <th class="text-center">订单编号</th> 
             <th class="text-center">创建时间</th> 
             <th class="text-center">账单状态</th>
            </tr>
           </thead> 
           <tbody>
            <tr>
             <td class="text-center">44.16</td> 
             <td class="text-center">T1526273260</td> 
             <td class="text-center">2018-05-14 12:47:42</td> 
             <td class="text-center">已成功</td>
            </tr>
           </tbody>
          </table>
         </div>
        </div> 
        <div class="panel-footer text-right">
         <a href="" class="btn btn-default btn-sm">查看更多</a>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>     -->