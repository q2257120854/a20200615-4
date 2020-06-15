@extends('layouts.app')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-body am-fr">
            <form class="am-form tpl-form-border-form">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">支付宝查询单号接口地址: <span class="tpl-form-line-small-title">POST接口</span></label>
                    <div class="am-u-sm-12">
                        <pre>https://api地址/lps/acs/{appid}</pre>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">微信查询单号接口地址: <span class="tpl-form-line-small-title">POST接口</span></label>
                    <div class="am-u-sm-12">
                        <pre>https://api地址/lps/wcs/{appid}</pre>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">QQ查询单号接口地址: <span class="tpl-form-line-small-title">POST接口</span></label>
                    <div class="am-u-sm-12">
                        <pre>https://api地址/lps/qcs/{appid}</pre>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">地址示例 <span class="tpl-form-line-small-title">请求示例</span></label>
                    <div class="am-u-sm-12">
                        <pre>https://api地址/lps/acs/84066E5D4F7E03C56DA3C36D29EBBB08</pre>
                    </div>
                </div>
                <table width="100%" class="am-table am-table-compact am-table-bordered am-table-radius am-table-striped tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>URL参数名</th>
                            <th>翻译</th>
                            <th>说明</th>
                            <th>示例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
                            <td>APPID</td>
                            <td>应用标识</td>
                            <td>在管理控制面板中的L Pays APPID</td>
                            <td>84066E5D4F7E03C56DA3C36D29EBBB08</td>
                        </tr>
                    </tbody>
                </table>
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
                            <td>Dh</td>
                            <td>单号</td>
                            <td>需要查询的单号</td>
                            <td>1dPmnOWB1534118836</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Token</td>
                            <td>查询口令</td>
                            <td>Md5密钥(由Dh+APPID组成) PHP例子:(md5($dh.$appid))</td>
                            <td>857D2123C2D452DA36C95B4292C9C227</td>
                        </tr>
                    </tbody>
                </table>
                <div class="am-form-group">
                    <a class="am-btn am-btn-primary am-btn-block" href="../phpfile/download.php?file=api地址/phpfile/edlm.txt&name=edlm.php">下载edlm.php文件 [PHP]</a>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">PHP实现代码<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                       <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                @php
                                    highlight_file('./phpfile/1.txt');
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">返回JSON解析(支付宝)<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                        <pre>{"error":"0","tradeNo":"2018081321001004020589602223","tradeAmount":"1.00","tradeTime":"2018-08-13 08:08:04","goodsTitle":"\u5546\u54c1","token":"55d5366a518503e8674868da91b168f0"}</pre>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">返回JSON解析(QQ)<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                        <pre>{"error":"0","tradeNo":"2018081321001004020589602223","tradeAmount":"1.00","tradeTime":"2018-08-13 08:08:04","qqn":"3283404596","token":"55d5366a518503e8674868da91b168f0"}</pre>
                    </div>
                </div>
                <table width="100%" class="am-table am-table-compact am-table-bordered am-table-radius am-table-striped tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>参数名</th>
                            <th>翻译</th>
                            <th>说明</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
                            <td>Error</td>
                            <td>错误</td>
                            <td>错误号,只有 0 是成功返回订单数据的，其它数字均为错误</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Msg</td>
                            <td>返回信息</td>
                            <td>本次请求如果错误号为0，此参数将不存在！</td>
                        </tr>
                        <tr class="gradeX">
                            <td>TradeNo</td>
                            <td>订单号</td>
                            <td>支付此订单的支付宝交易号</td>
                        </tr>
                        <tr class="gradeX">
                            <td>tradeAmount</td>
                            <td>实收金额</td>
                            <td>此订单实际收到的金额</td>
                        </tr>
                        <tr class="gradeX">
                            <td>tradeTime</td>
                            <td>交易时间</td>
                            <td>客户成功支付的时间</td>
                        </tr>
                        <tr class="gradeX">
                            <td>(支付宝和微信返回)goodsTitle/(QQ返回)qqn</td>
                            <td>备注</td>
                            <td>如果是查询支付宝和微信会返回goodsTitle,即是此订单支付时输入的备注或留言.如果是查询QQ会返回qqn,即是付款人的QQ号码</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Token</td>
                            <td>口令</td>
                            <td>用于判断此订单是否真实有效</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection