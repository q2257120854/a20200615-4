// window.onerror = function(msg,url,line,col,error){
//     //没有URL不上报！上报也不知道错误
//     if (msg != "Script error." && !url){
//         return true;
//     }
//     //采用异步的方式
//     //我遇到过在window.onunload进行ajax的堵塞上报
//     //由于客户端强制关闭webview导致这次堵塞上报有Network Error
//     //我猜测这里window.onerror的执行流在关闭前是必然执行的
//     //而离开文章之后的上报对于业务来说是可丢失的
//     //所以我把这里的执行流放到异步事件去执行
//     //脚本的异常数降低了10倍
//     setTimeout(function(){
//         var data = {};
//         //不一定所有浏览器都支持col参数
//         col = col || (window.event && window.event.errorCharacter) || 0;
//
//         data.url = url;
//         data.line = line;
//         data.col = col;
//         if (!!error && !!error.stack){
//             //如果浏览器有堆栈信息
//             //直接使用
//             data.msg = error.stack.toString();
//         }else if (!!arguments.callee){
//             //尝试通过callee拿堆栈信息
//             var ext = [];
//             var f = arguments.callee.caller, c = 3;
//             //这里只拿三层堆栈信息
//             while (f && (--c>0)) {
//                 ext.push(f.toString());
//                 if (f  === f.caller) {
//                     break;//如果有环
//                 }
//                 f = f.caller;
//             }
//             ext = ext.join(",");
//             data.msg = ext;
//         }
//         //把data上报到后台！
//         alert("前端异常提示，测试截图：" + data.url);
//         alert("前端异常提示，测试截图：" + data.line);
//         alert("前端异常提示，测试截图：" + data.col);
//         alert("前端异常提示，测试截图：" + data.msg);
//     },0);
//
//     return true;
// };
/**
 * 所有使用的工具类
 */
