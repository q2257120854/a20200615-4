@extends('layouts.app')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-body am-fr">
            <form class="am-form tpl-form-border-form">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">创建订单接口地址 <span class="tpl-form-line-small-title">Get接口</span></label>
                    <div class="am-u-sm-12">
                        <pre>http://支付页面地址/</pre>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">示例 <span class="tpl-form-line-small-title">请求示例</span></label>
                    <div class="am-u-sm-12">
                        <pre>http://支付页面地址/?appid=84066E5D4F7E03C56DA3C36D29EBBB08&income=1&gu=aHR0cDovL2FwaS5lZGxtLmNuL2RvYw==&rurl=aHR0cDovL2FwaS5lZGxtLmNuL2RvYw==&type=alipay</pre>
                    </div>
                </div>
                <table width="100%" class="am-table am-table-compact am-table-bordered am-table-radius am-table-striped tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>参数名</th>
                            <th>翻译</th>
                            <th>说明</th>
                            <th>示例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
                            <td>appid</td>
                            <td>应用标识</td>
                            <td>在管理控制面板中的L Pays APPID</td>
                            <td>84066E5D4F7E03C56DA3C36D29EBBB08</td>
                        </tr>
                        <tr class="gradeX">
                            <td>income</td>
                            <td>收入</td>
                            <td>商品价格/充值金额(也就是本次创建的订单需要支付的金额大小,数字型)</td>
                            <td>1</td>
                        </tr>
                        <tr class="gradeX">
                            <td>rurl</td>
                            <td>返回地址</td>
                            <td>付款成功后跳转的地址(请先将地址转为Base64编码,付款成功后会自动在最后加上单号[dh]和类型[ltype]参数供你直接使用)</td>
                            <td>aHR0cDovL2xvY2FsaG9zdC8=(Base64解码:http://localhost/)</td>
                        </tr>
                        <tr class="gradeX">
                            <td>gu</td>
                            <td>GET异步通知地址</td>
                            <td>付款成功后异步通知的地址(请先将地址转为Base64编码,付款成功后会自动在最后加上单号[dh]和类型[ltype]参数供你直接使用)</td>
                            <td>aHR0cDovL2xvY2FsaG9zdC8=(Base64解码:http://localhost/)</td>
                        </tr>
                        <tr class="gradeX">
                            <td>type</td>
                            <td>类型</td>
                            <td>订单支付类型(支付宝=alipay、微信=wxpay、QQ=qqpay)</td>
                            <td>alipay</td>
                        </tr>
                    </tbody>
                </table>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">HTML实现代码<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                       <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                @php
                                    highlight_file('./phpfile/html.txt');
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