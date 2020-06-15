(function(){
	var Ajax = window.Ajax = function(opt) {
		if(opt.form){
			Ajax.fn.postf(opt);
		}else {
			Ajax.fn.Do(opt);
		}
	};
	Ajax.Setting={
		asc: true,
		url: "",
		dataType: "text",
		method: "GET",
		data: "",
		timeout:10000,
		onlySend:false,
		charset:"GB2312",
		succeed: function(a,b,c){return true},
		error: function(a,b,c){return true},
		ontimeout:function(a){return true}
	};
	Ajax.fn = Ajax.prototype = {
		Do:function(options){
			var settings = Ajax.Setting;
			if(options) {
				settings = Ajax.fn.Ajax_Extend(settings, options);
			}
			var isTimeout=false;
			var s=settings;
			s.method = s.method.toUpperCase();
			s.charset = s.charset.toLowerCase();
			var a=Ajax.fn.Ajax_GetObj();
			var u=s.url;
			var b=u.indexOf("?") == -1 ? false:true;
			u= b ? u + "&aienrnd=" + Ajax.fn.Ajax_Rnd() : u + "?aienrnd=" + Ajax.fn.Ajax_Rnd();
			if(s.method=="GET"){
				u=s.data=="" ? u : u + "&" + s.data;
			}
			var d=null;
			if(s.method=="POST"){
				d=s.data
			}
			a.open(s.method,u,s.asc); 
			if(s.method=="POST"){
				a.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			}
			if(!s.onlySend){
				window.setTimeout(function(){isTimeout=true;},s.timeout);
				a.onreadystatechange =function(){
					if(isTimeout){
						s.ontimeout();
						a.abort();
						a=null;	
						return;
					}
					if(a.readyState==4){
						if(a.status==200){
							var t=s.dataType.toLowerCase();
							if(t=="text"){
									s.succeed(a.responseText,a,s);
							}
							if(t=="xml"){
								s.succeed(a.responseXML,a,s);
								}
							if(t=="json"){
								try{
									eval("j=" + a.responseText);
								}catch(ex){
									j = null;
								}
								s.succeed(j,a,s);
							}
							a=null;
						}else {
							s.error(a.status,a,s);
							a=null;
						}
					}
				};
			}
			a.send(d);
			if(!s.onlySend){
				if(!(navigator.appName=='Microsoft Internet Explorer')){
					if(a.readyState==4){
						if(a.status==200){
							var t=s.dataType.toLowerCase();
							if(t=="text"){
								s.succeed(a.responseText,a,s);
							}
							if(t=="xml"){
								s.succeed(a.responseXML,a,s);
							}
							if(t=="json"){
								eval("j=" + a.responseText);
								s.succeed(j,a,s);
							}
							a=null;
						}else {
							s.error(a.status,a,s);
							a=null;
						}
					}
				}
			}
		},
		Ajax_GetObj:function (){
			var b=null;
			if (window.ActiveXObject) {
				var httplist = ["MSXML2.XMLHttp.5.0","MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0","MSXML2.XMLHttp","Microsoft.XMLHttp"];
				for(var i = httplist.length -1;i>=0;i--){
					try{
						b= new ActiveXObject(httplist[i]);
						return b;
					}catch(ex){}
				}
			}else if (window.XMLHttpRequest) {
				b= new XMLHttpRequest(); 
			}
			return b;
		},
		Ajax_Rnd :function (){return Math.random().toString().substr(2);},
		Ajax_Extend:function (a, b){var c={};for(var m in a){c[m]=a[m];}for(var m in b){c[m]=b[m];}return c;}
	};
	
	Ajax.get = Ajax.fn.get=function(url,data,fn){
		var setting = Ajax.Setting;
		setting.url = url;
		setting.data = data;
		setting.succeed = fn;
		Ajax.fn.Do(setting);
	};
	Ajax.post = Ajax.fn.post=function(url,data,fn){
		var setting = Ajax.Setting;
		setting.url = url;
		setting.data = data;
		setting.succeed = fn;
		setting.method="post";
		Ajax.fn.Do(setting);
	};
	Ajax.Serializ=Ajax.fn.Serializ=function(nodes,charset){
		charset = charset.toLowerCase();
		var data="";
		for(var i=0;i<nodes.length;i++){
			if(nodes[i].name.trim()==""){continue;}
			if(nodes[i].type.toLowerCase()=="checkbox"){
				if(nodes[i].checked==true){
					if(charset=="GB2312"){
						data += nodes[i].name.utf8() + "=" + (nodes[i].value.trim()=="" ? "on": nodes[i].value.utf8()) + "&";
					}else {
						data += nodes[i].name.gb() + "=" + (nodes[i].value.trim()=="" ? "on": nodes[i].value.gb()) + "&";
					}
				}
			}else if(nodes[i].type.toLowerCase()=="radio"){
				if(nodes[i].checked==true){
					if(charset=="GB2312"){
						data += nodes[i].name.utf8() + "=" + (nodes[i].value.trim()=="" ? "on": nodes[i].value.utf8()) + "&";
					}else {
						data += nodes[i].name.gb() + "=" + (nodes[i].value.trim()=="" ? "on": nodes[i].value.gb()) + "&";
					}
				}
			}else {
				if(charset=="GB2312"){
					data += nodes[i].name.utf8() + "=" + nodes[i].value.utf8() + "&";
				}else {
					data += nodes[i].name.gb() + "=" + nodes[i].value.gb() + "&";	
				}
			}			
		}
		return data;
	};
	Ajax.postf = Ajax.fn.postf=function(setting){
		setting = Ajax.fn.Ajax_Extend(Ajax.Setting, setting);
		frm = setting.form;
		frm.onsubmit=function(){return false;};
		if(frm.nodeName.toLowerCase()!="form" || frm.method=="" || frm.action==""){return false;}
		setting.url = frm.action;
		setting.method = frm.method;
		var data="";
		data = Ajax.Serializ(frm,setting.charset);
		if(data!=""){
			data = data.substr(0,data.length-1);
		}
		setting.data = data;
		Ajax.fn.Do(setting);
		return false;
	};
	String.prototype.gb=function(){
		return escape(this.toString());
	};
	String.prototype.utf8=function(){
		return encodeURIComponent(this.toString());
	};
	String.prototype.unUtf8=function(){
		return decodeURIComponent(this.toString());
	};
	String.prototype.reg=function(r){
		return r.test(this.toString());
	};
	String.prototype.trim=function(){
		return this.toString().replace(/(^\s*)|(\s*$)/g,"");
	};
})();