var isAmountFlag=false
window.utils = {
    /**
     * 
     * @param {获得的key} key 
     */
    getLocalStorage: function(key) {
        return localStorage.getItem(key) || '';
    },
    /**
     * 
     * @param {key} key 
     * @param {传递的数据} data 
     */
    setLocalStorage: function(key, data) {
        localStorage.setItem(key, data);
    },
    /**
     * 通过key删除localStorage
     * @param {key} key 
     */
    removeLocalStorage: function(key) {
        localStorage.removeItem(key);
    },
    /**
     * 清除所有localStorage
     */
    clearLocalStorage: function() {
        localStorage.clear();
    },

    /**
     * 通过key获得sessionStorage中的数据
     * @param {获得的key} key 
     */
    getSessionStorage: function(key) {
        return sessionStorage.getItem(key) || null;
    },
    /**
     * 设置sessionStorage中的数据
     * @param {key} key 
     * @param {传递的数据} data 
     */
    setSessionStorage: function(key, data) {
        sessionStorage.setItem(key, data);
    },
    /**
     * 通过key删除sessionStorage
     * @param {key} key 
     */
    removeSessionStorage: function(key) {
        sessionStorage.removeItem(key);
    },
    /**
     * 清除所有sessionStorage
     */
    clearSessionStorage: function() {
        sessionStorage.clear();
    },
    /**
     * 
     * @param {字符串} str 
     * @param {补齐0的位数} num 
     */
    digit: function(str) {
        str = str.toString();
        return str[1] ? str : '0' + str;
    },
    /**
     * 判断是否是数字
     * @param {要补齐的数字} str 
     */
    isNumber: function(str) {
        return !this.isNull(str) ? !isNaN(str) : false;
    },
    /**
     * 判断两个值是否相等
     * 注：强制比较，包括同一个字符，但是不同类型
     */
    equals: function(arg1, arg2) {
        return Object.is(arg1, arg2);
    },
    /**
     * 
     * 判断是否是整数
     */
    isInteger: function(str) {
        return Number.isInteger(str);
    },
    /*
     * 判断对象是否为空，可以验证字符串和数组和Object
     */
    isNull: function(obj) {
        return (obj == undefined || obj == null || obj == "" || obj.length == 0 || (obj == null && obj == "" && Object.keys(obj).length == 0));
    },
    /**
     * 将字符转换为数字
     * @param {数字字符串} str 
     */
    parseInt: function(str) {
        return parseInt(str, 10);
    },
    /*
     * 去除字符串两边的空格
     */
    trim: function(str) {
        if (str == null || str == "") return;
        return str.replace(/(^\s*)|(\s*$)/g, '');
    },
    /*
     * 去除字符串全部空格
     */
    trimAll: function(str) {
        if (this.isNull(str)) return;
        return str.replace(/\s/g, '');
    },
    /**
     * 获得当前时间，格式是：yyyy-MM-dd HH:mm:ss
     * @param {传入的日期} date 
     */
    getDefaultTime: function(date) {
        date = date || new Date()
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hour = date.getHours();
        var minute = date.getMinutes();
        var second = date.getSeconds();

        return [year, month, day].map(this.digit).join("-") + " " + [hour, minute, second].map(this.digit).join(":");
    },
    valueToLabel: function(value, dictList) {
        if (!value && value !== 0) {
            console.warn('id为空，请检查后端接口返回')
            return ''
        }
        if (!dictList || dictList.length === 0) {
            console.warn('字典列表为空，请检查是否传入！')
            return value
        }
        for (var i = 0; i < dictList.length; i++) {
            var dict = dictList[i];
            if (value == dict.value) {
                return dict.label
            }
        }
        return ''
    },
    /**
     * 获取指定页面参数
     * @param paraName
     * @returns {string}
     */
    getUrlParam: function(paraName) {
        var url = document.location.toString();
        var arrObj = url.split("?");

        if (arrObj.length > 1) {
            var arrPara = arrObj[1].split("&");
            var arr;

            for (var i = 0; i < arrPara.length; i++) {
                arr = arrPara[i].split("=");

                if (arr != null && arr[0] == paraName) {
                    return arr[1];
                }
            }
            return "";
        }
        else {
            return "";
        }
    },
    isMobile: function() {
        var regex_match = /(iPad|nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;

        var u = navigator.userAgent;

        if (null == u) {
            return true;
        }
        var result = regex_match.exec(u);
        if (null == result) {
            return false
        } else {
            return true
        }

    }

};

/**
 * 所有公用的方法
 */
window.common = {
  
    copyeSuccessFun:  function(e) {
      //  alert(e.trigger.id)
      //  alert($('#orderAmountBtn'))
        if(e.trigger.id=="orderAmountBtn"){
            isAmountFlag=true
            $('#orderAmountBtn').hide();
        }else if(e.trigger.id=="amountCardNo"){
            if(isAmountFlag){
                $('#amountCardNo').hide();
            }else{
                $(".gac-toast").text('请先查看金额');
                setTimeout(function () {
                    $(".gac-toast").hide();
                },1000)
                $(".gac-toast").show();
                return;
            }
        }
        if (!ClipboardJS.isSupported()) {
            window.common.copyeErrorFun();
            return
        }
        if (!window.utils.isMobile()) {
            var clipboardData = window['clipboardData'];
            console.log('clipboardData userAgent：', navigator.userAgent.toLowerCase());
            console.log('clipboardData start：', clipboardData);

            clipboardData && console.log('clipboardData getData：', clipboardData.getData);
            console.log('clipboardData Text：', e);
            e && console.log('clipboardData Text：', e.text);
            clipboardData && console.log('clipboardData Text：', clipboardData.getData('Text'));
            if (clipboardData && clipboardData.getData) {
                if (!clipboardData.getData('Text') || e.text != clipboardData.getData('Text')) {
                    window.common.copyeErrorFun()
                    return;
                }
            }
        }

        if(e.trigger.id=="orderAmountBtn"){
            $(".gac-toastRMB").show();
        }else if(e.trigger.id=="amountCardNo"){
            $('.gac-toastCardNo').show();
        }else{
            $(".gac-toast").text('复制成功');
            $(".gac-toast").show();
        }

      //  $(".gac-toast").text('复制成功');
       // $(".gac-toast").show();
        $(".gac-copy-tips").hide();
        if (copyTimer) {
            clearTimeout(copyTimer)
        }
        copyTimer = setTimeout(function(v, i) {
            $(".gac-toast").hide();
            $(".gac-toastRMB").hide();
            $(".gac-toastCardNo").hide();
        }, 1 * 1000);
    },
    copyeErrorFun: function(e) {
        if (window.utils.isMobile()) {
            $(".gac-toast").text('复制失败，请长按复制');
        } else {
            $(".gac-toast").text('复制失败，请右键复制');
        }
        $(".gac-toast").show();
        $(".gac-copy-tips").hide();
        if (copyTimer) {
            clearTimeout(copyTimer)
        }
        copyTimer = setTimeout(function(v, i) {
            $(".gac-toast").hide();
        }, 1 * 1000);
    },
    /**
     * 展示消息提示框，全局可用
     * @param {配置} options 
     */
    showMessage: function(option) {
        content = option.content || '';
        btnText = option.btnText || '';
        onClick = option.onClick || function () {} ;
        console.log(content);
        $(".message_modal").remove();
        $(['<div class="gac-modal message_modal">',
            '                        <div class="modal-container">',
            '                            <div>',
            (content || "操作成功"),
            '                            </div>',
            '                            <div style="margin-top:2rem;">',
            '                                <button class="btn-success">' + (btnText || "确定") + '</button>',
            '                            </div>',
            '                        </div>',
            '                    </div>'].join("")).appendTo('body').show();
        $(".message_modal .btn-success").bind("click", function () {
            onClick();
            $(".message_modal").hide();
        })
    },
    /**
     * 隐藏消息提示框，全局可用
     */
    hideMessage: function() {
        $(".message_modal").hide();
    },
    /**
     * 转换钱数，前台获得金额会/10000，保留两位小数
     */
    convertMoney: function(num) {
        return (Number(num) / 10000).toFixed(2);
    },
};
    /**
     * 移动端调试工具
     * 页面url传入eruda=true开启
     */
;(function () {
    if (/eruda=true/.test(window.location)) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = '//cdn.bootcss.com/eruda/1.5.2/eruda.min.js';
        document.body.appendChild(script);
        if(script.readyState){   //IE
            script.onreadystatechange=function(){
                /*
                uninitialized - 还未开始载入
                loading - 载入中
                interactive - 已加载，文档与用户可以开始交互
                complete - 载入完成  (loaded)
                */
                if(script.readyState=='complete'||script.readyState=='loaded'){
                    script.onreadystatechange=null;
                    eruda.init();
                }
            }
        }else{    //非IE
            script.onload=function(){eruda.init();}
        }
    }
})();