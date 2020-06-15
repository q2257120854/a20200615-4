<?php
use xh\library\url;
use xh\library\model;
use xh\library\ip;

include_once(PATH_VIEW . 'common/header.php'); //头部
include_once(PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>

<!-- START CONTENT -->
<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">

        <ol class="breadcrumb">
            <li><a href="<?php echo url::s('admin/index/home'); ?>">控制台</a></li>
            <li class="active">支付宝订单</li>
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
                        交易订单 [ <b>统计:</b> <?php //查询今日收入
                        $where_call =  $where;
                        $where_call = trim(trim($where_call), 'and');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipaygm_automatic_orders where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                        ?>]
                    </div>

                    <style>
                        input {
                            width: 80px;
                        }
                    </style>
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
                                    <th>开始时间: <input type="date" style="width:150px" name="start_time" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>"></th>
                                    <th>结束时间： <input type="date" style="width:150px" name="end_time" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>"></th>
                                    <th>支付宝ID：<input type="text" name="alipaygm_id" value="<?php if(!empty($_GET['alipaygm_id'])){  echo $_GET['alipaygm_id']; }?>"></th>
                                    <th>商户ID: <input type="text" name="user_id" value="<?php if(!empty($_GET['user_id'])){  echo $_GET['user_id']; }?>"></th>
                                    <th>支付状态
                                        <select name="status">
                                            <option value="0" <?php if($_GET['status'] != 4){ echo 'selected';} ?>>全部</option>
                                            <option value="4" <?php if($_GET['status'] == 4){ echo 'selected';} ?>>已支付</option>
                                        </select>
                                    </th>
                                    <th><input type="submit" value="查询"></th>
                                </form>
                            </tr>
                            <tr>
                                <td>支付宝ID</td>
                                <th>
                                    订单信息
                                </th>
                                <th>
                                    支付信息
                                </th>
                                <th>
                                    商户信息
                                </th>
                                <th>
                                    异步通知
                                </th>
                                <th>回调信息</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="7" style="text-align: center;">暂时没有查询到订单!</td></tr>'; ?>

                            <?php foreach ($result['result'] as $ru) { ?>
                                <tr>
                                    <td>支付宝ID：<a
                                                href='<?php echo url::s("admin/alipaygm/automatic", "id={$ru['alipaygm_id']}"); ?>'><?php echo $ru['alipaygm_id']; ?></a>
                                        <br>创建时间：<?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?>
                                    </td>

                                    <td>订单号码：<?php echo $ru['trade_no']; ?>
                                        <br>订单信息：<span style="color:green;">

                         <?php echo $ru['alipaygm_id']; ?> | <?php echo $ru['id']; ?>

                     </span>
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

                                    <td>商户信息：<?php $userInfo = $mysql->query("client_user", "id={$ru['user_id']}")[0];
                                        echo is_array($userInfo) ? '<a href="' . url::s("admin/alipaygm/automaticOrder", "sorting=user&code={$userInfo[id]}&locking=true") . '"><span style="color:green;font-size:14px;font-weight:bold;">' . $userInfo['username'] . '</span></a>' . ' ( 商户ID: ' . $userInfo['id'] . ' ) ' : '<span style="color:red;font-size:8px;">会员不存在</span>'; ?>
                                        <br>手机号码：<span
                                                style="color:green;"><?php echo is_array($userInfo) ? $userInfo['phone'] : '无'; ?></span>
                                    </td>

                                    <td>
                                        <b>异步通知时间：</b> <?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无信息'; ?>
                                        <br>
                                        <b>异步通知状态：</b> <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?>
                                        <br>
                                    </td>

                                    <td>单笔接口费用：<?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '暂无信息'; ?>
                                        <br>接口返回信息：<span
                                                style="color:green;"><?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调'; ?></span>


                                </tr>
                            <?php } ?>
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
                            $.get("<?php echo url::s('admin/alipaygm/automaticReissue', "id=");?>" + id, function (result) {
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
                    location.href = "<?php echo url::s('admin/alipaygm/automaticOrder', "sorting=trade_no&code=");?>" + $(obj).val();
                }

                function member(obj) {
                    location.href = "<?php echo url::s('admin/alipaygm/automaticOrder', "sorting=user&locking=true&code=");?>" + $(obj).val();
                }

                function wechat() {
                    var wechat = $('#wechat').val();
                    console.log(wechat);
                    location.href = "<?php echo url::s('admin/alipaygm/automaticOrder', "sorting=alipaygm&code=");?>" + wechat;

                }

                function exportDoc () {
                    var alipaygm_id = GetQueryString('alipaygm_id');
                    var user_id = GetQueryString('user_id');
                    var status = GetQueryString('status');
                    var start_time = GetQueryString('start_time');
                    var end_time = GetQueryString('end_time');
                    location.href = "<?php echo url::s('admin/alipaygm/export', "user_id=");?>" + user_id+ '&start_time='+start_time + '&end_time=' + end_time + '&status=' + status + 'alipaygm_id=' + alipaygm_id;
                }
                function GetQueryString(name)
                {
                    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                    var r = window.location.search.substr(1).match(reg);
                    if(r!=null)return  unescape(r[2]); return null;
                }
                function del(id) {
                    swal({
                            title: "支付宝提醒",
                            text: "你确定要删除该订单吗？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要删除该订单!",
                            closeOnConfirm: false
                        },
                        function () {
                            $.get("<?php echo url::s('admin/alipaygm/automaticOrderDelete', 'id=');?>" + id, function (result) {

                                if (result.code == '200') {
                                    swal("操作提示", result.msg, "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1500);
                                } else {
                                    swal("操作提示", result.msg, "error");
                                }
                            });


                        });
                }


                function deletes() {
                    swal({
                            title: "非常危险",
                            text: "你确定要批量删除已选中的订单吗？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要删除这些订单!",
                            closeOnConfirm: false
                        },
                        function () {
                            $("input[name='items']:checked").each(function () {
                                $.get("<?php echo url::s('admin/alipaygm/automaticOrderDelete', 'id=');?>" + $(this).val(), function (result) {
                                    swal("操作提示", '当前操作已经执行完毕!', "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1500);
                                });
                            });

                        });

                }


                function callback() {
                    swal({
                            title: "危险操作",
                            text: "你确定你要以管理员的方式回调已勾选过的订单？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要帮助这些订单回调!",
                            closeOnConfirm: false
                        },
                        function () {
                            $("input[name='items']:checked").each(function () {
                                $.get("<?php echo url::s('admin/alipaygm/callback', 'id=');?>" + $(this).val(), function (result) {
                                    swal("操作提示", '当前操作已经执行完毕!', "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1000);
                                });
                            });

                        });

                }


                function showBtn() {
                    var Inc = 0;
                    $("input[name='items']:checkbox").each(function () {
                        if (this.checked) {
                            $('#deletes').show();
                            $('#callback').show();
                            return true;
                        }
                        Inc++;
                    });
                    if ($("input[name='items']:checkbox").length == Inc) {
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

    <?php include_once(PATH_VIEW . 'common/footer.php'); ?>

</div>
<!-- End Content -->

<?php include_once(PATH_VIEW . 'common/chat.php'); ?>

<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW; ?>/static/console/js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="<?php echo URL_VIEW; ?>/static/console/js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW; ?>/static/console/js/plugins.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="<?php echo URL_VIEW; ?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript"
        src="<?php echo URL_VIEW; ?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>

<script>


    $(function () {
        //实现全选与反选
        $("#checkboxAll").click(function () {
            if (this.checked) {
                $("input[name='items']:checkbox").each(function () {
                    $(this).prop("checked", true);
                });
                showBtn();
            } else {
                $("input[name='items']:checkbox").each(function () {
                    $(this).prop("checked", false);
                });
                showBtn();
            }
        });
    });
</script>

</body>
</html>