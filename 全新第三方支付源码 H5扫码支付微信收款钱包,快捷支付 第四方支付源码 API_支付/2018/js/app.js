/*
 *v=1.0
 **/
var validate = window.validate || {};
var app = window.app || {};
validate.data={
		reg : {
			obj : $("#bindPhone"),
			list : [ {obj : $("#email_"),parames : {type : "Email",byte:[0,32],tips:"请输入电子邮箱",empty : "请输入电子邮箱",error : "电子邮箱格式有误",ajax : {url : Context.base + "/register/valiateAccount.htm",data : {account : $("#email_")}}}},
					{obj : $("#password_"),parames : {type:"passWordStrong",byte : [ 6, 32, "长度必须在6~32位" ],tips:"<div class='pwd-tip'><div>请设置您的登录密码,区分大小写</div><div><b id='pwd-tj1' class='input-ont'></b>6-32位</div><div><b id='pwd-tj2' class='input-ont'></b>字母，数字及符号的组合</div><div id='pwd-ds' class='hide mt'><b class='input-ont icons icons-s-info'></b>大写锁定已打开</div></div>",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}},
					{obj : $("#password2_"),parames : {type:"passWordStrong",ext : function(obj) {if(obj.val() == $("#password_").val()){return {status:true,msg:"验证通过"}}else{return {status:false,msg:"两次密码输入不一致"}}},byte : [ 6, 32, "长度必须在6~32位" ],tips:"字母、数字及符号的组合，6-32位，区分大小写",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}},
					{obj : $("#code_"),parames : {reg : /^[A-Za-z0-9]{1,4}$/,empty : "请输入验证码",error : "验证码有误",place : $("#code_tip")}}
				   ],
			callback : function() {
				typeof(_paq)!="undefined" && _paq.push(['trackEvent','reg_again','重新填写注册页下一步按钮']);

				if(!$("input[name='agree']").is(":checked")){
					ll.common.tips("error","请选择同意智通付商户协议",1000);
					return;
				}

				ll.common.ajaxForm({
					obj:$("#bindPhone"),
					url : Context.base + "/register/validateImageCode.htm",
					data : $("#register").serialize(),
					success : function(data) {
						if (data.retcode == "0000") {
							var con = $("#bindPhoneTemp").html();
							ll.dialog.simple({title : '绑定手机号码',content : con,width : 660,lock : true,load : function() {
								$("#SendMsg").off("click.send").on("click.send",function() {
									var t=$(this).text();
									if($("#phone").val()==""){
										ll.common.tips("error","请输入手机号码",1000);
										return;
									}
									if(!ll.validate.reg.Mobile.test($("#phone").val())){
										ll.common.tips("error","请输入正确的手机号码",1000);
										return;
									}
									if ($(this).hasClass("disabled")) {return;}
									// 请求短信验证码
									var email = data.info.account;
									var telephone = $("#phone").val();
									var that = $(this);
									ll.common.ajaxForm({
										obj:$("#SendMsg"),
										url : Context.base+ "/register/sendRegisterPhoneMsg.htm",
										data : {account : email,phone : telephone},
										beforeSend:function(){
											$("#SendMsg").text("请稍后");
										},
										success : function(result) {
											$("#SendMsg").text(t);
											if (result.retcode == "0000") {
												$("#handleCode").val(result.info.handCode);
												ll.common.messageCode(that,60);
											} else {
												ll.common.tips('error',result.retmsg,2000);
											};
										},
										error : function(){
											$("#SendMsg").text(t);
											ll.common.tips('error',"验证码发送失败",2000);
										}
									});
								});
								$("#submitRegister").off("click").on("click", function() {
									typeof(_paq)!="undefined" && _paq.push(['trackEvent','reg_phone_again','重新填写绑手机号按钮']);
									var param = $("#register").serialize() + "&smsCode="+ $("#smsCode").val();
									ll.common.ajaxForm({
										obj:$("#submitRegister"),
										url : Context.base + "/register/submitRegister.htm",
										data : param,
										success : function(data) {
										if (data.retcode == "0000") {
											location.href = Context.base+ "/register/loginEmailPage.htm?account="+ data.info.account+"&UUID="+data.info.uuid;
										} else {
											ll.common.tips('error', data.retmsg,2000);
										}
										}
									});
								});
							}
						});
						} else {
							refresh();
							$("#code_").val("");
							ll.common.tips('error', data.retmsg,2000);
						}
					}
				});
			}
		},
		indexReg : {
			obj : $("#bindPhone"),
			list : [ {obj : $("#emailr_"),parames : {type : "Email",byte:[0,32],tips:"请输入电子邮箱",empty : "请输入电子邮箱",error : "电子邮箱格式有误",ajax : {url : Context.base + "/register/valiateAccount.htm",data : {account : $("#emailr_")}}}},
					{obj : $("#passwordr_"),parames : {type:"passWordStrong",byte : [ 6, 32, "长度必须在6~32位" ],tips:"<div class='pwd-tip'><div>请设置您的登录密码,区分大小写</div><div><b id='pwd-tj1' class='input-ont'></b>6-32位</div><div><b id='pwd-tj2' class='input-ont'></b>字母，数字及符号的组合</div><div id='pwd-ds' class='hide mt'><b class='input-ont icons icons-s-info'></b>大写锁定已打开</div></div>",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}},
					{obj : $("#passwordr2_"),parames : {type:"passWordStrong",ext : function(obj) {if(obj.val() == $("#passwordr_").val()){return {status:true,msg:"验证通过"}}else{return {status:false,msg:"两次密码输入不一致"}}},byte : [ 6, 32, "长度必须在6~32位" ],tips:"字母、数字及符号的组合，6-32位，区分大小写",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}},
					{obj : $("#coder_"),parames : {reg : /^[A-Za-z0-9]{1,4}$/,empty : "请输入验证码",error : "验证码有误",place : $("#code_tip")}},
					{obj:$("#phone"),parames:{type:"Mobile",empty:"请输入手机号码",error:"请输入正确的手机号码"}},
					{obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入短信验证码",error:"请输入正确的短信验证码"}}
				   ],
			callback : function() {
				typeof(_paq)!="undefined" && _paq.push(['trackEvent','reg_btn','注册按钮']);

				if(!$("input[name='agree']").is(":checked")){
					ll.common.tips("error","请选择同意智通付商户协议",1000);
					return;
				}

				var param = $("#register").serialize() + "&smsCode="+ $("#smsCode").val();
				ll.common.ajaxForm({
					obj:$("#bindPhone"),
					url : Context.base + "/register/submitRegister.htm",
					data : param,
					success : function(data) {
						if (data.retcode == "0000") {
							location.href = Context.base+ "/register/loginEmailPage.htm?account="+ data.info.account+"&UUID="+data.info.uuid;
						} else {
							refresh(['valir','vali']);
							$("#coder_").val("");
							ll.common.tips('error', data.retmsg,2000);
						}
					}
				});
			}
		},
		modifyPassword:{
			obj : $("#validateAccount"),
			list : [ {obj : $("#email_"),parames : {type : "Email",byte:[0,32],empty : "请输入电子邮箱",error : "电子邮箱格式有误"}},
					{obj : $("#code_"),parames : {reg : /^[A-Za-z0-9]{4}$/,empty : "请输入验证码",error : "验证码有误",place : $("#code_tip")}}
				   ],
			callback : function() {
				ll.common.ajaxForm({
						obj:$("#validateAccount"),
						type : 'POST',
						url : Context.base + "/password/validateImageCode.htm",
						data : $("#mdifyPassword").serialize(),
						success : function(data) {
							if (data.retcode == "0000") {
								location.href = Context.base+ "/password/modifyPasswordEmailPage.htm?account="+ data.info.account+ "&code="+ data.info.code+ "&bizcode="+ data.info.bizcode+ "&sign=" + data.info.sign;
							} else {
								ll.common.tips('error',data.retmsg,2000);
								refresh();
							}
						}
				});
			}
		},
		modifyPassword2:{
			obj : $("#mymodifyPassword"),
			list: [
				{obj : $("#password_"),parames : {type:"passWordStrong",byte : [ 6, 32, "长度必须在6~32位" ],tips:"<div class='pwd-tip'><div>请设置您的登录密码，区分大小写</div><div><b id='pwd-tj1' class='input-ont'></b>6-32位</div><div><b id='pwd-tj2' class='input-ont'></b>字母，数字及符号的组合</div><div id='pwd-ds' class='hide mt'><b class='input-ont icons icons-s-info'></b>大写锁定已打开</div></div>",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}},
				{obj : $("#password2_"),parames : {type:"passWordStrong",ext : function(obj) {if(obj.val() == $("#password_").val()){return {status:true,msg:"验证通过"}}else{return {status:false,msg:"两次密码输入不一致"}}},byte : [ 6, 32, "长度必须在6~32位" ],tips : "字母、数字及符号的组合，6-32位，区分大小写",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}}
			],
			callback:function(){
					ll.common.ajaxForm({
						obj : $("#mymodifyPassword"),
						url : Context.base + "/password/modifyPassword.htm",
						data : $("#modifyPasswordForm").serialize(),
						success : function(data) {
							if (data.retcode == "0000") {
								$("#modifyPasswordForm").submit();
							} else {
								ll.common.tips('error', data.retmsg,3000);
							}
						}
					});
			}
		},
	bindcard1:{
		obj:$("#bind_submit"),
        list:[
            {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#smsCode_tip")}}
        ],
        callback:function(){
    		//提交短信验证码
          	ll.common.ajaxForm({
          		obj:$("#bind_submit"),
      	        url: Context.base + "/bindcard/bindCardValidateSmsCode.htm",
      	        data:{smsCode:$("#smsCode").val(),handleCode:$("#handleCode").val()},
          	    success:function(result) {
          	    	if (result.retcode == "0000") {
          	    		$("#bindCardForm").submit();
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,2000);
          	    	}
          	    }
          	});
        }
	},
	bindcard2:{
		obj:$("#bind_submit"),
		list:[
		      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
		      {obj:$("#city"),parames:{error:"请选择省市",place:$("#city_tip")}},
		      {obj:$("#bank_name"),parames:{type:"CN",empty:"请输入开户支行名称",error:"请输入正确的开户支行名称"}},
		      {obj:$("#prcptcd"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
		      {obj:$("#bankNum"),parames:{type:"bankCardCompany",empty:"请输入银行卡号",error:"请输入正确的银行卡号"}},
		      {obj:$("#bankNum2"),parames:{type:"bankCardCompany",ext:function(obj){
	                if(obj.val()==$("#bankNum").val()){
	                    return {status:true,msg:"验证通过"};
	                }else{
	                    return {status:false,msg:"两次卡号输入不一致"};
	                }
	            },empty:"请再次输入银行卡号",error:"请输入正确的银行卡号"}}
		],
        callback:function(){
   			 var cityId = $("#city option:selected").attr("data-code") || "";
   		 	ll.common.ajaxForm({
   				obj:$("#bind_submit"),
   		 		url: Context.base + "/bindcard/bindCardSubmit.htm",
          	    data:$("#bindCardInfoForm").serialize() +"&cityId=" + cityId,
              	success:function(result) {
              		if (result.errorCode == "0000") {
              	    	location.href = Context.base + "/bindcard/bindCardSuccess.htm";
              	    } else {
              	    	ll.common.tips('error',result.errorMessage,2000);
              	    }
              	}
   		 	});
        }
	},
	bindcard2_new:{
		obj:$("#bind_submit"),
		list:[
		      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
		      {obj:$("#cnapsCode"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
		      {obj:$("#bankNum"),parames:{type:"bankCardCompany",empty:"请输入银行账户",error:"请输入正确的银行账户"}},
		      {obj:$("#bankNum2"),parames:{type:"bankCardCompany",ext:function(obj){
		    	  if(obj.val()==$("#bankNum").val()){
		    		  return {status:true,msg:"验证通过"};
		    	  }else{
		    		  return {status:false,msg:"两次账户输入不一致"};
		    	  }
		      },empty:"请再次输入银行账户",error:"请输入正确的银行账户"}}
		      ],
		      callback:function(){
		    	  var cityId = $("#city option:selected").attr("data-code") || "";
		    	  ll.common.ajaxForm({
		    		  obj:$("#bind_submit"),
		    		  url: Context.base + "/bindcard/bindCardSubmit.htm",
		    		  data:$("#bindCardInfoForm").serialize() +"&cityId=" + cityId,
		    		  success:function(result) {
		    			  if (result.errorCode == "0000") {
		    				  location.href = Context.base + "/bindcard/bindCardSuccess.htm";
		    			  } else {
		    				  ll.common.tips('error',result.errorMessage,2000);
		    			  }
		    		  }
		    	  });
		      }
	},
	bindcardind1:{
		obj:$("#bind_submit"),
        list:[
            {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#smsCode_tip")}}
        ],
        callback:function(){
    		//提交短信验证码
          	ll.common.ajaxForm({
          		obj:$("#bind_submit"),
      	        url: Context.base + "/bindcardind/bindCardValidateSmsCode.htm",
      	        data:{smsCode:$("#smsCode").val(),handleCode:$("#handleCode").val()},
          	    success:function(result) {
          	    	if (result.retcode == "0000") {
          	    		$("#bindCardForm").submit();
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,2000);
          	    	}
          	    }
          	});
        }
	},
	bindcardind2:{
		obj:$("#bind_submit"),
		list:[
		      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
		      {obj:$("#city"),parames:{error:"请选择省市",place:$("#city_tip")}},
		      {obj:$("#bank_name"),parames:{type:"CN",empty:"请输入开户支行名称",error:"请输入开户支行名称"}},
		      {obj:$("#prcptcd"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
		      {obj:$("#bankNum"),parames:{type:"bankCard",empty:"请输入银行卡号",error:"请输入正确的银行卡号"}},
		      {obj:$("#bankNum2"),parames:{type:"bankCard",ext:function(obj){
	                if(obj.val()==$("#bankNum").val()){
	                    return {status:true,msg:"验证通过"};
	                }else{
	                    return {status:false,msg:"两次卡号输入不一致"};
	                }
	            },empty:"请再次输入银行卡号",error:"请再次输入银行卡号"}}
		],
        callback:function(){
			 var cityId = $("#city option:selected").attr("data-code") || "";
		 	ll.common.ajaxForm({
				obj:$("#bind_submit"),
     	        url: Context.base + "/bindcardind/bindCardSubmit.htm",
     	        data:$("#bindCardInfoForm").serialize()+"&cityId="+cityId,
         	    success:function(result) {
         	    	if (result.errorCode == "0000") {
         	    		location.href = Context.base + "/bindcardind/bindCardSuccess.htm";
         	    	} else {
         	    		ll.common.tips('error',result.errorMessage,2000);
         	    	}
         	    }
         	});
        }
	},
	bindcardind2_new:{
		obj:$("#bind_submit"),
		list:[
		      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
		      {obj:$("#cnapsCode"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
		      {obj:$("#bankNum"),parames:{type:"bankCard",empty:"请输入银行卡号",error:"请输入正确的银行卡号"}},
		      {obj:$("#bankNum2"),parames:{type:"bankCard",ext:function(obj){
		    	  if(obj.val()==$("#bankNum").val()){
		    		  return {status:true,msg:"验证通过"};
		    	  }else{
		    		  return {status:false,msg:"两次卡号输入不一致"};
		    	  }
		      },empty:"请再次输入银行卡号",error:"请再次输入银行卡号"}}
		      ],
		      callback:function(){
		    	  var cityId = $("#city option:selected").attr("data-code") || "";
		    	  ll.common.ajaxForm({
		    		  obj:$("#bind_submit"),
		    		  url: Context.base + "/bindcardind/bindCardSubmit.htm",
		    		  data:$("#bindCardInfoForm").serialize()+"&cityId="+cityId,
		    		  success:function(result) {
		    			  if (result.errorCode == "0000") {
		    				  location.href = Context.base + "/bindcardind/bindCardSuccess.htm";
		    			  } else {
		    				  ll.common.tips('error',result.errorMessage,2000);
		    			  }
		    		  }
		    	  });
		      }
	},
	bank_card_add_info:{
		obj:$("#bank_card_add_submit"),
		list:[
		      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
		      {obj:$("#cnapsCode"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
		      {obj:$("#bankNum"),parames:{type:"bankCard",empty:"请输入银行卡号",error:"请输入正确的银行卡号"}},
		      ],
		      callback:function(){
		    	  var cityId = $("#city option:selected").attr("data-code") || "";
		    	  ll.common.ajaxForm({
		    		  obj:$("#bind_submit"),
		    		  url: Context.base + "/bindcardind/bank_card_add_submit.htm",
		    		  data:$("#bankCardAddInfoForm").serialize()+"&cityId="+cityId,
		    		  success:function(result) {
		    			  if (result.errorCode == "000000") {
		    				  location.href = Context.base + "/bindcardind/bank_card_add_success.htm";
		    			  } else {
		    				  ll.common.tips('error',result.errorMessage,2000);
		    			  }
		    		  }
		    	  });
		      }
	},
    kycperson:{// 个人
            obj:$("#personal_submit"),
            list:[
                {obj:$("#name_"),parames:{type:"realName",byte:[3,32,"姓名长度不合法"],empty:"请输入您的姓名",error:"请输入正确的姓名"}},
                {obj:$("#cardno_"),parames:{type:"idCard",empty:"请输入您的身份证号码",error:"请输入正确的身份证号码",
									ext:function(obj){
										var reg=/\d{17}[a-z]/;
										var value = obj.val();
										if(value.length == 18 && reg.test(value)){
												$("#cardno_").val(value.replace("x","X"));
										}
										return {status:true};
									}
							}},
                {obj:$("#card_photo_z"),parames:{ext:function(){
      	    	  if($("#card_photo_f").val()==""){
  	                    return {status:false,msg:"请上传身份证反面图片"};
      	    	  }else{
  	                    return {status:true,msg:"验证通过"};
      	    	  }
      	      	},empty:"请上传身份证正面图片",place:$("#cardPhoto_tip")}}
            ],
            callback:function(){
            	if($("#id_begin_date").val()>=$("#id_end_date").val() || $("#id_end_date").val()<ll.common.getCurrentDate()){
					ll.common.tips('error',"身份证有效期填写有误",2000);
            		return;
            	}
				typeof(_paq)!="undefined" && _paq.push(['trackEvent','person_1','实名认证第一页点击下一步按钮']);
            	ll.common.ajaxForm({
            		obj:$("#personal_submit"),
            		url:"personalOne.htm",
            		data:$("#personal_form").serialize(),
            		success:function(dto){
					  if (dto.retcode=="000000") {
						  personal_two();
					  } else {
						  ll.common.tips('error', dto.retmsg,3000);
					  }
					}
				 });
            }
    },
    kycperson_update:{// 个人
    	obj:$("#personal_submit"),
    	list:[
    	      {obj:$("#card_photo_z"),parames:{ext:function(){
    	    	  if($("#card_photo_f").val()==""){
	                    return {status:false,msg:"请上传身份证反面图片"};
    	    	  }else{
	                    return {status:true,msg:"验证通过"};
    	    	  }
    	      },empty:"请上传身份证正面图片",place:$("#cardPhoto_tip")}}
    	      ],
    	      callback:function(){
    	    	  if($("#id_begin_date").val()>=$("#id_end_date").val() || $("#id_end_date").val()<ll.common.getCurrentDate()){
    	    		  ll.common.tips('error',"身份证有效期填写有误",2000);
    	    		  return;
    	    	  }
    	    	  ll.common.ajaxForm({
    	    		  obj:$("#personal_submit"),
    	    		  url:"personalUpdate.htm",
    	    		  data:$("#personal_form").serialize(),
    	    		  success:function(dto){
    	    			  if (dto.retcode=="000000") {
    	    				  personal_success();
    	    			  } else {
    	    				  ll.common.tips('error', dto.retmsg,3000);
    	    			  }
    	    		  }
    	    	  });
    	      }
    },
    kycperson2_new:{
    	obj:$("#personal_submit"),
    	list:[
    	      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
    	    //   {obj:$("#cnapsCode"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
    	      {obj:$("#bankNum"),parames:{type:"bankCard",empty:"请输入银行卡号",error:"请输入正确的银行卡号"}}
    	      ],
    	      callback:function(){
				  typeof(_paq)!="undefined" && _paq.push(['trackEvent','person_2','实名认证银行卡认证页面点击下一步按钮']);
    	    	  ll.common.ajaxForm({
                		obj:$("#personal_submit"),
                		url:"personal_check_bankCard.htm",
                		data:$("#personal_form").serialize(),
                		success:function(dto){
    					  if (dto.retcode=="000000") {
    						  personal_confirm();
    					  } else {
    						  ll.common.tips('error', dto.retmsg,3000);
    					  }
    					}
    				 });
    	    	  //personal_confirm();
    	      }
    },
    // 企业
    kycCompany1:{
        obj:$("#kyc_submit"),
        list:[],
        callback:function(){
			typeof(_paq)!="undefined" && _paq.push(['trackEvent','business_2','企业资料收集页点击下一步按钮']);
        	business_two();
        }
    },
    kycCompany2:{
            obj:$("#kyc_submit"),
            list:[
                {obj:$("#name_"),parames:{type:"realName",byte:[3,32,"法人代表姓名长度不合法"],empty:"请输入法人代表姓名",error:"请输入正确的法人代表姓名"}},
                {obj:$("#cardno_"),parames:{type:"idCard",empty:"请输入法人身份证号码",error:"法人身份证号码有误",
									ext:function(obj){
									  var reg=/\d{17}[a-z]/;
									  var value = obj.val();
									  if(value.length == 18 && reg.test(value)){
									      $("#cardno_").val(value.replace("x","X"));
									  }
									  return {status:true};
									}
								}},
                {obj:$("#card_photo_z"),parames:{ext:function(){
      	    	  if($("#card_photo_f").val()==""){
  	                    return {status:false,msg:"请上传身份证反面图片"};
      	    	  }else{
  	                    return {status:true,msg:"验证通过"};
      	    	  }
      	      	},empty:"请上传身份证正面图片",place:$("#cardPhoto_tip")}}
            ],
            /**
            callback:function(){
            	if($("#id_begin_date").val()>=$("#id_end_date").val() || $("#id_end_date").val()<ll.common.getCurrentDate()){
					ll.common.tips('error',"身份证有效期填写有误",2000);
            		return;
            	}
            	business_three();
            }*/
		    callback:function(){
				typeof(_paq)!="undefined" && _paq.push(['trackEvent','business_3','法人信息填写页点击下一步按钮']);
		    	ll.common.ajaxForm({
		    		obj:$("#kyc_submit"),
		    		url:"business_insert.htm",
		    		data:$("#business_form").serialize(),
		    		success:function(dto){
					  if (dto.retcode=="000000") {
						  business_four();
					  } else {
						  ll.common.tips('error', dto.retmsg,3000);
					  }
					}
				 });
		    }
    },
    kycCompany3:{
            obj:$("#kyc_submit"),
            list:[
                {obj:$("#card_photo1"),parames:{empty:"请上传营业执照"}},
                {obj:$("#card_photo2"),parames:{empty:"请上传税务登记证"}},
                {obj:$("#card_photo3"),parames:{empty:"请上传开户许可证"}},
                {obj:$("#card_photo4"),parames:{empty:"请上传组织机构代码证"}}
            ],
            callback:function(){
            	ll.common.ajaxForm({
            		obj:$("#kyc_submit"),
            		url:"business_insert.htm",
            		data:$("#business_form").serialize(),
            		success:function(dto){
					  if (dto.retcode=="000000") {
						  business_four();
					  } else {
						  ll.common.tips('error', dto.retmsg,3000);
					  }
					}
				 });
            }
    },
    kycCompany4:{
    // 	obj:$("#kyc_submit"),
    // 	list:[
    // 	      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
    // 	      {obj:$("#city"),parames:{error:"请选择银行所在地",place:$("#city_tip")}},
    // 	      {obj:$("#bank_name"),parames:{type:"CN",byte:[3,64,"开户支行名称长度不合法"],empty:"请输入开户支行名称",error:"请输入开户支行名称"}},
	// 	      {obj:$("#cnapsCode"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
    // 	      {obj:$("#bankNum"),parames:{type:"bankCardCompany",empty:"请输入银行卡号",error:"请输入正确的银行卡号"}},
    // 	      {obj:$("#bankNum2"),parames:{type:"bankCardCompany",ext:function(obj){
	//                 if(obj.val()==$("#bankNum").val()){
	//                     return {status:true,msg:"验证通过"};
	//                 }else{
	//                     return {status:false,msg:"两次卡号输入不一致"};
	//                 }
	//             },empty:"请再次输入银行卡号",error:"请再次输入银行卡号"}}
	//       ],
	//       callback:function(){
	//     	  business_confirm();
	//       }
    },
    kycCompany4_new:{
    	obj:$("#kyc_submit"),
    	list:[
    	      {obj:$("#bank_"),parames:{error:"请选择开户银行",place:$("#bank_tip")}},
    	      {obj:$("#cnapsCode"),parames:{type:"Number",byte:[12,12],empty:"请输入大额行号",error:"请输入正确的大额行号"}},
    	      {obj:$("#bankNum"),parames:{type:"bankCardCompany",empty:"请输入银行账户",error:"请输入正确的银行账户"}}
    	      ],
    	      callback:function(){
				  typeof(_paq)!="undefined" && _paq.push(['trackEvent','business_4','对公银行账户页点击下一步按钮']);
    	    	  business_confirm();
    	      }
    },
	bindaccount:{
        obj:$("#account_submit"),
        list:[
              {obj:$("#mccCode"),parames:{error:"请选择经营范围",place:$("#mccCode_tip")}},
              //{obj:$("#mccAnnualIncome"),parames:{type:"Price",empty:"请输入月收入额度",error:"请输入正确的金额",place:$("#mccAnnualIncome_tip")}},
              //{obj:$("#mccLink"),parames:{type:"unNull",reg:/(http(s)?:\/\/)?[a-z0-9_\-\/.%]+\.[a-z0-9_\-\/.%&=]/i,empty:"请添写经营链接/网址", error:"请输入正确网址",place:$("#mccLink_tip")}}
        ],
        callback:function(){
        	if($("#mccLink").val()!=''){
        		if(!$("#mccLink").val().match(/(http(s)?:\/\/)?[a-z0-9_\-\/.%]+\.[a-z0-9_\-\/.%&=]/i)){
        			ll.common.tips("error","请输入正确的网址",1000);
        			return false;
        		}

        	}
			typeof(_paq)!="undefined" && _paq.push(['trackEvent','bind_paypal','关联界面点击下一步按钮']);
        	var con="<div class='pd'><i class='info-icon icons icons-load'></i><p class='info-text' style='font-size:12px;line-height:20px;'>您即将前往PayPal授权页面完成账户关联，页面加载需要片刻，请耐心等待。<br>关联过程中，您需要在PayPal账户授权页输入您的PayPal账户名和密码，连连支付不会以任何名义记录您的PayPal密码。</p>" +
        			"<ul class='c3' style='font-size:12px; line-height:26px; text-align:left; margin:20px;border:1px solid #ececee;background:#f7fcff;padding: 10px 20px;color: #797979;'><li class='c2'>如您在关联过程中无法成功：请按照以下方法完成关联：</li><li>1、请使用IE10.0及以上版本、谷歌或火狐浏览器进行关联。</li><li>2、PayPal授权页未弹出，可能是您的浏览器被拦截，请在浏览器地址栏设置允许弹窗。</li><li>3、最后一步请点击“关闭并继续”按钮，等待关联成功。</li></ul>"+
        			"</div>"
			ll.dialog.simple({title:'提示信息',content:con,width:636,lock:true});
        	ll.common.ajaxForm({
        		obj:$("#account_submit"),
				url:"request_paypal.htm",
				data:$("#bind_account_form").serialize(),
				success:function(dto){
					if (dto.errorCode=='000000') {
						var url = dto.url + "&locale.x=zh_XC";
						//var url = dto.url + "&locale.x=en_US";
						window.open(url,'newwindow','height=600,width=500,top=40,left=410,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
					} else {
						ll.common.tips('error', dto.errorMessage,3000);
					}
				}
			});
        }
    },
    unbindVerify:{
    	obj:$("#unbind_submit"),
    	list:[
    	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
    	      ],
    	      callback:function(){
    	    	  	// 校验短信验证码
    	          	ll.common.ajaxForm({
    	          		obj:$("#unbind_submit"),
    	      	        url: Context.base + "/account/unbindVerifySMS.htm",
    	      	        data:{smsCode:$("#smsCode").val(),handleCode:$("#handleCode").val()},
    	          	    success:function(result) {
    	          	    	if (result.retcode == "0000") {
    	          	    		unbind_confirm();
    	          	    	} else {
    	          	    		ll.common.tips('error',result.retmsg,2000);
    	          	    	}
    	          	    }
    	          	});
    	      }
    },
    changePassword:{
    	obj:$("#change_submit"),
    	list:[
   	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
    	],
    	callback:function(){
    		//调用ajax验证短信
    		ll.common.ajaxForm({
    				obj:$("#change_submit"),
    	  	        url: Context.base + "/account/modifyPasswordSendMsgCommit.htm",
    	  	      	data:$("#searchForm").serialize(),
    	      	    success:function(result) {
    	      	    	if (result.retcode == "0000") {
    	      	    		location.href = Context.base + "/account/verfiySmsCodeSuccess.htm?step=step1ModifyPassword&sign="+result.retmsg;
    	      	    	} else {
    	      	    		ll.common.tips('error',result.retmsg,3000);
    	      	    	}
    	      	    }
    	      	});
    	}
    },
    changePassword2:{
    	obj:$("#change_submit"),
    	list:[
    	      {obj : $("#newPassword"),parames : {type:"passWordStrong",byte : [ 6, 32, "长度必须在6~32位" ],tips:"<div class='pwd-tip'><div>请设置您的登录密码，区分大小写</div><div><b id='pwd-tj1' class='input-ont'></b>6-32位</div><div><b id='pwd-tj2' class='input-ont'></b>字母，数字及符号的组合</div><div id='pwd-ds' class='hide mt'><b class='input-ont icons icons-s-info'></b>大写锁定已打开</div></div>",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}},
    	      {obj : $("#newPasswordAgain"),parames : {type:"passWordStrong",ext : function(obj) {if(obj.val() == $("#newPassword").val()){return {status:true,msg:"验证通过"}}else{return {status:false,msg:"两次密码输入不一致"}}},byte : [ 6, 32, "长度必须在6~32位" ],tips:"字母、数字及符号的组合，6-32位，区分大小写",empty : "请输入密码",error : "密码必须同时包含字母、数字及符号"}}
    	],
    	callback:function(){
    		//调用ajax验证短信
    		ll.common.ajaxForm({
    			obj:$("#change_submit"),
    	  	    url: Context.base + "/account/modifyPasswordCommit.htm",
    	  	    data:$("#searchForm").serialize(),
    	      	success:function(result) {
    	      		if (result.retcode == "0000") {
    	      	    		location.href = Context.base + "/account/verfiySmsCodeSuccess.htm?step=step2ModifyPassword";
    	      	    }else{
    	      	    		ll.common.tips('error',result.retmsg,3000);
    	      	    }
    	      	}
    	    });
    	}
    },
    changePhone1:{
    	obj:$("#change_submit"),
    	list:[
   	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
    	],
    	callback:function(){
    		//调用ajax验证短信
    		ll.common.ajaxForm({
    			obj:$("#change_submit"),
      	        url: Context.base + "/account/modifyPhoneMsgCommit.htm",
      	      	data:$("#searchForm").serialize(),
          	    success:function(result) {
          	    	if (result.retcode == "0000") {
          	    		 location.href = Context.base + "/account/verfiySmsCodeSuccess.htm?step=step1ModifyPhone&sign="+result.retmsg;
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,3000);
          	    	}
          	    }
          	});
    	}
    },
    changePhone2:{
    	obj:$("#change_submit"),
    	list:[
       	      {obj:$("#phone"),parames:{type:"Mobile",empty:"请输入手机号码",error:"请输入正确的手机号码"}},
       	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
        	],
        callback:function(){
        	//调用ajax验证短信
        	ll.common.ajaxForm({
        		obj:$("#change_submit"),
          	    url: Context.base + "/account/modifyPhoneMsgCommit.htm",
          	    data:$("#searchForm").serialize(),
              	success:function(result){
              		if (result.retcode == "0000") {
              			location.href = Context.base + "/account/verfiySmsCodeSuccess.htm?step=step2ModifyPhone";
              	    } else {
              	    	ll.common.tips('error',result.retmsg,3000);
              	    }
              	}
            });
        }
    },
    changePhone3:{
    	obj:$("#change_submit"),
    	list:[
   	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
    	],
    	callback:function(){
    		//调用ajax验证短信
    		ll.common.ajaxForm({
    			obj:$("#change_submit"),
      	        url: Context.base + "/account/modifyPhoneMsgCommitByEmail.htm",
      	      	data:$("#searchForm").serialize(),
          	    success:function(result) {
          	    	if (result.retcode == "0000") {
          	    		 location.href = Context.base + "/account/verfiySmsCodeSuccessByemail.htm?step=step1ModifyPhone&sign="+result.retmsg;
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,3000);
          	    	}
          	    }
          	});
    	}
    },
    changePhone4:{
    	obj:$("#change_submit"),
    	list:[
       	      {obj:$("#phone"),parames:{type:"Mobile",empty:"请输入手机号码",error:"请输入正确的手机号码"}},
       	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
        	],
        callback:function(){
        	//调用ajax验证短信
        	ll.common.ajaxForm({
        		obj:$("#change_submit"),
          	    url: Context.base + "/account/modifyPhoneMsgCommitByEmail.htm",
          	    data:$("#searchForm").serialize(),
              	success:function(result){
              		if (result.retcode == "0000") {
              			location.href = Context.base + "/account/verfiySmsCodeSuccessByemail.htm?step=step2ModifyPhone";
              	    } else {
              	    	ll.common.tips('error',result.retmsg,3000);
              	    }
              	}
            });
        }
    },
    verifyInformationSwitchType:{
    	obj:$("#change_submit"),
    	list:[
   	      {obj:$("#smsCode"),parames:{type:"verCode",empty:"请输入验证码",error:"请输入正确的验证码",place:$("#msgcode_tip")}}
    	],
    	callback:function(){
    		//调用ajax验证短信
    		ll.common.ajaxForm({
    			obj:$("#change_submit"),
      	        url: Context.base + "/account/verifyInformationSwitchTypeCommit.htm",
      	      	data:$("#searchForm").serialize(),
          	    success:function(result) {
          	    	if (result.retcode == "0000") {
          	    		 location.href = Context.base + "/account/verifyInformationSwitchTypeSuccess.htm?userType="+result.retmsg;
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,3000);
          	    	}
          	    }
          	});
    	}
    },
};
app={
    auth:function(){
		var index = isPerson ? 0:1,
			personExpiredDom = $("#j-personExpired"),
			businessExpiredDom = $("#j-businessExpired");
		ll.common.tab($(".rz-hd>ul>li"),$(".rz-bd>div"),index,null);
		if (!!personRemaidExpiredDays && personRemaidExpiredDays<=60) {
			personExpiredDom.show();
		}
		if (!!businessRemaidExpiredDays && businessRemaidExpiredDays<=60) {
			businessExpiredDom.show();
		}
	},
    kycperson:function(){//实名认证
        ll.validate.submit(validate.data.kycperson);

		var name$ = $('#name_');
		var cardno$ = $('#cardno_');
        // 日期
        var bdate$=$("#id_begin_date");
    	var edate$=$("#id_end_date");
        var bdate=bdate$.val();
    	var edate=edate$.val();
        var d=new Date();
        var begin_day=(d.getFullYear()-20)+"-"+((d.getMonth()+1)>=10?(d.getMonth()+1):"0"+(d.getMonth()+1))+"-"+(d.getDate()>=10?d.getDate():"0"+d.getDate());
		var end_day=d.getFullYear()+"-"+((d.getMonth()+1)>=10?(d.getMonth()+1):"0"+(d.getMonth()+1))+"-"+(d.getDate()>=10?d.getDate():"0"+d.getDate());
		var noDateCheckInput=$(".x-checkbox").is("div")?$(".x-checkbox").children("input") : $(".x-checkbox"),
			allDate$ = $("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day");

        ll.common.date("begin_date_year","begin_date_month","begin_date_day",begin_day);
        ll.common.date("end_date_year","end_date_month","end_date_day",end_day);

        bdate$.val(begin_day);
		edate$.val(end_day);


		function handleValidity(bdate,edate){
			if(bdate!="" && edate!=""){
					
				if(bdate=="2000-01-01" && edate=="3000-01-01"){
					setTimeout(function(){
						allDate$.prop("disabled",true);
						noDateCheckInput.prop("checked",true);
						bdate$.val("2000-01-01");
						edate$.val("3000-01-01");
						ll.common.MformBeauty(allDate$);
					});
				}else{
					setTimeout(function(){
						$("#begin_date_year").val(bdate.split("-")[0]);
						$("#begin_date_month").val(bdate.split("-")[1]);
						$("#begin_date_day").val(bdate.split("-")[2]);
						$("#end_date_year").val(edate.split("-")[0]);
						$("#end_date_month").val(edate.split("-")[1]);
						$("#end_date_day").val(edate.split("-")[2]);
						bdate$.val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
						edate$.val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
						ll.common.MformBeauty(allDate$);
						noDateCheckInput.prop("checked",false);
						allDate$.prop("disabled",false);
					});
				}
			}
		}

		handleValidity(bdate,edate);

        $("#begin_date_year,#begin_date_month,#begin_date_day").change(function(){
            bdate$.val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
        });
        $("#end_date_year,#end_date_month,#end_date_day").change(function(){
            edate$.val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
        });

        //勾选长期
		$("body").on("click",".x-checkbox",function(){
			var obj=$(this).is("div")?$(this).children("input") : $(this);
			if(obj.is(":checked")){
				$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",true);
				$("#id_begin_date").val("2000-01-01");
				$("#id_end_date").val("3000-01-01");
			}else{
				$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",false);
				$("#id_begin_date").val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
				$("#id_end_date").val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
			}
			ll.common.MformBeauty($("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day"));
		});


        $(".img-prev").on("click",".imgs>p>a",function(){
			var prev=$(this).parents(".imgs");
			var input=$(this).parents(".img-prev").attr("id").replace("_prev","");
			prev.siblings(".upload-pop").removeClass("hide");
			prev.remove();
			$("#"+input).val("");
		});

        // 返回时回显图片
        if($("#card_photo_z").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo_z").val();
        	$("#card_photo_z_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo_z_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo_f").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo_f").val();
        	$("#card_photo_f_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo_f_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
		}
		ll.common.picCenter($(".imgs"));
		//OCR回调有效期-反面
		function handleORCValidity(data){
			var dateArr = data.validity.split('-'),
				dateReg = /\d{4}-\d{2}-\d{2}/;

			for (var i = 0; i < dateArr.length; i++) {
				dateArr[i] = dateArr[i].replace(/\./g,'-');
			}

			if ( dateArr.length !== 2 ) return;
			if (!dateReg.test(dateArr[0])) return;
			if (!dateReg.test(dateArr[1]) && dateArr[1] !== '长期') return;

			if (dateArr[1] === '长期') {
				bdate = '2000-01-01';
				edate = "3000-01-01";
			}else {
				bdate = dateArr[0];
				edate = dateArr[1];
			}

			handleValidity(bdate,edate);
		}
		//OCR回调身份信息-正面
		function handleORCNumber(data){
			data.id_number+='';
			if(!ll.common.checkIdcard(data.id_number.replace(/\s+/g,"").replace("x","X")).status) {
				return;
			}
			name$.val(data.name);
			cardno$.val(data.id_number);
		}
		function handleORC(url){
			$.ajax({
      	        url: Context.base + "/account/getIDImgByOcr.htm?random="+Math.random(),
				data:{"imgPath":url},
				dataType : "json",
          	    success:function(result) {
          	    	if (result.retCode == "000000") {
          	    		if (result.validity) {
							handleORCValidity(result);
						} else if (result.id_number) {
							handleORCNumber(result);
						}
          	    	} 
          	    }
          	});
		}
		window.backfn=function(id,url,name){
			//ORC
			handleORC(name);
			$("#"+id).val(name);
			$("#"+id+"_prev").find(".upload-pop").addClass("hide");
			$("#"+id+"_prev").find(".imgloading").remove();
			$("#"+id+"_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
			// 居中显示图片，特殊处理
			ll.common.picCenter($(".imgs"));
		};
		window.showloading=function(id){
			$("#"+id+"_prev").append("<div class='imgloading'><i></i></div>");
		};

			//介绍视频
			clickToShowVideoDialog($("#video-dialog-btn"));
    },
    kycperson_update:function(){//实名认证
    	ll.validate.submit(validate.data.kycperson_update);

    	// 日期
    	var bdate=$("#id_begin_date").val();
    	var edate=$("#id_end_date").val();
    	var d=new Date();
    	var begin_day=(d.getFullYear()-20)+"-"+((d.getMonth()+1)>=10?(d.getMonth()+1):"0"+(d.getMonth()+1))+"-"+(d.getDate()>=10?d.getDate():"0"+d.getDate());
    	var end_day=d.getFullYear()+"-"+((d.getMonth()+1)>=10?(d.getMonth()+1):"0"+(d.getMonth()+1))+"-"+(d.getDate()>=10?d.getDate():"0"+d.getDate())

    	ll.common.date("begin_date_year","begin_date_month","begin_date_day",begin_day);
    	ll.common.date("end_date_year","end_date_month","end_date_day",end_day);
    	var bdate=$("#id_begin_date").val();
    	var edate=$("#id_end_date").val();
    	$("#id_begin_date").val(begin_day);
    	$("#id_end_date").val(end_day);
    	if(bdate!="" && edate!=""){
    		if(bdate=="2000-01-01" && edate=="3000-01-01"){
    			setTimeout(function(){
    				var obj=$(".x-checkbox").is("div")?$(".x-checkbox").children("input") : $(".x-checkbox");
    				obj.prop("checked",true);
    				$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",true);
    				$("#id_begin_date").val("2000-01-01");
    				$("#id_end_date").val("3000-01-01");
    				ll.common.MformBeauty($("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day"));
    			});
    		}else{
    			setTimeout(function(){
    				$("#begin_date_year>option[value='"+bdate.split("-")[0]+"']").prop("selected",true);
    				$("#begin_date_month>option[value='"+bdate.split("-")[1]+"']").prop("selected",true);
    				$("#begin_date_day>option[value='"+bdate.split("-")[2]+"']").prop("selected",true);
    				$("#end_date_year>option[value='"+edate.split("-")[0]+"']").prop("selected",true);
    				$("#end_date_month>option[value='"+edate.split("-")[1]+"']").prop("selected",true);
    				$("#end_date_day>option[value='"+edate.split("-")[2]+"']").prop("selected",true);
    				$("#id_begin_date").val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
    				$("#id_end_date").val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
    				ll.common.MformBeauty($("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day"));
    			});
    		}
    	}


    	$("#begin_date_year,#begin_date_month,#begin_date_day").change(function(){
    		$("#id_begin_date").val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
    	});
    	$("#end_date_year,#end_date_month,#end_date_day").change(function(){
    		$("#id_end_date").val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
    	});

    	//勾选长期
    	$("body").on("click",".x-checkbox",function(){
    		var obj=$(this).is("div")?$(this).children("input") : $(this);
    		if(obj.is(":checked")){
    			$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",true);
    			$("#id_begin_date").val("2000-01-01");
    			$("#id_end_date").val("3000-01-01");
    		}else{
    			$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",false);
    			$("#id_begin_date").val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
    			$("#id_end_date").val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
    		}
    		ll.common.MformBeauty($("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day"));
    	});


    	$(".img-prev").on("click",".imgs>p>a",function(){
    		var prev=$(this).parents(".imgs");
    		var input=$(this).parents(".img-prev").attr("id").replace("_prev","");
    		prev.siblings(".upload-pop").removeClass("hide");
    		prev.remove();
    		$("#"+input).val("");
    	});

    	// 返回时回显图片
    	if($("#card_photo_z").val()!=""){
    		var url = Context.base + "/upload/watermark_" + $("#card_photo_z").val();
    		$("#card_photo_z_prev").find(".upload-pop").addClass("hide");
    		$("#card_photo_z_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
    	}
    	if($("#card_photo_f").val()!=""){
    		var url = Context.base + "/upload/watermark_" + $("#card_photo_f").val();
    		$("#card_photo_f_prev").find(".upload-pop").addClass("hide");
    		$("#card_photo_f_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
    	}

    	window.backfn=function(id,url,name){
    		$("#"+id).val(name);
    		$("#"+id+"_prev").find(".upload-pop").addClass("hide");
    		$("#"+id+"_prev").find(".imgloading").remove();
    		$("#"+id+"_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
    		// 居中显示图片，特殊处理
			ll.common.picCenter($(".imgs"));
    	};
    	window.showloading=function(id){
    		$("#"+id+"_prev").append("<div class='imgloading'><i></i></div>");
    	};
    },
    kycperson2_new:function(){
		ll.validate.submit(validate.data.kycperson2_new);
		//个人银行卡取消大额行号填写
    	// if($("#bank_").val()=="15947916"){
		// 	$("#bindcardlist>li[data-type='da']").removeClass("hide");
		// }
		// $("#bank_").change(function(){
		// 	var v=$(this).val();
		// 	if(v=="15947916"){
		// 		$("#bindcardlist>li[data-type='da']").removeClass("hide");
		// 	}else{
		// 		$("#cnapsCode").val("");
		// 		$("#bindcardlist>li[data-type='da']").addClass("hide");
		// 	}
		// });

		//卡Bin
		var bankNum$ = $("#bankNum"),
			bankLogo$ = $("#bankLogo"),
			bankType$ = $("#bank_"),
			bankTypeP$ = $("#bindcardlist>li[data-type='bankList']");
		function handleCardType(data) {
			if (data.retCode === "000000") {
				var imageUrl = "url("+Context.base+"/images/kyc/bankLogo/"+data.bankCode+".png)";
				if (data.showLogo === '1') {
					bankLogo$.css("background-image",imageUrl);
					bankLogo$.removeClass("hide");
				}else{
					bankLogo$.addClass("hide");
				}
				bankType$.val(data.bankCode);
				bankTypeP$.addClass("hide");
			} else if (data.retCode === "999997") {
				ll.common.tips('error', data.retMsg,2000);
				bankLogo$.addClass("hide");
				bankTypeP$.addClass("hide");
			} else {
				bankLogo$.addClass("hide");
				bankTypeP$.removeClass("hide");
			}
		}

		function postBin(cardNo) {
			if (cardVerify(cardNo)) {
				$.ajax({
					url: Context.base + "/account/getBankInfoByCardBin.htm",
					data:{"cardNo":cardNo},
					dataType : "json",
					success:handleCardType
				});
			} else{
				bankLogo$.addClass("hide");
			}
		}

		function cardVerify(value) {
			return ll.validate.reg.bankCard.test(value);
		}

		
		//ie9样式兼容
		if (window.navigator.appName == "Microsoft Internet Explorer" && (!document.documentMode || document.documentMode < 10)) {
			bankNum$.on("input blur",function(e){
				var value = $.trim(e.target.value);
				postBin(value);
			});
			bankNum$.on("focus", function(){
				bankLogo$.addClass("hide");
			})
		}else {
			bankNum$.on("input",function(e){
				var value = $.trim(e.target.value);
				postBin(value);
			});
		}

		if (bankNum$.val().trim().length >= 15) {
			postBin(bankNum$.val().trim());
		}
		//介绍视频
		clickToShowVideoDialog($("#video-dialog-btn"));
    },
	kycpersonComplete:function(){
		// 居中显示图片，特殊处理
		ll.common.picCenter($(".imgs"));

		function postPersonalKyc (buttonId) {
			ll.common.ajaxForm({
				obj:$("#"+buttonId),
				url:"personalConfirm.htm",
				data:$("#personal_form").serialize(),
				success:function(data){
					// if (data.retcode == "999999") {
					// 	var con=['<div class="pd">',
					// 			 '<i class="icons icons-m-info"></i><p class="info-text">实名信息已存在，是否直接关联？</p>',
					// 			 '</div>'].join("");
					// 	ll.dialog.confirm({title:'提示',content:con,width:600,lock:true,ok:function(){
					// 		ll.common.ajaxForm({
					// 			url:"personalUser.htm",
					// 			data:$("#personal_form").serialize(),
					// 			success:function(data){
					// 				typeof(_paq)!="undefined" && _paq.push(['trackEvent','kyc_bind_again']);
					// 				if (data.retcode == '000000') {
					// 					personal_success();
					// 				} else {
					// 					ll.common.tips('error', data.retmsg,2000);
					// 				}
					// 			}
					// 		});
					// 	}});
					// } else 
					if (data.retcode == "000000") {
						personal_success();
					} else {
						ll.common.tips('error', data.retmsg,2000);
					}
				}
			});
		}
		//
		$("#personal_submit").on("click",function(){
			typeof(_paq)!="undefined" && _paq.push(['trackEvent','person_submit','提交预览页点击确认提交按钮']);
			//PP名字校验
			ll.common.ajaxForm({
				obj:$("#personal_submit"),
				url:Context.base + '/account/compareNameWithPP.htm',
				data:{ "kycType":"C"},
				success:function(data){
					if (data.retCode === "000001") {
						typeof(_paq)!="undefined" && _paq.push(['trackEvent','Person_kyc confirm','实名认证预览提交界面不一致弹窗弹出率']);

						var con="<div class='pd'><img src="+Context.base+"/images/kyc/PPName/person.jpg"+" /><p class='info-text'>您的实名认证姓名与PayPal账户持有人名称不一致，将会影响您后续提现。您可重新填写您的实名认证信息或者前往PayPal修改您的账户持有人名称(<a  href='"+Context.base+"/register/question.htm?index=4' target='_blank'>查看匹配规则</a>)。</p></div><div class='setting-form'><div class='action-bar text-c'><a id='backToOne' class='button mr30' href='javascript:;'>修改实名认证信息</a><a id='dialogsubmit' class='button button-light' href='javascript:;'>确认提交</a></div></div>"
						ll.dialog.simple({title:'温馨提示',clazz:"comparePPNameDialog",content :con,width : 760,lock : true,load:function(o){
							var backToOneBtn = $("#backToOne"),
								dialogsubmitBtn = $("#dialogsubmit");
								backToOneBtn.click(function(){
									typeof(_paq)!="undefined" && _paq.push(['trackEvent','Person_kyc modify','实名认证预览提交界面弹窗修改实名认证按钮']);
									personal_one();
								});
								dialogsubmitBtn.click(function(){
									typeof(_paq)!="undefined" && _paq.push(['trackEvent','Person_kyc submit','实名认证预览提交界面弹窗确认提交按钮']);
									postPersonalKyc("dialogsubmit");
								});
						},
						destroyFunc:function(){
							typeof(_paq)!="undefined" && _paq.push(['trackEvent','Person_kyc close','实名认证预览提交界面点击关闭弹窗按钮']);
						}});;
					} else {
						postPersonalKyc("personal_submit");
					}
				}
			});
		});
	},
    kycCompany1:function(){//企业实名认证1
		//多证合一营业执照
		var combileRuleList = [
			{obj:$("#companyName_"),parames:{byte:[3,64,"企业名称长度不合法"],empty:"请输入企业名称",error:"请输入正确的企业名称"}},
			{obj:$("#j-businessLicense"),parames:{byte:[18,18,"营业执照号长度不合法"],empty:"请输入营业执照号",error:"请输入正确的营业执照号"}},
			{obj: $("#j-blve"),parames : {ext : function(obj) {if(!$("#j-blveLongip").prop("checked") && obj.val()===""){return {status:false,msg:"请输入营业执照有效期"}}else if(!$("#j-blveLongip").prop("checked")){$("#j-blveHidden").val(obj.val());return {status:true}}else{return {status:true}}}}},
			{obj:$("#card_photo1"),parames:{empty:"请上传营业执照照片"}},
			{obj:$("#province"),parames:{error:"请选择省市",place:$("#city_tip")}},
			{obj:$("#companyAddress_"),parames:{byte:[6,128,"企业地址长度不合法"],empty:"请输入企业地址",error:"请输入正确的企业地址"}}
		];
		//普通营业执照
		var seperateRuleList = [
			{obj:$("#companyName_"),parames:{byte:[3,64,"企业名称长度不合法"],empty:"请输入企业名称",error:"请输入正确的企业名称"}},
			{obj:$("#j-businessLicense"),parames:{empty:"请输入营业执照号",error:"请输入正确的营业执照号"}},
			{obj: $("#j-blve"),parames : {ext : function(obj) {if(!$("#j-blveLongip").prop("checked") && obj.val()===""){return {status:false,msg:"请输入营业执照有效期"}}else if(!$("#j-blveLongip").prop("checked")){$("#j-blveHidden").val(obj.val());return {status:true}}else{return {status:true}}}}},
			{obj:$("#card_photo1"),parames:{empty:"请上传营业执照照片"}},
			{obj:$("#companyCode_"),parames:{reg:/^([A-Za-z0-9]{9}|[A-Za-z0-9]{18})$/,type:"enNumber",empty:"请输入组织机构代码",error:"请输入9位组织机构代码或者18位统一社会信用代码"}},
			{obj: $("#j-ocve"),parames : {ext : function(obj) {if(!$("#j-ocveLongip").prop("checked") && obj.val()===""){return {status:false,msg:"请输入组织机构代码有效期"}}else if(!$("#j-ocveLongip").prop("checked")){$("#j-ocveHidden").val(obj.val());return {status:true}}else{return {status:true}}}}},
			{obj:$("#card_photo4"),parames:{empty:"请上传组织机构代码证"}},
			{obj:$("#companyTax_"),parames:{type:"enNumber",byte:[1,32,"税务登记证号码长度不合法"],empty:"请输入税务登记证号码",error:"请输入正确的税务登记证号码"}},
			{obj:$("#card_photo2"),parames:{empty:"请上传税务登记证"}},
			{obj:$("#j-bankCode"),parames:{type:"enNumber",byte:[1,40,"银行开户许可证号码长度不合法"],empty:"请输入银行开户许可证",error:"请输入正确的银行开户许可证"}},
			{obj:$("#card_photo3"),parames:{empty:"请上传开户许可证"}},
			{obj:$("#province"),parames:{error:"请选择省市",place:$("#city_tip")}},
			{obj:$("#companyAddress_"),parames:{byte:[6,128,"企业地址长度不合法"],empty:"请输入企业地址",error:"请输入正确的企业地址"}}
		];
		//更新----------多证合一营业执照
		var updateCombileRuleList = [
			{obj: $("#j-blve"),parames : {ext : function(obj) {if(!$("#j-blveLongip").prop("checked") && obj.val()===""){return {status:false,msg:"请输入营业执照有效期"}}else if(!$("#j-blveLongip").prop("checked")){$("#j-blveHidden").val(obj.val());return {status:true}}else{return {status:true}}}}},
			{obj:$("#card_photo1"),parames:{empty:"请上传营业执照照片"}}
		];
		//更新----------普通营业执照
		var updateSeperateRuleList = [
			{obj: $("#j-blve"),parames : {ext : function(obj) {if(!$("#j-blveLongip").prop("checked") && obj.val()===""){return {status:false,msg:"请输入营业执照有效期"}}else if(!$("#j-blveLongip").prop("checked")){$("#j-blveHidden").val(obj.val());return {status:true}}else{return {status:true}}}}},
			{obj:$("#card_photo1"),parames:{empty:"请上传营业执照照片"}},
			{obj: $("#j-ocve"),parames : {ext : function(obj) {if(!$("#j-ocveLongip").prop("checked") && obj.val()===""){return {status:false,msg:"请输入组织机构代码有效期"}}else if(!$("#j-ocveLongip").prop("checked")){$("#j-ocveHidden").val(obj.val());return {status:true}}else{return {status:true}}}}},
			{obj:$("#card_photo4"),parames:{empty:"请上传组织机构代码证"}},
			{obj:$("#card_photo2"),parames:{empty:"请上传税务登记证"}},
			{obj:$("#card_photo3"),parames:{empty:"请上传开户许可证"}}
		];
		ll.common.city("province","city");

		var certiTypes = $(".j-certiType"),
			certiTypeHidden = $("#j-certiTypeHidden"),
			businessLicense = $("#j-businessLicense"),
			defaultType = certiTypeHidden.val(),
			blveInput = $("#j-blve"),//营业执照有效期
			blveInputHidden = $("#j-blveHidden"),
			blveLong = $("#j-blveLong"),
			blveLongInput = $("#j-blveLongip"),
			ocveInput = $("#j-ocve"),//组织机构代码有效期
			ocveInputHidden = $("#j-ocveHidden"),
			ocveLong = $("#j-ocveLong"),
			ocveLongInput = $("#j-ocveLongip"),
			LIs = $("#j-formCtn li"),
			blTip = $("#j-blTip");//营业执照号tip

		var CONST = {
			"combile":{
				"blTip":"请输入18位统一社会信用代码，只支持英文和数字，不支持其他字符，如有，请去除。"
			},
			"seperate":{
				"blTip":"请输入营业执照号码或者18位统一社会信用代码，<br>只支持英文和数字，不支持其他字符，如有，请去除。"
			}
		};
		//企业证照类型
		certiTypes.click(function(e){
			var i = 0,
				combileType;

			certiTypes.removeClass("active");
			$(e.target).addClass("active");

			if ($(e.target).data("type") === "combile") {
				combileType = "combile";
				validate.data.kycCompany1.list = combileRuleList;
				certiTypeHidden.val(1);
				//更新模式----
				//普通模式转多证合一模式允许更新营业执照号
				if (!CERTITYPE_CHANGEABEL && CERTITYPE_TYPE === "0") {
					businessLicense.prop("disabled",false);
				}
				if (!CERTITYPE_CHANGEABEL) {
					//增加营业执照号校验规则
					var lisenseRule = {obj:$("#j-businessLicense"),parames:{byte:[18,18,"营业执照号长度不合法"],empty:"请输入营业执照号",error:"请输入正确的营业执照号"}};
					if (updateCombileRuleList[0].obj.attr("id") !== "j-businessLicense") {
						updateCombileRuleList.splice(0, 0, lisenseRule);  
					}
					validate.data.kycCompany1.list = updateCombileRuleList;
				}
				//更新模式--end--
			}else{
				combileType = "seperate";
				validate.data.kycCompany1.list = seperateRuleList;
				certiTypeHidden.val(0);
				//更新模式----
				//普通模式不允许更新营业执照号
				if (!CERTITYPE_CHANGEABEL && CERTITYPE_TYPE === "0") {
					businessLicense.prop("disabled",true);
				}
				if (!CERTITYPE_CHANGEABEL) {
					validate.data.kycCompany1.list = updateSeperateRuleList;
				}
				//更新模式--end--
			}
			//重新关联校验
        	ll.validate.update(validate.data.kycCompany1);
			//初始化营业执照号
			!!ORIGIN_BUSINESSLICENSE && businessLicense.val(ORIGIN_BUSINESSLICENSE);
			if (businessLicense.next(".x-tip")) {
				businessLicense.next(".x-tip").remove();
			}
			
			//营业执照号tip
			blTip.html(CONST[combileType].blTip);
			LIs.hide();
			while(i <= LIs.length){
				if (LIs.eq(i).hasClass($(e.target).data("type"))) {
					LIs.eq(i).show();
				}
				i++;
			};
			
		});
		var typeIndex = (defaultType === "0") ? 1 : 0;
		certiTypes.eq(typeIndex).click();
        ll.validate.submit(validate.data.kycCompany1);
		
		if (!CERTITYPE_CHANGEABEL && typeIndex === 0) {
			//更新模式下多证合一不能切换为普通
			certiTypes.off("click");
			businessLicense.prop("disabled",true);
		}
		//有效期时间控件
		blveInput.datepicker({
			"disabledDate":function(time){
				return time.getTime() < Date.now() - 8.64e7;
			},
			"success":function(value){
				blveInputHidden.val(value);
			}
		});
		ocveInput.datepicker({
			"disabledDate":function(time){
				return time.getTime() < Date.now() - 8.64e7;
			},
			"success":function(value){
				ocveInputHidden.val(value);
			}
		});
		//长期
		blveLong.click(function(e){
			if (blveLongInput.prop("checked") === true) {
				//blveInput.val("");
				blveInput.prop("disabled",true);
				blveInputHidden.val("3000-01-01");
			}else {
				blveInput.prop("disabled",false);
				blveInputHidden.val(blveInput.val());
			}
		});
		ocveLong.click(function(e){
			if (ocveLongInput.prop("checked") === true) {
				// ocveInput.val("");
				ocveInput.prop("disabled",true);
				ocveInputHidden.val("3000-01-01");
			}else {
				ocveInput.prop("disabled",false);
				ocveInputHidden.val(ocveInput.val());
			}
		});
		var blveInputStrHiddenValue = $("#j-blveStrHidden").val();//上次提交的时间
		var ocveInputStrHiddenValue = $("#j-olveStrHidden").val();
		if (blveInputStrHiddenValue === "3000-01-01" && !blveLongInput.prop("checked")) {
			blveLongInput.prop("checked",true);
			blveInput.prop("disabled",true);
		}else {
			blveLongInput.prop("checked",false);
			blveInput.prop("disabled",false);
			blveInput.val(blveInputStrHiddenValue);
		}
		if (ocveInputStrHiddenValue === "3000-01-01" && !ocveLongInput.prop("checked")) {
			ocveLongInput.prop("checked",true);
			ocveInput.prop("disabled",true);
		}else {
			ocveLongInput.prop("checked",false);
			ocveInput.prop("disabled",false);
			ocveInput.val(ocveInputStrHiddenValue);
		}
		// 上传
        $(".img-prev").on("click",".imgs>p>a",function(){
			var prev=$(this).parents(".imgs");
			var input=$(this).parents(".img-prev").attr("id").replace("_prev","");
			prev.siblings(".upload-pop").removeClass("hide");
			prev.remove();
			$("#"+input).val("");

		});
        // 返回时回显图片
        if($("#card_photo1").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo1").val();
        	$("#card_photo1_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo1_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo2").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo2").val();
        	$("#card_photo2_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo2_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo3").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo3").val();
        	$("#card_photo3_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo3_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo4").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo4").val();
        	$("#card_photo4_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo4_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
		ll.common.picCenter($(".imgs"));
		
		window.backfn=function(id,url,name){
			$("#"+id).val(name);
			$("#"+id+"_prev").find(".upload-pop").addClass("hide");
			$("#"+id+"_prev").find(".imgloading").remove();
			$("#"+id+"_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
			// 居中显示图片，特殊处理
			ll.common.picCenter($(".imgs"));
		};
		window.showloading=function(id){
			$("#"+id+"_prev").append("<div class='imgloading'><i></i></div>");
		};
		window.hideloading=function(id){
			$("#"+id+"_prev .imgloading").remove();
		};
    },
    kycCompany2:function(){//企业实名认证2
		var name$ = $('#name_');
		var cardno$ = $('#cardno_');
        // 日期
        var bdate$=$("#id_begin_date");
    	var edate$=$("#id_end_date");
        var bdate=bdate$.val();
    	var edate=edate$.val();
        var d=new Date();
        var begin_day=(d.getFullYear()-20)+"-"+((d.getMonth()+1)>=10?(d.getMonth()+1):"0"+(d.getMonth()+1))+"-"+(d.getDate()>=10?d.getDate():"0"+d.getDate());
		var end_day=d.getFullYear()+"-"+((d.getMonth()+1)>=10?(d.getMonth()+1):"0"+(d.getMonth()+1))+"-"+(d.getDate()>=10?d.getDate():"0"+d.getDate());
		var noDateCheckInput=$(".x-checkbox").is("div")?$(".x-checkbox").children("input") : $(".x-checkbox"),
		allDate$ = $("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day");

		ll.validate.submit(validate.data.kycCompany2);
		
        ll.common.date("begin_date_year","begin_date_month","begin_date_day",begin_day);
        ll.common.date("end_date_year","end_date_month","end_date_day",end_day);

        bdate$.val(begin_day);
		edate$.val(end_day);
		
		function handleValidity(bdate,edate){
			if(bdate!="" && edate!=""){
			
				if(bdate=="2000-01-01" && edate=="3000-01-01"){
					setTimeout(function(){
						allDate$.prop("disabled",true);
						noDateCheckInput.prop("checked",true);
						bdate$.val("2000-01-01");
						edate$.val("3000-01-01");
						ll.common.MformBeauty(allDate$);
					});
				}else{
					setTimeout(function(){
						$("#begin_date_year").val(bdate.split("-")[0]);
						$("#begin_date_month").val(bdate.split("-")[1]);
						$("#begin_date_day").val(bdate.split("-")[2]);
						$("#end_date_year").val(edate.split("-")[0]);
						$("#end_date_month").val(edate.split("-")[1]);
						$("#end_date_day").val(edate.split("-")[2]);
						bdate$.val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
						edate$.val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
						ll.common.MformBeauty(allDate$);
						noDateCheckInput.prop("checked",false);
						allDate$.prop("disabled",false);
					});
				}
			}
		}

		handleValidity(bdate,edate);

        $("#begin_date_year,#begin_date_month,#begin_date_day").change(function(){
        	bdate$.val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
        });
        $("#end_date_year,#end_date_month,#end_date_day").change(function(){
        	edate$.val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
        });
		//勾选长期
		$("body").on("click",".x-checkbox",function(){
			var obj=$(this).is("div")?$(this).children("input") : $(this);
			if(obj.is(":checked")){
				$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",true);
				$("#id_begin_date").val("2000-01-01");
				$("#id_end_date").val("3000-01-01");
			}else{
				$("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day").prop("disabled",false);
				$("#id_begin_date").val($("#begin_date_year").val()+"-"+$("#begin_date_month").val()+"-"+$("#begin_date_day").val());
				$("#id_end_date").val($("#end_date_year").val()+"-"+$("#end_date_month").val()+"-"+$("#end_date_day").val());
			}
			ll.common.MformBeauty($("#begin_date_year,#begin_date_month,#begin_date_day,#end_date_year,#end_date_month,#end_date_day"));
		});
        // 上传
        $(".img-prev").on("click",".imgs>p>a",function(){
			var prev=$(this).parents(".imgs");
			var input=$(this).parents(".img-prev").attr("id").replace("_prev","");
			prev.siblings(".upload-pop").removeClass("hide");
			prev.remove();
			$("#"+input).val("");

		});
        // 返回时回显图片
        if($("#card_photo_z").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo_z").val();
        	$("#card_photo_z_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo_z_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo_f").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo_f").val();
        	$("#card_photo_f_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo_f_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
		ll.common.picCenter($(".imgs"));

        //OCR回调有效期-反面
		function handleORCValidity(data){
			var dateArr = data.validity.split('-'),
				dateReg = /\d{4}-\d{2}-\d{2}/;

			for (var i = 0; i < dateArr.length; i++) {
				dateArr[i] = dateArr[i].replace(/\./g,'-');
			}

			if ( dateArr.length !== 2 ) return;
			if (!dateReg.test(dateArr[0])) return;
			if (!dateReg.test(dateArr[1]) && dateArr[1] !== '长期') return;

			if (dateArr[1] === '长期') {
				bdate = '2000-01-01';
				edate = "3000-01-01";
			}else {
				bdate = dateArr[0];
				edate = dateArr[1];
			}

			handleValidity(bdate,edate);
		}
		//OCR回调身份信息-正面
		function handleORCNumber(data){
			data.id_number+='';
			if(!ll.common.checkIdcard(data.id_number.replace(/\s+/g,"").replace("x","X")).status) {
				return;
			}
			name$.val(data.name);
			cardno$.val(data.id_number);
		}
		function handleORC(url){
			$.ajax({
      	        url: Context.base + "/account/getIDImgByOcr.htm?random="+Math.random(),
				data:{"imgPath":url},
				dataType : "json",
          	    success:function(result) {
          	    	if (result.retCode == "000000") {
          	    		if (result.validity) {
							handleORCValidity(result);
						} else if (result.id_number) {
							handleORCNumber(result);
						}
          	    	} 
          	    }
          	});
		}
		window.backfn=function(id,url,name){
			//ORC
			handleORC(name);
			$("#"+id).val(name);
			$("#"+id+"_prev").find(".upload-pop").addClass("hide");
			$("#"+id+"_prev").find(".imgloading").remove();
			$("#"+id+"_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
			// 居中显示图片，特殊处理
			ll.common.picCenter($(".imgs"));
		};
		window.showloading=function(id){
			$("#"+id+"_prev").append("<div class='imgloading'><i></i></div>");
		};
    },
    kycCompany3:function(){//企业实名认证3
        ll.validate.submit(validate.data.kycCompany3);
        // 上传
        $(".img-prev").on("click",".imgs>p>a",function(){
			var prev=$(this).parents(".imgs");
			var input=$(this).parents(".img-prev").attr("id").replace("_prev","");
			prev.siblings(".upload-pop").removeClass("hide");
			prev.remove();
			$("#"+input).val("");

		});
        // 返回时回显图片
        if($("#card_photo1").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo1").val();
        	$("#card_photo1_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo1_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo2").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo2").val();
        	$("#card_photo2_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo2_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo3").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo3").val();
        	$("#card_photo3_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo3_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
        if($("#card_photo4").val()!=""){
        	var url = Context.base + "/upload/watermark_" + $("#card_photo4").val();
        	$("#card_photo4_prev").find(".upload-pop").addClass("hide");
        	$("#card_photo4_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
        }
		window.backfn=function(id,url,name){
			$("#"+id).val(name);
			$("#"+id+"_prev").find(".upload-pop").addClass("hide");
			$("#"+id+"_prev").find(".imgloading").remove();
			$("#"+id+"_prev").append('<div class="imgs"><span><img src="'+url+'"></span><p><a href="javascript:;" class="uline">删除重新上传</a></p></div>');
			// 居中显示图片，特殊处理
			ll.common.picCenter($(".imgs"));
		};
		window.showloading=function(id){
			$("#"+id+"_prev").append("<div class='imgloading'><i></i></div>");
		};
    },
    kycCompany4:function(){
    //     ll.validate.submit(validate.data.kycCompany4);
	// 	ll.common.city("province","city");
	// 	//
	// 	$("#province,#city").on("change",function(){
	// 		setTimeout(function(){
	// 			$("#cityCode").val($("#city>option:selected").data("code"));
	// 			$("#stateName").val($("#province").val());
	// 			$("#cityName").val($("#city").val());
	// 		},10);
	// 	});
	// 	$("#bank_").on("change",function(){
	// 		$("#bankName").val($("#bank_>option:selected").text());
	// 	});
	// 	if($("#cityCode").val()!=""){
	// 		var code=$("#cityCode").val();
	// 		var base=Context.base;
	// 		$.getScript(base+"/js/city.js").done(function( script, textStatus ) {
	// 			for(var i=0;i<cityJsonData.length;i++){
	// 				for(var j=0;j<cityJsonData[i].cities.length;j++){
	// 					if(code==cityJsonData[i].cities[j].cityId){
	// 						$("#province>option[value='"+cityJsonData[i].province+"']").attr("selected","selected");
	// 						$("#province").change();
	// 						$("#city>option[value='"+cityJsonData[i].cities[j].cityName+"']").attr("selected","selected");
	// 						ll.common.MformBeauty($("#province,#city"));

	// 						// 修改时初始化开户行支行名称和大额行号
	// 						setTimeout(function(){
	// 							//加载分行和大额行号
	// 							if($("#bank_name").data("value")!=""){
	// 								$("#bank_name").val($("#bank_name").data("value"));
	// 							}
	// 							if($("#cnapsCode").data("value")!=""){
	// 								$("#cnapsCode").val($("#cnapsCode").data("value"));
	// 							}
	// 						},10);
	// 					}
	// 				}
	// 			}
	// 		});
	// 	}else{
	// 		if($("#cnapsCode").data("value")!=""){
	// 			$("#cnapsCode").val($("#cnapsCode").data("value"));
	// 		}
	// 	}
	// 	// 初始化开户行
  	// 	if($("#bank_").data("value")!=""){
  	// 		setTimeout(function(){
	// 			$("#bank_>option[value='"+$("#bank_").data("value")+"']").prop("selected","selected");
	// 			$("#bank_").change();
  	// 		});
	// 	}
	// 	//
	// 	var bankjson={"01000000":[
	// 	  						{"amtlimit":"5000000","bankname":"邮储银行","banktype":"C","isPrcptcd":"1"},
	// 	  						{"amtlimit":"10000000","bankname":"邮储银行","banktype":"B","isPrcptcd":"0"}
	// 	  					],"01020000":[{"amtlimit":"5000000","bankname":"工商银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"工商银行","banktype":"B","isPrcptcd":"0"}],"01030000":[{"amtlimit":"5000000","bankname":"农业银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"农业银行","banktype":"B","isPrcptcd":"0"}],"01040000":[{"amtlimit":"5000000","bankname":"中国银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"中国银行","banktype":"B","isPrcptcd":"0"}],
	// 	  					"01050000":[
	// 	  					{"amtlimit":"5000000","bankname":"建设银行","banktype":"C","isPrcptcd":"1"},
	// 	  					{"amtlimit":"10000000","bankname":"建设银行","banktype":"B","isPrcptcd":"0"}],
	// 	  					"03010000":[{"amtlimit":"5000000","bankname":"交通银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"交通银行","banktype":"B","isPrcptcd":"1"}],"03020000":[{"amtlimit":"5000000","bankname":"中信银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"中信银行","banktype":"B","isPrcptcd":"1"}],"03030000":[{"amtlimit":"5000000","bankname":"光大银行","banktype":"C","isPrcptcd":"0 "},{"amtlimit":"10000000","bankname":"光大银行","banktype":"B","isPrcptcd":"0"}],"03040000":[{"amtlimit":"5000000","bankname":"华夏银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"华夏银行","banktype":"B","isPrcptcd":"1"}],"03050000":[{"amtlimit":"5000000","bankname":"民生银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"民生银行","banktype":"B","isPrcptcd":"1"}],"03060000":[{ "amtlimit":"5000000","bankname":"广发银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"广发银行","banktype":"B","isPrcptcd":"1"}],"03070000":[{"amtlimit":"5000000","bankname":"平安银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"平安银行","banktype":"B","isPrcptcd":"1"}],"03080000":[{"amtlimit":"5000000","bankname":"招商银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000 ","bankname":"招商银行","banktype":"B","isPrcptcd":"0"}],"03090000":[{"amtlimit":"5000000","bankname":"兴业银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"兴业银行","banktype":"B","isPrcptcd":"1"}],"03100000":[{"amtlimit":"5000000","bankname":"浦发银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"浦发银行","banktype":"B","isPrcptcd":"1"}]};


	// 	  		$("#bank_").on("change",function(){
	// 	  			if($(this).val()==""){
	// 	  				$("#bindcardlist>li[data-type]").addClass("hide");
	// 	  				$("#bindcardlist>li[data-type]").find("input,select").val("");
	// 	  				return;
	// 	  			};
	// 	  			var code=$(this).find("option:selected").data("json");
	// 	  			var result=bankjson[code]!=null?bankjson[code][1]:-1;
	// 	  			if(result.isPrcptcd==1){
	// 	  				$("#bindcardlist>li[data-type='2']").removeClass("hide");
	// 	  				$("#bindcardlist>li[data-type='3']").addClass("hide");
	// 	  				$("#bindcardlist>li[data-type='3']").find("input,select").val("");
	// 	  			}else if(result.isPrcptcd==0){
	// 	  				$("#bindcardlist>li[data-type='2'],#bindcardlist>li[data-type='3']").addClass("hide");
	// 	  				$("#bindcardlist>li[data-type='2'],#bindcardlist>li[data-type='3']").find("input,select").val("");
	// 	  			}else{
	// 	  				$("#bindcardlist>li[data-type='3']").removeClass("hide");
	// 	  				$("#bindcardlist>li[data-type='2']").addClass("hide");
	// 	  				$("#bindcardlist>li[data-type='2']").find("input,select").val("");
	// 	  			}
	// 	  			$("#bindcardlist>li[data-type='1']").removeClass("hide");
	// 	  			$("#province").change();
	// 	  		});


	// 	  		//大额行号查询
	// 	  		var bankData={"sources":[{value:"没有匹配的银行"}]};
	// 	  		$("#bank_,#province,#city").on("change",function(){
	// 	  			if($("#province").is(":hidden")) return;
	// 	  			setTimeout(function(){
	// 		  			var bank=$("#bank_").val();
	// 		  			var city=$("#city option:selected").attr("data-code") || "";
	// 		  			$("#bank_name,#cnapsCode").val("");
	// 		  			if(!$("#city").is(":visible") || $("#city").val()=="") return;
	// 		  			$.ajax({
	// 		  				type:"post",
	// 		  				url:Context.base + '/bindcard/cnapsCodeQuery.htm?random='+Math.random(),
	// 		  				data:{ bankcode: bank, citicode:city},
	// 		  				dataType:"html",
	// 		  				async:true,
	// 		  				success:function(data){
	// 		  					if(data!=""){
	// 		  						bankData=eval("("+data+")");
	// 		  					}else{
	// 		  						bankData={"sources":[{value:"没有匹配的银行"}]};
	// 		  					}
	// 		  				}
	// 		  			});
	// 	  			});
	// 	  		});

	// 	  		$("#bank_name").attr("autocomplete","off").on("focus keyup",function(){
	// 	  			if(bankData.sources==null){return;};
	// 	  			var arry=bankData.sources,arryStr="";
	// 	  			var val=$(".bank_name_input").val().replace(/\s+/g,"");
	// 	  			var reg=new RegExp("("+val+")","g");
	// 	  			for (var key in arry){
	// 	  				var newstr=arry[key].value.replace(reg,"<font class='c1'>$1</font>");
	// 	  				if(reg.test(arry[key].label)){
	// 	  					arryStr+="<li num='"+arry[key].id+"'><span>"+newstr+"</span></li>";
	// 	  				};
	// 	  			}
	// 	  			if(arryStr!=""){
	// 	  				$("#bank_name_auto").html("").append(arryStr).show();
	// 	  			}else{
	// 	  				$("#bank_name_auto").html("<li><span>没有匹配的银行</span></li>").append(arryStr).show();
	// 	  			}
	// 	  			$(document).off("click").on("click", function(e){
	// 	  				var e=e?e:window.event;
	// 	  				var tar = e.srcElement||e.target;
	// 	  				if(!$(tar).closest(".autocomplete-box").size()){
	// 	  					$("#bank_name_auto").hide();
	// 	  				}
	// 	  			});
	// 	  		});
	// 	  		$("#bank_name_auto").on("click","li",function(){
	// 	  			if($(this).attr("num")=="undefined") return false;
	// 	  			$("#bank_name").val($(this).text());
	// 	  			$("#bank_name").blur();
	// 	  			//$("#bindcardlist>li[data-type='3']").removeClass("hide");
	// 	  			$("#cnapsCode").val($(this).attr("num"));
	// 	  			$("#bank_name_auto").hide();
	// 	  		});

    },
    kycCompany4_new:function(){
		ll.validate.submit(validate.data.kycCompany4_new);
		//其他银行、交通银行、上海银行、宁波银行、包商银行、江苏银行、珠海华润银行、浙商银行、东莞银行、广东南粤银行、广州银行、广发银行  需要大额行号
		var cnapsCodeArr = ['15947916',
				'03010000',
				'04012900',
				'04083320',
				'04791920',
				'05083000',
				'64375850',
				'03160000',
				'04256020',
				'64895910',
				'64135810',
				'03060000'
			],
			bankCodeVaule = $("#bank_").val();

		function showCnapsCode (value){
			var needCnapsCode = false;
			$.map(cnapsCodeArr, function(item){
				if(value ===item ){
					$("#bindcardlist>li[data-type='da']").removeClass("hide");
					needCnapsCode = true;
				}
			});
			return needCnapsCode;
		}
		showCnapsCode(bankCodeVaule);
    	
		$("#bank_").change(function(){
			var v=$(this).val();
			if( !showCnapsCode(v) ) {
				$("#cnapsCode").val("");
				$("#bindcardlist>li[data-type='da']").addClass("hide");
			};
		});
    },
    kycCompanyComplete:function(){
    	// 居中显示图片，特殊处理
		ll.common.picCenter($(".imgs"));
		
		function postBusinessKyc (buttonId) {
			ll.common.ajaxForm({
				obj:$("#"+buttonId),
        		url:"businessConfirm.htm",
        		data:$("#business_form").serialize(),
        		success:function(data){
        			// if (data.retcode == '999999') {
    				// 	var con=['<div class="pd">',
    				// 			 '<i class="icons icons-m-info"></i><p class="info-text">企业信息已存在，是否直接关联？</p>',
    				// 			 '</div>'].join("");
    				// 	ll.dialog.confirm({title:'提示',content:con,width:600,lock:true,ok:function(){
    				// 		ll.common.ajaxForm({
    				// 			url:"businessUser.htm",
    				// 			data:$("#business_form").serialize(),
    				// 			success:function(data){
    				// 				if (data.retcode == '000000') {
    				// 					business_success();
    				// 				} else {
    				// 					ll.common.tips('error', data.retmsg,2000);
    				// 				}
    				// 			}
    				// 		});
    				// 	}});
					// } else 
					if (data.retcode == '000000') {
        				business_success();
        			} else {
        				ll.common.tips('error',data.retmsg,2000);
        			}
        		}
        	});
		}
		//
		$("#kyc_submit").on("click",function(){
			typeof(_paq)!="undefined" && _paq.push(['trackEvent','business_submit','提交预览页点击确认提交按钮']);
			//PP名字校验
			ll.common.ajaxForm({
				obj:$("#kyc_submit"),
				url:Context.base + '/account/compareNameWithPP.htm',
				data:{ "kycType":"B"},
				success:function(data){
					if (data.retCode === "000001") {
						var con="<div class='pd'><img src="+Context.base+"/images/kyc/PPName/business.jpg"+" /><p class='info-text'>您的企业实名认证名称与PayPal账户名称不一致，将会影响您后续提现。您可重新填写您的实名认证信息或者前往PayPal修改您的账户名称(<a  href='"+Context.base+"/register/question.htm?index=4' target='_blank'>查看匹配规则</a>)。</p></div><div class='setting-form'><div class='action-bar text-c'><a id='backToOne' class='button mr30' href='javascript:;'>修改实名认证信息</a><a id='dialogsubmit' class='button button-light' href='javascript:;'>确认提交</a></div></div>"
						ll.dialog.simple({title:'温馨提示',clazz:"comparePPNameDialog",content :con,width : 760,lock : true,load:function(o){
							var backToOneBtn = $("#backToOne"),
								dialogsubmitBtn = $("#dialogsubmit");
								backToOneBtn.click(function(){
									business_one();
								});
								dialogsubmitBtn.click(function(){
									postBusinessKyc("dialogsubmit");
								});
						}});;
					} else {
						postBusinessKyc("kyc_submit");
					}
				}
			});
		});
	},
	//关联账户 step1;
	bindaccount:function(){
			//介绍视频
			clickToShowVideoDialog($("#video-dialog-btn"));

      ll.validate.submit(validate.data.bindaccount);
	},
	//解绑账户 step1;
	unbindVerify:function(){
		//
		ll.validate.submit(validate.data.unbindVerify);
		// 发送验证码
		$("#SendMsg").off("click.send").on("click.send",function(){
			var t=$(this).text();
			$("#smsCode").val("");
			if ($(this).hasClass("disabled")) {return;}
          	var $that = $(this);
          	//请求短信验证码
          	ll.common.ajaxForm({
          		obj:$("#SendMsg"),
      	        url: Context.base + "/account/unbindSendSMS.htm",
      	        beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
          	    success:function(result) {
					$("#SendMsg").text(t);
          	    	if (result.retcode == "0000") {
          	    		$("#handleCode").val(result.info.handcode);
          	    		ll.common.messageCode($that,60);
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,2000);
          	    	}
          	    },
          	    error : function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
          	});
		});
	},
	//解绑账户 step2;
	unbindComplete:function(){
		$("#unbind_submit").on("click",function(){
			ll.common.ajaxForm({
				obj:$("#unbind_submit"),
        		url:"unbindConfirm.htm",
        		data:$("#unbind_form").serialize(),
        		success:function(dto){
        			if (dto.errorCode == '000000') {
        				unbind_success();
        			} else {
        				ll.common.tips('errpr', dto.errorMessage,2000);
        			}
        		}
        	});
		});
	},
    bindcard1:function(){
		ll.validate.submit(validate.data.bindcard1);
		$("#SendMsg").off("click.send").on("click.send",function(){
			var t=$(this).text();
    		  $("#smsCode").val("");
            	if ($(this).hasClass("disabled")){return;}
            	var $that = $(this);
            	//请求短信验证码
            	ll.common.ajaxForm({
            		obj:$("#SendMsg"),
        	        url: Context.base + "/bindcard/bindCardSendPhoneMsg.htm",
          	        beforeSend:function(){
    					$("#SendMsg").text("请稍后");
    				},
            	    success:function(result) {
    					$("#SendMsg").text(t);
            	    	if (result.retcode == "0000") {
            	    		$("#handleCode").val(result.info.handcode);
            	    		 ll.common.messageCode($that,60);
            	    	} else {
            	    		ll.common.tips('error',result.retmsg,2000);
            	    	}
            	    },
              	    error : function(){
    					$("#SendMsg").text(t);
    					ll.common.tips('error',"验证码发送失败",2000);
    				}
            	});
		});
    },
	bindcard2:function(){//绑定银行卡
		ll.common.city("province","city");
        ll.validate.submit(validate.data.bindcard2);
		var bankjson={"01000000":[
						{"amtlimit":"5000000","bankname":"邮储银行","banktype":"C","isPrcptcd":"1"},
						{"amtlimit":"10000000","bankname":"邮储银行","banktype":"B","isPrcptcd":"0"}
					],"01020000":[{"amtlimit":"5000000","bankname":"工商银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"工商银行","banktype":"B","isPrcptcd":"0"}],"01030000":[{"amtlimit":"5000000","bankname":"农业银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"农业银行","banktype":"B","isPrcptcd":"0"}],"01040000":[{"amtlimit":"5000000","bankname":"中国银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"中国银行","banktype":"B","isPrcptcd":"0"}],
					"01050000":[
					{"amtlimit":"5000000","bankname":"建设银行","banktype":"C","isPrcptcd":"1"},
					{"amtlimit":"10000000","bankname":"建设银行","banktype":"B","isPrcptcd":"0"}],
					"03010000":[{"amtlimit":"5000000","bankname":"交通银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"交通银行","banktype":"B","isPrcptcd":"1"}],"03020000":[{"amtlimit":"5000000","bankname":"中信银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"中信银行","banktype":"B","isPrcptcd":"1"}],"03030000":[{"amtlimit":"5000000","bankname":"光大银行","banktype":"C","isPrcptcd":"0 "},{"amtlimit":"10000000","bankname":"光大银行","banktype":"B","isPrcptcd":"0"}],"03040000":[{"amtlimit":"5000000","bankname":"华夏银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"华夏银行","banktype":"B","isPrcptcd":"1"}],"03050000":[{"amtlimit":"5000000","bankname":"民生银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"民生银行","banktype":"B","isPrcptcd":"1"}],"03060000":[{ "amtlimit":"5000000","bankname":"广发银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"广发银行","banktype":"B","isPrcptcd":"1"}],"03070000":[{"amtlimit":"5000000","bankname":"平安银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"平安银行","banktype":"B","isPrcptcd":"1"}],"03080000":[{"amtlimit":"5000000","bankname":"招商银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000 ","bankname":"招商银行","banktype":"B","isPrcptcd":"0"}],"03090000":[{"amtlimit":"5000000","bankname":"兴业银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"兴业银行","banktype":"B","isPrcptcd":"1"}],"03100000":[{"amtlimit":"5000000","bankname":"浦发银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"浦发银行","banktype":"B","isPrcptcd":"1"}]};


		$("#bank_").on("change",function(){
			if($(this).val()==""){
				$("#bindcardlist>li[data-type]").addClass("hide");
				return;
			};
			var code=$(this).find("option:selected").data("json");
			var result=bankjson[code]!=null?bankjson[code][1]:-1;//对公;
			if(result.isPrcptcd==1){
				$("#bindcardlist>li[data-type='2']").removeClass("hide");
				$("#bindcardlist>li[data-type='3']").addClass("hide");
			}else if(result.isPrcptcd==0){
				$("#bindcardlist>li[data-type='2']").addClass("hide");
				$("#bindcardlist>li[data-type='3']").addClass("hide");
			}else{
				$("#bindcardlist>li[data-type='3']").removeClass("hide");
				$("#bindcardlist>li[data-type='2']").addClass("hide");
			}
			$("#bindcardlist>li[data-type='1']").removeClass("hide");
		});
		//大额行号查询
		var bankData={"sources":[{value:"没有匹配的银行"}]};
		$("#bank_,#province,#city").on("change",function(){
			if($("#province").is(":hidden")) return;
			setTimeout(function(){
				var bank=$("#bank_").val();
				var city=$("#city option:selected").attr("data-code") || "";
				$("#bank_name,#prcptcd").val("");
				if(!$("#city").is(":visible") || $("#city").val()=="") return;
				$.ajax({
					type:"post",
					url:Context.base + '/bindcard/cnapsCodeQuery.htm?random='+Math.random(),
					data:{ bankcode: bank, citicode:city},
					dataType:"html",
					async:true,
					success:function(data){
						if(data!=""){
							bankData=eval("("+data+")");
						}else{
							bankData={"sources":[{value:"没有匹配的银行"}]};
						}
					}
				});
			});
		});
		$("#bank_name").attr("autocomplete","off").on("focus keyup",function(){
			if(bankData.sources==null){return;};
			var arry=bankData.sources,arryStr="";
			var val=$(".bank_name_input").val().replace(/\s+/g,"");
			var reg=new RegExp("("+val+")","g");
			for (var key in arry){
				var newstr=arry[key].value.replace(reg,"<font class='c1'>$1</font>");
				if(reg.test(arry[key].label)){
					arryStr+="<li num='"+arry[key].id+"'><span>"+newstr+"</span></li>";
				};
			}
			if(arryStr!=""){
				$("#bank_name_auto").html("").append(arryStr).show();
			}else{
				$("#bank_name_auto").html("<li><span>没有匹配的银行</span></li>").append(arryStr).show();
			}
			$(document).off("click").on("click", function(e){
				var e=e?e:window.event;
				var tar = e.srcElement||e.target;
				if(!$(tar).closest(".autocomplete-box").size()){
					$("#bank_name_auto").hide();
				}
			});
		});
		$("#bank_name_auto").on("click","li",function(){
			if($(this).attr("num")=="undefined") return false;
			$("#bank_name").val($(this).text());
			$("#bank_name").blur();
			$("#prcptcd").val($(this).attr("num"));
			$("#bank_name_auto").hide();
		});
	},
	bindcard2_new:function(){//绑定银行卡
		ll.validate.submit(validate.data.bindcard2_new);
		if($("#bank_").val()=="15947916"){
			$("#bindcardlist>li[data-type='da']").removeClass("hide");
		}
		$("#bank_").change(function(){
			var v=$(this).val();
			if(v=="15947916"){
				$("#bindcardlist>li[data-type='da']").removeClass("hide");
			}else{
				$("#cnapsCode").val("");
				$("#bindcardlist>li[data-type='da']").addClass("hide");
			}
		});
	},
	bindcard3:function(){//绑定银行卡

		$("#submitAuthBankAccount").off("click").on("click",function(){
			 ll.common.ajaxForm({
				 	obj:$("#submitAuthBankAccount"),
        	        url: Context.base + "/bindcard/bindCardAuth.htm",
        	        data:$("#authBankAccountForm").serialize(),
            	    success:function(result) {
            	    	if (result.retcode == "0000") {
            	    		location.href = Context.base + "/bindcard/bindCardSuccess.htm";
            	    	} else {
            	    		if (result.info.lastTime == "0") {
            	    			location.href = Context.base + "/bindcard/bindCardFail.htm";
            	    		} else {
            	    			ll.common.tips('error',result.retmsg,2000);
                	    		$("#lastTime").text(result.info.lastTime);
            	    		}
            	    	}
            	    }
            	});

		 });
		$("#verifyMoney").on("input propertychange",function(){
			var $this=$(this);
			var r=$this.val().replace(/[^\d.]/g,"")
							.replace(/^\./g,"")
							.replace(/\.{2,}/g,".")
							.replace(".","$#{1}")
							.replace(/\./g,"")
							.replace("$#{1}",".")
							.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');
			$this.val(r);//屏蔽非金额字符
		}).on("blur",function(){
			var $this=$(this);
			var r=$this.val().replace(/[^\d.]/g,"")
							.replace(/^\./g,"")
							.replace(/\.{2,}/g,".")
							.replace(".","$#{1}")
							.replace(/\./g,"")
							.replace("$#{1}",".")
							.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');
			r=parseFloat(r).toFixed(2);
			$this.val(r);//屏蔽非金额字符
		});
	},
	bindcardind1:function(){
		//
		ll.validate.submit(validate.data.bindcardind1);
		//
  	  	$("#SendMsg").off("click.send").on("click.send",function(){
			var t=$(this).text();
  		  	$("#smsCode").val("");
          	if ($(this).hasClass("disabled")) {return;}
          	var $that = $(this);
          	//请求短信验证码
          	ll.common.ajaxForm({
        		obj:$("#SendMsg"),
      	        url: Context.base + "/bindcardind/bindCardSendPhoneMsg.htm",
      	        beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
          	    success:function(result) {
					$("#SendMsg").text(t);
          	    	if (result.retcode == "0000") {
          	    		$("#handleCode").val(result.info.handcode);
          	    		 ll.common.messageCode($that,60);
          	    	} else {
          	    		ll.common.tips('error',result.retmsg,2000);
          	    	}
          	    },
          	    error : function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
          	});
       });
  },
  bindcardind2:function(){//绑定银行卡
	ll.common.city("province","city");
      ll.validate.submit(validate.data.bindcardind2);
		var bankjson={"01000000":[
						{"amtlimit":"5000000","bankname":"邮储银行","banktype":"C","isPrcptcd":"1"},
						{"amtlimit":"10000000","bankname":"邮储银行","banktype":"B","isPrcptcd":"0"}
					],"01020000":[{"amtlimit":"5000000","bankname":"工商银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"工商银行","banktype":"B","isPrcptcd":"0"}],"01030000":[{"amtlimit":"5000000","bankname":"农业银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"农业银行","banktype":"B","isPrcptcd":"0"}],"01040000":[{"amtlimit":"5000000","bankname":"中国银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"中国银行","banktype":"B","isPrcptcd":"0"}],
					"01050000":[
					{"amtlimit":"5000000","bankname":"建设银行","banktype":"C","isPrcptcd":"1"},
					{"amtlimit":"10000000","bankname":"建设银行","banktype":"B","isPrcptcd":"0"}],
					"03010000":[{"amtlimit":"5000000","bankname":"交通银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"交通银行","banktype":"B","isPrcptcd":"1"}],"03020000":[{"amtlimit":"5000000","bankname":"中信银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"中信银行","banktype":"B","isPrcptcd":"1"}],"03030000":[{"amtlimit":"5000000","bankname":"光大银行","banktype":"C","isPrcptcd":"0 "},{"amtlimit":"10000000","bankname":"光大银行","banktype":"B","isPrcptcd":"0"}],"03040000":[{"amtlimit":"5000000","bankname":"华夏银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"华夏银行","banktype":"B","isPrcptcd":"1"}],"03050000":[{"amtlimit":"5000000","bankname":"民生银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"民生银行","banktype":"B","isPrcptcd":"1"}],"03060000":[{ "amtlimit":"5000000","bankname":"广发银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"广发银行","banktype":"B","isPrcptcd":"1"}],"03070000":[{"amtlimit":"5000000","bankname":"平安银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"平安银行","banktype":"B","isPrcptcd":"1"}],"03080000":[{"amtlimit":"5000000","bankname":"招商银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000 ","bankname":"招商银行","banktype":"B","isPrcptcd":"0"}],"03090000":[{"amtlimit":"5000000","bankname":"兴业银行","banktype":"C","isPrcptcd":"1"},{"amtlimit":"10000000","bankname":"兴业银行","banktype":"B","isPrcptcd":"1"}],"03100000":[{"amtlimit":"5000000","bankname":"浦发银行","banktype":"C","isPrcptcd":"0"},{"amtlimit":"10000000","bankname":"浦发银行","banktype":"B","isPrcptcd":"1"}]};


		$("#bank_").on("change",function(){
			if($(this).val()==""){
				$("#bindcardlist>li[data-type]").addClass("hide");
				return;
			};
			var code=$(this).find("option:selected").data("json");
			var result=bankjson[code]!=null?bankjson[code][0]:-1//对私;
			if(result.isPrcptcd==1){
				$("#bindcardlist>li[data-type='2']").removeClass("hide");
				$("#bindcardlist>li[data-type='3']").addClass("hide");
			}else if(result.isPrcptcd==0){
				$("#bindcardlist>li[data-type='2']").addClass("hide");
				$("#bindcardlist>li[data-type='3']").addClass("hide");
			}else{
				$("#bindcardlist>li[data-type='3']").removeClass("hide");
				$("#bindcardlist>li[data-type='2']").addClass("hide");
			}
			$("#bindcardlist>li[data-type='1']").removeClass("hide");
		});


		//大额行号查询
		var bankData={"sources":[{value:"没有匹配的银行"}]};
		$("#bank_,#province,#city").on("change",function(){
			if($("#province").is(":hidden")) return;
			setTimeout(function(){
				var bank=$("#bank_").val();
				var city=$("#city option:selected").attr("data-code") || "";
				$("#bank_name,#prcptcd").val("");
				if(!$("#city").is(":visible") || $("#city").val()=="") return;
				$.ajax({
					type:"post",
					url:Context.base + '/bindcard/cnapsCodeQuery.htm?random='+Math.random(),
					data:{ bankcode: bank, citicode:city},
					dataType:"html",
					async:true,
					success:function(data){
						if(data!=""){
							bankData=eval("("+data+")");
						}else{
							bankData={"sources":[{value:"没有匹配的银行"}]};
						}
					}
				});
			});
		});

		$("#bank_name").attr("autocomplete","off").on("focus keyup",function(){
			if(bankData.sources==null){return;};
			var arry=bankData.sources,arryStr="";
			var val=$(".bank_name_input").val().replace(/\s+/g,"");
			var reg=new RegExp("("+val+")","g");
			for (var key in arry){
				var newstr=arry[key].value.replace(reg,"<font class='c1'>$1</font>");
				if(reg.test(arry[key].label)){
					arryStr+="<li num='"+arry[key].id+"'><span>"+newstr+"</span></li>";
				};
			}
			if(arryStr!=""){
				$("#bank_name_auto").html("").append(arryStr).show();
			}else{
				$("#bank_name_auto").html("<li><span>没有匹配的银行</span></li>").append(arryStr).show();
			}
			$(document).off("click").on("click", function(e){
				var e=e?e:window.event;
				var tar = e.srcElement||e.target;
				if(!$(tar).closest(".autocomplete-box").size()){
					$("#bank_name_auto").hide();
				}
			});
		});
		$("#bank_name_auto").on("click","li",function(){
			if($(this).attr("num")=="undefined") return false;
			$("#bank_name").val($(this).text());
			$("#bank_name").blur();
			//$("#bindcardlist>li[data-type='3']").removeClass("hide");
			$("#prcptcd").val($(this).attr("num"));
			$("#bank_name_auto").hide();
		});


	},
	bindcardind2_new:function(){//绑定银行卡
		ll.validate.submit(validate.data.bindcardind2_new);
		if($("#bank_").val()=="15947916"){
			$("#bindcardlist>li[data-type='da']").removeClass("hide");
		}
		$("#bank_").change(function(){
			var v=$(this).val();
			if(v=="15947916"){
				$("#bindcardlist>li[data-type='da']").removeClass("hide");
			}else{
				$("#cnapsCode").val("");
				$("#bindcardlist>li[data-type='da']").addClass("hide");
			}
		});
	},
	// 添加银行卡
	bank_card_add_info:function(){
		ll.validate.submit(validate.data.bank_card_add_info);
		if($("#bank_").val()=="15947916"){
			$("#bindcardlist>li[data-type='da']").removeClass("hide");
		}
		$("#bank_").change(function(){
			var v=$(this).val();
			if(v=="15947916"){
				$("#bindcardlist>li[data-type='da']").removeClass("hide");
			}else{
				$("#cnapsCode").val("");
				$("#bindcardlist>li[data-type='da']").addClass("hide");
			}
		});
	},
	bindcardind3:function(){//绑定银行卡
		$("#submitAuthBankAccount").off("click").on("click",function(){
			 ll.common.ajaxForm({
				obj:$("#submitAuthBankAccount"),
      	        url: Context.base + "/bindcardind/bindCardAuth.htm",
      	        data:$("#authBankAccountForm").serialize(),
          	    success:function(result) {
          	    	if (result.retcode == "0000") {
          	    		location.href = Context.base + "/bindcard/bindCardSuccess.htm";
          	    	} else {

          	    		if (result.info != null) {
          	    			var lastTime = "-1";
          	    			if (result.info.lastTime != null) {
          	    				lastTime = result.info.lastTime;
          	    			}

              	    		if (lastTime == "0") {
              	    			location.href = Context.base + "/bindcard/bindCardFail.htm";
              	    		} else {
              	    			ll.common.tips('error',result.retmsg,2000);
                  	    		$("#lastTime").text(result.info.lastTime);
              	    		}
          	    		} else {
          	    			ll.common.tips('error',result.retmsg,2000);
          	    		}


          	    	}
          	    }
          	});
		 });
		$("#verifyMoney").on("input propertychange",function(){
			var $this=$(this);
			$this.val();
			$this.val($this.val().replace(/[^\d.]/g,"").replace(/^\./g,"").replace(/\.{2,}/g,".").replace(".","$#{1}").replace(/\./g,"").replace("$#{1}",".").replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3'));//屏蔽非金额字符
		});
   },
   exList:function(){
	   	var totalAmount = $("#j-totalamount"),
	   		exportBtn = $("#j-exportbtn"),
	   		searchForm = $("#searchForm");
	   totalAmount.text("USD " + Number(totalAmount.text()).toLocaleString("en-US",{ minimumFractionDigits: 2 }));

	   exportBtn.click(function(){
		typeof(_paq)!="undefined" && _paq.push(['trackEvent',FEE_RATE+'_download',FEE_RATE+'用户点击交易记录一键导出']);
		ll.common.ajaxForm({
			obj:exportBtn,
			url : Context.base + "/order/checkdownloadOrderList.htm",
			data : searchForm.serialize(),
			success:function(data){
				if (data.retcode === "000000") {
					window.open(Context.base + "/order/downloadOrderList.htm?uuid="+data.retmsg ,"_target")
				} else {
					ll.common.tips('error', data.retmsg,2000);
				}
			}
		});
	   });
				
		$(".date-picker").datepicker({
			"disabledDate":function(time){
				return time.getTime() > new Date();
			},
			"success":function(){
				var start=$("#startDate").val();
				var end=$("#endDate").val();
				var diff=Date.parse(end)-Date.parse(start);
				var diffDays=Math.floor(diff/(24*3600*1000));
				if(start>end){
					
					ll.common.tips("error","结束时间不能早于开始时间",1000);
					return;
				}
				if (diffDays > 365) {
					ll.common.tips("error","请重新选择查询时间，范围必须在1年以内",1000);
					return;
				}
				submitForm();
			}
		});
   		if($("#startDate").val()=="" && $("#endDate").val()==""){
   			$("#startDate").val(ll.common.getCurrentDate());
   			$("#endDate").val(ll.common.getCurrentDate());
   		}
   },
   createExchangeOrder:function(){//提现
	   var hasBalance=false;
	   var getTime=0;
		 var h5_balanceDom = $("#h5_balance");
	  window.getBalance=function(){
	    $.ajax({
	      type : "get",
	      url : "getBalance.htm?m="+Math.random(),
	      data : {},
	      dataType : "json",
	      success : function(data) {
	        hasBalance=true;
	        if(data==null){
	          if(getTime>10){
							var htm = "获取失败,<a href='javascript:;' onclick='resetGet();'>重新获取</a>";
	            $("#realbalance").removeClass("c3").html(htm);
							//H5
							if (h5_balanceDom) {
								h5_balanceDom.html(htm);
							}
	          }else{
	            getTime=getTime+1;
	            getBalance();
	          }
	        }else{
	          $("#realbalance").addClass("f18 bold").removeClass("c3").html("USD " + parseFloat(data).toFixed(2));
	          $("#balance").val(parseFloat(data).toFixed(2));
						//H5
						if (h5_balanceDom) {
							h5_balanceDom.html("USD " + parseFloat(data).toFixed(2));
						}
	        }
	      },
	      error:function(){
	        if(getTime>10){
						var htm = "获取失败,<a href='javascript:;' onclick='resetGet();'>重新获取</a>";
	          $("#realbalance").removeClass("c3").html("获取失败,<a href='javascript:;' onclick='resetGet();'>重新获取</a>");
						//H5
						if (h5_balanceDom) {
							h5_balanceDom.html(htm);
						}
	        }else{
	          getTime=getTime+1;
	          getBalance();
	        }
	      }
	    });
	  }
	  getBalance();
	  window.resetGet=function(){
	    getTime=0;
	    getBalance();
	  }

	  //获取余额
	  $("#createOrder").add("#h5_createOrder").on("click",function(){
	    if(canSend=="1001") {
	      ll.common.tips("error","请先前往绑定银行卡",2000);
	      return;
	    }
	    var balance =$("#balance").val();
	    if(balance=="" || !hasBalance){
	      ll.common.tips("error","获取余额中请稍等",1000);
	      return;
	    }
	    var foreignCurrencyAt =$("#foreignCurrencyAt_hidden").val();
	    if(foreignCurrencyAt==""){
	      ll.common.tips("error","请输入提现金额",1000);
	      return;
	    }
	    /*
	     * 真实*/
	    if(withdrawalAccount){
	      if($("#feeRate").val() != "" && $("#feeRate").val()*1 < 0.012){
	        if(Number(balance)<Number(foreignCurrencyAt)||Number(foreignCurrencyAt)>50000||Number(foreignCurrencyAt)<50){
	          ll.common.tips("error","输入金额有误,请您重新输入",1000);
	          return;
	        }
	      }else{
	        if(Number(balance)<Number(foreignCurrencyAt)||Number(foreignCurrencyAt)>10000||Number(foreignCurrencyAt)<50){
	          ll.common.tips("error","输入金额有误,请您重新输入",1000);
	          return;
	        }
	      }
	    }

	      //执行
	    ll.common.ajaxForm({
	        obj:$("#createOrder"),
	        url : "createExchangeOrder.htm",
	        data : $("#exForm").serialize(),
	        success : function(data){
	          if (data.retcode == "0000") {
	            var id = data.id;
	            var sourceCurrency = data.sourceCurrency;
	            var foreignCurrencyAt = data.foreignCurrencyAt;
	            var account = data.account;
	            var payeeType = data.payeeType;
	            var sourceAmount = data.sourceAmount;
	            var targetCurrency = data.targetCurrency;
	            location.href = "getExchangeOrderInfo.htm?exchangeOrder.id="+ id
	            + "&exchangeOrder.sourceCurrency="+ sourceCurrency+
	            "&exchangeOrder.payeeType="+ payeeType+ "&exchangeOrder.foreignCurrencyAt="
	            + foreignCurrencyAt+ "&exchangeOrder.account="
	            + account+ "&exchangeOrder.targetCurrency="+ targetCurrency+ "&exchangeOrder.sourceAmount="
	            + sourceAmount;
	          } else if(data.retcode == "900001"){
	            ll.common.tips('error',data.retmsg);
	          }else if(data.retcode == "900002"){
	            ll.common.tips('error',data.retmsg);
	          } else {
	            ll.common.tips('error','系统繁忙,请稍后再试');
	          }
	        }
	      });
	  });
	  var feeNum;
	  //var targetAmount = $("#targetAmount");
	  var sourceAmount = $("#sourceAmount"),targetAmount = $("#targetAmount"),fee = $("#fee"),fee1 = $("#fee1"),foreignCurrencyAt_hidden=$("#foreignCurrencyAt_hidden");
	  var feeRate = $("#feeRate").val();// 用户适用的费率 add 2016-05-03
	  //var exchangeRate = $("#exchangeRate").val();
	  $("#foreignCurrencyAt").add("#h5_foreignCurrencyAt").on("input propertychange",function(){
	    var $this=$(this);
	    var r=$this.val().replace(/[^\d.]/g,"").replace(/^\./g,"").replace(/\.{2,}/g,".").replace(".","$#{1}").replace(/\./g,"").replace("$#{1}",".").replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//屏蔽非金额字符
	    $this.val(r);
	    foreignCurrencyAt_hidden.val($this.val());
	    var foreignCurrencyAt = $this.val();
	    //输入的金额乘以汇率=参考到账人民币金额
	    //targetAmount.text((foreignCurrencyAt * exchangeRate).toFixed(2));
	    //手续费费率*输入金额=手续费
	    var feeNum_temp = ll.common.accMul(foreignCurrencyAt,feeRate).toFixed(2);
	    fee.val(feeNum_temp);
	    fee1.text(feeNum_temp);
	    feeNum = feeNum_temp;
	    ///实际汇兑金额=输入金额-手续费
	    var sa=ll.common.accMul(ll.common.accSub(foreignCurrencyAt,feeNum),1).toFixed(2);
	    sourceAmount.text(sa);
	    targetAmount.text("CNY "+(sa*rate).toFixed(2));
	    //$("#targetAmount1").val(foreignCurrencyAt * exchangeRate);
	 //			$("#sourceAmount1").val(foreignCurrencyAt - feeNum);
	    $("#sourceAmount1").val(sa);

	    /*
	     * 真实
	     */
	    if(feeRate != "" && feeRate*1 < 0.012){
	      var maxCurrent=(Number($("#balance").val())>=50000 || Number($("#balance").val())==0)?50000:Number($("#balance").val());
	      var tipstext="输入金额50~50000";
	    }else{
	      var maxCurrent=(Number($("#balance").val())>=10000 || Number($("#balance").val())==0)?10000:Number($("#balance").val());
	      var tipstext="输入金额50~10000";
	    }
	    if(maxCurrent<50 && foreignCurrencyAt>=maxCurrent){
	      tipstext="余额不足";
	    }else{
	      if(feeRate != "" && feeRate*1 < 0.012){
	        if(maxCurrent<=50000 && maxCurrent>=50){
	          tipstext="输入金额"+"50~"+maxCurrent;
	        }
	      }else{
	        if(maxCurrent<=10000 && maxCurrent>=50){
	          tipstext="输入金额"+"50~"+maxCurrent;
	        }
	      }
	    }
	    if(foreignCurrencyAt!="" && foreignCurrencyAt>=50 && foreignCurrencyAt<=maxCurrent){
	      $("#feebox").removeClass("hide");
	      $("#feetips").addClass("hide");
	    }else{
	      $("#feebox").addClass("hide");
	      $("#feetips").removeClass("hide").html(tipstext);
	    }

	    /*
	     * 测试
	     *
	     *
	    var maxCurrent=(Number($("#balance").val())>=10000 || Number($("#balance").val())==0)?10000:Number($("#balance").val());
	    var tipstext="输入金额0~10000";
	    if(maxCurrent<150 && foreignCurrencyAt>=maxCurrent){
	      tipstext="余额不足";
	    }else if(maxCurrent<=10000 && maxCurrent>0){
	      tipstext="输入金额"+"0~"+maxCurrent;
	    }
	    if(foreignCurrencyAt!="" && foreignCurrencyAt>0 && foreignCurrencyAt<=maxCurrent){
	      $("#feebox").removeClass("hide");
	      $("#feetips").addClass("hide");
	    }else{
	      $("#feebox").addClass("hide");
	      $("#feetips").removeClass("hide").html(tipstext);
	    }
	    */
	    /*
	     * 测试end
	     *
	     * */


	  }).on("focus",function(){
	    var r=$("#sourceCurrency").val()+" ";
	    $(this).val($(this).val().replace(r,""));
	  }).on("blur",function(){
	    var $this=$(this);
	    if($this.val()=="") return;
	    var r=$this.val().replace(/[^\d.]/g,"").replace(/^\./g,"").replace(/\.{2,}/g,".").replace(".","$#{1}").replace(/\./g,"").replace("$#{1}",".").replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//屏蔽非金额字符
	    var r=parseFloat(r).toFixed(2);
	    $this.val(r);


	    var val=$("#foreignCurrencyAt_hidden").val();
	    if(feeRate != "" && feeRate*1 < 0.012){
	      if(val!="" && (val<50 || val>50000)){
	        $("#feetips").removeClass("c3").addClass("c1");
	      }
	    }else {
	      if(val!="" && (val<50 || val>10000)){
	        $("#feetips").removeClass("c3").addClass("c1");
	      }
	    }
	    var r=$("#sourceCurrency").val()+" ";
	    var v=$(this).val();
	    if($(this).val().indexOf(r)<0 && $(this).val()!=""){
	      if($(this).val().indexOf(".")<0){v=v+".00";}
	      $(this).val($("#sourceCurrency").val() + " " + v);
	    }
	  });
	 },
   createExchangeOrderCNH:function(){//提现
	  	var hasBalance=false;
	  	var getTime=0;
		var h5_balanceDom = $("#h5_balance");
		var is05 = $("#feeRate").val() != "" && $("#feeRate").val()*1 < 0.012;
	  window.getBalance=function(){
	    $.ajax({
	      type : "get",
	      url : "getBalance.htm?m="+Math.random(),
	      data : {},
	      dataType : "json",
	      success : function(data) {
	        hasBalance=true;
	        if(data==null){
	          if(getTime>10){
							var htm = "获取失败,<a href='javascript:;' onclick='resetGet();'>重新获取</a>";
	            $("#realbalance").removeClass("c3").html(htm);
							//H5
							if (h5_balanceDom) {
								h5_balanceDom.html(htm);
							}
	          }else{
	            getTime=getTime+1;
	            getBalance();
	          }
	        }else{
	          $("#realbalance").addClass("f18 bold").removeClass("c3").html("USD " + parseFloat(data).toFixed(2));
	          $("#balance").val(parseFloat(data).toFixed(2));
						//H5
						if (h5_balanceDom) {
							h5_balanceDom.html("USD " + parseFloat(data).toFixed(2));
						}
	        }
	      },
	      error:function(){
	        if(getTime>10){
						var htm = "获取失败,<a href='javascript:;' onclick='resetGet();'>重新获取</a>";
	          $("#realbalance").removeClass("c3").html("获取失败,<a href='javascript:;' onclick='resetGet();'>重新获取</a>");
						//H5
						if (h5_balanceDom) {
							h5_balanceDom.html(htm);
						}
	        }else{
	          getTime=getTime+1;
	          getBalance();
	        }
	      }
	    });
	  }
	  getBalance();
	  window.resetGet=function(){
	    getTime=0;
	    getBalance();
	  }
	  //获取余额
	  $("#createOrderCNH").add("#h5_createOrderCNH").on("click",function(_event){
	    if(canSend=="1001") {
	      ll.common.tips("error","请先前往绑定银行卡",2000);
	      return;
	    }
	    var balance =$("#balance").val();
	    if(balance=="" || !hasBalance){
	      ll.common.tips("error","获取余额中请稍等",1000);
	      return;
	    }
	    var foreignCurrencyAt =$("#foreignCurrencyAt_hidden").val();
	    if(foreignCurrencyAt==""){
	      ll.common.tips("error","请输入提现金额",1000);
	      return;
	    }
	    /*
	     * 真实*/
	    if(withdrawalAccount){
	      if(is05){
	        if(Number(balance)<Number(foreignCurrencyAt)||Number(foreignCurrencyAt)>50000||Number(foreignCurrencyAt)<50){
	          ll.common.tips("error","输入金额有误,请您重新输入",1000);
	          return;
	        }
	      }else{
	        if(Number(balance)<Number(foreignCurrencyAt)||Number(foreignCurrencyAt)>10000||Number(foreignCurrencyAt)<50){
	          ll.common.tips("error","输入金额有误,请您重新输入",1000);
	          return;
	        }
	      }
	    }

	    if(!$("input[name='agreeCnh']").is(":checked")){
	      ll.common.tips("error","请选择用户协议中的汇兑相关条款",1000);
	      return;
	    }
		//打点
		if (typeof(_paq)!="undefined") {
			if (!!_event.target && _event.target.id === "createOrderCNH") {
				//web
				if (is05) {
					_paq.push(['trackEvent','0.5_withdraw_action','0.5 pc提现发起页点击提现用户数']);
				}else{
					_paq.push(['trackEvent','1.2_withdraw_action','1.2 pc提现发起页点击提现用户数']);
				}
			}else {//h5
				if (is05) {
					_paq.push(['trackEvent','0.5_h5_withdraw_action','0.5 H5提现发起页点击提现用户数']);
				}else{
					_paq.push(['trackEvent','1.2_h5_withdraw_action','1.2 H5提现发起页点击提现用户数']);
				}
			}
		}
		
	      //执行
	    ll.common.ajaxForm({
	        obj:$("#createOrderCNH"),
	        url : "createExchangeOrderCNH.htm",
	        data : $("#exForm").serialize(),
	        success : function(data){
	          if (data.retcode == "0000") {
	            var id = data.id;
	            var sourceCurrency = data.sourceCurrency;
	            var foreignCurrencyAt = data.foreignCurrencyAt;
	            var account = data.account;
	            var payeeType = data.payeeType;
	            var sourceAmount = data.sourceAmount;
	            var targetCurrency = data.targetCurrency;
	            var sourceActualAmount = data.sourceActualAmount;
	            location.href = "getExchangeOrderInfoCNH.htm?exchangeOrder.id="+ id
	            + "&exchangeOrder.sourceCurrency="+ sourceCurrency+
	            "&exchangeOrder.payeeType="+ payeeType+ "&exchangeOrder.foreignCurrencyAt="
	            + foreignCurrencyAt+ "&exchangeOrder.account="
	            + account+ "&exchangeOrder.targetCurrency="+ targetCurrency+ "&exchangeOrder.sourceAmount="
	            + sourceAmount+ "&exchangeOrder.sourceActualAmount="+sourceActualAmount;
	          } else if(data.retcode == "900001"){
	            ll.common.tips('error',data.retmsg);
	          }else if(data.retcode == "900002"){
	            ll.common.tips('error',data.retmsg);
	          } else {
	            ll.common.tips('error','系统繁忙,请稍后再试');
	          }
	        }
	      });
	  });
	  var feeNum;
	  //var targetAmount = $("#targetAmount");
	  var sourceAmount = $("#sourceAmount"),targetAmountCnh = $("#targetAmountCnh"),fee = $("#fee"),fee1 = $("#fee1"),foreignCurrencyAt_hidden=$("#foreignCurrencyAt_hidden");
	  var feeRate = $("#feeRate").val();// 用户适用的费率 add 2016-05-03
	  //var exchangeRate = $("#exchangeRate").val();
	  $("#foreignCurrencyAt").add("#h5_foreignCurrencyAt").on("input propertychange",function(){
	    var $this=$(this);
	    var r=$this.val().replace(/[^\d.]/g,"").replace(/^\./g,"").replace(/\.{2,}/g,".").replace(".","$#{1}").replace(/\./g,"").replace("$#{1}",".").replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//屏蔽非金额字符
	    $this.val(r);
	    foreignCurrencyAt_hidden.val($this.val());
	    var foreignCurrencyAt = $this.val();
	    //输入的金额乘以汇率=参考到账人民币金额
	    //targetAmount.text((foreignCurrencyAt * exchangeRate).toFixed(2));
	    //手续费费率*输入金额=手续费
	    var feeNum_temp = ll.common.accMul(foreignCurrencyAt,feeRate).toFixed(2);
	    fee.val(feeNum_temp);
	    fee1.text(feeNum_temp);
	    feeNum = feeNum_temp;
	    ///实际汇兑金额=输入金额-手续费
	    var sa=ll.common.accMul(ll.common.accSub(foreignCurrencyAt,feeNum),1).toFixed(2);
	    sourceAmount.text(sa);
	    targetAmountCnh.text("CNY "+(sa*rate).toFixed(2));
	    //$("#targetAmount1").val(foreignCurrencyAt * exchangeRate);
	 //			$("#sourceAmount1").val(foreignCurrencyAt - feeNum);
	    $("#sourceAmount1").val(sa);

	    /*
	     * 真实
	     */
	    if(feeRate != "" && feeRate*1 < 0.012){
	      var maxCurrent=(Number($("#balance").val())>=50000 || Number($("#balance").val())==0)?50000:Number($("#balance").val());
	      var tipstext="输入金额50~50000";
	    }else{
	      var maxCurrent=(Number($("#balance").val())>=10000 || Number($("#balance").val())==0)?10000:Number($("#balance").val());
	      var tipstext="输入金额50~10000";
	    }
	    if(maxCurrent<50 && foreignCurrencyAt>=maxCurrent){
	      tipstext="余额不足";
	    }else{
	      if(feeRate != "" && feeRate*1 < 0.012){
	        if(maxCurrent<=50000 && maxCurrent>=50){
	          tipstext="输入金额"+"50~"+maxCurrent;
	        }
	      }else{
	        if(maxCurrent<=10000 && maxCurrent>=50){
	          tipstext="输入金额"+"50~"+maxCurrent;
	        }
	      }
	    }
	 //			var maxCurrent=(Number($("#balance").val())>=10000 || Number($("#balance").val())==0)?10000:Number($("#balance").val());
	 //			var tipstext="输入金额50~10000";
	 //			if(maxCurrent<50 && foreignCurrencyAt>=maxCurrent){
	 //				tipstext="余额不足";
	 //			}else if(maxCurrent<=10000 && maxCurrent>=50){
	 //				tipstext="输入金额"+"50~"+maxCurrent;
	 //			}
	    if(foreignCurrencyAt!="" && foreignCurrencyAt>=50 && foreignCurrencyAt<=maxCurrent){
	      $("#feebox").removeClass("hide");
	      $("#feetips").addClass("hide");
	    }else{
	      $("#feebox").addClass("hide");
	      $("#feetips").removeClass("hide").html(tipstext);
	    }
	  }).on("focus",function(){
	    var r=$("#sourceCurrency").val()+" ";
	    $(this).val($(this).val().replace(r,""));
	  }).on("blur",function(){
	    var $this=$(this);
	    if($this.val()=="") return;
	    var r=$this.val().replace(/[^\d.]/g,"").replace(/^\./g,"").replace(/\.{2,}/g,".").replace(".","$#{1}").replace(/\./g,"").replace("$#{1}",".").replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//屏蔽非金额字符
	    var r=parseFloat(r).toFixed(2);
	    $this.val(r);


	    var val=$("#foreignCurrencyAt_hidden").val();
	    if(feeRate != "" && feeRate*1 < 0.012){
	      if(val!="" && (val<50 || val>50000)){
	        $("#feetips").removeClass("c3").addClass("c1");
	      }
	    }else {
	      if(val!="" && (val<50 || val>10000)){
	        $("#feetips").removeClass("c3").addClass("c1");
	      }
	    }
	    var r=$("#sourceCurrency").val()+" ";
	    var v=$(this).val();
	    if($(this).val().indexOf(r)<0 && $(this).val()!=""){
	      if($(this).val().indexOf(".")<0){v=v+".00";}
	      $(this).val($("#sourceCurrency").val() + " " + v);
	    }
	  });
	 },
   changePassword:function(){
	   ll.validate.submit(validate.data.changePassword);
	   $("#SendMsg").off("click.send").on("click.send",function(){
		   var t=$(this).text();
		   if ($(this).hasClass("disabled")) {return;}
	      	//请求短信验证码
	      	var telephone = $("#phone").text();
	      	var that = $(this);
	      	ll.common.ajaxForm({
        		obj:$("#SendMsg"),
	  	        url: Context.base + "/account/modifyPasswordSendMsg.htm",
				beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
	      	    success:function(result) {
					$("#SendMsg").text(t);
	      	    	if (result.retcode == "0000") {
	      	    		$("#handleCode").val(result.info.handcode);
	      	    		ll.common.messageCode(that,60);
	      	    	} else {
	      	    		ll.common.tips('error',result.retmsg,3000);
	      	    	}
	      	    },
	      	    error:function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
	      	    }
	      	});
	      });
   },
   changePassword2:function(){
	   ll.validate.submit(validate.data.changePassword2);

		var base=Context.base;
		var caspType=false;
		$.getScript(base+"/js/jquery.capslockstate.js").done(function( script, textStatus ) {
			$(window).capslockstate();
	        $(window).bind("capsOn", function(event) {
	        	caspType=true;
	        });
	        $(window).bind("capsOff", function(event) {
	        	caspType=false;
	        });
		});
		$("#newPassword").on("focus keyup",function(){
			if(caspType){
				$("#pwd-ds").removeClass("hide");
			}else{
				$("#pwd-ds").addClass("hide");
			}
			var passwordVal=$(this).val();
			if(passwordVal==""){
				$("#pwd-tj1,#pwd-tj2").removeClass("icon success error");
				return;
			}
			ll.validate.reg.passWord.test(passwordVal)?$("#pwd-tj1").removeClass("error").addClass("icon success"):$("#pwd-tj1").removeClass("success").addClass("icon error");//满足6~32位
	        ll.validate.reg.passWordGruop.test(passwordVal)?$("#pwd-tj2").removeClass("error").addClass("icon success"):$("#pwd-tj2").removeClass("success").addClass("icon error");//满足三种组合
		});
   },
   changePhone1:function(){
	   ll.validate.submit(validate.data.changePhone1);
		$("#SendMsg").off("click.send").on("click.send",function(){
			var t=$(this).text();
			if ($(this).hasClass("disabled")) {return;}
	      	var that = $(this);
	      	ll.common.ajaxForm({
				obj:$("#SendMsg"),
	  	        url: Context.base + "/account/modifyPhoneSendPhoneMsg.htm",
				beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
	      	    success:function(result) {
					$("#SendMsg").text(t);
	      	    	if (result.retcode == "0000") {
	      	    		 $("#handleCode").val(result.info.handcode);
	      	    		 ll.common.messageCode(that,60);
	      	    	} else {
	      	    		ll.common.tips('error',result.retmsg,3000);
	      	    	}
	      	    },error : function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
	      	});
	      });
   },
   changePhone2:function(){
	   ll.validate.submit(validate.data.changePhone2);
	   $("#SendMsg").off("click.send").on("click.send",function(){
		   var t=$(this).text();
			var telephone = $("#phone").val();
			if(telephone == ''){
				ll.common.tips("error","请输入新的手机号码",2000);
				return;
			}
			if(!ll.validate.reg.Mobile.test(telephone)){
				ll.common.tips("error","请输入正确的手机号码",2000);
				return;
			}
			if ($(this).hasClass("disabled")) {return;}
	      	//请求短信验证码
	      	var that = $(this);
	      	ll.common.ajaxForm({
				obj:$("#SendMsg"),
	  	        url: Context.base + "/account/sendNewPhoneMsg.htm",
	      	    data: {phone:telephone},
				beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
	      	    success:function(result){
					$("#SendMsg").text(t);
	      	    	if (result.retcode == "0000") {
	      	    		$("#handleCode").val(result.info.handcode);
	      	    		ll.common.messageCode(that,60);
	      	    	} else {
	      	    		ll.common.tips('error',result.retmsg,3000);
	      	    	}
	      	    },error : function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
	      	});
	   });
   },
   changePhone3:function(){

	   ll.validate.submit(validate.data.changePhone3);
	    $("#SendEmailMsg").off("click").on("click", function() {
	    	var that = $(this);
			var email=$("#emailAddress").val();
			ll.common.ajaxForm({
				obj:$("#SendEmailMsg"),
	  	        url: Context.base + "/account/sendEmailMsg.htm",
	  	        data : {emailAddress : email},
	      	    success:function(result) {
	      	    	if (result.retcode == "0000") {
	      	    		ll.common.messageCode(that,60);
	      	    	} else {
	      	    		ll.common.tips('error',result.retmsg,3000);
	      	    	}
	      	    }
	      	});
		})
   },
   changePhone4:function(){
	   ll.validate.submit(validate.data.changePhone4);
		$("#SendMsg").off("click.send").on("click.send",function(){
			var t=$(this).text();
			var telephone = $("#phone").val();
			if(telephone == ''){
				ll.common.tips("error","请输入新的手机号码",2000);
				return;
			}
			if(!ll.validate.reg.Mobile.test(telephone)){
				ll.common.tips("error","请输入正确的手机号码",2000);
				return;
			}
			if ($(this).hasClass("disabled")) {return;}
	      	//请求短信验证码
	      	var that = $(this);
	      	ll.common.ajaxForm({
				obj:$("#SendMsg"),
	  	        url: Context.base + "/account/sendNewPhoneMsg.htm",
	      	    data: {phone:telephone},
				beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
	      	    success:function(result){
					$("#SendMsg").text(t);
	      	    	if (result.retcode == "0000") {
	      	    		$("#handleCode").val(result.info.handcode);
	      	    		ll.common.messageCode(that,60);
	      	    	} else {
	      	    		ll.common.tips('error',result.retmsg,3000);
	      	    	}
	      	    },error : function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
	      	});
	      });
   },
   login : function() {// 登录页面

		var base=Context.base;
		var caspType=false;
		$.getScript(base+"/js/jquery.capslockstate.js").done(function( script, textStatus ) {
			$(window).capslockstate();
	        $(window).bind("capsOn", function(event) {
	        	caspType=true;
	        });
	        $(window).bind("capsOff", function(event) {
	        	caspType=false;
	        });
		});
		$("#password_").on("keyup",function(){
			if(caspType){
				showmsg("大写锁定打开");
			}else{
				$("#msg-tips").hide();
			}
		});

		$("#login_submit").click(function() {
			var _uname = $("#username_"), _pwd = $("#password_"), _code = $("#code_");
			if (_uname.val() == "" && _pwd.val() == "") {
				showmsg("请输入账号和密码");
				_uname.addClass("error");
				_pwd.addClass("error");
				return;
			};
			if (_uname.val() == "") {
				showmsg("请输入账号");
				_uname.addClass("error");
				return;
			};
			if (!ll.validate.reg.login.test(_uname.val())) {
				showmsg("账号格式有误");
				_uname.addClass("error");
				return;
			};
			if (_pwd.val() == "") {
				showmsg("请输入密码");
				_pwd.addClass("error");
				return;
			};
			if (!_pwd.val().length>32 || _pwd.val()<6) {
				showmsg("密码不正确");
				_pwd.addClass("error");
				return;
			};
			if (_code.val() == "") {
				showmsg("请输入验证码");
				_code.addClass("error");
				return;
			};
			if (!ll.validate.reg.unCN.test(_code.val()) || _code.val().length > 4) {
				showmsg("验证码有误");
				_code.addClass("error");
				return;
			};
			
			typeof(_paq)!="undefined" && _paq.push(['trackEvent','login_btn','登录按钮']);
			$("#login_form").submit();
		});
		/*$("#username_,#password_,#code_").focus(function() {
			$(this).removeClass("error");
		});*/
		var showmsg = function(m) {
			var m = m || "错误";
			var error_info = '<i class="icon icon-info-s"></i>' + m;
			$("#msg-tips").size()?$("#msg-tips").show().html(error_info):$(".setting-form").prepend("<div id='msg-tips' class='tips error'>"+error_info+"</div>");
		};

		showPassword();
		showPassword("passwordr_");//和登录冲突

		//两个模块的验证码
		var properChangeFunc = function(){
			var this_=$(this);
			if(/^[a-z|A-Z|0-9]{4}$/.test($(this).val()) ){
				ll.common.ajaxForm({
							url: Context.base + "/vaditeCaptcha.htm",
							data: {code:$(this).val(),username:$('#username_').val()},
							success:function(data) {
								if(this_.next().is(".codeResult")){
									this_.next(".codeResult").remove();
								}
								if(data){
									this_.after("<span class='codeResult success'></span>");
								}else{
									this_.after("<span class='codeResult error'></span>");
								}
							}
					});
			}else if($(this).val().length<4){
						if(this_.next().is(".codeResult")){
							this_.next(".codeResult").remove();
						}
			}
		};
		$("#code_").on("input propertychange",properChangeFunc);
		$("#coder_").on("input propertychange",properChangeFunc);

		///注册部分start///////////////////////////////////////////////////////
		ll.validate.submit(validate.data.indexReg);

		var sendPhoneMsgBtn = $("#SendMsg"),
			passwordIpt = $("#passwordr_"),
			regPhone = $("#phone"),
			regSubmitBtn = $("#bindPhone"),
			regEmail = $("#emailr_"),
			regCode = $("#coder_"),
			t=sendPhoneMsgBtn.text();
			
		passwordIpt.on("focus keyup",function(){
			if(caspType){
				$("#pwd-ds").removeClass("hide");
			}else{
				$("#pwd-ds").addClass("hide");
			}
			var passwordVal=$(this).val();
			if(passwordVal==""){
				$("#pwd-tj1,#pwd-tj2").removeClass("icon success error");
				return;
			}
			ll.validate.reg.passWord.test(passwordVal)?$("#pwd-tj1").removeClass("error").addClass("icon success"):$("#pwd-tj1").removeClass("success").addClass("icon error");//满足6~32位
			ll.validate.reg.passWordGruop.test(passwordVal)?$("#pwd-tj2").removeClass("error").addClass("icon success"):$("#pwd-tj2").removeClass("success").addClass("icon error");//满足三种组合
		});
		//短信验证码是否高亮
		regPhone.on("focus keyup",function(){
			sendPhoneMsgBtn.toggleClass("enabled" , ll.validate.reg.Mobile.test(regPhone.val()))
		});
		
		//发送短信验证码
		sendPhoneMsgBtn.off("click.send").on("click.send",function() {
			var email = regEmail.val();
			var telephone = regPhone.val();
			var that = $(this);
			var t=that.text();

			// 请求短信验证码
			function sendPhoneMsgFunc (){
				ll.common.ajaxForm({
					obj:sendPhoneMsgBtn,
					url : Context.base+ "/register/sendRegisterPhoneMsg.htm",
					data : {account : email,phone : telephone},
					beforeSend:function(){
						sendPhoneMsgBtn.text("请稍后");
					},
					success : function(result) {
						sendPhoneMsgBtn.text(t);
						if (result.retcode == "0000") {
							//置灰邮箱
							regEmail.attr("readonly","readonly");
							$("#handleCode").val(result.info.handCode);
							ll.common.messageCode(that,60);
						} else {
							ll.common.tips('error',result.retmsg,2000);
						};
					},
					error : function(){
						sendPhoneMsgBtn.text(t);
						ll.common.tips('error',"验证码发送失败",2000);
					}
				});
			}

			if ($(this).hasClass("disabled")) {return;}
			if( telephone==="" || !ll.validate.reg.Mobile.test(telephone)){
				return;
			}
			if( email==="" || !ll.validate.reg.Email.test(email) ){
				ll.common.tips("error","请输入正确的电子邮箱",1000);
				return;
			}
			if( regCode.val()===""){
				ll.common.tips("error","请填写验证码",1000);
				return;
			}
			//先验证邮箱和验证码
			ll.common.ajaxForm({
				obj:$("#bindPhone"),
				url : Context.base + "/register/validateImageCode.htm",
				data : $("#register").serialize(),
				success : function(data) {
					if (data.retcode == "0000") {
						sendPhoneMsgFunc();
					} else {
						refresh(['valir','vali']);
						regCode.val("");
						ll.common.tips('error', data.retmsg,2000);
					}
				}
			});
			
		});
		new EmailAutoComplete({
				targetCls:"#emailr_",
				parentCls:".row"
			});

		//介绍视频
		clickToShowVideoDialog($("#register-video-dialog"));
		//// 注册部分END////////////////////////////////////////////////////////
	},
	reg : function() {
		ll.validate.submit(validate.data.reg);
		var base=Context.base;
		var caspType=false;
		$.getScript(base+"/js/jquery.capslockstate.js").done(function( script, textStatus ) {
			$(window).capslockstate();
	        $(window).bind("capsOn", function(event) {
	        	caspType=true;
	        });
	        $(window).bind("capsOff", function(event) {
	        	caspType=false;
	        });
		});
		$("#password_").on("focus keyup",function(){
			if(caspType){
				$("#pwd-ds").removeClass("hide");
			}else{
				$("#pwd-ds").addClass("hide");
			}
			var passwordVal=$(this).val();
			if(passwordVal==""){
				$("#pwd-tj1,#pwd-tj2").removeClass("icon success error");
				return;
			}
			ll.validate.reg.passWord.test(passwordVal)?$("#pwd-tj1").removeClass("error").addClass("icon success"):$("#pwd-tj1").removeClass("success").addClass("icon error");//满足6~32位
	        ll.validate.reg.passWordGruop.test(passwordVal)?$("#pwd-tj2").removeClass("error").addClass("icon success"):$("#pwd-tj2").removeClass("success").addClass("icon error");//满足三种组合
		});
		$("#reSentEmail").off("click").on("click",function(){
			var param=$("#reSentEmail").data("element");
			 ll.common.ajaxForm({
			        url: Context.base + "/register/reSendEmail.htm",
		   	    	data: {account:param},
		   	    	beforeSend:function(){
			   	    	 ll.common.tips('wait','正在发送邮件',2000);
		   	    	},
		   	    	success:function(data) {
			   	     if (data.retcode == "0000") {
			   	    	 ll.common.tips('success','邮件发送成功',2000);
			   	       } else {
			   	    	 ll.common.tips('error',data.retmsg,2000);
			   	       }
		   	     	}
		   		});
		});
		// 删除注册信息
		$("#reRegister").off("click").on("click",function(){
			var con=['<div class="pd">',
					 '<i class="icons icons-m-info"></i><p class="info-text">点击确定后，你当前注册的账户将失效不可再使用，是否确认继续？</p>',
					 '</div>'].join("");
			ll.dialog.confirm({title:'提示',content:con,width:600,lock:true,ok:function(){
				var account=$("#reRegister").data("element");
				var UUID=$("#reRegister").data("element2");
				ll.common.ajaxForm({
					url: Context.base + "/account/cancel_user.action",
					data: {account:account,UUID:UUID},
					success:function(data) {
						if (data.errorCode == "000000") {
							location.href = Context.base + "/register/registerPage.htm";
						} else if (data.errorCode == "000505") {
							location.href = Context.base + "/account/page505.action";
						} else {
							ll.common.tips('error',data.errorMessage,2000);
						}
					}
				});
			}});
		});
		showPassword();

		//yanzhengma
		$("#code_").on("input propertychange",function(){
			if(/^[a-z|A-Z|0-9]{4}$/.test($(this).val()) ){
				ll.common.ajaxForm({
			        url: Context.base + "/vaditeCaptcha.htm",
		   	    	data: {code:$(this).val(),username:$('#username_').val()},
		   	    	success:function(data) {
		   	    		$("#code_").next(".code-msg").remove();
		   	    		if(data){
		   	    			$("#code_").after("<span class='code-msg'><i class='icons icons-s-yes'></i></span>");
		   	    		}else{
		   	    			$("#code_").after("<span class='code-msg'><i class='icons icons-s-fail'></i></span>");
		   	    		}
		   	     	}
		   		});
			}else if($(this).val().length<4){
   	    		$("#code_").next(".code-msg").remove();
			}
		});
		new EmailAutoComplete({
		    targetCls:"#email_",
		    parentCls:".row"
		  });
	},

	modifyPassword : function() {
		ll.validate.submit(validate.data.modifyPassword);
		$("#reSendMeg").off("click").on("click", function(){
			ll.common.ajaxForm({
				url : Context.base + "/password/reSendEmail.htm",
				data : {
					account : $(this).attr("data-element")
				},
	   	    	beforeSend:function(){
		   	    	 ll.common.tips('wait','正在发送邮件',2000);
	   	    	},
				success : function(data) {
					if (data.retcode == "0000") {
						ll.common.tips('success', '邮件发送成功',2000);
					} else {
						ll.common.tips('error', data.retmsg,2000);
					}
				}
			});
		});
	},
	modifyPassword2 : function() {
		ll.validate.submit(validate.data.modifyPassword2);

		var base=Context.base;
		var caspType=false;
		$.getScript(base+"/js/jquery.capslockstate.js").done(function( script, textStatus ) {
			$(window).capslockstate();
	        $(window).bind("capsOn", function(event) {
	        	caspType=true;
	        });
	        $(window).bind("capsOff", function(event) {
	        	caspType=false;
	        });
		});
		$("#password_").on("focus keyup",function(){
			if(caspType){
				$("#pwd-ds").removeClass("hide");
			}else{
				$("#pwd-ds").addClass("hide");
			}
			var passwordVal=$(this).val();
			if(passwordVal==""){
				$("#pwd-tj1,#pwd-tj2").removeClass("icon success error");
				return;
			}
			ll.validate.reg.passWord.test(passwordVal)?$("#pwd-tj1").removeClass("error").addClass("icon success"):$("#pwd-tj1").removeClass("success").addClass("icon error");//满足6~32位
	        ll.validate.reg.passWordGruop.test(passwordVal)?$("#pwd-tj2").removeClass("error").addClass("icon success"):$("#pwd-tj2").removeClass("success").addClass("icon error");//满足三种组合
		});
	},
   submitExchangeOrder:function(){//确认提现
	   $("#SendMsg").add("#h5_SendMsg").on("click",function(){
		   var t=$(this).text();
			if ($(this).hasClass("disabled")) {return;}
			var $that=$(this);
			var foreignCurrencyAt=$("#foreignCurrencyAt").val();
			ll.common.ajaxForm({
				obj:$that,
	            url:"sendMsg.htm",
	            data:"foreignCurrencyAt="+foreignCurrencyAt,
				beforeSend:function(){
					$that.text("请稍后");
				},
	            success: function(data){
					$that.text(t);
	            	if (data.ret_code == '0000'){
	            		$("#handleCode").val(data.ret_msg);
	            		ll.common.messageCode($that,60);
	            	}else{
	            		ll.common.tips('fail',data.ret_msg);
	            	}
	            },error : function(){
					$that.text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
	        });
	   });
	   ll.common.messageCode($("#SendMsg"),60);
	   ll.common.messageCode($("#h5_SendMsg"),60);//h5
		$("#submitOrder").add("#h5_submitOrder").on("click",function(){
	 		if ($(this).hasClass("disabled")) {return;}
			var that=$(this).next("a");
			that.hide();
			var merchantNumber=document.getElementById("merchantNumber").value;
			var payeeType=document.getElementById("payeeType").value;
			var sourceCurrency=document.getElementById("sourceCurrency").value;
			var foreignCurrencyAt=document.getElementById("foreignCurrencyAt").value;
			var foreignCurrencyFeeAt=document.getElementById("foreignCurrencyFeeAt").value;
			var id=document.getElementById("id").value;
			var verificateCode=document.getElementById("verificateCode").value;
			var handleCode=document.getElementById("handleCode").value;
			var orderStr=document.getElementById("orderStr").value;
			//h5验证码
			if($(this).attr("id") === "h5_submitOrder") {
				verificateCode=document.getElementById("h5_verificateCode").value;
			}
			if (!verificateCode) {
					ll.common.tips('error',"请填写验证码");
					return;
			}
			//执行
			var _successf = function(data){
				that.show();
				if (data.ret_code == "0000") {
					location.href="index.htm?status="+data.ret_msg;
				}else if(data.ret_code == "900005"){
							ll.common.tips('error',data.ret_msg);
					}else if(data.ret_code == "900001"){
							ll.common.tips('error',data.ret_msg);
					}else if(data.ret_code == "900004"){
							ll.common.tips('error',data.ret_msg);
					}else if(data.ret_code == "900002"){
							ll.common.tips('error',data.ret_msg);
					}else if(data.ret_code == "900008"){
					ll.common.tips('error',data.ret_msg);
				}else if(data.ret_code == "900006"){
					ll.common.tips('error',"订单已经成功提交,请勿重复提交");
				}else if(data.ret_code == "900007"){
					ll.common.tips('error',"订单已经成功提交,请勿重复提交");
				}else if(data.ret_code == "999999"){
					var strs= new Array(); //定义一数组
					strs=data.ret_msg.split(","); //字符分割
					location.href="error.htm?errorCode="+strs[0]+"&errorMsg="+strs[1];
				}else if(data.ret_code == "777777"){
					//如果超额，走新的错误页面
					location.href="error_limit.htm?&errorMsg="+data.ret_msg;
				}else{
					ll.common.tips('error',"系统繁忙,请您稍后重试");
				}
		};
		var _errorf = function(data){
			ll.common.tips('error',"系统繁忙,请您刷新后重试");
			that.show();
		 }
		 var _url = "submitExchangeOrder.htm";
		 var _data = "exchangeOrder.merchantNumber="+merchantNumber+"&exchangeOrder.payeeType="+payeeType
		 +"&exchangeOrder.sourceCurrency="+sourceCurrency+"&exchangeOrder.foreignCurrencyAt="+foreignCurrencyAt
		 +"&exchangeOrder.id="+id+"&exchangeOrder.fee="+foreignCurrencyFeeAt+"&handleCode="+handleCode+"&verificateCode="+verificateCode+"&orderStr="+orderStr;

			//h5点击事件
			if($(this).attr("id") === "h5_submitOrder") {
				ll.common.ajaxForm({
					obj:$("#h5_submitOrder"),
		            url:_url,
		            data:_data,
		            success:	_successf,
				    		error: _errorf
				});
			}else{
				//PC
				ll.common.ajaxForm({
					obj:$("#submitOrder"),
		            url:_url,
		            data:_data,
		            success:_successf,
				    		error: _errorf
				});
			}

		});
   },
   submitExchangeOrderCNH:function(){//确认提现
	   $("#SendMsgCNH").add("#h5_SendMsgCNH").on("click",function(){
		   var t=$(this).text();
			if ($(this).hasClass("disabled")) {return;}
			var $that=$(this);
			var foreignCurrencyAt=$("#foreignCurrencyAt").val();
			ll.common.ajaxForm({
				obj:$that,
	            url:"sendMsg.htm",
	            data:"foreignCurrencyAt="+foreignCurrencyAt,
				beforeSend:function(){
					$that.text("请稍后");
				},
	            success: function(data){
					$that.text(t);
	            	if (data.ret_code == '0000'){
	            		$("#handleCode").val(data.ret_msg);
	            		ll.common.messageCode($that,60);
	            	}else{
	            		ll.common.tips('fail',data.ret_msg);
	            	}
	            },error : function(){
					$that.text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
	        });
	   });
	   ll.common.messageCode($("#SendMsgCNH"),60);
	   ll.common.messageCode($("#h5_SendMsgCNH"),60);//h5
		$("#submitOrderCNH").add("#h5_submitOrderCNH").on("click",function(){
	 		if ($(this).hasClass("disabled")) {return;}
			var that=$(this).next("a");
			that.hide();
			var merchantNumber=document.getElementById("merchantNumber").value;
			var payeeType=document.getElementById("payeeType").value;
			var sourceCurrency=document.getElementById("sourceCurrency").value;
			var foreignCurrencyAt=document.getElementById("foreignCurrencyAt").value;
			var foreignCurrencyFeeAt=document.getElementById("foreignCurrencyFeeAt").value;
			var id=document.getElementById("id").value;
			var verificateCode=document.getElementById("verificateCode").value;
			var handleCode=document.getElementById("handleCode").value;
			var orderStr=document.getElementById("orderStr").value;
			//h5验证码
			if($(this).attr("id") === "h5_submitOrderCNH") {
				verificateCode=document.getElementById("h5_verificateCode").value;
			}
			if (!verificateCode) {
					ll.common.tips('error',"请填写验证码");
					return;
			}
			//执行
			var _successf = function(data){
				that.show();
				if (data.ret_code == "0000") {
					location.href="index.htm?status="+data.ret_msg;
				}else if(data.ret_code == "900005"){
						ll.common.tips('error',data.ret_msg);
				}else if(data.ret_code == "900001"){
						ll.common.tips('error',data.ret_msg);
				}else if(data.ret_code == "900004"){
						ll.common.tips('error',data.ret_msg);
				}else if(data.ret_code == "900002"){
						ll.common.tips('error',data.ret_msg);
				}else if(data.ret_code == "900008"){
					ll.common.tips('error',data.ret_msg);
				}else if(data.ret_code == "900006"){
					ll.common.tips('error',"订单已经成功提交,请勿重复提交");
				}else if(data.ret_code == "900010"){
					var con="<div class='pd'><i class='info-icon icons icons-b-info'></i><p class='info-text'>尊敬的PayPal用户，根据中国相关法规的要求，我们需要配合监管对跨境资金的贸易真实性进行核实。由于您未在我们要求的时间内提供相关资料，我们暂停了您的PayPal快捷人民币提现服务。请尽快查看我们由LLP_XBoarder@yintong.com.cn 邮箱发送的邮件并配合提供相关的材料。资料提交核实通过后，您的PayPal快捷人民币提现服务会被恢复。如有疑问，请致电400-091-0999联系连连客服人员。</p></div>"
					ll.dialog.simple({title : '提示',content :con,width : 680,lock : true,
						buttons : [{
								value:"知道了",
								handle:function(o){
									ll.dialog.close(o);
								}
								}]
					});
					
				}else if(data.ret_code == "999999"){
					var strs= new Array(); //定义一数组
					strs=data.ret_msg.split(","); //字符分割
					location.href="error.htm?errorCode="+strs[0]+"&errorMsg="+strs[1];
				}else if(data.ret_code == "777777"){
					//如果超额，走新的错误页面
					location.href="error_limit.htm?errorMsg="+data.ret_msg;
				}else{
					ll.common.tips('error',"系统繁忙,请您稍后重试");
				}
		};
	  var _errorf = function(data){
			ll.common.tips('error',"系统繁忙,请您刷新后重试");
			that.show();
		};
		var _url = "submitExchangeOrderCNH.htm";
		var _data = "exchangeOrder.merchantNumber="+merchantNumber+"&exchangeOrder.payeeType="+payeeType
		+"&exchangeOrder.sourceCurrency="+sourceCurrency+"&exchangeOrder.foreignCurrencyAt="+foreignCurrencyAt
		+"&exchangeOrder.id="+id+"&exchangeOrder.fee="+foreignCurrencyFeeAt+"&handleCode="+handleCode+"&verificateCode="+verificateCode+"&orderStr="+orderStr;

			 //h5点击事件
			 if($(this).attr("id") === "h5_submitOrderCNH") {
				 if (feeRate === "1.2%") {
					 typeof(_paq)!="undefined" && _paq.push(['trackEvent','1.2_h5_withdraw_confirm','1.2 H5提现确认页点击确认提现用户数']);
				 }else {
					typeof(_paq)!="undefined" && _paq.push(['trackEvent','0.5_h5_withdraw_confirm','0.5 H5提现确认页点击确认提现用户数']);
				 }

				 ll.common.ajaxForm({
					 obj:$("#h5_submitOrderCNH"),
							url:_url,
							data:_data,
							success:_successf,
							error: _errorf
				});
			 }else{
		     	//PC
				 if (feeRate === "1.2%") {
					 typeof(_paq)!="undefined" && _paq.push(['trackEvent','1.2_withdraw_confirm','1.2 pc提现确认页点击确认提现用户数']);
				 }else {
					typeof(_paq)!="undefined" && _paq.push(['trackEvent','0.5_withdraw_confirm','0.5 pc提现确认页点击确认提现用户数']);
				 }
				 
				 ll.common.ajaxForm({
					 obj:$("#submitOrderCNH"),
	            url:_url,
	            data:_data,
	            success:_successf,
			    		error: _errorf
				});
			 }
		});
   },
   verifyInformationSwitchType : function() {
	   ll.validate.submit(validate.data.verifyInformationSwitchType);
		$("#SendMsg").off("click.send").on("click.send",function(){
			var t=$(this).text();
			if ($(this).hasClass("disabled")) {return;}
	      	var that = $(this);
	      	ll.common.ajaxForm({
				obj:$("#SendMsg"),
	  	        url: Context.base + "/account/verifyInformationSendPhoneMsg.htm",
				beforeSend:function(){
					$("#SendMsg").text("请稍后");
				},
	      	    success:function(result) {
					$("#SendMsg").text(t);
	      	    	if (result.retcode == "0000") {
	      	    		 $("#handleCode").val(result.info.handcode);
	      	    		 ll.common.messageCode(that,60);
	      	    	} else {
	      	    		ll.common.tips('error',result.retmsg,3000);
	      	    	}
	      	    },error : function(){
					$("#SendMsg").text(t);
					ll.common.tips('error',"验证码发送失败",2000);
				}
	      	});
	      });
   }


};
/*点击眼睛显示密码，找眼睛节点的所有兄弟节点中的input
*@param id_ 默认是id为password_
 */
function showPassword(id_){
	var passwordDom;
	if (id_) {
		passwordDom = $("#"+id_);
	}
	else{
		passwordDom = $("#password_");
	}
	var showpass=$("<span class='code-msg'><i class='icons icons-eye'></i></span>").insertAfter(passwordDom).hide().on("mousedown",function(){
		$(this).prevAll("input").attr("type","text");
	}).on("mouseup",function(){
		$(this).prevAll("input").attr("type","password");
	});
	passwordDom.on("keyup",function(){
		if($(this).val()!=""){
			showpass.css({display:"inline-block"});
		}else{
	    		passwordDom.next(".code-msg").hide();

		}
	});
}

/*显示视频弹框
*@param url_ 视频地址
 */
function showVideoDialog(url_){
	if (!url_) {
		return;
	}
	var con='<div class="pd">\
	<video id="videoElem" class="video-js" controls autoplay preload="auto" width="660" height="370px"\
   data-setup="{}">\
    <source src="'+url_+'" type="video/mp4">\
    <p class="vjs-no-js">\
      To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video\
    </p>\
  </video>\
	</div>';
	ll.dialog.simple({title:'',content:con,width:700,lock:true,move:true,clazz:"dplayerP",load:function(){
		videojs('videoElem');
	},
	destroyFunc:function(){
		videojs('videoElem').dispose();
	}});
}
/*点击显示视频弹框
*@param nodes_ 按钮节点列表，可传数组或单个节点，null为直接显示弹框,节点带上url数据
*@param url_ 视频地址，默认不传
 */
function clickToShowVideoDialog(nodes_,url_){
	var videoUrl;
	if (!nodes_) {
		showVideoDialog(url_);
		return;
	}

	if (ll.common.isArray(nodes_)) {
		for (var i = 0; i < nodes_.length; i++) {
			nodes_[i].click(function(){
				videoUrl = $(this).data("url");
				showVideoDialog(videoUrl);
			});
		}
		return;
	}else {
		nodes_.click(function(){
			videoUrl = $(this).data("url");
			showVideoDialog(videoUrl);
		});
	}

}
