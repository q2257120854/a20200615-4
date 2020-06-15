<?php require_once 'header.php' ?>
<link rel="stylesheet" href="/view/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/view/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="/view/kindeditor/CN.js"></script>
<style>
#DemoArea
{

width: 220px;
height: 150px;

}
#DemoArea .box-ribbon {
	color: #fff;
    position: absolute;
    line-height: 24px;
    text-align: center;
    top: 175px;
    right: 592px;
    width: 100px;
    height: 25px;
    padding: 1px;
	border-radius:2px;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.13);

    background-color: #5DB9E4;
}

#DemoArea img{
	border-radius:10px;
	margin:0;
	padding:0;
	margin-left: 10px;
	background-color: #ffffff;
	border: 1px solid #c3c3c3;
   width:100%;
   height:100%;
}
</style>
<script type="text/javascript">
<!--
function test_demo_val(strValue)
{

var strId="DemoArea"

document.getElementById(strId).style.borderRadius=strValue;

document.getElementById("CodeValue").innerHTML=strValue;
}
//-->
</script>

    <script>
        var editor;
        KindEditor.ready(function(K) {
            var editor = K.editor({
					allowFileManager : true
				});


				K('#image3').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#xuke').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#xuke').val(url);
								editor.hideDialog();

								K('#image3-img').html("<img widht=200 height=200 src="+url+" />");
								
							}
						});
					});
				});

				K('#image2').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#yingye').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#yingye').val(url);
								editor.hideDialog();
								K('#image2-img').html("<img widht=200 height=200 src="+url+" />");
							}
						});
					});
				});


				K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#fanbian').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#fanbian').val(url);
								editor.hideDialog();
								K('#image1-img').html("<img widht=200 height=200 src="+url+" />");
							}
						});
					});
				});


				K('#image4').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#shenfen').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#shenfen').val(url);
								editor.hideDialog();
								K('#image4-img').html("<img widht=200 height=200 src="+url+" />");
							}
						});
					});
				});









        });
</script>											
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
							  <?php if($this->userData['is_state']=='0'):?>
            <div class="alert alert-warning" style="margin-bottom:0;">
                <span class="glyphicon glyphicon-info-sign">
                </span>
                &nbsp;您当前的账号状态为
                <span class="label label-danger">
                    未审核
                </span>
                ，请继续完善以下信息然后联系客服以便审核。
            </div>
            <?php endif;?>
                            <div class="panel-body">
							
							

                <div class="content-box">
                    <form class="form-ajax form-horizontal" action="/member/userinfo/editsave"
                    method="post">
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                注册邮箱：
                            </label>
                    
                         		<div class="col-lg-6">
				<div class="input-group">
                                <input type="text"  class="form-control"  value="<?php echo $userinfo['email']?>"
                                disabled><span class="input-group-addon" >
									<?php echo $users['is_verify_email']==1 ? '已验证' : '未验证'?>
											
										</span>	
                        </div>  </div>
                                              </div>
						                   <div class="form-group">
                            <label class="col-md-2 control-label">
                                手机号码：
                            </label>
                   		<div class="col-lg-6">
				<div class="input-group">
		
                                <input type="text"  name="phone"  class="form-control"
