<?php require_once 'header.php'?>
<h3><span class="current">订单列表</span>&nbsp;&nbsp;</h3>
<br>
<div class="panel panel-default">
<div class="panel-body">
<form class="form-inline" action="" method="get">
<div class="row"><div class="col-md-12">
<div class="form-group">
<select name="is_state" class="form-control">
<option value="-1"<?php echo $search['is_state'] == '-1' ? ' selected' : '' ?>>全部订单状态</option>
<option value="0"<?php echo $search['is_state'] == '0' ? ' selected' : '' ?>>未付款</option>
<option value="1"<?php echo $search['is_state'] == '1' ? ' selected' : '' ?>>已付款</option>
<option value="3"<?php echo $search['is_state'] == '3' ? ' selected' : '' ?>>已关闭</option>
<option value="2"<?php echo $search['is_state'] == '2' ? ' selected' : '' ?>>已冻结</option>
</select></div>
<div class="form-group">
<select name="is_checkout" class="form-control">
<option value="-1"<?php echo $search['is_checkout'] == '-1' ? ' selected' : '' ?>>全部接入源</option>
<option value="0"<?php echo $search['is_checkout'] == '0' ? ' selected' : '' ?>>商户接入</option>
<option value="1"<?php echo $search['is_checkout'] == '1' ? ' selected' : '' ?>>收银台</option>
</select></div>
<div class="form-group">
<input type="text" class="form-control" name="kw" placeholder="用户名/编号" value="<?php echo $search['kw'] ?>"></div>
<div class="form-group">
<input type="text" class="form-control" name="orderid" placeholder="平台订单号" value="<?php echo $search['orderid'] ?>"></div>
<div class="form-group">
<input type="text" class="form-control" name="sdorderno" placeholder="商户订单号" value="<?php echo $search['sdorderno'] ?>"></div></div>
<div class="col-md-10" style="margin-top:10px"><div class="form-group">
<select class="form-control" name="accid">
<option value="0">全部通道</option>
<?php foreach ($acc as $key => $val): ?>
<option value="<?php echo $val['id'] ?>"<?php echo $val['id'] == $search['accid'] ? ' selected' : '' ?>>
<?php echo $val['name'] ?></option>
<?php endforeach; ?></select></div>
<div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input size="16" type="text" name="fdate" readonly class="form_datetime form-control" value="<?php
echo $search['fdate'] ?>"><span class="input-group-addon">至</span><input size="16" type="text" name="tdate" readonly class="form_datetime form-control" value="<?php
echo $search['tdate'] ?>"></div></div>
<div class="form-group">
<select name="is_notify" class="form-control">
<option value="-1"<?php echo $search['is_notify'] == '-1' ? ' selected' : '' ?>>全部通知状态</option>
<option value="0"<?php echo $search['is_notify'] == '0' ? ' selected' : '' ?>>等待</option>
<option value="1"<?php echo $search['is_notify'] == '1' ? ' selected' : '' ?>>成功</option>
<option value="2"<?php echo $search['is_notify'] == '2' ? ' selected' : '' ?>>失败</option>
</select></div></div><div style="margin-left:14px;"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;立即查询</button></div>
</div></form></div></div>
<div style="margin-top:20px;margin-bottom:20px;text-align:center;font-size:12px;color:#666">提交订单数：<span class="blue"><?php
echo $count['total_orders'] ?></span>&nbsp;&nbsp;订单总金额：<span class="blue">&yen; <?php
echo number_format($count['total_money'], 2, '.', '') ?></span>&nbsp;&nbsp;已付订单数：<span class="green"><?php
echo $count['success_orders'] ?></span>&nbsp;&nbsp;已付总金额：<span class="green">&yen; <?php
echo number_format($count['success_money'], 2, '.', '') ?></span>&nbsp;&nbsp;用户收入：<span class="green">&yen; <?php
echo number_format($count['income_user'], 2, '.', '') ?></span>&nbsp;&nbsp;平台收入：<span class="green">&yen; <?php
echo number_format($count['income_pt'], 2, '.', '') ?></span>&nbsp;&nbsp;未付订单数：<span class="red"><?php
echo $count['total_orders'] - $count['success_orders'] ?></span>&nbsp;&nbsp;未付总金额：<span class="red">&yen; <?php
echo number_format($count['total_money'] - $count['success_money'], 2, '.', '') ?></span>&nbsp;&nbsp;</div>
<div class="table-responsive"><table id="table-6" class="table table-hover ">
<thead><tr class="info"><th width="100">用户编号</th><th>接入源</th><th>代理编号</th><th width="166">平台订单号</th><th>商户订单号</th><th>订单金额</th><th>实付金额</th><th>支付方式</th><th>商户收入</th><th>代理收入</th><th>平台收入</th><th>提交时间</th><th>处理时间</th><th>订单状态</th><th>通知状态</th><th>操作</th></tr></thead>
		  <tbody><?php if ($lists): ?>
