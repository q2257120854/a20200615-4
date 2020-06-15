<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            通用网关
        </span>
        &nbsp;/&nbsp;
        <span>
            增加网关
        </span>
    </h3>
    <br>
    <div class="set set0 table-responsive">
 <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th class="text-center">
                        编号
                    </th>
                    <th>
                        网关名称
                    </th>
                    <th>
                        编号
                    </th>
                    <th>
                        卡密面值
                    </th>
                    <th>
                        卡密长度
                    </th>
                    <th>
                        图片
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
                                <?php echo $val[ 'name']?>
                            </td>
                            <td>
                                <?php echo $val[ 'code']?>
                            </td>
                            <td>
                                <?php echo $val[ 'price'] ? implode( '|',json_decode($val[ 'price'],true)) : '-'?>
                            </td>
                            <td class="text-center">
                                <?php echo $val[ 'length'] ? implode( '|',json_decode($val[ 'length'],true)) : '-'?>
                            </td>
                            <td class="text-center">
                                <?php echo $val[ 'img'] ? '<img src="/static/payimg/'.$val[ 'img'].'">' : '-'?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo $this->dir?>acw/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>acw/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="7">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
    </div>
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acw/save"
        method="post">
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    网关名称：
                </label>
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    网关编号：
                </label>
                <div class="col-md-4">
                    <input type="text" name="code" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    卡密面值：
                </label>
                <div class="col-md-4">
                    <input type="text" name="price" class="form-control" placeholder="非点卡可为空">
                </div>
                <span class="col-md-4">
                    格式为 50|100
                </span>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    卡密长度：
                </label>
                <div class="col-md-4">
                    <input type="text" name="length" class="form-control" placeholder="可为空">
                </div>
                <span class="col-md-4">
                    格式为 10|12
                </span>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">
                    图片名称：
                </label>
                <div class="col-md-4">
                    <input type="text" name="img" class="form-control" placeholder="非点卡可为空">
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