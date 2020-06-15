<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            编辑通用网关
        </span>
    </h3>
    <br>
    <style>
        .form-group>span.col-md-4{font-size:0.9em;color:#6B6D6E;line-height: 30px}
    </style>
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>acw/editsave/<?php echo $data['id']?>"
    method="post">
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                网关名称：
            </label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" value="<?php echo $data['name']?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                网关编号：
            </label>
            <div class="col-md-4">
                <input type="text" name="code" class="form-control" value="<?php echo $data['code']?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label">
                卡密面值：
            </label>
            <div class="col-md-4">
                <input type="text" name="price" class="form-control" value="<?php echo $data['price'] ? implode('|',json_decode($data['price'],true)) : ''?>"
                placeholder="非点卡可为空">
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
                <input type="text" name="length" class="form-control" value="<?php echo $data['length'] ? implode('|',json_decode($data['length'],true)) : ''?>"
                placeholder="可为空">
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
                <input type="text" name="img" class="form-control" value="<?php echo $data['img']?>"
                placeholder="非点卡可为空">
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
    <?php require_once 'footer.php' ?>