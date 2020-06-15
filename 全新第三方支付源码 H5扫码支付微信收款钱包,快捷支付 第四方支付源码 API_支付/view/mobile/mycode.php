<?php require_once 'header.php' ?>
<header class="aui-bar aui-bar-nav baiset">
    <a onclick="tiao(&#39;/mobile/&#39;)" class="aui-pull-left aui-btn">
        <span style="color:#fff" class="aui-iconfont c-b"><返回</span>
    </a>
    <div class="aui-title">银行卡</div>
</header>
<script src="/js/qrcode.js"></script>
<div id="qrcode" style="margin-left:auto; margin-right:auto; margin-top:50px; width:120px;">
</div>
<script>
    window.onload =function(){
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 120,//设置宽高
            height : 120
        });
        qrcode.makeCode("<?php echo $imgfurl;?>");
        document.getElementById("send").onclick =function(){
            qrcode.makeCode(document.getElementById("getval").value);
        }
    }
</script>
<?php require_once 'footer.php' ?>