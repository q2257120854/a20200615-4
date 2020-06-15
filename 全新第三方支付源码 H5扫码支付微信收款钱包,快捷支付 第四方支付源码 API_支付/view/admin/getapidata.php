<style>
    table.customize{border-collapse: collapse;width:100%}table.customize td{height:
    40px;border-bottom:1px solid #ddd}table.customize td.title{color:#999;background:
    #fff}
</style>
<div class="panel panel-info">
    <div class="panel-heading">
        用户接入信息
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
                    接入密钥：
                </td>
                <td colspan="3">
                    <?php echo $user['apikey']?>
                        &nbsp;
                        <a href="<?php echo $this->dir?>users/resetapikey/<?php echo $user['id']?>">
                            <span class="glyphicon glyphicon-refresh" title="重新生成密钥">
                            </span>
                        </a>
                </td>
            </tr>
            <tr>
                <!--<td class="title">
                    收银台功能：
                </td>
                <td>
                    <?php echo $user['is_checkout'] ? '<span class="label label-success">已开通</span>' : '<span class="label label-warning">未开通</span>' ?>
                </td> -->
                <td class="title">
                    API功能：
                </td>
                <td>
                    <?php echo $user['is_paysubmit'] ? '<span class="label label-success">已开通</span>' : '<span class="label label-warning">未开通</span>' ?>
                </td>
            </tr>
        </table>
    </div>
</div>