<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            邮件模板
        </span>
        &nbsp;/&nbsp;
        <span>
            添加模板
        </span>
    </h3>
    <br>
    <div class="set set0">
     <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th>
                        编号
                    </th>
                    <th>
                        模板名称
                    </th>
                    <th>
                        标题
                    </th>
                    <th>
                        状态
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):?>
                        <tr data-id="<?php echo $val['id']?>">
                            <td>
                                <?php echo $val['id']?>
                            </td>
                            <td>
                                <?php echo $val['cname']?>
                            </td>
                            <td>
                                <?php echo $val['title']?>
                            </td>
                            <td>
                                <?php if($val['is_state']=='1' ):?>
                                    <span class="label label-danger">
                                        已停用
                                    </span>
                                    <?php else:?>
                                        <span class="label label-success">
                                            可使用
                                        </span>
                                        <?php endif;?>
                            </td>
                            <td>
                                <a href="<?php echo $this->dir?>mailtpl/edit/<?php echo $val['id']?>"
                                data-toggle="tooltip" title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>mailtpl/del')"
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
    <script charset="utf-8" src="/view/editor4/kindeditor-min.js">
    </script>
    <script charset="utf-8" src="/view/editor4/lang/zh_CN.js">
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
        <div class="alert alert-info">
            用户名：{username}&nbsp;用户编号：{userid}&nbsp;邮箱地址：{email}&nbsp;网址url：{url}&nbsp;日期时间：{time}&nbsp;平台名称：{sitename}&nbsp;金额：{money}
        </div>
        <form class="form-horizontal" action="<?php echo $this->dir?>mailtpl/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label class="col-md-2 control-label">
                    模板分类：
                </label>
                <div class="col-md-6">
                    <select name="cname" class="form-control">
                        <?php foreach($this->
                            setConfig->getMailTpl() as $val):?>
                            <option value="<?php echo $val?>">
                                <?php echo $val?>
                            </option>
                            <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    邮件标题：
                </label>
                <div class="col-md-6">
                    <input type="text" name="title" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    邮件内容：
                </label>
                <div class="col-md-10">
                    <textarea name="content" style="width:100%;height:300px;">
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">
                    设置状态：
                </label>
                <div class="col-md-6">
                    <select name="is_state" class="form-control">
                        <option value="0">
                            可使用
                        </option>
                        <option value="1">
                            不使用
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