<?php
    foreach ($lists as $key => $val):
        switch ($val['is_state']) {
            case '0':
                $state = '<span class="label label-warning">未付</span>';
                break;

            case '1':
                $state = '<span class="label label-success">已付</span>';
                break;

            case '2':
                $state = '<span class="label label-danger">冻结</span>';
                break;

            case '3':
                $state = '<span class="label label-default">关闭</span>';
                break;
        }
        $acc = $this->model()->select('name')->from('acc')->where(array(
            'fields' => 'id=?',
            'values' => array(
                $val['channelid']
            )
        ))->fetchRow();
        $accname = $acc ? $acc['name'] : '-';
        $notifyMsg = '-';
        $notify = $this->model()->select('is_status')->from('ordernotify')->where(array(
            'fields' => 'orid=?',
            'values' => array(
                $val['id']
            )
        ))->fetchRow();
        if ($notify) {
            switch ($notify['is_status']) {
                case '0':
                    $notifyMsg = '<span class="label label-warning">等待</span>';
                    break;

                case '1':
                    $notifyMsg = '<span class="label label-success">成功</span>';
                    break;

                case '2':
                    $notifyMsg = '<span class="label label-danger">失败</span>';
                    break;
            }
        } ?><tr data-id="<?php
        echo $val['id'] ?>"><td><div class="dropdown"><a href="javascript:;" class="dropdown-toggle" id="menulist" data-toggle="dropdown" aria-expanded="true"><?php
        echo $val['userid'] ?><span class="caret"></span><ul class="dropdown-menu" aria-labelledby="menulist"><li><a href="javascript:;" onclick="showContent('基本信息','<?php
        echo $this->dir ?>users/getuserinfo/<?php
        echo $val['userid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;基本信息</a></li><li><a href="javascript:;" onclick="showContent('设置分成比率','<?php
        echo $this->dir ?>users/getuserprice/<?php
        echo $val['userid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;分成比率</a></li><li><a href="javascript:;" onclick="showContent('收款信息','<?php
        echo $this->dir ?>users/getbadata/<?php
        echo $val['userid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;收款信息</a></li><li><a href="javascript:;" onclick="showContent('接入信息','<?php
        echo $this->dir ?>users/getapidata/<?php
        echo $val['userid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;接入信息</a></li><li><a href="<?php
        echo $this->dir ?>userlogs/?uname=<?php
        echo $val['userid'] ?>"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;登陆日志</a></li></ul></div></td><td><?php
        echo $val['is_paytype'] == '1' ? '收银台商户' : '线上商户' ?></td><td><?php
        if ($val['agentid']): ?><div class="dropdown"><a href="javascript:;" class="dropdown-toggle" id="menulist" data-toggle="dropdown" aria-expanded="true"><?php
            echo $val['agentid'] ?><span class="caret"></span><ul class="dropdown-menu" aria-labelledby="menulist"><li><a href="javascript:;" onclick="showContent('基本信息','<?php
            echo $this->dir ?>users/getuserinfo/<?php
            echo $val['agentid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;基本信息</a></li><li><a href="javascript:;" onclick="showContent('设置分成比率','<?php
            echo $this->dir ?>users/getuserprice/<?php
            echo $val['agentid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;分成比率</a></li><li><a href="javascript:;" onclick="showContent('收款信息','<?php
            echo $this->dir ?>users/getbadata/<?php
            echo $val['agentid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;收款信息</a></li><li><a href="javascript:;" onclick="showContent('接入信息','<?php
            echo $this->dir ?>users/getapidata/<?php
            echo $val['agentid'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;接入信息</a></li></ul></div><?php
        else: ?>-<?php
        endif; ?></td><td><div class="dropdown"><a href="javascript:;" class="dropdown-toggle" id="menulist" data-toggle="dropdown" aria-expanded="true"><?php
        echo $val['orderid'] ?><span class="caret"></span><ul class="dropdown-menu" aria-labelledby="menulist"><li><a href="javascript:;" onclick="showContent('订单详情','<?php
        echo $this->dir ?>orders/getorderinfo/<?php
        echo $val['id'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;订单详情</a></li><li><a href="javascript:;" onclick="showContent('通知详情','<?php
        echo $this->dir ?>orders/getnotifyinfo/<?php
        echo $val['id'] ?>')"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;通知详情</a></li></ul></div></td><td><?php
        echo $val['sdorderno'] ?><br><span class="gray"><?php
        echo $val['remark'] ?></span></td><td><?php
        echo $val['total_fee'] ?></td><td class="green"><?php
        echo $val['realmoney'] ?></td><td class="gray"><?php
        echo $accname ?></td><td class="blue"><?php
        echo $val['uprice'] * $val['realmoney'] ?></td><td class="red"><?php
        echo $val['gprice'] > 0 ? ($val['gprice'] - $val['uprice']) * $val['realmoney'] : '0.00' ?></td><td class="green"><?php
        echo $val['gprice'] > 0 ? ($val['wprice'] - $val['gprice']) * $val['realmoney'] : ($val['wprice'] - $val['uprice']) * $val['realmoney'] ?></td><td><?php
        echo date('m-d H:i:s', $val['addtime']) ?></td><td><?php
        echo date('m-d H:i:s', $val['lastime']) ?></td><td class="state<?php
        echo $val['id'] ?>"><?php
        echo $state ?></td><td><?php
        echo $notifyMsg ?></td><td width="70"><a href="javascript:;" onclick="pushOrder('<?php
        echo $val['orderid'] ?>')"  data-toggle="tooltip" title="通知"><span class="glyphicon glyphicon-refresh"></span></a>&nbsp;<a href="javascript:;" onclick="del(<?php
        echo $val['id'] ?>,'<?php
        echo $this->dir ?>orders/del')" data-toggle="tooltip" title="删除"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;<a href="javascript:;" onclick="freeze(<?php
        echo $val['id'] ?>,'<?php
        echo $this->dir ?>orders/freeze')" data-toggle="tooltip" class="freeze<?php
        echo $val['id'] ?>" title="<?php
        echo $val['freeze'] ? '还原' : '冻结' ?>订单"><?php
        echo $val['freeze'] ? '还' : '冻' ?></a></td></tr><?php
    endforeach; ?><?php
else: ?><tr><td colspan="16">no data.</td><?php
endif; ?></tbody></table></div><?php
echo $lists ? $pagelist : '' ?><br><br><script>function pushOrder(orderid){$.post('<?php
echo $this->dir ?>orders/notify',{orderid:orderid,t:new Date().getTime()},function(ret){alert('收到回复：\r\n'+ret);});}</script>
<?php require_once 'footer.php' ?>     
