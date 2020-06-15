function checkForm() {
	var numvalue = $("#numberjx").val();
	if($("[name='birthday']").val() == ""){
                layer.msg("请选择出生日期");
                return false;
            }
            if(numvalue == ""){
                layer.msg("请输入解析的号码");
                return false;
            }
            if($('._select').val() == 1){
                if(!/^[1][3,4,5,7,8][0-9]{9}$/.test(numvalue)){
                    layer.msg("手机号码输入有误");
                    return false;
                }
                $("[name='numberjx_e']").val(numvalue);
            }else if($('._select').val() == 2){
                if(!isVehicleNumber(numvalue)){
                    layer.msg("车牌号输入有误");
                    return false;
                }
                $("[name='numberjx_e']").val(numvalue.substring(1,numvalue.length));
            }
            
	
}