<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            接入网关列表
        </span>
        &nbsp;/&nbsp;
        <span>
            增加网关
        </span>
    </h3>
    <br>
    <div class="set set0">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" action="" method="get">
                    <div class="form-group">
                        <select name="acpcode" class="form-control">
                            <option value="">
                                全部接入商
                            </option>
                            <?php foreach($acp as $key=>$val):?>
                                <option value="<?php echo $val['code']?>" <?php echo $search['acpcode']==$val['code'] ? 'selected' : ''?>>
                                    <?php echo $val['name']?>
                                </option>
                                <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="acwid" class="form-control">
                            <option value="">
                                全部通用网关
                            </option>
                            <?php foreach($acw as $key=>$val):?>
                                <option value="<?php echo $val['id']?>" <?php echo $search['acwid']==$val['id'] ? 'selected' : ''?>>
                                    <?php echo $val['name']?>
                                </option>
                                <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="gateway" placeholder="接入网关"
                        value="<?php echo $search['gateway']?>">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search">
                        </span>
                        &nbsp;立即查询
                    </button>
                </form>
            </div>
        </div>
     <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th class="text-center">
                        编号
                    </th>
                    <th>
                        接入编号
                    </th>
                    <th>
                        接入网关
                    </th>
                    <th>
                        通用网关
                    </th>
                    <th class="text-center">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):?>
                        <tr data-id="<?php echo $val['id']?>">
                            <td class="text-center">
                                <?php echo $val['id']?>
                            </td>
                            <td>
                                <?php echo $val['acpcode']?>
                            </td>
                            <td>
                                <?php echo $val['gateway']?>
                            </td>
                            <td>
                                <?php echo $val['name']?>
                                    (
                                    <?php echo $val['acwid']?>
                                        )
                            </td>
                            <td class="text-center">
                                <a href="<?php echo $this->dir?>acl/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>acl/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="5">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
        <div style="margin-bottom:50px">
            <?php echo $lists ? $pagelist : ''?>
        </div>
    </div>
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acl/save"
        method="post">
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入商：
                </label>
                <div class="col-md-4">
                    <select name="acpcode" class="form-control">
                        <?php foreach($acp as $key=>$val):?>
                            <option value="<?php echo $val['code']?>">
                                <?php echo $val['name']?>
                            </option>
                            <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    通用网关：
                </label>
                <div class="col-md-4">
                    <select name="acwid" class="form-control">
                        <?php foreach($acw as $key=>$val):?>
                            <option value="<?php echo $val['id']?>">
                                <?php echo $val['name']?>
                            </option>
                            <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    接入网关：
                </label>
                <div class="col-md-4">
                    <input type="text" name="gateway" class="form-control" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php require_once 'footer.php' ?>