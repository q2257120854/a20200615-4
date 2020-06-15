<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            模板编辑
        </span>
    </h3>
    <br>
    <script charset="utf-8" src="/view/kindeditor/kindeditor-all-min.js">
    </script>
    <script charset="utf-8" src="/view/kindeditor/lang/CN.js">
    </script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                allowFileManager: false,
            });
        });
    </script>
    <div class="alert alert-info">
        用户名：{username}&nbsp;用户编号：{userid}&nbsp;邮箱地址：{email}&nbsp;网址url：{url}&nbsp;日期时间：{time}&nbsp;平台名称：{sitename}&nbsp;金额：{money}
    </div>
    <form class="form-horizontal" action="<?php echo $this->dir?>mailtpl/editsave/<?php echo $id?>"
    method="post" autocomplete="off">
        <div class="form-group">
            <label class="col-md-2 control-label">
                模板分类：
            </label>
            <div class="col-md-6">
                <select name="cname" class="form-control">
                    <?php foreach($this->
                        setConfig->getMailTpl() as $val):?>
                        <option value="<?php echo $val?>" <?php echo $cname==$val ?
                        ' selected' : ''?>
                            >
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
                <input type="text" name="title" class="form-control" value="<?php echo $title?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                邮件内容：
            </label>
            <div class="col-md-10">
                <textarea name="content" style="width:100%;height:300px;">
                    <?php echo $content ?>
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">
                设置状态：
            </label>
            <div class="col-md-6">
                <select name="is_state" class="form-control">
                    <option value="0" <?php echo $is_state=='0' ? ' selected' : ''?>
                        >可使用
                    </option>
                    <option value="1" <?php echo $is_state=='1' ? ' selected' : ''?>
                        >不使用
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
    <?php require_once 'footer.php' ?>