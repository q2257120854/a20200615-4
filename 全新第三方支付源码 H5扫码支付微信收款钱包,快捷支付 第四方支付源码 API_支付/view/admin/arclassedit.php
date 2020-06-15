<form class="form-horizontal" action="<?php echo $this->dir?>arcate/editsave/<?php echo $id ?>"
method="post" autocomplete="off">
    <div class="form-group">
        <label for="cname" class="col-sm-3 control-label">
            分类名称：
        </label>
        <div class="col-sm-5">
            <input type="text" name="cname" id="cname" class="form-control" required
            value="<?php echo $cname ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="stacode" class="col-sm-3 control-label">
        </label>
        <div class="col-sm-5">
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