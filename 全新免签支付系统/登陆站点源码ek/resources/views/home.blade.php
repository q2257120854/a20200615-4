@extends('layouts.app')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
    	<div class="row am-cf">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-8">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><i class="am-icon-bullhorn"></i> 公告</div>
                    </div>
                    <div class="widget-body am-fr">
                        <div class="am-fl">
                            <div class="widget-fluctuation-period-text">
                                {!! $gg ? $gg : '获取公告失败' !!}
                            </div>
                        </div>
                        <div class="am-fr am-cf">
                        	<br>
                            <button class="am-btn am-btn-success am-btn-sm">
                				更多公告
              				</button>
                        </div>
                    </div>
                </div>
            </div>
        	<div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><i class="am-icon-user-secret"></i> 人气</div>
                    </div>
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>分析</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="gradeX">
                                <td>{{ $hname }}</td>
                                <td>未知</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-6">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><i class="am-icon-thumbs-o-up"></i> 我的邀请网址:<a href="javascript:copy();" class="am-badge am-badge-secondary am-radius" style="background-color: #f2633b;">http://登陆地址/register?yqm={{ Auth::user()->id }}</a>【鼠年复制，分享给朋友，财运自然来】</div>
                        <textarea style="position: absolute;top: 0;left: 0;opacity: 0;z-index: -10;" id="urls">http://登陆地址/register?yqm={{ Auth::user()->id }}</textarea>
                    </div>
                    <div class="widget-body am-fr">
                        <div class="am-fl">
                            <div class="widget-fluctuation-period-text">
                                新用户加入时填写您的邀请码完成加入，此用户首次开通Pays Pro您即可获得5元，此用户次月续费您可再获得10元！<br><font color="red">【邀请所得金额可用于抵消开通Pays 服务消费，暂不支持提现！】</font>
                            </div>
                        </div>
                        <div class="am-fr am-cf">
                        	<br>
                        	<button class="am-btn am-btn-secondary am-btn-sm">
                				邀请所得:{{ Auth::user()->money }}元
              				</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-6">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><i class="am-icon-quote-left"></i> 留言</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function copy() {
		var input = document.getElementById("urls");
        input.select(); // 选中文本
        document.execCommand("copy"); // 执行浏览器复制命令
        alert('自动复制成功,如果失败,请手动复制');
	}
</script>
@endsection