<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            登录日志
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="uname" placeholder="管理员账号"
                    value="<?php echo $search['uname'] ?>" size="12">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="ip" placeholder="IP" value="<?php echo $search['ip'] ?>"
                    size="14">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                        <input size="16" type="text" name="fdate" readonly class="form_datetime form-control"
                        value="<?php echo $search['fdate']?>">
                        <span class="input-group-addon">
                            至
                        </span>
                        <input size="16" type="text" name="tdate" readonly class="form_datetime form-control"
                        value="<?php echo $search['tdate']?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">
                    </span>
                    &nbsp;立即查询
                </button>
            </form>
        </div>
    </div>
<div class="table-responsive">
<table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th class="text-center">
                        编号
                    </th>
                    <th>
                        账号名称
                    </th>
                    <th>
                        IP
                    </th>
                    <th>
                        日期
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
                                <?php echo $val[ 'id']?>
                            </td>
                            <td>
                                <?php echo $val[ 'adminname']?>
                            </td>
                            <td>
                                <?php echo $val[ 'ip']?>
                                    &nbsp;
                                    <a href="http://www.baidu.com/s?wd=<?php echo $val['ip']?>" target="_blank">
                                        <span class="glyphicon glyphicon-link">
                                        </span>
                                    </a>
                            </td>
                            <td>
                                <?php echo date( 'm-d H:i:s',$val[ 'addtime'])?>
                            </td>
                            <td class="text-center">
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>logs/del')"
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
    </div>
    <?php echo $lists ? $pagelist : ''?>
        <br>
        <?php require_once 'footer.php' ?>