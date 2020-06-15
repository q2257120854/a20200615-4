<?php $resCode='' ;if($retmsg){$ret=json_decode($retmsg,true);$resCode=$ret[
'resCode'];}?>
    <form class="form-horizontal" action="<?php echo $this->dir?>userpay/savepay/<?php echo $id ?>"
    method="post" autocomplete="off">
        <input type="hidden" name="ptype" value="<?php echo $ptype?>">
        <input type="hidden" name="cfoid" value="<?php echo $cfoid?>">
        <div class="form-group">
            <label class="col-sm-3 control-label">
                商户编号：
            </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" disabled value="<?php echo $userid ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">
                可付金额：
            </label>
            <div class="col-sm-8">
                <input type="text" name="money" class="form-control" value="<?php echo $money ?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">
                手续费：
            </label>
            <div class="col-sm-8">
                <input type="text" name="fee" class="form-control" value="<?php echo $fee ?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">
                实付金额：
            </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo number_format($money-$fee,2,'.','')?>"
                required>
            </div>
        </div>
		
        <div class="form-group">
            <label class="col-sm-3 control-label">
                付款记录状态：
            </label>
            <div class="col-sm-8">
                <select name="is_state" class="form-control">
                    <?php foreach($this->setConfig->billState() as $key=>$val):?>
                        <option value="<?php echo $key?>" <?php echo $is_state==$key ?
                        ' selected' : ''?>
                            >
                            <?php echo $val?>
                        </option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">
                开户名称：
            </label>
            <div class="col-sm-8">
                <input type="text" name="realname" class="form-control" value="<?php echo $realname?>"
                required>
            </div>
        </div>
  <div class="form-group">
            <label class="col-sm-3 control-label">
                开户银行：
            </label>
            <div class="col-sm-8">
                <input type="text" name="baaddr" class="form-control" value="<?php echo $baaddr?>"
                required>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-3 control-label">
                收款银行：
            </label>
            <div class="col-sm-8">
                <input type="text" name="batype" class="form-control" value="<?php echo $batype?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">
                收款账号：
            </label>
            <div class="col-sm-8">
                <input type="text" name="baname" class="form-control" value="<?php echo $baname?>"
                required>
            </div>
        </div>
		 <div class="form-group">
            <label class="col-sm-3 control-label">
                身份证号：
            </label>
            <div class="col-sm-8">
                <input type="text" name="sfz" class="form-control" value="<?php echo $sfz?>"
                required>
            </div>
        </div>
		
		 <div class="form-group">
            <label class="col-sm-3 control-label">
               手机号码：
            </label>
            <div class="col-sm-8">
                <input type="text" name="shouji" class="form-control" value="<?php echo $shouji?>"
                required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">
                备注说明：
            </label>
            <div class="col-sm-8">
                <textarea name="remark" class="form-control" rows="5">
                    <?php echo $remark?>
                </textarea>
            </div>
        </div>
        <?php if($ptype=='1' && $retmsg):?>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    代付接口通知：
                </label>
                <div class="col-sm-8">
                    <div class="alert alert-warning">
                        <?php $ret=json_decode($retmsg,true);echo $ret[ 'resCode']. ' '.$ret[
                        'resContent'];?>
                    </div>
                </div>
            </div>
            <?php endif;?>
                <div class="form-group">
                    <label for="stacode" class="col-sm-3 control-label">
                    </label>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success">
                            &nbsp;
                            <span class="glyphicon glyphicon-save">
                            </span>
                            &nbsp;保存账单&nbsp;
                        </button>
                    </div>
                </div>
    </form>
    </div>
    <br>