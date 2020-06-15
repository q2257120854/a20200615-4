<?php
use xh\library\url;
use xh\library\model;

$fix = DB_PREFIX;
?>
<?php include_once(PATH_VIEW . 'common/header.php'); ?>
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
                    <h5 class="breadcrumbs-title">Automatic <?php echo SYSTEM_VERSION; ?></h5>
                    <ol class="breadcrumbs">
                        <li><a href="#">支付宝固码</a></li>
                        <li class="active">Automatic-订单列表</li>
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
                <a href="<?php echo url::s("index/alipaygm/automatic"); ?>" style="font-size: 14px;"
                   class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left"
                                                                          style="width: 10px;"></i>支付宝列表</a>
                <a href="#" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"
                   onclick="resetOrder();">
                    <i class="mdi-editor-border-all left" style="width: 10px;"></i>
                    批量补单
                </a>
                <script>

                    function resetOrder() {
                        layer.prompt({title: "使用,号分割订单号，如1132,5523,3312", formType: 2,area: ['400px', '200px']}, function (text, index) {
                            $.ajax({
                                async : false,
                                cache : false,
                                type : 'POST',
                                url : 'resetOrder',
                                data:{order_ids:text},
                                beforeSend:function(){
                                    layer.msg('补单中，请耐心等候', {
                                        icon: 16
                                        ,shade: 0.2
                                    });
                                },
                                error : function() {
                                    layer.msg('网络错误');
                                    setTimeout(function(){
                                        //location.reload();
                                    }, 2000);
                                },
                                success : function(data) {
                                    layer.close(index);
                                    console.log(data);
                                    layer.msg(data.msg, {time: 100000} );
                                    setTimeout(function(){
                                        location.reload();
                                    }, 10000);
                                }
                            });



                        });
                    }

                </script>
                <span style="font-size: 15px;margin-left:20px;">[ <b>今日收入:</b> <?php //查询今日收入
                    $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                    $where_call = "creation_time > {$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');
                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipaygm_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?>] - [ <b>昨日收入:</b> <?php
                    $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间
                    $where_call = "creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');


                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipaygm_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?> ] - [ <b>全部收入:</b> <?php
                    $where_call = "status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');

                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipaygm_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . floatval($order[0]['count']) . '</span> ';
                    ?>
                    ] <?php if ($sorting['name'] == 'user' && $_GET['code'] != '' && $_SESSION['alipaygm']['WHERE'] == '') { ?> [
                        <a href="<?php echo url::s("admin/alipaygm/statisticOrder", "sorting=user&code={$_GET['code']}&locking=true"); ?>"
                           style="color: green;">锁定该用户查询</a> ]<?php } ?> <?php if ($_SESSION['alipaygm']['WHERE'] != '') { ?>  [
                        <a href="<?php echo url::s("admin/alipaygm/statisticOrder", "sorting=user&code={$_GET['code']}&locking=false"); ?>"
                           style="color: red;">查询全部</a> ] <?php } ?></span>
            </p>


            <!--Striped Table-->
            <div id="striped-table">

                <div class="row">

                    <div class="col s12 m12 l12">
                        <table class="striped" style="font-size: 14px;">
                            <thead>
                            <tr>
                                <form action="" method="get">
                                    <th>开始时间: <input type="date" style="width:145px" name="start_time" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>"></th>
                                    <th>结束时间： <input type="date" style="width:145px" name="end_time" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>"></th>
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
                                    <div class="input-field col s6" style="font-weight:normal;">
                                        <select multiple id="alipaygm">
                                            <option value="" disabled selected>选择支付宝</option>
                                            <?php foreach ($wechat as $wx) { ?>
                                                <option value="<?php echo $wx['id']; ?>"><?php echo $wx['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label>选择通道来查看<?php if ($_SESSION['alipaygm']['ORDER']['WHERE'] == '') { ?>(<a
                                                    href="#" onclick="alipaygm();">开始查询</a>)<?php } else { ?>(<a
                                                    href="<?php echo url::s('index/alipaygm/statisticOrder', "sorting=alipaygm&locking=closed"); ?>">取消锁定</a>)<?php } ?>
                                        </label>
                                    </div>
                                </th>
                                <th>
                                    支付信息 <?php if ($sorting['code'] != 0 && $sorting['name'] == 'status') { ?>(<?php if ($sorting['code'] == 1) echo '获取订单中';
                                        if ($sorting['code'] == 2) echo '未支付';
                                        if ($sorting['code'] == 3) echo '订单超时';
                                        if ($sorting['code'] == 4) echo '已支付'; ?>)<?php } ?><a
                                            href='<?php echo url::s('index/alipaygm/statisticOrder', "sorting=status&code=" . ($sorting['code'] + 1)); ?>'><i
                                                class="mdi-image-healing"></i></a></th>

                                <th>
                                    异步通知 <?php if ($sorting['code'] != -1 && $sorting['name'] == 'callback') { ?>(<?php if ($_GET['code'] == 0) echo '未回调';
                                        if ($_GET['code'] == 1) echo '已回调'; ?>)<?php } ?><a
                                            href='<?php echo url::s('index/alipaygm/statisticOrder', "sorting=callback&code=" . ($sorting['code'] + 1)); ?>'><i
                                                class="mdi-image-healing"></i></a></th>
                                <th>回调发送次数</th>
                                <th>回调来源</th>
                                <th>回调信息</th>
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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到订单!</td></tr>'; ?>

                            <?php foreach ($result['result'] as $ru) { ?>
                                <tr>
                                    <td>支付宝ID：<a
                                                href='<?php echo url::s("index/alipaygm/automatic"); ?>'><?php echo $ru['alipaygm_id']; ?></a>
                                        / 订单ID：<?php echo $ru['id']; ?> ( <a target="_blank"
                                                                             href="<?php echo url::s('gateway/pay/automaticalipaygm', "id={$ru['id']}"); ?>">支付链接</a>
                                        )
                                        <br>创建时间：<?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?>
                                    </td>

                                    <td>订单号码：<?php echo $ru['out_trade_no']; ?>
                                      </br>
                              系统订单号码：<?php echo $ru['trade_no']; ?>
                                        <br>订单信息：<span style="color:green;">
                            <?php echo $ru['alipaygm_id']; ?> | <?php echo $ru['id']; ?> </span>

                                    </td>

                                    <td>支付金额：<span
                                                style="color: green;"><b><?php echo $ru['amount']; ?></b> <?php echo $ru['callback_status'] == 1 ? " ( 利: " . ($ru['amount'] - $ru['fees']) . " )" : ''; ?></span>
                                        <br>支付状态：<?php
                                        if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                                        if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                                        if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                                        if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                                        ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s", $ru['pay_time']) . ')'; ?>
                                    </td>

                                    <td>
                                        <b>异步通知时间：</b> <?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无信息'; ?>
                                        <br>
                                        <b>异步通知状态：</b> <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?>
                                        <br>
                                    </td>
                                    <td><?php echo $ru['callback_count']; ?></td>
                                    <td><?php echo $ru['callback_from']; ?></td>
                                    <td>单笔接口费用：<?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '暂无信息'; ?>
                                        <br>
                                        接口返回信息：<span
                                                style="color:green;"><?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调'; ?>
                                            <br>

                            </span>


                                    <td><a onclick="reissue('<?php echo $ru['id']; ?>');" style="font-size: 14px;"
                                           class="btn waves-effect waves-light indigo"><i
                                                    class="mdi-action-lock-open left" style="width: 10px;"></i>手动补发</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <ul class="pagination"><?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?></ul>
                </div>

            </div>


        </div>


    </div>
    <!--end container-->

</section>
<!-- END CONTENT -->
<script type="text/javascript">
    function reissue(id) {
        swal({
                title: "订单通知",
                text: "手动补发也是需要扣除手续费,您是否要继续?",
                type: "info", showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "是的,我愿意承担手续费!"
            },
            function () {
                //开始请求支付宝登录
                $.get("<?php echo url::s('index/alipaygm/automaticReissue', "id=");?>" + id, function (result) {
                    if (result.code == '200') {
                        swal("支付宝提示", result.msg, "success");
                        setTimeout(function () {
                            location.href = '';
                        }, 1000);
                    } else {
                        swal("订单通知", result.msg, "error");
                    }
                });

            });
    }

    function trade_no(obj) {
        var s_time = new Date($('#start_time').val());
        var e_time = new Date($('#end_time').val());
        var start_time = s_time.getTime() / 1000;
        var end_time = e_time.getTime() / 1000;
        if (start_time || end_time) {
            location.href = "<?php echo url::s('index/alipaygm/statisticOrder', "sorting=trade_no&");?>"+'&start_time='+start_time + '&end_time=' + end_time;
        }else {
            location.href = "<?php echo url::s('index/alipaygm/statisticOrder', "sorting=trade_no&code=");?>" + $(obj).val();
        }
    }

    function alipaygm() {
        var alipaygm = $('#alipaygm').val();
        location.href = "<?php echo url::s('index/alipaygm/statisticOrder', "sorting=alipaygm&code=");?>" + alipaygm;
    }

    function exportData () {
        var code = GetQueryString('code');
        var start_time = GetQueryString('start_time');
        var end_time = GetQueryString('end_time');
        if (code) {
            location.href = "<?php echo url::s('index/alipaygm/export', "sorting=alipaygm&code=");?>" + code+ '&start_time='+start_time + '&end_time=' + end_time;
        }else {
            location.href = "<?php echo url::s('index/alipaygm/export', "sorting=alipaygm&start_time=");?>" + start_time + '&end_time=' + end_time;
        }
    }
    function GetQueryString(name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r!=null)return  unescape(r[2]); return null;
    }

</script>
<?php include_once(PATH_VIEW . 'common/footer.php'); ?>
