<style>
    table.customize{border-collapse: collapse;width:100%}table.customize td{height:
    40px;border-bottom:1px solid #ddd}table.customize td.title{color:#999;background:
    #fff}
</style>
<div class="panel panel-info">
    <div class="panel-heading">
        收款信息
    </div>
    <div class="panel-body">
        <?php if($cfoid):?>
            <table class="customize">
                <tr>
                    <td class="title">
                        注册编号：
                    </td>
                    <td>
                        <?php echo $user['id']?>
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
                <tr>
                    <td class="title">
                        银行名称：
                    </td>
                    <td>
                        <?php echo $userinfo['bankname']?>
                    </td>
                    <td class="title">
                        支行名称：
                    </td>
                    <td>
                        <?php echo $userinfo['branchname']?>
                    </td>
                </tr>
                <tr>
                    <td class="title">
                        账号名称：
                    </td>
                    <td>
                        <?php echo $userinfo['accountname']?>
                    </td>
                    <td class="title">
                        收款账号：
                    </td>
                    <td>
                        <?php echo $userinfo['cardno']?>
                    </td>
                </tr>
                <tr>
                    <td class="title">
                        开户地址：
                    </td>
                    <td colspan="3">
                        <?php echo $userinfo['provice']?>
                            <?php echo $userinfo['city']?>
                    </td>
                </tr>
            </table>
            <?php else:?>
                <table class="customize">
                    <tr>
                        <td class="title">
                            注册编号：
                        </td>
                        <td>
                            <?php echo $user['id']?>
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
                    <tr>
                        <td class="title">
                            真实姓名：
                        </td>
                        <td>
                            <?php echo $userinfo['realname']?>
                        </td>
                        <td class="title">
                            身份证号：
                        </td>
                        <td>
                            <?php echo $userinfo['idcard']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title">
                            收款方式：
                        </td>
                        <td>
                            <?php echo $userinfo['batype']?>
                        </td>
                        <td class="title">
                            收款账号：
                        </td>
                        <td>
                            <?php echo $userinfo['baname']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title">
                            开户地址：
                        </td>
                        <td colspan="3">
                            <?php echo $userinfo['baaddr']?>
                        </td>
                    </tr>
                </table>
                <?php endif;?>
    </div>
</div>