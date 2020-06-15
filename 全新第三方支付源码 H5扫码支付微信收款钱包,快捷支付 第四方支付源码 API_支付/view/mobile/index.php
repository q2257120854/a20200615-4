<?php require_once 'header.php' ?>
	<header class="aui-bar aui-bar-nav aui-text-content ziset">
		<h1>钱包</h1>
    </header>
    <header class="aui-bar aui-bar-nav aui-text-left header" id="header">
		<div class="aui-row aui-row-padded">
                        <div class="aui-col-xs-6 yu">
                            <h1>余额</h1>
                        </div>
                        <div class="aui-col-xs-6 yu">
                            <h1>今日订单</h1>
                        </div>
                        <div class="aui-col-xs-6 yu">
                            <h1><?php echo number_format($unpaid, '2', '.', '')?><div class="aui-badge zise ">元</div></h1>
                        </div>
                        <div class="aui-col-xs-6 yu">
                            <div class="aui-content">
								<h1><?php echo $today_orders;?></h1>
								<div class="aui-badge zise ">单</div>
							</div>
                        </div>                        
        </div>
        
    </header>



	<section class="aui-grid">
        <div class="aui-row">
            <div onclick="tiao(&#39;/mobile/orders&#39;)" class="aui-col-xs-4 fangge" align="center">
                <img src="/static/common/ddgl.png" style="width:30%; margin-left:auto; margin-right:auto;"/>
                <div class="aui-grid-label">订单管理</div>
            </div>
            <div onclick="tiao(&#39;/mobile/payments&#39;)" class="aui-col-xs-4 fangge">
                <img src="/static/common/tixian.png" style="width:30%; margin-left:auto; margin-right:auto;"/>
                <div class="aui-grid-label">提现管理</div>
            </div>
            <div onclick="tiao(&#39;/mobile/bank&#39;)" class="aui-col-xs-4 fangge">
                <img src="/static/common/bank.png" style="width:30%; margin-left:auto; margin-right:auto;"/>
                <div class="aui-grid-label">银行卡</div>
            </div>
            <div onclick="tiao(&#39;/mobile/takecash&#39;)" class="aui-col-xs-4 fangge">
                <img src="/static/common/outbank.png" style="width:30%; margin-left:auto; margin-right:auto;"/>
                <div class="aui-grid-label">我要提现</div>
            </div>
            <div onclick="tiao(&#39;/mobile/mycode&#39;)" class="aui-col-xs-4 fangge">
                <img src="/static/common/erweima.png" style="width:30%; margin-left:auto; margin-right:auto;"/>
                <div class="aui-grid-label">我的二维码</div>
            </div>
            <div class="aui-col-xs-4 fangge">
				<img src="/static/common/out.png" style="width:30%; margin-left:auto; margin-right:auto;"/>
                <div class="aui-grid-label"><a href="/login/logout" style="text-decoration:none; color:#444;" target="_top">退出登录</a></div>
            </div>
            <div class="aui-col-xs-4 fangge">
                <i class="aui-iconfont"></i>
                <div class="aui-grid-label"></div>
            </div>
            <div class="aui-col-xs-4 fangge">
				<i class="aui-iconfont"></i>
                <div class="aui-grid-label"></div>
            </div>
			<div class="aui-col-xs-4 fangge">
				<i class="aui-iconfont"></i>
                <div class="aui-grid-label"></div>
            </div>
        </div>
    </section>


<div class="aui-bar ad1" id="footer">
	广告位
</div>
<?php require_once 'footer.php' ?>