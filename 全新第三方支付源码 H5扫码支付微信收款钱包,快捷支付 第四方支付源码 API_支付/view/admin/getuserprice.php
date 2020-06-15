<form action="<?php echo $this->dir?>users/saveprice/<?php echo $userid?>"
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
                    用户分成
                </th>
                <th>
                    设置状态
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if($data):?>
                <?php foreach($data as $key=>
                    $val):?>
                    <tr>
                        <td class="text-center">
                            <?php echo $val[ 'id']?>
                        </td>
                        <?php $acc=$this->model()->select('id,name,is_display')->from('acc')->where(array('fields'=>'acwid=?','values'=>array($val['acwid'])))->fetchAll();if($acc):?>
                            <td>
                                <select name="channelid[<?php echo $val['id']?>]" class="form-control">
                                    <?php foreach($acc as $key2=>$val2):?>
                                        <option value="<?php echo $val2['id']?>" <?php echo $val2[ 'id']==$val['id'] ? ' selected' : ''?>
                                            >
                                            <?php echo $val2[ 'name']?>
                                                <?php echo $val2[ 'is_display']==1 ? '(非默认)' : ''?>
                                        </option>
                                        <?php endforeach;?>
                                </select>
                            </td>
                            <?php endif;?>
                                <td>
                                    <?php echo isset($val[ 'uprice_default']) ? $val[ 'uprice_default'] :
                                    $val[ 'uprice']?>
                                </td>
                                <td>
                                    <input type="text" class="form-control" size="4" name="uprice[<?php echo $val['id']?>]"
                                    value="<?php echo $val['uprice']?>">
                                </td>
                                <td>
                                    <select name="is_state[<?php echo $val['id']?>]" class="form-control">
                                        <option value="0" <?php echo $val[ 'is_state']=='0' ? ' selected' : ''?>
                                            >已开通
                                        </option>
                                        <option value="1" <?php echo $val[ 'is_state']=='1' ? ' selected' : ''?>
                                            >已暂停
                                        </option>
                                    </select>
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
        <a onclick="if(!confirm('是否要执行此操作？'))return false;" href="<?php echo $this->dir?>users/resetprice/<?php echo $userid?>"
        class="btn btn-danger">
            <span class="glyphicon glyphicon-refresh">
            </span>
            &nbsp;重置分成
        </a>
    </div>
    <br>
</form>