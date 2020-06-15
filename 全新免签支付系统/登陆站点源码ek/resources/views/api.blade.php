@extends('layouts.app')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        @if(isset($smsg) and $smsg)
        <div class="row  am-cf">
            <div class="am-u-sm-12 am-u-lg-12">
                <div class="am-alert am-alert-danger">
                    <i class="am-icon-info-circle lg li"></i>
                    {!! $smsg !!}
                </div>
            </div>
        </div>
        @elseif(isset($app->type) and $app->type==0)
        <div class="row  am-cf">
            <div class="am-u-sm-12 am-u-lg-12">
                <div class="am-alert am-alert-danger"><i class="am-icon-info-circle lg li"></i> 您好,当前您正在使用Pays Alipay API 单独版。此服务仅提供体验,功能有限!<br>&nbsp;&nbsp;&nbsp;&nbsp;服务到期时间为:{{ date('Y-m-d H:i:s',$app->dqtime) }}需要用于商业用途,建议购买Pays Pro[专业版] 20元/30天 <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="fk('Pays Pro','20.00');">马上开通</button></div>
            </div>
        </div>
        <div class="row am-cf">
            <div class="am-u-sm-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><span class="am-icon-paypal"></span> Pays Alipay API</div>
                    </div>
                    <div class="widget-body am-fr">
                        <div class="am-fl">
                            <div class="widget-fluctuation-period-text">
                                (以下信息是您的APP信息,请妥善保管,否则后果自负)
                                <br>
                                <span class="am-badge am-badge-danger am-radius">APP Id: </span><a class="am-badge am-badge-success am-radius">{{ $app->apiid }}</a>
                                <br>
                                <span class="am-badge am-badge-warning am-radius">APP Pwd: </span><a class="am-badge am-badge-secondary am-radius">{{ $app->apipwd }}</a>
                                <br><br>
                                <span class="am-badge am-badge-success am-radius">服务到期时间为: </span>
                                <span class="am-badge am-badge-danger am-radius am-text-lg">{{ date("Y-m-d H:i:s",$app->dqtime) }}</span>
                                <span class="am-badge am-badge-warning am-radius">请在即将到期时及时</span>
                                <a class="am-badge am-badge-danger am-radius am-text-lg" href="javascript:fk('Pays Alipay API 单独版','8.00');">续费30天</a>
                                <br><br>
                                <span class="am-badge am-badge-secondary am-radius">掉线邮件通知服务:</span><a class="am-badge am-badge-danger am-radius"> 已开通(限时免费中) </a>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black">
                            <thead>
                                <tr>
                                    <th>资料标题</th>
                                    <th>发布人</th>
                                    <th>发布时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td><a target="_blank" href="https://接口地址/doc/s">Pays 下载+对接文档+视频演示</a></td>
                                    <td>站长</td>
                                    <td>2018-08-12</td>
                                </tr>
                                <!-- more data -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><span class="am-icon-cny"></span> 收款信息配置</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="POST" action="./api">
                            @csrf
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">默认收款二维码 <span class="tpl-form-line-small-title">Code</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="zewm" placeholder="支付宝收款二维码链接" value="{{ $app->skewm }}">
                                    <small>(请在<a target="_blank" href="https://cli.im/deqr">草料二维码扫描器</a>上传收钱码贴纸上面的二维码)在此输入解析到的链接地址</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">订单有效时间 <span class="tpl-form-line-small-title">Time</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" value="{{ $app->gqtime }}" class="tpl-form-input" name="gqtime" placeholder="订单有效时间,例如:3">
                                    <small>在此输入每个订单有效的时间,单位/分钟!不可大于60分钟!建议3分钟!</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                	<a class="am-btn am-btn-warning" href="https://jq.qq.com/?_wv=1027&k=55N0u4y" target="_blank">加入Pays扣扣群！鼠年不迷路！</a>
                                    <input type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success" name="bc">
                                </div>
                            </div>
                        </form>
                        {!! $msg ? '<div class="am-alert am-alert-primary"><i class="am-icon-info-circle lg li"></i>'.$msg.'</div>' : '' !!}
                    </div>
                </div>
            </div>
        </div>
        @elseif(isset($app->type) and $app->type==1)
        <div class="row am-cf">
            <div class="am-u-sm-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><span class="am-icon-paypal"></span> Pays Pro API
                            @if($app->vip===9) #VIP：当前正在使用专属通道 @endif</div>
                    </div>
                    <div class="widget-body am-fr">
                        <div class="am-fl">
                            <div class="widget-fluctuation-period-text">
                                (以下信息是您的APP信息,请妥善保管,否则后果自负)
                                <br>
                                <span class="am-badge am-badge-danger am-radius">APP Id: </span><a class="am-badge am-badge-success am-radius">{{ $app->apiid }}</a>
                                <br>
                                <span class="am-badge am-badge-warning am-radius">APP Pwd: </span><a class="am-badge am-badge-secondary am-radius">{{ $app->apipwd }}</a>
                                <br><br>
                                <span class="am-badge am-badge-success am-radius">服务到期时间为: </span>
                                <span class="am-badge am-badge-danger am-radius am-text-lg">{{ date("Y-m-d H:i:s",$app->dqtime) }}</span>
                                <span class="am-badge am-badge-warning am-radius">请在即将到期时及时</span>
                                <a class="am-badge am-badge-danger am-radius am-text-lg" href="javascript:fk('Pays Pro API 专业版','20.00');">续费30天</a>
                                <br><br>
                                <span class="am-badge am-badge-secondary am-radius">掉线邮件通知服务:</span><a class="am-badge am-badge-danger am-radius"> 已开通(限时免费中) </a>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black">
                            <thead>
                                <tr>
                                    <th>资料标题</th>
                                    <th>发布人</th>
                                    <th>发布时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td><a target="_blank" href="https://接口地址/doc/s">Pays 下载+对接文档+视频演示</a></td>
                                    <td>站长</td>
                                    <td>2018-08-12</td>
                                </tr>
                                <!-- more data -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl"><span class="am-icon-cny"></span> 收款信息配置</div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-line-form" method="POST" action="./api">
                            @csrf
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">默认支付宝收款二维码 <span class="tpl-form-line-small-title">Code</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="zewm" placeholder="支付宝收款二维码链接" value="{{ $app->skewm }}">
                                    <small>(请在<a target="_blank" href="https://cli.im/deqr">草料二维码扫描器</a>上传收钱码贴纸上面的二维码)在此输入解析到的链接地址</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">默认微信收款二维码 <span class="tpl-form-line-small-title">Code</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="wewm" placeholder="微信收款二维码链接" value="{{ $app->wxskewm }}">
                                    <small>(请在<a target="_blank" href="https://cli.im/deqr">草料二维码扫描器</a>上传微信收款二维码)在此输入解析到的链接地址</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">默认QQ收款二维码 <span class="tpl-form-line-small-title">Code</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="qewm" placeholder="QQ收款二维码链接" value="{{ $app->qqskewm }}">
                                    <small>(请在<a target="_blank" href="https://cli.im/deqr">草料二维码扫描器</a>上传QQ收款二维码)在此输入解析到的链接地址</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">订单有效时间 <span class="tpl-form-line-small-title">Time</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" value="{{ $app->gqtime }}" class="tpl-form-input" name="gqtime" placeholder="订单有效时间,例如:3">
                                    <small>在此输入每个订单有效的时间,单位/分钟!不可大于60分钟!建议3分钟!</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                	<a class="am-btn am-btn-warning" href="https://jq.qq.com/?_wv=1027&k=55N0u4y" target="_blank">加入Pays扣扣群！鼠年不迷路！</a>
                                    <input type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success" name="bc">
                                </div>
                            </div>
                        </form>
                        {!! $msg ? '<div class="am-alert am-alert-primary"><i class="am-icon-info-circle lg li"></i>'.$msg.'</div>' : '' !!}
                    </div>
                </div>
            </div>
    	</div>
        @else
        <div class="row  am-cf">
            <div class="am-u-sm-12 am-u-lg-12">
                <div class="am-alert am-alert-danger"><i class="am-icon-info-circle lg li"></i> 检测到您暂未开通Pays服务,下面为您推荐以下套餐(当你开通服务后推荐则会消失,出现管理服务面板)</div>
            </div>
        </div>
    	<div class="row am-cf">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-5">
                <div class="widget widget-primary am-cf">
                    <div class="widget-statistic-header">
                        Pays Alipay API 单独版
                    </div>
                    <div class="widget-statistic-body">
                        <div class="widget-statistic-value">
                            ￥8.00
                        </div>
                        <div class="widget-statistic-description">
                            一款为个人收款而生的独立免签约API(真正的零手续费直接到账,收款账号是您自己的账号)，为支付宝、微信、QQ的个人账户,提供即时到账收款技术,安全可靠,零费率,直接到账!为自己省下更多时间,去做更多有意义的事情!<br><br>套餐说明:此套餐仅提供支付宝API,有效使用期为30天！
                        </div>
                        <div class="am-fr am-cf">
                            <br>
    						<button  type="button" class="am-btn am-btn-success am-btn-xs" onclick="fk('Pays Alipay API 单独版','8.00');">立刻享有</button>
                        </div>
                        <span class="widget-statistic-icon am-icon-coffee"></span>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-7">
                <div class="widget widget-yellow am-cf">
                    <div class="widget-statistic-header">
                        Pays Pro
                    </div>
                    <div class="widget-statistic-body">
                        <div class="widget-statistic-value">
                            ￥20.00
                        </div>
                        <div class="widget-statistic-description">
                            Pays 是一款为支付宝、微信、QQ的个人账户(真正的零手续费直接到账,收款账号是您自己的账号),提供即时到账收款技术的API,可任意对接各种平台实现免签约收款!安全可靠,零费率,直接到账!为自己省下更多时间,去做更多有意义的事情!12小时在线客服帮您快速完成对接!
                            <br><br>套餐说明:此版本包含支付宝、微信、QQ 三种免签约API,套餐有效时间为30天! 
                        </div>
                        <div class="am-fr am-cf">
                            <br>
                            <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="fk('Pays Pro','20.00');">立刻享有</button>
                        </div>
                        <span class="widget-statistic-icon am-icon-bed"></span>
                    </div>
                </div>  
            </div>
        </div>
        @endif
    </div>
