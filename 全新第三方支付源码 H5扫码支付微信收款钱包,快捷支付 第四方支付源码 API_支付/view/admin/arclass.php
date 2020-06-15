<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            公告分类
        </span>
        &nbsp;/&nbsp;
        <span>
            添加分类
        </span>
    </h3>
    <br>
    <div class="set set0">
      <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th width="100" class="text-center">
                        分类编号
                    </th>
                    <th>
                        分类名称
                    </th>
                    <th width="100" class="text-center">
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
                                <?php echo $val[ 'cname']?>
                            </td>
                            <td class="text-center">
                                <a href="javascript:;" onclick="showContent('编辑分类','<?php echo $this->dir?>arcate/edit/<?php echo $val['id']?>')"
                                data-toggle="tooltip" title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>arcate/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="3">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
    </div>
    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>arcate/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="cname" class="col-md-2 control-label">
                    分类名称：
                </label>
                <div class="col-md-4">
                    <input type="text" name="cname" id="cname" class="form-control" required="">
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>
    <?php require_once 'footer.php' ?>