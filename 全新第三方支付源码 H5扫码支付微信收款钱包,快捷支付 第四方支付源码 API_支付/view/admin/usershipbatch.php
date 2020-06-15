<form class="form-horizontal" action="<?php echo $this->dir?>usership/batchsave"
method="post" autocomplete="off">
    <div class="alert alert-warning">
        批量结算只结算类型为「平台结算」的用户。
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            结算周期：
        </label>
        <div class="col-sm-8">
            <select name="ship_cycle" class="form-control">
                <option value="-1">
                    全部周期
                </option>
                <?php if($this->setConfig->shipCycle()):?>
                    <?php foreach($this->setConfig->shipCycle() as $key=>$val):?>
                        <option value="<?php echo $key?>">
                            <?php echo $val?>
                        </option>
                        <?php endforeach;?>
                            <?php endif;?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
            结算金额：
        </label>
        <div class="col-sm-4">
            <select name="sim" class="form-control">
                <option value="1">
                    大于
                </option>
                <option value="2">
                    小于
                </option>
            </select>
        </div>
        <div class="col-sm-4">
            <input type="text" name="money" class="form-control" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
        </label>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-primary" onclick="if(!confirm('是否要执行此操作？'))return false;">
                <span class="glyphicon glyphicon-tasks">
                </span>
                &nbsp;开始结算
            </button>
        </div>
    </div>
</form>
</div>
<br>