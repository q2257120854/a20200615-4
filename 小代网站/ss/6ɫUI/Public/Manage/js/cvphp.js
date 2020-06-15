// JavaScript Document
function CvPHP(){
	this.post = function(url,data,callback){
		var shade_index = layer.load(1, {shade: [0.1,'#fff']});
        $.ajax({
            type: 'POST',
            async: true,
            data: data,
            url: url,
            dataType:'json',
            success: function(d,state){
            	layer.close(shade_index);
            	if(state!='success'){
            		layer.msg("请求数据出错");
            	}else{
            		callback(d);
            	}
            },
            error: function(e){
            	layer.close(shade_index);
                layer.msg("发起请求出错" + e)
            }
        });
	},
	this.get = function(url,data,callback){
		var shade_index = layer.load(1, {shade: [0.1,'#fff']});
        $.ajax({
            type: 'GET',
            async: true,
            data: data,
            url: url,
            dataType:'json',
            success: function(d,state){
            	layer.close(shade_index);
            	if(state!='success'){
            		layer.msg("请求数据出错");
            	}else{
            		callback(d);
            	}
            },
            error: function(e){
            	layer.close(shade_index);
                layer.msg("发起请求出错" + e)
            }
        });
	},
	this.submit = function(obj,callback){
		var shade_index = layer.load(1, {shade: [0.1,'#fff']});
		$(obj).ajaxSubmit({
			type: $(obj).attr('method'),
			success:function(data){
				layer.close(shade_index);
				callback(data);
			}
		});
		//$(obj).resetForm();
	}
}

cvphp = new CvPHP();
