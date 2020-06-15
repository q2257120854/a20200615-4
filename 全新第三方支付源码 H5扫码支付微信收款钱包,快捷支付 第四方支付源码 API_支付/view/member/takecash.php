<?php require_once 'header.php' ?>
 <div class="row wrapper wrapper-content">
            <div class="row">
                <div class="col-md-12">
                                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                             <?php echo $title ?>
                                </div>
                            </div>
        <div class="alert alert-warning" style="margin-bottom:0px;border:1px solid #ddd;border-top:0">
            <p>
                1、当前最低提现金额
                <?php echo $this->config['tx_minmoney']?>元
            </p>
            <p>
                2、当前结算手续费
                <?php echo $this->config['tx_fee']?>% (最高手续费 为<?php echo $this->config['tx_limit']?>%)，提现时手续费不足1元按1元收取。
            </p>
			  <p>3、您当前的账号结算周期为：
                        <span class="label label-success">
                            <?php echo $this->setConfig->shipCycle($this->userData['ship_cycle'])?>
                        </span>，未到指定结算周期，提现申请将被系统自动拒绝。</p>
        </div>
         <div class="panel-body">
            <form class="form-ajax form-horizontal" action="/member/takecash/submit"
            method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        商户名：
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="<?php echo $this->userData['username']?>"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        当前账户收入：
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="<?php echo $money+$income?>"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        可提现金额：
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="txmoney" class="form-control" value="<?php echo $money ?>"
                        required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        手续费：
                    </label>
                    <div class="col-md-6">
                        <input type="text" id="fee" class="form-control" value="<?php echo $fee ?>"
                        disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        下发方式：
                    </label>
					
					 <div class="col-md-6">
                        <select class="form-control" name="ptype">
                            <option value="0">选择提现方式</option>
                            <option value="1">银行代付</option>
					
                        </select>
					<!--
                    <div class="col-md-6">
                        <label>
                            <input type="radio" name="ptype" value="0" checked>
                            &nbsp;普通下发(已经停用,请选择右侧银行代收方式)
                        </label>
                        &nbsp;&nbsp;
                        <label>
                            <input type="radio" name="ptype" value="1">
                            &nbsp;银行代收(最低限额:<?php echo $this->config['tx_minmoney']?>元)
                        </label>  -->
                    </div>
                </div>
                <div class="p0">
                    <div class="form-group">
                        <label class="col-md-2 control-label">
                            注意事项：
                        </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="请务必正确填写收款信息,否则会造成代付失败"
                            disabled>
                        </div>
                    </div>
					
				
                   <!-- <div class="form-group">
                        <label class="col-md-2 control-label">
                            收款方式：
                        </label>
                        <div class="col-md-6">
                            <select class="form-control" disabled>
                                <?php foreach($this->
                                    setConfig->shipBank() as $bank):?>
                                    <option value="<?php echo $bank ?>" <?php echo $userinfo[ 'batype']==$bank
                                    ? ' selected' : ''?>
                                        >
                                        <?php echo $bank ?>
                                    </option>
                                    <?php endforeach;?>
                            </select>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="col-md-2 control-label">
                            收款账号：
                        </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $userinfo['baname']?>"
                            placeholder="支付宝/财付通/银行卡" disabled>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="col-md-2 control-label">
                            开户地址：
                        </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $userinfo['baaddr']?>"
                            placeholder="省份/城市/分行名称" disabled>
                        </div>
                    </div> -->
			
				
					
					
                </div>
						
                <div class="p1" style="display:none">
                    <div class="form-group add" style="display:none">
                        <label class="col-md-2 control-label">
                        </label>
                        <div class="col-md-6">
                            <div class="alert alert-warning">
                                还没有代收银行信息，现在&nbsp;
                                <a href="javascript:;" onclick="showContent('添加代收银行信息','/member/userinfo/addcfo')"
                                class="btn btn-danger btn-sm">
                                    添加
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="display:none" id="cfolist">
                        <label class="col-md-2 control-label">
                        </label>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="gray">
                                        选择代收银行：
                                    </span>
                                </div>
                                <div class="panel-body cfolistcontent">
                                    正在加载...
                                </div>
                                <div class="panel-footer">
                                    <a href="javascript:;" onclick="showContent('添加代收银行信息','/member/userinfo/addcfo')"
                                    class="btn btn-default btn-sm">
                                        <i class="fa fa-plus">
                                        </i>
                                        &nbsp;添加新的代收银行
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php  if ($this->userData['is_verify_phone']==1) : ?>
							    <div class="form-group">
                            <label class="col-md-2 control-label">
                                手机验证码：
                            </label>
                   		<div class="col-lg-6">
				<div class="input-group">
			   <input type="text" id="verifycode" name="verifycode" class="form-control" maxlength="4" required>
			   	<span class="input-group-btn"> 
				
							<button id="btnSendCode" class="btn btn-default getcode" onClick="getCode(this)"  type="button">			
				<i class="fa fa-mobile"></i> &nbsp;获取手机验证码</button>
		
						</button></span>
						</div>
						</div>
                            </div>
								<?php endif;?>	
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <button type="submit" class="btn btn-success">
                            &nbsp;
                           <i class="fa fa-check-square-o"></i>
                            &nbsp;立即申请&nbsp;
                        </button>
						
                    </div>
                </div>
            </form>
    </div>
    </div> </div></div>
    <script>
        $(function() {
            $('[name=ptype]').click(function() {
                $('.p0,.p1').hide();
                $('.p' + $(this).val()).fadeIn();
                getCfo();
            });
            $('[name=txmoney]').keyup(function() {
                var money = $(this).val();
                $.post('/member/takecash/getFee', {
                    money: money
                },
                function(ret) {
                    $('#fee').val(ret);
                });
            });
        });
        function getCfo() {
            $.post('/member/userinfo/getcfo', {
                t: new Date().getTime()
            },
            function(data) {
                if (data == '') {
                    $('.add').fadeIn();
                } else {
                    $('#cfolist').show();
                    $('.cfolistcontent').html(data);
                }
            });
        }
        function del(id) {
            if (confirm('是否删除？')) {
                $.post('/member/userinfo/delcfo', {
                    id: id,
                    t: new Date().getTime()
                },
                function(ret) {
                    if (ret.status == 0) {
                        alert('删除失败');
                    } else {
                        $('p.c' + id).fadeOut();
                    }
                },
                'json');
            }
        }
		
		var InterValObj; //timer变量，控制时间
				var count = 60; //间隔函数，1秒执行
				var curCount;//当前剩余秒数
				var code = ""; //验证码
				var codeLength = 6;//验证码长度
					var tel = <?php echo $userinfo['phone'] ?>;
			
				function getCode(obj) {		
				curCount = count;
							if(tel!=''){
		//验证手机有效性
			 var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/;  
            if(!myreg.test(tel)) 
          { 
             alert('请输入有效的手机号码！'); 
             return false; 
          } 
			$("#btnSendCode").attr("disabled", "true");
			$("#btnSendCode").html("请在" + curCount + "秒内输入验证码");
			InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
			$.ajax({
				url: "/sms.php",
				type: "Post",
				data: "Tel=" + tel,
				success: function(msg) {
                if (msg == "ok") {
              alert("生成成功!请等侍短信提示。")
              return;
          }
          if (msg == "error") {
              alert("生成失败!请联系管理员")
              return;
          }
          alert(msg);
      }
  });
			}else{
			alert('请填写手机号码');
		        }
				        }
			function SetRemainTime() {
			if (curCount == 0) {                
						window.clearInterval(InterValObj);//停止计时器
						$("#btnSendCode").removeAttr("disabled");//启用按钮
						$("#btnSendCode").html("重新发送验证码");
						code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效    
					}
					else {
						curCount--;
						$("#btnSendCode").html("请在" + curCount + "秒内输入验证码");
					}
				}
    </script>
<?php require_once 'footer.php' ?>