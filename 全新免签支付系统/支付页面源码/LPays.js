$('.pop-up').addClass('open');
function countTime() {  
    //获取当前时间  
    var date = new Date();  
    var now = date.getTime();  
    //时间差  
    var leftTime = end-now; 
    //定义变量 d,h,m,s保存倒计时的时间  
    var d,h,m,s;  
    if (leftTime>=0) {  
        d = Math.floor(leftTime/1000/60/60/24);  
        h = Math.floor(leftTime/1000/60/60%24);  
        m = Math.floor(leftTime/1000/60%60);  
        s = Math.floor(leftTime/1000%60);                     
    }
    //将倒计时赋值到div中
    document.getElementById('m').innerHTML = m;
    document.getElementById('s').innerHTML = s;
    if(m==0){
        if(s==0){
        	sgs = false;
            clearInterval(settime);
            sessionStorage.removeItem("dh");
            $("#time").text("付款成功没反应?点我！！！");
        }
    }
}
function getSetParam(){
	if(sgs){
		$.ajax({
	        type: 'GET',
	        url: "cc.php?appid="+appid+"&dh="+dh+"&type="+type+"&edlm="+randomNum(10,99999),
	        dataType: "json",
	        success:function(ret){
	            setTimeout(getSetParam,2900);//成功后才发第二次，否则即没意义又卡死
	            if(ret.error=='0'){
	            	sgs = false;
	                clearInterval(settime);
		            sessionStorage.removeItem("dh");
		            window.location.href=returnurl;
		            return;
	            }
	        },error:function(){
	        	alert('服务器出小差啦！点击确定后重新加载！');
	            window.location.href="/";
	        }
	    });
	}
}

function randomNum(min,max){ 
    switch(arguments.length){ 
        case 1: 
            return Math.floor(Math.random()*minNum+1); 
        break; 
        case 2: 
            return Math.floor(Math.random()*(max-min+1)+min); 
        break; 
            default: 
                return 0; 
            break; 
    } 
}

$('button').click(function(){
    if($("#time").text()==="付款成功没反应?点我！！！"){
        sgs = false;
        clearInterval(settime);
        sessionStorage.removeItem("dh");
        //window.location.href=returnurl;
        window.open(returnurl, '_blank').location;
        return;
    }
});


function copys(){
    Clipboard.copy(dh);
}
var settime = setInterval(function(){
    countTime();
},1000);
window.Clipboard = (function(window, document, navigator) {
    var textArea,
    copy;
    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }
    function createTextArea(text) {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.appendChild(textArea);
    }
    function selectText() {
        var range,
        selection;
        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }
    function copyToClipboard() {        
        try{
        if(document.execCommand("Copy")){
            alert("已复制此订单订单号"); 
        }else{
            prompt("复制失败,请手动复制下面的订单号", dh); 
        }
        }catch(err){
            prompt("复制失败,请手动复制下面的订单号", dh);
        }
        document.body.removeChild(textArea);
    }
    copy = function(text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };
    return {
        copy: copy
    };
})(window, document, navigator);
//开始循环判断是否付款成功
var sgs = true;
getSetParam();