@extends('layouts.app')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
            <div class="widget widget-yellow am-cf">
                <div class="widget-statistic-header">
                    当前用户总数量
                </div>
                <div class="widget-statistic-body">
                    <div class="widget-statistic-value">
                        {{ $uc }} 位
                    </div>
                    <div class="widget-statistic-description">
                        其中Pro用户<strong>{{ $pc }}</strong>位，Alipay用户<strong>{{ $ac }}</strong>位。
                    </div>
                    <span class="widget-statistic-icon am-icon-diamond"></span>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
            <div class="widget widget-primary am-cf">
                <div class="widget-statistic-header">
                    本月新增用户数量
                </div>
                <div class="widget-statistic-body">
                    <div class="widget-statistic-value">
                        {{ $yc }} 位
                    </div>
                    <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
            <div class="widget widget-purple am-cf">
                <div class="widget-statistic-header">
                    今天新增用户数量
                </div>
                <div class="widget-statistic-body">
                    <div class="widget-statistic-value">
                        {{ $tc }} 位
                    </div>
                    <span class="widget-statistic-icon am-icon-heart"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection