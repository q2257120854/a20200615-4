    <?php require_once 'header.php' ?>
     <div class="row wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <em class="fa fa-list">
                                        </em>
                             <?php echo $title ?>
                                </div>
                            </div>
						  <div class="panel-body">
        <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead">
                    <tr>
                        <th>
                            账单生成时间
                        </th>
                        <th>
                            账单序号
                        </th>
                        <th>
                            账单金额
                        </th>
                        <th>
                            手续费
                        </th>
                        <th>
                            实付金额
                        </th>
                        <th>
                            账单状态
                        </th>
                        <th>
                            收款户名
                        </th>
                        <th>
                            收款方式
                        </th>
						<th>
                            备注
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lists):?>
                        <?php foreach($lists as $key=>$val):switch($val['is_state']){case 0: $state='
                            <span class="label label-warning">
                                '.$this->setConfig->billState($val['is_state']).'
                            </span>
                            ';break;case 1: $state='
                            <span class="label label-success">
                                '.$this->setConfig->billState($val['is_state']).'
                            </span>
                            ';break;case 2: $state='
                            <span class="label label-default">
                                '.$this->setConfig->billState($val['is_state']).'</span>
                            ';break;case 3: $state='
                            <span class="label label-danger">
                                '.$this->setConfig->billState($val['is_state']).'</span>';break;}?>
                            <tr>
                              <td class="text-center blue">
                                    <?php echo date( 'm-d H:i:s',$val[ 'addtime'])?>
                                </td>
                               <td class="text-center">
                                    <?php echo $val[ 'sn']?>
                                </td>
                                <td class="text-center green">
                                    <?php echo $val[ 'money']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                               <td class="text-center">
                                    <?php echo $val[ 'fee']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                                <td class="text-center red">
                                    <?php echo $val[ 'money']-$val[ 'fee']?>
                                        <span class="gray">
                                            元
                                        </span>
                                </td>
                             <td class="text-center">
                                    <?php echo $state ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $val[ 'realname']?>
                                </td>
								
                                <td class="text-center">
								                    <?php echo $val[ 'batype'] ?>
                            <!--        <?php echo $val[ 'batype']=='' ? '网银代付' : $val[ 'batype'] ?>  -->
                             
                            <td class="text-center">
                                    <?php echo $val[ 'remark']?>
                                </td> </tr>
                            <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                          暂无记录
                                        </td>
                                    </tr>
                                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
	        </div></div></div></div></div>
			
    <?php require_once 'footer.php' ?>