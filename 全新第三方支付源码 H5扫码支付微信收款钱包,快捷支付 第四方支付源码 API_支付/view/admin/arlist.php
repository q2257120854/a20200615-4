<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            公告列表
        </span>
        &nbsp;/&nbsp;
        <span>
            添加公告
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
                        公告标题
                    </th>
                    <th>
                        公告分类
                    </th>
                    <th>
                        发布状态
                    </th>
                    <th>
                        发布日期
                    </th>
                    <th class="text-center">
                        公告操作
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
                                <?php echo $val[ 'title']?>
                            </td>
                            <td>
                                <?php echo $val[ 'cname']?>
                            </td>
                            <td>
                                <?php echo $val[ 'is_state'] ?
                                '<span class="label label-success">正式发布</span>' : '<span class="label label-danger">暂不发布</span>' ?>
                            </td>
                            <td>
                                <?php echo date( 'm-d H:i:s',$val[ 'addtime'])?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo $this->dir?>arlist/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>arlist/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="6">
                                        no data.
                                    </td>
                                </tr>
                                <?php endif;?>
            </tbody>
        </table>
        <?php echo $lists ? $pagelist : ''?>
    </div>
    <script charset="utf-8" src="/view/editor170814/kindeditor-min.js">
    </script>
    <script charset="utf-8" src="/view/editor170814/lang/zh_CN.js">
    </script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                allowFileManager: false,
            });
        });
    </script>
    <div class="set set1 hide">
        <form class="form-horizontal" action="<?php echo $this->dir?>arlist/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="cname" class="col-md-2 control-label">
                    分类名称：
                </label>
                <div class="col-md-6">
                    <select name="cid" class="form-control">
                        <?php if($class):?>
                            <?php foreach($class as $key=>
                                $val):?>
                                <option value="<?php echo $val['id']?>">
                                    <?php echo $val[ 'cname']?>
                                </option>
                                <?php endforeach;?>
                                    <?php endif;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-md-2 control-label">
                    公告标题：
                </label>
                <div class="col-md-6">
                    <input type="text" name="title" id="title" class="form-control" required=>
                </div>
            </div>
            <div class="form-group">
                <label for="addtime" class="col-md-2 control-label">
                    发布日期：
                </label>
                <div class="col-md-6">
                    <input type="text" name="addtime" id="addtime" class="form-control" required
                    value="<?php echo date('Y-m-d H:i:s')?>">
                </div>
            </div>
            <div class="form-group">
                <label for="cname" class="col-md-2 control-label">
                    公告内容：
                </label>
                <div class="col-md-10">
                    <textarea name="content" style="width:100%;height:300px;">
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="is_state" class="col-md-2 control-label">
                    设置状态：
                </label>
                <div class="col-md-6">
                    <select name="is_state" class="form-control">
                        <option value="1">
                            正式发布
                        </option>
                        <option value="0">
                            暂不发布
                        </option>
                    </select>
                </div>
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