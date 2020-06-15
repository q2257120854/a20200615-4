@extends('layouts.app')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-body  widget-body-lg am-fr">
            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                <thead>
                    <tr>
                        <th>文件名</th>
                        <th>作者</th>
                        <th>时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                	<!--需要添加可在1年内参考 官方API文档-->
                    <tr class="gradeX">
                        <td>A.超多解决方案以及获取L Pays最新版本</td>
                        <td>站长</td>
                        <td>2019-01-14</td>
                        <td>
                            <a class="am-btn am-btn-warning am-btn-xs am-round" href="https://jq.qq.com/?_wv=1027&k=55N0u4y" target="_blank">加入L Pays扣扣群！鼠年不迷路！</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection