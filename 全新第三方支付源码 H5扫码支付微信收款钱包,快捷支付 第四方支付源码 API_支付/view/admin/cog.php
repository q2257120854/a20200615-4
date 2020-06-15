<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            导航设置
        </span>
    </h3>
    <br>
    <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>cog/save"
    method="post" autocomplete="off">
        <div class="form-group">
            <?php foreach($this->menu() as $key=>$val):?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $key ?>
                    </div>
                    <div class="panel-body">
                        <?php foreach($val as $key2=>
                            $val2): ?>
                            <label for="<?php echo $key2 ?>">
                                <input type="checkbox" name="<?php echo $key2 ?>" id="<?php echo $key2?>"
                                value="<?php echo $val2?>" <?php echo array_key_exists($key2,$this->
                                nav) ? ' checked' : ''?>>&nbsp;
                                <?php echo $val2?>
                                    &nbsp;&nbsp;
                            </label>
                            <?php endforeach;?>
                    </div>
                </div>
                <?php endforeach;?>
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
    <script>
        $(function() {
            $('[type=checkbox]').click(function() {
                if ($('[type=checkbox]:checked').length > 7) {
                    alert('最多可同时选择7个栏目');
                    $(this).prop('checked', false);
                    return false;
                }
            });
        });
    </script>
    <?php require_once 'footer.php' ?>