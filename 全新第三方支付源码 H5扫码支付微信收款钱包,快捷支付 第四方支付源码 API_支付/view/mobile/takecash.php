<?php require_once 'header.php' ?>
<header class="aui-bar aui-bar-nav baiset">
    <a onclick="tiao(&#39;/mobile/&#39;)" class="aui-pull-left aui-btn">
        <span style="color:#fff" class="aui-iconfont c-b"><取消</span>
    </a>
    <div class="aui-title">我要提现</div>
	
</header>
<style>
	.bankone{
		width:90%;
		margin-left:auto;
		margin-right:auto;
		height:90px;
		background:#FBFBFB;
		margin-top:20px;
		font-size:15px
	}
	.bankword{
		float:left;
		margin-left:5%;
	}
	.bankwordl{
		float:left;
		margin-left:20px;
	}
	.outbankmoney{
		width:90%;
		margin-left:auto;
		margin-right:auto;
		height:300px;
		background:#fff;
	}
	.word{
		width:90%;
		margin-left:auto;
		margin-right:auto;
		font-size:15px;
	}
	.money{
		font-size:20px;
		width:90%;
		margin-left:auto;
		margin-right:auto;
	}
	.money input{
		border:0;
		border-bottom:1px solid #ccc;
		width:90%;
		float:left;
		font-size:20px;
	}
	.pwd{
		font-size:20px;
		width:90%;
		margin-left:auto;
		margin-right:auto;
	}
	.pwd input{
		border:1px solid #ccc;
		width:60%;
	}
	.word2{
		width:90%;
		margin-left:auto;
		margin-right:auto;
		font-size:15px;
		color:#ccc;
		float:left;
		margin-left:10%;
	}
	.btn{
		width:90%;
		margin-left:5%;
		margin-right:auto;
		color:#fff;
		font-size:20px;
		height:40px;
		line-height:40px;
		background:#A3DEA3;
		border:1px solid #ccc;
		padding:0px;
		border-radius:5px;
	}
	.y select{
		color:#09f;
		font-weight:normal;
	}
</style>
<form class="form-ajax2 form-horizontal" action="/mobile/takecash/submit1" method="post">
<div class="bankone">
	<div style="width:100%; height:20px;"></div>
	<div class="bankword">
    	<b>到账银行卡<b>	
    </div>
    <div class="bankwordl">
    	<div style="color:#7181AD;"><span class="y"><select name="bankid">
            	<?php foreach($usercfo as $l){?>
            	<option value="<?php echo $l['id'];?>"><?php echo $l['bankname']."(".$l['cardno'].")";?></option>
                <?php }?>
       		</select></span></div>
    </div>
</div>
<div class="outbankmoney">
	<div style="width:100%; height:20px;"></div>
    <div class="word">
    	<b>提现金额</b>
    </div>
    <div class="money">
    	<span style="float:left; margin-top:20px;">￥</span><input type="text" name="txmoney"/>
    </div>
    <div class="word2">
    	零钱余额：￥<span style="color:green;"><?php echo $money;?></span>
    </div>
    <div style="width:100%; height:30px; float:left;"></div>
    <button class="btn">提现</button>
</div>
</form>
<script>
    $(function() {
        $('.form-ajax2').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(ret) {
                    if (ret.status == '0') {
                        alert('保存失败');
                    }
                    if (ret.status == '1') {
                        alert('保存成功');
                        $('#waModal').modal('hide');
                    }
                }
            });
        });
        $('#waModal').on('hidden.bs.modal',
        function(e) {
            getCfo();
        });
    })
</script>

<?php require_once 'footer.php' ?>