</div>
<div class="am-modal am-modal-no-btn" tabindex="-1" id="fk" style="height: 150px">
    <div class="am-modal-dialog">
        <div class="am-modal-hd"><fw id="otitle">开通:Pays服务</fw>
            <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
        </div>
        <div class="am-modal-bd">
            <p>选择付款方式</p>
            <a class="am-btn am-btn-secondary am-btn-xs" id="zfb" href="javascript:$('#fk').modal('close');tip('付款数据丢失啦,请重新打开付款试试！');">支付宝</a>
            <a class="am-btn am-btn-success am-btn-xs" id="wx" href="javascript:$('#fk').modal('close');tip('付款数据丢失啦,请重新打开付款试试！');">微信支付</a>
            <a class="am-btn am-btn-danger am-btn-xs" id="qq" href="javascript:$('#fk').modal('close');tip('付款数据丢失啦,请重新打开付款试试！');">QQ钱包</a>
        </div>
    </div>
</div>
<div class="am-modal am-modal-no-btn" tabindex="-1" id="tips" style="height: 150px">
    <div class="am-modal-dialog">
        <div class="am-modal-hd"><fw id="otitle">温馨提示</fw>
            <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
        </div>
        <div class="am-modal-bd" id="msg">
            错误信息
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn">好的,知道了</span>
        </div>
    </div>