<?php echo $users['is_verify_phone']==1 ? 'value="'.substr_replace($userinfo['phone'],'****',3,4).'"'.' disabled' :  'value="'.$userinfo['phone'].'"'.' required'  ?>> 
	<span class="input-group-btn"> 
						<button class="btn btn-default" <?php echo $users['is_verify_phone']==1 ? 'disabled="disabled"' : '' ?> onclick="showContent('手机验证','/member/userinfo/addsms')"  type="button">			
						<?php echo $users['is_verify_phone']==1 ? '已验证' : '未验证' ?>
		
						</button></span>
                        </div>
						</div>
							</div>
    					<!--- 
						input-group-addon"
						--->
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                联系QQ：
                            </label>
                               <div class="col-md-6">
                                <input type="text" name="qq" class="form-control" value="<?php echo $userinfo['qq']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                真实姓名：
                            </label>
                       <div class="col-md-6">
                                <input type="text" name="realname" class="form-control" value="<?php echo $userinfo['realname']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                身份证号：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="idcard" class="form-control" value="<?php echo $userinfo['idcard']?>"
                                required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                收款银行：
                            </label>
                           <div class="col-md-6">
                                <select name="batype" class="form-control">
                                    <?php foreach($this->
                                        setConfig->shipBank() as $bank):?>
                                        <option value="<?php echo $bank ?>" <?php echo $userinfo[ 'batype']==$bank ? ' selected' : ''?>
                                            >
                                            <?php echo $bank ?>
                                        </option>
                                        <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                收款银行账号：
                            </label>
                               <div class="col-md-6">
                                <input type="text" name="baname" class="form-control" value="<?php echo $userinfo['baname']?>"
                                placeholder="银行卡帐号" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                开户银行地址：
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="baaddr" class="form-control" value="<?php echo $userinfo['baaddr']?>"
                                placeholder="省份/城市/分行名称" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                网站名称：
                            </label>
                        <div class="col-md-6">
                                <input type="text" name="sitename" class="form-control" value="<?php echo $userinfo['sitename']?>"
                                 placeholder="填写网站或平台名称" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                                网站地址：
                            </label>
                       <div class="col-md-6">
                                <input type="text" name="siteurl" class="form-control" value="<?php echo $userinfo['siteurl']?>"
                               placeholder="http://" required>
                            </div>
                        </div>
						
					
						
	<div class="form-group">
                            <label class="col-md-2 control-label">
                                身份证正面:
                            </label>
                       <div class="col-md-6">

								<input type="button" id="image4" value="选择图片" />（本地上传）
                                <input type="hidden" name="shenfen" id="shenfen" class="form-control" value=""
                                required>
								<div id="image4-img">
								<?php 
						
						if (!$userinfo['shenfen']){
						
							echo "未上传,请上传身份证正面";
						}else{
						
							echo "<br><div id='DemoArea'><img src='".$userinfo['shenfen']."' width=300 /><div class='box-ribbon'>已通过认证</div></div>";
						
						}
						
						?>
						
						</div>

                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-md-2 control-label">
                                身份证反面:
                            </label>
                       <div class="col-md-6">
								
								<input type="button" id="image1" value="选择图片" />（本地上传）
                                <input type="hidden" name="fanbian" id="fanbian" class="form-control" value=""
                                required>
								<div id="image1-img">
								<?php 
						
						if (!$userinfo['fanbian']){
						
							echo "未上传,请上传身份证反面";
						}else{
						
							echo "<br><div id='DemoArea'><img src='".$userinfo['fanbian']."' width=300 /><div class='box-ribbon'>已通过认证</div></div>";
						
						}
						
						?>
						</div>
                            </div>
                        </div>

						
						<div class="form-group">
                            <label class="col-md-2 control-label">
                                营业执照:
                            </label>
                       <div class="col-md-6">

								<input type="button" id="image2" value="选择图片" />（本地上传）<span style="color:red">个人用户请上传手持身份证照片</span>
                                <input type="hidden" name="yingye" id="yingye" class="form-control" value=""
                                required>
								<div id="image2-img">
								
								<?php 
						
						if (!$userinfo['yingye']){
						
							echo "未上传,请上传营业执照";
						}else{
						
							echo "<br><div id='DemoArea'><img src='".$userinfo['yingye']."' width=300 /><div class='box-ribbon'>已通过认证</div></div>";
						
						}
						
						?></div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-md-2 control-label">
                                开户许可证:
                            </label>
                       <div class="col-md-6">	
								
								<input type="button" id="image3" value="选择图片" />（本地上传）<span style="color:red">个人用户请上传结算卡正面照片</span>
                                <input type="hidden" name="xuke" id="xuke" class="form-control" value=""
                                required>
								<div id="image3-img">
								
								 <?php 
						
						if (!$userinfo['xuke']){
						
							echo "未上传,请上传开户许可证";
						}else{
						
							echo "<br><div id='DemoArea'><img src='".$userinfo['xuke']."' width=300 /><div class='box-ribbon'>已通过认证</div></div>";
						
						}
						
						?>
						</div>
                            </div>
                        </div> 
						
						<?php if ($users['is_verify_phone']==1) : ?>
							    <div class="form-group">
                            <label class="col-md-2 control-label">
                                手机验证码：
                            </label>
                   		<div class="col-lg-6">
				<div class="input-group">
			   <input type="text" id="verifycode" name="verifycode" class="form-control" maxlength="5" required>
			   	<span class="input-group-btn"> 
				
							<button id="btnSendCode" class="btn btn-default getcode" onClick="getCode(this)"  type="button">			
						          <i class="fa fa-mobile"></i> &nbsp;获取手机验证码</button>
		
						</button></span>
					
						</div>
						</div>
                            </div>
								<?php endif;?>	
						
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-6">
                                <button type="submit" class="btn btn-success">
                                    &nbsp;
                                                <i class="fa fa-check-square-o"></i>
                                    &nbsp;保存设置&nbsp;
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
    </div>  
	</div>
	   </div>
	   	   </div>
		   	   </div>
			    </div>
	

<script type="text/javascript">
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

			var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(14[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 

			alert(tel);

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