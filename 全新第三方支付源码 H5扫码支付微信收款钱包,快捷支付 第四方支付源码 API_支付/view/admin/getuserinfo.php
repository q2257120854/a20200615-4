<style>
    table.customize{border-collapse: collapse;width:100%}table.customize td{height:
    40px;border-bottom:1px solid #ddd}table.customize td.title{color:#999;background:
    #fff}
</style>
<div class="panel panel-info">
    <div class="panel-heading">
        注册信息
    </div>
    <div class="panel-body">
        <table class="customize">
            <tr>
                <td class="title">
                    注册编号：
                </td>
                <td>
                    <?php echo $user['id']?>
                </td>
                <td class="title">
                    用户名：
                </td>
                <td>
                    <?php echo $user['username']?>
                </td>
            </tr>
            <tr>
                <td class="title">
                    已付款：
                </td>
                <td>
                    <?php echo $user['paid']?>
                        元
                </td>
                <td class="title">
                    未付余额：
                </td>
                <td>
                    <?php echo $user['unpaid']?>
                        元
                </td>
            </tr>
            <tr>
                <td class="title">
                    结算类型：
                </td>
                <td>
                    <?php echo $this->
                        setConfig->shipType($user['ship_type'])?>(
                        <?php echo $this->
                            setConfig->shipCycle($user['ship_cycle'])?>)
                </td>
                <td class="title">
                    开通提现：
                </td>
                <td>
                    <?php switch($user['is_takecash']){case '0': $state='<span class="label label-warning">未开通</span>'
                    ;break;case '1': $state='<span class="label label-success">已开通</span>'
                    ;break;}echo $state;?>
                </td>
            </tr>
            <tr>
                <td class="title">
                    注册时间：
                </td>
                <td>
                    <?php echo date( 'Y-m-d H:i:s',$user['addtime'])?>
                </td>
                <td class="title">
                    账号状态：
                </td>
                <td>
                    <?php switch($user['is_state']){case '0': $state='<span class="label label-warning">未开通</span>'
                    ;break;case '1': $state='<span class="label label-success">已开通</span>'
                    ;break;case '2': $state='<span class="label label-danger">已停用</span>' ;break;}echo
                    $state;?>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-warning">
    <div class="panel-heading">
        联系信息
    </div>
    <div class="panel-body">
        <table class="customize">
            <tr>
                <td class="title">
                    注册邮箱：
                </td>
                <td>
                    <?php echo $userinfo['email']?>
                </td>
                <td class="title">
                    邮箱验证：
                </td>
                <td>
                    <?php echo $user['is_verify_email'] ?
                    '<span class="label label-success">已验证</span>' : '<span class="label label-warning">未验证</span>' ?>
                </td>
            </tr>
            <tr>
                <td class="title">
                    站点名称：
                </td>
                <td>
                    <?php echo $userinfo['sitename']?>
                </td>
                <td class="title">
                    网站地址：
                </td>
                <td>
                    <?php echo $userinfo['siteurl'] ?>
                        &nbsp;
                        <a href="http://<?php echo $userinfo['siteurl'] ?>" target="_blank">
                            <span class="glyphicon glyphicon-link">
                            </span>
                        </a>
                </td>
            </tr>
            <tr>
                <td class="title">
                    手机号码：
                </td>
                <td>
                    <?php echo $userinfo['phone']?>
                </td>
                <td class="title">
                    手机验证：
                </td>
                <td>
                    <?php echo $user['is_verify_phone'] ?
                    '<span class="label label-success">已验证</span>' : '<span class="label label-warning">未验证</span>' ?>
                </td>
            </tr>
            <tr>
                <td class="title">
                    联系QQ：
                </td>
                <td>
                    <?php echo $userinfo['qq']?>
                        &nbsp;
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $userinfo['qq']?>&Site=&Menu=yes"
                        target="_blank">
                            <span class="glyphicon glyphicon-share">
                            </span>
                        </a>
                </td>
                <td class="title">
                    最后更新：
                </td>
                <td>
                    <?php echo date( 'Y-m-d H:i:s',$userinfo['lastime'])?>
                </td>
            </tr>
        </table>
    </div>
</div>