</div>
<script type="text/javascript">
    function fk(title,money){
        $('#otitle').html('开通/续费:'+ title);
        $('#zfb').attr('href','http://支付页面/?appid=84066E5D4F7E03C56DA3C36D29EBBB08&income='+money+'&rurl={{  base64_encode('http://ek.edlm.cn/opens?st=lp') }}&type=alipay&gu={{ base64_encode('http://ek.edlm.cn/opens?st=lp&mds='.Auth::user()->id) }}');
        $('#wx').attr('href','http://支付页面/?appid=84066E5D4F7E03C56DA3C36D29EBBB08&income='+money+'&rurl={{  base64_encode('http://ek.edlm.cn/opens?st=lp') }}&type=wxpay&gu={{ base64_encode('http://ek.edlm.cn/opens?st=lp&mds='.Auth::user()->id) }}');
        $('#qq').attr('href','http://支付页面/?appid=84066E5D4F7E03C56DA3C36D29EBBB08&income='+money+'&rurl={{  base64_encode('http://ek.edlm.cn/opens?st=lp') }}&type=qqpay&gu={{ base64_encode('http://ek.edlm.cn/opens?st=lp&mds='.Auth::user()->id) }}');
        $('#fk').modal();
    }
    function tip(msg){
        $('#msg').html(msg);
        $('#tips').modal();
    }
</script>
@endsection