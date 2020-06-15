        <script type="text/javascript">
			function tiao(str){
				window.location.href=str;
			}
		</script>
        <style>
			*{
				margin:0;
				padding:0;
				border:0;
			}
        	.bottome111{
				width:100%;
				height:70px;
				background:#fff;
				bottom:0;
				position:fixed;
			}
			.bone{
				width:30%;
				margin-left:3%;
				margin-top:10px;
				float:left;
			}
			.bone a{
				text-decoration:none;
				color:#444;
				font-size:10px;
			}
			.bone img{
				width:30px;
			}
        </style>
		<script src="/static/member/bootbox.min.js"></script>
        <script src="/static/member/metismenu.js"></script>
        <script src="/static/member/jquery-ui.min.js"></script>
        <script src="/static/member/jquery.placeholder.min.js"></script>
        <script src="/static/member/jquery.qrcode.min.js"></script>       
 		<script src="/static/member/common.js"></script>
        <div class="bottome111" align="center">
        	<div class="bone"><a href="/mobile/"><img src="/static/common/bhome.png" style="margin-left:auto; margin-right:auto;"/>首页</a></div>
            <div class="bone"><a href="/mobile/orders"><img src="/static/common/border.png" style="margin-left:auto; margin-right:auto;"/>订单</a></div>
            <div class="bone"><a href="#" onclick="alert('暂未开通');return false;"><img src="/static/common/bperson.png" style="margin-left:auto; margin-right:auto;"/>个人中心</a></div>
        </div>
    </body>

</html>