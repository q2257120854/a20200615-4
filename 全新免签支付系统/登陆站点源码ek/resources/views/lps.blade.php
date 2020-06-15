@extends('layouts.app')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        @if(isset($msg) and $msg)
        <div class="row  am-cf">
            <div class="am-u-sm-12 am-u-lg-12">
                <div class="am-alert am-alert-danger">
                    <i class="am-icon-info-circle lg li"></i>
                    {!! $msg !!}
                </div>
            </div>
        </div>
        @else
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
            <div class="widget widget-yellow am-cf">
                <div class="widget-statistic-header">
                    本月总利润
                </div>
                <div class="widget-statistic-body">
                    <div class="widget-statistic-value">
                        {{ $byl }}
                    </div>
                    <div class="widget-statistic-description">
                        本月收入最高的是 <strong>未知</strong>.
                    </div>
                    <span class="widget-statistic-icon am-icon-diamond"></span>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
            <div class="widget widget-primary am-cf">
                <div class="widget-statistic-header">
                    本周总利润
                </div>
                <div class="widget-statistic-body">
                    <div class="widget-statistic-value">
                        {{ $bzl }}
                    </div>
                    <div class="widget-statistic-description">
                        本周收入最高的是 <strong>未知</strong>.
                    </div>
                    <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
            <div class="widget widget-purple am-cf">
                <div class="widget-statistic-header">
                    今天总利润
                </div>
                <div class="widget-statistic-body">
                    <div class="widget-statistic-value">
                        ￥{{ $jtl }}
                    </div>
                    <div class="widget-statistic-description">
                        今天收入最高的是 <strong>未知</strong>.
                    </div>
                    <span class="widget-statistic-icon am-icon-heart"></span>
                </div>
            </div>
        </div>
        <!--截至-->
        <div class="row am-cf">
            <div class="am-u-sm-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="am-u-sm">
                            <div class="am-alert am-alert-danger" id="my-alert" style="display: none">
							  	<p>开始日期应小于结束日期！</p>
							</div>
                            <form class="am-form-inline" role="form" method="GET">
                            	<input type="hidden" name="type" value="{{$type}}">
							  	<div class="am-form-group">
							      	<input type="text" class="am-form-field" name="str" placeholder="输入关键词">
							    </div>
							    <div class="am-btn-group">
	                                <button class="am-btn am-btn-warning am-btn-sm">支付类型</button>
	                                <div class="am-dropdown" data-am-dropdown>
	                                    <button class="am-btn am-btn-warning am-dropdown-toggle am-btn-sm" data-am-dropdown-toggle> <span class="am-icon-caret-down"></span></button>
	                                    <ul class="am-dropdown-content">
	                                        <li class="am-dropdown-header">支付宝类型</li>
	                                        <li {!! $type=='zfb' ? 'class="am-active"' : '' !!}><a href="?type=zfb">支付宝</a></li>
	                                        <li {!! $type=='wx' ? 'class="am-active"' : '' !!}><a href="?type=wx">微信</a></li>
	                                        <li {!! $type=='qq' ? 'class="am-active"' : '' !!}><a href="?type=qq">QQ</a></li>
	                                    </ul>
	                                </div>
	                            </div>
						    	<button type="button" class="am-btn am-btn-success am-margin-right am-btn-sm" id="my-start">开始日期</button><span id="my-startDate">{{ !empty($stime) ? $stime : '不筛选时间' }}</span><input type="hidden" id="stime" name="stime" value="{{$stime}}">
						    	&nbsp;
						    	<button type="button" class="am-btn am-btn-secondary am-margin-right am-btn-sm" id="my-end">结束日期</button><span id="my-endDate">{{ !empty($etime) ? $etime : '不筛选时间' }}</span><input type="hidden" id="etime" name="etime" value="{{$etime}}">
						    	&nbsp;
								<button type="submit" class="am-btn am-btn-primary am-btn-sm">筛选</button>
							</form>
                        </div>
                    </div>
                    <div class="widget-body am-fr">
                        <table width="100%" class="am-table am-table-compact am-table-bordered am-table-radius am-table-striped tpl-table-black">
                            <thead>
                                <tr>
                                    <th>订单号/交易号</th>
                                    <th>支付类型</th>
                                    <th>收款金额</th>
                                    <th>收款时间</th>
                                    <th>订单备注/对方QQ</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($s as $v)
                                <tr class="gradeX">
                                    <th>{{$v->dh}}<br>{{$v->tradeNo}}</th>
                                    <th>{{ $type=='zfb' ? '支付宝' : '' }}{{ $type=='wx' ? '微信' : '' }}{{ $type=='qq' ? 'QQ' : '' }}</th>
                                    <th>{{$v->tradeAmount}}</th>
                                    <th>{{$v->tradeTime}}</th>
                                    <th>{{ isset($v->goodsTitle) ? $v->goodsTitle : $v->qqn }}</th>
                                    <th><a href="javascript:get('{{$type}}','{{$v->dh}}')">重新通知</a></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $s->appends(['type' => $type,'stime' => $stime,'etime' => $etime,'str' => $str])->links() !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="am-modal am-modal-no-btn" tabindex="-1" id="tips" style="height: 150px">
    <div class="am-modal-dialog">
        <div class="am-modal-hd"><fw>通知结果↓</fw>
            <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
        </div>
        <div class="am-modal-bd" id="gets">
            
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn">关闭</span>
        </div>
    </div>
</div>
<script>
  	$(function() {
    	var startDate = new Date();
    	var endDate = new Date();
    	var $alert = $('#my-alert');
    	$('#my-start').datepicker().on('changeDate.datepicker.amui', function(event) {
        	if (event.date.valueOf() > endDate.valueOf()) {
          		$alert.find('p').text('开始日期应小于结束日期！').end().show();
        	} else {
          		$alert.hide();
          		startDate = new Date(event.date);
          		$('#my-startDate').text($('#my-start').data('date'));
          		$('#stime').val($('#my-start').data('date'));
        	}
        	$(this).datepicker('close');
  		});
    	$('#my-end').datepicker().on('changeDate.datepicker.amui', function(event) {
        	if (event.date.valueOf() < startDate.valueOf()) {
          		$alert.find('p').text('结束日期应大于开始日期！').end().show();
        	} else {
          		$alert.hide();
          		endDate = new Date(event.date);
          		$('#my-endDate').text($('#my-end').data('date'));
          		$('#etime').val($('#my-end').data('date'));
        	}
        	$(this).datepicker('close');
      	});
  	});
  	function get(type,dh){
  		$.ajax({
            url: '/gu',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            data:{
            	dh: dh,
            	type: type
            },
            success: function(data) {
            	gu(data);
            },error:function(){
                alert('服务器出小差了，请重试！');
            }
        });
  	}
  	function gu(url){
  		$('#gets').html('<iframe src="'+url+'" width="100%" height="100px"></iframe>');
  		$('#tips').modal();
  	}
</script>
@endsection