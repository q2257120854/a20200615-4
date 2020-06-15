<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            编辑公告
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
    <form class="form-horizontal" action="<?php echo $this->dir?>arlist/editsave/<?php echo $data['id']?>"
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
                            <option value="<?php echo $val['id']?>" <?php echo $data[ 'cid']==$val[
                            'id'] ? ' selected' : '' ?>
                                >
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
                <input type="text" name="title" id="title" class="form-control" required
                value="<?php echo $data['title'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="addtime" class="col-md-2 control-label">
                发布日期：
            </label>
            <div class="col-md-6">
                <input type="text" name="addtime" id="addtime" class="form-control" required
                value="<?php echo date('Y-m-d H:i:s',$data['addtime'])?>">
            </div>
        </div>
        <div class="form-group">
            <label for="cname" class="col-md-2 control-label">
                公告内容：
            </label>
            <div class="col-md-10">
                <textarea name="content" style="width:100%;height:300px;visibility:hidden;">
                    <?php echo $data[ 'content']?>
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="is_state" class="col-md-2 control-label">
                设置状态：
            </label>
            <div class="col-md-6">
                <select name="is_state" class="form-control">
                    <option value="1" <?php echo $data[ 'is_state']=='1' ? ' selected' :
                    ''?>
                        >正式发布
                    </option>
                    <option value="0" <?php echo $data[ 'is_state']=='0' ? ' selected' :
                    ''?>
                        >暂不发布
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