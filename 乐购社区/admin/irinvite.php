<?php 
$title='邀请记录';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'irinvite';
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



	<?
 include('header.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                       邀请记录
                    </div>
                    <div class="table-search-header">
                    <form  action="" name="search_form" id="search_form">
                        <div class="form-inline">
                            <input type="text" disabled="disabled" class="hidden">
                            <div class="form-group">
                                <input type="number"  name="yaoqingren" class="form-control"   placeholder="邀请人QQ">
                            </div>
                                                        <div class="form-group">
                                <input type="number"  name="shouyaoren" class="form-control"   placeholder="受邀人QQ">
                            </div>
                            
                                                        <div class="form-group">
                                <input type="number"  name="qunhao" class="form-control"   placeholder="群号">
                            </div>
                           <a class="btn btn-info"   onClick="document:search_form.submit();">  <i class="iconfont">&#xe652;</i>搜索</a>
                        </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>邀请人</th>
                                    <th>受邀人</th>
                                    <th>QQ群</th>
                                    <th>奖励积分</th>
                                    <th>邀请时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                                                <tr>
                                    <td colspan="102" class="text-center">
               <div class="smart-widget-footer text-center"><nav class="text-center"><ul class="pagination" style="display: -webkit-inline-box;">
                    <li class="active page-item"><a href="javascript:;" class="page-link">1</a></li> 
                 
                    
                    </ul></nav></div>  
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div><!-- /main-container -->

</div><!-- /wrapper -->


 <? include_once('footer.php');
?></body>
</html>
