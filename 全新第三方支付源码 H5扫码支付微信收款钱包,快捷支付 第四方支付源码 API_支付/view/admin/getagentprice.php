<form action="<?php echo $this->dir?>agent/saveprice/<?php echo $userid?>"
method="post">
    <table class="table table-hover">
        <thead>
            <tr class="info">
                <th>
                    编号
                </th>
                <th>
                    通道名称
                </th>
                <th>
                    默认分成
                </th>
                <th>
                    代理分成
                </th>
                <th>
                    设置状态
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if($data):?>
                <?php foreach($data as $key=>$val):?>
                    <tr>
                        <td>
                            <?php echo $val[ 'id']?>
                        </td>
                        <td>
                            <?php echo $val[ 'name']?>
                        </td>
                        <td>
                            <?php echo isset($val[ 'gprice_default']) ? $val[ 'gprice_default'] :
                            $val[ 'gprice']?>
                        </td>
                        <td>
                            <input type="text" class="form-control" size="4" name="gprice[<?php echo $val['id']?>]"
                            value="<?php echo $val['gprice']?>">
                        </td>
                        <td>
                            <?php if($val[ 'is_state']=='0' ):?>
                                <div class="label label-success" data-toggle="tooltip" title="已开通">
                                    <span class="glyphicon glyphicon-ok">
                                    </span>
                                </div>
                                <?php else:?>
                                    <div class="label label-danger" data-toggle="tooltip" title="已关闭">
                                        <span class="glyphicon glyphicon-remove">
                                        </span>
                                    </div>
                                    <?php endif;?>
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
        &nbsp;&nbsp;
        <a onclick="if(!confirm('是否要执行此操作？'))return false;" href="<?php echo $this->dir?>agent/resetprice/<?php echo $userid?>"
        class="btn btn-danger">
            <span class="glyphicon glyphicon-refresh">
            </span>
            &nbsp;重置分成
        </a>
    </div>
    <br>
</form>