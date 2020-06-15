@extends('layouts.app')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-body am-fr">
            <form class="am-form tpl-form-border-form">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">基于《查询订单》查询到的数据<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                        <pre>{"error":"0","tradeNo":"2018081321001004020589602223","tradeAmount":"1.00","tradeTime":"2018-08-13 08:08:04","goodsTitle":"\u5546\u54c1","token":"55d5366a518503e8674868da91b168f0"}</pre>
                    </div>
                </div>
                <div class="widget-fluctuation-period-text">
                    下面我们来解析以下上面的数据是怎么来的?而我们该如何使用?
                    <br>
                    <p>1.以上查询返回的数据是由用户扫码完成支付你创建的订单后取此用户支付的订单数据存入数据库,并归属于此单号所有！</p>
                    <p>2.拥有以上数据之后，可以自由利用，比如再次判断实收金额于您商品的金额是否一致，或识别备注信息.</p>
                    <p>3.识别通过之后，就可以将此单号记录下来，再次查询时已经无效(已经充值过或已经使用了)，然后给客户进行充值操作或提供虚拟商品.</p>
                    <p>4.Token的使用:为了避免用户使用非法手段伪造获取到的以上数据，我们为你提供了验证token，如果验证到token不正确则忽略！</p>
                    <p>5.最后我们既然有了收款数据,那么我们来利用试试！(我们把 row 变量 直接设为已获取到的收款数据 )</p>
                    <div class="am-u-sm-12">
                       <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                @php
                                    highlight_file('./phpfile/2.txt');
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection