<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            代理列表
        </span>
    </h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <select name="is_state" class="form-control">
                        <option value="-1" <?php echo $search['is_state']=='-1' ? ' selected' : ''?>>全部
                        </option>
                        <option value="0" <?php echo $search['is_state']=='0' ? ' selected' :''?>>未审核
                        </option>
                        <option value="1" <?php echo $search['is_state']=='1' ? ' selected' : ''?>>已审核
                        </option>
                        <option value="2" <?php echo $search['is_state']=='2' ? ' selected' :''?>>已停用
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="kw" placeholder="代理名/编号"
                    value="<?php echo $search['kw']?>">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                        <input size="16" type="text" name="fdate" readonly class="form_datetime form-control" value="<?php echo $search['fdate']?>">
                        <span class="input-group-addon">
                            至
                        </span>
                        <input size="16" type="text" name="tdate" readonly class="form_datetime form-control" value="<?php echo $search['tdate']?>">
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
<table class="table table-hover ">
     <table id="table-6" class="table table-hover ">
            <thead>
                <tr class="info">
                    <th class="text-center">
                        代理编号
                    </th>
                    <th>
                        代理名
                    </th>
                    <th class="text-center">
                        真实姓名
                    </th>
                    <th class="text-center">
                        手机号码
                    </th>
                    <th>
                        QQ
                    </th>
                    <th class="text-center">
                        注册时间
                    </th>
                    <th class="text-center">
                        状态
                    </th>
                    <th class="text-center">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):switch($val['is_state']){case '0': $state='
                        <span class="label label-warning">未开通</span>';break;case '1': $state='<span class="label label-success">已开通
                        </span>';break;case '2': $state='<span class="label label-danger">已停用</span>';break;}?>
                        <tr data-id="<?php echo $val['id']?>">
                            <td class="text-center">
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
                                                    <a href="javascript:;" onclick="showContent('基本信息','<?php echo $this->dir?>agent/getuserinfo/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;基本信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('设置分成比率','<?php echo $this->dir?>agent/getuserprice/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;分成比率
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('收款信息','<?php echo $this->dir?>agent/getbadata/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;收款信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" onclick="showContent('接入信息','<?php echo $this->dir?>agent/getapidata/<?php echo $val['id']?>')">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;接入信息
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->dir?>agentlogs/?uname=<?php echo $val['username']?>">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;登陆日志
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->dir?>users/?superid=<?php echo $val['id']?>">
                                                        <span class="glyphicon glyphicon-triangle-right">
                                                        </span>
                                                        &nbsp;下级用户
                                                    </a>
                                                </li>
                                            </ul>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php echo $val['realname'] ? $val['realname'] : '-'?>
                            </td>
                            <td class="text-center">
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
                            <td class="text-center">
                                <?php echo date( 'Y-m-d H:i:s',$val['addtime'])?>
                            </td>
                            <td class="text-center">
                                <?php echo $state ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo $this->dir?>agent/edit/<?php echo $val['id']?>" data-toggle="tooltip"
                                title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                                </a>
                                &nbsp;
                                <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>agent/del')"
                                data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td class="text-center" colspan="8">
                                        no data.
                                    </td>
                                    <?php endif;?>
            </tbody>
        </table>
    </div>
    <?php echo $lists ? $pagelist : '' ?>
        <?php require_once 'footer.php' ?>