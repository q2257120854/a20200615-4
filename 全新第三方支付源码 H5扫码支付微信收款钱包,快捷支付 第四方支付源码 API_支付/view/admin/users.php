<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            用户列表
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <select name="is_state" class="form-control">
                        <option value="-1" <?php echo $search['is_state']=='-1' ? ' selected': ''?>>全部
                        </option>
                        <option value="0" <?php echo $search['is_state']=='0' ? ' selected' :''?>>未审核
                        </option>
                        <option value="1" <?php echo $search['is_state']=='1' ? ' selected' :''?>>已审核
                        </option>
                        <option value="2" <?php echo $search['is_state']=='2' ? ' selected' :''?>>已停用
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="kw" placeholder="用户名/编号"
                    value="<?php echo $search['kw']?>">
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
    <div class="table-responsive">
       <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th>
                        用户编号
                    </th>
                    <th>
                        用户名
                    </th>
                    <th>
                        真实姓名
                    </th>
                    <th>
                        手机号码
                    </th>
                    <th>
                        QQ
                    </th>
                    <th>
                        注册时间
                    </th>
					
                    <th>
                        状态
                    </th>
                    <th>
                        上级代理
                    </th>
                    <th>
                        操作
                    </th>
					<th>
                        通道
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):switch($val['is_state']){case '0': $state='
                        <span class="label label-warning">
                            未开通
                        </span>
                        ';break;case '1': $state='
                        <span class="label label-success">
                            已开通
                        </span>
                        ';break;case '2': $state='
                        <span class="label label-danger">
                            已停用
                        </span>
                        ';break;}?>
                        <tr data-id="<?php echo $val['id']?>">
                            <td>
                                <?php echo $val['id']?>
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
                                                    <a href="javascript:;" onclick="showContent('基本信息','<?php echo $this->dir?>users/getuserinfo/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;基本信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('设置分成比率','<?php echo $this->dir?>users/getuserprice/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;分成比率
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('收款信息','<?php echo $this->dir?>users/getbadata/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;收款信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('接入信息','<?php echo $this->dir?>users/getapidata/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;接入信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->dir?>userlogs/?uname=<?php echo $val['username']?>">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;登陆日志
                                                    </a>
                                                </li>
                                            </ul>
                                </div>
                            </td>
                            <td>
                                <?php echo $val['realname'] ? $val['realname'] : '-'?>
                            </td>
                            <td>
                                <?php echo $val['phone']?>
                                    &nbsp;
                                    <?php echo $val['is_verify_phone'] ?
                                    '<span class="label label-success"><span class="glyphicon glyphicon-ok-sign" data-toggle="tooltip" title="已验证"></span>' :
                                    '<span class="label label-warning"><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="未验证"></span>' ?>
                            </td>
                            <td>
                                <?php echo $val['qq']?>
                                    &nbsp;
                                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $val['qq']?>&Site=&Menu=yes"
                                    target="_blank">
                                        <span class="glyphicon glyphicon-share">
                                        </span>
                                    </a>
                            </td>
                            <td>
                                <?php echo date( 'Y-m-d H:i:s',$val['addtime'])?>
                            </td>
							
                            <td>
                                <?php echo $state ?>
                            </td>
                            <td>
                                <?php if($val['superid']): ?>
                                    <?php echo $val['superid']?>
                                        &nbsp;
                                        <a href="<?php echo $this->dir?>agent?kw=<?php echo $val['superid']?>"
                                        target="_blank">
                                            <span class="glyphicon glyphicon-share">
                                            </span>
                                        </a>
                                        <?php else:?>
                                            -
                                            <?php endif;?>
                            </td>
                            <td>
                                <a href="<?php echo $this->dir?>users/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>users/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>

							<td>
									<a href="<?php echo $this->dir?>users/tongdao/<?php echo $val['id']?>" data-toggle="tooltip" title="通道管理">
										<span class="glyphicon glyphicon-cog"> </span>
									</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="9">
                                        no data.
                                    </td>
                                    <?php endif;?>
            </tbody>
        </table>
    </div>
    <?php echo $pagelist ?><br><br>
        <?php require_once 'footer.php' ?>