/**
 * JavaScript inputSuggest v0.1
 * Copyright (c) 2010 snandy
 * Blog: http://snandy.javaeye.com/
 * QQ群: 34580561
 * Date: 2010-09-25 
 * Download by http://down.liehuo.net
 * 
 * new InputSuggest({
 * 	  input 		HTMLInputElement 必选
 * 	  data 			Array ['sina.cn','sina.com','2008.sina.com','vip.sina.com.cn'] 必选
 * 	  containerCls	容器className
 * 	  itemCls		容器子项className
 * 	  activeCls		高亮子项className
 * 	  width 		宽度设置 此项将覆盖containerCls的width
 *    opacity		透明度设置 此项将覆盖containerCls的opacity
 * });
 */

function InputSuggest(opt){
	this.win = null;
	this.doc = null;	
	this.container = null;
	this.items = null;
	this.input = opt.input || null;
	this.containerCls = opt.containerCls || 'suggest-container';
	this.itemCls = opt.itemCls || 'suggest-item';
	this.activeCls = opt.activeCls || 'suggest-active';
	this.width = opt.width;
	this.opacity = opt.opacity;
	this.data = opt.data || [];
	this.active = null;
	this.visible = false;
	this.initFun = opt.initFun || function(){} ;//初始化前执行的函数
	this.init();
}
InputSuggest.prototype = {
	init: function(){
		this.win = window;
		this.doc = window.document;
		this.container = this.$C('div');
		this.attr(this.container, 'class', this.containerCls);				
		this.doc.body.appendChild(this.container);
		this.setPos();
		var _this = this, input = this.input;		

		this.on(input,'keyup',function(e){ 
			_this.setPos();	 
			if(input.value==''){
				_this.hide();
			}else{
				_this.onKeyup(e);
			}
			_this.initFun(); //执行第一步数据
			
		});
		// blur会在click前发生，这里使用mousedown
		this.on(input,'blur',function(e){
			_this.hide();			
		});
		this.onMouseover();
		this.onMousedown();
		
	},
	$C: function(tag){
		return this.doc.createElement(tag);
	},
	getPos: function (el){  
		var pos=[0,0], a=el;
		if(el.getBoundingClientRect){
			var box = el.getBoundingClientRect(); 
			pos=[box.left,box.top+this.getScorllTop()];
		}else{
			while(a && a.offsetParent){
				pos[0] += a.offsetLeft;
				pos[1] += a.offsetTop;
				a = a.offsetParent
			}	 
			pos[1] += this.getScorllTop() 
		}
		return pos;
	},	
	setPos: function(){
		var input = this.input, 
			pos = this.getPos(input), 
			brow = this.brow, 
			width = this.width,
			opacity = this.opacity,
			container = this.container;
		container.style.cssText =
			'position:absolute;overflow-y:scroll;left:' 
			+ pos[0] + 'px;top:'
			+ (pos[1]+input.offsetHeight) + 'px;width:'
			// IE6/7/8/9/Chrome/Safari input[type=text] border默认为2，Firefox为1，因此取offsetWidth-2保证与FF一致
			+ (brow.firefox ? input.clientWidth : input.offsetWidth-2) + 'px;';
		if(width){
			container.style.width = width + 'px';
		}
		if(opacity){
            if(this.brow.ie){
                container.style.filter = 'Alpha(Opacity=' + opacity * 100 + ');';
            }else{
                container.style.opacity = (opacity == 1 ? '' : '' + opacity);
            }			
		}
	},
	show: function(){
		this.container.style.visibility = 'visible';
		this.visible = true;
	},
	hide: function(){
		this.active = null;
		this.container.style.visibility = 'hidden';
		this.visible = false;	
	},
	attr: function(el, name, val){
		if(val === undefined){
			return el.getAttribute(name);
		}else{
			el.setAttribute(name,val);
			name=='class' && (el.className = val);			
		}
	},
    on: function(el, type, fn){
    	el.addEventListener ? el.addEventListener(type, fn, false) : el.attachEvent('on' + type, fn);
    },
    un: function(el, type, fn){
    	el.removeEventListener ? el.removeEventListener(type, fn, false) : el.detachEvent('on' + type, fn);
    },
	brow: function(ua){
		return {
			ie: /msie/.test(ua) && !/opera/.test(ua),
			opera: /opera/.test(ua),
			firefox: /firefox/.test(ua)
		};
	}(navigator.userAgent.toLowerCase()),
	onKeyup: function(e){
		var container = this.container, input = this.input, iCls = this.itemCls, aCls = this.activeCls;
		if(this.visible){window.status = e.keyCode
			switch(e.keyCode){
				case 13: // Enter
					if(this.active){
						input.value = this.active.firstChild.data;
						this.hide();
					}					
					return;
				case 38: // 方向键上
					if(this.active==null){
						this.active = container.lastChild;
						this.attr(this.active, 'class', aCls);
						input.value = this.active.firstChild.data;
					}else{
						if(this.active.previousSibling!=null){
							this.attr(this.active, 'class', iCls);
							this.active = this.active.previousSibling;
							this.attr(this.active, 'class', aCls);
							input.value = this.active.firstChild.data;
						}else{
							this.attr(this.active, 'class', iCls);
						    this.active = null;
						    input.focus();
							input.value = input.getAttribute("curr_val");
						}
					}
					return;
				case 40: // 方向键下
				    if(this.active==null){
			            this.active = container.firstChild;
						this.attr(this.active, 'class', aCls);
						input.value = this.active.firstChild.data;
						 
			        }else{			
			    		if(this.active.nextSibling!=null){
							this.attr(this.active, 'class', iCls);
			    			this.active = this.active.nextSibling;
							this.attr(this.active, 'class', aCls);
							input.value = this.active.firstChild.data;
			   			}else{
							this.attr(this.active, 'class', iCls);
			                this.active = null;
			                input.focus();
							input.value = input.getAttribute("curr_val");
			            }
			        }
					return;

			}
		
		}	
		if(e.keyCode==27){ // ESC键
			this.hide();
			input.value = this.attr(input,'curr_val');
			return;
		}	
		if(input.value.indexOf('@')!=-1){return;}
		this.items = [];
		
		if(this.attr(input,'curr_val')!=input.value){
			this.container.innerHTML = '';
			for(var i=0,len=this.data.length;i<len;i++){
				var item = this.$C('div');
				this.attr(item, 'class', this.itemCls);
				item.innerHTML = input.value + '@' + this.data[i];
				this.items[i] = item;
				this.container.appendChild(item);
			}
			this.attr(input,'curr_val',input.value);		
		}

		this.show();
					
	},
	onMouseover: function(){
		var _this = this, icls = this.itemCls, acls = this.activeCls;
		this.on(this.container,'mouseover',function(e){
			var target = e.target || e.srcElement;
			if(target.className == icls){
				if(_this.active){
					_this.active.className = icls;					
				}
				target.className = acls;
				_this.active = target;

			}
		});
	},
	onMousedown: function(){
		var _this = this;	
		this.on(this.container,'mousedown',function(e){
			var target = e.target || e.srcElement;
			_this.input.value = target.innerHTML;
			_this.hide();
		});
	},
	getScorllTop : function(){
		var top = 0;     
		if (typeof window.pageYOffset != 'undefined') {    
			top = window.pageYOffset;    
		}else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat'){    
			top = document.documentElement.scrollTop;    
		}else if (typeof document.body != 'undefined') {    
			top = document.body.scrollTop;    
		}  
		return top
	}
}	

