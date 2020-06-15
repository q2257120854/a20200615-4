<form action="/agent/users/setuserrate/<?php echo $userid ?>" method="post">
    <input type="hidden" name="saveset" value="1">
    <table class="table table-hover">
        <thead>
            <tr class="info">
                <th>
                    通道名称
                </th>
                <th>
                    当前状态
                </th>
                <th>
                    商户费率
                </th>
                <th>
                    您的费率
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if($userprice):?>
                <?php foreach($userprice as $key=>$val):$acc=$this->model()->select('name')->from('acc')->where(array('fields'=>'id=?','values'=>array($val['channelid'])))->fetchRow();?>
                    <tr>
                        <td>
                            <?php echo $acc[ 'name']?>
                        </td>
                        <td>
                            <?php if($val[ 'is_state']=='0' ):?>
                                <span class="label label-success">
                                    <span class="glyphicon glyphicon-ok">
                                    </span>
                                </span>
                                <?php else:?>
                                    <span class="label label-danger">
                                        <span class="glyphicon glyphicon-remove">
                                        </span>
                                    </span>
                                    <?php endif;?>
                        </td>
                        <td>
                            <input type="hidden" name="accid[]" value="<?php echo $val['channelid']?>">
                            <input type="text" name="uprice[]" class="form-control" size="5" maxlength="6"
                            value="<?php echo $val['uprice']?>">
                        </td>
                        <td>
                            <?php foreach($agentprice as $key2=>$val2):?>
                                <?php if($val2[ 'channelid']==$val[ 'channelid']):?>
                                    <?php echo $val2[ 'gprice']?>
                                        <?php endif;?>
                                            <?php endforeach;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                        <?php endif;?>
        </tbody>
    </table>
    <div class="text-center">
        <button type="submit" class="btn btn-success">
            &nbsp;
            <span class="glyphicon glyphicon-save">
            </span>
            &nbsp;保存设置&nbsp;
        </button>
    </div>
    <br>
</form>