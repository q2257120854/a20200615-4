<?php require_once 'header.php' ?>
    <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                             <?php echo $title ?>
                                </div>
                            </div>
                            <div class="panel-body">
        <div class="content-box">
            <form class="form-ajax form-horizontal" action="/agent/userpwd/editsave"
            method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        原密码：
                    </label>
                    <div class="col-md-6">
                        <input type="password" name="oldpwd" class="form-control" maxlength="20"
                        required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        新密码：
                    </label>
                    <div class="col-md-6">
                        <input type="password" name="newpwd" class="form-control" maxlength="20"
                        required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        确认新密码：
                    </label>
                    <div class="col-md-6">
                        <input type="password" name="cirpwd" class="form-control" maxlength="20"
                        required>
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
        </div>
    </div>  
	</div>
	   </div>
	   	   </div>
		   	   </div>
			    </div>
    <?php require_once 'footer.php' ?>