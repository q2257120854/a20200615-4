<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            代收款登记列表
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="uname" placeholder="用户名/编号"
                    value="<?php echo $search['uname'] ?>" size="12">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                        <input size="16" type="text" name="fdate" readonly class="form_datetime form-control"
                        value="<?php echo $search['fdate']?>">
                        <span class="input-group-addon">
                            至
                        </span>
                        <input size="16" type="text" name="tdate" readonly class="form_datetime form-control"
                        value="<?php echo $search['tdate']?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">
                    </span>
                    &nbsp;立即查询
                </button>
            </form>
        </div>
    </div>
    <div class="set set0 table-responsive">
      <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th>
                        用户编号
                    </th>
                    <th>
                        账号名称
                    </th>
                    <th>
                        银行名称
                    </th>
                    <th>
                        开户省份
                    </th>
                    <th>
                        开户城市
                    </th>
                    <th>
                        开户支行
                    </th>
                    <th>
                        开户名称
                    </th>
                    <th>
                        银行卡号
                    </th>
					 <th>
                        身份证号
                    </th>
                    <th>
                        手机号
                    </th>
                    <th>
                        日期
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
                                <?php echo $val['userid']?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle" id="menulist" data-toggle="dropdown"
                                    aria-expanded="true">
                                        <?php echo $val['username']?>
                                            <span class="caret">
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="menulist">
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('基本信息','<?php echo $this->dir?>users/getuserinfo/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;基本信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('设置分成比率','<?php echo $this->dir?>users/getuserprice/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;分成比率
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('收款信息','<?php echo $this->dir?>users/getbadata/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;收款信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('接入信息','<?php echo $this->dir?>users/getapidata/<?php echo $val['userid']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;接入信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->dir?>userlogs/?uname=<?php echo $val['userid']?>">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;登陆日志
                                                    </a>
                                                </li>
                                            </ul>
                                </div>
                            </td>
                            <td>
                                <?php echo $val['bankname']?>
                            </td>
                            <td>
                                <?php echo $val['provice']?>
                            </td>
                            <td>
                                <?php echo $val['city']?>
                            </td>
                            <td>
                                <?php echo $val['branchname']?>
                            </td>
                            <td>
                                <?php echo $val['accountname']?>
                            </td>
                            <td>
                                <?php echo $val['cardno']?>
                            </td>
							 <td>
                                <?php echo $val['sfz']?>
                            </td>
                            <td>
                                <?php echo $val['shouji']?>
                            </td>
                            <td>
                                <?php echo date( 'm-d H:i:s',$val['addtime'])?>
                            </td>
                            <td>
                                <a href="javascript:;" onclick="showContent('修改代收款信息','<?php echo $this->dir?>usercfo/edit/<?php echo $val['id']?>')"
                                data-toggle="tooltip" title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>usercfo/del')"
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
	<?php echo $lists ? $pagelist : '' ?>
    <?php require_once 'footer.php' ?>