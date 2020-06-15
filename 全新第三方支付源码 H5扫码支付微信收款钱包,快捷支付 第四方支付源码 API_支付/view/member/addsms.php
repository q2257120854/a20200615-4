	<script src="/static/common/jquery.js" type="text/javascript"></script>
           
<form class="form-horizontal" action="/member/userinfo/savesms"
method="post">
    <div class="form-group">
        <label class="col-md-3 control-label">
            手机号码：
        </label>
        <div class="col-md-6">
            <input type="text" id='phone' name="phone" class="form-control" value="<?php echo $userinfo['phone']?>"
            disabled>
        </div>
    </div>
	    <div class="form-group">
		        <label class="col-md-3 control-label">
            验证码：
        </label>
					<div class="col-lg-6">
				<div class="input-group">
                                            <input type="text" id="verifycode" name="verifycode" class="form-control" 
                                            maxlength="4" required>
							<br> <br>
												<button id="btnSendCode" class="btn btn-default getcode" onClick="getCode(this)"  type="button">			
						<i class="fa fa-mobile"></i> &nbsp;  点击获取手机验证码
		
						</button>
					
                                           
                                        </div>
										   </div>
                                    </div>
  <!-- placeholder=""--->
    <div class="form-group">
        <div class="col-md-offset-3 col-md-4">
            <button type="submit" class="btn btn-success">
                &nbsp;
             <i class="fa fa-check-square-o"></i>
                &nbsp;立即保存&nbsp;
            </button>
        </div>
    </div>
</form>
<br>


<script type="text/javascript">
				var InterValObj; //timer变量，控制时间
				var count = 60; //间隔函数，1秒执行
				var curCount;//当前剩余秒数
				var code = ""; //验证码
				var codeLength = 4;//验证码长度
 			/*-------------------------------------------*/
			
				function getCode(obj) {		
				curCount = count;
				tel = $('#phone').val();
				if(tel!=''){
		//验证手机有效性
			 var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
            if(!myreg.test($('#phone').val())) 
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
				data: "Tel=" + $("#phone").val(),
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