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
                <h5 class="breadcrumbs-title">收益记录</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">个人中心</a></li>
                    <li class="active">收益记录</li>
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
                            <th>用户名: <input type="text" name="uid" style="width:110px;height: 35px" value="<?php if(!empty($_GET['user_id'])){  echo $_GET['user_id']; }?>"></th>
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
                        </form>
                    </tr>
                      <tr>
                        <th>订单号</th>
                        <th>代理名称</th>
                        <th>类型</th>
                        <th>支付金额/元</th>
                        <th>收益/元</th>
                        <th>收益时间</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  if (!is_array($result)) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到数据!</td></tr>';?>
                    <?php foreach ($result as $ru){ ?>
                      <tr>
                          <td><?php echo $ru['trade_no'];?></td>
                          <td><?php echo $ru['username'];?></td>
                          <td><?php echo $ru['type'];?></td>
                          <td><?php echo $ru['pay_money'];?></td>
                          <td><?php echo $ru['money'];?></td>
                          <td><?php echo $ru['create_time'];?></td>
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
          function exportData () {
              var code = GetQueryString('code');
              var start_time = GetQueryString('start_time');
              var end_time = GetQueryString('end_time');
              if (code) {
                  location.href = "<?php echo url::s('index/member/export', "sorting=alipay&code=");?>" + code+ '&start_time='+start_time + '&end_time=' + end_time;
              }else {
                  location.href = "<?php echo url::s('index/member/export', "sorting=alipay&start_time=");?>" + start_time + '&end_time=' + end_time;
              }
          }
          function GetQueryString(name)
          {
              var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
              var r = window.location.search.substr(1).match(reg);
              if(r!=null)return  unescape(r[2]); return null;
          }
      function note(obj){
          location.href = "<?php echo url::s('index/member/agent',"sorting=note&name=");?>" + $(obj).val();
          }

	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>
   